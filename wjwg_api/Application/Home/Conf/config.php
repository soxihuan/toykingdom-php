<?php
return array(
    'URL_ROUTER_ON' => true,
    'URL_ROUTE_RULES' => array(
        '/^index/' => 'Index/index',
    ),
    'pages' => array(
        'site_store' => '5', //商家列表页分页参数位置 必须是最末尾
    ),
    'HTML_CACHE_ON' => false, // 开启静态缓存
    'HTML_CACHE_TIME' => 3600, // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.html', // 设置静态缓存文件后缀
    'HTML_CACHE_RULES' => array(// 定义静态缓存规则
        // 定义格式1 数组方式
        'stores:' => array('Stores/' . $lang_sel . '/_q_{$_GET.query}k_{$_GET.keywords}n_{$_GET.name}_{$_GET.paras}_{$_GET.p}'),
        'index:' => array('Index/' . $lang_sel . '/_{:action}'),
        'promotion:' => array('Promotion/' . $lang_sel . '/{$_GET.name}'),
        'promotions:' => array('Promotions/' . $lang_sel . '/{$_GET.name}')
    ),
    'version' => "",
    define('URL_PIC', "http://www.njsanheshu.com/attachment/"),//图片地址
    define('URL_QCORD', "http://www.njsanheshu.com/app/"),//链接
    define('UNIACID', "2"),
    "url_service" => "http://service.demo.com/rest/", //http://10.1.1.200:8080/rest/coupon/
    "url_mobile" => "http://m.demo.cn", //http://10.1.1.200:8080/rest/coupon/


);
