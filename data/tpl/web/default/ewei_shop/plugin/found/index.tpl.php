<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>


<div class="main">
    <div class="panel panel-info">
        <div class="panel-heading">筛选</div>
        <div class="panel-body">
            <form action="./index.php" method="get" class="form-horizontal" plugins="form">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shop" />
                <input type="hidden" name="do" value="plugin" />
                <input type="hidden" name="p"  value="found" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label"></label>
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
                        <th style="width:50px;">ID</th>
                        <th>标题</th>
                        <th>商品</th>
                        <th>发布时间</th>
                        <th >操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($others)) { foreach($others as $row) { ?>
                    <tr>
                        <td><?php  echo $row['id'];?></td>
                        <td><?php  echo $row['title'];?></td>
                        <td><?php  echo $row['goods_id'];?></td>
                        <td><?php  echo date('Y-m-d H:i:s', $row['createtime'])?></td>
                        <td style="position:relative;">
                            <?php if(cv('found.edit|found.view')) { ?><a href="<?php  echo $this->createPluginWebUrl('found', array('op' => 'post', 'id' => $row['id']))?>"class="btn btn-sm btn-default" title="<?php if(cv('shop.found.edit')) { ?>编辑<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-pencil"></i></a><?php  } ?>
                            <?php if(cv('found.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('found', array('id' => $row['id'], 'op' => 'delete'))?>" onclick="return confirm('确认删除发现？');return false;" class="btn btn-default  btn-sm"  title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                        </td>
                    </tr>
                    <?php  } } ?>
                    <tr>
                        <td colspan='6'>
                            <?php if(cv('found.add')) { ?>
                            <a class='btn btn-default' href="<?php  echo $this->createPluginWebUrl('found',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加发现</a>
                            <?php  } ?>

                            <?php if(cv('found.edit')) { ?>
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            <?php  } ?>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <?php  echo $pager;?>
            </div>
        </div>
    </form>
</div>
<script>
    require(['bootstrap'], function ($) {
        $('.btn').hover(function () {
            $(this).tooltip('show');
        }, function () {
            $(this).tooltip('hide');
        });
    });
</script>

<?php  } else if($operation == 'post') { ?>

<div class="main">
    <form action="" <?php if( ce('found' ,$mentor) ) { ?>action="" method="post"<?php  } ?>  class="form-horizontal form" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php  echo $mentor['id'];?>" />
    <div class='panel panel-default'>
        <div class='panel-heading'>
            发现设置
        </div>
        <div class='panel-body'>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>标题</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('shop.found' ,$mentor) ) { ?>
                    <input type="text" name="title" id="title" class="form-control" value="<?php  echo $mentor['ftitle'];?>" />
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $mentor['title'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style='color:red'>*</span>文案</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('shop.found' ,$mentor) ) { ?>
                    <input type="text" name="moments_copy" id="moments_copy" class="form-control" value="<?php  echo $mentor['moments_copy'];?>" />
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $mentor['moments_copy'];?></div>
                    <?php  } ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">文案图片</label>
                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('shop.goods' ,$mentor) ) { ?>
                    <?php  echo tpl_form_field_multi_image('moments_imgs',$wa_piclist)?>
                    <span class="help-block">建议尺寸: 640 * 640 ，或正方型图片 </span>
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
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">关联类型</label>
                    <div class="col-sm-9 col-xs-12" style="float: left;padding-right:100px;" id="ttttype">
                        <label for="isshow3" class="radio-inline"><input type="radio" name="type" value="1" id="isshow3" <?php  if(empty($mentor['ftype']) || $mentor['ftype'] == 1) { ?>checked="true"<?php  } ?> /> 商品</label>
                        <label for="isshow4" class="radio-inline"><input type="radio" name="type" value="2" id="isshow4"  <?php  if($mentor['ftype'] == 2) { ?>checked="true"<?php  } ?> /> 店铺</label>
                        <label for="isshow5" class="radio-inline"><input type="radio" name="type" value="3" id="isshow5"  <?php  if($mentor['ftype'] == 3) { ?>checked="true"<?php  } ?> /> 都不关联</label>
                    </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">关联商品</label>
                <div class="col-sm-9 col-xs-12" style="padding-right:100px;">
                    <input type='text' class='form-control' style="width: 100%;display: inline-block;float:left;" id='goods' name="goods_id" value="<?php  if(!empty($mentor)) { ?><?php  echo $mentor['goods_id'];?>;<?php  echo $mentor['gtitle'];?><?php  } ?>" readonly />
                    <div style="float: right">
                        <button type="button" onclick="$('#modal-goods').modal()" class="btn btn-default" style="position:absolute;">选择商品</button>
                    </div>
                </div>
            </div>


            <div class="form-group "   style="display: none">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></span>关联商品id</label>
                <div class="col-sm-9 col-xs-12">
                    <?php  if($mentor['goods_id'] != '') { ?>
                    <div class='form-control-static'><?php  echo $mentor['goods_id'];?></div>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  echo $_GPC['goods_id'];?></div>
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

<div id="modal-goods"  class="modal fade" tabindex="-1">
    <div class="modal-dialog" style='width: 920px;'>
        <div class="modal-content">
            <div class="modal-header"><button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button><h3>选择商品</h3></div>
            <div class="modal-body" >
                <div class="row">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" value="" id="search-kwd-goods" placeholder="请输入商品名称" />
                        <span class='input-group-btn'><button type="button" class="btn btn-default" onclick="search_goods();">搜索</button></span>
                    </div>
                </div>
                <div id="module-menus-goods" style="padding-top:5px;"></div>
            </div>
            <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal" aria-hidden="true">关闭</a></div>
        </div>

    </div>
</div>

<script language='javascript'>
    $('form').submit(function(){
        if($(':input[name="title"]').isEmpty()){
            Tip.focus(':input[name="title"]','请输入标题!');
            return false;
        }
        if ($.trim($(':input[name="moments_copy"]').val()) == '') {
            Tip.focus(':input[name="moments_copy"]', '请输入文案.');
            return false;
        }

        if ($.trim($(':input[name="type"]:checked').val()) == '1') {
            if($.trim($(':input[name="goods_id"]').val()) == '' || $.trim($(':input[name="goods_id"]').val()) == '0;'){
            Tip.focus(':input[name="goods_id"]', '请选择商品.');
            return false;
            }

        }

        return true;
    })
    function search_goods() {
        if( $.trim($('#search-kwd-goods').val())==''){
            Tip.focus('#search-kwd-goods','请输入关键词');
            return;
        }
        $("#module-goods").html("正在搜索....")
        $.get('<?php  echo $this->createWebUrl('shop/query')?>', {
            keyword: $.trim($('#search-kwd-goods').val())
        }, function(dat){
            $('#module-menus-goods').html(dat);
        });

    }
    function select_good(o) {
        $("#goodsid").val(o.id);
        $("#goods").val( o.id + ";" + o.title);
        $("#modal-goods .close").click();
        //alert($("#goods").val(o.id));
    }
</script>




<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>