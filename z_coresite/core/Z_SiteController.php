<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 网站控制器
 */
class Z_SiteController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		self::_init();
	}

	/**
	 * 初始化
	 */
	private function _init()
	{
		$this->load->database();
	}

	/**
	 * 显示信息
	 *
	 * @param string $message
	 * @param string $goto
	 * @param string $auto
	 * @param string $fix
	 */
	public function showMessage($message, $goto = '', $auto = TRUE)
	{
		if($goto == '')
		{
			$goto = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : site_url('?c=adminuser&m=index');
		}
		else
		{
			$goto = strpos($goto, 'http') !== false ? $goto : site_url($goto);
		}
		
		$viewData['message'] = $message;
		$viewData['goto'] = $goto;
		$viewData['auto'] = $auto;
		
		$template = $this->template->load('site/common/base.php', 'site/common/message.php', $viewData, TRUE);
		exit($template);
	}
}