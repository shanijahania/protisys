<?php

class Commission extends Admin_Controller {
	var $date;
	function __construct()
	{
		parent::__construct();
		$this->load->model('order_commision_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();
		$fields = array();
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "desc";
		$sort_column	= "c_id";
		$uid 			= '';
		$start 			= '';
		$end 			= '';
		$u_type			= '';
		$post_params = array();
		

		if(isset($_GET['s']) && $_GET['s'] !='')
		{
			$str = $_GET['s'];
			$uri_string = 'admin/commission?s='.$_GET['s'];
		}
		else
		{
			$uri_string = 'admin/commission?s='.$str;
		}

		if(isset($_GET['u_type']) && $_GET['u_type'] !=' ')
		{
			$u_type = $_GET['u_type'];
			$uri_string = '&u_type='.$_GET['u_type'];
		}

		if(isset($_GET['start']) && $_GET['start'] !='' && isset($_GET['end']) && $_GET['end'] !='')
		{
			$start = $_GET['start']." 00:00:00";
			$uri_string = '&start='.$_GET['start'];
			$end = $_GET['end']." 23:59:59";
			$uri_string = '&end='.$_GET['end'];
		}

		if(isset($_GET['uid']) && $_GET['uid'] !='')
		{
			$uid = $_GET['uid'];
			if(isset($_GET['role']) && $_GET['role'] == 'salesperson'):
				$getPartnerID = $this->users_model->get_many_by(array('parent_id' => $uid));
			
				$ids_users = array();
				if(!empty($getPartnerID)):
					foreach ($getPartnerID as $key => $value) 
					{
						$ids_users[$key] = $value->id_users; 
					}
				
					$post_params['ids_users'] = $ids_users;
				endif;
			endif;
			$uri_string .= "&uid=".$uid;
		}

		if(isset($_GET['per_page']) && $_GET['per_page'] !='')
		{
			$limit = $_GET['per_page'];
		}
		if(isset($_GET['sort_by']) && $_GET['sort_by'] !='')
		{
			$sort_by = $_GET['sort_by'];
			$uri_string .= "&sort_by=".$sort_by;
		}
		if(isset($_GET['sort_column']) && $_GET['sort_column'] !='')
		{
			$sort_column = $_GET['sort_column'];
			$uri_string .= "&sort_column=".$sort_column;
		}

		$data['s'] = $str;

		
		$post_params['limit'] 		= $limit;
		$post_params['per_page'] 	= $per_page;
		$post_params['str'] 		= $str;
		$post_params['sort_column'] = $sort_column;
		$post_params['sort_by'] 	= $sort_by;
		$post_params['fields'] 		= $fields;
		$post_params['uid'] 		= $uid;
		$post_params['start'] 		= $start;
		$post_params['end'] 		= $end;
		$post_params['u_type']		= $u_type;

		// pagination code goes here
		
		$base_url 	= base_url($uri_string);
		$total_com = $this->order_commision_model->orders_total($post_params);

		// echo $this->db->last_query();die();

		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $total_com;
		$config['per_page'] 			= $per_page; 
		$config['page_query_string'] 	= TRUE;

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;

		$comm_records = $this->order_commision_model->orders_info($post_params)->get_all();

		// echo $this->db->last_query();die();
		$data['comm_records'] = $comm_records;

		$data['sort_by'] 		= $sort_by;
		$data['sort_column'] 	= $sort_column;

		$data['uri_string'] = $uri_string;
		$data['page_title'] = 'Commissions | Point-s';
		$data['heading'] = 'Commissions';

	    $data['main'] = 'admin/members/members_commission_list';

		$this->load->view('admin/template/layout',$data);
	}
}
?>