<?php

namespace Home\Model;

use Think\Model;

class RightsidebarModel extends Model {

    public $tableName = "news_user";

    public function getStoresSelected() {//精选商家
        $s_stores_selected = S("" . LANG_SET . "_stores_selected");
        if (empty($s_stores_selected)) {
            $data = array('startLevel' => '1', 'endLevel' => 1, 'queryCount' => '9', 'lang' => LANG_SET);
            $arr = getCodeJson($data, 'getMerchantList');
            $s_stores_selected = $arr['merchants'];
            S("" . LANG_SET . "_stores_selected", $s_stores_selected, 1800);
        }
        return $s_stores_selected;
    }

    public function getStoresDouble() {//加倍商家
        $s_stores_double = S("" . LANG_SET . "_stores_double");
        if (empty($s_stores_double)) {
            $data = array('doubleRate' => 'true', 'lang' => LANG_SET);
            $arr = getCodeJson($data, 'getMerchantList');
            $s_stores_double = $arr['merchants'];
            S("" . LANG_SET . "_stores_double", $s_stores_double, 1800);
        }
        return $s_stores_double;
    }

    public function getStoresRelate($merchantId) {//相关商家
        $data = array('queryCount' => '9', 'lang' => LANG_SET, "merchantId" => $merchantId, "endLevel" => 5);
        $arr = getCodeJson($data, 'getRelativeMerchantList');
        return $arr['merchants'];
    }

    public function getStoresVisied($type) {//商家大全访问过的商家
        $chid_right_visit_stores = "rm-store-rvis"; //右侧商家大全访问过的商家 chid
        $c_uid = $_COOKIE['myuid'];
        if ($c_uid > 0) {
            $p = I("get.p", 1, 'int');
            $pagenum = 6;
            $cache_name = "stores_visied_" . $c_uid . "_" . $p . "_" . LANG_SET;
            $stores_visied = S($cache_name);
            if (empty($stores_visied)) {
                $data = array('queryStart' => ($p - 1) * $pagenum, 'userId' => $c_uid, 'queryCount' => $pagenum, 'lang' => LANG_SET);
                $stores_visied = getCodeJson($data, 'getBusyMerchantListByUserId');
                S($cache_name, $stores_visied, 120);
            }
            $li = '';
            foreach ($stores_visied['merchants'] as $v) {
                $li .= "<li><div class='store-button'>
<a class='storeping-btn button' target='_blank' onclick=getCouponUrl('" . getCouponUrl($v['rebateUrl'],$chid_right_visit_stores,$v['id']) . "')>" . L("shop_directly") . "</a></div><div class='store-title'>
<a href='" . __APP__ . "/stores/" . $v['urlName'] . "'>" . $v['displayName'] . "</a></div><div class='rebate'><a href='" . __APP__ . "/stores/" . $v['urlName'] . "'>" . L("check_promotions") . "</a><strong>" . getRebateEmpty($v['rateRanged']) . "" . $v['commission'] . "%</strong></div></li>";
            }
            if ($type == 1) {
                return $li;
            } else {
                $stores_visied_num = $stores_visied['totalCount'] > 48 ? 48 : $stores_visied['totalCount']; //常去商家数量
                $stores_visied_page = ceil($stores_visied_num / $pagenum); //常去商家分页
                return array("li" => $li, "page" => $stores_visied_page);
            }
        }
    }

    public function getAdvertiseList() {//首页右侧公告及帖子栏目
        $data = array('slugs' => 'ad1,ad2', 'lang' => LANG_SET);
        $arr = getCodeJson($data, 'getAdvertiseList');
        return $arr;
    }

    public function getKeywords() {//获取SEO关键字
        $data = array('slug' => '0', 'lang' => LANG_SET);
        return getCodeJson($data, 'getSEOBySlug');
    }

}
?>

