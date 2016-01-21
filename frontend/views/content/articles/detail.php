<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="conditions">
            <h2><?php echo $article->title;?></h2>
            <div class="clear">&nbsp;</div>
            <?php echo $article->short_content.$article->full_content;?>
            <?php if($article->category_id==7){?>
                <a href="<?php echo base_url().index_page();?>user/register.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGoToMember.png" /></a>
            <?php } else {?>
                <a href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
            <?php }?>
        </div>
    </div>
    <!--contentLeft--> 
    <?php echo modules::run('banner/banner/index'); ?> 
    <!--adsRight--> 
    
</div>
