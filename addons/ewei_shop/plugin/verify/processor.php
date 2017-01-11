<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
require IA_ROOT . "/addons/ewei_shop/defines.php";
require ewei_shop_INC . "plugin/plugin_processor.php";

class VerifyProcessor extends PluginProcessor
{
	public function __construct()
	{
		parent::__construct("verify");
	}

	public function respond($_var_0 = null)
	{
		global $_W;
		$_var_1 = $_var_0->message;
		$_var_2 = $_var_0->message["from"];
		$_var_3 = $_var_0->message["content"];
		$_var_4 = strtolower($_var_1["msgtype"]);
		$_var_5 = strtolower($_var_1["event"]);
		if ($_var_4 == "text" || $_var_5 == "click") {
			$_var_6 = pdo_fetch("select * from " . tablename("ewei_shop_saler") . " where openid=:openid and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_2));
			if (empty($_var_6)) {
				return $this->responseEmpty();
			}
			$_var_7 = m("common")->getSysset("trade");
			if (!$_var_0->inContext) {
				$_var_0->beginContext();
				return $_var_0->respText("请输入订单消费码:");
			} else if ($_var_0->inContext && is_numeric($_var_3)) {
				$_var_8 = pdo_fetch("select * from " . tablename("ewei_shop_order") . " where verifycode=:verifycode and uniacid=:uniacid  limit 1", array(":verifycode" => $_var_3, ":uniacid" => $_W["uniacid"]));
				if (empty($_var_8)) {
					return $_var_0->respText("未找到要核销的订单,请重新输入!");
				}
				$_var_9 = $_var_8["id"];
				if (empty($_var_8["isverify"])) {
					$_var_0->endContext();
					return $_var_0->respText("订单无需核销!");
				}
				if (!empty($_var_8["verified"])) {
					$_var_0->endContext();
					return $_var_0->respText("此订单已核销，无需重复核销!");
				}
				if ($_var_8["status"] != 1) {
					$_var_0->endContext();
					return $_var_0->respText("订单未付款，无法核销!");
				}
				$_var_10 = array();
				$_var_11 = pdo_fetchall("select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,g.isverify,g.storeids from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_8["id"]));
				foreach ($_var_11 as $_var_12) {
					if (!empty($_var_12["storeids"])) {
						$_var_10 = array_merge(explode(",", $_var_12["storeids"]), $_var_10);
					}
				}
				if (!empty($_var_10)) {
					if (!empty($_var_6["storeid"])) {
						if (!in_array($_var_6["storeid"], $_var_10)) {
							return $_var_0->respText("您无此门店的核销权限!");
						}
					}
				}
				$_var_13 = time();
				pdo_update("ewei_shop_order", array("status" => 3, "sendtime" => $_var_13, "finishtime" => $_var_13, "verifytime" => $_var_13, "verified" => 1, "verifyopenid" => $_var_2, "verifystoreid" => $_var_6["storeid"]), array("id" => $_var_8["id"]));
				m("notice")->sendOrderMessage($_var_9);
				if (p("commission")) {
					p("commission")->checkOrderFinish($_var_9);
				}
				$_var_0->endContext();
				return $_var_0->respText("核销成功!");
			}
		}
	}

	private function responseEmpty()
	{
		ob_clean();
		ob_start();
		echo '';
		ob_flush();
		ob_end_flush();
		exit(0);
	}
}