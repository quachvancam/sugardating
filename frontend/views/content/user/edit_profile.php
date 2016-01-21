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

<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery("#editForm").validate({
		rules: {
            password: {
                minlength: 6
            },
            confirm_password: {
                equalTo: "#password"
            },
            name: {
				required: true
			},
            code: {
				required: true
			},
            city: {
				required: true
			}
		}
	});
	$("#upavatar").click(function () {
        $("#userfile").trigger('click');
    });
    $("#see_profile").val('<?php echo $user->see_profile;?>').prop('selected',true);
    $("#gender").val('<?php echo $user->gender;?>').prop('selected',true);
    $("#day").val('<?php echo $user->day;?>').prop('selected',true);
    $("#month").val('<?php echo $user->month;?>').prop('selected',true);
    $("#year").val('<?php echo $user->year;?>').prop('selected',true);
    $('input:radio[class=own<?php echo $user->own;?>]').prop('checked', true);
    $('input:radio[class=play<?php echo $user->play;?>]').prop('checked', true);
    
    jQuery('#deactive').click(function(){
        var didConfirm = confirm("Ønsker du at deaktivere denne konto?");
        if (didConfirm == true) {
            location.href = '<?php echo base_url().index_page(); ?>user/deactivate.html';
        }
    });
    
    jQuery('#active').click(function(){
        var didConfirm = confirm("Ønsker du at aktivere denne konto?");
        if (didConfirm == true) {
            location.href = '<?php echo base_url().index_page(); ?>user/activate.html';
        }
    });
});
</script>
<script>
    function GetPostCode(code){
        $.ajax({
        	type: 'post',
        	url: '<?php echo base_url().index_page();?>user/ajax_load_postcode.html',
            data: {code: code,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
        	success:function (result){
                $('#city').val(result);
        	}			
        });
    }
</script>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil">
            
            <p class="id-profil"><?php echo $user->id;?> - <?php echo $own[$user->own]?></p>
            <div class="mb10">
                <a href="<?php echo base_url().index_page(); ?>user/photo.html" class="f-l" style="color:#999;">Mine billeder</a>
                <a href="javascript:void(0);" class="f-r" id="upavatar" style="color:#f8da62;">Skift profil billede</a>
                <?php echo form_open('user/ajaxUpdateAvatar', array('method'=>'post', 'class'=>'frm-profil', 'enctype'=>'multipart/form-data', 'id'=>'avatarForm'));?>
                <input type="file" style="display:none" name="userfile" id="userfile"/>
                </form>
                <div class="clearfix"></div>
                <script>
                    jQuery(document).ready(function(){
                    	var input = document.getElementById("userfile"), 
                    		formdata = false;
                    	if (window.FormData) {
                      		formdata = new FormData();
                    	}
                     	input.addEventListener("change", function (evt){
                            jQuery("#viewavatar").html('<p style="text-align: center; padding-top: 30px;"><img alt="Loading ..." width="32" src="<?php echo base_url();?>assets/frontend/img/loading.gif" /></p>');

                            var file = this.files[0];
                            if (formdata) {
            					formdata.append("avatar", file);
            				}
                    		if (formdata){
                    			$.ajax({
                    				url: "<?php echo base_url().index_page();?>user/ajaxUpdateAvatar.html",
                    				type: "POST",
                    				data: formdata,
                    				processData: false,
                    				contentType: false,
                    				success: function (result) {
                    					jQuery("#viewavatar").html(result); 
                    				}
                    			});
                    		}
                    	}, false);
                    });
                </script>
            </div>
            <div class="larg-profil" id="viewavatar" style="padding-bottom: 5px; width: 200px; height: 280px; overflow: hidden;">
                <?php echo $img;?>
            </div>
            <div class="clearfix"></div>
            <ul class="list-func">
                <li><a href="<?php echo base_url().index_page(); ?>user/owner.html">Min Profil</a></li>
                <?php if($user->active){?>
                <li class="deactive"><a href="javascript:void(0);" id="deactive" style="float:left;">Deaktivér min profil</a>
<div class="question-mark" style="float:none;  margin: 0 110px;">
                        <div class="common-popup">
                            <div class="top"><span class="arrow"></span></div>
                            <div class="content">
                                Hér kan du vælge at sætte din profil i dvale. Det betyder dog at andre profiler ikke længere kan se dig eller kontakte dig.<br/>
Hvis man igen skal kunne se og kontakte dig, skal du klikke på 'Aktivér min profil'.
 <p/>
Se mere under vores FAQ, hvis du ønsker at lukke din profil.
                            </div>
                            <div class="bottom"></div>
                        </div>
                    </div></li>
                <?php } else {?>
                <li><a href="javascript:void(0);" id="active">Aktiver min Profil</a></li>
                <?php }?>
            </ul>
        </div>
        <div class="info-profil"> 
            <?php echo form_open('user/update_profile', array('method'=>'post', 'class'=>'frm-profil', 'enctype'=>'multipart/form-data', 'id'=>'editForm'));?>
            <fieldset>
                <div style="float:right;">
                    <input type="submit" value="" class="btn-update" style="border:none; cursor:pointer;" />
                </div>
                
                <div class="clearfix"></div>
            
                    <div style="margin: 3px 5px 0 0; float: left;">
                    <input type="checkbox" name="hide_avatar" value="1" style="margin-left:0px;" <?php if($user->hide_avatar) echo 'checked';?> /> Kun medlemmer kan se profilbillede
                    </div>
                    <div class="question-mark" style="float:left; margin: 0 3px;">
                        <div class="common-popup">
                            <div class="top"><span class="arrow"></span></div>
                            <div class="content">
                                Når du klikker her, beskytter vi dit profil billede med vores slørede *låse billede*. 
                                Det sikrer dig, at kun medlemmer af Sugardating.dk som er logget ind, kan se dit profil billede.
                            </div>
                            <div class="bottom"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="txt-250">
                        <label>Ny adgangskode</label>
                        <input type="password" class="input-profil" name="password" id="password" value=""/>
                    </div>
                    <div class="txt-250">
                        <label>Bekræft adgangskode</label>
                        <input type="password" class="input-profil" name="confirm_password" value=""/>
                    </div>
                    <div class="txt-250">
                        <label>Profil navn</label>
                        <input type="text" class="input-profil" name="name" id="name" value="<?php echo $user->name;?>"/>
                    </div>
                    <div class="txt-250">
                        <label>Hvem må se dig?</label>
                        <select class="input-profil w250" name="see_profile" id="see_profile">
                            <option value="1" <?php if($user->see_profile == 1) echo 'selected';?>>Alle medlemmer </option>
                            <option value="2" <?php if($user->see_profile == 2) echo 'selected';?>>Mine venner </option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="body-size">
                        <label for="">Højde (cm)</label>
                        <input type="text" class="input-profil w50" name="height" value="<?php echo $user->height;?>"/>
                    </div>
                    <div class="body-size">
                        <label for="">Vægt (kg)</label>
                        <input type="text" class="input-profil w50" name="weight" value="<?php echo $user->weight;?>"/>
                    </div>
                    <div class="body-size">
                        <label for="">Køn</label>
                        <select class="input-profil w100" name="gender" id="gender">
                            <option value="0" <?php if($user->gender == 0) echo 'selected';?>>Kvinde</option>
                            <option value="1" <?php if($user->gender == 1) echo 'selected';?>>Mand</option>
                        </select>
                    </div>
                    <div class="clearfix"></div>
                    <div class="txt-250">
                        <label>Post nr.</label>
                        <input type="text" maxlength="4" value="<?php echo $user->code;?>" class="input-profil" name="code" id="code" onblur="GetPostCode(this.value)"/>
                    </div>
                    <div class="txt-250">
                        <label>By</label>
                        <input type="text" value="<?php echo $user->city;?>" class="input-profil" name="city" id="city"/>
                    </div>
                    <div class="clearfix"></div>
                    <label>Alder</label>
                    <div class="clearfix"></div>
                    <select class="input-profil w100 no-clear" name="day" id="day">
                        <?php for($i=1; $i<=31; $i++){?>
                        <option value="<?php echo $i;?>"><?php echo sprintf("%02s", $i);?></option>
                        <?php }?>
                    </select>
                    <select class="input-profil w100 no-clear ml15" name="month" id="month">
                        <?php for($i=1; $i<=12; $i++){?>
                        <option value="<?php echo $i;?>"><?php echo sprintf("%02s", $i);?></option>
                        <?php }?>
                    </select>
                    <select class="input-profil w100 no-clear ml15" name="year" id="year">
                        <?php
                        $yearend = date('Y',time()) - 18;
                        $yearstart = date('Y',time()) - 100;
                        for($i=$yearstart; $i<=$yearend; $i++){?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                        <?php }?>
                    </select>
                    <div class="clearfix"></div>
                    <div class="radio-button">
                        <div class="clearfix">
                            <label>Jeg er en</label>
                        </div>
                        <div>
                            <input type="radio" name="own" value="1" class="own1"/>
                            <span>Sugar Baby Mand</span> </div>
                        <div>
                            <input type="radio" name="own" value="2" class="own2"/>
                            <span>Sugar Baby Kvinde</span> </div>
                        <div>
                            <input type="radio" name="own" value="3" class="own3"/>
                            <span>Sugar Dad</span> </div>
                        <div>
                            <input type="radio" name="own" value="4" class="own4"/>
                            <span>Sugar Mom</span> </div>
                    </div>
                    <div class="radio-button">
                        <div class="clearfix">
                            <label>Som vil lege med en </label>
                        </div>
                        <div>
                            <input type="radio" name="play" value="1" class="play1"/>
                            <span>Sugar Baby Mand</span> </div>
                        <div>
                            <input type="radio" name="play" value="2" class="play2"/>
                            <span>Sugar Baby Kvinde</span> </div>
                        <div>
                            <input type="radio" name="play" value="3" class="play3"/>
                            <span>Sugar Dad</span> </div>
                        <div>
                            <input type="radio" name="play" value="4" class="play4"/>
                            <span>Sugar Mom</span> </div>
                    </div>
                    <div class="txt-250">
                        <label>Skriv et motto</label>
                        <input type="text" value="<?php echo $user->slogan;?>" class="input-profil" name="slogan"/>
                    </div>
                    <label>Personbeskrivelse</label>
                    <textarea class="input-profil w510" name="description"><?php echo $user->description;?></textarea>
                    <div class="clearfix"></div>
                    <?php if($user->member == 1){?>
                    <div class="box-gray mb20">
                        <p style="font-size:13px;margin-top: 0;">
                            <b>Sølv medlem</b><br/>
                            Gyldig til <span class="w-color">ubegrænset</span>
                        </p>
                        <a href="<?php echo base_url().index_page(); ?>user/upgrade.html" class="btn-upgrade-01">Opgradér</a>
                        <div class="clearfix"></div>
                    </div>
                    <?php } else {?>
                    <div class="box-gray mb20">
                        <p style="font-size:13px;margin-top: 0;">
                            <b>Gold medlem</b><br/>
                            Gyldig til <span class="w-color"><?php echo date("d-m-Y", strtotime("+1 month", $user->payment_time))?></span>
                        </p>
                        <div class="clearfix"></div>
                    </div>
                    <?php }?>
                    <!--<a href="#" class="btn-update">Update</a>-->
                    <input type="submit" value="" class="btn-update" style="border:none; cursor:pointer;" />
                    <a href="<?php echo base_url().index_page(); ?>user/owner.html" class="btn-canel1">Annullér</a>
                </fieldset>
            </form>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clearfix"></div>
</div>