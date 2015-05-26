<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券类型模型
 */
class CouponType_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('coupon_type');
	}

	/**
	 * 获取所有数据
	 *
	 * @return array
	 */
	public function getAll()
	{
		$result = $this->db->get($this->table)->result_array();
		$list = array();
		foreach($result as $item)
		{
			$list[$item['id']] = $item;
		}
		return $list;
	}
}