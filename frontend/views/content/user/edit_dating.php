<?php 
$cat_icon_array = array(
"1"=>"movie",
"2"=>"brunch",
"3"=>"coffee",
"4"=>"bar",
"5"=>"restaurant",
"6"=>"snack",
"7"=>"travel",
"8"=>"getaway",
"9"=>"outdoor",
"10"=>"sports",
"11"=>"other",
"12"=>"wellness",
"13"=>"leisure",
"14"=>"spoil",
"15"=>"culture",
"16"=>"events",
"17"=>"packed",
"18"=>"fun",
"19"=>"extraordinary",
"20"=>"sweet",
"21"=>"sexy",
"22"=>"naughty",
"23"=>"miscellaneous");
$hour = date("H", $dating->end_date);
$min = date("i", $dating->end_date);
$date = date("d-m-Y", $dating->end_date);
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/frontend/msdropdown/dd.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/msdropdown/js/uncompressed.jquery.dd.js"></script>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
    try {
        jQuery("#websites1").msDropDown({useSprite:'sprite'})
        jQuery("#ver").html(jQuery.msDropDown.version);
        } catch(e) {
          //alert("Error: "+e.message);
        }
    })
</script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/jquery.ui.all.css"/>
<script src="<?php echo base_url();?>assets/frontend/js/jquery.ui.core.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/jquery.ui.widget.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/jquery.ui.datepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/frontend/js/jquery.ui.datepicker-da.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/datepicker.css"/>
<script>
jQuery(function() {
    jQuery( "#datepicker,#datepicker1" ).datepicker({
            changeMonth: true,
            changeYear: true
        });	
    
});
</script>
<script type="text/javascript">
    function searchVip(){
        var namevip = jQuery('#namevip').val();
        jQuery("#list_vipmember").html('<img alt="Loading ..." src="<?php echo base_url();?>assets/frontend/img/loading.gif" />');
        $.ajax({
        	type: 'post',
        	url: '<?php echo base_url().index_page();?>user/searchUser.html',
            data: {name: namevip,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
        	success:function (result){
                $('#list_vipmember').html(result);
        	}			
        });
    }
</script>
<script type="text/javascript">
    function addVip(id){
        document.getElementById('close-VIP').click();
        jQuery('#vipid').val(id);
        $.ajax({
        	type: 'post',
        	url: '<?php echo base_url().index_page();?>user/addVip.html',
            data: {id: id,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
        	success:function (result){
                $('#vip').val(result);
        	}			
        });
    }
</script>
<div id="f-inviteVIP" class="reveal-modal">
  <div class="p-content3 clear-fix">
    <div>
        <h2>Invitér en VIP bruger</h2>
        <input name="namevip" id="namevip" class="txtSearch" type="text" onclick="this.value=''" value="Indtast profilnavn eller profilnr. på VIP brugeren"/>
        <input class="btnSearch" onclick="searchVip();" type="button" value="Søg" name="Søg"/>
    </div>
    <div class="clear"></div>
    <div id="list_vipmember">
    <p>Nyeste brugere:</p>
    <ul class="list_vipmember clearfix">
        <?php 
        if($menber){
            $own = array(1=>"SugarBaby (M)", 2=>"SugarBaby (F)", 3=>"SugarDad", 4=>"SugarMom");
            foreach($menber as $user){
            $img = '';
            if($user->avatar){
               $avatar = $user->avatar;
            } else {
               $avatar = 'noavatar'.$user->gender.'.jpg';
            }
            $img = '<img src="'.base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$avatar.'&q=100&w=200&h=280" alt=""/>';       
        ?>
        <li>
        <?php echo $img;?>
        <article>
          <h4>Profilenavn: <?php echo $user->name;?></h4>
          <p>Profilenr. <?php echo $user->id;?> - <?php echo $own[$user->own];?></p>
          <p>Alder: <?php echo get_age($user->day, $user->month, $user->year);?> år</p>
          <p>Højde: <?php echo $user->height;?> cm</p>
          <p>Vægt: <?php echo $user->weight;?> kg</p>
          <p>Postnr: <?php echo $user->city;?></p>
          <a class="btnSeeprofile" onclick="addVip('<?php echo $user->id;?>');" href="javascript:void(0);">Se Profile</a>
        </article>
        <div class="clear"></div>
        </li>
        <?php }}?>
    </ul>
    </div>
    <a class="close-reveal-modal" id="close-VIP"></a>
  </div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery("#myform").validate({
		rules: {
			title: {
				required: true
			},
            date: {
				required: true
			},
            description: {
				required: true
			}
		}
	});
});// JavaScript Document
</script>
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix"> <?php echo modules::run('own/own/left_content'); ?> </div>
        <div class="info-profil">
            <h2>Opret nyt VIP/Date opslag</h2>
            <div class="clear"></div>
            <span style="color:#F00; font-size:15px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>
            <?php echo form_open('user/update_dating', array('method'=>'post', 'name'=>'myform', 'id'=>'myform', 'class'=>'frm-profil'));?>
                <fieldset>
                    <label>Invitér en VIP bruger</label><br />
                    <input class="input-profil" readonly="true" style="width:263px" type="text" name="vip" id="vip" value="" />
                    <input type="hidden" name="vipid" id="vipid" value="" />
                    <div class="question-mark" style="float:left; margin: 0 3px;">
                        <div class="common-popup">
                            <div class="top"><span class="arrow"></span></div>
                            <div class="content">
                                <?php echo $help01[0]->short_content;?>
                            </div>
                            <div class="bottom"></div>
                        </div>
                    </div>
                    <a style="float: left;" class="btn-findadddating" data-reveal-id="f-inviteVIP" href="javascript:void(0);">Find og invitér</a><br />
                    <label>Overskrift</label><br />
                    <input class="input-profil" style="width:263px" type="text" name="title" id="title" value="<?php echo $dating->title;?>"/>
                    <div class="question-mark" style="float:left; margin: 0 3px;">
                        <div class="common-popup">
                            <div class="top"><span class="arrow"></span></div>
                            <div class="content">
                                <?php echo $help02[0]->short_content;?>
                            </div>
                            <div class="bottom"></div>
                        </div>
                    </div><br />
                    <label>Kategori</label>
                    <div class="clearfix"></div>
                    <select  class="input-profil" name="order_item_id" id="websites1" style="width:280px;" >
                        <?php if($vouchers){?>
                        <option class="<?php echo $cat_icon_array[$vouchers->category_id]?>" value="<?php echo $vouchers->id;?>" ><?php echo $vouchers->name.' : '.$vouchers->codes;?></option>
                        <?php }else{?>
                        <option value="0">Dating/event uden voucher</option>
                        <?php }?>
                    </select>
                    <label style="margin-top: 10px;">Tidspunkt</label>
                    <div class="clearfix"></div>
                    <select class="input-profil w130 no-clear" name="hour">
                        <?php for($i=0; $i<=23; $i++){?>
                        <option value="<?php echo $i;?>" <?php if($hour==$i) echo 'selected';?>><?php echo sprintf("%02s", $i);?></option>
                        <?php }?>
                    </select>
                    <select class="input-profil w130 no-clear ml15" name="minute">
                        <?php for($i=0; $i<=55; $i=$i+5){?>
                        <option value="<?php echo $i;?>" <?php if($min==$i) echo 'selected';?>><?php echo sprintf("%02s", $i);?></option>
                        <?php }?>
                    </select>
                    <label>Dato</label>
                    <input id="datepicker" name="date" type="text" class="input-profil w264" value="<?php echo $date;?>" style="background: #fff url('<?php echo base_url();?>assets/frontend/img/calendar.gif') right no-repeat; cursor:pointer; color:#000;border: 1px solid #393232;" />
                    <label>Beskrivelse</label>
                    <textarea class="input-profil w510" name="description" id="description"><?php echo $dating->description;?></textarea>
                    <div class="clearfix"></div>
                    <input type="submit" class="btn-savedating" style="cursor:pointer; border:none; float:left;" />
                    <a class="btn-canel1" href="<?php echo base_url().index_page()?>user/datinglist.html" style="margin-top:0px;">Annullér</a>
                    <input type="hidden" name="id" value="<?php echo $dating->id;?>" />
                </fieldset>
            </form>
        </div> 
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
</div>