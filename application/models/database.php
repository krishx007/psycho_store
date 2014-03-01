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

	function GetProductCount()
	{
		return $this->db->count_all('products');
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

	function GetRandomProductIds($count, $type, $game_name, $exceptions/*pass an array with exception values*/)
	{	
		$arr1 = $this->GetProducts($type,'latest',$game_name);
		$final_arr = array_diff_key($arr1, $exceptions);
		var_dump($arr1);
		var_dump($final_arr);
		$max_prods = count($final_arr);
		
		if($count > $max_prods )
			$count = $max_prods;

		$random_prods = array_rand ($final_arr, $count);

		return $random_prods;
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

	function GetOrdersForUser($userId)
	{
		$this->db->where('user_id', $userId);
		$query = $this->db->get('orders');
		return $query->result_array();
	}
}
?>