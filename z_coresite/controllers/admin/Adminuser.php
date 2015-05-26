<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 管理员用户控制器
 */
class Adminuser extends Z_AdminController
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 列表
	 */
	public function index()
	{
		if($_POST && $_POST['batch'])
		{
			self::_batchList();
		}
		
		list($list, $filter, $page, $totalPagenum, $totalRownum) = self::_getList();
		
		$viewData['adminuserList'] = $list;
		$viewData['filter'] = $filter;
		$viewData['page'] = $totalPagenum;
		$viewData['totalPagenum'] = $totalPagenum;
		$viewData['totalRownum'] = $totalRownum;
		$viewData['pagination'] = self::getPagination(zUrl('admin/adminuser/index', $filter), $totalRownum);
		
		$viewData['listurl'] = zNowUrl();
		$viewData['admingroupList'] = $this->admingroup_model->getAll();
		
		$this->template->load('layouts/base.php', 'adminuser/index', $viewData);
	}

	/**
	 * 添加
	 */
	public function add()
	{
		if($_POST && self::_validateForm('add'))
		{
			$postData = $this->input->post(NULL, TRUE);
			$adminuser = $this->adminuser_model->getByUsername($postData['username']);
			if($adminuser)
			{
				$this->showMessage('该登录账号已经存在！');
				return;
			}
			else
			{
				$result = $this->adminuser_model->insert($postData);
				if(0 < $result)
				{
					$this->showMessage('添加成功！');
					return;
				}
				else
				{
					$this->showMessage('添加失败！');
					return;
				}
			}
		}
		
		$listurl = $this->input->get('listurl');
		$listurl = $listurl ? $listurl : zUrl('admin/adminuser/index');
		$viewData['listurl'] = $listurl;
		
		$admingroupList = $this->admingroup_model->getAll();
		$viewData['admingroupList'] = $admingroupList;
		
		$this->template->load('layouts/base.php', 'adminuser/add.php', $viewData);
	}

	/**
	 * 删除
	 */
	public function del()
	{
		$result = $this->adminuser_model->delete((int)$this->input->get('id'));
		$this->showMessage('删除成功！');
		return;
	}

	/**
	 * 编辑
	 */
	public function edit()
	{
		$id = (int)$this->input->get('id');
		$adminuser = $this->adminuser_model->get($id);
		if(!$adminuser)
		{
			$this->showMessage('管理员不存在！');
			return;
		}
		
		if($_POST && self::_validateForm('edit'))
		{
			$postData = $this->input->post(NULL, TRUE);
			if($postData['username'] && $postData['username'] != $adminuser['username'])
			{
				$table = $this->db->dbprefix('adminuser');
				$sql = 'SELECT COUNT(1) AS rownum FROM ' . $table . ' WHERE id != ? AND username = ?';
				$result = $this->db->query($sql, array(
						$adminuser['id'],
						$adminuser['username'] 
				))->row_array();
				if($result['rownum'])
				{
					$this->showMessage('该登录账号已存在！');
					return;
				}
			}
			
			$this->adminuser_model->update($postData, $id);
			$this->showMessage('修改成功！');
			return;
		}
		
		$viewData['adminuser'] = $adminuser;
		
		$listurl = $this->input->get('listurl');
		$listurl = $listurl ? $listurl : zUrl('admin/adminuser/index');
		$viewData['listurl'] = $listurl;
		
		$admingroupList = $this->admingroup_model->getAll();
		$viewData['admingroupList'] = $admingroupList;
		
		$this->template->load('layouts/base.php', 'adminuser/edit.php', $viewData);
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
		$this->form_validation->set_rules('username', '登录账号', 'required|max_length[50]');
		if('add' == $action)
		{
			$this->form_validation->set_rules('password', '登录密码', 'required|min_length[6]|max_length[18]');
		}
		else
		{
			$this->form_validation->set_rules('password', '登录密码', 'min_length[6]|max_length[18]');
		}
		$this->form_validation->set_rules('realname', '管理员名', 'required|max_length[20]');
		$this->form_validation->set_rules('groupid', '管理员组', 'required');
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
			$reuslt = $this->adminuser_model->deleteByIds($ids);
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
		
		$totalRownum = $this->adminuser_model->countBy($listWhere);
		$pageSize = Z_ADMIN_PAGESIZE;
		$totalPagenum = ceil($totalRownum / $pageSize);
		
		$page = (int)$this->input->get('page');
		$page = max($page, 1);
		$page = min($page, $totalPagenum);
		$offset = $pageSize * ($page - 1);
		
		$list = array();
		if(0 < $totalRownum)
		{
			$list = $this->adminuser_model->getBy($listWhere, $pageSize, $offset);
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
	 * @return array()
	 */
	private function _getListWhere($filter)
	{
		$sql = ' 1=1 ';
		if($filter['realname'])
		{
			$sql .= ' AND realname LIKE "%' . $filter['realname'] . '%"';
		}
		
		if($filter['groupid'])
		{
			$sql .= ' AND groupid = ' . $filter['groupid'];
		}
		
		return $sql;
	}
}