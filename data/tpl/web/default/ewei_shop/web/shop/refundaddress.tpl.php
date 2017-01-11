<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/shop/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/shop/tabs', TEMPLATE_INCLUDEPATH));?>
<script type="text/javascript" src="../addons/ewei_shop/static/js/dist/area/cascade.js"></script>
<?php  if($operation == 'display') { ?>
<form action="" method="post">
<div class="main panel panel-default">
    <div class="panel-body table-responsive">
        <table class="table table-hover">
            <thead class="navbar-inner">
                <tr>
                    <th style="width:50px;">ID</th>
                    <th>退货地址名称</th>
                    <th>联系人</th>
                    <th>手机</th>
                    <th>地址</th>
                    <th>默认退货地址</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php  if(is_array($list)) { foreach($list as $item) { ?>
                <tr>
                    <td><?php  echo $item['id'];?></td>
                    <td><?php  echo $item['title'];?></td>
                    <td><?php  echo $item['name'];?></td>
                    <td><?php  echo $item['mobile'];?></td>
                    <td><?php  echo $item['address'];?></td>
                    <td><label class='label  label-default <?php  if($item['isdefault']==1) { ?>label-info<?php  } ?>' ><?php  if($item['isdefault']==1) { ?>是<?php  } else { ?>否<?php  } ?></label></td>
                    <td style="text-align:left;">
                         <?php if(cv('shop.refundaddress.view|shop.refundaddress.edit')) { ?><a href="<?php  echo $this->createWebUrl('shop/refundaddress', array('op' => 'post', 'id' => $item['id']))?>" class="btn btn-default btn-sm" title="<?php if(cv('shop.refundaddress.edit')) { ?>修改<?php  } else { ?>查看<?php  } ?>"><i class="fa fa-pencil"></i></a><?php  } ?>
                         <?php if(cv('shop.refundaddress.delete')) { ?><a href="<?php  echo $this->createWebUrl('shop/refundaddress', array('op' => 'delete', 'id' => $item['id']))?>" class="btn btn-default btn-sm" onclick="return confirm('确认删除此退货地址?')" title="删除"><i class="fa fa-times"></i></a><?php  } ?>
                    </td>
                </tr>
                <?php  } } ?>
                <tr>
                    <td colspan='9'>
                          <?php if(cv('shop.refundaddress.add')) { ?>
                        <a class='btn btn-default' href="<?php  echo $this->createWebUrl('shop/refundaddress',array('op'=>'post'))?>"><i class='fa fa-plus'></i> 添加退货地址</a>
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
    <form <?php if( ce('shop.refundaddress' ,$item) ) { ?>action="" method="post"<?php  } ?> class="form-horizontal form" enctype="multipart/form-data" onsubmit='return formcheck()'>
        <input type="hidden" name="id" value="<?php  echo $item['id'];?>" />
 
        <div class="panel panel-default">
            <div class="panel-heading">
                退货地址设置
            </div>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>退货地址名称</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <input type="text" id='title' name="title" class="form-control" value="<?php  echo $item['title'];?>" style="width: 300px;"/>
                          <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['title'];?></div>
                        <?php  } ?>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>联系人</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <input type="text" id='name' name="name" class="form-control" value="<?php  echo $item['name'];?>" style="width: 300px;"/>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['name'];?></div>
                        <?php  } ?>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"><span style="color:red">*</span>手机</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <input type="text" id='mobile' name="mobile" class="form-control" value="<?php  echo $item['mobile'];?>" style="width: 300px;"/>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['mobile'];?></div>
                        <?php  } ?>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">电话</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <input type="text" id='tel' name="tel" class="form-control" value="<?php  echo $item['tel'];?>" style="width: 300px;"/>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['mobile'];?></div>
                        <?php  } ?>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">邮编</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <input type="text" id='zipcode' name="zipcode" class="form-control" value="<?php  echo $item['zipcode'];?>" style="width: 300px;"/>
                        <?php  } else { ?>
                        <div class='form-control-static'><?php  echo $item['zipcode'];?></div>
                        <?php  } ?>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label">地址</label>
                    <div class="col-sm-9 col-xs-12">
                        <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                        <p class="form-control-static ad2" id="e_address">
                            <select id="sel-provance" name="province" onChange="selectCity();" class="select form-control" style="width:130px;display:inline;">
                                <option value="" selected="true">省/直辖市</option>
                            </select>
                            <select id="sel-city" name="city" onChange="selectcounty(0)" class="select form-control" style="width:135px;display:inline;">
                                <option value="" selected="true">请选择</option>
                            </select>
                            <select id="sel-area" name="area" class="select form-control" style="width:130px;display:inline;">
                                <option value="" selected="true">请选择</option>
                            </select>
                            <input type="text" name="address" id="address" class="form-control" style="width:300px;display:inline;" value="<?php  echo $item['address']?>">
                        </p>
                        <?php  } ?>

                    </div>
                </div>


                <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否为默认退货地址</label>

                <div class="col-sm-9 col-xs-12">
                    <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                    <label class='radio-inline'>
                        <input type='radio' name='isdefault' id="isdefault1" value='1' <?php  if($item['isdefault']==1) { ?>checked<?php  } ?> /> 是
                    </label>
                    <label class='radio-inline'>
                        <input type='radio' name='isdefault' id="isdefault0" value='0' <?php  if($item['isdefault']==0) { ?>checked<?php  } ?> /> 否
                    </label>
                    <?php  } else { ?>
                    <div class='form-control-static'><?php  if(empty($item['calculatetype'])) { ?>按重量计费<?php  } else { ?>按件计费<?php  } ?></div>
                    <?php  } ?>
                </div>
            </div>


            <div class="form-group"></div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                           <?php if( ce('shop.refundaddress' ,$item) ) { ?>
                            <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick="return formcheck()" />
                            <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                        <?php  } ?>
                       <input type="button" name="back" onclick='history.back()' <?php if(cv('shop.refundaddress.add|shop.refundaddress.edit')) { ?>style='margin-left:10px;'<?php  } ?> value="返回列表" class="btn btn-default col-lg-1" />
                    </div>
            </div>
            
            
            </div>
        </div>
     
    </form>
</div>


<script language='javascript'>

    $(function(){
        cascdeInit("<?php  echo $item['province']?>","<?php  echo $item['city']?>","<?php  echo $item['city']?>");
    });

    function formcheck() {

        if ($("#title").isEmpty()) {
            Tip.focus("title", "请填写退货地址名称!", "top");
            return false;
        }

        if ($("#name").isEmpty()) {
            Tip.focus("name", "请填写联系人!", "top");
            return false;
        }

        if ($("#mobile").isEmpty()) {
            Tip.focus("mobile", "请填写手机!", "top");
            return false;
        }

        if($('#sel-province').val()=='请选择省份') {
            Tip.focus("sel-province", "请选择省份!", "top");
            return false;
        }

        if ($("#address").isEmpty()) {
            Tip.focus("address", "请填写地址!", "top");
            return false;
        }

        return true;
    }
</script>

<?php  } ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>