<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<?php  if($operation == 'display') { ?>


<div class="main">
    <form action="" method="post">
        <div class="panel panel-default" style="width: 45%;float: left">
            <div style="padding-left:20px;padding-top: 10px;font-size: 16px">秒杀中</div>
            <div class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:60px;display:none">排序</th>
                        <th style="width:60px;">商品</th>
                        <th  style="width:300px;">&nbsp;</th>
                        <th style="width:150px;">结束时间</th>

                        <th style="width:150px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list)) { foreach($list as $item) { ?>
                    <tr>

                        <td style="display: none">
                            <?php if(cv('skill.edit')) { ?>
                            <input type="text" class="form-control" name="sequence[<?php  echo $item['sid'];?>]" value="<?php  echo $item['sequence'];?>">
                            <?php  } else { ?>
                            <?php  echo $item['sequence'];?>
                            <?php  } ?>
                        </td>
                        <td title="<?php  echo $item['title'];?>">
                            <img src="<?php  echo tomedia($item['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
                        </td>
                        <td title="<?php  echo $item['title'];?>" class='tdedit'>
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
                            <br/>
                            <span style="color: red"><?php  echo $item['total'];?></span>

                        </td>
                        <td><?php  echo date('Y-m-d H:i', $item['timeend'])?></td>
                        <td style="position:relative;">
                            <?php if(cv('skill.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('seckill/skill', array('id' => $item['sid'], 'op' => 'delete'))?>" onclick="return confirm('确认删除秒杀？');return false;" class="btn btn-default  btn-sm"  title="移除秒杀"><i class="fa">移除秒杀</i></a><?php  } ?>

                        </td>
                    </tr>
                    <?php  } } ?>
                    <tr>

                    <tr>
                        <td colspan='5' style="display: none">
                            <?php if(cv('skill.edit')) { ?>
                            <input name="submit" type="submit" class="btn btn-primary" value="提交排序">
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                            <?php  } ?>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
    <form action="" method="post">
        <div class="panel panel-default" style="width: 45%;float: right">
            <div style="padding-left:20px;padding-top: 10px;font-size: 16px">即将秒杀</div>
            <div class="panel-body table-responsive">
                <table class="table table-hover">
                    <thead class="navbar-inner">
                    <tr>
                        <th style="width:60px;display:none">排序</th>
                        <th style="width:60px;">商品</th>
                        <th  style="width:300px;">&nbsp;</th>
                        <th style="width:150px;">开始时间</th>
                        <th style="width:150px;">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  if(is_array($list2)) { foreach($list2 as $item2) { ?>
                    <tr>

                        <td style="display: none">
                            <?php if(cv('skill.edit')) { ?>
                            <input type="text" class="form-control" name="sequence[<?php  echo $item2['id'];?>]" value="<?php  echo $item2['sequence'];?>">
                            <?php  } else { ?>
                            <?php  echo $item2['sequence'];?>
                            <?php  } ?>
                        </td>
                        <td title="<?php  echo $item2['title'];?>">
                            <img src="<?php  echo tomedia($item2['thumb'])?>" style="width:40px;height:40px;padding:1px;border:1px solid #ccc;"  />
                        </td>
                        <td title="<?php  echo $item2['title'];?>" class='tdedit'>
                            <?php if(cv('shop.goods.edit')) { ?>

                            <span class=' fa-edit-item' style='cursor:pointer'><i class='fa fa-pencil' style="display:none"></i> <span class="title"><?php  echo $item2['title'];?></span> </span>
                            <div class="input-group goodstitle" style="display:none" data-goodsid="<?php  echo $item2['gid'];?>">
                                <input type='text' class='form-control' value="<?php  echo $item2['title'];?>"   />
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" data-goodsid='<?php  echo $item2['gid'];?>' data-type="title"><i class="fa fa-check"></i></button>
                                </div>
                            </div>
                            <?php  } else { ?>
                            <?php  echo $item2['title'];?>
                            <?php  } ?>
                            <br/>
                            <span style="color: red"><?php  echo $item2['total'];?></span>

                        </td>
                        <td><?php  echo date('Y-m-d H:i', $item2['timestart'])?></td>
                        <td style="position:relative;">
                            <?php if(cv('skill.delete')) { ?><a href="<?php  echo $this->createPluginWebUrl('seckill/skill', array('id' => $item2['sid'], 'op' => 'delete'))?>" onclick="return confirm('确认删除秒杀？');return false;" class="btn btn-default  btn-sm"  title="移除秒杀"><i class="fa">移除秒杀</i></a><?php  } ?>

                        </td>
                    </tr>
                    <?php  } } ?>
                    <tr>

                    </tr>

                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">



</script>
<?php  } else if($operation == 'post') { ?>

<?php  } ?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>