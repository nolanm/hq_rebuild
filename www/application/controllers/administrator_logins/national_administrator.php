<?php

class National_Administrator extends CI_Controller {
 

    function National_Administrator()
    {
            parent::__construct();
            $this->load->library('users');
            $this->load->library('permissions');
            $this->load->helper('url');
            $this->load->model('administrator_logins/national_administrator_model');

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
            $coop_array= $this->national_administrator_model->Coops(0);
            $coop_admins= $this->national_administrator_model->Coop_Admins(0);
         
            $region_array= $this->national_administrator_model->Regions(0);
            $region_admins= $this->national_administrator_model->Region_Admins(0);
        
            $division_array= $this->national_administrator_model->Divisions(0);
            $division_admins= $this->national_administrator_model->Division_Admins(0);
        
            $data['view_data']= array(
                'coop_array'=>$coop_array,
                'coop_admins'=> $coop_admins,
                'region_array'=>$region_array,
                'region_admins'=> $region_admins,
                'division_array'=>$division_array,
                'division_admins'=> $division_admins);
        }
        else if($this->session->userdata('user_type')=='division')
        {
            $coop_array= $this->national_administrator_model->Coops(1);
            $coop_admins= $this->national_administrator_model->Coop_Admins(1);
         
            $region_array= $this->national_administrator_model->Regions(1);
            $region_admins= $this->national_administrator_model->Region_Admins(1);
        
            $division_array= $this->national_administrator_model->Divisions(1);
            $division_admins= $this->national_administrator_model->Division_Admins(1);
        
            $data['view_data']= array(
                'coop_array'=>$coop_array,
                'coop_admins'=> $coop_admins,
                'region_array'=>$region_array,
                'region_admins'=> $region_admins,
                'division_array'=>$division_array,
                'division_admins'=> $division_admins);
        }
        else if($this->session->userdata('user_type')=='region')
        {
            $coop_array= $this->national_administrator_model->Coops(2);
            $coop_admins= $this->national_administrator_model->Coop_Admins(2);
         
            $region_array= $this->national_administrator_model->Regions(2);
            $region_admins= $this->national_administrator_model->Region_Admins(2);
        
            $data['view_data']= array(
                'coop_array'=>$coop_array,
                'coop_admins'=> $coop_admins,
                'region_array'=>$region_array,
                'region_admins'=> $region_admins);
        }
        else if($this->session->userdata('user_type')=='coop')
        {
            $coop_array= $this->national_administrator_model->Coops(3);
            $coop_admins= $this->national_administrator_model->Coop_Admins(3);
         
            $data['view_data']= array(
                'coop_array'=>$coop_array,
                'coop_admins'=> $coop_admins);
        }
        $data['bodycontent']='administrator_logins/national_administrator_view';
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
        $level="";
        if($this->input->post('division_id'))
        {
            $id= $this->input->post('division_id');
            $level='division';
        }
        if($this->input->post('region_id'))
        {
            $id= $this->input->post('region_id');
            $level='region';
        }
        if($this->input->post('coop_id'))
        {
            $id= $this->input->post('coop_id');
            $level='coop';
        }
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
                        
                        $adminID= $this->users->new_admin($username,$password,$firstname,$lastname,$email,$level, 0);
                       
                        if($adminID!=FALSE)
                        {
                            if($level=='division')
                            {
                                $permission_id = $this->permissions->add_division_permission($adminID, $id);
                            }
                            if($level=='region')
                            {
                                $permission_id = $this->permissions->add_region_permission($adminID, $id);
                            }
                            if($level=='coop')
                            {
                                $permission_id = $this->permissions->add_coop_permission($adminID, $id);
                            }
                                     
                            
                            $this->tools->reload_page('administrator_logins/national_administrator');
                        }
                        else
                        {
                           $this->alerts->save_unsuccessfull_alert();
                        }
                    }
                }
            }
        }
   
    }
    
    function delete_admin()
   {
        $level="";
        if($this->input->post('division_id'))
        {
            $id= $this->input->post('division_id');
            $level='division';
        }
        if($this->input->post('region_id'))
        {
            $id= $this->input->post('region_id');
            $level='region';
        }
        if($this->input->post('coop_id'))
        {
            $id= $this->input->post('coop_id');
            $level='coop';
        }
        $permissions= $this->permissions->permissions_for_admin($this->input->post('adminid'));
        $row_count= count($permissions);
        $deleted_count=0;
        foreach($permissions as $row)
        {
            if($row->correlation_id==$id && $row->correlation_type==$level)
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
            $this->alerts->save_unsuccessfull_alert();
        }
        
   }
    
    
}

?>
