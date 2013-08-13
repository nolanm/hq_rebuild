
<div class="container">
    
    
    <h1>LocalMark User Password</h1>

    <p>Your LocalMark.com password has expired. For security purposes, please create a new one in the fields below.</p>

    <p>For your protection, your password must follow these guidelines:</p>

    <p class="text-info">
    <ul>
            <li>Must contain a minimum of 7 alpha-numeric characters.</li>
            <li>Contain at least one (1) number AND letter.</li>
            <li>Not be longer than 15 characters.</li>
            <li>Cannot contain, or be the same as, your username.</li>
            <li>Cannot be the same as one of your previous 10 passwords. (Don't worry, we'll keep track of them for you!)</li>
    </ul>
    </p>

    
    <?php  echo form_open('login/newPassword', array('class'=>'form-horizontal'));?>

    <div class="control-group">
        <label class="control-label" for="password1">New Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'password1',
                        'id' => 'password1'));
            ?>
    </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="password">Confirmed Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'password2',
                        'id' => 'password2'));
            ?>
        </div>
    </div>
    <?php
        echo validation_errors("<p class='alert alert-error'>");
    ?>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save Password</button>
            <?php echo anchor('login/logout','No, thanks. Log me out.','class="btn btn-link"'); ?>
        </div>
    </div>
    
    </form>

</div>
