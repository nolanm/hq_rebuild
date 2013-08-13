<div class="page-header">
    <h2>Current Positions 
    <br/><small>The Jobs section allows you to publish your job opportunities on the website. This lets potential applicants know that you are hiring, and often results in a greater number of online applications.</small></h2>
</div>

<script type="text/javascript" src="<?php echo base_url();?>js/hr/jobs.js"></script> 

<?
//loading view data variables
$crew_restaurants= $view_data['crew_restaurants'];

$crew_disabled=FALSE;
if(count($crew_restaurants)==0)
{
    $crew_disabled=TRUE;   
}

$mgmt_restaurants= $view_data['mgmt_restaurants'];

$mgmt_disabled=FALSE;
if(count($mgmt_restaurants)==0)
{
    $mgmt_disabled=TRUE;
}

$distribution_lists= $view_data['distribution_lists'];
$this_admins_jobs= $view_data['admin_jobs'];
$owner_level_jobs= $view_data['owner_level_jobs'];
$extra_admin_jobs= $view_data['extra_admin_jobs'];

?>
<div class="tabbable">
<ul class="nav nav-pills">
    <?if(!$crew_disabled){?>
    <li class="active">
        <a href="#crew_tab" data-toggle="tab">Crew Jobs</a>
    </li>
    <?}?>
    <?if(!$mgmt_disabled){?>
    <li class="<?if($crew_disabled) print"active";?>">
        <a href="#mgmt_tab" data-toggle="tab">Management Jobs</a>
    </li>
    <?}?>
</ul>
    
<div class="tab-content"> 
    <?if(!$crew_disabled){?><!---Does user have any crew job permissions-->
        <div class="tab-pane <?if(!$crew_disabled) print"active";?>" id="crew_tab"><!------------------------------- Crew Jobs Content --------------------------------------------->
                <ul class="nav nav-pills">
                    <li class="dropdown">
                        <a class="dropdown-toggle" id="new_crew_drop" role="button" data-toggle="dropdown" href="#"><i class="icon-plus"></i> Add New Crew Job </a>
                        <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="new_crew_drop">
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(2)">Crew</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(3)">Miembro de equipo</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(6)">Beverage Specialist/Crew Trainer - McCafe</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(7)">Entrenador de empleados/especialista en bebidas - McCafe</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(8)">Crew Member - McCafe</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(9)">Miembro de equipo - McCafe</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(12)">Flexible Opportunities!</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(13)">Flexible Breakfast Opportunities!</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(14)">Flexible Lunch Opportunities!</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(15)">Flexible Dinner Opportunities!</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_crew_job_template(16)">Other...</a></li>
                        </ul>
                    </li>
                </ul> <!-- /tabs -->
                
                <div id="newCrewJobTemplate" class="well well-small" hidden >
                    <?
                        $form_data=array('restaurants'=>$crew_restaurants,
                                        'distribution_lists'=>$distribution_lists,
                                        'job_type'=>0,'new_job'=>1);
                        print $this->load->view('hr/jobs/job_form', $form_data, true);
                    ?>
                    <button class="btn btn-primary" onclick="create_new_job(0)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    or
                    <button class="btn btn-link" onclick="hide_crew_job_template()">Cancel</button>
                </div>
            
            <div class="well well-small accordion" hidden>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#newCrewJob">
                            <i class="icon-plus"></i> Add New Crew Job
                        </a>
                    </div>
                    <div id="newCrewJob" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <?
                            $form_data=array('restaurants'=>$crew_restaurants,
                                            'distribution_lists'=>$distribution_lists,
                                            'job_type'=>0);
                            print $this->load->view('hr/jobs/job_form', $form_data, true);
                            ?>
                            <button class="btn btn-primary" onclick="create_new_job(0)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
                             or
                            <button class="btn btn-link" data-toggle="collapse" data-target="#newCrewJob">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="lead">Your Crew Jobs <hr></div>

            <?
            $count=0;
            $job_assignments= $view_data['admin_job_assignments'];
            foreach($this_admins_jobs as $admin_job)
            {   
                if($admin_job->Type!=1)
                {
                    $count++;
                    $this_job_assignments= $job_assignments[$admin_job->id];
                    $form_data= array('job'=>$admin_job, 'restaurants'=>$crew_restaurants, 'distribution_lists'=>$distribution_lists , 'job_assignments'=>$this_job_assignments, 'job_type'=>0, 'new_job'=>0);
                    ?>

                    <div class="accordion">
                    <div class="accordion-group">
                    <div class="accordion-heading">
                        <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $admin_job->id;?>">
                            <i class="icon-pencil"></i> <?print $admin_job->Title;?> 
                        </a><small class="muted"><em>job #<?print $admin_job->id;?></em>, created by: <?print $admin_job->firstname." ".$admin_job->lastname;?></small>
                        <button rel="tooltip" data-placement="top" title="Delete Job" onclick="delete_job(<?print $admin_job->id;?>,<?print $admin_job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>

                    </div>
                        <div id="job<?print $admin_job->id;?>" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <div id="update_alert<?print $admin_job->id;?>"></div>
                            <?print $this->load->view('hr/jobs/job_form', $form_data, true);?>
                            <p class="center">
                            <button class="btn btn-primary" onclick="update_job(<?print $admin_job->id;?>)">Update Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            or
                            <button class="btn btn-link" data-toggle="collapse" data-target="#job<?print $admin_job->id;?>">Cancel</button>
                            </p>
                        </div>
                        </div>
                    </div>
                    </div>
                <?
                }
            }
            if($count==0)
            {
                print"You currently have no crew jobs in our system.<br/><br/>";
            }
              
            
            if(!empty($owner_level_jobs))
            {
                $contains_crew_job=FALSE;
                $i=0;
                while($i< count($owner_level_jobs))
                {
                    $this_job=$owner_level_jobs[$i];
                    //print_r($this_job);
                    if($this_job->Type!=1)
                    {
                       $contains_crew_job=TRUE;
                        break;
                    }
                    $i++;
                    //print_r($i.$contains_crew_job);
                }
                if($contains_crew_job)
                {
                    ?>
                    <div class="lead">Crew Jobs Created Within the Organization <hr></div>

                    <?
                    $owner_level_job_assignments= $view_data['owner_level_job_assignments'];
                    foreach($owner_level_jobs as $job)
                    {
                        if($job->Type!=1)
                        {
                            $this_job_assignments= $owner_level_job_assignments[$job->id];
                            $form_data= array('job'=>$job, 'restaurants'=>$crew_restaurants, 'job_assignments'=>$this_job_assignments,'job_type'=>0);
                            ?>

                            <div class="accordion disabled-color">
                            <div class="accordion-group">
                            <div class="accordion-heading">
                                <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $job->id;?>">
                                    <i class="icon-pencil"></i> <?print $job->Title;?> 
                                </a><small class="muted"><em>job #<?print $job->id;?></em>, created by: <?print $job->firstname." ".$job->lastname;?></small>

                                <?if(!empty($this_job_assignments))
                                {
                                ?>
                                    <button rel="tooltip" data-placement="top" title="Remove All Restaurant Assignments For This Job" onclick="unassign_all_restaurants(<?print $job->id;?>, <?print $job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                <?
                                }
                                ?>

                            </div>
                                <div id="job<?print $job->id;?>" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div id="update_alert<?print $job->id;?>"></div>
                                    <?print $this->load->view('hr/jobs/job_form_uneditable', $form_data, true);?>
                                    <p class="center">
                                     <button class="btn btn-primary" onclick="create_new_job(<?print $job->id;?>)">Duplicate Job</button> 
                                    </p>

                                </div>
                                </div>
                            </div>
                            </div>
                            <?
                        }
                    }
                }   
            }
            if(!empty($extra_admin_jobs))
            {
                $contains_crew_job=FALSE;
                $i=0;
                while($i< count($extra_admin_jobs))
                {
                    $this_job=$extra_admin_jobs[$i];
                    //print_r($this_job);
                    if($this_job->Type!=1)
                    {
                       $contains_crew_job=TRUE;
                        break;
                    }
                    $i++;
                    //print_r($i.$contains_crew_job);
                }
                if($contains_crew_job)
                {
                    ?>
                    <div class="lead">Crew Jobs Created by Other Administrators <hr></div>

                    <?
                    $extra_admin_job_assignments= $view_data['extra_admin_job_assignments'];
                    foreach($extra_admin_jobs as $job)
                    {
                        if($job->Type!=1)
                        {
                            $this_job_assignments= $extra_admin_job_assignments[$job->id];
                            $form_data= array('job'=>$job, 'restaurants'=>$crew_restaurants, 'job_assignments'=>$this_job_assignments,'job_type'=>0);
                            ?>

                            <div class="accordion disabled-color">
                            <div class="accordion-group">
                            <div class="accordion-heading">
                                <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $job->id;?>">
                                    <i class="icon-pencil"></i> <?print $job->Title;?> 
                                </a><small class="muted"><em>job #<?print $job->id;?></em>, created by: <?print $job->firstname." ".$job->lastname;?></small>
                                <?if(!empty($this_job_assignments))
                                {
                                ?>
                                    <button rel="tooltip" data-placement="top" title="Remove All Restaurant Assignments For This Job" onclick="unassign_all_restaurants(<?print $job->id;?>,<?print $job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                                <?
                                }
                                ?>
                            </div>
                                <div id="job<?print $job->id;?>" class="accordion-body collapse">
                                <div class="accordion-inner">
                                    <div id="update_alert<?print $job->id;?>"></div>
                                    <?print $this->load->view('hr/jobs/job_form_uneditable', $form_data, true);?>
                                    <p class="center">
                                     <button class="btn btn-primary" onclick="create_new_job(<?print $job->id;?>)">Duplicate Job</button> 
                                    </p>
                                </div>
                                </div>
                            </div>
                            </div>
                            <?
                        }
                    }
                }
            }
            ?>
        </div>
    <?}?>
    
    <?if(!$crew_disabled){?><!---Does user have any management job permissions-->
    <div class="tab-pane <?if($crew_disabled) print"active";?>" id="mgmt_tab"> <!------------------------------- Management Jobs Content --------------------------------------------->
       
        <ul class="nav nav-pills">
            <li class="dropdown">
                <a class="dropdown-toggle" id="new_management_drop" role="button" data-toggle="dropdown" href="#"><i class="icon-plus"></i> Add New Management Job </a>
                <ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="new_management_drop">
                   
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(0)">Management</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(1)">Gerentes</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(4)">Zone Management</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(5)">Gerentes de Zona</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(10)">Manager - McCafe</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(11)">Gerente - McCafe</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(12)">Flexible Opportunities!</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(13)">Flexible Breakfast Opportunities!</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(14)">Flexible Lunch Opportunities!</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(15)">Flexible Dinner Opportunities!</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" onclick="new_mgmt_job_template(16)">Other...</a></li>
                </ul>
            </li>
        </ul> <!-- /tabs -->
                
        <div id="newMgmtJobTemplate" class="well well-small" hidden >
            <?
                        
            $form_data_mgmt=array('restaurants'=>$mgmt_restaurants,
                            'distribution_lists'=>$distribution_lists,
                            'job_assignments'=>array(),
                            'job_type'=>1,'new_job'=>1);

            print $this->load->view('hr/jobs/job_form', $form_data_mgmt, true);
            ?>
            <button class="btn btn-primary" onclick="create_new_job(1)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
            or
            <button class="btn btn-link" onclick="hide_mgmt_job_template()">Cancel</button>
        </div>
        
        <div class="well well-small accordion" hidden>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#newMgmtJob">
                        <i class="icon-plus"></i> Add New Management Job
                    </a>
                </div>
                <div id="newMgmtJob" class="accordion-body collapse">
                    <div class="accordion-inner">
                       <?
                        $form_data_mgmt=array('restaurants'=>$mgmt_restaurants,
                                        'distribution_lists'=>$distribution_lists,
                                        'job_assignments'=>array(),
                                        'job_type'=>1);
                        
                        print $this->load->view('hr/jobs/job_form', $form_data_mgmt, true);
                        ?>
                        <button class="btn btn-primary" onclick="create_new_job(1)">Create Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
                         or
                        <button class="btn btn-link" data-toggle="collapse" data-target="#newMgmtJob">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="lead">Your Management Jobs <hr></div>

        <?
        $count=0;
        $job_assignments= $view_data['admin_job_assignments'];
        foreach($this_admins_jobs as $admin_job)
        {   
            if($admin_job->Type==1)
            {
                $count++;
                $this_job_assignments= $job_assignments[$admin_job->id];
                $form_data_mgmt= array('job'=>$admin_job, 'restaurants'=>$mgmt_restaurants, 'distribution_lists'=>$distribution_lists , 'job_assignments'=>$this_job_assignments, 'job_type'=>1,'new_job'=>0);
                ?>

                <div class="accordion">
                <div class="accordion-group">
                <div class="accordion-heading">
                    <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $admin_job->id;?>">
                        <i class="icon-pencil"></i> <?print $admin_job->Title;?> 
                    </a><small class="muted"><em>job #<?print $admin_job->id;?></em>, created by: <?print $admin_job->firstname." ".$admin_job->lastname;?></small>
                    <button rel="tooltip" data-placement="top" title="Delete Job" onclick="delete_job(<?print $admin_job->id;?>,<?print $admin_job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>

                </div>
                    <div id="job<?print $admin_job->id;?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div id="update_alert<?print $admin_job->id;?>"></div>
                        <?print $this->load->view('hr/jobs/job_form', $form_data_mgmt, true);?>
                        <button class="btn btn-primary" onclick="update_job(<?print $admin_job->id;?>)">Update Job</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        or
                        <button class="btn btn-link" data-toggle="collapse" data-target="#job<?print $admin_job->id;?>">Cancel</button>
                    </div>
                    </div>
                </div>
                </div>
                <?
            }
        }
        if($count==0)
            {
                print"You currently have no management jobs in our system.<br/><br/>";
            }
         

        if(!empty($owner_level_jobs))
        {
            
            $contains_mgmt_job=FALSE;
            $i=0;
            while($i< count($owner_level_jobs))
            {
                $this_job=$owner_level_jobs[$i];
                //print_r($this_job);
                if($this_job->Type==1)
                {
                   $contains_mgmt_job=TRUE;
                    break;
                }
                $i++;
                //print_r($i.$contains_mgmt_job);
            }
            
            if($contains_mgmt_job)
            {
                ?>
                <div class="lead">Management Jobs Created Within the Organization <hr></div>

                <?
                $owner_level_job_assignments= $view_data['owner_level_job_assignments'];
                foreach($owner_level_jobs as $job)
                {
                    if($job->Type==1)
                    {
                        $this_job_assignments= $owner_level_job_assignments[$job->id];
                        $form_data_mgmt= array('job'=>$job, 'restaurants'=>$mgmt_restaurants, 'job_assignments'=>$this_job_assignments,'job_type'=>1);
                        ?>

                        <div class="accordion disabled-color">
                        <div class="accordion-group">
                        <div class="accordion-heading">
                            <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $job->id;?>">
                                <i class="icon-pencil"></i> <?print $job->Title;?> 
                            </a><small class="muted"><em>job #<?print $job->id;?></em>, created by: <?print $job->firstname." ".$job->lastname;?></small>
                            <?if(!empty($this_job_assignments))
                            {
                            ?>
                                <button rel="tooltip" data-placement="top" title="Remove All Restaurant Assignments For This Job" onclick="unassign_all_restaurants(<?print $job->id;?>,<?print $job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                            <?
                            }
                            ?>
                        </div>
                            <div id="job<?print $job->id;?>" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <div id="update_alert<?print $job->id;?>"></div>
                                <?print $this->load->view('hr/jobs/job_form_uneditable', $form_data_mgmt, true);?>
                                <p class="center">
                                 <button class="btn btn-primary" onclick="create_new_job(<?print $job->id;?>)">Duplicate Job</button> 
                                </p>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?
                    }
                }
            }   
        }
        if(!empty($extra_admin_jobs))
        {
            $contains_mgmt_job=FALSE;
            $i=0;
            while($i< count($extra_admin_jobs))
            {
                $this_job=$extra_admin_jobs[$i];
                //print_r($this_job);
                if($this_job->Type==1)
                {
                   $contains_mgmt_job=TRUE;
                    break;
                }
                $i++;
                //print_r($i.$contains_mgmt_job);
            }
            if($contains_mgmt_job)
            {
                ?>
                <div class="lead">Management Jobs Created by Other Administrators <hr></div>

                <?
                $extra_admin_job_assignments= $view_data['extra_admin_job_assignments'];
                foreach($extra_admin_jobs as $job)
                {
                    if($job->Type==1)
                    {
                        $this_job_assignments= $extra_admin_job_assignments[$job->id];
                        $form_data_mgmt= array('job'=>$job, 'restaurants'=>$mgmt_restaurants, 'job_assignments'=>$this_job_assignments,'job_type'=>1);
                        ?>

                        <div class="accordion disabled-color">
                        <div class="accordion-group">
                        <div class="accordion-heading">
                            <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#job<?print $job->id;?>">
                                <i class="icon-pencil"></i> <?print $job->Title;?> 
                            </a><small class="muted"><em>job #<?print $job->id;?></em>, created by: <?print $job->firstname." ".$job->lastname;?></small>
                            <?if(!empty($this_job_assignments))
                            {
                            ?>
                                <button rel="tooltip" data-placement="top" title="Remove All Restaurant Assignments For This Job" onclick="unassign_all_restaurants(<?print $job->id;?>,<?print $job->Type;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                            <?
                            }
                            ?>
                        </div>
                            <div id="job<?print $job->id;?>" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <div id="update_alert<?print $job->id;?>"></div>
                                <?print $this->load->view('hr/jobs/job_form_uneditable', $form_data_mgmt, true);?>
                                <p class="center">
                                 <button class="btn btn-primary" onclick="create_new_job(<?print $job->id;?>)">Duplicate Job</button> 
                                </p>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?
                    }
                }
            }
        }
        ?>
    </div>
    <?}?>
</div>
</div>

                                


