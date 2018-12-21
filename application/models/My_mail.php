
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_mail extends CI_Model{


	public function send_mail($to,$subject,$message) {

		$this->load->library('email');

		$this->email->from('no_reply@domain.com', 'Admin');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()){
			return TRUE;
		}	
		else{
			return FALSE;
		}
	}
}
?>