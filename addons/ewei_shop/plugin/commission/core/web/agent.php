<?php
//decode by  
global $_W, $_GPC;
$agentlevels = $this->model->getLevels();
$mentor_search=$_GPC['mentor_search'];
$operation = empty($_GPC["op"]) ? "display" : $_GPC["op"];
if ($operation == "display") {
	ca("commission.agent.view");
    if (!empty($_GPC["mytest"])) {
        $mytest= explode(',', $_GPC['mytest']);
        foreach($mytest as $val){
            $mentor_id=$_GPC["mentor_name"];
            $mentor["mentor_id"]=$mentor_id;
            $openid = pdo_fetch("SELECT openid from ".tablename("ewei_shop_member")." WHERE id = '{$val}'");
            pdo_update("ewei_shop_member", $mentor, array("id" => $val));
            if(!empty($_GPC["mentor_name"])){
                $mentor_wx = pdo_fetch("SELECT name,wechat FROM ".tablename("mentor"). " WHERE id = '{$mentor_id}'");
                $this->model->sendMessage($openid["openid"], array("nickname" => $mentor_wx['name'], "mentor_wx" => $mentor_wx["wechat"]), TM_COMMISSION_MENTOR);
            }
        }
    }else{
        if(!empty($_GPC["mentor_id"]) ){
            $member_id=$_GPC["mentor_id"];
            $openid = pdo_fetch("SELECT openid from ".tablename("ewei_shop_member")." WHERE id = '{$member_id}'");
            if(empty($_GPC["mentor_name"])){
                $mentor_id='';
                $mentor["mentor_id"]=$mentor_id;
            }else{
                $mentor_id=$_GPC["mentor_name"];
                $mentor["mentor_id"]=$mentor_id;
            }
            pdo_update("ewei_shop_member", $mentor, array("id" => $member_id));
            if(!empty($_GPC["mentor_name"])){
                $mentor_id=$_GPC["mentor_name"];
                $mentor_wx = pdo_fetch("SELECT name,wechat FROM ".tablename("mentor"). " WHERE id = '{$mentor_id}'");
                $this->model->sendMessage($openid["openid"], array("nickname" => $mentor_wx['name'], "mentor_wx" => $mentor_wx["wechat"]), TM_COMMISSION_MENTOR);

            }
        }

    }



	$level = $this->set["level"];
	$pindex = max(1, intval($_GPC["page"]));
	$psize = 20;
	$params = array();
	$condition = '';
	if (!empty($_GPC["mid"])) {
		$condition .= " and dm.id=:mid";
		$params[":mid"] = intval($_GPC["mid"]);
	}
	if (!empty($_GPC["realname"])) {
		$_GPC["realname"] = trim($_GPC["realname"]);
		$condition .= " and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname)";
		$params[":realname"] = "%{$_GPC["realname"]}%";
	}
	if ($_GPC["parentid"] == '0') {
		$condition .= " and dm.agentid=0";
	} else if (!empty($_GPC["parentname"])) {
		$_GPC["parentname"] = trim($_GPC["parentname"]);
		$condition .= " and ( p.mobile like :parentname or p.nickname like :parentname or p.realname like :parentname)";
		$params[":parentname"] = "%{$_GPC["parentname"]}%";
	}
	if ($_GPC["followed"] != '') {
		if ($_GPC["followed"] == 2) {
			$condition .= " and f.follow=0 and dm.uid<>0";
		} else {
			$condition .= " and f.follow=" . intval($_GPC["followed"]);
		}
	}
	if (empty($starttime) || empty($endtime)) {
		$starttime = strtotime("-1 month");
		$endtime = time();
	}
	if (!empty($_GPC["time"])) {
		$starttime = strtotime($_GPC["time"]["start"]);
		$endtime = strtotime($_GPC["time"]["end"]);
		if ($_GPC["searchtime"] == "1") {
			$condition .= " AND dm.agenttime >= :starttime AND dm.agenttime <= :endtime ";
			$params[":starttime"] = $starttime;
			$params[":endtime"] = $endtime;
		}
	}
	if (!empty($_GPC["agentlevel"])) {
		$condition .= " and dm.agentlevel=" . intval($_GPC["agentlevel"]);
	}
	if ($_GPC["status"] != '') {
		$condition .= " and dm.status=" . intval($_GPC["status"]);
	}
	if ($_GPC["agentblack"] != '') {
		$condition .= " and dm.agentblack=" . intval($_GPC["agentblack"]);
	}
    if(!empty($_GPC["mentor_search"])){
        if($_GPC["mentor_search"] != 'weifenpei'){
            $condition .= " and dm.mentor_id=" . intval($_GPC["mentor_search"]);
        }elseif($_GPC["mentor_search"] == 'weifenpei'){
            $condition .= " and dm.mentor_id is null or dm.mentor_id = 0" ;
        }
    }

	$sql = 'select dm.*,dm.nickname,dm.avatar,dm.mentor_id,l.levelname,p.nickname as parentname,p.avatar as parentavatar,men.name as menname,men.head_url as menhead from ' . tablename("ewei_shop_member") . " dm " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("ewei_shop_commission_level") . " l on l.id = dm.agentlevel" . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid and f.uniacid={$_W["uniacid"]}" . " left join ". tablename("mentor") . "men on men.id=dm.mentor_id " . " where dm.uniacid = " . $_W["uniacid"] . " and dm.isagent =1  {$condition} ORDER BY dm.agenttime desc,dm.createtime desc";

    if (empty($_GPC["export"])) {
		$sql .= " limit " . ($pindex - 1) * $psize . "," . $psize;
	}

	$list = pdo_fetchall($sql, $params);

	$total = pdo_fetchcolumn("select count(dm.id) from" . tablename("ewei_shop_member") . " dm  " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid" . " where dm.uniacid =" . $_W["uniacid"] . " and dm.isagent =1 {$condition}", $params);

    foreach ($list as &$row) {
		$info = $this->model->getInfo($row["openid"], array("total", "pay"));
        $set              = $this->getSet();
        $level            = intval($set['level']);
		$row["levelcount"] = $info["agentcount"];
		if ($level >= 1) {
			$row["level1"] = $info["level1"];
		}
		if ($level >= 2) {
			$row["level2"] = $info["level2"];
		}
		if ($level >= 3) {
			$row["level3"] = $info["level3"];
		}
		$row["credit1"] = m("member")->getCredit($row["openid"], "credit1");
		$row["credit2"] = m("member")->getCredit($row["openid"], "credit2");
		$row["commission_total"] = $info["commission_total"];
		$row["commission_pay"] = $info["commission_pay"];
		$row["followed"] = m("user")->followed($row["openid"]);
	}
	unset($row);


	if ($_GPC["export"] == "1") {
//		ca("commission.agent.export");
//		plog("commission.agent.export", "导出分销商数据");
//		foreach ($list as &$row) {
//			$row["createtime"] = date("Y-m-d H:i", $row["createtime"]);
//			$row["agenttime"] = date("Y-m-d H:i", $row["agenttime"]);
//			$row["agentime"] = empty($row["agenttime"]) ? '' : date("Y-m-d H:i", $row["agentime"]);
//			$row["groupname"] = empty($row["groupname"]) ? "无分组" : $row["groupname"];
//			$row["levelname"] = empty($row["levelname"]) ? "普通等级" : $row["levelname"];
//			$row["parentname"] = empty($row["parentname"]) ? "总店" : "[" . $row["agentid"] . "]" . $row["parentname"];
//			$row["statusstr"] = empty($row["status"]) ? '' : "通过";
//			$row["followstr"] = empty($row["followed"]) ? '' : "已关注";
//			$row["menname"] = empty($row["menname"]) ? "" : $row["menname"];
//		}
//
//		unset($row);
//		m("excel")->export($list, array("title" => "分销商数据-" . date("Y-m-d-H-i", time()), "columns" => array(array("title" => "ID", "field" => "id", "width" => 12), array("title" => "昵称", "field" => "nickname", "width" => 12), array("title" => "姓名", "field" => "realname", "width" => 12), array("title" => "手机号", "field" => "mobile", "width" => 12), array("title" => "openid", "field" => "openid", "width" => 24), array("title" => "微信号", "field" => "weixin", "width" => 12), array("title" => "推荐人", "field" => "parentname", "width" => 12), array("title" => "分销商等级", "field" => "levelname", "width" => 12), array("title" => "点击数", "field" => "clickcount", "width" => 12), array("title" => "下线分销商总数", "field" => "levelcount", "width" => 12), array("title" => "一级下线分销商数", "field" => "level1", "width" => 12), array("title" => "二级下线分销商数", "field" => "level2", "width" => 12), array("title" => "三级下线分销商数", "field" => "level3", "width" => 12), array("title" => "累计佣金", "field" => "commission_total", "width" => 12), array("title" => "打款佣金", "field" => "commission_pay", "width" => 12), array("title" => "注册时间", "field" => "createtime", "width" => 12), array("title" => "成为分销商时间", "field" => "agenttime", "width" => 12), array("title" => "审核状态", "field" => "agenttime", "width" => 12), array("title" => "是否关注", "field" => "followstr", "width" => 12),array("title" => "导师姓名", "field" => "menname", "width" => 12))));

        $filename = "分销商数据-" . date("Y-m-d H:i", time());
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"" . $filename . ".csv\"");
        header('Cache-Control: max-age=0');
        $fp = fopen('php://output', 'a');
        $head = array('ID','openid', '姓名', '手机号','微信号','注册时间','成为分销商时间','点击数','昵称','分销商等级', '推荐人','导师姓名','一级下线分销商数','二级下线分销商数','三级下线分销商数','累计佣金','打款佣金','是否关注','分组','审核状态');
        fputcsv($fp, $head);


        foreach ($list as $key =>$e) {


            $e["createtime"] = date("Y-m-d H:i", $e["createtime"]);
            $e["agenttime"] = date("Y-m-d H:i", $e["agenttime"]);
            $e["groupname"] = empty($e["groupname"]) ? "无分组" : $e["groupname"];
            $e["levelname"] = empty($e["levelname"]) ? "普通等级" : $e["levelname"];
            $e["parentname"] = empty($e["parentname"]) ? "总店" : "[" . $e["agentid"] . "]" . $e["parentname"];
            $e["statusstr"] = empty($e["status"]) ? '' : "通过";
            $e["followed"] = empty($e["followed"]) ? '' : "已关注";
            $e["menname"] = empty($e["menname"]) ? "" : $e["menname"];

            unset($e['uniacid'],$e['uid'],$e['groupid'],$e['level'],$e['agentid'],$e['unionid'],$e['token'],$e['pwd'],$e['commission'],$e['content']);
            unset($e['status'],$e['isagent'],$e['agentlevel'],$e['noticeset'],$e['credit1'],$e['credit2'],$e['birthyear'],$e['birthmonth'],$e['birthday'],$e['gender'],$e['avatar'],$e['province']);
            unset($e['city'],$e['childtime'],$e['area'],$e['inviter'],$e['agentnotupgrade'],$e['agentselectgoods'],$e['agentblack'],$e['fixagentid'],$e['diymemberid'],$e['diymemberfields'],$e['diymemberdata'],$e['diymemberdataid'],$e['diycommissionid']);
            unset($e['diycommissionfields'],$e['diycommissiondata'],$e['diycommissiondataid'],$e['isblack'],$e['mentor_id'],$e['parentavatar"'],$e['menhead'],$e['parentavatar']);
            fputcsv($fp, $e);

        }

        fclose($fp) or die("can't close php://output");
        exit;



    }
	$pager = pagination($total, $pindex, $psize);
    $others = pdo_fetchall("SELECT id,name FROM " . tablename("mentor") );





} else if ($operation == "detail") {
	ca("commission.agent.view");
	$id = intval($_GPC["id"]);
	$member = $this->model->getInfo($id, array("total", "pay"));
	if (checksubmit("submit")) {
		ca("commission.agent.edit|commission.agent.check|commission.agent.agentblack");
		$data = is_array($_GPC["data"]) ? $_GPC["data"] : array();
		if (empty($_GPC["oldstatus"]) && $data["status"] == 1) {
			$time = time();
			$data["agenttime"] = time();
			$this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $time), TM_COMMISSION_BECOME);
            $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$member["agentid"]."' ");
            if(!empty($tOpenid['openid'])){
                $this->model->sendMessage($tOpenid["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_AGENT_NEWPER);
            }
			plog("commission.agent.check", "审核分销商 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
		}
		if (empty($_GPC["oldagentblack"]) && $data["agentblack"] == 1) {
			$data["agentblack"] = 1;
			$data["status"] = 0;
			$data["isagent"] = 1;
		}
		plog("commission.agent.edit", "修改分销商 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
		pdo_update("ewei_shop_member", $data, array("id" => $id, "uniacid" => $_W["uniacid"]));
		if (empty($_GPC["oldstatus"]) && $data["status"] == 1) {
			if (!empty($member["agentid"])) {
				$this->model->upgradeLevelByAgent($member["agentid"]);
			}
		}
		message("保存成功!", $this->createPluginWebUrl("commission/agent"), "success");
	}
	$diyform_flag = 0;
	$diyform_plugin = p("diyform");
	if ($diyform_plugin) {
		if (!empty($member["diycommissiondata"])) {
			$diyform_flag = 1;
			$fields = iunserializer($member["diycommissionfields"]);
		}
	}
} else if ($operation == "delete") {
	ca("commission.agent.delete");
	$id = intval($_GPC["id"]);
	$member = pdo_fetch("select * from " . tablename("ewei_shop_member") . " where uniacid=:uniacid and id=:id limit 1 ", array(":uniacid" => $_W["uniacid"], ":id" => $id));
	if (empty($member)) {
		message("会员不存在，无法取消分销商资格!", $this->createPluginWebUrl("commission/agent"), "error");
	}
	$agentcount = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_member") . " where  uniacid=:uniacid and agentid=:agentid limit 1 ", array(":uniacid" => $_W["uniacid"], ":agentid" => $id));
	if ($agentcount > 0) {
		message("此会员有下线存在，无法取消分销商资格!", '', "error");
	}
    //删除分销商的时候扣除积分

    $creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$member["uid"]."' ");
    if($creditold['credit1'] <= 200 ){
        $creditnow = 0;
    }else{
        $creditnow = $creditold['credit1'] - 200;
    }
    pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $member["uid"], "uniacid" => $_W["uniacid"]));
    pdo_insert("mc_credits_record", array("uid" => $member["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => "-200", "operator" => 0, "createtime" => time(), "remark" => "删除扣除"));


    $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$member["agentid"]."' ");
    if(!empty($tOpenid['openid'])){
        $credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$tOpenid["uid"]."' ");
        if($credittop['credit1'] <= 200){
            $credit1top = 0;
        }else{
            $credit1top = $credittop['credit1'] - 200 ;
        }

        pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $tOpenid["uid"]));
        pdo_insert("mc_credits_record", array("uid" =>  $tOpenid["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => "-200", "operator" => 0, "createtime" => time(), "remark" => "下线删除扣除"));

    }






	pdo_update("ewei_shop_member", array("isagent" => 0, "status" => 0), array("id" => $_GPC["id"]));
	plog("commission.agent.delete", "取消分销商资格 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
	message("删除成功！", $this->createPluginWebUrl("commission/agent"), "success");
} else if ($operation == "agentblack") {
	ca("commission.agent.agentblack");
	$id = intval($_GPC["id"]);
	$member = pdo_fetch("select * from " . tablename("ewei_shop_member") . " where uniacid=:uniacid and id=:id limit 1 ", array(":uniacid" => $_W["uniacid"], ":id" => $id));
	if (empty($member)) {
		message("会员不存在，无法设置黑名单!", $this->createPluginWebUrl("commission/agent"), "error");
	}
	$black = intval($_GPC["black"]);
	if (!empty($black)) {
		pdo_update("ewei_shop_member", array("isagent" => 1, "status" => 0, "agentblack" => 1), array("id" => $_GPC["id"]));
		plog("commission.agent.agentblack", "设置黑名单 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
		message("设置黑名单成功！", $this->createPluginWebUrl("commission/agent"), "success");
	} else {
		pdo_update("ewei_shop_member", array("isagent" => 1, "status" => 1, "agentblack" => 0), array("id" => $_GPC["id"]));
		plog("commission.agent.agentblack", "取消黑名单 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
		message("取消黑名单成功！", $this->createPluginWebUrl("commission/agent"), "success");
	}
} else if ($operation == "user") {
	ca("commission.agent.user");
	$level = intval($_GPC["level"]);
	$agentid = intval($_GPC["id"]);
	$member = $this->model->getInfo($agentid);
	$total = $member["agentcount"];
	$level1 = $member["level1"];
	$level2 = $member["level2"];
	$level3 = $member["level3"];
	$level11 = pdo_fetchcolumn("select count(*) from " . tablename("ewei_shop_member") . " where isagent=0 and agentid=:agentid and uniacid=:uniacid limit 1", array(":agentid" => $agentid, ":uniacid" => $_W["uniacid"]));
	$condition = '';
	$params = array();
	if (empty($level)) {
		$condition = " and ( dm.agentid={$member["id"]}";
		if ($level1 > 0) {
			$condition .= " or  dm.agentid in( " . implode(",", array_keys($member["level1_agentids"])) . ")";
		}
		if ($level2 > 0) {
			$condition .= " or  dm.agentid in( " . implode(",", array_keys($member["level2_agentids"])) . ")";
		}
		$condition .= " )";
		$hasagent = true;
	} else if ($level == 1) {
		if ($level1 > 0) {
			$condition = " and dm.agentid={$member["id"]}";
			$hasagent = true;
		}
	} else if ($level == 2) {
		if ($level2 > 0) {
			$condition = " and dm.agentid in( " . implode(",", array_keys($member["level1_agentids"])) . ")";
			$hasagent = true;
		}
	} else if ($level == 3) {
		if ($level3 > 0) {
			$condition = " and dm.agentid in( " . implode(",", array_keys($member["level2_agentids"])) . ")";
			$hasagent = true;
		}
	}
	if (!empty($_GPC["mid"])) {
		$condition .= " and dm.id=:mid";
		$params[":mid"] = intval($_GPC["mid"]);
	}
	if (!empty($_GPC["realname"])) {
		$_GPC["realname"] = trim($_GPC["realname"]);
		$condition .= " and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname)";
		$params[":realname"] = "%{$_GPC["realname"]}%";
	}
	if ($_GPC["isagent"] != '') {
		$condition .= " and dm.isagent=" . intval($_GPC["isagent"]);
	}
	if ($_GPC["status"] != '') {
		$condition .= " and dm.status=" . intval($_GPC["status"]);
	}
	if (empty($starttime) || empty($endtime)) {
		$starttime = strtotime("-1 month");
		$endtime = time();
	}
	if (!empty($_GPC["agentlevel"])) {
		$condition .= " and dm.agentlevel=" . intval($_GPC["agentlevel"]);
	}
	if ($_GPC["parentid"] == '0') {
		$condition .= " and dm.agentid=0";
	} else if (!empty($_GPC["parentname"])) {
		$_GPC["parentname"] = trim($_GPC["parentname"]);
		$condition .= " and ( p.mobile like :parentname or p.nickname like :parentname or p.realname like :parentname)";
		$params[":parentname"] = "%{$_GPC["parentname"]}%";
	}
	if ($_GPC["followed"] != '') {
		if ($_GPC["followed"] == 2) {
			$condition .= " and f.follow=0 and dm.uid<>0";
		} else {
			$condition .= " and f.follow=" . intval($_GPC["followed"]);
		}
	}
	if ($_GPC["agentblack"] != '') {
		$condition .= " and dm.agentblack=" . intval($_GPC["agentblack"]);
	}
	$pindex = max(1, intval($_GPC["page"]));
	$psize = 20;
	$list = array();
	if ($hasagent) {
		$total = pdo_fetchcolumn("select count(dm.id) from" . tablename("ewei_shop_member") . " dm " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid" . " where dm.uniacid =" . $_W["uniacid"] . "  {$condition}", $params);
		$list = pdo_fetchall("select dm.*,p.nickname as parentname,p.avatar as parentavatar  from " . tablename("ewei_shop_member") . " dm " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid  and f.uniacid={$_W["uniacid"]}" . " where dm.uniacid = " . $_W["uniacid"] . "  {$condition}   ORDER BY dm.agenttime desc limit " . ($pindex - 1) * $psize . "," . $psize, $params);
		$pager = pagination($total, $pindex, $psize);
		foreach ($list as &$row) {
			$info = $this->model->getInfo($row["openid"], array("total", "pay"));
			$row["levelcount"] = $info["agentcount"];
			if ($this->set["level"] >= 1) {
				$row["level1"] = $info["level1"];
			}
			if ($this->set["level"] >= 2) {
				$row["level2"] = $info["level2"];
			}
			if ($this->set["level"] >= 3) {
				$row["level3"] = $info["level3"];
			}
			$row["credit1"] = m("member")->getCredit($row["openid"], "credit1");
			$row["credit2"] = m("member")->getCredit($row["openid"], "credit2");
			$row["commission_total"] = $info["commission_total"];
			$row["commission_pay"] = $info["commission_pay"];
			$row["followed"] = m("user")->followed($row["openid"]);
			if ($row["agentid"] == $member["id"]) {
				$row["level"] = 1;
			} else if (in_array($row["agentid"], array_keys($member["level1_agentids"]))) {
				$row["level"] = 2;
			} else if (in_array($row["agentid"], array_keys($member["level2_agentids"]))) {
				$row["level"] = 3;
			}
		}
	}
	unset($row);
	load()->func("tpl");
	include $this->template("agent_user");
	exit;
}else if($operation == "mentor"){
    ca("commission.agent.mentor");
    $mentor = pdo_fetchall("SELECT id,name FROM " . tablename("mentor"));
    var_dump($_GPC);




} else if ($operation == "query") {
	$kwd = trim($_GPC["keyword"]);
	$wechatid = intval($_GPC["wechatid"]);
	if (empty($wechatid)) {
		$wechatid = $_W["uniacid"];
	}
	$params = array();
	$params[":uniacid"] = $wechatid;
	$condition = " and uniacid=:uniacid and isagent=1 and status=1";
	if (!empty($kwd)) {
		$condition .= " AND ( `nickname` LIKE :keyword or `realname` LIKE :keyword or `mobile` LIKE :keyword )";
		$params[":keyword"] = "%{$kwd}%";
	}
	if (!empty($_GPC["selfid"])) {
		$condition .= " and id<>" . intval($_GPC["selfid"]);
	}
	$ds = pdo_fetchall("SELECT id,avatar,nickname,openid,realname,mobile FROM " . tablename("ewei_shop_member") . " WHERE 1 {$condition} order by createtime desc", $params);
	include $this->template("query");
	exit;
} else if ($operation == "check") {
	ca("commission.agent.check");
	$id = intval($_GPC["id"]);
	$member = $this->model->getInfo($id, array("total", "pay"));
	if (empty($member)) {
		message("未找到会员信息，无法进行审核", '', "error");
	}
	if ($member["isagent"] == 1 && $member["status"] == 1) {
		message("此分销商已经审核通过，无需重复审核!", '', "error");
	}
	$time = time();
	pdo_update("ewei_shop_member", array("status" => 1, "agenttime" => $time), array("id" => $member["id"], "uniacid" => $_W["uniacid"]));
    //审核通过的时候给分销商加两百积分
//    $creditold = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$member["uid"]."' ");
//    $creditnow = $creditold['credit1'] + 200;
//	pdo_update("mc_members", array("credit1" => $creditnow), array("uid" => $member["uid"], "uniacid" => $_W["uniacid"]));
//    pdo_insert("mc_credits_record", array("uid" => $member["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "成为店主奖励"));

	$this->model->sendMessage($member["openid"], array("nickname" => $member["nickname"], "agenttime" => $time), TM_COMMISSION_BECOME);
    $tOpenid = pdo_fetch("SELECT * FROM " . tablename("ewei_shop_member") . "WHERE id = '".$member["agentid"]."' ");
    //var_dump($tOpenid);exit;
    if(!empty($tOpenid['openid'])){
//        $credittop = pdo_fetch("SELECT credit1 FROM " . tablename("mc_members") . "WHERE uid = '".$tOpenid["uid"]."' ");
//        $credit1top = $credittop['credit1'] + 200 ;
//        pdo_update("mc_members", array("credit1" => $credit1top), array("uid" => $tOpenid["uid"]));
//        pdo_insert("mc_credits_record", array("uid" =>  $tOpenid["uid"], "uniacid" => $_W["uniacid"], "credittype" => "credit1", "num" => 200, "operator" => 0, "createtime" => time(), "remark" => "发展下线奖励"));
        $this->model->sendMessage($tOpenid["openid"], array("nickname" => $member["nickname"], "agenttime" => $data["agenttime"]), TM_COMMISSION_AGENT_NEWPER);
    }
	if (!empty($member["agentid"])) {
		$this->model->upgradeLevelByAgent($member["agentid"]);
	}
	plog("commission.agent.check", "审核分销商 <br/>分销商信息:  ID: {$member["id"]} /  {$member["openid"]}/{$member["nickname"]}/{$member["realname"]}/{$member["mobile"]}");
	message("审核分销商成功!", $this->createPluginWebUrl("commission/agent"), "success");
}
load()->func("tpl");
include $this->template("agent");