<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券控制器
 */
class Coupon extends Z_SiteController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coupon_Model', 'coupon_model');
		$this->load->model('CouponExchangelog_Model', 'couponexchangelog_model');
	}

	/**
	 * 兑换页面
	 */
	public function exchange()
	{
		if($_POST && self::_validateForm())
		{
			// 检验兑换次数
			$ip = $this->input->ip_address();
			$exchangeipTimes = self::_getExchangeipTimes($ip);
			if(3 == $exchangeipTimes)
			{
				$this->showMessage('兑换次数已经超过今日的限制！');
				return;
			}
			else
			{
				$this->couponexchangeip_model->updateTimesByIp($ip, $exchangeipTimes + 1);
			}
			
			// 正常兑换流程
			$postData = $this->input->post(NULL, TRUE);
			$coupon = $this->coupon_model->getByCode($postData['code']);
			if(!$coupon)
			{
				$this->showMessage('此优惠券不存在！');
				return;
			}
			
			if(1 == $coupon['status'])
			{
				$this->showMessage('此优惠券已兑换！');
				return;
			}
			
			$postData['couponid'] = $coupon['id'];
			$result = $this->couponexchangelog_model->insert($postData);
			if(0 < $result)
			{
				$this->showMessage('此优惠券兑换成功！');
				return;
			}
		}
		
		$this->template->load('layouts/base.php', 'coupon/exchange.php');
	}

	/**
	 * 验证表单
	 */
	private function _validateForm()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('code', '兑换码', 'required');
		$this->form_validation->set_rules('cellphone', '手机号码', 'required|valid_cellphone');
		$this->form_validation->set_rules('recellphone', '确认号码', 'required|matches[cellphone]');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * 获取地址的兑换次数
	 */
	private function _getExchangeipTimes($ip)
	{
		$result = $this->couponexchangeip_model->getByIp($ip);
		if(!$result)
		{
			return 0;
		}
		
		$lastdate = date('Y-m-d', $result['lasttime']);
		$nowdate = date('Y-m-d', $_SERVER['REQUEST_TIME']);
		if($nowdate == $lastdate)
		{
			if(3 == $result['times'])
			{
				return 3;
			}
			else
			{
				return $result['times'];
			}
		}
		else
		{
			return 0;
		}
	}
}