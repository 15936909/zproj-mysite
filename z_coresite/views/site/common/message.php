<div style="margin:100px auto; width:400px; padding:10px; border:solid 1px #ddd;">
	<table width="400px" cellpadding="5" align="center" >
        <thead>
            <tr>
            	<th>提示信息</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                   	<div align="center">
						<br />
                        <div style="color:red;font-weight:bold"><?php echo $message; ?></div>
                        <br />
                        <br />
                        <br />
                        <br />
                        <?php if($auto): ?>
                        <script>
                            function redirect($url)
                            {
                                location = $url;	
                            }
                            setTimeout("redirect('<?php echo $goto; ?>');", 3000);
                        </script>
                        <a href="<?php echo $goto; ?>" style="text-decoration:underline"><?php echo "页面正在自动转向，你也可以点此直接跳转！"; ?></a>
                        <br />
                        <br />
                        <br />
                        <br />
                        <?php endif; ?>
                	</div>
                </td>
            </tr>
        </tbody>
    </table>
</div>