<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Sugardating.dk</title>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery-1.8.3.min.js"></script>
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.ico" />
<link rel="shortcut icon" type="img/x-icon" href="<?php echo base_url(); ?>assets/frontend/icon/icon.png" />
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/frontend/css/reset.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/styles.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/font/stylesheet.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/css/reveal.css"/>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Source+Sans+Pro:300:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 
</script>
</head>
<body>
<div class="log-container">
    <div class="log-cnt">
        <a class="logo" href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url(); ?>assets/frontend/img/logo-log.png" alt="" /></a>
        <div><a href="<?php echo base_url().index_page();?>user/register.html">Opret login </a></div>
        <div class="form-login">
            <?php 
            $email = $this->input->cookie('email');
            $password = $this->input->cookie('password');
            ?>
            <?php echo form_open('user/logins')?>
                <fieldset>
                    <span style="color:#F00; font-size:15px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>
                    <label>Indtast din e-mail</label>
                    <input class="txt-login" type="text" name="email" value="<?php echo $email;?>" />
                    <label>Indtast din kode</label>
                    <input class="txt-login" type="password" name="password" value="<?php echo $password;?>" />
                    <div class="f-l" style="margin-top: 10px; margin-bottom: 5px;">
                      <input type="checkbox" name="remember" value="1"/> <span>Husk mig!</span>
                    </div>
                    <div class="clearfix"></div>
                    <input type="submit" class="btn-login" style="border:none; cursor:pointer;" />
                </fieldset>
                <input type="hidden" name="return" value="/user/login/" />
            </form>
            <a class="gemt-pass" href="<?php echo base_url().index_page();?>user/forgotpassword.html">Glemt dit login?</a>
        </div>
    </div>
    <div id="footer" class="log-footer">
        <div id="w-footer" style="background: none;">
            <p>Copyright © 2014. All Rights Reserved.</p>
         </div>
    </div>
</div>
<script type="text/javascript">
    window.fbAsyncInit = function() {
        //Initiallize the facebook using the facebook javascript sdk
        FB.init({ 
            appId:'<?php echo $this->config->item('appID'); ?>', // App ID 
            cookie:true, // enable cookies to allow the server to access the session
            status:true, // check login status
            xfbml:true, // parse XFBML
            oauth : true //enable Oauth 
        });
    };
    //Read the baseurl from the config.php file
    (function(d){
           var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
           if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           ref.parentNode.insertBefore(js, ref);
         }(document));
    //Onclick for fb login
    $('#facebook').click(function(e) {
        FB.login(function(response) {
            if(response.authResponse) {
                parent.location ='<?php echo base_url().index_page(); ?>user/fblogin'; //redirect uri after closing the facebook popup
            }
        },
        {scope: 'email, read_stream, publish_stream, user_birthday, user_location, user_work_history, user_hometown, user_photos'}); //permissions for facebook
    });
</script>
</body>
</html>