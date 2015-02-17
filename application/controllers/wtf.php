<?php 
class Wtf extends CI_controller
{
	function __construct()
	{
		parent::__construct();		
	}

	function index()
	{
		$this->_start();
	}

	function _start()
	{
		$this->load->view('view_wtf');
	}
}
?>