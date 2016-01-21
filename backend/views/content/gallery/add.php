<script language="javascript" src="<?php echo base_url(); ?>assets/backend/js/common.js"></script>
<link href="<?php echo base_url(); ?>assets/backend/upload/css/style.css" rel="stylesheet" />
<div class="admin-cnt">
	<div class="btn-admin f-r">
       <!--<a href="javascript:submitButton();"><img src="<?php echo base_url(); ?>assets/backend/img/btn-save.jpg" alt=""/></a>-->
       <a href="<?php echo base_url().index_page(); ?>gallery/close/<?php echo $this->uri->segment(3);?>.html"><img src="<?php echo base_url(); ?>assets/backend/img/btn-close.jpg" alt=""/></a>
    </div>
    <div class="f-l title-ad"><?php echo $title;?></div>
    <div class="clearfix"></div>
	<?php echo show_message($this->session->flashdata('message'));?>
    <form id="upload" method="post" action="<?php echo base_url().index_page(); ?>gallery/ajax_save/<?php echo $this->uri->segment(3);?>.html" enctype="multipart/form-data">
        <div id="drop">
            Drop Here
            <a>Browse</a>
            <input type="file" name="upl" multiple />
        </div>
        <ul>
            <!-- The file uploads will be shown here -->
        </ul>
    </form>
	<script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.knob.js"></script>

    <!-- jQuery File Upload Dependencies -->
    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.ui.widget.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.iframe-transport.js"></script>
    <script src="<?php echo base_url(); ?>assets/backend/upload/js/jquery.fileupload.js"></script>
    
    <!-- Our main JS file -->
    <script src="<?php echo base_url(); ?>assets/backend/upload/js/script.js"></script>
</div>