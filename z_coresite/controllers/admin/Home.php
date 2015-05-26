<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 首页控制器
 */
class Home extends Z_AdminController
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 首页
	 */
	public function index()
	{
		$this->template->load('home.php');
	}
}