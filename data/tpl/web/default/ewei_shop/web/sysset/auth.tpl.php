<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="main">
    <form action="" method="post" class="form-horizontal form" enctype="multipart/form-data" >
        <div class="panel panel-default">
            <div class="panel-heading">
                系统授权
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">域名</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="domain" class="form-control" value="<?php  echo $domain;?>" readonly/>
                        <span class="help-block">服务器域名</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">站点IP</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="ip" class="form-control" value="<?php  echo $ip;?>" readonly/>
                        <span class="help-block">站点IP</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">站点ID</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="id" class="form-control" value="<?php  echo $id;?>" readonly />
                        <span class="help-block">站点ID,如果为空，请到 <a href='<?php  echo url('cloud/profile')?>'>站点注册</a> 绑定您的服务器</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">授权码</label>
                    <div class="col-sm-9 col-xs-12">
                        <input type="text" name="code" class="form-control" value="<?php  echo $auth['code'];?>" />
                        <span class="help-block">请联系客服将IP及站点ID提交给客服, 索取授权码，保护好您的授权码，避免泄漏</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">授权状态</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='form-control-static'>
                            <?php  if($status==1) { ?>
                            <span class='label label-success'>已授权</span>
                            <?php  } else if($status==0) { ?>
                            <span class='label label-danger'>未授权</span>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
                <?php  if($_W['isfounder']) { ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">官方网站</label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='form-control-static'><a href='http://www.we7shop.cn' target='_blank'>http://www.we7shop.cn</a></div>
                        <?php  if($status==0) { ?>
                        <span class='help-block'>如果您正在使用非正版授权，请您尊重我们的劳动成果，谢谢您~</span>
                        <span class='help-block'>盗版有风险，请谨慎使用!</span>
                        <?php  } else { ?>
                        <?php  } ?>
                    </div>
                </div>
                <?php  } ?>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                        <div class='form-control-static'>
                        
                            <input type="submit" name="submit" value="验证授权" class="btn btn-primary col-lg-1" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                                 <?php  if($status==1) { ?><input type="button" name="submit" style="margin-left:10px;" onclick="location.href='<?php  echo $this->createWebUrl('upgrade')?>'" value="系统升级" class="btn btn-success col-lg-1" /><?php  } ?>
                        </div>
                    </div>
                </div>

            </div>  
        </div>

    </form>
</div>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>