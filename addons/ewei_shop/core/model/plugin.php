<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Ewei_DShop_Plugin
{
	public function getSet($_var_0 = '', $_var_1 = '', $_var_2 = 0)
	{
		global $_W, $_GPC;
		if (empty($_var_2)) {
			$_var_2 = $_W["uniacid"];
		}
		$_var_3 = m("cache")->getArray("sysset", $_var_2);
		if (empty($_var_3)) {
			$_var_3 = pdo_fetch("select * from " . tablename("ewei_shop_sysset") . " where uniacid=:uniacid limit 1", array(":uniacid" => $_var_2));
		}
		if (empty($_var_3)) {
			return array();
		}
		$_var_4 = unserialize($_var_3["sets"]);
		if (empty($_var_1)) {
			return $_var_4;
		}
		return $_var_4[$_var_1];
	}

	public function exists($_var_5 = '')
	{
		$_var_6 = pdo_fetchall("select * from " . tablename("ewei_shop_plugin") . " where identity=:identyty limit  1", array(":identity" => $_var_5));
		if (empty($_var_6)) {
			return false;
		}
		return true;
	}

	public function getAll()
	{
		global $_W;
		$_var_7 = m("cache")->getArray("plugins", "global");
		if (empty($_var_7)) {
			$_var_7 = pdo_fetchall("select * from " . tablename("ewei_shop_plugin") . " order by displayorder asc");
			m("cache")->set("plugins", $_var_7, "global");
		}
		return $_var_7;
	}

	public function getCategory()
	{
		return array("biz" => array("name" => "业务类"), "sale" => array("name" => "营销类"), "tool" => array("name" => "工具类"), "help" => array("name" => "辅助类"));
	}
}