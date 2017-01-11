<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("PermModel")) {
	class PermModel extends PluginModel
	{
		public function allPerms()
		{
			$_var_0 = array("shop" => array("text" => "商城管理", "child" => array("goods" => array("text" => "商品", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "found" => array("text" => "发现列表", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"),"category" => array("text" => "商品分类", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "dispatch" => array("text" => "配送方式", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "adv" => array("text" => "幻灯片", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "notice" => array("text" => "公告", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "comment" => array("text" => "评价", "view" => "浏览", "add" => "添加评论-log", "edit" => "回复-log", "delete" => "删除-log"), "refundaddress" => array("text" => "退货地址", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"))), "member" => array("text" => "会员管理", "child" => array("member" => array("text" => "会员", "view" => "浏览", "edit" => "修改-log", "delete" => "删除-log", "export" => "导出-log"), "group" => array("text" => "会员组", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "level" => array("text" => "会员等级", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"))), "order" => array("text" => "订单管理", "child" => array("view" => array("text" => "浏览", "status_1" => "浏览关闭订单", "status0" => "浏览待付款订单", "status1" => "浏览已付款订单", "status2" => "浏览已发货订单", "status3" => "浏览完成的订单", "status4" => "浏览退货申请订单", "status5" => "浏览已退货订单",), "op" => array("text" => "操作", "pay" => "确认付款-log", "send" => "发货-log", "sendcancel" => "取消发货-log", "finish" => "确认收货(快递单)-log", "verify" => "确认核销(核销单)-log", "fetch" => "确认取货(自提单)-log", "close" => "关闭订单-log", "refund" => "退货处理-log", "export" => "导出订单-log", "changeprice" => "订单改价-log", "changeaddress" => "修改订单地址-log"))), "finance" => array("text" => "财务管理", "child" => array("recharge" => array("text" => "充值", "view" => "浏览", "credit1" => "充值积分-log", "credit2" => "充值余额-log", "refund" => "充值退款-log", "export" => "导出充值记录-log"), "withdraw" => array("text" => "提现", "view" => "浏览", "withdraw" => "提现-log", "export" => "导出提现记录-log"), "downloadbill" => array("text" => "下载对账单"),)), "statistics" => array("text" => "数据统计", "child" => array("view" => array("text" => "浏览权限", "sale" => "销售指标", "sale_analysis" => "销售统计", "order" => "订单统计", "goods" => "商品销售统计", "goods_rank" => "商品销售排行", "goods_trans" => "商品销售转化率", "member_cost" => "会员消费排行", "member_increase" => "会员增长趋势"), "export" => array("text" => "导出", "sale" => "导出销售统计-log", "order" => "导出订单统计-log", "goods" => "导出商品销售统计-log", "goods_rank" => "导出商品销售排行-log", "goods_trans" => "商品销售转化率-log", "member_cost" => "会员消费排行-log"),)), "sysset" => array("text" => "系统设置", "child" => array("view" => array("text" => "浏览", "shop" => "商城设置", "follow" => "引导及分享设置", "notice" => "模板消息设置", "trade" => "交易设置", "pay" => "支付方式设置", "template" => "模板设置", "member" => "会员设置", "category" => "分类层级设置", "contact" => "联系方式设置"), "save" => array("text" => "修改", "shop" => "修改商城设置-log", "follow" => "修改引导及分享设置-log", "notice" => "修改模板消息设置-log", "trade" => "修改交易设置-log", "pay" => "修改支付方式设置-log", "template" => "模板设置-log", "member" => "会员设置-log", "category" => "分类层级设置-log", "contact" => "联系方式设置-log"))),);
			$_var_1 = m("plugin")->getAll();
			foreach ($_var_1 as $_var_2) {
//				$_var_3 = p($_var_2["identity"]);
//				if ($_var_3) {
//					if (method_exists($_var_3, "perms")) {
//						$_var_4 = $_var_3->perms();
//						$_var_0 = array_merge($_var_0, $_var_4);
//					}
//				}
			}
			return $_var_0;
		}

		public function isopen($_var_5 = '')
		{
			if (empty($_var_5)) {
				return false;
			}
			$_var_1 = m("plugin")->getAll();
			foreach ($_var_1 as $_var_2) {
				if ($_var_2["identity"] == strtolower($_var_5)) {
					if (empty($_var_2["status"])) {
						return false;
					}
				}
			}
			return true;
		}

		public function check_edit($_var_6 = '', $_var_7 = array())
		{
			if (empty($_var_6)) {
				return false;
			}
			if (!$this->check_perm($_var_6)) {
				return false;
			}
			if (empty($_var_7["id"])) {
				$_var_8 = $_var_6 . ".add";
				if (!$this->check($_var_8)) {
					return false;
				}
				return true;
			} else {
				$_var_9 = $_var_6 . ".edit";
				if (!$this->check($_var_9)) {
					return false;
				}
				return true;
			}
		}

		public function check_perm($_var_10 = '')
		{
			global $_W;
			$_var_11 = true;
			if (empty($_var_10)) {
				return false;
			}
			if (!strexists($_var_10, "&") && !strexists($_var_10, "|")) {
				$_var_11 = $this->check($_var_10);
			} else if (strexists($_var_10, "&")) {
				$_var_12 = explode("&", $_var_10);
				foreach ($_var_12 as $_var_13) {
					$_var_11 = $this->check($_var_13);
					if (!$_var_11) {
						break;
					}
				}
			} else if (strexists($_var_10, "|")) {
				$_var_12 = explode("|", $_var_10);
				foreach ($_var_12 as $_var_13) {
					$_var_11 = $this->check($_var_13);
					if ($_var_11) {
						break;
					}
				}
			}
			return $_var_11;
		}

		private function check($_var_6 = '')
		{
			global $_W, $_GPC;
			if ($_W["role"] == "manager" || $_W["role"] == "founder") {
				return true;
			}
			$_var_14 = $_W["uid"];
			if (empty($_var_6)) {
				return false;
			}
			$_var_15 = pdo_fetch('select u.status as userstatus,r.status as rolestatus,u.perms as userperms,r.perms as roleperms,u.roleid from ' . tablename("ewei_shop_perm_user") . " u " . " left join " . tablename("ewei_shop_perm_role") . " r on u.roleid = r.id " . " where uid=:uid limit 1 ", array(":uid" => $_var_14));
			if (empty($_var_15) || empty($_var_15["userstatus"])) {
				return false;
			}
			if (!empty($_var_15["role"]) && empty($_var_15["rolestatus"])) {
				return true;
			}
			$_var_16 = explode(",", $_var_15["roleperms"]);
			$_var_17 = explode(",", $_var_15["userperms"]);
			$_var_0 = array_merge($_var_16, $_var_17);
			if (empty($_var_0)) {
				return false;
			}
			$_var_18 = explode(".", $_var_6);
			if (!in_array($_var_18[0], $_var_0)) {
				return false;
			}
			if (isset($_var_18[1]) && !in_array($_var_18[0] . "." . $_var_18[1], $_var_0)) {
				return false;
			}
			if (isset($_var_18[2]) && !in_array($_var_18[0] . "." . $_var_18[1] . "." . $_var_18[2], $_var_0)) {
				return false;
			}
			return true;
		}

		function check_plugin($_var_5 = '')
		{
			global $_W, $_GPC;
			$_var_19 = m("cache")->getString("permset", "global");
			if (empty($_var_19)) {
				return true;
			}
			if ($_W["role"] == "founder") {
				return true;
			}
			$_var_20 = $this->isopen($_var_5);
			if (!$_var_20) {
				return false;
			}
			$_var_21 = true;
			$_var_22 = pdo_fetchcolumn("SELECT acid FROM " . tablename("account_wechats") . " WHERE `uniacid`=:uniacid LIMIT 1", array(":uniacid" => $_W["uniacid"]));
			$_var_23 = pdo_fetch("select  plugins from " . tablename("ewei_shop_perm_plugin") . " where acid=:acid limit 1", array(":acid" => $_var_22));
			if (!empty($_var_23)) {
				$_var_24 = explode(",", $_var_23["plugins"]);
				if (!in_array($_var_5, $_var_24)) {
					$_var_21 = false;
				}
			} else {
				load()->model("account");
				$_var_25 = uni_owned($_W["founder"]);
				if (in_array($_W["uniacid"], array_keys($_var_25))) {
					$_var_21 = true;
				} else {
					$_var_21 = false;
				}
			}
			if (!$_var_21) {
				return false;
			}
			return $this->check($_var_5);
		}

		public function getLogName($_var_26 = '', $_var_27 = null)
		{
			if (!$_var_27) {
				$_var_27 = $this->getLogTypes();
			}
			foreach ($_var_27 as $_var_28) {
				if ($_var_28["value"] == $_var_26) {
					return $_var_28["text"];
				}
			}
			return '';
		}

		public function getLogTypes()
		{
			$_var_29 = array();
			$_var_0 = $this->allPerms();
			foreach ($_var_0 as $_var_30 => $_var_31) {
				if (isset($_var_31["child"])) {
					foreach ($_var_31["child"] as $_var_32 => $_var_33) {
						foreach ($_var_33 as $_var_34 => $_var_35) {
							if (strexists($_var_35, "-log")) {
								$_var_36 = str_replace("-log", "", $_var_31["text"] . "-" . $_var_33["text"] . "-" . $_var_35);
								if ($_var_34 == "text") {
									$_var_36 = str_replace("-log", "", $_var_31["text"] . "-" . $_var_33["text"]);
								}
								$_var_29[] = array("text" => $_var_36, "value" => str_replace(".text", "", $_var_30 . "." . $_var_32 . "." . $_var_34));
							}
						}
					}
				} else {
					foreach ($_var_31 as $_var_34 => $_var_35) {
						if (strexists($_var_35, "-log")) {
							$_var_36 = str_replace("-log", "", $_var_31["text"] . "-" . $_var_35);
							if ($_var_34 == "text") {
								$_var_36 = str_replace("-log", "", $_var_31["text"]);
							}
							$_var_29[] = array("text" => $_var_36, "value" => str_replace(".text", "", $_var_30 . "." . $_var_34));
						}
					}
				}
			}
			return $_var_29;
		}

		public function log($_var_26 = '', $_var_37 = '')
		{
			global $_W;
			static $_var_38;
			if (!$_var_38) {
				$_var_38 = $this->getLogTypes();
			}
			$_var_39 = array("uniacid" => $_W["uniacid"], "uid" => $_W["uid"], "name" => $this->getLogName($_var_26, $_var_38), "type" => $_var_26, "op" => $_var_37, "ip" => CLIENT_IP, "createtime" => time());
			pdo_insert("ewei_shop_perm_log", $_var_39);
		}

		public function perms()
		{
			return array("perm" => array("text" => $this->getName(), "isplugin" => true, "child" => array("set" => array("text" => "基础设置"), "role" => array("text" => "角色", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "user" => array("text" => "操作员", "view" => "浏览", "add" => "添加-log", "edit" => "修改-log", "delete" => "删除-log"), "log" => array("text" => "操作日志", "view" => "浏览", "delete" => "删除-log", "clear" => "清除-log"),)));
		}
	}
}