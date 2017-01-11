<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Ewei_DShop_Cache
{
	function get_key($key = '', $uniacid = '')
	{
		global $_W;
		if (empty($uniacid)) {
			$uniacid = $_W['uniacid'];
		}
		return ewei_shop_PREFIX . "_new_" . $uniacid . '_' . $key;
	}

	function getArray($key = '', $uniacid = '')
	{
		return $this->get($key, $uniacid);
	}

	function getString($key = '', $uniacid = '')
	{
		return $this->get($key, $uniacid);
	}

	function get($key = '', $uniacid = '')
	{
		return cache_read($this->get_key($key, $uniacid));
	}

	function set($key = '', $value = null, $uniacid = '')
	{
		cache_write($this->get_key($key, $uniacid), $value);
	}
}