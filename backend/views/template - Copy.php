<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administration | Control Panel</title>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/backend/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php
if ($this->session->userdata('admin_status') == FALSE){
	redirect('/admin/');
}
?>
<form action="<?php echo base_url().index_page()."admin/test/"; ?>" method="post">
<?php
    $description = "<b>Cuong $ Kakaka</b>";

    
    $this->ckeditor->config['height'] = 300;
    $this->ckeditor->config['width'] = 700;
	#unset($this->ckeditor->config['height']);
	#unset($this->ckeditor->config['width']);
    #$this->ckeditor->config['toolbar'] = 'Basic';
	unset($this->ckeditor->config['toolbar']);
	$this->ckeditor->editor('content',$description);
?>
<input type="submit">
</form>
</body>
</html>