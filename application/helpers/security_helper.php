<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('validate_user')){
    function validate_user(array $userdata){
        $ci =& get_instance();

        /*
         * Because we don't have session data when accessing via curl we use the report-export-Jsbv36{8zDLXH7wo;WcFVVgNvhK6nAhn user agent string to allow access
        */
        if(! isset($userdata['account_id']) && $_SERVER['HTTP_USER_AGENT'] != "report-export-Jsbv36{8zDLXH7wo;WcFVVgNvhK6nAhn"){
            redirect(base_url());
        }
    }
}