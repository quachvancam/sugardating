<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <ul class="breakcum">
            <li><a href="">Start</a></li>
            <li><a href="<?php echo base_url().index_page();?>user/register.html">Oprettet sugar medlemskab</a></li>
        </ul>
        <div class="f-step clear" style="min-height: 400px;">
            <h2><?php echo $article->title;?></h2>
            <div class="clear"></div>
            <p class="contentStep"><?php echo strip_tags($article->short_content);?></p>
            <a href="<?php echo base_url().index_page();?>user/auto_login.html" class="bntgotologin f-l">Auto login</a> 
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
    <div class="clear"></div>
</div>