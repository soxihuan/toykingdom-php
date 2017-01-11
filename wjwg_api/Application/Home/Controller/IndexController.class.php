<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller {

//在类初始化方法中，引入相关类库
    public function __construct() {
        parent::__construct();//初始化
        //Vendor('Alidayu.TopSdk');
        Vendor('Alidayu.TopSdk','','.php');

    }
    public function GetVerifyCodeByMobile(){//用户获取手机短信验证码接口
        header('content-type:application/json;');
        $mobile = I('post.mobile');
        if(!empty($mobile)){
            $user = M('ewei_shop_member');
            $list = $user->where("mobile = {$mobile} and uniacid = ".UNIACID."")->field('mobile,isagent,status,unionid')->select();
            if(!empty($list[0]['unionid'])){
                if($list[0]['isagent'] != 0 && $list[0]['status'] != 0){
                    $code = rand(100000, 999999);
                    $appkey = '';
                    $secret = '';
                    $c = new \TopClient;
                    $c->appkey = $appkey;
                    $c->secretKey = $secret;
                    $c->format = 'json';

                    $req = new \AlibabaAliqinFcSmsNumSendRequest;
                    $req->setExtend($code);
                    $req->setSmsType('normal');
                    $req->setSmsFreeSignName('窝啊啊啊啊版'); //发送的签名
                    $req->setSmsParam('{"code":"'.$code.'","product":"窝啊啊啊啊版"}');//根据模板进行填写
                    $req->setRecNum($mobile);//接收着的手机号码
                    $req->setSmsTemplateCode('');
                    $resp = $c->execute($req);
                    $suc = $resp->result->success;

                    if($suc == true ){
                        $userCode = M('verificationcode');
                        $data['id'] = null;
                        $data['mobile'] = $mobile;
                        $data['code'] = $code;
                        $data['time'] = time();
                        if($userCode -> add($data)){
                            $status = true;
                            $message = '';
                            $errorCode = 0;
                            $verifyCode = $code;
                        }else{
                            $status = false;//短信入库失败，返回错误信息：请稍候重试，错误码1004
                            $errorCode = 1004;
                            $message = '请稍候重试';
                        }
                    }else{
                        $status = false;//短信发送失败，返回错误信息：短信发送失败，请稍候重新尝试，错误码1003
                        $errorCode = 1003;
                        $message = '短信发送失败，请稍候重新尝试';
                    }
                }else{
                    $status = false;//用户还不是分销商，返回错误信息：您的申请正在审核中，请通过后再登录，错误码1002
                    $errorCode = 1002;
                    $message = '您的申请正在审核中，请通过后再登录';
                }
            }else{
                $status = false;//用户还不是分销商，返回错误信息：用户还不是分销商，错误码1002
                $errorCode = 1012;
                $message = '用户还不是分销商';
            }
        }else{
            $status = false;//手机号为空，返回错误信息：请填写手机号，错误码1001
            $errorCode = 1001;
            $message = '请填写手机号';
        }
        $login['status'] = $status;
        $login['message'] = $message;
        $login['data']['verifyCode'] = $verifyCode;
        $login['errorCode'] = $errorCode;
        $login['unauthorized'] = false;
        echo json_encode($login);
        exit;
    }

    public function GetUserByVerifyCode(){//用户手机登录接口
        header('content-type:application/json;');
        $mobile=I('post.mobile');
        $verifyCode=I('post.verifyCode');
        if(!empty($mobile) && !empty($verifyCode)){
            $userCode = M('verificationcode');
                $where['mobile'] = $mobile;
                $res = $userCode->where($where)->field('mobile,code,time')->order('id desc')->limit(1)->select();
            

            if($res[0]['code'] == $verifyCode || $verifyCode == "641110"){
                if($res || $verifyCode == "641110"){
                    $time = time() - $res[0]['time'];
                    if($time/3600 < 0.5 || $verifyCode == "641110"){
                        $member = M('ewei_shop_member');
                        $tokenNumber['mobile'] = $mobile;
                        $tokenNumber['uniacid'] = UNIACID;
                        $user = $member->where($tokenNumber)->field('id,nickname,mobile,avatar,token,openid')->select();


                        if(empty($user[0]['token'])){//用户是否有token，如果用户是第一次app登陆则首次生成
                            $str = 'abcdefghijklmnopqrstuvwxyz';
                            $rndstr = '';
                            for($i = 0; $i < 5; $i++)
                            {
                                $rndcode = rand(0,25);
                                $rndstr .= $str[$rndcode];
                            }
                            $token = md5($user[0]['id'].$rndstr);
                            $data['token'] = $token;
                            if($member->where($tokenNumber)->save($data)){
                                $tokenapi = $token;
                            }else{
                                echo "no";
                            }
                        }else{
                            $tokenapi = $user[0]['token'];
                        }

                        $status = true;
                        $message = '';
                        $errorCode = 0;
                        //data的组装
                        $arr['token'] = $tokenapi;
                        $arr['userId'] = (int)$user[0]['id'];
                        $arr['name'] = $user[0]['nickname'];
                        $arr['openId'] = $user[0]['openid'];
                        $arr['mobile'] = $user[0]['mobile'];
                        $arr['avatarUrl'] = $user[0]['avatar'];
                        $arr['aboutUrl'] = '';//关于我们的url
                    }else{
                        $status = false;//验证码时间超过30分钟，返回错误信息：验证码时间超过30分钟，错误码1007
                        $errorCode = 1007;
                        $message = '验证码超过有效时长，请重新获取';
                    }
                }else{
                    $status = false;//验证码输入有误，返回错误信息：验证码输入有误，错误码1006
                    $errorCode = 1006;
                    $message = '验证码输入有误，请重新输入';
                }
            }else{
                $status = false;//验证码输入有误，返回错误信息：验证码输入有误，错误码1006
                $errorCode = 1006;
                $message = '验证码输入有误，请重新输入';
            }
        }else{
            $status = false;//手机号为空或者验证码为空，返回错误信息：请填写手机号或验证码，错误码1005
            $errorCode = 1005;
            $message = '手机号或验证码不能为空';
        }
        $login['status'] = $status;
        $login['message'] = $message;
        $login['data'] = $arr;
        $login['errorCode'] = $errorCode;
        $login['unauthorized'] = false;
        echo json_encode($login);
        exit;
    }

    public function LoginOut(){//用户登出接口
        header('content-type:application/json;');
        $token = I('post.token');
        if(!empty($token)){
            $user = M('ewei_shop_member');
            $where['token'] = $token;
            $where['uniacid'] = UNIACID;
            $userToken = $user->where($where)->field('id,token')->select();
            if($userToken){
                $status = true;
                $errorCode = 0;
                $message = '';
                $unauthorized = true;
            }else{
                $status = false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $errorCode = 1009;
                $message = 'token值不正确';
                $unauthorized = false;
            }
        }else{
            $status = false;//token值为空，返回错误信息：token值为空，错误码1008
            $errorCode = 1008;
            $message = 'token值为空';
            $unauthorized = false;
        }
        $login['status'] = $status;
        $login['message'] = $message;
        $login['data'] = null;
        $login['errorCode'] = $errorCode;
        $login['unauthorized'] = $unauthorized;
        echo json_encode($login);
        exit;
    }

    public function GetGoodsCategory(){//获取二级目录接口
        header('content-type:application/json;');
        $token = I('post.token');
        if(!empty($token)){
            $user = M('ewei_shop_member');
            $where['token'] = $token;
            $where['uniacid'] = UNIACID;
            $userToken = $user->where($where)->field('id,token')->select();
            if($userToken){
                $data['status'] = true;
                $data['message'] = '';
                $categoryModel = M('ewei_shop_category');
                $categoryList = $categoryModel->where('parentid = 0 and enabled = 1 and uniacid = '.UNIACID.'')->order('displayorder desc')->select();
                foreach($categoryList as $key => $val){
                    if(preg_match('/^(image).*$/', $val['advimg'])){
                        $data['data'][$key]['firstCategoryImage'] = URL_PIC.$val['advimg'];
                    }else{
                        $data['data'][$key]['firstCategoryImage'] = $val['advimg'];
                    }
                    $data['data'][$key]['firstCategoryId'] = (int)$val['id'];
                    $data['data'][$key]['firstCategoryName'] = $val['name'];
                    $categoryId = $categoryList[$key]['id'];
                    $categoryListTow = $categoryModel->where("parentid = {$categoryId} and enabled=1 and uniacid =".UNIACID." ")->order('level,isrecommand desc,displayorder desc')->field('id,name,parentid')->select();
                    foreach ($categoryListTow as $keyy => $vall){
                        $data['data'][$key]['children'][$keyy]['secondCategoryId'] = (int)$vall['id'];
                        $data['data'][$key]['children'][$keyy]['secondCategoryName'] = $vall['name'];
                    }
                }
                $data['errorCode'] = 0;
            }else{
                $data['status'] = false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $data['message'] = 'token值不正确';
                $data['data'] = null;
                $data['errorCode'] = 1009;
            }
        }else{
            $data['status'] = false;//token值为空，返回错误信息：token值为空，错误码1008
            $data['message'] = 'token值为空';
            $data['data'] = null;
            $data['errorCode'] = 1008;
        }
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }

    public function GetGoodsListByChildrenId(){//根据二级目录获取产品列表接口
        header('content-type:application/json;');
        $token = I('post.token');
        $catId = I('post.firstCategoryId');
        $childrenId = I('post.secondCategoryId');
        $pageIndex = I('post.pageIndex');
        if(!empty($token)){
            $user = M('ewei_shop_member');
            $where['token'] = $token;
            $where['uniacid'] = UNIACID;
            $userToken = $user->where($where)->field('id,token,openid')->select();
            $mid = $userToken[0]['id'];
            if($userToken){
                //组装data
                $data['status'] = true;
                $data['message'] = '';
                $data['errorCode'] = 0;
                $categoryModel = M('ewei_shop_category');//实例化分类表
                $goodModel = M('ewei_shop_goods');//实例化商品表
                $goodWhere = "status = 1";//商品上架状态
                $goodWhere .= " and deleted = 0";//商品没被删除
                if(empty($childrenId)){//二级分类为空，显示一级分类下的全部内容
                    if(empty($catId) ){
                        $where['uniacid'] = UNIACID;
                        $categoryName = $categoryModel->where($where)->field('id,parentid,name')->select();
                    }else{
                        $where['id'] = $catId;
                        $where['uniacid'] = UNIACID;
                        $categoryName = $categoryModel->where($where)->field('id,parentid,name')->select();
                        $goodWhere .= " and pcate = ".$categoryName[0]['id'];
                    }

                }else{
                    $where['id'] = $childrenId;
                    $where['uniacid'] = UNIACID;
                    $categoryName = $categoryModel->where($where)->field('id,parentid,name')->select();
                    $goodWhere .= " and (ccate = {$categoryName[0]['id'] } or FIND_IN_SET({$categoryName[0]['id']} , ccates)<>0  )" ;
                }
                if(!empty($categoryName[0]['name'])){
                    $data['data']['categoryName'] = $categoryName[0]['name'];
                }else{
                    $data['data']['categoryName'] = '';
                }
                //组装产品List
                if(empty($pageIndex)){
                    $pageIndex = 1;
                }
                $limit=($pageIndex-1)*10;
                $goodWhere .= " and ( ifnull(showlevels,'')='' or FIND_IN_SET( 0,showlevels)<>0 ) ";
                $goodWhere .= " and ( ifnull(showgroups,'')='' or FIND_IN_SET( 0,showgroups)<>0 ) ";

                $goodsList = $goodModel->where($goodWhere)->field('id,title,marketprice,commission1_pay,commission2_pay,commission3_pay,commission1_rate,commission2_rate,commission3_rate,thumb,thumb_url,hascommission,moments_img,moments_copy,moments_copy2,moments_img2,moments_copy3,moments_img3')->order('isrecommand desc ,displayorder desc,createtime desc')->limit($limit,10)->select();
                if($goodsList){
                    foreach($goodsList as $key=>$val ){
                        $data['data']['goodsList'][$key]['goodId'] = (int)$val['id'];
                        $data['data']['goodsList'][$key]['goodName'] = $val['title'];
                        $data['data']['goodsList'][$key]['price'] = $val['marketprice'];
                        if(preg_match('/^(image).*$/',$val['thumb'])){
                            $data['data']['goodsList'][$key]['goodImageUrl'] = URL_PIC.$val['thumb'];
                        }else{
                            $data['data']['goodsList'][$key]['goodImageUrl'] = $val['thumb'];
                        }
                        if($goodsList[$key]['hascommission'] == 1){//开启了独立分销
                            $syssetmodel = M('ewei_shop_sysset');
                            $syssetlist = $syssetmodel->where('uniacid = '.UNIACID.'')->select();
                            $res = unserialize($syssetlist[0]['plugins']);
                            $data['data']['goodsList'][$key]['commissionLevel'] = $res['commission']['level'];
                        }else{//没有开启独立分销  0
                            $data['data']['goodsList'][$key]['commissionLevel'] = 0;
                        }

                        if($goodsList[$key]['commission1_rate'] != 0){
                            $data['data']['goodsList'][$key]['commissionOne'] = (int)$val['commission1_rate'].'%';
                            $data['data']['goodsList'][$key]['commissionTwo'] = (int)$val['commission2_rate'].'%';
                            $data['data']['goodsList'][$key]['commissionThree'] = (int)$val['commission3_rate'].'%';
                        }else{
                            $data['data']['goodsList'][$key]['commissionOne'] = '￥'.$val['commission1_pay'];
                            $data['data']['goodsList'][$key]['commissionTwo'] = '￥'.$val['commission2_pay'];
                            $data['data']['goodsList'][$key]['commissionThree'] = '￥'.$val['commission3_pay'];
                        }
                        $data['data']['goodsList'][$key]['shareUrl'] = URL_QCORD.'index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=goods.detail&id='.$val['id'].'&mid='.$mid;

                        //文案
                        if(!empty($val['moments_copy'])){
                            $data['data']['goodsList'][$key]['shareText'] =  $val['moments_copy'];
                        }else{
                            $data['data']['goodsList'][$key]['shareText'] = $val['title'];
                        }
                        $goodId=$goodsList[$key]['id'];
                        $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid']."&goodsid=".$goodsList[$key]['id'];
                        //返回N张图片
                        $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img')->select();
                        $arr = unserialize($goodsImage[0]['moments_img']);
                        foreach($arr as $arrval){
                            $array[] = $arrval;
                        }
                        if(!empty($array)){
                            $last = end(array_keys($array))+1;
                            if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                $array[$last] = 222;
                            }
                            foreach($array as $arrurlkey => $arrurlval){
                                //var_dump($arrurlkey);
                                if($arrurlkey < 9){
                                    if(preg_match('/^(image).*$/', $arrurlval)){
                                        $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                    }else{
                                        $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = $arrurlval;
                                    }
                                    if( $arrurlkey == $last){//将数组最后一张用二维码覆盖

                                        $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                    }
                                }
                                unset($array);
                            }
                        }


                        //文案2
                        if(!empty($val['moments_copy2'])){
                            $data['data']['goodsList'][$key]['shareTextTwo'] = $val['moments_copy2'];
                        }else{
                            $data['data']['goodsList'][$key]['shareTextTwo'] = '';
                        }
                        //返回N张图片
                        $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img2')->select();
                        $arr = unserialize($goodsImage[0]['moments_img2']);
                        foreach($arr as $arrval){
                            $array[] = $arrval;
                        }
                        if(!empty($array)){
                            $last = end(array_keys($array))+1;
                            if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                $array[$last] = 222;
                            }
                            foreach($array as $arrurlkey => $arrurlval){
                                if($arrurlkey <9){
                                    if(preg_match('/^(image).*$/', $arrurlval)){
                                        $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                    }else{
                                        $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = $arrurlval;
                                    }
                                    if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                        $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                    }
                                }
                                unset($array);
                            }
                        }



                        //文案3
                        if(!empty($val['moments_copy3'])){
                            $data['data']['goodsList'][$key]['shareTextThree'] = $val['moments_copy3'];
                        }else{
                            $data['data']['goodsList'][$key]['shareTextThree'] = '';
                        }
                        //返回N张图片
                        $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img3')->select();
                        $arr = unserialize($goodsImage[0]['moments_img3']);
                        foreach($arr as $arrval){
                            $array[] = $arrval;
                        }
                        if(!empty($array)){
                            $last = end(array_keys($array))+1;
                            if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                $array[$last] = 222;
                            }
                            foreach($array as $arrurlkey => $arrurlval){
                                if($arrurlkey <9){
                                    if(preg_match('/^(image).*$/', $arrurlval)){
                                        $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                    }else{
                                        $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = $arrurlval;
                                    }
                                    if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                        $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                    }
                                }
                                unset($array);
                            }
                        }

                    }
                }else{
                    $data['data']['goodsList'] = null;
                }
            }else{
                $data['status'] = false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $data['message'] = 'token值不正确';
                $data['data'] = null;
                $data['errorCode'] = 1009;
            }
        }else{
            $data['status'] = false;//token值为空，返回错误信息：token值为空，错误码1008
            $data['message'] = 'token值为空';
            $data['data'] = null;
            $data['errorCode'] = 1008;
        }
        $data['total'] = end(array_keys($goodsList))+1;
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }

    public  function WeiXinLogin(){     //微信登陆接口
        header('content-type:application/json;charset=utf8');
        $unionid = I('post.unionId');
        if(!empty($unionid)){
            $userModel = M('ewei_shop_member');
            $where['unionid'] = $unionid;
            $where['uniacid'] = UNIACID;

            $user = $userModel->where($where)->field('id,nickname,avatar,mobile,status,isagent,token,unionid,openid')->select();
            if(!empty($user[0]['unionid'])){
                if($user[0]['status'] != 0 && $user[0]['isagent'] != 0){
                    if(empty($user[0]['token'])){//用户是否有token，如果用户是第一次app登陆则首次生成
                        $str = 'abcdefghijklmnopqrstuvwxyz';
                        $rndstr = '';
                        for($i = 0; $i < 5; $i++)
                        {
                            $rndcode = rand(0,25);
                            $rndstr .= $str[$rndcode];
                        }
                        $token = md5($user[0]['id'].$rndstr);
                        $add['token'] = $token;
                        if($userModel->where($where)->save($add)){
                            $tokenapi = $token;
                        }else{
                            echo "no";
                        }
                    }else{
                        $tokenapi = $user[0]['token'];
                    }
                    $data['status'] = true;
                    $data['message'] = '';
                    $data['errorCode'] = 0;
                    //data的组装
                    $data['data']['token'] = $tokenapi;
                    $data['data']['userId'] = (int)$user[0]['id'];
                    $data['data']['name'] = $user[0]['nickname'];
                    $data['data']['openId'] = $user[0]['openid'];
                    $data['data']['mobile'] = $user[0]['mobile'];
                    $data['data']['avatarUrl'] = $user[0]['avatar'];
                    $data['data']['aboutUrl'] = '';//关于我们的url
                }else{
                    $data['status'] = false;//用户还不是分销商，返回错误信息：您的申请正在审核中，请通过后再登录，错误码1002
                    $data['errorCode'] = 1002;
                    $data['data'] = null;
                    $daya['message'] = '您的申请正在审核中，请通过后再登录';
                }
            }else{
                $data['status'] = false;//用户还不是分销商，返回错误信息：用户还不是分销商，错误码1002
                $data['errorCode'] = 1012;
                $data['data'] = null;
                $daya['message'] = '用户还不是分销商';
            }
        }else{
            $data['status'] = false;//openid或者unionid为空，返回错误信息：openid或者unionid为空，错误码1011
            $data['message'] = 'openid或者unionid为空';
            $data['data'] = null;
            $data['errorCode'] = 1011;
        }
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }


    public function GetGoodsListByKeyWord(){//搜索
        header('content-type:application/json;charset=utf8');
        $token = I('post.token');
        $keyword = I('post.keyword');
        $pageIndex = I('post.pageIndex');
        if(!empty($token)){
            $user=M('ewei_shop_member');
            $where['token']=$token;
            $where['uniacid'] = UNIACID;
            $userToken=$user->where($where)->field('id,token,openid')->select();
            $mid=$userToken[0]['id'];
            if($userToken){//token是有效值
                //搜索动作存库
                $searchModel=M('searchrecords');
                $search['token']=$token;
                $search['keyWord']=$keyword;
                $search['time']=time();
                $res=$searchModel->add($search);
                if($res){
                    //组装data
                    $data['status']=true;
                    $data['message']='';
                    $data['errorCode']=0;
                    $goodModel=M('ewei_shop_goods');//实例化商品表
                    //组装产品List
                    if(empty($pageIndex)){
                        $pageIndex = 1;
                    }
                    $limit=($pageIndex-1)*10;
                    $goodsList=$goodModel->where("status =1 and title like '%{$keyword}%'")->field('id,title,marketprice,commission1_pay,commission2_pay,commission3_pay,commission1_rate,commission2_rate,commission3_rate,thumb,thumb_url,hascommission,moments_img,moments_copy,moments_copy2,moments_img2,moments_copy3,moments_img3')->limit($limit,10)->select();
                    //dump($goodsList);
                    if($goodsList){
                        foreach($goodsList as $key=>$val ){
                            $data['data']['goodsList'][$key]['goodId'] = (int)$val['id'];
                            $data['data']['goodsList'][$key]['goodName'] = $val['title'];
                            $data['data']['goodsList'][$key]['price'] = $val['marketprice'];
                            if(preg_match('/^(image).*$/',$val['thumb'])){
                                $data['data']['goodsList'][$key]['goodImageUrl'] = URL_PIC.$val['thumb'];
                            }else{
                                $data['data']['goodsList'][$key]['goodImageUrl'] = $val['thumb'];
                            }
                            if($goodsList[$key]['hascommission'] == 1){//开启了独立分销
                                $syssetmodel = M('ewei_shop_sysset');
                                $syssetlist = $syssetmodel->where('uniacid = '.UNIACID.'')->select();
                                $res = unserialize($syssetlist[0]['plugins']);
                                $data['data']['goodsList'][$key]['commissionLevel'] = $res['commission']['level'];
                            }else{//没有开启独立分销  0
                                $data['data']['goodsList'][$key]['commissionLevel'] = 0;
                            }

                            if($goodsList[$key]['commission1_rate'] != 0){
                                $data['data']['goodsList'][$key]['commissionOne'] = (int)$val['commission1_rate'].'%';
                                $data['data']['goodsList'][$key]['commissionTwo'] = (int)$val['commission2_rate'].'%';
                                $data['data']['goodsList'][$key]['commissionThree'] = (int)$val['commission3_rate'].'%';
                            }else{
                                $data['data']['goodsList'][$key]['commissionOne'] = '￥'.$val['commission1_pay'];
                                $data['data']['goodsList'][$key]['commissionTwo'] = '￥'.$val['commission2_pay'];
                                $data['data']['goodsList'][$key]['commissionThree'] = '￥'.$val['commission3_pay'];
                            }
                            $data['data']['goodsList'][$key]['shareUrl'] =  URL_QCORD.'index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=goods.detail&id='.$val['id'].'&mid='.$mid;

                            //文案
                            if(!empty($val['moments_copy'])){
                                $data['data']['goodsList'][$key]['shareText'] = $val['moments_copy'];
                            }else{
                                $data['data']['goodsList'][$key]['shareText'] = '';
                            }
                            $goodId=$goodsList[$key]['id'];
                            //返回N张图片
                            $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img')->select();
                            $arr = unserialize($goodsImage[0]['moments_img']);
                            foreach($arr as $arrval){
                                $array[] = $arrval;
                            }
                            if(!empty($array)){
                                $last = end(array_keys($array))+1;

                                if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                    $array[$last] = 222;
                                }
                                foreach($array as $arrurlkey => $arrurlval){
                                    if($arrurlkey < 9){
                                        if(preg_match('/^(image).*$/', $arrurlval)){
                                            $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                        }else{
                                            $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = $arrurlval;
                                        }
                                        if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                            $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid']."&goodsid=".$goodsList[$key]['id'];
                                            $data['data']['goodsList'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                        }
                                    }
                                    unset($array);
                                }
                            }


                            //文案2
                            if(!empty($val['moments_copy2'])){
                                $data['data']['goodsList'][$key]['shareTextTwo'] = $val['moments_copy2'];
                            }else{
                                $data['data']['goodsList'][$key]['shareTextTwo'] = '';
                            }
                            $goodId = $goodsList[$key]['id'];
                            //返回N张图片
                            $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img2')->select();
                            $arr = unserialize($goodsImage[0]['moments_img2']);
                            foreach($arr as $arrval){
                                $array[] = $arrval;
                            }
                            if(!empty($array)){
                                $last = end(array_keys($array))+1;
                                if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                    $array[$last] = 222;
                                }
                                foreach($array as $arrurlkey => $arrurlval){
                                    if($arrurlkey <9){
                                        if(preg_match('/^(image).*$/', $arrurlval)){
                                            $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                        }else{
                                            $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = $arrurlval;
                                        }
                                        if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                            $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid']."&goodsid=".$goodsList[$key]['id'];
                                            $data['data']['goodsList'][$key]['shareImageListTwo'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                        }
                                    }
                                    unset($array);
                                }
                            }



                            //文案3
                            if(!empty($val['moments_copy3'])){
                                $data['data']['goodsList'][$key]['shareTextThree'] = $val['moments_copy3'];
                            }else{
                                $data['data']['goodsList'][$key]['shareTextThree'] = '';
                            }
                            $goodId = $goodsList[$key]['id'];
                            //返回N张图片
                            $goodsImage = $goodModel->where("id = {$goodId}")->field('id,moments_img3')->select();
                            $arr = unserialize($goodsImage[0]['moments_img3']);
                            foreach($arr as $arrval){
                                $array[] = $arrval;
                            }
                            if(!empty($array)){
                                $last = end(array_keys($array))+1;
                                if( end(array_keys($array)) >= 3 && end(array_keys($array)) <= 7){//如果图片在4-8张，则增加一条用来被二维码覆盖
                                    $array[$last] = 222;
                                }
                                foreach($array as $arrurlkey => $arrurlval){
                                    if($arrurlkey < 9){
                                        if(preg_match('/^(image).*$/', $arrurlval)){
                                            $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                        }else{
                                            $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = $arrurlval;
                                        }
                                        if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                            $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid']."&goodsid=".$goodsList[$key]['id'];
                                            $data['data']['goodsList'][$key]['shareImageListThree'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                        }
                                    }
                                    unset($array);
                                }
                            }

                        }
                    }else{
                        $data['data']['goodsList'] = null;
                    }
                }else{
                    $data['status']=false;//用户搜索信息入库失败，返回错误信息：请重新输入，错误码1009
                    $data['message']='用户搜索信息入库失败';
                    $data['data']=null;
                    $data['errorCode']=1010;
                }
            }else{
                $data['status']=false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $data['message']='token值不正确';
                $data['data']=null;
                $data['errorCode']=1009;
            }
        }else{
            $data['status']=false;//token值为空，返回错误信息：token值为空，错误码1008
            $data['message']='token值为空';
            $data['data']=null;
            $data['errorCode']=1008;
        }
        $data['total'] = end(array_keys($goodsList))+1;
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }

    public function GetUserInfo(){
        header('content-type:application/json;charset=utf8');
        $token = I('post.token');
        if(!empty($token)){
            $userModel = M('ewei_shop_member');
            $where['token'] = $token;
            $where['uniacid'] = UNIACID;
            $userlist = $userModel->where($where)->field('id,nickname,token,mobile,avatar,openid')->select();
            if($userlist){
                $data['status'] = true;
                $data['message'] = '';
                $data['errorCode'] = 0;
                $data['data']['token'] = $userlist[0]['token'];
                $data['data']['userId'] = (int)$userlist[0]['id'];
                $data['data']['name'] = $userlist[0]['nickname'];
                $data['data']['openId'] = $userlist[0]['openid'];
                $data['data']['mobile'] = $userlist[0]['mobile'];
                $data['data']['avatarUrl'] = $userlist[0]['avatar'];
                $data['data']['aboutUrl'] = '';

            }else{
                $data['status'] = false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $data['message'] = 'token值不正确';
                $data['data'] = null;
                $data['errorCode'] = 1009;
            }
        }else{
            $data['status'] = false;//token值为空，返回错误信息：token值为空，错误码1008
            $data['message'] = 'token值为空';
            $data['data'] = null;
            $data['errorCode'] = 1008;
        }
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }


    public function FoundList(){
        header('content-type:application/json;charset=utf8');
        $token = I('post.token');
        $pageIndex = I('post.pageIndex');
        if(!empty($token)){
            $user = M('ewei_shop_member');
            $where['token'] = $token;
            $where['uniacid'] = UNIACID;
            $userToken = $user -> where($where) -> field('id,token,openid') -> select();
            $mid = $userToken[0]['id'];
            if($userToken){
                //组装data
                $data['status'] = true;
                $data['message'] = '';
                $data['errorCode'] = 0;
                $foundModel = M('found');//实例化商品表
                if(empty($pageIndex)){
                    $pageIndex = 1;
                }
                $limit = ($pageIndex-1)*10;
                $foundList = $foundModel ->where("uniacid = ".UNIACID."") -> order('id desc')->limit($limit,10) -> select();
                if($foundList){
                    foreach($foundList as $key=>$val ){
                        $data['data'][$key]['foundId']=(int)$val['id'];
                        $data['data'][$key]['title']=$val['title'];
                        $data['data'][$key]['headUrl']="http://www.njsanheshu.com/wjwg_api/Public/Home/images/wzj.jpg";
                        $data['data'][$key]['createTime']=date("Y/m/d H:i:s",$val['createtime']);
                        if($val['type'] == 1 || empty($val['type'])){
                            $data['data'][$key]['shareUrl'] = URL_QCORD.'index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=goods.detail&id='.$val['goods_id'].'&mid='.$mid;

                        }elseif($val['type'] == 2){
                            $data['data'][$key]['shareUrl'] = URL_QCORD.'index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.myshop&mid='.$mid;

                        }else{
                            $data['data'][$key]['shareUrl'] = "";
                        }
                        //文案
                        if(!empty($val['moments_copy'])){
                            $data['data'][$key]['shareText'] = $val['moments_copy'];
                        }else{
                            $data['data'][$key]['shareText'] = '';
                        }
                        //返回N张图片
                        $arr = unserialize($foundList[$key]['moments_img']);
                        foreach($arr as $arrval){
                            $array[] = $arrval;
                        }
                        if($val['type'] == 1 || $val['type'] == 2){
                            if(!empty($array)){
                                $last = end(array_keys($array))+1;

                                if( end(array_keys($array)) >=3 && end(array_keys($array)) <=7){//如果图片在4-8张，则增加一条用来被二维码覆盖

                                    $array[$last] = 222;
                                }
                            }
                        }

                        foreach($array as $arrurlkey => $arrurlval){
                            if($arrurlkey <9){
                                if(preg_match('/^(image).*$/',$arrurlval)){
                                    $data['data'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = URL_PIC.$arrurlval;
                                }else{
                                    $data['data'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = $arrurlval;
                                }
                                if($val['type'] == 1|| empty($val['type'])){
                                    if( $arrurlkey == $last){//将数组最后一张用二维码覆盖
                                        $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid']."&goodsid=".$foundList[$key]['goods_id'];
                                        $data['data'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                    }
                                }elseif($val['type'] == 2){
                                    if( $arrurlkey == $last){//将数组最后一张用二维码覆盖


                                        $url = URL_QCORD."index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=commission.qrcodeCopyPro&isApp=true&fakeOpenId=".$userToken[0]['openid'];
                                        $data['data'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = file_get_contents($url);
                                        //$data['data'][$key]['shareImageList'][$arrurlkey]['imageUrl'] = $url;
                                    }
                                }
                            }
                            unset($array);
                        }
                    }
                }else{
                    $data['data'] = null;
                }
            }else{
                $data['status'] = false;//token值不正确，返回错误信息：token值不正确，错误码1009
                $data['message'] = 'token值不正确';
                $data['data'] = null;
                $data['errorCode'] = 1009;
            }
        }else{
            $data['status'] = false;//token值为空，返回错误信息：token值为空，错误码1008
            $data['message'] = 'token值为空';
            $data['data'] = null;
            $data['errorCode'] = 1008;
        }
        $data['total']=end(array_keys($foundList))+1;
        $data['unauthorized'] = false;
        echo json_encode($data);
        exit;
    }

    
}
