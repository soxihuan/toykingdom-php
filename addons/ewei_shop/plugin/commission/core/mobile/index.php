<?php
//decode by 

//header("Content-Security-Policy: upgrade-insecure-requests"); 
global $_W, $_GPC;

//$a = !empty($_W['config']['setting']['https']) ? true : (strtolower(($_SERVER['SERVER_PORT'] == 443 || (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) != 'off') ? true : false)))? 'https://' : 'http://';
//var_dump($a);exit;

//$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
//echo $http_type;exit;

$openid = m("user")->getOpenid();
if ($_W["isajax"]) {
	$member = $this->model->getInfo($openid, array("total", "ordercount0", "ok"));
	$cansettle = $member["commission_ok"] >= 1 && $member["commission_ok"] >= floatval($this->set["withdraw"]);
	$commission_ok = $member["commission_ok"];
	$member["agentcount"] = number_format($member["agentcount"], 0);
	$member["ordercount0"] = number_format($member["ordercount0"], 0);
	$member["commission_ok"] = number_format($member["commission_ok"], 2);
	$member["commission_pay"] = number_format($member["commission_pay"], 2);
	$member["commission_total"] = number_format($member["commission_total"], 2);
	$member["customercount"] = pdo_fetchcolumn("select count(id) from " . tablename("ewei_shop_member") . " where agentid=:agentid and ((isagent=1 and status=0) or isagent=0) and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":agentid" => $member["id"]));
	if (mb_strlen($member["nickname"], "utf-8") > 12) {
		$member["nickname"] = mb_substr($member["nickname"], 0, 12, "utf-8");
	}
	$openselect = false;
	if ($this->set["select_goods"] == "1") {
		if (empty($member["agentselectgoods"]) || $member["agentselectgoods"] == 2) {
			$openselect = true;
		}
	} else {
		if ($member["agentselectgoods"] == 2) {
			$openselect = true;
		}
	}
	$this->set["openselect"] = $openselect;
	$level = $this->model->getLevel($openid);
	show_json(1, array("commission_ok" => $commission_ok, "member" => $member, "level" => $level, "cansettle" => $cansettle, "settlemoney" => number_format(floatval($this->set["withdraw"]), 2), "set" => $this->set,));
}
include $this->template("index");