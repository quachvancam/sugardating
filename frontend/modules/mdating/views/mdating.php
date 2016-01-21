<script language="javascript">
jQuery(document).ready( function(){
    var category_id = null;
    var own = null;
    var play = null;
    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url().index_page();?>profiles/ajax_get_dating.html",
        data: { page: 1, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', category_id : category_id, own : own, play : play}
    }).done(function( result ) {
        jQuery("#content1").html(result);
        
    });
    moreDating = function(pageNum){
        var category_id = jQuery('#category_id').val();
        var own = jQuery('#own').val();
        var play = jQuery('#play').val();
        jQuery("#content1").html('<div style="padding-top: 50px; width: 655px; text-align: center;"><img alt="Loading ..." src="<?php echo base_url();?>assets/frontend/img/loading.gif" /></div>');
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>profiles/ajax_get_dating.html",
            data: {page: pageNum, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>', category_id : category_id, own : own, play : play }
        }).done(function( htmlResult ) {
            jQuery("#content1").html(htmlResult);
        });
    }
    searchDating = function(){
        moreDating(1);
    }
});
</script>