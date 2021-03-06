<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js"></script>
<div class="clearfix bgContent" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil">
            <?php echo modules::run('own/own/left_content'); ?>
        </div>
        <div class="info-profil">
            <div class="clearfix"></div>
            <?php echo form_open('user/add_blog', array('class'=>'frm-profil', 'enctype'=>'multipart/form-data'))?>
                <fieldset>
                    <div class="txt-250">
                        <label>Blog titel</label>
                        <input type="text" class="input-profil" name="title" style="width:500px;"/>
                    </div>
                    <div class="clearfix"></div>
                    <div class="txt-250">
                        <label>Billede</label>
                        <input type="file" name="image" id="image" style="margin-bottom:10px; height:26px; background:none !important;" />
                    </div>
                    <div class="clearfix">
                        <label>Indhold</label>
                        <div class="input-profil w510" style="background:none; border:none;">
                        <?php
                            $this->ckeditor->config['height'] = 200;
                            $this->ckeditor->config['width'] = 500;
                            $this->ckeditor->config['toolbar'] = 'Basic';
                            $this->ckeditor->editor('content');
                        ?>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <a href="javascript:history.back()" class="bntNext n-mt" style="float:left;"><span class="red">&lt; </span> Tilbage </a>
                    <input class="f-r btn-postmsg" type="submit"/>
                    
                </fieldset>
            </form>
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?>
    <div class="clearfix"></div>
</div>