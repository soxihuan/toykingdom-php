<?php
//decode by  
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class FoundWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('found');
    }


    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}