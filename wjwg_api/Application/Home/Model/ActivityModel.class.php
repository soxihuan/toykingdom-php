<?php

namespace Home\Model;

use Think\Model;

class ActivityModel extends Model {

    public $tableName = "news_user";
    public function getCats() {//获取商家分类
        $data = array(
            "activitySlug" => '',
            "type" => "merchant",
            "needCouponCount" => false,
            "lang" => LANG_SET
        );
        $cats = getCodeJson($data, 'getCategroyList');
        return $cats[0]['categroys'];
    }
    /*获取活动品牌*/
    public function getActivityBrandListBySlug($activitySlug,$queryCount)
    {
        $data = array(
            "activitySlug" => "$activitySlug",
            "lang" => LANG_SET,
            "queryCount" => $queryCount,
        );
        $getActivityBrand = getCodeJson($data, 'getBrandListByActivitySlug');
        return $getActivityBrand['brands'];
    }
    /*获取活动优惠*/
    public function getActivityCouponsBySlug($activitySlug,$queryCount)
    {
        $data = array(
            "activitySlug" => "$activitySlug",
            "startLevel" => 1,
            "endLevel" => 5,
            "queryCount" => $queryCount,
            "lang" => LANG_SET,
        );
        $couponRecommendArr = getCodeJson($data, 'getCouponList');
        return $couponRecommend = $couponRecommendArr['coupons'];
    }
    //根据Category的Id来获取优惠
    public function getCoupons($cateId,$activitySlug,$queryCount) {  
        $data = array('categoryId' => $cateId, 'queryCount' => $queryCount, "activitySlug"=>$activitySlug,'lang' => LANG_SET);
        $selectedCoupon = getCodeJson($data, 'getCouponList');
        return $selectedCoupon['coupons'];
    }
    /*获取模板数据*/
    public function getActivityTempletBySlug($activitySlug)
    {
        $data = array(
            "slug" => "$activitySlug",
        );
        $getActivityTemplet = getCodeJson($data, 'getTempletByActivitySlug');
        return $getActivityTemplet['templet'];
    }
     /*获取活动商家分类*/
    public function getActivityShopsCategoryBySlug($activitySlug) {
        $data = array(
            "activitySlug" => "$activitySlug",
            "type" => "merchant",
            "lang" => LANG_SET,
            "queryCount" =>5,
        );
        $getActivityShopsCategory = getCodeJson($data, 'getCategroyList');
        return $getActivityShopsCategory;
    }
       /*获取活动优惠分类*/
    public function getActivityCouponsCategoryBySlug($activitySlug)
    {
          $data = array(
            "activitySlug" => "$activitySlug",
                "type" => "coupon",
                "needCouponCount" => false,
                "lang" => LANG_SET,
                "queryCount"=>4
        );
        $getActivityCouponsCategory = getCodeJson($data, 'getCategroyList');
        return $getActivityCouponsCategory;
    }
    /*获取活动精选商家*/
    public function getActivityShopsBySlug($activitySlug,$queryCount)
    {
        $data = array('startLevel' => '1', 'endLevel' => '2',"activitySlug" => "$activitySlug", 'queryCount' => $queryCount, 'lang' => LANG_SET);
        $getActivityShops = getCodeJson($data, 'getMerchantList');
        return $getActivityShops;
    }
   /*获取活动分类活动下的精选商家*/
    public function getShopsByCategorys($cateId,$activitySlug,$queryCount)
    {
        $data = array(
            'categoryIds' => $cateId,
            'queryCount' => $queryCount,
            'lang' => LANG_SET,
            "activitySlug" => "$activitySlug",
            );
        $getActivityShops = getCodeJson($data, 'getMerchantList');
        return $getActivityShops["merchants"];
    }
    
    
    
}
?>

