<?php if(! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('check_in_code')){
    function check_in_code($check_date){
        /**
         * Generate a 4 digit id for each check in
         * The id is based on the check in auto increment id of the last check in + 1
         * and is padded left with 0's to make 4 digits if less than 4 digits
         * or we use substr to trim to four digits if the id is greater than 4 digits
         * we trim from the begenning so that we dont have repeating codes, ex. id=1111283 would return 1111 and so would id=1111284 etc.
        */
        $ci =& get_instance();
        $data = $ci->db->query('SELECT id FROM check_in ORDER BY id DESC LIMIT 0,1');
        if($data->num_rows() > 0){
            $last_id = $data->row();
            $id = $last_id->id + 1;

            $id = substr($id, -4, 4);
            $id = str_pad($id, 4, "0", STR_PAD_LEFT);
            return $id;
        }else{
            return "0000";
        }
    }
}