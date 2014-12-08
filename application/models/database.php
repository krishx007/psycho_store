<?php
/**
* 
*/
class Database extends CI_Model
{
	
	function __construct()
	{
		$this->load->database();
	}

	//For single product
	function GetProductById($id)
	{
		$this->db->where('product_id', $id);
		$query = $this->db->get('products');
		return $query->row_array();
	}

	function GetProductByURL($url)
	{
		$this->db->where('product_url', $url);
		$query = $this->db->get('products');
		return $query->row_array();
	}

	function GetMaxProductID()
	{
		$result = $this->db->get('products');
		$row = $result->last_row('array');		
		return $row['product_id'];
	}

	function GetproductCount()
	{
		return $this->db->count_all('products');
	}

	function GetAllSuportedGames()
	{
		$this->db->distinct();
		$this->db->select('product_game');
		$this->db->order_by('product_game');
		$query = $this->db->get('products');
		return $query->result_array();
	}

	function GetProducts($type, $sort, $game_name = 'all')
	{	
		if($type != 'all')
			$this->db->where('product_type', $type);
		if($game_name != 'all')
			$this->db->like('product_game', $game_name);

		if($sort == 'latest')
			$this->db->order_by('product_id', 'desc');
		else if($sort =='popular')				
			$this->db->order_by('product_qty_sold', 'desc');	//Sort by selling amount

		$query = $this->db->get('products');
		return $query->result_array();
	}

	function GetRandomProducts ($count, $type, $game_name, $exceptions/*pass an array with exception values*/)
	{	
		$prods = $this->GetProducts($type,'latest',$game_name);
		foreach ($prods as $key => $value)
		{
			if($exceptions)
			{
				foreach ($exceptions as $ex_key => $ex_value)
				{
					if( (string)$value['product_id'] === (string)$ex_value['product_id'] )
						unset($prods[$key]);
				}				
			}
		}		
		$max_prods = count($prods);
		
		if($count > $max_prods )
			$count = $max_prods;
		
		$random_ids = array_rand ($prods, $count);
		$random_prods = array();

		foreach ($random_ids as $key => $value) 
			$random_prods[] = $prods[$value];
		
		return $random_prods;
	}

	function ModifyProduct($product)
	{
		$this->db->where('product_id', $product['product_id']);
		$this->db->update('products', $product);
	}

	function GetUserById($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('users');
		return $query->row_array();
	}

	function GetAddressById($id)
	{
		$this->db->where('address_id', $id);
		$query = $this->db->get('address');
		return $query->row_array();
	}

	function GetAddressesForUser($userid)
	{
		$this->db->where('user_id', $userid);
		$query = $this->db->get('address');
		return $query->result_array();
	}

	function RegisterAddress($data)
	{
		$this->db->insert('address',$data);
	}

	function RemoveAddress($id)
	{
		$this->db->where('address_id', $id);
		$this->db->delete('address');
	}

	function AddOrder($order)
	{
		$this->db->insert('orders',$order);
	}

	//It expects a single order Item
	function AddOrderItem($item)
	{
		$this->db->insert('order_items',$item);
	}

	function GetNumOrders()
	{
		return $this->db->count_all('orders');
	}

	//Gives count num of orders, ordered by date modifed
	function GetOrders($start_id = '0', $count = '20')
	{
		if($start_id < 0 )
			$start_id = 0;

		$max_orders = $this->GetNumOrders();
		if($start_id > $max_orders)
			$start_id = $max_orders - $count;
		
		$this->db->order_by('date_modified', 'desc');

		$query = $this->db->get('orders', $count, $start_id);		
		return $query->result_array();
	}

	function GetOrdersForUser($userId)
	{
		$this->db->where('user_id', $userId);
		$query = $this->db->get('orders');
		return $query->result_array();
	}

	function RewardUser($user_id, $points)
	{
		$this->db->set('points', $points);
		$this->db->where('id', $user_id);		
		$this->db->update('users');
	}

	function Subscribe($email_id)
	{
		//make sure it isnt already present
		$this->db->where('email', $email_id);
		$query = $this->db->get('newsletter');
		if($query->num_rows() == 0)
		{
			$email = array('email' => $email_id);
			$this->db->insert('newsletter',$email);
		}
	}

	function Unsubscribe($email)
	{
		$this->db->where('email_id', $email);
		$this->db->delete('email_id');
	}

	function GetNumOfSubscribers()
	{
		return $this->db->count_all('newsletter');
	}

	function GetDiscountCoupon($coupon)
	{
		$this->db->where('coupon', $coupon);
		$query = $this->db->get('discount_coupons');
		return $query->row_array();
	}

	function GetCheckoutOrder($txn_id)
	{
		$this->db->where('txn_id', $txn_id);
		$query = $this->db->get('checkout_orders');
		return $query->row_array();	
	}

	function GetCheckoutOrderItems($txn_id)
	{
		$this->db->where('txn_id', $txn_id);
		$query = $this->db->get('checkout_items');
		return $query->result_array();	
	}

	function RemoveCheckoutItemsForTxnId($txn_id)
	{
		$this->db->where('txn_id', $txn_id);
		$this->db->delete('checkout_items');
	}

	function CheckoutDone($txn_id)
	{		
		$this->db->where('txn_id', $txn_id);
		$this->db->delete('checkout_orders');

		$this->db->where('txn_id', $txn_id);
		$this->db->delete('checkout_items');
	}

	function SaveTxnIdOnCheckout($txn_id)
	{
		$this->db->set('txn_id', $txn_id);
		$this->db->insert('checkout_orders');
	}

	function SaveAmountOnCheckout($amount, $txn_id)
	{
		$this->db->set('amount', $amount);
		$this->db->where('txn_id', $txn_id);
		$this->db->update('checkout_orders');
	}

	//It expects a single cart item
	function SaveCartItemOnCheckout($item)
	{
		$this->db->insert('checkout_items',$item);
	}

	function SaveUserIdOnCheckout($user_id, $txn_id)
	{
		$this->db->set('user_id', $user_id);
		$this->db->where('txn_id', $txn_id);
		$this->db->update('checkout_orders');
	}

	function SaveAddressOnCheckout($address_id, $txn_id)
	{
		$this->db->set('address_id', $address_id);
		$this->db->where('txn_id', $txn_id);
		$this->db->update('checkout_orders');
	}

	function LockCheckoutOrder($txn_id)
	{
		$this->db->set('state', 'locked');
		$this->db->where('txn_id', $txn_id);
		$this->db->update('checkout_orders');	
	}
}
?>