<?php

class Administrator_model extends CI_Model {
    
    //returns all permissions, for all admins that have been given restaurant permissions to the restaurants within the enterprise.
    function users_administrators_permissions($sort)
    {
        $sort_by="";
        if($sort=='admin')
        {
            $sort_by="p.parent_id, p.adminid, p.correlation_id";
        }
        if($sort=='restaurant')
        {
            $sort_by="p.parent_id, p.correlation_id, p.adminid";
        }
        if($sort=='function')
        {
            $sort_by="p.parent_id, p.adminid, p.correlation_id";
        }
        
        $parent_ids= implode(",", $this->enterprise_owners());
        //this function retrieves all the admins and their permissions that have access to the current operators restaurants 
        $query_string="SELECT p.*,u.adminid, u.username, u.firstname, u.lastname, u.email, r.RestaurantID, r.UnitName
                FROM permissions_hierarchy p, users u, Restaurants r
                WHERE p.parent_type LIKE '".$this->session->userdata('user_type')."' 
                AND p.parent_id IN ($parent_ids)
                AND p.adminid= u.adminid AND p.correlation_type LIKE 'restaurant' AND p.correlation_id= r.RestaurantID
                ORDER BY $sort_by";
       
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function owners_restaurants() //function retrieves all the current restaurants beloning to the owner's enterprise
    {
        $parent_ids= implode(",", $this->enterprise_owners());
        $query_string= "SELECT r.RestaurantID, r.UnitName, r.StoreName, o.FirstName, o.LastName, o.OwnerID
                    FROM Restaurants r, Owners o
                    WHERE r.OwnerID IN ($parent_ids) AND r.OwnerID= o.OwnerID 
                    ORDER BY r.RestaurantID";
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    //returns all admins who have been given restaurant permissions to any restaurant in the enterprise
    function users_admins()
    {
        $parent_ids= implode(",", $this->enterprise_owners()); 
        $query_string="SELECT u.adminid, u.username, u.firstname, u.lastname, u.email, o.FirstName, o.LastName, o.OwnerID
                FROM parent_connections p, users u, Owners o
                WHERE p.parent_type LIKE '".$this->session->userdata('user_type')."' 
                AND p.parent_id IN ($parent_ids)
                AND p.adminid= u.adminid
                AND p.parent_id= o.OwnerID 
                ORDER BY o.OwnerID";
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    /*
     * returns all the admins who have operator access within the enterprise
     */
    function enterprise_operator_admins()
    {
        $parent_ids= implode(",", $this->enterprise_owners()); 
        $query_string="SELECT u.adminid, u.username, u.firstname, u.lastname, u.email, o.FirstName, o.LastName, o.OwnerID
                FROM permissions_hierarchy p, users u, Owners o
                WHERE p.correlation_type LIKE '".$this->session->userdata('user_type')."' 
                AND p.correlation_id IN ($parent_ids)
                AND p.adminid= u.adminid
                AND p.correlation_id= o.OwnerID";
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    //search for admins within the user table, for a user that has the same name, adminid, and user_type as the paramaters given.
    function search_admins()
    {
        
        $query_string="SELECT adminid, username, firstname, lastname, email, mcopco
            FROM users 
            WHERE user_type = '".$this->session->userdata('user_type')."' 
            AND firstname ='".$this->input->post('firstname')."' 
            AND lastname = '".$this->input->post('lastname')."'
            AND username = '".$this->input->post('username')."'";
        $query=$this->db->query($query_string);
        return $query->row();
    }
    
    /*
     * This function will add restaurant permissions to the admin specified. 
     * The restaurant will have no permissions turned on.
     */
    function add_restaurants_to_admin($restaurants, $admin_to_add)
    {
        $parent_id= $this->parent_id();
        $querystring="SELECT correlation_id, parent_id FROM permissions_hierarchy WHERE adminid= ".$admin_to_add.
               " AND parent_id =$parent_id";
        $query=  $this->db->query($querystring);
        $restaurants_already_assigned= array();
       
        if($query->num_rows()!=0)
        {

             foreach ($query->result() as $row)
             {
                array_push($restaurants_already_assigned, $row->correlation_id);
             }
        }
       
        foreach($restaurants as $restaurant)
        {
            if(!in_array($restaurant, $restaurants_already_assigned))//does admin already have access to this restaurant
            {
                //add restaurant permission.
                $this->permissions->add_restaurant_permission($admin_to_add,$restaurant,$this->session->userdata('user_type'), $parent_id);
            }
        }
    
       
    }
    
    //returns permission id and parent of all fields accociated to adminid.
    function permission_ids_and_parents_for_admin($id)
    {
        
        $query= $this->db->query("SELECT permissions_id, adminid, parent_type, parent_id FROM permissions_hierarchy
                                   WHERE adminid=$id");
        return $query->result();
    }
    
    //gets parent_id(OwnerID) of operator
    function parent_id()
    {
        $query= $this->db->query("SELECT `correlation_id` FROM permissions_hierarchy WHERE adminid= ".$this->session->userdata('adminid')." AND `parent_id` IS NULL");
        $row= $query->row();
        return $row->correlation_id;
    }
    
     //returns array of all Owner ID's in the same enterprise as current operator.
    function enterprise_owners() 
    {
        $enterprise_array= array();
        $parentid= $this->parent_id();
        $query= $this->db->query("SELECT OwnerID from Owners WHERE EnterpriseID IN (SELECT EnterpriseID FROM Owners WHERE OwnerID= $parentid)");
        foreach ($query->result() as $row)
        {
            array_push($enterprise_array, $row->OwnerID);
        }
        return $enterprise_array;
                
    }
    
    
}
?>
