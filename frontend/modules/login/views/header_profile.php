<div class="login"><span class="iLogin"><a class="noDisplay" href="javascript:void(0);">Log in</a><a href="<?php echo base_url().index_page(); ?>user/logout.html">Log ud</a></span></div>
<?php if($B2B){?>
<div class="login">
    <span class="iLogin">
        <a href="<?php echo base_url().index_page(); ?>b2b/index.html">B2B</a>
    </span>
</div>
<div class="login">
    <span class="iLogin">
        <a href="javascript:void(0);"><?php if(!isB2b()) echo $user->name; else echo $user->company;?></a>
    </span>
</div>
<?php }else{?>
<div class="login">
    <span class="iLogin">
        <a class="noDisplay" href="javascript:void(0);">Log in</a>
        <a href="<?php echo base_url().index_page(); ?>sugarshop/mydeal.html">Mine deals </a>
    </span>
</div>
<div class="login">
    <span class="iLogin">
        <a href="javascript:void(0);" class="noDisplay">Log in</a>
        <a href="<?php echo base_url().index_page().'user/owner.html';?>"><?php echo $user->name;?></a>
    </span>
</div>
<?php }?>