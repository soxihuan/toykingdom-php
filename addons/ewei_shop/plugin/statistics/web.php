<?php
//decode by  
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class StatisticsWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('statistics');
    }


    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function sales()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function stat()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}