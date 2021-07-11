<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_user extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	function get_login_records($username, $password) {
		$q = $this->db->select('u.users_id,u.name,u.email,u.status')->from('users u');
		$q->where('u.email', $username);
		$q->where('u.password', $password);
		$q->where('u.status', '1');
		// echo $this->db->get_compiled_select();
		return $q->get()->result();
	}

	function data_update($id,$upadte_data, $table= ''){

		$upadte_data['update_dt'] = date('Y-m-d H:i:s');
		$this->db->where('users_id', $id);
        $this->db->update('access_token', $upadte_data);
	}


}