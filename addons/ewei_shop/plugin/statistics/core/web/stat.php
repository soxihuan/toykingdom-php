<?php
global $_W, $_GPC;
$agentlevels = $this->model->getLevels();
$mentor_search=$_GPC['mentor_search'];
$operation = empty($_GPC["op"]) ? "display" : $_GPC["op"];
ca("statistics.stat.view");

$level = $this->set["level"];
$pindex = max(1, intval($_GPC["page"]));
$psize = 50;
$params = array();
$condition = '';

if (empty($bstarttime) || empty($bendtime)) {
    $bstarttime = strtotime("-1 month");
    $bendtime = time();
}
if (!empty($_GPC["btime"])) {
    $bstarttime = strtotime($_GPC["btime"]["start"]);
    $bendtime = strtotime($_GPC["btime"]["end"]);
    if ($_GPC["bsearchtime"] == "1") {
        $condition = " AND dm.agenttime >= {$bstarttime} AND dm.agenttime <= {$bendtime} ";

    }
}
if (empty($ostarttime) || empty($oendtime)) {
    $ostarttime = strtotime("-1 month");
    $oendtime = time();
}
if (!empty($_GPC["otime"])) {
    $ostarttime = strtotime($_GPC["otime"]["start"]);
    $oendtime = strtotime($_GPC["otime"]["end"]);
    if ($_GPC["osearchtime"] == "1") {
        $condition3 = " AND paytime >= {$ostarttime} AND paytime <= {$oendtime} ";

    }
}

if (!empty($_GPC["realname"])) {
    $_GPC["realname"] = trim($_GPC["realname"]);
    $condition .= " and ( dm.realname like :realname or dm.nickname like :realname or dm.mobile like :realname)";
    $params[":realname"] = "%{$_GPC["realname"]}%";
}
if(!empty($_GPC["mentor_search"])){
    if($_GPC["mentor_search"] != 'weifenpei'){
        $condition .= " and dm.mentor_id=" . intval($_GPC["mentor_search"]);
    }elseif($_GPC["mentor_search"] == 'weifenpei'){
        $condition .= " and dm.mentor_id is null or dm.mentor_id = 0" ;
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
        $condition2 = " AND agenttime >= {$starttime} AND agenttime <= {$endtime} ";

    }
}


$sql = 'select dm.*,dm.nickname,dm.avatar,l.levelname,p.nickname as parentname,p.avatar as parentavatar,men.name as menname,men.head_url as menhead from ' . tablename("ewei_shop_member") . " dm " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("ewei_shop_commission_level") . " l on l.id = dm.agentlevel" . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid and f.uniacid={$_W["uniacid"]}" . " left join ". tablename("mentor") . "men on men.id=dm.mentor_id " . " where dm.uniacid = " . $_W["uniacid"] . " and dm.isagent =1 and dm.status=1 {$condition} ORDER BY dm.agenttime desc";

if (empty($_GPC["export"])) {
    $sql .= " limit " . ($pindex - 1) * $psize . "," . $psize;
}
$list = pdo_fetchall($sql, $params);

$total = pdo_fetchcolumn("select count(dm.id) from" . tablename("ewei_shop_member") . " dm  " . " left join " . tablename("ewei_shop_member") . " p on p.id = dm.agentid " . " left join " . tablename("mc_mapping_fans") . "f on f.openid=dm.openid" . " where dm.uniacid =" . $_W["uniacid"] . " and dm.isagent =1 {$condition}", $params);
foreach ($list as &$row) {

    $price_agentids = pdo_fetchall("select count(id) as id ,sum(price) as price from " . tablename('ewei_shop_order') . " where agentid=:agentid  and uniacid=:uniacid {$condition3} ", array(
        ':uniacid' => $_W['uniacid'],
        ':agentid' => $row['id']
    ));

    $row["ordercount"] = $price_agentids[0]['id'];
    if(empty($price_agentids[0]['price'])){
        $row["ordersales"] = "0.00";
    }else{
        $row["ordersales"] = $price_agentids[0]['price'];
    }


    $level = intval(2);
    if ($level >= 1) {
        $level1_agentids = pdo_fetchall("select id from " . tablename('ewei_shop_member') . " where agentid=:agentid and isagent=1 and status=1 and uniacid=:uniacid {$condition2} ", array(
            ':uniacid' => $_W['uniacid'],
            ':agentid' => $row['id']
        ), 'id');
        $level1          = count($level1_agentids);
    }
    if ($level >= 2) {
        if ($level1 > 0) {
            $level2_agentids = pdo_fetchall("select id from " . tablename('ewei_shop_member') . " where agentid in(" . implode(",", array_keys($level1_agentids)) . ") and isagent=1 and status=1 and uniacid=:uniacid {$condition2}", array(
                ':uniacid' => $_W['uniacid']
            ), 'id');
            $level2          = count($level2_agentids);
        }else{
            $level2 = intval(0);
        }
    }
    if ($level >= 1) {
        $row["level1"] = $level1;
    }
    if ($level >= 2) {
        $row["level2"] = $level2;
    }

}


unset($row);
//echo "<pre>";
//var_dump($list);
if ($_GPC["export"] == "1") {

    $filename = "分销商下级和营业额统计-" . date("Y-m-d H:i", time());
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=\"" . $filename . ".csv\"");
    header('Cache-Control: max-age=0');
    $fp = fopen('php://output', 'a');
    $head = array('ID','openid', '姓名', '手机号','昵称','注册时间','成为分销商时间','微信号', '推荐人','导师姓名','订单数','销售额','一级下线分销商数','二级下线分销商数');
    fputcsv($fp, $head);
    $cnt = 0;
    $limit = 100000;

    foreach ($list as $key =>$e) {


        $e["createtime"] = date("Y-m-d H:i", $e["createtime"]);
        $e["agenttime"] = date("Y-m-d H:i", $e["agenttime"]);
        $e["parentname"] = empty($e["parentname"]) ? "总店" : "[" . $e["agentid"] . "]" . $e["parentname"];
        unset($e['uniacid'],$e['uid'],$e['groupid'],$e['level'],$e['agentid'],$e['unionid'],$e['token'],$e['pwd'],$e['commission'],$e['commission_pay'],$e['commission_pay'],$e['content']);
        unset($e['status'],$e['isagent'],$e['clickcount'],$e['agentlevel'],$e['noticeset'],$e['credit1'],$e['credit2'],$e['birthyear'],$e['birthmonth'],$e['birthday'],$e['gender'],$e['avatar'],$e['province']);
        unset($e['city'],$e['childtime'],$e['area'],$e['inviter'],$e['agentnotupgrade'],$e['agentselectgoods'],$e['agentblack'],$e['fixagentid'],$e['diymemberid'],$e['diymemberfields'],$e['diymemberdata'],$e['diymemberdataid'],$e['diycommissionid']);
        unset($e['diycommissionfields'],$e['diycommissiondata'],$e['diycommissiondataid'],$e['isblack'],$e['mentor_id'],$e['levelname'],$e['parentavatar"'],$e['menhead'],$e['parentavatar']);
        fputcsv($fp, $e);

    }

    fclose($fp) or die("can't close php://output");
    exit;








//    ca("statistics.index.export");
//    plog("statistics.index.export", "导出分销商数据");
//    foreach ($list as &$row) {
//        $row["createtime"] = date("Y-m-d H:i", $row["createtime"]);
//        $row["agentime"] = empty($row["agenttime"]) ? '' : date("Y-m-d H:i", $row["agentime"]);
//        $row["parentname"] = empty($row["parentname"]) ? "总店" : "[" . $row["agentid"] . "]" . $row["parentname"];
//        $row["menname"] = empty($row["menname"]) ? "萍萍" : $row["menname"];
//    }
//
//    unset($row);
//    m("excel")->export($list, array("title" => "分销商下级和营业额统计-" . date("Y-m-d-H-i", time()), "columns" => array(array("title" => "ID", "field" => "id", "width" => 12), array("title" => "昵称", "field" => "nickname", "width" => 12), array("title" => "姓名", "field" => "realname", "width" => 12), array("title" => "手机号", "field" => "mobile", "width" => 12), array("title" => "openid", "field" => "openid", "width" => 24), array("title" => "微信号", "field" => "weixin", "width" => 12), array("title" => "推荐人", "field" => "parentname", "width" => 12), array("title" => "一级下线分销商数", "field" => "level1", "width" => 12), array("title" => "二级下线分销商数", "field" => "level2", "width" => 12), array("title" => "注册时间", "field" => "createtime", "width" => 12), array("title" => "销售额", "field" => "ordersales", "width" => 12), array("title" => "订单数", "field" => "ordercount", "width" => 12), array("title" => "成为分销商时间", "field" => "agenttime", "width" => 12),array("title" => "导师姓名", "field" => "menname", "width" => 12))));
}
$pager = pagination($total, $pindex, $psize);
$others = pdo_fetchall("SELECT id,name FROM " . tablename("mentor") );






load()->func("tpl");
include $this->template('stat');