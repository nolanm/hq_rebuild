<h2>Restaurant Services</h2>


<div class="lead">Your restaurants provide a wide array of services. 
    These services are important to visitors as they choose which restaurants to visit.
    This area allows you to configure your site with the services your stores provide.</div>

<script type="text/javascript" src="<?php echo base_url();?>js/restaurants/sevices.js"></script> 

<form action="#" id="services_frm" name="services_frm">
<? 
    $restaurants = $view_data['restaurant_array'];
    $owner="";

    foreach($restaurants as $row)
    {
        if($owner!=$row->OwnerID)
        {
            if($owner!="")
            {
                print"</tbody>";
                print"</table>";
            }
            $owner=$row->OwnerID;
            print"<div class='well well-small'>$row->FirstName $row->LastName Organization</div>";
            print"<table class='table table-striped table-condensed' id='table_$row->OwnerID'>";
            print"<thead>".
                    "<tr>".
                        "<th>&nbsp;</th>".
                        "<th>ArchCard</th>".
                        "<th>Cashless</th>".
                        "<th>WiFi</th>".
                        "<th>RedBox</th>".
                        "<th>RV/Bus</th>".
                        "<th>PlayPlace</th>".
                        "<th>Drivethru</th>".
                        "<th>Walmart</th>".
                        "<th>McCafe</th>".
                        "<th>&nbsp;</th>".
                    "</tr>".
                "</thead><tbody>";
        }
        
        ?>

        
            <tr>
                <td><p class="small"><?print"#$row->RestaurantID";?></p><small><?print"$row->UnitName";?></small></td>
                <td><?
                    $archcard= array(
                        'name'        => "archcard_$row->RestaurantID",
                        'id'          => "archcard_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->archcard,
                        'onclick'     => "update_service('archcard_$row->RestaurantID')"
                     );
                    print form_checkbox($archcard);
                    ?>
                </td>
                <td>
                    <?
                    $cashless= array(
                        'name'        => "cashless_$row->RestaurantID",
                        'id'          => "cashless_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->cashless,
                        'onclick'     => "update_service('cashless_$row->RestaurantID')"
                     );
                    print form_checkbox($cashless);
                    ?>
                </td>
                <td>
                    <?
                    $wifi= array(
                        'name'        => "wifi_$row->RestaurantID",
                        'id'          => "wifi_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->wifi,
                        'onclick'     => "update_service('wifi_$row->RestaurantID')"
                     );
                    print form_checkbox($wifi);
                    ?>
                </td>
                <td>
                    <?
                    $redbox= array(
                        'name'        => "redbox_$row->RestaurantID",
                        'id'          => "redbox_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->redbox,
                        'onclick'     => "update_service('redbox_$row->RestaurantID')"
                     );
                    print form_checkbox($redbox);
                    ?>
                </td>
                <td>
                    <?
                    $rvbus= array(
                        'name'        => "rvbus_$row->RestaurantID",
                        'id'          => "rvbus_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->rvbus,
                        'onclick'     => "update_service('rvbus_$row->RestaurantID')"
                     );
                    print form_checkbox($rvbus);
                    ?>
                </td>
                <td>
                    <?
                    $placeplace= array(
                        'name'        => "playplace_$row->RestaurantID",
                        'id'          => "playplace_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->playplace,
                        'onclick'     => "update_service('playplace_$row->RestaurantID')"
                     );
                    print form_checkbox($placeplace);
                    ?>
                </td>
                <td>
                    <?
                    $drivethru= array(
                        'name'        => "drivethru_$row->RestaurantID",
                        'id'          => "drivethru_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->drivethru,
                        'onclick'     => "update_service('drivethru_$row->RestaurantID')"
                     );
                    print form_checkbox($drivethru);
                    ?>
                </td>
                <td>
                    <?
                    $walmart= array(
                        'name'        => "walmart_$row->RestaurantID",
                        'id'          => "walmart_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->walmart,
                        'onclick'     => "update_service('walmart_$row->RestaurantID')"
                     );
                    print form_checkbox($walmart);
                    ?>
                </td>
               <td>
                    <?
                    $mccafe= array(
                        'name'        => "mccafe_$row->RestaurantID",
                        'id'          => "mccafe_$row->RestaurantID",
                        'value'       => 'accept',
                        'checked'     => $row->mccafe,
                        'onclick'     => "update_service('mccafe_$row->RestaurantID')"
                     );
                    print form_checkbox($mccafe);
                    ?>
                </td>
                <td>
                    <button class="btn btn-mini btn-info" type="button" onclick="check_all(<?print"$row->RestaurantID";?>)"><i class="icon-ok"></i> Check All</button>
                </td>
            </tr>
       <?
        
    }
?>
</tbody>
</table>
</form>