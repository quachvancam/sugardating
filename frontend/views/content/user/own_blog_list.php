<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix">
        <?php echo modules::run('own/own/left_content'); ?>
        </div> 
        <div class="infoProfil clearfix">
            <span style="color:#F00; font-size:15px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>
            <div class="profilowner">
                <div class="bloger m-b20 clearfix mt20">
                    <h2 class="w-color">Jeg sukkerblogger</h2>
                    <div class="clear"></div>
                    <hr style="margin-bottom:10px;"/>
                    <?php if($blogs){ foreach($blogs as $blog){
                        $del_link = base_url().index_page().'user/deleteblog/'.$blog->id.'.html';
                        $edit_link = base_url().index_page().'user/editblog/'.$blog->id.'.html';
                        $detail_link = base_url().index_page().'user/blogdetail/'.$blog->id.'/'.$blog->alias.'.html';
                    ?>
                    <a href="<?php echo $del_link;?>"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/btn-del-foto.jpg" /></a>
                    <a href="<?php echo $edit_link;?>"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/btn-edit.jpg" /></a>
                    <a href="<?php echo base_url().index_page(); ?>user/addblog.html"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/btn-add1.jpg" /></a>
                    <div class="clear"></div>
                    <div class="topNews bor-b" style="margin-top:10px;">
                        <h4 style="color:#ffffff;"><?php echo date('H:i d/m/Y', $blog->time);?></h4>
                        <a href="<?php echo $detail_link;?>" style="font-size:14px; margin-bottom:5px; font-weight:bold; margin-left:20px; display:block;"><?php echo $blog->title;?></a>
                        <div class="clear"></div>
                        <div class="ml20">
                        <?php if($blog->image){?>
                            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_blog_path').$blog->image.'&q=100&w=209'; ?>" alt=""/>
                        <?php }?>
                            <?php echo implode(' ', array_slice(explode(' ', $blog->content), 0, 50)).'...';?>
                        </div>
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