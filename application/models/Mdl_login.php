<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_login extends MY_Model{

	private $session_key;
	public function __construct(){
		parent::__construct();
		
		//get session key
		$this->session_key = config_item('session_data_key');
	}



	function authenticate(){
		$this->load->library(['form_validation','encryption']);

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ( ! $this->form_validation->run() ){
			return FALSE;
		}
		
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$Adminrecord = $this->get_records(['username' => $username],'admin',['user_id','name','username','password','role']);
	
		if(count($Adminrecord)){
			if(!Encryption::verifyPassword($password, $Adminrecord[0]->password)) {
				return FALSE;
		 }

		 $admin_info = [
			        'user_id'=> $Adminrecord[0]->user_id,
					'username'=>$Adminrecord[0]->username,
					'role'=> $Adminrecord[0]->role, 
				];
		  $this->session->set_userdata($this->session_key, $admin_info);
		  return TRUE;
		 
		}

		return FALSE;
	}


}