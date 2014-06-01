<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends front_controller {

	var $date;
	function __construct()
	{
		parent::__construct();
		$this->date = date('Y-m-d H:i:s');
	}
	function _404()
	{

		$data['page_title'] = "404 Page not found.";
		$data['heading'] = "Page not found";
		$data['output'] = '404';	
		$this->load->view('template/layout', $data);
	}

	function front_404()
	{

	}
	function access_denied()
	{

		$data['page_title'] = "Permission denied.";
		$data['heading'] = "Permission denied.";
		$data['main'] = 'admin/permission_denied';	
		$this->load->view('admin/template/layout', $data);
	}
}