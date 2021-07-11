<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_Session extends CI_Session {
    private $session_key;

    function __construct(){
        parent::__construct();
        $this->session_key = config_item('session_data_key');
    }


    public function is_admin_session_in(){
		$is_userdata = $this->userdata($this->session_key);
		if($is_userdata ){
			return TRUE ;
		}else{
			return FALSE;
		}
    }

}