<a href="<?php echo zUrl('admin/coupon/add', array('listurl' => $listurl)); ?>">添加</a>
<a href="<?php echo zUrl('admin/coupon/export', $filter); ?>">导出</a>

<form action="" method="get">
	<input name="c" type="hidden" value="coupon">
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
	<label>创建时间：</label>
	<input class="Wdate" name="f[laddtime]" value="<?php echo $filter['laddtime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<span>-</span>
	<input class="Wdate" name="f[raddtime]" value="<?php echo $filter['raddtime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<label>到期时间：</label>
	<input class="Wdate" name="f[lexptime]" value="<?php echo $filter['lexptime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<span>-</span>
	<input class="Wdate" name="f[rexptime]" value="<?php echo $filter['rexptime']; ?>" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'});">
	<input name="search" type="submit" value="搜索">
</form>

<form action="" method="post">
	
	<table class="table table-striped">
		<?php 
			foreach ($couponList as & $item)
			{
		?>
		<tr>
			<td>
				<label>
					<input name="ids[]" type="checkbox" value="<?php echo $item['id']; ?>">
					<span><?php echo $item['id']; ?></span>
				</label>
			</td>
			<td>
				<?php echo $item['code']; ?>
			</td>
			<td>
				<?php echo $item['typename']; ?>
			</td>
			<td>
				<?php echo $item['status'] ? '已兑换' : '未兑换'; ?>
			</td>
			<td>
				<?php echo date('Y-m-d H:i:s', $item['addtime']); ?>
			</td>
			<td>
				<?php echo date('Y-m-d H:i:s', $item['exptime']); ?>
			</td>
			<td>
				<a href="<?php echo zUrl('admin/coupon/edit', array('id' => $item['id'], 'listurl' => $listurl)); ?>">编辑</a>
				<a href="<?php echo zUrl('admin/coupon/del', array('id' => $item['id'], 'listurl' => $listurl)); ?>">删除</a>
			</td>
		</tr>
		<?php 
			}
		?>
	</table>
	
	<div>
		<label>
			<input type="checkbox" onchange="zAdminListCheckAll(this.checked, 'ids[]');">
			<span>全选</span>
		</label>
		<select name="act">
			<option value="del">删除</option>
		</select>
		<input name="batch" type="submit" value="处理">
	</div>
	
</form>

<?php echo $pagination; ?>