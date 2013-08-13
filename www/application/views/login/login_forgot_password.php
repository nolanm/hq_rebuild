<div class="container">
    
    
    <h1>Forget Your Password?</h1>

    <p class="lead">Enter the username associated with your account. We will email a temporary password to you and you will be required to set a new password once you successfully login.</p>
    <?php
         if($this->session->userdata('forgetPasswordValidation'))
        {
                if($this->session->userdata('valid_username'))
                {
                    echo"<div class= 'alert alert-success'>";
                    echo "<p>Your temporary password has been emailed to you.";
                    echo "Check your email, then ".anchor('login/index','login here &raquo;')."</p></div>";
                }
                else
                {
                    echo'<div class= "alert alert-error">Sorry, there is no account found with that username.'. 
                        ' Find your username '.anchor('login/forgot_username','here').' or call technical support at 1-866-407-9472.</div>';
                }
        }
        echo validation_errors("<p class='alert alert-error'>");
        $this->session->unset_userdata('forgetPasswordValidation');
        $this->session->unset_userdata('valid_username');
    ?>
    <?php  echo form_open('login/forgot_password', array('class'=>'form-horizontal'));?>

    <div class="control-group">
        <label class="control-label" for="fp_username">Username:</label>
        <div class="controls">
            <?php echo form_input(array(
                        'name' => 'fp_username',
                        'id' => 'fp_username'));
            ?>
    </div>
    </div>
   
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Retrieve my password!</button>
        </div>
    </div>
    
    </form>

</div>
