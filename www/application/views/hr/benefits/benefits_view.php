<div class="page-header">
    <h2>Restaurant Benefits</h2>
    <p>You can display the benefits offered to your employees on your website. This can help you impress potential applicants, resulting in a higher number of online applications.</p>
<p>Your benefits are displayed in groups, called 'packages'. You can only display one package per restaurant, but that package can hold as many individual benefits as you wish. You may choose to share one package for all of your restaurants, or you could choose to display a different package for every restaurant.</p>
</div>
<script type="text/javascript" src="<?php echo base_url();?>js/hr/benefits.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>

<?
//loading view data variables
$restaurants= $view_data['restaurants'];
//$distribution_lists= $view_data['distribution_lists'];
$this_admins_benefits= $view_data['admin_benefits'];
$admin_package_items= $view_data['admin_package_items'];
$admin_benefit_assignments =$view_data['admin_benefit_assignments'];

?>
<div class="well">
    <div class="media">
    <a class="pull-left" href="#" data-toggle="collapse" data-target="#mip_config">
    <img src="/img/mip_button.jpg" alt="McDonald's Insurance Program" class="media-object img-polaroid margin-right">
    </a>
    <div class="media-body">
        <p>
        Do you offer the McDonald's Insurance Program at your restaurants? Configure your settings below to display MIP information on your benefits page automatically.
        <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#mip_config">
            Configure MIP Settings &raquo;
        </a>
        </p>
    </div>
    </div>      
       
    <div id="mip_config" class="collapse">
       
            
            <button class="btn btn-primary" onclick="create_new_job(0)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
             or
            <button class="btn btn-link" data-toggle="collapse" data-target="#newCrewJob">Cancel</button>
        
    </div>
</div>
    
<div class="well">
    <div class="media">
    <a class="pull-left" href="#" data-toggle="collapse" data-target="#mcr_config">
    <img src="/img/mcResource_button.gif" alt="McDonald's McResource Program" class="media-object img-polaroid margin-right">
    </a>
    <div class="media-body">
        <p>
        Do you offer the McDonald's McResource Program at your restaurants? Configure your settings below to display McResource information on your benefits page automatically. 
        <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#mcr_config">
            Configure McResource Settings &raquo;
        </a>
        </p>
    </div>
    </div>      
       
    <div id="mcr_config" class="collapse">
        
            
            <button class="btn btn-primary" onclick="create_new_job(0)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
             or
            <button class="btn btn-link" data-toggle="collapse" data-target="#newCrewJob">Cancel</button>
       
    </div>
</div>

<div class="well well-small accordion">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#newPackage">
                <i class="icon-plus"></i> Add New Benefits Package
            </a>
        </div>
        <div id="newPackage" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php  echo form_open('hr/benefits/new_package', array('class'=>'form-horizontal'));?>
                    <div class="control-group">
                        <label class="control-label" for="name">New Package Name:</label>
                        <div class="controls">
                            <?php echo form_input(array(
                                'name' => 'name',
                                'id' => 'name'));
                            ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-small">Create</button>&nbsp;&nbsp;
                     or
                    &nbsp;&nbsp;<a href="#" data-toggle="collapse" data-target="#newPackage">Cancel</a>
                </form>
                
            </div>
        </div>
    </div>
</div>
<div class="lead">Your Benefit Packages<hr></div>

<?
if(count($this_admins_benefits)>0)
{
    foreach($this_admins_benefits as $admin_package)
    {   
       ?> 
       <div class="accordion">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#package<?print $admin_package->packageid;?>" >
                        <i class="icon-pencil"></i> <?print $admin_package->name;?> 
                    </a><small class="muted"><em> #<?print $admin_package->packageid;?></em>, created by: <?print $admin_package->firstname." ".$admin_package->lastname;?></small>
                    <button rel="tooltip" data-placement="top" title="Delete Benefit Package" onclick="delete_package(<?print $admin_package->packageid;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>

                </div>
                <div id="package<?print $admin_package->packageid;?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div id="items_<?print $admin_package->packageid;?>" class="pull-left">
                        <?
                            $items= $admin_package_items[$admin_package->packageid];
                            $data= array('package_id'=>$admin_package->packageid, 'items'=>$items);
                            print $this->load->view('hr/benefits/benefit_package_items', $data, true);
                        ?>
                        </div>
                        <div class="pull-right">
                        <?
                           
                            $package_assignments= $admin_benefit_assignments[$admin_package->packageid];
                            $data= array('package'=>$admin_package, 'assignments'=>$package_assignments, 'restaurants'=>$restaurants);
                            print $this->load->view('hr/benefits/benefit_package_assignments', $data, true);
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?
       
    }
}
else
{
    print"You currently have no crew jobs in our system.<br/><br/>";
}
?>