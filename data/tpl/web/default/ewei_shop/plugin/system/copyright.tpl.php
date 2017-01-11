<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/ewei_shop/static/js/dist/select2/select2.css" rel="stylesheet">
<link href="../addons/ewei_shop/static/js/dist/select2/select2-bootstrap.css" rel="stylesheet">
<script language="javascript" src="../addons/ewei_shop/static/js/dist/select2/select2.min.js"></script>
<script language="javascript" src="../addons/ewei_shop/static/js/dist/select2/select2_locale_zh-CN.js"></script>
<div class="main">
    <form id="dataform" action="" method="post" class="form-horizontal form">
        <div class="panel panel-default">
            <div class="panel-heading">
                底部版权设置
            </div>
            <div class="panel-body">
	 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">选择公众号</label>
                    <div class="col-sm-9">
						<select id='wechatid' name='wechatid' class='form-control' onchange="location.href= '<?php  echo $this->createPluginWebUrl('system/copyright')?>&wechatid=' + $(this).val()" >
							<option value=''></option>
							<?php  if(is_array($wechats)) { foreach($wechats as $we) { ?>	
							<option value='<?php  echo $we['uniacid'];?>' <?php  if($_GPC['wechatid']==$we['uniacid']) { ?>selected<?php  } ?>><?php  echo $we['name'] ?></option>
							<?php  } } ?>
							<option value='-1' <?php  if($_GPC['wechatid']==-1 || empty($_GPC['wechatid'])) { ?>selected<?php  } ?>>全部公众号</option>
						</select>
                    </div>
                </div>
	      <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">背景颜色</label>
                    <div class="col-sm-9">
				     <?php  echo tpl_form_field_color('bgcolor',$copyrights['bgcolor'])?>
                    </div>
                </div>	 
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">底部版权</label>
                    <div class="col-sm-9">
				     <?php  echo tpl_ueditor('copyright',$copyrights['copyright'])?>
                    </div>
                </div> 
		 
				<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9">
						<input id="btn_submit" type="submit" name='submit'  value="保存" class="btn btn-primary"/>
						<input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    </div>
                </div>	
            </div>
        </div>

    </form>
</div>
<script type="text/javascript">
 
 $(function () {
		$('#wechatid').select2({
			search: true,
			placeholder: "请选择公众号",
			allowClear: true
		});
		 
	})
</script>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
