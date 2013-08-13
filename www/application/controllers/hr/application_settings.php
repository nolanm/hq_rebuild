<?php
class Application_Settings extends CI_Controller {

    function Application_Settings()
    {
        parent::__construct();
        $this->load->library('alerts');
        $this->load->model('hr/application_settings_model');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
    function index()
    {
        $settings_array= $this->application_settings_model->application_settings();
        $data['view_data']= array(
            'settings_array'=>$settings_array);
        $data['bodycontent']='hr/application_settings_view';
        $this->load->view('template',$data);
    }
    
    function restaurant_accept_appplications()
    {
        $result= $this->application_settings_model->accepts_apps($this->input->post('RestaurantID'),$this->input->post('AcceptsApps'));
    }
    
    function save_settings()
    {
        $result= $this->application_settings_model->save_settings();
        if($result)
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
