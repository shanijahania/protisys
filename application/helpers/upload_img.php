<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
 
 
    function multiple_upload($params)
    {

		$name 			= $params['name']; 
		$upload_dir 	= $params['upload_dir'];
		$allowed_types 	= $params['allowed_types']; 
		$size 			= $params['size'];

        $CI =& get_instance();
     
        $config['upload_path']   = realpath($upload_dir);
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = $size;
		$config['max_width']     = "1907";
		$config['max_height']    = "1280";
        $config['overwrite']     = FALSE;
        $config['encrypt_name']  = TRUE;
             
 
            $CI->upload->initialize($config);
            $errors = FALSE;
                      
            if(!$CI->upload->do_upload($name)):
	                $errors = TRUE;
            else:
                // Build a file array from all uploaded files
	                $files = $CI->upload->data();
            endif;
 
             
            // There was errors, we have to delete the uploaded files
            if($errors):                   
	                @unlink($files['full_path']);
                return false;
            else:
	                return $files;
            endif;
             
    }
 
	function upload_batch_images($name = 'userfile', $upload_dir = 'sources/images/', $allowed_types = 'gif|jpg|jpeg|jpe|png', $size) 
	{
	    $CI =& get_instance();
        $realpath = $upload_dir."images-".rand(1111111111,9999999999); //let's make it unique
        $config['upload_path']   = $realpath;
        $config['allowed_types'] = $allowed_types;
        $config['max_size']      = $size;
        $config['overwrite']     = FALSE;
        $config['encrypt_name']  = TRUE;
         
	    $CI->upload->initialize($config);
	         
	    if(mkdir($realpath)):
		        if($CI->upload->do_upload($name)):
			            $files = $CI->upload->data(); 
		            if(openZip($realpath."/".$files['file_name'], $realpath)):
			                @unlink($files['full_path']);
		                return $realpath;
		            else:
			                @unlink($files['full_path']);
		                return false;
		            endif;
		        endif;
		    else:
			        return false;
		    endif;
	}
    
	function image_thumb( $image_path, $height, $width ) {
	    // Get the CodeIgniter super object
	    $CI =& get_instance();

	    // Path to image thumbnail
	    $image_thumb = dirname( $image_path ) . '/' . $height . '_' . $width . '.jpg';

	    if ( !file_exists( $image_thumb ) ) {
	        // LOAD LIBRARY
	        $CI->load->library( 'image_lib' );

	        // CONFIGURE IMAGE LIBRARY
	        $config['image_library']    = 'gd2';
	        $config['source_image']     = $image_path;
	        $config['new_image']        = $image_thumb;
	        $config['maintain_ratio']   = TRUE;
	        $config['height']           = $height;
	        $config['width']            = $width;
	        $CI->image_lib->initialize( $config );
	        $CI->image_lib->resize();
	        $CI->image_lib->clear();
	    }

	    return '<img src="' . dirname( $_SERVER['SCRIPT_NAME'] ) . '/' . $image_thumb . '" />';
	}


    function openZip($file_to_open, $zip_target) 
	{
	    $zip = new ZipArchive();
	    $x = $zip->open($file_to_open);
	    if ($x === true):
		        $zip->extractTo($zip_target);
	        $zip->close();
	        return true;
	    else:
		        return false;
	    endif;
	}
 