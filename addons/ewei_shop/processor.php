<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
require IA_ROOT . "/addons/ewei_shop/version.php";
require IA_ROOT . "/addons/ewei_shop/defines.php";
require ewei_shop_INC . "functions.php";
require ewei_shop_INC . "processor.php";
require ewei_shop_INC . "plugin/plugin_model.php";

class ewei_shopModuleProcessor extends Processor
{
	public function respond()
	{
		return parent::respond();
	}
}