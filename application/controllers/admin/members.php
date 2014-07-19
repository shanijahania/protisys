<?php

class Members extends Admin_Controller {
	var $date;
	function __construct()
	{
		parent::__construct();
		$this->load->model('users_model');
		$this->load->model('partner_meta_model');
		$this->date = date('Y-m-d H:i:s');
	}

	function index()
	{
		$data = array();

		$moduleName = $this->uri->segment(2);
		$data['module'] = $moduleName;

		if($moduleName == 'salesperson')
		{
			$data['heading'] = 'Sales Representative';	
		}
		else
		{
			$data['heading'] = $moduleName;	
		}

		$data['page_title'] = $data['heading']." | ".$this->config->item('site_name');

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
		$sort_by		= "desc";
		$sort_column	= "user_id";

		

		if(isset($_GET['s']) && $_GET['s'] !='')
		{
			$str = $_GET['s'];
			$uri_string = 'admin/members?s='.$_GET['s'];
		}
		else
		{
			$uri_string = 'admin/members?s='.$str;
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
		$post_params['access'] 		= $this->uri->segment(2);
		$post_params['parent_id']	= '';

		if($this->admin_session->userdata['admin']['access'] != 'super_admin'):
			$post_params['parent_id'] = $this->admin_session->userdata['admin']['user_id'];
		endif;

		// pagination code goes here
		
		$base_url 	= base_url($uri_string);
		$total_members = $this->users_model->users_total($post_params);

		$config['base_url'] 			= $base_url;
		$config['total_rows'] 			= $total_members;
		$config['per_page'] 			= $per_page; 
		$config['page_query_string'] 	= TRUE;

		$this->pagination->initialize($config);
		$pagination = $this->pagination->create_links();
		$data['pagination'] = $pagination;


		$members_records = $this->users_model->users_info($post_params)->get_all();
		
		
		$data['sort_by'] 		= $sort_by;
		$data['sort_column'] 	= $sort_column;

		$data['members_records'] = $members_records;

		$data['uri_string'] = $uri_string;

	    $data['main'] = 'admin/members/members_list';
	    $data['js_function'] = array('members_list');

		$this->load->view('admin/template/layout',$data);
	}

	function add_members()
	{
		$data = array();

		$moduleName = $this->uri->segment(2);
		$data['module'] = $moduleName;

		if($moduleName == 'salesperson')
		{
			$data['heading'] = 'Sales Representative Detail';	
		}
		else
		{
			$data['heading'] = 'Add ' . $moduleName;
		}

		$data['page_title'] = $moduleName." | ".$this->config->item('site_name');

		$moduleName = $this->uri->segment(2);

		if ($moduleName == 'salesperson')
		{
			$moduleName = 'Sales Representative';
		}
		else
		{
			$moduleName = $moduleName;
		}
		

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|callback_email_unique|valid_email');
		$this->form_validation->set_rules('address', 'Address', 'trim');
		$this->form_validation->set_rules('postcode', 'Postcode', 'trim');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim');
		$this->form_validation->set_rules('access', 'Access', 'trim|required');
		$this->form_validation->set_rules('c_per', 'Commission Persentage', 'trim|is_numeric');
		$this->form_validation->set_rules('notes', 'Aggregate Notes', 'trim');
		$this->form_validation->set_rules('is_active', 'Is Active', 'trim|required');
		$this->form_validation->set_rules('parent_id', 'Sales Representative', 'trim|required');
		if($moduleName == 'partners')
		{
			$this->form_validation->set_rules('bussiness_name', 'Bussiness Name', 'trim');
			$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim');
		}
		if($this->form_validation->run() == TRUE)
	    {
	    	$name 		= $this->input->post('name');
			$surname 	= $this->input->post('surname');
			$username 	= $this->input->post('username');
			$password 	= sha1($this->input->post('password'));
			$email 		= $this->input->post('email');
			$address 	= $this->input->post('address');
			$postcode	= $this->input->post('postcode');
			$mobile 	= $this->input->post('mobile');
			$access 	= $this->input->post('access');
			$c_per 		= $this->input->post('c_per');
			$notes 		= $this->input->post('notes');
			$is_active 	= $this->input->post('is_active');

			$userParent = $this->input->post('parent_id');

	    	$data = array(
	    				'name'			=> $name,
	    				'surname'		=> $surname,
	    				'username'		=> $username,
	    				'password'		=> $password,
	    				'email'			=> $email,
	    				'mobile'		=> $mobile,
	    				'address'		=> $address,
	    				'postcode'		=> $postcode,
	    				'access'		=> $access,
	    				'is_active'		=> $is_active,
	    				'parent_id'		=> $userParent,
	    				'commission_per'=> $c_per,
	    				'notes'			=> $notes,
	    				'created_at' 	=> $this->date,
	    				'modified_at' 	=> $this->date
	    				);

	    	$insert_id = $this->users_model->insert($data);

	    	if($insert_id)
			{
				if($moduleName == 'partners')
				{
					$bussiness_name = $this->input->post('bussiness_name');
					$contact_name 	= $this->input->post('contact_name');

					$partner_meta = array(
						'user_id' 			=> $insert_id, 
						'bussiness_name' 	=> $bussiness_name,
						'contact_name' 		=> $contact_name
					);
					$this->partner_meta_model->insert($partner_meta);
				}
				// ********* Insert Member Permissions *********

				$permissions = array();

				$userRole = $this->uri->segment(2);

				if ($userRole == 'salesperson') 
				{
					$modules = Array ( 
				    		'2' => Array ( 'view' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1 ),
				    		'3' => Array ( 'view' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1 ), 
				    		'5' => Array ( 'view' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1 )
			    		);					
				}
				elseif ($userRole == 'partners') 
				{
					$modules = Array ( 
				    		'3' => Array ( 'view' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1 ), 
				    		'5' => Array ( 'view' => 1, 'add' => 1, 'edit' => 1, 'delete' => 1 )
			    		);	
				}
				else
				{
					$modules = array(
							'5' => Array ( 'view' => 0, 'add' => 1, 'edit' => 0, 'delete' => 0 )
						);
				}

		    	if($modules)
		    	{
		    		$module_permissions = array();	
		    		foreach ($modules as $module_id => $module_permissions) 
			    	{
			    		$module_permissions['modules_id'] 	= $module_id;
			    		$module_permissions['users_id'] 	= $insert_id;

			    		foreach ($module_permissions as $module => $value) 
			    		{
			    			$module_permissions[$module] = $value;
			    		}
			    		
			    		$permissions[] = $module_permissions;
			    	}
		    	}
		    	$this->permissions_model->insert_many($permissions);
		    	
				// ********* Insert Member Meta Data *********

		    	$subject = "Your Login Details";
		    	$to = $this->input->post('email');
		    	$from = "no-reply@protisys.com";
		    	$msg = "<h2>Protisystem Login Details</h2>";
		    	$msg .= "<p>Your login details are below.</p>";
		    	$msg .= "<table>";

		    	$msg .= "<tr><td>Username</td><td>".$this->input->post('username')."</td></tr>";
		    	$msg .= "<tr><td>Password</td><td>".$this->input->post('password')."</td></tr>";
		    	$msg .= "<tr><td>Url</td><td>".base_url('admin/login')."</td></tr>";

		    	$msg .= "</table>";

		    	$sendMail = sendHtmlMail($from,'',$to,$subject,$msg);
		    	if($sendMail)
		    	{
		    		echo "email sent..!"; die();
		    	}
		    	else
		    	{
		    		print_r($sendMail); die();
		    	}

				$this->session->set_flashdata('success', 'The ' . $moduleName . ' info have been successfully added');
				redirect('admin/' . $this->uri->segment(2) . '/create');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect('admin/' . $this->uri->segment(2) . '/create');
			}
	    }
	    else //if page initial load or form validation false
	    {

	    	$salespersons 	= array();
	    	$partners		= array();
	    	if($this->uri->segment(2) == 'partners' && $this->admin_session->userdata['admin']['access'] == 'super_admin' )
	    	{
	    		$this->db->where(array('access' => 'salesperson','is_active' => '1'));
	    		$salespersons = $this->users_model->get_many_by();
	    		
	    		$object = new stdClass();

	    		$object->user_id 	= $this->admin_session->userdata['admin']['user_id'];
	    		$object->name 		= 'Admin';

	    		$parent_array = array($object);
	    		$salespersons = array_merge((array)$parent_array, (array)$salespersons);

	    	}
	    	elseif($this->uri->segment(2) == 'clients' && $this->admin_session->userdata['admin']['access'] == 'salesperson' )
	    	{
	    		$this->db->where(array('access' => 'partners','is_active' => '1'));
	    		$partners = $this->users_model->get_many_by();
	    		
	    		$object = new stdClass();

	    		$object->user_id 	= $this->admin_session->userdata['admin']['user_id'];
	    		$object->name 		= 'Direct Client';

	    		$parent_array = array($object);
	    		$partners = array_merge((array)$parent_array, (array)$partners);

	    	}

	    	$data['salespersons'] = $salespersons;
	    	$data['partners'] = $partners;

	    	$data['main'] = 'admin/members/add_members';

			$this->load->view('admin/template/layout',$data);
	    }
	}

	function edit_member()
	{
		$data = array();
		$moduleName = $this->uri->segment(2);
		$data['module'] = $moduleName;

		if ($moduleName == 'salesperson'):
			$moduleName = 'Sales Representative';
		else:
			$moduleName = $moduleName;
		endif;

		$data['page_title'] = 'Edit ' . $moduleName . '';
		$data['heading'] = 'Edit ' . $moduleName;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('surname', 'Surname', 'trim');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'trim');
		$this->form_validation->set_rules('logo', 'Logo', 'trim');
		$this->form_validation->set_rules('access', 'Access', 'trim|required');
		$this->form_validation->set_rules('c_per', 'Commission Persentage', 'trim|required|is_numeric');
		$this->form_validation->set_rules('notes', 'Aggregate Notes', 'trim');
		$this->form_validation->set_rules('is_active', 'Is Active', 'required');
		if($moduleName == 'partners')
		{
			$this->form_validation->set_rules('bussiness_name', 'Bussiness Name', 'trim');
			$this->form_validation->set_rules('contact_name', 'Contact Name', 'trim');
		}
		if($this->form_validation->run() == TRUE)
	    {
	    	$hash_members_id = $this->input->post('members_id');
		
			//check hash if the user edit it
			$members_id = $this->input->post('members_id');
	    	$hash = get_attr_hash($hash_members_id);

	    	// $this->permission->check_form_id_hash($members_id,$hash);

	    	$name 		= $this->input->post('name');
			$surname 	= $this->input->post('surname');
			$username 	= $this->input->post('username');
			$mobile 	= $this->input->post('mobile');
			$logo 		= $this->input->post('logo');
			$access 	= $this->input->post('access');
			$c_per 		= $this->input->post('c_per');
			$notes 		= $this->input->post('notes');
			$is_active 	= $this->input->post('is_active');
			
	    	$data = array(
	    				'name'			=> $name,
	    				'surname'		=> $surname,
	    				'username'		=> $username,
	    				'mobile'		=> $mobile,
	    				'access'		=> $access,
	    				'notes'			=> $notes,
	    				'commission_per'=> $c_per,
	    				'is_active'		=> $is_active, 
	    				'modified_at' 	=> $this->date
	    				);

	    	if($this->input->post('password'))
			{
				$password = sha1($this->input->post('password'));
				$data['password'] = $password;
			}

	    	if($this->users_model->update($members_id, $data))
			{
				if($moduleName == 'partners')
				{
					$bussiness_name = $this->input->post('bussiness_name');
					$contact_name 	= $this->input->post('contact_name');
					$partner_meta 	= $this->partner_meta_model->get_by('user_id', $members_id);

					$partner_meta_data = array(
						'bussiness_name' 	=> $bussiness_name,
						'contact_name' 		=> $contact_name
						);
					if($partner_meta)
					{
						$this->partner_meta_model->update_by('user_id', $members_id, $partner_meta_data);	
					}
					else
					{
						$partner_meta_data['user_id'] = $members_id;
						$this->partner_meta_model->insert($partner_meta_data);	
					}

					
				}

				$this->session->set_flashdata('success', 'The ' . $moduleName . ' info have been successfully updated');
				redirect("admin/" . $this->uri->segment(2) . "/edit/$members_id");
			}
			else
			{
				$this->session->set_flashdata('error', 'Error. Please try again.');
				redirect("admin/" . $this->uri->segment(2) . "/edit/$members_id");
			}
	    }
	    else //if page initial load or form validation false
	    {
	    	$members_id = $this->uri->segment(4);

	    	if($this->input->post('members_id'))
	    	{
	    		$hash_members_id = $this->input->post('members_id');

		    	//check hash if the user edit it

		    	$members_id = $this->input->post('members_id');
		    	$hash = get_attr_hash($hash_members_id);

		    	// $this->permission->check_form_id_hash($members_id,$hash);
	    	}

	    	$members_records = $this->users_model->with('partner_meta')->get($members_id);

	    	$data['members_records'] = $members_records;

	    	$salespersons 	= array();
	    	$partners		= array();
	    	if($this->uri->segment(2) == 'partners' && $this->admin_session->userdata['admin']['access'] == 'super_admin' )
	    	{
	    		$this->db->where(array('access' => 'salesperson','is_active' => '1'));
	    		$salespersons = $this->users_model->get_many_by();
	    		
	    		$object = new stdClass();

	    		$object->user_id 	= $this->admin_session->userdata['admin']['user_id'];
	    		$object->name 		= 'Admin';

	    		$parent_array = array($object);
	    		$salespersons = array_merge((array)$parent_array, (array)$salespersons);

	    	}
	    	elseif($this->uri->segment(2) == 'clients')
	    	{
	    		$this->db->where(array('access' => 'partners','is_active' => '1'));
	    		$partners = $this->users_model->get_many_by();
	    		
	    		$object = new stdClass();

	    		$object->user_id 	= $this->admin_session->userdata['admin']['user_id'];
	    		$object->name 		= 'Direct Client';

	    		$parent_array = array($object);
	    		$partners = array_merge((array)$parent_array, (array)$partners);

	    	}

	    	$data['salespersons'] = $salespersons;
	    	$data['partners'] = $partners;
	    	
	    	$data['main'] = 'admin/members/edit_members';

			$this->load->view('admin/template/layout',$data);
	    }
	}
	function show_member()
	{

		$data = array();

		$moduleName = $this->uri->segment(2);
		$data['module'] = $moduleName;

		if($moduleName == 'salesperson')
		{
			$data['heading'] = 'Sales Representative';	
		}
		else
		{
			$data['heading'] = $moduleName;	
		}

		$data['page_title'] = $data['heading'].' | '.$this->config->item('site_name');
		
		$hash_members_id = $this->uri->segment(4);

    	//check hash if the user edit it
    	$members_id = $this->uri->segment(4);
    	$hash = get_attr_hash($hash_members_id);
		$members_records = $this->users_model->with('partner_meta')->get($members_id);
	    $data['members_records'] = $members_records;
	    $data['main'] = 'admin/members/show_member';

	    $this->load->view('admin/template/layout',$data);
	}

	public function commission()
	{
		
		$data = array();

		$moduleName = $this->uri->segment(2);
		$data['module'] = $moduleName;

		if($moduleName == 'salesperson')
		{
			$data['heading'] = 'Sales Representative';	
		}
		else
		{
			$data['heading'] = $moduleName;	
		}

		$this->load->model('order_commision_model');
		$this->db->join('users','user_id = u_id');
		$this->db->where(array('u_id'=>$this->uri->segment(4)));
		
		$data['members_records'] = $this->order_commision_model->get_many_by();
		
		$data['main'] = 'admin/members/members_commission_list';

		$this->load->view('admin/template/layout',$data);
	}

	function load_permissions()
	{
		$data['type'] = $this->input->post('type');
		$view = $this->load->view('admin/members/_user_partial', $data);
		return $view;
	}

	function ajax_delete_members()
	{
		// $this->permission->is_ajax();

		$ajax_members_id = $this->input->post('members_id');

		//get the members_id

		$members_id = get_attr_id($ajax_members_id);

		//get the hash

		$hash = get_attr_hash($ajax_members_id);

		if($this->users_model->delete($members_id))
		{
			$this->member_meta_model->delete_by('member_id', $members_id);
			$this->permissions_model->delete_by('users_id', $members_id);

			$this->session->set_flashdata('success', 'Member was deleted successfully.');
			echo '1';
		}
		else
		{
			$this->session->set_flashdata('error', 'Error deleting member. Please try again later.');
			echo '2';
		}

	}

	public function email_unique($value)
	{
			
		if($this->users_model->unique_email($value))
		{
			$this->form_validation->set_message('email_unique', 'email should be unique');
			return false;
		}
		else
		{
			return true;	
		}
	}

	public function check_password(){
		$password = sha1($this->input->get_post('password_old'));
		$id = $this->admin_session->userdata['admin']['user_id'];

		$userdata = $this->users_model->get_by(array('user_id' => $id, 'password' => $password));

		if(empty($userdata)):
			echo 0;
		endif;
	}

	public function update_password()
	{
		$data = array('password' => $this->input->post('password') );
		$id = $this->admin_session->userdata['admin']['user_id'];

		if($this->users_model->update($id,$data))
		{
			$this->session->set_flashdata('success', 'Password has been updated successfully.');
			redirect('admin/dashboard');
		}		
	}

}
?>