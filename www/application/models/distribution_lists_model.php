<?php

class Distribution_lists_Model extends CI_Model {
    
    function restaurants()
    {
         $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE adminid= "
                    .$this->session->userdata('adminid')." ORDER BY correlation_type, correlation_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT r.RestaurantID, r.UnitName, r.City, r.Zip, s.StateName as State, c.Name as Coop, re.Name as Region FROM Restaurants r, Coops c, Regions re,States s
                    WHERE r.RestaurantID = $row->correlation_id AND r.activated = 1 AND s.StateID= r.StateID AND c.CoopID= r.CoopID AND re.RegionID= r.RegionID";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT r.RestaurantID, r.UnitName, r.City, r.Zip, s.StateName as State, c.Name as Coop, re.Name as Region FROM Restaurants r, Coops c, Regions re,States s
                    WHERE r.OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) AND activated = 1 AND s.StateID= r.StateID AND c.CoopID= r.CoopID AND re.RegionID= r.RegionID ORDER BY RestaurantID";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    function create_new_list()
    {
        $data = array(
            'adminid' => $this->session->userdata('adminid'),
            'name' => $this->input->post('name')
         );

        $this->db->insert('distribution_lists3', $data); 
    }
    
    function add_restaurant_to_list($restaurant,$list)
    {
        $data = array(
           'id' => $list ,
           'restaurantid' => $restaurant
          ); 
       $this->db->insert('distribution_list_assignments', $data); 
    }

    function remove_restaurant_from_list($restaurant, $list)
    {
        $data = array(
           'id' => $list ,
           'restaurantid' => $restaurant
          ); 
       $this->db->delete('distribution_list_assignments', $data); 
    }
}
?>
