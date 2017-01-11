<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<title>加入我们</title>
<style type="text/css">
body {margin:0; font-family:'微软雅黑'; background:#000;}
.top {overflow:hidden}
.top img { width:100%;}
a{ text-decoration: none;}
.main {height:520px; padding:30px 12px;}
.main .text {height:20px; font-size:14px; line-height:20px; color:#666;}
.main .text span {color:#f6914b;}

.main .text1 {padding:5px; font-size:14px; line-height:20px; color:#666;}
.main .text1 span {color:#f6914b;}


.main .input {height:36px; margin:14px 10px 0 0;background:#fff;border-radius:5px;font-size: 0;}
.main .input input {width:100%;  height:36px; border:0px; outline:none; font-size:15px; color:#999;border-radius: 5px;padding-left: 10px;box-sizing:border-box;}

.main .sub {height:36px; background:#fdd32f; margin-top:14px;border:1px solid #222121;border-radius:5px; text-align:center; line-height:36px; color:#222121; font-size:14px;position: relative;}
.main .title {height:30px; margin-top:20px; font-size:12px; line-height:30px; color:#666;}
.vip_main {height:182px; background:#fff; border-radius:4px;}
.vip_main .vip {height:36px; padding:12px; border-bottom:1px solid #f1f1f1; overflow:hidden; font-size:12px; color:#999;}
.vip_main .vip .ico1 {height:36px; width:36px; background:#32cd32; border-radius:18px; color:#fff; font-size:20px; line-height:36px; text-align:center; float:left;}
.vip_main .vip .ico2 {height:36px; width:36px; background:#fece00; border-radius:18px; color:#fff; font-size:22px; line-height:40px; text-align:center; float:left;}
.vip_main .vip .text {height:36px; margin-left:12px; float:left;}
.vip_main .vip .text .t1 {height:18px; font-size:15px; color:#666; line-height:18px;}
.vip_main .vip .text .t2 {height:18px; font-size:13px; color:#999; line-height:18px;}


.ok {height:200px; padding-top:30px;}
.ok .ico {height:65px; width:65px; margin:auto; border:3px solid #32cd32; border-radius:55px; color:#32cd32; font-size:50px; text-align:center; line-height:65px;}
.ok .text {height:20px; margin-top:30px; font-size:16px; color:#666; line-height:20px; text-align:center;}
.ok .sub {height:32px; width:145px; background:#e53c39; margin:15px auto; border-radius:20px; color:#fff; line-height:32px; text-align:center; font-size:16px;}
.otherWay{font-size: 13px;color: #505050;}
.white-person{height: 36px;line-height: 36px;border-radius: 5px;color: #222121;font-size: 14px;text-align: center;margin-top:10px;border:1px solid #222121;position: relative;}
.main .sub span{display: inline-block;height: 16px;line-height: 16px;padding-left:29px;background: url('../addons/ewei_shop/template/mobile/default/static/images/register-car.png') no-repeat left center;background-size:contain;position: absolute;left: 50%;top:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);}
.white-person span{display: inline-block;height: 16px;line-height: 16px;padding-left:29px;background: url('../addons/ewei_shop/template/mobile/default/static/images/user.png') no-repeat left center;background-size:contain;position: absolute;left: 50%;top:50%;transform:translate(-50%,-50%);-webkit-transform:translate(-50%,-50%);}
.intoPhoneNumber{background: #fff;padding:13px 18px;display: none;border-radius: 4px;}
#PhoneNumber{border: 1px solid #A7A7A7;border-radius: 4px;display: block;height: 32px;line-height: 32px;font-size: 14px;width: 100%;padding-left: 15px;box-sizing:border-box;}
#PhoneNumber::-webkit-input-placeholder {
    color: #8A8A8A;
    text-indent: 5px;
}
.makesure{height: 32px;line-height: 32px;text-align: center;font-size: 14px;border:1px solid #222121;border-radius: 4px;margin-top: 8px;}
input{font-family: 微软雅黑;}
.main .input .thisIsMark{display:inline-block;width: 90px;height: 30px;line-height: 27px;text-align: center;font-size: 14px;color:#222121;border-radius: 5px;position: absolute;right: 10px;top: 50%;transform:translatey(-50%);-webkit-transform:translatey(-50%);border:1px solid #222121;background:none;padding:0;}
.jxl{display:none}
.tipTxt{width: 7.25rem;text-align: left;margin: 0 auto ;font-size: 0.35rem;line-height: 0.55rem;}
.tipImg{width: 4rem;height: 4rem;;display: block;margin: 0.2rem auto 0;}
.gray{font-size: 0.35rem;text-align: center;color: #999;margin: 0.1rem}
.teacherWechart{font-size: 0.4rem;text-align: center;line-height: 0.4rem;margin: 0.1rem;font-size: 14px;}
.tipTitleName{text-align: center;margin-top:8px;font-size: 14px;}
.Mytext{   

    padding-top: 10px;
    font-size: 14px;
    color: #666;
    line-height: 20px;
    text-align: left;
    width: 85%;
    margin: 0 auto;
}
.mainPage{width: 100%;font-size: 0;overflow: hidden;}
</style>
<script>
    var oHtml=document.documentElement;
    getSize();
    function getSize(){
    //获取屏幕宽度
        var screenWidth=oHtml.clientWidth;
        oHtml.style.fontSize=screenWidth/9.38+'px';
    }
    //当窗口宽度被改变时调用这个函数
    window.onresize=function(){
        getSize();
    }
    getSize();
</script>
<div id='container'>
    <div class="mainPage">

        <img src="../addons/ewei_shop/template/mobile/default/static/images/l-squashed.jpg" alt="" width="100%;">

    </div>

</div>
<script>
    window.onload = function(){
        var myHeight  = $(window).height();
        var picHeight = $('.mainPage').height();
        var moreheight = Number(picHeight) + 50
        var trueMyHeight = myHeight - 50;
        console.log(trueMyHeight+','+moreheight+','+myHeight)
        if ( moreheight > myHeight) {
            $('.mainPage').css('height', trueMyHeight);
        };
        
    }

</script>
<?php  $show_footer=true;$footer_current ='commission'?>
<?php (!empty($this) && $this instanceof WeModuleSite) ? (include $this->template('common/footer', TEMPLATE_INCLUDEPATH)) : (include template('common/footer', TEMPLATE_INCLUDEPATH));?>
