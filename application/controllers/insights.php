<?php 

class insights extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('tank_auth');
		$this->load->library('cart');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('html');
		$this->load->helper('psycho_helper');
		$this->load->model('database');
	}

	function index()
	{
		$is_admin = $this->_is_user_admin();

		$month = $this->input->post('month');
		
		if($month === false)
		{
			$month = date("M");
		}

		$data['heading'] = "Insights";
		
		$all_orders = $this->database->GetAllOrders();
		
		//Get this months orders data
		$month_info = $this->_getOrdersDataForMonth($month);

		$data['month'] = $month;
		$data['sales_data'] = $month_info['orders'];
		$data['num_orders'] = $month_info['num_orders'];
		$data['dates'] = $month_info['dates'];
		$data['revenue_data'] = $month_info['revenue'];
		$data['total_revenue'] = $month_info['total_revenue'];
		$data['cod_orders'] = $this->_getNumCodOrders($all_orders);
		$data['online_orders'] = $this->_getNumOnlineOrders($all_orders);		
		$data['is_admin'] = $is_admin;
		
		//Get Statewise Orders data
		$state_info = $this->_getStateWiseOrderData();

		$data['states'] = $state_info['states'];
		$data['states_sales'] = $state_info['states_sales'];

		//Get Game Sepcific Sales Data
		$games_data = $this->database->GetDataForGameSalesChart();
		foreach ($games_data as $key => $value)
		{
			$data['game_sales_data'][] = (int)$value['product_qty_sold'];
		}

		$all_games = $this->database->GetAllSuportedGames();
		foreach ($all_games as $key => $value)
		{
			$data['all_games'][] = $value['product_game'];
		}


		generate_header($data);

		//Show header
		$this->load->view('header', $data);

		$this->load->view('view_insights', $data);

		$this->load->view('footer', $data);
	}

	function _is_user_admin()
	{
		$current_user = $this->database->GetUserById($this->tank_auth->get_user_id());		
		$admin = false;
		$admin_emails = $this->config->item('admin_email');
		
		foreach ($admin_emails as $key => $email)
		{
			if($current_user)
			{
				if($current_user['email'] == $email )
				{
					$admin = true;
				}
			}			
		}

		return $admin;
	}

	function _getNumCodOrders($orders)
	{
		$count = 0;
		foreach ($orders as $key => $value)
		{
			if($value['payment_mode'] == "cod")
			{
				$count++;
			}
		}

		return $count;
	}

	function _getNumOnlineOrders($orders)
	{
		$count = 0;
		foreach ($orders as $key => $value)
		{
			if($value['payment_mode'] == "online")
			{
				$count++;
			}
		}

		return $count;	
	}

	function _getNumOrdersForDate($date, $orders)
	{
		$start_date = $date. " 00:00:00";
		$end_date = $date. " 23:59:59";
		$sales = 0;
		if($orders != null)
		{
			foreach ($orders as $key => $value)
			{			
				if(strtotime($value['date_created']) >= strtotime($start_date) && strtotime($value['date_created']) <= strtotime($end_date))
				{
					$sales++;
				}
			}
		}

		return $sales;
	}

	function _getRevenueForDate($date, $orders)
	{
		$start_date = $date. " 00:00:00";
		$end_date = $date. " 23:59:59";
		$revenue = 0;
		if($orders != null)
		{
			foreach ($orders as $key => $value)
			{			
				if(strtotime($value['date_created']) >= strtotime($start_date) && strtotime($value['date_created']) <= strtotime($end_date))
				{
					$revenue += $value['order_amount'];
				}
			}
		}

		return $revenue;
	}

	//Expects month as date("M");
	function _getOrdersDataForMonth($month)
	{
		$month_orders = null;
		$month_revenue = null;
		$month_dates = null;
		$year = date("Y");

		$mon_to_num = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06', 'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' =>'11', 'Dec' => '12' );
		$mon = $mon_to_num[$month];
		$start_date = $year."-$mon-01";
		$end_date = $year."-$mon-31";
		$orders = $this->database->GetOrdersForDate($start_date, $end_date);

		for($i = 1; $i<=31; $i++)
		{
			$date = $year."-$mon-$i";
			$month_orders[] = $this->_getNumOrdersForDate($date, $orders);
			$month_revenue[] = $this->_getRevenueForDate($date, $orders);
			$month_dates[] = $i;
		}

		$month_info['orders'] = $month_orders;
		$month_info['num_orders'] = array_sum($month_orders);
		$month_info['dates'] = $month_dates;
		$month_info['revenue'] = $month_revenue;
		$month_info['total_revenue'] = array_sum($month_revenue);
		
		return $month_info;
	}

	function _getStateWiseOrderData()
	{
		$states_data = $this->database->GetDataForStatesChart();		
		$states = array();
		$states_sales = array();
		foreach ($states_data as $key => $value)
		{
			$states[] = $value['state'];
			$states_sales[] = $value["Count('state')"];
		}

		$state_info['states'] = $states;
		$state_info['states_sales'] = $states_sales;
		
		return $state_info;		
	}
}

?>