<?php
class Jobs extends CI_Controller {

     public $crew_restaurants = array(); //array of restaurants administrator has crew job permissions for
     public $mgmt_restaurants = array(); //array of restaurants administrator has managment job permissions for
    
    function Jobs()
    {
        parent::__construct();
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->model('hr/jobs_model');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
    function index()
    {
       //get restaurants admin has crew job permissions to access
       $this->crew_restaurants= $this->jobs_model->get_restaurants_for_crew_jobs();
       
       //get restaurants admin has management job permissions to access
       $this->mgmt_restaurants= $this->jobs_model->get_restaurants_for_mgmt_jobs();
       
       //Get jobs and their corresponding assignments that the user has created 
       $admin_jobs= $this->jobs_model->get_jobs_for_admin();
       $admin_job_assignments= $this->fill_job_assignments($admin_jobs, $this->crew_restaurants, $this->mgmt_restaurants);
       
       
       $distribution_lists=$this->tools->distribution_lists_by_admin($this->session->userdata('adminid'));
       
       //get owner id of current admin, if admin is not an owner, $owner_id will be false.
       $owner_id= $this->permissions->operator_level_admin($this->session->userdata('adminid'));
       
       //initializing potential arrays. 
       $owner_level_jobs=array();
       $owner_level_job_assignments= array();
       $extra_admin_jobs=array();
       $extra_admin_job_assignments= array();
       
       
       if($owner_id)//if current admin is and owner
       {
           //Get jobs and their corresponding assignments that has been created within the orgainization
           $owner_level_jobs= $this->jobs_model->get_extra_jobs_for_owner($owner_id);
           $owner_level_job_assignments= $this->fill_job_assignments($owner_level_jobs, $this->crew_restaurants, $this->mgmt_restaurants);
       }
       
       //Get jobs and their corresponding assignments that have been assigned to restaurants administrator has permissions for
        $extra_admin_jobs= $this->jobs_model->get_extra_jobs_for_admin();
        $extra_admin_job_assignments= $this->fill_job_assignments($extra_admin_jobs, $this->crew_restaurants, $this->mgmt_restaurants);
       
       
        $data['view_data']= array(
            'crew_restaurants'=>$this->crew_restaurants,
            'mgmt_restaurants'=>$this->mgmt_restaurants,
            'admin_jobs'=>$admin_jobs,
            'admin_job_assignments'=>$admin_job_assignments,
            'distribution_lists'=>$distribution_lists,
            'owner_level_jobs'=>$owner_level_jobs,
            'owner_level_job_assignments'=> $owner_level_job_assignments,
            'extra_admin_jobs'=>$extra_admin_jobs,
            'extra_admin_job_assignments'=>$extra_admin_job_assignments);
        $data['bodycontent']='hr/jobs/jobs_view';
        $this->load->view('template',$data);
    }
    
    /*
     * creates and array of arrays, where every index of the original array is the job id. 
     * The job id corrisponds to an array of restaurants which are the restaurants the indexed job id is assigned to.
     * The Restaurants inserted into the array will have to be among the restaurants this admin has job permissions for.
     * EX: Array (  [0] => Array ( [501] => Array ( [0] => stdClass Object ( [restaurantid] => 778 )  [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [1] => Array ( [6708] => Array ( ) ) 
     *              [2] => Array ( [6709] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [3] => Array ( [6710] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [4] => Array ( [6711] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *           ) 
     * params: array of jobs, array of available crew restaurants, array of available management restaurants
     */
    
    function fill_job_assignments($job_array, $admins_crew_restaurants, $admins_mgmt_restaurants)
    {
        $crew_rests=array();
        $mgmt_rests=array();
        
        foreach($admins_crew_restaurants as $admin_row)
        {
            array_push($crew_rests, $admin_row->RestaurantID);
        }
        
        foreach($admins_mgmt_restaurants as $admin_row)
        {
            array_push($mgmt_rests, $admin_row->RestaurantID);
        }
        
        $assignments_array= array();
        foreach($job_array as $job)
        {   
            
            $restaurant_array=array();
            $restaurants= $this->jobs_model->get_restaurant_assignments_for_job($job->id);
            foreach($restaurants as $row)
            {
                if($job->Type==1)
                {
                    if(in_array($row->restaurantid, $mgmt_rests))
                    {
                        array_push($restaurant_array, $row->restaurantid);
                    }
                }
                else
                {
                    if(in_array($row->restaurantid, $crew_rests))
                    {
                        array_push($restaurant_array, $row->restaurantid);
                    }
                }
            }
            $assignments_array[$job->id] = $restaurant_array;
           
        }
        
        return $assignments_array;
    }
    
    
    //creates new job and assigns the job to the restaurants the administrator selected
    function create_job()
    {
       
        $job_id= $this->jobs_model->create_job();
       if($job_id)//creating job was successfull
       {
           if($this->input->post('restaurants'))//are restaurants assigned to the job
           {    
                $restaurants=$this->input->post('restaurants');
                for($i = 0; $i < count($restaurants); $i++)
                {
                    // create assignments
                    $this->jobs_model->assign_job_to_restaurant($job_id,$restaurants[$i]);
                }
           }
           else if($this->input->post('distribution') && $this->input->post('distribution')!='None')// is the job assigned to a distripution list
           {
                $restaurants= $this->tools->restaurants_for_distribution_list($this->input->post('distribution'));
                foreach($restaurants as $row)
                {  
                    $rest_id= $row->restaurantid;
                    $this->jobs_model->assign_job_to_restaurant($job_id,$rest_id);
                }
           }
       }   
    }
    
    //updates job information and new restaurant assignments
    function update_job()
    {
        
        $result= $this->jobs_model->update_job($this->input->post('id'));
        
        if($result)
        {
            if($this->input->post('restaurants'))//are restaurants assigned to the job
            {    
                if($this->input->post('type')==1)//mgmt job?
                {
                    $this->jobs_model->delete_mgmt_job_assignments($this->input->post('id'));// delete current restaurant assignments
                }
                else
                {
                    $this->jobs_model->delete_crew_job_assignments($this->input->post('id'));// delete current restaurant assignments
                }
                $restaurants=$this->input->post('restaurants');
                for($i = 0; $i < count($restaurants); $i++)
                {
                    // create assignments
                    $this->jobs_model->assign_job_to_restaurant($this->input->post('id'),$restaurants[$i]);
                }
            }
            else if($this->input->post('distribution'))// is the job assigned to a distripution list
            {
                if($this->input->post('type')==1) //mgmt job?
                {
                    $this->jobs_model->delete_mgmt_job_assignments($this->input->post('id'));// delete current restaurant assignments
                    if($this->input->post('distribution')!='None')
                    {
                        $this->mgmt_restaurants= $this->jobs_model->get_restaurants_for_mgmt_jobs();
                        $mgmt_rests=array();
                        foreach($this->mgmt_restaurants as $admin_row)
                        {
                            array_push($mgmt_rests, $admin_row->RestaurantID);
                        }
                       $restaurants= $this->tools->restaurants_for_distribution_list($this->input->post('distribution'));//get restaurants in distribution list
                       //assign jobs to restaurants that are both in distribution list, and part of restaurants set administrator has permissions for
                       foreach($restaurants as $row)
                       {  
                           $rest_id= $row->restaurantid;
                           if(in_array($rest_id, $mgmt_rests))
                           {
                                $this->jobs_model->assign_job_to_restaurant($this->input->post('id'),$rest_id);
                           }
                       }
                    }
                }
                else
                {
                    $this->jobs_model->delete_crew_job_assignments($this->input->post('id'));// delete current restaurant assignments
                    if($this->input->post('distribution')!='None')
                    {
                        $this->crew_restaurants= $this->jobs_model->get_restaurants_for_crew_jobs();
                        $crew_rests=array();
                        foreach($this->crew_restaurants as $admin_row)
                        {
                            array_push($crew_rests, $admin_row->RestaurantID);
                        }
                       $restaurants= $this->tools->restaurants_for_distribution_list($this->input->post('distribution')); //get restaurants in distribution list
                       //assign jobs to restaurants that are both in distribution list, and part of restaurants set administrator has permissions for
                       foreach($restaurants as $row)
                       {  
                           $rest_id= $row->restaurantid;
                           if(in_array($rest_id, $crew_rests))
                           {
                                $this->jobs_model->assign_job_to_restaurant($this->input->post('id'),$rest_id);
                           }
                       }
                    }
                }
                
            } 
            $this->alerts->save_successfull_alert();
        }
        else
        {
           $this->alerts->save_unsuccessfull_alert();
        }
        
    }
    
    /*Called after user selects a distribution list to assign a job to. 
     * The function will determine what stores, if any, from the distribution list will not be assigned the job because the user does not have job permissions for the restaurants.
     * If any restaurants are found, the user will be notified via the view, job_distribution_list_alert.php
    */
    function distribution_list_alert()
    {
        $distribution_restaurants= $this->tools->restaurants_for_distribution_list($this->input->post('distribution_list'));
        if($this->input->post('job_type')==1)// is the job a management job or a crew job?
        {
            $this->mgmt_restaurants= $this->jobs_model->get_restaurants_for_mgmt_jobs();
            $unpermitted_restaurants=$this->unpermitted_restaurants_from_list($this->mgmt_restaurants, $distribution_restaurants);
            if(count($unpermitted_restaurants)>0)
            {
                $data['view_data']= array(
                    'unpermitted_restaurants'=>$unpermitted_restaurants);
                $this->load->view('hr/jobs/job_distribution_list_alert',$data);
            }
            
        }
        else
        {
            $this->crew_restaurants= $this->jobs_model->get_restaurants_for_crew_jobs();
            $unpermitted_restaurants=$this->unpermitted_restaurants_from_list($this->crew_restaurants, $distribution_restaurants);
            if(count($unpermitted_restaurants)>0)
            {
                $data['view_data']= array(
                    'unpermitted_restaurants'=>$unpermitted_restaurants);
                $this->load->view('hr/jobs/job_distribution_list_alert',$data);
            }
            
        }
    }
    
    /*this function will return an array of restaurants that are part of the distribution list selected
     * but are not one of the restaurants the user has job permissions for.
     * Count return an empty array if user has job permissions for all restaurants in distribution list 
    */
    function unpermitted_restaurants_from_list($job_restaurants, $list_restaurants)
    {
        $unpermitted_restaurants= array();
        foreach($list_restaurants as $row)// walks through each restaurant from distribution list to see if it is also contained in the permitted restaurants -> ($job_restaurants)
        {
            $row_permitted=FALSE;
            $index=0;
            while ($index < count($job_restaurants)) // walks the distribution list restaurant through the permitted restaurant if its a match.
            {
                $restaurant= $job_restaurants[$index];
                if($row->restaurantid== $restaurant->RestaurantID)
                {
                    $row_permitted=TRUE;
                    break;
                }
                $index++;
            }
            if(!$row_permitted)//if distribution list restaurant is not a match?
            {
                array_push($unpermitted_restaurants, $row->restaurantid);
            }
        }
        return $unpermitted_restaurants;
    }
    
    function unassign_restaurants()
    {
        if($this->input->post('type')==1)// is the posted job a management job or a crew job?
        {
            $this->jobs_model->delete_mgmt_job_assignments($this->input->post('id'));// delete current restaurant assignments
        }
        else
        {
            $this->jobs_model->delete_crew_job_assignments($this->input->post('id'));// delete current restaurant assignments
        }
    }


    function update_assignment()
    {
        if($this->input->post('checked'))
        {
            $this->jobs_model->assign_job_to_restaurant($this->input->post('jobid'),$this->input->post('restaurantid'));
        }
        else
        {
            $this->jobs_model->delete_job_assignment_for_restaurant($this->input->post('jobid'),$this->input->post('restaurantid'));
        }
    }
    
    function delete_job()
    {
        $this->jobs_model->delete_job($this->input->post('id'));
        if($this->input->post('type')==1)
        {
            $this->jobs_model->delete_mgmt_job_assignments($this->input->post('id'));// delete current restaurant assignments
        }
        else
        {
            $this->jobs_model->delete_crew_job_assignments($this->input->post('id'));// delete current restaurant assignments
        }
    }
    
}
?>
