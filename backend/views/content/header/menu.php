<div class="nav-admin">
	<ul>
        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/backend/img/iconSystem.png" alt=""/>System</a>
			<ul class="sub-nav-admin">
				<li><a href="<?php echo base_url().index_page(); ?>config.html">Config</a></li>
                <li><a href="<?php echo base_url().index_page(); ?>mail.html">Mail templates</a></li>
			</ul>
		</li>
		<li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/backend/img/iconUser.png" alt=""/>User</a>
			<ul class="sub-nav-admin">
				<li><a href="<?php echo base_url().index_page(); ?>admin_user.html">Admin</a></li>
				<li><a href="<?php echo base_url().index_page(); ?>b2b_user.html">B2B User</a></li>
                <li><a href="<?php echo base_url().index_page(); ?>user.html">User</a></li>
			</ul>
		</li>
       	<li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/backend/img/iconShop.png" alt=""/>Shop</a>
            <ul class="sub-nav-admin">
				<li><a href="<?php echo base_url().index_page(); ?>deal_category.html">Categories</a></li>
				<li><a href="<?php echo base_url().index_page(); ?>deal.html">Deals</a></li>
			</ul>
        </li>
        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/backend/img/iconOrder.png" alt=""/>Order</a>
            <ul class="sub-nav-admin">
				<li><a href="<?php echo base_url().index_page(); ?>order.html">Order</a></li>
				<li><a href="<?php echo base_url().index_page(); ?>b2b.html">B2B</a></li>
			</ul>
        </li>
        <li><a href="javascript:void(0);"><img src="<?php echo base_url(); ?>assets/backend/img/iconArticle.png" alt=""/>Articles</a>
        	<ul class="sub-nav-admin">
				<li><a href="<?php echo base_url().index_page(); ?>category.html">Categories</a></li>
				<li><a href="<?php echo base_url().index_page(); ?>article.html">Articles</a></li>
			</ul>
        </li>  		
        <li><a href="<?php echo base_url().index_page(); ?>banner.html"><img src="<?php echo base_url(); ?>assets/backend/img/iconBanner.png" alt=""/>Banner</a>
        </li>
        <li><a href="<?php echo base_url().index_page(); ?>slideshow.html"><img src="<?php echo base_url(); ?>assets/backend/img/iconSlideshow.png" alt=""/>Slideshow</a>
        </li>
  	</ul>
    <style>
        .linklink a:hover{text-decoration: underline;}
    </style>
    <span class="linklink" style="float:right; line-height:30px; margin-right:20px; font-weight:bold;"><a target="_blank" href="<?php echo base_url(); ?>">View Site</a></span>
    <span class="linklink" style="float:right; line-height:30px; margin-right:20px; font-weight:bold;"><a href="<?php echo base_url().index_page(); ?>admin/logout.html">Logout</a></span>
    <span class="linklink" style="float:right; line-height:30px; margin-right:20px; font-weight:bold;">Welcome <?php echo $this->session->userdata('name');?></span>
    
</div>