<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}

class Plugin extends Core
{
	public $pluginname;
	public $model;

	public function __construct($_var_0 = '')
	{
		parent::__construct();
		$this->modulename = "ewei_shop";
		$this->pluginname = $_var_0;
		$this->loadModel();
		if (strexists($_SERVER["REQUEST_URI"], "/web/")) {
			cpa($this->pluginname);
		} else if (strexists($_SERVER["REQUEST_URI"], "/app/")) {
			$this->setFooter();
		}
		$this->module["title"] = pdo_fetchcolumn("select title from " . tablename("modules") . " where name='ewei_shop' limit 1");
	}

	private function loadModel()
	{
		$_var_1 = IA_ROOT . "/addons/" . $this->modulename . "/plugin/" . $this->pluginname . "/model.php";
		if (is_file($_var_1)) {
			$_var_2 = ucfirst($this->pluginname) . "Model";
			require $_var_1;
			$this->model = new $_var_2($this->pluginname);
		}
	}

	public function getSet()
	{
		return $this->model->getSet();
	}

	public function updateSet($_var_3 = array())
	{
		$this->model->updateSet($_var_3);
	}

	public function template($_var_4, $_var_5 = TEMPLATE_INCLUDEPATH)
	{
		global $_W;
		$_var_6 = IA_ROOT . "/addons/ewei_shop/";
		if (defined("IN_SYS")) {
			$_var_7 = IA_ROOT . "/addons/ewei_shop/plugin/" . $this->pluginname . "/template/{$_var_4}.html";
			$_var_8 = IA_ROOT . "/data/tpl/web/{$_W["template"]}/ewei_shop/plugin/" . $this->pluginname . "/{$_var_4}.tpl.php";
			if (!is_file($_var_7)) {
				$_var_7 = IA_ROOT . "/addons/ewei_shop/template/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/tpl/web/{$_W["template"]}/ewei_shop/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_7 = IA_ROOT . "/web/themes/{$_W["template"]}/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/tpl/web/{$_W["template"]}/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_7 = IA_ROOT . "/web/themes/default/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/tpl/web/default/{$_var_4}.tpl.php";
			}
		} else {
			$_var_9 = m("cache")->getString("template_shop");
			if (empty($_var_9)) {
				$_var_9 = "default";
			}
			if (!is_dir(IA_ROOT . "/addons/ewei_shop/template/mobile/" . $_var_9)) {
				$_var_9 = "default";
			}
			$_var_10 = m("cache")->getString("template_" . $this->pluginname);
			if (empty($_var_10)) {
				$_var_10 = "default";
			}
			if (!is_dir(IA_ROOT . "/addons/ewei_shop/plugin/" . $this->pluginname . "/template/mobile/" . $_var_10)) {
				$_var_10 = "default";
			}
			$_var_8 = IA_ROOT . "/data/app/ewei_shop/plugin/" . $this->pluginname . "/{$_var_10}/mobile/{$_var_4}.tpl.php";
			$_var_7 = $_var_6 . "/plugin/" . $this->pluginname . "/template/mobile/{$_var_10}/{$_var_4}.html";
			if (!is_file($_var_7)) {
				$_var_7 = $_var_6 . "/plugin/" . $this->pluginname . "/template/mobile/default/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/app/ewei_shop/plugin/" . $this->pluginname . "/default/mobile/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_7 = $_var_6 . "/template/mobile/{$_var_9}/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/app/ewei_shop/{$_var_9}/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_7 = $_var_6 . "/template/mobile/default/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/app/ewei_shop/default/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_7 = $_var_6 . "/template/mobile/{$_var_4}.html";
				$_var_8 = IA_ROOT . "/data/app/ewei_shop/{$_var_4}.tpl.php";
			}
			if (!is_file($_var_7)) {
				$_var_11 = explode("/", $_var_4);
				$_var_12 = $_var_11[0];
				$_var_13 = m("cache")->getString("template_" . $_var_12);
				if (empty($_var_13)) {
					$_var_13 = "default";
				}
				if (!is_dir(IA_ROOT . "/addons/ewei_shop/plugin/" . $_var_12 . "/template/mobile/" . $_var_13)) {
					$_var_13 = "default";
				}
				$_var_14 = $_var_11[1];
				$_var_7 = IA_ROOT . "/addons/ewei_shop/plugin/" . $_var_12 . "/template/mobile/" . $_var_13 . "/{$_var_14}.html";
			}
		}
		if (!is_file($_var_7)) {
			exit("Error: template source '{$_var_4}' is not exist!");
		}
		if (DEVELOPMENT || !is_file($_var_8) || filemtime($_var_7) > filemtime($_var_8)) {
			shop_template_compile($_var_7, $_var_8, true);
		}
		return $_var_8;
	}

	public function _exec_plugin($_var_15, $_var_16 = true)
	{
		global $_GPC;
		if ($_var_16) {
			$_var_17 = IA_ROOT . "/addons/ewei_shop/plugin/" . $this->pluginname . "/core/web/" . $_var_15 . ".php";
		} else {
			$_var_17 = IA_ROOT . "/addons/ewei_shop/plugin/" . $this->pluginname . "/core/mobile/" . $_var_15 . ".php";
		}
		if (!is_file($_var_17)) {
			message("未找到控制器文件 : {$_var_17}");
		}
		include $_var_17;
		exit;
	}
}