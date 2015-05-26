<a href="<?php echo zUrl('admin/adminuser/add', array('listurl' => $listurl)); ?>">添加</a>

<form action="" method="get">
	<input name="c" type="hidden" value="adminuser">
	<input name="m" type="hidden" value="index">
	<label>管理员名：</label>
	<input name="f[realname]" value="<?php echo $filter['realname']; ?>">
	<label>管理员组：</label>
	<select name="f[groupid]">
		<option value="">所有管理组</option>
		<?php 
			foreach($admingroupList as & $item)
			{
				echo sprintf('<option value="%s" %s >%s</option>', $item['id'], set_select('groupid', $item['id'], $item['id'] == $filter['groupid']), $item['name']);
			}
		?>
	</select>
	<input name="search" type="submit" value="搜索">
</form>

<form action="" method="post">
	
	<table class="table table-striped">
		<?php 
			foreach ($adminuserList as & $item)
			{
		?>
		<tr>
			<td>
				<input name="ids[]" type="checkbox" value="<?php echo $item['id']; ?>">
			</td>
			<td>
				<?php echo $item['realname']; ?>
			</td>
			<td>
				<?php
					if(isset($admingroupList[$item['groupid']]))
					{
						echo $admingroupList[$item['groupid']]['name'];
					}
				?>
			</td>
			<td>
				<a href="<?php echo zUrl('admin/adminuser/edit', array('id' => $item['id'], 'listurl' => $listurl)); ?>">编辑</a>
				<a href="<?php echo zUrl('admin/adminuser/del', array('id' => $item['id'], 'listurl' => $listurl)); ?>">删除</a>
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