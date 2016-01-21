<div id="sugarDates" class="clearfix bgContent m-t-3">
    <div class="contentLeft">
    <ul class="breakcum">
    <li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Opret trin 1</a></li>
    </ul>
    <div class="f-step clear">
    <form name="f1" action="" method="get">
    	<fieldset>
            <a class="bntStep1" href="<?php echo base_url().index_page(); ?>sugarshop/checkout.html">Trin 1</a>
            <a class="bntStep2a active" href="<?php echo base_url(); ?>">Trin 2</a>
            <div class="clear"></div>
            <div class="f-l m-t10">
            	<div>
                  <label>Hér kan du kan betale med følgende betalingskort:</label>
                    <ul class="listCard m-t10">
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard1.png" alt=""/></li>
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard2.png" alt=""/></li>
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard3.png" alt=""/></li>
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard4.png" alt=""/></li>
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard5.png" alt=""/></li>
                      <li><img src="<?php echo base_url(); ?>assets/frontend/img/iconCard6.png" alt=""/></li>
                    </ul>
                </div>
    			<div class="clear"></div>
                <div>
                    <form id="leasingForm" name="leasingForm" action="https://secure.quickpay.dk/form/" method="post">
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
                    <input type="hidden" name="autocapture" value="<?php echo $autocapture ?>" />
                    <input type="hidden" name="cardtypelock" value="<?php echo $cardtypelock ?>" />
                    <input type="hidden" name="md5check" value="<?php echo $md5check ?>" />
                	<input type="hidden" name="description" value="<?php echo $description ?>" />
                	<input type="hidden" name="testmode" value="<?php echo $testmode ?>" />
                	<input type="hidden" name="splitpayment" value="<?php echo $splitpayment ?>" />					
                </form>
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        //$("#leasingForm").submit();
                    });
                </script>
                <script>
                    function sendPayment(){
                        $("#leasingForm").submit();
                    }
                </script>
                <div class="clear"></div>
                <a class="bntCreate2" onclick="sendPayment();" href="javascript:void(0);">Betal nu >></a>
            </div><!---->
            <div class="f-r m-t10">
            	<!--img src="<?php echo base_url(); ?>assets/frontend/img/introCreditcard.png" alt=""/-->
            </div><!---->
        </fieldset>
    </form>
    </div><!--.f-step1-->
    
    </div><!--contentLeft-->
    
    <?php echo modules::run('banner/banner/index'); ?>
    <!--adsRight-->
    <div class="clear"></div>
</div>