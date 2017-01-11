<?php
//decode by  
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class   MomentsWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('moments');
    }


    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}