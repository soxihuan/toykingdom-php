<?php

namespace Home\Model;

use Think\Model;

class IndexModel extends Model {

    public $tableName = "maiclub_category";
    public function getCategory(){
        $M = M("maiclub_category");
        $data = $M ->where('ParentId=0')->select();
        return $data;
    }
    public function getMerchantsHot() {//热门商家
        $s_merchants_hot = S("" . LANG_SET . "_index_merchants_hot");
        if (empty($s_merchants_hot)) {
            $data = array(
                "queryStart" => 0,
                "queryCount" => 8,
                "needCouponCount" => false,
                "startLevel" => 1,
                "endLevel" => 1,
                "misNoCouponMerchant" => false,
                "lang" => LANG_SET
            );
            $merchants = getCodeJson($data, 'getMerchantList');
            $s_merchants_hot = $merchants['merchants'];
            S("" . LANG_SET . "_index_merchants_hot", $s_merchants_hot, 1800);
        }
        return $s_merchants_hot;
    }

    public function getSiteInfo() {
        $getSiteInfo = S("getSiteInfo");
        if (empty($getSiteInfo)) {
            $getSiteInfo = getCodeJson("", 'getSiteInfo');
            S("getSiteInfo", $getSiteInfo, 1800);
        }
        return $getSiteInfo;
    }
}
?>

