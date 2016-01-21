<?php echo form_open('user/logins', array('name'=>'loginForm'))?>
    <fieldset>
        <h4>Log in</h4>
        <div style="margin-bottom:10px;">
            <label>E-mail</label>
            <input type="text" name="email" class="input"/>
        </div>
        <div style="margin-bottom:10px;">
            <label>Kodeord</label>
            <input type="password" name="password" class="input"/>
        </div>
        <input type="submit" class="bntLogin" style="border:none; cursor:pointer;" />
        <!--<a class="bntLogin" href="profile-owner2.html">Log in</a>-->
        <div style="margin-bottom:10px;">
            <p><a href="<?php echo base_url().index_page(); ?>user/forgotpassword.html">Glemt Login?</a></p>
        </div>
    </fieldset>
</form>
<span style="color:#999999; font-size:13px;"><?php echo $this->session->flashdata('message') ? $this->session->flashdata('message') : '';?></span>