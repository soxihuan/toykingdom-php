<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
define("TM_COMMISSION_AGENT_NEW", "commission_agent_new");
define("TM_COMMISSION_AGENT_NEWPER", "commission_agent_newper");
define("TM_COMMISSION_ORDER_PAY", "commission_order_pay");
define("TM_COMMISSION_ORDER_FINISH", "commission_order_finish");
define("TM_COMMISSION_APPLY", "commission_apply");
define("TM_COMMISSION_CHECK", "commission_check");
define("TM_COMMISSION_PAY", "commission_pay");
define("TM_COMMISSION_UPGRADE", "commission_upgrade");
define("TM_COMMISSION_BECOME", "commission_become");
define("TM_COMMISSION_WELCOME", "commission_welcome");
define("TM_COMMISSION_MENTOR", "commission_mentor");
if (!class_exists("CommissionModel")) {
	class CommissionModel extends PluginModel
	{
		public function getSet($_var_0 = 0)
		{
			$_var_1 = parent::getSet($_var_0);
			$_var_1["texts"] = array("agent" => empty($_var_1["texts"]["agent"]) ? "分销商" : $_var_1["texts"]["agent"], "shop" => empty($_var_1["texts"]["shop"]) ? "小店" : $_var_1["texts"]["shop"], "myshop" => empty($_var_1["texts"]["myshop"]) ? "我的小店" : $_var_1["texts"]["myshop"], "center" => empty($_var_1["texts"]["center"]) ? "分销中心" : $_var_1["texts"]["center"], "become" => empty($_var_1["texts"]["become"]) ? "我要开店!" : $_var_1["texts"]["become"], "withdraw" => empty($_var_1["texts"]["withdraw"]) ? "提现" : $_var_1["texts"]["withdraw"], "commission" => empty($_var_1["texts"]["commission"]) ? "佣金" : $_var_1["texts"]["commission"], "commission1" => empty($_var_1["texts"]["commission1"]) ? "分销佣金" : $_var_1["texts"]["commission1"], "commission_total" => empty($_var_1["texts"]["commission_total"]) ? "累计佣金" : $_var_1["texts"]["commission_total"], "commission_ok" => empty($_var_1["texts"]["commission_ok"]) ? "可提现佣金" : $_var_1["texts"]["commission_ok"], "commission_apply" => empty($_var_1["texts"]["commission_apply"]) ? "已申请佣金" : $_var_1["texts"]["commission_apply"], "commission_check" => empty($_var_1["texts"]["commission_check"]) ? "待打款佣金" : $_var_1["texts"]["commission_check"], "commission_lock" => empty($_var_1["texts"]["commission_lock"]) ? "未结算佣金" : $_var_1["texts"]["commission_lock"], "commission_detail" => empty($_var_1["texts"]["commission_detail"]) ? "佣金明细" : $_var_1["texts"]["commission_detail"], "commission_pay" => empty($_var_1["texts"]["commission_pay"]) ? "成功提现佣金" : $_var_1["texts"]["commission_pay"], "order" => empty($_var_1["texts"]["order"]) ? "分销订单" : $_var_1["texts"]["order"], "myteam" => empty($_var_1["texts"]["myteam"]) ? "我的团队" : $_var_1["texts"]["myteam"], "c1" => empty($_var_1["texts"]["c1"]) ? "一级" : $_var_1["texts"]["c1"], "c2" => empty($_var_1["texts"]["c2"]) ? "二级" : $_var_1["texts"]["c2"], "c3" => empty($_var_1["texts"]["c3"]) ? "三级" : $_var_1["texts"]["c3"], "mycustomer" => empty($_var_1["texts"]["mycustomer"]) ? "我的客户" : $_var_1["texts"]["mycustomer"],);
			return $_var_1;
		}

		public function calculate($_var_2 = 0, $_var_3 = true)
		{
			global $_W;
			$_var_1 = $this->getSet();
			$_var_4 = $this->getLevels();
			$_var_5 = pdo_fetchcolumn("select agentid from " . tablename("ewei_shop_order") . " where id=:id limit 1", array(":id" => $_var_2));
			$_var_6 = pdo_fetchall('select og.id,og.realprice,og.total,g.hascommission,g.nocommission, g.commission1_rate,g.commission1_pay,g.commission2_rate,g.commission2_pay,g.commission3_rate,g.commission3_pay,og.commissions from ' . tablename("ewei_shop_order_goods") . "  og " . " left join " . tablename("ewei_shop_goods") . " g on g.id = og.goodsid" . " where og.orderid=:orderid and og.uniacid=:uniacid", array(":orderid" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if ($_var_1["level"] > 0) {
				foreach ($_var_6 as &$_var_7) {
					$_var_8 = $_var_7["realprice"];
					if (empty($_var_7["nocommission"])) {
						if ($_var_7["hascommission"] == 1) {
							$_var_7["commission1"] = array("default" => $_var_1["level"] >= 1 ? ($_var_7["commission1_rate"] > 0 ? round($_var_7["commission1_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission1_pay"] * $_var_7["total"], 2)) : 0);
							$_var_7["commission2"] = array("default" => $_var_1["level"] >= 2 ? ($_var_7["commission2_rate"] > 0 ? round($_var_7["commission2_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission2_pay"] * $_var_7["total"], 2)) : 0);
							$_var_7["commission3"] = array("default" => $_var_1["level"] >= 3 ? ($_var_7["commission3_rate"] > 0 ? round($_var_7["commission3_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission3_pay"] * $_var_7["total"], 2)) : 0);
							foreach ($_var_4 as $_var_9) {
								$_var_7["commission1"]["level" . $_var_9["id"]] = $_var_7["commission1_rate"] > 0 ? round($_var_7["commission1_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission1_pay"] * $_var_7["total"], 2);
								$_var_7["commission2"]["level" . $_var_9["id"]] = $_var_7["commission2_rate"] > 0 ? round($_var_7["commission2_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission2_pay"] * $_var_7["total"], 2);
								$_var_7["commission3"]["level" . $_var_9["id"]] = $_var_7["commission3_rate"] > 0 ? round($_var_7["commission3_rate"] * $_var_8 / 100, 2) . "" : round($_var_7["commission3_pay"] * $_var_7["total"], 2);
							}
						} else {
							$_var_7["commission1"] = array("default" => $_var_1["level"] >= 1 ? round($_var_1["commission1"] * $_var_8 / 100, 2) . "" : 0);
							$_var_7["commission2"] = array("default" => $_var_1["level"] >= 2 ? round($_var_1["commission2"] * $_var_8 / 100, 2) . "" : 0);
							$_var_7["commission3"] = array("default" => $_var_1["level"] >= 3 ? round($_var_1["commission3"] * $_var_8 / 100, 2) . "" : 0);
							foreach ($_var_4 as $_var_9) {
								$_var_7["commission1"]["level" . $_var_9["id"]] = $_var_1["level"] >= 1 ? round($_var_9["commission1"] * $_var_8 / 100, 2) . "" : 0;
								$_var_7["commission2"]["level" . $_var_9["id"]] = $_var_1["level"] >= 2 ? round($_var_9["commission2"] * $_var_8 / 100, 2) . "" : 0;
								$_var_7["commission3"]["level" . $_var_9["id"]] = $_var_1["level"] >= 3 ? round($_var_9["commission3"] * $_var_8 / 100, 2) . "" : 0;
							}
						}
					} else {
						$_var_7["commission1"] = array("default" => 0);
						$_var_7["commission2"] = array("default" => 0);
						$_var_7["commission3"] = array("default" => 0);
						foreach ($_var_4 as $_var_9) {
							$_var_7["commission1"]["level" . $_var_9["id"]] = 0;
							$_var_7["commission2"]["level" . $_var_9["id"]] = 0;
							$_var_7["commission3"]["level" . $_var_9["id"]] = 0;
						}
					}
					if ($_var_3) {
						$_var_10 = array("level1" => 0, "level2" => 0, "level3" => 0);
						if (!empty($_var_5)) {
							$_var_11 = m("member")->getMember($_var_5);
							if ($_var_11["isagent"] == 1 && $_var_11["status"] == 1) {
								$_var_12 = $this->getLevel($_var_11["openid"]);
								$_var_10["level1"] = empty($_var_12) ? round($_var_7["commission1"]["default"], 2) : round($_var_7["commission1"]["level" . $_var_12["id"]], 2);
								if (!empty($_var_11["agentid"])) {
									$_var_13 = m("member")->getMember($_var_11["agentid"]);
									$_var_14 = $this->getLevel($_var_13["openid"]);
									$_var_10["level2"] = empty($_var_14) ? round($_var_7["commission2"]["default"], 2) : round($_var_7["commission2"]["level" . $_var_14["id"]], 2);
									if (!empty($_var_13["agentid"])) {
										$_var_15 = m("member")->getMember($_var_13["agentid"]);
										$_var_16 = $this->getLevel($_var_15["openid"]);
										$_var_10["level3"] = empty($_var_16) ? round($_var_7["commission3"]["default"], 2) : round($_var_7["commission3"]["level" . $_var_16["id"]], 2);
									}
								}
							}
						}
						pdo_update("ewei_shop_order_goods", array("commission1" => iserializer($_var_7["commission1"]), "commission2" => iserializer($_var_7["commission2"]), "commission3" => iserializer($_var_7["commission3"]), "commissions" => iserializer($_var_10), "nocommission" => $_var_7["nocommission"]), array("id" => $_var_7["id"]));
					}
				}
				unset($_var_7);
			}
			return $_var_6;
		}

		public function getOrderCommissions($_var_2 = 0, $_var_17 = 0)
		{
			global $_W;
			$_var_1 = $this->getSet();
			$_var_5 = pdo_fetchcolumn("select agentid from " . tablename("ewei_shop_order") . " where id=:id limit 1", array(":id" => $_var_2));
			$_var_6 = pdo_fetch("select commission1,commission2,commission3 from " . tablename("ewei_shop_order_goods") . " where id=:id and orderid=:orderid and uniacid=:uniacid and nocommission=0 limit 1", array(":id" => $_var_17, ":orderid" => $_var_2, ":uniacid" => $_W["uniacid"]));
			$_var_10 = array("level1" => 0, "level2" => 0, "level3" => 0);
			if ($_var_1["level"] > 0) {
				$_var_18 = iunserializer($_var_6["commission1"]);
				$_var_19 = iunserializer($_var_6["commission2"]);
				$_var_20 = iunserializer($_var_6["commission3"]);
				if (!empty($_var_5)) {
					$_var_11 = m("member")->getMember($_var_5);
					if ($_var_11["isagent"] == 1 && $_var_11["status"] == 1) {
						$_var_12 = $this->getLevel($_var_11["openid"]);
						$_var_10["level1"] = empty($_var_12) ? round($_var_18["default"], 2) : round($_var_18["level" . $_var_12["id"]], 2);
						if (!empty($_var_11["agentid"])) {
							$_var_13 = m("member")->getMember($_var_11["agentid"]);
							$_var_14 = $this->getLevel($_var_13["openid"]);
							$_var_10["level2"] = empty($_var_14) ? round($_var_19["default"], 2) : round($_var_19["level" . $_var_14["id"]], 2);
							if (!empty($_var_13["agentid"])) {
								$_var_15 = m("member")->getMember($_var_13["agentid"]);
								$_var_16 = $this->getLevel($_var_15["openid"]);
								$_var_10["level3"] = empty($_var_16) ? round($_var_20["default"], 2) : round($_var_20["level" . $_var_16["id"]], 2);
							}
						}
					}
				}
			}
			return $_var_10;
		}

		public function getInfo($_var_21, $_var_22 = null)
		{
			if (empty($_var_22) || !is_array($_var_22)) {
				$_var_22 = array();
			}
			global $_W;
			$_var_1 = $this->getSet();
			$_var_9 = intval($_var_1["level"]);
			$_var_23 = m("member")->getMember($_var_21);
			$_var_24 = $this->getLevel($_var_21);
			$_var_25 = time();
			$_var_26 = intval($_var_1["settledays"]) * 3600 * 24;
			$_var_27 = 0;
			$_var_28 = 0;
			$_var_29 = 0;
			$_var_30 = 0;
			$_var_31 = 0;
			$_var_32 = 0;
			$_var_33 = 0;
			$_var_34 = 0;
			$_var_35 = 0;
			$_var_36 = 0;
			$_var_37 = 0;
			$_var_38 = 0;
			$_var_39 = 0;
			$_var_40 = 0;
			$_var_41 = 0;
			$_var_42 = 0;
			$_var_43 = 0;
			$_var_44 = 0;
			$_var_45 = 0;
			$_var_46 = 0;
			$_var_47 = 0;
			$_var_48 = 0;
			$_var_49 = 0;
			$_var_50 = 0;
			$_var_51 = 0;
			$_var_52 = 0;
			$_var_53 = 0;
			$_var_54 = 0;
			if ($_var_9 >= 1) {
				if (in_array("ordercount0", $_var_22)) {
					$_var_55 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . ' where o.agentid=:agentid and o.status>=0 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					$_var_43 += $_var_55["ordercount"];
					$_var_28 += $_var_55["ordercount"];
					$_var_29 += $_var_55["ordermoney"];
				}
				if (in_array("ordercount", $_var_22)) {
					$_var_55 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . ' where o.agentid=:agentid and o.status>=1 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					$_var_46 += $_var_55["ordercount"];
					$_var_30 += $_var_55["ordercount"];
					$_var_31 += $_var_55["ordermoney"];
				}
				if (in_array("ordercount3", $_var_22)) {
					$_var_56 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . ' where o.agentid=:agentid and o.status>=3 and og.status1>=0 and og.nocommission=0 and o.uniacid=:uniacid  limit 1', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					$_var_49 += $_var_56["ordercount"];
					$_var_32 += $_var_56["ordercount"];
					$_var_33 += $_var_56["ordermoney"];
					$_var_52 += $_var_56["ordermoney"];
				}
				if (in_array("total", $_var_22)) {
					$_var_57 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid=:agentid and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_57 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_34 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_34 += isset($_var_10["level1"]) ? floatval($_var_10["level1"]) : 0;
						}
					}
				}
				if (in_array("ok", $_var_22)) {
					$_var_57 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$_var_25} - o.finishtime > {$_var_26}) and og.status1=0  and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_57 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_35 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_35 += isset($_var_10["level1"]) ? $_var_10["level1"] : 0;
						}
					}
				}
				if (in_array("lock", $_var_22)) {
					$_var_60 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid=:agentid and o.status>=3 and og.nocommission=0 and ({$_var_25} - o.finishtime <= {$_var_26})  and og.status1=0  and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_60 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_38 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_38 += isset($_var_10["level1"]) ? $_var_10["level1"] : 0;
						}
					}
				}
				if (in_array("apply", $_var_22)) {
					$_var_61 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . ' where o.agentid=:agentid and o.status>=3 and og.status1=1 and og.nocommission=0 and o.uniacid=:uniacid', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_61 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_36 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_36 += isset($_var_10["level1"]) ? $_var_10["level1"] : 0;
						}
					}
				}
				if (in_array("check", $_var_22)) {
					$_var_61 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . ' where o.agentid=:agentid and o.status>=3 and og.status1=2 and og.nocommission=0 and o.uniacid=:uniacid ', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_61 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_37 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_37 += isset($_var_10["level1"]) ? $_var_10["level1"] : 0;
						}
					}
				}
				if (in_array("pay", $_var_22)) {
					$_var_61 = pdo_fetchall("select og.commission1,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . ' where o.agentid=:agentid and o.status>=3 and og.status1=3 and og.nocommission=0 and o.uniacid=:uniacid ', array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]));
					foreach ($_var_61 as $_var_58) {
						$_var_10 = iunserializer($_var_58["commissions"]);
						$_var_59 = iunserializer($_var_58["commission1"]);
						if (empty($_var_10)) {
							$_var_39 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
						} else {
							$_var_39 += isset($_var_10["level1"]) ? $_var_10["level1"] : 0;
						}
					}
				}
				$_var_62 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where agentid=:agentid and isagent=1 and status=1 and uniacid=:uniacid ", array(":uniacid" => $_W["uniacid"], ":agentid" => $_var_23["id"]), "id");
				$_var_40 = count($_var_62);
				$_var_27 += $_var_40;
			}
			if ($_var_9 >= 2) {
				if ($_var_40 > 0) {
					if (in_array("ordercount0", $_var_22)) {
						$_var_63 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=0 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_44 += $_var_63["ordercount"];
						$_var_28 += $_var_63["ordercount"];
						$_var_29 += $_var_63["ordermoney"];
					}
					if (in_array("ordercount", $_var_22)) {
						$_var_63 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=1 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_47 += $_var_63["ordercount"];
						$_var_30 += $_var_63["ordercount"];
						$_var_31 += $_var_63["ordermoney"];
					}
					if (in_array("ordercount3", $_var_22)) {
						$_var_64 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct o.id) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=3 and og.status2>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_50 += $_var_64["ordercount"];
						$_var_32 += $_var_64["ordercount"];
						$_var_33 += $_var_64["ordermoney"];
						$_var_53 += $_var_64["ordermoney"];
					}
					if (in_array("total", $_var_22)) {
						$_var_65 = pdo_fetchall("select og.commission2,og.commissions from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_65 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_34 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_34 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					if (in_array("ok", $_var_22)) {
						$_var_65 = pdo_fetchall("select og.commission2,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and ({$_var_25} - o.finishtime > {$_var_26}) and o.status>=3 and og.status2=0 and og.nocommission=0  and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_65 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_35 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_35 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					if (in_array("lock", $_var_22)) {
						$_var_66 = pdo_fetchall("select og.commission2,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and ({$_var_25} - o.finishtime <= {$_var_26}) and og.status2=0 and o.status>=3 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_66 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_38 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_38 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					if (in_array("apply", $_var_22)) {
						$_var_67 = pdo_fetchall("select og.commission2,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=3 and og.status2=1 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_67 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_36 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_36 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					if (in_array("check", $_var_22)) {
						$_var_68 = pdo_fetchall("select og.commission2,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=3 and og.status2=2 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_68 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_37 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_37 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					if (in_array("pay", $_var_22)) {
						$_var_68 = pdo_fetchall("select og.commission2,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid " . " where o.agentid in( " . implode(",", array_keys($_var_62)) . ")  and o.status>=3 and og.status2=3 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_68 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission2"]);
							if (empty($_var_10)) {
								$_var_39 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_39 += isset($_var_10["level2"]) ? $_var_10["level2"] : 0;
							}
						}
					}
					$_var_69 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where agentid in( " . implode(",", array_keys($_var_62)) . ") and isagent=1 and status=1 and uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]), "id");
					$_var_41 = count($_var_69);
					$_var_27 += $_var_41;
				}
			}
			if ($_var_9 >= 3) {
				if ($_var_41 > 0) {
					if (in_array("ordercount0", $_var_22)) {
						$_var_70 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=0 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_45 += $_var_70["ordercount"];
						$_var_28 += $_var_70["ordercount"];
						$_var_29 += $_var_70["ordermoney"];
					}
					if (in_array("ordercount", $_var_22)) {
						$_var_70 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=1 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_48 += $_var_70["ordercount"];
						$_var_30 += $_var_70["ordercount"];
						$_var_31 += $_var_70["ordermoney"];
					}
					if (in_array("ordercount3", $_var_22)) {
						$_var_71 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=3 and og.status3>=0 and og.nocommission=0 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"]));
						$_var_51 += $_var_71["ordercount"];
						$_var_32 += $_var_71["ordercount"];
						$_var_33 += $_var_71["ordermoney"];
						$_var_54 += $_var_70["ordermoney"];
					}
					if (in_array("total", $_var_22)) {
						$_var_72 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=1 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_72 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_34 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_34 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					if (in_array("ok", $_var_22)) {
						$_var_72 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and ({$_var_25} - o.finishtime > {$_var_26}) and o.status>=3 and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_72 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_35 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_35 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					if (in_array("lock", $_var_22)) {
						$_var_73 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=3 and ({$_var_25} - o.finishtime > {$_var_26}) and og.status3=0  and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_73 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_38 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_38 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					if (in_array("apply", $_var_22)) {
						$_var_74 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=3 and og.status3=1 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_74 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_36 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_36 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					if (in_array("check", $_var_22)) {
						$_var_75 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=3 and og.status3=2 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_75 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_37 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_37 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					if (in_array("pay", $_var_22)) {
						$_var_75 = pdo_fetchall("select og.commission3,og.commissions  from " . tablename("ewei_shop_order_goods") . " og " . " left join  " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where o.agentid in( " . implode(",", array_keys($_var_69)) . ")  and o.status>=3 and og.status3=3 and og.nocommission=0 and o.uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]));
						foreach ($_var_75 as $_var_58) {
							$_var_10 = iunserializer($_var_58["commissions"]);
							$_var_59 = iunserializer($_var_58["commission3"]);
							if (empty($_var_10)) {
								$_var_39 += isset($_var_59["level" . $_var_24["id"]]) ? $_var_59["level" . $_var_24["id"]] : $_var_59["default"];
							} else {
								$_var_39 += isset($_var_10["level3"]) ? $_var_10["level3"] : 0;
							}
						}
					}
					$_var_76 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where uniacid=:uniacid and agentid in( " . implode(",", array_keys($_var_69)) . ") and isagent=1 and status=1", array(":uniacid" => $_W["uniacid"]), "id");
					$_var_42 = count($_var_76);
					$_var_27 += $_var_42;
				}
			}
			$_var_23["agentcount"] = $_var_27;
			$_var_23["ordercount"] = $_var_30;
			$_var_23["ordermoney"] = $_var_31;
			$_var_23["order1"] = $_var_46;
			$_var_23["order2"] = $_var_47;
			$_var_23["order3"] = $_var_48;
			$_var_23["ordercount3"] = $_var_32;
			$_var_23["ordermoney3"] = $_var_33;
			$_var_23["order13"] = $_var_49;
			$_var_23["order23"] = $_var_50;
			$_var_23["order33"] = $_var_51;
			$_var_23["order13money"] = $_var_52;
			$_var_23["order23money"] = $_var_53;
			$_var_23["order33money"] = $_var_54;
			$_var_23["ordercount0"] = $_var_28;
			$_var_23["ordermoney0"] = $_var_29;
			$_var_23["order10"] = $_var_43;
			$_var_23["order20"] = $_var_44;
			$_var_23["order30"] = $_var_45;
			$_var_23["commission_total"] = round($_var_34, 2);
			$_var_23["commission_ok"] = round($_var_35, 2);
			$_var_23["commission_lock"] = round($_var_38, 2);
			$_var_23["commission_apply"] = round($_var_36, 2);
			$_var_23["commission_check"] = round($_var_37, 2);
			$_var_23["commission_pay"] = round($_var_39, 2);
			$_var_23["level1"] = $_var_40;
			$_var_23["level1_agentids"] = $_var_62;
			$_var_23["level2"] = $_var_41;
			$_var_23["level2_agentids"] = $_var_69;
			$_var_23["level3"] = $_var_42;
			$_var_23["level3_agentids"] = $_var_76;
			$_var_23["elapseddate"] = floor((time() - $_var_23["agenttime"]) / 86400) + 1;
			$_var_23["agenttime"] = date("Y-m-d H:i", $_var_23["agenttime"]);
			return $_var_23;
		}

		public function getAgents($_var_2 = 0)
		{
			global $_W, $_GPC;
			$_var_77 = array();
			$_var_78 = pdo_fetch("select id,agentid,openid from " . tablename("ewei_shop_order") . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (empty($_var_78)) {
				return $_var_77;
			}
			$_var_11 = m("member")->getMember($_var_78["agentid"]);
			if (!empty($_var_11) && $_var_11["isagent"] == 1 && $_var_11["status"] == 1) {
				$_var_77[] = $_var_11;
				if (!empty($_var_11["agentid"])) {
					$_var_13 = m("member")->getMember($_var_11["agentid"]);
					if (!empty($_var_13) && $_var_13["isagent"] == 1 && $_var_13["status"] == 1) {
						$_var_77[] = $_var_13;
						if (!empty($_var_13["agentid"])) {
							$_var_15 = m("member")->getMember($_var_13["agentid"]);
							if (!empty($_var_15) && $_var_15["isagent"] == 1 && $_var_15["status"] == 1) {
								$_var_77[] = $_var_15;
							}
						}
					}
				}
			}
			return $_var_77;
		}

		public function isAgent($_var_21)
		{
			if (empty($_var_21)) {
				return false;
			}
			if (is_array($_var_21)) {
				return $_var_21["isagent"] == 1 && $_var_21["status"] == 1;
			}
			$_var_23 = m("member")->getMember($_var_21);
			return $_var_23["isagent"] == 1 && $_var_23["status"] == 1;
		}

		public function getCommission($_var_6)
		{
			global $_W;
			$_var_1 = $this->getSet();
			$_var_59 = 0;
			if ($_var_6["hascommission"] == 1) {
				$_var_59 = $_var_1["level"] >= 1 ? ($_var_6["commission1_rate"] > 0 ? ($_var_6["commission1_rate"] * $_var_6["marketprice"] / 100) : $_var_6["commission1_pay"]) : 0;
			} else {
				$_var_21 = m("user")->getOpenid();
				$_var_9 = $this->getLevel($_var_21);
				if (!empty($_var_9)) {
					$_var_59 = $_var_1["level"] >= 1 ? round($_var_9["commission1"] * $_var_6["marketprice"] / 100, 2) : 0;
				} else {
					$_var_59 = $_var_1["level"] >= 1 ? round($_var_1["commission1"] * $_var_6["marketprice"] / 100, 2) : 0;
				}
			}
			return $_var_59;
		}

		public function createMyShopQrcode($_var_79 = 0, $_var_80 = 0)
		{
			global $_W;
			$_var_81 = IA_ROOT . "/addons/ewei_shop/data/qrcode/" . $_W["uniacid"];
			if (!is_dir($_var_81)) {
				load()->func("file");
				mkdirs($_var_81);
			}
			$_var_82 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=plugin&p=commission&method=myshop&mid=" . $_var_79;
			if (!empty($_var_80)) {
				$_var_82 .= "&posterid=" . $_var_80;
			}
			$_var_83 = "myshop_" . $_var_80 . "_" . $_var_79 . ".png";
			$_var_84 = $_var_81 . "/" . $_var_83;
			if (!is_file($_var_84)) {
				require IA_ROOT . "/framework/library/qrcode/phpqrcode.php";
				QRcode::png($_var_82, $_var_84, QR_ECLEVEL_H, 4);
			}
			return $_W["siteroot"] . "addons/ewei_shop/data/qrcode/" . $_W["uniacid"] . "/" . $_var_83;
		}

        public function createInviterQrcode($_var_79 = 0, $_var_80 = 0)
        {
            global $_W;
            $_var_81 = IA_ROOT . "/addons/ewei_shop/data/qrcode/" . $_W["uniacid"];
            if (!is_dir($_var_81)) {
                load()->func("file");
                mkdirs($_var_81);
            }
            $_var_82 = $_W['siteroot'] . 'app/index.php?i=' . $_W['uniacid'] . '&c=entry&m=ewei_shop&do=plugin&p=commission&method=register&inviter=' . $_var_79;
            if (!empty($_var_80)) {
                $_var_82 .= "&posterid=" . $_var_80;
            }
            $_var_83 = "inviter_" . $_var_80 . "_" . $_var_79 . ".png";
            $_var_84 = $_var_81 . "/" . $_var_83;
            if (!is_file($_var_84)) {
                require IA_ROOT . "/framework/library/qrcode/phpqrcode.php";
                QRcode::png($_var_82, $_var_84, QR_ECLEVEL_H, 4);
            }
            return $_W["siteroot"] . "addons/ewei_shop/data/qrcode/" . $_W["uniacid"] . "/" . $_var_83;
        }

		private function createImage($_var_82)
		{
			load()->func("communication");
			$_var_85 = ihttp_request($_var_82);
			return imagecreatefromstring($_var_85["content"]);
		}

		public function createGoodsImage($_var_6, $_var_86)
		{
			global $_W, $_GPC;
			$_var_6 = set_medias($_var_6, "thumb");
			$_var_21 = m("user")->getOpenid();
			$_var_87 = m("member")->getMember($_var_21);
			if ($_var_87["isagent"] == 1 && $_var_87["status"] == 1) {
				$_var_88 = $_var_87;
			} else {
				$_var_79 = intval($_GPC["mid"]);
				if (!empty($_var_79)) {
					$_var_88 = m("member")->getMember($_var_79);
				}
			}
			$_var_81 = IA_ROOT . "/addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/";
			if (!is_dir($_var_81)) {
				load()->func("file");
				mkdirs($_var_81);
			}
			$_var_89 = empty($_var_6["commission_thumb"]) ? $_var_6["thumb"] : tomedia($_var_6["commission_thumb"]);
			$_var_90 = md5(json_encode(array("id" => $_var_6["id"], "marketprice" => $_var_6["marketprice"], "productprice" => $_var_6["productprice"], "img" => $_var_89, "openid" => $_var_21, "version" => 4)));
			$_var_83 = $_var_90 . ".jpg";
			if (!is_file($_var_81 . $_var_83)) {
				set_time_limit(0);
				$_var_91 = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
				$_var_92 = imagecreatetruecolor(640, 1225);
				$_var_93 = imagecreatefromjpeg(IA_ROOT . "/addons/ewei_shop/plugin/commission/images/poster.jpg");
				imagecopy($_var_92, $_var_93, 0, 0, 0, 0, 640, 1225);
				imagedestroy($_var_93);
				$_var_94 = preg_replace("/\\/0\$/i", "/96", $_var_88["avatar"]);
				$_var_95 = $this->createImage($_var_94);
				$_var_96 = imagesx($_var_95);
				$_var_97 = imagesy($_var_95);
				imagecopyresized($_var_92, $_var_95, 24, 32, 0, 0, 88, 88, $_var_96, $_var_97);
				imagedestroy($_var_95);
				$_var_98 = $this->createImage($_var_89);
				$_var_96 = imagesx($_var_98);
				$_var_97 = imagesy($_var_98);
				imagecopyresized($_var_92, $_var_98, 0, 160, 0, 0, 640, 640, $_var_96, $_var_97);
				imagedestroy($_var_98);
				$_var_99 = imagecreatetruecolor(640, 127);
				imagealphablending($_var_99, false);
				imagesavealpha($_var_99, true);
				$_var_100 = imagecolorallocatealpha($_var_99, 0, 0, 0, 25);
				imagefill($_var_99, 0, 0, $_var_100);
				imagecopy($_var_92, $_var_99, 0, 678, 0, 0, 640, 127);
				imagedestroy($_var_99);
				$_var_101 = tomedia(m("qrcode")->createGoodsQrcode($_var_88["id"], $_var_6["id"]));
				$_var_102 = $this->createImage($_var_101);
				$_var_96 = imagesx($_var_102);
				$_var_97 = imagesy($_var_102);
				imagecopyresized($_var_92, $_var_102, 50, 835, 0, 0, 250, 250, $_var_96, $_var_97);
				imagedestroy($_var_102);
				$_var_103 = imagecolorallocate($_var_92, 0, 3, 51);
				$_var_104 = imagecolorallocate($_var_92, 240, 102, 0);
				$_var_105 = imagecolorallocate($_var_92, 255, 255, 255);
				$_var_106 = imagecolorallocate($_var_92, 255, 255, 0);
				$_var_107 = "我是";
				imagettftext($_var_92, 20, 0, 150, 70, $_var_103, $_var_91, $_var_107);
				imagettftext($_var_92, 20, 0, 210, 70, $_var_104, $_var_91, $_var_88["nickname"]);
				$_var_108 = "我要为";
				imagettftext($_var_92, 20, 0, 150, 105, $_var_103, $_var_91, $_var_108);
				$_var_109 = $_var_86["name"];
				imagettftext($_var_92, 20, 0, 240, 105, $_var_104, $_var_91, $_var_109);
				$_var_110 = imagettfbbox(20, 0, $_var_91, $_var_109);
				$_var_111 = $_var_110[4] - $_var_110[6];
				$_var_112 = "代言";
				imagettftext($_var_92, 20, 0, 240 + $_var_111 + 10, 105, $_var_103, $_var_91, $_var_112);
				$_var_113 = mb_substr($_var_6["title"], 0, 50, "utf-8");
				imagettftext($_var_92, 20, 0, 30, 730, $_var_105, $_var_91, $_var_113);
				$_var_114 = "￥" . number_format($_var_6["marketprice"], 2);
				imagettftext($_var_92, 25, 0, 25, 780, $_var_106, $_var_91, $_var_114);
				$_var_110 = imagettfbbox(26, 0, $_var_91, $_var_114);
				$_var_111 = $_var_110[4] - $_var_110[6];
				if ($_var_6["productprice"] > 0) {
					$_var_115 = "￥" . number_format($_var_6["productprice"], 2);
					imagettftext($_var_92, 22, 0, 25 + $_var_111 + 10, 780, $_var_105, $_var_91, $_var_115);
					$_var_116 = 25 + $_var_111 + 10;
					$_var_110 = imagettfbbox(22, 0, $_var_91, $_var_115);
					$_var_111 = $_var_110[4] - $_var_110[6];
					imageline($_var_92, $_var_116, 770, $_var_116 + $_var_111 + 20, 770, $_var_105);
					imageline($_var_92, $_var_116, 771.5, $_var_116 + $_var_111 + 20, 771, $_var_105);
				}
				imagejpeg($_var_92, $_var_81 . $_var_83);
				imagedestroy($_var_92);
			}
			return $_W["siteroot"] . "addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/" . $_var_83;
		}

		public function createShopImage($_var_86)
		{
			global $_W, $_GPC;
			$_var_86 = set_medias($_var_86, "signimg");
			$_var_81 = IA_ROOT . "/addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/";
			if (!is_dir($_var_81)) {
				load()->func("file");
				mkdirs($_var_81);
			}
			$_var_79 = intval($_GPC["mid"]);
			$_var_21 = m("user")->getOpenid();
			$_var_87 = m("member")->getMember($_var_21);
			if ($_var_87["isagent"] == 1 && $_var_87["status"] == 1) {
				$_var_88 = $_var_87;
			} else {
				$_var_79 = intval($_GPC["mid"]);
				if (!empty($_var_79)) {
					$_var_88 = m("member")->getMember($_var_79);
				}
			}
			$_var_90 = md5(json_encode(array("openid" => $_var_21, "version" => 4)));
			$_var_83 = $_var_90 . ".jpg";
			if (!is_file($_var_81 . $_var_83)) {
				set_time_limit(0);
				@ini_set("memory_limit", "256M");
				$_var_91 = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
				$_var_92 = imagecreatetruecolor(640, 1225);
				$_var_103 = imagecolorallocate($_var_92, 0, 3, 51);
				$_var_104 = imagecolorallocate($_var_92, 240, 102, 0);
				$_var_105 = imagecolorallocate($_var_92, 255, 255, 255);
				$_var_106 = imagecolorallocate($_var_92, 255, 255, 0);
				$_var_93 = imagecreatefromjpeg(IA_ROOT . "/addons/ewei_shop/plugin/commission/images/poster.jpg");
				imagecopy($_var_92, $_var_93, 0, 0, 0, 0, 640, 1225);
				imagedestroy($_var_93);
				$_var_94 = preg_replace("/\\/0\$/i", "/96", $_var_88["avatar"]);
				$_var_95 = $this->createImage($_var_94);
				$_var_96 = imagesx($_var_95);
				$_var_97 = imagesy($_var_95);
				imagecopyresized($_var_92, $_var_95, 24, 32, 0, 0, 88, 88, $_var_96, $_var_97);
				imagedestroy($_var_95);
				$_var_98 = $this->createImage($_var_86["signimg"]);
				$_var_96 = imagesx($_var_98);
				$_var_97 = imagesy($_var_98);
				imagecopyresized($_var_92, $_var_98, 0, 160, 0, 0, 640, 640, $_var_96, $_var_97);
				imagedestroy($_var_98);
				$_var_117 = tomedia($this->createMyShopQrcode($_var_88["id"]));
				$_var_102 = $this->createImage($_var_117);
				$_var_96 = imagesx($_var_102);
				$_var_97 = imagesy($_var_102);
				imagecopyresized($_var_92, $_var_102, 50, 835, 0, 0, 250, 250, $_var_96, $_var_97);
				imagedestroy($_var_102);
				$_var_107 = "我是";
				imagettftext($_var_92, 20, 0, 150, 70, $_var_103, $_var_91, $_var_107);
				imagettftext($_var_92, 20, 0, 210, 70, $_var_104, $_var_91, $_var_88["nickname"]);
				$_var_108 = "我要为";
				imagettftext($_var_92, 20, 0, 150, 105, $_var_103, $_var_91, $_var_108);
				$_var_109 = $_var_86["name"];
				imagettftext($_var_92, 20, 0, 240, 105, $_var_104, $_var_91, $_var_109);
				$_var_110 = imagettfbbox(20, 0, $_var_91, $_var_109);
                if($_var_110 == false){
                    $_var_111 = 220; // can be modified
                }
                else{
                    $_var_111 = abs($_var_110[2] - $_var_110[0]);
                    if($_var_110[0] < -1) {
                        $_var_111 = abs($_var_110[2]) + abs($_var_110[0]) - 1;
                    }
                }
				$_var_112 = "代言";
              //var_dump($_var_110);
				imagettftext($_var_92, 20, 0, 240 + $_var_111 + 10, 105, $_var_103, $_var_91, $_var_112);
				imagejpeg($_var_92, $_var_81 . $_var_83);
				imagedestroy($_var_92);
			}
			return $_W["siteroot"] . "addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/" . $_var_83;
		}

        public function createInviterImage($_var_86)
        {
            global $_W, $_GPC;
            $_var_86 = set_medias($_var_86, "signimg");
            $_var_81 = IA_ROOT . "/addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/";
            if (!is_dir($_var_81)) {
                load()->func("file");
                mkdirs($_var_81);
            }
            $_var_79 = intval($_GPC["mid"]);
            $_var_21 = m("user")->getOpenid();
            $_var_87 = m("member")->getMember($_var_21);
            if ($_var_87["isagent"] == 1 && $_var_87["status"] == 1) {
                $_var_88 = $_var_87;
            } else {
                $_var_79 = intval($_GPC["mid"]);
                if (!empty($_var_79)) {
                    $_var_88 = m("member")->getMember($_var_79);
                }
            }
            $_var_90 = md5(json_encode(array("openid" => $_var_21, "version" => 4,"type" => 'inviter')));
            $_var_83 = $_var_90 . ".jpg";
            if (!is_file($_var_81 . $_var_83)) {
                set_time_limit(0);
                @ini_set("memory_limit", "256M");
                $_var_91 = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
                $_var_92 = imagecreatetruecolor(640, 1225);
                $_var_103 = imagecolorallocate($_var_92, 0, 3, 51);
                $_var_104 = imagecolorallocate($_var_92, 240, 102, 0);
                $_var_105 = imagecolorallocate($_var_92, 255, 255, 255);
                $_var_106 = imagecolorallocate($_var_92, 255, 255, 0);
                $_var_93 = imagecreatefromjpeg(IA_ROOT . "/addons/ewei_shop/plugin/commission/images/poster1.jpg");
                imagecopy($_var_92, $_var_93, 0, 0, 0, 0, 640, 1225);
                imagedestroy($_var_93);
                $_var_94 = preg_replace("/\\/0\$/i", "/96", $_var_88["avatar"]);
                $_var_95 = $this->createImage($_var_94);
                $_var_96 = imagesx($_var_95);
                $_var_97 = imagesy($_var_95);
                imagecopyresized($_var_92, $_var_95, 24, 32, 0, 0, 88, 88, $_var_96, $_var_97);
                imagedestroy($_var_95);
                $a ="http://wechat.52wzj.com/addons/ewei_shop/plugin/commission/images/tuijian.jpg";
               // var_dump($a);exit;
                $_var_98 = $this->createImage($a);
                $_var_96 = imagesx($_var_98);
                $_var_97 = imagesy($_var_98);
                imagecopyresized($_var_92, $_var_98, 0, 160, 0, 0, 640, 640, $_var_96, $_var_97);
                imagedestroy($_var_98);
                $_var_117 = tomedia($this->createInviterQrcode($_var_88["id"]));
                $_var_102 = $this->createImage($_var_117);
                $_var_96 = imagesx($_var_102);
                $_var_97 = imagesy($_var_102);
                imagecopyresized($_var_92, $_var_102, 50, 835, 0, 0, 250, 250, $_var_96, $_var_97);
                imagedestroy($_var_102);
                $_var_107 = "我是";
                imagettftext($_var_92, 20, 0, 150, 70, $_var_103, $_var_91, $_var_107);
                imagettftext($_var_92, 20, 0, 210, 70, $_var_104, $_var_91, $_var_88["nickname"]);
                $_var_108 = "我要为";
                imagettftext($_var_92, 20, 0, 150, 105, $_var_103, $_var_91, $_var_108);
                $_var_109 = $_var_86["name"];
                imagettftext($_var_92, 20, 0, 240, 105, $_var_104, $_var_91, $_var_109);
                $_var_110 = imagettfbbox(20, 0, $_var_91, $_var_109);
                if($_var_110 == false){
                    $_var_111 = 220; // can be modified
                }
                else{
                    $_var_111 = abs($_var_110[2] - $_var_110[0]);
                    if($_var_110[0] < -1) {
                        $_var_111 = abs($_var_110[2]) + abs($_var_110[0]) - 1;
                    }
                }
                $_var_112 = "代言";
                //var_dump($_var_110);
                imagettftext($_var_92, 20, 0, 240 + $_var_111 + 10, 105, $_var_103, $_var_91, $_var_112);
                imagejpeg($_var_92, $_var_81 . $_var_83);
                imagedestroy($_var_92);
            }
            return $_W["siteroot"] . "addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/" . $_var_83;
        }

        public function welcomewzj(){
            global $_W, $_GPC;
            $_var_21 = m("user")->getOpenid();
            if (empty($_var_21)) {
                return;
            }
            $_var_23 = m("member")->getMember($_var_21);
            if (empty($_var_23)) {
                return;
            }
            $_var_118 = false;
            $_var_79 = intval($_GPC["mid"]);
            if (!empty($_var_79)) {
                $_var_118 = m("member")->getMember($_var_79);
            }
            if($_var_23['agentid'] == $_var_118['id']){

                $this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => time()), TM_COMMISSION_WELCOME);
            }

        }

		public function checkAgent()
		{
			global $_W, $_GPC;
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return;
			}
			$_var_21 = m("user")->getOpenid();
			if (empty($_var_21)) {
				return;
			}
			$_var_23 = m("member")->getMember($_var_21);
			if (empty($_var_23)) {
				return;
			}
			$_var_118 = false;
			$_var_79 = intval($_GPC["mid"]);
			if (!empty($_var_79)) {
				$_var_118 = m("member")->getMember($_var_79);
			}
			$_var_119 = !empty($_var_118) && $_var_118["isagent"] == 1 && $_var_118["status"] == 1;





			if ($_var_119) {



				if ($_var_118["openid"] != $_var_21) {
                   // $this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => time()), TM_COMMISSION_WELCOME);
					$_var_120 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_commission_clickcount") . " where uniacid=:uniacid and openid=:openid and from_openid=:from_openid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21, ":from_openid" => $_var_118["openid"]));
					if ($_var_120 <= 0) {
						$_var_121 = array("uniacid" => $_W["uniacid"], "openid" => $_var_21, "from_openid" => $_var_118["openid"], "clicktime" => time());
						pdo_insert("ewei_shop_commission_clickcount", $_var_121);
						pdo_update("ewei_shop_member", array("clickcount" => $_var_118["clickcount"] + 1), array("uniacid" => $_W["uniacid"], "id" => $_var_118["id"]));
					}
				}
			}
			if ($_var_23["isagent"] == 1) {
				return;
			}
			if ($_var_122 == 0) {
				$_var_123 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_member") . " where id<>:id and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":id" => $_var_23["id"]));
				if ($_var_123 <= 0) {
					pdo_update("ewei_shop_member", array("isagent" => 1, "status" => 1, "agenttime" => time(), "agentblack" => 0), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
					return;
				}
			}
			$_var_25 = time();
			$_var_124 = intval($_var_1["become_child"]);
            if(empty($_var_118["openid"] )){
                $this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => time()), TM_COMMISSION_WELCOME);
            }



			if ($_var_119 && empty($_var_23["agentid"])) {

				if ($_var_23["id"] != $_var_118["id"]) {

					if (empty($_var_124)) {

						if (empty($_var_23["fixagentid"])) {
							pdo_update("ewei_shop_member", array("agentid" => $_var_118["id"], "childtime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
							$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "childtime" => $_var_25), TM_COMMISSION_AGENT_NEW);
							$this->upgradeLevelByAgent($_var_118["id"]);
						}
					} else {
						pdo_update("ewei_shop_member", array("inviter" => $_var_118["id"]), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
					}
				}
			}
			$_var_125 = intval($_var_1["become_check"]);
			if (empty($_var_1["become"])) {
				if (empty($_var_23["agentblack"])) {
					pdo_update("ewei_shop_member", array("isagent" => 1, "status" => $_var_125, "agenttime" => $_var_125 == 1 ? $_var_25 : 0), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));

//					$creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_23["uid"]."' ");
//                    $creditnow = $creditold['credit1'] + 200;
//					pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"]));
//					pdo_insert("mc_credits_record", array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));
//
//
//
//					$credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_118["uid"]."' ");
//					$credit1top = $credittop['credit1'] + 200 ;
//					pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $_var_118["uid"]));
//					pdo_insert("mc_credits_record", array("uid" =>  $_var_118["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));


					if ($_var_125 == 1) {



						$this->sendMessage($_var_21, array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_BECOME);
						$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_AGENT_NEWPER);
						if ($_var_119) {
							$this->upgradeLevelByAgent($_var_118["id"]);
						}
					}
				}
			}
		}

		public function checkOrderConfirm($_var_2 = '0')
		{
			global $_W, $_GPC;
			if (empty($_var_2)) {
				return;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return;
			}
			$_var_78 = pdo_fetch("select id,openid,ordersn,goodsprice,agentid,paytime from " . tablename("ewei_shop_order") . " where id=:id and status>=0 and uniacid=:uniacid limit 1", array(":id" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (empty($_var_78)) {
				return;
			}
			$_var_21 = $_var_78["openid"];
			$_var_23 = m("member")->getMember($_var_21);
			if (empty($_var_23)) {
				return;
			}
			$_var_124 = intval($_var_1["become_child"]);
			$_var_118 = false;
			if (empty($_var_124)) {
				$_var_118 = m("member")->getMember($_var_23["agentid"]);
			} else {
				$_var_118 = m("member")->getMember($_var_23["inviter"]);
			}
			$_var_119 = !empty($_var_118) && $_var_118["isagent"] == 1 && $_var_118["status"] == 1;
			$_var_25 = time();
			$_var_124 = intval($_var_1["become_child"]);
			if ($_var_119) {
				if ($_var_124 == 1) {
					if (empty($_var_23["agentid"]) && $_var_23["id"] != $_var_118["id"]) {
						if (empty($_var_23["fixagentid"])) {
							$_var_23["agentid"] = $_var_118["id"];
							pdo_update("ewei_shop_member", array("agentid" => $_var_118["id"], "childtime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
							$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "childtime" => $_var_25), TM_COMMISSION_AGENT_NEW);
							$this->upgradeLevelByAgent($_var_118["id"]);
						}
					}
				}
			}
			$_var_5 = $_var_23["agentid"];
			if ($_var_23["isagent"] == 1 && $_var_23["status"] == 1) {
				if (!empty($_var_1["selfbuy"])) {
					$_var_5 = $_var_23["id"];
				}
			}
			if (!empty($_var_5)) {
				pdo_update("ewei_shop_order", array("agentid" => $_var_5), array("id" => $_var_2));
			}
			$this->calculate($_var_2);
		}

		public function checkOrderPay($_var_2 = '0')
		{
			global $_W, $_GPC;
			if (empty($_var_2)) {
				return;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return;
			}
			$_var_78 = pdo_fetch("select id,openid,ordersn,goodsprice,agentid,paytime from " . tablename("ewei_shop_order") . " where id=:id and status>=1 and uniacid=:uniacid limit 1", array(":id" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (empty($_var_78)) {
				return;
			}
			$_var_21 = $_var_78["openid"];
			$_var_23 = m("member")->getMember($_var_21);
			if (empty($_var_23)) {
				return;
			}
			$_var_124 = intval($_var_1["become_child"]);
			$_var_118 = false;
			if (empty($_var_124)) {
				$_var_118 = m("member")->getMember($_var_23["agentid"]);
			} else {
				$_var_118 = m("member")->getMember($_var_23["inviter"]);
			}
			$_var_119 = !empty($_var_118) && $_var_118["isagent"] == 1 && $_var_118["status"] == 1;
			$_var_25 = time();
			$_var_124 = intval($_var_1["become_child"]);
			if ($_var_119) {
				if ($_var_124 == 2) {
					if (empty($_var_23["agentid"]) && $_var_23["id"] != $_var_118["id"]) {
						if (empty($_var_23["fixagentid"])) {
							$_var_23["agentid"] = $_var_118["id"];
							pdo_update("ewei_shop_member", array("agentid" => $_var_118["id"], "childtime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
							$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "childtime" => $_var_25), TM_COMMISSION_AGENT_NEW);
							$this->upgradeLevelByAgent($_var_118["id"]);
							if (empty($_var_78["agentid"])) {
								$_var_78["agentid"] = $_var_118["id"];
								pdo_update("ewei_shop_order", array("agentid" => $_var_118["id"]), array("id" => $_var_2));
								$this->calculate($_var_2);
							}
						}
					}
				}
			}
			$_var_126 = $_var_23["isagent"] == 1 && $_var_23["status"] == 1;
			if (!$_var_126) {
				if (intval($_var_1["become"]) == 4 && !empty($_var_1["become_goodsid"])) {
					$_var_127 = pdo_fetchall("select goodsid from " . tablename("ewei_shop_order_goods") . " where orderid=:orderid and uniacid=:uniacid  ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_78["id"]), "goodsid");
					if (in_array($_var_1["become_goodsid"], array_keys($_var_127))) {
						if (empty($_var_23["agentblack"])) {
							pdo_update("ewei_shop_member", array("status" => 1, "isagent" => 1, "agenttime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));

//							$creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_23["uid"]."' ");
//							$creditnow = $creditold['credit1'] + 200;
//							pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"]));
//							pdo_insert("mc_credits_record", array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));
//
//							$credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_118["uid"]."' ");
//							$credit1top = $credittop['credit1'] + 200 ;
//							pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $_var_118["uid"]));
//							pdo_insert("mc_credits_record", array("uid" =>  $_var_118["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));

							$this->sendMessage($_var_21, array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_BECOME);
							$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_AGENT_NEWPER);
							if (!empty($_var_118)) {
								$this->upgradeLevelByAgent($_var_118["id"]);
							}
						}
					}
				} else if ($_var_1["become"] == 2 || $_var_1["become"] == 3) {
					if (empty($_var_1["become_order"])) {
						$_var_25 = time();
						if ($_var_1["become"] == 2 || $_var_1["become"] == 3) {
							$_var_128 = true;
							if (!empty($_var_23["agentid"])) {
								$_var_118 = m("member")->getMember($_var_23["agentid"]);
								if (empty($_var_118) || $_var_118["isagent"] != 1 || $_var_118["status"] != 1) {
									$_var_128 = false;
								}
							}
							if ($_var_128) {
								$_var_129 = false;
								if ($_var_1["become"] == "2") {
									$_var_30 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_order") . " where openid=:openid and status>=1 and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21));
									$_var_129 = $_var_30 >= intval($_var_1["become_ordercount"]);
								} else if ($_var_1["become"] == "3") {
									$_var_130 = pdo_fetchcolumn("select sum(og.realprice) from " . tablename("ewei_shop_order_goods") . " og left join " . tablename("ewei_shop_order") . " o on og.orderid=o.id  where o.openid=:openid and o.status>=1 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21));
									$_var_129 = $_var_130 >= floatval($_var_1["become_moneycount"]);
								}
								if ($_var_129) {
									if (empty($_var_23["agentblack"])) {
										$_var_125 = intval($_var_1["become_check"]);
										pdo_update("ewei_shop_member", array("status" => $_var_125, "isagent" => 1, "agenttime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
//										$creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_23["uid"]."' ");
//										$creditnow = $creditold['credit1'] + 200;
//										pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"]));
//										pdo_insert("mc_credits_record", array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));
//
//										$credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_118["uid"]."' ");
//										$credit1top = $credittop['credit1'] + 200 ;
//										pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $_var_118["uid"]));
//										pdo_insert("mc_credits_record", array("uid" =>  $_var_118["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));

										if ($_var_125 == 1) {
											$this->sendMessage($_var_21, array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_BECOME);
											$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_AGENT_NEWPER);
											if ($_var_128) {
												$this->upgradeLevelByAgent($_var_118["id"]);
											}
										}
									}
								}
							}
						}
					}
				}
			}
			if (!empty($_var_23["agentid"])) {
				$_var_118 = m("member")->getMember($_var_23["agentid"]);
				if (!empty($_var_118) && $_var_118["isagent"] == 1 && $_var_118["status"] == 1) {
					if ($_var_78["agentid"] == $_var_118["id"]) {
						$_var_127 = pdo_fetchall('select g.id,g.title,og.total,og.price,og.realprice, og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission1 from ' . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . " where og.uniacid=:uniacid and og.orderid=:orderid ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_78["id"]));
						$_var_6 = '';
						$_var_9 = $_var_118["agentlevel"];
						$_var_34 = 0;
						$_var_131 = 0;
						foreach ($_var_127 as $_var_132) {
							$_var_6 .= "" . $_var_132["title"] . "( ";
							if (!empty($_var_132["optiontitle"])) {
								$_var_6 .= " 规格: " . $_var_132["optiontitle"];
							}
							$_var_6 .= " 单价: " . ($_var_132["realprice"] / $_var_132["total"]) . " 数量: " . $_var_132["total"] . " 总价: " . $_var_132["realprice"] . "); ";
							$_var_59 = iunserializer($_var_132["commission1"]);
							$_var_34 += isset($_var_59["level" . $_var_9]) ? $_var_59["level" . $_var_9] : $_var_59["default"];
							$_var_131 += $_var_132["realprice"];
						}
						$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "ordersn" => $_var_78["ordersn"], "price" => $_var_131, "goods" => $_var_6, "commission" => $_var_34, "paytime" => $_var_78["paytime"],), TM_COMMISSION_ORDER_PAY);
					}
				}
			}
		}

		public function checkOrderFinish($_var_2 = '')
		{
			global $_W, $_GPC;
			if (empty($_var_2)) {
				return;
			}
			$_var_78 = pdo_fetch("select id,openid, ordersn,goodsprice,agentid,finishtime from " . tablename("ewei_shop_order") . " where id=:id and status>=3 and uniacid=:uniacid limit 1", array(":id" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (empty($_var_78)) {
				return;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return;
			}
			$_var_21 = $_var_78["openid"];
			$_var_23 = m("member")->getMember($_var_21);
			if (empty($_var_23)) {
				return;
			}
			$_var_25 = time();
			$_var_126 = $_var_23["isagent"] == 1 && $_var_23["status"] == 1;
			if (!$_var_126 && $_var_1["become_order"] == 1) {
				if ($_var_1["become"] == 2 || $_var_1["become"] == 3) {
					$_var_128 = true;
					if (!empty($_var_23["agentid"])) {
						$_var_118 = m("member")->getMember($_var_23["agentid"]);
						if (empty($_var_118) || $_var_118["isagent"] != 1 || $_var_118["status"] != 1) {
							$_var_128 = false;
						}
					}
					if ($_var_128) {
						$_var_129 = false;
						if ($_var_1["become"] == "2") {
							$_var_30 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_order") . " where openid=:openid and status>=3 and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21));
							$_var_129 = $_var_30 >= intval($_var_1["become_ordercount"]);
						} else if ($_var_1["become"] == "3") {
							$_var_130 = pdo_fetchcolumn("select sum(goodsprice) from " . tablename("ewei_shop_order") . " where openid=:openid and status>=3 and uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21));
							$_var_129 = $_var_130 >= floatval($_var_1["become_moneycount"]);
						}
						if ($_var_129) {
							if (empty($_var_23["agentblack"])) {
								$_var_125 = intval($_var_1["become_check"]);
								pdo_update("ewei_shop_member", array("status" => $_var_125, "isagent" => 1, "agenttime" => $_var_25), array("uniacid" => $_W["uniacid"], "id" => $_var_23["id"]));
//								$creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_23["uid"]."' ");
//								$creditnow = $creditold['credit1'] + 200;
//								pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"]));
//								pdo_insert("mc_credits_record", array("uid" => $_var_23["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));
//
//								$credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$_var_118["uid"]."' ");
//								$credit1top = $credittop['credit1'] + 200 ;
//								pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $_var_118["uid"]));
//								pdo_insert("mc_credits_record", array("uid" =>  $_var_118["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));
//
								
								if ($_var_125 == 1) {
									$this->sendMessage($_var_23["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_BECOME);
									$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "agenttime" => $_var_25), TM_COMMISSION_AGENT_NEWPER);
									if ($_var_128) {
										$this->upgradeLevelByAgent($_var_118["id"]);
									}
								}
							}
						}
					}
				}
			}
			if (!empty($_var_23["agentid"])) {
				$_var_118 = m("member")->getMember($_var_23["agentid"]);
				if (!empty($_var_118) && $_var_118["isagent"] == 1 && $_var_118["status"] == 1) {
					if ($_var_78["agentid"] == $_var_118["id"]) {
						$_var_127 = pdo_fetchall('select g.id,g.title,og.total,og.realprice,og.price,og.optionname as optiontitle,g.noticeopenid,g.noticetype,og.commission1 from ' . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . " where og.uniacid=:uniacid and og.orderid=:orderid ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_78["id"]));
						$_var_6 = '';
						$_var_9 = $_var_118["agentlevel"];
						$_var_34 = 0;
						$_var_131 = 0;
						foreach ($_var_127 as $_var_132) {
							$_var_6 .= "" . $_var_132["title"] . "( ";
							if (!empty($_var_132["optiontitle"])) {
								$_var_6 .= " 规格: " . $_var_132["optiontitle"];
							}
							$_var_6 .= " 单价: " . ($_var_132["realprice"] / $_var_132["total"]) . " 数量: " . $_var_132["total"] . " 总价: " . $_var_132["realprice"] . "); ";
							$_var_59 = iunserializer($_var_132["commission1"]);
							$_var_34 += isset($_var_59["level" . $_var_9]) ? $_var_59["level" . $_var_9] : $_var_59["default"];
							$_var_131 += $_var_132["realprice"];
						}
						$this->sendMessage($_var_118["openid"], array("nickname" => $_var_23["nickname"], "ordersn" => $_var_78["ordersn"], "price" => $_var_131, "goods" => $_var_6, "commission" => $_var_34, "finishtime" => $_var_78["finishtime"],), TM_COMMISSION_ORDER_FINISH);
					}
				}
			}
			$this->upgradeLevelByOrder($_var_21);
		}

		function getShop($_var_133)
		{
			global $_W;
			$_var_23 = m("member")->getMember($_var_133);
			$_var_134 = pdo_fetch("select * from " . tablename("ewei_shop_commission_shop") . " where uniacid=:uniacid and mid=:mid limit 1", array(":uniacid" => $_W["uniacid"], ":mid" => $_var_23["id"]));
			$_var_135 = m("common")->getSysset(array("shop", "share"));
			$_var_1 = $_var_135["shop"];
			$_var_136 = $_var_135["share"];
			$_var_137 = $_var_136["desc"];
			if (empty($_var_137)) {
				$_var_137 = $_var_1["description"];
			}
			if (empty($_var_137)) {
				$_var_137 = $_var_1["name"];
			}
			$_var_138 = $this->getSet();
			if (empty($_var_134)) {
				$_var_134 = array("name" => $_var_23["nickname"] . "的" . $_var_138["texts"]["shop"], "logo" => $_var_23["avatar"], "desc" => $_var_137, "img" => tomedia($_var_1["img"]),);
			} else {
				if (empty($_var_134["name"])) {
					$_var_134["name"] = $_var_23["nickname"] . "的" . $_var_138["texts"]["shop"];
				}
				if (empty($_var_134["logo"])) {
					$_var_134["logo"] = tomedia($_var_23["avatar"]);
				}
				if (empty($_var_134["img"])) {
					$_var_134["img"] = tomedia($_var_1["img"]);
				}
				if (empty($_var_134["desc"])) {
					$_var_134["desc"] = $_var_137;
				}
			}
			return $_var_134;
		}

		function getLevels($_var_139 = true)
		{
			global $_W;
			if ($_var_139) {
				return pdo_fetchall("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid order by commission1 asc", array(":uniacid" => $_W["uniacid"]));
			} else {
				return pdo_fetchall("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid and (ordermoney>0 or commissionmoney>0) order by commission1 asc", array(":uniacid" => $_W["uniacid"]));
			}
		}

		function getLevel($_var_21)
		{
			global $_W;
			if (empty($_var_21)) {
				return false;
			}
			$_var_23 = m("member")->getMember($_var_21);
			if (empty($_var_23["agentlevel"])) {
				return false;
			}
			$_var_9 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid and id=:id limit 1", array(":uniacid" => $_W["uniacid"], ":id" => $_var_23["agentlevel"]));
			return $_var_9;
		}

		function upgradeLevelByOrder($_var_21)
		{
			global $_W;
			if (empty($_var_21)) {
				return false;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return false;
			}
			$_var_133 = m("member")->getMember($_var_21);
			if (empty($_var_133)) {
				return;
			}
			$_var_140 = intval($_var_1["leveltype"]);
			if ($_var_140 == 4 || $_var_140 == 5) {
				if (!empty($_var_133["agentnotupgrade"])) {
					return;
				}
				$_var_141 = $this->getLevel($_var_133["openid"]);
				if (empty($_var_141["id"])) {
					$_var_141 = array("levelname" => empty($_var_1["levelname"]) ? "普通等级" : $_var_1["levelname"], "commission1" => $_var_1["commission1"], "commission2" => $_var_1["commission2"], "commission3" => $_var_1["commission3"]);
				}
				$_var_142 = pdo_fetch("select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from " . tablename("ewei_shop_order") . " o " . " left join  " . tablename("ewei_shop_order_goods") . " og on og.orderid=o.id " . " where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $_var_21));
				$_var_31 = $_var_142["ordermoney"];
				$_var_30 = $_var_142["ordercount"];
				if ($_var_140 == 4) {
					$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_31} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(":uniacid" => $_W["uniacid"]));
					if (empty($_var_143)) {
						return;
					}
					if (!empty($_var_141["id"])) {
						if ($_var_141["id"] == $_var_143["id"]) {
							return;
						}
						if ($_var_141["ordermoney"] > $_var_143["ordermoney"]) {
							return;
						}
					}
				} else if ($_var_140 == 5) {
					$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_30} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(":uniacid" => $_W["uniacid"]));
					if (empty($_var_143)) {
						return;
					}
					if (!empty($_var_141["id"])) {
						if ($_var_141["id"] == $_var_143["id"]) {
							return;
						}
						if ($_var_141["ordercount"] > $_var_143["ordercount"]) {
							return;
						}
					}
				}
				pdo_update("ewei_shop_member", array("agentlevel" => $_var_143["id"]), array("id" => $_var_133["id"]));
				$this->sendMessage($_var_133["openid"], array("nickname" => $_var_133["nickname"], "oldlevel" => $_var_141, "newlevel" => $_var_143,), TM_COMMISSION_UPGRADE);
			} else if ($_var_140 >= 0 && $_var_140 <= 3) {
				$_var_77 = array();
				if (!empty($_var_1["selfbuy"])) {
					$_var_77[] = $_var_133;
				}
				if (!empty($_var_133["agentid"])) {
					$_var_11 = m("member")->getMember($_var_133["agentid"]);
					if (!empty($_var_11)) {
						$_var_77[] = $_var_11;
						if (!empty($_var_11["agentid"]) && $_var_11["isagent"] == 1 && $_var_11["status"] == 1) {
							$_var_13 = m("member")->getMember($_var_11["agentid"]);
							if (!empty($_var_13) && $_var_13["isagent"] == 1 && $_var_13["status"] == 1) {
								$_var_77[] = $_var_13;
								if (empty($_var_1["selfbuy"])) {
									if (!empty($_var_13["agentid"]) && $_var_13["isagent"] == 1 && $_var_13["status"] == 1) {
										$_var_15 = m("member")->getMember($_var_13["agentid"]);
										if (!empty($_var_15) && $_var_15["isagent"] == 1 && $_var_15["status"] == 1) {
											$_var_77[] = $_var_15;
										}
									}
								}
							}
						}
					}
				}
				if (empty($_var_77)) {
					return;
				}
				foreach ($_var_77 as $_var_144) {
					$_var_145 = $this->getInfo($_var_144["id"], array("ordercount3", "ordermoney3", "order13money", "order13"));
					if (!empty($_var_145["agentnotupgrade"])) {
						continue;
					}
					$_var_141 = $this->getLevel($_var_144["openid"]);
					if (empty($_var_141["id"])) {
						$_var_141 = array("levelname" => empty($_var_1["levelname"]) ? "普通等级" : $_var_1["levelname"], "commission1" => $_var_1["commission1"], "commission2" => $_var_1["commission2"], "commission3" => $_var_1["commission3"]);
					}
					if ($_var_140 == 0) {
						$_var_31 = $_var_145["ordermoney3"];
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid and {$_var_31} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(":uniacid" => $_W["uniacid"]));
						if (empty($_var_143)) {
							continue;
						}
						if (!empty($_var_141["id"])) {
							if ($_var_141["id"] == $_var_143["id"]) {
								continue;
							}
							if ($_var_141["ordermoney"] > $_var_143["ordermoney"]) {
								continue;
							}
						}
					} else if ($_var_140 == 1) {
						$_var_31 = $_var_145["order13money"];
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid and {$_var_31} >= ordermoney and ordermoney>0  order by ordermoney desc limit 1", array(":uniacid" => $_W["uniacid"]));
						if (empty($_var_143)) {
							continue;
						}
						if (!empty($_var_141["id"])) {
							if ($_var_141["id"] == $_var_143["id"]) {
								continue;
							}
							if ($_var_141["ordermoney"] > $_var_143["ordermoney"]) {
								continue;
							}
						}
					} else if ($_var_140 == 2) {
						$_var_30 = $_var_145["ordercount3"];
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_30} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(":uniacid" => $_W["uniacid"]));
						if (empty($_var_143)) {
							continue;
						}
						if (!empty($_var_141["id"])) {
							if ($_var_141["id"] == $_var_143["id"]) {
								continue;
							}
							if ($_var_141["ordercount"] > $_var_143["ordercount"]) {
								continue;
							}
						}
					} else if ($_var_140 == 3) {
						$_var_30 = $_var_145["order13"];
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_30} >= ordercount and ordercount>0  order by ordercount desc limit 1", array(":uniacid" => $_W["uniacid"]));
						if (empty($_var_143)) {
							continue;
						}
						if (!empty($_var_141["id"])) {
							if ($_var_141["id"] == $_var_143["id"]) {
								continue;
							}
							if ($_var_141["ordercount"] > $_var_143["ordercount"]) {
								continue;
							}
						}
					}
					pdo_update("ewei_shop_member", array("agentlevel" => $_var_143["id"]), array("id" => $_var_144["id"]));
					$this->sendMessage($_var_144["openid"], array("nickname" => $_var_144["nickname"], "oldlevel" => $_var_141, "newlevel" => $_var_143,), TM_COMMISSION_UPGRADE);
				}
			}
		}

		function upgradeLevelByAgent($_var_21)
		{
			global $_W;
			if (empty($_var_21)) {
				return false;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return false;
			}
			$_var_133 = m("member")->getMember($_var_21);
			if (empty($_var_133)) {
				return;
			}
			$_var_140 = intval($_var_1["leveltype"]);
			if ($_var_140 < 6 || $_var_140 > 9) {
				return;
			}
			$_var_145 = $this->getInfo($_var_133["id"], array());
			if ($_var_140 == 6 || $_var_140 == 8) {
				$_var_77 = array($_var_133);
				if (!empty($_var_133["agentid"])) {
					$_var_11 = m("member")->getMember($_var_133["agentid"]);
					if (!empty($_var_11)) {
						$_var_77[] = $_var_11;
						if (!empty($_var_11["agentid"]) && $_var_11["isagent"] == 1 && $_var_11["status"] == 1) {
							$_var_13 = m("member")->getMember($_var_11["agentid"]);
							if (!empty($_var_13) && $_var_13["isagent"] == 1 && $_var_13["status"] == 1) {
								$_var_77[] = $_var_13;
							}
						}
					}
				}
				if (empty($_var_77)) {
					return;
				}
				foreach ($_var_77 as $_var_144) {
					$_var_145 = $this->getInfo($_var_144["id"], array());
					if (!empty($_var_145["agentnotupgrade"])) {
						continue;
					}
					$_var_141 = $this->getLevel($_var_144["openid"]);
					if (empty($_var_141["id"])) {
						$_var_141 = array("levelname" => empty($_var_1["levelname"]) ? "普通等级" : $_var_1["levelname"], "commission1" => $_var_1["commission1"], "commission2" => $_var_1["commission2"], "commission3" => $_var_1["commission3"]);
					}
					if ($_var_140 == 6) {
						$_var_146 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where agentid=:agentid and uniacid=:uniacid ", array(":agentid" => $_var_133["id"], ":uniacid" => $_W["uniacid"]), "id");
						$_var_147 += count($_var_146);
						if (!empty($_var_146)) {
							$_var_148 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where agentid in( " . implode(",", array_keys($_var_146)) . ") and uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]), "id");
							$_var_147 += count($_var_148);
							if (!empty($_var_148)) {
								$_var_149 = pdo_fetchall("select id from " . tablename("ewei_shop_member") . " where agentid in( " . implode(",", array_keys($_var_148)) . ") and uniacid=:uniacid", array(":uniacid" => $_W["uniacid"]), "id");
								$_var_147 += count($_var_149);
							}
						}
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_147} >= downcount and downcount>0  order by downcount desc limit 1", array(":uniacid" => $_W["uniacid"]));
					} else if ($_var_140 == 8) {
						$_var_147 = $_var_145["level1"] + $_var_145["level2"] + $_var_145["level3"];
						$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_147} >= downcount and downcount>0  order by downcount desc limit 1", array(":uniacid" => $_W["uniacid"]));
					}
					if (empty($_var_143)) {
						continue;
					}
					if ($_var_143["id"] == $_var_141["id"]) {
						continue;
					}
					if (!empty($_var_141["id"])) {
						if ($_var_141["downcount"] > $_var_143["downcount"]) {
							continue;
						}
					}
					pdo_update("ewei_shop_member", array("agentlevel" => $_var_143["id"]), array("id" => $_var_144["id"]));
					$this->sendMessage($_var_144["openid"], array("nickname" => $_var_144["nickname"], "oldlevel" => $_var_141, "newlevel" => $_var_143,), TM_COMMISSION_UPGRADE);
				}
			} else {
				if (!empty($_var_133["agentnotupgrade"])) {
					return;
				}
				$_var_141 = $this->getLevel($_var_133["openid"]);
				if (empty($_var_141["id"])) {
					$_var_141 = array("levelname" => empty($_var_1["levelname"]) ? "普通等级" : $_var_1["levelname"], "commission1" => $_var_1["commission1"], "commission2" => $_var_1["commission2"], "commission3" => $_var_1["commission3"]);
				}
				if ($_var_140 == 7) {
					$_var_147 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_member") . " where agentid=:agentid and uniacid=:uniacid ", array(":agentid" => $_var_133["id"], ":uniacid" => $_W["uniacid"]));
					$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_147} >= downcount and downcount>0  order by downcount desc limit 1", array(":uniacid" => $_W["uniacid"]));
				} else if ($_var_140 == 9) {
					$_var_147 = $_var_145["level1"];
					$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_147} >= downcount and downcount>0  order by downcount desc limit 1", array(":uniacid" => $_W["uniacid"]));
				}
				if (empty($_var_143)) {
					return;
				}
				if ($_var_143["id"] == $_var_141["id"]) {
					return;
				}
				if (!empty($_var_141["id"])) {
					if ($_var_141["downcount"] > $_var_143["downcount"]) {
						return;
					}
				}
				pdo_update("ewei_shop_member", array("agentlevel" => $_var_143["id"]), array("id" => $_var_133["id"]));
				$this->sendMessage($_var_133["openid"], array("nickname" => $_var_133["nickname"], "oldlevel" => $_var_141, "newlevel" => $_var_143,), TM_COMMISSION_UPGRADE);
			}
		}

		function upgradeLevelByCommissionOK($_var_21)
		{
			global $_W;
			if (empty($_var_21)) {
				return false;
			}
			$_var_1 = $this->getSet();
			if (empty($_var_1["level"])) {
				return false;
			}
			$_var_133 = m("member")->getMember($_var_21);
			if (empty($_var_133)) {
				return;
			}
			$_var_140 = intval($_var_1["leveltype"]);
			if ($_var_140 != 10) {
				return;
			}
			if (!empty($_var_133["agentnotupgrade"])) {
				return;
			}
			$_var_141 = $this->getLevel($_var_133["openid"]);
			if (empty($_var_141["id"])) {
				$_var_141 = array("levelname" => empty($_var_1["levelname"]) ? "普通等级" : $_var_1["levelname"], "commission1" => $_var_1["commission1"], "commission2" => $_var_1["commission2"], "commission3" => $_var_1["commission3"]);
			}
			$_var_145 = $this->getInfo($_var_133["id"], array("pay"));
			$_var_150 = $_var_145["commission_pay"];
			$_var_143 = pdo_fetch("select * from " . tablename("ewei_shop_commission_level") . " where uniacid=:uniacid  and {$_var_150} >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1", array(":uniacid" => $_W["uniacid"]));
			if (empty($_var_143)) {
				return;
			}
			if ($_var_141["id"] == $_var_143["id"]) {
				return;
			}
			if (!empty($_var_141["id"])) {
				if ($_var_141["commissionmoney"] > $_var_143["commissionmoney"]) {
					return;
				}
			}
			pdo_update("ewei_shop_member", array("agentlevel" => $_var_143["id"]), array("id" => $_var_133["id"]));
			$this->sendMessage($_var_133["openid"], array("nickname" => $_var_133["nickname"], "oldlevel" => $_var_141, "newlevel" => $_var_143,), TM_COMMISSION_UPGRADE);
		}

		function sendMessage($_var_21 = '', $_var_151 = array(), $_var_152 = '')
		{
			global $_W, $_GPC;
			$_var_1 = $this->getSet();
			$_var_153 = $_var_1["tm"];
			$_var_154 = $_var_153["templateid"];
			$_var_23 = m("member")->getMember($_var_21);
			$_var_155 = unserialize($_var_23["noticeset"]);
			if (!is_array($_var_155)) {
				$_var_155 = array();
			}
			if ($_var_152 == TM_COMMISSION_AGENT_NEW) {
				$_var_156 = $_var_153["commission_agent_new"];
				$_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["childtime"]), $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_agent_newtitle"]) ? $_var_153["commission_agent_newtitle"] : "新增下线通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			}else if($_var_152 == TM_COMMISSION_AGENT_NEWPER){
                $_var_156 = $_var_153["commission_agent_newper"];
                $_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
                $_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["childtime"]), $_var_156);
                $_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_agent_newpertitle"]) ? $_var_153["commission_agent_newpertitle"] : "新增下线通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
                if (!empty($_var_154)) {
                    m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
                } else {
                    m("message")->sendCustomNotice($_var_21, $_var_157);
                }
            }else if($_var_152 == TM_COMMISSION_MENTOR){
                $_var_156 = $_var_153["commission_mentor"];
                $_var_156 = str_replace("[导师名字]", $_var_151["nickname"], $_var_156);
                $_var_156 = str_replace("[导师微信号]", $_var_151["mentor_wx"], $_var_156);
                $_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_mentortitle"]) ? $_var_153["commission_mentortitle"] : "导师分配提醒", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
                if (!empty($_var_154)) {
                    m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
                } else {
                    m("message")->sendCustomNotice($_var_21, $_var_157);
                }
            }
            else if($_var_152 == TM_COMMISSION_WELCOME){
                $_var_156 = $_var_153["commission_welcome"];
                $_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
                $_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["childtime"]), $_var_156);
                $_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_welcometitle"]) ? $_var_153["commission_welcometitle"] : "进店通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
                if (!empty($_var_154)) {
                    m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
                } else {
                    m("message")->sendCustomNotice($_var_21, $_var_157);
                }
            }else if ($_var_152 == TM_COMMISSION_ORDER_PAY && !empty($_var_153["commission_order_pay"]) && empty($_var_155["commission_order_pay"])) {
				$_var_156 = $_var_153["commission_order_pay"];
				$_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["paytime"]), $_var_156);
				$_var_156 = str_replace("[订单编号]", $_var_151["ordersn"], $_var_156);
				$_var_156 = str_replace("[订单金额]", $_var_151["price"], $_var_156);
				$_var_156 = str_replace("[佣金金额]", $_var_151["commission"], $_var_156);
				$_var_156 = str_replace("[商品详情]", $_var_151["goods"], $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_order_paytitle"]) ? $_var_153["commission_order_paytitle"] : "下线付款通知"), "keyword2" => array("value" => $_var_156));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_ORDER_FINISH && !empty($_var_153["commission_order_finish"]) && empty($_var_155["commission_order_finish"])) {
				$_var_156 = $_var_153["commission_order_finish"];
				$_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["finishtime"]), $_var_156);
				$_var_156 = str_replace("[订单编号]", $_var_151["ordersn"], $_var_156);
				$_var_156 = str_replace("[订单金额]", $_var_151["price"], $_var_156);
				$_var_156 = str_replace("[佣金金额]", $_var_151["commission"], $_var_156);
				$_var_156 = str_replace("[商品详情]", $_var_151["goods"], $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_order_finishtitle"]) ? $_var_153["commission_order_finishtitle"] : "下线确认收货通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_APPLY && !empty($_var_153["commission_apply"]) && empty($_var_155["commission_apply"])) {
				$_var_156 = $_var_153["commission_apply"];
				$_var_156 = str_replace("[昵称]", $_var_23["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", time()), $_var_156);
				$_var_156 = str_replace("[金额]", $_var_151["commission"], $_var_156);
				$_var_156 = str_replace("[提现方式]", $_var_151["type"], $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_applytitle"]) ? $_var_153["commission_applytitle"] : "提现申请提交成功", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_CHECK && !empty($_var_153["commission_check"]) && empty($_var_155["commission_check"])) {
				$_var_156 = $_var_153["commission_check"];
				$_var_156 = str_replace("[昵称]", $_var_23["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", time()), $_var_156);
				$_var_156 = str_replace("[金额]", $_var_151["commission"], $_var_156);
				$_var_156 = str_replace("[提现方式]", $_var_151["type"], $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_checktitle"]) ? $_var_153["commission_checktitle"] : "提现申请审核处理完成", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_PAY && !empty($_var_153["commission_pay"]) && empty($_var_155["commission_pay"])) {
				$_var_156 = $_var_153["commission_pay"];
				$_var_156 = str_replace("[昵称]", $_var_23["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", time()), $_var_156);
				$_var_156 = str_replace("[金额]", $_var_151["commission"], $_var_156);
				$_var_156 = str_replace("[提现方式]", $_var_151["type"], $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_paytitle"]) ? $_var_153["commission_paytitle"] : "佣金打款通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_UPGRADE && !empty($_var_153["commission_upgrade"]) && empty($_var_155["commission_upgrade"])) {
				$_var_156 = $_var_153["commission_upgrade"];
				$_var_156 = str_replace("[昵称]", $_var_23["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", time()), $_var_156);
				$_var_156 = str_replace("[旧等级]", $_var_151["oldlevel"]["levelname"], $_var_156);
				$_var_156 = str_replace("[旧一级分销比例]", $_var_151["oldlevel"]["commission1"] . "%", $_var_156);
				$_var_156 = str_replace("[旧二级分销比例]", $_var_151["oldlevel"]["commission2"] . "%", $_var_156);
				$_var_156 = str_replace("[旧三级分销比例]", $_var_151["oldlevel"]["commission3"] . "%", $_var_156);
				$_var_156 = str_replace("[新等级]", $_var_151["newlevel"]["levelname"], $_var_156);
				$_var_156 = str_replace("[新一级分销比例]", $_var_151["newlevel"]["commission1"] . "%", $_var_156);
				$_var_156 = str_replace("[新二级分销比例]", $_var_151["newlevel"]["commission2"] . "%", $_var_156);
				$_var_156 = str_replace("[新三级分销比例]", $_var_151["newlevel"]["commission3"] . "%", $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_upgradetitle"]) ? $_var_153["commission_upgradetitle"] : "分销等级升级通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			} else if ($_var_152 == TM_COMMISSION_BECOME && !empty($_var_153["commission_become"]) && empty($_var_155["commission_become"])) {
				$_var_156 = $_var_153["commission_become"];
				$_var_156 = str_replace("[昵称]", $_var_151["nickname"], $_var_156);
				$_var_156 = str_replace("[时间]", date("Y-m-d H:i:s", $_var_151["agenttime"]), $_var_156);
				$_var_157 = array("keyword1" => array("value" => !empty($_var_153["commission_becometitle"]) ? $_var_153["commission_becometitle"] : "成为分销商通知", "color" => "#73a68d"), "keyword2" => array("value" => $_var_156, "color" => "#73a68d"));
				if (!empty($_var_154)) {
					m("message")->sendTplNotice($_var_21, $_var_154, $_var_157);
				} else {
					m("message")->sendCustomNotice($_var_21, $_var_157);
				}
			}
		}

		function perms()
		{
			return array("commission" => array("text" => $this->getName(), "isplugin" => true, "child" => array("cover" => array("text" => "入口设置"), "agent" => array("text" => "分销商", "view" => "浏览", "check" => "审核-log", "edit" => "修改-log", "agentblack" => "黑名单操作-log", "delete" => "删除-log", "user" => "查看下线", "order" => "查看推广订单(还需有订单权限)", "changeagent" => "设置分销商"),"mentor" => array("text" => "导师管理", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"),"white" => array("text" => "分销商白名单", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"),  "level" => array("text" => "分销商等级", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "apply" => array("text" => "佣金审核", "view1" => "浏览待审核", "view2" => "浏览已审核", "view3" => "浏览已打款", "view_1" => "浏览无效", "export1" => "导出待审核-log", "export2" => "导出已审核-log", "export3" => "导出已打款-log", "export_1" => "导出无效-log", "check" => "审核-log", "pay" => "打款-log", "cancel" => "重新审核-log"), "notice" => array("text" => "通知设置-log"), "increase" => array("text" => "分销商趋势图"), "changecommission" => array("text" => "修改佣金-log"), "set" => array("text" => "基础设置-log"))));
		}

		// 物流查询用到的方法
		function curlOpen($url, $config = array())
		{
		    $arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
		    $arr = array_merge($arr, $config);
		    $ch = curl_init();
		    
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
		    curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']);  
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
		    curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
		    curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
		    //curl_setopt($ch, CURLOPT_HEADER, true);//获取header
		    if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
		    if($arr['ssl'])
		    {
		        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		    }
		    if(!empty($arr['cookie']))
		    {
		        curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
		        curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']); 
		    } 
		    
		    if(!empty($arr['proxy']))
		    {
		        //curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);  
		        curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
		        if(!empty($arr['userpwd']))
		        {            
		            curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
		        }        
		    }    
		    
		    //ip比较特殊，用键值表示
		    if(!empty($arr['header']['ip']))
		    {
		        array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
		        unset($arr['header']['ip']);
		    }   
		    $arr['header'] = array_filter($arr['header']);
		    
		    if(!empty($arr['header']))
		    {
		        curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']); 
		    }

		    if ($arr['post'] != false)
		    {
		        curl_setopt($ch, CURLOPT_POST, true);
		        if(is_array($arr['post']) && $arr['isupfile'] === false)
		        {
		            $post = http_build_query($arr['post']);            
		        } 
		        else
		        {
		            $post = $arr['post'];
		        }
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		    }    
		    $result = curl_exec($ch);
		    //var_dump(curl_getinfo($ch));
		    curl_close($ch);

		    return $result;
		}
	}
}