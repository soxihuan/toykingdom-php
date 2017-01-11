<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("ArticleModel")) {
	class ArticleModel extends PluginModel
	{
		public function doShare($_var_0, $_var_1, $_var_2)
		{
			global $_W, $_GPC;
			if (empty($_var_0) || empty($_var_1) || empty($_var_2) || $_var_1 == $_var_2) {
				return;
			}
			$_var_3 = m("member")->getMember($_var_1);
			$_var_4 = m("member")->getMember($_var_2);
			if (empty($_var_4) || empty($_var_3)) {
				return;
			}
			$_var_5 = m("common")->getSysset("shop");
			$_var_6 = intval($_var_0["article_rule_credit"]);
			$_var_7 = floatval($_var_0["article_rule_money"]);
			$_var_8 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("ewei_shop_article_share") . " WHERE aid=:aid and click_user=:click_user and uniacid=:uniacid ", array(":aid" => $_var_0["id"], ":click_user" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (!empty($_var_8)) {
				$_var_6 = intval($_var_0["article_rule_credit2"]);
				$_var_7 = floatval($_var_0["article_rule_money2"]);
			}
			if (!empty($_var_0["article_hasendtime"]) && time() > $_var_0["article_endtime"]) {
				return;
			}
			$_var_9 = $_var_0["article_readtime"];
			if ($_var_9 <= 0) {
				$_var_9 = 4;
			}
			$_var_10 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("ewei_shop_article_share") . " WHERE aid=:aid and share_user=:share_user and click_user=:click_user and uniacid=:uniacid ", array(":aid" => $_var_0["id"], ":share_user" => $_var_1, ":click_user" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if ($_var_10 >= $_var_9) {
				return;
			}
			$_var_11 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("ewei_shop_article_share") . " WHERE aid=:aid and share_user=:share_user and uniacid=:uniacid ", array(":aid" => $_var_0["id"], ":share_user" => $_var_1, ":uniacid" => $_W["uniacid"]));
			if ($_var_11 >= $_var_0["article_rule_allnum"]) {
				$_var_6 = 0;
				$_var_7 = 0;
			} else {
				$_var_12 = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
				$_var_13 = mktime(0, 0, 0, date("m"), date("d") + 1, date("Y")) - 1;
				$_var_14 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("ewei_shop_article_share") . ' WHERE aid=:aid and share_user=:share_user and click_date>:day_start and click_date<:day_end and uniacid=:uniacid ', array(":aid" => $_var_0["id"], ":share_user" => $_var_1, ":day_start" => $_var_12, ":day_end" => $_var_13, ":uniacid" => $_W["uniacid"]));
				if ($_var_14 >= $_var_0["article_rule_daynum"]) {
					$_var_6 = 0;
					$_var_7 = 0;
				}
			}
			$_var_15 = pdo_fetchcolumn("SELECT COUNT(*) FROM " . tablename("ewei_shop_article_share") . " WHERE aid=:aid and share_user=:click_user and click_user=:share_user and uniacid=:uniacid ", array(":aid" => $_var_0["id"], ":share_user" => $_var_1, ":click_user" => $_var_2, ":uniacid" => $_W["uniacid"]));
			if (!empty($_var_15)) {
				return;
			}
			if ($_var_0["article_rule_credittotal"] > 0 || $_var_0["article_rule_moneytotal"] > 0) {
				$_var_16 = 0;
				$_var_17 = 0;
				$_var_18 = pdo_fetchcolumn("select count(distinct click_user) from " . tablename("ewei_shop_article_share") . " where aid=:aid and uniacid=:uniacid limit 1", array(":aid" => $_var_0["id"], ":uniacid" => $_W["uniacid"]));
				$_var_19 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_article_share") . " where aid=:aid and uniacid=:uniacid limit 1", array(":aid" => $_var_0["id"], ":uniacid" => $_W["uniacid"]));
				$_var_20 = $_var_19 - $_var_18;
				if ($_var_0["article_rule_credittotal"] > 0) {
					$_var_16 = $_var_0["article_rule_credittotal"] - ($_var_18 + $_var_0["article_readnum_v"]) * $_var_0["article_rule_creditm"] - $_var_20 * $_var_0["article_rule_creditm2"];
				}
				if ($_var_0["article_rule_moneytotal"] > 0) {
					$_var_17 = $_var_0["article_rule_moneytotal"] - ($_var_18 + $_var_0["article_readnum_v"]) * $_var_0["article_rule_moneym"] - $_var_20 * $_var_0["article_rule_moneym2"];
				}
				$_var_16 <= 0 && $_var_16 = 0;
				$_var_17 <= 0 && $_var_17 = 0;
				if ($_var_16 <= 0) {
					$_var_6 = 0;
				}
				if ($_var_17 <= 0) {
					$_var_7 = 0;
				}
			}
			$_var_21 = array("aid" => $_var_0["id"], "share_user" => $_var_1, "click_user" => $_var_2, "click_date" => time(), "add_credit" => $_var_6, "add_money" => $_var_7, "uniacid" => $_W["uniacid"]);
			pdo_insert("ewei_shop_article_share", $_var_21);
			if ($_var_6 > 0) {
				m("member")->setCredit($_var_3["openid"], "credit1", $_var_6, array(0, $_var_5["name"] . " 文章营销奖励积分"));
			}
			if ($_var_7 > 0) {
				m("member")->setCredit($_var_3["openid"], "credit2", $_var_7, array(0, $_var_5["name"] . " 文章营销奖励余额"));
			}
			if ($_var_6 > 0 || $_var_7 > 0) {
				$_var_22 = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_article_sys") . " WHERE uniacid=:uniacid limit 1 ", array(":uniacid" => $_W["uniacid"]));
				$_var_23 = $_W["siteroot"] . "app/index.php?i=" . $_W["uniacid"] . "&c=entry&m=ewei_shop&do=member";
				$_var_24 = '';
				if ($_var_6 > 0) {
					$_var_24 .= $_var_6 . "个积分、";
				}
				if ($_var_7 > 0) {
					$_var_24 .= $_var_7 . "元余额";
				}
				$_var_25 = array("first" => array("value" => "您的奖励已到帐！", "color" => "#4a5077"), "keyword1" => array("title" => "任务名称", "value" => "分享得奖励", "color" => "#4a5077"), "keyword2" => array("title" => "通知类型", "value" => "用户通过您的分享进入文章《" . $_var_0["article_title"] . "》，系统奖励您" . $_var_24 . "。", "color" => "#4a5077"), "remark" => array("value" => "奖励已发放成功，请到会员中心查看。", "color" => "#4a5077"));
				if (!empty($_var_22["article_message"])) {
					m("message")->sendTplNotice($_var_3["openid"], $_var_22["article_message"], $_var_25, $_var_23);
				} else {
					m("message")->sendCustomNotice($_var_3["openid"], $_var_25, $_var_23);
				}
			}
		}

		function mid_replace($_var_26)
		{
			global $_GPC;
			preg_match_all("/href\\=[\"|\\'](.*?)[\"|\\']/is", $_var_26, $_var_27);
			foreach ($_var_27[1] as $_var_28 => $_var_29) {
				$_var_30 = $this->href_replace($_var_29);
				$_var_26 = str_replace($_var_27[0][$_var_28], "href=\"{$_var_30}\"", $_var_26);
			}
			return $_var_26;
		}

		function href_replace($_var_29)
		{
			global $_GPC;
			$_var_30 = $_var_29;
			if (strexists($_var_29, "ewei_shop") && !strexists($_var_29, "&mid")) {
				if (strexists($_var_29, "?")) {
					$_var_30 = $_var_29 . "&mid=" . intval($_GPC["mid"]);
				} else {
					$_var_30 = $_var_29 . "?mid=" . intval($_GPC["mid"]);
				}
			}
			return $_var_30;
		}

		function perms()
		{
			return array("article" => array("text" => $this->getName(), "isplugin" => true, "child" => array("cate" => array("text" => "分类设置", "addcate" => "添加分类-log", "editcate" => "编辑分类-log", "delcate" => "删除分类-log"), "page" => array("text" => "文章设置", "add" => "添加文章-log", "edit" => "修改文章-log", "delete" => "删除文章-log", "showdata" => "查看数据统计", "otherset" => "其他设置", "report" => "举报记录"))));
		}
	}
}