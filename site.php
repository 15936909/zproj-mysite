<?php

// 设置自身文件全名
define('Z_SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// 设置自身文件目录路径
define('Z_FCPATH', dirname(__FILE__) . '/');

// 设置应用目录
if(isset($_GET['a']) && preg_match('/^[a-z]+$/i', $_GET['a']) && is_dir(Z_FCPATH . $_GET['a']))
{
	define('Z_APP_DIR', $_GET['a']);
}
else
{
	define('Z_APP_DIR', 'z_coresite');
}

// 设置应用目录路径
define('Z_APPPATH', Z_FCPATH . Z_APP_DIR . DIRECTORY_SEPARATOR);

// 设置应用视图目录
define('Z_VIEW_DIR', Z_APPPATH . 'views/site');

// 取消后台管理标记
define('Z_IS_ADMIN', FALSE);

// 设置应用目录名
$_GET['d'] = 'site';
$_GET['c'] = isset($_GET['c']) ? $_GET['c'] : 'coupon';
$_GET['m'] = isset($_GET['m']) ? $_GET['m'] : 'exchange';
