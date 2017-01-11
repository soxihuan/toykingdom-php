<?php

if (!defined("IN_IA")) {
    print ("Access Denied");
}
if (!class_exists("PosteraModel")) {
    class PosteraModel extends PluginModel {
        public function getSceneTicket($zym_var_30, $zym_var_40) {
            global $_W, $_GPC;
            $zym_var_39 = m("common")->getAccount();
            $zym_var_41 = "{"expire_seconds":" . $zym_var_30 . ","action_info":{"scene":{"scene_id":" . $zym_var_40 . "}},"action_name":"QR_SCENE"}";
            $zym_var_42 = $zym_var_39->fetch_token();
            $zym_var_43 = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $zym_var_42;
            $zym_var_38 = curl_init();
            curl_setopt($zym_var_38, CURLOPT_URL, $zym_var_43);
            curl_setopt($zym_var_38, CURLOPT_POST, 1);
            curl_setopt($zym_var_38, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($zym_var_38, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($zym_var_38, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($zym_var_38, CURLOPT_POSTFIELDS, $zym_var_41);
            $zym_var_37 = curl_exec($zym_var_38);
            $zym_var_33 = @json_decode($zym_var_37, true);
            if (!is_array($zym_var_33)) {
                return false;
            }
            if (!empty($zym_var_33["errcode"])) {
                return error(-1, $zym_var_33["errmsg"]);
            }
            $zym_var_32 = $zym_var_33["ticket"];
            return array(
                "barcode" => json_decode($zym_var_41, true) ,
                "ticket" => $zym_var_32
            );
        }
        function getSceneID() {
            global $_W;
            $zym_var_34 = $_W["acid"];
            $zym_var_35 = 1;
            $zym_var_36 = 2147483647;
            $zym_var_40 = rand($zym_var_35, $zym_var_36);
            if (empty($zym_var_40)) {
                $zym_var_40 = rand($zym_var_35, $zym_var_36);
            }
            while (1) {
                $zym_var_45 = pdo_fetchcolumn("select count(*) from " . tablename("qrcode") . " where qrcid=:qrcid and acid=:acid and model=0 limit 1", array(
                    ":qrcid" => $zym_var_40,
                    ":acid" => $zym_var_34
                ));
                if ($zym_var_45 <= 0) {
                    break;
                }
                $zym_var_40 = rand($zym_var_35, $zym_var_36);
                if (empty($zym_var_40)) {
                    $zym_var_40 = rand($zym_var_35, $zym_var_36);
                }
            }
            return $zym_var_40;
        }
        public function getQR($zym_var_51, $zym_var_54) {
            global $_W, $_GPC;
            $zym_var_34 = $_W["acid"];
            $zym_var_53 = time();
            $zym_var_55 = $zym_var_51["timeend"];
            $zym_var_30 = $zym_var_55 - $zym_var_53;
            if ($zym_var_30 > 86400 * 30 - 15) {
                $zym_var_30 = 86400 * 30 - 15;
            }
            $zym_var_57 = $zym_var_53 + $zym_var_30;
            $zym_var_52 = pdo_fetch("select * from " . tablename("ewei_shop_postera_qr") . " where openid=:openid and acid=:acid and posterid=:posterid limit 1", array(
                ":openid" => $zym_var_54["openid"],
                ":acid" => $zym_var_34,
                ":posterid" => $zym_var_51["id"]
            ));
            if (empty($zym_var_52)) {
                $zym_var_52["current_qrimg"] = '';
                $zym_var_40 = $this->getSceneID();
                $zym_var_33 = $this->getSceneTicket($zym_var_30, $zym_var_40);
                if (is_error($zym_var_33)) {
                    return $zym_var_33;
                }
                if (empty($zym_var_33)) {
                    return error(-1, "生成二维码失败");
                }
                $zym_var_47 = $zym_var_33["barcode"];
                $zym_var_32 = $zym_var_33["ticket"];
                $zym_var_46 = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $zym_var_32;
                $zym_var_48 = array(
                    "uniacid" => $_W["uniacid"],
                    "acid" => $_W["acid"],
                    "qrcid" => $zym_var_40,
                    "model" => 0,
                    "name" => "EWEI_SHOP_POSTERA_QRCODE",
                    "keyword" => "EWEI_SHOP_POSTERA",
                    "expire" => $zym_var_30,
                    "createtime" => time() ,
                    "status" => 1,
                    "url" => $zym_var_33["url"],
                    "ticket" => $zym_var_33["ticket"]
                );
                pdo_insert("qrcode", $zym_var_48);
                $zym_var_52 = array(
                    "acid" => $zym_var_34,
                    "openid" => $zym_var_54["openid"],
                    "sceneid" => $zym_var_40,
                    "type" => $zym_var_51["type"],
                    "ticket" => $zym_var_33["ticket"],
                    "qrimg" => $zym_var_46,
                    "posterid" => $zym_var_51["id"],
                    "expire" => $zym_var_30,
                    "url" => $zym_var_33["url"],
                    "goodsid" => $zym_var_51["goodsid"],
                    "endtime" => $zym_var_57
                );
                pdo_insert("ewei_shop_postera_qr", $zym_var_52);
                $zym_var_52["id"] = pdo_insertid();
            } else {
                $zym_var_52["current_qrimg"] = $zym_var_52["qrimg"];
                if (time() > $zym_var_52["endtime"]) {
                    $zym_var_40 = $zym_var_52["sceneid"];
                    $zym_var_33 = $this->getSceneTicket($zym_var_30, $zym_var_40);
                    if (is_error($zym_var_33)) {
                        return $zym_var_33;
                    }
                    if (empty($zym_var_33)) {
                        return error(-1, "生成二维码失败");
                    }
                    $zym_var_47 = $zym_var_33["barcode"];
                    $zym_var_32 = $zym_var_33["ticket"];
                    $zym_var_46 = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $zym_var_32;
                    pdo_update("qrcode", array(
                        "ticket" => $zym_var_33["ticket"],
                        "url" => $zym_var_33["url"]
                    ) , array(
                        "acid" => $_W["acid"],
                        "qrcid" => $zym_var_40
                    ));
                    pdo_update("ewei_shop_postera_qr", array(
                        "ticket" => $zym_var_32,
                        "qrimg" => $zym_var_46,
                        "url" => $zym_var_33["url"],
                        "endtime" => $zym_var_57
                    ) , array(
                        "id" => $zym_var_52["id"]
                    ));
                    $zym_var_52["ticket"] = $zym_var_32;
                    $zym_var_52["qrimg"] = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $zym_var_52["ticket"];
                }
            }
            return $zym_var_52;
        }
        public function getRealData($zym_var_49) {
            $zym_var_49["left"] = intval(str_replace("px", '', $zym_var_49["left"])) * 2;
            $zym_var_49["top"] = intval(str_replace("px", '', $zym_var_49["top"])) * 2;
            $zym_var_49["width"] = intval(str_replace("px", '', $zym_var_49["width"])) * 2;
            $zym_var_49["height"] = intval(str_replace("px", '', $zym_var_49["height"])) * 2;
            $zym_var_49["size"] = intval(str_replace("px", '', $zym_var_49["size"])) * 2;
            $zym_var_49["src"] = tomedia($zym_var_49["src"]);
            return $zym_var_49;
        }
        public function createImage($zym_var_50) {
            load()->func("communication");
            $zym_var_56 = ihttp_request($zym_var_50);
            return zymfunc_1($zym_var_56["content"]);
        }
        public function mergeImage($zym_var_44, $zym_var_49, $zym_var_50) {
            $zym_var_31 = $this->createImage($zym_var_50);
            $zym_var_10 = imagesx($zym_var_31);
            $zym_var_9 = imagesy($zym_var_31);
            imagecopyresized($zym_var_44, $zym_var_31, $zym_var_49["left"], $zym_var_49["top"], 0, 0, $zym_var_49["width"], $zym_var_49["height"], $zym_var_10, $zym_var_9);
            imagedestroy($zym_var_31);
            return $zym_var_44;
        }
        public function mergeText($zym_var_44, $zym_var_49, $zym_var_11) {
            $zym_var_12 = IA_ROOT . "/addons/ewei_shop/static/fonts/msyh.ttf";
            $zym_var_14 = $this->hex2rgb($zym_var_49["color"]);
            $zym_var_13 = imagecolorallocate($zym_var_44, $zym_var_14["red"], $zym_var_14["green"], $zym_var_14["blue"]);
            imagettftext($zym_var_44, $zym_var_49["size"], 0, $zym_var_49["left"], $zym_var_49["top"] + $zym_var_49["size"], $zym_var_13, $zym_var_12, $zym_var_11);
            return $zym_var_44;
        }
        function hex2rgb($zym_var_8) {
            if ($zym_var_8[0] == "#") {
                $zym_var_8 = substr($zym_var_8, 1);
            }
            if (strlen($zym_var_8) == 6) {
                list($zym_var_7, $zym_var_2, $zym_var_1) = array(
                    $zym_var_8[0] . $zym_var_8[1],
                    $zym_var_8[2] . $zym_var_8[3],
                    $zym_var_8[4] . $zym_var_8[5]
                );
            } elseif (strlen($zym_var_8) == 3) {
                list($zym_var_7, $zym_var_2, $zym_var_1) = array(
                    $zym_var_8[0] . $zym_var_8[0],
                    $zym_var_8[1] . $zym_var_8[1],
                    $zym_var_8[2] . $zym_var_8[2]
                );
            } else {
                return false;
            }
            $zym_var_7 = hexdec($zym_var_7);
            $zym_var_2 = hexdec($zym_var_2);
            $zym_var_1 = hexdec($zym_var_1);
            return array(
                "red" => $zym_var_7,
                "green" => $zym_var_2,
                "blue" => $zym_var_1
            );
        }
        public function createPoster($zym_var_51, $zym_var_54, $zym_var_52, $zym_var_3 = true) {
            global $_W;
            $zym_var_4 = IA_ROOT . "/addons/ewei_shop/data/postera/" . $_W["uniacid"] . "/";
            if (!is_dir($zym_var_4)) {
                load()->func("file");
                mkdirs($zym_var_4);
            }
            if (!empty($zym_var_52["goodsid"])) {
                $zym_var_6 = pdo_fetch("select id,title,thumb,commission_thumb,marketprice,productprice from " . tablename("ewei_shop_goods") . " where id=:id and uniacid=:uniacid limit 1", array(
                    ":id" => $zym_var_52["goodsid"],
                    ":uniacid" => $_W["uniacid"]
                ));
                if (empty($zym_var_6)) {
                    m("message")->sendCustomNotice($zym_var_54["openid"], "未找到商品，无法生成海报");
                    exit;
                }
            }
            $zym_var_5 = md5(json_encode(array(
                "openid" => $zym_var_54["openid"],
                "goodsid" => $zym_var_52["goodsid"],
                "bg" => $zym_var_51["bg"],
                "data" => $zym_var_51["data"],
                "version" => 1
            )));
            $zym_var_15 = $zym_var_5 . ".png";
            if (!is_file($zym_var_4 . $zym_var_15) || $zym_var_52["qrimg"] != $zym_var_52["current_qrimg"]) {
                set_time_limit(0);
                @ini_set("memory_limit", "256M");
                $zym_var_44 = imagecreatetruecolor(640, 1008);
                $zym_var_16 = $this->createImage(tomedia($zym_var_51["bg"]));
                imagecopy($zym_var_44, $zym_var_16, 0, 0, 0, 0, 640, 1008);
                imagedestroy($zym_var_16);
                $zym_var_49 = json_decode(str_replace("&quot;", "'", $zym_var_51["data"]) , true);
                foreach ($zym_var_49 as $zym_var_26) {
                    $zym_var_26 = $this->getRealData($zym_var_26);
                    if ($zym_var_26["type"] == "head") {
                        $zym_var_25 = preg_replace("/\/0$/i", "/96", $zym_var_54["avatar"]);
                        $zym_var_44 = $this->mergeImage($zym_var_44, $zym_var_26, $zym_var_25);
                    } else if ($zym_var_26["type"] == "time") {
                        $zym_var_53 = date("Y-m-d H:i", $zym_var_52["endtime"]);
                        $zym_var_44 = $this->mergeText($zym_var_44, $zym_var_26, $zym_var_53);
                    } else if ($zym_var_26["type"] == "img") {
                        $zym_var_44 = $this->mergeImage($zym_var_44, $zym_var_26, $zym_var_26["src"]);
                    } else if ($zym_var_26["type"] == "qr") {
                        $zym_var_44 = $this->mergeImage($zym_var_44, $zym_var_26, tomedia($zym_var_52["qrimg"]));
                    } else if ($zym_var_26["type"] == "nickname") {
                        $zym_var_44 = $this->mergeText($zym_var_44, $zym_var_26, $zym_var_54["nickname"]);
                    } else {
                        if (!empty($zym_var_6)) {
                            if ($zym_var_26["type"] == "title") {
                                $zym_var_44 = $this->mergeText($zym_var_44, $zym_var_26, $zym_var_6["title"]);
                            } else if ($zym_var_26["type"] == "thumb") {
                                $zym_var_27 = !empty($zym_var_6["commission_thumb"]) ? tomedia($zym_var_6["commission_thumb"]) : tomedia($zym_var_6["thumb"]);
                                $zym_var_44 = $this->mergeImage($zym_var_44, $zym_var_26, $zym_var_27);
                            } else if ($zym_var_26["type"] == "marketprice") {
                                $zym_var_44 = $this->mergeText($zym_var_44, $zym_var_26, $zym_var_6["marketprice"]);
                            } else if ($zym_var_26["type"] == "productprice") {
                                $zym_var_44 = $this->mergeText($zym_var_44, $zym_var_26, $zym_var_6["productprice"]);
                            }
                        }
                    }
                }
                imagepng($zym_var_44, $zym_var_4 . $zym_var_15);
                imagedestroy($zym_var_44);
            }
            $zym_var_31 = $_W["siteroot"] . "addons/ewei_shop/data/poster/" . $_W["uniacid"] . "/" . $zym_var_15;
            if (!$zym_var_3) {
                return $zym_var_31;
            }
            if ($zym_var_52["qrimg"] != $zym_var_52["current_qrimg"] || empty($zym_var_52["mediaid"]) || empty($zym_var_52["createtime"]) || $zym_var_52["createtime"] + 3600 * 24 * 3 - 7200 < time()) {
                $zym_var_28 = $this->uploadImage($zym_var_4 . $zym_var_15);
                $zym_var_52["mediaid"] = $zym_var_28;
                pdo_update("ewei_shop_postera_qr", array(
                    "mediaid" => $zym_var_28,
                    "createtime" => time()
                ) , array(
                    "id" => $zym_var_52["id"]
                ));
            }
            return array(
                "img" => $zym_var_31,
                "mediaid" => $zym_var_52["mediaid"]
            );
        }
        public function uploadImage($zym_var_31) {
            load()->func("communication");
            $zym_var_39 = m("common")->getAccount();
            $zym_var_29 = $zym_var_39->fetch_token();
            $zym_var_43 = "http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token={$zym_var_29}&type=image";
            $zym_var_38 = curl_init();
            $zym_var_49 = array(
                "media" => "@" . $zym_var_31
            );
            if (version_compare(PHP_VERSION, "5.5.0", ">")) {
                $zym_var_49 = array(
                    "media" => curl_file_create($zym_var_31)
                );
            }
            curl_setopt($zym_var_38, CURLOPT_URL, $zym_var_43);
            curl_setopt($zym_var_38, CURLOPT_POST, 1);
            curl_setopt($zym_var_38, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($zym_var_38, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($zym_var_38, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($zym_var_38, CURLOPT_POSTFIELDS, $zym_var_49);
            $zym_var_24 = @json_decode(curl_exec($zym_var_38) , true);
            if (!is_array($zym_var_24)) {
                $zym_var_24 = array(
                    "media_id" => ''
                );
            }
            curl_close($zym_var_38);
            return $zym_var_24["media_id"];
        }
        public function getQRByTicket($zym_var_32 = '') {
            global $_W;
            if (empty($zym_var_32)) {
                return false;
            }
            $zym_var_23 = pdo_fetchall("select * from " . tablename("ewei_shop_postera_qr") . " where ticket=:ticket and acid=:acid limit 1", array(
                ":ticket" => $zym_var_32,
                ":acid" => $_W["acid"]
            ));
            $zym_var_45 = count($zym_var_23);
            if ($zym_var_45 <= 0) {
                return false;
            }
            if ($zym_var_45 == 1) {
                return $zym_var_23[0];
            }
            return false;
        }
        public function checkMember($zym_var_18 = '') {
            global $_W;
            $zym_var_17 = WeiXinAccount::create($_W["acid"]);
            $zym_var_19 = $zym_var_17->fansQueryInfo($zym_var_18);
            $zym_var_19["avatar"] = $zym_var_19["headimgurl"];
            load()->model("mc");
            $zym_var_20 = mc_openid2uid($zym_var_18);
            if (!empty($zym_var_20)) {
                pdo_update("mc_members", array(
                    "nickname" => $zym_var_19["nickname"],
                    "gender" => $zym_var_19["sex"],
                    "nationality" => $zym_var_19["country"],
                    "resideprovince" => $zym_var_19["province"],
                    "residecity" => $zym_var_19["city"],
                    "avatar" => $zym_var_19["headimgurl"]
                ) , array(
                    "uid" => $zym_var_20
                ));
            }
            pdo_update("mc_mapping_fans", array(
                "nickname" => $zym_var_19["nickname"]
            ) , array(
                "uniacid" => $_W["uniacid"],
                "openid" => $zym_var_18
            ));
            $zym_var_22 = m("member");
            $zym_var_54 = $zym_var_22->getMember($zym_var_18);
            if (empty($zym_var_54)) {
                $zym_var_21 = mc_fetch($zym_var_20, array(
                    "realname",
                    "nickname",
                    "mobile",
                    "avatar",
                    "resideprovince",
                    "residecity",
                    "residedist"
                ));
                $zym_var_54 = array(
                    "uniacid" => $_W["uniacid"],
                    "uid" => $zym_var_20,
                    "openid" => $zym_var_18,
                    "realname" => $zym_var_21["realname"],
                    "mobile" => $zym_var_21["mobile"],
                    "nickname" => !empty($zym_var_21["nickname"]) ? $zym_var_21["nickname"] : $zym_var_19["nickname"],
                    "avatar" => !empty($zym_var_21["avatar"]) ? $zym_var_21["avatar"] : $zym_var_19["avatar"],
                    "gender" => !empty($zym_var_21["gender"]) ? $zym_var_21["gender"] : $zym_var_19["sex"],
                    "province" => !empty($zym_var_21["resideprovince"]) ? $zym_var_21["resideprovince"] : $zym_var_19["province"],
                    "city" => !empty($zym_var_21["residecity"]) ? $zym_var_21["residecity"] : $zym_var_19["city"],
                    "area" => $zym_var_21["residedist"],
                    "createtime" => time() ,
                    "status" => 0
                );
                pdo_insert("ewei_shop_member", $zym_var_54);
                $zym_var_54["id"] = pdo_insertid();
                $zym_var_54["isnew"] = true;
            } else {
                $zym_var_54["nickname"] = $zym_var_19["nickname"];
                $zym_var_54["avatar"] = $zym_var_19["headimgurl"];
                $zym_var_54["province"] = $zym_var_19["province"];
                $zym_var_54["city"] = $zym_var_19["city"];
                pdo_update("ewei_shop_member", $zym_var_54, array(
                    "id" => $zym_var_54["id"]
                ));
                $zym_var_54["isnew"] = false;
            }
            return $zym_var_54;
        }
        function perms() {
            return array(
                "postera" => array(
                    "text" => $this->getName() ,
                    "isplugin" => true,
                    "view" => "浏览",
                    "add" => "添加-log",
                    "edit" => "修改-log",
                    "delete" => "删除-log",
                    "log" => "扫描记录",
                    "clear" => "清除缓存-log",
                    "setdefault" => "设置默认海报-log"
                )
            );
        }
    }
} ?>
