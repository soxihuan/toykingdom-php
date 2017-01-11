<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	// var $Know = select;
	$Myordersn = $_GPC['destine'];
	$orderid = intval($_GPC["orderId"]);
	$Myopenid = m("user")->getOpenid();
	$Myuseropenid = pdo_fetchall("select openid   from " . tablename("ewei_shop_order") . " where  ordersn = '".$Myordersn."'");
	$order = pdo_fetch("select * from " . tablename("ewei_shop_order") . " where id=:id and uniacid=:uniacid and openid=:openid limit 1", array(":id" => $orderid, ":uniacid" => 4, ":openid" => $Myuseropenid[0]["openid"]));

	// if (condition) {
		$goods = pdo_fetchall("select og.goodsid,og.price,g.title,g.thumb,og.total,g.credit,og.optionid,og.optionname as optiontitle,g.isverify,c.name as pname from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . "left join" . tablename("ewei_shop_category") . " c on c.id = g.pcate " . " where og.orderid= '".$orderid."'");
		$goods2 = pdo_fetchall("select og.goodsid,c.name as cname from " . tablename("ewei_shop_order_goods") . " og " . " left join " . tablename("ewei_shop_goods") . " g on g.id=og.goodsid " . "left join" . tablename("ewei_shop_category") . " c on c.id = g.ccate " . " where og.orderid= '".$orderid."'");
			// var_dump($goods);
			// echo "............";
		$Myarr = array();
			foreach ($goods2 as $key => $value) {
				array_push($Myarr,"{
	       'sku': '".$goods[$key]['optionid'].",".$goods[$key]['optiontitle']."',
	       'name': '".$goods[$key]['title']."',
	       'category': '".$goods[$key]['pname'].",".$goods2[$key]['cname']."',
	       'price': ".$goods[$key]['price'].",
	       'quantity': ".$goods[$key]['total']."
	                }");
			};
		$goodList = join(",",$Myarr);
		// var_dump($goodList);	
		// 	echo "............";
		// var_dump($order);
		echo "<script> 
			window.dataLayer = window.dataLayer || []
	            dataLayer.push({
	            'transactionId': '".$Myordersn ."',
	            'transactionTotal': ".$order['price'].",
	            'transactionShipping': ".$order['olddispatchprice'].",
	            'transactionProducts': [".$goodList."]

	        });
		</script>";
	?>
	<!-- Google Tag Manager -->
		<noscript><iframe src="http://www.googletagmanager.com/ns.html?id=GTM-5KZ794"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5KZ794');</script>
		<!-- End Google Tag Manager -->
</body>
</html>
