/* DangKhoaWeb */
jQuery(document).ready(function(){
jQuery('a').click(function(){
        if (jQuery(this).attr('href').indexOf('delete',1) != -1) {
            if (!confirm ('Are you sure you want to do this?')) {
                return false;
            }
        }
    });   
});