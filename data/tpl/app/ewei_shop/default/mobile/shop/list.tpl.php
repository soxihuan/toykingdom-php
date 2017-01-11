<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title><?php  if(empty($current_category)) { ?>全部商品<?php  } else { ?><?php  echo $current_category['name'];?><?php  } ?></title>
<style type="text/css">
    body {margin:0px; width:100%; height:100%; background:#eee; color:#fff; }
    html {}
    .main {height:100%; width:100%; background:#fff; }
    .main .category {height:100%; width:60%; background:rgba(0,0,0,0.8);  position:fixed; left:-60%; top:0; z-index:9999;overflow-y: auto;}
    .main .category .title {height:44px; width:100%; background:rgba(0,0,0,0.2); line-height:44px; font-size:16px; color:#fff; text-align:center;}
    .main .category .all {height:auto; width:80%; padding:10px 10%; color:#fff;}
    .main .category .all p {height:auto; width:100%; font-size:16px; line-height:20px; padding:0px; margin:0px;}
   .main .category .all p.category_item { padding-top:10px;}
    .main .category .all p.child {height:auto; width:100%; font-size:16px; line-height:20px;  padding-left:10px;padding-top:10px;}
    .main .category .all p.third {height:auto; width:100%; font-size:16px; line-height:20px;  padding-left:20px;padding-top:10px;}
    .main .category .all span {height:auto; width:95%; margin-left:5%; margin-bottom:10px; font-size:16px; line-height:20px; padding:0px;}

    .main .page {width:100%; background:#eee; }
    .main .page .topbar {height:28px; width:100%; background:#f9f9f9; padding:8px 0;}
    .main .page .topbar .list1,    .main .page .topbar .list2 {height:28px; width:10%; float:left; margin-left:3%; line-height:28px; font-size:18px; text-align:left; color:#999;}
    .main .page .topbar .name {height:28px; width:54%; padding-left:10%; margin:auto; text-align:center; float:left; font-size:16px; line-height:28px; color:#666;}
    .main .page .topbar .sort {height:28px; width:10%; float:right; font-size:18px; line-height:28px; padding-top:5px; text-align:right; color:#999;}
    .main .page .topbar .search {height:28px; width:10%; float:right; margin-right:3%; font-size:18px; line-height:25px; text-align:right; color:#999;}

    .main .page .goods {height:auto; width:100%; /* padding:0 1%;  */margin-top:4px; float:left;}
    .main .page .goods .good {height:6.4rem;width:4.4rem; background:#fff; /*  margin:4px 1%; */margin-top:5px;float:left;position:relative;border-bottom:1px solid #E5E5E5;box-sizing: border-box;margin-left:0.185rem;}
    .main .page .goods .good img {width:100%;}
    .main .page .goods .good .nostock { position: absolute;bottom:20px;right:0px; width:30%;height:30%;}
    .main .page .goods .good .nostock img { max-width: 50px;}
    
    .main .page .goods .good .name {height:0.64rem; width:100%; font-size:0.3rem; color:#999; line-height:0.35rem;overflow:hidden;color:#222121;box-sizing: border-box;padding:0 0.15rem;}
    .main .page .goods .good .price {height:0.625rem; width:100%; font-size:0.45rem; color:#E60011;line-height:0.625rem;margin-top:5px;margin-bottom:6px;padding-left:0.1rem;box-sizing: border-box;}
/*     .main .page .goods .good .price span {height:23px; width:auto; padding:2px 6px; background:#666; color:#fff; font-size:12px; border-radius:5px; text-decoration: line-through;} */
    .main .page .goods .good .price span {color:#999; font-size:12px;text-decoration: line-through;}

    .main .page .copyright {height:40px; width:100%; text-align:center; line-height:40px; font-size:12px; color:#999; margin-top:10px;float:left;}

    .main .page .sort_list {height:100px; width:90px; background:rgba(51,51,51,0.8); border-radius:5px; position:absolute; top:50px; right:5%; display:none;z-index:999;}
    .main .page .sort_list .nav {height:25px; width:90px; line-height:25px; font-size:12px; color:#fff; text-align:center;}
    .main .page .sort_list .navon {color:#ff6600;}
 
    #list_loading { width:94%;padding:10px;color:#666;text-align: center;float:right;font-size:14px;}
    .list_no {height:100px; width:100%; margin:50px 0px 60px; color:#ccc; font-size:12px; text-align:center;}
    .list_no_menu {height:40px; width:50%; text-align:center;margin:auto;}
    .list_no_nav {height:38px; padding:5px;background:#eee; border:1px solid #d4d4d4; border-radius:5px; text-align:center; line-height:38px; color:#666;font-size:18px;}

#category_group{margin-top:8px;}

.category_group {background:#fff;height:41px;overflow-y: hidden;overflow: auto; list-style-type:none; -webkit-overflow-scrolling: touch; box-shadow: 0 1px 1px rgba(8,8,8,.1);white-space:nowrap;-webkit-overflow-scrolling:touch ; }
.category_group .container{ height:41px;list-style-type:none;white-space:nowrap;overflow: auto; -webkit-overflow-scrolling:touch;font-size:0; }
.category_group  a {display:inline-block;line-height:41px;height:41px;text-decoration: none; color:#666; text-align: center; padding:0 10px;font-size:16px;}
.category_group a.on  { color:#222121;background:;border-bottom:2px solid #F4D500;box-sizing: border-box;font-weight: 500;}



.thisIsMyDcs{height:21px;width:21px;display:block;background:url('../addons/ewei_shop/template/mobile/default/static/images/list-the-sorting.png') no-repeat center center;background-size:contain;}
.thisIsMyZoom{height:21px;width:21px;display:block;background:url('../addons/ewei_shop/template/mobile/default/static/images/list-search.png') no-repeat center center;background-size:contain;}
.thisIsMyAll{height:21px;width:21px;display:block;background:url('../addons/ewei_shop/template/mobile/default/static/images/list-all.png') no-repeat center center;background-size:contain;}
.fatherdiv{position:relative;}
.fatherdiv .thisIsMyZoom{position:absolute;top:50%;left:50%;transform: translate(-50%,-50%);-webkit-transform: translate(-50%,-50%);}
.myGoTopBtn{height: 44px;width: 44px;background:url('../addons/ewei_shop/template/mobile/default/static/images/goTop.png') no-repeat center center;background-size:contain;position: fixed;z-index: 999;right: 18px;bottom:76px;opacity: 0.9;display: none;}
</style>
<!-- 初始化lazy-load -->
<script>
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


</script>
 
<div id='container'>
   
</div>

<script id='tpl_main' type='text/html'>
     <!--搜索-->
    <div class="search1">
                <div class="topbar1">
                    <div class='right'>
                        <button class="sub1 fatherdiv"><i class="thisIsMyZoom"></i></button>
                        <div class="home1">取消</div>
                    </div>
                    <div class='left_wrap'>
                        <div class='left'>
                            <input type="text" id='keywords' class="input1" placeholder='搜索: 输入商品关键词' value='<?php  echo $_GPC['keywords'];?>'/>
                        </div>
                    </div>
                </div>
                <div id='search_container' class='result1'>
        </div>
</div>
    <div class="main">
        <div id='category_container'></div>
        <div class='page'>
            <!--排序div-->
            <div class="sort_list">
                <div class="nav navon"  data-order='sales' data-by='desc'>销量从高到低</div>
                <div class="nav" data-order='marketprice' data-by='asc'>价格从低到高</div>
                <div class="nav "  data-order='marketprice' data-by='desc'>价格从高到低</div>
                <div class="nav"  data-order='score' data-by='asc'>评价从高到低</div>
            </div>
            <!--topbar-->
            <div class="topbar">
                <?php  if(!empty($myshop['selectcategory']) || empty($myshop)) { ?>
                <div class="list1">
                  <i class="thisIsMyAll"></i>
                </div>
                <?php  } else { ?>
                <div class="list2" onclick='history.back()'>
                  <i class="fa fa-angle-left"></i>
                </div>
                
                <?php  } ?>
                <div class="name"><?php  if(empty($current_category)) { ?>全部商品<?php  } else { ?><?php  echo $current_category['name'];?><?php  } ?></div>
                <div class="search fatherdiv"><i class="thisIsMyZoom"></i></div>
                <div class="sort"><i class="thisIsMyDcs" style="float:right;"></i></div>
            </div>
            <div id="category_group"></div>
            <!--商品列表-->
            <div class="goods">
                <div id='goods_container'></div>
            </div>
        </div>
          <div class="myGoTopBtn"></div>  
    </div>
</script>
 
<script id='tpl_search_list' type='text/html'>
     <ul>
     <%each list as value%>
        <li><i class="fa fa-angle-right"></i> <a href="<?php  echo $this->createMobileUrl('shop/detail')?>&id=<%value.id%>"><%value.title%></a></li>
        <%/each%>
    </ul> 
</script>
<script id="tpl_category_group" type="text/html">
  
                <div class="category_group">
                    <div class='container'>
                    <%each category as c%><a href="javascript:;"
                                             level="<%c.level%>"
                                             name="<%c.name%>"
                       <%if c.level==1%>pcate="<%c.id%>"<%/if%>
                       <%if c.level==2%>ccate="<%c.id%>"<%/if%>
                       <%if c.level==3%>tcate="<%c.id%>"<%/if%>
                       <%if c.on %>class="on"<%/if%>
                       
                       ><%c.name%></a><%/each%>
     </div>
               </div>
 
 
 </script>
<script id='tpl_goods_list' type='text/html'>
    <%each goods as g%>
    <div class="good" data-goodsid='<%g.id%>'>
<!--         <%if g.total<=0%><div class="nostock"><img src="../addons/ewei_shop/template/mobile/default/static/images/salez.png"></div><%/if%>
        <img src="<%g.thumb%>"> -->
        <%if g.total<=0%><div class="nostock"><img class="lazy" data-original="../addons/ewei_shop/template/mobile/default/static/images/salez.png"></div><%/if%>
        <img class="lazy" data-original="<%g.thumb%>?imageView2/1/w/350/h/350">
        <div class="price">￥<%g.marketprice%> <%if g.productprice>0 && g.marketprice!=g.productprice%><span>￥<%g.productprice%></span><%/if%></div>   
        <div class="name"><%g.title%> </div>
     </div>
    <%/each%>
    
</script>
<script id='tpl_category_list' type='text/html'>
     <div class="category">
        <div class="title category_item" data-name='全部商品'><i class="fa fa-list-ul"></i> 全部分类<i class="fa fa-angle-left close" style="font-size:26px; float:right; line-height:44px; margin-right:20px;"></i></div>
        <div class="all">
        <p class='category_item' data-isnew='1' data-name='新上宝贝'><i class="fa fa-cart-plus"></i> 新上宝贝</p>
        <p class='category_item' data-isrecommand='1'  data-name='推荐宝贝'><i class="fa fa-heart"></i> 推荐宝贝</p>
        <p class='category_item' data-ishot='1'  data-name='热销宝贝'><i class="fa fa-fire"></i> 热销宝贝</p>
        <p class='category_item' data-istime='1'  data-name='限时秒杀'><i class="fa fa-clock-o"></i> 限时秒杀</p>
        <p class='category_item' data-isdiscount='1'  data-name='促销宝贝'><i class="fa fa-thumbs-up"></i> 促销宝贝</p>
        <%each category as parent%>
         <p class='category_item'  data-pcate='<%parent.id%>' data-name='<%parent.name%>'><i class="fa fa-angle-double-right"></i> <%parent.name%></p>
         <%each parent.children as child%>
              <p class='child category_item' data-ccate='<%child.id%>' data-name='<%child.name%>'><i class="fa fa-angle-right"></i> <%child.name%></p>
              <?php  if(intval($set['catlevel'])==3) { ?>
               <%each child.children as third%>
                   <p class='third category_item' data-tcate='<%third.id%>' data-name='<%third.name%>'><i class="fa fa-angle-right"></i> <%third.name%></p>
               <%/each%>
               <?php  } ?>
         <%/each%>
         <%/each%>
        </div>
    </div>
</script>
<script id='tpl_empty' type='text/html'>
 <div class="list_no"><i class="fa fa-shopping-cart" style="font-size:100px;"></i><br><span style="line-height:18px; font-size:16px;">暂时没有相关商品</span><br>主人快去给我找点其他东西吧</div>
<div class="list_no_menu">
        <div class="list_no_nav" onclick="location.href='<?php  echo $this->createMobileUrl('shop/list')?>'">看看其他的</div>
 </div>
</script>
<script language='javascript'>
    var loaded = false;
    var stop = true;
    var category = null;
    var def_args = args  = {
           page:"<?php  echo $_GPC['page'];?>",
           isnew: "<?php  echo $_GPC['isnew'];?>",
           ishot: "<?php  echo $_GPC['ishot'];?>",
           isrecommand:"<?php  echo $_GPC['isrecommand'];?>",
           isdiscount:"<?php  echo $_GPC['isdiscount'];?>",
           keywords:"<?php  echo $_GPC['keywords'];?>",
           istime:"<?php  echo $_GPC['istime'];?>",
           pcate:"<?php  echo $_GPC['pcate'];?>",
           ccate:"<?php  echo $_GPC['ccate'];?>",
           tcate:"<?php  echo $_GPC['tcate'];?>",
           order:"<?php  echo $_GPC['order'];?>",
           by:"<?php  echo $_GPC['by'];?>",
           shopid:"<?php  echo $_GPC['shopid'];?>"
    };

    require(['tpl', 'core'], function (tpl, core) {
    
        function getGoods() {
             
            core.json('shop/list', args, function (json) {
           
             
                 
                $('#goods_container').html(tpl('tpl_goods_list',json.result));

            $("img.lazy").lazyload({effect: "fadeIn"});
                 // alert($(window).height())
                 // 
                    $(window).scrollTop(sessionStorage.lasttop)

                $('#category_group').html("");
                if(json.result.category && json.result.category.length>0){
                    var category = {category:json.result.category,parent:json.result.parent_category};
                    $('#category_group').html(tpl('tpl_category_group',category));    
                    $('#category_group a').unbind('click').click(function(){
                        if( $(this).attr('level')=='0'){
                          $('.topbar .name').html('全部商品');
                          document.title ='全部商品';
                        } else{
                            $('.topbar .name').html($(this).attr('name'));
                          document.title =$(this).attr('name');
                        }
                        args.page = 1;
                        args.pcate = $(this).attr('pcate') || 0;
                        args.ccate = $(this).attr('ccate') || 0;
                        args.tcate = $(this).attr('tcate') || 0;
                        loaded =false;
                        getGoods();
                    })
                }  
               
                if(json.result.current_category){
                     $('.topbar .name').html( json.result.current_category.name);
                     document.title = json.result.current_category.name;
                }
                
                if (json.result.goods.length <= 0) {
                    loaded = true;
                    $(window).scroll = null;
                    $('#goods_container').html(tpl('tpl_empty'));
                    return;
                }
                bindEvents();
                stop =true;
                bindMore();
                
            }, true);
        }
        function getGoodsMore() {
     
            core.json('shop/list', args, function (json) {
                var result = json.result;
                $('#goods_container').append(tpl('tpl_goods_list',result));

                $("img.lazy").lazyload({effect: "fadeIn"});
                
                bindEvents();
                $('#list_loading').remove();
                if (result.goods.length < result.pagesize) {
                        $('#goods_container').append('<div id="list_loading">已经加载全部商品</div>');
                        loaded = true;
                        $(window).scroll = null;
                        return;
                }
                stop=true;
                bindMore(); 
                
            });
        }

        function bindEvents() {
            $('.good img').each(function(){
               $(this).height($(this).width()); 
            });
            $('.good').unbind('click').click(function () {
                        location.href = core.getUrl('shop/detail', {id: $(this).data('goodsid'),my:'<?php  echo $_GPC['my'];?>'});
            });
        }
        
        function bindMore() {
     
            $(window).scroll(function () {
  
                if (loaded) {
                    return;
                }
                totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
                if ($(document).height() <= totalheight) {
                
                    if (stop == true) {
                        stop = false;
                        $('#goods_container').append('<div id="list_loading"><i class="fa fa-spinner fa-spin"></i> 正在加载更多商品</div>');
                  
                        if(args.page=='' || args.page=='undefined'){
                            args.page = 1;
                        }
                        args.page++;
                        getGoodsMore();
                    }
                }
            });
        }
 
        function reset() {
            $('#form')[0].reset();
        }
        function bindCategoryEvents(){
            
             $(".category .close").unbind('click').click(function(){
                        $(".category").animate({left:"-60%"},200);
             });
             $(".category .category_item").unbind('click').click(function(){
                 var item = $(this);
                      $('#keywords').val(""); $('#search_container').html('');
                     $(".category").animate({left:"-60%"},200);
                      args  = {
                            page:1,
                            isnew: item.data('isnew'),
                            ishot:item.data('ishot'),
                            isrecommand:item.data('isrecommand'),
                            isdiscount:item.data('isdiscount'),
                            keywords:"",
                            istime: item.data('istime:'),
                            pcate: item.data('pcate'),
                            ccate: item.data('ccate'),
                            tcate: item.data('tcate'),
                            order:"",
                            by:"",
                            shopid:"<?php  echo $_GPC['shopid'];?>"
                     };
                     $('.topbar .name').html( item.data('name'));
                     document.title = item.data('name');
                     getGoods();
             });
             
        }
        

        $('#container').html(tpl('tpl_main'));
        

        console.log(sessionStorage.lasttop)
     
       window.onunload = function(){
        var mysrcoll;
        mysrcoll = $(window).scrollTop()
        sessionStorage.lasttop=mysrcoll;
       }

        $('.sort').click(function () {
                var display = $(".sort_list").css('display');
                if (display == 'none') {
                    $(".sort_list").fadeIn(200);
                } else {
                    $(".sort_list").fadeOut(100);
                }

        });
        $('.nav').click(function () {

              
                
                if ($(this).data('order') ==args.order && $(this).data('by') == args.by) {
                    return;
                }
                $('.nav').removeClass('navon');
                
                $(this).addClass('navon');
                   args  = {
                            page:1,
                            isnew: args.isnew,
                            ishot: args.ishot,
                            isrecommand:args.isrecommand,
                            isdiscount:args.isdiscount,
                            keywords:args.keywords,
                            istime: args.istime,
                            pcate:args.pcate,
                            ccate: args.ccate,
                            tcate: args.tcate,
                            order:$(this).data('order'),
                            by:$(this).data('by'),
                            shopid:args.shopid
                     };
               
                $(".sort_list").fadeOut(200);
                getGoods();
        });
        $('.list1').click(function(){
             $(".sort_list").fadeOut(100);
             if(category!=null){
                  $(".category").animate({left:"0px"},200);
                  bindCategoryEvents();
                  return;
             }
             
             core.json('shop/util',{op:'category'}, function (json) {
                 category = json.result;
                 $('#category_container').append(tpl('tpl_category_list',category));
                 $(".category").animate({left:"0px"},200);
                 bindCategoryEvents();
              }, true);
        });

                // 点击返回页面顶部
        $('.myGoTopBtn').click(function(){
            $('html,body').animate({'scrollTop': 0}, 250)
        })
        
    var myHeight = document.body.clientHeight;
    $(window).scroll(function(){
        var heightNow = $(window).scrollTop();
        if (heightNow >= myHeight) {
            $('.myGoTopBtn').show();
        }else{
             $('.myGoTopBtn').hide();
        };
    })



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
                  
                   args  = {
                            page:1,
                            isnew: args.isnew,
                            ishot: args.ishot,
                            isrecommand:args.isrecommand,
                            isdiscount:args.isdiscount,
                            keywords:keywords,
                            istime: args.istime,
                            pcate:args.pcate,
                            ccate: args.ccate,
                            tcate: args.tcate,
                            order:args.order,
                            by:args.by,
                            shopid:args.shopid
                     };
               
                $(".sort_list").fadeOut(200);
                 $(".search1").animate({bottom:"-100%"},100);
                 getGoods();
            });


            $('.search1 .home1').unbind('click').click(function(){
                 $(".search1").animate({bottom:"-100%"},100);
            });
        });
        
    
   
     getGoods();
     

 


    });
</script>
<?php  $show_copyright=true; $show_footer = true;?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
