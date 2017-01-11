<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class ExhelperMobile extends Plugin
{
	public function __construct()
	{
		parent::__construct("exhelper");
		$this->set = $this->getSet();
	}
}