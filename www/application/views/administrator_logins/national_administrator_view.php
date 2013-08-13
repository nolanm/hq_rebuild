<div class="page-header">
    <h2>Administrator Logins</h2>
    <?
    if($this->session->userdata('user_type')!='coop')
    {
    ?>
        <ul class="nav nav-pills">
            <?
            if($this->session->userdata('user_type')=='national' || $this->session->userdata('user_type')=='division')
            {
            ?>
                <li class="active"><a href="#division" data-toggle="tab">Divisions</a></li>
                <li><a href="#region" data-toggle="tab">Regions</a></li>
                <li><a href="#coop" data-toggle="tab">Coops</a></li>
            <?
            }
            else if($this->session->userdata('user_type')=='region')
            {
            ?> 
                <li class="active"><a href="#region" data-toggle="tab">Regions</a></li>
                <li><a href="#coop" data-toggle="tab">Coops</a></li>
            <?
            }
            ?>
        </ul> 
    <?
    }
    ?>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/administrator_logins/national_administrator.js"></script>
<div class="tab-content">
<? 
if($this->session->userdata('user_type')=='national' || $this->session->userdata('user_type')=='division')
{
    $division_array=$view_data['division_array'];
    $division_admins=$view_data['division_admins'];
?>

    <div class="tab-pane active" id="division">
        <?
            foreach($division_array as $division)
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

               <div class='accordion' id='accordion_division<?print"$division->DivisionID";?>'>
                   <div class="accordion-group">
                       <div class="accordion-heading">&nbsp; 
                           <a type="button" class="btn btn-link" data-toggle="collapse" data-parent="#accordion_division<?print"$division->DivisionID";?>" data-target="#collapse_division<?print"$division->DivisionID";?>">
                              <i class="icon-tasks"></i>&nbsp;&nbsp;<?print"$division->Name";?>
                           </a>

                           <button href="#daddModal<?print"$division->DivisionID";?>" role="button" class="btn btn-link pull-right" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Administrator</button>
                       </div>
                       <div id="collapse_division<?print"$division->DivisionID";?>" class="accordion-body collapse">
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
                                                       <a href="#AddRegionModal<?print $operator->adminid;?>" role="button" class="btn btn-link" data-toggle="modal"><i class="icon-plus"></i>Add Administrator to other Regions</a>
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
    <?}
    if($this->session->userdata('user_type')!='coop')
    {
        $region_array= $view_data['region_array'];
        $region_admins= $view_data['region_admins'];
        if($this->session->userdata('user_type')=='region')
        {
            ?><div class="tab-pane active" id="region"><?
        }
        else
        {
            ?><div class="tab-pane" id="region"><?
        }
    ?>
    
        <?
        $divisionid="";
            foreach($region_array as $region)
            {
        ?>
    
                <div id="raddModal<?print"$region->RegionID";?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h3 id="myModalLabel"><?print"$region->Name ";?>New Administrator</h3>
                   </div>
                   <div class="modal-body hero-unit-basic">
                       <form class="form-horizontal">
                           <div id="new_admin_alert<?print"$region->RegionID";?>"></div>
                           <div class="control-group">
                               <label class="control-label" for="username">Username:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'username'.$region->RegionID,
                                               'id' => 'username'.$region->RegionID,
                                              'placeholder' => 'Username'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password1">Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password1'.$region->RegionID,
                                               'id' => 'password1'.$region->RegionID,
                                       'placeholder' => 'Password'));
                                   ?>
                           </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password2">Confirmed Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password2'.$region->RegionID,
                                               'id' => 'password2'.$region->RegionID,
                                       'placeholder' => 'Confirm'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="firstname">First Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'firstname'.$region->RegionID,
                                               'id' => 'firstname'.$region->RegionID,
                                               'placeholder' => 'First Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="lastname">Last Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'lastname'.$region->RegionID,
                                               'id' => 'lastname'.$region->RegionID,
                                               'placeholder' => 'Last Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="email">Email:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'email'.$region->RegionID,
                                               'id' => 'email'.$region->RegionID,
                                               'placeholder' => 'Email'));
                                   ?>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                       <button class="btn btn-primary" onclick="add_new_region_admin(<?print"$region->RegionID";?>)">Save changes</button>
                   </div>
               </div>

               <?
                if($region->DivisionID!= $divisionid)
                {
                    ?>    
                        <div class="well well-small"><p><?print $region->division." Division";?></p></div>
                    <?
                    $divisionid= $region->DivisionID;
                }
               ?>
        
               <div class='accordion' id='accordion_region<?print"$region->RegionID";?>'>
                   <div class="accordion-group">
                       <div class="accordion-heading">&nbsp; 
                           <a type="button" class="btn btn-link" data-toggle="collapse" data-parent="#accordion_region<?print"$region->RegionID";?>" data-target="#collapse_region<?print"$region->RegionID";?>">
                              <i class="icon-tasks"></i>&nbsp;&nbsp;<?print"$region->Name Region";?>
                           </a>

                           <button href="#raddModal<?print"$region->RegionID";?>" role="button" class="btn btn-link pull-right" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Administrator</button>
                       </div>
                       <div id="collapse_region<?print"$region->RegionID";?>" class="accordion-body collapse">
                           <div class="accordion-inner">
                               <?
                                   foreach($region_admins as $operator)
                                   {
                                      if($operator->correlation_id == $region->RegionID)
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
                                                      <button rel="tooltip" data-placement="top" title="Remove Administrator from McOpCo Region" onclick="admin_delete_from_region(<?print"$operator->adminid";?>,<?print"$region->RegionID";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                                       <div id="alert_<?print"$operator->permissions_id"?>"></div>
                                                   </div>
                                                   <div id="collapse_<?print"$operator->permissions_id"?>" class="accordion-body collapse">
                                                       <div class="accordion-inner">
                                                           <div class="hero-unit-basic">
                                                               <form class="form-horizontal">

                                                                   <table class="table table-striped">
                                                                       <thead>
                                                                           <th>
                                                                               Regional Operations
                                                                           </th>
                                                                       </thead>
                                                                       <tbody>
                                                                           <tr>
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
                                                                            <tr>
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
                                                                                <td>
                                                                                   <?
                                                                                       $banners= array(
                                                                                           'id'          => "banners-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->restaurant_settings,
                                                                                           'onclick'     => "update_permission('banners-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($banners);
                                                                                   ?>
                                                                                   Regional Banners
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
    <?
    }
    $coop_array= $view_data['coop_array'];
    $coop_admins= $view_data['coop_admins'];
    if($this->session->userdata('user_type')=='coop')
    {
        ?><div class="tab-pane active" id="coop"><?
    }
    else
    {
        ?><div class="tab-pane" id="coop"><?
    }
    ?>
    <div class="tab-pane" id="coop">
        <?
            $regionid="";
            foreach($coop_array as $coop)
            {
        ?>
    
                <div id="caddModal<?print"$coop->CoopID";?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                       <h3 id="myModalLabel"><?print"$coop->Name ";?>New Administrator</h3>
                   </div>
                   <div class="modal-body hero-unit-basic">
                       <form class="form-horizontal">
                           <div id="new_admin_alert<?print"$coop->CoopID";?>"></div>
                           <div class="control-group">
                               <label class="control-label" for="username">Username:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'username'.$coop->CoopID,
                                               'id' => 'username'.$coop->CoopID,
                                              'placeholder' => 'Username'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password1">Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password1'.$coop->CoopID,
                                               'id' => 'password1'.$coop->CoopID,
                                       'placeholder' => 'Password'));
                                   ?>
                           </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="password2">Confirmed Password:</label>
                               <div class="controls">
                                   <?php echo form_password(array(
                                               'name' => 'password2'.$coop->CoopID,
                                               'id' => 'password2'.$coop->CoopID,
                                       'placeholder' => 'Confirm'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="firstname">First Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'firstname'.$coop->CoopID,
                                               'id' => 'firstname'.$coop->CoopID,
                                               'placeholder' => 'First Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="lastname">Last Name:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'lastname'.$coop->CoopID,
                                               'id' => 'lastname'.$coop->CoopID,
                                               'placeholder' => 'Last Name'));
                                   ?>
                               </div>
                           </div>
                           <div class="control-group">
                               <label class="control-label" for="email">Email:</label>
                               <div class="controls">
                                   <?php echo form_input(array(
                                               'name' => 'email'.$coop->CoopID,
                                               'id' => 'email'.$coop->CoopID,
                                               'placeholder' => 'Email'));
                                   ?>
                               </div>
                           </div>
                       </form>
                   </div>
                   <div class="modal-footer">
                       <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                       <button class="btn btn-primary" onclick="add_new_coop_admin(<?print"$coop->CoopID";?>)">Save changes</button>
                   </div>
               </div>
               
               <?
                if($coop->RegionID!= $regionid)
                {
                    ?>    
                        <div class="well well-small"><p><?print $coop->region." Region";?></p></div>
                    <?
                    $regionid=$coop->RegionID;
                }
               ?>
        
               <div class='accordion' id='accordion_coop<?print"$coop->CoopID";?>'>
                   <div class="accordion-group">
                       <div class="accordion-heading">&nbsp; 
                           <a type="button" class="btn btn-link" data-toggle="collapse" data-parent="#accordion_coop<?print"$coop->CoopID";?>" data-target="#collapse_coop<?print"$coop->CoopID";?>">
                              <i class="icon-tasks"></i>&nbsp;&nbsp;<?print"$coop->Name Coop";?>
                           </a>

                           <button href="#caddModal<?print"$coop->CoopID";?>" role="button" class="btn btn-link pull-right" data-toggle="modal"><i class="icon-plus-sign"></i> Add New Administrator</button>
                       </div>
                       <div id="collapse_coop<?print"$coop->CoopID";?>" class="accordion-body collapse">
                           <div class="accordion-inner">
                               <?
                                   foreach($coop_admins as $operator)
                                   {
                                      if($operator->correlation_id == $coop->CoopID)
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
                                                      <button rel="tooltip" data-placement="top" title="Remove Administrator from McOpCo Region" onclick="admin_delete_from_coop(<?print"$operator->adminid";?>,<?print"$coop->CoopID";?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                                       <div id="alert_<?print"$operator->permissions_id"?>"></div>
                                                   </div>
                                                   <div id="collapse_<?print"$operator->permissions_id"?>" class="accordion-body collapse">
                                                       <div class="accordion-inner">
                                                           <div class="hero-unit-basic">
                                                               <form class="form-horizontal">
                                                                   <p class="lead">Coop Operations</p>
                                                                   <table class="table table-striped">
                                                                       
                                                                       <tbody>
                                                                           <tr>
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
                                                                           </tr>
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
                                                                                       $banners= array(
                                                                                           'id'          => "banners-".$operator->permissions_id,
                                                                                           'value'       => 'accept',
                                                                                           'checked'     => $operator->restaurant_settings,
                                                                                           'onclick'     => "update_permission('banners-".$operator->permissions_id."')"
                                                                                        );
                                                                                       print form_checkbox($banners);
                                                                                   ?>
                                                                                   Coop Banners
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
</div>