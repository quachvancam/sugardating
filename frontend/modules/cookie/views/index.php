<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.cookie.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        if(!$.cookie("CookieInfo")){
            $('#CookieInfo').show();
        };
        $(".bt-close-cookie").click(function(event) {
            $.cookie("CookieInfo",true);
            $("#CookieInfo").hide();
        });
    }); 
</script>
<div class="CookieInfo" id="CookieInfo" style="display: none;">
    <div class="cookie-content">
        <div>
        <?php echo $cookie->short_content;?>
        </div>
        <a href="javascript:void(0);" class="bt-close-cookie">Luk</a> 
    </div> 
</div>