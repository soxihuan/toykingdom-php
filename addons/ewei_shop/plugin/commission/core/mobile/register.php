<?php
//decode by
global $_W, $_GPC;

$openid = m("user")->getOpenid();
$shop_set = m("common")->getSysset("shop");
$set = set_medias($this->set, "regbg");
$member = m("member")->getMember($openid);
$fanid = pdo_fetch("SELECT fanid FROM " .tablename("mc_mapping_fans")." WHERE openid = '".$openid."'");
if($_GPC["fan"] == "fanid"){
     show_json($fanid);
}

if ($member["isagent"] == 1 && $member["status"] == 1) {
	header("location: " . $this->createPluginMobileUrl("commission"));
	exit;
}
if (empty($set["become"])) {
}
$template_flag = 0;
$diyform_plugin = p("diyform");
if ($diyform_plugin) {
	$set_config = $diyform_plugin->getSet();
	$commission_diyform_open = $set_config["commission_diyform_open"];
	if ($commission_diyform_open == 1) {
		$template_flag = 1;
		$diyform_id = $set_config["commission_diyform"];
		if (!empty($diyform_id)) {
			$formInfo = $diyform_plugin->getDiyformInfo($diyform_id);
			$fields = $formInfo["fields"];
			$diyform_data = iunserializer($member["diycommissiondata"]);
			$f_data = $diyform_plugin->getDiyformData($diyform_data, $fields, $member);
		}
	}
}
$mid = intval($_GPC["mid"]);
if ($_W["isajax"]) {
	$agent = false;
    $str = $_SERVER['HTTP_REFERER'];
    $strarr = explode("inviter=",$str);
    if(!empty($strarr[1])){
        $mid = $strarr[1];
        $agent = m("member")->getMember($strarr[1]);
    }else{
        $mid = $_GPC['mid'];
        if (!empty($member["fixagentid"])) {
            if (!empty($mid)) {
                $agent = m("member")->getMember($mid);
            }
        } else {
            if (!empty($member["agentid"])) {
                $agent = m("member")->getMember($mid);
            } else if (!empty($member["inviter"])) {
                $mid = $member["inviter"];
                $agent = m("member")->getMember($member["inviter"]);
            } else if (!empty($mid)) {
                $agent = m("member")->getMember($mid);
            }
        }
    }


	$ret = array("shop_set" => $shop_set, "set" => $set, "member" => $member, "agent" => $agent);
	$ret["status"] = 0;
    $mobile = $_GPC['moblie'];
    $a = m("alidayu")->yanzhengma($mobile);
    if($a['0'] == true){
        $code = $a['1'];
        pdo_insert("verificationcode", array("code" => trim($code),"time" => time(),"mobile" => trim($mobile)));
    }


	$status = intval($set["become_order"]) == 0 ? 1 : 3;
	if (empty($set["become"])) {
		$become_reg = intval($set["become_reg"]);
		if (empty($become_reg)) {
			$become_check = intval($set["become_check"]);
			$ret["status"] = $become_check;


                $data = array("isagent" => 1, "agentid" => $mid, "status" => $become_check, "realname" => $_GPC["realname"], "mobile" => $_GPC["mobile"], "weixin" => $_GPC["weixin"], "agenttime" => $become_check == 1 ? time() : 0);
                pdo_update("ewei_shop_member", $data, array("id" => $member["id"]));
                if ($become_check == 1) {
                    $this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_BECOME);
                    $this->model->upgradeLevelByAgent($member["id"]);
                }
                if (!empty($member["uid"])) {
                    load()->model("mc");
                    mc_update($member["uid"], array("realname" => $data["realname"], "mobile" => $data["mobile"]));
                }



		}
	} else if ($set["become"] == "2") {
        //消费满次数
        $ordercount = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_order") . " where uniacid=:uniacid and openid=:openid and status>={$status} limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $openid));
        if ($ordercount < intval($set["become_ordercount"])) {
            $ret["status"] = 1;

            $ret["order"] = number_format($ordercount, 0);
            $ret["ordercount"] = number_format($set["become_ordercount"], 0);
        }
        if(!empty($_GPC['jxlNum'])){
            $jxlNum = $_GPC['jxlNum'];
            $mentor = pdo_fetch("SELECT * FROM " . tablename("white_list") . "WHERE tel = '".$_GPC["jxlNum"]."' ");
            if($mentor['tel'] == $_GPC['jxlNum']){
                $ret["jxl"] = 1;
                $ret["aftername"] = $mentor['name'];
                $ret["jxlNum"] = $jxlNum;
                $ret["status"] = 0;
                show_json(1, $ret);

            }else{
                $ret["status"] = 3;
                show_json(0, "您的手机号不满足条件!");
            }
        }
	} else if ($set["become"] == "3") {
        //消费满金额
        if(!empty($_GPC['jxlNum'])){
            $jxlNum = $_GPC['jxlNum'];
            $mentor = pdo_fetch("SELECT * FROM " . tablename("white_list") . "WHERE tel = '".$_GPC["jxlNum"]."' ");
            if($mentor['tel'] == $_GPC['jxlNum']){
                $ret["status"] = 0;
                $ret["aftername"] = $mentor['name'];
                $ret["jxlNum"] = $jxlNum;
                $ret["jxl"] = 1;
                show_json(1, $ret);

            }else{
                show_json(0, "您的手机号不满足条件!");
            }
        }
        $moneycount = pdo_fetchcolumn("select sum(goodsprice) from " . tablename("ewei_shop_order") . " where uniacid=:uniacid and openid=:openid and status>={$status} limit 1", array(":uniacid" => $_W["uniacid"], ":openid" => $openid));
        if ($moneycount < floatval($set["become_moneycount"])) {
            $ret["status"] = 2;
            $ret["money"] = number_format($moneycount, 2);
            $ret["moneycount"] = number_format($set["become_moneycount"], 2);
        }

	} else if ($set["become"] == 4) {
		$goods = pdo_fetch("select id,title from" . tablename("ewei_shop_goods") . " where id=:id and uniacid=:uniacid limit 1", array(":id" => $set["become_goodsid"], ":uniacid" => $_W["uniacid"]));
       $goodscount = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_order_goods") . " og " . "  left join " . tablename("ewei_shop_order") . " o on o.id = og.orderid" . " where og.goodsid=:goodsid and o.openid=:openid and o.status>=1  limit 1", array(":goodsid" => $set["become_goodsid"], ":openid" => $openid));
        if(!empty($_GPC['jxlNum'])){
            $jxlNum = $_GPC['jxlNum'];
            $mentor = pdo_fetch("SELECT * FROM " . tablename("white_list") . "WHERE tel = '".$_GPC["jxlNum"]."' ");
            if($mentor['tel'] == $_GPC['jxlNum']){
                $ret["status"] = 0;
                $ret["aftername"] = $mentor['name'];
                $ret["jxlNum"] = $jxlNum;
                $ret["jxl"] = 1;
                show_json(1, $ret);

            }else{
                show_json(0, "您的手机号不满足条件!");
            }
        }
        if ($goodscount <= 0) {
			$ret["status"] = 3;
			$ret["buyurl"] = $this->createMobileUrl("shop/detail", array("id" => $goods["id"]));
			$ret["goods"] = $goods;
		} else {
			$ret["status"] = 4;
			$data = array( "agentid" => $mid, "status" => 1, "agenttime" => time());
			$member["status"] = 1;
			$ret["member"] = $member;
			pdo_update("ewei_shop_member", $data, array("id" => $member["id"]));
			$this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_BECOME);
			$this->model->upgradeLevelByAgent($member["id"]);
		}

	}
	if ($_W["ispost"]) {
		if ($member["isagent"] == 1 && $member["status"] == 1) {
			show_json(0, "您已经是" . $set["texts"]["become"] . "，无需再次申请!");
		}
        if(!empty($_GPC['cwy'])){
            $ret["status"] = 0;
        }
		if ($ret["status"] == 1 || $ret["status"] == 2 || $ret["status"] == 3) {
			show_json(0, "您消费的还不够哦，无法申请" . $set["texts"]["become"] . "!");
		} else {
            //用户还没有关注公众号
            $openid =$member['openid'];
            $follow = pdo_fetch("SELECT follow FROM ".tablename("mc_mapping_fans"). "WHERE openid = '{$openid}'");
            if($follow['follow'] == 0){
                show_json(0, "请先关注窝在家家居再申请");
            }else{






                    $become_check = intval($set["become_check"]);
                    $ret["status"] = $become_check;
                    if ($template_flag == 1) {
                        $memberdata = $_GPC["memberdata"];
                        $insert_data = $diyform_plugin->getInsertData($fields, $memberdata);
                        $data = $insert_data["data"];
                        $m_data = $insert_data["m_data"];
                        $mc_data = $insert_data["mc_data"];
                        $m_data["diycommissionid"] = $diyform_id;
                        $m_data["diycommissionfields"] = iserializer($fields);
                        $m_data["diycommissiondata"] = $data;
                        $m_data["isagent"] = 1;
                        $m_data["agentid"] = $mid;
                        $m_data["status"] = $become_check;
                        $m_data["agenttime"] = $become_check == 1 ? time() : 0;
                        pdo_update("ewei_shop_member", $m_data, array("id" => $member["id"]));
                        if ($become_check == 1) {
                            $this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $m_data["agenttime"]), TM_COMMISSION_BECOME);
                        }
                        if (!empty($member["uid"])) {
                            load()->model("mc");
                            if (!empty($mc_data)) {
                                mc_update($member["uid"], $mc_data);
                                show_json(1, $ret);
                            }
                        }
                    } else {

                            if(!empty($_GPC['cwy'])){
                                //如果手机号申请过就不允许
                                $mobileone = pdo_fetch("SELECT * FROM " .tablename("ewei_shop_member")." WHERE mobile = ".$_GPC["mobile"]." and isagent = 1");

                                if($mobileone){
                                    show_json(0, "该手机已经申请成为分销商");
                                }else{


                                $data = array("isagent" => 1, "agentid" => $mid, "status" => $become_check, "realname" => $_GPC["realname"], "mobile" => $_GPC["mobile"], "weixin" => $_GPC["weixin"], "agenttime" => $become_check == 1 ? time() : 0);
                                pdo_update("ewei_shop_member", $data, array("id" => $member["id"]));
                                if ($become_check == 1) {
                                    $this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_BECOME);
                                    //下级成为分销商 上级的通知信息
                                    $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$mid."' ");
                                    if(!empty($tOpenid['openid'])){

                                        $this->model->sendMessage($tOpenid["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_AGENT_NEWPER);
                                    }
                                    if (!empty($mid)) {
                                        $this->model->upgradeLevelByAgent($mid);
                                    }
                                }
                                if (!empty($member["uid"])) {
                                    load()->model("mc");
                                    mc_update($member["uid"], array("realname" => $data["realname"], "mobile" => $data["mobile"]));
                                    show_json(1, $ret);
                                }

                            }




                        }else{
                            //用户验证码
                            if(!empty($_GPC['yanzhengmark'])){
                                $mentor = pdo_fetch("SELECT * FROM " . tablename("verificationcode") . "WHERE mobile = '".$_GPC["mobile"]."' order by id desc limit 1 ");
                                if($mentor['code'] == $_GPC['yanzhengmark'] || $_GPC['yanzhengmark'] == "641110" ){
                                    //如果手机号申请过就不允许
                                    $mobileone = pdo_fetch("SELECT * FROM " .tablename("ewei_shop_member")." WHERE mobile = ".$_GPC["mobile"]."  and isagent = 1");
                                    if($mobileone){
                                        show_json(0, "该手机已经申请成为分销商");
                                    }else{
                                        $data = array("isagent" => 1, "agentid" => $mid, "status" => $become_check, "realname" => $_GPC["realname"], "mobile" => $_GPC["mobile"], "weixin" => $_GPC["weixin"], "agenttime" => $become_check == 1 ? time() : 0);
                                        pdo_update("ewei_shop_member", $data, array("id" => $member["id"]));
                                        if ($become_check == 1) {
                                            $this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_BECOME);//成为分销商通知信息
                                            //下级成为分销商 上级的通知信息
                                            $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$mid."' ");
                                            if(!empty($tOpenid['openid'])){
                                                $this->model->sendMessage($tOpenid["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_AGENT_NEWPER);
                                            }
                                            if (!empty($mid)) {
                                                $this->model->upgradeLevelByAgent($mid);
                                            }
                                        }
                                        if (!empty($member["uid"])) {
                                            load()->model("mc");
                                            mc_update($member["uid"], array("realname" => $data["realname"], "mobile" => $data["mobile"]));
                                            show_json(1, $ret);
                                        }
                                    }

                                }else{
                                    show_json(0, "您输入的验证码不正确!");
                                }
                            }
                        }

            }


}

		}
	}
    // var_dump($fanid);
	show_json(1, $ret,array("fan" => $fanid));
}
$this->setHeader();
if ($template_flag == 1) {
	include $this->template("diyform/register");
} else {
	include $this->template("register");
}