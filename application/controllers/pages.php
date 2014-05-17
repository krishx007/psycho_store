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
			$this->_send_email('subscribe', $email_id, $data);			
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
			$id = $id + 1; if($id > $total_products ) $id = 1;
			$result = $this->database->GetProductById($id);						
		}		
		$next = $result['product_id'];		
		
		//reset
		$result = null;
		$id = $current_id;
		while(count($result) < 1)
		{
			$id = $id - 1; if($id < 1 ) $id = $total_products;
			$result = $this->database->GetProductById($id);		
		}
		$prev = $result['product_id'];	
	}

	function product($url)
	{
		$total_products = $this->database->GetMaxProductID();
		$url = $this->beautify($url,'_');
		$result = $this->database->GetProductByURL($url);
		if($result)
		{
			$next = $prev = 0;
			$this->GetNextPreviousIds($result['product_id'], $next, $prev, $total_products);
			$data['product'] = $result;
			$data['total_products'] = $total_products;			
			$data['next_id'] = url_title($this->database->GetProductById($next)['product_url'],'_');
			$data['prev_id'] = url_title($this->database->GetProductById($prev)['product_url'],'_');
			$data['small_stock']="";
			$data['medium_stock']="";
			$data['large_stock']="";
			$data['xl_stock']="";

			if($result['product_count_small'] <= 0)
				$data['small_stock'] = 'disabled';
			if($result['product_count_medium'] <= 0)
				$data['medium_stock'] = 'disabled';
			if($result['product_count_large'] <= 0)
				$data['large_stock'] = 'disabled';
			if($result['product_count_xl'] <= 0)
				$data['xl_stock'] = 'disabled';			
			
			//Generate Suggestions
			$data['suggested_products'] = $this->GenerateSuggestions($result, 6);
			$this->display('product', $data);			
		}
		else
			echo "No product available";
	}

	function latest()
	{		
		$data['products'] = $this->database->GetProducts('all', 'latest', 'all');
		$data['latest_link_state'] = 'active';
		$data['popular_link_state'] = 'none';
		$this->display('browse', $data);
	}

	function popular()
	{		
		$data['products'] = $this->database->GetProducts('all', 'popular', 'all');
		$data['popular_link_state'] = 'active';
		$data['latest_link_state'] = 'none';
		$this->display('browse', $data);
	}
	
	//Removes spaces from a url
	function beautify($string, $replace_char)
	{
		return str_replace($replace_char,' ',$string);
	}


	function search($game = "")
	{
		$name = ($this->input->post('search_query') != false) ? trim($this->input->post('search_query')) : $this->beautify($game,'_');

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

		$this->display('search', $data);
	}

	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->lang->load('tank_auth');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		if(!$this->email->send())
			show_error($this->email->print_debugger());
	}

	function subscribe()
	{
		$email_id = strtolower($this->input->post('subscribe_email'));
		$data = array();

		if(valid_email($email_id))
		{			
			$this->database->Subscribe($email_id);
			$data['site_name'] = 'Psycho Store';
			//$this->_send_email('subscribe', $email_id, $data);			
			$data['heading'] = "<small>Greetings</small> ".$email_id;
			$data['content'] = "We dont know who you are. We dont know what you want. If you are looking for toilet brushes, We can tell you we dont have any. But what we do have are a very particular set of gaming stuff. Stuff that we have made with a lot of hardwork. Stuff that can make people like you very happy. If you buy that stuff from us, that will be the end of it. We will not look for you, We will not pursue you. But if you dont, we will look for you, we will find you, and we will keep updating you.";
		}
		else
		{
			$data['email_id'] = $email_id;
			$data['heading'] = "Damn, you cant even type an email correctly";
			$data['content'] = "Just dont disappoint this time, try again";
		}

		$this->display('basic', $data);
	}

	function policies()
	{
		$data['heading'] = "Shipping and Returns";

		$data['content'] = "At Psycho Store our aim is to always provide you with high quality stuff as quickly as possible. But in some unfortunate situations we may err. 
							<h3>Free Shipping all over India</h3>
							Its as simple as that we ship all our products totally free, no minimum cost or hidden text, wether you pay us Online or Cash On Delivery everything is shipped totally free.
							Your product will reach you in about 5-10 buisness days, given that there is no involvement of G-Man or some other force beyond our control. As of now we ship only in India.
							<br><h3 > 365 days Return Policy</h3>
							If you recieved a defective product or we sent the wrong size or a completelty different tshirt, curse us and punch us in the face if you want and send us the product back whenever you can (literally 365 days) with its original packing. We will inspect the product and see if you are telling the truth and will do a refund or excahnge as you desire.
							We will bear the shipping charges as well if it is acceptable for returning.
							<br><br> If you realised just now that you dont look good in this colour or you didn't check the size chart before buying, then we will curse you, punch you in the face if we can, but sigh, we will still accept the product back and do an exchange.You will have to bear the shipping charges in this case.
							<br><br> Note : In both the cases, product should be in its original condition, it should not be worn or washed, otherwise it will not be returned.
							<br><br>Email us with your product id at <a href=\"mailto:returns@psychostore.in\">returns@psychostore.in</a> and ship the product to given address
							<br><br> Return Address :
							<br>
							F5, Ganraj Heights,<br>
							Sainikwadi, Wadgaon Sheri,<br>
							Pune - 411014,<br>
							Maharashtra
							<br><br>For any other query email us at <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a>";
							
							

		$this->display('basic', $data);
	}

	function contact()
	{
		$data['heading'] = "Psycho Store <small>designed and developed by</small> Psycho Corporation";
		$data['content'] = "<h3>Head office</h3>55/2 Nanak Nagar,<br> Lane 1,<br> Jammu - 180004,<br> Jammu and Kashmir<br><br>Phone : +917387045828<br>Email : <a href=\"mailto:contact@psychostore.in\">contact@psychostore.in</a>
							<br><br><h4>Address for Refunds and Returns</h4>
							F5, Ganraj Height,<br> Sainikwadi, Wadgaon sheri,<br> Pune - 411014,<br> Maharashtra";

		$this->display('basic', $data);
	}


	function about()
	{
		$data['heading'] = "Who are We";
		$data['content'] = "<h3>Psycho Store</h3>You probably would be thinking why the word \"Psycho\" in a Gaming Apparell store.Well it actually has to do with a problem that I have, that is getting increasingly obsessed with something that I am passionate about.
							Giving it all that I have and actually going that exrtra mile when everyone else's common sense says that you are walking in the wrong direction. Did you ever had that feeling that whatever you were doing, your mind was always stuck on that one thing, that one thing which you just cannot get out of your head.
							I call that being in a state of psychoness, when you feel about something deep from your heart and you take absurd decisions to get it through, no matter what it takes and whats the costs. If you can relate, then just give us a shout I am sure our frequency would match.
							In short we have that crazy streak in us for whatever we decide to do. <br>In Hindi we say \"keeda hona chahiye kisi cheez k liye\".<br>
							Whatever we do, we do with that crazy streak, whoever we work with, we just try to look for that crazy streak in them as well.
							<br><br>Oh by the way, what were you asking <h3>who are we?</h3>We are the people who are working hard to create Psycho Store the biggest and the most badass clothing brand for the gaming community, across the earth(other planets can wait for now). So that you gamers can have stuff from your favorite games that you have always wanted.<br>
							<h3><small>What is</small> <> by Codinpsycho ?</h3>
							It means all this crazy stuff was thought,designed and programmed by a single guy alone, who calls himself Codinpsycho, god knows why. Also he open sourced this website's code, if any programmer out there wants to use. Get in touch with him and praise him, that would make him happy which in turn will make him do more creative stuff.<br>
							<a href=\"https://twitter.com/codinpsycho\"><h5 class=\" molot\">Twitter</h5></a>
							<a href=\"https://www.facebook.com/codinpsycho\"><h5 class=\" molot\">Facebook</h5></a>
							<a href=\"https://github.com/codinpsycho\"><h5 class=\" molot\">github</h5></a>
							<a href=\"https://github.com/codinpsycho/psycho_store\"><h5 class=\" molot\">Source Code</h5></a>
							<br><br><br>P.S : He also wrote all that stuff you just read, including this line.
							";

		$this->display('basic', $data);
	}

	function GenerateHeader(&$data)
	{
		//Login Info
		$data['user_id'] = 0;
		$data['user_name'] = null;

		if($this->tank_auth->is_logged_in())
		{
			$data['user_id'] 	= $this->tank_auth->get_user_id();
			$data['user_name'] 	= $this->tank_auth->get_username();
		}

		//Cart Info
		$data['num_items'] = $this->cart->total_items();
		$data['total_price'] = $this->cart->total();

		//Game search Links
		$data['supported_games'] = $this->database->GetAllSuportedGames();		
	}

	function display($page, $data)
	{
		$this->GenerateHeader($data);

		//Show header
		$this->load->view('header', $data);

		//Show body		
		switch ($page)
		{
			case 'search':
			$this->load->view('view_search', $data);
			break;
			case 'browse':
				$this->load->view('home', $data);	
			break;
			case 'product': 				
				$this->load->view('view_product', $data);
			break;		
			case 'basic':			
				$this->load->view('basic_view', $data);
				break;			
			default:
				show_404();
			break;		
		}		

		//Show footer
		$this->load->view('footer', $data);
	}
}
?>