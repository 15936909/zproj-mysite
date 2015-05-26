<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 自定义模型
 */
class Z_Model extends CI_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 获取数据
	 *
	 * @param int $id
	 * @return array
	 */
	public function get($id)
	{
		$result = $this->db->where('id', $id)->get($this->table)->row_array();
		if(!$result)
		{
			return array();
		}
		return $result;
	}

	/**
	 * 通过条件获取数据
	 *
	 * @param string $where
	 * @param string $limit
	 * @param string $offset
	 * @param string $order
	 */
	public function getBy($where, $limit = NULL, $offset = NULL, $order = NULL)
	{
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
		
		return $this->db->get($this->table)->result_array();
	}

	/**
	 * 通过条件统计数据
	 *
	 * @return int
	 */
	public function countBy($where)
	{
		return $this->db->where($where)->count_all_results($this->table);
	}

	/**
	 * 删除单条数据
	 *
	 * @param int $id
	 * @return int
	 */
	public function delete($id)
	{
		$this->db->where('id', $id)->delete($this->table);
		return $this->db->affected_rows();
	}

	/**
	 * 删除多条数据
	 *
	 * @param array $ids
	 * @return int
	 */
	public function deleteByIds($ids)
	{
		if($ids)
		{
			$this->db->where_in('id', $ids)->delete($this->table);
			return $this->db->affected_rows();
		}
		return 0;
	}
}