<script>
jQuery(document).ready( function(){
    var min_old<?php echo $id;?> = null;
    var max_old<?php echo $id;?> = null;
    var min_height<?php echo $id;?> = null;
    var max_height<?php echo $id;?> = null;
    var min_weight<?php echo $id;?> = null;
    var max_weight<?php echo $id;?> = null;
    var min_code<?php echo $id;?> = null;
    var max_code<?php echo $id;?> = null;
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url().index_page();?>profiles/ajax_get_sugar.html",
        data: { id: <?php echo $id;?>, page: 1, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', functionName: '<?php echo $function;?>', min_old: min_old<?php echo $id;?>, max_old: max_old<?php echo $id;?>, min_height: min_height<?php echo $id;?>, max_height: max_height<?php echo $id;?>, min_weight: min_weight<?php echo $id;?>, max_weight: max_weight<?php echo $id;?>, min_code: min_code<?php echo $id;?>, max_code: max_code<?php echo $id;?>}
    }).done(function( htmlResult ) {
        jQuery("#<?php echo $content;?>").html(htmlResult);
    })
});
</script>
<script>
jQuery(document).ready( function(){
    <?php echo $function;?> = function(pageNum){
        var min_old<?php echo $id;?> = jQuery('#min_old<?php echo $id;?>').val();
        var max_old<?php echo $id;?> = jQuery('#max_old<?php echo $id;?>').val();
        var min_height<?php echo $id;?> = jQuery('#min_height<?php echo $id;?>').val();
        var max_height<?php echo $id;?> = jQuery('#max_height<?php echo $id;?>').val();
        var min_weight<?php echo $id;?> = jQuery('#min_weight<?php echo $id;?>').val();
        var max_weight<?php echo $id;?> = jQuery('#max_weight<?php echo $id;?>').val();
        var min_code<?php echo $id;?> = jQuery('#min_code<?php echo $id;?>').val();
        var max_code<?php echo $id;?> = jQuery('#max_code<?php echo $id;?>').val();
        jQuery("#<?php echo $content;?>").html('<div style="padding-top: 50px; width: 655px; text-align: center;"><img alt="Loading ..." src="<?php echo base_url();?>assets/frontend/img/loading.gif" /></div>');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>profiles/ajax_get_sugar.html",
            data: { id: <?php echo $id;?>, page: pageNum, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', functionName: '<?php echo $function;?>', min_old: min_old<?php echo $id;?>, max_old: max_old<?php echo $id;?>, min_height: min_height<?php echo $id;?>, max_height: max_height<?php echo $id;?>, min_weight: min_weight<?php echo $id;?>, max_weight: max_weight<?php echo $id;?>, min_code: min_code<?php echo $id;?>, max_code: max_code<?php echo $id;?> }
        }).done(function( htmlResult ) {
            jQuery("#<?php echo $content;?>").html(htmlResult);
        });
    };
    searchSugar<?php echo $id;?> = function(){
        <?php echo $function;?>(1);
    }
});
</script>