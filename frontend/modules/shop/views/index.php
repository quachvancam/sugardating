<script type="text/javascript">
jQuery(document).ready( function(){
jQuery("#slideshop").carouFredSel({
		auto			: false,
		items	: 4,
		scroll	: {
			items			: 2,
			duration		: 1000,
			timeoutDuration	: 2000
		},
		prev			:'#foo5_prev',
		next			:'#foo5_next'
	});
});
</script>
<div class="sugarShop bgContent clearfix mt0">
    <h2>Sugar shop</h2>
    <div class="bannerSS m-t10">
    <div class="html_carousel2">
      <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; width: 940px; height: 287px; margin: 0px; overflow: hidden;">
      <div id="foo2" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 2820px; height: 287px;">
        <?php if($deals){ if($deals[0]){?>
        <div class="slide">
            <a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $deals[0]->id."/".seo_url($deals[0]->name);?>.html">
                <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $deals[0]->image1; ?>&h=288&w=759&q=80" alt="<?php echo $deals[0]->name; ?>" />
            </a>
          <div>
            <h1><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $deals[0]->id."/".seo_url($deals[0]->name);?>.html"><?php echo $deals[0]->name;?></a></h1>
            <div class="slideR">
                <div style="top:0px; height:200px;">
                    <p style="font-size:15px;"><?php echo $deals[0]->title;?></p><br />
                    <?php echo implode(' ', array_slice(explode(' ', strip_tags($deals[0]->description)), 0, 40)).' ...';?>
                </div>
                <div style="top: 208px;">
                <a href="<?php echo base_url().index_page(); ?>sugarshop/index.html" class="bntOpenshop">Åbn Sugar Shoppen</a>
                </div>
            </div>
          </div>
        </div>
        <?php }}else{?>
        <div style="padding: 20px 0;">
            <p>Ingen resultater</p>
        </div>
        <?php }?>
      </div>
      </div>
    </div>
    </div>
    <ul id="slideshop" class="listPro clearfix">
        <?php if($deals){ $i = 1; foreach($deals as $rows){ if($rows->end_date>time()){?>
        <li style="position: relative;">
            <span style="padding: 4px; position: absolute; right: 0; top: 89px; background: #0B0505;color: #999999;font-size:11px;">Antal vouchers <?php echo $rows->quantity;?></span>
        
            <div class="mainImg">
                <a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows->id."/".seo_url($rows->name);?>.html">
                    <img src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows->image1; ?>&h=113&w=220&q=80" alt=""/>
                </a>
            </div>
            <p class="titlePro"><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows->id."/".seo_url($rows->name);?>.html"><?php echo $rows->name;?></a></p>
            <div class="contentPro clearfix">
            <div class="contentPro-l f-l"> <span class="values">Værdi</span> <span class="price"><?php echo $rows->old_price;?>, - </span> </div>

            <div class="contentPro-r f-r"> <span class="values">Sugar medlems pris</span> <span class="price2"><?php echo $rows->new_price;?>, -</span> </div>

            </div>
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
        <?php }}}?>
    </ul>
    <div class="clear" style="height: 10px;">&nbsp;</div>
    <a id="foo5_next" class="bntNext" href="javascript:void(0);">Næste <span class="red"> &gt; </span></a>
    <a id="foo5_prev" class="bntPev" href="javascript:void(0);"><span class="red"> &lt; </span> Tilbage</a>
    <div class="clear"></div>
</div>