<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("SeckillModel")) {
	class SeckillModel extends PluginModel
	{

	}
}