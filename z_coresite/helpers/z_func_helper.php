<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 加密密码
 *
 * @param string $password
 * @param string $salt
 * @return string
 */
function zEncryptPassword($password, $salt)
{
	return md5(md5($password) . $salt . md5($password));
}

/**
 * 生成加密码
 *
 * @param int $len
 * @return string
 */
function zGenerateSalt($len = 10)
{
	return substr(md5(rand(0, 999)), 0, $len);
}

/**
 * 生成优惠券兑换码
 *
 * @return string
 */
function zGenerateCouponCode()
{
	$str = md5(time() . mt_rand(1, 1000000));
	return substr($str, 8, 16);
}