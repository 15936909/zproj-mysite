<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>管理平台</title>
    <link rel="stylesheet" href="<?php echo zStaticUrl('css/bs/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo zStaticUrl('css/font-awesome/css/font-awesome.css'); ?>" />
    <link rel="stylesheet" href="<?php echo zStaticUrl('css/common.css'); ?>">
    <link rel="stylesheet" href="<?php echo zStaticUrl('css/admin.css'); ?>">
    <script type="text/javascript" src="<?php echo zStaticUrl('js/My97DatePicker/WdatePicker.js')?>"></script>
    <script type="text/javascript" src="<?php echo zStaticUrl('js/admin.js')?>"></script>
</head>
<body>

	<div class="wrapper login">
	
		<div class="loginbox">
			
			<h2>后台管理中心</h2>
			<form action="<?php echo zUrl('admin/login/index', array('backurl' => $backurl)); ?>" method="post" class="form-validate">
				<div class="control-group">
					<input class="form-control" name="username" id="username" type="text" placeholder="账号">
					<?php echo form_error('username'); ?>
				</div>
				<div class="control-group">
					<input class="form-control" name="password" id="password" type="password" placeholder="密码">
					<?php echo form_error('password'); ?>
				</div>
				<div class="submit">
					<button type="submit" class="btn btn-primary">登录</button>
				</div>
			</form>
			
		</div>
		
	</div>

</body>
</html>