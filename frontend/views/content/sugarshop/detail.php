<script type="text/javascript" src="<?php echo base_url(); ?>assets/frontend/js/jquery.countdown1.3.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#time").countdown({
            date: '<?php echo date('m/d/Y h:i:s',$deals->end_date);?>',
            htmlTemplate: " %{d} dage %{h} : %{m} : %{s}",
            onChange: function( event, timer ){
                //jQuery(this).html("change");
            },
            onComplete: function( event ){
            	//jQuery(this).html("Completed");
            	jQuery(this).html("Udløbe");
                $('a.addCart').click(function() { return false; });
            },
            onPause: function( event, timer ){
            	jQuery(this).html("Pause");
            },
            onResume: function( event ){
            	jQuery(this).html("Resumed");
            },
            leadingZero: true,
            direction: "down"
        });
	
    });
</script>
<script>
function showImg(id){
    for(i=1; i<5;i++){
        if(i==id){
            jQuery('#show_'+i).fadeIn('slow');
        }
        else{
            jQuery('#show_'+i).hide();
        }
    }
}
</script>
<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
    <div class="col-profil clearfix">
        <?php if($deals->company_image){?>
            <a class="img-profil" href="<?php echo $deals->company_web;?>" target="_blank">
                <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/b2b/<?php echo $deals->company_image; ?>&h=300&w=220&q=100" alt=""/>
            </a>
        <?php }?>
    </div>
    <div class="infoProfil clearfix">
      <div class="singleItem">
        <div id="gallery" class="SIcontent">
          <div class="mainSIcontent clearfix">
            <p><?php echo $deals->company_code;?> - <?php echo $deals->company_name;?></p>
            <h2><?php echo $deals->name;?></h2>
            <div class="clear"></div>
            <div class="w340 f-l">
                <div class="imgLarg m-b20">
                    <?php if($deals->image1){?>
                    <img id="show_1" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image1; ?>&h=340&w=340&q=100" alt=""/>
                    <?php }?>
                    <?php if($deals->image2){?>
                    <img id="show_2" style="display: none;" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image2; ?>&h=340&w=340&q=100" alt=""/>
                    <?php }?>
                    <?php if($deals->image3){?>
                    <img id="show_3" style="display: none;" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image3; ?>&h=340&w=340&q=100" alt=""/>
                    <?php }?>
                    <?php if($deals->image4){?>
                    <img id="show_4" style="display: none;" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image4; ?>&h=340&w=340&q=100" alt=""/>
                    <?php }?>
                    <div class="ticker">
                        <h2 style="float: none;"><?php echo round((($deals->old_price-$deals->new_price)/$deals->old_price)*100,2);?>%</h2>
                        <h2 style="margin-top: 0px;float: none;">sugar</h2>
                    </div>
                </div>
                <div style="padding: 5px 0; font-size: 15px;"><?php echo $deals->title;?></div>
                <div style="padding-bottom: 10px;">
                    <?php echo $deals->description;?>
                </div>
            </div>
            <div class="w159 f-r">
              <div class="btn-share-social">
              	<p>Del produktet på</p>
   	                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $deals->id."/".seo_url($deals->name);?>.html">
                        <img src="<?php echo base_url(); ?>assets/frontend/img/btn-fb-share.png" alt="" title="facebook"/>
                    </a>
              </div>
              <div class="valueSale clearfix">
                <div class="f-l">
                  <label>Værdi</label>
                  <p><?php echo priceFormat($deals->old_price);?></p>
                </div>
                <div class="f-r">
                  <label>Spar</label>
                  <p><?php echo priceFormat($deals->old_price-$deals->new_price);?></p>
                </div>
              </div>
              <div class="prices m-t10">
                <label>PRIS</label>
                <p><?php echo priceFormat($deals->new_price);?></p>
              </div>
              <div class="expires m-t10">
                <p>Udløber om</p>
                <span style="font-size: 11px;" id="time"></span>
              </div>
              <div class="numVoucher m-t10 m-b10">
                <p>Antal vouchers <span><?php echo $deals->quantity;?></span></p>
                <?php if($deals->quantity > $deals->quantitybuy){?>
                <p class="ticker45"><img src="<?php echo base_url(); ?>assets/frontend/img/iconTicker.png" alt=""/><?php echo $deals->quantitybuy;?></p>
                <?php } else {?>
                <p class="ticker45" style="font-size:28px;">UDSOLGT!</p>
                <?php }?>
                <p>HAR STRØET SUKKER</p>
              </div>
              
              <?php echo form_open('cart/insert', array('id'=>'pro_'.$deals->id));?>
              
                <input type="hidden" name="id_<?php echo $deals->id;?>" id="id_<?php echo $deals->id;?>" value="<?php echo $deals->id;?>" />
                <input type="hidden" name="name_<?php echo $deals->id;?>" id="name_<?php echo $deals->id;?>" value="<?php echo $deals->name;?>" />
                <input type="hidden" name="qty_<?php echo $deals->id;?>" id="qty_<?php echo $deals->id;?>" value="1" />
                <input type="hidden" name="price_<?php echo $deals->id;?>" id="price_<?php echo $deals->id;?>" value="<?php echo $deals->new_price;?>" />
                <?php if($deals->quantity > $deals->quantitybuy){?>
                <a onclick="AddToCart('<?php echo $deals->id;?>');" class="addCart" href="javascript:void(0);" data-reveal-id="f-cart">Læg i kurv</a>
                <?php }?>
              </form>
              
              <div class="clear"></div>
              <ul class="listRes m-t10 thumb1">

                <?php if($deals->image1){?><li><img style="cursor: pointer;" onclick="showImg(1);" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image1; ?>&h=70&w=73&q=80"/></li><?php }?>
                <?php if($deals->image2){?><li class="end"><img style="cursor: pointer;" onclick="showImg(2);" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image2; ?>&h=70&w=73&q=80"/></li><?php }?>
                <?php if($deals->image3){?><li><img style="cursor: pointer;" onclick="showImg(3);" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image3; ?>&h=70&w=73&q=80"/></li><?php }?>
                <?php if($deals->image4){?><li class="end"><img style="cursor: pointer;" onclick="showImg(4);" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals->image4; ?>&h=70&w=73&q=80"/></li><?php }?>

              </ul>
            </div>
            <div style="clear: both;"></div>
            <div style="position: relative; left: 0; bottom: 0;">
                <a href="<?php echo base_url().index_page().'sugarshop/index.html';?>">
                    <img src="<?php echo base_url(); ?>assets/frontend/img/btn-back.jpg" />
                </a>
            </div>
          </div>
        </div>
        <div class="clear"></div>

        <div class="bloger m-b20 clearfix">
              <?php if($activities){?>
                <div class="blogerComment clearfix">
                    <h2>Se hvad der sker</h2>
                    <div class="clear"></div>
                    <?php foreach($activities as $activity){
                        $profile_link = base_url().index_page().'profiles/detail/'.$activity->id.'/'.$activity->name.'.html';
                    ?>
                    <div class="commentItem">
                        <div class="f-l w420">
                            <a href="<?php echo $profile_link;?>">
                                <?php if($activity->avatar){?>
                                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').$activity->avatar.'&q=100&w=29&h=29'; ?>" alt=""/>
                                <?php }else{?>
                                <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_avatar_path').'noavatar'.$activity->gender.'.jpg'.'&q=100&w=29&h=29'; ?>" alt=""/>
                                <?php }?>
                            </a>
                            <p style="margin-left: 32px;"><span class="userName"><a href="<?php echo $profile_link;?>"><?php echo $activity->name?></a></span>
                            <?php 
                            if($activity->type == 1){
                                echo 'har postet <strong>'.$activity->data.'</strong>';
                            } else if($activity->type ==2){
                                echo 'har tilføjet <strong>'.$activity->data.'</strong> billeder';
                            } else if($activity->type == 3){
                                echo 'har købt: <strong>'.$activity->data.'</strong>';
                            } else {
                            }
                            ?>
                            </p>
                        </div>
                        <div class="f-r w100 text-r">
                            <p><?php echo get_time_difference_php($activity->time);?></p>
                        </div>
                    </div>
                    <?php }?>
                    
                </div>
                <div class="bntSeemore m-t10"><a href="javascript:void(0);"><img alt="Se mere" style="vertical-align: inherit;" src="<?php echo base_url(); ?>/assets/frontend/img/seemore.png" /></a></div>
                <input type="hidden" id="offset" value="<?php echo 3;?>" />
                <?php }?>
             
          </div>
      </div>
    </div>
  </div>
  <?php echo modules::run('banner/banner/index'); ?>
  
  </div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/da_DK/all.js#xfbml=1&appId=329684403786353";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<script>
jQuery(document).ready(function(){
	jQuery("#sugarshop_active").addClass('active');
	});
</script>