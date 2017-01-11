<?php
function getSiteKey($site_code) {
    $site_key = "950eb1c9c6395a1a24cf7032dc8dec3d";
    switch ($site_code) {
        case "zhuanyun":
            $site_key = "2451589652WDESRFTG25GTFR562356ED";
            break;
    }
    return $site_key;
}
function getCodeJson($data, $func, $site_code = "rebatesme", $mtype = "") {
    $site_code = $site_code ? $site_code : "rebatesme";
    $key = getSiteKey($site_code);
    $data_json = json_encode($data);
    $beforeCheck = $site_code . $data_json . $key;
    $check_code = md5($beforeCheck);
    if ($mtype == 2) {
        $url_func = "user";
    } else {
        $url_func = "coupon";
    }
    $url = C("url_service") . $url_func . "/" . $func . "?siteCode=" . $site_code . "&data=" . urlencode($data_json) . "&checkCode=" . $check_code . "";
    if ($func == 'getUserOrderInfo') {
//        $url = C("url_service") . $url_func . "/" . $func . "?siteCode=" . $site_code . "&data=" . $data_json . "&checkCode=" . $check_code . "";
//      echo $url.'<br/>'; 
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $lists = json_decode($output, true);
    return $lists;
}
function getUrlJson($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    $lists = json_decode($output, true);
    return $lists;
}
/**
 * 获取当前页面完整URL地址
 */
function getUrl() {
    $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
    $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
    $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
    $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self . (isset($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : $path_info);
    $relate_url = $sys_protocal . (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '') . $relate_url;
    return urlencode($relate_url);
}
//判断普通用户是否已登陆
function checkUserLogin(){
    $commonAccount = cookie('commonAccount');
    if(!empty($commonAccount)){
        return 1;
    }else{
        echo "<script>location.href='/login/'</script>";
        redirect('/login/',1, '亲，请先登陆哦...');
    }
}
//判断代理商用户是否已登陆
function checkAgentLogin(){
    $agentCount = cookie('agentCount');
    if(!empty($agentCount)){
        return 1;
    }else{
        echo "<script>location.href='/login/'</script>";
        redirect('/login/',1, '亲，请先登陆哦...');
    }
}
//获取用户真实IP
function getClientIp() {
    if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
        $ip = getenv("REMOTE_ADDR");
    else if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
        $ip = $_SERVER['REMOTE_ADDR'];
    else
        $ip = "unknown";
    return ($ip);
}