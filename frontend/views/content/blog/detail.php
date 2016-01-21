<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft"> <?php echo modules::run('profile/left_content',$user->id); ?>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="bloger m-b20 clearfix mt20">
                    <h2 class="w-color"><?php echo $blog->title;?></h2>
                    <div class="clear"></div>
                    <hr/>
                    <div class="topNews">
                        <h4 style="color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <?php if($blog->image){?>
                        	<img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" />
                        <?php }?>
                        <p><?php echo strip_tags($blog->content);?></p>
                        <a href="<?php echo base_url().index_page();?>index.html"><img src="<?php echo base_url();?>assets/frontend/img/btnGohome.png" /></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
</div>