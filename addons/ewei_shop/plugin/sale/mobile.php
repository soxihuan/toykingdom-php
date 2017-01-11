<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class SaleMobile extends Plugin
{
	public function __construct()
	{
		parent::__construct('sale');
	}
}