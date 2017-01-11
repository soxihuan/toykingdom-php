<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>个人中心</title>
<style type="text/css">
    body {margin:0px; background:#eee; -moz-appearance:none;}
    a {text-decoration:none;}
    .header {height: auto; width:100%; padding:0px; background: url('../addons/ewei_shop/template/mobile/default/static/images/myHomeBg.png')no-repeat center center;background-size:cover;}
    .header .user {height:55px; padding:10px;border-bottom: 2px solid #e5e5e5;}
    .header .user .user-head {height:54px; width:54px; background:#fff; border-radius:50%; float:left;margin-left:3px;}
    .header .user .user-head img {height:54px; width:54px; border-radius:50%;}
    .header .user .user-info {height:48px; width:auto; float:left; margin-left:14px; color:#fff;padding-top:5px;}
    .header .user .user-info .user-name {height:24px; width:auto; font-size:16px; line-height:24px;color:#222121;}
    .header .user .user-info .user-other {height:24px; width:auto; font-size:12px;color:#222121;display:inline;padding:2px 7px;background:#FFB84D;border-radius:2px;}

    .header .user-gold {height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px;}
    .header .user-gold .title {height:35px; width:auto; float:left; color:#666;}
    .header .user-gold .num {height:35px; width:auto; float:left; color:#f90;}
    
    .header .user-gold .draw {width:80px; height:30px; background:#6c9; float:right;}
    .header .user .set {height:20px; width:20px; float:right; margin-top:10px;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-setting.png') no-repeat center center;background-size:contain;}
  /*   .TheCenterSet{height:20px;width:20px;background:;} */
    .fa-angle-right{color:#222121;}

    .header .user-op { height:35px; width:94%; padding:5px 3%; border-bottom:1px solid #ddd; background:#fff; font-size:16px; line-height:35px; }
    .take {height:30px; width:auto; padding:0 10px; line-height:30px; font-size:16px; float:right; background:#ff6600; border-radius:5px; margin-top:5px; color:#fff;}
    .take1 {height:30px; width:auto; padding:0 10px; line-height:30px; font-size:16px; float:right; background:#F4D500; border-radius:5px; margin-top:6px; color:#222121;}
    
    .order {height:128px; width:100%; background:#fff; margin-top:8px; border-bottom:1px solid #ddd;padding:0 13px;box-sizing: border-box;}
    .order_all {/* height:100px; */ width:100%; padding:16px 0px 0px; color:#666;overflow:hidden;height:69px;}
    .order_pub {height:25px; text-align:center; color:#666; position:relative;border-right:1px solid #E0E0E0;box-sizing: border-box;margin-bottom: 8px;}
    .order_all a{width:25%;float:left;}
    .order_all a:nth-child(1) .order_pub{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-for-the-payment.png') no-repeat center center;background-size:contain;}
    .order_all a:nth-child(2) .order_pub{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-to-send-the-goods.png') no-repeat center center;background-size:contain;}
    .order_all a:nth-child(3) .order_pub{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-for-the-goods.png') no-repeat center center;background-size:contain;}
    .order_all a:nth-child(4) .order_pub{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-for-a-refund.png') no-repeat center center;background-size:contain;border-right:none;}
    .explain{display:block;text-align:center;font-size:16px;color:#222121;}


    .order_pub span {height:16px; width:16px; background:#E60012; border-radius:8px; position:absolute; top:-5px; right:25%; font-size:12px; color:#fff; line-height:16px;}
/*     .order_1 {width:24%;}
    .order_2 {width:25%;}
    .order_3 {width:25%;}
    .order_4 {width:25%;} */

    .homeAllMyOreder{display:inline-block;height:13px;width:13px;background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-the-order.png') no-repeat center center;background-size:contain;position:absolute;left:0;top:50%;transform: translatey(-50%);-webkit-transform: translatey(-50%);}



    .list1 {height:44px;background:#fff;border-bottom:1px solid #ddd;line-height:44px; color:#222121;font-size:16px;box-sizing: border-box;padding-left:30px;position:relative;}
    .list1 i {height:20px;width:10px;}
    .list1 i:first-child {position:absolute;height:20px;width:20px;left:0;top:50%;transform: translatey(-50%);-webkit-transform: translatey(-50%);}
    .allorder {float:right; color:#aaa; margin-right:33px; text-decoration:none;}
    .first-list-home{position:relative;}

    .cart {height:auto; width:100%; background:#fff; margin-top:8px; border-bottom:1px solid #ddd;box-sizing: border-box;padding:0 13px;}
    .cart div{/* border-bottom:1px solid #E5E5E5; */}
    .address {height:38px; width:100%; background:#fff; margin-top:20px; border-bottom:1px solid #ddd; border-top:1px solid #ddd; line-height:38px;}

    .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin-top:10px;}

	span.count {float:right; margin-top:14px; margin-right: 7px; height:20px;font-size:16px; color:#E60012; line-height:16px; text-align: center;}
.address-control{padding:0 13px;display:block;background:#fff;box-sizing: border-box;}
    .address-control div{margin-top:8px;border:none;}

    .mayIcon-1{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-distribut-on-center.png') no-repeat center center;background-size:contain;}
    .mayIcon-2{background:url('../addons/ewei_shop/template/mobile/default/static/images/icon_HomePage_me.png') no-repeat center center;background-size:contain;}
    .mayIcon-3{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-coupons.png') no-repeat center center;background-size:contain;}
    .mayIcon-4{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-coupons1.png') no-repeat center center;background-size:contain;}
    .mayIcon-5{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-the-shopping-cart.png') no-repeat center center;background-size:contain;}
    .mayIcon-6{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-my-collection.png') no-repeat center center;background-size:contain;}
    .mayIcon-7{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-footprint.png') no-repeat center center;background-size:contain;}
    .mayIcon-8{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-message-to-remind.png') no-repeat center center;background-size:contain;}
    .mayIcon-9{background:url('../addons/ewei_shop/template/mobile/default/static/images/personal-center-address.png') no-repeat center center;background-size:contain;}
    .integral-icon{background:url('../addons/ewei_shop/template/mobile/default/static/images/points-unselected.png') no-repeat center center;background-size:contain;}
}
</style>
 
<div id="container"></div>
<script id="member_center" type="text/html">
    <div class="header">
        <div class="user">
            <div class="user-head"><img src="<%member.avatar%>" /></div>
            <div class="user-info">
                <div class="user-name"><%member.nickname%></div>
                <div class="user-other" <?php  if(!empty($set['shop']['levelurl'])) { ?>onclick='location.href="<?php  echo $set['shop']['levelurl'];?>"'<?php  } ?>><%level.levelname%><?php  if(!empty($set['shop']['levelurl'])) { ?><i class='fa fa-question-circle' ></i><?php  } ?>
                </div>
            </div>
            <div class="set" onclick='location.href="<?php  echo $this->createMobileUrl('member/info')?>"'><!-- <i class="TheCenterSet" style=""></i> --></div>
        </div>

</div>
 <div class="cart " style=''>
   <!--   <a href="javascript:;"><div class="list1" style=" border-bottom:0px;border-top:0px;">余额: <span style='color:#f90'><%member.credit2%></span> 
             <?php  if(empty($set['trade']['closerecharge'])) { ?>
             <div class="take" onclick="location.href='<?php  echo $this->createMobileUrl('member/recharge',array('openid'=>$openid))?>'">充值</div>
             <?php  } ?>
                 
         </div></a> -->
    
    <a href="javascript:;"><div class="list1" style="margin:0px; border-bottom:0px;">积分: <%member.credit1%>
             <i class="integral-icon"></i>
            <%if open_creditshop%>
            <div class="take1" onclick="location.href='<?php  echo $this->createPluginMobileUrl('creditshop')?>'">积分兑换</div>
            <%/if%>
        </div>
    </a>
</div>
<div class="order">
    <a href="<?php  echo $this->createMobileUrl('order')?>">
        <div class="list1 first-list-home" >
            <i class="homeAllMyOreder" style="float:left; line-height:44px;"></i>
            <span style="float:left;">我的订单</span>
            <i class="fa fa-angle-right" style="color:#222121; font-size:26px; float:right; line-height:44px;"></i>
            <div class="allorder">查看我的全部订单</div>
        </div>
    </a>
    <div class="order_all">
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>0))?>"><div class="order_pub order_1" ><!-- <i class="order-list-first" style="font-size:30px"></i> --><%if order.status0>0%><span><%order.status0%></span><%/if%></div><span class="explain">待付款</span></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>1))?>"><div class="order_pub order_2"><!-- <i class="order-list-second" style="font-size:30px"></i> --><%if order.status1>0%><span><%order.status1%></span><%/if%></div><span class="explain">待发货</span></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>2))?>"><div class="order_pub order_3"><!-- <i class="order-list-third" style="font-size:30px"></i> --><%if order.status2>0%><span><%order.status2%></span><%/if%></div><span class="explain">待收货</span></a>
        <a href="<?php  echo $this->createMobileUrl('order',array('status'=>4))?>"><div class="order_pub order_4"><!-- <i class="order-list-fouth" style="font-size:30px"></i> --><%if order.status4>0%><span><%order.status4%></span><%/if%></div><span class="explain">待退款</span></a>
    </div>
</div>

	
<div class="cart">
	<?php  if($hascom) { ?>
	        <a href="<?php  echo $this->createPluginMobileUrl('commission')?>"><div class="list1" style="margin:0px; "><i class="mayIcon-1" style="color:#f10;"></i><?php  echo $pset['texts']['center']?><i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>	
	<?php  } ?>
    <a href="<?php  echo $this->createMobileUrl('member/info')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="mayIcon-2" style="color:#A6E1EC;"></i>我的资料<i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>
</div>
<?php  if($hascoupon) { ?>
<div class="cart">
     <?php  if($hascouponcenter) { ?>
	<a href="<?php  echo $this->createPluginMobileUrl('coupon')?>"><div class="list1" style="margin:0px; "><i class="mayIcon-3" style="color:#b03d08;"></i>领取优惠券 <i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i> </div></a>	
    <?php  } ?>
    <a href="<?php  echo $this->createPluginMobileUrl('coupon/my')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="mayIcon-4" style="color:#08b00e;"></i>我的优惠券 <i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i> <span class="count"><%counts.couponcount%></span></div></a>	
    
</div>
<?php  } ?>
<div class="cart">
    <a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><div class="list1" style="margin:0px;"><i class="mayIcon-5" style="color:#f90;"></i>我的购物车<i class="fa fa-angle-right" style="font-size:26px; float:right; line-height:44px;"></i> <span class="count"><%counts.cartcount%></span></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/favorite')?>"><div class="list1" style="margin:0px; "><i class="mayIcon-6" style="color:#f03;"></i>我的收藏<i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i><span class="count"><%counts.favcount%></span></div></a>
    <a href="<?php  echo $this->createMobileUrl('shop/history')?>"><div class="list1" style="margin:0px; "><i class="mayIcon-7" style="color:#096;"></i>我的足迹<i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>
    <a href="<?php  echo $this->createMobileUrl('member/notice')?>"><div class="list1" style="margin:0px; border-bottom:0px;"><i class="mayIcon-8" style="color:#cc6;"></i>消息提醒设置<i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>
    
</div>
<!--     <?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>
    <a href="javascript:;" id="btnwithdraw"><div class="list1" style="border-bottom: 0px;"><i class="fa fa-money" style="color:#0096ff;"></i>余额提现<i class="fa fa-angle-right" style="color:#999; font-size:26px; float:right; line-height:44px;"></i></div></a>    
    <?php  } ?>
    <?php  if(isset($set['trade']) && ($set['trade']['withdraw']==1 || empty($set['trade']['closerecharge']))) { ?>
    <a href="<?php  echo $this->createMobileUrl('member/log')?>"><div class="list1" style="<?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>margin:0px;<?php  } ?>"><i class="fa fa-file-text" style="color:#009;"></i><?php  if(isset($set['trade']) && $set['trade']['withdraw']==1) { ?>余额明细<?php  } else { ?>充值记录<?php  } ?>
            <i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>    
   <?php  } ?> -->
    
<a href="<?php  echo $this->createMobileUrl('shop/address')?>" class="address-control"><div class="list1"><i class="mayIcon-9" style="color:#99C"></i>收货地址管理<i class="fa fa-angle-right" style=" font-size:26px; float:right; line-height:44px;"></i></div></a>


</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.json('member/center',{},function(json){
            
           $('#container').html(  tpl('member_center',json.result) );
           var withdrawmoney = <?php echo empty($set['trade']['withdrawmoney'])?0:floatval($set['trade']['withdrawmoney'])?>;
           $('#btnwithdraw').click(function(){
 
               if(json.result.member.credit2<=0){
                   core.tip.show('无余额可提!');
                   return;
               }
               if(withdrawmoney>0 && json.result.member.credit2<withdrawmoney){
                   core.tip.show('满' +withdrawmoney + "元才能提现!" ); 
                   return;
               }
               location.href = core.getUrl('member/withdraw');
           })
            
        },true);
        
    })
</script>
<!-- <?php  $show_footer=true?>
<?php  $footer_current='member'?>
 -->
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>

