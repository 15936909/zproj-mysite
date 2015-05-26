<a href="<?php echo zUrl('admin/couponexchangelog/export', $filter); ?>">导出</a>

<form action="" method="get">
	<input name="c" type="hidden" value="couponexchangelog">
	<input name="m" type="hidden" value="index">
	<label>兑换码：</label>
	<input name="f[code]" value="<?php echo $filter['code']; ?>">
	<label>类型：</label>
	<select name="f[typeid]">
		<?php 
			foreach($coupontypeList as & $item)
			{
				echo sprintf('<option value="%s" %s >%s</option>', $item['id'], set_select('coupon', $item['id'], $item['id'] == $filter['typeid']), $item['name']);
			}
		?>
	</select>
	<label>兑换时间：</label>
	<input class="Wdate" name="f[laddtime]" value="<?php echo $filter['laddtime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<span>-</span>
	<input class="Wdate" name="f[raddtime]" value="<?php echo $filter['raddtime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<input name="search" type="submit" value="搜索">
</form>

<form action="" method="post">
	
	<table style="width: 100%">
		<tr>
			<td>编号</td>
			<td>手机号码</td>
			<td>兑奖码</td>
			<td>兑奖券类型</td>
			<td>兑奖时间</td>
		</tr>
		<?php 
			foreach ($couponexchangelogList as & $item)
			{
		?>
		<tr>
			<td>
				<?php echo $item['id']; ?>
			</td>
			<td>
				<?php echo $item['cellphone']; ?>
			</td>
			<td>
				<?php echo $item['code']; ?>
			</td>
			<td>
				<?php echo $item['typename']; ?>
			</td>
			<td>
				<?php echo date('Y-m-d H:i:s', $item['addtime']); ?>
			</td>
		</tr>
		<?php 
			}
		?>
	</table>
	
</form>

<?php echo $pagination; ?>