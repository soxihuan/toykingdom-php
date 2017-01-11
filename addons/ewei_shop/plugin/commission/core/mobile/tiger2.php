<?php
//decode by  
global $_W, $_GPC;
$mid = intval($_GPC["mid"]);
$openid = m("user")->getOpenid();
$member = m("member")->getMember($openid);

include $this->template("tiger/indexVisitor");