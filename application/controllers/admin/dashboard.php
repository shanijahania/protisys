<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->lang->load('dashboard');
		$this->load->model('orders_model');
		$this->load->model('users_model');
		$this->load->model('order_commision_model');
	}
	public function index()
	{
		$data = '';
		$data['page_title'] = $this->config->item('site_name');
		$data['heading'] = 'Dashboard (Overview and Stats)';     

		$data['total_sales'] = $this->orders_model->totalSales();
		$data['total_orders'] = $this->orders_model->count_all();
		$data['total_partners'] = $this->users_model->count_by(array('access' => 'partners'));
		$data['total_sales_rep'] = $this->users_model->count_by(array('access' => 'salesperson'));
		$data['total_clients'] = $this->users_model->count_by(array('access' => 'clients'));

		// Get commissions stats
		$data['total_commission'] = $this->order_commision_model->total_commission('all')->get_all()[0]->ord_commission;
		$data['paid_commission'] = $this->order_commision_model->total_commission('paid')->get_all()[0]->ord_commission;
		$data['pending_commission'] = $this->order_commision_model->total_commission('pending')->get_all()[0]->ord_commission;

		$data['commission_paid_percent'] = floor(($data['paid_commission'] / $data['total_commission']) * 100);
		$data['commission_pending_percent'] = floor(($data['pending_commission'] / $data['total_commission']) * 100);

		$data['orders_records'] = $this->recent_orders();

		$data['main'] = 'admin/dashboard_view';
		$this->load->view('admin/template/layout', $data);
	}

	public function recent_orders()
	{
		$data = array();
		$fields = array(
			'first_name' 	=> 'First Name',
			'email' 		=> 'Surname', 
			'postcode' 		=> 'Username', 
			'showroom' 		=> 'Email'
			);
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '10';
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

		$this->db->join('users as u','u.user_id = orders.user_id');
		$orders_records = $this->orders_model->orders_info($post_params)->get_all();

		return $orders_records;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */