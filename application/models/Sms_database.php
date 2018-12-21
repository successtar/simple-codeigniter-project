<?php

Class Sms_database extends CI_Model {

	// Insert registration data in database
	public function sms_insert($data) {

		// Query to insertsms in database
		$this->db->insert('text_message', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		}
		else {
			return false;
		}

	}

	// Load sent text messages
	public function sent_messages() {

		//Initialise Previous_sms string and counter
		$previous_sms = "";
		$i = 1;

		$this->db->select('*');
		$this->db->from('text_message');

		//If user is not Super Admin obtain only the Vendor text messages
		if ($_SESSION['role']!="superadmin"){
			$condition = "vendor =" . "'" . $_SESSION['username']. "'";
			$this->db->where($condition);
		}
		//Obtain in descendin order
		$this->db->order_by('id','desc');

		//Obtain most recent 50 text messages
		$this->db->limit(50);

		// Execute the query
		$query = $this->db->get();

		// Check if the query return list of text messages
		if ($query->num_rows() >= 1) {
			
			foreach ($query->result() as $result){
				//Obtain the text messages released from the database for the user
        		$previous_sms = $previous_sms." <tr class='odd gradeX'>
										<td> ".$i.".</td>
										<td> ".ucfirst($result->vendor)." </td>
										<td> ".$result->sender." </td>
										<td> ".$result->receiver."</td>
										<td> ".$result->message." </td>
										<td> ".ucfirst($result->status)." </td>
										<td> ".$result->time_sent." </td>
									</tr>
									";
				$i++;
			}
			

		} 

		// Return the list of text messages if there is any
		return $previous_sms; 

	}

}

?>