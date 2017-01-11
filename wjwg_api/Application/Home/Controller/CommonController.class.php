<?php
//
//namespace Home\Controller;
//
//use Think\Controller;
//
//class CommonController extends Controller {
//
//    function _initialize() {
//
//        header("Content-type: text/html; charset=utf-8");
//        $assignArr = array(
//            "control" => strtolower(CONTROLLER_NAME),
//            "mod" => strtolower(ACTION_NAME),
//            'lang_kind' => LANG_SET,
//            'time_cur' => time(),
//            'url_ali' => C("url_ali"),
//            'url_admin'=>C("url_admin"),
//            'url_mobile'=>C("url_mobile"),
//            "version" => C("version"),
//            'current_url' => getUrl(),
//            'commonAccount'=>$_COOKIE['commonAccount'],
//            'agentCount'=>$_COOKIE['agentCount'],
//        );
//        $this->assign($assignArr);
//    }
//
//}
