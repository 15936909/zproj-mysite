<form action="" method="post">
	
	<div class="form-group">
		<label>兑换码：</label>
		<input name="code" value="<?php echo set_value('code'); ?>" placeholder="请输入兑换码">
		<?php echo form_error('code'); ?>
	</div>
	
	<div class="form-group">
		<label>手机号码：</label>
		<input name="cellphone" value="<?php echo set_value('cellphone'); ?>" placeholder="请输入手机号码">
		<?php echo form_error('cellphone'); ?>
	</div>
	
	<div class="form-group">
		<label>确认号码：</label>
		<input name="recellphone" value="<?php echo set_value('recellphone'); ?>" placeholder="请输入确认号码">
		<?php echo form_error('recellphone'); ?>
	</div>
	
	<button class="btn btn-default">兑换</button>
	
</form>