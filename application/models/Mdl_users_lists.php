<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_users_lists extends MY_Model{

	public function __construct(){
		parent::__construct();
	}

	

    function get_collection($filters = []) {
        
        $q = $this->db->select('u.users_id,u.name,u.email,u.profile_picture_path,u.about,u.insert_dt
        ,d.department_id,d.department_name,GROUP_CONCAT(DISTINCT uh.hobbie) AS u_hobbie')
		->from('users u')
		->join('department d', 'd.department_id = u.department_id')
        ->join('users_hobbies uh', 'uh.users_id = u.users_id');

		if(sizeof($filters)) { 
			foreach ($filters as $key=>$value) { 
                $q->where("$key", $value); }
		}
        $q->group_by('u.users_id');
        $q->order_by('u.insert_dt desc');
		$collection =  $q->get()->result_array();
		// echo $this->db->last_query(); die();
		return $collection;
	}	


}