<?php

class myaccount extends CI_Controller {

        function myaccount()
        {
            parent::__construct();
            $this->load->library('permissions');
            $this->load->library('tools');
            $this->load->library('alerts');
            $this->load->library('form_validation');
            $this->load->model('myaccount_model');

            $userAuthenticated=$this->session->userdata('authenticated');
            if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
            {
                 redirect(base_url(), 'refresh');
            }
        }
    
	public function index()
	{
            
            $data['bodycontent']='myaccount_view';
            $this->load->view('template',$data);
	}
        
        public function changePassword()
        {
                
                $data['bodycontent']='change_password';
                $this->load->view('template',$data);
            
        }
        
        public function update_password()
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('newpassword1','New Password', 
                'trim|required|min_length[7]|max_length[15]|password_check');
            $this->form_validation->set_rules('newpassword2','Confirmed Password', 
                'trim|required|matches[newpassword1]');
            if($this->form_validation->run())//do both new passwords meet the requirments?
            {
                
                $this->load->model('myaccount_model');
                if($this->myaccount_model->old_password_correct())// is old password correct?
                {
                    $password_result= $this->myaccount_model->update_password();
                    if($password_result)// was changing the password in the database successfull?
                    {
                       $result_string= "<p class='alert alert-success'> Your new password was successfully changed</p>";
                    }
                    else
                    {
                        $result_string= "<p class='alert alert-error'> There was an error while updating your password, please try again.</p>";
                    }
                }
                else // old password did not match current password in database.
                {
                    $result_string= "<p class='alert alert-error'> Your old password does not match our records, please try again or call customer support for assistance</p>";
                }
            
                $data['view_data']=array('result'=>$result_string);
            }
            $data['bodycontent']='change_password';
            $this->load->view('template',$data);
        }
        
        public function changeEmail()
        {
            $this->load->library('form_validation');
                $this->form_validation->set_rules('email','Email', 
                    'trim|required|valid_email');
                if($this->form_validation->run())//email validation fails
                { 
                        $this->session->set_userdata('email_changed',TRUE);
                        $this->load->model('myaccount_model');
                        $result=$this->myaccount_model->update_email();
                        if($result)
                        {
                            $result_string= "<p class='alert alert-success'> Your email was successfully changed</p>";
                        }
                        else
                        {
                            $result_string= "<p class='alert alert-error'> There was an error while updating your email, please try again.</p>";
                        }
                        $data['view_data']=array('result'=>$result_string);
                }
                
                
                $data['bodycontent']='myaccount_view';
                $this->load->view('template',$data);
        }
}
?>
