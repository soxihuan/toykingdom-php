<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
function sortByCreateTime($a, $b)
{
	if ($a['createtime'] == $b['createtime']) {
		return 0;
	} else {
		return ($a['createtime'] < $b['createtime']) ? 1 : -1;
	}
}

class CommissionMobile extends Plugin
{
	protected $set = null;

	public function __construct()
	{
		parent::__construct('commission');
		$this->set = $this->getSet();
		global $_GPC;
		if ($_GPC['method'] != 'posterPage' && $_GPC['method'] != 'myshop' && $_GPC['method'] != 'register' && $_GPC['method'] != 'experience') {
			$openid = m('user')->getOpenid();
			$member = m('member')->getMember($openid);

			if ($member['isagent'] != 1 || $member['status'] != 1) {
				header('location:' . $this->createPluginMobileUrl('commission/posterPage'));
				exit;
			}
		}
	}


//自己增加的Copy页面
	public function teamCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function customerCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
	public function orderCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function indexCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}	
	public function teacherCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
	public function sharesCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function sharesCopyPro()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

		public function express1()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function express1Copy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function withdrawCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function logCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function applyCopy()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function posterPage()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function tiger()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
		public function tiger2()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}


//原系统中的页面
	public function index()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function team()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

		public function teacher()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function customer()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function order()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function withdraw()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function apply()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function shares()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
    public function inviteshares()
    {
        $this->_exec_plugin(__FUNCTION__, false);
    }
    public function invitesharesCopy()
    {
        $this->_exec_plugin(__FUNCTION__, false);
    }
	public function register()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}

	public function myshop()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
    public function experience()
    {
        $this->_exec_plugin(__FUNCTION__, false);
    }
	public function log()
	{
		$this->_exec_plugin(__FUNCTION__, false);
	}
}
