<?php

class Application_Settings_Model extends CI_Model {
    
    function application_settings()
    {
        $string="SELECT correlation_type, correlation_id FROM permissions_hierarchy WHERE application_settings=1 AND adminid= "
                .$this->session->userdata('adminid')." ORDER BY parent_id";
        $query=$this->db->query($string);
        $restaurant_array=array();
        foreach ($query->result() as $row)
        {
            
            if(strcmp($row->correlation_type, "restaurant")==0)
            {   
                $querystring="SELECT r.*, o.FirstName, o.LastName, o.OwnerID FROM Restaurants r, Owners o
                    WHERE r.RestaurantID = $row->correlation_id AND r.OwnerID = o.OwnerID AND r.activated = 1";
                $query=  $this->db->query($querystring);
                array_push($restaurant_array, $query->row());
            }
            if(strcmp($row->correlation_type, "organization")==0)
            {
                $querystring="SELECT r.*,o.FirstName, o.LastName, o.OwnerID FROM Restaurants r, Owners o
                    WHERE r.OwnerID IN (SELECT OwnerID FROM Owners WHERE EnterpriseID= (SELECT EnterpriseID FROM Owners WHERE OwnerID= $row->correlation_id)) and r.OwnerID = o.OwnerID AND r.activated = 1";
                $query=  $this->db->query($querystring);
                foreach ($query->result() as $row)
                {
                    array_push($restaurant_array, $row);
                }
            }
        }
        
        return $restaurant_array;
    }
    
    function save_settings()
    {
       
       $query=$this->db->query("UPDATE Restaurants SET e_verify= ".$this->input->post('e_verify').", htw_autolink = ".$this->input->post('htw_autolink').", hiring_to_win = ".$this->input->post('hiring_to_win').", hiring_to_win_force_mgmt = ".$this->input->post('hiring_to_win_force_mgmt').",  
            hiring_to_win_force_crew = ".$this->input->post('hiring_to_win_force_crew').", HTMLApps = ".$this->input->post('HTMLApps').", SpanishApps = ".$this->input->post('SpanishApps').", AppResponseText = '".addslashes($this->input->post('AppResponseText'))."', 
                SendAppResponse = '".$this->input->post('SendAppResponse')."', CrewEmail = '".addslashes($this->input->post('CrewEmail'))."', MgmtEmail = '".addslashes($this->input->post('MgmtEmail'))."' WHERE restaurantid = ".$this->input->post('RestaurantID'));
       return $query;
    }
    
    function accepts_apps($restaurant, $accept_apps)
    {
        $query=$this->db->query("UPDATE Restaurants SET AcceptsApps= $accept_apps WHERE restaurantid = $restaurant");
       return $query;
    }
}

?>
