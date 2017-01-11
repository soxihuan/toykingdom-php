<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  echo $shop['name'];?></title>
<style type="text/css">
body {margin:0px; width:100%;background:#f4f4f4; font-family:'微软雅黑';}

.top {overflow:hidden; background:#fff; border-bottom:1px solid #ddd;}
.top .bgimg {height:150px; position:relative;}
.top .bgimg img {height:150px;width:100%; position: relative; }
.top .bgimg .shopimg {height:66px; width:66px; background:#ccc; position:absolute; left:10px; bottom:-35px; border:1px solid #fff; box-shadow:0px 0px 2px rgba(0,0,0,0.1); }
.top .bgimg .shopimg img {height:66px; width:66px;}
.top .bgimg .shopname {height:40px; width:auto; position:absolute; left:90px; bottom:0px; font-size:16px; line-height:40px; font-size:18px; color:#fff; text-shadow:2px 2px 2px rgba(0,0,0,0.2);}
.top .bgimg .set {height:24px; width:24px; position:absolute; top:10px; right:10px; font-size:24px; color:#fff; text-align:center; line-height:24px;}
.top .nav {height:40px; padding:0px 0px 5px 100px; text-align:center;}
.top .nav .sub {height:40px; width:23%; border-left:1px solid #ddd; float:right;}
.top .nav .sub span {font-size:18px; color:#000; line-height:22px;}
.top .nav .sub nav {font-size:12px; color:#999;}

    .goods {height:auto; min-height:100px; width:100%; background:#fff; overflow:hidden;float:left;padding-bottom:40px;} 
    .goods .good {overflow:hidden; width:46%; padding:0px 2% 10px; float:left;}
    .goods .good .img {width:100%;overflow:hidden;}
    .goods .good .img img {width:100%;}
    .goods .good .name {height:20px; width:100%; font-size:15px; line-height:20px; color:#666; overflow:hidden;}
    .goods .good .price {height:20px; width:100%; color:#f03; font-size:14px;}
    .goods .good .price span {color:#aaa; font-size:12px; text-decoration:line-through;}
    
      .banner {overflow:hidden;position:relative;height:auto;}
     .banner  .main_image{width:100%;position:relative;top:0;left:0;}
  .banner .main_image ul{;position:absolute;top:0;left:0}
  .banner .main_image li{float:left;}
  .banner .main_image li img{display:block;width:100%;}
  .banner .main_image li a{display:block;width:100%;}

    div.flicking_con{position:absolute;bottom:10px;z-index:1;width:100%;height:12px;}
    div.flicking_con .inner { width:100%;height:9px;text-align:center;}
    div.flicking_con a{position:relative; width:10px;height:9px;background:url('../addons/ewei_shop/template/mobile/default/static/images/dot.png') 0 0 no-repeat;display:inline-block;text-indent:-1000px}
    div.flicking_con a.on{background-position:0 -9px}
    #index_loading { width:94%;padding:10px;color:#666;text-align: center;float:left;}
    .search {height:40px; width:97%; margin:5px; background:#fff; color:#ccc; line-height:40px; font-size:14px; text-align:center;}
       .title {height:40px; width:94%; background:#fff; padding:0px 3%; font-size:16px; color:#666; line-height:40px;}
        .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin:10px 0 54px;}
</style>
<div id="container"></div>
<script id="tpl_main" type="text/html">
 
<div class="top">
   <div class="bgimg">
        <img src="<%shop.img%>">
        <div class="shopimg"><img src="<%shop.logo%>"></div>
        <div class="shopname"><%shop.name%></div>
        <%if isme%><div class="set" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/myshop',array('op'=>'set'))?>'"><i class="fa fa-cog fa-spin"></i></div><%/if%>
    </div>
    <div class="nav">
        <div class="sub" onclick="location.href='<?php  echo $this->createPluginMobileUrl('commission/shares')?>'">
              <span><i class="fa fa-qrcode"></i></span>
            <nav >二维码</nav>
        </div>
        <div class="sub" id='fav'>
            <span><i class="fa fa-star-o"></i></span>
            <nav>收藏本店</nav>
        </div>
        <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/category')?>'">
            <span><i class="fa fa-list-ul"></i></span>
            <nav>全部分类</nav>
        </div>
        <div class="sub" onclick="location.href='<?php  echo $this->createMobileUrl('shop/list')?>'">
            <span><%goodscount%></span>
            <nav>全部商品</nav>
        </div>
    </div>
</div>
    
    <div class='search'><i class="fa fa-search"></i> 在店铺内搜索</div>
    <%if advs.length>0%>
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
    <%/if%>
    <div class="title">推荐宝贝</div>
    <div class="goods">
        <div id='goods_container'></div>
    </div>
    <div class="copyright">版权所有 © <%if set.copyright%><%set.copyright%><%else%><?php  echo $_W['account']['name'];?><%/if%></div>
    
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
        <div class='img'><img src="<%g.thumb%>"></div>
        <div class="name"><%g.title%></div>
        <div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>
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
                           
           
                    $('.good img').each(function(){
                            $(this).height($(this).width());
                    })

                        $('.good').unbind('click').click(function(){
                            location.href = core.getUrl('shop/detail',{id:$(this).data('goodsid') });
                        })
                    if (result.goods.length < result.pagesize) {

                        $('#goods_container').append('<div id="index_loading">已经加载全部商品</div>');
                        loaded = true;
                        $(window).scroll = null;
                        return;
                    }

                    //自动加载

                    $(window).scroll(function () {

                        if (loaded) {
                            return;
                        }
                        totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
                        if ($(document).height() <= totalheight) {
                            if (stop == true) {
                                stop = false;
                                $('#goods_container').append('<div id="index_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载更多商品</div>');
                                page++;
                                getGoods('display');
                            }
                        }
                    });
                });
            }

        core.pjson('commission/myshop',{mid:"<?php  echo $_GPC['mid'];?>"},function(json){
            var result = json.result;   
        
                    $('#container').html(  tpl('tpl_main',result) );
            
             if( result.advs.length>0) {
                    $('.banner').height($('.main_image').find('img').height());
                    new Swipe($('.main_image')[0], {
			speed:300,
			auto:4000,
			callback: function(){
			  
                                 $(".flicking_con  .inner  a").removeClass("on").eq(this.index).addClass("on");
		}
	  });
                
               }
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
            
        },true);
        
        
        
    })
</script>
<?php  $show_footer=true;$footer_current ='first'?> 
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>