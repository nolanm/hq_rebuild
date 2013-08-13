<?php


class Restaurant_Settings extends CI_Controller {
    
    
    function restaurant_settings()
    {
        parent::__construct();
        $this->load->library('users');
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->helper('url');
        $this->load->model('restaurants/restaurant_settings_model');

        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
    function index()
    {

        $restaurant_query= $this->restaurant_settings_model->users_restautants();
        $restaurant_backgrounds= $this->restaurant_settings_model->restaurant_backgrounds();
        $data['view_data']= array(
            'restaurant_array'=>$restaurant_query,
            'backgrounds_array'=>$restaurant_backgrounds);
        $data['bodycontent']='restaurants/restaurant_settings_view';
        $this->load->view('template',$data);

    }
    
    
    function update_info()
    {
        $success= $this->restaurant_settings_model->update_restaurant_info();
        if($success)
        {
            $this->alerts->save_successfull_alert();
        }
        else
        {
            $this->alerts->save_unsuccessfull_alert();
        }
        
    }
    
    function update_address()
    {
        
        $success= $this->restaurant_settings_model->update_restaurant_address();
        if($success)
        {
            $this->alerts->save_successfull_alert();
        }
        else
        {
            $this->alerts->unsave_successfull_alert();
        }
        
    }
    
    function update_background()
    {
        
        $success= $this->restaurant_settings_model->update_restaurant_background();
        if($success)
        {
            $this->alerts->save_successfull_alert();
        }
        else
        {
            $this->alerts->save_unsuccessfull_alert();
        }
        
    }
    
    function update_map()
    {
        $success= $this->restaurant_settings_model->update_restaurant_map();
        if($success)
        {
            $this->alerts->save_successfull_alert();
        }
        else
        {
           $this->alerts->save_unsuccessfull_alert();
        }
        
    }
   
    
}
?>
