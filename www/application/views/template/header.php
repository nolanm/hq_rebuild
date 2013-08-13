
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
	"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>LocalMark HQ</title>
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.css"
              type="text/css" media="screen" charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?php echo base_url();?>css/bootstrap-responsive.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-latest.js"></script>
        <script src="<?php echo base_url();?>js/bootstrap/bootstrap.min.js"></script>
        <script type='text/javascript'>
            $(document).ready(function () {
            if ($("[rel=tooltip]").length) {
            $("[rel=tooltip]").tooltip();
            }
          });
         </script>
       
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar" >
<div id="wrap" >
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">LocalMark HQ</a>
            <div class="nav-collapse collapse">
            <ul class="nav pull-right">
                
                <li><a href="<?php echo base_url();?>index.php/myaccount/">Your Account</a></li>
                <li><a href="<?php echo base_url();?>index.php/root/logout/">Logout</a></li>
            </ul>
        </div>
        </div>
    </div>
    </div>
   


  
  
    
    <?php //print_r($this->session->all_userdata()); ?>