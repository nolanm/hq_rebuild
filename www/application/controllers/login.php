<?php

class Login extends CI_Controller {
     
    function index()
    {
        $data['bodycontent']='login/login_view';
        $this->load->view('login_template',$data);
    }
    
    //authorize administrator login credentials
    function authorize()
    {
        $this->load->model('login_model');
        $adminid=$this->session->userdata('adminid');
        if(empty($adminid))
        {
            $query= $this->login_model->validate();

            if($query) //users credentials are validated  (need to check password reset depending on timeframe)
            {
                $data= array(
                'username'=> $this->input->post('username'),
                'password'=> md5($this->input->post('password')),
                'authenticated'=>true
                );
                
                //set session data
                $this->session->set_userdata($data);
                $this->session->unset_userdata('fail');
                
                
                $this->load->library('permissions');
                $ownerid=$this->permissions->operator_level_admin($this->session->userdata('adminid'));
                if($ownerid)
                {
                    $this->session->set_userdata('operator_id',$ownerid);
                }
                $this->login_model->navigation_permissions();
                $this->authorize();
            }
            else //user credentials are not valid.
            {
                $this->session->set_userdata('fail', true);

                $tries = $this->db->query("SELECT count(id) as 'count' FROM `user_logins` WHERE `ip` = '{$this->session->userdata('ip_address')}' AND `timestamp` > DATE_SUB(now(), INTERVAL 5 MINUTE)");
                if ($tries->row()->count >= 5) {
                    $this->session->set_userdata('wait', true);
                }
                else {
                    $this->session->set_userdata('wait', false);
                }

                $this->index();
            }
        }
        else if(!$this->login_model->eula($this->session->userdata('adminid')))//user has agreed to eula 
        {
            $data['bodycontent']='login/login_eula';
            $this->load->view('login_template',$data);
        }
        else if(!$this->login_model->password_age($this->session->userdata('adminid')))
        {
            //does user password still meets all the criteria of McDonald's Password Policy.
            $data['bodycontent']='login/login_password';
            $this->load->view('login_template',$data);
        }
        else//user is valid and ready to go to home page
        {
            redirect('root/index');
        }
    }
    
    //reset password
    function newPassword()
    {
        $this->load->library('form_validation');
        //password has to be between 7 and 15 characters
        $this->form_validation->set_rules('password1','New Password', 
                'trim|required|min_length[7]|max_length[15]|password_check');
        $this->form_validation->set_rules('password2','Confirmed Password', 
                'trim|required|matches[password1]');
        if($this->form_validation->run()==FALSE)//password validation fails
        {
            $data['bodycontent']='login/login_password';
            $this->load->view('login_template',$data);
        }
        else//password validation confirmed 
        {
            $this->load->model('login_model');
            $update=$this->login_model->update_password();
            if($update)
            {
                $this->authorize();
            }
        }
    }
    
    function eula()
    {
        // ACCEPT EULA...
	$update = $this->db->query("UPDATE users SET eula = 1 WHERE adminid = {$this->session->userdata('adminid')}");
        $this->authorize();
        
    }
    
    //loads view for forgotten username, sends email to user with username
    function forgot_username()
    {
        $email=$this->input->post('email');
        if(empty($email))//user input email empty?
        {
            $data['bodycontent']='login/login_forgot_username';
            $this->load->view('login_template',$data);
        }
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email','Email', 
                'trim|required|valid_email');
            if($this->form_validation->run())//email validation doesn't fail
            {
                $this->session->set_userdata('forgetUsernameValidation', TRUE);
                $query=$this->db->query("SELECT adminid, email, username, firstname, lastname FROM users WHERE email LIKE '{$email}'");
                if($query->num_rows()==0)//no users found with given email
                {
                    $this->session->set_userdata('user_email', FALSE);
                }
                else// user email valid
                {
                    $this->session->set_userdata('user_email', TRUE);
                    $this->load->model('login_model');
                    $this->login_model->retriever($query);
                }
            }
            else// email form validation fails
            {
                $this->session->set_userdata('forgetUsernameValidation', FALSE);
            }
            $data['bodycontent']='login/login_forgot_username';
            $this->load->view('login_template',$data);
        }
    }
    
    //loads view for forgotten password, sends email to user with temporary password 
    function forgot_password()
    {
        $username=$this->input->post('fp_username');
       if(empty($username))//user input username empty?
        {
            $data['bodycontent']='login/login_forgot_password';
            $this->load->view('login_template',$data);
        } 
        else
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('fp_username','Username', 
                'trim|required');
            if($this->form_validation->run())//Username validation doesn't fail
            {
                $this->session->set_userdata('forgetPasswordValidation', TRUE);
                $query=$this->db->query("SELECT adminid FROM users WHERE username LIKE '{$username}'");
                if($query->num_rows()==0)// no uers exist with username
                {
                    $this->session->set_userdata('valid_username', FALSE);
                }
                else //username valid. send temporary password
                {
                    $this->session->set_userdata('valid_username', TRUE);
                    $this->load->model('login_model');
                    $row=$query->row();
                    $this->login_model->whack($row->adminid);
                }
            }
            else //Username validation fails
            {
                $this->session->set_userdata('forgetPasswordValidation', FALSE);
                
            }
            $data['bodycontent']='login/login_forgot_password';
            $this->load->view('login_template',$data);
        }
    }
    
    function logout()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        redirect('root/index');
    }
    
}


?>
