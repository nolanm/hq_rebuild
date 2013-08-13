<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools {

    public function __construct() {
        $this->ci = & get_instance();

        $this->ci->load->library('session');
        $this->ci->load->library('email');
        $this->ci->load->helper('url');
    }
    
    
    function reload_page($path)
    {
        redirect(base_url()."index.php".$path, 'refresh');
    }
    
    /*
     * Distribution Lists
     */
	//returns all the distribution lists created by the adminid given
    public function distribution_lists_by_admin($adminid)
    {
        $query=$this->ci->db->query("SELECT * FROM distribution_lists3 WHERE adminid= $adminid");
        return $query->result();
    }
    
	//returns all the restaurants assigned to the given distribution list
    public function restaurants_for_distribution_list($id)
    {
        $query=$this->ci->db->query("SELECT restaurantid FROM distribution_list_assignments WHERE id= $id");
        return $query->result();
    }


    /*
     * Pending Administrator Requests
     */
    
	// returns request information of given id
    public function get_request($id)
    {
        $userQuery=$this->ci->db->query("SELECT * FROM pending_administrator_requests WHERE id = $id");
        return $userQuery->row();
    }
    
	//return permissions for given request id
    public function get_request_permissions($id)
    {
        $userQuery=$this->ci->db->query("SELECT * FROM pending_request_permissions WHERE request_id = $id");
        return $userQuery->result();
    }
    
	//return requests that are being sent to given adminid
    public function get_requests_by_adminid($adminid)
    {
        $userQuery=$this->ci->db->query("SELECT p.*, CONCAT(u.firstname,' ',u.lastname) as parent_name FROM pending_administrator_requests p, users u WHERE p.adminid = $adminid AND p.parent_admin= u.adminid ");
        return $userQuery->result();
    }
    
	// return requests by the parent that made them.
    public function get_requests_by_parent($parent_type, $parent_id)
    {
         $userQuery=$this->ci->db->query("SELECT p.*, CONCAT(u.firstname,' ',u.lastname) as admin_name FROM pending_administrator_requests p, users u WHERE p.parent_type = '$parent_type' AND p.parent_id= $parent_id AND p.adminid= u.adminid");
        return $userQuery->result();
    }
   
	// creates new request, returns requestid if successfull, false if not
    public function insert_request($adminid, $parent_type, $parent_id, $parent_admin)
    {
        $myquery = "INSERT INTO pending_administrator_requests (adminid, parent_type, parent_id, parent_admin) 
           VALUES('$adminid', '$parent_type',$parent_id, $parent_admin)";
        $query=  $this->ci->db->query($myquery);
        if($query)
        {
            return $this->ci->db->insert_id();
        }
        else
        {
            return false;
        }
    }
    
	//creates permissions for requests and assigns them to request id
    public function insert_request_permission($requestid,$restaurant,$hr,$lsm,$ro)
    {
        $myquery = "INSERT INTO pending_request_permissions (request_id ,restaurant_id ,hr_permissions ,lsm_permissions ,operation_permissions)
                    VALUES ($requestid, $restaurant, $hr, $lsm, $ro);";
        $query=  $this->ci->db->query($myquery);
        return $query;
    }

	// deletes request with given id
    public function delete_request($id)
    {
         $this->ci->db->delete('pending_administrator_requests', array('id' => $id));
         $this->ci->db->delete('pending_request_permissions', array('request_id' => $id));
    }
    
    
    //creates and sends an email with the given response, title, and recipient. 
    public function emailer($response,$title,$recipEmail) {
	
        $this->ci->email->from('webmaster@localmark.com', 'LocalMark Support Team');
        $this->ci->email->to($recipEmail);
        $this->ci->email->subject($title);
        $this->ci->email->message($response);

       return $this->ci->email->send();
    }
    
}

?>
