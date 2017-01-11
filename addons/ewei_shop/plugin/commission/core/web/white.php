<?php
//decode by
global $_W, $_GPC;
$lastid = pdo_fetch("SELECT id FROM " . tablename("white_list") . "order by id desc limit 1 ");
if($_GPC["import"] == "2"){
    ca("commission.agent.import");
    plog("commission.agent.import", "导入");
    $excefile = 'file';
    $aaa = m("excel")->import($excefile);

    foreach($aaa as $val){
        if(empty($val['0']) || empty($val['1'])){
            continue;
        }else{
            $mentor = pdo_fetch("SELECT id, tel FROM " . tablename("white_list") . " WHERE tel = ".$val['0']."");
        }
        if(!$mentor){
            $white_list = pdo_insert("white_list", array("tel" => trim($val['0']),"name" => trim($val['1'])));
        }
    }

    $lastid2 = pdo_fetch("SELECT id FROM " . tablename("white_list") . "order by id desc limit 1 ");
    if($lastid2['id'] - $lastid['id'] == 0){
        message("本次上传成功的数据为0条！", $this->createPluginWebUrl("commission/white"), "error");
    }else{
        pdo_insert("uplode_record", array("name" => trim($_FILES['file']['name']),"time" => time()));
        message("更新成功！", $this->createPluginWebUrl("commission/white"), "success");
    }

}
$pindex = max(1, intval($_GPC["page"]));
$psize = 20;
$totalnum = pdo_fetchcolumn("select count(id) from" . tablename("uplode_record") );


$record = pdo_fetchall("SELECT * FROM " . tablename("uplode_record") ."order by time desc limit ". ($pindex - 1) * $psize . "," . $psize);
$total = pdo_fetchcolumn("SELECT count(id) FROM " . tablename("white_list") ."");
$pager = pagination($totalnum, $pindex, $psize);

load()->func("tpl");
include $this->template('white');