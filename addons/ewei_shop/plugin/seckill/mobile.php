<?php
//decode by
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class SeckillWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct("seckill");
    }

    public function seckill()
    {
        $this->_exec_plugin(__FUNCTION__);
    }



}