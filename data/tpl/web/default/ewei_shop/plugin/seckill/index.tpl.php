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
                <input type="hidden" name="p"  value="seckill" />
                <input type="hidden" name="op" value="display" />
                <div class="form-group">
                    <label class="col-xs-12 col-sm-2 col-md-2 col-lg-1 control-label">关键字</label>
                    <div class="col-xs-12 col-sm-8 col-lg-9">
                        <input class="form-control" name="keyword" id="" type="text" value="<?php  echo $_GPC['keyword'];?>">
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
                        <th style="width:300px;">限时购买时间</th>
                        <th style="width:150px;">库存</th>

                        <th style="">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>

                        <td><?php  echo $item['gid'];?></td>
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
                            <div class="input-group goodstitle" style="display:none" data-goodsid="<?php  echo $item['gid'];?>">
                                <input type='text' class='form-control' value="<?php  echo $item['title'];?>"   />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-goodsid='<?php  echo $item['gid'];?>' data-type="title"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <?php  } else { ?>
                            <?php  echo $item['title'];?>
                            <?php  } ?>
                        </td>
                        <td><?php  echo date('Y-m-d H:i', $item['timestart'])?> - <?php  echo date('Y-m-d H:i', $item['timeend'])?></td>
                        <td><?php  echo $item['total'];?></td>
                        <td style="position:relative;">
                            <label data='<?php  echo $item['iskill'];?>' class='label label-default <?php  if($item['iskill']==1) { ?>label-info<?php  } ?>' <?php if(cv('seckill.edit')) { ?>onclick="setProperty(this,<?php  echo $item['sid'];?>,'kill')"<?php  } ?>>秒杀</label>

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

    function setProperty(obj, sid, type) {
        $(obj).html($(obj).html() + "...");
        $.post("<?php  echo $this->createPluginWebUrl('seckill')?>"
                , {'op': 'setgoodsproperty', id: sid, type: type, data: obj.getAttribute("data")}
                , function (d) {
                    $(obj).html($(obj).html().replace("...", ""));

                    $(obj).attr("data", d.data);
                    if (d.result == 1) {
                        $(obj).toggleClass("label-info");
                    }
                }
                , "json"
        );
    }

</script>
<?php  } else if($operation == 'post') { ?>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>