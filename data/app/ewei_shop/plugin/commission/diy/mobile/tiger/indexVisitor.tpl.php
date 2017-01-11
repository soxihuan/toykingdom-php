<?php defined('IN_IA') or exit('Access Denied');?>﻿
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>小店年终大盘点</title>
<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0'/>
<script language="javascript" src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/js/countUp.js"></script>
<link rel="stylesheet" href="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/css/swiper.min.css">
<link rel="stylesheet" href="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/css/animate.min.css">
<script src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/js/swiper.min.js"></script>
<script src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/js/swiper.animate.min.js"></script>
<script src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/js/swiper.animate.min.js"></script>

 <script language="javascript" src="../addons/ewei_shop/static/js/require.js"></script>
<script language="javascript" src="../addons/ewei_shop/static/js/dist/jquery-1.11.1.min.js"></script>

<script language="javascript" src="../addons/ewei_shop/static/js/app/config.js?v=3"></script>

<!-- <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script> -->

<!--<link rel="stylesheet" href="/dist/css/swiper.min.css">
<link rel="stylesheet" href="/dist/css/animate.min.css">
<script src="/dist/js/swiper.min.js"></script>
<script src="/dist/js/swiper.animate.min.js"></script>-->

<style>
*{
	margin:0;
	padding:0;
}
html,body{
	height:100%;
  font-family: 'microsoft yahei',微软雅黑,Verdana, Arial, Helvetica, sans-serif;
}
body{
	font-family:'microsoft yahei',微软雅黑,Verdana, Arial, Helvetica, sans-serif;
}
.swiper-container {
  /*  width: 320px;
    height: 480px;*/
	width: 100%;
    height: 100%;
	background:#000;

  
}  
div{font-family:'microsoft yahei',微软雅黑,Verdana, Arial, Helvetica, sans-serif;}
.swiper-slide{
	width:100%;
	height:100%;
	background:url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/bg.jpg) no-repeat left top;
	background-size:100% 100%;

}
img{
	display:block;
}
.swiper-pagination-bullet {
width: 6px;
height: 6px;
background: #fff;
opacity: .4;
}
.swiper-pagination-bullet-active {
opacity: 1;
}
@-webkit-keyframes start {
	0%,30% {opacity: 0;}
	60% {opacity: 1;}
	100% {opacity: 0;}
}
@-moz-keyframes start {
	0%,30% {opacity: 0;-moz-transform: translate(0,10px);}
	60% {opacity: 1;-moz-transform: translate(0,0);}
	100% {opacity: 0;-moz-transform: translate(0,-8px);}
}
@keyframes start {
	0%,30% {opacity: 0;}
	60% {opacity: 1;}
	100% {opacity: 0;}
}
.ani{
	position:absolute;
	}
.txt{
	position:absolute;
}
#array{
	position:absolute;z-index:999;-webkit-animation: start 1.5s infinite ease-in-out;
}
.pageOne{background: url(http://static.52wzj.com/P1_BG.jpg) no-repeat center center;background-size: 100% auto;}

.costerName{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P1_text.png) no-repeat center center;background-size: contain;width:3.3rem;height:1.625rem;top:6.9rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);color: #FEE100;font-size: 0.4rem;text-align: center;line-height: 0.87rem;}


.costerNameInner{background: #000;height: 0.78rem;padding:0 0.5rem;top:7.0rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);color: #FEE100;font-size: 0.4rem;text-align: center;line-height: 0.78rem;z-index: 5;min-width: 2rem;border-radius:0.39rem;white-space: nowrap;}

.pageTwo{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P2_BG.jpg) no-repeat center center;background-size: 100% auto;}
.intoTime{font-size: 0.9rem;color: #222121;text-align: center;top: 6rem;left: 50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);font-weight:;white-space: nowrap;font-family: 'microsoft yahei',微软雅黑,Verdana, Arial, Helvetica, sans-serif;}
.howLong{white-space: nowrap;font-size: 2rem;font-weight: 500;text-align: center;left: 50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top: 10.6rem;font-family:'microsoft yahei',微软雅黑,Verdana, Arial, Helvetica, sans-serif;}
.pageThree{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P3_bg.jpg) no-repeat center center;background-size: 100% auto;}
.firstOrder{font-size: 0.75rem;text-align: center;white-space: nowrap;top: 6.25rem;left: 50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);}
.howMuch{position: absolute;right: 4rem;top: 7.9rem;font-size: 0.9rem;color: #FF5A01;font-weight: 400;z-index: 4;}

.howMuchCommission{position: absolute;left: 4.3rem;color: #FEE100;font-size: 0.9rem;top: 11rem;z-index: 4;}
.pageFour{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P4_bg.jpg) no-repeat center center;background-size: 100% auto;}
.pageFourNum1{position: absolute;color: #FF5A01;font-size: 0.55rem;right: 6.8rem;top: 6.56rem;}
.pageFourNum2{position: absolute;color: #FF5A01;font-size: 0.5rem;right: 6.8rem;top: 7.285rem; }
.imgGround{position: absolute;top: 8.65rem;left: 50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);width: 7rem;height: 5.5rem;}
.imghead{position: absolute;width: 3rem;height: 3rem;border-radius: 50%;border:3px solid #000;}

.pageFive{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P5_bg.jpg) no-repeat center center;background-size: 100% auto;}
.pageFive .allSales{position: absolute;left: 4.7rem;top: 6.51rem;font-size: 0.625rem;color: #FF5A01;}
.pageFive .ranking{position: absolute;left: 5.82rem;top: 7.5rem;font-size: 0.625rem;color: #FF5A01;}
.pageFive .month{position: absolute;right: 7.5rem;top: 8.74rem;font-size: 0.625rem;color: #FF5A01;}

.pageSix{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P6_bg.jpg) no-repeat center center;background-size: 100% auto;}
.pageSix .allSales{position: absolute;left: 4.7rem;top: 6.51rem;font-size: 0.625rem;color: #FF5A01;}
.pageSix .ranking{position: absolute;left: 5.82rem;top: 7.42rem;font-size: 0.625rem;color: #FF5A01;}
.pageSix .month{position: absolute;right: 7.5rem;top: 8.63rem;font-size: 0.625rem;color: #FF5A01;}

.pageSeven{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P7_bg.jpg) no-repeat center center;background-size: 100% auto;}
.imgheadSeven{position: absolute;width: 3rem;height: 3rem;border-radius: 50%;border:3px solid #000;}
.howManyPeo{position:absolute;top: 5.855rem;right:4.7rem;font-size: 1.3rem;color: #FF5A01;}

.pageEight{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P8_bg.jpg) no-repeat center center;background-size: 100% auto;}
.share{position: absolute;width: 3.675rem;height:1.23rem;background:url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P8_share.png) no-repeat center center;background-size:contain;top: 12rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);z-index: 5;}
.shadowShare{position:absolute;width: 100%;height: 100%;background:rgba(0,0,0,.5);left: 0;top:0;display: none;z-index: 5;}
.shadowShare span{width: 5rem;position: absolute;left: 50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top: 2.5rem;}
.pageNine{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_bg_visitor.jpg) no-repeat center center;background-size: 100% auto;}

.ShopName{font-size: 0.45rem;color: #FF5A01;position:absolute;width: 1.6rem;text-align: center;display:block;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
.imgGround img {display: none;}

.ifNothing{position: absolute;top: 6.8rem;color: #000;left: 50%;white-space: nowrap;font-weight: 500;font-size: 0.6rem;text-align: center;transform:translatex(-50%);-webkit-transform:translatex(-50%);display: none;}
.MusicPlay{width: 1rem;height: 1rem;position: fixed;right: 0.2rem;top: 0.2rem;z-index: 5;border-radius: 50%;}
.MusicPlay.go{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/gogo.png) no-repeat center center;background-size:contain;}
.MusicPlay.stop{background: url(../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/stop.png) no-repeat center center;background-size:contain;}
</style>
</head>


<body>
<div class="swiper-container">
    <div class="swiper-wrapper">
      <!-- 第一页 -->
      <section class="swiper-slide swiper-slide1 pageOne">
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/logo.png" class="ani  resize" style="width:2.125rem;left:0.625rem;top:0.625rem;z-index:3;" swiper-animate-effect="" swiper-animate-duration="1.5s" swiper-animate-delay="0s">
      <img src="" class="ani myhead resize" style="width:3.825rem;height:3.825rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2.7rem;z-index:3;border-radius: 50%;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s" >

      <div class="ani costerName" style="z-index:3;" swiper-animate-effect="" swiper-animate-duration="1s" swiper-animate-delay="0s"></div>
      <div class="ani costerNameInner" style="z-index:3;" swiper-animate-effect="" swiper-animate-duration="1s" swiper-animate-delay="0s" ></div>
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P1_2016.png" class="ani resize" style="width:6.65rem;height:2.85rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:9rem;z-index:3;" swiper-animate-effect="slideInUp" swiper-animate-duration="1s" swiper-animate-delay="0s" >
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P1_end.png" class="ani resize" style="width:6.875rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:12.3rem;z-index:3;" swiper-animate-effect="slideInUp" swiper-animate-duration="1s" swiper-animate-delay="0.5s" >
      </section>
      <!-- 第二页 -->  
      <section class="swiper-slide swiper-slide2 pageTwo">
    
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P2_shop.png" class="ani resize" style="width:8rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2.625rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
      <div class="intoTime ani" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">2016年10月9日</div>
      
       <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p2_visitor_Text.png" class="ani resize" style="width:6.05rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:7.7rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.5s">
       <div class="howLong ani" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s" id="howLong">0</div>
      <!--         <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/004.png" class="ani resize" style="width:320px;height:64px;left:0px;top:10px;z-index:5; " swiper-animate-effect="bounce" swiper-animate-duration="0.5s" swiper-animate-delay="0s"  > 
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/005.png" class="ani resize" style="width:320px;height:42px;left:0px;top:100px;z-index:4;" swiper-animate-effect="fadeIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.5s"  > 
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/006.png" class="ani resize" style="width:320px;height:264px;left:0px;top:160px;z-index:3;" swiper-animate-effect="zoomInDown" swiper-animate-duration="0.5s" swiper-animate-delay="1s"  > -->
      </section>


     <!----------------slide3-------------->
        <section class="swiper-slide swiper-slide3 pageThree">
     
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P3_calendar.png" class="ani resize" style="width:5.2rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2.625rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0s">
        <div class="firstOrder mayBeNone ani" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">2016年12月22日</div>

     
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P3_text.png" class="ani mayBeNone resize" style="width:4.625rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:7.4rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">
        <div class="howMuch mayBeNone ani" id="howMuch" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s" >0</div>
        
        <img class="headPic mayBeNone ani" style="width:4.15rem;height:4.15rem;left:50%;top:9.125rem;z-index:4;" src="" swiper-animate-effect="slideInUp" swiper-animate-duration="1s" swiper-animate-delay="0.4s" alt="">

        <div class="ifNothing ani" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.4s">小店还没有成交过订单<br>需要加油呦~</div>       
<!--         <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/007.png" class="ani resize" style="width:320px;height:66px;left:0px;top:30px;z-index:5; " swiper-animate-effect="bounce" swiper-animate-duration="0.5s" swiper-animate-delay="0s"  > 
      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/008.png" class="ani resize" style="width:320px;height:192px;left:0px;top:220px;z-index:4;" swiper-animate-effect="bounceInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="1s"  > 
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/009.png" class="ani resize" style="width:320px;height:77px;left:0px;top:110px;z-index:3;" swiper-animate-effect="zoomIn" swiper-animate-duration="0.5s" swiper-animate-delay="0.5s"  > 
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/010.png" class="ani resize" style="width:320px;height:192px;left:0px;top:220px;z-index:2;" swiper-animate-effect="bounceInRight" swiper-animate-duration="0.5s" swiper-animate-delay="1.5s"   >  -->
 
        </section>
    
        <section class="swiper-slide swiper-slide4 pageFour">
        

         <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P4_customer.png" class="ani resize" style="width:5.15rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s" >

         <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p4_visitor_Text.png" class="ani resize" style="width:5.95rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:6.125rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">
         <div class="pageFourNum1 ani" id="pageFourNum1" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">0</div>
         <div class="pageFourNum2 ani" id="pageFourNum2" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">0</div>
         <ul class="imgGround">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.7s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.7s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="2.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="2.7s">
         </ul>
         <script>
            for (var i = 0; i < 6; i++) {
              var num1 = Math.random();
              var num2 = Math.random();
              var num3 = (10-Math.random()*2)/10;
              console.log(num1+','+num2);
              var positionx = 3.9 * num1;
              var positiony = 2.45 * num2;
              $('.imghead').eq(i).css({
                'left': positionx+'rem',
                'top': positiony+'rem',
                'width': 3*num3+'rem',
                'height': 3*num3+'rem'
              });
            };
         </script>
<!--         <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/001.jpg" class="ani resize" style="width:320px;height:46px;left:0;top:20px;z-index:2;" swiper-animate-effect="fadeInDown" swiper-animate-duration="0.5s" swiper-animate-delay="0s"   > 
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/upload/002.jpg"  class="ani resize" style="width:320px;height:327px;left:0px;top:100px;z-index:1;" swiper-animate-effect="zoomInLeft" swiper-animate-duration="0.5s" swiper-animate-delay="0.5s"  > -->
 
        </section>

      
      <section class="swiper-slide swiper-slide7 pageSeven">

      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/P7_team.png" class="ani resize" style="width:5.5rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s" >

      <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p5_visitor_Text.png" class="ani resize" style="width:6rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:6.8rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">
         <ul class="imgGround">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.7s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="1.7s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="2.2s">
           <img src="" class="imghead ani" alt="" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="2.7s">
         </ul>
         <script>
            for (var i = 0; i < 6; i++) {
              var num1 = Math.random();
              var num2 = Math.random();
              var num3 = (10-Math.random()*2)/10;
              console.log(num1+','+num2);
              var positionx = 3.9 * num1;
              var positiony = 2.45 * num2;
              $('.pageSeven .imghead').eq(i).css({
                'left': positionx+'rem',
                'top': positiony+'rem',
                'width': 3*num3+'rem',
                'height': 3*num3+'rem'
              });
            };
         </script>
          <div class="howManyPeo ani" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s" id="howManyPeo">0</div>
      </section>


      <section class="swiper-slide swiper-slide8 pageNine otherShop">

        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_visitor.png" class="ani resize" style="width:6.2rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2rem;z-index:3;" >

        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_visitor_Text.png" class="ani resize" style="width:8.425rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:5.8rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">

        <a href=""  swiper-animate-effect="" swiper-animate-duration="1s" swiper-animate-delay="0.2s" class="ani theShopUrl" style="left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:13rem;" >
          <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_goShopping.png" class="" style="width:5.1rem;z-index:3;"></a>

        <span class="ShopName" style="left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:13.1rem;">Hello</span>
      </section>

      <section class="swiper-slide swiper-slide8 pageNine myhistory">

        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_visitor.png" class="ani  resize" style="width:6.2rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:2rem;z-index:3;" >

        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_visitor_Text.png" class="ani resize" style="width:8.425rem;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:5.8rem;z-index:3;" swiper-animate-effect="fadeIn" swiper-animate-duration="1s" swiper-animate-delay="0.2s">

        <a href=""  swiper-animate-effect="" swiper-animate-duration="1s" swiper-animate-delay="0.2s" class="ani theOneHistory" style="left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);top:13rem;">
        <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/p6_myFinally.png" class="" style="width:4.425rem;z-index:3;"></a>

      </section>
    </div>

<div class="MusicPlay go"></div>
<audio id="Jaudio" class="media-audio" src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/js/Hisaishi.mp3" preload loop="loop"></audio >
<script>
var Jaudio = document.getElementById('Jaudio');  
  function audioAutoPlay(id){
    var audio = document.getElementById(id);
    audio.play();
    document.addEventListener("WeixinJSBridgeReady", function () {
            audio.play();
    }, false);
}


      
    $(".MusicPlay").click(function(){                  
      // $('#Jaudio').pause()
        // audio.bind('Jaudio',);
        if ( $(".MusicPlay").hasClass('go')) {
         $('.MusicPlay').addClass('stop').removeClass('go')

          Jaudio.pause();
        }else{
           $('.MusicPlay').addClass('go').removeClass('stop')   
           audioAutoPlay('Jaudio'); 
        }       
    });  
          
  audioAutoPlay('Jaudio'); 
</script>
   <img src="../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/down.png" style="width:0.75rem;bottom:10px;left:50%;transform:translatex(-50%);-webkit-transform:translatex(-50%);" id="array" class="resize"> 
<!--   <div class="swiper-pagination"></div>  --> 
</div>


<script>  

// scaleW=window.innerWidth/320;
// scaleH=window.innerHeight/480;
// var resizes = document.querySelectorAll('.resize');
//           for (var j=0; j<resizes.length; j++) {
//            resizes[j].style.width=parseInt(resizes[j].style.width)*scaleW+'px';
// 		   resizes[j].style.height=parseInt(resizes[j].style.height)*scaleH+'px';
// 		   resizes[j].style.top=parseInt(resizes[j].style.top)*scaleH+'px';
// 		   resizes[j].style.left=parseInt(resizes[j].style.left)*scaleW+'px'; 
//           }
    var oHtml=document.documentElement;
    getSize();
    function getSize(){

    var screenWidth=oHtml.clientWidth;
    oHtml.style.fontSize=screenWidth/9.38+'px'
    

    }

    window.onresize=function(){
        getSize();

    }
    getSize();   
var howLongTime;
var howMuchNum;
var pageFourNum1Num;
var pageFourNum2Num;
var allSalesNum;
var rankingNum;
var monthNum;
var allSales2Num;
var ranking2Num;
var month2Num;
var howManyPeoNum;
var thename;


 $.ajax({
            url:'<?php  echo $this->createPluginMobileUrl('commission/experience')?>',
            type: "post",
            async:false,
            cache: false,
            success: function (data) {
               var callBackStr = JSON.parse(data)
               var useful = callBackStr.result;
            //   console.log(useful.page1.nickname)
              thename = useful.page1.nickname;
              $('.costerNameInner').html(useful.page1.nickname)
              $('.myhead').attr('src',useful.page1.avatar);
              $('.intoTime').html(useful.page2.agenttime);
              howLongTime = useful.page2.agentday;

              $('#howLong').html(howLongTime)

              $('.firstOrder').html(useful.page3.paytime);
              $('.headPic').attr('src',useful.page3.thumb+'?imageView2/1/w/350/h/350');
              howMuchNum = useful.page3.order_price;
              $('#howMuch').html(howMuchNum) 

              if ( useful.page3.commissions == null) {
                $('.mayBeNone').remove();
                $('.ifNothing').show();
              };


              // $('.howMuchCommission').html(useful.page3.commissions+'元');
              pageFourNum1Num = Number(useful.page4.clickcount);
              pageFourNum2Num = useful.page4.customer_num;

               $('#pageFourNum1').html(pageFourNum1Num);
              $('#pageFourNum2').html(pageFourNum2Num);

              if( useful.page4.customer_pic == null){
                $('.pageFour .imgGround img').eq(0).show().attr('src', useful.page1.avatar).siblings('img').hide();
              }else{
                  var MyFour = useful.page4.customer_pic.length;
                    if (MyFour > 0) {
                      $.each(useful.page4.customer_pic, function(index,item){
                        $('.pageFour .imgGround img').eq(index).show().attr('src', item.avatar);
                      })
                    };
              }

            //   allSalesNum = parseFloat(useful.page5.ordersales);
            //   rankingNum = useful.page5.ordersales_ranking;
            //   monthNum = useful.page5.ordersales_mon;

            //   allSales2Num = parseFloat(useful.page6.commission);
            //   ranking2Num = useful.page6.commission_ranking;
            //   month2Num = useful.page6.commission_mon;
            //   howManyPeoNum = useful.page7.agentcount;
            //   var MyFour = useful.page7.agentids_img.length;
            //   // if (MyFour > 0) {
            //   //   $.each(useful.page7.agentids_img, function(index,item){
            //   //     $('.pageSeven .imghead').eq(index).show().attr('src', item);
            //   //   })
            //   // };
            howManyPeoNum = useful.page5.agentcount;
            $('#howManyPeo').html(howManyPeoNum);

              $('.pageSeven .imghead').eq(0).show().attr('src', useful.page1.avatar).siblings('img').hide();
              if( useful.page5.agentids_img == null){
                
              }else{
                  var MyFour = useful.page5.agentids_img.length;
                    if (MyFour > 0) {
                      $.each(useful.page5.agentids_img, function(index,item){
                        $('.pageSeven .imghead').eq(index).show().attr('src', item.avatar);
                      })
                    };
              }
              $('.ShopName').html(useful.page1.nickname);

              if (useful.is_shop == 1) {
                $('.otherShop').remove();
              }else{
                $('.myhistory').remove();
              };
              $('.theShopUrl').attr('href', useful.shopurl);
              $('.theOneHistory').attr('href', useful.experienceurl);

            }
        })



    var howLong      = document.getElementById('howLong');
    var howMuch      = document.getElementById('howMuch');
    var pageFourNum1 = document.getElementById('pageFourNum1');
    var pageFourNum2 = document.getElementById('pageFourNum2');
    var allSales     = document.getElementById('allSales');
    var ranking      = document.getElementById('ranking');
    var allSales2    = document.getElementById('allSales2');
    var ranking2     = document.getElementById('ranking2');
    var month2       = document.getElementById('month2');
    var howManyPeo   = document.getElementById('howManyPeo');

    // var myBtn = document.getElementById('myBtn');
    // var myBtn = document.getElementById('myBtn');

    var easeOutCubic = function(t, b, c, d) {
    var ts = (t /= d) * t;
    var tc = ts * t;
    return b + c * (1.77635683940025e-15 * tc * ts + 0.999999999999998 * tc + -3 * ts + 3 * t);
};
    var options = {
      easingFn: easeOutCubic
    };

  $('.share').click(function(event) {
    $('.shadowShare').show();

  });
  $('.shadowShare').click(function(event) {
    $('.shadowShare').hide();
  });;

		  
  var mySwiper = new Swiper ('.swiper-container', {
   direction : 'vertical',
   pagination: '.swiper-pagination',
  //virtualTranslate : true,
   mousewheelControl : true,
   onInit: function(swiper){
   swiperAnimateCache(swiper);
   swiperAnimate(swiper);
   console.log('123')
	  },
   onSlideChangeEnd: function(swiper){
	swiperAnimate(swiper);
  console.log(mySwiper.activeIndex)

  if (mySwiper.activeIndex == 1) {
    setTimeout(function(){
      var demo = new CountUp("howLong",0, howLongTime, 0, 1, options);    
          demo.start();
    }, 200)
  }else if(mySwiper.activeIndex == 2){
      setTimeout(function(){
      var demo = new CountUp("howMuch",0, howMuchNum, 2, 1, options);    
          demo.start();
    }, 400)
  }else if(mySwiper.activeIndex == 3){
      setTimeout(function(){
      var demo = new CountUp("pageFourNum1",0, pageFourNum1Num, 0, 1, options);    
      demo.start();

      var demo1 = new CountUp("pageFourNum2",0, pageFourNum2Num, 0, 1, options);    
      demo1.start();
    }, 200)
  }else if(mySwiper.activeIndex == 4){
    $('#array').show();
      setTimeout(function(){
      var demo = new CountUp("howManyPeo",0, howManyPeoNum, 0, 1, options);    
      demo.start();

    }, 400)
  }else if(mySwiper.activeIndex == 5){
    $('#array').hide();
  }

    },
	onTransitionEnd: function(swiper){
	swiperAnimate(swiper);

    },
	
	
	watchSlidesProgress: true,

      onProgress: function(swiper){
        for (var i = 0; i < swiper.slides.length; i++){
          var slide = swiper.slides[i];
          var progress = slide.progress;
          var translate = progress*swiper.height/4;  
		  scale = 1 - Math.min(Math.abs(progress * 0.5), 1);
          var opacity = 1 - Math.min(Math.abs(progress/2),0.5);
          slide.style.opacity = opacity;
		  es = slide.style;
		  es.webkitTransform = es.MsTransform = es.msTransform = es.MozTransform = es.OTransform = es.transform = 'translate3d(0,'+translate+'px,-'+translate+'px) scaleY(' + scale + ')';

        }
      },
	
	   onSetTransition: function(swiper, speed) {
        for (var i = 0; i < swiper.slides.length; i++){
          es = swiper.slides[i].style;
		      es.webkitTransitionDuration = es.MsTransitionDuration = es.msTransitionDuration = es.MozTransitionDuration = es.OTransitionDuration = es.transitionDuration = speed + 'ms';

        }
      },
	
	
	
	   })

  require(['http://res.wx.qq.com/open/js/jweixin-1.0.0.js'],function(wx){
                 window.shareData = <?php  echo json_encode($_W['shopshare'])?>;
  jssdkconfig = <?php  echo json_encode($_W['account']['jssdkconfig']);?> || { jsApiList:[] };
        <?php  if($trigger) { ?>
                window.shareData.trigger =function(e){
                    
                    require(['core'],function(core){
                        core.message('需要完善您的资料才能继续操作!',"<?php  echo $this->createMobileUrl('member/info',array('returnurl'=>urlencode($_W['siteurl'].$_SERVER['QUERY_STRING'])))?>",'warning');
                        return;
                    })   
                    wx.cancel();
                }
        <?php  } ?>
    jssdkconfig.debug = false;
  jssdkconfig.jsApiList = ['checkJsApi','hideMenuItems','onMenuShareTimeline','onMenuShareAppMessage','closeWindow'];
  wx.config(jssdkconfig);
  wx.ready(function () {
    wx.showOptionMenu();
var urlNow = window.location.href;
   wx.onMenuShareTimeline({
    title: thename+'喊你看Ta的2016窝在家战报！', // 分享标题
    link: urlNow, // 分享链接
    imgUrl: 'http://static.52wzj.com/PT04ot111rZ4N1zB4ar0WC1044RTC1.jpg', // 分享图标
    });

  wx.onMenuShareAppMessage({
    title: thename+'喊你看Ta的2016窝在家战报！', // 分享标题
    desc: '我的窝在家小店2016年终大盘点！！！', // 分享描述
    link: urlNow, // 分享链接
    imgUrl: 'http://static.52wzj.com/PT04ot111rZ4N1zB4ar0WC1044RTC1.jpg', // 分享图标
    type: '', // 分享类型,music、video或link，不填默认为link
    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空

});
    });
  
    });
  </script>
</body>
</html>
