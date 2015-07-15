<?php 
/**
* 	
*/
class Pages extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('psycho_helper');
		$this->load->helper('mailgun_helper');
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->load->helper('email');
	}

	function index()
	{
		$this->signup();
		//$this->latest('all');
	}

	function signup()
	{
		$data['num_of_gamers'] = $this->database->GetNumOfSubscribers();
		$this->load->view('launch_signup', $data);		
	}

	function beta()
	{
		$this->latest('all');
	}

	function launch_signup()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{
			$this->database->Subscribe($email_id);
			$data['site_name'] = 'Psycho Store';
			$params = mg_create_mail_params('subscribe', $data);
			mg_send_mail($email_id, $params);
		}		

		redirect('');
	}	

	function GenerateSuggestions($product, $howmany)
	{		
		$exception[] = $product;
		$suggested_products = $this->database->GetRandomProducts($howmany,'all', 'all', $exception);
		return $suggested_products;
	}

	function GetNextPreviousIds($current_id, &$next, &$prev, $total_products)
	{		
		$result = array();
		$id = $current_id;
		
		while(count($result) < 1)
		{
			$id = $id + 1;
			if($id > $total_products )
				$id = 1;
			$result = $this->database->GetProductById($id);						
		}

		$next = $result['product_id'];		
		
		//reset
		$result = null;
		$id = $current_id;
		while(count($result) < 1)
		{
			$id = $id - 1;
			if($id < 1 )
				$id = $total_products;
			$result = $this->database->GetProductById($id);
		}
		$prev = $result['product_id'];	
	}

	function AddToRecentlyViewed($product)
	{
		$recently_viewed = $this->session->userdata('recently_viewed');
				
		//Make sure no duplicate entries are there
		if(is_array($recently_viewed))
		{
			foreach ($recently_viewed as $key => $value)
			{
				if($value['product_id'] == $product['product_id'])
					return;
			}
		}
		
		//Make sure at a time there are only 6 recent prods
		if(count($recently_viewed) >= 6)
		{
			$recently_viewed = array_reverse($recently_viewed);
			array_pop($recently_viewed);
			$recently_viewed = array_reverse($recently_viewed);
		}

		$recently_viewed[] = $product;		
		$this->session->set_userdata('recently_viewed', $recently_viewed);
	}

	function GetRecentlyViewed()
	{
		return $this->session->userdata('recently_viewed');
	}

	function feedback()
	{
		$feedback = $this->database->GetFeedback(TRUE);
		$data['feedbacks'] = $feedback;
		
		display('feedback_wall', $data);
	}

	function product($id, $url = null)
	{
		$total_products = $this->database->GetMaxProductID();
		$url = $this->beautify($url,'_');
		$result = $this->database->GetProductById($id);		
		if($result)
		{
			$next = $prev = 0;
			$this->GetNextPreviousIds($result['product_id'], $next, $prev, $total_products);
			$data['product'] = $result;
			$data['total_products'] = $total_products;	
			$data['next_id'] = product_url( $this->database->GetProductById($next), false );
			$data['prev_id'] = product_url( $this->database->GetProductById($prev), false );
			$data['small_stock']="";
			$data['medium_stock']="";
			$data['large_stock']="";
			$data['xl_stock']="";
			$data['size_chart'] = site_url($this->config->item('size_chart'));

			if($result['product_count_small'] <= 0)
				$data['small_stock'] = 'disabled';
			if($result['product_count_medium'] <= 0)
				$data['medium_stock'] = 'disabled';
			if($result['product_count_large'] <= 0)
				$data['large_stock'] = 'disabled';
			if($result['product_count_xl'] <= 0)
				$data['xl_stock'] = 'disabled';			
			
			//Generate Suggestions
			$data['suggested_products'] = $this->GenerateSuggestions($result, 3);

			$data['recently_viewed'] = $this->GetRecentlyViewed();
			$this->AddToRecentlyViewed($result);

			display('product', $data);
		}
		else
		{
			$data['heading'] = 'No Products Found';
			$data['content'] = "I am sure, this has something to do with G-Man, anyways just go somewhere else, try some other product";
			display('basic', $data);
		}
	}

	function latest()
	{
		$data['products'] = $this->database->GetProducts('all', 'latest', 'all');
		$data['latest_link_state'] = 'active';
		$data['popular_link_state'] = 'none';		
		display('browse', $data);
	}

	function popular()
	{		
		$data['products'] = $this->database->GetProducts('all', 'popular', 'all');
		$data['popular_link_state'] = 'active';
		$data['latest_link_state'] = 'none';
		display('browse', $data);
	}
	
	//Removes spaces from a url
	function beautify($string, $replace_char)
	{
		return str_replace($replace_char,' ',$string);
	}


	function like($game = "")
	{
		$name = ($this->input->post('search_query') != false) ? trim($this->input->post('search_query')) : $this->beautify($game,'-');

		$data['search_result'] = 0;
		$data['search_text'] = $name;
		$data['products'] = array();
		if(strlen($name))
		{			
			$result = $this->database->GetProducts('all','latest', $name);
			$count = count($result);
			$data['search_result'] = $count;

			if($result)
				$data['products'] = $result;			
		}		

		display('search', $data);
	}

	function subscribe()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{			
			if($this->database->Subscribe($email_id))
			{
				$data['site_name'] = 'Psycho Store';
				mg_add_subscriber($email_id);
				$params = mg_create_mail_params('subscribe', $data);
				mg_send_mail($email_id, $params);

				$data['heading'] = "<small>Greetings</small> ".$email_id;
				$data['content'] = "We dont know who you are. We dont know what you want. If you are looking for toilet brushes, We can tell you we dont have any. But what we do have are a very particular set of gaming stuff. Stuff that we have made with a lot of hardwork. Stuff that can make people like you very happy. If you buy that stuff from us, that will be the end of it. We will not look for you, We will not pursue you. But if you dont, we will look for you, we will find you, and we will keep updating you.";
			}
			else
			{
				$data['heading'] = $email_id;
				$data['content'] = "We understand you love us, and you love playing around our website and subscribing to Psycho Store newsletter. But you are already in our list you know. Dont fret we wont forget you, you know. Adding your name once is enough you know. Just so you know.";
			}
		}
		else
		{
			$data['email_id'] = $email_id;
			$data['heading'] = "Damn, you cant even type an email correctly";
			$data['content'] = "Just dont disappoint this time, try again";
		}

		display('basic', $data);
	}

	function unsubscribe()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{			
			$this->database->Unsubscribe($email_id);
			mg_unsubscribe($email_id);
			$data['email_id'] = $email_id;
			$data['heading'] = "You have been Unsubscribed";
			$data['content'] = "So this is the end of us. Take care and stay Psycho anyways.";
		}

		display('basic', $data);
	}

	function shipping_returns()
	{
		$data['heading'] = "Shipping and Returns";
		$ret_address = format_address($this->config->item('return_address'));

		$data['content'] = "<p>At Psycho Store our aim is to always provide you with unique and highest quality merchandises that you have always desired for.</p>
							<h3>Free Shipping all over India</h3>
							<p>Its as simple as that we ship all our products totally free, no minimum cost or hidden text, wether you pay us Online or Cash On Delivery everything is shipped totally free.
							Your product will reach you in about 3-5 buisness days, given that there is no involvement of G-Man or some other force beyond our control. As of now we ship only in India.</p>
							<h3> 365 days Return Policy</h3>
							<p>If you recieved a defective product or we sent the wrong size or a completelty different tshirt, curse us and punch us in the face if you want but most importantly notify us along with your order ID at <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a> within 2 days and send us the product back whenever you can (literally 365 days) in its original condition. We will inspect the product and will do a refund or excahnge as you desire.
							We will bear the shipping charges as well if its our fault.
							<br><br> If you realised just now that you dont look good in this colour or you didn't check the size chart before buying, then we will curse you, punch you in the face if we can, but sigh, we will still accept the product back and do an exchange.You will have to bear the shipping charges in this case.
							<br><br> Note : In both the cases, problem should be notified within 2 days along with order ID at <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a> and returned product should be in its original condition, it should not be worn or washed, otherwise it will not be returned. Also Cash On Delivery handling charges are not refundable.
							<br><br>Email us with your product id at <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a> and ship the product to given address
							<br><br>
							<h4 class=\"molot\">Address for returns</h4>
							$ret_address
							<br><br>
							For any other query email us at <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a></p>";
							
							

		display('basic', $data);
	}

	function contact()
	{
		$data['return_address'] = format_address($this->config->item('return_address'));
		display('contact', $data);
	}


	function about()
	{
		$data['heading'] = "Who are We";
		$data['content'] = "<h3>Our belief</h3><p>You probably would be thinking why the word \"Psycho\" in a Gaming Merchandise store. Well it actually has to do with a problem that we have, \"Our Belief\" that is getting increasingly obsessed with something that we are passionate about.
							Giving it all that we have and actually going that extra mile when everyone else's common sense says that it's the wrong direction. Did you ever had that feeling that whatever you were doing, your mind was always stuck on that one thing, that one thing which kept knocking on the back door of your mind.
							We call that being in a state of psychoness, in which you feel about something so deep from your heart that you take absurd decisions to get it through, no matter what it takes and whats the cost. If you can relate, then just give us a shout I am sure our frequencies would match.
							In short we have that crazy streak in us for whatever we decide to do. <br>In Hindi we say \"keeda hona chahiye kisi cheez ke liye\". We just replaced keeda with psycho and we are proud to say that we have that in us.<br>
							Whatever we do, we do with that crazy streak, whoever we work with, we just try to look for that crazy streak in them as well.
							<br><br>Oh by the way, you were asking</p> <h3>who are we?</h3> <p>We are the people who are working hard to create Psycho Store the biggest and the most badass merchandise brand for the gaming and geek community of earth (other planets can wait for now).<br></p>
							<h3><small>What is</small> <> by Codinpsycho ?</h3>
							<p>It means all this crazy stuff was thought,designed and programmed by a single guy, who calls himself Codinpsycho, god knows why. Also he open sourced this website's code, if any programmer out there wants to use. Get in touch with him and praise him, that would make him happy which in turn will make him do more creative stuff.<br></p>
							<h5 class=\" molot\"><a target='_blank' href=\"https://twitter.com/codinpsycho\">Twitter </a></h5>
							<h5 class=\" molot\"><a target='_blank' href=\"https://www.facebook.com/codinpsycho\">Facebook </a></h5>
							<h5 class=\" molot\"><a target='_blank' href=\"https://github.com/codinpsycho\">github</h5></a>
							<h5 class=\" molot\"><a target='_blank' href=\"https://github.com/codinpsycho/psycho_store\">Source Code</h5></a>
							Kudos to these kickass human beings: 
							<a traget='_blank' href=\"https://twitter.com/mdo\">@mdo</a> and <a traget=\"_blank\" href=\"https://twitter.com/fat\">@fat</a> for <a traget=\"_blank\" href=\"https://getbootstrap.com/\">Bootstrap</a>,
							guys at <a traget='_blank' href=\"http://ellislab.com/\">Ellis Lab</a> for <a traget='_blank' href=\"https://github.com/EllisLab/CodeIgniter/\">CodeIgniter</a></p>
							<p><br><br><br>P.S : He also wrote all that stuff you just read, including this line.</p>
							";

		display('basic', $data);
	}
}
?>