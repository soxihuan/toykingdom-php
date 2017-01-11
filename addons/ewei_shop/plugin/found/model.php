<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
if (!class_exists("FoundModel")) {
	class FoundModel extends PluginModel
	{

	}
}