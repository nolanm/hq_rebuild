<?php

?>

<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
       <a class="brand" href="/">LocalMark HQ</a>
        <div class="nav-collapse collapse navbar-inverse-collapse">
          <ul class="nav">
          <?
          if(strcmp($this->session->userdata('user_type'), 'organization') == 0)
          {

              if($this->session->userdata('restaurant_settings') 
                          || $this->session->userdata('hours') 
                          || $this->session->userdata('services')) 
                      {
                      // //check to see if user has permission to any link under my restaurant button
                      ?>
                          <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Restaurants <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <? if($this->session->userdata('restaurant_settings')) { ?>
                          <li>
                              <a href="/index.php/restaurants/restaurant_settings/" >Settings</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('hours')) { ?>
                          <li>
                              <a href="/" >Hours</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('services')) { ?>
                          <li>
                              <a href="/index.php/restaurants/services/" >Services</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('qr_codes')) { ?>
                          <li>
                              <a href="/" >QR Codes</a>
                          </li>
                          <? } ?>
                          </ul>
                        </li>



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
                      <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Local Store Marketing <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                         <? if($this->session->userdata('donation_request')) { ?>
                          <li>
                              <a href="/" >Donation Request</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('grand_opening')) { ?>
                          <li>
                              <a href="/" >Grand Opening Template</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('calendar_of_events')) { ?>
                          <li>
                              <a href="/" >Calendar of Events</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('restaurant_tours')) { ?>
                          <li>
                              <a href="/" >Restaurant Tours</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('orange_bowl')) { ?>
                          <li>
                              <a href="/" >Orange Bowl</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('power_bowl')) { ?>
                          <li>
                              <a href="/" >Power Bowl</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('birthday_party_to_go')) { ?>
                          <li>
                              <a href="/" >Birthday Party To Go</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('birthday_party_reservation')) { ?>
                          <li>
                              <a href="/" >Birthday Party Reservation</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('brand_trust')) { ?>
                          <li>
                              <a href="/" >Brand Trust</a>
                          </li>
                          <? } ?>
                      </ul>
                    </li>

                  <? } //end of my lsm button check ?>
                  <? if($this->session->userdata('jobs') 
                          || $this->session->userdata('benefits') 
                          || $this->session->userdata('application_settings') 
                          || $this->session->userdata('ray_kroc')
                          || $this->session->userdata('hiring_day')) 
                      {
                      // //check to see if user has permission to any link under my restaurant button
                      ?>
                      <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Human Resources <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <? if($this->session->userdata('jobs')) { ?>
                          <li>
                              <a href="/index.php/hr/jobs/" >Jobs</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('benefits')) { ?>
                          <li>
                              <a href="/index.php/hr/benefits/" >Benefits</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('application_settings')) { ?>
                          <li>
                              <a href="/index.php/hr/application_settings/" >Application Settings</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('ray_kroc')) { ?>
                          <li>
                              <a href="/" >Employee Awards</a>
                          </li>
                          <? } ?>
                          <? if($this->session->userdata('hiring_day')) { ?>
                          <li>
                              <a href="/" >Hiring Day Template</a>
                          </li>
                          <? } ?>
                      </ul>
                    </li>

                  <? } //end of my HR button check ?>
                  <?if($this->session->userdata('custom_content')) { ?>
                      <li><a href="#">Custom Content</a></li>  
                  <? } ?>

                      <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                          <li><a href="#">Statistics</a></li>
                          <li><a href="#">Support</a></li>
                          <li><a href="#">Suggestion Box</a></li>
                          <li><a href="#">Order P.O.P.</a></li>
                      </ul>
                    </li>
                  
          <? 
          }
          ?>

          </ul>
          
          <ul class="nav pull-right">
              <li><a href="<?php echo base_url();?>index.php/myaccount/">Your Account</a></li>
              <li><a href="<?php echo base_url();?>index.php/root/logout/">Logout</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div>
    </div><!-- /navbar-inner -->
  </div><!-- /navbar -->
<div class="container" >
   <div class="row" id="background">
        <div class="span10 offset1">
<?

?>
