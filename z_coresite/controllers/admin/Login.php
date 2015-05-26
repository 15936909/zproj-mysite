<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 登录控制器
 */
class Login extends Z_AdminController
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if($_POST && self::_validateForm())
		{
			$postData = $this->input->post(NULL, TRUE);
			$reuslt = $this->adminuser_model->login($postData['username'], $postData['password']);
			if(0 < $reuslt)
			{
				$backurl = $this->input->get('backurl') ? urldecode($this->input->get('backurl')) : zUrl('admin/adminuser/index');
				$this->showMessage('登录成功！', $backurl);
				return;
			}
			elseif(-1 == $reuslt)
			{
				$this->showMessage('账号不存在！');
				return;
			}
			elseif(-2 == $reuslt)
			{
				$this->showMessage('密码错误！');
				return;
			}
		}
		
		$this->template->set('backurl', $this->input->get('backurl'));
		$this->template->load('login.php');
	}

	/**
	 * 退出登录
	 */
	public function logout()
	{
		$this->session->unset_userdata('adminuser');
		$this->showMessage('退出登录成功！', zUrl('admin/login/index'));
	}

	/**
	 * 验证表单
	 *
	 * @return boolean
	 */
	private function _validateForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('username', '账号', 'required');
		$this->form_validation->set_rules('password', '密码', 'required');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		return TRUE;
	}
}