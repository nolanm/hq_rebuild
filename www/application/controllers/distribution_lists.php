<?php
class Distribution_Lists extends CI_Controller {

    function Distribution_Lists()
    {
        parent::__construct();
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->model('distribution_lists_model');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
    function index()
    {
        $distribution_lists= $this->tools->distribution_lists_by_admin($this->session->userdata('adminid'));
        $distribution_list_assignments= $this->distribution_list_assignments($distribution_lists);
        $restaurants= $this->distribution_lists_model->restaurants();
        
        $data['view_data']= array(
            'restaurants'=>$restaurants,
            'distribution_lists'=>$distribution_lists,
            'assignments'=> $distribution_list_assignments);
        $data['bodycontent']='distribution_list_view';
        $this->load->view('template',$data);
        
    }
    
    function distribution_list_assignments($distribution_lists)
    {
        $assignments= array();
        foreach($distribution_lists as $row)
        {
            $list_assignments= array();
            $restaurants=$this->tools->restaurants_for_distribution_list($row->id);
            foreach($restaurants as $restaurant)
            {
                array_push($list_assignments, $restaurant->restaurantid);
            }
            $assignments[$row->id]= $list_assignments;
        }
        return $assignments; 
    }
    
    function new_list()
    {
        $this->distribution_lists_model->create_new_list();
        $this->index();
    }
   
    function update_list_restaurant()
    {
        if($this->input->post('add')==1)//add restaurant to list
        {
            $this->distribution_lists_model->add_restaurant_to_list($this->input->post('restaurant'),  $this->input->post('list'));
        }
        else //remove restaurant from list
        {
            $this->distribution_lists_model->remove_restaurant_from_list($this->input->post('restaurant'),  $this->input->post('list'));
        }
    }
    
}

?>