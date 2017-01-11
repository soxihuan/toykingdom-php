<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>

<?php  if($operation == 'post') { ?>

<div class="main">
    <form action="" <?php if( ce('commission.mentor' ,$mentor) ) { ?>action="" method="post"<?php  } ?>  class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $mentor['id'];?>" />
    <div class='panel panel-default'>
        <div class='panel-heading'>
                 导师设置
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>姓名</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('commission.mentor' ,$mentor) ) { ?>
                    <input type="text" name="name" id="name" class="form-control" value="<?php  echo $mentor['name'];?>" />
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $mentor['name'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>头像</label>
                <div class="col-sm-9 col-xs-12 detail-logo">
                    <?php if( ce('commission.mentor' ,$mentor) ) { ?>
                    <?php  echo tpl_form_field_image('head_url', $mentor['head_url'])?>
                    <span class="help-block">建议尺寸: 90 * 90 ，或正方型图片 </span>
                    <?php  } else { ?>
                    <?php  if(!empty($mentor['head_url'])) { ?>
                    <a href='<?php  echo tomedia($mentor['head_url'])?>' target='_blank'>
                    <img src="<?php  echo tomedia($mentor['head_url'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                    </a>
                    <?php  } ?>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>二维码</label>
                <div class="col-sm-9 col-xs-12 detail-logo">
                    <?php if( ce('commission.mentor' ,$mentor) ) { ?>
                    <?php  echo tpl_form_field_image('qr_code', $mentor['qr_code'])?>
                    <span class="help-block">建议尺寸: 320 * 320 ，或正方型图片 </span>
                    <?php  } else { ?>
                    <?php  if(!empty($mentor['qr_code'])) { ?>
                    <a href='<?php  echo tomedia($mentor['qr_code'])?>' target='_blank'>
                    <img src="<?php  echo tomedia($mentor['qr_code'])?>" style='width:100px;border:1px solid #ccc;padding:1px' />
                    </a>
                    <?php  } ?>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>微信号</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('commission.mentor' ,$mentor) ) { ?>
                    <input type="text" name="wechat" id="wechat" class="form-control" value="<?php  echo $mentor['wechat'];?>" />
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $mentor['wechat'];?></div>
                    <?php  } ?>
                </div>
            </div>

        </div>
    </div>
    <div class="form-group col-sm-12">
        <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" />
        <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
    </div>
    </form>
</div>

<script language='javascript'>
    $('form').submit(function(){
        if($(':input[name=name]').isEmpty()){
            Tip.focus($(':input[name=name]'),'请输入导师姓名!');
            return false;
        }else{
            var nametext=$(':input[name=name]').val();
            var length=nametext.length;
            if(length > 10){
                Tip.focus($(':input[name=name]'),'姓名不能超过十个字!');
                return false;
            }

        }
        if ($.trim($(':input[name="head_url"]').val()) == '') {
            Tip.focus(':input[name="head_url"]', '请上传头像.');
            return false;
        }
        if ($.trim($(':input[name="qr_code"]').val()) == '') {
            Tip.focus(':input[name="qr_code"]', '请上传二维码.');
            return false;
        }
        if ($.trim($(':input[name="wechat"]').val()) == '') {
            Tip.focus(':input[name="wechat"]', '请输入微信号.');
            return false;
        }

            return true;
    })

</script>
<?php  } else if($operation == 'display') { ?>


<div class="main">

    <style>
        .label{cursor:pointer;}
    </style>
    <div class="panel panel-default">
        <div class="panel-body">
            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('commission/mentor', array('op' => 'post'))?>"><i class='fa fa-plus'></i> 添加导师</a>
        </div>
    </div>
    <form action="" method="post">
        <div class="panel panel-default">
            <div class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:60px;">导师ID</th>
                        <th style="width:300px;">导师</th>
                        <th style="width:200px;">微信号</th>

                        <th style="">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($others)) { foreach($others as $item) { ?>
                    <tr>

                        <td><?php  echo $item['id'];?></td>
                        <td>
                            <img src='<?php  echo $item['head_url'];?>' style='width:30px;height:30px;padding1px;border:1px solid #ccc' />
                            <?php  echo $item['name'];?></td>
                        <td><?php  echo $item['wechat'];?></td>


                        <td style="position:relative;">

                            <?php if(cv('commission.mentor.edit|commission.mentor.view')) { ?><a href="<?php  echo $this->createPluginWebUrl('commission/mentor', array('op' => 'post', 'id' => $item['id']))?>"class="btn btn-sm btn-default" title="<?php if(cv('commission.mentor.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-pencil"></i></a><?php  } ?>
                            <?php if(cv('commission.mentor.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('commission/mentor', array('id' => $item['id'], 'op' => 'delete'))?>" onclick="return confirm('确认删除导师？');return false;" class="btn btn-default  btn-sm" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <tr>
                        <td colspan='9'>
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('commission/mentor', array('op' => 'post'))?>"><i class='fa fa-plus'></i> 添加导师</a>


                        </td>
                    </tr>

                    </tr>
                    </tbody>
                </table>
                <?php  echo $pager;?>
            </div>
        </div>
    </form>
</div>
<?php  } ?>


<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>