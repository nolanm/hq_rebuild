<?php

class Benefits_Model extends CI_Model {

   /* function fill_created_by_field()
    {
        $query=$this->db->query("SELECT * FROM benefit_packages");
        foreach($query->result() as $benefit)
        {
            if($benefit->ownerid)
            {
                $string="UPDATE benefit_packages SET created_by = (SELECT adminid FROM users WHERE ownerid = ".$benefit->ownerid." LIMIT 1) WHERE packageid = ".$benefit->packageid;
                $query=$this->db->query($string);
            }
            else if($benefit->coopid)
            {
                $string="UPDATE benefit_packages SET created_by = (SELECT adminid FROM users WHERE coopid = ".$benefit->coopid." LIMIT 1) WHERE packageid = ".$benefit->packageid;
                $query=$this->db->query($string);
            }
            else if($benefit->regionid)
            {
                $string="UPDATE benefit_packages SET created_by = (SELECT adminid FROM users WHERE regionid = ".$benefit->regionid." LIMIT 1) WHERE packageid = ".$benefit->packageid;
                $query=$this->db->query($string);
            }
        }
    }
    */
    
     /*
     * function will return jobs this admin has created within their HQ. 
     */
    function get_benefits_for_admin()
    {
        $query_string="SELECT b.*, u.firstname, u.lastname
                        FROM benefit_packages b
                        JOIN users u ON b.created_by= u.adminid
                        WHERE b.created_by= ".$this->session->userdata('adminid');
        
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
   
    /*
     * this function is only called if the current admin is an operator
     * returns benefit packages and the user's first and last name of who created packages.
     * returns benefit packages created by other owners in the enterprise and packages created by restaurant level admins who have "benefits" permissions for restaurants within the enterprise.
     */
    function get_extra_benefits_for_owner($ownerid)
    {   
         $query_string="SELECT b.*, u.firstname, u.lastname
                        FROM benefit_packages b
                        JOIN permissions_hierarchy p ON p.adminid = b.created_by
                        JOIN Owners o ON o.OwnerID = p.correlation_id
                        JOIN users u ON b.created_by= u.adminid
                        WHERE p.correlation_type='organization' 
                        AND o.EnterpriseID IN (SELECT EnterpriseID FROM Owners WHERE OwnerID = $ownerid) 
                        AND b.created_by <> ".$this->session->userdata('adminid')."
                            UNION 
                        SELECT DISTINCT b.*, u.firstname, u.lastname
                         FROM benefit_packages b
                        JOIN benefit_packages_assignments a ON b.packageid= a.packageid 
                        JOIN users u ON b.created_by= u.adminid
                        WHERE b.created_by <>".$this->session->userdata('adminid')." AND a.restaurantid IN 
                        (SELECT RestaurantID FROM Restaurants WHERE OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID = (SELECT EnterpriseID FROM Owners WHERE OwnerID = $ownerid)))";
                        
         $query=$this->db->query($query_string);
         return $query->result();
    }
    
     /*
     * this function returns benefit packages created by restaurant level admins who have "job" permissions for the same restaurants that the owner has restaurant level permissions for.
     */
    function get_extra_benefits_for_admin()
    {
        $query_string="SELECT DISTINCT b.*, u.firstname, u.lastname
                        FROM benefit_packages b
                        JOIN benefit_packages_assignments a ON b.packageid= a.packageid 
                        JOIN users u ON b.created_by= u.adminid
                        WHERE b.created_by <>".$this->session->userdata('adminid')." AND a.restaurantid IN 
                        (SELECT correlation_id FROM permissions_hierarchy WHERE adminid=".$this->session->userdata('adminid')." AND benefits=1 AND correlation_type= 'restaurant')";
         
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    
    /*
     * Returns all restaurants that admin has permission for benefits. 
     */
    function get_restaurants_for_benefits()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE benefits=1 AND adminid= "
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
    
    function get_assignments_for_benefit_package($packageID)
    {
        $query_string="SELECT restaurantid
                        FROM benefit_package_assignments
                        WHERE packageid=$packageID"; 
         
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function get_items_for_benefit_package($packageID)
    {
        $query_string="SELECT *
                        FROM benefit_package_items
                        WHERE packageid =$packageID ORDER BY order_number"; 
         
        $query=$this->db->query($query_string);
        return $query->result();
    }
    
    function number_of_items_for_package($packageID)
    {
        $query_string="SELECT *
                        FROM benefit_package_items
                        WHERE packageid =$packageID"; 
        $query=$this->db->query($query_string);
        return $query->num_rows();
    }
    
    function create_new_package()
    {
        $insertquery = "INSERT INTO benefit_packages (name, created_by) 
                        VALUES ('".addslashes($this->input->post('name'))."', ".$this->session->userdata('adminid').")"; 
        $query=  $this->db->query($insertquery);
        return $query;
    }
    
    function create_new_item($package_id,$name,$order_number, $header)
    {
        $insertquery = "INSERT INTO benefit_package_items (packageid, name, order_number, heading) 
                        VALUES ($package_id,'".addslashes($this->input->post('name'))."', $order_number, $header)"; 
        $query=  $this->db->query($insertquery);
        return $query;
    }
    
    function update_item($item_id, $name, $description)
    {
        $query=$this->db->query("UPDATE benefit_package_items SET name= '".addslashes($name)."', text= '".addslashes($description)."' WHERE id=$item_id");
        return $query;
    }
    
    function assign_package_to_restaurant($id, $restaurantid)
    {
       $data = array(
            'packageid' => $id ,
            'restaurantid' => $restaurantid
           ); 
       $this->db->insert('benefit_package_assignments', $data); 
    }
    
    function delete_package_assignments($id)
    {
        $restaurants= $this->get_restaurants_for_benefits();
        foreach($restaurants as $row)
        {
            $data= array('packageid' => $id, 'restaurantid'=> $row->RestaurantID);
            $this->db->delete('benefit_package_assignments',$data);  
        }
    }
    
    function delete_package_items($id)
    {
        $this->db->delete('benefit_package_items', array('packageid' => $id)); 
    }
    
    function delete_package($id)
    {
        $this->db->delete('benefit_packages', array('packageid' => $id)); 
    }
    
    function delete_item($id)
    {
        $this->db->delete('benefit_package_items', array('id' => $id)); 
    }
    
    function sort_item($item, $sort_number)
    {
        $query=$this->db->query("UPDATE benefit_package_items SET order_number= $sort_number WHERE id=$item");
    }
}

?>
