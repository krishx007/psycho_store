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

	function AddProduct($product)
	{
		$this->db->insert('products',$product);
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

	function AddFeedback($feedback)
	{
		$this->db->insert('feedback', $feedback);
	}

	function RemoveFeedback($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('feedback');
	}

	function GetFeedback($published_only)
	{
		if($published_only)
		{
			$this->db->where('publish', 1);
		}

		$query = $this->db->get('feedback');
		return $query->result_array();
	}

	function SetPublishState($id, $value)
	{
		$this->db->set('publish', $value);
		$this->db->where('id', $id);		
		$this->db->update('feedback');
	}

	//-------------------------- Order Specific Functions -------------------------- 

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

	//Returns both order and order_items
	//order_items are stored in 'order_items' key;
	function GetOrderById($txn_id)
	{
		$order = null;
		$this->db->where('txn_id', $txn_id);
		$query = $this->db->get('orders');		

		if($query->num_rows() > 0)	
		{
			//Get order_items for this txn_id			
			$this->db->where('txn_id', $txn_id);
			$items_query = $this->db->get('order_items');

			$row = $query->row_array();

			//Get the product id and add actual products in 'order_items' array
			$order_items = $items_query->result_array();
			foreach ($items_query->result_array() as $key => $item)
			{
				$order_items[$key]['product'] = $this->GetProductById($item['product_id']);
			}

			$row['order_items'] = $order_items;

			$order = $row;			
		}	

		return $order;
	}

	function UpdateOrderStatus($txn_id, $status)
	{
		$this->db->set('order_status', $status);
		$this->db->where_in('txn_id', $txn_id);
		$query = $this->db->update('orders');
	}

	function AssignWaybill($txn_id, $waybill)
	{
		$this->db->set('waybill', $waybill);
		$this->db->where('txn_id', $txn_id);
		$this->db->update('orders');
	}

	function RemoveWaybillFromOrder($txn_id)
	{
		$this->db->set('waybill', null);
		$this->db->where('txn_id', $txn_id);
		$this->db->update('orders');
	}

	function GetOrdersByStatus($status)
	{
		$this->db->select('txn_id');
		$this->db->where('order_status =', $status);
		$query = $this->db->get('orders');
		$orders = array();

		foreach ($query->result_array() as $row)
		{
			$orders[] = $this->GetOrderById($row['txn_id']);
		}

		return $orders;
	}

	function GetPendingReturnedOrders()
	{

		$this->db->select('txn_id');
		$this->db->where('order_status !=', 'shipped');
		$query = $this->db->get('orders');
		$orders = array();

		foreach ($query->result_array() as $row)
		{
			$orders[] = $this->GetOrderById($row['txn_id']);
		}

		return $orders;
	}

	function GetAllOrders()
	{
		$this->db->select('txn_id');	
		$query = $this->db->get('orders');
		$orders = array();
		foreach ($query->result_array() as $row)
		{
			$orders[] = $this->GetOrderById($row['txn_id']);
		}

		return $orders;
	}

	//Format is "y-m-d"
	function GetOrdersForDate($start_date, $end_date)
	{
		$start_date = $start_date." 00:00:00";
		$end_date = $end_date." 23:59:59";		
		
		$this->db->select(array('txn_id', 'date_created'));
		$this->db->having(array('date_created >= ' => $start_date, 'date_created <= ' => $end_date));
		$query = $this->db->get('orders');		
		if($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
			{
				$orders[] = $this->GetOrderById($row['txn_id']);
			}
			return $orders;
		}

		return null;
	}

	//-------------------------- XXX -------------------------- 

	function GetDataForGameSalesChart()
	{		
		$this->db->select_sum('product_qty_sold');
		$this->db->group_by('product_game');
		$query = $this->db->get('products');
		return $query->result_array();
	}

	function GetDataForStatesChart()
	{
		$sql = "Select *,Count('state') From ( SELECT address.state
		FROM address
		INNER JOIN orders
		ON orders.address_id=address.address_id ) as t
		Group By `state`";

		$query = $this->db->query($sql);		
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
		$ret = false;
		//make sure it isnt already present
		$this->db->where('email', $email_id);
		$query = $this->db->get('newsletter');
		if($query->num_rows() == 0)
		{
			$email = array('email' => $email_id);
			$this->db->insert('newsletter',$email);
			$ret = true;
		}

		return $ret;
	}

	function SubscriberUpdated($email)
	{		
		$this->db->set('last_update', date('Y-m-d H:i:s'));
		$this->db->where('email', $email);
		$this->db->update('newsletter');
	}
	
	function GetSubscribers($to_update, $update_threshold = '60*5')
	{
		if($to_update)
		{
			//Get only those who havent been updated recently
			$this->db->where('UNIX_TIMESTAMP(last_update) >', time() - $update_threshold);
			$query = $this->db->get('newsletter');
		}
		else
		{			
			$query = $this->db->get('newsletter');		
		}

		return $query->result_array();
	}

	function GetTestEmails()
	{
		$query = $this->db->get('test_mails');
		return $query->result_array();	
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

	function SetWaybillState($waybill, $state)
	{
		$this->db->set('state', $state);
		$this->db->where_in('waybill', $waybill);
		$this->db->update('delhivery_waybills');
	}

	function DeleteWaybill($waybill)
	{		
		$this->db->where_in('waybill', $waybill);
		$this->db->delete('delhivery_waybills');
	}

	function GetWaybills($count = 1)
	{
		$this->db->where('state !=', 'dead');
		$this->db->limit($count);
		$query = $this->db->get('delhivery_waybills');
		$result = $query->result_array();

		foreach ($result as $key => $waybill)
		{
			$wb[] = $waybill['waybill'];
		}

		$this->SetWaybillState($wb, 'dead');

		return $wb;
	}

	//-------------------------- Checkout Specific Functions -------------------------- 

	function GetDiscountCoupon($coupon)
	{
		$this->db->where('coupon', $coupon);
		$query = $this->db->get('discount_coupons');
		return $query->row_array();
	}

	//For now its only Delhivery
	function GetShippingDetails($pincode)
	{
		$this->db->where('pincode', $pincode);
		$query = $this->db->get('delhivery');
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

	function RemoveCheckoutItemsForTxnId($txn_id)
	{
		$this->db->where('txn_id', $txn_id);
		$this->db->delete('checkout_items');
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
	//-------------------------- XXX -------------------------- 
}
?>