<?php
//decode by
global $_W, $_GPC;
$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
if ($operation == "display"){
    ca("commission.mentor.view");
    $others = pdo_fetchall("SELECT * FROM " . tablename("mentor") );

}elseif ($operation == "post"){
    $id = trim($_GPC["id"]);
    if (empty($id)) {
        ca("commission.mentor.add");
    } else {
        ca("commission.mentor.view|commission.mentor.edit");
    }
    if(!empty($id)){
        $mentor = pdo_fetch("SELECT * FROM " . tablename("mentor") . " WHERE id = :id", array(":id" => $id));
        //var_dump($mentor);
    }
        $data = array(  "name" => trim($_GPC["name"]),  "head_url" => save_media($_GPC["head_url"]), "qr_code" => save_media($_GPC["qr_code"]), "wechat" => trim($_GPC["wechat"]));



    if (checksubmit("submit")) {
        if (empty($_GPC["name"])) {
            message("抱歉，请输入导师姓名！");
        }
        if (empty($id)) {
            pdo_insert("mentor", $data);
            $id = pdo_insertid();
            plog("commission.mentor.add", "添加导师 ID: {$id}");
        } else {

             pdo_update("mentor", $data, array("id" => $id));
             plog("commission.mentor.edit", "编辑导师 ID: {$id}");
        }
        message("更新导师成功！", $this->createPluginWebUrl("commission/mentor", array("op" => "display")), "success");
    }




}elseif ($operation == "delete"){
    ca("commission.mentor.delete");
    $id = intval($_GPC["id"]);
    //var_dump($id);
    if($id == 3){
        message("该导师不可以删除！", $this->createPluginWebUrl("commission/mentor", array("op" => "display")), "error");
    }else{
        $mentor = pdo_fetch("SELECT id,name FROM " . tablename("mentor") . " WHERE id = '$id'");

        if (empty($mentor)) {
            message("抱歉，导师不存在或是已经被删除！", $this->createPluginWebUrl("commission/mentor", array("op" => "display")), "error");
        }
        $member_mentor = pdo_fetch("SELECT id FROM " . tablename("ewei_shop_member") . " WHERE mentor_id = '$id'");
        if($member_mentor){
            message("该导师下有分销商，不可以删除！", $this->createPluginWebUrl("commission/mentor", array("op" => "display")), "error");
        }else{
            pdo_delete("mentor", array("id" => $id));
            plog("commission.mentor.delete", "删除导师 ID: {$id} 姓名: {$mentor["name"]}");
            message("导师删除成功！", $this->createPluginWebUrl("commission/mentor", array("op" => "display")), "success");
        }
    }


}
load()->func("tpl");

include $this->template('mentor');