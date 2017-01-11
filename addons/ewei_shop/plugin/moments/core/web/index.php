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

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 20;
    $condition = " WHERE `uniacid` = :uniacid AND `deleted` = :deleted";
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
    if ($_GPC["status"] != '') {
        $condition .= " AND `status` = :status";
        $params[":status"] = intval($_GPC["status"]);
    }
    $sql = "SELECT COUNT(*) FROM " . tablename("ewei_shop_goods") . $condition;
    $total = pdo_fetchcolumn($sql, $params);
    if (!empty($total)) {
        $sql = "SELECT * FROM " . tablename("ewei_shop_goods") . $condition . " ORDER BY `status` DESC, `displayorder` DESC,\r\n\t\t\t\t\t\t`id` DESC LIMIT " . ($pindex - 1) * $psize . "," . $psize;
        $list = pdo_fetchall($sql, $params);
        $pager = pagination($total, $pindex, $psize);
    }
}else if ($operation == "post") {
    $id = intval($_GPC["id"]);
    if (!empty($id)) {
        ca("moments.edit|moments.view");
    } else {
        ca("moments.add");
    }
    $item = pdo_fetch("SELECT id,title,moments_copy,moments_copy2,moments_copy3,moments_img,moments_img2,moments_img3  FROM " . tablename("ewei_shop_goods") . " WHERE id = :id", array(":id" => $id));
    if (!empty($id)) {


        if (empty($item)) {
            message("抱歉，商品不存在或是已经删除！", '', "error");
        }
        $wa_piclist1 = unserialize($item["moments_img"]);
        $wa_piclist = array();
        if (is_array($wa_piclist1)) {
            foreach ($wa_piclist1 as $p) {
                $wa_piclist[] = is_array($p) ? $p["attachment"] : $p;
            }
        }

        $wa_piclists2 = unserialize($item["moments_img2"]);
        $wa_piclist2 = array();
        if (is_array($wa_piclists2)) {
            foreach ($wa_piclists2 as $p) {
                $wa_piclist2[] = is_array($p) ? $p["attachment"] : $p;
            }
        }

        $wa_piclists3 = unserialize($item["moments_img3"]);
        $wa_piclist3 = array();
        if (is_array($wa_piclists3)) {
            foreach ($wa_piclists3 as $p) {
                $wa_piclist3[] = is_array($p) ? $p["attachment"] : $p;
            }
        }

    }

    if (checksubmit("submit")) {
        if (empty($_GPC["moments_imgs"])) {
            $_GPC["moments_imgs"] = array();
        }
        if (empty($_GPC["moments_imgs2"])) {
            $_GPC["moments_imgs2"] = array();
        }
        if (empty($_GPC["moments_imgs3"])) {
            $_GPC["moments_imgs3"] = array();
        }
        if(empty($_GPC["moments_copy"])){
            $_GPC["moments_copy"]=$item["title"];
        }
        $data = array("uniacid" => intval($_W["uniacid"]), "moments_copy" => trim($_GPC["moments_copy"]),"moments_copy2" => trim($_GPC["moments_copy2"]),"moments_copy3" => trim($_GPC["moments_copy3"]), "createtime" => TIMESTAMP);

        if (is_array($_GPC["moments_imgs"])) {
            $moments_imgs = $_GPC["moments_imgs"];
            $moments_img = array();
            foreach ($moments_imgs as $th) {
                $moments_img[] = save_media($th);
            }
            $data["moments_img"] = serialize($moments_img);
        }

        if (is_array($_GPC["moments_imgs2"])) {
            $moments_imgs2 = $_GPC["moments_imgs2"];
            $moments_img2 = array();
            foreach ($moments_imgs2 as $th) {
                $moments_img2[] = save_media($th);
            }
            $data["moments_img2"] = serialize($moments_img2);
        }

        if (is_array($_GPC["moments_imgs3"])) {
            $moments_imgs3 = $_GPC["moments_imgs3"];
            $moments_img3 = array();
            foreach ($moments_imgs3 as $th) {
                $moments_img3[] = save_media($th);
            }
            $data["moments_img3"] = serialize($moments_img3);
        }

        if (empty($id)) {
            pdo_insert("ewei_shop_goods", $data);
            $id = pdo_insertid();
            plog("moments.add", "添加商品 ID: {$id}");
        } else {
            unset($data["createtime"]);
            pdo_update("ewei_shop_goods", $data, array("id" => $id));
            plog("moments.edit", "编辑商品 ID: {$id}");
        }

        message("商品更新成功！", $this->createPluginWebUrl("moments", array("op" => "post", "id" => $id)), "success");
    }
}
load()->func("tpl");
include $this->template('index');