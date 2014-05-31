<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class usersModel extends CI_Model
{
	var $session_expire	= 7200;
	
	/*
	>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
				these functions handle logging in and out
	<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	*/

	function logout()
	{
		$this->session->unset_userdata('user');
		//$this->session->sess_destroy();
	}
	
	function login($username, $password, $remember=false)
	{
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('is_active', 1);
		$this->db->where('password',  sha1($password));
		$this->db->limit(1);
		$result = $this->db->get('users');

		$customer	= $result->row();
		
		if (sizeof($customer) > 0)
		{	
			$user = array();
			$user['user']					= array();
			$user['user']['id']				= $customer->id_users;
			$user['user']['access'] 		= $customer->access;
			$user['user']['name']			= $customer->name;
			$user['user']['surname']		= $customer->surname;
			$user['user']['email']			= $customer->email;
			$user['user']['gender']			= $customer->gender;
			$user['user']['avatar']			= $customer->avatar;
			$user['user']['location']		= $customer->location;
			$user['user']['password']		= $customer->password;
			$user['user']['ageGroup']		= $customer->age;
			// print_r($admin);
			if(!$remember)
			{
				$user['user']['expire'] = time()+$this->session_expire;
			}
			else
			{
				$user['user']['expire'] = false;
			}

			$this->session->set_userdata($user);
			// print_r($this->CI->admin_session->all_userdata($admin));
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function is_logged_in($redirect = false, $default_redirect = 'welcome')
	{
		
		//$redirect allows us to choose where a customer will get redirected to after they login
		//$default_redirect points is to the login page, if you do not want this, you can set it to false and then redirect wherever you wish.
		if(isset($this->session->userdata['user'])){
			$user = $this->session->userdata['user'];	
		}
		
		if (!isset($user['id']))
		{
			//this tells gocart where to go once logged in
			if ($redirect)
			{
				$this->session->set_flashdata('redirect', $redirect);
			}
			
			if ($default_redirect)
			{	
				redirect($default_redirect);
			}
			
			return false;
		}
		else
		{
		
			//check if the session is expired if not reset the timer
			if($user['expire'] && $user['expire'] < time())
			{

				$this->logout();
				if($redirect)
				{
					$this->session->set_flashdata('redirect', $redirect);
				}

				if($default_redirect)
				{
					redirect('secure/login');
				}

				return false;
			}
			else
			{

				//update the session expiration to last more time if they are not remembered
				if($user['expire'])
				{
					$user['expire'] = time()+$this->session_expire;
					$this->session->set_userdata($user);
				}

			}

			return true;
		}
	}
	
	function reset_password($email)
	{
		$this->load->library('encrypt');
		$customer = $this->get_customer_by_email($email);
		if ($customer)
		{
			$this->load->helper('string');
			$this->load->library('email');

			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$config['mailtype'] = 'html';
			$this->email->initialize($config);


			$new_password			= random_string('alnum', 8);
			$customer['password']	= sha1($new_password);
			$this->save($customer);
			
			$this->email->from(get_email(), $this->config->item('site_name'));
			$this->email->to($email);
			$this->email->subject($this->config->item('site_name').': Password Reset');
			$this->email->message('Your password has been reset to <strong>'. $new_password .'</strong>.');
			if($this->email->send()){
				return true;	
			}else{
				return false;	
			}
		}
		else
		{
			return false;
		}
	}
	
	function get_customer_by_email($email)
	{
		$result	= $this->db->get_where('users', array('email'=>$email, 'access' => 'member'));
		return $result->row_array();
	}
}
?>