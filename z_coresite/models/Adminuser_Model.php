<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 管理员模型
 */
class Adminuser_Model extends Z_Model
{
	var $table;

	public function __construct()
	{
		parent::__construct();
		$this->table = $this->db->dbprefix('adminuser');
	}

	/**
	 * 通过username获取数据
	 *
	 * @param string $username
	 * @return array
	 */
	public function getByUsername($username)
	{
		$result = $this->db->where('username', $username)->limit(1)->get($this->table)->row_array();
		if(!$result)
		{
			return array();
		}
		return $result;
	}

	/**
	 * 新增数据
	 *
	 * @param array $data
	 * @return int
	 */
	public function insert($data)
	{
		$salt = zGenerateSalt(10);
		$password = zEncryptPassword($data['password'], $salt);
		
		$inserData = array(
				'realname' => $data['realname'],
				'username' => $data['username'],
				'password' => $password,
				'salt' => $salt,
				'groupid' => $data['groupid'],
				'addtime' => $_SERVER['REQUEST_TIME'] 
		);
		
		$this->db->insert($this->table, $inserData);
		return $this->db->insert_id();
	}

	/**
	 * 删除单条数据
	 *
	 * @param int $id
	 * @return void
	 */
	public function delete($id)
	{
		// 不删除初始管理账户
		if(1 == $id)
		{
			return;
		}
		
		$this->db->where('id', $id)->delete($this->table);
	}

	/**
	 * 删除多条数据
	 *
	 * @param array $id
	 * @return void
	 */
	public function deleteByIds($ids)
	{
		// 不删除初始管理账户
		$superIndex = array_search(1, $ids);
		if(-1 < $superIndex)
		{
			unset($ids[$superIndex]);
		}
		
		if($ids)
		{
			$this->db->where_in('id', $ids)->delete($this->table);
			return $this->db->affected_rows();
		}
		return 0;
	}

	/**
	 * 更新单条数据
	 *
	 * @param array $data
	 * @param int $id
	 * @return void
	 *
	 */
	public function update($data, $id)
	{
		$updateData['realname'] = $data['realname'];
		$updateData['username'] = $data['username'];
		$updateData['groupid'] = $data['groupid'];
		
		if($data['password'])
		{
			$salt = zGenerateSalt(10);
			$password = zEncryptPassword($data['password'], $salt);
			$updateData['salt'] = $salt;
			$updateData['password'] = $password;
		}
		
		$this->db->where('id', $id)->update($this->table, $updateData);
	}

	/**
	 * 登录管理员
	 *
	 * @param string $username
	 * @param string $password
	 * @return int int	id	登录成功 int	-1	账户不存在 int	-2	密码不正确 int
	 */
	public function login($username, $password)
	{
		$reuslt = $this->db->select('`id`, `realname`, `username`, `password`, `salt`, `groupid`')->where('username', $username)->limit(1)->get($this->table)->row_array();
		if(!$reuslt)
		{
			return -1;
		}
		elseif(zEncryptPassword($password, $reuslt['salt']) != $reuslt['password'])
		{
			return -2;
		}
		
		$this->session->set_userdata('adminuser', array(
				'id' => $reuslt['id'],
				'username' => $reuslt['username'],
				'realname' => $reuslt['realname'],
				'groupid' => $reuslt['groupid'] 
		));
		
		return $reuslt['id'];
	}
}