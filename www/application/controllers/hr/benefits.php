<?php
class Benefits extends CI_Controller {

    function Benefits()
    {
        parent::__construct();
        $this->load->library('permissions');
        $this->load->library('tools');
        $this->load->library('alerts');
        $this->load->helper('url');
        $this->load->model('hr/benefits_model');
        
        $userAuthenticated=$this->session->userdata('authenticated');
        if(!isset($userAuthenticated) || $userAuthenticated !=TRUE)
        {
             redirect(base_url(), 'refresh');
        }
    }
    
   function index()
   {
       //get restaurants admin has benefit permissions to access
        $restaurants= $this->benefits_model->get_restaurants_for_benefits();

        $admin_benefits= $this->benefits_model->get_benefits_for_admin();
        $admin_package_items= $this->items_for_benefit_packages($admin_benefits);
        $admin_benefits_assignments= $this->assignments_for_benefit_packages($admin_benefits, $restaurants);
        $distribution_lists=$this->tools->distribution_lists_by_admin($this->session->userdata('adminid'));
        $owner_id= $this->permissions->operator_level_admin($this->session->userdata('adminid'));
       /* $owner_level_jobs=array();
        $owner_level_job_assignments= array();
        $extra_admin_jobs=array();
        $extra_admin_job_assignments= array();
        if($owner_id)
        {
            $owner_level_jobs= $this->jobs_model->get_extra_jobs_for_owner($owner_id);
            $owner_level_job_assignments= $this->fill_job_assignments($owner_level_jobs, $crew_restaurants, $mgmt_restaurants);
        }
      
        $extra_admin_jobs= $this->jobs_model->get_extra_jobs_for_admin();
        $extra_admin_job_assignments= $this->fill_job_assignments($extra_admin_jobs, $crew_restaurants, $mgmt_restaurants);
       */
       
        $data['view_data']= array(
            'restaurants'=>$restaurants,
            'admin_benefits'=>$admin_benefits,
            'admin_benefit_assignments'=>$admin_benefits_assignments,
            'admin_package_items'=>$admin_package_items
            );
        $data['bodycontent']='hr/benefits/benefits_view';
        $this->load->view('template',$data);
   }

   
    /*
     * creates and returns an array of arrays, where every index of the original array is the benefit package id. 
     * The benefit package id corrisponds to an array of restaurants which are the restaurants the indexed benefit package id is assigned to.
     * The Restaurants inserted into the array will have to be among the restaurants this admin has job permissions for.
     * EX: Array (  [0] => Array ( [501] => Array ( [0] => stdClass Object ( [restaurantid] => 778 )  [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [1] => Array ( [6708] => Array ( ) ) 
     *              [2] => Array ( [6709] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [3] => Array ( [6710] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *              [4] => Array ( [6711] => Array ( [0] => stdClass Object ( [restaurantid] => 778 ) [1] => stdClass Object ( [restaurantid] => 2653 ) [2] => stdClass Object ( [restaurantid] => 4412 ) [3] => stdClass Object ( [restaurantid] => 6023 ) [4] => stdClass Object ( [restaurantid] => 6553 ) [5] => stdClass Object ( [restaurantid] => 12464 ) [6] => stdClass Object ( [restaurantid] => 17454 ) ) ) 
     *           ) 
     * params: array of benefit packages, array of available restaurants user can assign benefits.
     */
    
    function assignments_for_benefit_packages($package_array, $benefit_restaurants)
   {
        /*
         * $restaurants array will be used to hold the same RestaurantID's as $benefit_restaurants but only the RestaurantID
         * Basically cutting out the UnitName from each index of $benefit_restaurants so the function 'in_array' can be used later in the function. 
         * 
         */
        $restaurants=array();
        
        //adding each RestaurantID to $restaurants from $benefit_restaurants
        foreach($benefit_restaurants as $row)
        {
            array_push($restaurants, $row->RestaurantID);
        }

        //initializing the return array.
        $assignments_array= array();
        
        //loops throught the $package_array adding the array of assignments to $assignments_array with an index of the corresponding package id
        foreach($package_array as $benefit)
        {   
            
            $restaurant_array=array();
            $assignment_restaurants= $this->benefits_model->get_assignments_for_benefit_package($benefit->packageid);
            foreach($assignment_restaurants as $row)
            {
                
                if(in_array($row->restaurantid, $restaurants))
                {
                    array_push($restaurant_array, $row->restaurantid);
                }
                
            }
            $assignments_array[$benefit->packageid] = $restaurant_array;
           
        }
        
        return $assignments_array;
   }
   
   
   /*
     * creates and returns an array of arrays, where every index of the original array is the benefit package id. 
     * The benefit package id corrisponds to an array of benefit items which are the items the indexed benefit package id is assigned to.
     * EX:  Array ( [1] => Array ( [0] => stdClass Object ( [id] => 11391 [packageid] => 1 [name] => MANAGER BENEFITS [text] => [order_number] => 0 [heading] => 1 ) [1] => stdClass Object ( [id] => 1 [packageid] => 1 [name] => Medical, Dental, Vision, Life [text] => Comprehensive Medical/Dental/Vision Plans, Paid & Optional Life Insurance, Voluntary Physical Exam Program, Healthcare Flexible Spending Account, Short/Long Term Disability Plans [order_number] => 1 [heading] => 0 ) [2] => stdClass Object ( [id] => 2 [packageid] => 1 [name] => Pay & Future Investment Plans [text] => Base Salary Increases & Promotions, 401 (k), Profit Sharing Program, Stock Options, Credit Union, McSave, McDirect Shares [order_number] => 2 [heading] => 0 ) [3] => stdClass Object ( [id] => 18825 [packageid] => 1 [name] => Quarterly Cash Incentive [text] => Variable compensation paid in quarterly cash payments, with each manager's rewards determined by his or her restaurant's success in QSC, guest counts, profit and people. [order_number] => 3 [heading] => 0 ) [4] => stdClass Object ( [id] => 3 [packageid] => 1 [name] => Time Off Programs [text] => 8 Paid Holidays, 2 Weeks Paid Vacation, 8 Week Sabbatical Program, Leave of Absence Programs. [order_number] => 4 [heading] => 0 ) [5] => stdClass Object ( [id] => 4 [packageid] => 1 [name] => Additional Benefits [text] => Educational Assistance (90% after 6 months), Day Care Reimbursement, Parent/Student Loan Program, Company Car (Restaurant Managers), Employee Assistance Program. [order_number] => 5 [heading] => 0 ) [6] => stdClass Object ( [id] => 5 [packageid] => 1 [name] => Service Recognition Awards Program [text] => Recognition Awards Based on Length of Service, Cash Awards, etc. [order_number] => 6 [heading] => 0 ) )
     *           [3520] => Array ( [0] => stdClass Object ( [id] => 14945 [packageid] => 3520 [name] => 401 (k) [text] => [order_number] => 0 [heading] => 0 ) [1] => stdClass Object ( [id] => 18826 [packageid] => 3520 [name] => Quarterly Cash Incentive [text] => Variable compensation paid in quarterly cash payments, with each manager's rewards determined by his or her restaurant's success in QSC, guest counts, profit and people. [order_number] => 1 [heading] => 0 ) [2] => stdClass Object ( [id] => 14947 [packageid] => 3520 [name] => Tuition Reimbursement [text] => [order_number] => 2 [heading] => 0 ) [3] => stdClass Object ( [id] => 14948 [packageid] => 3520 [name] => Paid Vacations [text] => [order_number] => 3 [heading] => 0 ) [4] => stdClass Object ( [id] => 14949 [packageid] => 3520 [name] => Health, Dental, Vision, Life, Etc... [text] => [order_number] => 4 [heading] => 0 ) [5] => stdClass Object ( [id] => 14950 [packageid] => 3520 [name] => Career Development Classes [text] => [order_number] => 5 [heading] => 0 ) ) 
     *           [3521] => Array ( [0] => stdClass Object ( [id] => 14953 [packageid] => 3521 [name] => 401 (k) [text] => [order_number] => 0 [heading] => 0 ) [1] => stdClass Object ( [id] => 14951 [packageid] => 3521 [name] => Health, Dental, Vision, Life Insurance, Etc. [text] => [order_number] => 1 [heading] => 0 ) [2] => stdClass Object ( [id] => 14952 [packageid] => 3521 [name] => Flexible Schedules [text] => [order_number] => 2 [heading] => 0 ) [3] => stdClass Object ( [id] => 14955 [packageid] => 3521 [name] => Scholarships [text] => [order_number] => 3 [heading] => 0 ) [4] => stdClass Object ( [id] => 14954 [packageid] => 3521 [name] => Free Uniforms / Meals [text] => [order_number] => 4 [heading] => 0 ) ) 
     *           [6316] => Array ( [0] => stdClass Object ( [id] => 24447 [packageid] => 6316 [name] => CREW BENEFITS [text] => [order_number] => 0 [heading] => 1 ) [1] => stdClass Object ( [id] => 24448 [packageid] => 6316 [name] => 401 (K) [text] => Our organization offers an incredible opportunity for investing with 100% employer matching of up to 3% of annual pay, pre-tax dollars, to qualifying employees [order_number] => 0 [heading] => 0 ) [2] => stdClass Object ( [id] => 24449 [packageid] => 6316 [name] => SHIFT MANAGER BENEFITS [text] => [order_number] => 0 [heading] => 1 ) [3] => stdClass Object ( [id] => 24450 [packageid] => 6316 [name] => SALARIED MANAGER BENEFITS [text] => [order_number] => 0 [heading] => 1 ) ) 
     *            )
     *  params: array of benefit packages, array of available restaurants user can assign benefits.
     */
    
   function items_for_benefit_packages($package_array)
   {
       $benefit_items= array();
       foreach($package_array as $row)
       {
           $items_of_one_package= $this->benefits_model->get_items_for_benefit_package($row->packageid);
           $benefit_items[$row->packageid]= $items_of_one_package;
       }
        return $benefit_items;
   }
   
   
   function new_package()
   {
       if(($this->input->post('name')!=''))
       {
            $query=$this->benefits_model->create_new_package();
       }
       $this->index();
   }
   
   //gets package items associated with packageid and posts them to view
  function package_items()
  {
      $items= $this->benefits_model->get_items_for_benefit_package($this->input->post('packageid'));
      $data= array('package_id'=>$this->input->post('packageid'), 'items'=>$items);
      print $this->load->view('hr/benefits/benefit_package', $data, true);
  }
  
  //creates new package item
  function new_package_item()
  {
      $item_count= $this->benefits_model->number_of_items_for_package($this->input->post('package_id'));
      $this->benefits_model->create_new_item($this->input->post('package_id'),$this->input->post('name'),$item_count++,$this->input->post('header'));
      
      $this->reload_items_view_for_package($this->input->post('package_id'));
  }
  
  //updates package item
  function update_item()
  {
     $query= $this->benefits_model->update_item($this->input->post('id'),$this->input->post('name'),$this->input->post('description'));
     if($query)
     {
         $this->alerts->save_successfull_alert();
     }
     else
     {
         $this->alerts->save_unsuccessfull_alert();
     }
  }
  
  //update benefit package restaurant assignments
  function update_assignments()
  {
    $restaurants=$this->input->post('restaurants');
    $this->benefits_model->delete_package_assignments($this->input->post('id'));
    for($i = 0; $i < count($restaurants); $i++)
    {
        // create assignments
        $this->benefits_model->assign_package_to_restaurant($this->input->post('id'),$restaurants[$i]);
    }
    $this->alerts->save_successfull_alert();
  }
  
  //sort benefit items
  function sort_items()
  {
      $sorting_number=1;
      foreach($this->input->post('sorting_list') as $item)
      {
          $this->benefits_model->sort_item($item,$sorting_number);
          $sorting_number++;
      }
  }
  
  
  function delete_item()
  {
      $this->benefits_model->delete_item($this->input->post('item_id'));
      $this->reload_items_view_for_package($this->input->post('package_id'));
  }
  
  function delete_package()
  {
      $this->benefits_model->delete_package_assignments($this->input->post('package_id'));
      $this->benefits_model->delete_package_items($this->input->post('package_id'));
      $this->benefits_model->delete_package($this->input->post('package_id'));
  }
  
  function reload_items_view_for_package($id)
   {
        $data= array('package_id'=>$id, 'items'=>$this->benefits_model->get_items_for_benefit_package($id));
        print $this->load->view('hr/benefits/benefit_package_items', $data, true);
   }
   
   
}
?>
