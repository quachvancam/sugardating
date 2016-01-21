<div id="sugarDates" class="clearfix bgContent m-t-3">
  <div class="contentLeft">
   <ul class="breakcum">
   	<li><a href="<?php echo base_url(); ?>">Start</a></li>
    <li><a href="<?php echo base_url().index_page(); ?>sugarshop/index.html">Sugar shop</a></li>
   </ul>
  <div class="featuredItem">
    <h2>Sugar shop</h2>
    <div class="clear"></div>
    <div class="bannerSS2 m-t10 m-b20">
    <div class="html_carousel2">
      <div id="foo2">
        <?php if($deals){?>
        <div class="slide">
        <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals[0]->image1; ?>&h=288&w=545&q=100" alt="Image" />
          <div>
            <h2><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $deals[0]->id."/".seo_url($deals[0]->name);?>.html"><?php echo $deals[0]->name;?></a></h2>
            <div class="slideR2" style="height: 270px;">
                <p style="font-size:15px;"><?php echo $deals[0]->title;?></p><br />
                <?php echo implode(' ', array_slice(explode(' ', strip_tags($deals[0]->description)), 0, 40)).' ...';?>
            </div>
          </div>
        </div>
        <?php }else{?>
            Der er ingen produkt, der matcher søgekriterierne.
        <?php }?>
      </div>
      <!--foo2-->
    </div>
    <!--.html_carousel2-->
  </div>
  <!--bannerSS-->
  </div><!--.featuredItem-->

  <div class="cate">
    <h2>Nyeste idéer til din date</h2>
    <div class="f-r">
      <div id="search2" style="position: relative;">
        <?php echo form_open('sugarshop/searchname', array('id'=>'searchname'));?>
          <input class="txt" type="text" name="name" value="Indtast søgeord" />
          <input class="bt" type="image" src="<?php echo base_url(); ?>assets/frontend/img/iconFindsmall.png" name="submit" value="" />
        </form>
      </div>
    </div>
    <div class="clear"></div>
    <div class="topCate">
      <label style="float: left;">Kategori</label>
      <script>
        function submitsearchcategory(){
            $( "#searchcategory" ).submit();
        }
      </script>
      <?php echo form_open('sugarshop/searchcategory', array('id'=>'searchcategory', 'name'=>'searchcategory'))?>
          <select name="dealcategory" id="dealcategory" onchange="submitsearchcategory();">
            <option class="movie" value="alle">Alle</option>
            <?php if($dealcategorys){ foreach($dealcategorys as $row){ ?>
            <option class="movie" value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
            <?php }}?>
          </select>
      </form>
      <div style="clear: both;"></div>
    </div><!--.topCate-->
    
    <script type="text/javascript">
        function addWishlist(user,deal){
            $.ajax({
            	type: 'post',
            	url: '<?php echo base_url().index_page();?>sugarshop/wishlist.html',
                data: {user: user, deal: deal,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' },
            	success:function (result){
                    $("#wishlist_"+deal).removeClass("wishlist-off");
                    $("#wishlist_"+deal).removeAttr("onclick");
                    $("#wishlist_"+deal).addClass("wishlist-on");
            	}			
            });
        }
    </script>
    <ul class="listCate m-t20 clearfix">
    <?php 
    if($deals){ 
    $i = 1; $j=0;
    foreach($deals as $rows){
    if($rows->end_date>time()){
        if($wishlist){
            if($wishlist[$j]['id']>0){
                $check = 1;
            }
            else{
                $check = 0;
            }
        }
        else{
            $check = 0;
        }
    ?>
    <?php echo form_open('cart/insert', array('id'=>'pro_'.$rows->id))?>
    <li <?php if($i%3==0){echo 'class="end"';}?> >

        <a id="wishlist_<?php echo $rows->id;?>" href="javascript:void(0);" <?php if($user){?> <?php if(!$check){?> onclick="addWishlist('<?php echo $user->id;?>','<?php echo $rows->id;?>');" <?php }}else{?> data-reveal-id="f-errorPage" <?php }?> class="wishlist-<?php if($check){echo "on";}else{echo "off";}?> tooltip" style="cursor: pointer;"><span>Tilføj til min ønskeliste</span></a>
        <span style="padding: 4px; position: absolute; right: 0; top: 89px; background: #0B0505;color: #999999;font-size:11px;">Antal vouchers <?php echo $rows->quantity;?></span>
        
        <div class="mainImg"> 
        <a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows->id."/".seo_url($rows->name);?>.html">
            <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows->image1; ?>&h=113&w=220&q=100" alt=""/>
        </a>
        </div>
        <!--.mainImg-->
        <p class="titlePro"><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows->id."/".seo_url($rows->name);?>.html"><?php echo $rows->name;?></a></p>
        <div class="contentPro clearfix">
            <div class="contentPro-l f-l"> <span class="values">Værdi</span> <span class="price"><?php echo $rows->old_price;?>, - </span> </div>
            <!--.contentPro-l-->
            <div class="contentPro-r f-r"> <span class="values">Sugar medlems pris</span> <span class="price2"><?php echo $rows->new_price;?>, -</span> </div>
            <!--.contentPro-r-->
        </div>
        <!--.contentPro-->
        <input type="hidden" name="id_<?php echo $rows->id;?>" id="id_<?php echo $rows->id;?>" value="<?php echo $rows->id;?>" />
        <input type="hidden" name="name_<?php echo $rows->id;?>" id="name_<?php echo $rows->id;?>" value="<?php echo $rows->name;?>" />
        <input type="hidden" name="qty_<?php echo $rows->id;?>" id="qty_<?php echo $rows->id;?>" value="1" />
        <input type="hidden" name="price_<?php echo $rows->id;?>" id="price_<?php echo $rows->id;?>" value="<?php echo $rows->new_price;?>" />
        
        <?php if($rows->quantity > $rows->quantitybuy){?>
            <a class="bntAddcart" data-reveal-id="f-cart" onclick="AddToCart('<?php echo $rows->id;?>');" href="javascript:void(0);">Læg i kurv</a>
            <?php /* if($user){?>
            <a class="bntGivegif" data-reveal-id="f-givagave" onclick="addGiftID('<?php echo $rows->id;?>');" href="javascript:void(0);">Giv i gave</a>
            <?php }else{?>
                <a class="bntGivegif" data-reveal-id="f-errorPage" href="javascript:void(0);">Giv i gave</a>
            <?php }*/?>
        <?php }else{?>
        <a class="bntAddcart2" href="javascript:void(0);">Læg i kurv</a>
        <!--a style="margin: 0;padding-top:5px;height:30px; float:left;" href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/frontend/img/bntGivegif_disable.png" /></a-->
        <?php }?>
    </li>
    </form>
    <?php $i++;$j++; }}}?>
    </ul>
    <?php
    if($links){
        echo $links;
    }
    else{
        echo "<div class='pagging clear'>&nbsp;</div>";
    }  
    ?>
  <!--.pagging-->
  </div><!--cate-->
  </div><!--contentLeft-->
    <?php echo modules::run('banner/banner/index'); ?>
  <!--adsRight-->
  <div class="clear"></div>
</div>
<script>
jQuery(document).ready(function(){
	jQuery("#sugarshop_active").addClass('active');
	});
</script>