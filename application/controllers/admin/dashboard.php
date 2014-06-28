<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->lang->load('dashboard');
		$this->load->model('orders_model');
		$this->load->model('users_model');
	}
	public function index()
	{
		$data = '';
		$data['page_title'] = $this->config->item('site_name');
		$data['heading'] = 'Dashboard';     

		$data['total_sales'] = $this->orders_model->totalSales();
		$data['total_orders'] = $this->orders_model->count_all();
		$data['total_partners'] = $this->users_model->count_by(array('access' => 'partners'));

		$data['orders_records'] = $this->recent_orders();

		$data['main'] = 'admin/dashboard_view';
		$this->load->view('admin/template/layout', $data);
	}

	public function recent_orders()
	{
		$data = array();
		$fields = array(
			'first_name' => 'First Name',
			'email' => 'Surname', 
			'postcode' => 'Username', 
			'showroom' => 'Email'
			);
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "desc";
		$sort_column	= "orders_id";
		$uid 			= '';
		$post_params = array();
		
		$post_params['limit'] 		= $limit;
		$post_params['per_page'] 	= $per_page;
		$post_params['str'] 		= $str;
		$post_params['sort_column'] = $sort_column;
		$post_params['sort_by'] 	= $sort_by;
		$post_params['fields'] 		= $fields;
		$post_params['uid'] 		= $uid;
		$post_params['access'] 		= 'admin';

		$this->db->join('users as u','u.id_users = user_id');
		$orders_records = $this->orders_model->orders_info($post_params)->get_all();

		return $orders_records;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */