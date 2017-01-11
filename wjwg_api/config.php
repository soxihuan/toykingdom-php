<?php

return array(
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'maiclub', // 数据库名tp
    'DB_USER' => 'root', // 用户名tp
    'DB_PWD' => 'mai@club136#123*', // 密码tp
    'DB_PORT' => 3306, // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_CHARSET' => 'utf8', // 字符集
    'DB_DEBUG' => TRUE,
    'MODULE_ALLOW_LIST' => array(
        'Home',
        'Admin'
    ),
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR',
    'SHOW_PAGE_TRACE' => true, //显示调试信息
    'DEFAULT_GROUP' => 'Home',
    'URL_MODEL' => 2,
    //'TMPL_EXCEPTION_FILE' => './Application/Home/View/Public/404.html',//./Application/Home/View/Public/404.html
    'LOAD_EXT_FILE' => 'common',
    'LANG_SWITCH_ON' => false, // 开启语言包功能
    'URL_CASE_INSENSITIVE' => true, //true 不区分大小写
    'LANG_LIST' => 'zh,en,jp', // 允许切换的语言列表 用逗号分隔
    'VAR_LANGUAGE' => 'l', // 默认语言切换变量
    'DEFAULT_LANG' => 'zh',
    'URL_LIST' => array(
        'rebatesme' => "http://www.maiclub.cn"
    )
);
