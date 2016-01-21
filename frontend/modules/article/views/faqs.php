<div class="fqa">
    <h2>FAQ</h2>
    <ul>
        <?php foreach($faqs as $faq){?>
        <li><a href="<?php echo base_url().index_page(); ?>faq.html">- <?php echo $faq->title;?></a></li>
        <?php }?>
    </ul>
    <a class="bntQuestion" href="<?php echo base_url().index_page(); ?>faq.html">Spørgsmål ?</a>
</div>