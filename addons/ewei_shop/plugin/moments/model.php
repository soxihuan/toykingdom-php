<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("MomentsModel")) {
	class MomentsModel extends PluginModel
	{

	}
}