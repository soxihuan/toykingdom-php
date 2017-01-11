<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/order/tabs', TEMPLATE_INCLUDEPATH)) : (include template('web/order/tabs', TEMPLATE_INCLUDEPATH));?>
<link href="../addons/ewei_shop/static/js/dist/select2/select2.css" rel="stylesheet">
<link href="../addons/ewei_shop/static/js/dist/select2/select2-bootstrap.css" rel="stylesheet">
<script language="javascript" src="../addons/ewei_shop/static/js/dist/select2/select2.min.js"></script>
<script language="javascript" src="../addons/ewei_shop/static/js/dist/select2/select2_locale_zh-CN.js"></script>
<style type='text/css'>
    .trhead td {  background:#efefef;text-align: center}
    .trbody td {  text-align: center; vertical-align:top;border-left:1px solid #ccc;overflow: hidden;}
    .goods_info{position:relative;width:60px;}
    .goods_info img {width:50px;background:#fff;border:1px solid #CCC;padding:1px;}
    .goods_info:hover {z-index:1;position:absolute;width:auto;}
    .goods_info:hover img{width:320px; height:320px; }

    .form-control .select2-choice {
        border: 0 none;
        border-radius: 2px;
        height: 32px;    line-height: 32px;
    }
    .changeTips{height: 25px;width: 50px;background: #eea236;color: #fff;font-size: 14px;text-align: center;line-height: 25px;float: right;margin-right: 30%;
        cursor: pointer;border-radius: 3px;}
    .Myone{background: #eea236;}
    .MyTwo{background: #d9534f;display: none;}
</style>

<div class="panel panel-default">
    <div class="panel-body">
        <form action="./index.php" method="get" class="form-horizontal" role="form" id="form1">
            <input type="hidden" name="c" value="site" />
            <input type="hidden" name="a" value="entry" />
            <input type="hidden" name="m" value="ewei_shop" />
            <input type="hidden" name="do" value="order" />
            <input type="hidden" name="status" value="<?php  echo $status;?>" />
            <input type="hidden" name="agentid" value="<?php  echo $_GPC['agentid'];?>" />
            <input type="hidden" name="refund" value="<?php  echo $_GPC['refund'];?>" />
            <div class="form-group">
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <div class='input-group'>
                        <div class='input-group-addon'>订单号</div>
                        <input class="form-control" name="keyword" type="text" value="<?php  echo $_GPC['keyword'];?>" placeholder="订单号">
                        <div class='input-group-addon'>快递单号</div>
                        <input class="form-control" name="expresssn" type="text" value="<?php  echo $_GPC['expresssn'];?>" placeholder="快递单号">
                        <div class='input-group-addon'>用户信息</div>
                        <input class="form-control" name="member" type="text" value="<?php  echo $_GPC['member'];?>" placeholder="用户手机号/姓名/昵称, 收件人姓名/手机号 ">
                        <div class='input-group-addon'>支付方式</div>
                        <select name="paytype" class="form-control">
                            <option value="" <?php  if($_GPC['paytype']=='') { ?>selected<?php  } ?>>不限</option>
                            <?php  if(is_array($paytype)) { foreach($paytype as $key => $type) { ?>
                            <option value="<?php  echo $key;?>" <?php  if($_GPC['paytype'] == "$key") { ?> selected="selected" <?php  } ?>><?php  echo $type['name'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class='form-group'>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <div class='input-group'>
                        <div class='input-group-addon'>商品名称</div>
                        <input class="form-control" name="goodstitle" type="text" value="<?php  echo $_GPC['goodstitle'];?>" placeholder="商品名称">

                        <div class='input-group-addon'>商品编号</div>
                        <input class="form-control" name="goodssn" type="text" value="<?php  echo $_GPC['goodssn'];?>" placeholder="商品编号">

                        <div class='input-group-addon'>核销员</div>
                        <input class="form-control" name="saler" type="text" value="<?php  echo $_GPC['saler'];?>" placeholder="核销员昵称/姓名/手机号">
                        <div class='input-group-addon'>核销门店</div>
                        <select name="storeid" class="form-control select2" style='height:35px;'>
                            <option value="" ></option>
                            <?php  if(is_array($stores)) { foreach($stores as $store) { ?>
                            <option value="<?php  echo $store['id'];?>" <?php  if($_GPC['storeid'] ==$store['id']) { ?> selected="selected" <?php  } ?>><?php  echo $store['storename'];?></option>
                            <?php  } } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-6">

                    <div class='input-group'>
                        <div class='input-group-addon'>下单时间
                            <label class='radio-inline' style='margin-top:-7px;'>
                                <input type='radio' value='0' name='searchtime' <?php  if($_GPC['searchtime']=='0') { ?>checked<?php  } ?>>不搜索
                            </label>
                            <label class='radio-inline'  style='margin-top:-7px;'>
                                <input type='radio' value='1' name='searchtime' <?php  if($_GPC['searchtime']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                        </div>
                        <?php  echo tpl_form_field_daterange('time', array('starttime'=>date('Y-m-d H:i', $starttime),'endtime'=>date('Y-m-d H:i', $endtime)),true);?>

                        <div class='input-group-addon'>完成时间
                            <label class='radio-inline' style='margin-top:-7px;'>
                                <input type='radio' value='0' name='fsearchtime' <?php  if($_GPC['fsearchtime']=='0') { ?>checked<?php  } ?>>不搜索
                            </label>
                            <label class='radio-inline'  style='margin-top:-7px;'>
                                <input type='radio' value='1' name='fsearchtime' <?php  if($_GPC['fsearchtime']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                        </div>
                        <?php  echo tpl_form_field_daterange('ftime', array('starttime'=>date('Y-m-d H:i', $fstarttime),'endtime'=>date('Y-m-d H:i', $fendtime)),true);?>
                    </div>

                </div>

            </div>

            <div class="form-group">

                <div class="col-sm-6">

                    <div class='input-group'>
                        <div class='input-group-addon'>付款时间
                            <label class='radio-inline' style='margin-top:-7px;'>
                                <input type='radio' value='0' name='psearchtime' <?php  if($_GPC['psearchtime']=='0') { ?>checked<?php  } ?>>不搜索
                            </label>
                            <label class='radio-inline'  style='margin-top:-7px;'>
                                <input type='radio' value='1' name='psearchtime' <?php  if($_GPC['psearchtime']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                        </div>
                        <?php  echo tpl_form_field_daterange('ptime', array('starttime'=>date('Y-m-d H:i', $pstarttime),'endtime'=>date('Y-m-d H:i', $pendtime)),true);?>

                        <div class='input-group-addon'>发货时间
                            <label class='radio-inline' style='margin-top:-7px;'>
                                <input type='radio' value='0' name='ssearchtime' <?php  if($_GPC['ssearchtime']=='0') { ?>checked<?php  } ?>>不搜索
                            </label>
                            <label class='radio-inline'  style='margin-top:-7px;'>
                                <input type='radio' value='1' name='ssearchtime' <?php  if($_GPC['ssearchtime']=='1') { ?>checked<?php  } ?>>搜索
                            </label>
                        </div>
                        <?php  echo tpl_form_field_daterange('stime', array('starttime'=>date('Y-m-d H:i', $sstarttime),'endtime'=>date('Y-m-d H:i', $sendtime)),true);?>
                    </div>

                </div>

                <?php  if(!empty($agentid) && $level>0) { ?>
                <div class="col-sm-3">
                    <div class='input-group'>
                        <div class='input-group-addon'>分销订单级数</div>
                        <select name="olevel" class="form-control">
                            <option value="" >不限</option>
                            <option value="1" <?php  if($_GPC['olevel'] ==1) { ?> selected="selected" <?php  } ?>>一级订单</option>
                            <option value="2" <?php  if($_GPC['olevel'] ==2) { ?> selected="selected" <?php  } ?>>二级订单</option>
                            <option value="3" <?php  if($_GPC['olevel'] ==3) { ?> selected="selected" <?php  } ?>>三级订单</option>
                        </select>
                    </div>    </div>
                <?php  } ?>

            </div>
            <div class='form-group'>
                <div class="col-sm-8 col-lg-9 col-xs-12">
                    <div class='input-group'>
                        <div class='input-group-addon'>备注</div>
                        <input class="form-control" style="width: 30%" name="remark" type="text" value="<?php  echo $_GPC['remark'];?>" placeholder="订单备注">

                    </div>
                </div>
            </div>
            <div class="form-group">

                <div class="col-sm-7 col-lg-9 col-xs-12">
                    <button class="btn btn-default"><i class="fa fa-search"></i> 搜索</button>
                    <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
                    <button type="submit" name="export" value="1" class="btn btn-primary">导出 Excel</button>
                    <a class="btn btn-warning" href="<?php  echo $this->createWebUrl('order/export')?>">自定义导出</a>
                </div>
            </div>

        </form>
    </div>
</div>


<table class='table' style='float:left;border:1px solid #ccc;margin-bottom:5px;table-layout: fixed'>
    <tr class='trhead'>
        <td colspan='2' style='width:460px;text-align: left'>订单数: <?php  echo $total;?> 订单金额: <?php  echo $totalmoney;?></td>
        <td  style='width:150px;text-align:left;'>单价/数量</td>
        <td  >买家</td>
        <td >支付方式/配送方式</td>
        <td  style='width:200px;'>价格</td>
        <td >状态</td>
        <td>操作</td>
    </tr>
</table>

<?php  if(is_array($list)) { foreach($list as $item) { ?>
<table class='table' style='float:left;border:1px solid #ccc;margin-top:5px;margin-bottom:0px;table-layout: fixed;'>
    <tr >
        <td colspan='8'  style='border-bottom:1px solid #ccc;background:#efefef;' >
            <b>订单编号:</b>  <?php  echo $item['ordersn'];?>
            <b>下单时间:  </b><?php  echo date('Y-m-d H:i:s', $item['createtime'])?>
            <?php  if(!empty($item['refundstate'])) { ?><label class='label label-danger'><?php  echo $r_type[$item['rtype']];?>申请</label><?php  } ?>
            <?php  if($item['rstatus'] == 4) { ?><label class='label label-primary'>客户已经寄出快递</label><?php  } ?>
            <?php  if(!empty($agentid)) { ?>
            <b>分销订单级别:</b> <?php  echo $item['level'];?>级 <b>分销佣金:</b> <?php  echo $item['commission'];?> 元

            <?php  } ?>
            <?php  if(!empty($level)) { ?>

            <?php  if(empty($agentid)) { ?>
            <?php  if($item['commission1']!=-1) { ?><b>1级佣金:</b> <?php  echo $item['commission1'];?> 元 <?php  } ?>
            <?php  if($item['commission2']!=-1) { ?><b>2级佣金:</b> <?php  echo $item['commission2'];?> 元 <?php  } ?>
            <?php  if($item['commission3']!=-1) { ?><b>3级佣金:</b> <?php  echo $item['commission3'];?> 元 <?php  } ?>
            <?php  } ?>
            <?php  if(!empty($item['agentid'])) { ?>
            <?php if(cv('commission.changecommission')) { ?>
            <a href='javascript:;' class='btn btn-default' onclick="commission_change('<?php  echo $item['id'];?>')">修改佣金</a>
            <?php  } ?>
            <?php  } ?>

            <?php  } ?>
        </td>
        <td style='border-bottom:1px solid #ccc;background:#efefef;text-align: center' >
            <?php  if(empty($item['statusvalue'])) { ?>
            <?php if(cv('order.op.close')) { ?>
            <a class="btn btn-default btn-sm" href="javascript:;" onclick="$('#modal-close').find(':input[name=id]').val('<?php  echo $item['id'];?>')" data-toggle="modal" data-target="#modal-close">关闭订单</a>
            <?php  } ?>
            <?php  } ?>
        </td>

    </tr>
</table>
<table class='table' style='float:left;border:1px solid #ccc;border-top:none;table-layout: fixed;'>


    <?php  if(is_array($item['goods'])) { foreach($item['goods'] as $k => $g) { ?>
    <tr class='trbody'>
        <td class="goods_info">
            <img src="<?php  echo tomedia($g['thumb'])?>">
        </td>
        <td valign='top'  style='border-left:none;text-align: left;width:400px;'  >
            <?php  echo $g['title'];?><?php  if(!empty($g['optiontitle'])) { ?><br/><span class="label label-primary"><?php  echo $g['optiontitle'];?></span><?php  } ?>
            <br/><?php  echo $g['goodssn'];?>
        </td>
        <td style='border-left:none;text-align:left;width:150px'>原价: <?php  echo number_format( $g['price']/$g['total'],2)?> <br />应付: <?php  echo number_format($g['realprice']/$g['total'],2)?>
            <br/>数量: <?php  echo $g['total'];?>
        </td>

        <?php  if($k==0) { ?>
        <td rowspan="<?php  echo count($item['goods'])?>" >
            <?php if(cv('member.member.edit')) { ?>
            <a href="<?php  echo $this->createWebUrl('member/list',array('op'=>'detail', 'id'=>$item['mid']))?>"> <?php  echo $item['nickname'];?></a>
            <?php  } else { ?>
            <?php  echo $item['nickname'];?>
            <?php  } ?>

            <br/>
            <?php  echo $item['addressdata']['realname'];?><br/><?php  echo $item['addressdata']['mobile'];?></td>
        <td rowspan="<?php  echo count($item['goods'])?>"    >

            <?php  if($item['statusvalue'] > 0) { ?>
            <label class='label label-<?php  echo $item['css'];?>'><?php  echo $item['paytype'];?></label><br/>
            <?php  } else if($item['statusvalue'] == 0) { ?>
            <?php  if($item['paytypevalue'] == 3) { ?>
            <label class='label label-default'>货到付款</label><br/>
            <?php  } else { ?>
            <label class='label label-default'>未支付</label><br/>
            <?php  } ?>
            <?php  } else if($item['statusvalue'] == -1) { ?>
            <label class='label label-default'><?php  echo $item['paytype'];?></label><br/>
            <?php  } ?>



            <?php  echo $item['dispatchname'];?>
            <?php  if($item['addressid']!=0 && $item['statusvalue']>=2) { ?><br/>
            <button type='button' class='btn btn-default btn-sm' onclick='express_find(this,"<?php  echo $item['id'];?>")' >查看物流</button>
            <?php  } ?>
        </td>
        <td  rowspan="<?php  echo count($item['goods'])?>" style='width:200px;'>
            <table style='width:100%;'>
                <tr>
                    <td  style='border:none;text-align:right;'>商品小计：</td>
                    <td  style='border:none;text-align:right;;'>￥<?php  echo number_format( $item['goodsprice'] ,2)?></td>
                </tr>
                <tr>
                    <td  style='border:none;text-align:right;'>运费：</td>
                    <td  style='border:none;text-align:right;;'>￥<?php  echo number_format( $item['olddispatchprice'],2)?></td>
                </tr>
                <?php  if($item['discountprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>会员折扣：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['discountprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>积分抵扣：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['deductprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductcredit2']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>余额抵扣：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['deductcredit2'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['deductenough']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>满额立减：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['deductenough'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if($item['couponprice']>0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>优惠券优惠：</td>
                    <td  style='border:none;text-align:right;;'>-￥<?php  echo number_format( $item['couponprice'],2)?></td>
                </tr>
                <?php  } ?>
                <?php  if(intval($item['changeprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改价：</td>
                    <td  style='border:none;text-align:right;;'><span style="<?php  if(0<$item['changeprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>"><?php  if(0<$item['changeprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo number_format(abs($item['changeprice']),2)?></span></td>
                </tr>
                <?php  } ?>
                <?php  if(intval($item['changedispatchprice'])!=0) { ?>
                <tr>
                    <td  style='border:none;text-align:right;'>卖家改运费：</td>
                    <td  style='border:none;text-align:right;;'><span style="<?php  if(0<$item['changedispatchprice']) { ?>color:green<?php  } else { ?>color:red<?php  } ?>"><?php  if(0<$item['changedispatchprice']) { ?>+<?php  } else { ?>-<?php  } ?>￥<?php  echo abs($item['changedispatchprice'])?></span></td>
                </tr>
                <?php  } ?>
                <tr>
                    <td style='border:none;text-align:right;'>应收款：</td>
                    <td  style='border:none;text-align:right;color:green;'>￥<?php  echo number_format($item['price'],2)?></td>
                </tr>
                <?php if(cv('order.op.changeprice')) { ?>
                <?php  if(empty($item['statusvalue'])) { ?>
                <tr>
                    <td style='border:none;text-align:right;'></td>
                    <td  style='border:none;text-align:right;color:green;'><a href="javascript:;" class="btn btn-link " onclick="changePrice('<?php  echo $item['id'];?>')">修改价格</a></td>
                </tr>
                <?php  } ?>  <?php  } ?>
            </table>
        </td>
        <td   rowspan="<?php  echo count($item['goods'])?>" ><label class='label label-<?php  echo $item['statuscss'];?>'><?php  echo $item['status'];?></label><br />
            <a href="<?php  echo $this->createWebUrl('order', array('op' => 'detail', 'id' => $item['id']))?>"   >查看详情</a></td>
        <td   rowspan="<?php  echo count($item['goods'])?>" >
            <?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/order/ops', TEMPLATE_INCLUDEPATH)) : (include template('web/order/ops', TEMPLATE_INCLUDEPATH));?>


        </td>
        <?php  } ?>
    </tr>

    <?php  } } ?>
    <tr >
        <td colspan='8'  style='border-bottom:1px solid #ccc;' >

            收货地址：<?php  echo $item['addressdata']['realname'];?> <?php  echo $item['addressdata']['mobile'];?> <?php  echo $item['addressdata']['address'];?>
        </td>
    </tr>
    <tr >
        <td colspan='8'  style='border-bottom:1px solid #ccc;background:#FEFCE5;' >
            <div style="width:100%;height:40px;" class="nameParent">
            <style>
                    .postName{text-align: center;border-radius: 3px;color: #fff;cursor: pointer;}
            </style>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">吴婷</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">春兰</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">红艳</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">盼盼</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">谣谣</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">凤梅</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">善花</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">明月</span>
                <span class="postName" style="display:block;width:70px;height:25px;background:#acc0d0;color:#555;float:left;margin-left:30px;line-height:25px;">亚楠</span>

            </div>
            <b mysn="<?php  echo $item['ordersn'];?>">备注:</b><!-- <span class="tdedit" style="color: #ef4f4f"><?php  echo $item['remark'];?></span> -->
                <input type="text" disabled="disabled" style="display:inline-block;width:60%;color:#d9534f;border:none;" class="tdedit orm-control" value="<?php  echo $item['remark'];?>">
             <div class="changeTips Myone">修改</div>
             <div class="changeTips MyTwo">完成</div> 
        </td>
    </tr>

</table>

<?php  } } ?>

<?php  echo $pager;?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/order/modals', TEMPLATE_INCLUDEPATH)) : (include template('web/order/modals', TEMPLATE_INCLUDEPATH));?>
<?php  if(p('commission')) { ?>

<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('commission/changecommission', TEMPLATE_INCLUDEPATH)) : (include template('commission/changecommission', TEMPLATE_INCLUDEPATH));?>
<?php  } ?>
<script language='javascript'>
    $(function () {
        $('.select2').select2({
            search: true,
            placeholder: "请选择门店",
            allowClear: true
        });

        $('.Myone').click(function(event) {
            $(this).siblings('.tdedit').removeAttr('disabled')
            $(this).hide();
            $(this).siblings('.MyTwo').show();
        });
       $('.MyTwo').click(function(event) {
            $(this).siblings('.tdedit').prop('disabled','disabled');
            var MyChangeTip = $(this).siblings('.tdedit').val();
            var mysn = $(this).siblings('b').attr('mysn');
            $.ajax({
                url:'<?php  echo $this->createWebUrl('order/list')?>',
                type: "post",
                data: {op: 'MyChangeTip', MyChangeTip:MyChangeTip,mysnn:mysn},
                cache: false,
                success: function (data) {
                    var callBackStr = JSON.parse(data);
                    if (callBackStr.status == 1) {
                        alert('修改留言成功')
                    };
                }
           })
            $(this).hide();
             $(this).siblings('.Myone').show();
        });

       $('.postName').click(function(event) {
           var thisName = $(this).text();
           var valNow = $(this).parent('.nameParent').siblings('input').val()
           var PDnum = valNow.indexOf('*');
           var needtext = thisName+"   *"+ $(this).parent('.nameParent').siblings('input').val().substring(PDnum+1);
           $(this).parent('.nameParent').siblings('input').val(needtext);

            
            var MyChangeTip = needtext;
            var mysn =$(this).parent('.nameParent').siblings('b').attr('mysn');
           $.ajax({
                url:'<?php  echo $this->createWebUrl('order/list')?>',
                type: "post",
                data: {op: 'MyChangeTip', MyChangeTip:MyChangeTip,mysnn:mysn},
                cache: false,
                success: function (data) {
                    var callBackStr = JSON.parse(data);
                    if (callBackStr.status == 1) {
                           
                    };
                }
           })

       });

    });
</script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>
