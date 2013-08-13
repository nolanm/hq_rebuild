<?php

class myaccount_model extends CI_Model {

function update_email()
    {
        $update = $this->db->query("UPDATE users SET email = '".$this->input->post('email')."' WHERE username LIKE '{$this->session->userdata('username')}'");
        $this->session->set_userdata('email', $this->input->post('email'));
        return $update;
    }
    
    function old_password_correct()
    {
        $result= $this->db->query("SELECT * FROM users WHERE username LIKE '{$this->session->userdata('username')}' AND password LIKE '".md5($this->input->post('oldpassword'))."'"); 
         if($result->num_rows()==1)
         {
             return TRUE;
         }
         else
         {
             return FALSE;
         }
    }
    
    function update_password()
    {
        $update = $this->db->query("UPDATE users SET password = '".md5($this->input->post('newpassword1'))."', passchanged = now() WHERE username LIKE '{$this->session->userdata('username')}'");
        return $update;
    }
    
}
?>
