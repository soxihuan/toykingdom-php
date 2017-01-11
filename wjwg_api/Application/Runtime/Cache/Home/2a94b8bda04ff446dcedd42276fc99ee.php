<?php if (!defined('THINK_PATH')) exit();?><form action="/wzj_api/index.php/Alidayu/GetVerifyCodeByMobile" method="post" enctype="multipart/form-data" >
    <input type="text" name="mobile" class="register_txt phone" placeholder="请输入手机号码" />
    <input type="submit" class="register_btn" value="免费注册" />
 </form>




<form action="/wzj_api/index.php/Alidayu/GetUserByVerifyCode" method="post" enctype="multipart/form-data" >
    <input type="text" name="mobile"  class="register_txt phone" placeholder="请输入手机号码" />
    <input type="text" name="verifyCode"  class="register_txt phone" placeholder="yanzhengma" />
    <input type="submit"  class="register_btn" value="登陆测试" />
</form>