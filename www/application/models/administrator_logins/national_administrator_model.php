<?php

class National_Administrator_model extends CI_Model {

    //$level 0=national level, 1=divisional level, 2=regional level, 3=coop level
    function Divisions($level)
    {
        if($level==0)
        {
            $query_string="SELECT * FROM Divisions WHERE DivisionID >1";
        }
        else//level==1
        {
            $query_string="SELECT d.* FROM Divisions d, permissions_hierarchy p WHERE d.DivisionID= p.correlation_id AND p.correlation_type = 'division' AND p.adminid = ".$this->session->userdata('adminid');
        }        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function Regions($level)
    {
        if($level==0)
        {
            $query_string="SELECT r.*, d.Name as division FROM Regions r, Divisions d WHERE r.DivisionID= d.DivisionID ORDER BY r.DivisionID, r.Name";
        }
        else if($level==1)
        {
            $query_string="SELECT r.*, d.Name as division FROM Regions r, Divisions d WHERE r.DivisionID= d.DivisionID 
                AND r.RegionID IN (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")
                ORDER BY r.DivisionID, r.Name";
        }
        else //level==2
        {
            $query_string="SELECT r.*, d.Name as division FROM Regions r, Divisions d, permissions_hierarchy p WHERE r.DivisionID=d.DivisionID AND r.RegionID= p.correlation_id AND p.correlation_type = 'region' AND p.adminid = ".$this->session->userdata('adminid');
        }
         $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function Coops($level)
    {
        if($level==0)
        {
            $query_string="SELECT c.*, r.Name as region FROM Coops c, Regions r WHERE c.CoopID!=9999999 AND c.RegionID= r.RegionID ORDER BY c.RegionID, c.Name";
        }
        else if($level==1)
        {
            $query_string="SELECT DISTINCT c.*, r.Name as region FROM Coops c, Regions r WHERE c.CoopID!=9999999 AND c.RegionID= r.RegionID 
                AND c.RegionID IN (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")
                ORDER BY c.RegionID, c.Name";
        }
        else if($level==2)
        {
            $query_string="SELECT DISTINCT c.*, r.Name as region FROM Coops c, Regions r WHERE c.CoopID!=9999999 AND c.RegionID= r.RegionID 
                AND c.RegionID IN (SELECT correlation_id FROM permissions_hierarchy WHERE correlation_type = 'region' AND adminid = ".$this->session->userdata('adminid').")
                ORDER BY c.RegionID, c.Name";
        }
        else //$level==3 
        {
            $query_string="SELECT c.*, r.Name as region FROM Coops c, Regions r WHERE c.RegionID= r.RegionID 
                AND c.CoopID IN (SELECT correlation_id FROM permissions_hierarchy WHERE correlation_type = 'coop' AND adminid = ".$this->session->userdata('adminid').")
                ORDER BY c.RegionID, c.Name";
        }
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function Division_Admins($level)
    {
        if($level==0)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                FROM permissions_hierarchy p, users u, Divisions d
                WHERE p.correlation_type LIKE 'division' 
                AND p.correlation_id = d.DivisionID
                AND p.adminid= u.adminid AND u.user_type = 'division'";
        }
        else //$level==1
        {
             $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                FROM permissions_hierarchy p, users u, Divisions d
                WHERE p.correlation_type LIKE 'division' 
                AND p.correlation_id = d.DivisionID
                AND p.adminid= u.adminid AND u.user_type = 'division' 
                AND p.correlation_id IN (SELECT correlation_id FROM permissions_hierarchy WHERE correlation_type = 'division' AND adminid = ".$this->session->userdata('adminid').")";
        }
        $query=$this->db->query($query_string);
        
        return $query->result();
    }
    
    function Region_Admins($level)
    {
        if($level==0)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Regions r
                    WHERE p.correlation_type LIKE 'region' 
                    AND p.correlation_id = r.RegionID
                    AND p.adminid= u.adminid AND u.user_type = 'region'";
        }
        else if($level==1)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Regions r
                    WHERE p.correlation_type LIKE 'region' 
                    AND p.correlation_id = r.RegionID
                    AND p.adminid= u.adminid AND u.user_type = 'region'
                    AND p.correlation_id IN (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")";
        } 
        else //level==2
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Regions r
                    WHERE p.correlation_type LIKE 'region' 
                    AND p.correlation_id = r.RegionID
                    AND p.adminid= u.adminid AND u.user_type = 'region'
                    AND p.correlation_id IN (SELECT correlation_id FROM permissions_hierarchy WHERE correlation_type = 'region' AND adminid = ".$this->session->userdata('adminid').")";
        }
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    
    function Coop_Admins($level)
    {
        if($level==0)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Coops c
                    WHERE p.correlation_type LIKE 'coop' 
                    AND p.correlation_id = c.CoopID
                    AND p.adminid= u.adminid AND u.user_type = 'coop'";
        }
        else if($level==1)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Coops c
                    WHERE p.correlation_type LIKE 'coop' 
                    AND p.correlation_id = c.CoopID
                    AND p.adminid= u.adminid AND u.user_type = 'coop'
                    AND p.correlation_id IN (SELECT CoopID FROM Coops WHERE RegionID IN (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid')."))";
        }
        else if($level==2)
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Coops c
                    WHERE p.correlation_type LIKE 'coop' 
                    AND p.correlation_id = c.CoopID
                    AND p.adminid= u.adminid AND u.user_type = 'coop'
                    AND p.correlation_id IN (SELECT c.CoopID FROM Coops c, permissions_hierarchy p WHERE c.RegionID= p.correlation_id AND p.correlation_type LIKE 'region' AND p.adminid = ".$this->session->userdata('adminid').")";
        }
        else //level==3
        {
            $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                    FROM permissions_hierarchy p, users u, Coops c
                    WHERE p.correlation_type LIKE 'coop' 
                    AND p.correlation_id = c.CoopID
                    AND p.adminid= u.adminid AND u.user_type = 'coop'
                    AND p.correlation_id IN (SELECT correlation_id FROM permissions_hierarchy WHERE correlation_type = 'coop' AND adminid = ".$this->session->userdata('adminid').")";
        }
           
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    
}

?>
