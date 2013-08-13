<?php

class Administrator extends CI_Controller {

    public $sorter;
    
    function Administrator()
    {
        parent::__construct();
        $this->load->library('users');
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->helper('url');
        
        $this->load->model('administrator_logins/administrator_model');

        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
   
   function index()
    {
        if(empty($this->sorter))
        {
            $this->sorter='admin';
        }
        //start recieving all of initial view data
        $permissions_query= $this->administrator_model->users_administrators_permissions($this->sorter); //returns all administrators created by operaor, and permissions those administrators have for the restaurants owned by the operator
        $restaurants_query= $this->administrator_model->owners_restaurants();// returs array of restaurant owned by the operator
        $admins_query= $this->administrator_model->users_admins();//returns array of admins created by operator
        $enterprise_admins= $this->administrator_model->enterprise_operator_admins();// returns other owners within the enterprise
        $pending_admin_requests= $this->tools->get_requests_by_parent($this->session->userdata('user_type'), $this->administrator_model->parent_id());//returns any pending administrator requests
        $data['view_data']= array(
            'permissions_array'=>$permissions_query,
            'restaurants_array'=> $restaurants_query,
            'admin_array'=> $admins_query,
            'enterprise_admins'=>$enterprise_admins,
            'pending_requests'=>$pending_admin_requests,
            'sort_by'=>  $this->sorter
            );
        $data['bodycontent']='administrator_logins/administrator_view';
        $this->load->view('template',$data);
        
    }
    
    
    function sort_by_admin()
    {
        $this->sorter='admin';
        $this->index();
    }
    
    function sort_by_restaurant()
    {
        $this->sorter='restaurant';
        $this->index();
    }
    
    function sort_by_function()
    {
        $this->sorter='function';
        $this->index();
    }

    /*
     * operator updated a permission of an administrator(clicked or unclicked checkbox for a certain function of a certain restaurant)
     * sends new permission data to model to change in DB.
     */
    function update_permission()
    {
        
        $var = explode("-", $this->input->post('field_name'));
        
        $result= $this->permissions->update_permission($var[1],$var[0],$this->input->post('value'));
    }
   
    //operator updated administrators login info.
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
                        $this->alerts->save_unsuccessfull_alert();
                    }
                }
            }
        }
    }
    
    /*
     * operator looking for existing administrator.
     * function returns administrators found.
     */
    function admin_search()
    {
        if(!($this->input->post('username')== "" &&
        $this->input->post('firstname')== "" &&
        $this->input->post('lastname')== ""))
        {
            $html_result="";
            $admin= $this->administrator_model->search_admins();
            if($admin && ($this->session->userdata('mcopco')== $admin->mcopco))
            {
                $html_result.='<input type="hidden" id="existing_adminid" value="'.$admin->adminid.'">';
                $html_result.='<table class="table table-condensed">';
                $html_result.='<thead>';
                $html_result.='<th>AdminID</th>';
                $html_result.='<th>First Name</th>';
                $html_result.='<th>Last Name</th>';
                $html_result.='<th>Username</th>';
                $html_result.='<th>Email</th>';
                $html_result.='</thead>';
                $html_result.="<tr>";
                $html_result.="<td>".$admin->adminid."</td>";
                $html_result.="<td>".$admin->firstname."</td>";
                $html_result.="<td>".$admin->lastname."</td>";
                $html_result.="<td>".$admin->username."</td>";
                $html_result.="<td>".$admin->email."</td>";
                $html_result.="</tr>";
                $html_result.="</table>";
            }
            print $html_result;
        }
    }
    
    
    /*
     * function called when operator adds restaurant permissions to administrator
     */
    function add_restaurants_to_admin()
    {
        
        
        if($this->input->post('all'))//is the admin getting access to all owners restaurants
        { 
            $newArray=array();
            $restaurants= $this->administrator_model->owners_restaurants();
            /*
             * change array so its filled with only restaurantid, instead of objects with restaurantids and unitnames
             */
            foreach($restaurants as $row)
            {
                array_push($newArray, $row->RestaurantID);
            }
            $result= $this->administrator_model->add_restaurants_to_admin($newArray,$this->input->post('adminid'));
        }
        else
        {
            $result= $this->administrator_model->add_restaurants_to_admin($this->input->post('restaurants'),$this->input->post('adminid'));
        }
        $this->index();
    }
    
    
    /*
     * Function is call after operator fills out form to create new administrator.
     * returns html to the javacript function 'add_new_admin()', which is the function that called this function and sent the post data.
     * returning html is either various error messages based on the form incorrectely filled or a database error. 
     */
    function add_new_admin()
    {
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
                if(strcmp($password, $password2)!=0)// does password confirmation match?
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
                    else //all validations have been checked and we are ready to creat new admin.
                    {
                        //create new user and return new adminid.
                        $new_admin_id= $this->users->new_admin($username,$password,$firstname,$lastname,$email,$this->session->userdata('user_type'),$this->session->userdata('mcopco'));
                        
                        if($new_admin_id!=FALSE)
                        {
                            
                            //add the connection between the new admin and the parent (owner) that created them. 
                            $this->permissions->add_admin_to_parent($new_admin_id, $this->session->userdata('user_type'),$this->administrator_model->parent_id());
                            
                            if($this->input->post('all_permissions')) //is new admin getting all permissions (Total Operational Permissions)?
                            {
                                 $restaurants= $this->administrator_model->owners_restaurants();
                                 foreach($restaurants as $row)
                                 {
                                     $permission_id=$this->permissions->add_restaurant_permission($new_admin_id, $row->RestaurantID,$this->session->userdata('user_type'),$this->administrator_model->parent_id());
                                     $this->permissions->add_lsm_permissions($permission_id);
                                     $this->permissions->add_hr_permissions($permission_id);
                                     $this->permissions->add_ro_permissions($permission_id);
                                 }
                                 
                            }
                            else// 'Total Operational Permissions' checkbox was not checked. 
                            {
                               if($this->input->post('hr_checkbox'))//is hr checkbox checked?
                               {
                                   foreach($this->input->post('hr_restaurants') as $hr_restaurant)
                                   {
                                        $permission_id=$this->permissions->permissionid_for_admin_restaurant($new_admin_id, $hr_restaurant);
                                       if($permission_id)//if permission exits between new admin and restaurant
                                       {
                                           $this->permissions->add_hr_permissions($permission_id);//turn on hr permissions for permission_id.
                                       }
                                       else// permission didnt exist
                                       {
                                           $permission_id= $this->permissions->add_restaurant_permission($new_admin_id,$hr_restaurant,$this->session->userdata('user_type'),$this->administrator_model->parent_id());//create permission between adminid and restaurant
                                           $this->permissions->add_hr_permissions($permission_id);//turn on hr permissions for permission_id.
                                       }
                                   }
                               }
                               if($this->input->post('lsm_checkbox'))//is lsm checkbox checked?
                               {
                                   foreach($this->input->post('lsm_restaurants') as $lsm_restaurant)
                                   {
                                       $permission_id=$this->permissions->permissionid_for_admin_restaurant($new_admin_id, $lsm_restaurant);
                                       if($permission_id)//if permission exits between new admin and restaurant
                                       {
                                           $this->permissions->add_lsm_permissions($permission_id);//turn on lsm permissions for permission_id.
                                       }
                                       else// permission didnt exist
                                       {
                                           $permission_id= $this->permissions->add_restaurant_permission($new_admin_id,$lsm_restaurant,$this->session->userdata('user_type'),$this->administrator_model->parent_id());//create permission between adminid and restaurant
                                           $this->permissions->add_lsm_permissions($permission_id);//turn on lsm permissions for permission_id.
                                       }
                                   }
                               }
                               if($this->input->post('ro_checkbox'))//is restaurant operations checkbox checked?
                               {
                                   foreach($this->input->post('ro_restaurants') as $ro_restaurant)
                                   {
                                       $permission_id=$this->permissions->permissionid_for_admin_restaurant($new_admin_id, $ro_restaurant);
                                       if($permission_id)//if permission exits between new admin and restaurant
                                       {
                                           $this->permissions->add_ro_permissions($permission_id);//turn on restaurant operations permissions for permission_id.
                                       }
                                       else// permission didnt exist
                                       {
                                           $permission_id= $this->permissions->add_restaurant_permission($new_admin_id,$ro_restaurant,$this->session->userdata('user_type'),$this->administrator_model->parent_id());//create permission between adminid and restaurant
                                           $this->permissions->add_ro_permissions($permission_id);//turn on restaurant operations permissions for permission_id.
                                       }
                                   }
                               }
                            }
                            $this->tools->reload_page('administrator_logins/administrator');
                            
                        }
                        else // There was an error is creating new admin even though the form was filled out correctly.
                        {
                            $this->alerts->save_unsuccessfull_alert();
                        }
                    }
                }
            }
        }
    }
    
    
    /*
     * function is called when operator wants to give permissions to an administrator they didn't create that already exists in the system.
     * function will store permission data in DB so operator will not have to sign in after administrator accepts or denies request.
     * Administrator will recieve email, notifying them of the oporators request.
     */
    function add_request()
    {
        $adminid=$this->input->post('adminid');
        $hr_checkbox=$this->input->post('hr_checkbox');
        $lsm_checkbox=$this->input->post('lsm_checkbox');
        $ro_checkbox=$this->input->post('ro_checkbox');
        
        $request_id=$this->tools->insert_request($adminid,$this->session->userdata('user_type'),$this->administrator_model->parent_id(),$this->session->userdata('adminid'));
        if($request_id)
        {   
            //If there are any permissions for the pending request, this next if/else statement will add all the permissions the operator set. 
            if($this->input->post('all_permissions')) //is new admin getting all permissions (Total Operational Permissions)?
            {   
                //Add hr,lsm, and restuarant operation permissions for all restaurants to the pending_request_permissions table.
                $restaurants= $this->administrator_model->owners_restaurants();
                foreach($restaurants as $row)
                {
                    $this->tools->insert_request_permission($request_id,$row->RestaurantID,1,1,1);
                }

            }
            else// 'Total Operational Permissions' checkbox was not checked. 
            {
               if($hr_checkbox || $lsm_checkbox || $ro_checkbox)
               {
                   //
                   $restaurants= $this->administrator_model->owners_restaurants();
                   foreach($restaurants as $row)
                   {
                        $hr=0;
                        $lsm=0;
                        $ro=0;
                        if($hr_checkbox && in_array($row->RestaurantID, $this->input->post('hr_restaurants')))
                        {
                           $hr=1; 
                        }
                        if($lsm_checkbox && in_array($row->RestaurantID, $this->input->post('lsn_restaurants')))
                        {
                            $lsm=1;
                        }
                        if($ro_checkbox && in_array($row->RestaurantID, $this->input->post('ro_restaurants')))
                        {
                            $ro=1;
                        }
                        
                        if($hr || $lsm || $ro)
                        {
                            $this->tools->insert_request_permission($request_id,$row->RestaurantID,$hr,$lsm,$ro);
                        }
                   }
               }
            }
            $user= $this->users->user_information($adminid);

            $email_body = "Hello ".$user->firstname." ".$user->lastname.". <br/><br/>".$this->session->userdata('name')." has requested that you have administrative permissions for their organization.<br/><br/>";
            $email_body .= "You can accept of deny this request by logging in to your account at http://hq.mcstate.com<br/><br/>";
            $email_body .= "McState.com Tech Support<br/>1-866-407-9472";

            if($this->tools->emailer($email_body,'McState.com HQ Administrator Request', $user->email))
            {
                $this->tools->reload_page('administrator_logins/national_administrator');
            }
            else
            {
                $this->alerts->email_error_alert();
            }
        }
        else
        {
            $this->alerts->pending_request_error_alert();
        }
        print $html;
    }
    

   /*
    * Deletes alladmin's permissions for the for the restaurants within the operators enterprise.
    * If admin is only connected to this operators enterprise, the admin will completely be deleted from the user table.
    * Else, they have a connection to another enterprise and he will remain in the database without permissions to this operators enterprise.
    */
   function delete_admin()
   {
       $permissions= $this->administrator_model->permission_ids_and_parents_for_admin($this->input->post('adminid'));
        $row_count= count($permissions);
        $parent_id= $this->administrator_model->parent_id();
        print_r($parent_id);
        $deleted_count=0;
        foreach($permissions as $row)
        {
            if($row->parent_id==$parent_id)
            {
                $this->permissions->delete_permissions_row($row->permissions_id);
                $deleted_count++;
            }
        }
        $this->permissions->delete_parent_connection($this->input->post('adminid'), $parent_id, $this->session->userdata('user_type'));
        if($deleted_count==$row_count)
        {
            $this->users->delete_administrator($row->adminid);
        }
        
   }
    
}
?>
