<?php
//decode by
if (!defined("IN_IA")) {
    exit("Access Denied");
}

class StatisticsWeb extends Plugin
{
    public function __construct()
    {
        parent::__construct("statistics");
    }

    public function statistics()
    {
        $this->_exec_plugin(__FUNCTION__);
    }



}