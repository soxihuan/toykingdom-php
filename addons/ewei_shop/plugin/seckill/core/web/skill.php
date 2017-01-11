<?php
if (!defined("IN_IA")) {
    exit("Access Denied");
}
global $_W, $_GPC;
$shopset = m("common")->getSysset("shop");
$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
if ($operation == "display") {
    ca("seckill.view");
    if (!empty($_GPC["sequence"])) {
        ca("seckill.edit");
        foreach ($_GPC["sequence"] as $id => $sequence) {
            pdo_update("ewei_shop_seckill", array("sequence" => $sequence), array("id" => $id));
        }
        plog("seckill.edit", "批量修改秒杀排序");
        message("秒杀排序更新成功！", $this->createPluginWebUrl("seckill/skill", array("op" => "display")), "success");
    }


    $timenow = time();
    $condition = " on g.id = s.goodsid WHERE g.`uniacid` = :uniacid AND g.`deleted` = :deleted and g.istime =1 and g.status = 1 and s.iskill = 1 and g.timestart < '{$timenow}' and g.timeend > '{$timenow}' ";
    $params = array(":uniacid" => $_W["uniacid"], ":deleted" => '0');
    $sql = "SELECT g.id gid, g.title, g.pcate, g.ccate, g.tcate, g.thumb, g.timestart, g.timeend, g.total, s.iskill, s.id sid, s.sequence FROM " . tablename("ewei_shop_goods") ." g left join ".tablename("ewei_shop_seckill")." s " . $condition . " ORDER BY  g.timestart DESC, g.`displayorder` DESC,\r\n\t\t\t\t\t\t g.`id` DESC  " ;
    $list = pdo_fetchall($sql, $params);

//即将秒杀商品
    $condition2 = " on g.id = s.goodsid WHERE g.`uniacid` = :uniacid AND g.`deleted` = :deleted and g.status = 1 and g.istime =1 and s.iskill = 1 and g.timestart > '{$timenow}' ";
    $params2 = array(":uniacid" => $_W["uniacid"], ":deleted" => '0');
    $sql2 = "SELECT g.id gid, g.title, g.pcate, g.ccate, g.tcate, g.thumb, g.timestart, g.timeend, g.total, s.iskill, s.id sid, s.sequence FROM " . tablename("ewei_shop_goods") ." g left join ".tablename("ewei_shop_seckill")." s " . $condition2 . " ORDER BY g.timestart asc, g.`displayorder` DESC,\r\n\t\t\t\t\t\t g.`id` DESC  " ;
    $list2 = pdo_fetchall($sql2, $params2);


}elseif ($operation == "delete"){
    ca("seckill.delete");
    $id = intval($_GPC["id"]);
    $killdel = pdo_fetch("SELECT id FROM " . tablename("ewei_shop_seckill") . " WHERE id = '$id'");
    if (empty($killdel)) {
        message("抱歉，秒杀商品不存在或是已经被删除！", $this->createPluginWebUrl("seckill/skill", array("op" => "display")), "error");
    }
    pdo_update("ewei_shop_seckill", array("iskill" => 0), array("id" => $id));
    plog("skill.delete", "移除秒杀 ID: {$id}");
    message("移除秒杀成功！", $this->createPluginWebUrl("seckill/skill", array("op" => "display")), "success");


}
load()->func("tpl");
include $this->template('skill');