<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('validate_user')){
    function validate_user(array $userdata){
        $ci =& get_instance();

        if(! isset($userdata['account_id'])){
            redirect(base_url());
        }
    }
}