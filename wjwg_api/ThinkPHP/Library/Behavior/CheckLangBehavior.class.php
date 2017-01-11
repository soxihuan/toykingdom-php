<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2012 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
namespace Behavior;
/**
 * 语言检测 并自动加载语言包
 */
class CheckLangBehavior {

    // 行为扩展的执行入口必须是run
    public function run(&$params){
        // 检测语言
        $this->checkLanguage();
    }

    public function selectLang($langSet) {
        session_start();
        cookie('rm_selected_language', $langSet, 60 * 60 * 24 *365);
		cookie('lang_chosen', $langSet, 60 * 60 * 24 *365);
		cookie('lang_chosen_legacy', $langSet, 60 * 60 * 24 *365);
        session('rm_selected_language', $langSet);
    }
    /**
     * 语言检查
     * 检查浏览器支持语言，并自动加载语言包
     * @access private
     * @return void
     */
    private function checkLanguage() {
         // 不开启语言包功能，仅仅加载框架语言文件直接返回
        if (!C('LANG_SWITCH_ON',null,false)){
            return;
        }
         // 启用了语言包功能
        $langSet = C('DEFAULT_LANG');
        $varLang =  C('VAR_LANGUAGE',null,'l');
        $langList = C('LANG_LIST',null,'en');
        
//        session_start();
        // 首先判断用户有无手动指定语言
        if(!empty($_GET[$varLang]))
        {
            $selectLang = $_GET[$varLang];   
        }
        if (isset($selectLang)) {
            // 切换语言
            $langSet = $selectLang;
            $abc='用户自己设置语言';
            if (false === stripos($langList, $langSet)) $langSet = C('DEFAULT_LANG');// 非法语言参数
            $this->selectLang($langSet);
        } else {
            // 从session中获得当前语言
            $sessionLang = session('rm_selected_language');
            if(isset($sessionLang))
            {
                $abc='从Session中获得';
                $langSet = $sessionLang;
                if (false === stripos($langList, $langSet)) {
                    $langSet = C('DEFAULT_LANG');// 非法语言参数
                    $this->selectLang($langSet); // 刷新成正确的值
                }
            } else {
                if (cookie('rm_selected_language')) {// 获取上次用户的选择
                    $langSet = cookie('rm_selected_language');
                    $abc='获取上次用户的选择';
                } elseif (null !== $this->getLangTypeByIP()) {
                    //优先级2 根据IP段判断
                    $langSet = $this->getLangTypeByIP();
                    $abc='根据IP段判断';
                } elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {// 自动侦测浏览器语言
                    preg_match('/^([a-z\d\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
                    //优先级3 根据浏览器语言判断
                    $langSet = strtolower($matches[1]) == 'zh-cn' ? 'zh' : $matches[1];
                    
                    $abc='自动侦测浏览器语言';
                }
                if (false === stripos($langList, $langSet)) $langSet = C('DEFAULT_LANG');// 非法语言参数
                $this->selectLang($langSet);
            }
        }
        // 定义当前语言
        define('LANG_SET',strtolower($langSet));
        define('HELLO',$abc);

        // 读取框架语言包
        $file   =   THINK_PATH.'Lang/'.LANG_SET.'.php';
        if(LANG_SET != C('DEFAULT_LANG') && is_file($file))
            L(include $file);

        // 读取应用公共语言包
        $file   =  LANG_PATH.LANG_SET.'.php';
        if(is_file($file))
            L(include $file);
        
        // 读取模块语言包
        $file   =   MODULE_PATH.'Lang/'.LANG_SET.'.php';
        if(is_file($file))
            L(include $file);

        // 读取当前控制器语言包
        $file   =   MODULE_PATH.'Lang/'.LANG_SET.'/'.strtolower(CONTROLLER_NAME).'.php';
        if (is_file($file))
            L(include $file);
    }
    //优先级2 获取IP
     public function getLangTypeByIP(){
//        $site_code = "rebatesme";
//        $key = "950eb1c9c6395a1a24cf7032dc8dec3d";
        $data = array('ip'=>get_client_ip());
//        $data_json = json_encode($data);
//        $beforeCheck = $site_code . $data_json . $key;
//        $check_code = md5($beforeCheck);
//       // $url = "http://service.rebatesme.com/rest/coupon/" . $func . "?siteCode=" . $site_code . "&data=" . $data_json . "&checkCode=" . $check_code . "";
//        $url = "http://10.1.1.200:8080/rest/coupon/getLangTypeByIP"."?siteCode=" . $site_code . "&data=" . $data_json . "&checkCode=" . $check_code . "";
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        $output = curl_exec($ch);
//        curl_close($ch);
//        //把取到的Json对象转换成数组
//        $lists = json_decode($output, true);
        
        /*$lists = getCodeJson($data, 'getLangTypeByIP');
        if(!empty($lists['lang'])&&isset($lists['lang']))
        {
            return $lists['lang'];   
        }else
        {
            return null;
        }*/
    }
}
