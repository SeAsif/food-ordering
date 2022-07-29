<?php

defined('BASEPATH') or exit('No direct script access allowed');
use Twilio\Rest\Client;
//
if(!function_exists('check_user_subscription')){
    function check_user_subscription($restaurant_info){
        $subscription_status = 'not_expired';
        //
        $current_date = date("Y-m-d");
        $trail_end_date = date("Y-m-d", strtotime('+60 days', strtotime($restaurant_info['stamp'])));
        //
        if ($current_date > $trail_end_date) {
            //
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->where('restauran_id', $restaurant_info['id']); 
            //
            $subscribe_info = $CI->db->get('subscriptions')->row_array();
            //
            if (!empty($subscribe_info)) {
                //  
                if (empty($subscribe_info['subscription_code'])) {
                    // redirect(base_url("subscription"),true);
                    $subscription_status = 'expired';
                }
                //
            } else {
                // redirect(base_url("subscription"),true);
                $subscription_status = 'expired';
            }
        }

        return $subscription_status;
    }
}    

    //
if(!function_exists('get_location_name')){
    function get_location_name($location_id){
    	$CI = &get_instance();
        $CI->db->select('location, address');
        $CI->db->where('id', $location_id); 
        //
        $location_info = $CI->db->get('restaurant_location')->row_array();
        //
        if (!empty($location_info)) {
        	return $location_info['address'].', '.$location_info['location'];
        } else {
        	return 'Not Assigned';
        }
       
    }
}

if(!function_exists('get_Role_name')){
    function get_Role_name($roles_id){
    	$user_roles = explode(',', $roles_id);
    	$CI = &get_instance();
        $CI->db->select('role_color, role_name');
        $CI->db->where_in('id', $user_roles); 
        //
        $role_info = $CI->db->get('user_role')->result_array();
        //
        if (!empty($role_info)) {
        	$return_data = "";
        	foreach ($role_info as $key => $role) {
        		$return_data .= '<badge class="badge" style="background: '.$role['role_color'].';">';
        		$return_data .= $role['role_name'];
        		$return_data .= '</badge></br>';
        	}
        	return $return_data;
        } else {
        	return 'Not Assigned';
        }
       
    }
}

if(!function_exists('sendSMS')){
	function sendSMS($data){
		$sid = 'AC36a78ddc99ecba5cdd43401a5c934f12';
			$token = '5bd4f16e1491aea0f20b29b76758bb55';
			$twilio  = new Client($sid, $token);

			try {
				return $twilio->messages->create(
					// the number you'd like to send the message to
					$data['phone'],
					array(
							// A Twilio phone number you purchased at twilio.com/console
							// "from" => "+15005550006",
							"from" => "+17054820170",
							// the body of the text message you'd like to send
							'body' => $data['text']
					)
				);
			} catch( Exception $e ) {
				error_log($e->getMessage());
			}
				
	}
}

if(!function_exists('remakeRoleCompleteName')){
    function remakeRoleCompleteName($role_info){
        
        $role_name  = $role_info['role_name'];
        //
        $role_slug = '';
        //
        if (isset($role_info['default'])) {
            $role_slug = $role_name; 
        } else {
            $location = $role_info['location'];
            $location_address = $role_info['address'];
            $department = $role_info['department_name'];
            //
            $role_slug = $role_name . ' ('.$department.') ['. $location_address.', '.$location.']';  
        }
        //
        return $role_slug;
                
    }
}

	function dd()
	{
	array_map(function($x) { var_dump($x); }, func_get_args()); die;
	}

	function table_already_exists($table_name){
		echo "<pre>";
		print_r('<p style="color:red">'.$table_name." table already exists</p>");
		echo "<pre>";
	}

	function table_created($table_name){
		echo "<pre>";
		print_r('<p style="color:green">'.$table_name." table created successfully</p>");
		echo "<pre>";
	}


if(!function_exists('clean_image_path')){
    function clean_image_path ($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-.]/', '', $string); // Removes special chars.
    }
}   



    function rows_show () {
       $array=array("10","20","30","40","50");
       return $array;
    }
