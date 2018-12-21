<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adduser extends CI_Controller {

	
	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		session_start();

		// Redirect User to Login page when not logged in and redirect to dashboard for vendor 
		if  (!isset($_SESSION['username'])) {
    		header('location:'.base_url().'login');
		}
		elseif ($_SESSION['role'] == 'vendor') {
			header('location:'.base_url().'dashboard');
		}

		// Load database
		$this->load->database();

		$this->load->model('login_database');

	}

	// Validate and store registration data in database
	public function new_user() {

		// Check validation for user input in Add User form
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|min_length[3]|is_unique[users.username]', array('is_unique'   => 'This %s already exists.' ));

		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.user_email]', array('is_unique'   => 'This %s already exists.' ));
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[8]');
		
		//User input to return if there is error
		$data['username'] = $this->input->post('username');
		$data['email'] = $this->input->post('email');

		//Check validation if there is no error
		if ($this->form_validation->run() == FALSE) {
			// Load all users
			$data['all_users'] = $this->login_database->load_users();

			$data['error_message']=validation_errors();
			$this->load->view('adduser_view',$data);
		} 
		else {

			//Prepare data for database insert	
			$insert_data = array(
					'username' => $this->input->post('username'),
					'user_email' => $this->input->post('email'),
					'user_password' => $this->input->post('password'),
					'role' => $this->input->post('role')
					);

			// Insert data using registration_insert in Login_database model
			$result = $this->login_database->registration_insert($insert_data);

			// Load all users
			$data['all_users'] = $this->login_database->load_users();	

			//Use result to ascertain the previous process was successful
			if ($result == TRUE) {

				//Send Mail to the new User 					
				$this->load->model('my_mail');	
				$email_message="Dear ".$insert_data['username'].", \r\n\r\n Your account with the role as a ".ucfirst($insert_data['role'])." was created successfully. Find below, the login credentials to your account; \r\n\r\n   E-mail: ".$insert_data['user_email']." \r\n\r\n Password: ".$insert_data['user_password']." \r\n\r\n Please, kindly change the password after successful login to your desired and secure password. \r\n \r\n".base_url()."\r\n \r\n Regards.";

				$this->my_mail->send_mail($insert_data['user_email'],"Your Account Created Successfully",$email_message);

				//Prevent user input from filling the form
				unset($data['username']);
				unset($data['email']) ;
				
				$data['success_message'] = strtoupper($this->input->post('username')).' Account Created Successfully !';
				$this->load->view('adduser_view', $data);

				
			} 
			else {
				
				$data['error_message'] = 'Username or Email already exist!';
				$this->load->view('adduser_view', $data);
			}
		}


	}


	public function index(){
		// Load all users
		$data['all_users'] = $this->login_database->load_users();
		
		$this->load->view('adduser_view', $data);
	}


}