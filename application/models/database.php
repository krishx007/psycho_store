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

	function GetProductById($id)
	{
		$this->db->where('product_id', $id);
		$query = $this->db->get('products');
		return $query->row_array();
	}
	
	function GetProductByName($name)
	{
		$this->db->like('product_game', $name);
		$query = $this->db->get('products');
		return $query->result_array();
	}

	function GetProduct($type, $sort = 'latest')
	{
		//-----Use type also------
		
		if($sort == 'latest')
			$this->db->order_by('product_id', 'desc');
		else if($sort =='popluar')
			$this->db->order_by('product_id', 'desc');	//Sort by selling amount

		$query = $this->db->get('products');		
		return $query->result_array();
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