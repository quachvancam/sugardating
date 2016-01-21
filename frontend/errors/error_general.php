<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Le Duc Cuong" />
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'/>
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.ico" />
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend//icon/icon.png" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reveal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/font/stylesheet.css"/>
<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'/>
<title>Sugardating - Error!</title>
</head>
<body>
<div id="page">
<div class="lineTop"></div>
  <div id="w-page" style="margin: 64px auto 0">
  	<div id="w-header">
        <!--Header Menu-->
        <div id="wraNav" class="clearfix" style="margin-top: 60px;">
          <div id="logo"><a href="<?php echo base_url().index_page();?>index.html">Sugardating</a></div>
          <ul id="mainNav">
            <li id="srart_active"><a href="<?php echo base_url().index_page();?>index.html">Start</a></li>
            <li id="minprofil_active"><a href="<?php echo base_url().index_page();?>user/owner.html">Min Profil</a></li>
            <li id="sugarshop_active"><a href="<?php echo base_url().index_page();?>sugarshop/index.html">Sugarshop</a></li>
            <li id="faq_active"><a href="<?php echo base_url().index_page();?>faq.html">FAQ</a></li>
            <li id="help_active"><a href="<?php echo base_url().index_page();?>help.html">Hjælp</a></li>
          </ul>
        </div>
        <!--#wraNav-->
    </div>
    <div id="banner" style="height: 60px;"></div>
    <div id="main">
      <div class="indexPage">
        <div id="sugarDates" class="clearfix bgContent m-t-3">
        <div class="contentLeft">
        <div style="min-height: 400px; font-size: 25px;">
            <h1><?php echo $heading; ?></h1>
            <?php echo $message; ?> <a href="<?php echo base_url().index_page();?>index.html"><img style="vertical-align: middle;" src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  <!--#w-page-->
  <div class="clear"></div>
  <!--Footer-->
  <div id="footer">
    <div id="w-footer">
        <ul class="clearfix">
            <li><a href="<?php echo base_url().index_page(); ?>index.html">Start</a></li>
            <li><a href="<?php echo base_url().index_page();?>user/owner.html">Min Profil</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Sugarshop</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>faq.html"><span>FAQ</span></a></li>
            <li><a href="<?php echo base_url().index_page(); ?>help.html">Hjælp</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>sikkerhed.html"><span>Sikkerhed</span></a></li>
            <li><a href="<?php echo base_url().index_page(); ?>medlemsbetingelser.html">Vilkår og handelsbetingelser</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>medlemskab.html">Medlemskab</a></li>    
            <li class="end"><a href="<?php echo base_url().index_page(); ?>kontakt.html">Kontakt</a></li>
        </ul>
        <p style="margin-left: -60px;">Copyright © 2014. All Rights Reserved. <!--<img style="vertical-align:middle; padding-left:10px;" src="<?php echo base_url(); ?>assets/frontend/img/dankort.png" alt=""/>--></p>
    </div>
    </div>
  <!--#footer-->
</div>
<!--#page-->
</body>
</html>