<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $shop['name'];?></title>
<style type="text/css">
body {margin:0px; width:100%;background:#f4f4f4; font-family:'微软雅黑';}

.top {overflow:hidden;border-bottom:1px solid #ddd;height:2.7rem;/* background:url('../addons/ewei_shop/template/mobile/default/static/images/background-myshop.png') no-repeat center center;background-size:cover; */position:relative;border-bottom:2px solid #F4D500;}
.top img {height:2.7rem;width:100%; position: absolute;left:0;top:0;}
.top .shopimg {height:2.25rem; width:2.25rem;position:absolute; left:0.3rem; top:0.25rem;z-index:2;}
.top .shopimg img {height:2.25rem; width:2.25rem;}
.top .shopname {line-height:0.625rem; width:auto; position:absolute; left:2.95rem; top:0.25rem;font-size:0.45rem; color:#222121; text-shadow:2px 2px 2px rgba(0,0,0,0.2);z-index:2;}
.top .set {height:0.5rem; width:0.5rem; position:absolute; top:0.35rem; right:0.35rem;color:#fff; text-align:center;z-index:2;}
.top .set i{display:block;height:100%;width:100%;background:url('../addons/ewei_shop/template/mobile/default/static/images/my-shop-icon-setting.png')no-repeat center center;background-size:contain;}
.whitespace{background:rgba(255, 255, 255,.8);position:absolute;height:100%;width:100%;left:0;top:0;z-index:1;}
.top .nav {height:1rem; text-align:center;width:6.75rem;position:absolute;right:0;bottom:0.24rem;z-index:2;}
.top .nav .sub {height:1rem; width:33%; border-right:1px solid #ddd; float:right;font-size:0;box-sizing: border-box;}
.top .nav .sub:nth-child(3) span{font-size:0.35rem;color:#e60011;display:inline-block;height:0.55rem;}
.top .nav .sub:first-child{border-right:none;}
.top .nav .sub span {font-size:18px; color:#000; line-height:22px;}
.top .nav .sub nav {font-size:0.4rem; color:#222121;height:0.55rem;}
.myYellowStar{height:0.47rem;width:0.47rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/collection-myshop.png') no-repeat center center;background-size:contain;display:inline-block;}
.myErMark{height:0.47rem;width:0.47rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/myErMark.png') no-repeat center center;background-size:contain;display:inline-block;}

.topnav{width:100%;height:4.5rem;}
.topnav .swiper-slide a {display:block;height:100%;width:100%;}
.topnav .swiper-slide a img{width:100%;height:100%;}

.second{width:100%;height:4.5rem;}
.second .swiper-slide a {display:block;height:100%;width:100%;}
.second .swiper-slide a img{width:100%;height:100%;}



.second-kill{background:#fff;padding-top:0.2rem;padding-bottom:0.2rem;margin:0.25rem 0;}
.second-kill p{line-height:0.5rem;font-size:0.35rem;color:#222121;margin: 0;text-align:center;}
.second-kill p span{color:#e60011;}
.second-kill-title{background:url('../addons/ewei_shop/template/mobile/default/static/images/Group-line.png') no-repeat center center ;background-size:8rem;position:relative;height:0.75rem;line-height:0.75rem;}
.second-kill-title span{font-size:0.5rem;padding:;color:#222121;padding:0 0.4rem;background:#fff;position:absolute;left:50%;transform: translatex(-50%);-webkit-transform: translatex(-50%);white-space: nowrap;}
.second-kill-title span::before{
    content:'';
    display:block;
    position:absolute;
    height:0.2rem;
    width:0.2rem;
    background:url('../addons/ewei_shop/template/mobile/default/static/images/Fill.png') no-repeat center center;
    background-size:contain;
    left:0.1rem;
    top:50%;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);

}
.second-kill-title span::after{
    content:'';
    display:block;
    position:absolute;
    height:0.2rem;
    width:0.2rem;
    background:url('../addons/ewei_shop/template/mobile/default/static/images/Fill.png') no-repeat center center;
    background-size:contain;
    right:0.1rem;
    top:50%;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
}

.goods {height:auto; min-height:100px; width:100%; overflow:hidden;} 
.goods .good {overflow:hidden; width:4.4rem; float:left;margin-left:0.2rem;margin-top:0.2rem;height:6.4rem;background:#fff; }
.goods .good:nth-child(1){margin-top:0;}
.goods .good:nth-child(2){margin-top:0;}
.goods .good .img {width:100%;overflow:hidden;}
.goods .good .img img {width:100%;}
.goods .good .name {font-size: 0.3rem;padding:0.1rem 0.22rem;line-height: 0.45rem;overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;
-webkit-box-orient: vertical;margin-top:0.12rem;}

.goods .good .price {height:0.5rem; width:100%; color:#e60011; font-size:0.45rem;padding-left:0.1rem;}
.goods .good .price span {color:#aaa; font-size:12px; text-decoration:line-through;margin-left:0.2rem;}
 
.banner {overflow:hidden;position:relative;height:auto;}
.banner  .main_image{width:100%;position:relative;top:0;left:0;}
.banner .main_image ul{;position:absolute;top:0;left:0;}
.banner .main_image li{float:left;}
.banner .main_image li img{display:block;width:100%;}
.banner .main_image li a{display:block;width:100%;}

div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
div.flicking_con .inner { width:100%;height:9px;text-align:center;}
div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/ewei_shop/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-1000px;}
div.flicking_con a.on{background-position:0 -9px;}
#index_loading { width:94%;padding:10px;color:#666;text-align: center;float:left;}

.search {height:0.85rem;margin:0.25rem 0.325rem; background:#fff; color:#999; line-height:0.85rem; font-size:0.35rem; text-align:center;position:relative;border-radius:0.125rem;}
.search .zoommyshop{display:inline-block;height:0.5rem;width:0.5rem;background:url('../addons/ewei_shop/template/mobile/default/static/images/list-search.png') no-repeat center center;background-size:contain;position:absolute;left:2.6rem;top:50%;transform:translatey(-50%);-webkit-transform:translatey(-50%);}
.title {height:40px; width:94%; background:#fff; padding:0px 3%; font-size:16px; color:#666; line-height:40px;}
.copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999;}

#goods_container{overflow:hidden;}
#goods_new_list{overflow:hidden;}

.others{padding:0 0.25rem;overflow:hidden;}
.others div{height:2.75rem;width:4.3rem;margin-top:0.25rem;}
.others div:nth-child(1){margin-top:0;}
.others div:nth-child(2){margin-top:0;}
.others div a{display:block;height:100%;width:100%;}
.others div a img{height:100%;width:100%;}


.topnav-b span{border:1px solid #222121;height:0.125rem;width:0.125rem;}
.topnav-b span.swiper-pagination-bullet-active{background:#F4D500;}

.iwannashop{display:block;width:100%;height:1.1rem;line-height:1.1rem;background:#F4D500;font-size:0.4rem;color:#222121;text-align:center;margin-top:0.2rem;text-decoration:none;}
.SecKill{width:100%;height:4.5rem;margin-top:0.25rem;}
.SecKill a{display:block;height:100%;}
.SecKill a img {width:100%;height:100%;}

.sales-promotion{width:100%;height:4.5rem;margin-top:0.25rem;}
.sales-promotion a{display:block;height:100%;}
.sales-promotion a img {width:100%;height:100%;}

.SecondOfPlate{width:100%;height:4.5rem;margin-top:0.25rem;}
.SecondOfPlate a{display:block;height:100%;}
.SecondOfPlate a img {width:100%;height:100%;}
.myGoTopBtn{height: 32px;width: 32px;background:url('../addons/ewei_shop/template/mobile/default/static/images/goTop.png') no-repeat center center;background-size:contain;position: fixed;z-index: 999;right: 18px;bottom:76px;}
</style>
<div id="container"></div>

<script>
    var oHtml=document.documentElement;
    getSize();
    function getSize(){
    //获取屏幕宽度
    var screenWidth=oHtml.clientWidth;
    oHtml.style.fontSize=screenWidth/9.38+'px'
    

    }
    //当窗口宽度被改变时调用这个函数
    window.onresize=function(){
        getSize();

    }
    getSize();

</script>

<script id="tpl_main" type="text/html">
 
<div class="top">

        <img class="bgImg" src="<%shop.img%>" > 
        <!-- 头像 -->
        <div class="shopimg"><img src="<%shop.logo%>"></div>
        <div class="whitespace" style="display:none;"></div>
        <div class="shopname"><%shop.name%></div>
        <!-- 设置 -->
        <%if isme%><div class="set" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'set'))?>'"><i></i></div><%/if%>

    <div class="nav">
        <div class="sub" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/shares')?>'">
              <span><i class="myErMark"></i></span>
            <nav >二维码</nav>
        </div>
        <div class="sub" id='fav'>
            <span><i class="myYellowStar"></i></span>
            <nav>收藏本店</nav>
        </div>
<!--         <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/category')?>'">
            <span><i class="fa fa-list-ul"></i></span>
            <nav>全部分类</nav>
        </div> -->
        <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/list')?>'">
            <span><%goodscount%></span>
            <nav>全部商品</nav>
        </div>
    </div>
</div>
    
    <div class='search'><i class="zoommyshop"></i> 在店铺内搜索</div>
<!--     <%if advs.length>0%>
    <div class="banner">

        <%if advs.length>1%>
        <div class="flicking_con"><div class="inner">
            <%each advs as value index %>
            <a class="<%if index==0%>on<%/if%>" href="#@"><%index%></a>
            <%/each%>
            </div>
        </div>
        <%/if%>
        <div class="main_image">
            <ul>
                <%each advs as adv %>
                <li <%if adv.link%>onclick="location.href='<%adv.link%>'"<%/if%>> <img src="<%adv.thumb%>"></li>
                <%/each%>
            </ul>
        </div>
    </div>
    <%/if%> -->

        <!-- 轮播图开始 -->
    <div class="swiper-container topnav">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&do=shop&m=ewei_shop&p=list&isdiscount=1"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160816banner.jpg" alt=""></a></div>
            <div class="swiper-slide"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&ccate=76&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/project-banner1.jpg" alt=""></a></div>
            <div class="swiper-slide"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=136&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/project-banner2.jpg" alt=""></a></div>
<!--             <div class="swiper-slide"><a href=""><img src="../addons/ewei_shop/template/mobile/default/static/images/list-search.png" alt=""></a></div>
            <div class="swiper-slide"><a href=""><img src="../addons/ewei_shop/template/mobile/default/static/images/list-search.png" alt=""></a></div> -->
     
        </div>
        <div class="swiper-pagination topnav-b"></div>
 

    </div>
    <!-- 轮播图结束 -->  




<div class="second-kill">
    <div class="second-kill-title"><span>每日秒杀</span></div>
    <p>每天<span>10:00</span>&nbsp;&nbsp;<span>20:00</span>两个时间段 准时开秒</p>
</div>
<div class="SecKill"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=963&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160822kill01.jpg" alt=""></a></div>
<div class="SecKill"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=700&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160822kill02.jpg" alt=""></a></div>
<div class="SecKill"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=631&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160823kill03.jpg" alt=""></a></div>



<!-- 第二件半价 -->
<div class="second-kill">
    <div class="second-kill-title"><span>第二件半价&nbsp;&nbsp;任性狂欢</span></div>
    <p>这些东西一定要2件一起买</p>
</div>

<div class="SecondOfPlate"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=718&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/201608015secondprice01.jpg" alt=""></a></div>
<div class="SecondOfPlate"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=809&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160808secondprice2.jpg" alt=""></a></div>
<div class="SecondOfPlate"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=722&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/201608015secondprice03.jpg" alt=""></a></div>








<!-- 买就送 -->
<div class="second-kill">
    <div class="second-kill-title"><span>你敢买，我敢送</span></div>
    <p>一般般的福利我们是不会发的！</p>
</div>

<div class="sales-promotion"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=928&do=shop&m=ewei_shop
"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160815buyAndFree01.jpg" alt=""></a></div>
<div class="sales-promotion"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=892&do=shop&m=ewei_shop
"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160822buyAndFree02.jpg" alt=""></a></div>
<div class="sales-promotion"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=764&do=shop&m=ewei_shop
"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160815buyAndFree03.jpg" alt=""></a></div>
<div class="sales-promotion"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=565&do=shop&m=ewei_shop
"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160819buyAndFree04.jpg" alt=""></a></div>
<div class="sales-promotion"><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=detail&id=554&do=shop&m=ewei_shop
"><img src="../addons/ewei_shop/template/mobile/default/static/images/20160823buyAndFree05.jpg" alt=""></a></div>




<div class="second-kill">
    <div class="second-kill-title"><span>场景导航</span></div>
</div>
<div class="others">
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=74&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-1.jpg" alt=""></a></div> 
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=93&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-2.jpg" alt=""></a></div>
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=62&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-3.jpg" alt=""></a></div>
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=81&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-4.jpg" alt=""></a></div>
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=133&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-5.jpg" alt=""></a></div> 
     <div><a href="http://wechat.52wzj.com/app/index.php?i=4&c=entry&p=list&pcate=141&do=shop&m=ewei_shop"><img src="../addons/ewei_shop/template/mobile/default/static/images/Group-6.jpg" alt=""></a></div>  
 </div>

<div class="second-kill">
    <div class="second-kill-title"><span>进店必败</span></div>
</div>

<div class="goods">
    <div id='goods_container'></div>
</div>

<div class="second-kill">
    <div class="second-kill-title"><span>本周新品特惠</span></div>

</div>
<div class="goods">
    <div id='goods_new_list'></div>
</div>



<a href="<?php  echo $this->footer['commission']['url']?>" class="iwannashop">我也要开店</a>

    <div class="copyright">版权所有 © <%if set.copyright%><%set.copyright%><%else%><?php  echo $_W['account']['name'];?><%/if%></div>
<div class="myGoTopBtn"></div>  
     <!--搜索-->
    <div class="search1">
                <div class="topbar1">
                    <div class='right'>
                        <button class="sub1"><i class="fa fa-search"></i></button>
                        <div class="home1">取消</div>
                    </div>
                    <div class='left_wrap'>
                        <div class='left'>
                            <input type="text" id='keywords' class="input1" placeholder='搜索: 输入商品关键词'/>
                        </div>
                    </div>
                </div>
                <div id='search_container' class='result1'>
        </div>
        
</script>
 
<script id='tpl_goods_list' type='text/html'>

    <%each goods as g%>
    <div class="good" data-goodsid='<%g.id%>'>
        <div class='img'><img src="<%g.thumb%>?imageView2/1/w/350/h/350"></div>
        
        <div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>
        <div class="name"><%g.title%></div>
    </div>
    <%/each%>

</script>

<script id='tpl_goods_new' type='text/html'>

    <%each goods as g%>
    <div class="good" data-goodsid='<%g.id%>'>
        <div class='img'><img src="<%g.thumb%>?imageView2/1/w/350/h/350"></div>
        <div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>
        <div class="name"><%g.title%></div>
    </div>
    <%/each%>

</script>


 <script id='tpl_search_list' type='text/html'>
     <ul>
     <%each list as value%>
        <li><i class="fa fa-angle-right"></i> <a href="<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.id%>"><%value.title%></a></li>
        <%/each%>
    </ul> 
</script>
<div id='cover'><img src='../addons/ewei_shop/plugin/commission/images/favorite.png' style='width:100%;' /></div>
<script language="javascript">
    var page = 1;  var loaded = false;
    var stop = true;
    require(['tpl', 'core','jquery.touchslider','swipe'], function(tpl, core) {
         function getGoods(type) {

                core.pjson('commission/myshop', {'op': 'goods', page: page,mid:"<?php  echo $_GPC['mid'];?>"}, function (gjson) {
                    var result = gjson.result;
                    if (result.status == 0) {
                        core.message('服务器内部错误', core.getUrl('commission/myshop'), 'error');
                        return;
                    }
            
                       $('#fav').click(function(){
                            $('#cover').fadeIn(200).unbind('click').click(function(){
                                $(this).fadeOut(100);
                            })
                        });

                    stop = true;
                    $('#index_loading').remove();
                    $('#goods_container').append(tpl('tpl_goods_list', result));

                   // $(window).scrollTop(sessionStorage.myshopHomeTop)
                    $('.good img').each(function(){
                            $(this).height($(this).width());
                    })

                        $('.good').unbind('click').click(function(){
                            location.href = core.getUrl('shop/detail',{id:$(this).data('goodsid') });
                        })
                    if (result.goods.length < result.pagesize) {

                        // $('#goods_container').append('<div id="index_loading">已经加载全部商品</div>');
                        loaded = true;
                        $(window).scroll = null;
                        return;
                    }
 
                  
                });
                
                core.pjson('commission/myshop', {'op': 'goods_new', page: page,mid:"<?php  echo $_GPC['mid'];?>"}, function (gjson) {
                    var result = gjson.result;
                    if (result.status == 0) {
                        core.message('服务器内部错误', core.getUrl('commission/myshop'), 'error');
                        return;
                    }
                    $('#goods_new_list').append(tpl('tpl_goods_new', result));
        
                

                    $('.good img').each(function(){
                            $(this).height($(this).width());
                    })

                        $('.good').unbind('click').click(function(){
                            location.href = core.getUrl('shop/detail',{id:$(this).data('goodsid') });
                    })
                //         alert(222)
     
                       
                });
            }


        core.pjson('commission/myshop',{mid:"<?php  echo $_GPC['mid'];?>"},function(json){
            var result = json.result;   
        
                    $('#container').html(  tpl('tpl_main',result) );
                 
             var swiper = new Swiper('.topnav', {
                    pagination: '.topnav-b',
                    paginationClickable: true,
                    spaceBetween: 30,
                    centeredSlides: true,
                    autoplay: 7000,
                    autoplayDisableOnInteraction: true
                });

        // var swiper = new Swiper('.second', {
        //     pagination: '.second-b',
        //     paginationClickable: true,
        //     spaceBetween: 30,
        //     centeredSlides: true,
        //     autoplay: 7000,
        //     autoplayDisableOnInteraction: true
        // });

        $('.others div').each(function(index, el) {
            if (index%2 == 0) {
                $(this).css('float', 'left');
            }else{
                $(this).css('float', 'right');
            }
        });

                // 点击返回页面顶部
        $('.myGoTopBtn').click(function(){
            $('html,body').animate({'scrollTop': 0}, 250)
        })



        $('.others div a').each(function(index, el) {
            var originalHref = $(this).attr('href');
            $(this).attr('href', originalHref+truemid);
        });

        $('.topnav .swiper-wrapper .swiper-slide').each(function(index, el) {
           var originalHrefbanner = $(this).find('a').attr('href');
            $(this).find('a').attr('href', originalHrefbanner+truemid);
        });

        $('.SecKill').each(function(index, el) {
           var originalHrefkill = $(this).find('a').attr('href');
            $(this).find('a').attr('href', originalHrefkill+truemid);
        })
         $('.sales-promotion').each(function(index, el) {
           var originalHrefpromotion = $(this).find('a').attr('href');
            $(this).find('a').attr('href', originalHrefpromotion+truemid);
        })
        $('.SecondOfPlate').each(function(index, el) {
           var originalHrefPlate = $(this).find('a').attr('href');
            $(this).find('a').attr('href', originalHrefPlate+truemid);
        })




    // 将跳转发生时的    
      window.onunload = function(){
        var mysrcoll;
        mysrcoll = $(window).scrollTop()
        sessionStorage.myshopHomeTop=mysrcoll;
    }


        // console.log(truemid)
          //            if( result.advs.length>0) {
  //                   $('.banner').height($('.main_image').find('img').height());
  //                   new Swipe($('.main_image')[0], {
		// 	speed:300,
		// 	auto:4000,
		// 	callback: function(){
			  
  //                                $(".flicking_con  .inner  a").removeClass("on").eq(this.index).addClass("on");
		// }
	 //  });
                
  //}
                $('.search').click(function(){
 
                          $(".search1").animate({bottom:"0px"},100);
                          $('#keywords').unbind('keyup').keyup(function(){
                                   var keywords = $.trim( $(this).val());
                                   if(keywords==''){
                                       $('#search_container').html("");         
                                       return;
                                   }
                                   core.json('shop/util',{op:'search',keywords:keywords }, function (json) {
                                        var result = json.result;
                                        if(result.list.length>0){
                                           $('#search_container').html(tpl('tpl_search_list',result));    
                                        }
                                        else{
                                           $('#search_container').html("");         
                                        }

                                     }, true);
                           });
                           $('.search1 .sub1').unbind('click').click(function(){
                                   var keywords = $.trim( $('#keywords').val());
                                   var url = core.getUrl('shop/list',{keywords:keywords});
                                   location.href=  url;
                            });
                           $('.search1 .home1').unbind('click').click(function(){
                                $(".search1").animate({bottom:"-100%"},100);
                           });
                       });
        
            //获取首页商品
            getGoods();
            
        $(window).ajaxStop(function(){
           $(window).scrollTop(sessionStorage.myshopHomeTop)
        });

        },true);  
        
    })

</script>
<?php  $show_footer=true;$footer_current ='first'?> 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>