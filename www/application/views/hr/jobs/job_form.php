<script type="text/javascript" src="<?php echo base_url();?>js/hr/jobs.js"></script>
<!-- Redactor is here -->
<link rel="stylesheet" href="<?php echo base_url();?>css/redactor.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/redactor/redactor.js"> //custom scripts </script>

<table class="table">   
    <tr>
        <td class="span4">
<?

if ($new_job==1) 
    {
        $job= new stdClass();
        $job->id=$job_type;
        $job->Title='';
        $job->Hours='';
        $job->PayRange='';
        $job->Type='';
        $job->Description='';
        $job->Benefits='';
        $job->distribution_list='';
        $job->edit_job='';
        
?>
<?
    } 
    else
    {
    ?>
        <h5>Job Template:</h5>
        <select name="jobTemplate<?= $job->id; ?>" id="jobTemplate<?= $job->id; ?>" onchange="job_template_changed(<?= $job->id; ?>)">
        <option value=""></option>
        <?
        if($job_type==0) 
        { 
        ?>
        <option value="2">Crew</option>
        <option value="3">Miembro de equipo</option>
        <option value="6">Beverage Specialist/Crew Trainer - McCafe</option>
        <option value="7">Entrenador de empleados/especialista en bebidas - McCafe</option>
        <option value="8">Crew Member - McCafe</option>
        <option value="9">Miembro de equipo - McCafe</option>
        <?
        }
        if($job_type==1)
        {
        ?>
        <option value="0">Management</option>
        <option value="1">Gerentes</option>
        <option value="4">Zone Management</option>
        <option value="5">Gerentes de Zona</option>
        <option value="10">Manager - McCafe</option>
        <option value="11">Gerente - McCafe</option>
        <?
        }
        ?>
        <option value="12">Flexible Opportunities!</option>
        <? //if ($mcopco = $db->get_row("SELECT ownerid FROM McOpCos WHERE ownerid = {$_SESSION['ownerid']} LIMIT 1;")) { // ONLY display on McOpCo Restaurant HQs ?>
        <option value="13">Flexible Breakfast Opportunities!</option>
        <option value="14">Flexible Lunch Opportunities!</option>
        <option value="15">Flexible Dinner Opportunities!</option>
        <option value="16">Other...</option>
        <? //}; ?>
        </select><br/>
        <small><em>Jump start your job listings by editing one of our pre-built job descriptions in English and Spanish!</small><br />
    <?
    } 
    ?>
                        <input type="hidden" id="edit_job<?= $job->id; ?>" value="<?=$job->edit_job;?>" />
                        <h5>Title:</h5>
			<input type="text" id="title<?= $job->id; ?>" name="title" value="<?=$job->Title;?>" size="25" maxlength="50" <? if($job->edit_job == 0) echo 'disabled'; ?> />&nbsp;<a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="Consider choosing a unique title for your open position. Everyone is looking for \'crew\', make your job title stand out!" title="Title Hints"><i class="icon-question-sign"></i></a><br />
                       <h5> Hours:</h5>
			<input type="text" id="hours<?= $job->id; ?>" name="hours" value="<?=$job->Hours;?>" size="25" maxlength="50" /><br />
			<h5>Pay Range:</h5>
                        <input type="text" id="payrange<?= $job->id; ?>" name="payrange" value="<?=$job->PayRange;?>" size="25" maxlength="50">&nbsp;<a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="Consider using phrases such as,\'Depending on experience\' or \'Negotiable\'. Putting a lower hourly rate than a competitor, even by a few cents, could prevent a potential employee from applying." title="Pay Range Hints"><i class="icon-question-sign"></i></a><br />
                        
			<h5>Position Type:</h5>
                         <?
                        if($job_type==0) 
                        { 
                        ?>
                        <input type="radio" id="type0<?= $job->id; ?>" name="type<?= $job->id; ?>" value="0" <? if ($job->Type == 0) echo 'checked'; if($job->edit_job == 0) echo 'disabled'; ?>> Crew<br />
			<input type="radio" id="type2<?= $job->id; ?>" name="type<?= $job->id; ?>" value="2" <? if ($job->Type == 2) echo 'checked'; if($job->edit_job == 0) echo 'disabled'; ?>> Support <a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="Use the \'Support\' category for jobs such as maintenance, office staff, etc." title="Support Hints"><i class="icon-question-sign"></i></a><br />
                        <?
                        }
                        if($job_type==1)
                        {
                        ?>
                        <input type="radio" id="type1<?= $job->id; ?>" name="type<?= $job->id; ?>" value="1"  checked <? if($job->edit_job == 0) echo 'disabled'; ?>> Management<br />
                        <?
                        }
                        ?>
			
                        <h5>Overview:</h5>
			<textarea id="overview<?= $job->id; ?>" name="overview" cols="35" rows="10" <? if($job->edit_job == 0) echo 'disabled'; ?>></textarea>
		</td>

                <td class="span4">
                    <h5>Publishing Options: </h5>
                    <p><input id="radioall<?= $job->id; ?>" type="radio" value="all" name="publish_option<?= $job->id; ?>" onclick="distListDisplay(<?= $job->id; ?>);" /> All Stores</p>
                    
                    <div id="restaurants_all_<?= $job->id; ?>" hidden>
                        <select multiple="multiple" size="10" id="allstores<?= $job->id; ?>">
                            <? foreach ($restaurants AS $restaurant) { ?>
                                <option value="<?= $restaurant->RestaurantID; ?>" selected><?= '(' . $restaurant->RestaurantID . ') ' . $restaurant->UnitName; ?></option>
                            <? }; ?>
                        </select>
                    </div>
                    <p><input id="radiostores<?= $job->id; ?>" type="radio" value="individual" name="publish_option<?= $job->id; ?>" onclick="distListDisplay(<?= $job->id; ?>);" checked /> Display on Selected Stores: <a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="To hide opportunities from the public, simply do not assign it to a store.<br /><br />To post a position on multiple stores, hold the ctrl button while clicking multiple restaurant names." title="Multiple Restaurant Hints"><i class="icon-question-sign"></i></a></p> 
                            
                    <div id="restaurants_<?= $job->id; ?>">
                            <p><select multiple="multiple" size="10" id="stores<?= $job->id; ?>">
                            <? foreach ($restaurants AS $restaurant) { ?>

                                <?
                                $selected = '';
                                if(isset($job_assignments))
                                {
                                    if(in_array($restaurant->RestaurantID, $job_assignments))
                                    {
                                       $selected= 'SELECTED';
                                    }
                                    
                                    /*if ($job->id != '') {
                                        $match = $db->get_row("SELECT * FROM job_assignments WHERE restaurantid = " . $restaurant->RestaurantID . " AND id = {$job->id};");
                                        if ($db->num_rows > 0) {
                                            $selected = 'SELECTED';
                                        }
                                    }*/
                                }
                                ?> 

                                <option value="<?= $restaurant->RestaurantID; ?>" <?print $selected; ?> >
                                    (<?= $restaurant->RestaurantID; ?>) <?= $restaurant->UnitName; ?>
                                </option>

                            <? }; ?>
                            </select></p>
                        </div>
                    <p><input id="radiodist<?= $job->id; ?>" type="radio" value="distlist" name="publish_option<?= $job->id; ?>" onclick="distListDisplay(<?= $job->id; ?>);" <? if ($job->distribution_list != "") echo 'checked'; ?> /> Distribution List</p>

                    <div id="distribution_<?= $job->id; ?>" <? if ($job->distribution_list == "") echo 'style="display:none; overflow:hidden;"'; ?>>
                        <p><select id="distlist<?= $job->id; ?>" onchange="distListUpdate(<?= $job->id;?>,<?print $job_type;?>);">
                            <option>None</option>
<?
                            if ($distribution_lists) {
                                foreach ($distribution_lists AS $list) {
                                    $list->id == $job->distribution_list ? $selected = 'selected' : $selected = '';
                                    echo "<option value=\"{$list->id}\" {$selected}>{$list->name}</option>";
                                }
                            }
?>
                        </select></p>
                        <div id="distribution_alert<?= $job->id;?>"></div>
                    </div><hr> 
                    
                    <h5>Description:</h5>
                    <textarea id="description<?= $job->id; ?>" name="description" cols="35" rows="10" <? if($job->edit_job == 0) echo 'disabled'; ?>><?=$job->Description;?></textarea>
                    <!-- additional benefits -->
                   <h5> Position Benefits:</h5>
                    <?
                    if($this->session->userdata('mcopco'))
                    {
                        ?><textarea id="mcopco_benefits<?= $job->id; ?>" name="mcopco_benefits" cols="35" rows="10" class="redactor" disabled >Got what it takes? Then join the team! We offer a long list of good things like: Flexible schedules, training and development programs, advancement opportunities, uniforms, and much more! See Restaurant Manager for details.</textarea><?
                    }
                    else 
                    {
                        ?> <textarea id="benefits<?= $job->id; ?>" name="benefits" cols="35" rows="10" class="redactor" <? if($job->edit_job == 0) echo 'disabled'; ?> ><?= $job->Benefits; ?></textarea><?
                    }
                    ?>
                   
                </td>	
        </tr>
</table>