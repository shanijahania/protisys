<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if(!function_exists('helper_exist'))
{
	function helper_exist()
	{
		$ci =& get_instance();
		// return "permission helper exists";
		print_r($ci->admin_session->userdata['admin']['id_users']);
	}
}

if(!function_exists('module_permission'))
{
	function module_permission($module)
	{
		// create instance
		$ci =& get_instance();

		$user_modules = allowed_modules();
		if(!array_key_exists('all', $user_modules))
		{
			if(array_key_exists($module, $user_modules))
			{
				return true;
			}
			else
			{
				return false;	
			}
		}
		else
		{
			return true;
		}
		

		
	}
}
if(!function_exists('action_allowed'))
{
	function action_allowed($module, $action)
	{
		// create instance
		$ci =& get_instance();
		
		$allowed_modules = allowed_modules();
		$all_modules = all_modules();

		// login user data
		$user_id = $ci->admin_session->userdata['admin']['id_users'];
		$user_access = $ci->admin_session->userdata['admin']['access'];

		if($user_access != 'super_admin')
		{
			if(in_array($module, $all_modules))
			{
				$module_permissions = $allowed_modules[$module];
				$module_action = $module_permissions[$action];
				if($module_action){
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return true;
		}
		
	}
}
if(!function_exists('allowed_modules'))
{
	function allowed_modules()
	{
		// create instance
		$ci =& get_instance();

		// load required models
		$ci->load->model('permissions_model');
		$ci->load->model('modules_model');

		$user_id = $ci->admin_session->userdata['admin']['id_users'];
		$user_access = $ci->admin_session->userdata['admin']['access'];
		$user_modules = array();

		if($user_access != 'super_admin')
		{
			$modules = $ci->permissions_model->getPermissionsByUser($user_id)->get_many_by('users_id', $user_id);	
			foreach ($modules as $module) 
			{
				$user_modules[$module->name] = array(
					'permission_id' => $module->id_permission,
					'module_id' 	=> $module->modules_id,
					'view' 			=> $module->view,
					'add' 			=> $module->add,
					'edit' 			=> $module->edit,
					'delete' 		=> $module->delete
					);
			}
		}
		else
		{
			$user_modules['all'] = 'all';	
		}
		
		return $user_modules;

	}
}
if(!function_exists('all_modules'))
{
	function all_modules()
	{
		// create instance
		$ci =& get_instance();

		// load required models
		$ci->load->model('permissions_model');
		$ci->load->model('modules_model');

		$modules = $ci->modules_model->modules_info()->get_all();
		$all_modules = array();
		foreach ($modules as $module) 
		{
			$all_modules[] = $module->name;
		}

		return $all_modules;
	}
}
if(!function_exists('is_access'))
{
	function is_access($access)
	{
		// create instance
		$ci =& get_instance();

		$user_id = $ci->admin_session->userdata['admin']['id_users'];
		$user_access = $ci->admin_session->userdata['admin']['access'];

		if($user_access == $access)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
}