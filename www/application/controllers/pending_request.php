<?php

class Pending_Request extends CI_Controller {
   
    function Pending_Request()
    {
        
        parent::__construct();
        $this->load->library('tools');
        $this->load->library('permissions');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
    function index()
    {
        $requests= $this->tools->get_requests_by_adminid($this->session->userdata('adminid'));
        if(count($requests)>0)
        {
            $data['view_data']= array(
                'request_array'=>$requests);
            $data['bodycontent']='pending_request_view';
            $this->load->view('template',$data);
        }
        else
        {
            redirect(base_url(), 'refresh');
        }
    }
    
    function accept($id,$parent_type,$parent_id)
    {
        $this->permissions->add_admin_to_parent($this->session->userdata('adminid'), $parent_type, $parent_id);
        foreach($this->tools->get_request_permissions($id) as $row)
        {
            $permission_id= $this->permissions->add_restaurant_permission($this->session->userdata('adminid'), $row->restaurant_id,$parent_type, $parent_id);
            if($row->hr_permissions)
            {
                $this->permissions->add_hr_permissions($permission_id);
            }
            if($row->lsm_permissions)
            {
                $this->permissions->add_lsm_permissions($permission_id);
            }
            if($row->operation_permissions)
            {
                $this->permissions->add_ro_permissions($permission_id);
            }
        }
        $this->tools->delete_request($id);
        $this->session->unset_userdata('pending_admin_requests');
        $this->index();
        
    }
    
    function deny($id)
    {
        $this->tools->delete_request($id);
        $this->session->unset_userdata('pending_admin_requests');
        $this->index();
    }
}

?>
