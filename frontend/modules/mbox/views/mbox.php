<div class="mainBox clearfix">
    <div class="f-l p5 bor-r">
        <div class="f-l"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/iconMysugar.png"/>
            <p class="numlarg"><?php echo count($sugars);?></p>
        </div>
        <div class="f-r">
            <ul class="list-frame">
                <?php $i=1; foreach($sugars as $sugar){?>
                <li>
                <a style="cursor: pointer;" class="tooltip" href="<?php echo base_url().index_page();?>sugarshop/detail/<?php echo $sugar->id;?>/<?php echo $sugar->alias;?>.html">
                    <span><?php echo $sugar->name;?></span>
                    <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_deal_path').$sugar->image1.'&q=100&w=35&h=35'; ?>" alt=""/>
                </a>
                </li>
                <?php $i++; }?>
                <?php if($i<12){ for($i; $i<13; $i++){?>
                <li></li>
                <?php }}?>
            </ul>
        </div>
    </div>
    <div class="f-r p5 pl-10">
        <div class="f-l"><img alt="" src="<?php echo base_url(); ?>/assets/frontend/img/iconMysweet.png"/>
            <p class="numlarg"><?php echo count($sweets);?></p>
        </div>
        <div class="f-r">
            <ul class="list-frame">
                <?php $j=1; foreach($sweets as $sweet){?>
                <li>
                <a style="cursor: pointer;" class="tooltip" href="<?php echo base_url().index_page();?>sugarshop/detail/<?php echo $sweet->id;?>/<?php echo $sweet->alias;?>.html">
                    <span><?php echo $sweet->name;?></span>
                    <img src="<?php echo base_url().'thumbnail/timthumb.php?src='.base_url().get_config_value('upload_deal_path').$sweet->image1.'&q=100&w=35&h=35'; ?>" alt=""/>
                </a>
                </li>
                <?php $j++; }?>
                <?php if($j<12){ for($j; $j<13; $j++){?>
                <li></li>
                <?php }}?>
            </ul>
        </div>
    </div>
</div>