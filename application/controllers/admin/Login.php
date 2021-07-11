<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('mdl_login','model');

        $this->load->library('Session'); 
    } 


	public function index(){
    
    $this->data['tiele'] = 'Admin Login';
    $this->load->view('admin/header',$this->data);
    $this->load->view('admin/login',$this->data);
    $this->load->view('admin/footer',$this->data);

	}

    function submit(){
		if(! $this->input->post()){ show_404();	}
			
             $status = $this->model->authenticate();
             
				$this->data["errr_msg"] = "";
				if($status){
                   // print_r($status);exit;
					redirect('admin/dashboard' ,'refresh');
				}
				$errors = validation_errors();
				
				if(empty($errors)) {
					
					$this->data['error_msg'] = 'Username and Password don\'t match';
				}

        $this->load->view('admin/header',$this->data);
        $this->load->view('admin/login',$this->data);
        $this->load->view('admin/footer',$this->data);
		
	}


}
