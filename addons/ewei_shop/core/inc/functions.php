<?php
//decode by  
if (!defined("IN_IA")) {
	exit("Access Denied");
}
function m($_var_0 = '')
{
	static $_var_1 = array();
	if (isset($_var_1[$_var_0])) {
		return $_var_1[$_var_0];
	}
	$_var_2 = ewei_shop_CORE . "model/" . strtolower($_var_0) . ".php";
	if (!is_file($_var_2)) {
		die(" Model " . $_var_0 . " Not Found!");
	}
	require $_var_2;
	$_var_3 = "Ewei_Dshop_" . ucfirst($_var_0);
	$_var_1[$_var_0] = new $_var_3();
	return $_var_1[$_var_0];
}

function p($_var_0 = '')
{
	if ($_var_0 != "perm" && !IN_MOBILE) {
		static $_var_4;
		if (!$_var_4) {
			$_var_5 = ewei_shop_PLUGIN . "perm/model.php";
			if (is_file($_var_5)) {
				require $_var_5;
				$_var_6 = "PermModel";
				$_var_4 = new $_var_6("perm");
			}
		}
		if ($_var_4) {
			if (!$_var_4->check_plugin($_var_0)) {
				return false;
			}
		}
	}
	static $_var_7 = array();
	if (isset($_var_7[$_var_0])) {
		return $_var_7[$_var_0];
	}
	$_var_2 = ewei_shop_PLUGIN . strtolower($_var_0) . "/model.php";
	if (!is_file($_var_2)) {
		return false;
	}
	require $_var_2;
	$_var_3 = ucfirst($_var_0) . "Model";
	$_var_7[$_var_0] = new $_var_3($_var_0);
	return $_var_7[$_var_0];
}

function byte_format($_var_8, $_var_9 = 0)
{
	$_var_10 = array(" B", "K", "M", "G", "T");
	$_var_11 = round($_var_8, $_var_9);
	$_var_12 = 0;
	while ($_var_11 > 1024) {
		$_var_11 /= 1024;
		$_var_12++;
	}
	$_var_13 = round($_var_11, $_var_9) . $_var_10[$_var_12];
	return $_var_13;
}

function save_media($_var_14)
{
	load()->func("file");
	$_var_15 = array("qiniu" => false);
	$_var_16 = p("qiniu");
	if ($_var_16) {
		$_var_15 = $_var_16->getConfig();
		if ($_var_15) {
			if (strexists($_var_14, $_var_15["url"])) {
				return $_var_14;
			}
			$_var_17 = $_var_16->save(tomedia($_var_14), $_var_15);
			if (empty($_var_17)) {
				return $_var_14;
			}
			return $_var_17;
		}
		return $_var_14;
	}
	return $_var_14;
}

function save_remote($_var_14)
{
}

function is_array2($_var_18)
{
	if (is_array($_var_18)) {
		foreach ($_var_18 as $_var_19 => $_var_20) {
			return is_array($_var_20);
		}
		return false;
	}
	return false;
}

function set_medias($_var_21 = array(), $_var_22 = null)
{
	if (empty($_var_22)) {
		foreach ($_var_21 as &$_var_23) {
			$_var_23 = tomedia($_var_23);
		}
		return $_var_21;
	}
	if (!is_array($_var_22)) {
		$_var_22 = explode(",", $_var_22);
	}
	if (is_array2($_var_21)) {
		foreach ($_var_21 as $_var_24 => &$_var_11) {
			foreach ($_var_22 as $_var_25) {
				if (isset($_var_21[$_var_25])) {
					$_var_21[$_var_25] = tomedia($_var_21[$_var_25]);
				}
				if (is_array($_var_11) && isset($_var_11[$_var_25])) {
					$_var_11[$_var_25] = tomedia($_var_11[$_var_25]);
				}
			}
		}
		return $_var_21;
	} else {
		foreach ($_var_22 as $_var_25) {
			if (isset($_var_21[$_var_25])) {
				$_var_21[$_var_25] = tomedia($_var_21[$_var_25]);
			}
		}
		return $_var_21;
	}
}

function get_last_day($_var_26, $_var_27)
{
	return date("t", strtotime("{$_var_26}-{$_var_27} -1"));
}

function show_message($_var_28 = '', $_var_14 = '', $_var_29 = 'success')
{
	$_var_30 = "<script language='javascript'>require(['core'],function(core){ core.message('" . $_var_28 . "','" . $_var_14 . "','" . $_var_29 . "')})</script>";
	die($_var_30);
}

function show_json($_var_31 = 1, $_var_32 = null)
{
	$_var_33 = array("status" => $_var_31);
	if ($_var_32) {
		$_var_33["result"] = $_var_32;
	}
	die(json_encode($_var_33));
}

function is_weixin()
{
	if (empty($_SERVER["HTTP_USER_AGENT"]) || strpos($_SERVER["HTTP_USER_AGENT"], "MicroMessenger") === false && strpos($_SERVER["HTTP_USER_AGENT"], "Windows Phone") === false) {
		return false;
	}
	return true;
}

function b64_encode($_var_34)
{
	if (is_array($_var_34)) {
		return urlencode(base64_encode(json_encode($_var_34)));
	}
	return urlencode(base64_encode($_var_34));
}

function b64_decode($_var_35, $_var_36 = true)
{
	$_var_35 = base64_decode(urldecode($_var_35));
	if ($_var_36) {
		return json_decode($_var_35, true);
	}
	return $_var_35;
}

function create_image($_var_37)
{
	$_var_38 = strtolower(substr($_var_37, strrpos($_var_37, ".")));
	if ($_var_38 == ".png") {
		$_var_39 = imagecreatefrompng($_var_37);
	} else if ($_var_38 == ".gif") {
		$_var_39 = imagecreatefromgif($_var_37);
	} else {
		$_var_39 = imagecreatefromjpeg($_var_37);
	}
	return $_var_39;
}






$my_scenfiles = array();
function my_scandir($_var_49)
{
	global $my_scenfiles;
	if ($_var_50 = opendir($_var_49)) {
		while (($_var_51 = readdir($_var_50)) !== false) {
			if ($_var_51 != ".." && $_var_51 != ".") {
				if (is_dir($_var_49 . "/" . $_var_51)) {
					my_scandir($_var_49 . "/" . $_var_51);
				} else {
					$my_scenfiles[] = $_var_49 . "/" . $_var_51;
				}
			}
		}
		closedir($_var_50);
	}
}

function shop_template_compile($_var_52, $_var_53, $_var_54 = false)
{
	$_var_55 = dirname($_var_53);
	if (!is_dir($_var_55)) {
		load()->func("file");
		mkdirs($_var_55);
	}
	$_var_56 = shop_template_parse(file_get_contents($_var_52), $_var_54);
	if (IMS_FAMILY == "x" && !preg_match("/(footer|header|account\\/welcome|login|register)+/", $_var_52)) {
		$_var_56 = str_replace("微擎", "系统", $_var_56);
	}
	file_put_contents($_var_53, $_var_56);
}

function shop_template_parse($_var_35, $_var_54 = false)
{
	$_var_35 = template_parse($_var_35, $_var_54);
	$_var_35 = preg_replace("/{ifp\\s+(.+?)}/", "<?php if(cv(\$1)) { ?>", $_var_35);
	$_var_35 = preg_replace("/{ifpp\\s+(.+?)}/", "<?php if(cp(\$1)) { ?>", $_var_35);
	$_var_35 = preg_replace("/{ife\\s+(\\S+)\\s+(\\S+)}/", "<?php if( ce(\$1 ,\$2) ) { ?>", $_var_35);
	return $_var_35;
}

function ce($_var_57 = '', $_var_58 = null)
{
	$_var_59 = p("perm");
	if ($_var_59) {
		return $_var_59->check_edit($_var_57, $_var_58);
	}
	return true;
}

function cv($_var_60 = '')
{
	$_var_59 = p("perm");
	if ($_var_59) {
		return $_var_59->check_perm($_var_60);
	}
	return true;
}

function ca($_var_60 = '')
{
	if (!cv($_var_60)) {
		message("您没有权限操作，请联系管理员!", '', "error");
	}
}

function cp($_var_61 = '')
{
	$_var_59 = p("perm");
	if ($_var_59) {
		return $_var_59->check_plugin($_var_61);
	}
	return true;
}

function cpa($_var_61 = '')
{
	if (!cp($_var_61)) {
		message("您没有权限操作，请联系管理员!", '', "error");
	}
}

function plog($_var_29 = '', $_var_62 = '')
{
	$_var_59 = p("perm");
	if ($_var_59) {
		$_var_59->log($_var_29, $_var_62);
	}
}

function tpl_form_field_category_3level($_var_0, $_var_63, $_var_64, $_var_65, $_var_66, $_var_67)
{
	$_var_68 = "\r\n<script type=\"text/javascript\">\r\n\twindow._" . $_var_0 . " = " . json_encode($_var_64) . ";\r\n</script>";
	if (!defined("TPL_INIT_CATEGORY_THIRD")) {
		$_var_68 .= '
<script type="text/javascript">
	function renderCategoryThird(obj, name){
		var index = obj.options[obj.selectedIndex].value;
		require([\'jquery\', \'util\'], function($, u){
			$selectChild = $(\'#\'+name+\'_child\');
                                                      $selectThird = $(\'#\'+name+\'_third\');
			var html = \'<option value="0">请选择二级分类</option>\';
                                                      var html1 = \'<option value="0">请选择三级分类</option>\';
			if (!window[\'_\'+name] || !window[\'_\'+name][index]) {
				$selectChild.html(html); 
                                                                        $selectThird.html(html1);
				return false;
			}
			for(var i=0; i< window[\'_\'+name][index].length; i++){
				html += \'<option value="\'+window[\'_\'+name][index][i][\'id\']+\'">\'+window[\'_\'+name][index][i][\'name\']+\'</option>\';
			}
			$selectChild.html(html);
                                                    $selectThird.html(html1);
		});
	}
        function renderCategoryThird1(obj, name){
		var index = obj.options[obj.selectedIndex].value;
		require([\'jquery\', \'util\'], function($, u){
			$selectChild = $(\'#\'+name+\'_third\');
			var html = \'<option value="0">请选择三级分类</option>\';
			if (!window[\'_\'+name] || !window[\'_\'+name][index]) {
				$selectChild.html(html);
				return false;
			}
			for(var i=0; i< window[\'_\'+name][index].length; i++){
				html += \'<option value="\'+window[\'_\'+name][index][i][\'id\']+\'">\'+window[\'_\'+name][index][i][\'name\']+\'</option>\';
			}
			$selectChild.html(html);
		});
	}
</script>
			';
		define("TPL_INIT_CATEGORY_THIRD", true);
	}
	$_var_68 .= '<div class="row row-fix tpl-category-container">
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-parent" id="' . $_var_0 . "_parent\" name=\"" . $_var_0 . "[parentid]\" onchange=\"renderCategoryThird(this,'" . $_var_0 . "')\">\r\n\t\t\t<option value=\"0\">请选择一级分类</option>";
	$_var_69 = '';
	foreach ($_var_63 as $_var_23) {
		$_var_68 .= "\r\n\t\t\t<option value=\"" . $_var_23["id"] . "\" " . (($_var_23["id"] == $_var_65) ? "selected=\"selected\"" : '') . ">" . $_var_23["name"] . "</option>";
	}
	$_var_68 .= '
		</select>
	</div>
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-child" id="' . $_var_0 . "_child\" name=\"" . $_var_0 . "[childid]\" onchange=\"renderCategoryThird1(this,'" . $_var_0 . "')\">\r\n\t\t\t<option value=\"0\">请选择二级分类</option>";
	if (!empty($_var_65) && !empty($_var_64[$_var_65])) {
		foreach ($_var_64[$_var_65] as $_var_23) {
			$_var_68 .= "\r\n\t\t\t<option value=\"" . $_var_23["id"] . "\"" . (($_var_23["id"] == $_var_66) ? "selected=\"selected\"" : '') . ">" . $_var_23["name"] . "</option>";
		}
	}
	$_var_68 .= '
		</select> 
	</div> 
                  <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
		<select class="form-control tpl-category-child" id="' . $_var_0 . "_third\" name=\"" . $_var_0 . "[thirdid]\">\r\n\t\t\t<option value=\"0\">请选择三级分类</option>";
	if (!empty($_var_66) && !empty($_var_64[$_var_66])) {
		foreach ($_var_64[$_var_66] as $_var_23) {
			$_var_68 .= "\r\n\t\t\t<option value=\"" . $_var_23["id"] . "\"" . (($_var_23["id"] == $_var_67) ? "selected=\"selected\"" : '') . ">" . $_var_23["name"] . "</option>";
		}
	}
	$_var_68 .= "</select>\r\n\t</div>\r\n</div>";
	return $_var_68;
}