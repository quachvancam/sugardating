<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <ul class="breakcum">
        </ul>
        <div class="f-step clear" style="min-height: 400px;">
            <?php
                $protocol='7';
                $msgtype='authorize';
                $merchant='89898978';
                $language='da';
                $ordernumber = 'su-'.$user_id;
                $amount = get_config_value('gold_member_fee')*100;
                $currency='DKK';
                $continueurl = base_url().index_page().'user/register_checkout_success.html?id='.$user_id.'&'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
                $cancelurl = base_url().index_page().'user/register_checkout_error.html?'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
                $callbackurl = base_url().index_page().'user/register_checkout_callback.html?'.$this->security->get_csrf_token_name().'='.$this->security->get_csrf_hash();
                $md5secret ='29p61DveBZ79c3144LW61lVz1qrwk2gfAFCxPyi5sn49m3Y3IRK5M6SN5d8a68u7';
                $md5check = md5($protocol.$msgtype.$merchant.$language.$ordernumber.$amount.$currency.$continueurl.$cancelurl.$callbackurl.$md5secret);
            ?>
            <?php /*?>
            <!--<form action="https://secure.quickpay.dk/form/" method="post" id="leasingForm">
                <input type="hidden" name="protocol" value="<?php echo $protocol ?>" />
                <input type="hidden" name="msgtype" value="<?php echo $msgtype ?>" />
                <input type="hidden" name="merchant" value="<?php echo $merchant ?>" />
                <input type="hidden" name="language" value="<?php echo $language ?>" />
                <input type="hidden" name="ordernumber" value="<?php echo $ordernumber ?>" />
                <input type="hidden" name="amount" value="<?php echo $amount ?>" />
                <input type="hidden" name="currency" value="<?php echo $currency ?>" />
                <input type="hidden" name="continueurl" value="<?php echo $continueurl ?>" />
                <input type="hidden" name="cancelurl" value="<?php echo $cancelurl ?>" />
                <input type="hidden" name="callbackurl" value="<?php echo $callbackurl ?>" />
                <input type="hidden" name="md5check" value="<?php echo $md5check ?>" />
            </form>-->
            <?php */?>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypalForm">
                <input type="hidden" value="utf-8" name="charset"/>
                <input type="hidden" value="_cart" name="cmd"/>
                <input type="hidden" value="1" name="upload"/>
                <input name="shipping" type="hidden" value="0.00"/>
                <input name="tax" type="hidden" value="0.00"/>
                
                <input type="hidden" value="1" name="item_number_1"/>
                <input type="hidden" value="Guldmedlem" name="item_name_1"/>
                <input type="hidden" value="<?php echo get_config_value('gold_member_fee');?>" name="amount_1"/>
                <input type="hidden" value="1" name="quantity_1"/>
                
                <input name="amount" type="hidden" value="<?php echo get_config_value('gold_member_fee');?>"/>
                <input name="business" type="hidden" value="paypal@reddocksmedia.com"/>
                <input name="currency_code" type="hidden" value="DKK"/>
                <input name="lc" type="hidden" value="da_DK"/>
                <input name="return" type="hidden" value="<?php echo $continueurl;?>"/>
                <input name="notify_url" type="hidden" value="<?php echo $callbackurl;?>"/>
                <input name="cancel_return" type="hidden" value="<?php echo $cancelurl;?>"/>
                <input name="custom" type="hidden" value="custom data"/>
            </form>
            <!--a class="bntconfirmOrder1" onclick="sendPayment();" href="javascript:void(0);">Til betaling</a-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#paypalForm").submit();
                });
                function sendPayment(){
                    $("#paypalForm").submit();
                }
            </script>
            <p class="contentStep">Du viderestilles nu til PayPal. Nem og sikker betaling. <a href="https://www.paypal.com/dk/webapps/mpp/logo-center"><img style="vertical-align: middle;" src="<?php echo base_url(); ?>assets/frontend/img/logo_PayPal_dk.png"/></a></p>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clear"></div>
</div>