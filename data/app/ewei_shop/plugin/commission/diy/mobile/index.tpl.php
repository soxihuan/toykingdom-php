<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>分销中心</title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; }
    a {text-decoration:none;}
/*     .topbar {height:40px; padding:10px; background:#fff;}
    .topbar .user_face {height:40px; width:40px; background:#ccc; float:left;}
    .topbar .user_face img {height:100%; width:100%;}
    .topbar .user_info {height:40px; width:auto; float:left; margin-left:12px;}
    .topbar .user_info .user_name {height:24px; width:100%; font-size:16px; line-height:24px; color:#666;}
       .topbar .user_info .user_name span { font-size:14px; color:#ff6600;}
    .topbar .user_info .user_date {height:14px; width:100%; font-size:14px; line-height:14px; color:#999;} */
    

    /* 修改的开始 */
    .topbar {height:2.5rem; padding-top:0.25rem; background:#fff;background:url();border-bottom:4px solid #F4D500;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-index-bg.png') no-repeat center center;background-size:cover;position:relative;}
    .topbar .user_face {height:2.25rem; width:2.25rem; background:#ccc; float:left;border-radius:50%;float:left;margin-left: 0.45rem;}
    .topbar .user_face img {height:100%; width:100%;border-radius:50%;}
    .topbar .user_info {float:left; margin-left:0.5rem;margin-top:0.3rem;width:6rem;}
    .topbar .user_info .user_name {float:left;height:0.625rem; width:100%; font-size:0.45rem; line-height:0.625rem; color:#373737;}
    .topbar .user_info .user_name .myShopNanme{float:left;line-height:0.75rem;max-width: 3.15rem;white-space:nowrap; overflow:hidden; text-overflow:ellipsis;}
    .topbar .user_info .user_name  span { display:inline-block;height:0.4rem;line-height:0.4rem;padding:0 0.2rem;color:#fff;font-size:0.3rem;background-color:#FFB84D;border-radius:0.05rem;margin-left:0.2rem;}
    .topbar .user_info .user_date {height:0.425rem; width:100%; font-size:0.3rem; line-height:0.45rem; color:#373737;}
    .setsomething {position:absolute;right:0.25rem;top:1rem;height:0.5rem;width:0.5rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-setting.png') no-repeat center center;background-size:contain;}
    /* 修改的结束 */
    




  /*   .top {height:180px;padding:5px; background:#cc3431;}
    .top .top_1 {height:114px; width:100%;}
    .top .top_1 .text {height:114px; width:auto; float:left; color:#fff; line-height:50px; font-size:14px; color:#fff;}
    .top .top_1 .ico {height:40px; width:30px; background:url(../addons/ewei_shop/plugin/commission/template/mobile/default/static/images/gold_ico2.png) 0px 10px no-repeat; margin-bottom:74px; float:right;}
    .top .top_2 {height:66px; width:100%; font-size:40px; line-height:66px; color:#fff;}
    .top .top_2 span {height:32px; color:#fff; width:auto; border:1px solid #fff; font-size:14px; line-height:32px; margin-top:17px; padding:0px 15px;  float:right; border-radius:5px;}
    .top .top_2 .disabled { color:#999;border:1px solid #999;} */
   
    /* 修改的开始 */
.top{height:3.75rem;background:#fff;padding:0 0.2rem;margin-top:0.2rem;position:relative;border-top:1px solid #E5E4E4;border-bottom:1px solid #E5E4E4;}
.top .ThisIstitle-index{border-bottom:1px solid #E0E0E0;height:28px;line-height:28px;margin:0;font-size:0.35rem;color:#373737;}
.top_1 {overflow:hidden;position: absolute;left:1.1rem;top:1.4rem;}
.top_1 .howMuchiHaveIcon{display:inline-block;height:1.4rem;width:1.4rem;float:left;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-commission.png') no-repeat center center;background-size:contain;}
.top_1 .text{float:left;width:2.5rem;margin-left:0.2rem;}
.top_1 .text span{display:block;}
.top_1 .text span:first-child{color:#FF0000;height:0.625rem;line-height:0.625rem;font-size:0.45rem;padding-top:0.2rem;}
.top_1 .text span:first-child b{font-size:0.3rem;}
.top_1 .text span:last-child{color:#373737;height:0.35rem;line-height:0.35rem;font-size:0.3rem;}

.top_2{overflow:hidden;position:absolute;left:6.5rem;top:1.15rem;}
.top_2 .howMuchiCanIcon{display:inline-block;height:0.8rem;width:0.8rem;float:left;background:url('../addons/ewei_shop/template/mobile/default/static/images/pushmymoney.png') no-repeat center center;background-size:contain;}
.top_2 .canPostal{float:left;}
.top_2 .canPostal{float:left;width:1.7rem;margin-left:0.2rem;}
.top_2 .canPostal span{display:block;}
.top_2 .canPostal span:first-child{color:#FF0000;height:0.5rem;line-height:0.5rem;font-size:0.35rem;}
.top_2 .canPostal span:first-child b{font-size:0.3rem;font-weight:normal;}
.top_2 .canPostal span:last-child{color:#373737;height:0.35rem;line-height:0.35rem;font-size:0.25rem;transform: scale(0.9) translateX(-5px);}

.top_3{overflow:hidden;position:absolute;left:6.5rem;bottom:0.3rem;}
.top_3 .shopbirthday{display:inline-block;height:0.8rem;width:0.8rem;float:left;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-birthday.png') no-repeat center center;background-size:contain;}
.top_3 .longday{float:left;}
.top_3 .longday{float:left;width:1.7rem;margin-left:0.2rem;}
.top_3 .longday span{display:block;color:#373737;}
.top_3 .longday span:first-child{height:0.5rem;line-height:0.5rem;font-size:0.35rem;}
.top_3 .longday span:first-child b{font-size:0.3rem;font-weight:normal;}
.top_3 .longday span:last-child{color:#373737;height:0.35rem;line-height:0.35rem;font-size:0.25rem;transform: scale(0.9) translateX(-5px);}


    /* 修改的结束 */
/* .menu {overflow:hidden; background:#fff;}
.menu .nav { width:33%; float:left;padding-top:10px;padding-bottom:10px;}

.menu .nav .title {height:24px; width:100%; text-align:center; font-size:14px; color:#666;}
.menu .nav .con {height:20px; width:100%; text-align:center; font-size:12px; color:#999;}
.menu .nav .con span {color:#f90;}
.menu .nav1 {border-bottom:1px solid #f1f1f1; border-right:1px solid #f1f1f1;  text-align:center; } 
.menu .nav1 i { color:#ff9901;}
.menu .nav2 {border-bottom:1px solid #f1f1f1; border-right:1px solid #f1f1f1;text-align:center;} 
.menu .nav2 i { color:#98cd37;}
.menu .nav3 {border-bottom:1px solid #f1f1f1;text-align:center; } 
.menu .nav3 i { color:#ffcb05;} 
.menu .nav4 {border-right:1px solid #f1f1f1; text-align:center;} 
.menu .nav4 i { color:#ca81d1;}
.menu .nav5 {border-right:1px solid #f1f1f1; text-align:center;} 
.menu .nav5 i { color:#53bdec;}
.menu .nav6 {border-bottom:1px solid #f1f1f1; text-align:center;} 
.menu .nav6 i { color:#aadaf6;} */
    /* 修改的开始 */
.menu {border-bottom:1px solid #E5E4E4;margin-top:0.2rem;background:#fff;overflow:hidden;border-top:1px solid #E5E4E4;}

.menu a{display:inline-block;width:33.3%;box-sizing: border-box;float:left;text-decoration:none;color:#373737;border-bottom:1px solid #E5E4E4;border-right:1px solid  #E5E4E4;font-size:0;}
.menu a:nth-child(3){border-right:none;}
.menu a:nth-child(6){border-right:none;}
.menu a:nth-child(7){border-bottom:none;}
.menu a:nth-child(8){border-bottom:none;}
.menu a div.nav{height:2.75rem;}
.menu a div .title{font-size:0.35rem;margin-top:0.25rem;text-align:center;color:#373737;}
.menu a div .con{font-size:0.35rem;color:#999;text-align:center;}
.menu a:nth-child(1) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -8rem 0;background-size:9rem;}
.menu a:nth-child(2) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -7rem 0;background-size:9rem;}
/* .menu a:nth-child(3) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -2rem 0;background-size:9rem;} */
.menu a:nth-child(3) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -1rem 0;background-size:9rem;}
.menu a:nth-child(4) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -2rem 0;background-size:9rem;}
.menu a:nth-child(5) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat 0 0;background-size:9rem;}  
/* .menu a:nth-child(7) i{display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-merchandise.png') no-repeat center center;background-size:contain;} */
.menu a:nth-child(6) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -5rem 0;background-size:9rem;}

.menu a:nth-child(7) i {display:block;width:1rem;height:1rem;margin:0.35rem auto 0.25rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myshop-sprite.png') no-repeat -6rem 0;background-size:9rem;}
 
    /* 修改的结束 */
 .historyInTO{width: 2.825rem;height: 0.575rem;background:url('../addons/ewei_shop/plugin/commission/template/mobile/diy/tiger/images/Rectangle.png') no-repeat right center;background-size:contain;font-size: 0.3rem;color: #222121;line-height: 0.575rem;text-align: center;z-index: 99;white-space: nowrap;position: absolute;right: 0;bottom: 0.4rem;}
</style>
<script>
    var oHtml=document.documentElement;
    getSize();
    function getSize(){

    var screenWidth=oHtml.clientWidth;
    oHtml.style.fontSize=screenWidth/9.38+'px';
    

    }

    window.onresize=function(){
        getSize();

    }
    getSize();

</script>
<div id='container'></div>

<script id='tpl_main' type='text/html'>
    <div class="topbar">
        <div class="user_face"><img src="<%member.avatar%>"></div>
        <div class="user_info">
            <div class="user_name" <%if set.levelurl!=''%>onclick='location.href="<%set.levelurl%>"' <%/if%>> <div class="myShopNanme"> <%member.nickname%> </div><span>[<%if level%><%level.levelname%><%else%>
                    <%if set.levelname!=''%><%set.levelname%><%else%>普通等级<%/if%>
                    <%/if%>] 
                    <%if set.levelurl!=''%><i class='fa fa-question-circle' ></i></span><%/if%>
            </div>

            <div class="user_date">入住时间：<%member.agenttime%></div>
        </div>
    <a href="<?php  echo $this->createPluginMobileUrl('commission/experience',array("mid" => $_GPC['mid']))?>" class="historyInTO">小店年终盘点 ></a> 
    <!--     <div class="setsomething"></div> -->
    </div> 

   <div class="top">
        <h3 class="ThisIstitle-index">成长日记</h3>
        <div class="top_1">
            <div class="howMuchiHaveIcon"></div>
            <div class="text"><span><%member.commission_total%><b>元</b></span><span>累计佣金</span><!-- <br>可提现佣金（元） --></div>
        </div>

    <!--     <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="ico">搜索时</div></a> -->

        <div class="top_2">
            <div class="howMuchiCanIcon"></div>
            <div class="canPostal"><span><%member.commission_ok%><b>元</b></span><span>可提现佣金</span></div>
        </div>

        <div class="top_3">
            <div class="shopbirthday"></div>
            <div class="longday"><span><%member.elapseddate%><b>天</b></span><span>小店生日</span></div>
        </div>

   

    </div>  
    <div class="menu">
<!--         提现模块从上方移下来 -->   
<!--         <a <%if commission_ok<=0 || commission_ok< set.withdraw%>href="javascript:;"<%else%>href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>"<%/if%> id='withdraw' ><span <%if commission_ok<=0 || commission_ok< set.withdraw%>class='disabled'<%/if%> >提现</span></a> -->

        <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="nav nav1"><i class="btn-icon"></i><div class="title">佣金提现</div><div class="con"><span><%member.commission_total%></span>元</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/team')?>"><div class="nav nav2"><i class="btn-icon"></i><div class="title">我的团队</div><div class="con"><span><%member.agentcount%></span>个成员</div></div></a>

       <!--  <a href=""><div class="nav nav3"><i class="btn-icon"></i><div class="title">我的导师</div><div class="con"><span></span>导师</div></div></a> -->
        
     

        <a href="<?php  echo $this->createPluginMobileUrl('commission/order')?>"><div class="nav nav5"><i class="btn-icon"></i><div class="title">分销订单</div><div class="con"><span><%member.ordercount0%></span>个订单</div></div></a>

        <a href="<?php  echo $this->createPluginMobileUrl('commission/teacher')?>"><div class="nav nav3"><i class="btn-icon"></i><div class="title">我的导师</div><div class="con"><span></span>导师</div></div></a>
  

        <a href="<?php  echo $this->createPluginMobileUrl('commission/customer')?>"><div class="nav nav6"><i class="btn-icon"></i><div class="title">我的客户</div><div class="con">客户</div></div></a>

<!--         <a href=""><div class="nav nav6"><i class="btn-icon"></i><div class="title">自选商品</div><div class="con">商品</div></div></a> -->
        <a href="<?php  echo $this->createPluginMobileUrl('commission/inviteshares')?>"><div class="nav nav4"><i class="btn-icon"></i><div class="title">邀请开店</div><div class="con">推广二维码</div></div></a>

        <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>"><div class="nav nav5"><i class="btn-icon"></i><div class="title">分享店铺</div><div class="con">推广店铺</div></div></a>

       <!--  <a href="<?php  echo $this->createPluginMobileUrl('commission/withdraw')?>"><div class="nav nav1"><i class="btn-icon"></i><div class="title">分销佣金</div><div class="con"><span><%member.commission_total%></span>元</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/team')?>"><div class="nav nav2"><i class="btn-icon"></i><div class="title">我的团队</div><div class="con"><span><%member.agentcount%></span>个成员</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/order')?>"><div class="nav nav3"><i class="btn-icon"></i><div class="title">分销订单</div><div class="con"><span><%member.ordercount0%></span>个订单</div></div></a>
        
        <a href="<?php  echo $this->createPluginMobileUrl('commission/log')?>"><div class="nav nav4"><i class="btn-icon"></i><div class="title">佣金明细</div><div class="con">佣金提现明细</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>"><div class="nav nav5"><i class="btn-icon"></i><div class="title">二维码</div><div class="con">推广二维码</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/set')?>"><div class="nav nav6"><i class="btn-icon"></i><div class="title">小店设置</div><div class="con">设置我的小店</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/shares')?>"><div class="nav nav5"><i class="btn-icon"></i><div class="title">二维码</div><div class="con">推广二维码</div></div></a>
        <a href="<?php  echo $this->createPluginMobileUrl('commission/myshop/set')?>"><div class="nav nav6"><i class="btn-icon"></i><div class="title">小店设置</div><div class="con">设置我的小店</div></div></a> -->
    </div>
</script>
 
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        
        core.pjson('commission',{},function(json){
            var result = json.result;   
            $('#container').html(  tpl('tpl_main',result) );
            $('#withdraw').click(function(){
                if(!json.result.cansettle){
                     if(json.result.settlemoney>0){
                     core.tip.show('需到'+json.result.settlemoney+'元才能申请提现!');    
                     }else{
                        core.tip.show('无可提佣金!');        
                     }
                }
            });
        },true);
        
        
    })
</script>
<?php  $show_footer=true;$footer_current ='commission'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
