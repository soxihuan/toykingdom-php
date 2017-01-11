<?php
global $_W, $_GPC;
$mid = intval($_GPC['mid']);
$openidOld = pdo_fetch("SELECT openid FROM ".tablename("ewei_shop_member"). " WHERE id = '{$mid}'");
$openid = m('user')->getOpenid();
$user = pdo_fetch("SELECT id,status,isagent FROM ".tablename("ewei_shop_member"). " WHERE openid = '{$openid}'");
$member = m('member')->getMember($openidOld['openid']);

if ($_W["isajax"]) {
    $click = pdo_fetch("SELECT * FROM ".tablename("cs")." WHERE id = '1'");
    pdo_update("cs",array("click" => $click['click'] + 1),array("id" => 1));
    $page1  = array("nickname" => $member['nickname'], "avatar" => $member['avatar']);
    //成为分销商到2016-12-20多少天
    $becomeDay = floor((time() - $member['agenttime']) / 86400) +1;
    $time = date("Y年m月d日",$member['agenttime']);
    $page2 = array("agenttime" => $time, "agentday" => $becomeDay);
    //3
    $firstOrder = pdo_fetch("SELECT o.id order_id,o.createtime,o.price order_price,g.goodsid,good.thumb FROM" . tablename("ewei_shop_order")." o LEFT JOIN ".tablename("ewei_shop_order_goods"). " g ON o.id = g.orderid LEFT JOIN ".tablename("ewei_shop_goods")."good ON good.id = g.goodsid WHERE o.agentid = '".$member['id']."' and o.status != 4 and o.status != -1");
    $firstCommissions = pdo_fetchall("SELECT commissions FROM ".tablename("ewei_shop_order_goods")." WHERE orderid = '".$firstOrder['order_id']."'");
    foreach($firstCommissions as $o){
        $commissions = iunserializer($o["commissions"]);
        $commission_ok += $commissions['level1'];
    }
    $time2 = date("Y年m月d日",$firstOrder['createtime']);
    $page3 = array("paytime" => $time2, "order_price" => $firstOrder['order_price'], "thumb" => $firstOrder['thumb'], "commissions" => $commission_ok);

    //4
    //touxiang count( DISTINCT openid) as customer
    $buyMyshop =pdo_fetchall("SELECT id ,openid FROM ".tablename("ewei_shop_order")." WHERE agentid = '".$member['id']."' group by openid");
    foreach($buyMyshop as $key=>$row){
        if($key <= 5){
            $thumb = pdo_fetch("SELECT avatar FROM ".tablename("ewei_shop_member")." WHERE openid = '{$row['openid']}'");
            $a[$key] = $thumb;
        }
    }
    if(end(array_keys($buyMyshop)) != 0){
        $last = end(array_keys($buyMyshop))+1;
    }
    if($member['clickcount'] == 0){
        $member['clickcount'] =1;
    }
    $page4 = array("clickcount" => $member['clickcount'], "customer_pic" => $a, "customer_num" => $last);
    //5
    $ordersaleslist = pdo_fetch("SELECT * FROM ".tablename("cs2"). " WHERE uid = '".$member['id']."'");


    //zuigao
    $mon = array("8" => $ordersaleslist['aug'], "9" => $ordersaleslist['sep'], "10" => $ordersaleslist['oct'], "11" => $ordersaleslist['nov'], "12" => $ordersaleslist['dec']);
    asort($mon);
    $ordersales_mon = end(array_keys($mon));
    $ordersales_top = end($mon);
    if($ordersaleslist['id'] > 1824 ||empty($ordersaleslist)){
        $ordersaleslist['id'] = 1825;
        $ordersales_mon = '12';
        $ordersaleslist['ordersales'] = 0;
    }
    if($ordersaleslist['id'] <= 10){
        $ordersales_prompt = '超棒！';
    }elseif($ordersaleslist['id'] > 10 && $ordersaleslist['id'] <= 50){
        $ordersales_prompt = '哎呦~不错哦！';
    }else{
        $ordersales_prompt = '加油哒！';
    }
    $page5 = array("ordersales" => $ordersaleslist['ordersales'], "ordersales_ranking" => $ordersaleslist['id'], "ordersales_prompt" => $ordersales_prompt, "ordersales_mon" => $ordersales_mon);
    //6
    $commissionlist = pdo_fetch("SELECT * FROM ".tablename("cwy4"). " WHERE uid = '".$member['id']."'");

    //zuigao
    $commission_mon = array("8" => $commissionlist['aug'], "9"=>$commissionlist['sep'],"10"=>$commissionlist['oct'], "11" => $commissionlist['nov'], "12" => $commissionlist['dec']);
    asort($commission_mon);
    $commission_mon = end(array_keys($commission_mon));
    $commission_top = end($commission_mon);
    if($commissionlist['id'] > 1943  ||empty($commissionlist)){
        $commissionlist['id'] = 1944;
        $commission_mon = '12';
        $commissionlist['commission_total'] = 0;
    }
    if($commissionlist['id'] <= 10 && $commissionlist['id']>0){
        $commission_prompt = '超棒！';
    }elseif($commissionlist['id'] > 10 && $commissionlist['id'] <= 50){
        $commission_prompt = '哎呦~不错哦！';
    }elseif($commissionlist['id'] >50){
        $commission_prompt = '加油哒！';
    }

    $page6 = array("commission" => $commissionlist['commission_total'], "commission_ranking" => $commissionlist['id'], "commission_prompt" => $commission_prompt, "commission_mon" => $commission_mon);
    //7
    $agentid = intval($member["id"]);
    $shop_owner = $this->model->getInfo($agentid);
    $level1_agentids = pdo_fetchall('select m.id,m.avatar from ' . tablename('ewei_shop_member') ." m LEFT JOIN ".tablename("cs2"). " c ON m.id = c.uid where m.agentid='".$member['id']."' and m.isagent=1 and m.status=1 and m.uniacid= '".$_W['uniacid']."' ORDER BY c.ordersales desc limit 5");
    $level1 = count($level1_agentids);
    if($level1 < 5 && $shop_owner['agentcount'] >$level1){
        $agent_num = 5-$level1;
        $level2_agentids = pdo_fetchall('select m.id, m.avatar from ' . tablename('ewei_shop_member') ." m LEFT JOIN ".tablename("cs2"). ' c ON m.id = c.uid where m.agentid in( ' . implode(',', array_keys($shop_owner['level1_agentids'])) . ") and m.isagent=1 and m.status=1 and m.uniacid='".$_W['uniacid']."' ORDER BY c.ordersales desc limit {$agent_num} ");
    }
    foreach($level2_agentids as $val){
        $level1_agentids[] = $val;
    }
    $page7 = array("agentcount" => $shop_owner['agentcount'], "avatar" => $member['avatar'],"agentids_img" => $level1_agentids);

    if($openidOld['openid'] != $openid){
        if($user['status'] && $user['isagent']){
            $is_shop = 1;
        }else{
            $is_shop = 0;
        }
        show_json(1, array("page1" => $page1, 'page2' => $page2, 'page3' => $page3,'page4'=>$page4, 'page5'=>$page7,'is_shop' => $is_shop,'shopurl'=>$this->createPluginMobileUrl("commission/myshop",array("mid" => $member['id'])),"experienceurl"=>$this->createPluginMobileUrl("commission/experience",array("mid" => $user['id']))));
    }else{
        show_json(1, array("click" => $click,"page1" => $page1, 'page2' => $page2, 'page3' => $page3,'page4'=>$page4, 'page5'=>$page5, 'page6'=>$page6, 'page7'=>$page7));
    }

}
if($openidOld['openid'] != $openid){
    include $this->template("tiger/indexVisitor");
}else{
    include $this->template("tiger/index");
}





























