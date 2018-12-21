<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		session_start();
		// Load session library
		//$this->load->library('session');

		// Load database
		$this->load->database();

		$this->load->model('login_database');
	}


	// Check for user login process
	public function user_auth() {

		// Check if user already logged in and redirect to the dashboard
		if  (isset($_SESSION['username'])) {
    		header('location:'.base_url().'dashboard');
		}
		// Validate Entries	
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

		if ($this->form_validation->run() == FALSE) {
	
			//If User already logged in, redirrect to dasshboard else back to login page
			if(isset($_SESSION['username'])){
				header('location:'.base_url().'dashboard');
			}
			else{
				$data['error_message']=validation_errors();
				$this->load->view('login_view', $data);
			}

		} 
		else {
			$data = array(
					'email' => $this->input->post('email'),
					'password' => $this->input->post('password')
					);

			//Verify if email and password is correct for the user
			$result = $this->login_database->login($data);
			if ($result == TRUE) {
	
				// Read user information from database and create a session for the user
				$email= $this->input->post('email');
				$result = $this->login_database->read_user_information($email);
		
				if ($result != false) {
	
					$_SESSION['username']=$result[0]->username;
					$_SESSION['user_email']=$result[0]->user_email;
					$_SESSION['role']=$result[0]->role;

					header('location:'.base_url().'dashboard');

				}	
			} 
			else{

				$data['error_message']='Invalid Email or Password';
				$this->load->view('login_view', $data);
			}	
		}
	}


	// Destroy session to logout User
	public function signout(){
	
		session_destroy();	
		$this->load->view('login_view');
	}


	// Request Password
	public function forgot_password(){

		//If User already logged in, redirrect to dasshboard
		if(isset($_SESSION['username'])){	
			header('location:'.base_url().'dashboard');
		}
		else{
			$this->load->view('forgot_password_view');
		}
	}

	// Recover User Password via email
	public function recover_password()	{

		//If User already logged in, redirrect to dasshboard
		if(isset($_SESSION['username'])){	header('location:'.base_url().'dashboard');
		}	

		//Validate Email
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');		
		if ($this->form_validation->run() == FALSE) {

			$data['error_message']=validation_errors();
			$this->load->view('forgot_password_view', $data);
		}
		else{

			$data = array('email' => $this->input->post('email')	);

			//Verify if email exist
			$result = $this->login_database->password($data);

			if ($result == TRUE) {
		
				// Read user information from database with the email
				$email= $this->input->post('email');
				$result = $this->login_database->read_user_information($email);
		
				if ($result != false) {

					$username=$result[0]->username;
					$email=$result[0]->user_email;
					$password=$result[0]->user_password;

					// Check if on localhost or live server	
					if ($_SERVER['SERVER_NAME']=="sdms.com"){
						$data['success_message']="Oops you are on localhost, Mail cannot be sent";
						$this->load->view('forgot_password_view', $data);
					}	

					else{

						//Send Password to user as mail						
						$this->load->model('my_mail');	

						$email_message="Dear ".$username.", \r\n\r\n Below is the login credentials to your account; \r\n\r\n   E-mail: ".$email." \r\n\r\n Password: ".$password." \r\n\r\n Please, kindly change your password after successful login for security of your account. \r\n \r\n".base_url()."\r\n \r\n Regards.";

						$result = $this->my_mail->send_mail($email,"Password Recovery",$email_message);
						
						if ($result == TRUE) {		
							$data['success_message']="Password sent to your E-mail Adress successfully";
							$this->load->view('forgot_password_view', $data);
						}
						else{

							$data['error_message']='Mail failed please try again later';
							$this->load->view('forgot_password_view', $data);
						}	
					}	
				}
			} 
			else{

				$data['error_message']='User not found';
				$this->load->view('forgot_password_view', $data);
			}	
		}
	}

	// Change user Password
	public function password(){
	
		$this->load->view('password_view');
	}

	
	// Change user Password data
	public function changed_password(){

		// Check and validate user input 
		$this->form_validation->set_rules('currentpassword', 'current Password', 'trim|required|xss_clean');	
		$this->form_validation->set_rules('newpassword1', 'New Password', 'trim|required|xss_clean|min_length[8]|differs[currentpassword]');
		$this->form_validation->set_rules('newpassword2', 'Retyped New Password', 'trim|required|xss_clean|matches[newpassword1]');

		//If there is error in the data supply by the user return to login page
		if ($this->form_validation->run() == FALSE) {
			$data['error_message']=validation_errors();
			$this->load->view('password_view',$data);
		}
		else{
			//If all data supply by user are correct proceed with password edit
			$data = array(
					'username' => $_SESSION['username'],
					'current_password' => $this->input->post('currentpassword'),
					'user_password' => $this->input->post('newpassword1'),
					);

			// Perform the task with the password_insert method in Login_database class
			$result = $this->login_database->password_insert($data);

			//Check if password was updated successfully in the model script
			if ($result == TRUE) {
				$data['success_message'] = ' Password Updated Successfully !';
				$this->load->view('password_view', $data);
			} 
			else {
				$data['error_message'] = 'Current Password not Correct';
				$this->load->view('password_view', $data);
			}
		}

	}

	public function index(){
		// Check if user already logged in and redirect to the dashboard
		if  (isset($_SESSION['username'])) {
    		header('location:'.base_url().'dashboard');
    		die();
		}

		//Else load the login page
		$this->load->view('login_view');
	}




}
