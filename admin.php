<?php

// 设置自身文件全名
define('Z_SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// 设置自身文件目录路径
define('Z_FCPATH', dirname(__FILE__) . '/');

// 设置应用程序目录
if(isset($_GET['a']) && preg_match('/^[a-z]+$/i', $_GET['a']) && is_dir(Z_FCPATH . $_GET['a']))
{
	define('Z_APP_DIR', $_GET['a']);
}
else
{
	define('Z_APP_DIR', 'z_coresite');
}

// 设置应用程序目录路径
define('Z_APPPATH', Z_FCPATH . Z_APP_DIR . DIRECTORY_SEPARATOR);

// 设置后台管理视图目录
define('Z_VIEW_DIR', Z_APPPATH . 'views/admin');

// 设置后台管理标记
define('Z_IS_ADMIN', TRUE);

// 设置应用程序目录名
$_GET['d'] = 'admin';
$_GET['c'] = isset($_GET['c']) ? $_GET['c'] : 'home';
$_GET['m'] = isset($_GET['m']) ? $_GET['m'] : 'index';

require('index.php');
