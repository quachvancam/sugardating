<script type="text/javascript">
    $(document).ready(function() {
        $('.infoTab:not(:first)').hide();
        $('h3:first').addClass('active');
        $('h3').click(function() {
            $('.active').removeClass('active');
            $('.infoTab').slideUp('normal');
            if($(this).next('.infoTab').is(':hidden') == true) {
            $(this).addClass('active');
            $(this).next('.infoTab').slideDown('normal');
            }
        });
        $('h3').hover(function(){//over
            $(this).addClass('on');
        },function() {//out
            $(this).removeClass('on');
        });
    });
</script>
<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
        <ul class="breakcum">
            <li><a href="<?php echo base_url(); ?>">Start</a></li>
            <li><a href="<?php echo base_url().index_page(); ?>faq.html">FAQ</a></li>
        </ul>
        <div class="faq">
            <h2><a href="<?php echo base_url().index_page(); ?>faq.html"><?php echo $title;?></a></h2>
            <div class="clear"></div>
            <div class="top-info"><?php echo $info1;?></div>
            <div class="con-faq"><?php echo $info2;?></div>
            <div class="faqContent clearfix">
            <?php if($info){ $i = 1; foreach($info as $rows){?>
              <h3 <?php if($i%2==0){echo 'class="redLight"';} else {echo 'class="redDark"';}?> ><?php echo $rows->title;?></h3>
              <div class="infoTab">
                    <?php echo $rows->full_content;?>
              </div>
            <?php $i++; }}?>
            </div><!--.faqContent-->
            <div class="findAnwser m-t20 m-b10">
              <span>Fandt du ikke svar på dit spørgsmål?</span>
              <a class="bntHelphere" href="<?php echo base_url().index_page(); ?>help.html">få hjælp her</a>
            </div><!--.findAnwser-->
            <a href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
        </div><!--.faq-->
    </div><!--contentLeft-->
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery("#faq_active").addClass('active');
	});
</script>