<div class="myCart">
    <div class="titleGray2 clearfix">
        <h3>Min indkøbs kurv</h3>
        <div class="w168 f-l">valgt</div>
        <div class="w65 f-l">stk</div>
        <div class="w65 f-l">sugar</div>
        <div class="w65 f-l">pris</div>
    </div>
    <?php if($cart){ foreach($cart as $rows){?>
    <div class="clearfix bor-b2 p10">
        <div class="w168 f-l"><a href="<?php echo base_url().index_page(); ?>sugarshop/detail/<?php echo $rows['id']."/".seo_url($rows['name']);?>.html">
            <img class="m-l10" src="<?php echo base_url(); ?>thumbnail/timthumb.php?src=<?php echo base_url(); ?>upload/deal/<?php echo $rows['image']; ?>&h=39&w=39&q=100" alt=""/>
        </a>
            <p><?php echo $rows['name'];?></p>
        </div>
        <div class="w65 f-l"><?php echo $rows['qty'];?></div>
        <div class="w65 f-l"><?php echo priceFormat($rows['price']);?></div>
        <div class="w65 f-l"><?php echo priceFormat($rows['qty']*$rows['price']);?></div>
    </div>
    <?php }}else{?>
        <div class="clearfix bor-b2 p10">
            Din Indkøbsvogn er tom
        </div>
    <?php }?>
    <div class="clearfix text-r">
        <div class="f-l m-l85">
            <h4>Pris ialt</h4>
        </div>
        <div class="f-r p-r20 m-b20">
            <h4><?php echo priceFormat($tatal);?></h4>
        </div>
    </div>
</div>