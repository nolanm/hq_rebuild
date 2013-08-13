<?php

class McOpCo_Administrator extends CI_Controller {
    
   
    function McOpCo_Administrator()
    {
            parent::__construct();
            $this->load->library('users');
            $this->load->library('permissions');
            $this->load->library('alerts');
            $this->load->helper('url');
            $this->load->model('administrator_logins/mcopco_administrator_model');

            $userAuthenticated=$this->session->userdata('authenticated');
            if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
            {
                 redirect(base_url(), 'refresh');
            }
    }
    
    
    function index()
    {
       
        if($this->session->userdata('user_type')=='national')
        {
            $national=TRUE;
        }
        else if($this->session->userdata('user_type')=='division')
        {
            $national=FALSE;
        }
        else
        {
            redirect(base_url(), 'refresh');
        }
        
            $mcopcos_query= $this->mcopco_administrator_model->McOpCo_Regions($national);
            $mcopco_operators_query= $this->mcopco_administrator_model->McOpCo_Operator_Admins($national);
            $divisions= $this->mcopco_administrator_model->Divisions($national);
            $division_admins= $this->mcopco_administrator_model->McOpCo_Division_Admins($national);


            $data['view_data']= array(
                'mcopco_regions'=>$mcopcos_query,
                'mcopco_operators'=>$mcopco_operators_query,
                'divisions'=>$divisions,
                'division_admins'=>$division_admins);
            $data['bodycontent']='administrator_logins/mcopco_administrator_view';
            $this->load->view('template',$data);
            
       
        
    }
    
    //function recieves updated admin info from view and sends data to update_admin_info in model
    // returns successfull or failing output.
    function update_admin_info()
    {
        $username= $this->input->post('username');
        $firstname= $this->input->post('firstname');
        $lastname= $this->input->post('lastname');
        $email=$this->input->post('email');
        if(empty($username) || empty($firstname) || empty($lastname) || empty($email))
        {
            //were all the input field filled out?
           $this->alerts->all_fields_alert();
        }
        else
        {
            
            $result= $this->users->check_username($username);
            if(!empty($result) && $result->adminid != $this->input->post('adminid'))// was the username entered already taken?
            {
                 $this->alerts->username_unavailable_alert();
            }
            else
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                if(!$this->form_validation->run())// was the email entered a valid email?
                {
                     $this->alerts->valid_email_alert();
                }
                else //all validations have been checked and we are ready to update info
                {
                   
                    $result= $this->users->update_admin_info($this->input->post('adminid'),$username,$firstname,$lastname,$email);
                    if($result)
                    {
                        $this->alerts->save_successfull_alert();
                    }
                    else
                    {
                        $this->alerts->unsave_successfull_alert();
                    }
                }
            }
        }
       
    }
    
    function add_new_admin()
    {
        
        $operator_id= $this->input->post('operator_id');
        $username= $this->input->post('username');
        $password= $this->input->post('password');
        $password2=$this->input->post('password2');
        $firstname= $this->input->post('firstname');
        $lastname= $this->input->post('lastname');
        $email=$this->input->post('email');
       
        if(empty($username) || empty($password) || empty($password2) || empty($firstname) || empty($lastname) || empty($email))
        {
            //were all the input field filled out?
          $this->alerts->all_fields_alert();
        }
        else
        {
            
            $result= $this->users->check_username($username);
            if(!empty($result) && $result->adminid != $this->input->post('adminid'))// was the username entered already taken?
            {
                 $this->alerts->username_unavailable_alert();
            }
            else
            {
                if(strcmp($password, $password2)!=0)
                {
                     $this->alerts->password_confirmation_alert();
                }
                else
                {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                    if(!$this->form_validation->run())// was the email entered a valid email?
                    {
                        $this->alerts->valid_email_alert();
                    }
                    else //all validations have been checked and we are ready to update info
                    {
                        
                        $adminID= $this->users->new_admin($username,$password,$firstname,$lastname,$email,'organization', 1);
                       
                        if($adminID!=FALSE)
                        {
                           $permission_id = $this->permissions->add_organization_permission($adminID, $operator_id);
                             
                           if($this->input->post('all_permissions'))
                           {
                               $this->permissions->add_hr_permissions($permission_id);
                               $this->permissions->add_lsm_permissions($permission_id);
                               $this->permissions->add_ro_permissions($permission_id);
                           }
                           else
                           {
                                if($this->input->post('hr_checkbox'))
                                {
                                    $this->permissions->add_hr_permissions($permission_id);
                                }
                                if($this->input->post('lsm_checkbox'))
                                {
                                    $this->permissions->add_lsm_permissions($permission_id);
                                }
                                if($this->input->post('ro_checkbox'))
                                {
                                    $this->permissions->add_ro_permissions($permission_id);
                                }
                           }
                            
                            $this->tools->reload_page('administrator_logins/mcopco_administrator');
                        }
                        else
                        {
                            $this->alerts->unsave_successfull_alert();
                        }
                    }
                }
            }
        }

    }
    
    
    function add_new_division_admin()
    {
        
        $division_id= $this->input->post('division_id');
        $username= $this->input->post('username');
        $password= $this->input->post('password');
        $password2=$this->input->post('password2');
        $firstname= $this->input->post('firstname');
        $lastname= $this->input->post('lastname');
        $email=$this->input->post('email');
       
        if(empty($username) || empty($password) || empty($password2) || empty($firstname) || empty($lastname) || empty($email))
        {
            //were all the input field filled out?
           
            $this->alerts->all_fields_alert();
        }
        else
        {
            
            $result= $this->users->check_username($username);
            if(!empty($result) && $result->adminid != $this->input->post('adminid'))// was the username entered already taken?
            {
                 $this->alerts->username_unavailable_alert();
            }
            else
            {
                if(strcmp($password, $password2)!=0)
                {
                    $this->alerts->password_confirmation_alert();
                }
                else
                {
                    $this->load->library('form_validation');
                    $this->form_validation->set_rules('email','Email','trim|required|valid_email');
                    if(!$this->form_validation->run())// was the email entered a valid email?
                    {
                         $this->alerts->valid_email_alert();
                    }
                    else //all validations have been checked and we are ready to update info
                    {
                        
                        $adminID= $this->users->new_admin($username,$password,$firstname,$lastname,$email,'division', 1);
                       
                        if($adminID!=FALSE)
                        {
                           $permission_id = $this->permissions->add_division_permission($adminID, $division_id);
                                     
                            $email_body = "Hello ".$this->input->post('firstname')." ".$this->input->post('lastname').", Welcome to McState!\n\n";
                            $email_body .= $this->session->userdata('name')." has created your McState.com account.\n\n";
                            $email_body .= "Your username is: ".$this->input->post('username')."\n\n";
                            $email_body .= "Your password is: ".$this->input->post('password')."\n\n";
                            $email_body .= "You can login using your new permissions at http://hq.mcstate.com\n\n";
                            $email_body .= "McState.com Tech Support\n1-866-407-9472";

                            $this->mcopco_administrator_model->emailer($email_body,'Welcome to McState.com', $email);
                            
                            $this->tools->reload_page('administrator_logins/national_administrator');
                        }
                        else
                        {
                            $this->alerts->unsave_successfull_alert();
                        }
                    }
                }
            }
        }

    }
    
    
   function update_permission()
   {
        $var = explode("-", $this->input->post('field_name'));
        
        $result= $this->permissions->update_permission($var[1],$var[0],$this->input->post('value'));
        if($result)
        {
            $this->alerts->save_successfull_alert();
        }
        else
        {
            $this->alerts->unsave_successfull_alert();
        }
        
   }
   
   function delete_admin_from_region()
   {
      
        $permissions= $this->permissions->permissions_for_admin($this->input->post('adminid'));
        $row_count= count($permissions);
        $deleted_count=0;
        foreach($permissions as $row)
        {
            if($row->correlation_id==$this->input->post('regionid') && $row->correlation_type=='organization')
            {
                $this->permissions->delete_permissions_row($row->permissions_id);
                $deleted_count++;
            }
        }
        if($deleted_count==$row_count)
        {
            $this->users->delete_administrator($row->adminid);
        }
        
   }
   
   function delete_admin_from_division()
   {
      
        $permissions= $this->permissions->permissions_for_admin($this->input->post('adminid'));
        $row_count= count($permissions);
        $deleted_count=0;
        foreach($permissions as $row)
        {
            if($row->correlation_id==$this->input->post('division') && $row->correlation_type=='division')
            {
                $this->permissions->delete_permissions_row($row->permissions_id);
                $deleted_count++;
            }
        }
        if($deleted_count==$row_count)
        {
            $this->users->delete_administrator($row->adminid);
        }
        
   }
    
}

?>
