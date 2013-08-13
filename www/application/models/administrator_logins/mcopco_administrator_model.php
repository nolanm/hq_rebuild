<?php

class McOpCo_Administrator_model extends CI_Model {
    
    function McOpCo_Regions($national)
    {
        //returns list of McOpCo Region Operations and the data for each.
        
        $query_string="SELECT o.OwnerID, o.FirstName, o.LastName, r.RegionID, r.Name
            FROM Owners o, McOpCos m, Regions r WHERE m.RegionID= r.RegionID AND o.OwnerID= m.OwnerID";
        if(!$national)
        {
            $query_string.=" AND m.RegionID IN 
            (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")";
        }
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function McOpCo_Operator_Admins($national)
    {
        $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                FROM permissions_hierarchy p, users u, mcopcos m
                WHERE p.correlation_type LIKE 'organization' 
                AND p.correlation_id = m.OwnerID
                AND p.adminid= u.adminid";
        if(!$national)
        {
            $query_string.=" AND m.RegionID IN (SELECT r.RegionID FROM Regions r, permissions_hierarchy p WHERE r.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")";
        }
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function Divisions($national)
    {
       
        if($national)
        {
            $query_string="SELECT * FROM Divisions WHERE DivisionID >1";
        }
        else
        {
            $query_string="SELECT d.* FROM Divisions d, permissions_hierarchy p WHERE d.DivisionID= p.correlation_id AND p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid');
        }
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function McOpCo_Division_Admins($national)
    {
        $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email
                FROM permissions_hierarchy p, users u, Divisions d
                WHERE p.correlation_type LIKE 'division' 
                AND p.correlation_id = d.DivisionID
                AND p.adminid= u.adminid AND u.user_type LIKE 'division' AND mcopco=1";
        if(!$national)
        {
            $query_string.=" AND p.correlation_id IN (SELECT correlation_id FROM permissions_hierarchy WHERE p.correlation_type LIKE 'division' AND p.adminid = ".$this->session->userdata('adminid').")";
        }
        $query=$this->db->query($query_string);
        return $query->result();
    }
   
    
}

?>
