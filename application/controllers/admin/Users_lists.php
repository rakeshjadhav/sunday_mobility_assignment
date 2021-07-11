<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users_lists extends Admin_Controller
{
	
	
	function __construct() {
		parent::__construct();
        $this->load->model('mdl_users_lists','model');
	}

	function index(){
		if( ! $this->session->is_admin_session_in() ){
			redirect('admin/login','refresh');
		}

		$this->data['collection'] = $this->model->get_collection($filters = []);
	
        $this->data['mainmenu'] = 'Users Lists';
        
        $this->load->view('admin/header');
        $this->load->view('admin/navbar');
        $this->load->view('admin/users_lists',$this->data);
        $this->load->view('admin/footer');

    }




}