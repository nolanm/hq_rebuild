
<script type="text/javascript" src="<?php echo base_url();?>js/hr/jobs.js"></script>
<table class="table">
	<tr>
		<td>
			
			<h5>Title:</h5>
			<input type="text" id="title<?= $job->id; ?>" name="title" value="<?=$job->Title;?>" size="25" maxlength="50" disabled/><br />
                        <h5>Hours:</h5>
			<input type="text" id="hours<?= $job->id; ?>" name="hours" value="<?=$job->Hours;?>" size="25" maxlength="50" disabled><br />
			<h5>Pay Range:</h5>
                        <input type="text" id="payrange<?= $job->id; ?>" name="payrange" value="<?=$job->PayRange;?>" size="25" maxlength="50" disabled><br />
                        
			<h5>Position Type:</h5>
                         <?
                        if($job_type==0) 
                        { 
                        ?>
                        <input type="radio" id="type0<?= $job->id; ?>" name="type<?= $job->id; ?>" value="0" <? if ($job->Type == 0) echo 'checked'; ?> disabled> Crew<br />
			<input type="radio" id="type2<?= $job->id; ?>" name="type<?= $job->id; ?>" value="2" <? if ($job->Type == 2) echo 'checked'; ?> disabled> Support <a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="Use the \'Support\' category for jobs such as maintenance, office staff, etc." title="Support Hints"><i class="icon-question-sign"></i></a><br />
                        <?
                        }
                        if($job_type==1)
                        {
                        ?>
                        <input type="radio" id="type1<?= $job->id; ?>" name="type<?= $job->id; ?>" value="1" <? if ($job->Type == 1) echo 'checked'; ?> disabled> Management<br />
                        <?
                        }
                        ?>
                        
			<h5>Description:</h5>
			<textarea id="description<?= $job->id; ?>" name="description" cols="35" rows="10" disabled><?=$job->Description;?></textarea>
		</td>

                <td>
                    <h5>Restaurant Assignments:</h5>
                    <div id="restaurants_<?= $job->id; ?>">
                        <?
                            if(!empty($job_assignments))
                            {
                         
                               
                                foreach ($restaurants AS $restaurant) 
                                { 
                                    if(in_array($restaurant->RestaurantID, $job_assignments))
                                    {
                                        $chechox= array(
                                                    'id'          => "checbox-".$job->id."-".$restaurant->RestaurantID,
                                                    'value'       => 'accept',
                                                    'checked'     => TRUE,
                                                    'onclick'     => "update_assignment(".$job->id.",".$restaurant->RestaurantID.")"
                                                 );
                                                print form_checkbox($chechox);
                                                print "(".$restaurant->RestaurantID.") ".$restaurant->UnitName."<br/>";
                                                
                                    }
                                }
                            }
                            else
                            {
                                ?><h6>This jobs is currently not assigned to any restaurants.</h6><?
                            }
                             ?>
                            </select></p>
                        </div>
                    <hr>
                    <!-- additional benefits -->
                    <h5>Additional Benefits: </h5>
                    <textarea id="benefits<?= $job->id; ?>" name="benefits" cols="35" rows="10" disabled><?= $job->Benefits; ?></textarea>
                    
                </td>	
        </tr>
</table>
