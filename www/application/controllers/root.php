<?php

class Root extends CI_Controller {
    
    function __construct() 
    {
        parent::__construct();
        $this->load->library('tools');
        $this->userAuthenticated();
    }
    
    function index()
    {
        
    }
    
    function userAuthenticated()
   {
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
            $data['bodycontent']='login/login_view';
            $this->load->view('login_template',$data);
        }
        else
        {
            if($userAuthenticated)
            {
                $this->hq_home();
            }
        }
    }
    
    function hq_home()
    {
        if(count($this->tools->get_requests_by_adminid($this->session->userdata('adminid')))>0)
        {
            $this->session->set_userdata('pending_admin_requests', TRUE);
        }
        $data['bodycontent']='hq_home';
        $this->load->view('template',$data);
     
    }
    
        function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect('root/index');
    }
}
    
?>
