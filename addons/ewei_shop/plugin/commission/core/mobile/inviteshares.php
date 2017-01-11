<?php
//decode by  
global $_W, $_GPC;
$mid = intval($_GPC["mid"]);
$openid = m("user")->getOpenid();
$member = m("member")->getMember($openid);
$shop_set = set_medias(m("common")->getSysset("shop"), "logo");
$share_set = set_medias(m("common")->getSysset("share"), "icon");
$can = false;
if ($member["isagent"] == 1 && $member["status"] == 1) {
    $can = true;
}
if (!$can) {
    header("location: " . $this->createPluginMobileUrl("commission/register"));
    exit;
}
$returnurl = urlencode($this->createPluginMobileUrl("commission/shares", array("goodsid" => $_GPC["goodsid"])));

$infourl = "";
$set = $this->set;
if (empty($set["become_reg"])) {
    if (empty($member["realname"]) || empty($member["mobile"])) {
        $infourl = $this->createMobileUrl("member/info", array("returnurl" => $returnurl));
    }
}
$_W["shopshare"] = array("title" => "我是窝在家店主，邀请你加入我们！", "imgUrl" => "http://static.52wzj.com/PT04ot111rZ4N1zB4ar0WC1044RTC1.jpg", "desc" => "吴昕喊你来窝在家0元开店创业啦！一件代发不囤货，赶快加入吧！！！", "link" => $this->createPluginMobileUrl("commission/register", array("mid" => $member["id"])));
if (empty($infourl) && $_W["isajax"]) {
    $img = $this->model->createInviterImage($shop_set);
    die($img);
}

include $this->template("inviteshares");