
<h2>My Application Settings</h2>


<div class="lead"><p>Update all of your restaurant application settings here.</p></div>

<script type="text/javascript" src="<?php echo base_url();?>js/hr/application_settings.js"></script> 

<?
    $settings = $view_data['settings_array'];
    $owner=0;
    foreach($settings as $row)
    {
        if($owner!=$row->OwnerID)
        {
            $owner=$row->OwnerID;
            print"<div class='well well-small'>$row->FirstName $row->LastName Organization</div>";
        }
        ?>  
        <div class="accordion">
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a type="button" class="btn  btn-link" data-toggle="collapse" data-target="#settings<?print $row->RestaurantID;?>">
                        <i class="icon-pencil"></i>
                    <?print"$row->RestaurantID - $row->UnitName"; 
                        if(!empty($row->StoreName))
                        {
                           print" ($row->StoreName)";
                        }
                     ?>  
                    </a>
                    <span class="pull-right">
                        <em>Is this restaurant currently accepting applications? 
                        Yes <input type="radio" id="AcceptsApps<?print $row->RestaurantID;?>" name="AcceptsApps<?print $row->RestaurantID;?>" value="1" <? if ($row->AcceptsApps == 1) echo 'checked'; ?> onclick="accept_apps(<?print $row->RestaurantID;?>);" />&nbsp;
                        No <input type="radio" id="AcceptsApps<?print $row->RestaurantID;?>" name="AcceptsApps<?print $row->RestaurantID;?>" value="0" <? if ($row->AcceptsApps == 0) echo 'checked'; ?> onclick="accept_apps(<?print $row->RestaurantID;?>);" />&nbsp;
                        </em>
                    </span>
                </div>
                <div id="settings<?print $row->RestaurantID;?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <div id="update_alert<?print $row->RestaurantID;?>"></div>
                        <div>Does this restaurant participate in the E-Verify Program? 
                            Yes <input type="radio" id="everify_<?=$row->RestaurantID;?>" name="everify_<?=$row->RestaurantID;?>" value="1" <? if ($row->e_verify == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="everify_<?=$row->RestaurantID;?>" name="everify_<?=$row->RestaurantID;?>" value="0" <? if ($row->e_verify == 0) echo 'checked'; ?> /> <br/><br/>
                        </div>
                        
                        <div>Is this restaurant enrolled in Hiring To Win? 
                            YES <input type="radio" id="hiring_to_win<?print $row->RestaurantID;?>" name="hiring_to_win<?print $row->RestaurantID;?>" value="1" <? if ($row->hiring_to_win == 1) echo 'checked'; ?> onclick="show_htw_div(<?print $row->RestaurantID;?>)" />
                            NO <input type="radio" id="hiring_to_win<?print $row->RestaurantID;?>" name="hiring_to_win<?print $row->RestaurantID;?>" value="0" <? if ($row->hiring_to_win == 0) echo 'checked'; ?> onclick="hide_htw_div(<?print $row->RestaurantID;?>)" /><br/><br/>
                        </div>
                        
                        
                        <div id="htw_link<?print $row->RestaurantID;?>" <?if($row->hiring_to_win == 0) print "hidden";?>>
                            Would you like to auto-link your connection to Hiring to Win for this restaurant? 
                            YES <input type="radio" id="htw_autolink<?print $row->RestaurantID;?>" name="htw_autolink<?print $row->RestaurantID;?>" value="1"  <? if ($row->htw_autolink == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="htw_autolink<?print $row->RestaurantID;?>" name="htw_autolink<?print $row->RestaurantID;?>" value="0" <? if ($row->htw_autolink == 0) echo 'checked'; ?> /><br/><br/>
                        </div>
                        
                        <div id="htw_mgmt<?print $row->RestaurantID;?>" <?if($row->hiring_to_win == 0) print "hidden";?>>
                            Would you like to send your MANAGEMENT applications to Hiring To Win? 
                            YES <input type="radio" id="hiring_to_win_force_mgmt<?print $row->RestaurantID;?>" name="hiring_to_win_force_mgmt<?print $row->RestaurantID;?>" value="1" onclick="hide_mgmt_email(<?print $row->RestaurantID;?>)" <? if ($row->hiring_to_win_force_mgmt == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="hiring_to_win_force_mgmt<?print $row->RestaurantID;?>" name="hiring_to_win_force_mgmt<?print $row->RestaurantID;?>" value="0" onclick="show_mgmt_email(<?print $row->RestaurantID;?>)" <? if ($row->hiring_to_win_force_mgmt == 0) echo 'checked'; ?> /><br/><br/>
                        </div>
                        
                        <div id="mgmt_email<?print $row->RestaurantID;?>" <?if($row->hiring_to_win == 1 && $row->hiring_to_win_force_mgmt == 1) print "hidden";?>>
                            Management Email Address: <input type="text" id="MgmtEmail<?print $row->RestaurantID;?>" size="50" value="<?=$row->MgmtEmail;?>" /><br/>
                            <small><em>seperate addresses by comma to send apps to multiple addresses eg: email1@mcd.com, email2@mcd.com, etc</em></small><br><br/>
                        </div>
                        
                        <div id="htw_crew<?print $row->RestaurantID;?>" <?if($row->hiring_to_win == 0) print "hidden";?>>
                            Would you like to send your CREW applications to Hiring To Win? 
                            YES <input type="radio" id="hiring_to_win_force_crew<?print $row->RestaurantID;?>" name="hiring_to_win_force_crew<?print $row->RestaurantID;?>" value="1" onclick="hide_crew_email(<?print $row->RestaurantID;?>)" <? if ($row->hiring_to_win_force_crew == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="hiring_to_win_force_crew<?print $row->RestaurantID;?>" name="hiring_to_win_force_crew<?print $row->RestaurantID;?>" value="0" onclick="show_crew_email(<?print $row->RestaurantID;?>)" <? if ($row->hiring_to_win_force_crew == 0) echo 'checked'; ?> /><br><br/>
                        </div>
                        
                        <div id="crew_email<?print $row->RestaurantID;?>" <?if($row->hiring_to_win == 1 && $row->hiring_to_win_force_crew == 1) print "hidden";?>>
                            Crew Email Address: <input type="text" id="CrewEmail<?print $row->RestaurantID;?>" size="50" value="<?=$row->CrewEmail;?>" /><br/>
                            <small><em>seperate addresses by comma to send apps to multiple addresses eg: email1@mcd.com, email2@mcd.com, etc</em></small><br><br/>
                        </div>
                        
                        <div id="addOptions<?=$row->RestaurantID;?>" <?if ($row->hiring_to_win == 1 && $row->hiring_to_win_force_crew == 1 && $row->hiring_to_win_force_mgmt == 1 ) print "hidden"; ?>>
                            
                            <strong>Additional Application Options:</strong><hr>

                            Would you like to receive spanish applications at this restaurant? 
                            YES <input type="radio" id="SpanishApps<?print $row->RestaurantID;?>" name="SpanishApps<?print $row->RestaurantID;?>" value="1" <? if ($row->SpanishApps == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="SpanishApps<?print $row->RestaurantID;?>" name="SpanishApps<?print $row->RestaurantID;?>" value="0" <? if ($row->SpanishApps == 0) echo 'checked'; ?> /><br><br>

                            Would you like to receive HTML formatted applications? 
                            YES <input type="radio" id="HTMLApps<?print $row->RestaurantID;?>" name="HTMLApps<?print $row->RestaurantID;?>" value="1" <? if ($row->HTMLApps == 1) echo 'checked'; ?> /> 
                            NO <input type="radio" id="HTMLApps<?print $row->RestaurantID;?>" name="HTMLApps<?print $row->RestaurantID;?>" value="0" <? if ($row->HTMLApps == 0) echo 'checked'; ?> /><br><br>

                            Would you like to send applicants an email response?<br><br>
                            <input type="radio" id="SendAppResponse<?print $row->RestaurantID;?>" name="SendAppResponse<?print $row->RestaurantID;?>" value="1" onclick="app_response(<?=$row->RestaurantID;?>)" <? if ($row->SendAppResponse == 1) echo 'checked'; ?> /> Send the default response.<br><br>
                            <input type="radio" id="SendAppResponse<?print $row->RestaurantID;?>" name="SendAppResponse<?print $row->RestaurantID;?>" value="2" onclick="app_response(<?=$row->RestaurantID;?>)" <? if ($row->SendAppResponse == 2) echo 'checked'; ?> /> Send the response indicated below.<br><br>
                           
                            <div id="appresponse_default<?=$row->RestaurantID;?>"<?if ($row->SendAppResponse == 2) echo 'hidden';?>>
                                    
                                    <p>Email Body<br /><textarea class="span5" rows="10" id="AppResponseDefaultText<?=$row->RestaurantID;?>" readonly>Dear Applicant:<?print"\n\n";?>Thank you for taking the time to apply for an opportunity at your local McDonald's restaurant<?print"\n\n";?>Your application has been received and your information will be reviewed. We will contact you if you are going to be considered for the next step in the hiring process.<?print"\n\n";?>If you would like to learn more about employment opportunities with McDonald's and its franchisees, please visit http://www.mcdonalds.com/careers.<?print"\n\n";?>Thank you again,<?print"\n";?>McDonald's Management Team</textarea></p>
                                    
                            </div>
                            <div id="appresponse<?=$row->RestaurantID;?>" <?if ($row->SendAppResponse == 1) echo 'hidden';?>>
                                    
                                    <p>Email Body<br /><textarea class="span5" rows="10" id="AppResponseText<?=$row->RestaurantID;?>"><?if($row->AppResponseText !=''){print $row->AppResponseText;}else{print "Type your custom message here.";}?></textarea></p>
                                    
                            </div>

                        </div>
                        <button class="btn btn-primary" onclick="save_settings(<?print $row->RestaurantID;?>)">Save Settings</button>&nbsp;&nbsp;&nbsp;&nbsp;
                        or
                        <button class="btn btn-link" data-toggle="collapse" data-target="#settings<?print $row->RestaurantID;?>">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <?
    }

?>