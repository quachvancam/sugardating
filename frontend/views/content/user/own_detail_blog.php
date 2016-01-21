<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix">
            <?php echo modules::run('own/own/left_content'); ?>
        </div>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="bloger m-b20 clearfix mt20">
                    <h2 class="w-color"><?php echo $blog->title;?></h2>
                    <div class="clear"></div>
                    <hr/>
                    <div class="topNews">
                        <h4 style="margin-bottom:10px; color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <?php if($blog->image){?>
                        <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" alt=""/>
                        <?php }?>
                        <?php echo $blog->content;?>
                    </div>
                    <div style="padding: 20px 0;">
                        <a href="javascript:void(0);" onclick="javascript:history.back();">
                            <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
</div>