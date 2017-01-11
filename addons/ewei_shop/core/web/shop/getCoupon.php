<?php
//decode by
global $_W, $_GPC;
$operation = !empty($_GPC["op"]) ? $_GPC["op"] : "display";
if ($operation == "display"){
    ca("shop.getCoupon.view");

    $pindex = max(1, intval($_GPC["page"]));
    $psize = 10;
  	$totalnum = pdo_fetchcolumn("select count(id) from" . tablename("ewei_taobaolink") );
    $others = pdo_fetchall("SELECT * FROM " . tablename("ewei_taobaolink")."order by time desc limit ". ($pindex - 1) * $psize . "," . $psize );
  	$pager = pagination($totalnum, $pindex, $psize);

}elseif ($operation == "post"){

    $Mu = trim($_GPC["earlyStage"]);

    $linkSecond = explode('*',$Mu);

    

    foreach( $linkSecond as $value){

    	$timeNow = time();

		$linkFirst = explode('】',$value);
		// $str1 = substr($Mu,$linkFirst+1,$linkSecond);
		$linkSecond = explode('点击',$linkFirst[1]);

		$linkinfo = stripos($value,'￥');

		$str1 = substr($value,$linkinfo);
		// var_dump($str1.','.$linkinfo.','.$linkSecond[0].','.$timeNow);
		pdo_insert("ewei_taobaolink", array("time" => $timeNow,"link" =>$linkSecond[0],"moreInfo" => $str1,"allInfo" => $value));

	} 

    message("商品更新成功！", $this->createWebUrl("shop/getCoupon"), "success");
    exit;
}

load()->func("tpl");

include $this->template('web/shop/getCoupon');