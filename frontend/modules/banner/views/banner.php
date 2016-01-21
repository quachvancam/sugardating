<div class="adsRight">
    <?php if($banners){foreach($banners as $banner){if($banner->image){?>
    <div class="adsBlock"><a href="<?php echo $banner->link_path?>" target="_blank">
        <img alt="" src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/banner/'.$banner->image.'&w=160&h=106&q=80'; ?>"/>
    </a> </div>
    <?php }}}?>
</div>