<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <META http-equiv="Default-Style" content="compact">
    <title></title>
    
	
    <!-- Add jQuery library -->
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery-2.1.3.min.js"></script>
    <script src="<?php echo base_url();?>js/hallpass/bootstrap.min.js"></script>
    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.fancybox.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/moment.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.countdown.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/additional-methods.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/bootstrap-datetimepicker.js"></script>
    
	<script type="text/javascript" src="<?php echo base_url();?>js/hallpass/javascript.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/jquery.mousewheel.min.js"></script>
    <!--<script type="text/javascript" src="<?php echo base_url();?>js/spinningwheel-min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/spinningwheel.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/hallpass/moment.min.js"></script>
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/jquery.fancybox.css" media="screen" />
	<link rel="stylesheet" type="text/css" rel="alternate stylesheet" href="<?php echo base_url();?>css/hallpass/bootstrap.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/rome.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/hallpass/bootstrap-theme.css"/>
    <link rel="stylesheet" title="compact" type="text/css" href="<?php echo base_url();?>css/hallpass/spinningwheel.css"/>
    
    <link href="<?php echo base_url();?>css/hallpass/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen and (max-device-width: 550px)" href="<?php echo base_url();?>css/hallpass/mobile.css" />
    
</head>
<body>
    <script type="text/javascript">
        var time = "";
        </script>
<div class="wrapper">
    <div style="width: 100%;" class="header_top">
        <div class="header_inner_top" style="">
            <!-- Logo -->
            <div style="" class="logo_header"><img src="<?php echo base_url();?>images/hallpass/HallPass.png" style="width: 60px;"></div>
            <!-- Text -->
            <div style="float: right; margin-top: 0px; " class="text_header">
                <span style='font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; '>Hall Pass </span></div>
        </div>
        <div style="float: right; height: 80px; margin-top: 14px;">
            <?php
            if($login == "Yes")
            {
            ?>
            <button type='button' style="float: right;" onclick="location.href='logout'" class='btn btn-lg btn-default' id='login'>Logout</button>
            <?php
            }
            else {
                ?>
            <!--<button type='button' style="float: right;" onclick="location.href='student_login'" class='btn btn-lg btn-default' id='login'>Login</button>-->
            <?php
            }
            ?>
        </div>
    </div>
