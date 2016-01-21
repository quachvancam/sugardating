<div class="filler">
    <h2>Sugardating flirter .. </h2>
    <ul>
        <?php $i = 1; foreach($articles as $article){
            $link = base_url().index_page().'articles/view/'.$article->id.'/'.$article->alias.'.html';
        ?>
        <li>
            <img src="<?php echo base_url(); ?>assets/frontend/img/iconNumer<?php echo $i;?>.png" alt="Number"/>
            <a href="<?php echo $link;?>">
                <h4><?php echo $article->title?></h4>
                <div style="padding-left: 45px;"><?php echo $article->short_content;?></div>
            </a>
        </li>
        <?php $i++;}?>
    </ul>
</div>