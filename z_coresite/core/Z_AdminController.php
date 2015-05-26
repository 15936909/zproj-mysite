<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 管理控制器
 */
class Z_AdminController extends CI_Controller
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
		$this->load->library('session');
		$this->checkLogin();
		
		$this->load->database();
		$this->load->model('Adminuser_Model', 'adminuser_model');
		$this->load->model('Admingroup_Model', 'admingroup_model');
	}

	/**
	 * 判断登录
	 *
	 * @return boolean
	 */
	protected function checkLogin()
	{
		$uncheckArr = array(
				'login' 
		);
		
		if(!in_array($this->router->class, $uncheckArr))
		{
			if(!$this->session->userdata('adminuser'))
			{
				$loginUrl = zUrl('admin/login/index', array(
						'backurl' => urlencode(zNowUrl()) 
				));
				return redirect($loginUrl);
			}
			else
			{
				$this->template->set('adminuser', $this->session->userdata('adminuser'));
			}
		}
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
		
		$template = $this->template->load('layouts/base.php', 'common/message.php', $viewData, TRUE);
		exit($template);
	}

	/**
	 * 获取分页
	 *
	 * @param string $url
	 * @param int $totalRownum
	 * @return string
	 */
	protected function getPagination($url, $totalRownum)
	{
		$this->load->library('pagination');
		$config['base_url'] = $url;
		$config['per_page'] = Z_ADMIN_PAGESIZE;
		$config['next_link'] = '下一页';
		$config['prev_link'] = '上一页';
		$config['last_link'] = '末页';
		$config['first_link'] = '首页';
		$config['total_rows'] = $totalRownum;
		$config['cur_tag_open'] = '<span>';
		$config['cur_tag_close'] = '</span>';
		$config['use_page_numbers'] = TRUE;
		$config['query_string_segment'] = 'page';
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}