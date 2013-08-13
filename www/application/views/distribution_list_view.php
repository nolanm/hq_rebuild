
<div class="page-header">
    <h2>Your Distribution Lists
    <br/><small>Many users have permissions for multiple stores. For this reason, publishing content individually to a large number of restaurants is time-consuming and inefficient. Distribution lists allow you to create a group of stores that you can quickly publish stores to, removing the need for repetitive clicking.</small></h2>
</div>
<link href="<?php echo base_url();?>css/table_sorter.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>js/restaurants/distribution_lists.js"></script>


<?php

$restaurants= $view_data['restaurants'];
$distribution_lists= $view_data['distribution_lists'];
$assignments= $view_data['assignments'];
$restauranids=array();
foreach($restaurants as $row)
{
    array_push($restauranids, $row->RestaurantID);
}
?>

<script type="text/javascript">
    restaurants= new Array(<?php echo implode(',', $restauranids); ?>);
    set_restaurants_array(restaurants);
</script>

<div class="well well-small accordion">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#newPackage">
                <i class="icon-plus"></i> Add New Distribution List
            </a>
        </div>
        <div id="newPackage" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php  echo form_open('distribution_lists/new_list', array('class'=>'form-horizontal'));?>
                   
                        New List Name:
                        
                        <?php echo form_input(array(
                            'name' => 'name',
                            'id' => 'name'));
                        ?>
                        <br/><br/>
                    
                
                    <button type="submit" class="btn btn-primary btn-small">Create</button>&nbsp;&nbsp;
                     or
                    &nbsp;&nbsp;<a href="#" data-toggle="collapse" data-target="#newPackage">Cancel</a>
                </form>
                
            </div>
        </div>
    </div>
</div>

<?

if(count($distribution_lists)>0)
{
    foreach($distribution_lists as $dlist)
    {
        $list_assignments= $assignments[$dlist->id];
        ?>
            <div class="accordion">
                <div class="accordion-group">
                <div class="accordion-heading">
                    <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#list<?print $dlist->id;?>">
                        <i class="icon-pencil"></i> <?print $dlist->name;?> 
                    </a>
                    <button rel="tooltip" data-placement="top" title="Delete List" onclick="delete_list(<?print $dlist->id;?>)" class="btn btn-link btn-small pull-right"><i class="icon-minus-sign"></i></button>

                </div>
                    <div id="list<?print $dlist->id;?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <table class="table table-striped tablesorter" id="table<?print $dlist->id;?>">
                             <thead>
                                <tr>
                                    <th><button id="toggle_<?print $dlist->id;?>" rel="tooltip" data-placement="top" title="Check All" onclick="check_all_toggle(<?print $dlist->id;?>)" class="btn" data-toggle="button">Check All</i></button></th>
                                    <th>Restaurant ID</th>
                                    <th>Name</th>
                                    <th>City</th>
                                    <th>Zip</th>
                                    <th>State</th>
                                    <th>Coop</th>
                                    <th>Region</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?
                                foreach($restaurants as $restaurant)
                                {
                                ?>
                                <tr>
                                    <td>
                                        <?
                                        $cheched=FALSE;
                                        if(in_array($restaurant->RestaurantID, $list_assignments))
                                        {
                                            $cheched= TRUE;
                                        }
                                        $chechox= array(
                                            'id'          => "list-".$dlist->id."restaurant-".$restaurant->RestaurantID,
                                            'value'       => 'accept',
                                            'checked'     => $cheched,
                                            'onclick'     => "update_box(".$dlist->id.",".$restaurant->RestaurantID.")"
                                         );
                                        print form_checkbox($chechox);
                                        ?>
                                    </td>
                                    <td><?print $restaurant->RestaurantID;?></td>
                                    <td><?print $restaurant->UnitName;?></td>
                                    <td><?print $restaurant->City;?></td>
                                    <td><?print $restaurant->Zip;?></td>
                                    <td><?print $restaurant->State;?></td>
                                    <td><?print $restaurant->Coop;?></td>
                                    <td><?print $restaurant->Region;?></td>
                                </tr>
                                <?
                                }
                                ?>
                            </tbody>
                        </table>
                        <script type="text/javascript">
                            sortable_table(<?print $dlist->id?>);
                        </script>
                    </div>
                    </div>
                </div>
            </div>
        <?
    }
}
else
{
    ?>
        You currently have no distribution lists.
    <?
}

?>