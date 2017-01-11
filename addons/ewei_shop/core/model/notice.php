<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Ewei_DShop_Notice
{
	public function sendOrderMessage($_var_0 = '0', $_var_1 = false)
	{
		global $_W;
		if (empty($_var_0)) {
			return;
		}
		$_var_2 = pdo_fetch("select * from " . tablename("ewei_shop_order") . " where id=:id limit 1", array(":id" => $_var_0));
		if (empty($_var_2)) {
			return;
		}
		$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=order&p=detail&id=" . $_var_0;
		if (strexists($_var_3, "/addons/ewei_shop/")) {
			$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
		}
		if (strexists($_var_3, "/core/mobile/order/")) {
			$_var_3 = str_replace("/core/mobile/order/", "/", $_var_3);
		}
		$_var_4 = $_var_2["openid"];
		$_var_5 = pdo_fetchall('select g.id,g.title,og.realprice,og.total,og.price,og.optionname as optiontitle,g.noticeopenid,g.noticetype from ' . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . " where og.uniacid=:uniacid and og.orderid=:orderid ", array(":uniacid" => $_W["uniacid"], ":orderid" => $_var_0));
		$_var_6 = '';
		foreach ($_var_5 as $_var_7) {
			$_var_6 .= "" . $_var_7["title"] . "( ";
			if (!empty($_var_7["optiontitle"])) {
				$_var_6 .= " 规格: " . $_var_7["optiontitle"];
			}
			$_var_6 .= " 单价: " . ($_var_7["realprice"] / $_var_7["total"]) . " 数量: " . $_var_7["total"] . " 总价: " . $_var_7["realprice"] . "); ";
		}
		$_var_8 = " 订单总价: " . $_var_2["price"] . "(包含运费:" . $_var_2["dispatchprice"] . ")";
		$_var_9 = m("member")->getMember($_var_4);
		$_var_10 = unserialize($_var_9["noticeset"]);
		if (!is_array($_var_10)) {
			$_var_10 = array();
		}
		$_var_11 = m("common")->getSysset();
		$_var_12 = $_var_11["shop"];
		$_var_13 = $_var_11["notice"];
		if ($_var_1) {
			$_var_14 = array('0' => "退款", "1" => "退货退款", "2" => "换货");
			if (!empty($_var_2["refundid"])) {
				$_var_15 = pdo_fetch("select * from " . tablename("ewei_shop_order_refund") . " where id=:id limit 1", array(":id" => $_var_2["refundid"]));
				if (empty($_var_15)) {
					return;
				}
				if (empty($_var_15["status"])) {
					$_var_16 = array("first" => array("value" => "您的" . $_var_14[$_var_15["rtype"]] . "申请已经提交！", "color" => "#4a5077"), "orderProductPrice" => array("title" => "退款金额", "value" => $_var_15["rtype"] == 3 ? "-" : ("¥" . $_var_15["applyprice"] . "元"), "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => "\r\n等待商家确认" . $_var_14[$_var_15["rtype"]] . "信息！", "color" => "#4a5077"),);
					if (!empty($_var_13["refund"]) && empty($_var_10["refund"])) {
						m("message")->sendTplNotice($_var_4, $_var_13["refund"], $_var_16, $_var_3);
					} else if (empty($_var_10["refund"])) {
						m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
					}
				} else if ($_var_15["status"] == 3) {
					$_var_17 = iunserializer($_var_15["refundaddress"]);
					$_var_18 = "退货地址: " . $_var_17["province"] . " " . $_var_17["city"] . " " . $_var_17["area"] . " " . $_var_17["address"] . " 收件人: " . $_var_17["name"] . " (" . $_var_17["mobile"] . ")(" . $_var_17["tel"] . ") ";
					$_var_16 = array("first" => array("value" => "您的" . $_var_14[$_var_15["rtype"]] . "申请已经通过！", "color" => "#4a5077"), "orderProductPrice" => array("title" => "退款金额", "value" => $_var_15["rtype"] == 3 ? "-" : ("¥" . $_var_15["applyprice"] . "元"), "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => "\r\n请您根据商家提供的退货地址将商品寄回！" . $_var_18 . "", "color" => "#4a5077"),);
					if (!empty($_var_13["refund"]) && empty($_var_10["refund"])) {
						m("message")->sendTplNotice($_var_4, $_var_13["refund"], $_var_16, $_var_3);
					} else if (empty($_var_10["refund"])) {
						m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
					}
				} else if ($_var_15["status"] == 5) {
					if (!empty($_var_2["address"])) {
						$_var_19 = iunserializer($_var_2["address_send"]);
						if (!is_array($_var_19)) {
							$_var_19 = iunserializer($_var_2["address"]);
							if (!is_array($_var_19)) {
								$_var_19 = pdo_fetch("select id,realname,mobile,address,province,city,area from " . tablename("ewei_shop_member_address") . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $_var_2["addressid"], ":uniacid" => $_W["uniacid"]));
							}
						}
					}
					if (empty($_var_19)) {
						return;
					}
					$_var_16 = array("first" => array("value" => "您的换货物品已经发货！", "color" => "#4a5077"), "keyword1" => array("title" => "订单内容", "value" => "【" . $_var_2["ordersn"] . "】" . $_var_6, "color" => "#4a5077"), "keyword2" => array("title" => "物流服务", "value" => $_var_15["rexpresscom"], "color" => "#4a5077"), "keyword3" => array("title" => "快递单号", "value" => $_var_15["rexpresssn"], "color" => "#4a5077"), "keyword4" => array("title" => "收货信息", "value" => "地址: " . $_var_19["province"] . " " . $_var_19["city"] . " " . $_var_19["area"] . " " . $_var_19["address"] . "收件人: " . $_var_19["realname"] . " (" . $_var_19["mobile"] . ") ", "color" => "#4a5077"), "remark" => array("value" => "\r\n我们正加速送到您的手上，请您耐心等候。", "color" => "#4a5077"));
					if (!empty($_var_13["send"]) && empty($_var_10["send"])) {
						m("message")->sendTplNotice($_var_4, $_var_13["send"], $_var_16, $_var_3);
					} else if (empty($_var_10["send"])) {
						m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
					}
				} else if ($_var_15["status"] == 1) {
					if ($_var_15["rtype"] == 2) {
						$_var_16 = array("first" => array("value" => "您的订单已经完成换货！", "color" => "#4a5077"), "orderProductPrice" => array("title" => "退款金额", "value" => "-", "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => "\r\n 换货成功！\r\n【" . $_var_12["name"] . "】期待您再次购物！", "color" => "#4a5077"));
					} else {
						$_var_20 = '';
						if (empty($_var_15["refundtype"])) {
							$_var_20 = ", 已经退回您的余额账户，请留意查收！";
						} else if ($_var_15["refundtype"] == 1) {
							$_var_20 = ', 已经退回您的对应支付渠道（如银行卡，微信钱包等, 具体到账时间请您查看微信支付通知)，请留意查收！';
						} else {
							$_var_20 = ", 请联系客服进行退款事项！";
						}
						$_var_16 = array("first" => array("value" => "您的订单已经完成退款！", "color" => "#4a5077"), "orderProductPrice" => array("title" => "退款金额", "value" => "¥" . $_var_15["price"] . "元", "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => "\r\n 退款金额 ¥" . $_var_15["price"] . "{$_var_20}\r\n 【" . $_var_12["name"] . "】期待您再次购物！", "color" => "#4a5077"));
					}
					if (!empty($_var_13["refund1"]) && empty($_var_10["refund1"])) {
						m("message")->sendTplNotice($_var_4, $_var_13["refund1"], $_var_16, $_var_3);
					} else if (empty($_var_10["refund1"])) {
						m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
					}
				} elseif ($_var_15["status"] == -1) {
					$_var_21 = "\n驳回原因: " . $_var_15["reply"];
					if (!empty($_var_12["phone"])) {
						$_var_21 .= "\n客服电话:  " . $_var_12["phone"];
					}
					$_var_16 = array("first" => array("value" => "您的" . $_var_14[$_var_15["rtype"]] . "申请被商家驳回，可与商家协商沟通！", "color" => "#4a5077"), "orderProductPrice" => array("title" => "退款金额", "value" => "¥" . $_var_15["price"] . "元", "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
					if (!empty($_var_13["refund2"]) && empty($_var_10["refund2"])) {
						m("message")->sendTplNotice($_var_4, $_var_13["refund2"], $_var_16, $_var_3);
					} else if (empty($_var_10["refund2"])) {
						m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
					}
				}
				return;
			}
		}
		$_var_22 = '';
		if (!empty($_var_2["address"])) {
			$_var_19 = iunserializer($_var_2["address_send"]);
			if (!is_array($_var_19)) {
				$_var_19 = iunserializer($_var_2["address"]);
				if (!is_array($_var_19)) {
					$_var_19 = pdo_fetch("select id,realname,mobile,address,province,city,area from " . tablename("ewei_shop_member_address") . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $_var_2["addressid"], ":uniacid" => $_W["uniacid"]));
				}
			}
			if (!empty($_var_19)) {
				$_var_22 = "收件人: " . $_var_19["realname"] . "\n联系电话: " . $_var_19["mobile"] . "\n收货地址: " . $_var_19["province"] . $_var_19["city"] . $_var_19["area"] . " " . $_var_19["address"];
			}
		} else {
			$_var_23 = iunserializer($_var_2["carrier"]);
			if (is_array($_var_23)) {
				$_var_22 = "联系人: " . $_var_23["carrier_realname"] . "\n联系电话: " . $_var_23["carrier_mobile"];
			}
		}
		if ($_var_2["status"] == -1) {
			if (empty($_var_2["dispatchtype"])) {
				$_var_24 = array("title" => "收货信息", "value" => "收货地址: " . $_var_19["province"] . " " . $_var_19["city"] . " " . $_var_19["area"] . " " . $_var_19["address"] . " 收件人: " . $_var_19["realname"] . " 联系电话: " . $_var_19["mobile"], "color" => "#4a5077");
			} else {
				$_var_24 = array("title" => "收货信息", "value" => "自提地点: " . $_var_23["address"] . " 联系人: " . $_var_23["realname"] . " 联系电话: " . $_var_23["mobile"], "color" => "#4a5077");
			}
			$_var_16 = array("first" => array("value" => "您的订单已取消!", "color" => "#4a5077"), "orderProductPrice" => array("title" => "订单金额", "value" => "¥" . $_var_2["price"] . "元(含运费" . $_var_2["dispatchprice"] . "元)", "color" => "#4a5077"), "orderProductName" => array("title" => "商品详情", "value" => $_var_6, "color" => "#4a5077"), "orderAddress" => $_var_24, "orderName" => array("title" => "订单编号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => "\r\n【" . $_var_12["name"] . "】欢迎您的再次购物！", "color" => "#4a5077"));
			if (!empty($_var_13["cancel"]) && empty($_var_10["cancel"])) {
				m("message")->sendTplNotice($_var_4, $_var_13["cancel"], $_var_16, $_var_3);
			} else if (empty($_var_10["cancel"])) {
				m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
			}
		} else if ($_var_2["status"] == 0) {
			$_var_25 = explode(",", $_var_13["newtype"]);
			if (empty($_var_13["newtype"]) || (is_array($_var_25) && in_array(0, $_var_25))) {
				$_var_21 = "\n订单下单成功,请到后台查看!";
				if (!empty($_var_22)) {
					$_var_21 .= "\r\n下单者信息:\n" . $_var_22;
				}
				$_var_16 = array("first" => array("value" => "订单下单通知!", "color" => "#4a5077"), "keyword1" => array("title" => "时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
				$_var_26 = m("common")->getAccount();
				if (!empty($_var_13["openid"])) {
					$_var_27 = explode(",", $_var_13["openid"]);
					foreach ($_var_27 as $_var_28) {
						if (empty($_var_28)) {
							continue;
						}
						if (!empty($_var_13["new"])) {
							m("message")->sendTplNotice($_var_28, $_var_13["new"], $_var_16, '', $_var_26);
						} else {
							m("message")->sendCustomNotice($_var_28, $_var_16, '', $_var_26);
						}
					}
				}
			}
			$_var_21 = "\r\n商品已经下单，请及时备货，谢谢!";
			if (!empty($_var_22)) {
				$_var_21 .= "\r\n下单者信息:\n" . $_var_22;
			}
			foreach ($_var_5 as $_var_7) {
				if (!empty($_var_7["noticeopenid"])) {
					$_var_29 = explode(",", $_var_7["noticetype"]);
					if (empty($_var_7["noticetype"]) || (is_array($_var_29) && in_array(0, $_var_29))) {
						$_var_30 = $_var_7["title"] . "( ";
						if (!empty($_var_7["optiontitle"])) {
							$_var_30 .= " 规格: " . $_var_7["optiontitle"];
						}
						$_var_30 .= " 单价: " . ($_var_7["realprice"] / $_var_7["total"]) . " 数量: " . $_var_7["total"] . " 总价: " . $_var_7["realprice"] . "); ";
						$_var_16 = array("first" => array("value" => "商品下单通知!", "color" => "#4a5077"), "keyword1" => array("title" => "时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_30, "color" => "#4a5077"), "keyword3" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
						if (!empty($_var_13["new"])) {
							m("message")->sendTplNotice($_var_7["noticeopenid"], $_var_13["new"], $_var_16, '', $_var_26);
						} else {
							m("message")->sendCustomNotice($_var_7["noticeopenid"], $_var_16, '', $_var_26);
						}
					}
				}
			}
			if (!empty($_var_2["addressid"])) {
				$_var_21 = "\r\n您的订单我们已经收到，支付后我们将尽快配送~~";
			} else if (!empty($_var_2["isverify"])) {
				$_var_21 = "\r\n您的订单我们已经收到，支付后您就可以到店使用了~~";
			} else if (!empty($_var_2["virtual"])) {
				$_var_21 = "\r\n您的订单我们已经收到，支付后系统将会自动发货~~";
			} else {
				$_var_21 = "\r\n您的订单我们已经收到，支付后您就可以到自提点提货物了~~";
			}
			$_var_16 = array("first" => array("value" => "您的订单已提交成功！", "color" => "#4a5077"), "keyword1" => array("title" => "店铺", "value" => $_var_12["name"], "color" => "#4a5077"), "keyword2" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword3" => array("title" => "商品", "value" => $_var_6, "color" => "#4a5077"), "keyword4" => array("title" => "金额", "value" => "¥" . $_var_2["price"] . "元(含运费" . $_var_2["dispatchprice"] . "元)", "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
			if (!empty($_var_13["submit"]) && empty($_var_10["submit"])) {
				m("message")->sendTplNotice($_var_4, $_var_13["submit"], $_var_16, $_var_3);
			} else if (empty($_var_10["submit"])) {
				m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
			}
		} else if ($_var_2["status"] == 1) {
			$_var_25 = explode(",", $_var_13["newtype"]);
			if ($_var_13["newtype"] == 1 || (is_array($_var_25) && in_array(1, $_var_25))) {
				$_var_21 = "\n订单已经下单支付，请及时备货，谢谢!";
				if (!empty($_var_22)) {
					$_var_21 .= "\r\n购买者信息:\n" . $_var_22;
				}
				$_var_16 = array("first" => array("value" => "订单下单支付通知!", "color" => "#4a5077"), "keyword1" => array("title" => "时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
				$_var_26 = m("common")->getAccount();
				if (!empty($_var_13["openid"])) {
					$_var_27 = explode(",", $_var_13["openid"]);
					foreach ($_var_27 as $_var_28) {
						if (empty($_var_28)) {
							continue;
						}
						if (!empty($_var_13["new"])) {
							m("message")->sendTplNotice($_var_28, $_var_13["new"], $_var_16, '', $_var_26);
						} else {
							m("message")->sendCustomNotice($_var_28, $_var_16, '', $_var_26);
						}
					}
				}
			}
			$_var_21 = "\r\n商品已经下单支付，请及时备货，谢谢!";
			if (!empty($_var_22)) {
				$_var_21 .= "\r\n购买者信息:\n" . $_var_22;
			}
			foreach ($_var_5 as $_var_7) {
				$_var_29 = explode(",", $_var_7["noticetype"]);
				if ($_var_7["noticetype"] == "1" || (is_array($_var_29) && in_array(1, $_var_29))) {
					$_var_30 = $_var_7["title"] . "( ";
					if (!empty($_var_7["optiontitle"])) {
						$_var_30 .= " 规格: " . $_var_7["optiontitle"];
					}
					$_var_30 .= " 单价: " . ($_var_7["price"] / $_var_7["total"]) . " 数量: " . $_var_7["total"] . " 总价: " . $_var_7["price"] . "); ";
					$_var_16 = array("first" => array("value" => "商品下单支付通知!", "color" => "#4a5077"), "keyword1" => array("title" => "时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_30, "color" => "#4a5077"), "keyword3" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
					if (!empty($_var_13["new"])) {
						m("message")->sendTplNotice($_var_7["noticeopenid"], $_var_13["new"], $_var_16, '', $_var_26);
					} else {
						m("message")->sendCustomNotice($_var_7["noticeopenid"], $_var_16, '', $_var_26);
					}
				}
			}
			$_var_21 = "\r\n【" . $_var_12["name"] . "】欢迎您的再次购物！";
			if ($_var_2["isverify"]) {
				$_var_21 = "\r\n点击订单详情查看可消费门店, 【" . $_var_12["name"] . "】欢迎您的再次购物！";
			}
			$_var_16 = array("first" => array("value" => "您已支付成功订单！", "color" => "#4a5077"), "keyword1" => array("title" => "订单", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "支付状态", "value" => "支付成功", "color" => "#4a5077"), "keyword3" => array("title" => "支付日期", "value" => date("Y-m-d H:i:s", $_var_2["paytime"]), "color" => "#4a5077"), "keyword4" => array("title" => "商户", "value" => $_var_12["name"], "color" => "#4a5077"), "keyword5" => array("title" => "金额", "value" => "¥" . $_var_2["price"] . "元(含运费" . $_var_2["dispatchprice"] . "元)", "color" => "#4a5077"), "remark" => array("value" => $_var_21, "color" => "#4a5077"));
			$_var_31 = $_var_3;
			if (strexists($_var_31, "/addons/ewei_shop/")) {
				$_var_31 = str_replace("/addons/ewei_shop/", "/", $_var_31);
			}
			if (strexists($_var_31, "/core/mobile/order/")) {
				$_var_31 = str_replace("/core/mobile/order/", "/", $_var_31);
			}
			if (!empty($_var_13["pay"]) && empty($_var_10["pay"])) {
				m("message")->sendTplNotice($_var_4, $_var_13["pay"], $_var_16, $_var_31);
			} else if (empty($_var_10["pay"])) {
				m("message")->sendCustomNotice($_var_4, $_var_16, $_var_31);
			}
			if ($_var_2["dispatchtype"] == 1 && empty($_var_2["isverify"])) {
				$_var_23 = iunserializer($_var_2["carrier"]);
				if (!is_array($_var_23)) {
					return;
				}
				$_var_16 = array("first" => array("value" => "自提订单提交成功!", "color" => "#4a5077"), "keyword1" => array("title" => "自提码", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品详情", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "提货地址", "value" => $_var_23["address"], "color" => "#4a5077"), "keyword4" => array("title" => "提货时间", "value" => $_var_23["content"], "color" => "#4a5077"), "remark" => array("value" => "\r\n请您到选择的自提点进行取货, 自提联系人: " . $_var_23["realname"] . " 联系电话: " . $_var_23["mobile"], "color" => "#4a5077"));
				if (!empty($_var_13["carrier"]) && empty($_var_10["carrier"])) {
					m("message")->sendTplNotice($_var_4, $_var_13["carrier"], $_var_16, $_var_3);
				} else if (empty($_var_10["carrier"])) {
					m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
				}
			}
		} else if ($_var_2["status"] == 2) {
			if (empty($_var_2["dispatchtype"])) {
				if (empty($_var_19)) {
					return;
				}
				$_var_16 = array("first" => array("value" => "您的宝贝已经发货！", "color" => "#4a5077"), "keyword1" => array("title" => "订单内容", "value" => "【" . $_var_2["ordersn"] . "】" . $_var_6 . $_var_8, "color" => "#4a5077"), "keyword2" => array("title" => "物流服务", "value" => $_var_2["expresscom"], "color" => "#4a5077"), "keyword3" => array("title" => "快递单号", "value" => $_var_2["expresssn"], "color" => "#4a5077"), "keyword4" => array("title" => "收货信息", "value" => "地址: " . $_var_19["province"] . " " . $_var_19["city"] . " " . $_var_19["area"] . " " . $_var_19["address"] . "收件人: " . $_var_19["realname"] . " (" . $_var_19["mobile"] . ") ", "color" => "#4a5077"), "remark" => array("value" => "\r\n我们正加速送到您的手上，请您耐心等候。", "color" => "#4a5077"));
				if (!empty($_var_13["send"]) && empty($_var_10["send"])) {
					m("message")->sendTplNotice($_var_4, $_var_13["send"], $_var_16, $_var_3);
				} else if (empty($_var_10["send"])) {
					m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
				}
			}
		} else if ($_var_2["status"] == 3) {
			$_var_32 = p("virtual");
			if ($_var_32 && !empty($_var_2["virtual"])) {
				$_var_33 = $_var_32->getSet();
				$_var_34 = "\n" . $_var_22 . "\n" . $_var_2["virtual_str"];
				$_var_16 = array("first" => array("value" => "您购物的物品已自动发货!", "color" => "#4a5077"), "keyword1" => array("title" => "订单金额", "value" => "¥" . $_var_2["price"] . "元", "color" => "#4a5077"), "keyword2" => array("title" => "商品详情", "value" => $_var_6, "color" => "#4a5077"), "keyword3" => array("title" => "收货信息", "value" => $_var_34, "color" => "#4a5077"), "remark" => array("title" => '', "value" => "\r\n【" . $_var_12["name"] . "】感谢您的支持与厚爱，欢迎您的再次购物！", "color" => "#4a5077"));
				if (!empty($_var_33["tm"]["send"]) && empty($_var_10["finish"])) {
					m("message")->sendTplNotice($_var_4, $_var_33["tm"]["send"], $_var_16, $_var_3);
				} else if (empty($_var_10["finish"])) {
					m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
				}
				$_var_35 = "买家购买的商品已经自动发货!";
				$_var_21 = "\r\n发货信息:" . $_var_34;
				$_var_25 = explode(",", $_var_13["newtype"]);
				if ($_var_13["newtype"] == 2 || (is_array($_var_25) && in_array(2, $_var_25))) {
					$_var_16 = array("first" => array("value" => $_var_35, "color" => "#4a5077"), "keyword1" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword4" => array("title" => "发货时间", "value" => date("Y-m-d H:i:s", $_var_2["sendtime"]), "color" => "#4a5077"), "keyword5" => array("title" => "确认收货时间", "value" => date("Y-m-d H:i:s", $_var_2["finishtime"]), "color" => "#4a5077"), "remark" => array("title" => '', "value" => $_var_21, "color" => "#4a5077"));
					$_var_26 = m("common")->getAccount();
					if (!empty($_var_13["openid"])) {
						$_var_27 = explode(",", $_var_13["openid"]);
						foreach ($_var_27 as $_var_28) {
							if (empty($_var_28)) {
								continue;
							}
							if (!empty($_var_13["finish"])) {
								m("message")->sendTplNotice($_var_28, $_var_13["finish"], $_var_16, '', $_var_26);
							} else {
								m("message")->sendCustomNotice($_var_28, $_var_16, '', $_var_26);
							}
						}
					}
				}
				foreach ($_var_5 as $_var_7) {
					$_var_29 = explode(",", $_var_7["noticetype"]);
					if ($_var_7["noticetype"] == "2" || (is_array($_var_29) && in_array(2, $_var_29))) {
						$_var_30 = $_var_7["title"] . "( ";
						if (!empty($_var_7["optiontitle"])) {
							$_var_30 .= " 规格: " . $_var_7["optiontitle"];
						}
						$_var_30 .= " 单价: " . ($_var_7["price"] / $_var_7["total"]) . " 数量: " . $_var_7["total"] . " 总价: " . $_var_7["price"] . "); ";
						$_var_16 = array("first" => array("value" => $_var_35, "color" => "#4a5077"), "keyword1" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_30, "color" => "#4a5077"), "keyword3" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword4" => array("title" => "发货时间", "value" => date("Y-m-d H:i:s", $_var_2["sendtime"]), "color" => "#4a5077"), "keyword5" => array("title" => "确认收货时间", "value" => date("Y-m-d H:i:s", $_var_2["finishtime"]), "color" => "#4a5077"), "remark" => array("title" => '', "value" => $_var_21, "color" => "#4a5077"));
						if (!empty($_var_13["finish"])) {
							m("message")->sendTplNotice($_var_7["noticeopenid"], $_var_13["finish"], $_var_16, '', $_var_26);
						} else {
							m("message")->sendCustomNotice($_var_7["noticeopenid"], $_var_16, '', $_var_26);
						}
					}
				}
			} else {
				$_var_16 = array("first" => array("value" => "亲, 您购买的宝贝已经确认收货!", "color" => "#4a5077"), "keyword1" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword4" => array("title" => "发货时间", "value" => date("Y-m-d H:i:s", $_var_2["sendtime"]), "color" => "#4a5077"), "keyword5" => array("title" => "确认收货时间", "value" => date("Y-m-d H:i:s", $_var_2["finishtime"]), "color" => "#4a5077"), "remark" => array("title" => '', "value" => "\r\n【" . $_var_12["name"] . "】感谢您的支持与厚爱，欢迎您的再次购物！", "color" => "#4a5077"));
				if (!empty($_var_13["finish"]) && empty($_var_10["finish"])) {
					m("message")->sendTplNotice($_var_4, $_var_13["finish"], $_var_16, $_var_3);
				} else if (empty($_var_10["finish"])) {
					m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
				}
				$_var_35 = "买家购买的商品已经确认收货!";
				if ($_var_2["isverify"] == 1) {
					$_var_35 = "买家购买的商品已经确认核销!";
				}
				$_var_21 = "";
				if (!empty($_var_22)) {
					$_var_21 = "\r\n购买者信息:\n" . $_var_22;
				}
				$_var_25 = explode(",", $_var_13["newtype"]);
				if ($_var_13["newtype"] == 2 || (is_array($_var_25) && in_array(2, $_var_25))) {
					$_var_16 = array("first" => array("value" => $_var_35, "color" => "#4a5077"), "keyword1" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_6 . $_var_8, "color" => "#4a5077"), "keyword3" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword4" => array("title" => "发货时间", "value" => date("Y-m-d H:i:s", $_var_2["sendtime"]), "color" => "#4a5077"), "keyword5" => array("title" => "确认收货时间", "value" => date("Y-m-d H:i:s", $_var_2["finishtime"]), "color" => "#4a5077"), "remark" => array("title" => '', "value" => $_var_21, "color" => "#4a5077"));
					$_var_26 = m("common")->getAccount();
					if (!empty($_var_13["openid"])) {
						$_var_27 = explode(",", $_var_13["openid"]);
						foreach ($_var_27 as $_var_28) {
							if (empty($_var_28)) {
								continue;
							}
							if (!empty($_var_13["finish"])) {
								m("message")->sendTplNotice($_var_28, $_var_13["finish"], $_var_16, '', $_var_26);
							} else {
								m("message")->sendCustomNotice($_var_28, $_var_16, '', $_var_26);
							}
						}
					}
				}
				foreach ($_var_5 as $_var_7) {
					$_var_29 = explode(",", $_var_7["noticetype"]);
					if ($_var_7["noticetype"] == "2" || (is_array($_var_29) && in_array(2, $_var_29))) {
						$_var_30 = $_var_7["title"] . "( ";
						if (!empty($_var_7["optiontitle"])) {
							$_var_30 .= " 规格: " . $_var_7["optiontitle"];
						}
						$_var_30 .= " 单价: " . ($_var_7["price"] / $_var_7["total"]) . " 数量: " . $_var_7["total"] . " 总价: " . $_var_7["price"] . "); ";
						$_var_16 = array("first" => array("value" => $_var_35, "color" => "#4a5077"), "keyword1" => array("title" => "订单号", "value" => $_var_2["ordersn"], "color" => "#4a5077"), "keyword2" => array("title" => "商品名称", "value" => $_var_30, "color" => "#4a5077"), "keyword3" => array("title" => "下单时间", "value" => date("Y-m-d H:i:s", $_var_2["createtime"]), "color" => "#4a5077"), "keyword4" => array("title" => "发货时间", "value" => date("Y-m-d H:i:s", $_var_2["sendtime"]), "color" => "#4a5077"), "keyword5" => array("title" => "确认收货时间", "value" => date("Y-m-d H:i:s", $_var_2["finishtime"]), "color" => "#4a5077"), "remark" => array("title" => '', "value" => $_var_21, "color" => "#4a5077"));
						if (!empty($_var_13["finish"])) {
							m("message")->sendTplNotice($_var_7["noticeopenid"], $_var_13["finish"], $_var_16, '', $_var_26);
						} else {
							m("message")->sendCustomNotice($_var_7["noticeopenid"], $_var_16, '', $_var_26);
						}
					}
				}
			}
		}
	}

	public function sendMemberUpgradeMessage($_var_4 = '', $_var_36 = null, $_var_37 = null)
	{
		global $_W, $_GPC;
		$_var_9 = m("member")->getMember($_var_4);
		$_var_10 = unserialize($_var_9["noticeset"]);
		if (!is_array($_var_10)) {
			$_var_10 = array();
		}
		$_var_12 = m("common")->getSysset("shop");
		$_var_13 = m("common")->getSysset("notice");
		$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member";
		if (strexists($_var_3, "/addons/ewei_shop/")) {
			$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
		}
		if (strexists($_var_3, "/core/mobile/order/")) {
			$_var_3 = str_replace("/core/mobile/order/", "/", $_var_3);
		}
		if (!$_var_37) {
			$_var_37 = m("member")->getLevel($_var_4);
		}
		$_var_38 = empty($_var_12["levelname"]) ? "普通会员" : $_var_12["levelname"];
		$_var_16 = array("first" => array("value" => "亲爱的" . $_var_9["nickname"] . ", 恭喜您成功升级！", "color" => "#4a5077"), "keyword1" => array("title" => "任务名称", "value" => "会员升级", "color" => "#4a5077"), "keyword2" => array("title" => "通知类型", "value" => "您会员等级从 " . $_var_38 . " 升级为 " . $_var_37["levelname"] . ", 特此通知!", "color" => "#4a5077"), "remark" => array("value" => "\r\n您即可享有" . $_var_37["levelname"] . "的专属优惠及服务！", "color" => "#4a5077"));
		if (!empty($_var_13["upgrade"]) && empty($_var_10["upgrade"])) {
			m("message")->sendTplNotice($_var_4, $_var_13["upgrade"], $_var_16, $_var_3);
		} else if (empty($_var_10["upgrade"])) {
			m("message")->sendCustomNotice($_var_4, $_var_16, $_var_3);
		}
	}

	public function sendMemberLogMessage($_var_39 = '')
	{
		global $_W, $_GPC;
		$_var_40 = pdo_fetch("select * from " . tablename("ewei_shop_member_log") . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $_var_39, ":uniacid" => $_W["uniacid"]));
		$_var_9 = m("member")->getMember($_var_40["openid"]);
		$_var_12 = m("common")->getSysset("shop");
		$_var_10 = unserialize($_var_9["noticeset"]);
		if (!is_array($_var_10)) {
			$_var_10 = array();
		}
		$_var_26 = m("common")->getAccount();
		if (!$_var_26) {
			return;
		}
		$_var_13 = m("common")->getSysset("notice");
		if ($_var_40["type"] == 0) {
			if ($_var_40["status"] == 1) {
				$_var_41 = "后台充值";
				if ($_var_40["rechargetype"] == "wechat") {
					$_var_41 = "微信支付";
				} else if ($_var_40 == "alipay") {
					$_var_41["rechargetype"] = "支付宝";
				}
				$_var_42 = "¥" . $_var_40["money"] . "元";
				if ($_var_40["gives"] > 0) {
					$_var_43 = $_var_40["money"] + $_var_40["gives"];
					$_var_42 .= "，系统赠送" . $_var_40["gives"] . "元，合计:" . $_var_43 . "元";
				}
				$_var_16 = array("first" => array("value" => "恭喜您充值成功!", "color" => "#4a5077"), "money" => array("title" => "充值金额", "value" => $_var_42, "color" => "#4a5077"), "product" => array("title" => "充值方式", "value" => $_var_41, "color" => "#4a5077"), "remark" => array("value" => "\r\n谢谢您对我们的支持！", "color" => "#4a5077"));
				$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member";
				if (strexists($_var_3, "/addons/ewei_shop/")) {
					$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
				}
				if (strexists($_var_3, "/core/mobile/order/")) {
					$_var_3 = str_replace("/core/mobile/order/", "/", $_var_3);
				}
				if (!empty($_var_13["recharge_ok"]) && empty($_var_10["recharge_ok"])) {
					m("message")->sendTplNotice($_var_40["openid"], $_var_13["recharge_ok"], $_var_16, $_var_3);
				} else if (empty($_var_10["recharge_ok"])) {
					m("message")->sendCustomNotice($_var_40["openid"], $_var_16, $_var_3);
				}
			} else if ($_var_40["status"] == 3) {
				$_var_16 = array("first" => array("value" => "充值退款成功!", "color" => "#4a5077"), "reason" => array("title" => "退款原因", "value" => "【" . $_var_12["name"] . "】充值退款", "color" => "#4a5077"), "refund" => array("title" => "退款金额", "value" => "¥" . $_var_40["money"] . "元", "color" => "#4a5077"), "remark" => array("value" => "\r\n退款成功，请注意查收! 谢谢您对我们的支持！", "color" => "#4a5077"));
				$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member";
				if (strexists($_var_3, "/addons/ewei_shop/")) {
					$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
				}
				if (strexists($_var_3, "/core/mobile/order/")) {
					$_var_3 = str_replace("/core/mobile/order/", "/", $_var_3);
				}
				if (!empty($_var_13["recharge_fund"]) && empty($_var_10["recharge_fund"])) {
					m("message")->sendTplNotice($_var_40["openid"], $_var_13["recharge_fund"], $_var_16, $_var_3);
				} else if (empty($_var_10["recharge_fund"])) {
					m("message")->sendCustomNotice($_var_40["openid"], $_var_16, $_var_3);
				}
			}
		} else if ($_var_40["type"] == 1 && $_var_40["status"] == 0) {
			$_var_16 = array("first" => array("value" => "提现申请已经成功提交!", "color" => "#4a5077"), "money" => array("title" => "提现金额", "value" => "¥" . $_var_40["money"] . "元", "color" => "#4a5077"), "timet" => array("title" => "提现时间", "value" => date("Y-m-d H:i:s", $_var_40["createtime"]), "color" => "#4a5077"), "remark" => array("value" => "\r\n请等待我们的审核并打款！", "color" => "#4a5077"));
			$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member&p=log&type=1";
			if (strexists($_var_3, "/addons/ewei_shop/")) {
				$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
			}
			if (!empty($_var_13["withdraw"]) && empty($_var_10["withdraw"])) {
				m("message")->sendTplNotice($_var_40["openid"], $_var_13["withdraw"], $_var_16, $_var_3);
			} else if (empty($_var_10["withdraw"])) {
				m("message")->sendCustomNotice($_var_40["openid"], $_var_16, $_var_3);
			}
		} else if ($_var_40["type"] == 1 && $_var_40["status"] == 1) {
			$_var_16 = array("first" => array("value" => "恭喜您成功提现!", "color" => "#4a5077"), "money" => array("title" => "提现金额", "value" => "¥" . $_var_40["money"] . "元", "color" => "#4a5077"), "timet" => array("title" => "提现时间", "value" => date("Y-m-d H:i:s", $_var_40["createtime"]), "color" => "#4a5077"), "remark" => array("value" => "\r\n感谢您的支持！", "color" => "#4a5077"));
			$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member&p=log&type=1";
			if (!empty($_var_13["withdraw_ok"]) && empty($_var_10["withdraw_ok"])) {
				m("message")->sendTplNotice($_var_40["openid"], $_var_13["withdraw_ok"], $_var_16, $_var_3);
			} else if (empty($_var_10["withdraw_ok"])) {
				m("message")->sendCustomNotice($_var_40["openid"], $_var_16, $_var_3);
			}
		} else if ($_var_40["type"] == 1 && $_var_40["status"] == -1) {
			$_var_16 = array("first" => array("value" => "抱歉，提现申请审核失败!", "color" => "#4a5077"), "money" => array("title" => "提现金额", "value" => "¥" . $_var_40["money"] . "元", "color" => "#4a5077"), "timet" => array("title" => "提现时间", "value" => date("Y-m-d H:i:s", $_var_40["createtime"]), "color" => "#4a5077"), "remark" => array("value" => "\r\n有疑问请联系客服，谢谢您的支持！", "color" => "#4a5077"));
			$_var_3 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member&p=log&type=1";
			if (strexists($_var_3, "/addons/ewei_shop/")) {
				$_var_3 = str_replace("/addons/ewei_shop/", "/", $_var_3);
			}
			if (strexists($_var_3, "/core/mobile/order/")) {
				$_var_3 = str_replace("/core/mobile/order/", "/", $_var_3);
			}
			if (!empty($_var_13["withdraw_fail"]) && empty($_var_10["withdraw_fail"])) {
				m("message")->sendTplNotice($_var_40["openid"], $_var_13["withdraw_fail"], $_var_16, $_var_3);
			} else if (empty($_var_10["withdraw_fail"])) {
				m("message")->sendCustomNotice($_var_40["openid"], $_var_16, $_var_3);
			}
		}
	}
}