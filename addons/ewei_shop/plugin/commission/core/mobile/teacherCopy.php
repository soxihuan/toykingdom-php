<?php
global $_W, $_GPC;


if(!empty($mid)){
    $mid = intval($_GPC["mid"]);
}else{
    $openid = m("user")->getOpenid();
    $member_id = pdo_fetch("SELECT id FROM " . tablename("ewei_shop_member") . " WHERE openid = '$openid'");
    $mid=$member_id['id'];

}


$mentor = pdo_fetch("SELECT m.name,m.head_url,m.wechat,m.qr_code FROM " . tablename("ewei_shop_member") . " dm " . "left join" . tablename("mentor") . "m on dm.mentor_id = m.id" . " WHERE dm.id = '$mid'");

include $this->template("teacherCopy");