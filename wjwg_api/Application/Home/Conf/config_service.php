<?php
$lang_sel = session('rm_selected_language');
if (!$lang_sel) {
    preg_match('/^([a-z\d\-]+)/i', $_SERVER['HTTP_ACCEPT_LANGUAGE'], $matches);
    $lang_sel = strtolower($matches[1]);
}
return array(
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' => array(
        '/^stores$/' => 'Stores/lists',
        '/^stores\/list-([0-9-]+)$/' => 'Stores/lists?paras=:1',
        '/^stores\/([a-zA-Z0-9_ -]+)\/coupons-([0-9-]+)$/' => 'Stores/detail?name=:1&p=:2', //stores/:id\d
        '/^stores\/([a-zA-Z0-9_ -]+)$/' => 'Stores/detail?name=:1', //stores/:id\d
        'search' => 'Search/stores_coupons',
        'reg' => 'Index/reg',
        'forget' => 'Pwd/find',
        'sendtip' => 'Pwd/send_tip',
        'error' => 'Index/error404',
        '/^index$/' => 'Index/index',
    ),
    'pages' => array(
        'site_store' => '5', //商家列表页分页参数位置 必须是最末尾
    ),
    'HTML_CACHE_ON' => false, // 开启静态缓存
    'HTML_CACHE_TIME' => 3600, // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.html', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(// 定义静态缓存规则
        // 定义格式1 数组方式
        'stores:' => array('Stores/'.$lang_sel.'/_q_{$_GET.query}k_{$_GET.keywords}n_{$_GET.name}_{$_GET.paras}_{$_GET.p}'),
        'index:' => array('Index/'.$lang_sel.'/_index')
    ),
    'version' => "_v2.0.1",
    'url_ali'=>"http://pics.demo.com/newrm/",
    "url_service"=>"http://service.demo.com/rest/coupon/",//http://10.1.1.200:8080/rest/coupon/ http://service.rebatesme.com/rest/coupon/
);
