<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>


<div class="main">
<div class="panel panel-info">
    <div class="panel-heading">筛选</div>
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shop" />
            <input type="hidden" name="do" value="plugin" />
            <input type="hidden" name="p"  value="moments" />
            <input type="hidden" name="op" value="display" />
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                <div class="col-xs-12 col-sm-8 col-lg-9">
                    <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">状态</label>
                <div class="col-xs-12 col-sm-8 col-lg-9">
                    <select name="status" class='form-control'>
                        <option value="" <?php  if($_GPC['status'] == '') { ?> selected<?php  } ?>></option>
                        <option value="1" <?php  if($_GPC['status']== '1') { ?> selected<?php  } ?>>上架</option>
                        <option value="0" <?php  if($_GPC['status'] == '0') { ?> selected<?php  } ?>>下架</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-1 control-label">分类</label>
                <div class="col-sm-8 col-xs-12">
                    <?php  if(intval($shopset['catlevel'])==3) { ?>
                    <?php  echo tpl_form_field_category_3level('category', $parent, $children, $params[':pcate'], $params[':ccate'], $params[':tcate'])?>
                    <?php  } else { ?>
                    <?php  echo tpl_form_field_category_2level('category', $parent, $children, $params[':pcate'], $params[':ccate'])?>
                    <?php  } ?>
                </div>
                <div class="col-xs-12 col-sm-2 col-lg-2">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                </div>
            </div>

            <div class="form-group">
            </div>
        </form>
    </div>
</div>
<style>
    .label{cursor:pointer;}
</style>

<form action="" method="post">
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">ID</th>
                    <th style="width:60px;">商品</th>
                    <th  style="width:300px;">&nbsp;</th>
                    <th style="">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>

                    <td><?php  echo $item['id'];?></td>
                    <td title="<?php  echo $item['title'];?>">
                        <img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
                    </td>
                    <td title="<?php  echo $item['title'];?>" class='tdedit'>
                        <?php  if(!empty($category[$item['pcate']])) { ?>
                        <span class="text-danger">[<?php  echo $category[$item['pcate']]['name'];?>]</span>
                        <?php  } ?>
                        <?php  if(!empty($category[$item['ccate']])) { ?>
                        <span class="text-info">[<?php  echo $category[$item['ccate']]['name'];?>]</span>
                        <?php  } ?>
                        <?php  if(!empty($category[$item['tcate']]) && intval($shopset['catlevel'])==3) { ?>
                        <span class="text-info">[<?php  echo $category[$item['tcate']]['name'];?>]</span>
                        <?php  } ?>
                        <br/>
                        <?php if(cv('shop.goods.edit')) { ?>

                        <span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item['title'];?></span> </span>
                        <div class="input-group goodstitle" style="display:none" data-goodsid="<?php  echo $item['id'];?>">
                            <input type='text' class='form-control' value="<?php  echo $item['title'];?>"   />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['id'];?>' data-type="title"><i class="fa fa-check"></i></button>
                            </div>
                        </div>
                        <?php  } else { ?>
                        <?php  echo $item['title'];?>
                        <?php  } ?>
                    </td>

                    <td style="position:relative;">
                        <?php if(cv('moments.edit|moments.view')) { ?><a href="<?php  echo $this->createPluginWebUrl('moments', array('id' => $item['id'], 'op' => 'post'))?>"class="btn btn-sm btn-default" title="<?php if(cv('shop.goods.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-pencil"></i></a><?php  } ?>
                    </td>
                </tr>
                <?php  } } ?>
                <tr>

                </tr>

                </tr>
                </tbody>
            </table>
            <?php  echo $pager;?>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    function fastChange(id, type, value) {

        $.ajax({
            url: "<?php  echo $this->createWebUrl('shop/goods')?>",
            type: "post",
            data: {op: 'change', id: id, type: type, value: value},
            cache: false,
            success: function () {

            }
        })
    }


</script>
<?php  } else if($operation == 'post') { ?>
<form <?php if(cv('moments.edit|moments.check')) { ?>action="" method='post'<?php  } ?> class='form-horizontal'>
<input type="hidden" name="id" value="<?php  echo $item['id'];?>">


<div class='panel panel-default'>


    <div class='panel-heading'>
        多文案添加
    </div>
    <div class='panel-body'>

        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案</label>
            <div class="col-sm-6 col-xs-6">
                <?php if( ce('shop.goods' ,$item) ) { ?>
                <textarea name="moments_copy" id="moments_copy" class="form-control" ><?php  echo $item['moments_copy'];?></textarea>
                <span class="help-block">如果不填写，默认为商品名称，最多500字 </span>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['moments_copy'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('shop.goods' ,$item) ) { ?>
                <?php  echo tpl_form_field_multi_image('moments_imgs',$wa_piclist)?>
                <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 ，最多上传九张 </span>
                <?php  } else { ?>
                <?php  if(is_array($wa_piclist)) { foreach($wa_piclist as $p) { ?>
                <a href='<?php  echo tomedia($p)?>' target='_blank'>
                    <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                </a>
                <?php  } } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案</label>
            <div class="col-sm-6 col-xs-6">
                <?php if( ce('shop.goods' ,$item) ) { ?>

                <textarea name="moments_copy2" id="moments_copy2" class="form-control" ><?php  echo $item['moments_copy2'];?></textarea>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['moments_copy2'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('shop.goods' ,$item) ) { ?>
                <?php  echo tpl_form_field_multi_image('moments_imgs2',$wa_piclist2)?>
                <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 ，最多上传九张</span>
                <?php  } else { ?>
                <?php  if(is_array($wa_piclist2)) { foreach($wa_piclist2 as $p) { ?>
                <a href='<?php  echo tomedia($p)?>' target='_blank'>
                    <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                </a>
                <?php  } } ?>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案</label>
            <div class="col-sm-6 col-xs-6">
                <?php if( ce('shop.goods' ,$item) ) { ?>

                <textarea name="moments_copy3" id="moments_copy3" class="form-control" ><?php  echo $item['moments_copy3'];?></textarea>
                <?php  } else { ?>
                <div class='form-control-static'><?php  echo $item['moments_copy3'];?></div>
                <?php  } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案图片</label>
            <div class="col-sm-9 col-xs-12">
                <?php if( ce('shop.goods' ,$item) ) { ?>
                <?php  echo tpl_form_field_multi_image('moments_imgs3',$wa_piclist3)?>
                <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 ，最多上传九张</span>
                <?php  } else { ?>
                <?php  if(is_array($wa_piclist3)) { foreach($wa_piclist3 as $p) { ?>
                <a href='<?php  echo tomedia($p)?>' target='_blank'>
                    <img src="<?php  echo tomedia($p)?>" style='height:100px;border:1px solid #ccc;padding:1px;float:left;margin-right:5px;' />
                </a>
                <?php  } } ?>
                <?php  } ?>
            </div>
        </div>

        <div class='panel-body'>

            <div class="form-group"></div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <?php if(cv('moments.edit|moments.check')) { ?>
                    <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1"  />
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <?php  } ?>
                    <input type="button" name="back" onclick='history.back()' <?php if(cv('moments.edit|moments.check')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default" />
                </div>
            </div>


        </div>
    </div>
</div>
</form>
<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>