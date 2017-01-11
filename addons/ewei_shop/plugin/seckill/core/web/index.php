<?php
if (!defined("IN_IA")) {
    exit("Access Denied");
}
global $_W, $_GPC;
$shopset = m("common")->getSysset("shop");
$sql = "SELECT * FROM " . tablename("ewei_shop_category") . " WHERE `uniacid` = :uniacid ORDER BY `parentid`, `displayorder` DESC";
$category = pdo_fetchall($sql, array(":uniacid" => $_W["uniacid"]), "id");
$parent = $children = array();
if (!empty($category)) {
    foreach ($category as $cid => $cate) {
        if (!empty($cate["parentid"])) {
            $children[$cate["parentid"]][] = $cate;
        } else {
            $parent[$cate["id"]] = $cate;
        }
    }
}
$pv = p("virtual");
$diyform_plugin = p("diyform");

$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
if ($operation == "display") {
    ca("shop.goods.view");
    $timenow = time();
    $pindex = max(1, intval($_GPC["page"]));
    $psize = 20;
    $condition = " on g.id = s.goodsid WHERE g.`uniacid` = :uniacid AND g.`deleted` = :deleted and g.istime =1 and g.total >0  and g.status = 1 AND g.timeend > '{$timenow}'";
    $params = array(":uniacid" => $_W["uniacid"], ":deleted" => '0');
    if (!empty($_GPC["keyword"])) {
        $_GPC["keyword"] = trim($_GPC["keyword"]);
        $condition .= " AND `title` LIKE :title";
        $params[":title"] = "%" . trim($_GPC["keyword"]) . "%";
    }
    if (!empty($_GPC["category"]["thirdid"])) {
        $condition .= " AND `tcate` = :tcate";
        $params[":tcate"] = intval($_GPC["category"]["thirdid"]);
    }
    if (!empty($_GPC["category"]["childid"])) {
        $condition .= " AND `ccate` = :ccate";
        $params[":ccate"] = intval($_GPC["category"]["childid"]);
    }
    if (!empty($_GPC["category"]["parentid"])) {
        $condition .= " AND `pcate` = :pcate";
        $params[":pcate"] = intval($_GPC["category"]["parentid"]);
    }

    $sql = "SELECT COUNT(*) FROM " . tablename("ewei_shop_goods")." g left join ".tablename("ewei_shop_seckill")." s "  . $condition;
    $total = pdo_fetchcolumn($sql, $params);
    if (!empty($total)) {
        $sql = "SELECT g.id gid,g.title,g.pcate,g.ccate,g.tcate,g.thumb,g.timestart,g.timeend,g.total,s.iskill,s.id sid FROM " . tablename("ewei_shop_goods") ." g left join ".tablename("ewei_shop_seckill")." s " . $condition . " ORDER BY  g.`displayorder` DESC,\r\n\t\t\t\t\t\t g.`id` DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize;
        $lists = pdo_fetchall($sql, $params);

        foreach($lists as $key=>$val){
            $kill = pdo_fetch("SELECT id  FROM " . tablename("ewei_shop_seckill") . " WHERE goodsid = :id", array(":id" => $val['gid']));
            if(empty($kill)){
                pdo_insert('ewei_shop_seckill', array("goodsid" => $val['gid']));
            }

        }

        $list = pdo_fetchall($sql, $params);

        $pager = pagination($total, $pindex, $psize);
    }


}else if ($operation == "setgoodsproperty") {
    ca("seckill.edit");
    $id = intval($_GPC["id"]);
    $type = $_GPC["type"];
    $data = intval($_GPC["data"]);
   // var_dump($id.','.$type.','.$data);
    if (in_array($type, array("kill"))) {
        $data = ($data == 1 ? '0' : "1");
        pdo_update("ewei_shop_seckill", array("is" . $type => $data), array("id" => $id));
        if ($type == "kill") {
            $typestr = "秒杀商品";
        }
        plog("shop.goods.edit", "修改商品{$typestr}状态   ID: {$id}");
        die(json_encode(array("result" => 1, "data" => $data)));
    }

    die(json_encode(array("result" => 0)));

}
load()->func("tpl");
include $this->template('index');