<?php 
$own = array(0=>"", 1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$play = array(0=>"", 1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
$chat_link = "javascript:jqcc.cometchat.chatWith('".$user->id."');";
$img = '';
if($user->avatar){
   $avatar = $user->avatar;
} else {
   $avatar = 'noavatar'.$user->gender.'.jpg';
}
$img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().'upload/user/'.$avatar.'&q=100&w=200&h=280" alt=""/>';
?>
<?php if(member_type()==2){?>
<script type="text/javascript">
jQuery(document).ready(function(){
    $("#request").click(function(){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>profiles/ajax_send_request.html",
            data: { from_id: $("#from_id").val(), to_id: $("#to_id").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        }).done(function( result ) { 
            if(result == 1){
                $('#alert').html('Din venneanmodning er nu sendt');
                $('#backoverlay').show();
                $('#show_popup').show();
            } else if(result == 2){
                $('#alert').html('Din venneanmodning er nu sendt, vent venligst');
                $('#backoverlay').show();
                $('#show_popup').show();
            } else {
                $('#alert').html('Kan ikke sende en venneanmodning');
                $('#backoverlay').show();
                $('#show_popup').show();
            }
        });
    });
});
</script>
<?php }?>
<div class="col-profil">
    <p class="id-profil"><?php echo $user->id;?> - <?php echo $own[$user->own]?></p>
    <span class="img-profil">
        <?php echo $img;?>
    </span>
    <div class="status-profil"><?php echo $user->slogan;?></div>
    <?php if($user->id != getUser()->id){?>
    <ul class="list-func">
        <li><a href="<?php echo base_url().index_page().'profiles/chat/'.$user->id.'/'.$user->name.'.html'; ?>">Skriv til <?php echo $user->name;?></a></li>
        <li><a href="<?php echo base_url().index_page().'user/adddating.html'; ?>" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Strø lidt sukker på mig <sup style="font-size: 9px;">TM</sup></a></li>
        <li><a href="javascript:void(0);" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?> id="request">Tilføj <?php echo $user->name;?> som favorit</a></li>
        <li><a href="<?php echo $chat_link;?>" <?php if(member_type()==1){?>data-reveal-id="f-upgradePage"<?php }?>>Chat med <?php echo $user->name;?></a></li>
    </ul>
    <?php }?>
    <input type="hidden" value="<?php echo $user->id;?>" id="to_id" />
    <input type="hidden" value="<?php echo getUser()->id;?>" id="from_id" />
    <div class="box-border">
        <span style="font-size: 15px;">Jeg søger: <?php echo $play[$user->play]?></span>
        <p><?php echo $user->description;?></p>
    </div>
</div>