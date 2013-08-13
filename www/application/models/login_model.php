<?php

class Login_model extends CI_Model {

    function validate()
    {      
        /* This function receives a username/password combination and returns 
	true/false if a valid match is found. If no match is found, the attempt
	is recorded and a user is locked out after 5 unsuccessful attempts */
        
   
        $password= md5($this->input->post('password'));
       $string="SELECT * FROM users WHERE username = '".$this->input->post('username')."' AND password = '$password'";
       /*$this->db->where('username',  $this->input->post('username'));
      $this->db->where('password', md5($this->input->post('password')));
      $query= $this->db->get('users');*/
       $query=$this->db->query($string);
      if($query->num_rows()==1)
      {
            $row= $query->row();
            $name= $row->firstname." ".$row->lastname;
            $data= array(
                'adminid'=> $row->adminid,
                'name'=> $name,
                'email'=> $row->email,
                'user_type'=> $row->user_type,
                'mcopco'=>$row->mcopco
                );
            $this->session->set_userdata($data);
            $success = $this->db->query("INSERT INTO user_logins SET userid = {$this->session->userdata('adminid')}, successful = 1, ip = '{$this->session->userdata('ip_address')}'");
            $lastlogin = $this->db->query("UPDATE users SET last_login = now() WHERE adminid = '{$this->session->userdata('adminid')}'");
            return true;
      }
      else
      {
          $user = $this->db->query("SELECT adminid FROM users WHERE username = '{$this->input->post('username')}'");
        if ($user->num_rows()==1)
        {
            $row=$user->row();
            // record invalid attempt if username is valid...
            $fail = $this->db->query("INSERT INTO user_logins SET userid = {$row->adminid}, successful = 0, ip = '{$this->session->userdata('ip_address')}'"); 
        }	
        return false;
      }
    }
    
    function eula($id) {
	
	/* This function receives a username and returns 
	a true/false if the user has accepted the EULA */
	
	$query= $this->db->query("SELECT adminid FROM users WHERE adminid = '{$id}' AND eula = 1;");
	
        if ($query->num_rows()==1) {
		return true;
	} else {
		return false;
	}
    }


    function email($id) {

            /* This function receives a username and returns true false 
            if the user has a valid email associated with the login.
            Returns true/false. */

            global $db;

            if ($email = $db->get_row("SELECT * FROM users WHERE adminid = '{$id}' AND email <> '';")) {
                    return true;
            } else {
                    return false;
            }

    }

    function password_age($id) {

            /* This function checks to see if the username/password combination 
            still meets all the criteria of McDonald's Password Policy.
            Returns true/false. */

            $passChanged = $this->db->query("SELECT passchanged FROM users WHERE adminid = '{$id}';");
           
            if ($passChanged)
            {
                 $row=$passChanged->row();
                 
                    if ($this->dateDiff('/', date("m/d/Y"), date("m/d/Y",strtotime($row->passchanged))) > 90 || $row->passchanged == '') {
                            // not more than 90 days old
                            return false;
                    } else {
                            return true; 
                    }
            } else {
                    // password has never been changed...
                    return false;
            }	
    }
    

    


    function dateDiff($dformat, $endDate, $beginDate) {
            $date_parts1=explode($dformat, $beginDate);
            $date_parts2=explode($dformat, $endDate);
            $start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
            $end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
            return $end_date - $start_date;
    }

    function update_password()
    {
        $update = $this->db->query("UPDATE users SET password = '".md5($this->input->post('password1'))."', passchanged = now() WHERE username LIKE '{$this->session->userdata('username')}'");
        return $update;
    }
    
    //emails user temporary password
    function whack($id) {
	$pass = $this->generatePassword();
	$sql = "UPDATE users SET password = '".md5($pass)."', passchanged = NULL WHERE adminid = {$id};";
	$reset = $this->db->query($sql);
	
	$sql = "SELECT * FROM users WHERE adminid = {$id}";
	$user_query = $this->db->query($sql);
        $user=$user_query->row();
	
	$email_body = "Someone has attempted to retrieve the password for your LocalMark.com account. As a security precaution, we are resetting the password and sending you a temporary password. Next time you attempt to login, you will need to set a new password.\n\n";
	
	$email_body .= "Your temporary password is: {$pass}\n\n";
	$email_body .= "You can login using your new password at http://hq.LocalMark.com\n\n";
	$email_body .= "LocalMark.com Tech Support\n1-866-407-9472";
	
	$this->emailer($email_body,'Your Temporary LocalMark.com Password',$user->firstname.' '.$user->lastname, $user->email);
	//emailer($email_body,'Your Temporary LocalMark.com Password',$user->firstname.' '.$user->lastname,'brant@LocalMark.com');
    }

    //emails username to user
    function retriever($matches) {

        
            $email_body = "Someone has attempted to retrieve the username(s) for your LocalMark.com account. As a security precaution, we are sending them to the email associated with the account(s):\n\n";

            foreach ($matches->result() AS $match) {
                    $email_body .= $match->username."\n";
                    $name = $match->firstname.' '.$match->lastname;
                    $email = $match->email;
            }
            $email_body .= "\n";
            $email_body .= "You can login using your username(s) at http://hq.LocalMark.com\n\n";
            $email_body .= "LocalMark.com Tech Support\n1-866-407-9472";

            $this->emailer($email_body,'Your LocalMark.com Username',$name,$email);
            //emailer($email_body,'Your LocalMark.com Username',$name,'brant@LocalMark.com');
    }

function generatePassword($length = 8) {

  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }
  }

  // done!
  return $password;
} 

function emailer($response,$title,$recipName,$recipEmail) {
	/*$reply = new PHPMailer;
	$reply->IsSMTP(); // telling the class to use SMTP
	$reply->Host = "localhost"; // SMTP server
	$reply->From = "webmaster@LocalMark.com";
	$reply->FromName = "LocalMark Support Team";
	$reply->AddAddress($recipEmail, $recipName);
	$reply->Subject = $title;
	$reply->Body = $response;
	$reply->WordWrap = 80;
	$reply->Send();*/
        
        
        $this->load->library('email');

        $this->email->from('webmaster@LocalMark.com', 'LocalMark Support Team');
        $this->email->to($recipEmail);
        $this->email->subject($title);
        $this->email->message($response);

        $this->email->send();

       
}

function set_permissions_array()
{
    $string="SELECT * FROM permissions_hierarchy WHERE adminid = '".$this->session->userdata('adminid')."'";
       /*$this->db->where('username',  $this->input->post('username'));
      $this->db->where('password', md5($this->input->post('password')));
      $query= $this->db->get('users');*/
       $query=$this->db->query($string);
       $permissions_array= array();
       foreach($query->result() as $row)
       {
           array_push($permissions_array, $row);
       }
       $this->session->set_userdata(array('permissions'=>$permissions_array));
}

function navigation_permissions()
{
    $this->load->library('Permissions');
    $navigation_array= array(
        'mcteachers_night'=>  $this->permissions->mcteachers_night(),
        'donation_request'=> $this->permissions->donation_request(),
        'grand_opening' => $this->permissions->grand_opening(),
        'calendar_of_events'=>  $this->permissions->calendar_of_events(),
        'tours'=> $this->permissions->tours(),
        'orange_bowl'=> $this->permissions->orange_bowl(),
        'power_bowl'=> $this->permissions->power_bowl(),
        'birthday_party_to_go'=> $this->permissions->birthday_party_to_go(),
        'birthday_party_reservation'=> $this->permissions->birthday_party_reservation(),
        'brand_trust'=> $this->permissions->brand_trust(),
        'jobs'=> $this->permissions->jobs(),
        'benefits'=> $this->permissions->benefits(),
        'application_settings'=> $this->permissions->application_settings(),
        'ray_kroc'=> $this->permissions->ray_kroc(),
        'hiring_day'=> $this->permissions->hiring_day(),
        'custom_content'=> $this->permissions->custom_content(),
        'restaurant_settings'=> $this->permissions->restaurant_settings(),
        'hours'=> $this->permissions->hours(),
        'services'=> $this->permissions->services(),
        'qr_codes'=> $this->permissions->qr_codes(),
        'login_permissions'=> $this->permissions->login_permissions(),
        'banners'=> $this->permissions->banners()
    );
 $this->session->set_userdata($navigation_array);
}
    
}

?>
