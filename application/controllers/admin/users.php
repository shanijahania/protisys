<?php

class Users extends Admin_Controller {
	var $date;
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();

		$fields = array(
			'name' => 'Name',
			'surname' => 'Surname', 
			'username' => 'Username', 
			'email' => 'Email', 
			'mobile' => 'Mobile'
			);
		
		$data['fields'] = $fields;

		$str 			= '';
		$per_page 		= '20';
		$limit 			= 0;
		$sort_by		= "asc";
		$sort_column	= "user_id";

		

		if(isset($_GET['s']) && $_GET['s'] !='')
		{
			$str = $_GET['s'];
			$uri_string = 'admin/users?s='.$_GET['s'];
		}
		else
		{
			$uri_string = 'admin/users?s='.$str;
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

		$post_params = array();
		$post_params['limit'] 		= $limit;
		$post_params['per_page'] 	= $per_page;
		$post_params['str'] 		= $str;
		$post_params['sort_column'] = $sort_column;
		$post_params['sort_by'] 	= $sort_by;
		$post_params['fields'] 		= $fields;
		$post_params['access'] 		= 'admin';

		// pagination code goes here
		
		$base_url 	= base_url($uri_string);
		$total_users = $this->users_model->users_total($post_params);

		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $total_users;
		$config['per_page'] 			= $per_page; 
		$config['page_query_string'] 	= TRUE;

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;


		$users_records = $this->users_model->users_info($post_params)->get_all();

		$data['sort_by'] 		= $sort_by;
		$data['sort_column'] 	= $sort_column;

		$data['users_records'] = $users_records;

		$data['uri_string'] = $uri_string;
		$data['page_title'] = 'Users | Point-s';
		$data['heading'] = 'Users';

	    $data['main'] = 'admin/users/users_list';
	    $data['js_function'] = array('users_list');

		$this->load->view('admin/template/layout',$data);
	}

	function add_users()
	{
		
		$data = array();
		$data['page_title'] = 'Add Users | Point-s';
		$data['heading'] = 'Add Users';
		$data['modules'] = $this->modules_model->modules_info()->get_all();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_unique');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim');
		$this->form_validation->set_rules('module', 'Permissions', 'required');
		// $this->form_validation->set_rules('location', 'Location', 'trim|required|alpha_numeric');
		// $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		// $this->form_validation->set_rules('logo', 'Logo', 'trim');
		// $this->form_validation->set_rules('access', 'Access', 'trim|required');
		$this->form_validation->set_rules('is_active', 'Status', 'trim|required');
		

		if($this->form_validation->run() == TRUE)
	    {
	    	$name 		= $this->input->post('name');
			$surname 	= $this->input->post('surname');
			$username 	= $this->input->post('username');
			$password 	= $this->input->post('password');
			$email 		= $this->input->post('email');
			$mobile 	= $this->input->post('mobile');
			// $location 	= $this->input->post('location');
			// $gender 	= $this->input->post('gender');
			$logo 		= $this->input->post('logo');
			$access 	= $this->input->post('access');
			// $is_active 	= $this->input->post('is_active');

	    	$data = array('name'=>$name,'surname'=>$surname,'username'=>$username,'password'=>$password,'email'=>$email,'mobile'=>$mobile,'access'=>$access,'is_active'=>$is_active, 'created_at' => $this->date, 'modified_at' => $this->date);
	    	$insert_id = $this->users_model->insert($data);


	    	if($insert_id)
			{
				// ************* Insert admin permissions ****************
				$permissions = array();
		    	if($this->input->post('module'))
		    	{
		    		$module_permissions = array();	
		    		foreach ($this->input->post('module') as $module_id => $module_permissions) 
			    	{
			    		$module_permissions['modules_id'] = $module_id;
			    		$module_permissions['users_id'] = $insert_id;

			    		foreach ($module_permissions as $module => $value) {
			    			$module_permissions[$module] = $value;
			    		}
			    		$permissions[] = $module_permissions;
			    	}
		    	}
		    	if($this->permissions_model->insert_many($permissions))	
		    	{
		    		$this->session->set_flashdata('success', 'The users info have been successfully added');
					redirect('admin/users/add_users');
		    	}
		    	else
		    	{
		    		$this->session->set_flashdata('error', 'Error. Please try again.');
					redirect('admin/users/add_users');
		    	}
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect('admin/users/add_users');
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$data['main'] = 'admin/users/add_users';

			$this->load->view('admin/template/layout',$data);
	    }
	}

	function edit_users()
	{
		$data = array();

		if($this->input->post('users_id'))
		{
			$users_id = $this->input->post('users_id');
		}
		else
		{
			$users_id = $this->uri->segment(4);
		}
		

		$data['page_title'] = 'Edit Users | Point-s';
		$data['heading'] 	= 'Edit Users';
		$data['modules'] 	= $this->modules_model->modules_info()->get_all();

		$permissions = $this->permissions_model->permissions_info()->get_many_by('users_id',$users_id);
		$set_permissions = array();

		foreach ($permissions as $permission) 
		{
			$set_permissions[$permission->modules_id] = array(
				'id_permission' => $permission->id_permission,
				'add' 			=> $permission->add,
				'edit' 			=> $permission->edit,
				'delete' 		=> $permission->delete,
				'view' 			=> $permission->view,
				'users_id' 		=> $permission->users_id
				);
		}
		$data['permissions'] = $set_permissions;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		// $this->form_validation->set_rules('password', 'Password', 'trim|required');
		// $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_unique|valid_email');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim');
		// $this->form_validation->set_rules('logo', 'Logo', 'trim');
		// $this->form_validation->set_rules('access', 'Access', 'trim|required');
		$this->form_validation->set_rules('is_active', 'Is Active', 'required');
		$this->form_validation->set_rules('module', 'Permissions', 'required');
		

		if($this->form_validation->run() == TRUE)
	    {
	    	$hash_users_id = $this->input->post('users_id');

	    	//check hash if the user edit it   	
	    	$hash = get_attr_hash($hash_users_id);

	    	// $this->permission->check_form_id_hash($users_id,$hash);

	    	$name 		= $this->input->post('name');
			$surname 	= $this->input->post('surname');
			$username 	= $this->input->post('username');
			
			$mobile 	= $this->input->post('mobile');
			// $location 	= $this->input->post('location');
			// $gender 		= $this->input->post('gender');
			$logo 		= $this->input->post('logo');
			$access 	= $this->input->post('access');
			$is_active 	= $this->input->post('is_active');
			
	    	$data = array('name'=>$name,'surname'=>$surname,'username'=>$username,'mobile'=>$mobile,'access'=>$access,'is_active'=>$is_active, 'modified_at' => $this->date);
	    	if($this->input->post('password'))
	    	{	
	    		$password = sha1($this->input->post('password'));
	    		$data['password'] = $password;
	    	}
	    	if($this->users_model->update($users_id, $data))
			{
				$this->permissions_model->delete_by('users_id', $users_id);
				$permissions = array();
		    	if($this->input->post('module'))
		    	{
		    		$module_permissions = array();	
		    		foreach ($this->input->post('module') as $module_id => $module_permissions) 
			    	{
			    		$module_permissions['modules_id'] = $module_id;
			    		$module_permissions['users_id'] = $users_id;

			    		foreach ($module_permissions as $module => $value) {
			    			$module_permissions[$module] = $value;
			    		}
			    		$permissions[] = $module_permissions;
			    	}
		    	}
		    	if($this->permissions_model->insert_many($permissions))
		    	{
		    		$this->session->set_flashdata('success', 'The user info have been successfully updated');
					redirect("admin/users/edit_users/$users_id/$hash");
		    	}
		    	else
		    	{
		    		$this->session->set_flashdata('error', 'Error. Please try again.');
					redirect("admin/users/edit_users/$users_id/$hash");
		    	}
				
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect("admin/users/edit_users/$users_id/$hash");
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$users_id = $this->uri->segment(4);

	    	//means come from users list

	    	// if($this->uri->segment(3))
	    	// {
	    	// 	$this->permission->check_id_hash($users_id);
	    	// }

	    	//means come from validation error

	    	if($this->input->post('users_id'))
	    	{
	    		$hash_users_id = $this->input->post('users_id');

		    	//check hash if the user edit it

		    	$users_id = $this->input->post('users_id');
		    	$hash = get_attr_hash($hash_users_id);

		    	// $this->permission->check_form_id_hash($users_id,$hash);
	    	}

	    	$users_records = $this->users_model->get($users_id);

	    	$data['users_records'] = $users_records;

	    	$data['main'] = 'admin/users/edit_users';

			$this->load->view('admin/template/layout',$data);
	    }
	}
	function show_user(){

		$data = array();
		$data['page_title'] = 'User | Point-s';
		$data['heading'] 	= 'User View';
		$data['modules'] 	= $this->modules_model->modules_info()->get_all();

		$hash_users_id = $this->uri->segment(4);

    	//check hash if the user edit it
    	$users_id = $this->uri->segment(4);
    	$hash = get_attr_hash($hash_users_id);
		$users_records = $this->users_model->get($users_id);
	    $data['users_records'] = $users_records;

	    $permissions = $this->permissions_model->permissions_info()->get_many_by('users_id',$users_id);
		$set_permissions = array();

		foreach ($permissions as $permission) 
		{
			$set_permissions[$permission->modules_id] = array(
				'id_permission' => $permission->id_permission,
				'add' 			=> $permission->add,
				'edit' 			=> $permission->edit,
				'delete' 		=> $permission->delete,
				'view' 			=> $permission->view,
				'users_id' 		=> $permission->users_id
				);
		}
		$data['permissions'] = $set_permissions;

	    $data['main'] = 'admin/users/show_user';

	    $this->load->view('admin/template/layout',$data);
	}

	function load_permissions()
	{
		$data['type'] = $this->input->post('type');
		$view = $this->load->view('admin/users/_user_partial', $data);
		return $view;
	}

	function ajax_delete_users()
	{
		// $this->permission->is_ajax();

		$ajax_users_id = $this->input->post('users_id');

		//get the users_id

		$users_id = get_attr_id($ajax_users_id);

		//get the hash

		$hash = get_attr_hash($ajax_users_id);

		//check the hash

		// $this->permission->check_ajax_id_hash($users_id,$hash);

		if($this->users_model->delete($users_id))
		{
			
			$this->permissions_model->delete_by('users_id', $users_id);
			$this->session->set_flashdata('success', 'Member was deleted successfully.');
			echo '1';
		}
		else
		{
			$this->session->set_flashdata('error', 'Error deleting member. Please try again later.');
			echo '2';
		}

	}

	public function email_unique($value){
			
		if($this->users_model->unique_email($value))
		{
			$this->form_validation->set_message('email_unique', 'Email already exists');
			return false;
		}
		else
		{
			return true;	
		}
	}

}
?>