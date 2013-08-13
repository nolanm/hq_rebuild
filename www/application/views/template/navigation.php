<?php 

  
?>
<div class="container" >

    <!-- Docs nav
    ================================================== -->
    <div class="row" id="background">
        
      <div class="span3 bs-docs-sidebar">
    <!--Sidebar content-->
    <ul class="nav nav-list"> 
        <p>
            <a href="/" class="btn btn-link">
            <img src="/img/logo.gif" class="img-rounded">
            </a>
        </p>
        <br/>
        <br/>
        
<?

if(strcmp($this->session->userdata('user_type'), 'organization') == 0)
{
    
    if($this->session->userdata('restaurant_settings') 
                || $this->session->userdata('hours') 
                || $this->session->userdata('services')) 
            {
            // //check to see if user has permission to any link under my restaurant button
            ?>
        <button type="button" class="btn btn-small btn-primary btn-block" data-toggle="collapse" data-target="#myrestaurants">
            My Restaurants
        </button> 
        <div id="myrestaurants" class="collapse">
            <ul class="unstyled">
            <? if($this->session->userdata('restaurant_settings')) { ?>
                <li>
                    <a href="/index.php/restaurants/restaurant_settings/" class="btn btn-link">Settings</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('hours')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Hours</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('services')) { ?>
                <li>
                    <a href="/index.php/restaurants/services/" class="btn btn-link">Services</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('qr_codes')) { ?>
                <li>
                    <a href="/" class="btn btn-link">QR Codes</a>
                </li>
                <? } ?>
            </ul>
        </div>
        <li class="divider"></li>
        <? } //end of my restaurant button check ?>
        <? if($this->session->userdata('mcteachers_night') 
                || $this->session->userdata('donation_request') 
                || $this->session->userdata('grand_opening') 
                || $this->session->userdata('calendar_of_events')
                || $this->session->userdata('restaurant_tours')
                || $this->session->userdata('orange_bowl')
                || $this->session->userdata('power_bowl')
                || $this->session->userdata('birthday_party_to_go')
                || $this->session->userdata('birthday_party_reservation')
                || $this->session->userdata('brand_trust'))
            {
            // //check to see if user has permission to any link under my restaurant button
            ?>
        <button type="button" class="btn btn-small btn-primary btn-block" data-toggle="collapse" data-target="#lsm">
            Local Store Marketing
        </button>
        <div id="lsm" class="collapse">
            <ul class="unstyled">
                <? if($this->session->userdata('mcteachers_night')) { ?>
                <li>
                    <a href="/index.php/lsm/mcteachers_night/" class="btn btn-link">McTeacher's Night</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('donation_request')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Donation Request</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('grand_opening')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Grand Opening Template</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('calendar_of_events')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Calendar of Events</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('restaurant_tours')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Restaurant Tours</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('orange_bowl')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Orange Bowl</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('power_bowl')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Power Bowl</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('birthday_party_to_go')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Birthday Party To Go</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('birthday_party_reservation')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Birthday Party Reservation</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('brand_trust')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Brand Trust</a>
                </li>
                <? } ?>
            </ul>
        </div>
        <li class="divider"></li>
        <? } //end of my lsm button check ?>
        <? if($this->session->userdata('jobs') 
                || $this->session->userdata('benefits') 
                || $this->session->userdata('application_settings') 
                || $this->session->userdata('ray_kroc')
                || $this->session->userdata('hiring_day')) 
            {
            // //check to see if user has permission to any link under my restaurant button
            ?>
        <button type="button" class="btn btn-small btn-primary btn-block" data-toggle="collapse" data-target="#hr">
            Human Resources
        </button>
        <div id="hr" class="collapse">
            <ul class="unstyled">
                <? if($this->session->userdata('jobs')) { ?>
                <li>
                    <a href="/index.php/hr/jobs/" class="btn btn-link">Jobs</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('benefits')) { ?>
                <li>
                    <a href="/index.php/hr/benefits/" class="btn btn-link">Benefits</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('application_settings')) { ?>
                <li>
                    <a href="/index.php/hr/application_settings/" class="btn btn-link">Application Settings</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('ray_kroc')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Ray Kroc Award</a>
                </li>
                <? } ?>
                <? if($this->session->userdata('hiring_day')) { ?>
                <li>
                    <a href="/" class="btn btn-link">Hiring Day Template</a>
                </li>
                <? } ?>
            </ul>
        </div>
        <li class="divider"></li>
        <? } //end of my HR button check ?>
        <?if($this->session->userdata('custom_content')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Custom Content
            </a>
        </p>

        <? } ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Statistics
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Support
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Suggestion Box
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Order P.O.P.
            </a>
        </p>

  

<? 
    }

    if($this->session->userdata('user_type')=='coop')
    {
        if($this->session->userdata('calendar_of_events')) { ?>
            <p>
                <a href="/" class="btn btn-small btn-primary btn-block">
                    Calendar of Events
                </a>
            </p>
            <? } ?>
            <? if($this->session->userdata('brand_trust')) { ?>
            <p>
                <a href="/" class="btn btn-small btn-primary btn-block">
                    Brand Trust
                </a>
            </p>
            <? } ?>

            <? if($this->session->userdata('jobs')) { ?>
            <p>
                <a href="/" class="btn btn-small btn-primary btn-block">
                    Jobs
                </a>
            </p>
            <? } ?>
                
        <?if($this->session->userdata('custom_content')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Custom Content
            </a>
        </p>

        <? } ?>
        
        <?if($this->session->userdata('banners')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Banners
            </a>
        </p>

        <? } ?>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Statistics
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Support
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Suggestion Box
            </a>
        </p>


        <?
    }

    if($this->session->userdata('user_type')=='region')
    {
         if($this->session->userdata('calendar_of_events')) { ?>
            <p>
                <a href="/" class="btn btn-small btn-primary btn-block">
                    Calendar of Events
                </a>
            </p>
            <? } ?>
            <? if($this->session->userdata('brand_trust')) { ?>
            <p>
                <a href="/" class="btn btn-small btn-primary btn-block">
                    Brand Trust
                </a>
            </p>
            <? } ?>

                
        <?if($this->session->userdata('custom_content')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Custom Content
            </a>
        </p>

        <? } ?>
        
        <?if($this->session->userdata('banners')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Banners
            </a>
        </p>

        <? } ?>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Statistics
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Support
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Suggestion Box
            </a>
        </p>

 


        <?
    }

    if($this->session->userdata('user_type')=='division')
    {
       if($this->session->userdata('custom_content')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Custom Content
            </a>
        </p>

        <? } ?>
        
        <?if($this->session->userdata('banners')) { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Banners
            </a>
        </p>

        <? } ?>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Statistics
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Support
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Suggestion Box
            </a>
        </p>

   
        <?
    }
    
    if($this->session->userdata('user_type')=='national' || 
            $this->session->userdata('user_type')=='administrative')
    {
       
       ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Banners
            </a>
        </p>
        
        
        <?if($this->session->userdata('user_type')=='administrative') { ?>
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            MAI
            </a>
        </p>
        
        <p>
            <button type="button" class="btn btn-small btn-primary btn-block" data-toggle="collapse" data-target="#myrestaurants">
            HQAI
        </button> 
        <div id="myrestaurants" class="collapse">
            <ul class="unstyled">
            
                <li>
                    <a href="/" class="btn btn-link">"What's New" Blog</a>
                </li>
               
                <li>
                    <a href="/" class="btn btn-link">Online Manuals</a>
                </li>
               
                <li>
                    <a href="/" class="btn btn-link">FAQs</a>
                </li>
                
                <li>
                    <a href="/" class="btn btn-link">Facts</a>
                </li>
              
            </ul>
        </div>
        </p>

        <? } ?>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            MCD
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Statistics
            </a>
        </p>
        
        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Support
            </a>
        </p>

        <p>
            <a href="/" class="btn btn-small btn-primary btn-block">
            Suggestion Box
            </a>
        </p>
        
        <?
        if($this->session->userdata('user_type')=='administrative')
        {
            ?> 
                <li class="divider"></li>
                <h4>DAI Tools</h4>
               
                <div class="btn-group">
                    <a class="btn" href="#">Find Restaurant</a>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Find Division</a></li>
                        <li><a tabindex="-1" href="#">Find Region</a></li>
                        <li><a tabindex="-1" href="#">Find Coop</a></li>
                        <li><a tabindex="-1" href="#">Find Organization</a></li>
                        <li><a tabindex="-1" href="#">Find Restaurant</a></li>
                        <li><a tabindex="-1" href="#">Find Login</a></li>
                    </ul>
                    </div>
                <br/>
                <div class="btn-group">
                    <a class="btn" href="#">Add Restaurant</a>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a tabindex="-1" href="#">Add Organization</a></li>
                        <li><a tabindex="-1" href="#">Add Restaurant</a></li>
                        <li><a tabindex="-1" href="#">Add Login</a></li>
                    </ul>
                </div>
            <?
        }
    }
    
    if($this->session->userdata('pending_admin_requests'))
    {
        ?>
            <a href="/index.php/pending_request" class="btn btn-small btn-warning btn-block">
               Pending Administrator Request
            </a>
        <?
    }

?>


        </ul>
    </div>

        
<div class="span8">
<!--Body content-->
    

