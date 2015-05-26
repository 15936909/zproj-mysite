<a href="<?php echo $listurl; ?>">返回列表</a>

<form action="" method="post">
	
	<div class="form-group">
		<label>优惠券数量：</label>
		<input class="form-control" name="quatity" type="text" value="<?php echo set_value('quatity'); ?>">
		<?php echo form_error('quatity'); ?>
	</div>
	
	<div class="form-group">
		<label>优惠券类型：</label>
		<select class="form-control" name="typeid">
		<?php 
			foreach($coupontypeList as & $item) {
				echo sprintf('<option value="%s" %s >%s</option>', $item['id'], set_select('typeid', $item['id']), $item['name']);
			}
		?>
		</select>
		<?php echo form_error('typeid'); ?>
	</div>
	
	<div class="form-group">
		<label>过期时间：</label>
		<input class="form-control Wdate" name="exptime" type="text" value="<?php echo set_value('exptime'); ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
		<?php echo form_error('exptime'); ?>
	</div>
	
	<button type="submit">添加</button>
	
</form>