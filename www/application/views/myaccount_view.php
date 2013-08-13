

<h2>Your Account</h2>


<div class="lead">Name: <?print $this->session->userdata('name');?></div>
<?
    if(isset($view_data['result']))
    {
        print $view_data['result'];
    }
?>
<a href="<?echo base_url();?>index.php/myaccount/changePassword">Change Password</a><br/><br/>
<a href="<?echo base_url();?>index.php/distribution_lists">Distribution Lists </a><br/><br/>
<?
    if($this->session->userdata('user_type')=='administrative')
    {

    }
    else if($this->session->userdata('user_type')=='organization' && $this->session->userdata('operator_id'))
    {
        ?><a href="<?echo base_url();?>index.php/administrator_logins/administrator">Site Administrator Logins </a><br/><br/><?
    }
    else if($this->session->userdata('user_type')=='division' || $this->session->userdata('user_type')=='national')
    {
        if($this->session->userdata('mcopco'))
        {
            ?><a href="<?echo base_url();?>index.php/administrator_logins/mcopco_administrator">Site Administrator Logins </a><br/><br/><?
        }
        else 
        {
            ?>
            <a href="<?echo base_url();?>index.php/administrator_logins/national_administrator">Site Administrator Logins </a><br/><br/>
            <a href="<?echo base_url();?>index.php/administrator_logins/mcopco_administrator">McOpCo Site Administrator Logins </a><br/><br/>   
            <?
        }
    }
    else if($this->session->userdata('user_type')=='region' || $this->session->userdata('user_type')=='coop')
    {
        ?><a href="<?echo base_url();?>index.php/administrator_logins/national_administrator">Site Administrator Logins </a><br/><br/><?
    }
         
?>
        
<?php  echo form_open('myaccount/changeEmail', array('class'=>'form-inline'));?>

    <div class="control-group">
        <label class="control-label" for="email">Email Address:</label>
        
            <?php echo form_input(array(
                        'name' => 'email',
                        'id' => 'email',
                        'value'=> $this->session->userdata('email')
                    ));
            ?>
  
    </div>
    <br/>
    
    <?php
        echo validation_errors("<p class='alert alert-error'>");
    ?>
    <div class="control-group">
        <div class="controls">
            <button type="submit" class="btn btn-primary">Update Account Information</button>
        </div>
    </div>
    
    </form>