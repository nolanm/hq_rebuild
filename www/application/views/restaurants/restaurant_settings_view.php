

    <h2>Change Restaurant Settings</h2>
   
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
      <script type="text/javascript" src="<?php echo base_url();?>js/restaurants/restaurant_settings.js"></script> 
      
     
    <?
        $restaurants= $view_data['restaurant_array'];
        $backgrounds= $view_data['backgrounds_array'];
        //print_r($backgrounds);
        $owner="";
        foreach($restaurants as $row)
        {
            if($owner!=$row->OwnerID)
            {
                if($owner!="")
                {
                    print"</div>";
                }
                $owner=$row->OwnerID;
                print"<div class='well well-small'>$row->FirstName $row->LastName Organization</div>";
                print"<div class='accordion' id='accordion$row->OwnerID'>";
            }
            ?>
            <div class="accordion-group">
                <div class="accordion-heading">
                    <?//print"$row->RestaurantID - $row->UnitName ($row->StoreName)"?>
                    &nbsp; <a type="button" class="btn  btn-mini btn-info" data-toggle="collapse" data-parent="#accordion<?print"$row->OwnerID";?>" data-target="#collapse<?print"$row->RestaurantID";?>">
                    <i class="icon-pencil"></i>
                    </a>
                    <?print"$row->RestaurantID - $row->UnitName"; 
                        if(!empty($row->StoreName))
                        {
                           print" ($row->StoreName)";
                        }
                      ?>  
                </div>
                <div id="collapse<?print"$row->RestaurantID";?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div class="hero-unit-basic">
                            <div class="tabbable tabs-left">
                                <ul class="nav nav-tabs" id="tab<?print"$row->RestaurantID";?>">
                                    <li class="active"><a href="#info<?print"$row->RestaurantID";?>" data-toggle="tab">Information</a></li>
                                    <li><a href="#photo<?print"$row->RestaurantID";?>" data-toggle="tab">Photo</a></li>
                                    <li><a href="#map<?print"$row->RestaurantID";?>" id="map_tab<?print"$row->RestaurantID";?>" data-toggle="tab" >Map Location</a></li>
                                    <li><a href="#address<?print"$row->RestaurantID";?>" data-toggle="tab">Mailing Address</a></li>
                                    <li><a href="#background<?print"$row->RestaurantID";?>" data-toggle="tab">Website Background</a></li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="info<?print"$row->RestaurantID";?>"><br/>
                                         
                                     <form> 
                                        <div id="info_alert_<?print"$row->RestaurantID";?>" name="info_alert_<?print"$row->RestaurantID";?>"></div>
                                        <div class="control-group">
                                            <label class="control-label" for="restaurantid">Restaurant ID:</label>
                                            <div class="controls">
                                                <input type="text" name="restaurantid" id="restaurantid<?print"$row->RestaurantID";?>" value="<?print"$row->RestaurantID";?>" readonly>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="StoreName">Store Name:<br><small>(for public display)</small></label>
                                            <div class="controls">
                                                <input type="text" id="StoreName<?print"$row->RestaurantID";?>" value="<?print"$row->StoreName";?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="UnitName">Restaurant Nickname:<br><small>(internal use only)</small></label>
                                            <div class="controls">
                                                <input type="text" id="UnitName<?print"$row->RestaurantID";?>" value="<?print"$row->UnitName";?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="ManagerName">Restaurant Manager:<br><small>(Will show up on IRHP Header)</small></label>
                                            <div class="controls">
                                                <input type="text" id="ManagerName<?print"$row->RestaurantID";?>" value="<?print"$row->ManagerName";?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="ManagerEmail">Restaurant Manager Email:<br><small>(Email address where messages can be sent to the manager. Leave blank if the manager does not wish to receive emails.)</small></label>
                                            <div class="controls"> 
                                                <input type="text" id="ManagerEmail<?print"$row->RestaurantID";?>" value="<?print"$row->ManagerEmail";?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="CommentsEmail">Comments Email:<br><small>(Email address where comments to this restaurant will be sent. Leave blank if you do not wish to receive comments.)</small></label>
                                            <div class="controls">
                                                <input type="text" id="CommentsEmail<?print"$row->RestaurantID";?>" value="<?print"$row->CommentsEmail";?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="timezone">Restaurant Timezone:</label>
                                            <div class="controls">
                                                <select name="timezone<?print"$row->RestaurantID";?>" id="timezone<?print"$row->RestaurantID";?>">
                                                    <option value="0">- No Timezone Selected -</option>
                                                    <option value="-10.0" <? if ($row->timezone == '-10.0') echo 'selected';?>>(GMT -10:00) Hawaii</option>
                                                    <option value="-9.0" <? if ($row->timezone == '-9.0') echo 'selected';?>>(GMT -9:00) Alaska</option>
                                                    <option value="-8.0" <? if ($row->timezone == '-8.0') echo 'selected';?>>(GMT -8:00) Pacific Time (US)</option>
                                                    <option value="-7.0" <? if ($row->timezone == '-7.0') echo 'selected';?>>(GMT -7:00) Mountain Time (US)</option>
                                                    <option value="-6.0" <? if ($row->timezone == '-6.0') echo 'selected';?>>(GMT -6:00) Central Time (US)</option>
                                                    <option value="-5.0" <? if ($row->timezone == '-5.0') echo 'selected';?>>(GMT -5:00) Eastern Time (US)</option>
                                                    <option value="10.0" <? if ($row->timezone == '10.0') echo 'selected';?>>(GMT 10:00) Guam</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="market_radius">Market Radius:</label>
                                            <div class="controls">
                                                <select name="market_radius<?print"$row->RestaurantID";?>" id="market_radius<?print"$row->RestaurantID";?>">
							<option value="1" <? if ($row->market_radius == '1') echo 'selected';?>>1 Mile</option>
							<option value="5" <? if ($row->market_radius == '5') echo 'selected';?>>5 Miles</option>
							<option value="10" <? if ($row->market_radius == '10') echo 'selected';?>>10 Miles</option>
							<option value="25" <? if ($row->market_radius == '25') echo 'selected';?>>25 Miles</option>
							<option value="50" <? if ($row->market_radius == '50') echo 'selected';?>>50 Miles</option>
							<option value="100" <? if ($row->market_radius == '100') echo 'selected';?>>100 Miles</option>
						</select>
                                            </div>
                                        </div>
                                     </form>
                                        <p><button class="btn btn-primary" onclick="save_info(<?print"$row->RestaurantID";?>)">Save Information</button></p>
                                    </div>
                                    <div class="tab-pane" id="photo<?print"$row->RestaurantID";?>"><br/>
                                       
                                      <div class="row-fluid">
                                            <ul class="thumbnails">
                                                <li class="span9 offset1">
                                                <div class="thumbnail">
                                                    <?
                                                    if(!isset($row->RestaurantID) )
                                                    {
                                                        print"<img src='/img/restaurant_photos/$row->RestaurantID.jpg' class='img-polaroid'>";
                                                    }
                                                    else
                                                    {
                                                        print"<img src='/img/restaurant_photos/default_photo.jpg' class='img-polaroid'>";
                                                    }
                                                    ?>
                                                    <br/>
                                                    <div class="row-fluid">
                                                        <div class="span4 offset2"><a href="#myModal" role="button" class="btn btn-block btn-primary" data-toggle="modal" onclick="addphotolistener(<?print"$row->RestaurantID";?>)"><i class="icon-picture"></i> Change Photo</a></div>

                                                        <div class="span4"><button class="btn btn-block btn-primary"><i class="icon-minus-sign"></i> Reset Photo</button></div>
                                                    </div>
                                                </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- Modal -->
                                        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h3 id="myModalLabel">Change Restaurant Image</h3>
                                            </div>
                                            <div class="modal-body">
                                                <form id="input_picture_form<?print"$row->RestaurantID";?>">
                                                   
                                                <p>Choose Picture: <input id="uploadedfile<?print"$row->RestaurantID";?>" type="file" /></p>
                                                    <ul class="thumbnails">
                                                        <li class="span3">
                                                         <div id="upload_photo_resize<?print"$row->RestaurantID";?>"></div>
                                                        </li>
                                                        <li class="span1">
                                                         <div id="upload_photo_thumb<?print"$row->RestaurantID";?>" ></div>
                                                        </li>
                                                    </ul>
                                               
                                                
                                                
                                                <input type="hidden" name="x1" value="" id="x1" />
                                                <input type="hidden" name="y1" value="" id="y1" />
                                                <input type="hidden" name="x2" value="" id="x2" />
                                                <input type="hidden" name="y2" value="" id="y2" />
                                                <input type="hidden" name="w" value="" id="w" />
                                                <input type="hidden" name="h" value="" id="h" />
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                                                <button class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="map<?print"$row->RestaurantID";?>"><br/>
                                        <script type="text/javascript">
                                            show_map(<?print $row->RestaurantID;?>,<?print $row->latitude;?>,<?print $row->longitude;?>) 
                                        </script>
                                          <div id="map_alert_<?print"$row->RestaurantID";?>" name="map_alert_<?print"$row->RestaurantID";?>"></div>
                                         <p><label>Latitude:</label>
                                         <input id="res_lat_<?print $row->RestaurantID;?>" onchange="lat_lng_changed(<?print $row->RestaurantID;?>)" name="latitude" type="text" value="<?print $row->latitude;?>" size="10"></p>
                                         <p><label>Longitude:</label>
                                         <input id="res_lng_<?print $row->RestaurantID;?>" onchange="lat_lng_changed(<?print $row->RestaurantID;?>)" type="text" name="longitude" value="<?print $row->longitude;?>" size="10"></p>
                                        <div class="center map_canvas" id="map_canvas<?print $row->RestaurantID;?>">
                                            
                                        </div><br/>
                                        <?
                                            $physicalAddress = "";
                                                    if ($row->Address != '')
                                                        $physicalAddress = $physicalAddress.$row->Address." ";
                                                    if ($row->Address2 != '')
                                                        $physicalAddress = $physicalAddress.$row->Address2." ";
                                                    if ($row->City != '')
                                                        $physicalAddress = $physicalAddress.ucwords(strtolower($row->City)).", ";
                                                    if ($row->Abbreviation != '')
                                                        $physicalAddress = $physicalAddress.$row->Abbreviation." ";
                                                    if ($row->Zip != '')
                                                        $physicalAddress = $physicalAddress.$row->Zip;
                                                    
                                        ?>
                                        <p><label>Jump to an Address:</label><input id="address_<?print $row->RestaurantID;?>" type="textbox" size="40" value="<?print $physicalAddress;?>">
                                        <button onclick="codeAddress(<?print $row->RestaurantID;?>)">Map this Address</button><p/>
                                        
                                        <p><label>Restaurant Physical Address:</label> <input id="physicaladdress_<?print $row->RestaurantID;?>" type="textbox" size="40" value="<?print $physicalAddress;?>" readonly="readonly"></p>
                                        <p><button class="btn btn-primary" onclick="update_latlng(<?print $row->RestaurantID;?>)">Save changes</button></p>
                                    </div>
                                    <div class="tab-pane" id="address<?print"$row->RestaurantID";?>"><br/>
                                        
                                        <form id="address<?print"$row->RestaurantID";?>" > 
                                        <div id="address_alert_<?print"$row->RestaurantID";?>" name="address_alert_<?print"$row->RestaurantID";?>"></div>
                                        <input type="hidden" id="addressrestaurantid<?print"$row->RestaurantID";?>" value="<?print"$row->RestaurantID";?>" />
                                        <div class="control-group">
                                            <label class="control-label" for="MailAddress">Address 1:</label>
                                            <div class="controls">
                                                <input id="MailAddress_<?=$row->RestaurantID;?>" type="text" name="MailAddress" value="<?= $row->MailAddress ?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="MailAddress2">Address 2:</label>
                                            <div class="controls">
                                                <input id="MailAddress2_<?=$row->RestaurantID;?>" type="text" name="MailAddress2" value="<?= $row->MailAddress2 ?>" size="40">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="MailCity">City:</label>
                                            <div class="controls">
                                                <input id="City_<?=$row->RestaurantID;?>" type="text" name="MailCity" value="<?= $row->MailCity ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="MailState">State:</label>
                                            <div class="controls">
                                                <input id="State_<?=$row->RestaurantID;?>" type="text" name="MailState" value="<?= $row->MailState ?>" size="3">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="MailZip">Zip:</label>
                                            <div class="controls">
                                                <input id="Zip_<?=$row->RestaurantID;?>" type="text" name="MailZip" value="<?= $row->MailZip ?>" size="12">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Phone">Restaurant Phone:</label>
                                            <div class="controls">
                                                <input type="text" name="Phone" id="Phone_<?=$row->RestaurantID;?>" value="<?= $row->Phone ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label" for="Fax">Restaurant Fax:</label>
                                            <div class="controls">
                                                <input type="text" name="Fax" id="Fax_<?=$row->RestaurantID;?>" value="<?= $row->Fax ?>">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" onclick="save_address(<?print"$row->RestaurantID";?>)" id="address_button_<?print"$row->RestaurantID";?>">Save Mailing Address</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="background<?print"$row->RestaurantID";?>"><br/>
                                        
                                        
                                        
                                        <form id="background<?print"$row->RestaurantID";?>" > 
                                        <div id="background_alert_<?print"$row->RestaurantID";?>" name="background_alert_<?print"$row->RestaurantID";?>"></div>
                                        <input type="hidden" id="background_restaurantid<?print"$row->RestaurantID";?>" value="<?print"$row->RestaurantID";?>" />
                                        <div class="btn-group" data-toggle-name="is_private" data-toggle="buttons-radio" >
                                        <div class="row-fluid">
                                            <ul class="thumbnails">
                                            <?
                                            
                                            $i=0;
                                            foreach($backgrounds as $background)
                                            {
                                                if ($background->style == 'dark') 
                                                {
                                                    $style = '#000';
                                                }
                                                else 
                                                {
                                                    $style = '#F1EEE6';
                                                }
                                                if($background->id == $row->background)
                                                {
                                                    $checked=TRUE;
                                                }
                                                else
                                                {
                                                    $checked=FALSE;
                                                }
                                                $radio = array(
                                                    'name'        => "radio_background_$row->RestaurantID",
                                                    'value'       => $background->id,
                                                    'checked'     => $checked,
                                                    );
                                            ?>
                                              <li class="span4">
                                                <div class="thumbnail">
                                                    <?print'<img src="/img/irhp-thumbnail.png" style="background: '.$style.' url(\'/img/restaurant_backgrounds/'.$background->id.'_thumb.jpg\') top no-repeat;">';?>
                                                    <div class="caption">
                                                        <h5><?echo form_radio($radio); echo" $background->name"; if($background->default==1){?><small class="muted"><em> Default</em></small><?}?></h5>
                                                    <?if($background->expiration != '') 
                                                        {
                                                            echo '<p><small>Expiration: ' . $background->expiration.'</small></p>';
							}?>
                                                    </div>
                                                </div>
                                              </li>
                                              <?
                                                $i++;
                                                if($i%3==0)
                                                {
                                                    ?>
                                                    </ul>
                                                    </div>
                                                    <div class="row-fluid">
                                                    <ul class="thumbnails">
                                                    <?  
                                                }
                                              ?>
                                              
                                            <?}?>
                                            </ul>
                                        </div>
                                        </div>
                                        <button class="btn btn-primary" id="background_button_<?print"$row->RestaurantID";?>">Save Website Background</button>
                                        <?echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?
        }
        print"</div>";//ends last accordion div
        //echo form_open("settings_", array('class'=>'form-horizontal'));
    ?>

