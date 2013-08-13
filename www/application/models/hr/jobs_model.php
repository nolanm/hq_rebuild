<?php

class Jobs_Model extends CI_Model {

    function get()
    {
        /*$query_string="SELECT correlation_id as restaurantid FROM permissions_hierarchy WHERE adminid= ".$this->session->userdata('adminid')." AND jobs=1 AND correlation_type = 'restaurant'";
        $query=$this->db->query($query_string);
        return $query->result();*/
        
       /* $query=$this->db->query("SELECT * FROM jobs");
        foreach($query->result() as $job)
        {
            if($job->created_by==0)
            {
            
                if(!empty($job->ownerID))
                {
                    print_r("ownerID");
                    $string="UPDATE jobs SET created_by = (SELECT adminid FROM users WHERE ownerid = ".$job->ownerID." LIMIT 1) WHERE id= ".$job->id;
                     $query=$this->db->query($string);
                }
                else
                {
                    print_r("coopID");
                    $string="UPDATE jobs SET created_by = (SELECT adminid FROM users WHERE coopid = ".$job->coopid." LIMIT 1) WHERE id= ".$job->id;
                     $query=$this->db->query($string);
                }
            }
            print_r("<br/><br/>");
        }*/
    }
    
    /*
     * this function is only called if the current admin is an operator
     * returns jobs and the user's first and last name of who created job.
     * returns jobs created by other owners in the enterprise and jobs created by restaurant level admins who have "job" permissions for restaurants within the enterprise.
     */
    function get_extra_jobs_for_owner($ownerid)
    {   
         $query_string="SELECT j.*, u.firstname, u.lastname
                        FROM jobs j
                        JOIN permissions_hierarchy p ON p.adminid = j.created_by
                        JOIN Owners o ON o.OwnerID = p.correlation_id
                        JOIN users u ON j.created_by= u.adminid
                        WHERE p.correlation_type='organization' 
                        AND o.EnterpriseID IN (SELECT EnterpriseID FROM Owners WHERE OwnerID = $ownerid) 
                        AND j.created_by <> ".$this->session->userdata('adminid')."
                            UNION 
                        SELECT DISTINCT j.*, u.firstname, u.lastname
                        FROM jobs j 
                        JOIN job_assignments a ON j.id= a.id 
                        JOIN users u ON j.created_by= u.adminid
                        WHERE j.created_by <>".$this->session->userdata('adminid')." AND a.restaurantid IN 
                        (SELECT RestaurantID FROM Restaurants WHERE OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID = (SELECT EnterpriseID FROM Owners WHERE OwnerID = $ownerid)))";
                        
         $query=$this->db->query($query_string);
         return $query->result();
    }
    
    
    /*
     * this function will return jobs created by restaurant level admins who have "job" permissions for the same restaurants that the owner has restaurant level permissions for.
     */
    function get_extra_jobs_for_admin()
    {
        /*$query_string="SELECT DISTINCT j.*, u.firstname, u.lastname
                        FROM jobs j 
                        JOIN job_assignments a ON j.id= a.id 
                        JOIN users u ON j.created_by= u.adminid
                        WHERE j.created_by <>".$this->session->userdata('adminid')." AND a.restaurantid IN 
                        (SELECT correlation_id FROM permissions_hierarchy WHERE adminid=".$this->session->userdata('adminid')." AND (jobs_crew=1 OR jobs_mgmt=1) AND correlation_type= 'restaurant') ORDER BY j.id";*/
        $query_string="SELECT DISTINCT j.*, u.firstname, u.lastname
                        FROM jobs j 
                        JOIN job_assignments a ON j.id= a.id 
                        JOIN users u ON j.created_by= u.adminid
JOIN permissions_hierarchy p ON p.correlation_id = a.restaurantid 
                        WHERE j.created_by <>".$this->session->userdata('adminid')." AND p.adminid=".$this->session->userdata('adminid')." AND (p.jobs_crew=1 OR p.jobs_mgmt=1) AND p.correlation_type= 'restaurant' ORDER BY j.id";
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    /*
     * function will return jobs this admin has created within their HQ. 
     */
    function get_jobs_for_admin()
    {
        $query_string="SELECT j.*, u.firstname, u.lastname
                        FROM jobs j
                        JOIN users u ON j.created_by= u.adminid
                        WHERE j.created_by= ".$this->session->userdata('adminid');
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    
    /*
     * 
     */
    function get_restaurant_assignments_for_job($jobID)
    {
        $query_string="SELECT restaurantid
                        FROM job_assignments
                        WHERE id=$jobID"; 
         
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    /*
     * Returns all restaurants that admin has permission for crew jobs. 
     */
    function get_restaurants_for_crew_jobs()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE jobs_crew=1 AND adminid= "
                    .$this->session->userdata('adminid')." ORDER BY correlation_type, correlation_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT RestaurantID, UnitName FROM Restaurants
                    WHERE RestaurantID = $row->correlation_id AND activated = 1";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT RestaurantID, UnitName FROM Restaurants
                    WHERE OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) AND activated = 1 ORDER BY RestaurantID";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    /*
     * Returns all restaurants that admin has permission for management jobs. 
     */
    function get_restaurants_for_mgmt_jobs()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE jobs_mgmt=1 AND adminid= "
                    .$this->session->userdata('adminid')." ORDER BY correlation_type, correlation_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT RestaurantID, UnitName FROM Restaurants
                    WHERE RestaurantID = $row->correlation_id AND activated = 1";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT RestaurantID, UnitName FROM Restaurants
                    WHERE OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) AND activated = 1 ORDER BY RestaurantID";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    /*
     * creates new job with information passed from the form in view. 
     * Returns new job_id if successful, false is not successful
     */
    function create_job()
    {
        
        $insertquery = "INSERT INTO jobs (Title, Hours, PayRange, Type, Description, Benefits, distribution_list, auto, created_by, edit_job) 
                        VALUES ('".addslashes($this->input->post('title'))."', '".addslashes($this->input->post('hours')).
                        "', '".addslashes($this->input->post('payrange'))."', "; 
     
        if($this->input->post('type'))
        {
            $insertquery= $insertquery.$this->input->post('type');
        }
        else
        {
            $insertquery= $insertquery.'0';
        }
        
        $insertquery= $insertquery.", '".addslashes($this->input->post('description'))."', '".addslashes($this->input->post('benefits'))."',";
        
        if($this->input->post('distribution') && $this->input->post('distribution')!='None')
        {
            $insertquery= $insertquery.$this->input->post('distribution');
        }
        else
        {
            $insertquery= $insertquery.'NULL';
        }
        
        $insertquery= $insertquery." , 0, ".$this->session->userdata('adminid').", ".$this->input->post('edit_job').")";
        $query=  $this->db->query($insertquery);
        if($query)
        {
            return $this->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
    
    function update_job($id)
    {
        $jobsql = "UPDATE jobs SET Title = '".mysql_real_escape_string($this->input->post('title'))."', Hours = '".mysql_real_escape_string($this->input->post('hours'))."', PayRange = '".mysql_real_escape_string($this->input->post('payrange'))."',
                    edit_job=".$this->input->post('edit_job').", Type = ";
        
        if($this->input->post('type'))
        {
            $jobsql= $jobsql.$this->input->post('type');
        }
        else
        {
            $jobsql= $jobsql.'0';
        }
        
        $jobsql= $jobsql.", Description = '".mysql_real_escape_string($this->input->post('description'))."', Benefits = '".mysql_real_escape_string($this->input->post('benefits'))."', distribution_list= ";
        
        if($this->input->post('distribution') && $this->input->post('distribution')!='None')
        {
            $jobsql= $jobsql.$this->input->post('distribution');
        }
        else
        {
            $jobsql= $jobsql.'NULL';
        }
        
        $jobsql=$jobsql.",auto = 0 WHERE id = $id";
        $query= $this->db->query($jobsql);
        return $query;
    }
    
    
    function assign_job_to_restaurant($jobid, $restaurantid)
    {
       $data = array(
            'id' => $jobid ,
            'restaurantid' => $restaurantid
           ); 
       $this->db->insert('job_assignments', $data); 
    }
    
    function delete_job($id)
    {
        $this->db->delete('jobs', array('id' => $id)); 
    }
    
    function delete_crew_job_assignments($id)
    {
        $restaurants= $this->get_restaurants_for_crew_jobs();
        foreach($restaurants as $row)
        {
            $data= array('id' => $id, 'restaurantid'=> $row->RestaurantID);
            $this->db->delete('job_assignments',$data);  
        }
    }
    
    function delete_mgmt_job_assignments($id)
    {
        $restaurants= $this->get_restaurants_for_mgmt_jobs();
        foreach($restaurants as $row)
        {
            $data= array('id' => $id, 'restaurantid'=> $row->RestaurantID);
            $this->db->delete('job_assignments',$data);  
        }
    }
    
    function delete_job_assignment_for_restaurant($id,$restaurantid)
    {
        // delete assignments
        $data= array('id' => $id, 'restaurantid'=> $restaurantid);
        $this->db->delete('job_assignments',$data);  
    }
}

?>
