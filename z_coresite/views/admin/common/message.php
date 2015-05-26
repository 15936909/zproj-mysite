<div class="messagebox">
	
	<h4 class="title">提示信息</h4>
	
	<div class="content">
		<p><?php echo $message; ?></p>
	</div>
	
	<div class=footer>
		<?php if($auto): ?>
		<script>
        function redirect($url)
        {
            location = $url;
        }
        setTimeout("redirect('<?php echo $goto; ?>');", 3000);
        </script>
        <a href="<?php echo $goto; ?>">
        	<?php echo "页面正在自动转向，你也可以点此直接跳转！"; ?>
        </a>
		<?php endif; ?>
	</div>
	
</div>