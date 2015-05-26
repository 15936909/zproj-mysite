<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 自定义表单验证类
 */
class Z_Form_validation extends CI_Form_validation
{

	public function __construct($rules = array())
	{
		parent::__construct($rules);
	}

	/**
	 * 验证日期时间
	 *
	 * @param string $str
	 * @return boolean
	 */
	public function valid_datetime($str)
	{
		$str = trim($str);
		$reg = "/^\d{4}-\d{1,2}-\d{1,2}( \d{2}:\d{2}:\d{2})?$/";
		return preg_match($reg, $str) ? TRUE : FALSE;
	}

	/**
	 * 验证手机号码
	 *
	 * @param string $str
	 * @return boolean
	 */
	public function valid_cellphone($str)
	{
		$reg = '"/^13[0-9]{1}[0-9]{8}$|15[0189]{1}[0-9]{8}$|189[0-9]{8}$/"';
		return preg_match($reg, $str) ? TRUE : FALSE;
	}
}
