<?php defined('IN_IA') or exit('Access Denied');?><?php  if($show_footer) { ?>
<div style='height:50px;width:100%'></div>
<footer id="footer-nav">
                <ul class="menu-list">
                	<!-- 原地址更改 -->
             <!--        <li ><a href="<?php  echo $this->createMobileUrl('shop')?>"><i class="fa fa-home"></i><span>首页</span></a></li> -->
                    <li class='active'><a href="<?php  echo $this->createPluginMobileUrl('commission/myshop', array('mid' => $_GPC['mid']))?>"><i class="myindex"></i><span>首页</span></a></li>
                    <li><a href="<?php  echo $this->footer['second']['url']?>"><i class="classify"></i><span>分类</span></a></li>
                    <li><a href="<?php  echo $this->createPluginMobileUrl('commission')?>"><i class="mycenter"></i><span>分销中心</span></a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><i class="nav-shopping"></i><span>购物车</span></a></li>
                    <li><a href="<?php  echo $this->createMobileUrl('member')?>"><i class="thisisuser"></i><span>个人中心</span></a></li>
                </ul>
                <script>

                		var myTitle=$('title').html()
                		if (myTitle =="分销中心") {
                			$('.menu-list li').eq(2).addClass('active').siblings('li').removeClass('active');
                		}else if(myTitle =="个人中心") {
            				$('.menu-list li').eq(4).addClass('active').siblings('li').removeClass('active');
                		}else{
            				$('.menu-list li').eq(0).addClass('active').siblings('li').removeClass('active');
                		};
      
                </script>
</footer>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?>