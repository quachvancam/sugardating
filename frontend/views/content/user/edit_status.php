<?php 
$own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$img = '';
if($user->avatar){
   $avatar = $user->avatar;
} else {
   $avatar = 'noavatar'.$user->gender.'.jpg';
}
$img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=200&h=280" alt=""/>';
?>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil">
            <p class="id-profil"><?php echo $user->id;?> - <?php echo $own[$user->own]?></p>
            <div class="mb10">
                <a href="<?php echo base_url().index_page(); ?>user/photo.html" class="f-l" style="color:#999;">Mine billeder</a>
                <div class="clearfix"></div>
            </div>
            <span class="img-profil larg-profil">
                <?php echo $img;?>
            </span>
            <div class="clearfix"></div>
            <ul class="list-func">
                <li><a href="<?php echo base_url().index_page(); ?>user/owner.html">Min Profil</a></li>
                <?php if($user->active){?>
                <li class="deactive"><a href="javascript:void(0);" id="deactive">Deaktivér min profil</a></li>
                <?php } else {?>
                <li><a href="javascript:void(0);" id="active">Aktiver min Profil</a></li>
                <?php }?>
            </ul>
        </div>
        <div class="info-profil">
            <h2 style="font-size:26px; min-height: 58px;">Skriv din Chat Mig tekst her og vis du er klar nu!</h2>
            <div class="clear"></div>
            <?php echo form_open('user/save_status', array('method'=>'post', 'class'=>'frm-profil', 'enctype'=>'multipart/form-data', 'id'=>'editForm'));?>
                <fieldset>
                    <textarea class="input-profil w510" name="status"><?php echo $user->status;?></textarea>
                    <input type="submit" value="" class="btn-opretchatmig" style="border:none; cursor:pointer;" />
                    <a href="<?php echo base_url().index_page(); ?>user/owner.html" class="btn-canel1">Annullér</a>
                </fieldset>
            </form>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clearfix"></div>
</div>