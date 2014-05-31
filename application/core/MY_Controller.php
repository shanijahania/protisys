<?php

/**
 * The base controller which is used by the Front and the Admin controllers
 */
class Base_Controller extends CI_Controller
{
	
	public function __construct()
	{
		
		parent::__construct();
		
	}//end __construct()
	
}//end Base_Controller

class Front_Controller extends Base_Controller
{
	
	//we collect the categories automatically with each load rather than for each function
	//this just cuts the codebase down a bit
	var $categories	= '';
	
	//load all the pages into this variable so we can call it from all the methods
	var $pages = '';
	
	function __construct(){
		
		parent::__construct();

		$this->load->model(array('usersmodel'));

		$this->load->model(array('showrooms_model'));
		$this->load->model(array('products_model'));
		$this->load->model(array('locations_model'));
		
		//load the theme package
		$this->load->add_package_path('application/themes/'.$this->config->item('theme').'/');
		$guest_session_config = array(
		    'sess_cookie_name' => 'guest_session_config',
		    'sess_expiration' => 0
		);
		$this->load->library('session', $guest_session_config, 'feed_session');
	}
	
	/*
	This works exactly like the regular $this->load->view()
	The difference is it automatically pulls in a header and footer.
	*/
	function view($view, $vars = array(), $string=false)
	{
		if($string)
		{
			$result	 = $this->load->view('header', $vars, true);
			$result	.= $this->load->view($view, $vars, true);
			$result	.= $this->load->view('footer', $vars, true);
			
			return $result;
		}
		else
		{
			$this->load->view('header', $vars);
			$this->load->view($view, $vars);
			$this->load->view('footer', $vars);
		}
	}
	
	/*
	This function simple calls $this->load->view()
	*/
	function partial($view, $vars = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $vars, true);
		}
		else
		{
			$this->load->view($view, $vars);
		}
	}
}

class Admin_Controller extends Base_Controller 
{
	function __construct()
	{
		
		parent::__construct();
		
		$module = $this->uri->segment(2);
		$action = $this->uri->segment(3);

		$this->load->library('auth');
		$this->auth->is_logged_in(uri_string());
		$this->auth->check_permission($module);
		$this->auth->check_admin_access($module);
		$this->auth->check_action_allowed($module, $action);
		//load the base language file
		$this->lang->load('admin_common');
		$this->lang->load('goedit');

		//load models
		$this->load->model('member_meta_model');
		$this->load->model('permissions_model');
		$this->load->model('modules_model');
	}

	function permissions()
	{
		
	}
}