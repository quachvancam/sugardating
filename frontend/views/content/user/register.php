<script language="javascript">
jQuery(document).ready(function(){
	jQuery("#registerForm").validate({
		rules: {
			name: {
				required: true
			},
            email: {
				required: true,
                email: true
			},
            password: {
                required: true,
                minlength: 6
            },
            confirm_password: {
                equalTo: "#password"
            },
            term: {
				required: true
			},
            accepted_email:{
                range: [1, 1]
            }
		}
	});
    
    $("#email").blur(function(){
		if(!$("#email").val()){
			$("#email").addClass('error');
			return false;
		}
        $.ajax({
            type: "POST",
            url: "<?php echo base_url().index_page();?>user/ajax_check_email.html",
            data: { email: $("#email").val(), '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
        }).done(function( result ) { 
            result = jQuery.parseJSON(result);
            if(!result.accept){
                $("#email").addClass('error');
            }
            $("#check_email" ).html( result.html );
            $("#accepted_email").val(result.accept);
        });
    });
    
    
});// JavaScript Document
</script>

<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <ul class="breakcum">
            <li><a href="<?php echo base_url(); ?>">Start</a></li>
            <li><a href="#">Opret trin 1</a></li>
        </ul>
        <div class="f-step clear">
            <?php echo form_open('user/register_process', array('id'=>'registerForm'))?>
                <fieldset>
                    <h2>Bliv Sugar medlem og leg med</h2>
                    <a href="javascript:void(0);" class="bntStep1">Trin 1</a> <a href="javascript:void(0);" class="bntStep2">Trin 2</a>
                    <div class="clear"></div>
                    <div class="f-l m-t10">
                        <div class="clearfix">
                            <p class="f-r"><span>*</span> skal udfyldes</p>
                        </div>
                        <div>
                            <label>Vælg dit profil navn <span>*</span></label>
                            <input type="text" value="" name="name" class="input"/>
                        </div>
                        <div>
                            <label>Køn <span>*</span></label>
                            <select name="gender" class="w100">
                                <option value="0">Kvinde </option>
                                <option value="1">Mand </option>
                            </select>
                        </div>
                        <div>
                            <label>Alder <span>*</span></label>
                            <select class="w69 m-r12" name="day">
                                <?php for($i=1; $i<=31; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo sprintf("%02s", $i);?></option>
                                <?php }?>
                            </select>
                            <select class="w100 m-r12" name="month">
                                <?php for($i=1; $i<=12; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo sprintf("%02s", $i);?></option>
                                <?php }?>
                            </select>
                            <select class="w90" name="year">
                                <?php
                                $yearend = date('Y',time()) - 18;
                                $yearstart = date('Y',time()) - 100;
                                for($i=$yearstart; $i<=$yearend; $i++){?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <!---->
                    <div class="f-r m-t10">
                        <div>
                            <label>E-mail <span>*</span></label>
                            <input type="text" value="" name="email" class="input" id="email"/>
                            <br />
                            <span id="check_email"></span>
                        </div>
                        <div>
                            <label>Vælg kodeord <span>*</span>(min. 6 karakter)</label>
                            <input type="password" value="" name="password" class="input" id="password"/>
                        </div>
                        <div>
                            <label>Gentag Kodeord <span>*</span></label>
                            <input type="password" value="" name="confirm_password" class="input" id="confirm_password"/>
                        </div>
                        <div class="choose">
                            <div class="f-l m-t10  m-r20">
                                <label>Jeg er en</label>
                                <div>
                                    <input type="radio" name="own" class="rad" value="1" checked=""/>
                                    Sugar Baby Mand (m) </div>
                                <div class="m-t-10">
                                    <input type="radio" name="own" class="rad" value="2"/>
                                    Sugar Baby Kvinde (f) </div>
                                <div class="m-t-10">
                                    <input type="radio" name="own" class="rad" value="3"/>
                                    Sugar Dad </div>
                                <div class="m-t-10">
                                    <input type="radio" name="own" class="rad" value="4"/>
                                    Sugar Mom </div>
                            </div>
                            <div class="f-r m-t10">
                                <label>Som vil lege med en </label>
                                <div>
                                    <input type="radio" name="play" class="rad" value="1" checked=""/>
                                    Sugar Baby Mand (m) </div>
                                <div class="m-t-10">
                                    <input type="radio" name="play" class="rad" value="2"/>
                                    Sugar Baby Kvinde (f) </div>
                                <div class="m-t-10">
                                    <input type="radio" name="play" class="rad" value="3"/>
                                    Sugar Dad </div>
                                <div class="m-t-10">
                                    <input type="radio" name="play" class="rad" value="4"/>
                                    Sugar Mom </div>
                            </div>
                        </div>
                        <!--.choose--> 
                    </div>
                    <!---->
                    <div class="clear"></div>
                    <div class="selectMem clearfix">
                        <label>Vælg medlemskab</label>
                        <div>
                            <input type="radio" checked name="member" class="rad" value="1"/>
                            Sølv medlem (gratis)</div>
                        <div>
                            <input type="radio" name="member" class="rad" value="2"/>
                            Guld medlem (koster 99, - dkr. pr. mdr. inkl. moms)</div>
                    </div>
                    <!---->
                    
                    <div class="tou m-t10">
                        <p>
                            <input type="checkbox" class="ck" name="term" value="1"/>
                            Jeg har læst og accepterer <a href="<?php echo base_url().index_page(); ?>medlemsbetingelser/user.html" class="red" target="_blank">brugerbetingelserne for Sugardating.dk</a></p>
                    </div>
                    <input type="hidden" name="accepted_email" value="0" id="accepted_email" />
                    <input type="submit" class="bntGostep" style="border:none; cursor:pointer;" />
                </fieldset>
            </form>
        </div>
        <!--.f-step1--> 
        
    </div>
    <!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>
