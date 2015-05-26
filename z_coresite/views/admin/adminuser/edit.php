<a href="<?php echo $listurl; ?>">返回列表</a>

<form action="" method="post">
	<table>
		<tr>
			<td>登录账号：</td>
			<td>
				<input name="username" type="text" value="<?php echo set_value('username', $adminuser['username']); ?>">
				<?php echo form_error('username'); ?>
			</td>
		</tr>
		<tr>
			<td>登录密码：</td>
			<td>
				<input name="password" type="password" value="">
				<?php echo form_error('password'); ?>
			</td>
		</tr>
		<tr>
			<td>管理员名：</td>
			<td>
				<input name="realname" type="text" value="<?php echo set_value('realname', $adminuser['realname']); ?>">
				<?php echo form_error('realname'); ?>
			</td>
		</tr>
		<tr>
			<td>管理员组：</td>
			<td>
				<select name="groupid">
				<?php 
					foreach($admingroupList as & $item) {
						echo sprintf('<option value="%s" %s >%s</option>', $item['id'], set_select('groupid', $item['id'], $item['id'] == $adminuser['groupid']), $item['name']);
					}
				?>
				</select>
				<?php echo form_error('groupid'); ?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><button type="submit">修改</button></td>
		</tr>
	</table>
</form>