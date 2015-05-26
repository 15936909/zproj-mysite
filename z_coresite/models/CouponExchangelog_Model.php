<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券兑换日志模型
 */
class CouponExchangelog_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('coupon_exchangelog');
	}

	/**
	 * 添加数据
	 *
	 * @param array $data
	 * @return int
	 */
	public function insert($data)
	{
		$inserData['couponid'] = $data['couponid'];
		$inserData['cellphone'] = $data['cellphone'];
		$inserData['addtime'] = $_SERVER['REQUEST_TIME'];
		
		$this->db->insert($this->table, $inserData);
		return $this->db->insert_id();
	}
	
	public function getFullBy($where, $limit = NULL, $offset = NULL, $order = NULL)
	{
		$_ci = & get_instance();
		$_ci->load->model('coupon_model');
		$_ci->load->model('coupontype_model');
		
		$this->db->select("cel.*, c.code, ct.name AS typename");
		$this->db->from("{$this->table} AS cel");
		$this->db->join("{$this->coupon_model->table} AS c", 'cel.couponid = c.id', 'inner');
		$this->db->join("{$this->coupontype_model->table} AS ct", 'c.typeid = ct.id', 'left');
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
		$_ci->load->model('coupon_model');
		$_ci->load->model('coupontype_model');
		
		$this->db->from("{$this->table} AS cel");
		$this->db->join("{$this->coupon_model->table} AS c", 'cel.couponid = c.id', 'inner');
		$this->db->join("{$this->coupontype_model->table} AS ct", 'c.typeid = ct.id', 'left');
		$this->db->where($where);
		return $this->db->count_all_results();
	}
}