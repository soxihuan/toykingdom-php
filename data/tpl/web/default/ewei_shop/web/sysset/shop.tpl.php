<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/sysset/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/sysset/tabs', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <input type='hidden' name='setid' value="<?php  echo $set['id'];?>" />
        <input type='hidden' name='op' value="shop" />
        <div class="panel panel-default">
			<div class="panel-heading">
				基本设置
			</div>
            <div class='panel-body'>  
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
                        <input type="text" name="shop[name]" class="form-control" value="<?php  echo $set['shop']['name'];?>" />
                        <?php  } else { ?>
                        <input type="hidden" name="shop[name]" value="<?php  echo $set['shop']['name'];?>"/>
                        <div class='form-control-static'><?php  echo $set['shop']['name'];?></div>
                        <?php  } ?>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城LOGO</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
                        <?php  echo tpl_form_field_image('shop[logo]', $set['shop']['logo'])?>
                        <span class='help-block'>正方型图片</span>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[logo]" value="<?php  echo $set['shop']['logo'];?>"/>
                        <?php  if(!empty($set['shop']['logo'])) { ?>
                        <a href='<?php  echo tomedia($set['shop']['logo'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($set['shop']['logo'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">店招</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
                        <?php  echo tpl_form_field_image('shop[img]', $set['shop']['img'])?>
                        <span class='help-block'>商城首页店招，建议尺寸640*450</span>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[img]" value="<?php  echo $set['shop']['img'];?>"/>
                        <?php  if(!empty($set['shop']['img'])) { ?>
                        <a href='<?php  echo tomedia($set['shop']['img'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($set['shop']['img'])?>" style='width:200px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城海报</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
                        <?php  echo tpl_form_field_image('shop[signimg]', $set['shop']['signimg'])?>
                        <span class='help-block'>推广海报，建议尺寸640*640</span>
                        <?php  } else { ?>
                        <input type="hidden" name="shop[signimg]" value="<?php  echo $set['shop']['signimg'];?>"/>
                        <?php  if(!empty($set['shop']['signimg'])) { ?>
                        <a href='<?php  echo tomedia($set['shop']['signimg'])?>' target='_blank'>
                           <img src="<?php  echo tomedia($set['shop']['signimg'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                        </a>
                        <?php  } ?>
                        <?php  } ?>

                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">全局统计代码</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
			 <textarea name="shop[diycode]" class="form-control richtext" cols="70" rows="5"><?php  echo $set['shop']['diycode'];?></textarea>
                        <?php  } else { ?>
                        <textarea name="shop[diycode]" class="form-control richtext" cols="70" style="display:none"  rows="5"><?php  echo $set['shop']['diycode'];?></textarea>
                        <div class='form-control-static'><?php  echo $set['shop']['diycode'];?></div>
                        <?php  } ?>
                    </div>
            </div>
				
          
                       
            </div>  
			
			<div class="panel-heading">
				商城关闭设置
			</div>
            <div class='panel-body'>
				  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城状态</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
						<label class="radio-inline">
							<input type="radio" name="shop[close]" value='0' <?php  if($set['shop']['close']==0) { ?>checked<?php  } ?> /> 开启
						</label>
						<label class="radio-inline">
							<input type="radio" name="shop[close]" value='1' <?php  if($set['shop']['close']==1) { ?>checked<?php  } ?> /> 关闭
						</label>
						
                        <?php  } else { ?>
                        
                        <div class='form-control-static'><?php  if($set['shop']['close']==1) { ?>关闭<?php  } else { ?>开启<?php  } ?></div>
                        <?php  } ?>
                    </div>
            </div>
	<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城关闭跳转连接</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
                        <input type="text" name="shop[closeurl]" class="form-control" value="<?php  echo $set['shop']['closeurl'];?>" />
						<span class='help-block'>如果您不采用系统页面，则可以设置关闭提醒连接，当商城关闭时跳转到此链接（非任何商城的连接）</span>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $set['shop']['closeurl'];?></div>
                        <?php  } ?>

                    </div>
                </div>			
	  <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">商城关闭提醒</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if(cv('sysset.save.shop')) { ?>
			 <?php  echo tpl_ueditor('shop[closedetail]',$set['shop']['closedetail'])?>
                        <?php  } else { ?>
                         <textarea id='detail' style='display:none'><?php  echo $set['shop']['closedetail'];?></textarea>
                            <a href='javascript:preview_html("#detail")' class="btn btn-default">查看内容</a>
                        <?php  } ?>
                    </div>
            </div>
				
				
				<div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if(cv('sysset.save.shop')) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                          <?php  } ?>
                     </div>
            </div>
			</div>
			
        </div>     
    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>     