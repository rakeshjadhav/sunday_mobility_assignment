<?php
defined('BASEPATH') or exit('No direct script access allowed');
class MY_Model extends CI_Model
{

    private $table;
    public function __construct($table = '')
    {
        parent::__construct();
        $this->table = $table;
        $this->load->library('user_agent');
    }

    function get_records($filters = [], $table = '', $select = []) {

        if(sizeof($select) > 0){
			$this->db->select($select);
		}
		if(sizeof($filters) > 0){
            foreach($filters as $key => $filter) {
                if(! is_array($filter)) {
                    $this->db->where($key, $filter);
                } 
            }
		}

		$this->db->order_by('insert_dt desc');

		$this->db->from($table);
		$query = $this->db->get();
		// echo $this->db->last_query(); die();
		return $query->result();
	}

    function data_insert($data, $table = '') {
	
		$data['insert_dt'] = $data['update_dt'] = date('Y-m-d H:i:s');
		return ($this->db->insert($table, $data)) ? $this->db->insert_id() : FALSE;
	}

}