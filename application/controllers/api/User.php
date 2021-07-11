<?php
class User extends Api_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('mdl_user','model');
		$this->load->library(['form_validation', 'encryption']);
	}


    function user_registration(){

		// User Registr in to the system

		/**
		 * @api {post} /api/user/user_registration User Registration
		 * @apiName Registration
		 * @apiGroup User
		 *
		 * @apiParam {String} name Name 
		 * @apiParam {String} email Email
		 * @apiParam {String} password Password
		 * @apiParam {String} department Department.
		 * @apiParam {String} about About System.
		 * @apiParam {String} hobbies Hobbies - In aaray hobbies[0],hobbies[1]..
		 * @apiParam {String} image_path Users Profile.
		 *
		 * @apiSuccess {String} message  Associated Message.
		 * @apiSuccess {Object} error  Error if Any.
		 * @apiSuccess {Number} code HTTP Status Code.
		 * @apiSuccess {Object} data  Employee Record Object With Token
		
		 *
		 * @apiSuccessExample Success-Response:
		 *     HTTP/1.1 200 OK
		* {
		*	"message": "User Added Successfully",
		*	"error": "",
		*	"code": 200,
		*	"data": {
		*		"users_id": "1",
		*		"request_id": 1583129355.35145
		*	}
		*}
		 */

		$name 			= trim(isset($_POST['name']) ? $_POST['name'] : '');
		$email 			= trim(isset($_POST['email']) ? $_POST['email'] : '');
		$password 		= trim(isset($_POST['password']) ? $_POST['password'] : '');
		$department 	= trim(isset($_POST['department']) ? $_POST['department'] : '');
		$about 			= trim(isset($_POST['about']) ? $_POST['about'] : '');
		$hobbies        = trim(isset($_POST['hobbies']) ? $_POST['hobbies'] : '');
		$pimage 		= isset($_FILES['image_path']) ? $_FILES['image_path'] : '';


		if (empty($name)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Name Field Is Mandatory";
			$this->error = array('message' => 'Name Field Is Mandatory');
			$this->sendResponse();
			return;
		}

		if ((!preg_match('/^[a-zA-Z ]*$/',$name))) {
			$this->response['code'] = 400;
			$this->response['message'] = "Please add only alphabets in name field.";
			$this->error = array('message' => 'Please add only alphabets in name field!');
			$this->sendResponse();
			return;
		}

		if (empty($email)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Email field is mandatory";
			$this->error = array('message' => 'Email field is mandatory');
			$this->sendResponse();
			return;
		}

		//check email alleady exits
		$EmailInfo = $this->model->get_records(['email' => $email],"users",['users_id']);

		  if(count($EmailInfo)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Email address already exists !! please use another email address";
			$this->error = array('message' => 'Email address already exists !! please use another email address');
			$this->sendResponse();
			return;

		  }

		if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i', $email)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Please enter valid email.";
			$this->error = array('message' => 'Please enter valid email!');
			$this->sendResponse();
			return;
		}

		if (empty($password)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Password field is mandatory";
			$this->error = array('message' => 'Password field is mandatory');
			$this->sendResponse();
			return;
		}
		if (strlen($password) < 6){
			$this->response['code'] = 400;
			$this->response['message'] = "Password field must be at least 6 characters in length.";
			$this->error = array('message' => 'Password field must be at least 6 characters in length');
			$this->sendResponse();
			return;
		}

		if(!isset($_POST['hobbies']) || empty($_POST['hobbies'])) {

			$this->response['code'] = 400;
			$this->response['message'] = "Hobbies Field Is Mandatory";
			$this->error = array('message' => 'Hobbies Field Is Mandatory!');
			$this->sendResponse();
			return;
		}
		if (empty($department)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Department field is mandatory";
			$this->error = array('message' => 'Department field is mandatory');
			$this->sendResponse();
			return;
		}
		
		if (!preg_match('/^[a-zA-Z ]*$/',$department)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Please add only alphabets in department field.";
			$this->error = array('message' => 'Please add only alphabets in department field.!');
			$this->sendResponse();
			return;
		}
			
			
		  $departmentInfo = $this->model->get_records(['department_name' => $department],"department",['department_id']);

		  if(count($departmentInfo)) {
			 $department_id = $departmentInfo[0]->department_id;
		  }else{
            $doc_insert['department_name'] = $department;
			$department_id = $this->model->data_insert($doc_insert,'department');
		  }

		 if(empty($about)){
				$this->response['code'] = 400;
				$this->response['message'] = "About is Mandatory";
				$this->error = array('message' => 'About is Mandatory!');
				$this->sendResponse();
				return;
			}
		//upload file check isset or empty
		if(!isset($_FILES["image_path"]) && empty($_FILES['image_path']['name'])) {
				$this->response['code'] = 400;
				$this->response['message'] = "Profile Image is Mandatory";
				$this->error = array('message' => 'Profile Image is Mandatory!');
				$this->sendResponse();
				return;
			}

		if(isset($_FILES["image_path"]) && !empty($_FILES['image_path']['name'])) {
		
			$imgExt 	 		= strtolower(pathinfo($pimage['name'], PATHINFO_EXTENSION));
			$imgFormatExpected  = ['jpeg','jpg','jpe','png'];
		
		 if(!in_array($imgExt,$imgFormatExpected)){
				$this->response['code'] = 400;
				$this->response['message'] = "Please Upload Valid Image.";
				$this->error = array('message' => 'Please Upload Valid Image.');
				$this->sendResponse();
				return;
		}

        $img_name = "";
		if (isset($_FILES["image_path"]) && !empty($_FILES['image_path']['name'])) {	
			$fileInfo = pathinfo($_FILES["image_path"]["name"]);
			$img_name = str_replace(' ', '_', $name . '.' . $fileInfo['extension']);
			//upload file into uploads/prof_images foldr
			move_uploaded_file($_FILES["image_path"]["tmp_name"], "./uploads/prof_images/" . $img_name);	
		}
	 }

		$UserData = [
			'name' 		=> $name,
			'email' 		=> $email,
			'password' 	=> Encryption::encryptPassword($password), //encryption lib call for encrypt pass 
			'profile_picture_path' 		=> "uploads/prof_images/" . $img_name,
			'department_id' 		=> $department_id,
			'about' 		=> $about,
			'status' 		=> '1'
		];
              //insert into users table
		$users_id = $this->model->data_insert($UserData,'users');

		#insert with hobbies
		 for($i=0;$i<count($_POST['hobbies']);$i++){ 

                $hobbie = $_POST['hobbies'][$i];
                $hobbie_insert['users_id'] =  $users_id;
                $hobbie_insert['hobbie'] =  $hobbie;
				$hobbie_insert['status'] = '1';
				//insert into hobbies table
                $this->model->data_insert($hobbie_insert, 'users_hobbies');
            }

			if(!$users_id){
				$this->response['code'] = 400;
				$this->response['message'] = "Problem while process Data! Please try again later.";
				$this->error = array('message' => 'Problem while process Data! Please try again later.');
				$this->sendResponse();
				return;
			}

			$responseMessage = 'User Added Successfully';

			$this->response['code'] = 200;
			$this->response['data'] = ['users_id'=> $users_id];
			$this->response['message'] = $responseMessage;
			$this->error = array('message' => "");
			$this->sendResponse();
			return;

	}


	function user_login(){
      
		// User Logging in to the system

		/**
		 * @api {post} /api/user/user_login User Login
		 * @apiName user_login
		 * @apiGroup User
		 *
		 * @apiParam {String} username Username - email id -
		 * @apiParam {String} password Password. - password 
		 * 
		 *
		 * @apiSuccess {Number} code HTTP Status Code.
		 * @apiSuccess {String} message  Associated Message.
		 * @apiSuccess {Object} data  Users Record Object With Token
		 * @apiSuccess {Object} error  Error if Any.
		 *
		 * @apiSuccessExample Success-Response:
		 *     HTTP/1.1 200 OK
		* {
		*	"message": "Login Successful",
		*	"error": "",
		*	"code": 200,
		*	"data": {
		*		"token": "a6db99431370af81e68d8d121cd2430b20a3999c",
		*		"users_id": "1",
		*		"name": "Rakesh Ramesh Jadhav",
		*		"email": "test1@gmail.com",
		*		"request_id": 1583129355.35145
		*	}
		*}
		 */
 
		$username = trim(isset($this->input_data['username']) ? $this->input_data['username'] : '');
		$password = trim(isset($this->input_data['password']) ? $this->input_data['password'] : '');
	
		if (empty($username)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Username is Mandatory";
			$this->error = array('message' => 'Username Id Mandatory!');
			$this->sendResponse();
			return;
		}

		if (empty($password)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Password is Mandatory";
			$this->error = array('message' => 'Password is Mandatory!');
			$this->sendResponse();
			return;
		}
        //check username  exists
		$userInfo = $this->model->get_records(['email' => $username],"users",['users_id','name','email','password']);

		if(!count($userInfo)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Incorrect Username";
			$this->error = array('message' => 'Incorrect Username');
			$this->sendResponse();
			return;
		 }
		 // verify password
		 if(!Encryption::verifyPassword($password, $userInfo[0]->password)) {
			$this->response['code'] = 400;
			$this->response['message'] = "Incorrect Username or Password";
			$this->error = array('message' => 'Incorrect Username or Password!');
			$this->sendResponse();
			return;
		
		}else {
			if (!empty($userInfo)) {
              
				$users_id = $userInfo[0]->users_id;
				$name = $userInfo[0]->name;
				$email = $userInfo[0]->email;
				
				//Set access_token
				$token = sha1(md5(microtime() . "" . $users_id));
				$access_data = array();
				$access_data['users_id'] 			= $users_id;
				$access_data['access_token'] 		= $token;
     
				// first dectivate old token
				$upadte_data['token_status'] 		= 'inactive';
                $update_tstatus = $this->model->data_update($users_id,$upadte_data,'access_token'); 
              
				// User is logged in generate the access token 
				$insert_token = $this->model->data_insert($access_data, 'access_token'); 

				$data = array();
				$data['token'] = $token;
				$data['users_id'] = $users_id;
				$data['name'] = $name;
				$data['email'] = $email;
				
				$this->response['code'] = 200;
				$this->response['message'] = "Login Successful";
				$this->response['data'] = $data;
				$this->sendResponse();
			} else {
				$this->response['code'] = 401;
				$this->response['message'] = "Login Failure";
				$this->error = array('message' => 'Something went Wrong! Please Try Again.');
				$this->sendResponse();
			}
		}
	}

	

}
