<div class="page-header">
    <h2>McOpCo Administrator Logins</h2>
    <ul class="nav nav-pills">
        <li class="active"><a href="#region" data-toggle="tab">Regions</a></li>
        <li><a href="#division" data-toggle="tab">Divisions</a></li>
    </ul> 
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/administrator_logins/mcopco_administrator.js"></script>

<?
$mcopco_regions= $view_data['mcopco_regions'];
$mcopco_operators= $view_data['mcopco_operators'];
$divisions= $view_data['divisions'];
$division_admins=$view_data['division_admins'];
?>
     
<div class="tab-content">
    <div class="tab-pane active" id="region">
        <?
            foreach($mcopco_regions as $region)
            {
        ?>
    
                <div id="raddModal<?print"$region->OwnerID";?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h3 id="myModalLabel"><?print"$region->FirstName $region->LastName ";?>New Administrator</h3>
                   </div>
                   <div class="modal-body hero-unit-basic">
                       <form class="form-horizontal">
                           <div id="new_admin_alert<?print"$region->OwnerID";?>"></div>
                           <div class="control-group">
                               <label class="control-label" for="username">Username:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'username'.$region->OwnerID,
                                               'id' => 'username'.$region->OwnerID,
                                              'placeholder' => 'Username'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password1">Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password1'.$region->OwnerID,
                                               'id' => 'password1'.$region->OwnerID,
                                       'placeholder' => 'Password'));
                                   ?>
                           </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password2">Confirmed Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password2'.$region->OwnerID,
                                               'id' => 'password2'.$region->OwnerID,
                                       'placeholder' => 'Confirm'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="firstname">First Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'firstname'.$region->OwnerID,
                                               'id' => 'firstname'.$region->OwnerID,
                                               'placeholder' => 'First Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="lastname">Last Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'lastname'.$region->OwnerID,
                                               'id' => 'lastname'.$region->OwnerID,
                                               'placeholder' => 'Last Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="email">Email:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'email'.$region->OwnerID,
                                               'id' => 'email'.$region->OwnerID,
                                               'placeholder' => 'Email'));
                                   ?>
                               </div>
                           </div>

                           <div  rel="tooltip" data-placement="top" title="Admin can access all functionallity for every store under the organization.">
                               <label class="control-label" for="email">Permissions:</label>
                               <div class="controls">
                                   <label class="checkbox" data-toggle="collapse" data-target="#non_total_div<?print"$region->OwnerID";?>">
                                   <input type="checkbox" name="operation_permissions" id="operation_permissions<?print"$region->OwnerID";?>" value="operation">Total Operational Permissions 
                                   </label> 
                               </div>  
                           </div>

                           <div id="non_total_div<?print"$region->OwnerID";?>" class="hero-unit-basic collapse in">


                               <div class="controls">
                                   <label class="checkbox">
                                       <input type="checkbox"  id="hr_checkbox<?print"$region->OwnerID";?>" value=""> Human Resources Permissions
                                   </label>
                               </div>


                               <div class="controls">
                                   <label class="checkbox">
                                       <input type="checkbox"  id="lsm_checkbox<?print"$region->OwnerID";?>" value=""> Local Store Marketing Permissions
                                   </label>
                               </div>


                               <div class="controls">
                                   <label class="checkbox">
                                       <input type="checkbox"  id="ro_checkbox<?print"$region->OwnerID";?>" value=""> Restaurant Operation Permissions
                                   </label>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                       <button class="btn btn-primary" onclick="add_new_admin(<?print"$region->OwnerID";?>)">Save changes</button>
                   </div>
               </div>

               <div class='accordion' id='accordion_region<?print"$region->OwnerID";?>'>
                   <div class="accordion-group">
                       <div class="accordion-heading">&nbsp; 
                           <a type="button" class="btn btn-link" data-toggle="collapse" data-parent="#accordion_region<?print"$region->OwnerID";?>" data-target="#collapse<?print"$region->OwnerID";?>">
                              <i class="icon-tasks"></i>&nbsp;&nbsp;<?print"$region->Name Region";?>
                           </a>

                           <button href="#raddModal<?print"$region->OwnerID";?>" role="button" class="btn btn-link pull-right" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Administrator</button>
                       </div>
                       <div id="collapse<?print"$region->OwnerID";?>" class="accordion-body collapse">
                           <div class="accordion-inner">
                               <?
                                   foreach($mcopco_operators as $operator)
                                   {
                                      if($operator->correlation_id == $region->OwnerID)
                                       {
                                       ?>

                                           <!-- Modals -->
                                           <div id="editAdminModal<?print$operator->adminid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                   <h3 id="myModalLabel">Edit Administrator Information</h3>
                                               </div>
                                               <div class="modal-body">
                                                   <form class="form-horizontal">
                                                       <div id="info_alert<?print"$operator->adminid";?>"></div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="username<?print$operator->adminid;?>">Username:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'username'.$operator->adminid,
                                                                           'id' => 'username'.$operator->adminid,
                                                                           'value'=> $operator->username));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="firstname<?print$operator->adminid;?>">First Name:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'firstname'.$operator->adminid,
                                                                           'id' => 'firstname'.$operator->adminid,
                                                                           'value'=> $operator->firstname));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="lastname<?print$operator->adminid;?>">Last Name:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'lastname'.$operator->adminid,
                                                                           'id' => 'lastname'.$operator->adminid,
                                                                           'value'=> $operator->lastname));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="email<?print$operator->adminid;?>">Email:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'email'.$operator->adminid,
                                                                           'id' => 'email'.$operator->adminid,
                                                                           'value'=> $operator->email));
                                                               ?>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                   <button class="btn btn-primary" onclick="update_admin_info(<?print$operator->adminid;?>)">Save changes</button>
                                               </div>
                                           </div>

                                           <div class='accordion' id='accordion_<?print"$operator->permissions_id"?>'>
                                               <div class="accordion-group">
                                                   <div class="accordion-heading">&nbsp;
                                                       <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion_<?print"$operator->permissions_id"?>" data-target="#collapse_<?print"$operator->permissions_id"?>">
                                                           <i class="icon-list-alt"></i>
                                                       </a>
                                                       <?print"$operator->firstname $operator->lastname - ($operator->username)"; ?> 
                                                       <a href="#editAdminModal<?print $operator->adminid;?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-pencil"></i>Edit Administrator info</a>
                                                      <button rel="tooltip" data-placement="top" title="Remove Administrator from McOpCo Region" onclick="admin_delete_from_region(<?print"$operator->adminid";?>,<?print"$region->OwnerID";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                                       <div id="alert_<?print"$operator->permissions_id"?>"></div>
                                                   </div>
                                                   <div id="collapse_<?print"$operator->permissions_id"?>" class="accordion-body collapse">
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
                                                                                       $jobs_crew= array(
                                                                                           'id'          => "jobs_crew-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->jobs_crew,
                                                                                           'onclick'     => "update_permission('jobs_crew-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($jobs_crew);
                                                                                   ?>
                                                                                   Crew Jobs
                                                                               </td>
                                                                               <td>
                                                                                   <?
                                                                                       $content= array(
                                                                                           'id'          => "content-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->content,
                                                                                           'onclick'     => "update_permission('content-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($content);
                                                                                   ?>
                                                                                   Custom Content
                                                                               </td>
                                                                               <td>
                                                                                   <?
                                                                                       $restaurant_settings= array(
                                                                                           'id'          => "restaurant_settings-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->restaurant_settings,
                                                                                           'onclick'     => "update_permission('restaurant_settings-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($restaurant_settings);
                                                                                   ?>
                                                                                   Restaurant Settings
                                                                               </td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td>
                                                                                   <?
                                                                                       $jobs_mgmt= array(
                                                                                           'id'          => "jobs_mgmt-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->jobs_mgmt,
                                                                                           'onclick'     => "update_permission('jobs_mgmt-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($jobs_mgmt);
                                                                                   ?>
                                                                                   Management Jobs
                                                                               </td>
                                                                               
                                                                               <td>
                                                                                  <?
                                                                                       $mcteachers_night= array(
                                                                                           'id'          => "mcteachers_night-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->mcteachers_night,
                                                                                           'onclick'     => "update_permission('mcteachers_night-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($mcteachers_night);
                                                                                   ?> 
                                                                                   McTeacher's Night
                                                                               </td>
                                                                               <td>
                                                                                   <?
                                                                                       $hours= array(
                                                                                           'id'          => "hours-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->hours,
                                                                                           'onclick'     => "update_permission('hours-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($hours);
                                                                                   ?>
                                                                                   Restaurant Hours
                                                                               </td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td>
                                                                                   <?
                                                                                       $benefits= array(
                                                                                           'id'          => "benefits-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->benefits,
                                                                                           'onclick'     => "update_permission('benefits-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($benefits);
                                                                                   ?>
                                                                                   Benefits
                                                                               </td>
                                                                               
                                                                               <td>
                                                                                  <?
                                                                                       $donation_request= array(
                                                                                           'id'          => "donation_request-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->donation_request,
                                                                                           'onclick'     => "update_permission('donation_request-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($donation_request);
                                                                                   ?> 
                                                                                   Donation Request
                                                                               </td>
                                                                               <td>
                                                                                   <?
                                                                                       $services= array(
                                                                                           'id'          => "services-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->services,
                                                                                           'onclick'     => "update_permission('services-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($services);
                                                                                   ?>
                                                                                   Restaurant Services
                                                                               </td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td>
                                                                                  <?
                                                                                       $application_settings= array(
                                                                                           'id'          => "application_settings-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->application_settings,
                                                                                           'onclick'     => "update_permission('application_settings-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($application_settings);
                                                                                   ?>
                                                                                   Application Settings
                                                                               </td>
                                                                              
                                                                               <td>
                                                                                   <?
                                                                                       $grand_opening= array(
                                                                                           'id'          => "grand_opening-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->grand_opening,
                                                                                           'onclick'     => "update_permission('grand_opening-".$operator->permissions_id."')"
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
                                                                                       $ray_kroc= array(
                                                                                           'id'          => "ray_kroc-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->ray_kroc,
                                                                                           'onclick'     => "update_permission('ray_kroc-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($ray_kroc);
                                                                                   ?>
                                                                                   Ray Kroc
                                                                               </td>
                                                                               
                                                                               <td>
                                                                                   <?
                                                                                       $calendar_of_events= array(
                                                                                           'id'          => "calendar_of_events-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->calendar_of_events,
                                                                                           'onclick'     => "update_permission('calendar_of_events-".$operator->permissions_id."')"
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
                                                                                       $hiring_day= array(
                                                                                           'id'          => "hiring_day-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->hiring_day,
                                                                                           'onclick'     => "update_permission('hiring_day-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($hiring_day);
                                                                                   ?>
                                                                                   Hiring Day
                                                                               </td>
                                                                               <td>
                                                                                   <?
                                                                                       $tours= array(
                                                                                           'id'          => "tours-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->tours,
                                                                                           'onclick'     => "update_permission('tours-".$operator->permissions_id."')"
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
                                                                                           'id'          => "orange_bowl-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->orange_bowl,
                                                                                           'onclick'     => "update_permission('orange_bowl-".$operator->permissions_id."')"
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
                                                                                           'id'          => "power_bowl-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->power_bowl,
                                                                                           'onclick'     => "update_permission('power_bowl-".$operator->permissions_id."')"
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
                                                                                           'id'          => "birthday_party_to_go-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->birthday_party_to_go,
                                                                                           'onclick'     => "update_permission('birthday_party_to_go-".$operator->permissions_id."')"
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
                                                                                           'id'          => "birthday_party_reservation-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->birthday_party_reservation,
                                                                                           'onclick'     => "update_permission('birthday_party_reservation-".$operator->permissions_id."')"
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
                                                                                           'id'          => "brand_trust-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->brand_trust,
                                                                                           'onclick'     => "update_permission('brand_trust-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($brand_trust);
                                                                                   ?>
                                                                                   Brand Trust
                                                                               </td>
                                                                               <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                               <td>
                                                                                   <button class="btn btn btn-info" type="button" onclick="check_all_hr(<?print"$operator->permissions_id";?>,true)"><i class="icon-ok"></i>Apply All Human Resource Functions</button>
                                                                               </td>
                                                                               <td>
                                                                                   <button class="btn btn btn-info" type="button" onclick="check_all_lsm(<?print"$operator->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Local Store Marketing Functions</button>
                                                                               </td>
                                                                               <td>
                                                                                   <button class="btn btn btn-info" type="button" onclick="check_all_operations(<?print"$operator->permissions_id";?>,true)"><i class="icon-ok"></i> Apply All Restaurant Operation Functions</button>
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
                                       }
                                   }
                               ?>
                           </div><!-- end of accordian inner -->
                       </div><!-- <div id="collapse print"$operator->adminid";" class="accordion-body collapse"> -->
                   </div><!-- end of <div class="accordion-group"> -->
               </div><!-- end of <div class='accordion' id='accordion_admin print"$operator->adminid" '> -->

               <?
           }
        ?>
    </div>
    <div class="tab-pane" id="division">
        <?
            foreach($divisions as $division)
            {
                ?>
                <div id="daddModal<?print"$division->DivisionID";?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h3 id="myModalLabel"><?print"$division->Name ";?>New Administrator</h3>
                   </div>
                   <div class="modal-body hero-unit-basic">
                       <form class="form-horizontal">
                           <div id="new_admin_alert<?print"$division->DivisionID";?>"></div>
                           <div class="control-group">
                               <label class="control-label" for="username">Username:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'username'.$division->DivisionID,
                                               'id' => 'username'.$division->DivisionID,
                                              'placeholder' => 'Username'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password1">Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password1'.$division->DivisionID,
                                               'id' => 'password1'.$division->DivisionID,
                                       'placeholder' => 'Password'));
                                   ?>
                           </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password2">Confirmed Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password2'.$division->DivisionID,
                                               'id' => 'password2'.$division->DivisionID,
                                       'placeholder' => 'Confirm'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="firstname">First Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'firstname'.$division->DivisionID,
                                               'id' => 'firstname'.$division->DivisionID,
                                               'placeholder' => 'First Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="lastname">Last Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'lastname'.$division->DivisionID,
                                               'id' => 'lastname'.$division->DivisionID,
                                               'placeholder' => 'Last Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="email">Email:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'email'.$division->DivisionID,
                                               'id' => 'email'.$division->DivisionID,
                                               'placeholder' => 'Email'));
                                   ?>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                       <button class="btn btn-primary" onclick="add_new_division_admin(<?print"$division->DivisionID";?>)">Save changes</button>
                   </div>
               </div>

               <div class='accordion' id='accordion_region<?print"$division->DivisionID";?>'>
                   <div class="accordion-group">
                       <div class="accordion-heading">&nbsp; 
                           <a type="button" class="btn btn-link" data-toggle="collapse" data-parent="#accordion_region<?print"$division->DivisionID";?>" data-target="#collapse<?print"$division->DivisionID";?>">
                              <i class="icon-tasks"></i>&nbsp;&nbsp;<?print"$division->Name";?>
                           </a>

                           <button href="#daddModal<?print"$division->DivisionID";?>" role="button" class="btn btn-link pull-right" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Administrator</button>
                       </div>
                       <div id="collapse<?print"$division->DivisionID";?>" class="accordion-body collapse">
                           <div class="accordion-inner">
                               <?
                                   foreach($division_admins as $operator)
                                   {
                                      if($operator->correlation_id == $division->DivisionID)
                                       {
                                       ?>

                                           <!-- Modals -->
                                           <div id="editAdminModal<?print$operator->adminid;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                               <div class="modal-header">
                                                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                   <h3 id="myModalLabel">Edit Administrator Information</h3>
                                               </div>
                                               <div class="modal-body">
                                                   <form class="form-horizontal">
                                                       <div id="info_alert<?print"$operator->adminid";?>"></div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="username<?print$operator->adminid;?>">Username:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'username'.$operator->adminid,
                                                                           'id' => 'username'.$operator->adminid,
                                                                           'value'=> $operator->username));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="firstname<?print$operator->adminid;?>">First Name:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'firstname'.$operator->adminid,
                                                                           'id' => 'firstname'.$operator->adminid,
                                                                           'value'=> $operator->firstname));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="lastname<?print$operator->adminid;?>">Last Name:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'lastname'.$operator->adminid,
                                                                           'id' => 'lastname'.$operator->adminid,
                                                                           'value'=> $operator->lastname));
                                                               ?>
                                                           </div>
                                                       </div>
                                                       <div class="control-group">
                                                           <label class="control-label" for="email<?print$operator->adminid;?>">Email:</label>
                                                           <div class="controls">
                                                               <?php echo form_input(array(
                                                                           'name' => 'email'.$operator->adminid,
                                                                           'id' => 'email'.$operator->adminid,
                                                                           'value'=> $operator->email));
                                                               ?>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                               <div class="modal-footer">
                                                   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                   <button class="btn btn-primary" onclick="update_admin_info(<?print$operator->adminid;?>)">Save changes</button>
                                               </div>
                                           </div>

                                           <div class='accordion' id='accordion_<?print"$operator->permissions_id"?>'>
                                               <div class="accordion-group">
                                                   <div class="accordion-heading">&nbsp;
                                                       <?print"$operator->firstname $operator->lastname - ($operator->username)"; ?> 
                                                       <a href="#editAdminModal<?print $operator->adminid;?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-pencil"></i>Edit Administrator info</a>
                                                      <button rel="tooltip" data-placement="top" title="Remove Administrator from McOpCo Division" onclick="admin_delete_from_division(<?print"$operator->adminid";?>,<?print"$division->DivisionID";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                                       <div id="alert_<?print"$operator->permissions_id"?>"></div>
                                                   </div>
                                                   
                                               </div>
                                           </div> 
                                       <?
                                       }
                                   }
                               ?>
                           </div><!-- end of accordian inner -->
                       </div><!-- <div id="collapse print"$operator->adminid";" class="accordion-body collapse"> -->
                   </div><!-- end of <div class="accordion-group"> -->
               </div><!-- end of <div class='accordion' id='accordion_admin print"$operator->adminid" '> -->
        <?
            }
        ?>
    </div>
</div>