<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Le Cuong" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reset.css"/>
    <link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.ico" />
    <link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.png" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reveal.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/font/stylesheet.css"/>
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.8.3.min.js"></script>
	<title><?php echo $title;?></title>
    
    <style>
    .printdeal{border: 1px solid #575151; font-size:14px;}
    .border-right{border-right: 1px solid #575151;}
    .printdeal span {
        display: block;
        position: absolute;
        right: 10px;
        top: 10px;
    }
    .print a{margin: 0; padding:5px 20px;width: 50px; height: 25px; background: #530a0b; border-radius: 5px; color: #ffffff;}
    
    </style>
    
</head>
<body>
<div style="margin:0 auto;width:  800px;">
    <div style="font-size: 34px;">Mine deals</div>
    
    <div class="printdeal" style="margin:0; padding:0;">
        <div class="border-right" style="margin: 0; padding: 0; position: relative; width: 221px; height:120px; float:left;">
            <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image; ?>&h=120&w=220&q=100" />
            <span><img src="<?php echo base_url(); ?>upload/deal_category/<?php echo $deals->red_icon; ?>" alt=""/></span>
        </div>
        <div class="border-right" style="margin: 0; padding: 0; width: 150px; height:120px; text-align: center; float:left;">
            <p style="padding:5px; font-size: 16px;font-weight: bold;"><?php echo $deals->name;?></p>
        </div>
        <div class="border-right" style="margin: 0; padding: 0 5px; width: 200px; height:120px;float:left;">
            <?php echo $deals->title;?>
        </div>
        <div style="margin: 0; padding: 0 5px; width: 200px; height:120px;float:left; text-align: center;">
            Værdikode: <br /><p style="font-weight: bold;"><?php echo $deals->codes;?></p>
        </div>
        
        <div style="clear: both;"></div>
    </div>
    
    <div style="margin:0; padding: 20px 0; float: right; text-align: right;">
        <a style="font-size: 34px; color: #000000;" href="<?php echo base_url(); ?>">SUGARDATING.DK</a>
    </div>
    <div style="clear: both;"></div>
    <div class="print">
        <a onclick="window.print();" href="javascript:void(0);">Udskriv</a>
    </div>
    
</div>
</body>
</html>