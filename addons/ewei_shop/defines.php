<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
define("ewei_shop_DEBUG", false);
!defined("ewei_shop_PATH") && define("ewei_shop_PATH", IA_ROOT . "/addons/ewei_shop/");
!defined("ewei_shop_CORE") && define("ewei_shop_CORE", ewei_shop_PATH . "core/");
!defined("ewei_shop_PLUGIN") && define("ewei_shop_PLUGIN", ewei_shop_PATH . "plugin/");
!defined("ewei_shop_INC") && define("ewei_shop_INC", ewei_shop_CORE . "inc/");
!defined("ewei_shop_URL") && define("ewei_shop_URL", $_W['siteroot'] . 'addons/ewei_shop/');
!defined("ewei_shop_STATIC") && define("ewei_shop_STATIC", ewei_shop_URL . "static/");
!defined("ewei_shop_PREFIX") && define("ewei_shop_PREFIX", "ewei_shop_");
!defined("ewei_shop_AUTH_URL") && define("ewei_shop_AUTH_URL", "http://120.26.212.219/api.php");