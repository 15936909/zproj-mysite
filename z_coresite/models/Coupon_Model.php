<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券模型
 */
class Coupon_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('coupon');
	}

	/**
	 * 通过code获取数据
	 *
	 * @param string $code
	 * @return array
	 */
	public function getByCode($code)
	{
		$result = $this->db->where('code', $code)->limit(1)->get($this->table)->row_array();
		if(!$result)
		{
			return array();
		}
		return $result;
	}

	/**
	 * 通过条件获取完整记录
	 */
	public function getFullByFilter()
	{
		$_ci = & get_instance();
	}

	/**
	 * 更新数据
	 *
	 * @param array $data
	 * @param string $id
	 */
	public function update($data, $id)
	{
		$updateData['typeid'] = $data['typeid'];
		$updateData['exptime'] = strtotime($data['exptime']);
		$this->db->where('id', $id)->update($this->table, $updateData);
	}

	/**
	 * 通过条件获取完整数据
	 * 
	 * @param $where
	 */
	public function getFullBy($where, $limit = NULL, $offset = NULL, $order = NULL)
	{
		$_ci = & get_instance();
		$_ci->load->model('coupontype_model');
		
		$this->db->select('c.*, ct.name AS typename');
		$this->db->from("{$this->table} AS c");
		$this->db->join("{$_ci->coupontype_model->table} AS ct", 'ct.id = c.typeid', 'left');
		$this->db->where($where);
		
		if($limit && $offset)
		{
			$this->db->limit($limit, $offset);
		}
		else if($limit)
		{
			$this->db->limit($limit);
		}
		
		if($order)
		{
			$this->db->order_by($order);
		}
		
		return $this->db->get()->result_array();
	}
	
	/**
	 * 通过条件统计完整数据
	 *
	 * @param $where
	 * @return int
	 */
	public function countFullBy($where)
	{
		$_ci = & get_instance();
		$_ci->load->model('coupontype_model');
		
		$this->db->from("{$this->table} AS c");
		$this->db->join("{$_ci->coupontype_model->table} AS ct", 'ct.id = c.typeid', 'left');
		$this->db->where($where);
		return $this->db->count_all_results();
	}

	/**
	 * 生成优惠券
	 *
	 * @param array $params
	 * @return int
	 */
	public function generate($params)
	{
		$quatity = $params['quatity'];
		$insertData = array();
		while($quatity)
		{
			$insertData[] = array(
					'typeid' => $params['typeid'],
					'code' => zGenerateCouponCode(),
					'exptime' => strtotime($params['exptime']),
					'addtime' => $_SERVER['REQUEST_TIME'] 
			);
			$quatity--;
		}
		return $this->db->insert_batch($this->table, $insertData);
	}
}