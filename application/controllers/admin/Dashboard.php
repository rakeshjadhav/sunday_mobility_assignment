<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends Admin_Controller
{
	
	
	function __construct() {
		parent::__construct();
        $this->load->model('mdl_dashboard','model');
	}

	function index(){
		if( ! $this->session->is_admin_session_in() ){
			redirect('admin/login','refresh');
		}

		$this->data['regis_count'] = count($this->model->get_records([], 'users'));
	
        $this->data['mainmenu'] = 'dashboard';
        
        $this->load->view('admin/header',$this->data);
        $this->load->view('admin/navbar',$this->data);
        $this->load->view('admin/dashboard',$this->data);
        $this->load->view('admin/footer',$this->data);

    	// $this->set_view($this->data, $this->controller . '/dashboard',  '_admin');
    }


    function logout() {
		$userId = $_SESSION['v1-sunday_mobility']['user_id'];
    	
        $session_key = config_item('session_data_key');
		$sessionData = array('user_id'=>'',	'username'=>'', 'role'=>'');
		
		$this->session->unset_userdata($session_key, $sessionData);
     	redirect('admin/login','refresh');
    }

}
    