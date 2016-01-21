<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title;?> | Sugar dating administrator</title>
<link rel="shortcut icon" type="img/x-icon" href="icon.ico" />
<link rel="shortcut icon" type="img/x-icon" href="icon.png" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/reset.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/css/reveal.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/backend/font/stylesheet.css"/>
<link href='http://fonts.googleapis.com/css?family=Marck+Script' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/js/jquery-1.8.3.min.js"></script>
<script type='text/javascript' src='<?php echo base_url(); ?>assets/backend/js/jquery.validate.pack.js'></script>

<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Marck+Script::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
</head>

<body>
<?php
if ($this->session->userdata('adminStatus') == FALSE){
	redirect(base_url().index_page().'admin/');
}
?>
<div id="page2">
  <div class="admin-page">
  	<div id="w-header2">
    <div id="wraNav" class="clearfix">
      <div id="logo"><a href="<?php echo base_url().index_page(); ?>admin">sugardateme</a> </div>
    </div>
    <!--#wraNav-->
    </div><!--#w-header-->
    <div id="main" class="clearfix">
      <div class="adminPage m-t20">
       <div class="clearfix"></div>
 			<?php require 'content/header/menu.php';?>
        <!--#tabsholder-->
        <div class="clear"></div>
        
        <?php require_once ('content/'.$content.'.php'); ?>

      </div><!--.adminPage-->
    </div>
    <!--#main-->
  </div>
  <!--#w-page-->
  <div class="clear"></div>
  <div id="footer" class="n-bg bor-t1">
    <div id="w-footer">
      <p>Copyright © 2014. All Rights Reserved.</p>
    </div>
    <!--#w-footer-->
  </div>
  <!--#footer-->
</div>
<!--#page-->
</body>
</html>