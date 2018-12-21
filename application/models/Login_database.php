<?php

Class Login_Database extends CI_Model {

	// Insert registration data in database
	public function registration_insert($data) {

		// Query to check whether username already exist or not
		$condition = "user_email =" . "'" . $data['user_email'] . "' OR " ."username =" . "'" . $data['username'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 0) {

			// Query to insert data in database
			$this->db->insert('users', $data);

			if ($this->db->affected_rows() > 0) {
			return true;
			}
		} 
		else{
			return false;
		}
	}


	// Update Password in database
	public function password_insert($data) {

		// Query to check whether current password is correct or not
		$condition = "user_password =" . "'" . $data['current_password'] . "' AND " ."username =" . "'" . $data['username'] . "'";
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() != 0) {

			// Query to update password in database
			$condition = "username =" . "'" . $data['username'] . "'";
			$update = array('user_password' =>  $data['user_password']);
			$this->db->where($condition);
			$this->db->update('users', $update);

			if ($this->db->affected_rows() > 0) {
				return true;
			}
		} 
		else {
			return false;
		}
	}


	// Read data using user email and password
	public function login($data) {

		$condition = "user_email =" . "'" . $data['email'] . "' AND " . "user_password =" . "'" . $data['password'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return true;
		} 
		else {
			return false;
		}
	}


	// Retrieve user password from database
	public function password($data) {

		$condition = "user_email =" . "'" . $data['email'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return true;
		} 
		else {
			return false;
		}	
	}



	// Read data from database to show data in Dashboard page
	public function read_user_information($email) {

		$condition = "user_email =" . "'" . $email . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		} 
		else {
			return false;
		}
	}


	// Load active users
	public function load_users(){

		//Initialise users_list string and counter
		$users_list = "";
		$i = 1;

		$this->db->select('*');
		$this->db->from('users');

		//Obtain users in descending order
		$this->db->order_by('id','desc');

		//Obtain most recent 50 users
		$this->db->limit(50);

		// Execute the query
		$query = $this->db->get();

		// Check if the query return list of users
		if ($query->num_rows() >= 1) {
			
			foreach ($query->result() as $result){
				//Obtain the Users released from the database for the user
        		$users_list = $users_list." <tr class='odd gradeX'>
										<td> ".$i.".</td>
										<td> ".ucfirst($result->username)." </td>
										<td> ".$result->user_email." </td>
										<td> ".ucfirst(str_replace('superadmin', 'Super Admin',$result->role))."</td>
										<td> ".ucfirst($result->status)." </td>
										<td> ".$result->time_registered." </td>
									</tr>
									";
				$i++;
			}
			

		} 

		// Return the list of users
		return $users_list; 

	}	

}

?>