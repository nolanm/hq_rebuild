<?php

class Restaurant_Settings_model extends CI_Model {

    //function returns an Array of Restaurants and their Organizations the user has permission to edit
    function users_restautants()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE restaurant_settings=1 AND adminid= "
        .$this->session->userdata('adminid')." ORDER BY parent_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT r.*, s.Abbreviation, o.FirstName, o.LastName FROM Restaurants r, States s, Owners o
                    WHERE r.RestaurantID = $row->correlation_id AND r.OwnerID = o.OwnerID AND r.stateid = s.stateid AND r.activated = 1";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT r.*, s.Abbreviation, o.FirstName, o.LastName FROM Restaurants r, States s, Owners o
                    WHERE r.OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) and r.OwnerID = o.OwnerID AND r.stateid = s.stateid AND r.activated = 1";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    function restaurant_backgrounds()
    {
        $string="SELECT * FROM restaurant_backgrounds WHERE expiration > DATE('".date('Y-m-d')."') ORDER BY name";
        $query= $this->db->query($string);
        return $query->result() ;
    }
    
    function update_restaurant_info()
    {
        $query_string="UPDATE Restaurants SET StoreName = '".addslashes($this->input->post('StoreName'))."', UnitName = '".addslashes($this->input->post('UnitName'))."', 
            ManagerName = '".addslashes($this->input->post('ManagerName'))."', ManagerEmail= '".addslashes($this->input->post('ManagerEmail'))."', CommentsEmail= '".addslashes($this->input->post('CommentsEmail'))."', timezone= ".addslashes($this->input->post('timezone')).",
            market_radius = ".addslashes($this->input->post('market_radius'))." WHERE RestaurantID=".addslashes($this->input->post('restaurantid'));
       
        $success = $this->db->query($query_string);
        return $success;
    }
    
    function update_restaurant_address()
    {
        
        $query_string="UPDATE Restaurants SET MailAddress = '".addslashes($this->input->post('MailAddress'))."', MailAddress2 = '".addslashes($this->input->post('MailAddress2'))."', 
            MailCity = '".addslashes($this->input->post('MailCity'))."', MailState= '".addslashes($this->input->post('MailState'))."', MailZip= '".addslashes($this->input->post('MailZip'))."', Phone= '".addslashes($this->input->post('Phone'))."',
            Fax = '".addslashes($this->input->post('Fax'))."' WHERE RestaurantID=".addslashes($this->input->post('restaurantid'));
      
        $success = $this->db->query($query_string);
        return $success;
    }
    
    function update_restaurant_background()
    {
        
        $query_string="UPDATE Restaurants SET background = ".$this->input->post('background')." WHERE RestaurantID=".$this->input->post('restaurantid');
       $success = $this->db->query($query_string);
        return $success;
    }
    
    function update_restaurant_map()
    {
        $query_string="UPDATE Restaurants SET longitude = ".$this->input->post('longitude').", latitude = ".$this->input->post('latitude')." WHERE RestaurantID=".$this->input->post('restaurantid');
       $success = $this->db->query($query_string);
        return $success;
    }
    
}
?>
