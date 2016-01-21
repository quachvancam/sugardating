<link href="<?php echo base_url(); ?>assets/backend/upload/css/style.css" rel="stylesheet" />
<div class="clearfix bgContent m-t-3" id="sugarDates">
    <div class="contentLeft">
        <div class="col-profil clearfix"> <?php echo modules::run('own/own/left_content'); ?> </div>
        <div class="infoProfil clearfix">
            <div class="photoGallery">
                <h2>Tilføj billeder</h2>
                <div class="clear"></div>
                <div id="w-mainGallery" style="margin-top:20px;">
                    <?php echo form_open('user/ajax_save_photo', array('id'=>'upload', 'enctype'=>'multipart/form-data', 'method'=>'post'))?>
                        <div id="drop">
                            Drop Her
                            <a>Gennemse</a>
                            <input type="file" name="upl" multiple=""/>
                        </div>
                        <ul>
                            <!-- The file uploads will be shown here -->
                        </ul>
                    </form>
                    <div style="padding-top: 10px;">
                        <a class="viewphoto" href="<?php echo base_url().index_page();?>user/photo.html">Se mine billeder</a>
                    </div>
                    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.knob.js"></script>
                    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.ui.widget.js"></script>
                    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.iframe-transport.js"></script>
                    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.fileupload.js"></script>
                    <script src="<?php echo base_url(); ?>assets/backend/upload/js/script.js"></script>
                </div>
            </div> 
        </div>
    </div>
    <?php echo modules::run('banner/banner/index'); ?> 
</div>