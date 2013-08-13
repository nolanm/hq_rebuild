<div class="container">
    
    
    <h1>Forget Your Username?</h1>

    <p class="lead">Enter the email address associated with your account. We will email your username to you.</p>
   <?php
        
        if($this->session->userdata('forgetUsernameValidation'))
        {
                if($this->session->userdata('user_email'))
                {
                    echo"<div class= 'alert alert-success'>";
                    echo "<p>Your username(s) have been emailed to you.";
                    echo "Check your email, then ".anchor('login/index','login here &raquo;')."</p></div>";
                }
                else
                {
                    echo'<div class= "alert alert-error">Sorry, there are no accounts found with that username.'. 
                        ' Please try a different email address or call technical support at 1-866-407-9472.</div>';
                }
        }
        echo validation_errors("<p class='alert alert-error'>");
        $this->session->unset_userdata('forgetUsernameValidation');
        $this->session->unset_userdata('$user_email');
    ?>
    <?php  echo form_open('login/forgot_username', array('class'=>'form-horizontal'));?>

    <div class="control-group">
        <label class="control-label" for="email">Email:</label>
        <div class="controls">
            <?php echo form_input(array(
                        'name' => 'email',
                        'id' => 'email'));
            ?>
    </div>
    </div>
    
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Retrieve my username!</button>
        </div>
    </div>
    
    </form>

</div>
