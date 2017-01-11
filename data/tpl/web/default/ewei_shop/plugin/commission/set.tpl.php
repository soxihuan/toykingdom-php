<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>
<form id="setform"  action="" method="post" class="form-horizontal form">
    <div class='panel panel-default'>
           <div class='panel-heading'>
            分销等级设置
        </div>
        <div class='panel-body'>

            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销层级</label>
                <div class="col-sm-4">
                    <select  class="form-control" name="setdata[level]">
                        <option value="0" <?php  if(empty($set['level'])) { ?>selected<?php  } ?>>不开启分销机制</option>
                        <option value="1" <?php  if($set['level']==1) { ?>selected<?php  } ?>>开启一级分销</option>
                        <option value="2" <?php  if($set['level']==2) { ?>selected<?php  } ?> >开启二级分销</option>
                        <option value="3" <?php  if($set['level']==3) { ?>selected<?php  } ?> >开启三级分销</option>
                    </select>
		<div class='help-block'>默认佣金比例请到<a href='<?php  echo $this->createPluginWEbUrl('commission/level')?>' target='_blank'>【分销商等级】</a>进行设置</div>
                </div>
            </div> 
                    <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销内购</label>
                <div class="col-sm-9 col-xs-12">
                     <label class="radio-inline"><input type="radio"  name="setdata[selfbuy]" value="0" <?php  if($set['selfbuy'] ==0) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[selfbuy]" value="1" <?php  if($set['selfbuy'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
                    <span class='help-block'>开启分销内购，分销商自己购买商品，享受一级佣金，上级享受二级佣金，上上级享受三级佣金</span>
                </div>
            </div>
            
        </div>
        <div class='panel-heading'>
            分销设置
        </div>
        <div class='panel-body'>
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为下线条件</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[become_child]" value="0" <?php  if($set['become_child'] ==0) { ?> checked="checked"<?php  } ?> /> 首次点击分享连接</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[become_child]" value="1" <?php  if($set['become_child'] ==1) { ?> checked="checked"<?php  } ?> /> 首次下单</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[become_child]" value="2" <?php  if($set['become_child'] ==2) { ?> checked="checked"<?php  } ?> /> 首次付款</label>
                    <span class='help-block'>首次点击分享连接： 可以自由设置分销商条件</span>
                    <span class='help-block'>首次下单/首次付款： 无条件不可用</span>
                </div>
               </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为分销商条件</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[become]" value="0" <?php  if($set['become'] ==0) { ?> checked="checked"<?php  } ?> /> 无条件</label>
                </div> 
            </div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-6">
                         <label class="radio-inline"><input type="radio"  name="setdata[become]" value="1" <?php  if($set['become'] ==1) { ?> checked="checked"<?php  } ?> /> 申请</label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-6">
                         <div class='input-group' style='border:none;margin-left:-12px;'>
                            <div class='input-group-addon'  style='border:none;background:#fff;'><label class="radio-inline" style='margin-top:-3px;'><input type="radio"  name="setdata[become]" value="2" <?php  if($set['become'] == 2) { ?> checked="checked"<?php  } ?> /> 消费达到</label></div>
                            <input type='text' class='form-control' name='setdata[become_ordercount]' value="<?php  echo $set['become_ordercount'];?>" />
                            <div class='input-group-addon'  style='border:none;background:#fff;'>次</div>
                        </div>
                    </div>
                </div>
      

                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-6">
                          <div class='input-group' style='border:none;margin-left:-12px;'>
                            <div class='input-group-addon'  style='border:none;background:#fff;'><label class="radio-inline" style='margin-top:-3px;'><input type="radio"  name="setdata[become]" value="3" <?php  if($set['become'] == 3) { ?> checked="checked"<?php  } ?> /> 消费达到</label></div>
                            <input type='text' class='form-control' name='setdata[become_moneycount]' value="<?php  echo $set['become_moneycount'];?>" />
                            <div class='input-group-addon'  style='border:none;background:#fff;'>元</div>
                        </div>
                    </div>
                </div>
			
			 <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-6">
                       <input type='hidden' class='form-control' id='goodsid' name='setdata[become_goodsid]' value="<?php  echo $set['become_goodsid'];?>" />
                          <div class='input-group' style='border:none;margin-left:-12px;'>
                            <div class='input-group-addon'  style='border:none;background:#fff;'><label class="radio-inline" style='margin-top:-3px;'><input type="radio"  name="setdata[become]" value="4" <?php  if($set['become'] == 4) { ?> checked="checked"<?php  } ?> /> 购买商品</label></div>
                            <input type='text' class='form-control' id='goods' value="<?php  if(!empty($goods)) { ?>[<?php  echo $goods['id'];?>]<?php  echo $goods['title'];?><?php  } ?>" readonly />
                            <div class="input-group-btn">
								<button type="button" onclick="$('#modal-goods').modal()" class="btn btn-default" >选择商品</button>
			   </div>
                        </div>
                    </div>
                </div>
			
      <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[become_order]" value="0" <?php  if($set['become_order'] ==0) { ?> checked="checked"<?php  } ?> /> 付款后</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[become_order]" value="1" <?php  if($set['become_order'] ==1) { ?> checked="checked"<?php  } ?> /> 完成后</label>
                    <span class="help-block">消费条件统计的方式</span>
                </div>
           </div>
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销商必须完善资料</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[become_reg]" value="0" <?php  if($set['become_reg'] ==0) { ?> checked="checked"<?php  } ?> /> 需要</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[become_reg]" value="1" <?php  if($set['become_reg'] ==1) { ?> checked="checked"<?php  } ?> /> 不需要</label>
                    <span class="help-block">分销商在分销或提现时是否必须完善资料</span>
                </div>
           </div>
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">成为分销商是否需要审核</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[become_check]" value="0" <?php  if($set['become_check'] ==0) { ?> checked="checked"<?php  } ?> /> 需要</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[become_check]" value="1" <?php  if($set['become_check'] ==1) { ?> checked="checked"<?php  } ?> /> 不需要</label>
                    <span class="help-block">以上条件达到后，是否需要审核才能成为真正的分销商</span>
                </div>
           </div>
            
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">提现额度</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="setdata[withdraw]" class="form-control" value="<?php echo empty($set['withdraw'])?1:$set['withdraw']?>"  />
                    <span class="help-block">分销商的佣金达到此额度时才能提现,最低1元</span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">开启提现到余额</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[closetocredit]" value="0" <?php  if($set['closetocredit'] ==0) { ?> checked="checked"<?php  } ?> /> 开启</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[closetocredit]" value="1" <?php  if($set['closetocredit'] ==1) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <span class="help-block">是否允许用户佣金提现到余额，否则只允许微信提现</span>
                </div>
            </div>
               <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">结算天数</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="setdata[settledays]" class="form-control" value="<?php  echo $set['settledays'];?>"  />
                    <span class="help-block">当订单完成后的n天后，佣金才能申请提现</span>
                </div>
            </div>
           <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销等级说明连接</label>
                <div class="col-sm-9 col-xs-12">
                    <input type="text" name="setdata[levelurl]" class="form-control" value="<?php  echo $set['levelurl'];?>"  />
                    <span class="help-block">分销等级说明连接</span>
                </div>
            </div>
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销商自选商品</label>
                <div class="col-sm-9 col-xs-12">
                    <label class="radio-inline"><input type="radio"  name="setdata[select_goods]" value="0" <?php  if($set['select_goods'] ==0) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[select_goods]" value="1" <?php  if($set['select_goods'] ==1) { ?> checked="checked"<?php  } ?> /> 开启</label>
                    <span class="help-block">是否允许分销商自己的小店选择自己推广的产品,如果开启自选后，要单独禁用某个分销商的自选权限，请到分销商管理中设置</span>
                </div> 
           </div>
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">是否关闭"我的小店"功能</label>
                <div class="col-sm-9 col-xs-12">
                	<label class="radio-inline"><input type="radio"  name="setdata[closemyshop]" value="0" <?php  if(empty($set['closemyshop'])) { ?> checked="checked"<?php  } ?> /> 开启</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[closemyshop]" value="1" <?php  if($set['closemyshop'] ==1) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    
                    <span class="help-block">如果关闭小店功能, 则分享的店铺连接，进入店铺的连接全是总店</span>
                </div> 
           </div>
			
	 <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销订单商品详情</label>
                <div class="col-sm-9 col-xs-12">
                	<label class="radio-inline"><input type="radio"  name="setdata[openorderdetail]" value="0" <?php  if(empty($set['openorderdetail'])) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[openorderdetail]" value="1" <?php  if($set['openorderdetail'] ==1) { ?> checked="checked"<?php  } ?> /> 显示</label>
                    
                    <span class="help-block">分销中心分销订单是否显示商品详情</span>
                </div> 
           </div>
	   <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销订单购买者详情</label>
                <div class="col-sm-9 col-xs-12">
                	<label class="radio-inline"><input type="radio"  name="setdata[openorderbuyer]" value="0" <?php  if(empty($set['openorderbuyer'])) { ?> checked="checked"<?php  } ?> /> 关闭</label>
                    <label class="radio-inline"><input type="radio"  name="setdata[openorderbuyer]" value="1" <?php  if($set['openorderbuyer'] ==1) { ?> checked="checked"<?php  } ?> /> 显示</label>
                    
                    <span class="help-block">分销中心分销订单是否显示购买者</span>
                </div> 
           </div>
            
           
            
        </div>
 
	  <div class='panel-heading'>
            分销商等级升级设置
        </div>
	<div class='panel-body'>

		<div class='panel-body'>
		  <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">分销商等级升级依据</label>
                <div class="col-sm-9 col-xs-12">
              
                        <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="0" <?php  if(empty($set['leveltype'])) { ?>checked<?php  } ?>/> 分销订单总额(完成的订单)
                        </label>
		    <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="1" <?php  if($set['leveltype']==1) { ?>checked<?php  } ?>/> 一级分销订单金额(完成的订单)
                        </label>		<br/>
						
					
		   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="2" <?php  if($set['leveltype']==2) { ?>checked<?php  } ?>/> 分销订单总数(完成的订单)
                        </label>
						   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="3" <?php  if($set['leveltype']==3) { ?>checked<?php  } ?>/> 一级分销订单总数(完成的订单)
                        </label>
				<br /><br />	
		   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="4" <?php  if($set['leveltype']==4) { ?>checked<?php  } ?>/> 自购订单金额(完成的订单)
                        </label>		
						<label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="5" <?php  if($set['leveltype']==5) { ?>checked<?php  } ?>/> 自购订单数量(完成的订单)
                        </label>		
<br/>				
		   
		 <br />
	              <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="6" <?php  if($set['leveltype']==6) { ?>checked<?php  } ?>/> 下线总人数（分销商+非分销商）
                        </label>		
		   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="7" <?php  if($set['leveltype']==7) { ?>checked<?php  } ?>/> 一级下线人数（分销商+非分销商）
                        </label> 
					<br />	
		   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="8" <?php  if($set['leveltype']==8) { ?>checked<?php  } ?>/> 下级分销商总人数
                        </label>		
		   <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="9" <?php  if($set['leveltype']==9) { ?>checked<?php  } ?>/> 一级分销商人数
                        </label>
				<br /><br />
				 <label class="radio radio-inline" style="width:240px">
                              <input type="radio" name="setdata[leveltype]" value="10" <?php  if($set['leveltype']==10) { ?>checked<?php  } ?>/> 已提现佣金总金额
                        </label>	
                        <span class="help-block">默认为分销订单总金额</span> 
                      
                </div>
            </div>
			
 </div> </div> 
	
        <div class='panel-heading'>
            样式设置
        </div>
        <div class='panel-body'>
             <div class="form-group">
        <label class="col-xs-12 col-sm-3 col-md-2 control-label">模板选择</label>
        <div class="col-sm-9 col-xs-12">
            <select class='form-control' name='setdata[style]'>
                <?php  if(is_array($styles)) { foreach($styles as $style) { ?>
                <option value='<?php  echo $style;?>' <?php  if($style==$set['style']) { ?>selected<?php  } ?>><?php  echo $style;?></option>
                <?php  } } ?>
            </select>
        </div>
    </div>
   
       
            <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label">注册面头部图片</label>
                <div class="col-sm-9 col-xs-12">
                    <?php  echo tpl_form_field_image('setdata[regbg]',$set['regbg'],'../addons/ewei_shop/plugin/commission/template/mobile/default/static/images/bg.png')?>
                </div>
            </div>
      
        </div>
           <div class='panel-heading'>
            文字设置
        </div>
        <div class='panel-body'>
             <div class="form-group">
                <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                <div class="col-sm-9 col-xs-12">
                      <div class="input-group">
                        <div class="input-group-addon">按钮文字</div>
                        <input type="text" name="setdata[buttontext]" class="form-control" value="<?php echo empty($set['buttontext'])?'我要分销':$set['buttontext']?>"  />
                        <span class="input-group-addon">商品详情页面“我要分销”按钮文字,建议使用4个汉字</span>
                    </div>
                </div>
                </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">分销商名称</div>
                            <input type="text" name="texts[agent]" class="form-control" value="<?php echo empty($set['texts']['agent'])?'分销商':$set['texts']['agent']?>"  />
                        </div>
                    </div>
              </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">小店</div>
                            <input type="text" name="texts[shop]" class="form-control" value="<?php echo empty($set['texts']['shop'])?'小店':$set['texts']['shop']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">我的小店</div>
                            <input type="text" name="texts[myshop]" class="form-control" value="<?php echo empty($set['texts']['myshop'])?'我的小店':$set['texts']['myshop']?>"  />
                        </div>
                    </div>
              </div>
            <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">分销中心</div>
                            <input type="text" name="texts[center]" class="form-control" value="<?php echo empty($set['texts']['center'])?'分销中心':$set['texts']['center']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">成为分销商</div>
                            <input type="text" name="texts[become]" class="form-control" value="<?php echo empty($set['texts']['become'])?'成为分销商':$set['texts']['become']?>"  />
                        </div>
                    </div>
              </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">提现</div>
                            <input type="text" name="texts[withdraw]" class="form-control" value="<?php echo empty($set['texts']['withdraw'])?'提现':$set['texts']['withdraw']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">佣金</div>
                            <input type="text" name="texts[commission]" class="form-control" value="<?php echo empty($set['texts']['commission'])?'佣金':$set['texts']['commission']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">分销佣金</div>
                            <input type="text" name="texts[commission1]" class="form-control" value="<?php echo empty($set['texts']['commission1'])?'分销佣金':$set['texts']['commission1']?>"  />
                        </div>
                    </div>
              </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">累计佣金</div>
                            <input type="text" name="texts[commission_total]" class="form-control" value="<?php echo empty($set['texts']['commission_total'])?'累计佣金':$set['texts']['commission_total']?>"  />
                        </div>
                    </div>
              </div>
                <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">可提现佣金</div>
                            <input type="text" name="texts[commission_ok]" class="form-control" value="<?php echo empty($set['texts']['commission_ok'])?'可提现佣金':$set['texts']['commission_ok']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">已申请佣金</div>
                            <input type="text" name="texts[commission_apply]" class="form-control" value="<?php echo empty($set['texts']['commission_apply'])?'已申请佣金':$set['texts']['commission_apply']?>"  />
                        </div>
                    </div>
              </div>
               <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">待打款佣金</div>
                            <input type="text" name="texts[commission_check]" class="form-control" value="<?php echo empty($set['texts']['commission_check'])?'待打款佣金':$set['texts']['commission_check']?>"  />
                        </div>
                    </div>
              </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">未结算佣金</div>
                            <input type="text" name="texts[commission_lock]" class="form-control" value="<?php echo empty($set['texts']['commission_lock'])?'未结算佣金':$set['texts']['commission_lock']?>"  />
                        </div>
                    </div>
              </div>
			<div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                           <div class="input-group-addon">成功提现佣金</div>
                            <input type="text" name="texts[commission_pay]" class="form-control" value="<?php echo empty($set['texts']['commission_pay'])?'成功提现佣金':$set['texts']['commission_pay']?>"  />
                        </div>
                    </div>
              </div>
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">佣金明细</div>
                            <input type="text" name="texts[commission_detail]" class="form-control" value="<?php echo empty($set['texts']['commission_detail'])?'佣金明细':$set['texts']['commission_detail']?>"  />
                        </div>
                    </div>
              </div>
               <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">分销订单</div>
                            <input type="text" name="texts[order]" class="form-control" value="<?php echo empty($set['texts']['order'])?'佣金明细':$set['texts']['order']?>"  />
                        </div>
                    </div>
              </div>
             <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">我的团队</div>
                            <input type="text" name="texts[myteam]" class="form-control" value="<?php echo empty($set['texts']['myteam'])?'我的团队':$set['texts']['myteam']?>"  />
                        </div>
                    </div>
              </div>
              
              <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">团队级别名称</div>
                            <input type="text" name="texts[c1]" class="form-control" value="<?php echo empty($set['texts']['c1'])?'一级':$set['texts']['c1']?>" style="width:100px;" />
                            <input type="text" name="texts[c2]" class="form-control" value="<?php echo empty($set['texts']['c2'])?'二级':$set['texts']['c2']?>" style="width:100px;" />
                            <input type="text" name="texts[c3]" class="form-control" value="<?php echo empty($set['texts']['c3'])?'三级':$set['texts']['c3']?>" style="width:100px;" />
                            
                        </div>
                    </div>
              </div>
              
               <div class="form-group">
                    <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
                    <div class="col-sm-9 col-xs-12">
                          <div class="input-group">
                            <div class="input-group-addon">我的客户</div>
                            <input type="text" name="texts[mycustomer]" class="form-control" value="<?php echo empty($set['texts']['mycustomer'])?'我的下线':$set['texts']['mycustomer']?>"  />
                        </div>
                    </div>
              </div>
                  
            <div class="form-group"></div>
               <div class="form-group">
            <label class="col-xs-12 col-sm-3 col-md-2 control-label"></label>
            <div class="col-sm-9">
                <input type="submit" name="submit" value="提交" class="btn btn-primary col-lg-1" onclick='return formcheck()' />
                <input type="hidden" name="token" value="<?php  echo $_W['token'];?>" />
            </div>
        </div>
   
        </div>
        
    </div>
</form>
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
                               $("#goods").val( "[" + o.id + "]" + o.title);
   	               $("#modal-goods .close").click();
	}
	
    function formcheck(){
        var become_child =$(":radio[name='setdata[become_child]']:checked").val();
        if( become_child=='1'  || become_child=='2' ){
            if( $(":radio[name='setdata[become]']:checked").val() =='0'){
              alert('成为下线条件选择了首次下单/首次付款，成为分销商条件不能选择无条件!')   ;
              return false;
            }
        }
        return true;
    }
    </script>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>