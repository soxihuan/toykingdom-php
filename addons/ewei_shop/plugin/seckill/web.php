<?php
//decode by  
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class SeckillWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct('seckill');
    }


    public function index()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function skill()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
    public function switchkill()
    {
        $this->_exec_plugin(__FUNCTION__);
    }
}