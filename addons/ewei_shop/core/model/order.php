<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Ewei_DShop_Order
{
	function getDispatchPrice($_var_0, $_var_1, $_var_2 = -1)
	{
		if (empty($_var_1)) {
			return 0;
		}
		$_var_3 = 0;
		if ($_var_2 == -1) {
			$_var_2 = $_var_1["calculatetype"];
		}
		if ($_var_2 == 1) {
			if ($_var_0 <= $_var_1["firstnum"]) {
				$_var_3 = floatval($_var_1["firstnumprice"]);
			} else {
				$_var_3 = floatval($_var_1["firstnumprice"]);
				$_var_4 = $_var_0 - floatval($_var_1["firstnum"]);
				$_var_5 = floatval($_var_1["secondnum"]) <= 0 ? 1 : floatval($_var_1["secondnum"]);
				$_var_6 = 0;
				if ($_var_4 % $_var_5 == 0) {
					$_var_6 = ($_var_4 / $_var_5) * floatval($_var_1["secondnumprice"]);
				} else {
					$_var_6 = ((int)($_var_4 / $_var_5) + 1) * floatval($_var_1["secondnumprice"]);
				}
				$_var_3 += $_var_6;
			}
		} else {
			if ($_var_0 <= $_var_1["firstweight"]) {
				$_var_3 = floatval($_var_1["firstprice"]);
			} else {
				$_var_3 = floatval($_var_1["firstprice"]);
				$_var_4 = $_var_0 - floatval($_var_1["firstweight"]);
				$_var_5 = floatval($_var_1["secondweight"]) <= 0 ? 1 : floatval($_var_1["secondweight"]);
				$_var_6 = 0;
				if ($_var_4 % $_var_5 == 0) {
					$_var_6 = ($_var_4 / $_var_5) * floatval($_var_1["secondprice"]);
				} else {
					$_var_6 = ((int)($_var_4 / $_var_5) + 1) * floatval($_var_1["secondprice"]);
				}
				$_var_3 += $_var_6;
			}
		}
		return $_var_3;
	}

	function getCityDispatchPrice($_var_7, $_var_8, $_var_0, $_var_1)
	{
		if (is_array($_var_7) && count($_var_7) > 0) {
			foreach ($_var_7 as $_var_9) {
				$_var_10 = explode(";", $_var_9["citys"]);
				if (in_array($_var_8, $_var_10) && !empty($_var_10)) {
					return $this->getDispatchPrice($_var_0, $_var_9, $_var_1["calculatetype"]);
				}
			}
		}
		return $this->getDispatchPrice($_var_0, $_var_1);
	}

	public function payResult($_var_11)
	{
		global $_W;
		$_var_12 = intval($_var_11["fee"]);
		$_var_13 = array("status" => $_var_11["result"] == "success" ? 1 : 0);
		$_var_14 = $_var_11["tid"];
		$_var_15 = pdo_fetch('select id,ordersn, price,openid,dispatchtype,addressid,carrier,status,isverify,deductcredit2,virtual,isvirtual,couponid from ' . tablename("ewei_shop_order") . " where  ordersn=:ordersn and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":ordersn" => $_var_14));
		$_var_16 = $_var_15["id"];
		if ($_var_11["from"] == "return") {
			$_var_17 = false;
			if (empty($_var_15["dispatchtype"])) {
				$_var_17 = pdo_fetch("select realname,mobile,address from " . tablename("ewei_shop_member_address") . " where id=:id limit 1", array(":id" => $_var_15["addressid"]));
			}
			$_var_18 = false;
			if ($_var_15["dispatchtype"] == 1 || $_var_15["isvirtual"] == 1) {
				$_var_18 = unserialize($_var_15["carrier"]);
			}
			if ($_var_11["type"] == "cash") {
				return array("result" => "success", "order" => $_var_15, "address" => $_var_17, "carrier" => $_var_18);
			} else {
				if ($_var_15["status"] == 0) {
					$_var_19 = p("virtual");
					if (!empty($_var_15["virtual"]) && $_var_19) {
						$_var_19->pay($_var_15);
					} else {
                        //首次下单加积分
                        $openid = $_var_15['openid'];
                        $userMode = pdo_fetch("select * from ".tablename("ewei_shop_member")." where openid = '{$openid}'");
                        $useragent = $userMode['agenttime'];
                        if($userMode['status'] ==1 && $userMode['isagent'] == 1 && $useragent > "1480068000"){
                            $ordernum = pdo_fetchall("select count(*) from".tablename("ewei_shop_order")." where agentid = '".$userMode['id']."' and paytime >= '{$useragent}'");
                            if($ordernum[0]['count(*)'] == 0){
                                if(empty($userMode["uid"])){
                                    $userMode["uid"] = mc_openid2uid($openid);
                                }
                                $creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$userMode["uid"]."' ");
                                $creditnow = $creditold['credit1'] + 200;
                             	pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $userMode["uid"], "uniacid" => $_W["uniacid"]));
                                pdo_insert("mc_credits_record", array("uid" => $userMode["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));
                                $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$userMode["agentid"]."' ");

                                if(!empty($tOpenid['openid'])){
                                    $credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$tOpenid["uid"]."' ");
                                    $credit1top = $credittop['credit1'] + 200 ;

                                    pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $tOpenid["uid"], "uniacid" => $_W["uniacid"]));
                                    pdo_insert("mc_credits_record", array("uid" =>  $tOpenid["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));
                                }
                            }
                        }
						pdo_update("ewei_shop_order", array("status" => 1, "paytime" => time()), array("id" => $_var_16));
						if ($_var_15["deductcredit2"] > 0) {
							$_var_20 = m("common")->getSysset("shop");
							m("member")->setCredit($_var_15["openid"], "credit2", -$_var_15["deductcredit2"], array(0, $_var_20["name"] . "余额抵扣: {$_var_15["deductcredit2"]} 订单号: " . $_var_15["ordersn"]));
						}
						$this->setStocksAndCredits($_var_16, 1);
						if (p("coupon") && !empty($_var_15["couponid"])) {
							p("coupon")->backConsumeCoupon($_var_15["id"]);
						}
						m("notice")->sendOrderMessage($_var_16);
						if (p("commission")) {
							p("commission")->checkOrderPay($_var_15["id"]);
						}
					}
				}
				return array("result" => "success", "order" => $_var_15, "address" => $_var_17, "carrier" => $_var_18, "virtual" => $_var_15["virtual"]);
			}
		}
	}

	function setStocksAndCredits($_var_16 = '', $_var_21 = 0)
	{
		global $_W;
		$_var_15 = pdo_fetch("select id,ordersn,price,openid,dispatchtype,addressid,carrier,status from " . tablename("ewei_shop_order") . " where id=:id limit 1", array(":id" => $_var_16));
		$_var_22 = pdo_fetchall('select og.goodsid,og.total,g.totalcnf,og.realprice, g.credit,og.optionid,g.total as goodstotal,og.optionid,g.sales,g.salesreal from ' . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . " where og.orderid=:orderid and og.uniacid=:uniacid ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_16));
		$_var_23 = 0;
		foreach ($_var_22 as $_var_24) {
			$_var_25 = 0;
			if ($_var_21 == 0) {
				if ($_var_24["totalcnf"] == 0) {
					$_var_25 = -1;
				}
			} else if ($_var_21 == 1) {
				if ($_var_24["totalcnf"] == 1) {
					$_var_25 = -1;
				}
			} else if ($_var_21 == 2) {
				if ($_var_15["status"] >= 1) {
					if ($_var_24["totalcnf"] == 1) {
						$_var_25 = 1;
					}
				} else {
					if ($_var_24["totalcnf"] == 0) {
						$_var_25 = 1;
					}
				}
			}
			if (!empty($_var_25)) {
				if (!empty($_var_24["optionid"])) {
					$_var_26 = m("goods")->getOption($_var_24["goodsid"], $_var_24["optionid"]);
					if (!empty($_var_26) && $_var_26["stock"] != -1) {
						$_var_27 = -1;
						if ($_var_25 == 1) {
							$_var_27 = $_var_26["stock"] + $_var_24["total"];
						} else if ($_var_25 == -1) {
							$_var_27 = $_var_26["stock"] - $_var_24["total"];
							$_var_27 <= 0 && $_var_27 = 0;
						}
						if ($_var_27 != -1) {
							pdo_update("ewei_shop_goods_option", array("stock" => $_var_27), array("uniacid" => $_W["uniacid"], "goodsid" => $_var_24["goodsid"], "id" => $_var_24["optionid"]));
						}
					}
				}
				if (!empty($_var_24["goodstotal"]) && $_var_24["goodstotal"] != -1) {
					$_var_28 = -1;
					if ($_var_25 == 1) {
						$_var_28 = $_var_24["goodstotal"] + $_var_24["total"];
					} else if ($_var_25 == -1) {
						$_var_28 = $_var_24["goodstotal"] - $_var_24["total"];
						$_var_28 <= 0 && $_var_28 = 0;
					}
					if ($_var_28 != -1) {
						pdo_update("ewei_shop_goods", array("total" => $_var_28), array("uniacid" => $_W["uniacid"], "id" => $_var_24["goodsid"]));
					}
				}
			}
			$_var_29 = trim($_var_24["credit"]);
			if (!empty($_var_29)) {
				if (strexists($_var_29, "%")) {
					$_var_23 += intval(floatval(str_replace("%", '', $_var_29)) / 100 * $_var_24["realprice"]);
				} else {
					$_var_23 += intval($_var_24["credit"]) * $_var_24["total"];
				}
			}
			if ($_var_21 == 0) {
				pdo_update("ewei_shop_goods", array("sales" => $_var_24["sales"] + $_var_24["total"]), array("uniacid" => $_W["uniacid"], "id" => $_var_24["goodsid"]));
			} elseif ($_var_21 == 1) {
				if ($_var_15["status"] >= 1) {
					$_var_30 = pdo_fetchcolumn("select ifnull(sum(total),0) from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where og.goodsid=:goodsid and o.status>=1 and o.uniacid=:uniacid limit 1", array(":goodsid" => $_var_24["goodsid"], ":uniacid" => $_W["uniacid"]));
					pdo_update("ewei_shop_goods", array("salesreal" => $_var_30), array("id" => $_var_24["goodsid"]));
				}
			}
		}
		if ($_var_23 > 0) {
			$_var_20 = m("common")->getSysset("shop");
			if ($_var_21 == 1) {
				m("member")->setCredit($_var_15["openid"], "credit1", $_var_23, array(0, $_var_20["name"] . "购物积分 订单号: " . $_var_15["ordersn"]));
			} elseif ($_var_21 == 2) {
				if ($_var_15["status"] >= 1) {
					m("member")->setCredit($_var_15["openid"], "credit1", -$_var_23, array(0, $_var_20["name"] . "购物取消订单扣除积分 订单号: " . $_var_15["ordersn"]));
				}
			}
		}
	}

	function getDefaultDispatch()
	{
		global $_W;
		$_var_31 = "select * from " . tablename("ewei_shop_dispatch") . " where isdefault=1 and uniacid=:uniacid and enabled=1 Limit 1";
		$_var_11 = array(":uniacid" => $_W["uniacid"]);
		$_var_13 = pdo_fetch($_var_31, $_var_11);
		return $_var_13;
	}

	function getNewDispatch()
	{
		global $_W;
		$_var_31 = "select * from " . tablename("ewei_shop_dispatch") . " where uniacid=:uniacid and enabled=1 order by id desc Limit 1";
		$_var_11 = array(":uniacid" => $_W["uniacid"]);
		$_var_13 = pdo_fetch($_var_31, $_var_11);
		return $_var_13;
	}

	function getOneDispatch($_var_32)
	{
		global $_W;
		$_var_31 = "select * from " . tablename("ewei_shop_dispatch") . " where id=:id and uniacid=:uniacid and enabled=1 Limit 1";
		$_var_11 = array(":id" => $_var_32, ":uniacid" => $_W["uniacid"]);
		$_var_13 = pdo_fetch($_var_31, $_var_11);
		return $_var_13;
	}
}