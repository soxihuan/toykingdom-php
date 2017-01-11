<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>分销中心</title>
<style type="text/css">
    body {margin:0px; background:#eee; font-family:'微软雅黑'; }
    a {text-decoration:none;}
 
 
    
.gold_top {height:160px;background:url('../addons/ewei_shop/template/mobile/default/static/images/mySaleCenter.png') no-repeat center center;background-size:cover; padding:10px 22px 0px;box-sizing: border-box;}
.gold_top .title {padding-bottom:11px; width:100%; font-size:16px; color:#373737; padding-top:10px;}
.gold_top .num {height:67px; width:100%; font-size:48px; line-height:67px; color:#FF0000;}
.gold_top .num2 a {height:37px; width:auto; background:url('../addons/ewei_shop/template/mobile/default/static/images/yellow-next-btn.png') right 12px no-repeat; background-size:15px 15px;float:right; padding-right:20px; line-height:37px; color:#fff; font-size:14px;color:#373737;}
.gold_top .num2 {height:37px; width:100%; color:#373737; line-height:37px; font-size:14px; border-top:2px solid #F4D500;}

.gold_num {height:auto; background:#fff; font-size:14px;overflow:hidden;padding:10px 0;margin-top:8px;}
.gold_num .nav {height:38px; width:33.3%;float:left; border-right:1px solid #F4D500;box-sizing: border-box;}
.gold_num .nav:last-child{border-right:none;}
.gold_num .nav .title {height:19px; width:100%; color:#373737 font-size:14px; line-height:19px;text-align:center;}
.gold_num .nav .num {height:19px; width:100%; color:#FF0000; font-size:14px; line-height:9px;text-align:center;}
/* .gold_num .nav .tip {height:20px; width:90%; color:#666; font-size:12px; line-height:20px; color:#999;} */
.gold_sub {height:35px; width:96%; background:#F4D500; line-height:35px; font-size:18px; color:#373737; text-align:center; margin:13px auto; border-radius:3px;border:1px solid #222121;box-sizing: border-box;}
.tip{display:none;}

.gold_num{}
.gold_text{color:#999999;font-size:12px;margin-top:8px;padding:0 20px;height:66px;}
.gold_text p{margin:0;}
.gold_text p:last-child{margin-top:2px;}
.gold_text:before{
  content:'注：';
  display:inline-block;
  float:left;
  width:25px;
  color:#999999;
  height:100%;
}
</style>
<div id='container'></div>
 
<script id='tpl_main' type='text/html'>
    <div class="gold_top">
        <div class="title">可提现佣金（元）</div>
        <div class="num"><%member.commission_ok%></div>
        <div class="num2">已提现佣金：<%member.commission_pay%><a href="<?php  echo $this->createPluginMobileUrl('commission/log')?>" >查看明细</a></div>
    </div>

    <div class="gold_num" style="">
        <div class="nav"><div class="num"><%member.commission_total%>元</div><div class="title">累计佣金</div><div class='tip'>所有佣金</div></div>


        <div class="nav" style=""><div class="num"><%member.commission_apply%>元</div><div class="title">已申请佣金</div><div class='tip'>待审核的佣金</div></div>
<!--     </div> -->

<!--     <div class="gold_num" style="border:0px;height:70px"> -->
        <div class="nav"><div class="num"><%member.commission_check%>元</div><div class="title">待打款佣金</div><div class='tip'>审核通过的佣金</div></div>

 <!--        
        <%if set.settledays>0%><div class="nav" style="border:0px; width:44%;"><div class="title">未结算佣金</div><div class="num"><%member.commission_lock%></div><div class='tip'>结算期内的佣金</div></div><%/if%> -->
    </div>

    <div class="gold_text">
    <p>
         <%if set.withdraw>0%>
    1.可用现金满 <span style='color:red'><%set.withdraw%></span> 元后才能申请提现<%/if%></p>
    <p>2.买家确认收货后，立即获得分销佣金。<%if set.settledays>0%>结算期（<%set.settledays%>天）后，佣金可提现。结算期内，买家退货，佣金将自动扣除。<%/if%></p>
   

    </div>


    <div class="gold_sub" <%if !cansettle %>style='background:#ccc;color:#fff;'<%/if%>>我要提现</div>
        
        
</div>

</script>
<script language="javascript">
    require(['tpl', 'core'], function(tpl, core) {
        
        core.pjson('commission/withdraw',{},function(json){
           $('#container').html(  tpl('tpl_main',json.result) );
             
           if(json.result.cansettle){
               $('.gold_sub').click(function(){
                   location.href="<?php  echo $this->createPluginMobileUrl('commission/apply')?>";
               })
           }
        },true);
        
    })
</script>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
  