<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("VirtualModel")) {
	class VirtualModel extends PluginModel
	{
		public function updateGoodsStock($_var_0 = 0)
		{
			global $_W, $_GPC;
			$_var_1 = pdo_fetch("select virtual from " . tablename("ewei_shop_goods") . " where id=:id and type=3 and uniacid=:uniacid limit 1", array(":id" => $_var_0, ":uniacid" => $_W["uniacid"]));
			if (empty($_var_1)) {
				return;
			}
			$_var_2 = 0;
			if (!empty($_var_1["virtual"])) {
				$_var_2 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_virtual_data") . " where typeid=:typeid and uniacid=:uniacid and openid='' limit 1", array(":typeid" => $_var_1["virtual"], ":uniacid" => $_W["uniacid"]));
			} else {
				$_var_3 = array();
				$_var_4 = pdo_fetchall("select id, virtual from " . tablename("ewei_shop_goods_option") . " where goodsid=$_var_0");
				foreach ($_var_4 as $_var_5) {
					if (empty($_var_5["virtual"])) {
						continue;
					}
					$_var_6 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_virtual_data") . " where typeid=:typeid and uniacid=:uniacid and openid='' limit 1", array(":typeid" => $_var_5["virtual"], ":uniacid" => $_W["uniacid"]));
					pdo_update("ewei_shop_goods_option", array("stock" => $_var_6), array("id" => $_var_5["id"]));
					if (!in_array($_var_5["virtual"], $_var_3)) {
						$_var_3[] = $_var_5["virtual"];
						$_var_2 += $_var_6;
					}
				}
			}
			pdo_update("ewei_shop_goods", array("total" => $_var_2), array("id" => $_var_0));
		}

		public function updateStock($_var_7 = 0)
		{
			global $_W;
			$_var_8 = array();
			$_var_1 = pdo_fetchall("select id from " . tablename("ewei_shop_goods") . " where type=3 and virtual=:virtual and uniacid=:uniacid limit 1", array(":virtual" => $_var_7, ":uniacid" => $_W["uniacid"]));
			foreach ($_var_1 as $_var_9) {
				$_var_8[] = $_var_9["id"];
			}
			$_var_4 = pdo_fetchall("select id, goodsid from " . tablename("ewei_shop_goods_option") . " where virtual=:virtual and uniacid=:uniacid", array(":uniacid" => $_W["uniacid"], ":virtual" => $_var_7));
			foreach ($_var_4 as $_var_5) {
				if (!in_array($_var_5["goodsid"], $_var_8)) {
					$_var_8[] = $_var_5["goodsid"];
				}
			}
			foreach ($_var_8 as $_var_10) {
				$this->updateGoodsStock($_var_10);
			}
		}

		public function pay($_var_11)
		{
			global $_W, $_GPC;
			$_var_1 = pdo_fetch("select id,goodsid,total,realprice from " . tablename("ewei_shop_order_goods") . " where  orderid=:orderid and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_11["id"]));
			$_var_9 = pdo_fetch("select id,credit,sales,salesreal from " . tablename("ewei_shop_goods") . " where  id=:id and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":id" => $_var_1["goodsid"]));
			$_var_12 = pdo_fetchall("SELECT id,typeid,fields FROM " . tablename("ewei_shop_virtual_data") . " WHERE typeid=:typeid and openid=:openid and uniacid=:uniacid order by rand() limit " . $_var_1["total"], array(":openid" => '', ":typeid" => $_var_11["virtual"], ":uniacid" => $_W["uniacid"]));
			$_var_13 = pdo_fetch("select fields from " . tablename("ewei_shop_virtual_type") . " where id=:id and uniacid=:uniacid limit 1 ", array(":id" => $_var_11["virtual"], ":uniacid" => $_W["uniacid"]));
			$_var_14 = iunserializer($_var_13["fields"], true);
			$_var_15 = array();
			$_var_16 = array();
			foreach ($_var_12 as $_var_17) {
				$_var_15[] = $_var_17["fields"];
				$_var_18 = array();
				$_var_19 = iunserializer($_var_17["fields"]);
				foreach ($_var_19 as $_var_20 => $_var_21) {
					$_var_18[] = $_var_14[$_var_20] . ": " . $_var_21;
				}
				$_var_16[] = implode(" ", $_var_18);
				pdo_update("ewei_shop_virtual_data", array("openid" => $_var_11["openid"], "orderid" => $_var_11["id"], "ordersn" => $_var_11["ordersn"], "price" => round($_var_1["realprice"] / $_var_1["total"], 2), "usetime" => time()), array("id" => $_var_17["id"]));
				pdo_update("ewei_shop_virtual_type", "usedata=usedata+1", array("id" => $_var_17["typeid"]));
				$this->updateStock($_var_17["typeid"]);
			}
			$_var_16 = implode("\n", $_var_16);
			$_var_15 = "[" . implode(",", $_var_15) . "]";
			$_var_22 = time();
			pdo_update("ewei_shop_order", array("virtual_info" => $_var_15, "virtual_str" => $_var_16, "status" => "3", "paytime" => $_var_22, "sendtime" => $_var_22, "finishtime" => $_var_22), array("id" => $_var_11["id"]));
			if ($_var_11["deductcredit2"] > 0) {
				$_var_23 = m("common")->getSysset("shop");
				m("member")->setCredit($_var_11["openid"], "credit2", -$_var_11["deductcredit2"], array(0, $_var_23["name"] . "余额抵扣: {$_var_11["deductcredit2"]} 订单号: " . $_var_11["ordersn"]));
			}
			$_var_24 = $_var_1["total"] * $_var_9["credit"];
			if ($_var_24 > 0) {
				$_var_23 = m("common")->getSysset("shop");
				m("member")->setCredit($_var_11["openid"], "credit1", $_var_24, array(0, $_var_23["name"] . "购物积分 订单号: " . $_var_11["ordersn"]));
			}
			$_var_25 = pdo_fetchcolumn("select ifnull(sum(total),0) from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where og.goodsid=:goodsid and o.status>=1 and o.uniacid=:uniacid limit 1", array(":goodsid" => $_var_9["id"], ":uniacid" => $_W["uniacid"]));
			pdo_update("ewei_shop_goods", array("salesreal" => $_var_25), array("id" => $_var_9["id"]));
			m("member")->upgradeLevel($_var_11["openid"]);
			m("notice")->sendOrderMessage($_var_11["id"]);
			if (p("coupon") && !empty($_var_11["couponid"])) {
				p("coupon")->backConsumeCoupon($_var_11["id"]);
			}
			if (p("commission")) {
				p("commission")->checkOrderPay($_var_11["id"]);
				p("commission")->checkOrderFinish($_var_11["id"]);
			}
		}

		public function perms()
		{
			return array("virtual" => array("text" => $this->getName(), "isplugin" => true, "child" => array("temp" => array("text" => "模板", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "data" => array("text" => "数据", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log", "import" => "导入-log", "export" => "导出已使用数据-log"), "category" => array("text" => "分类", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"))));
		}
	}
}