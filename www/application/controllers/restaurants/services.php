<?php


class services extends CI_Controller {
    
     function Services()
    {
        parent::__construct();
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->model('restaurants/services_model');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
   public function index()
    {
        $restaurant_query= $this->services_model->user_restaurants();
        $data['view_data']= array(
            'restaurant_array'=>$restaurant_query);
        $data['bodycontent']='restaurants/services_view';
        $this->load->view('template',$data);
        
    }
    
    public function update_service()
    {
        $this->load->model('restaurants/services_model');
        $result= $this->services_model->update_service();
        return $result;
    }
    
   
}
?>
