<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}
class Ewei_DShop_Alidayu{
	public function yanzhengma($mobile){

		header("Content-Type: text/html; charset=UTF-8");
        global $_W;
        include_once IA_ROOT . '/framework/library/alidayu/TopSdk.php';
        //require_once IA_ROOT . '/framework/library/alidayu/top/TopClient.php';
        //require_once IA_ROOT . '/framework/library/alidayu/top/request/AlibabaAliqinFcSmsNumSendRequest.php';

        $code = rand(100000, 999999);
        $appkey = '23341024';
        $secret = '3254bc83035de103562ac2612b2f0f36';
        $c = new \TopClient;

        $c->appkey = $appkey;
        $c->secretKey = $secret;
        $c->format = 'json';

        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        $req->setExtend($code);
        $req->setSmsType('normal');
        $req->setSmsFreeSignName('窝在家商城'); //发送的签名
        $req->setSmsParam('{"code":"'.$code.'","product":"窝在家商城"}');//根据模板进行填写
        $req->setRecNum("$mobile");//接收着的手机号码
        $req->setSmsTemplateCode('SMS_12900532');
        $resp = $c->execute($req);
        $suc = $resp->result->success;
        return array($suc,$code);
		
	}
	
}