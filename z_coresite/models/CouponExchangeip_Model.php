<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券兑换ip模型
 */
class CouponExchangeip_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('coupon_exchangeip');
	}

	/**
	 * 通过ip获取数据
	 *
	 * @param string $ip
	 * @return array
	 */
	public function getByIp($ip)
	{
		$result = $this->db->where('ip', $ip)->limit(1)->get($this->table)->row_array();
		if(!$result)
		{
			return array();
		}
		return $result;
	}

	/**
	 * 通过ip更新兑换次数
	 *
	 * @param string $ip
	 * @return int
	 */
	public function updateTimesByIp($ip, $times)
	{
		$lasttime = $_SERVER['REQUEST_TIME'];
		$sql = "REPLACE INTO `{$this->table}`(`ip`, `times`, `lasttime`) VALUES(?, ?, ?);";
		$this->db->query($sql, array($ip, $times, $lasttime));
	}

	/**
	 * 添加兑换ip
	 *
	 * @param array $data
	 * @return int
	 */
	public function insert($data)
	{
		$inserData['couponid'] = $data['couponid'];
		$inserData['ip'] = $data['ip'];
		$inserData['lasttime'] = $_SERVER['REQUEST_TIME'];
		
		$this->db->insert($this->table, $inserData);
		echo $this->db->last_query();
		return $this->db->insert_id();
	}
}