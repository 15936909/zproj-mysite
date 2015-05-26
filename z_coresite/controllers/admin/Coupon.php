<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 优惠券控制器
 */
class Coupon extends Z_AdminController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Coupon_Model', 'coupon_model');
		$this->load->model('CouponType_Model', 'coupontype_model');
	}

	/**
	 * 优惠券列表
	 */
	public function index()
	{
		if($_POST && $_POST['batch'])
		{
			self::_batchList();
		}
		
		list($list, $filter, $page, $totalPagenum, $totalRownum) = self::_getList();
		
		$viewData['couponList'] = $list;
		$viewData['filter'] = $filter;
		$viewData['page'] = $page;
		$viewData['totalPagenum'] = $totalPagenum;
		$viewData['totalRownum'] = $totalRownum;
		$viewData['pagination'] = self::getPagination(zUrl('admin/coupon/index', $filter), $totalRownum);
		$viewData['listurl'] = zNowUrl();
		
		$viewData['coupontypeList'] = $this->coupontype_model->getAll();
		
		$this->template->load('layouts/base.php', 'coupon/index.php', $viewData);
	}

	/**
	 * 添加
	 */
	public function add()
	{
		if($_POST && self::_validateForm('add'))
		{
			$postData = $this->input->post(NULL, TRUE);
			$result = $this->coupon_model->generate($postData);
			if(0 < $result)
			{
				$this->showMessage(sprintf('添加成功，共计%s个优惠券！', $result));
				return;
			}
			else
			{
				$this->showMessage('添加失败！');
				return;
			}
		}
		
		$listurl = $this->input->get('listurl');
		$listurl = $listurl ? $listurl : zUrl('admin/coupon/index');
		$viewData['listurl'] = $listurl;
		
		$coupontypeList = $this->coupontype_model->getAll();
		$viewData['coupontypeList'] = $coupontypeList;
		
		$this->template->load('layouts/base.php', 'coupon/add.php', $viewData);
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$result = $this->coupon_model->delete((int)$this->input->get('id'));
		$this->showMessage(sprintf('删除成功，共计%s条记录！', $result));
		return;
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = intval($this->input->get('id'));
		$coupon = $this->coupon_model->get($id);
		if(!$coupon)
		{
			$this->showMessage('优惠券不存在！');
			return;
		}
		
		if($_POST && self::_validateForm('edit'))
		{
			$postData = $this->input->post(NULL, TRUE);
			$this->coupon_model->update($postData, $id);
			$this->showMessage('修改成功！');
			return;
		}
		
		$listurl = $this->input->get('listurl');
		$listurl = $listurl ? $listurl : zUrl('admin/adminuser/index');
		$viewData['listurl'] = $listurl;
		
		$coupon_type_list = $this->coupontype_model->getAll();
		$viewData['coupontypeList'] = $coupontypeList;
		
		$viewData['coupon'] = $coupon;
		
		$this->template->load('layouts/base.php', 'coupon/edit.php', $viewData);
	}

	/**
	 * 导出
	 */
	public function export()
	{
		$filter = $this->input->get('f', TRUE);
		$listWhere = self::_getListWhere($filter);
		
		// 关联查询获取需要导出的字段
		$this->db->select('c.id, ct.name AS typename, c.code, c.status, c.exptime, c.addtime');
		$this->db->from("{$this->coupon_model->table} AS c");
		$this->db->join("{$this->coupontype_model->table} AS ct", 'ct.id = c.typeid', 'left');
		$this->db->where($listWhere);
		$query = $this->db->get();
		
		// 需要导出的字段映射
		$fieldMap = array(
				'id' => '优惠券编号',
				'typename' => '优惠券类型',
				'code' => '优惠券兑换码',
				'status' => '是否已兑换',
				'exptime' => '过期时间',
				'addtime' => '添加时间' 
		);
		
		$csvResult = self::_csvFromResult($query, $fieldMap);
		
		$this->load->helper('download');
		force_download('coupon.csv', $csvResult);
	}

	/**
	 * 验证表单
	 *
	 * @return bool
	 */
	private function _validateForm($action = 'add')
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if('add' == $action)
		{
			$this->form_validation->set_rules('quatity', '优惠券数量', 'required|greater_than[0]|less_than[999]');
		}
		$this->form_validation->set_rules('typeid', '优惠券类型', 'required');
		$this->form_validation->set_rules('exptime', '过期时间', 'required|valid_datetime');
		if($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * 批处理列表数据
	 */
	private function _batchList()
	{
		$ids = $this->input->post('ids', TRUE);
		if(!$ids)
		{
			$this->showMessage('请选择要处理的项！');
			return;
		}
		
		$act = $this->input->post('act', TRUE);
		if('del' == $act)
		{
			$reuslt = $this->coupon_model->deleteByIds($ids);
			$this->showMessage(sprintf('删除完成，共计%s条记录！', $reuslt));
			return;
		}
	}

	/**
	 * 获取列表数据
	 *
	 * @return array
	 */
	private function _getList()
	{
		$filter = $this->input->get('f', TRUE);
		$listWhere = self::_getListWhere($filter);
		
		$totalRownum = $this->coupon_model->countFullBy($listWhere);
		
		$pageSize = Z_ADMIN_PAGESIZE;
		$totalPagenum = ceil($totalRownum / $pageSize);
		
		$page = intval($this->input->get('page'));
		$page = max($page, 1);
		$page = min($page, $totalPagenum);
		$offset = $pageSize * ($page - 1);
		
		$list = array();
		if(0 < $totalRownum)
		{
			$list = $this->coupon_model->getFullBy($listWhere, $pageSize, $offset);
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
			$where .= ' AND c.addtime >= ' . strtotime($filter['laddtime']);
		}
		
		if($filter['raddtime'])
		{
			$where .= ' AND c.addtime <= ' . strtotime($this->input->get('raddtime'));
		}
		
		if($filter['lexptime'])
		{
			$where .= ' AND c.exptime >= ' . strtotime($filter['lexptime']);
		}
		
		if($filter['rexptime'])
		{
			$where .= ' AND c.exptime <= ' . strtotime($filter['rexptime']);
		}
		
		return $where;
	}

	/**
	 * 从查询结果返回csv字符串
	 *
	 * @param object $query
	 * @param array $fieldMap
	 * @param string $delim
	 * @param string $newline
	 * @param string $enclosure
	 */
	private function _csvFromResult($query, $filedMap, $delim = ',', $newline = "\n", $enclosure = '"')
	{
		if(!is_object($query) or !method_exists($query, 'list_fields'))
		{
			show_error('You must submit a valid result object');
		}
		
		$out = '';
		foreach($query->list_fields() as $name)
		{
			if(isset($fieldMap[$name]))
			{
				$out .= $enclosure . str_replace($enclosure, $enclosure . $enclosure, $fieldMap[$name]) . $enclosure . $delim;
			}
		}
		
		$out = substr(rtrim($out), 0, -strlen($delim)) . $newline;
		while($row = $query->unbuffered_row('array'))
		{
			foreach($row as $key => $value)
			{
				if('exptime' == $key || 'addtime' == $key)
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