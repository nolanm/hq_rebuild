<div class="page-header">
    <h2>Site Administrator Logins</h2>
</div>

<script type="text/javascript" src="<?php echo base_url();?>js/administrator_logins/administrator.js"></script>

<? /*
    * Show pending admin requests if any are available.
    */
    $pending_requests= $view_data['pending_requests'];
    if(count($pending_requests)>0)
    {
        ?>
            <a class="lead" data-toggle="collapse" data-target="#pending_requests">
                Pending Administrator Request
            </a><hr>
            <div id="pending_requests" class="collapse">
        <?
        foreach($pending_requests as $request)
        {
                ?>
                <div class='accordion' id='accordion_request<?print"$request->id";?>'>
                    <div class="accordion-group">
                        <div class="accordion-heading">&nbsp; 
                            <?print"$request->admin_name ";?> - <small class="muted">sent on <em><? print date ('F j, Y', strtotime ($request->request_date));?></em></small>
                            <a href="send_email<?print$request->adminid?>"  class="btn btn-link" >Send Reminder Email</a>
                        </div>
                    </div><!-- end of <div class="accordion-group"> -->
                </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                <?
        }
        ?>
                <hr>
            </div>
        <?
    }
?>
<!-- SHow other Enterprise Logins -->
<a class="lead" data-toggle="collapse" data-target="#enterprise_logins">
    Enterprise Operator Logins
</a><hr>
<div id="enterprise_logins" class="collapse">
 <?
  $enterprise_admins= $view_data['enterprise_admins'];
        
        foreach($enterprise_admins as $admin_row)
        {
           
                ?>
                
               
                <div class='accordion' id='accordion_admin<?print"$admin_row->adminid";?>'>
                    <div class="accordion-group">
                        <div class="accordion-heading">&nbsp; 
                            <?print"$admin_row->firstname $admin_row->lastname ";?>
                            <a href="#editAdminModal<?print$admin_row->adminid?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-pencil"></i>Edit Administrator info</a>
                        </div>
                    </div><!-- end of <div class="accordion-group"> -->
                </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                
                <div id="editAdminModal<?print$admin_row->adminid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3 id="myModalLabel">Edit Administrator Information</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div id="info_alert<?print"$admin_row->adminid";?>"></div>
                            <div class="control-group">
                                <label class="control-label" for="username<?print$admin_row->adminid;?>">Username:</label>
                                <div class="controls">
                                    <?php echo form_input(array(
                                                'name' => 'username'.$admin_row->adminid,
                                                'id' => 'username'.$admin_row->adminid,
                                                'value'=> $admin_row->username));
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="firstname<?print$admin_row->adminid;?>">First Name:</label>
                                <div class="controls">
                                    <?php echo form_input(array(
                                                'name' => 'firstname'.$admin_row->adminid,
                                                'id' => 'firstname'.$admin_row->adminid,
                                                'value'=> $admin_row->firstname));
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="lastname<?print$admin_row->adminid;?>">Last Name:</label>
                                <div class="controls">
                                    <?php echo form_input(array(
                                                'name' => 'lastname'.$admin_row->adminid,
                                                'id' => 'lastname'.$admin_row->adminid,
                                                'value'=> $admin_row->lastname));
                                    ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="email<?print$admin_row->adminid;?>">Email:</label>
                                <div class="controls">
                                    <?php echo form_input(array(
                                                'name' => 'email'.$admin_row->adminid,
                                                'id' => 'email'.$admin_row->adminid,
                                                'value'=> $admin_row->email));
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                        <button class="btn btn-primary" onclick="update_admin_info(<?print$admin_row->adminid;?>)">Save changes</button>
                    </div>
                </div>
                <?
            
        }
 ?>
                <hr>
</div>
    

    <!-- Buttons to trigger modals -->
   <a href="#addNewModal" role="button" class="btn btn-primary" data-toggle="modal">Add New Administrator</a>
    <a href="#addExistingModal" role="button" class="btn btn-primary" data-toggle="modal">Add Existing Administrator</a>
    <a href="#deleteModal" role="button" class="btn btn-danger" data-toggle="modal">Delete Administrator</a>
     
     
    <!-- Add New Administrator Modal -->
    <div id="addNewModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add New Administrator</h3>
        </div>
        <div class="modal-body hero-unit-basic">
            <form class="form-horizontal">
                <div id="new_admin_alert"></div>
                <div class="control-group">
                    <label class="control-label" for="username">Username:</label>
                    <div class="controls">
                        <?php echo form_input(array(
                                    'name' => 'username',
                                    'id' => 'username',
                                   'placeholder' => 'Username'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password1">Password:</label>
                    <div class="controls">
                        <?php echo form_password(array(
                                    'name' => 'password1',
                                    'id' => 'password1',
                            'placeholder' => 'Password'));
                        ?>
                </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="password2">Confirmed Password:</label>
                    <div class="controls">
                        <?php echo form_password(array(
                                    'name' => 'password2',
                                    'id' => 'password2',
                            'placeholder' => 'Confirm'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="firstname">First Name:</label>
                    <div class="controls">
                        <?php echo form_input(array(
                                    'name' => 'firstname',
                                    'id' => 'firstname',
                                    'placeholder' => 'First Name'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="lastname">Last Name:</label>
                    <div class="controls">
                        <?php echo form_input(array(
                                    'name' => 'lastname',
                                    'id' => 'lastname',
                                    'placeholder' => 'Last Name'));
                        ?>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="email">Email:</label>
                    <div class="controls">
                        <?php echo form_input(array(
                                    'name' => 'email',
                                    'id' => 'email',
                                    'placeholder' => 'Email'));
                        ?>
                    </div>
                </div>
                
                <div  rel="tooltip" data-placement="top" title="Admin can access all functionallity for every store under the organization.">
                    <label class="control-label" for="email">Permissions:</label>
                    <div class="controls">
                        <label class="checkbox" data-toggle="collapse" data-target="#non_total_div">
                        <input type="checkbox" name="operation_permissions" id="operation_permissions" value="operation">Total Operational Permissions 
                        </label> 
                    </div>  
                </div>
                
                <div id="non_total_div" class="hero-unit-basic collapse in">
                
                        
                    <div class="controls">
                                <label class="checkbox" data-toggle="collapse" data-target="#hr_restaurants">
                                <input type="checkbox"  id="hr_checkbox" value="Hello"> Human Resources Permissions
                                </label>
                                
                                <div id="hr_restaurants" class="collapse"> 
                                    <label> Choose individual restaurants for human resource permissions:</label>
                                        <select multiple="multiple" id="hr_selector">
                                        <?
                                            foreach($view_data['restaurants_array'] as $restaurant)
                                            {
                                                print"<option value='".$restaurant->RestaurantID."'>".
                                                    $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                            }
                                        ?>
                                        </select>
                                    </div>
                    </div>
                    
                    
                    <div class="controls">
                                    <label class="checkbox" data-toggle="collapse" data-target="#lsm_restaurants">
                                <input type="checkbox"  id="lsm_checkbox" value="Hello"> Local Store Marketing Permissions
                                </label>
                                
                                <div id="lsm_restaurants" class="collapse"> 
                                    <label> Choose individual restaurants for marketing permissions:</label>
                                        <select multiple="multiple" id="lsm_selector">
                                        <?
                                            foreach($view_data['restaurants_array'] as $restaurant)
                                            {
                                                print"<option value='".$restaurant->RestaurantID."'>".
                                                    $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                            }
                                        ?>
                                        </select>
                                    </div>
                        </div>
                    
                    
                    <div class="controls">
                    <label class="checkbox" data-toggle="collapse" data-target="#ro_restaurants">
                                <input type="checkbox"  id="ro_checkbox" value="Hello"> Restaurant Operation Permissions
                                </label>
                                
                                <div id="ro_restaurants" class="collapse"> 
                                    <label> Choose individual restaurants for operation permissions:</label>
                                        <select multiple="multiple" id="ro_selector">
                                        <?
                                            foreach($view_data['restaurants_array'] as $restaurant)
                                            {
                                                print"<option value='".$restaurant->RestaurantID."'>".
                                                    $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                            }
                                        ?>
                                        </select>
                                    </div>
                        </div>
                    
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" onclick="add_new_admin()">Save changes</button>
        </div>
    </div>
    
    
    <!-- Add Permissions to Existing  Administrator Modal-->
    <div id="addExistingModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Add Existing Administrator</h3>
        </div>
        <div class="modal-body">
            <form class="form-horizontal">
            <div id="existing_admin_alert"></div>
            <p class="lead"><h4>Search Administrator:<br/> <small>(You must know first name, last name, and username to add administrator)</small></h4></p>
            <table class="table table-condensed">
                <thead>
                    <th>
                        First Name
                    </th>
                    <th>
                        Last Name
                    </th>
                    <th>
                        Username
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input id="search_admin_first" class="input-medium" onKeyUp="admin_search()" type="text" placeholder="John">
                        </td> 
                        <td>
                            <input id="search_admin_last" class="input-medium" onKeyUp="admin_search()" type="text" placeholder="Doe">
                        </td> 
                        <td>
                            <input id="search_admin_username" class="input-medium" onKeyUp="admin_search()" type="text" placeholder="jDoe">
                        </td> 
                    <tr>
                </tbody>
            </table>
        
            <div id="admin_results"></div>
            
            <div id="existing_permissions" class="hide">
                <p class="lead"><h4>Permissions:<br/> <small>(What permissions would you like this administrator to have?)</small></h4></p>
                
                <div>
                   <span rel="tooltip" data-placement="top" title="Admin can access all functionallity for every store under the organization.">
                        <label class="checkbox" data-toggle="collapse" data-target="#non_total_div2">
                            <input type="checkbox" name="operation_permissions_existing" id="total_permissions_existing" value="operation">Total Operational Permissions 
                        </label>
                    </span>
                </div>

                <div id="non_total_div2" class="collapse in">
                    <label class="checkbox" data-toggle="collapse" data-target="#hr_restaurants2">
                        <input type="checkbox"  id="hr_checkbox_existing" value="Hello"> Human Resources Permissions
                    </label>
                    <div id="hr_restaurants2" class="collapse"> 
                        <label> Choose individual restaurants for human resource permissions:</label>
                            <select multiple="multiple" id="hr_selector_existing">
                            <?
                                foreach($view_data['restaurants_array'] as $restaurant)
                                {
                                    print"<option value='".$restaurant->RestaurantID."'>".
                                        $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                }
                            ?>
                            </select>
                    </div>
                    
                    <label class="checkbox" data-toggle="collapse" data-target="#lsm_restaurants2">
                        <input type="checkbox"  id="lsm_checkbox_existing" value="Hello"> Local Store Marketing Permissions
                    </label>
                    <div id="lsm_restaurants2" class="collapse"> 
                        <label> Choose individual restaurants for marketing permissions:</label>
                            <select multiple="multiple" id="lsm_selector_existing">
                            <?
                                foreach($view_data['restaurants_array'] as $restaurant)
                                {
                                    print"<option value='".$restaurant->RestaurantID."'>".
                                        $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                }
                            ?>
                            </select>
                    </div>
                    
                    
                    <label class="checkbox" data-toggle="collapse" data-target="#ro_restaurants2">
                        <input type="checkbox"  id="ro_checkbox_existing" value="Hello"> Restaurant Operation Permissions
                    </label>
                    <div id="ro_restaurants2" class="collapse"> 
                        <label> Choose individual restaurants for operation permissions:</label>
                            <select multiple="multiple" id="ro_selector_existing">
                            <?
                                foreach($view_data['restaurants_array'] as $restaurant)
                                {
                                    print"<option value='".$restaurant->RestaurantID."'>".
                                        $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                }
                            ?>
                            </select>
                    </div>
                    
                </div> 
            </div>
            </form>     
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button id="add_existing_button" class="btn btn-primary disabled" onclick="add_request()">Send Add Request to Administrator</button>
        </div>
    </div>
    
    <!-- Delete Administrator Modal -->
    <div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Delete Administrator</h3>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                 <tbody>
                    <? foreach($view_data['admin_array'] as $admin)
                    {
                    ?>
                    <tr>
                        <td>
                            <?print $admin->firstname." ".$admin->lastname." - (".$admin->username.")";?>
                        </td>
                        <td>
                            
                            <button class="btn btn-danger btn-small" onclick="admin_delete(<?print $admin->adminid;?>)"><i class="icon-trash"></i> Delete</button>
                       </td>
                        
                    </tr>
                    
                    <?}?>
                </tbody>
            </table>
        </div>
       
    </div>
    <br/><br/>
    
    <?
              
        $sort_by=$view_data['sort_by'];
        $admin_sort="";
        $rest_sort="";
        $function_sort="";
        if($sort_by=='admin')
        {
            $admin_sort='active';
        }
        if($sort_by=='restaurant')
        {
            $rest_sort='active';
        }
        if($sort_by=='function')
        {
           $function_sort='active';
        }
    ?>
    
        <p>Sort By:</p>
    <div class="btn-group" data-toggle="buttons-radio">
        <a href="<?php echo base_url();?>index.php/administrator_logins/administrator/sort_by_admin" class="btn btn-primary span2 <?print $admin_sort;?>">Administrator</a>
        <a href="<?php echo base_url();?>index.php/administrator_logins/administrator/sort_by_restaurant" class="btn btn-primary span2 <?print $rest_sort;?>">Restaurant</a>
        <a href="<?php echo base_url();?>index.php/administrator_logins/administrator/sort_by_function" class="btn btn-primary span2 <?print $function_sort;?>">Function</a>
    </div>
    <br/><br/>
        
    
    
 <?
        $permissions= $view_data['permissions_array'];
        $restaurants= $view_data['restaurants_array'];
        $admins= $view_data['admin_array'];
        
if($sort_by=='admin')
{
    $ownerid="";    
        foreach($admins as $admin_row)
        {
            $restaurant_count=0;
            ?>
            <!-- Modals -->
            <div id="editAdminModal<?print$admin_row->adminid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Edit Administrator Information</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div id="info_alert<?print"$admin_row->adminid";?>"></div>
                        <div class="control-group">
                            <label class="control-label" for="username<?print$admin_row->adminid;?>">Username:</label>
                            <div class="controls">
                                <?php echo form_input(array(
                                            'name' => 'username'.$admin_row->adminid,
                                            'id' => 'username'.$admin_row->adminid,
                                            'value'=> $admin_row->username));
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="firstname<?print$admin_row->adminid;?>">First Name:</label>
                            <div class="controls">
                                <?php echo form_input(array(
                                            'name' => 'firstname'.$admin_row->adminid,
                                            'id' => 'firstname'.$admin_row->adminid,
                                            'value'=> $admin_row->firstname));
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="lastname<?print$admin_row->adminid;?>">Last Name:</label>
                            <div class="controls">
                                <?php echo form_input(array(
                                            'name' => 'lastname'.$admin_row->adminid,
                                            'id' => 'lastname'.$admin_row->adminid,
                                            'value'=> $admin_row->lastname));
                                ?>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="email<?print$admin_row->adminid;?>">Email:</label>
                            <div class="controls">
                                <?php echo form_input(array(
                                            'name' => 'email'.$admin_row->adminid,
                                            'id' => 'email'.$admin_row->adminid,
                                            'value'=> $admin_row->email));
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                    <button class="btn btn-primary" onclick="update_admin_info(<?print$admin_row->adminid;?>)">Save changes</button>
                </div>
            </div>
             
            <div id="addRestaurantModal<?print$admin_row->adminid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="myModalLabel">Add Restaurant Permissions</h3>
                        </div>
                        <div class="modal-body">



                                
                            <form>
                                 <?echo form_hidden("adminid", $admin_row->adminid);?>
                                <fieldset>
                                
                                <span class="help-block">Choose restaurants to be added to <?print"$admin_row->firstname $admin_row->lastname ";?> access.</span>
                                <label class="checkbox" data-toggle="collapse" data-target="#choose_rest_<?print$admin_row->adminid;?>">
                                <input type="checkbox" id="all_rest_<?print$admin_row->adminid;?>" value="Hello"> All Restaurants
                                </label>
                                
                                <div id="choose_rest_<?print$admin_row->adminid;?>" class="collapse in"> 
                                    <label> Choose individual restaurants.</label>
                                        <select multiple="multiple" id="restaurant_selector<?print$admin_row->adminid;?>">
                                        <?
                                            foreach($restaurants as $restaurant)
                                            {
                                                print"<option value='".$restaurant->RestaurantID."'>".
                                                    $restaurant->RestaurantID." - ".$restaurant->UnitName."</option>";

                                            }
                                        ?>
                                        </select>
                                    </div>
                                </fieldset>
                                </form>
                                   
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            <button class="btn btn-primary" onclick="add_restaurants(<?print$admin_row->adminid;?>)">Save changes</button>
                        </div>
                    </div>   
            <?
                if($ownerid!= $admin_row->OwnerID)
                {
                    print"<p class='lead'>".$admin_row->FirstName." ".$admin_row->LastName." Ownership</p><hr>";
                    $ownerid=$admin_row->OwnerID;
                }
            ?>
            
            
                <div class='accordion' id='accordion_admin<?print"$admin_row->adminid";?>'>
                    <div class="accordion-group">
                        <div class="accordion-heading">&nbsp; 
                            <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_admin<?print"$admin_row->adminid";?>" data-target="#collapse<?print"$admin_row->adminid";?>">
                                <i class="icon-tasks"></i>
                            </a>
                            <?print"$admin_row->firstname $admin_row->lastname ";?>
                            <a href="#editAdminModal<?print$admin_row->adminid?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-pencil"></i>Edit Administrator info</a> 
                            <a href="#addRestaurantModal<?print$admin_row->adminid?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-plus"></i> Add Restaurant Permissions</a>
                            
                        </div>
                        <div id="collapse<?print"$admin_row->adminid";?>" class="accordion-body collapse">
                            <div class="accordion-inner">
                
            <?
               foreach($permissions as $row)
               {
                   
                   if($row->adminid == $admin_row->adminid)
                   {
                       $restaurant_count++;
            ?>
                                <div class='accordion' id='accordion_<?print"$row->permissions_id"?>'>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">&nbsp;
                                            <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_<?print"$row->permissions_id"?>" data-target="#collapse_<?print"$row->permissions_id"?>">
                                                <i class="icon-list-alt"></i>
                                            </a>
                                            <?print"$row->RestaurantID - $row->UnitName";?> 
                                            <button rel="tooltip" data-placement="top" title="Remove admin's permissions for this restaurant" onclick="uncheck_all_permissions(<?print"$row->permissions_id";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                            <button rel="tooltip" data-placement="top" title="Add all permissions for this restaurant" onclick="check_all_permissions(<?print"$row->permissions_id";?>)" class="btn btn-link btn-small pull-right"><i class="icon-plus-sign"></i></button>
                                            <div id="alert_<?print"$row->permissions_id"?>"></div>
                                        </div>
                                        <div id="collapse_<?print"$row->permissions_id"?>" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <div class="hero-unit-basic">
                                                    <form class="form-horizontal">
                                                        
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>
                                                                    Human Resources
                                                                 </th>
                                                                <th>
                                                                    Local Store Marketing
                                                                 </th>
                                                                <th>
                                                                    Restaurant Operations
                                                                </th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                     <td>
                                                                        <?
                                                                            $benefits= array(
                                                                                'id'          => "benefits-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->benefits,
                                                                                'onclick'     => "update_permission('benefits-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($benefits);
                                                                        ?>
                                                                        Benefits
                                                                    </td>
                                                                    
                                                                    
                                                                    <td>
                                                                        <?
                                                                            $content= array(
                                                                                'id'          => "content-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->content,
                                                                                'onclick'     => "update_permission('content-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($content);
                                                                        ?>
                                                                        Custom Content
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $restaurant_settings= array(
                                                                                'id'          => "restaurant_settings-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->restaurant_settings,
                                                                                'onclick'     => "update_permission('restaurant_settings-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($restaurant_settings);
                                                                        ?>
                                                                        Restaurant Settings
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td>
                                                                       <?
                                                                            $application_settings= array(
                                                                                'id'          => "application_settings-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->application_settings,
                                                                                'onclick'     => "update_permission('application_settings-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($application_settings);
                                                                        ?>
                                                                        Application Settings
                                                                    </td>
                                                                    <td>
                                                                       <?
                                                                            $mcteachers_night= array(
                                                                                'id'          => "mcteachers_night-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->mcteachers_night,
                                                                                'onclick'     => "update_permission('mcteachers_night-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($mcteachers_night);
                                                                        ?> 
                                                                        McTeacher's Night
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $hours= array(
                                                                                'id'          => "hours-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->hours,
                                                                                'onclick'     => "update_permission('hours-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($hours);
                                                                        ?>
                                                                        Restaurant Hours
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <?
                                                                            $ray_kroc= array(
                                                                                'id'          => "ray_kroc-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->ray_kroc,
                                                                                'onclick'     => "update_permission('ray_kroc-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($ray_kroc);
                                                                        ?>
                                                                        Ray Kroc
                                                                    </td>
                                                                    <td>
                                                                       <?
                                                                            $donation_request= array(
                                                                                'id'          => "donation_request-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->donation_request,
                                                                                'onclick'     => "update_permission('donation_request-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($donation_request);
                                                                        ?> 
                                                                        Donation Request
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $services= array(
                                                                                'id'          => "services-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->services,
                                                                                'onclick'     => "update_permission('services-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($services);
                                                                        ?>
                                                                        Restaurant Services
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?
                                                                            $hiring_day= array(
                                                                                'id'          => "hiring_day-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->hiring_day,
                                                                                'onclick'     => "update_permission('hiring_day-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($hiring_day);
                                                                        ?>
                                                                        Hiring Day
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <?
                                                                            $grand_opening= array(
                                                                                'id'          => "grand_opening-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->grand_opening,
                                                                                'onclick'     => "update_permission('grand_opening-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($grand_opening);
                                                                        ?>
                                                                        Grand Opening
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                   <td>
                                                                        <?
                                                                            $jobs_crew= array(
                                                                                'id'          => "jobs_crew-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->jobs_crew,
                                                                                'onclick'     => "update_permission('jobs_crew-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($jobs_crew);
                                                                        ?>
                                                                        Crew Jobs
                                                                    </td>
                                                                  
                                                                    <td>
                                                                        <?
                                                                            $calendar_of_events= array(
                                                                                'id'          => "calendar_of_events-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->calendar_of_events,
                                                                                'onclick'     => "update_permission('calendar_of_events-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($calendar_of_events);
                                                                        ?>
                                                                        Calendar of Events
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td>
                                                                       <?
                                                                        if(!$this->session->userdata('mcopco'))
                                                                        {
                                                                            $jobs_mgmt= array(
                                                                                'id'          => "jobs_mgmt-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->jobs_mgmt,
                                                                                'onclick'     => "update_permission('jobs_mgmt-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($jobs_mgmt);
                                                                            print" Management Jobs";
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $tours= array(
                                                                                'id'          => "tours-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->tours,
                                                                                'onclick'     => "update_permission('tours-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($tours);
                                                                        ?>
                                                                        Tours
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $orange_bowl= array(
                                                                                'id'          => "orange_bowl-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->orange_bowl,
                                                                                'onclick'     => "update_permission('orange_bowl-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($orange_bowl);
                                                                        ?> 
                                                                        Orange Bowl
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $power_bowl= array(
                                                                                'id'          => "power_bowl-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->power_bowl,
                                                                                'onclick'     => "update_permission('power_bowl-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($power_bowl);
                                                                        ?> 
                                                                        Power Bowl
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $birthday_party_to_go= array(
                                                                                'id'          => "birthday_party_to_go-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->birthday_party_to_go,
                                                                                'onclick'     => "update_permission('birthday_party_to_go-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($birthday_party_to_go);
                                                                        ?> 
                                                                        Birthday Party To Go
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <?
                                                                            $birthday_party_reservation= array(
                                                                                'id'          => "birthday_party_reservation-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->birthday_party_reservation,
                                                                                'onclick'     => "update_permission('birthday_party_reservation-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($birthday_party_reservation);
                                                                        ?>
                                                                        Birthday Party Reservation
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <?
                                                                            $brand_trust= array(
                                                                                'id'          => "brand_trust-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->brand_trust,
                                                                                'onclick'     => "update_permission('brand_trust-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($brand_trust);
                                                                        ?>
                                                                        Brand Trust
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_hr(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i>Apply All Human Resource Functions</button>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_lsm(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Local Store Marketing Functions</button>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_operations(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Restaurant Operation Functions</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
            <?
                   }//end of if
               }//end of foreach($permissions)
               if($restaurant_count==0)
               {
                   print"<p class='lead'>$admin_row->firstname $admin_row->lastname does not have any permissions for any restaurants yet.</p>";
               }
    ?>
                            </div><!-- end of accordian inner -->
                        </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                    </div><!-- end of <div class="accordion-group"> -->
                </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
            
            
<?
        }//end of foreach($admins)
        if(count($admins)==0)
        {
            ?><br/><div class="hero-unit"><p>You do not have any administrators currently active for this organization.</p>
                <p>To create a new administrator, click the 'Add New Administrator' button shown above.</p></div><?
        }
}//end if($sort_by=='admin')
else if($sort_by=='restaurant')
{
    $ownerid='';
        foreach($restaurants as $restaurant)
        {
             if($ownerid!= $restaurant->OwnerID)
                {
                    print"<p class='lead'>".$restaurant->FirstName." ".$restaurant->LastName." Ownership</p><hr>";
                    $ownerid=$restaurant->OwnerID;
                }
            
            ?>
           
             
                <div class='accordion' id='accordion_restaurant<?print $restaurant->RestaurantID;?>'>
                    <div class="accordion-group">
                        <div class="accordion-heading">&nbsp; 
                            <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_restaurant<?print"$restaurant->RestaurantID";?>" data-target="#collapse<?print"$restaurant->RestaurantID";?>">
                                <i class="icon-tasks"></i>
                            </a>
                            <?print $restaurant->RestaurantID." - ".$restaurant->UnitName; 
                                if(!empty($restaurant->StoreName))
                                {
                                   print" (".$restaurant->StoreName.")";
                                }
                             ?>
                        </div>
                        
                        
                        <div id="collapse<?print $restaurant->RestaurantID;?>" class="accordion-body collapse">
                            <div class="accordion-inner">
            <?
                    $admin_to_restaurant_count=0;
                    foreach($permissions as $row)
                    {
                        if($row->correlation_id==$restaurant->RestaurantID)
                        {
            ?>
                                <div class='accordion' id='accordion_<?print"$row->permissions_id"?>'>
                                    <div class="accordion-group">
                                        <div class="accordion-heading">&nbsp;
                                            <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_<?print"$row->permissions_id"?>" data-target="#collapse_<?print"$row->permissions_id"?>">
                                                <i class="icon-list-alt"></i>
                                            </a>
                                           <?print"$row->firstname $row->lastname ";?>
                                            <button rel="tooltip" data-placement="top" title="Remove restaurant's permissions for this admin" onclick="uncheck_all_permissions(<?print"$row->permissions_id";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                             <button rel="tooltip" data-placement="top" title="Add all restaurant's permissions for this admin" onclick="check_all_permissions(<?print"$row->permissions_id";?>)" class="btn btn-link btn-small pull-right"><i class="icon-plus-sign"></i></button>
                                        </div>
                                        <div id="collapse_<?print"$row->permissions_id"?>" class="accordion-body collapse">
                                            <div class="accordion-inner">
                                                <div class="hero-unit-basic">
                                                    <form class="form-horizontal">
                                                        
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <th>
                                                                    Human Resources
                                                                 </th>
                                                                <th>
                                                                    Local Store Marketing
                                                                 </th>
                                                                <th>
                                                                    Restaurant Operations
                                                                </th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                     <td>
                                                                        <?
                                                                            $benefits= array(
                                                                                'id'          => "benefits-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->benefits,
                                                                                'onclick'     => "update_permission('benefits-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($benefits);
                                                                        ?>
                                                                        Benefits
                                                                    </td>
                                                                    
                                                                    
                                                                    <td>
                                                                        <?
                                                                            $content= array(
                                                                                'id'          => "content-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->content,
                                                                                'onclick'     => "update_permission('content-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($content);
                                                                        ?>
                                                                        Custom Content
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $restaurant_settings= array(
                                                                                'id'          => "restaurant_settings-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->restaurant_settings,
                                                                                'onclick'     => "update_permission('restaurant_settings-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($restaurant_settings);
                                                                        ?>
                                                                        Restaurant Settings
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td>
                                                                       <?
                                                                            $application_settings= array(
                                                                                'id'          => "application_settings-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->application_settings,
                                                                                'onclick'     => "update_permission('application_settings-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($application_settings);
                                                                        ?>
                                                                        Application Settings
                                                                    </td>
                                                                    <td>
                                                                       <?
                                                                            $mcteachers_night= array(
                                                                                'id'          => "mcteachers_night-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->mcteachers_night,
                                                                                'onclick'     => "update_permission('mcteachers_night-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($mcteachers_night);
                                                                        ?> 
                                                                        McTeacher's Night
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $hours= array(
                                                                                'id'          => "hours-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->hours,
                                                                                'onclick'     => "update_permission('hours-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($hours);
                                                                        ?>
                                                                        Restaurant Hours
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                         <?
                                                                            $ray_kroc= array(
                                                                                'id'          => "ray_kroc-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->ray_kroc,
                                                                                'onclick'     => "update_permission('ray_kroc-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($ray_kroc);
                                                                        ?>
                                                                        Ray Kroc
                                                                    </td>
                                                                    <td>
                                                                       <?
                                                                            $donation_request= array(
                                                                                'id'          => "donation_request-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->donation_request,
                                                                                'onclick'     => "update_permission('donation_request-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($donation_request);
                                                                        ?> 
                                                                        Donation Request
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $services= array(
                                                                                'id'          => "services-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->services,
                                                                                'onclick'     => "update_permission('services-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($services);
                                                                        ?>
                                                                        Restaurant Services
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?
                                                                            $hiring_day= array(
                                                                                'id'          => "hiring_day-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->hiring_day,
                                                                                'onclick'     => "update_permission('hiring_day-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($hiring_day);
                                                                        ?>
                                                                        Hiring Day
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <?
                                                                            $grand_opening= array(
                                                                                'id'          => "grand_opening-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->grand_opening,
                                                                                'onclick'     => "update_permission('grand_opening-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($grand_opening);
                                                                        ?>
                                                                        Grand Opening
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                   <td>
                                                                        <?
                                                                            $jobs_crew= array(
                                                                                'id'          => "jobs_crew-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->jobs_crew,
                                                                                'onclick'     => "update_permission('jobs_crew-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($jobs_crew);
                                                                        ?>
                                                                        Crew Jobs
                                                                    </td>
                                                                  
                                                                    <td>
                                                                        <?
                                                                            $calendar_of_events= array(
                                                                                'id'          => "calendar_of_events-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->calendar_of_events,
                                                                                'onclick'     => "update_permission('calendar_of_events-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($calendar_of_events);
                                                                        ?>
                                                                        Calendar of Events
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td>
                                                                        <?
                                                                        if(!$this->session->userdata('mcopco'))
                                                                        {
                                                                            $jobs_mgmt= array(
                                                                                'id'          => "jobs_mgmt-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->jobs_mgmt,
                                                                                'onclick'     => "update_permission('jobs_mgmt-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($jobs_mgmt);
                                                                            print" Management Jobs";
                                                                        }
                                                                        ?>
                                                                       
                                                                    </td>
                                                                    <td>
                                                                        <?
                                                                            $tours= array(
                                                                                'id'          => "tours-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->tours,
                                                                                'onclick'     => "update_permission('tours-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($tours);
                                                                        ?>
                                                                        Tours
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $orange_bowl= array(
                                                                                'id'          => "orange_bowl-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->orange_bowl,
                                                                                'onclick'     => "update_permission('orange_bowl-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($orange_bowl);
                                                                        ?> 
                                                                        Orange Bowl
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $power_bowl= array(
                                                                                'id'          => "power_bowl-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->power_bowl,
                                                                                'onclick'     => "update_permission('power_bowl-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($power_bowl);
                                                                        ?> 
                                                                        Power Bowl
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                       <?
                                                                            $birthday_party_to_go= array(
                                                                                'id'          => "birthday_party_to_go-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->birthday_party_to_go,
                                                                                'onclick'     => "update_permission('birthday_party_to_go-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($birthday_party_to_go);
                                                                        ?> 
                                                                        Birthday Party To Go
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <?
                                                                            $birthday_party_reservation= array(
                                                                                'id'          => "birthday_party_reservation-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->birthday_party_reservation,
                                                                                'onclick'     => "update_permission('birthday_party_reservation-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($birthday_party_reservation);
                                                                        ?>
                                                                        Birthday Party Reservation
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td>
                                                                        <?
                                                                            $brand_trust= array(
                                                                                'id'          => "brand_trust-".$row->permissions_id,
                                                                                'value'       => 'accept',
                                                                                'checked'     => $row->brand_trust,
                                                                                'onclick'     => "update_permission('brand_trust-".$row->permissions_id."')"
                                                                             );
                                                                            print form_checkbox($brand_trust);
                                                                        ?>
                                                                        Brand Trust
                                                                    </td>
                                                                    <td></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_hr(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i>Apply All Human Resource Functions</button>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_lsm(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Local Store Marketing Functions</button>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn btn-info" type="button" onclick="check_all_operations(<?print"$row->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Restaurant Operation Functions</button>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
            <?
                            $admin_to_restaurant_count++;
                        }
                    }
                    
                    if($admin_to_restaurant_count==0)
                    {
                        ?><p class='lead'>There are no administrators with permissions for this restaurant.</p><?
                    }
        
        
    ?>
                            </div><!-- end of accordian inner -->
                        </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                    </div><!-- end of <div class="accordion-group"> -->
                </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
            
            
<?
        }
}
else if($sort_by=='function')
{
   ?>  
       
       <p><table class="table table-bordered table-condensed"><tr><td> <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse"  data-target="#collapse_hr">
                                <i class="icon-tasks"></i>
                                </a>
                                Human Resources
               </td></tr> </table></p>
                       
                        
                        
                        <div id="collapse_hr" class="collapse">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#jobs_crew" data-toggle="tab">Crew Jobs</a></li>
                                  <?if(!$this->session->userdata('mcopco')){?>
                                  <li><a href="#jobs_mgmt" data-toggle="tab">Management Jobs</a></li>
                                  <?}?>
                                  <li><a href="#benefits" data-toggle="tab">Benefits</a></li>
                                  <li><a href="#app_settings" data-toggle="tab">Application Settings</a></li>
                                  <li><a href="#ray_kroc" data-toggle="tab">Ray Kroc</a></li>
                                  <li><a href="#hiring" data-toggle="tab">Hiring Day</a></li>
                                </ul>
                                <div class="tab-content">
                                    
                                    <div class="tab-pane active" id="jobs_crew">
                                        
                                        <p class="lead">Crew Jobs:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->jobs_crew)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {  
                                                   print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_jobs_crew<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_jobs_crew<?print $adminid;?>" data-target="#collapse_add_jobs_crew<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_jobs_crew<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $jobs_crew= array(
                                                                            'id'          => "jobs_crew-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('jobs_crew-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($jobs_crew);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                    
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_jobs_crew<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_jobs_crew<?print $row->adminid;?>" data-target="#collapse_jobs_crew<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                        
                                                    </div>
                                                    <div id="collapse_jobs_crew<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $jobs_crew= array(
                                                'id'          => "jobs_crew-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('jobs_crew-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($jobs_crew);
                                                                       
                                            print" ".$row->RestaurantID." - ".$row->UnitName; 
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>  
                                                       <div class='accordion' id='accordion_add_jobs_crew<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_jobs_crew<?print $adminid;?>" data-target="#collapse_add_jobs_crew<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_jobs_crew<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table id="collapse_add_jobs_crew_<?print $adminid;?>" class="table table-striped  collapse">
                                                            <?
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $jobs_crew= array(
                                                                            'id'          => "jobs_crew-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('jobs_crew-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($jobs_crew);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?> 
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  
                                </div>
                                    
                                    <div class="tab-pane" id="jobs_mgmt">
                                        
                                        <p class="lead">Management Jobs:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->jobs_mgmt)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {  
                                                   print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_jobs_mgmt<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_jobs_mgmt<?print $adminid;?>" data-target="#collapse_add_jobs_mgmt<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_jobs_mgmt<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $jobs_mgmt= array(
                                                                            'id'          => "jobs_mgmt-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('jobs_mgmt-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($jobs_mgmt);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                    
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_jobs_mgmt<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_jobs_mgmt<?print $row->adminid;?>" data-target="#collapse_jobs_mgmt<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                        
                                                    </div>
                                                    <div id="collapse_jobs_mgmt<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $jobs_mgmt= array(
                                                'id'          => "jobs_mgmt-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('jobs_mgmt-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($jobs_mgmt);
                                                                       
                                            print" ".$row->RestaurantID." - ".$row->UnitName; 
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>  
                                                       <div class='accordion' id='accordion_add_jobs_mgmt<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_jobs_mgmt<?print $adminid;?>" data-target="#collapse_add_jobs_mgmt<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_jobs_mgmt<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table id="collapse_add_jobs_mgmt_<?print $adminid;?>" class="table table-striped  collapse">
                                                            <?
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $jobs_mgmt= array(
                                                                            'id'          => "jobs_mgmt-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('jobs_mgmt-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($jobs_mgmt);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?> 
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  
                                </div>
                                <div class="tab-pane" id="benefits">
                                    <p class="lead">Benefits:</p>
                                  <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->benefits)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_benefits<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_benefits<?print $adminid;?>" data-target="#collapse_add_benefits<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_benefits<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $benefits= array(
                                                                            'id'          => "benefits-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('benefits-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($benefits);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                    
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_benefits<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_benefits<?print $row->adminid;?>" data-target="#collapse_benefits<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_benefits<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $benefits= array(
                                                'id'          => "benefits-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('benefits-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($benefits);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName; 
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>     
                                                <div class='accordion' id='accordion_add_benefits<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_benefits<?print $adminid;?>" data-target="#collapse_add_benefits<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_benefits<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $benefits= array(
                                                                            'id'          => "benefits-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('benefits-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($benefits);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?> 
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                                <div class="tab-pane" id="app_settings">
                                    <p class="lead">Application Settings:</p>
                                 <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->application_settings)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_app_settings<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_app_settings<?print $adminid;?>" data-target="#collapse_add_app_settings<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_app_settings<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $app_settings= array(
                                                                            'id'          => "application_settings-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('application_settings-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($app_settings);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                    
                                                    
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_application_settings<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_application_settings<?print $row->adminid;?>" data-target="#collapse_application_settings<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_application_settings<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $app_settings= array(
                                                'id'          => "application_settings-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('application_settings-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($app_settings);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;  
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>
                                                            
                                                <div class='accordion' id='accordion_add_app_settings<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_app_settings<?print $adminid;?>" data-target="#collapse_add_app_settings<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_app_settings<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $application_settings= array(
                                                                            'id'          => "application_settings-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('application_settings-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($application_settings);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                            <?}?>       
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                                  <div class="tab-pane" id="ray_kroc">
                                      <p class="lead">Ray Kroc:</p>
                                  <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->ray_kroc)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_ray_kroc<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_ray_kroc<?print $adminid;?>" data-target="#collapse_add_ray_kroc<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_ray_kroc<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table  class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $ray_kroc= array(
                                                                            'id'          => "ray_kroc-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('ray_kroc-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($ray_kroc);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_ray_kroc<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_ray_kroc<?print $row->adminid;?>" data-target="#collapse_ray_kroc<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_ray_kroc<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $ray_kroc= array(
                                                'id'          => "ray_kroc-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('ray_kroc-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($ray_kroc);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>
                                                <div class='accordion' id='accordion_add_ray_kroc<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_ray_kroc<?print $adminid;?>" data-target="#collapse_add_ray_kroc<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_ray_kroc<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table  class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $ray_kroc= array(
                                                                            'id'          => "ray_kroc-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('ray_kroc-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($ray_kroc);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                       <?}?>                      
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                                <div class="tab-pane" id="hiring">
                                    <p class="lead">Hiring Day:</p>
                                  <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->hiring_day)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_hiring<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_hiring<?print $adminid;?>" data-target="#collapse_add_hiring<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_hiring<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $hiring_day= array(
                                                                            'id'          => "hiring_day-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('hiring_day-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($hiring_day);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_hiring_day<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_hiring_day<?print $row->adminid;?>" data-target="#collapse_hiring_day<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_hiring_day<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $hiring= array(
                                                'id'          => "hiring_day-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('hiring_day-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($hiring);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;  
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                             <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>               
                                                <div class='accordion' id='accordion_add_hiring<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_hiring<?print $adminid;?>" data-target="#collapse_add_hiring<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_hiring<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $hiring_day= array(
                                                                            'id'          => "$hiring_day-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('$hiring_day-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($hiring_day);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                       <?}?>                      
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                              </div>
                            </div> <!-- /tabbable -->
                        
                
                </div><!-- <div id="collapse_hr print"> -->
            
     
       <p><table class="table table-bordered table-condensed"><tr><td> <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse"  data-target="#collapse_lsm">
                                <i class="icon-tasks"></i>
                                </a>
                               Local Store Marketing
               </td></tr></table> </p>
                       
                        
                        
                        <div id="collapse_lsm" class="collapse">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#content" data-toggle="tab">Custom Content</a></li>
                                  <li><a href="#mcteacher" data-toggle="tab">McTeacher's Night</a></li>
                                  <li><a href="#donation" data-toggle="tab">Donation Request</a></li>
                                  <li><a href="#grand" data-toggle="tab">Grand Opening</a></li>
                                  <li><a href="#calendar" data-toggle="tab">Calendar of Events</a></li>
                                  <li><a href="#tour" data-toggle="tab">Restaurant Tours</a></li>
                                  <li><a href="#orange" data-toggle="tab">Orange Bowl</a></li>
                                  <li><a href="#power" data-toggle="tab">Power Bowl</a></li>
                                  <li><a href="#bptg" data-toggle="tab">Birthday Party To Go</a></li>
                                  <li><a href="#bpr" data-toggle="tab">Birthday Party Reservation</a></li>
                                  <li><a href="#brand" data-toggle="tab">Brand Trust</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="content">
                                      <p class="lead">Custom Content:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->content)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_content<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_content<?print $adminid;?>" data-target="#collapse_add_content<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_content<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $content= array(
                                                                            'id'          => "content-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('content-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($content);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_content<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_content<?print $row->adminid;?>" data-target="#collapse_content<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_content<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $content= array(
                                                'id'          => "content-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('content-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($content);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>             
                                                <div class='accordion' id='accordion_add_content<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_content<?print $adminid;?>" data-target="#collapse_add_content<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_content<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $content= array(
                                                                            'id'          => "content-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('content-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($content);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>                     
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="mcteacher">
                                      <p class="lead">McTeacher's Night:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->mcteachers_night)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_mcteacher<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_mcteacher<?print $adminid;?>" data-target="#collapse_add_mcteacher<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_mcteacher<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $mcteachers_night= array(
                                                                            'id'          => "mcteachers_night-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('mcteachers_night-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($mcteachers_night);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_mcteachers_night<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_mcteachers_night<?print $row->adminid;?>" data-target="#collapse_mcteachers_night<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_mcteachers_night<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $mcteacher= array(
                                                'id'          => "mcteachers_night-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('mcteachers_night-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($mcteacher);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>             
                                                <div class='accordion' id='accordion_add_mcteacher<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_mcteacher<?print $adminid;?>" data-target="#collapse_add_mcteacher<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_mcteacher<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $mcteachers_night= array(
                                                                            'id'          => "mcteachers_night-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('mcteachers_night-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($mcteachers_night);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                        <?}?>                     
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="donation">
                                      <p class="lead">Donation Request:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->donation_request)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_donation<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_donation<?print $adminid;?>" data-target="#collapse_add_donation<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_donation<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $donation_request= array(
                                                                            'id'          => "donation_request-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('donation_request-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($donation_request);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_donation_request<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_donation_request<?print $row->adminid;?>" data-target="#collapse_donation_request<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_donation_request<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $donation= array(
                                                'id'          => "donation_request-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('donation_request-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($donation);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;  
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                                <div class='accordion' id='accordion_add_donation<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_donation<?print $adminid;?>" data-target="#collapse_add_donation<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_donation<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $donation_request= array(
                                                                            'id'          => "donation_request-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('donation_request-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($donation_request);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>            
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                    <div class="tab-pane" id="grand">
                                        <p class="lead">Grant Opening:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->grand_opening)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                    print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_grand<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_grand<?print $adminid;?>" data-target="#collapse_add_grand<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_grand<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $grand_opening= array(
                                                                            'id'          => "grand_opening-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('grand_opening-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($grand_opening);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_grand_opening<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_grand_opening<?print $row->adminid;?>" data-target="#collapse_grand_opening<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_grand_opening<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $grand= array(
                                                'id'          => "grand_opening-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('grand_opening-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($grand);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;   
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>             
                                                <div class='accordion' id='accordion_add_grand<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_grand<?print $adminid;?>" data-target="#collapse_add_grand<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_grand<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $grand_opening= array(
                                                                            'id'          => "grand_opening-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('grand_opening-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($grand_opening);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>            
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="calendar">
                                      <p class="lead">Calendar of Events:</p>
                                     <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->calendar_of_events)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_calendar<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_calendar<?print $adminid;?>" data-target="#collapse_add_calendar<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_calendar<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $calendar_of_events= array(
                                                                            'id'          => "calendar_of_events-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('calendar_of_events-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($calendar_of_events);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_calendar_of_events<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_calendar_of_events<?print $row->adminid;?>" data-target="#collapse_calendar_of_events<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_calendar_of_events<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $calendar= array(
                                                'id'          => "calendar_of_events-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('calendar_of_events-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($calendar);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>             
                                                <div class='accordion' id='accordion_add_calendar<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_calendar<?print $adminid;?>" data-target="#collapse_add_calendar<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_calendar<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $calendar_of_events= array(
                                                                            'id'          => "calendar_of_events-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('calendar_of_events-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($calendar_of_events);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>            
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                    <div class="tab-pane" id="tour">
                                        <p class="lead">Restaurant Tours:</p>
                                     <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->tours)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                    print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_tour<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_tour<?print $adminid;?>" data-target="#collapse_add_tour<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_tour<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $tours= array(
                                                                            'id'          => "tours-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('tours-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($tours);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_tours<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_tours<?print $row->adminid;?>" data-target="#collapse_tours<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_tours<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $tour= array(
                                                'id'          => "tours-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('tours-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($tour);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                                <div class='accordion' id='accordion_add_tour<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_tour<?print $adminid;?>" data-target="#collapse_add_tour<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_tour<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $tours= array(
                                                                            'id'          => "tours-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('tours-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($tours);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>           
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="orange">
                                      <p class="lead">Orange Bowl:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->orange_bowl)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_orange<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_orange<?print $adminid;?>" data-target="#collapse_add_orange<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_orange<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $orange_bowl= array(
                                                                            'id'          => "orange_bowl-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('orange_bowl-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($orange_bowl);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_orange_bowl<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_orange_bowl<?print $row->adminid;?>" data-target="#collapse_orange_bowl<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_orange_bowl<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $orange= array(
                                                'id'          => "orange_bowl-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('orange_bowl-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($orange);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;   
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                            <div class='accordion' id='accordion_add_orange<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_orange<?print $adminid;?>" data-target="#collapse_add_orange<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_orange<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $orange_bowl= array(
                                                                            'id'          => "orange_bowl-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('orange_bowl-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($orange_bowl);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                          <?}?>          
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="power">
                                      <p class="lead">Power Bowl:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->power_bowl)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_power<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_power<?print $adminid;?>" data-target="#collapse_add_power<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_power<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $power_bowl= array(
                                                                            'id'          => "power_bowl-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('power_bowl-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($power_bowl);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_power_bowl<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_power_bowl<?print $row->adminid;?>" data-target="#collapse_power_bowl<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_power_bowl<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                             $power= array(
                                                'id'          => "power_bowl-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('p-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($power);
                                                                       
                                            print " ".$row->RestaurantID." - ".$row->UnitName;  
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                            <div class='accordion' id='accordion_add_power<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_power<?print $adminid;?>" data-target="#collapse_add_power<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_power<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $power_bowl= array(
                                                                            'id'          => "power_bowl-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('power_bowl-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($power_bowl);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>          
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                    <div class="tab-pane" id="bptg">
                                        <p class="lead">Birthday Party To Go:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->birthday_party_to_go)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_bptg<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_bptg<?print $adminid;?>" data-target="#collapse_add_bptg<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_bptg<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $birthday_party_to_go= array(
                                                                            'id'          => "birthday_party_to_go-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('birthday_party_to_go-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($birthday_party_to_go);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_birthday_party_to_go<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_birthday_party_to_go<?print $row->adminid;?>" data-target="#collapse_birthday_party_to_go<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_birthday_party_to_go<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $bptg= array(
                                                'id'          => "birthday_party_to_go-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('birthday_party_to_go-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($bptg); 
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                                <div class='accordion' id='accordion_add_bptg<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_bptg<?print $adminid;?>" data-target="#collapse_add_bptg<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_bptg<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $birthday_party_to_go= array(
                                                                            'id'          => "birthday_party_to_go-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('birthday_party_to_go-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($birthday_party_to_go);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>           
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                  <div class="tab-pane" id="bpr">
                                      <p class="lead">Birthday Party Reservation:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->birthday_party_reservation)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_bpr<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_bpr<?print $adminid;?>" data-target="#collapse_add_bpr<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_bpr<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $birthday_party_reservation= array(
                                                                            'id'          => "birthday_party_reservation-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('birthday_party_reservation-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($birthday_party_reservation);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_birthday_party_reservation<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_birthday_party_reservation<?print $row->adminid;?>" data-target="#collapse_birthday_party_reservation<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_birthday_party_reservation<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $bpr= array(
                                                'id'          => "birthday_party_reservation-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('birthday_party_reservation-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($bpr); 
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                              <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                            <div class='accordion' id='accordion_add_bpr<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_bpr<?print $adminid;?>" data-target="#collapse_add_bpr<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_bpr<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $birthday_party_reservation= array(
                                                                            'id'          => "birthday_party_reservation-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('birthday_party_reservation-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($birthday_party_reservation);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>           
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                    <div class="tab-pane" id="brand">
                                        <p class="lead">Brand Trust:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->brand_trust)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_brand<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_brand<?print $adminid;?>" data-target="#collapse_add_brand<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_brand<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $brand_trust= array(
                                                                            'id'          => "brand_trust-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('brand_trust-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($brand_trust);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_brand_trust<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_brand_trust<?print $row->adminid;?>" data-target="#collapse_brand_trust<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_brand_trust<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $brand= array(
                                                'id'          => "brand_trust-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('brand_trust-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($brand);
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>             
                                                <div class='accordion' id='accordion_add_brand<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_brand<?print $adminid;?>" data-target="#collapse_add_brand<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_brand<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $brand_trust= array(
                                                                            'id'          => "brand_trust-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('brand_trust-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($brand_trust);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>            
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                  </div>
                                </div>
                              </div> <!-- /tabbable -->
                        
                
                </div><!-- <div id="collapse_hr print"> -->
            
            
            
       
       <p><table class="table table-bordered table-condensed"><tr><td> <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse"  data-target="#collapse_ro">
                                <i class="icon-tasks"></i>
                                </a>
                                Restaurant Operations
               </td></tr></table></p>
                       
                        
                        
                        <div id="collapse_ro" class="collapse">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs">
                                  <li class="active"><a href="#settings" data-toggle="tab">Restaurant Settings</a></li>
                                  <li><a href="#hours" data-toggle="tab">Restaurant Hours</a></li>
                                  <li><a href="#services" data-toggle="tab">Restaurant Services</a></li>
                                </ul>
                                <div class="tab-content">
                                  <div class="tab-pane active" id="settings">
                                      <p class="lead">Restaurant Settings:</p>
                                    <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->restaurant_settings)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_settings<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_settings<?print $adminid;?>" data-target="#collapse_add_settings<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_settings<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $restaurant_settings= array(
                                                                            'id'          => "restaurant_settings-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('restaurant_settings-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($restaurant_settings);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_restaurant_settings<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_restaurant_settings<?print $row->adminid;?>" data-target="#collapse_restaurant_settings<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_restaurant_settings<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $settings= array(
                                                'id'          => "restaurant_settings-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('restaurant_settings-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($settings); 
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                              <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                                <div class='accordion' id='accordion_add_settings<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_settings<?print $adminid;?>" data-target="#collapse_add_settings<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_settings<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $restaurant_settings= array(
                                                                            'id'          => "restaurant_settings-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('restaurant_settings-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($restaurant_settings);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?}?>          
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                      
                                </div>
                                <div class="tab-pane" id="hours">
                                    <p class="lead">Restaurant Hours:</p>
                                  <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->hours)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_hours<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_hours<?print $adminid;?>" data-target="#collapse_add_hours<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_hours<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $hours= array(
                                                                            'id'          => "hours-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('hours-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($hours);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_hours<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_hours<?print $row->adminid;?>" data-target="#collapse_hours<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_hours<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $hours= array(
                                                'id'          => "hours-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('hours-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($hours); 
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++; 
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                            <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                            <div class='accordion' id='accordion_add_hours<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_hours<?print $adminid;?>" data-target="#collapse_add_hours<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_hours<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $hours= array(
                                                                            'id'          => "hours-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('hours-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($hours);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>           
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                                <div class="tab-pane" id="services">
                                    <p class="lead">Restaurant Services:</p>
                                 <?
                                    $adminid="";
                                    $function_restaurants=array();
                                    foreach($permissions as $row)
                                    {
                                        if($row->services)
                                        {
                                            if($row->adminid!=$adminid)
                                            {
                                                $i=1;
                                                $shown=TRUE;
                                                if($adminid!="")
                                                {
                                                     print"</table>" ;
                                                    if(count($restaurants)!=count($function_restaurants))
                                                    {
                                                     //this section will be the 'add restaurants' section. All Restaurants that user doesnt hace access to will show up here with available checkbox.
                                                    ?>
                                                    <div class='accordion' id='accordion_add_services<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_services<?print $adminid;?>" data-target="#collapse_add_services<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_services<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $services= array(
                                                                            'id'          => "services-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('services-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($services);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                                   
                                                    <?
                                                    }
                                                    print'</div>
                                                            </div>
                                                            </div>
                                                        </div>';
                                                    
                                                }
                                                ?>
                                                 <div class='accordion' id='accordion_services<?print $row->adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading">&nbsp; 
                                                        <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_services<?print $row->adminid;?>" data-target="#collapse_services<?print $row->adminid;?>">
                                                            <i class="icon-tasks"></i>
                                                        </a>
                                                        <?print"$row->firstname $row->lastname ";?>
                                                    </div>
                                                    <div id="collapse_services<?print $row->adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                            <table class="table table-striped ">
                                                <?
                                                $adminid=$row->adminid;
                                                $function_restaurants=array();
                                            }
                                             if($i==1)
                                            {
                                                print"<tr>";
                                            }
                                            print"<td>";
                                            $services= array(
                                                'id'          => "services-".$row->permissions_id,
                                                'value'       => 'accept',
                                                'checked'     => true,
                                                'onclick'     => "update_permission('services-".$row->permissions_id."')"
                                             );
                                            print form_checkbox($services); 
                                            print" ".$row->RestaurantID." - ".$row->UnitName;
                                            print"</td>";
                                            if($i%3==0)
                                            {
                                                print"</tr>";
                                            }
                                            $i++;  
                                            array_push($function_restaurants, $row->RestaurantID);
                                        }
                                    }
                                    if($shown)
                                    {
                                        ?>
                                                </table>
                                              <?
                                            if(count($restaurants)!=count($function_restaurants))
                                            {
                                            ?>              
                                                <div class='accordion' id='accordion_add_services<?print $adminid;?>'>
                                                <div class="accordion-group">
                                                    <div class="accordion-heading"> 
                                                        <a type="button" class="btn  btn-mini btn-info btn-block" data-toggle="collapse" data-parent="#accordion_add_services<?print $adminid;?>" data-target="#collapse_add_services<?print $adminid;?>">
                                                            Add Restaurants
                                                        </a>
                                                    </div>
                                                    <div id="collapse_add_services<?print $adminid;?>" class="accordion-body collapse">
                                                        <div class="accordion-inner">
                                                   
                                                        <table class="table table-striped">
                                                            <?
                                                            
                                                                $j=1;
                                                                foreach($restaurants as $restaurant_row)
                                                                {
                                                                    if(!in_array($restaurant_row->RestaurantID, $function_restaurants)) //if restaurant was not already given access to.
                                                                    {
                                                                        if($j==1)
                                                                        {
                                                                            print"<tr>";
                                                                        }
                                                                        print"<td>";
                                                                         $services= array(
                                                                            'id'          => "services-".$restaurant_row->RestaurantID."-".$adminid,
                                                                            'value'       => 'accept',
                                                                            'checked'     => FALSE,
                                                                            'onclick'     => "update_function_permission('services-".$restaurant_row->RestaurantID."-".$adminid."')"
                                                                         );
                                                                        print form_checkbox($services);

                                                                        print" ".$restaurant_row->RestaurantID." - ".$restaurant_row->UnitName; 
                                                                        print"</td>";
                                                                        if($j%3==0)
                                                                        {
                                                                            print"</tr>";
                                                                        }
                                                                        $j++;
                                                                    }
                                                                }
                                                            ?>
                                                        </table>
                                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                         <?}?>           
                                                            
                                             </div><!-- end of accordian inner -->
                                            </div><!-- <div id="collapse print"$row->adminid";" class="accordion-body collapse"> -->
                                            </div><!-- end of <div class="accordion-group"> -->
                                        </div><!-- end of <div class='accordion' id='accordion_admin print"$row->adminid" '> -->
                                        <?
                                    }
                                 ?>
                                </div>
                                  
                               
                              </div>
                            </div> <!-- /tabbable -->
                        
                
                </div><!-- <div id="collapse_hr print"> -->
            
 <?
}
?>

