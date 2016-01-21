<!DOCTYPE HTML>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Administrator | SUGAR DATING</title>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
    WebFontConfig = {google: { families: [ 'Source+Sans+Pro:300:latin' ]}};
    function() {
        var wf = document.createElement('script');
        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
          '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
        wf.type = 'text/javascript';
        wf.async = 'true';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(wf, s);
    } </script>
    <link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/common/icon.ico" />
    <link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/common/icon.png" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/common/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/common/css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/common/font/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/common/css/reveal.css"/>
    <!--[if IE ]>
    <link href="/* custom css file */" rel="stylesheet" type="text/css" media="screen" />
    <![endif]-->
    <link rel="stylesheet" type="text/css" media="screen and (min-device-width: 481px)" href="/* custom css file */" />
    <link rel="stylesheet" type="text/css" media="only screen and (max-device-width:480px)" href="/* mobile css files */" />
    <!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="Specific ie" /><![endif]-->
    </head>
    <body>
        <div class="log-container">
            <div class="log-head">
                <ul>
                    <li><a>Administrator</a></li>
                </ul>
            </div>
            <div class="log-cnt"> <div class="logo"><img src="<?php echo base_url(); ?>assets/frontend/img/logo-log.png" alt="" /></div>
                <div class="form-login">
                    <form action="<?php echo base_url().index_page()."admin/login/"; ?>" method="post">
                        <fieldset>
                            <label>Indtast dit e-mail</label>
                            <input class="txt-login" type="text" name="email" />
                            <label>Indtast din kode</label>
                            <input class="txt-login" type="password" name="password" />
                            <div class="clearfix"></div>
                            <input type="submit" name="submit" value="submit" class="btn-login" style="border:none; cursor:pointer;" />
                        </fieldset>
                    </form>
                    <span style="color:#F00; font-size:15px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>
                 </div>
			</div>
            <div id="footer" class="log-footer">
                <div id="w-footer">
                    <p>Copyright © 2014. All Rights Reserved.</p>
                </div>
            <!--#w-footer--> 
            </div>
                  <!--#footer--> 
             </div>
        <!--/ page content -->
        </div>
	<noscript>Warning! JavaScript must be enabled for proper operation of the Administrator.</noscript>
	</body>
</html>