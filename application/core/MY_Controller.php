<?php

class MY_Controller extends CI_Controller
{

    public function __construct(){

        parent::__construct();

    }

}

class Api_Controller extends MY_Controller
{

    public $response = array('message'=> 'OK', 'error'=>"");
    private $request_id = null;
    protected $error = array();
    public function __construct(){
        parent::__construct();
        $this->request_id = microtime(true);
        $this->load->model('mdl_user');
		$this->load->library('form_validation');

        $input = rawurldecode(trim(file_get_contents('php://input')));
        if($input){
            $input = json_decode($input, TRUE);
    
            if(!json_last_error()) {
                $this->input_data = $input ;
    
            } else {
                $this->response['code'] = 200;
                $this->response['message'] = "Bad Request. JSON ERROR";
    
                $this->output->set_status_header(200)->set_content_type('application/json');
                header("Content-Type: application/json");
                echo json_encode($this->response);
                exit;
            }
        }
    }


    protected function sendResponse(){
		
        $this->response['data']['request_id'] = $this->request_id;
    //   print_r($this->response);
		if(!empty($this->error)){
			$this->response['error'] = array_pop($this->error);
		}
		$this->response['message'] =$this->response['message'];
		$response = json_encode($this->response);

		$this->output->set_status_header($this->response['code'])->set_content_type('application/json')->set_output($response);
	}

}

    class Admin_Controller extends MY_Controller
{
    protected $test = false;
    public function __construct(){
        parent::__construct();
        

    }

    


}




