<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券兑换记录控制器
 */
class Couponexchangelog extends Z_AdminController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coupon_Model', 'coupon_model');
		$this->load->model('CouponType_Model', 'coupontype_model');
		$this->load->model('CouponExchangelog_Model', 'couponexchangelog_model');
	}

	/**
	 * 列表
	 */
	public function index()
	{
		list($list, $filter, $page, $totalPagenum, $totalRownum) = self::_getList();
		
		$viewData['couponexchangelogList'] = $list;
		$viewData['filter'] = $filter;
		$viewData['page'] = $page;
		$viewData['totalPagenum'] = $totalPagenum;
		$viewData['totalRownum'] = $totalRownum;
		$viewData['pagination'] = self::getPagination(zUrl('admin/couponexchangelog/index', $filter), $totalRownum);
		$viewData['listurl'] = zNowUrl();
		
		$viewData['coupontypeList'] = $this->coupontype_model->getAll();
		
		$this->template->load('layouts/base.php', 'couponexchangelog/index.php', $viewData);
	}

	/**
	 * 导出
	 */
	public function export()
	{
		$filter = $this->input->get('f', TRUE);
		$where = self::_getListWhere($filter);
		
		// 关联查询获取需要导出的字段
		$this->db->select("cel.id, cel.cellphone, c.code, ct.name AS typename, cel.addtime");
		$this->db->from("{$this->couponexchangelog_model->table} AS cel");
		$this->db->join("{$this->coupon_model->table} AS c", 'cel.couponid = c.id', 'inner');
		$this->db->join("{$this->coupontype_model->table} AS ct", 'c.typeid = ct.id', 'left');
		$this->db->where($where);
		$query = $this->db->get();
		
		// 需要导出的字段映射
		$fieldMap = array(
				'id' => '编号',
				'cellphone' => '手机号码',
				'code' => '兑换码',
				'typename' => '兑换券类型',
				'addtime' => '兑换时间' 
		);
		
		$csvResult = self::_csvFromResult($query, $fieldMap);
		
		$this->load->helper('download');
		force_download('couponexchangelog.csv', $csvResult);
	}

	/**
	 * 获取列表数据
	 *
	 * @return array
	 */
	private function _getList()
	{
		$filter = $this->input->get('f', TRUE);
		$where = self::_getListWhere($filter);
		
		$totalRownum = $this->couponexchangelog_model->countFullBy($where);
		$pageSize = Z_ADMIN_PAGESIZE;
		$totalPagenum = ceil($totalRownum / $pageSize);
		
		$page = intval($this->input->get('page'));
		$page = max($page, 1);
		$page = min($page, $totalPagenum);
		$offset = $pageSize * ($page - 1);
		
		$list = array();
		if(0 < $totalRownum)
		{
			$list = $this->couponexchangelog_model->getFullBy($where, $pageSize, $offset);
		}
		
		return array(
				$list,
				$filter,
				$page,
				$totalPagenum,
				$totalRownum 
		);
	}

	/**
	 * 获取列表查询条件
	 *
	 * @return string
	 */
	private function _getListWhere($filter)
	{
		$where = ' 1=1';
		
		if($filter['code'])
		{
			$where .= ' AND c.code LIKE "%' . $filter['code'] . '%"';
		}
		
		if($filter['typeid'])
		{
			$where .= ' AND ct.id = ' . intval($filter['typeid']);
		}
		
		if($filter['laddtime'])
		{
			$where .= ' AND cel.addtime >= ' . strtotime($filter['laddtime']);
		}
		
		if($filter['raddtime'])
		{
			$where .= ' AND cel.addtime <= ' . strtotime($this->input->get('raddtime'));
		}
		
		return $where;
	}

	/**
	 * 从查询结果返回csv字符串
	 *
	 * @param object $query
	 * @param string $delim
	 * @param string $newline
	 * @param string $enclosure
	 */
	private function _csvFromResult($query, $fieldMap, $delim = ',', $newline = "\n", $enclosure = '"')
	{
		if(!is_object($query) or !method_exists($query, 'list_fields'))
		{
			show_error('You must submit a valid result object');
		}
		
		$out = '';
		foreach($query->list_fields() as $name)
		{
			$out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $fieldMap[$name]) . $enclosure . $delim;
		}
		
		$coupontypeList = $this->coupontype_model->getAll();
		
		$out = substr(rtrim($out), 0, -strlen($delim)) . $newline;
		while($row = $query->unbuffered_row('array'))
		{
			foreach($row as $key => $value)
			{
				if('typeid' == $key)
				{
					$value = $coupontypeList[$value]['name'];
				}
				elseif('exptime' == $key || 'addtime' == $key)
				{
					$value = date('Y-m-d H:i:s', $value);
				}
				elseif('status' == $key)
				{
					$value = $value ? '已兑换' : '未兑换';
				}
				$out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $value) . $enclosure . $delim;
			}
			$out = substr(rtrim($out), 0, -strlen($delim)) . $newline;
		}
		
		return $out;
	}
}