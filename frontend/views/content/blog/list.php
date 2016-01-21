<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <?php echo modules::run('profile/left_content',$user->id); ?>
        <div class="infoProfil clearfix">
            <div class="profilowner">
                <div class="bloger m-b20 clearfix mt20">
                    <h2 class="w-color">Jeg sukkerblogger</h2>
                    <div class="clear"></div>
                    <hr/>
                    <?php if($blogs){ foreach($blogs as $blog){
                        $detail_link = base_url().index_page().'blog/detail/'.$blog->id.'/'.$blog->alias.'.html';
                    ?>
                    <div class="topNews bor-b mt20">
                        <h4 style="color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <a href="<?php echo $detail_link;?>" style="font-size:14px; margin-bottom:5px; font-weight:bold; display:block;"><?php echo $blog->title;?></a>
                        <div class="clear"></div>
                        <?php if($blog->image){?>
                            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" />
                        <?php }?>
                        <p><?php echo implode(' ', array_slice(explode(' ', strip_tags($blog->content)), 0, 50)).'...';?></p>
                    </div>
                    <?php }}else{?>
                        <div>
                            ... men jeg har endnu ikke skrevet blog indlæg på min profil
                        </div>
                        <div style="padding: 20px 0;">
                            <a href="javascript:void(0);" onclick="javascript:history.back();">
                                <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" />
                            </a>
                        </div>
                        
                    <?php }?>
                </div>
                <?php echo $all_link;?>
            </div>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
</div>