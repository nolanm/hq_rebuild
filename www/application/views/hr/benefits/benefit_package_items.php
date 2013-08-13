
<script type="text/javascript" src="<?php echo base_url();?>js/hr/benefits.js"></script>

<div class="well well-small accordion">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#newBenefit<?print $package_id;?>">
                <i class="icon-plus"></i> Add New Benefit
            </a>
        </div>
        <div id="newBenefit<?print $package_id;?>" class="accordion-body collapse">
            <div class="accordion-inner">
                
                    <div class="control-group">
                        <label class="control-label">New Benefit Name:</label>
                        <div class="controls">
                            <?php echo form_input(array(
                                'name' => 'newBenefit_name'.$package_id,
                                'id' => 'newBenefit_name'.$package_id));
                            ?>
                        </div>
                    </div>
                    <div class="control-group">
                           Heading? 
                            <input type="radio" name="newBenefit_heading<?print $package_id;?>" id="newBenefit_headingYes<?print $package_id;?>" value="yes">&nbsp;Yes
                             &nbsp; or &nbsp;
                            <input type="radio" name="newBenefit_heading<?print $package_id;?>" id="newBenefit_headingNO<?print $package_id;?>" value="no" checked/>&nbsp;No
                        </div>
                   
                    <button class="btn btn-primary btn-small" onclick="new_benefit_item(<?print $package_id;?>)">Create Benefit</button>&nbsp;&nbsp;
                            or
                    &nbsp;&nbsp;<a href="#" data-toggle="collapse" data-target="#newBenefit<?print $package_id;?>">Cancel</a>
                
            </div>
        </div>
    </div>
</div>
 
<ul id="list_<?print $package_id;?>" class="unstyled">
<?
foreach($items as $item)
{
    ?>
    <li id="<?print $item->id;?>">
    <div class="accordion">
        <div class="accordion-group">
            <div class="accordion-heading">
                <span class="handle"><i class="icon-resize-vertical"></i></span>
                <?if($item->heading)
                    {
                        ?>
                           <strong> 
                                <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#benefit_item<?print $item->id;?>">
                                    <i class="icon-pencil"></i> <?print $item->name;?> 
                                </a>
                           </strong>
                        <?
                    }   
                    else
                    {
                        ?>
                        <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#benefit_item<?print $item->id;?>">
                            <i class="icon-pencil"></i> <?print $item->name;?> 
                        </a>
                        <?
                    }
                ?>
                
                <button rel="tooltip" data-placement="top" title="Delete Benefit Item" onclick="delete_item(<?print $item->id;?>,<?print $package_id;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>
                

            </div>
            <div id="benefit_item<?print $item->id;?>" class="accordion-body collapse">
                <div class="accordion-inner">
                    <span id="update_alert_item<?print $item->id;?>"></span>
                   
                    <label class="control-label">Benefit:</label>
                        <div class="controls">
                            <?php echo form_input(array(
                               
                                'id' => 'benefit_name'.$item->id,
                                'value'=> $item->name));
                            ?>
                        </div>
                        <?if(!$item->heading)
                        {
                            ?>
                            <label class="control-label">Description:</label>
                            <div class="controls">
                                <textarea id="item_description<?= $item->id;?>" cols="35" rows="10"><?=$item->text;?></textarea>
                            </div>
                                
                            <?
                        }
                        ?>
                    
                    
                    <button class="btn btn-primary" onclick="update_item(<?print $item->id;?>)">Update Item</button>&nbsp;&nbsp;&nbsp;&nbsp;
                    or
                    <button class="btn btn-link" data-toggle="collapse" data-target="#benefit_item<?print $item->id;?>">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>
</li>
    <?
}
?>
</ul>
<script language="JavaScript">create_sortable(<?print $package_id;?>);</script>