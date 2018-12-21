<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();

		// Load form helper library
		$this->load->helper('form');

		// Load form validation library
		$this->load->library('form_validation');

		session_start();

		// Prevent Unauthorise access
		if  (!isset($_SESSION['username'])) {
    		header('location:'.base_url().'login');
		}

		//Load database
		$this->load->database();

		//load sms database model
		$this->load->model('sms_database');

		//load login database database model
		$this->load->model('login_database');

	}

	public function sms(){
		// Check validation for user input in SMS form
		$this->form_validation->set_rules('sender', 'Text Message Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('receiver', 'Receiver Number', 'trim|required|xss_clean|integer|exact_length[13]', array('integer' => "Enter only Numbers in the %s field" ));
		$this->form_validation->set_rules('message', 'Text Message', 'trim|required|xss_clean');

		//Retrieve input data for all use
		$data = array(
				'vendor' => $_SESSION['username'],
				'sender' => $this->input->post('sender'),
				'receiver' => $this->input->post('receiver'),
				'message' => $this->input->post('message'),
				'status' => 'Sent',
			);

		if ($this->form_validation->run() == FALSE) {
			// Load Previous sent sms
			$data['sent_sms'] = $this->sms_database->sent_messages();
		
			// SEnd Error Message to the User	
			$data['error_message']=validation_errors();
			$this->load->view('dashboard_view', $data);
		} 
		else {
			
			//insert sms into sms table
			$result = $this->sms_database->sms_insert($data);

			if ($result == TRUE) {

				//Remove data of the text message sent
				$data['sender'] = "";
				$data['receiver'] = "";
				$data['message'] = ""; 

				// Load Previous sent sms
				$data['sent_sms'] = $this->sms_database->sent_messages();
		
				$data['success_message'] = ' Text Message sent successfully';
				$this->load->view('dashboard_view', $data);
			} 
			else {
				$data['error_message'] = 'Error saving text Message';

				// Load Previous sent sms
				$data['sent_sms'] = $this->sms_database->sent_messages();

				$this->load->view('dashboard_view', $data);
			}
		}


	}



	public function index(){

		// Load Previous sent sms
		$data['sent_sms'] = $this->sms_database->sent_messages();

		$this->load->view('dashboard_view', $data);
	}
}