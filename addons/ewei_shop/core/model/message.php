<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Ewei_DShop_Message
{
	public function sendTplNotice($_var_0, $_var_1, $_var_2, $_var_3 = '', $_var_4 = null)
	{
		if (!$_var_4) {
			$_var_4 = m("common")->getAccount();
		}
		if (!$_var_4) {
			return;
		}
		return $_var_4->sendTplNotice($_var_0, $_var_1, $_var_2, $_var_3);
	}

	public function sendCustomNotice($_var_5, $_var_6, $_var_3 = '', $_var_4 = null)
	{
		{
			if (!$_var_4) {
				$_var_4 = m("common")->getAccount();
			}
			if (!$_var_4) {
				return;
			}
			$_var_7 = "";
			if (is_array($_var_6)) {
				foreach ($_var_6 as $_var_8 => $_var_9) {
					if (!empty($_var_9["title"])) {
						$_var_7 .= $_var_9["title"] . ":" . $_var_9["value"] . "\n";
					} else {
						$_var_7 .= $_var_9["value"] . "\n";
						if ($_var_8 == 0) {
							$_var_7 .= "\n";
						}
					}
				}
			} else {
				$_var_7 = $_var_6;
			}
			if (!empty($_var_3)) {
				$_var_7 .= "<a href='{$_var_3}'>点击查看详情</a>";
			}
			return $_var_4->sendCustomNotice(array("touser" => $_var_5, "msgtype" => "text", "text" => array("content" => urlencode($_var_7))));
		}
	}

	public function sendImage($_var_5, $_var_10)
	{
		$_var_4 = m("common")->getAccount();
		return $_var_4->sendCustomNotice(array("touser" => $_var_5, "msgtype" => "image", "image" => array("media_id" => $_var_10)));
	}

	public function sendNews($_var_5, $_var_11, $_var_4 = null)
	{
		if (!$_var_4) {
			$_var_4 = m("common")->getAccount();
		}
		return $_var_4->sendCustomNotice(array("touser" => $_var_5, "msgtype" => "news", "news" => array("articles" => $_var_11)));
	}
}