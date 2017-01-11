<?php defined('IN_IA') or exit('Access Denied');?>

<?php  if($show_footer) { ?>
	<?php  if($this->footer['diymenu']) { ?>
		 {$thi->fotter['diymenu']}
		<div id="designer-nav" style="display: none">
		<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('designer/menu', TEMPLATE_INCLUDEPATH)) : (include template('designer/menu', TEMPLATE_INCLUDEPATH));?>	
		</div>

	<?php  } else { ?>
		<style type="text/css">
			<?php  if($this->footer['commission']) { ?>
			footer#footer-nav .menu-list li { width:20%;}
			<?php  } ?> 
		</style>

		<footer id="footer-nav" style="display: none">
						<ul class="menu-list" style="margin:0;">
							<!--li <?php  if($footer_current=='first') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['first']['url']?>"><i class="fa fa-<?php  echo $this->footer['first']['ico']?>"></i><span><?php  echo $this->footer['first']['text']?></span></a></li-->
							<li <?php  if($footer_current=='first') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createPluginMobileUrl('commission/myshop', array('mid' => $_GPC['mid']))?>"><i class="myindex"></i><span><?php  echo $this->footer['first']['text']?></span></a></li>
							<li <?php  if($footer_current=='second') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['second']['url']?>"><i class="classify"></i><span><?php  echo $this->footer['second']['text']?></span></a></li>
						<?php  if($this->footer['commission']) { ?>
							<li <?php  if($footer_current=='commission') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->footer['commission']['url']?>"><i class="mycenter"></i><span><?php  echo $this->footer['commission']['text']?></span></a></li>
						<?php  } ?> 
							<li <?php  if($footer_current=='cart') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('shop/cart')?>"><i class="nav-shopping"></i><span>购物车</span></a></li>
							<li <?php  if($footer_current=='member') { ?>class='active'<?php  } ?>><a href="<?php  echo $this->createMobileUrl('member')?>"><i class="thisisuser"></i><span>个人中心</span></a></li>
						</ul>
		</footer>
	<?php  } ?>
<?php  } ?> 

<?php  $systemcopyright = false?>
<?php  $psystem = p('system')?>
<?php  if($psystem) { ?>
	   <?php  $systemcopyright = $psystem->getCopyright()?>
<?php  } ?>
<?php  if($show_footer && $show_copyright) { ?>
     <div style='display:none;margin:0;padding:0;padding-bottom:0px;float:left;width:100%;background-color:<?php  echo $systemcopyright['bgcolor'];?>' id="systemcopyright">
	   <?php  echo $systemcopyright['copyright']?>
	</div>
	<div style='height:50px; width:100%;margin:0;padding:0;float:left;display:block;'></div>
<?php  } else if($show_copyright) { ?>
    <div style='display:none;margin:0;padding:0;padding-bottom:0px;float:left;width:100%;background-color:<?php  echo $systemcopyright['bgcolor'];?>' id="systemcopyright">
	   <?php  echo $systemcopyright['copyright']?>
   </div>
   <?php  if($footertype==2 || $hide_footer=1) { ?>
	<div style='height:50px; width:100%;margin:0;padding:0;float:left;display:block;'></div>
   <?php  } ?>
<?php  } else if($show_footer) { ?>
     <div style='height:50px; width:100%;margin:0;padding:0;float:left;display:block;'></div>
<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer_base', TEMPLATE_INCLUDEPATH)) : (include template('common/footer_base', TEMPLATE_INCLUDEPATH));?> 

