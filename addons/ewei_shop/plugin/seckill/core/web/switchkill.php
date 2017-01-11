<?php
if (!defined("IN_IA")) {
    exit("Access Denied");
}
global $_W, $_GPC;

ca("seckill.switchkill.save");
$iskill = pdo_fetch("SELECT * from ".tablename("ewei_shop_kill_open")."where id = 1");

if (checksubmit("submit")) {
    pdo_update("ewei_shop_kill_open", array("isopen" => $_GPC['data']['isopen']), array("id" => '1'));
    message("设置成功!", referer(), "success");
}

load()->func("tpl");
include $this->template('switchkill');