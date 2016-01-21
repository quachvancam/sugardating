<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.js?v=2.1.3"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/frontend/fancybox/jquery.fancybox.css?v=2.1.2" media="screen" />
<script type="text/javascript">
$(document).ready(function() {
    /*
    *  Simple image gallery. Uses default settings
    */
    $('.fancybox').fancybox();
    
    $('.fancybox-buttons').fancybox({
        openEffect  : 'none',
        closeEffect : 'none',
        prevEffect : 'none',
        nextEffect : 'none',
        closeBtn  : true,
        helpers : {
            title : {
                type : 'inside'
            },
            buttons : {}
        },
        afterLoad : function() {
            this.title = 'Billede ' + (this.index + 1) + ' af ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
    });
});
function confirm_detele(id){
    var del = confirm('Er du sikker på vil slette dette billede?');
    if(del == true){
        location.href = '<?php echo base_url().index_page(); ?>user/own_delete_photo/'+id+'.html';
    }
}
</script>
<style type="text/css">
.fancybox-custom .fancybox-skin {
    box-shadow: 0 0 50px #222;
}
</style>
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix"> <?php echo modules::run('own/own/left_content'); ?> </div>
        <div class="infoProfil clearfix">
            <div class="photoGallery">
                <h2><?php echo getUser()->name;?>’s Billeder</h2>
                <div class="clear"></div>
                <div id="w-mainGallery">
                    <?php if($photos){?>
                    <ul class="smallImg">
                        <?php foreach($photos as $photo){?>
                        <li> 
                            <a href="javascript:confirm_detele(<?php echo $photo->id;?>)"><img src="<?php echo base_url(); ?>/assets/frontend/img/ico-del1.png" class="ckb-del" /></a>
                            <a href="<?php echo base_url().get_config_value('upload_gallery_path').$photo->image; ?>" data-fancybox-group="button" class="fancybox-buttons"> 
                            <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_gallery_path').$photo->image.'&q=100&w=99&h=99'; ?>" alt=""/></a>
                        </li>
                        <?php }?>
                    </ul>
                    <?php }else{if(member_type()==1){?>
                        <div>
                            Opgradér til Guld medlem og læg ubegrænset antal billeder på din profil. Vis hvorfor du er den helt rigtige Sugardate.
                        </div>
                        <div style="padding: 20px 0;">
                            <a href="<?php echo base_url().index_page(); ?>user/upgrade.html" class="btn-upgrade-01">Opgradér</a>
                        </div>
                    <?php }else{?>
                        <p>Du har endnu ikke tilføjet billeder. Klik her og vis at du er den rigtige sugardate</p>
                        <div class="mt20"><a class="addphoto" href="<?php echo base_url().index_page();?>user/addphoto.html">Tilføj billeder</a></div>
                        
                    <?php }}?>
                </div>
                <!--#w-mainGallery--> 
            </div>
            <?php echo $all_link;?>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
</div>