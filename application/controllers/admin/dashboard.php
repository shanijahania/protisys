<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->lang->load('dashboard');
	}
	public function index()
	{
		$data = '';
		$data['page_title'] = $this->config->item('site_name');
		$data['heading'] = 'Dashboard';
		$data['main'] = 'admin/dashboard_view';
		$this->load->view('admin/template/layout', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */