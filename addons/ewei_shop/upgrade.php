<?php

 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_credittotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_credittotal` int(11) NULL DEFAULT '0';");
}
  if(!pdo_fieldexists('ewei_shop_article', 'article_rule_moneytotal')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_moneytotal` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_credit2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_credit2` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_money2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_money2` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_creditm')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_creditm` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_moneym')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_moneym` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_creditm2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_creditm2` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_rule_moneym2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_rule_moneym2` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_readtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_readtime` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_areas')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_areas` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_endtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_endtime` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'article_hasendtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `article_hasendtime` tinyint(3) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_article', 'displayorder')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_article')." ADD    `displayorder` int(11) NULL DEFAULT '0';");
} 

/**/

 if(!pdo_fieldexists('ewei_shop_dispatch', 'calculatetype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `calculatetype` tinyint(1) NULL DEFAULT '0';");
} 
 if(!pdo_fieldexists('ewei_shop_dispatch', 'firstnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `firstnum` int(11) NULL DEFAULT '0';");
} 
 if(!pdo_fieldexists('ewei_shop_dispatch', 'secondnum')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `secondnum` int(11) NULL DEFAULT '0';");
} 
 if(!pdo_fieldexists('ewei_shop_dispatch', 'firstnumprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `firstnumprice` decimal(10,2) NULL DEFAULT '0.00';");
} 
 if(!pdo_fieldexists('ewei_shop_dispatch', 'secondnumprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `secondnumprice` decimal(10,2) NULL DEFAULT '0.00';");
} 
 if(!pdo_fieldexists('ewei_shop_dispatch', 'isdefault')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_dispatch')." ADD    `isdefault` tinyint(1) NULL DEFAULT '0';");
} 

/**/

 if(!pdo_fieldexists('ewei_shop_goods', 'saleupdate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `saleupdate` tinyint(3) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'diyformtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `diyformtype` tinyint(3) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `diyformid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'diymode')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `diymode` tinyint(3) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'dispatchtype')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `dispatchtype` tinyint(1) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'dispatchid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `dispatchid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'dispatchprice')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `dispatchprice` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'manydeduct')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `manydeduct` tinyint(1) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_goods', 'shorttitle')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_goods')." ADD    `shorttitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0';");
}  

/**/

 if(!pdo_fieldexists('ewei_shop_member', 'commission')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `commission` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_member', 'commission_pay')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `commission_pay` decimal(10,2) NULL DEFAULT '0.00';");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diymemberid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diymemberid` int(11) NULL DEFAULT '0';");
} 
if(!pdo_fieldexists('ewei_shop_member', 'diymemberfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diymemberfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diymemberdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diymemberdata` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diymemberdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diymemberdataid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diycommissionid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diycommissionid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diycommissionfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diycommissionfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diycommissiondata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diycommissiondata` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_member', 'diycommissiondataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `diycommissiondataid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_member', 'isblack')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member')." ADD    `isblack` tinyint(3) NULL DEFAULT '0';");
}

/**/


 if(!pdo_fieldexists('ewei_shop_member_cart', 'diyformdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD    `diyformdataid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_member_cart', 'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD    `diyformdata` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_member_cart', 'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD    `diyformid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_member_cart', 'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_member_cart')." ADD    `diyformfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}

/**/

 if(!pdo_fieldexists('ewei_shop_order', 'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `diyformdata` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_order', 'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `diyformfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_order', 'address_send')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `address_send` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_order', 'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `diyformid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order', 'storeid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `storeid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order', 'printstate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `printstate2` tinyint(1) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order', 'printstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order')." ADD    `printstate` tinyint(1) NULL DEFAULT '0';");
}

/**/


 if(!pdo_fieldexists('ewei_shop_order_goods', 'diyformdata')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `diyformdata` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'diyformfields')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `diyformfields` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'diyformid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `diyformid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'diyformdataid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `diyformdataid` int(11) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'printstate2')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `printstate2` tinyint(1) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'printstate')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `printstate` tinyint(1) NULL DEFAULT '0';");
}
 if(!pdo_fieldexists('ewei_shop_order_goods', 'openid')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_order_goods')." ADD    `openid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;");
}  


 if(!pdo_fieldexists('ewei_shop_postera', 'starttext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD    `starttext` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}
 if(!pdo_fieldexists('ewei_shop_postera', 'endtext')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_postera')." ADD    `endtext` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}


 if(!pdo_fieldexists('ewei_shop_store', 'realname')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD    `realname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}
 if(!pdo_fieldexists('ewei_shop_store', 'mobile')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD    `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}
 if(!pdo_fieldexists('ewei_shop_store', 'fetchtime')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD    `fetchtime` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '';");
}
 if(!pdo_fieldexists('ewei_shop_store', 'type')) {
	pdo_query("ALTER TABLE ".tablename('ewei_shop_store')." ADD    `type` tinyint(1) NULL DEFAULT '0';");
}
 
$sql = "
CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_diyform_category'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NULL DEFAULT 0 COMMENT '所属帐号' ,
`name`  varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '分类名称' ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_diyform_data'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NOT NULL DEFAULT 0 ,
`typeid`  int(11) NOT NULL DEFAULT 0 COMMENT '类型id' ,
`cid`  int(11) NULL DEFAULT 0 COMMENT '关联id' ,
`diyformfields`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`fields`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字符集' ,
`openid`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '使用者openid' ,
`type`  tinyint(2) NULL DEFAULT 0 COMMENT '该数据所属模块' ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE ,
INDEX `idx_typeid` (`typeid`) USING BTREE ,
INDEX `idx_cid` (`cid`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_diyform_temp'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NOT NULL DEFAULT 0 ,
`typeid`  int(11) NULL DEFAULT 0 ,
`cid`  int(11) NOT NULL DEFAULT 0 COMMENT '关联id' ,
`diyformfields`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`fields`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字符集' ,
`openid`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '使用者openid' ,
`type`  tinyint(1) NULL DEFAULT 0 COMMENT '类型' ,
`diyformid`  int(11) NULL DEFAULT 0 ,
`diyformdata`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE ,
INDEX `idx_cid` (`cid`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_diyform_type'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NOT NULL DEFAULT 0 ,
`cate`  int(11) NULL DEFAULT 0 ,
`title`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '分类名称' ,
`fields`  text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '字段集' ,
`usedata`  int(11) NOT NULL DEFAULT 0 COMMENT '已用数据' ,
`alldata`  int(11) NOT NULL DEFAULT 0 COMMENT '全部数据' ,
`status`  tinyint(1) NULL DEFAULT 1 COMMENT '状态' ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE ,
INDEX `idx_cate` (`cate`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_exhelper_express'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NULL DEFAULT 0 ,
`type`  int(1) NOT NULL DEFAULT 1 COMMENT '单据分类 1为快递单 2为发货单' ,
`expressname`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' ,
`expresscom`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' ,
`express`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' ,
`width`  decimal(10,2) NULL DEFAULT 0.00 ,
`datas`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`height`  decimal(10,2) NULL DEFAULT 0.00 ,
`bg`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' ,
`isdefault`  tinyint(3) NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE ,
INDEX `idx_isdefault` (`isdefault`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_exhelper_senduser'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NULL DEFAULT 0 ,
`sendername`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '发件人' ,
`sendertel`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '发件人联系电话' ,
`sendersign`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '发件人签名' ,
`sendercode`  int(11) NULL DEFAULT NULL COMMENT '发件地址邮编' ,
`senderaddress`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '发件地址' ,
`sendercity`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '发件城市' ,
`isdefault`  tinyint(3) NULL DEFAULT 0 ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE ,
INDEX `idx_isdefault` (`isdefault`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_exhelper_sys'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NOT NULL DEFAULT 0 ,
`ip`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'localhost' ,
`port`  int(11) NOT NULL DEFAULT 8000 ,
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS ".tablename('ewei_shop_system_copyright'). " (
`id`  int(11) NOT NULL AUTO_INCREMENT ,
`uniacid`  int(11) NULL DEFAULT NULL ,
`copyright`  text CHARACTER SET utf8 COLLATE utf8_general_ci NULL ,
`bgcolor`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' ,
PRIMARY KEY (`id`),
INDEX `idx_uniacid` (`uniacid`) USING BTREE 
) ENGINE=MyISAM DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci;

INSERT INTO " . tablename('ewei_shop_plugin') . " (`id`,`displayorder`,`identity`,`name`,`version`,`author`,`status`,`category`) VALUES
(15,15,'diyform','自定义表单','1.0','官方','0','help'),
(16,16,'system','系统工具','1.0','官方','0','help'),
(17,17,'exhelper','快递助手','1.0','官方','0','help');
";
pdo_query($sql);