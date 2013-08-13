<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions {
    
    public function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->library('session');
    }

    
    
   //GET FUNCTIONS 
    /*
     * functions return boolean, does user have access to an overall functionality within HQ.
     * EX: does the user have any lsm item
    */
    
    
    function permissions_for_admin($id)//returns permission id and parent of all fields accociated to adminid perameter.
    {
        
        $query= $this->ci->db->query("SELECT * FROM permissions_hierarchy
                                    WHERE adminid=$id");
        return $query->result();
    }
    
    
    /*
     * functions return organization id if admin have operator level access to organization, false is otherwise.
    */
    function operator_level_admin($id)
    {
        $query= $this->ci->db->query("SELECT correlation_id FROM permissions_hierarchy
                                    WHERE adminid=$id AND correlation_type = 'organization' AND parent_id IS NULL");
        if ($query->num_rows() > 0)
        {
            $row=$query->row();
            return $row->correlation_id;
        }
        else
        {
            return false;
        }
             
    }
    
    /*
     * Get permissionid where adminid has permissions for certain restaurant, returns false if permission doesnt exist  
     */
    function permissionid_for_admin_restaurant($adminid, $restaurantid)
    {
        $query= $this->ci->db->query("SELECT permissions_id FROM permissions_hierarchy
                                    WHERE adminid=$adminid AND correlation_type = 'restaurant' AND correlation_id=$restaurantid");
        if ($query->num_rows() > 0)
        {
            $row=$query->row();
            return $row->permissions_id;
        }
        else
        {
            return false;
        }
    }
    
    
    
    //does user have access to create any lsm content
    public function lsm()
    {
        $string="SELECT mcteachers_night, donation_request, grand_opening, calendar_of_events, tours, orange_bowl, power_bowl, birthday_party_to_go, birthday_party_reservation, brand_trust FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->mcteachers_night)
           {
               $result=TRUE;
               break;
           }
           if($row->donation_request)
           {
               $result=TRUE;
               break;
           }
           if($row->grand_opening)
           {
               $result=TRUE;
               break;
           }
           if($row->calendar_of_events)
           {
               $result=TRUE;
               break;
           }
           if($row->orange_bowl)
           {
               $result=TRUE;
               break;
           }
           if($row->power_bowl)
           {
               $result=TRUE;
               break;
           }
           if($row->birthday_party_to_go)
           {
               $result=TRUE;
               break;
           }
           if($row->birthday_party_reservation)
           {
               $result=TRUE;
               break;
           }
           if($row->brand_trust)
           {
               $result=TRUE;
               break;
           }
           if($row->tours)
           {
               $result=TRUE;
               break;
           }
           
           $i++;
       }
       return $result;
    }
    
	//does user have access to create any hr content
    public function hr()
    {
        
        
        $string="SELECT jobs_crew, jobs_mgmt, benefits, application_settings, ray_kroc, hiring_day FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->jobs_crew || $row->jobs_mgmt)
           {
               $result=TRUE;
               break;
           }
           else if($row->benefits)
           {
               $result=TRUE;
               break;
           }
           else if($row->application_settings)
           {
               $result=TRUE;
               break;
           }
           else if($row->ray_kroc)
           {
               $result=TRUE;
               break;
           }
           else if($row->hiring_day)
           {
               $result=TRUE;
               break;
           }
           
           $i++;
       }
       return $result;
    }
    
 
   /* public function restaurants_with_settings_permissions()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE restaurant_settings=1 AND adminid= ".$this->ci->session->userdata('adminid');
        $query=$this->ci->db->query($string);
        foreach ($query->result() as $row)
        {
            
        }
    }*/

/*start of specific permission functions.
 * EX: does user have permission to edit calendar of events
 */

    //does user have access to create custom content
    public function custom_content()
    {
      $string="SELECT content FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);
           if($row->content)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    /*lsm permission functions
     * mcteachers_night, donation_request, grand_opening, calendar_of_events,
     * tours, orange_bowl, power_bowl, birthday_party_to_go, birthday_party_reservation,
     * brand_trust
     */ 
    
    public function mcteachers_night()
    {
     $string="SELECT mcteachers_night FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->mcteachers_night)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function donation_request()
    {
     $string="SELECT donation_request FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->donation_request)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function grand_opening()
    {
     $string="SELECT grand_opening FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->grand_opening)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function calendar_of_events()
    {
     $string="SELECT calendar_of_events FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->calendar_of_events)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }

    public function orange_bowl()
    {
     $string="SELECT orange_bowl FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->orange_bowl)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function tours()
    {
     $string="SELECT tours FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->tours)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    
    public function power_bowl()
    {
     $string="SELECT orange_bowl FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->orange_bowl)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function birthday_party_to_go()
    {
     $string="SELECT birthday_party_to_go FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->birthday_party_to_go)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function birthday_party_reservation()
    {
     $string="SELECT birthday_party_reservation FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->birthday_party_reservation)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    public function brand_trust()
    {
     $string="SELECT brand_trust FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->brand_trust)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
   /*start of HR permission functions
    * jobs, benefits, application_settings, ray_kroc, hiring_day
    */ 
    
     public function jobs()
    {
     $string="SELECT jobs_crew,jobs_mgmt FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->jobs_crew || $row->jobs_mgmt)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
     public function benefits()
    {
     $string="SELECT benefits FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->benefits)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
     public function application_settings()
    {
     $string="SELECT application_settings FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->application_settings)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
     public function ray_kroc()
    {
     $string="SELECT ray_kroc FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->ray_kroc)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
     public function hiring_day()
    {
     $string="SELECT hiring_day FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->hiring_day)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    /* start of My Restaurants Pemissions
     * Settings, Hours, Services, QR Codes
     */
    
    public function restaurant_settings()
    {
        $string="SELECT restaurant_settings FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->restaurant_settings)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    public function hours()
    {
        $string="SELECT hours FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->hours)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    public function services()
    {
        $string="SELECT services FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->services)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    public function qr_codes()
    {
        $string="SELECT qr_codes FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->qr_codes)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    public function login_permissions()
    {
        $string="SELECT login_permissions FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->login_permissions)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;
    }
    
    public function banners()
    {
     $string="SELECT banners FROM permissions_hierarchy WHERE adminid = ".$this->ci->session->userdata('adminid');
       $query=$this->ci->db->query($string);
       $i=0;
       $result=FALSE;
       while($i<$query->num_rows())
       {
           $row= $query->row($i);

           if($row->banners)
           {
               $result=TRUE;
               break;
           }
           $i++;
       }
       return $result;   
    }
    
    
    /*
     * 
     * Alter and Update permissions tables
     * 
     */
    
    //adds record to database connecting adminid to organization id
    // ***********THIS DOES NOT AND ANY LSM, HR, OR OPERATIONS PERMISSIONS******************
    //returns new permission_id if successfull
    
	//creates new connection between new administrator and the organization that created them. 
    function add_admin_to_parent($adminid, $parent_type, $parent_id)
    {
        $query= $this->ci->db->query("INSERT INTO parent_connections (adminid, parent_type, parent_id) VALUES ('$adminid','$parent_type','$parent_id')");
        return $query;
    }
    
	//creates new restaurant permission for administrator 
    function add_restaurant_permission($adminid, $restaurantid,$parent_type, $parent_id)
    {
        $querystring="INSERT INTO permissions_hierarchy SET adminid = $adminid, parent_type= '$parent_type', parent_id=$parent_id,
          correlation_type= 'restaurant', correlation_id= $restaurantid";
        $query= $this->ci->db->query($querystring);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
    function add_organization_permission($adminid, $organizationid)
    {
       $querystring="INSERT INTO permissions_hierarchy SET adminid = $adminid, 
           correlation_type= 'organization', correlation_id= $organizationid";
        $query= $this->ci->db->query($querystring);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        }
        
    }
    
    function add_coop_permission($adminid, $coopid)
    {
       $querystring="INSERT INTO permissions_hierarchy SET adminid = $adminid, 
           correlation_type= 'coop', correlation_id= $coopid";
        $query= $this->ci->db->query($querystring);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        } 
    }
    
    function add_region_permission($adminid, $regionid)
    {
       $querystring="INSERT INTO permissions_hierarchy SET adminid = $adminid, 
           correlation_type= 'region', correlation_id= $regionid";
        $query= $this->ci->db->query($querystring);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        } 
    }
    
    function add_division_permission($adminid, $divisionid)
    {
       $querystring="INSERT INTO permissions_hierarchy SET adminid = $adminid, 
           correlation_type= 'division', correlation_id= $divisionid";
        $query= $this->ci->db->query($querystring);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        } 
    }
    
    function add_lsm_permissions($permissions_id)
    {
       $myquery = "UPDATE permissions_hierarchy SET content = 1, mcteachers_night = 1, donation_request = 1, 
            grand_opening = 1, calendar_of_events = 1, tours = 1, orange_bowl = 1, power_bowl = 1, 
            birthday_party_to_go = 1, birthday_party_reservation = 1, brand_trust = 1 
            WHERE permissions_id = $permissions_id";
        $query=  $this->ci->db->query($myquery);
        return $query;
    }
    
    function add_hr_permissions($permissions_id)
    {
        $myquery = "UPDATE permissions_hierarchy SET jobs_crew = 1, jobs_mgmt=1, benefits = 1, 
            application_settings = 1, ray_kroc = 1, hiring_day = 1
            WHERE permissions_id = $permissions_id";
        $query=  $this->ci->db->query($myquery);
        return $query;
        
    }
    
    function add_ro_permissions($permissions_id)
    {
        $myquery = "UPDATE permissions_hierarchy SET restaurant_settings = 1, hours = 1, services = 1
            WHERE permissions_id = $permissions_id";
        $query=  $this->ci->db->query($myquery);
        return $query;
    }
    
    function update_permission($permissionid, $field, $value)
    {
        
        $myquery = "UPDATE permissions_hierarchy SET `$field` = $value WHERE permissions_id = $permissionid";
        $query=  $this->ci->db->query($myquery);
        return $query;
    }
    
     function delete_permissions_row($permission_id)
    {
        $this->ci->db->delete('permissions_hierarchy', array('permissions_id' => $permission_id));
    }
    
    function delete_parent_connection($adminid,$parentid,$parent_type)
    {
        $this->ci->db->delete('parent_connections', array('adminid' => $adminid,'parent_type'=>$parent_type, 'parent_id'=>$parentid));
    }
    
    
}


?>
