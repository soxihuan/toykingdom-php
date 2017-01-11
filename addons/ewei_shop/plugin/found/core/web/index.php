<?php
if (!defined("IN_IA")) {
    exit("Access Denied");
}
global $_W, $_GPC;
$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
$uniacid = $_W['uniacid'];
if ($operation == "display"){

    ca("shop.found.view");
    if(!empty($_GPC["keyword"])){
        $keyword = trim($_GPC['keyword']);

        $condition =  "and title like '%{$keyword}%'  or goods_id like '%{$keyword}%'";

    }

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 20;
    $totalnum = pdo_fetchcolumn("select count(id) from" . tablename("found") );
    $others = pdo_fetchall("SELECT * FROM " . tablename("found")."WHERE   uniacid =  '{$uniacid}' {$condition} order by id desc limit ". ($pindex - 1) * $psize . "," . $psize);
    $pager = pagination($totalnum, $pindex, $psize);

}elseif ($operation == "post"){



    $id = trim($_GPC["id"]);
    if (empty($id)) {
        ca("shop.found.add");
    } else {
        ca("shop.found.view|shop.found.edit");
    }
    if(!empty($id)){
        $mentor = pdo_fetch("SELECT f.id, f.title as ftitle, f.moments_copy, f.moments_img, f.goods_id,f.type as ftype,g.title as gtitle FROM " . tablename("found") . " f " . " left join".tablename("ewei_shop_goods")."g on f.goods_id = g.id WHERE f.uniacid =  '{$uniacid}'and f.id = :id", array(":id" => $id));
        $wa_piclist1 = unserialize($mentor["moments_img"]);
        $wa_piclist = array();
        if (is_array($wa_piclist1)) {
            foreach ($wa_piclist1 as $p) {
                $wa_piclist[] = is_array($p) ? $p["attachment"] : $p;
            }
        }
    }


    if (empty($_GPC["moments_imgs"])) {
        $_GPC["moments_imgs"] = array();
    }
    $data = array(  "title" => trim($_GPC["title"]),"moments_copy" => trim($_GPC["moments_copy"]),"createtime" => time());
    if(!empty($_GPC['goods_id'])){
        $data['goods_id'] = intval($_GPC["goods_id"]);
    }
    if(!empty($_GPC['type'])){
        $data['type'] = intval($_GPC["type"]);
    }


    if (is_array($_GPC["moments_imgs"])) {
        $wa_thumbs = $_GPC["moments_imgs"];
        $wa_thumb = array();
        foreach ($wa_thumbs as $th) {
            $wa_thumb[] = save_media($th);
        }
        $data["moments_img"] = serialize($wa_thumb);
    }
    $data['uniacid'] = $uniacid;
    if (checksubmit("submit")) {
        if (empty($id)) {



            pdo_insert("found", $data);
            $id = pdo_insertid();
            plog("shop.found.add", "添加发现 ID: {$id}");
        } else {

            pdo_update("found", $data, array("id" => $id));
            plog("shop.found.edit", "编辑发现 ID: {$id}");
        }
        message("更新发现成功！", $this->createPluginWebUrl("found", array("op" => "display")), "success");
    }

}elseif ($operation == "delete"){
    ca("shop.found.delete");
    $id = intval($_GPC["id"]);
    $founddel = pdo_fetch("SELECT id,title FROM " . tablename("found") . " WHERE id = '$id' and uniacid =  '{$uniacid}'");
    if (empty($founddel)) {
        message("抱歉，发现不存在或是已经被删除！", $this->createPluginWebUrl("found", array("op" => "display")), "error");
    }
    pdo_delete("found", array("id" => $id));
    plog("shop.found.delete", "删除发现 ID: {$id}");
    message("发现删除成功！", $this->createPluginWebUrl("found", array("op" => "display")), "success");


}
load()->func("tpl");
include $this->template('index');