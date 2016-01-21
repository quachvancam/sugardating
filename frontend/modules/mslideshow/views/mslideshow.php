<script type="text/javascript">
jQuery(document).ready( function(){
    jQuery("#slideintro").carouFredSel({
        circular: true,
        infinite: true,
        auto    : true,
        pagination  : "#block1_pag",
        scroll      :
        {
            duration    :1200,
            fx          : "crossfade"
        },
        items       :
        {
            visible     : 1,
            width       : 755,
            height      : 384
        }
    });
});
</script>
<div id="slideintro">
    <?php if($slideshows){ foreach($slideshows as $slideshow){
    if($slideshow->image){
    $link = $slideshow->link_path?$slideshow->link_path:'javascript:void(0);';
    ?>
    <div class="slide">
    <a href="<?php echo $link;?>">
        <img alt="" src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().'upload/slideshow/'.$slideshow->image.'&q=100&w=755&h=384'; ?>" />
    </a>
    </div>
    <?php }}}?>
</div>
<div class="clearfix"></div>
<div class="pagination" id="block1_pag"></div>