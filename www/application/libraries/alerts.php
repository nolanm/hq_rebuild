<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alerts {
    
    public function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->library('session');
    }
    
    function save_successfull_alert()
    {
        print $this->ci->load->view('alerts/save_successfull.html');
    }
    
    function save_unsuccessfull_alert()
    {
        print $this->ci->load->view('alerts/save_unsuccessfull.html');
    }
    
    function all_fields_alert()
    {
        print $this->ci->load->view('alerts/fill_all_fields.html');
    }
    
    function username_unavailable_alert()
    {
        print $this->ci->load->view('alerts/username_unavailable.html');
    }
    
    function valid_email_alert()
    {
        print $this->ci->load->view('alerts/invalid_email.html');
    }
    
    function password_confirmation_alert()
    {
        print $this->ci->load->view('alerts/password_confirmation.html');
    }
    
    function email_error_alert()
    {
        print $this->ci->load->view('alerts/email_sent_error.html');
    }
    
    function pending_request_error_alert()
    {
        print $this->ci->load->view('alerts/pending_request_error.html');
    }
    
}

?>
