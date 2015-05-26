<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 管理组模型
 */
class Admingroup_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('admingroup');
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