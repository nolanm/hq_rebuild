
<script type="text/javascript" src="<?php echo base_url();?>js/hr/benefits.js"></script>
<span id="update_alert_assignments<?print $package->packageid;?>"></span>
<h5>Publishing Options: </h5>
    <p><input id="radioall<?= $package->packageid; ?>" type="radio" value="all" name="publish_option<?= $package->packageid; ?>" onclick="distListDisplay(<?= $package->packageid; ?>);" /> All Stores</p>

    <div id="restaurants_all_<?= $package->packageid; ?>" hidden>
        <select multiple="multiple" size="10" id="allstores<?= $package->packageid; ?>">
            <? foreach ($restaurants AS $restaurant) { ?>
                <option value="<?= $restaurant->RestaurantID; ?>" selected><?= '(' . $restaurant->RestaurantID . ') ' . $restaurant->UnitName; ?></option>
            <? }; ?>
        </select>
    </div>
    <p><input id="radiostores<?= $package->packageid; ?>" type="radio" value="individual" name="publish_option<?= $package->packageid; ?>" onclick="distListDisplay(<?= $package->packageid; ?>);" checked /> Display on Selected Stores: <a href="#" class="btn btn-link" data-toggle="popover" data-placement="top" data-content="To hide opportunities from the public, simply do not assign it to a store.<br /><br />To post a position on multiple stores, hold the ctrl button while clicking multiple restaurant names." title="Multiple Restaurant Hints"><i class="icon-question-sign"></i></a></p> 

    <div id="restaurants_<?= $package->packageid; ?>">
            <p><select multiple="multiple" size="10" id="stores<?= $package->packageid; ?>">
            <? foreach ($restaurants AS $restaurant) { ?>

                <?
                $selected = '';
                if(isset($assignments))
                {
                    if(in_array($restaurant->RestaurantID, $assignments))
                    {
                       $selected= 'SELECTED';
                    }
                }
                ?> 

                <option value="<?= $restaurant->RestaurantID; ?>" <?print $selected; ?> >
                    (<?= $restaurant->RestaurantID; ?>) <?= $restaurant->UnitName; ?>
                </option>

            <? }; ?>
            </select></p>
        </div>
    <?/* <p><input id="radiodist<?= $job->id; ?>" type="radio" value="distlist" name="publish_option<?= $job->id; ?>" onclick="distListDisplay(<?= $job->id; ?>);" <? if ($job->distribution_list != "") echo 'checked'; ?> /> Distribution List</p>

    <div id="distribution_<?= $job->id; ?>" <? if ($job->distribution_list == "") echo 'style="display:none; overflow:hidden;"'; ?>>
        <p><select id="distlist<?= $job->id; ?>">
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
    </div><hr>   */
   
    ?>

    <button class="btn btn-primary" onclick="update_package_assignments(<?print $package->packageid;?>)">Update Publishing Options</button>