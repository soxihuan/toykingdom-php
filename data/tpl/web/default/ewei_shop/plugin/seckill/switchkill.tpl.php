<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>



<div class="main">
    <form id="dataform"    <?php if(cv('seckill.switchkill.save')) { ?>action="" method="post"<?php  } ?> class="form-horizontal form">
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">首页显示秒杀</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('seckill.switchkill.save')) { ?>
                    <label class="radio-inline">
                        <input type="radio" name="data[isopen]" value='1' <?php  if($iskill['isopen']==1) { ?>checked<?php  } ?> /> 开启
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="data[isopen]" value='0' <?php  if(empty($iskill['isopen'])) { ?>checked<?php  } ?> /> 关闭
                    </label>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if($iskill['isopen']==1) { ?>开启<?php  } else { ?>关闭<?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>

            <div class="form-group"></div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <input type="submit" name="submit"  value="保存设置" class="btn btn-primary"/>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                </div>
            </div>

        </div>
    </div>
    </form>
</div>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>