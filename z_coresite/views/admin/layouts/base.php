<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理平台</title>
    <link rel="stylesheet" href="<?php echo zStaticUrl('css/bs/css/bootstrap.css'); ?>" />
	<link rel="stylesheet" href="<?php echo zStaticUrl('css/bs/css/bootstrap-responsive.css'); ?>" />
	<link rel="stylesheet" href="<?php echo zStaticUrl('css/admin.css'); ?>" />
	<script type="text/javascript" src="<?php echo zStaticUrl('js/lib/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?php echo zStaticUrl('js/My97DatePicker/WdatePicker.js')?>"></script>
    <script type="text/javascript" src="<?php echo zStaticUrl('js/admin.js')?>"></script>
</head>
<body>
	
	<div class="container-fluid">
		
		<?php echo $contents; ?>
	
	</div>
	
</body>
</html>