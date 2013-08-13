<div class="container">
    <h1>LocalMark HQ Login</h1>
    <p class="lead">Welcome to LocalMark HQ, the your Service &amp; Support site.<br> For security purposes, this is a restricted area.</p>
    <p class="lead">Please log in below using the password you have been issued.</p>
    <?php  echo form_open('login/authorize', array('class'=>'form-horizontal'));
    
     if($this->session->userdata('fail'))
      {
            echo "<div class='alert alert-error'>The username and password you provided did not match. Please try again.</div>";
      }
    ?>
    <?php
    $tries = $this->db->query("SELECT count(id) as 'count' FROM `user_logins` WHERE `ip` = '{$this->session->userdata('ip_address')}' AND `timestamp` > DATE_SUB(now(), INTERVAL 5 MINUTE)");
    if (($tries->row()->count < 5))
        { 
    ?>
    <div class="control-group">
        <label class="control-label" for="username">Username:</label>
        <div class="controls">
            <?php echo form_input(array(
                        'name' => 'username',
                        'id' => 'username',
                        'placeholder' => 'Username'));
            echo '<em>'.anchor('login/forgot_username','I forgot my username','class="btn btn-mini btn-link"').'</em>';
            ?>
    </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'password',
                        'id' => 'password',
                        'placeholder' => 'Password'));
                echo '<em>'.anchor('login/forgot_password','I forgot my password','class="btn btn-mini btn-link"').'</em>';
                
            ?>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
    </div>
    <?php } 
     else 
         { 
         $this->session->unset_userdata('fail');
     ?>
    <div class="well"><p>You have exceeded the maximum number of login attempts. Please try again in 5-10 minutes.</p></div>
    <?php
         } 
    ?>
    </form>

</div>

	


