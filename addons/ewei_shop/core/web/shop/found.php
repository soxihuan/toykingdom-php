<?php

global $_W, $_GPC;
$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";

if ($operation == "display"){
    ca("commission.found.view");
    if(!empty($_GPC["keyword"])){
        $keyword = trim($_GPC['keyword']);
        $condition =  "Where title like '%{$keyword}%'  or goods_id like '%{$keyword}%'";

    }

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 20;
    $totalnum = pdo_fetchcolumn("select count(id) from" . tablename("found") );
    $others = pdo_fetchall("SELECT * FROM " . tablename("found")." {$condition} order by id desc limit ". ($pindex - 1) * $psize . "," . $psize);
    $pager = pagination($totalnum, $pindex, $psize);

}elseif ($operation == "post"){




    $id = trim($_GPC["id"]);
    if (empty($id)) {
        ca("shop.found.add");
    } else {
        ca("shop.found.view|shop.found.edit");
    }
    if(!empty($id)){
        $mentor = pdo_fetch("SELECT f.id, f.title as ftitle, f.wenan, f.wa_thumb, f.goods_id,g.title as gtitle FROM " . tablename("found") . " f " . " left join".tablename("ewei_shop_goods")."g on f.goods_id = g.id WHERE f.id = :id", array(":id" => $id));
        $wa_piclist1 = unserialize($mentor["wa_thumb"]);
        $wa_piclist = array();
        if (is_array($wa_piclist1)) {
            foreach ($wa_piclist1 as $p) {
                $wa_piclist[] = is_array($p) ? $p["attachment"] : $p;
            }
        }
    }
    //从朋友圈文案分享过来
    if(!empty($_GPC['goods_id'])){
        $goods_id = trim($_GPC["goods_id"]);
        $mentor = pdo_fetch("SELECT wenan,wa_thumb,wenan2,wa_thumb2,wenan3,wa_thumb3 FROM " . tablename("ewei_shop_goods") . " WHERE id = :id", array(":id" => $goods_id));
        if($_GPC['wenannum'] == 1){
            $wa_piclist1 = unserialize($mentor["wa_thumb"]);
        }elseif($_GPC['wenannum'] == 2){
            $wa_piclist1 = unserialize($mentor["wa_thumb2"]);
        }else{
            $wa_piclist1 = unserialize($mentor["wa_thumb3"]);
        }
        $wa_piclist = array();
        if (is_array($wa_piclist1)) {
            foreach ($wa_piclist1 as $p) {
                $wa_piclist[] = is_array($p) ? $p["attachment"] : $p;
            }
        }

    }

    if (empty($_GPC["wa_thumbs"])) {
        $_GPC["wa_thumbs"] = array();
    }
    $data = array(  "title" => trim($_GPC["title"]),"wenan" => trim($_GPC["wenan"]),"createtime" => time());
    if(!empty($_GPC['goods_id'])){
        $data['goods_id'] = intval($_GPC["goods_id"]);
    }


    if (is_array($_GPC["wa_thumbs"])) {
        $wa_thumbs = $_GPC["wa_thumbs"];
        $wa_thumb = array();
        foreach ($wa_thumbs as $th) {
            $wa_thumb[] = save_media($th);
        }
        $data["wa_thumb"] = serialize($wa_thumb);
    }

    if (checksubmit("submit")) {
        if (empty($id)) {
            pdo_insert("found", $data);
            $id = pdo_insertid();
            plog("shop.found.add", "添加发现 ID: {$id}");
        } else {

            pdo_update("found", $data, array("id" => $id));
            plog("shop.found.edit", "编辑发现 ID: {$id}");
        }
        message("更新发现成功！", $this->createWebUrl("shop/found", array("op" => "display")), "success");
    }

}elseif ($operation == "delete"){
    ca("shop.found.delete");
    $id = intval($_GPC["id"]);
    $founddel = pdo_fetch("SELECT id,title FROM " . tablename("found") . " WHERE id = '$id'");
    if (empty($founddel)) {
        message("抱歉，发现不存在或是已经被删除！", $this->createWebUrl("shop/found", array("op" => "display")), "error");
    }
    pdo_delete("found", array("id" => $id));
    plog("shop.found.delete", "删除发现 ID: {$id}");
    message("发现删除成功！", $this->createWebUrl("shop/found", array("op" => "display")), "success");


}
load()->func("tpl");
include $this->template('web/shop/found');