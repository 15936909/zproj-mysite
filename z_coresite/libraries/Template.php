<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 模板类
 */
class Template
{
	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function load($template = '', $view = '', $view_data = array(), $return = FALSE)
	{
		$this->CI = & get_instance();
		if($view)
		{
			$this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
		}
		return $this->CI->load->view($template, $this->template_data, $return);
	}
}

/* End of file Template.php */