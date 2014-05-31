<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['site_name']		= 'Protisystem';

$config['theme']			= 'default';

//change the name of the admin controller folder 
$config['admin_folder']		= 'admin';

//file upload size limit
$config['size_limit']		= intval(ini_get('upload_max_filesize'))*1024;
