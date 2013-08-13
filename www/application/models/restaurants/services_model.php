<?php

class Services_model extends CI_Model {

    //function returns an Array of Restaurants and their Organizations the user has permission to edit
    function user_restaurants()
    {
       
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE services=1 AND adminid= "
        .$this->session->userdata('adminid')." ORDER BY parent_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT s.*,r.RestaurantID, r.UnitName, o.FirstName, o.LastName, o.OwnerID FROM Restaurants r, services s, Owners o
                    WHERE r.RestaurantID = $row->correlation_id AND r.OwnerID = o.OwnerID AND r.RestaurantID = s.restaurantid AND r.activated = 1";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT s.*,r.RestaurantID, r.UnitName, o.FirstName, o.LastName, o.OwnerID FROM Restaurants r, services s, Owners o
                    WHERE r.OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) and r.OwnerID = o.OwnerID AND r.RestaurantID = s.restaurantid AND r.activated = 1";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    function update_service()
    {
        $var = explode("_", $this->input->post('field_name'));

        // update list
        $myquery = "UPDATE services SET `{$var[0]}` = {$this->input->post('value')} WHERE restaurantid = {$var[1]}";
        $query=  $this->db->query($myquery);
        return $query;
    }
}
?>
