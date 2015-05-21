<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <title></title>
    <link href="<?php echo base_url();?>css/hallpass/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen and (max-device-width: 480px)" href="<?php echo base_url();?>css/hallpass/mobile.css" />
	
    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.fancybox.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.0.1-p7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/bootstrap-datetimepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/jquery.fancybox.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/rome.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/bootstrap-theme.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/spinningwheel.css"/>
	<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/javascript.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.mousewheel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/spinningwheel-min.js"></script>
    
</head>
<body onload="$('#load').load('/index.php/staff');">
    <script type="text/javascript">
        var time = "";
        </script>
<div class="wrapper">
    <div style="width: 100%;" class="header_top">
        <div style="float: left; width: 300px; height: 80px; margin-top: 10px; font-family: Arial,Helvetica Neue,Helvetica,sans-serif;">
            <!-- Logo -->
            <div style="" class="logo_header"><img src="<?php echo base_url();?>images/hallpass/HallPass.png" style="width: 60px;"></div>
            <!-- Text -->
            <div style="float: right; margin-top: 0px; " class="text_header">
                <span style='font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; '>Hall Pass </span></div>
        </div>
        <div style="float: right; height: 80px; margin-top: 14px;">
            <p>Staff username: mt</p>
            <p>Password: pass111</p>
            <p>Staff Code: 1111</p>
        </div>
    </div>
