<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users {
    
    public function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->library('session');
    }
    
	// returns user information given adminid
    function user_information($adminid)
    {
        $userQuery=$this->ci->db->query("SELECT * FROM users WHERE adminid = $adminid");
        return $userQuery->row();
    }
    
    // returns boolean - whether or not username exists in database or not.
    function check_username($username)
    {
        $usernameQuery=$this->ci->db->query("SELECT adminid FROM users WHERE username LIKE '$username'");
        return $usernameQuery->row();
        
    }
    
    
    //params: updated firstname, lastname, username, and email for given adminid
    //returns boolean- was update successfull?
    function update_admin_info($adminid,$username,$firstname,$lastname,$email)
    {
        $myquery = "UPDATE users SET username = '$username', firstname= '$firstname',
             lastname= '$lastname',  email= '$email' WHERE adminid = $adminid";
        $query=  $this->ci->db->query($myquery);
        return $query;
    }
    
    //adds new user to database with given paramaters.
    //returns new adminid if successfull, false is not successfull
    function new_admin($username,$password,$firstname,$lastname,$email,$usertype, $mcopco)
    {
        $myquery = "INSERT INTO users (username, password, firstname, lastname, email, user_type, mcopco) 
           VALUES('$username', '".md5($password)."', 
               '$firstname', '$lastname','$email','$usertype',$mcopco)";
        $query=  $this->ci->db->query($myquery);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
	//deletes user with given adminid
    function delete_administrator($adminid)
    {
        $this->ci->db->delete('users', array('adminid' => $adminid));
    }
}
?>
