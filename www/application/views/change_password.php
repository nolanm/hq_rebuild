 
    <h2>Change Password</h2>

     <div class="well">
    <ul>
            <li>Must contain a minimum of 7 alpha-numeric characters.</li>
            <li>Contain at least one (1) number AND letter.</li>
            <li>Not be longer than 15 characters.</li>
            <li>Cannot contain, or be the same as, your username.</li>
            <li>Cannot be the same as one of your previous 10 passwords. (Don't worry, we'll keep track of them for you!)</li>
    </ul>
    </div>
    <?
    if(isset($view_data['result']))
    {
        print $view_data['result'];
    }
    ?>
    <?php  echo form_open('myaccount/update_password', array('class'=>'form-horizontal'));?>

     <div class="control-group">
        <label class="control-label" for="oldpassword">Old Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'oldpassword',
                        'id' => 'oldpassword'));
            ?>
    </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="newpassword1">New Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'newpassword1',
                        'id' => 'newpassword1'));
            ?>
    </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="newpassword">Confirmed Password:</label>
        <div class="controls">
            <?php echo form_password(array(
                        'name' => 'newpassword2',
                        'id' => 'newpassword2'));
            ?>
        </div>
    </div>
    <?php
        echo validation_errors("<p class='alert alert-error'>");
    ?>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Save Password</button>
            
        </div>
    </div>
    
    </form>

