<?php 
/**
* 
*/
class cart extends CI_controller
{	
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('cart');
		$this->load->model('database');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->library('tank_auth');
	}

	function index()
	{		
		$this->view();
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

		//Meta tags
		$data['url'] = current_url();
		$data['favico'] = site_url('images\ps.jpg');
		$data['title'] = 'Psycho Store | Gaming merchandise brand';
		$data['description'] = "We craft clothing/merchandises for the gaming community of earth(other planets can wait for now)";
		$data['keywords'] = 't-shirt, tshirt, t shirt, shirt, tee, t, t-shirts, tshirts, t shirts, shirts, tees, ts, clothing, clothes, threads, wear, gift, gifts, hats, hat, beanies, beanie, gear, sweatshirt, hoodie, sweatshirts, hoodies, gamer, geek, hacker, nerd, computer, gamers, geeks, hackers, nerds, coder, coders,';
		$data['image'] = site_url('images\ps.jpg');
	}

	//make sure user cant enter more than available tshirts qty
	function setStockText(&$data)
	{		
		foreach ($this->cart->contents() as $items)
		{
			$prod_id = $items['id'];
			$product = $this->database->GetProductById($prod_id);				
			//Check stock Size and set stock state					
			$data['products'][$items['rowid'].'stock_state'] = "";
			$size = $items['options']['Size'];			
			$size_in_stock = $product['product_count_'.strtolower($size)];
			if($items['qty'] > $size_in_stock)
				$data['products'][$items['rowid'].'stock_state'] = "Out Of Stock";				
				

			$data['products'][$prod_id] = $product;
		}
	}

	//Show items in cart
	function view()
	{
		$data[] = 0;
		$num_items = $this->cart->total_items();		
		$this->GenerateHeader($data);		
		$this->setStockText($data);		

		$this->load->view('header',$data);
		$this->load->view('view_cart',$data);
		$this->load->view('footer');
	}	

	function add($productID)
	{		
		//Get the product using id
		$product = $this->database->getProductbyId($productID);
		if($product)
		{			
			$size = $this->input->post('size');
			if($size)
			{
				$cart_item = array
					(
						'id' 	=> $productID,
						'qty'	=> '1',
						'price' => $product['product_price'],
						'name'  => $product['product_name'],
						'options'=> array('Size' => $size),
					);
				
				$row_id = $this->cart->insert($cart_item);
			}
		}
		
		redirect('cart');
	}

	function remove($row_id)
	{		
		$data = array('rowid' => $row_id, 'qty' => 0);
		$this->cart->update($data);

		redirect('cart');
	}

	function update()
	{		
		foreach ($this->cart->contents() as $items)
		{
			if( $this->input->post($items['rowid']) != (string)FALSE)
			{				
				$id = $items['rowid'];
				$quant = (int)$this->input->post($items['rowid']);

				//Update Cart
				$data = array('rowid' => $id, 'qty' => $quant);
				$this->cart->update($data);
			}
		}

		redirect('cart');
	}

	function getDiscount($coupon)
	{		
		$discount = $this->database->GetDiscountCoupon($coupon);
		
		if(count($discount) > 0)
		{
			//Make sure it hasnt expired yet
			if( strtotime($discount['expiry']) > strtotime(date("Y-m-d")) )
			{
				return $discount['how_much'];
			}
		}
		return 0;	
	}

	function applyDiscount()
	{
		if($this->input->post('coupon') != (string)FALSE)
		{
			$coupon = trim($this->input->post('coupon'));
			$this->cart->apply_discount($this->getDiscount($coupon));
		}

		redirect('cart');
	}
}
?>