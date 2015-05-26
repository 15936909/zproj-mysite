<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 自定义地址函数
 *
 * @param string $url
 * @param array $query
 * @param string $self
 * @return string
 */
function zUrl($url, $query = array(), $self = SELF)
{
	if(!$url) return $self;
	
	$url = strpos($url, 'admin') === 0 ? substr($url, 5) : $url;
	$url = trim($url, '/');
	$url = explode('/', $url);
	$uri = array();
	
	switch(count($url))
	{
		case 1 :
			$uri['c'] = $url[0];
			$uri['m'] = 'index';
			break;
		case 2 :
			$uri['c'] = $url[0];
			$uri['m'] = $url[1];
			break;
		case 3 :
			$uri['a'] = $url[0];
			$uri['c'] = $url[1];
			$uri['m'] = $url[2];
			break;
	}
	
	if($query) $uri = @array_merge($uri, $query);
	
	return base_url($self . '?' . http_build_query($uri));
}

/**
 * 自定义当前地址函数
 *
 * @return string
 */
function zNowUrl()
{
	$url = 'http';
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
	{
		$url .= 's';
	}
	
	$url .= '://';
	if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '80')
	{
		$url .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
	}
	else
	{
		$url .= $_SERVER['SERVER_NAME'];
	}
	$url .= $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
	
	return $url;
}

/**
 * 自定义静态资源地址函数
 *
 * @param string $uri
 * @return string
 */
function zStaticUrl($uri)
{
	return base_url(Z_STATICS_DIR . '/' . $uri);
}