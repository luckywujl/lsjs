-- ----------------------------
-- Table structure for __PREFIX__ezprint
-- ----------------------------
CREATE TABLE IF NOT EXISTS `__PREFIX__ezprint` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `code` varchar(255) DEFAULT NULL COMMENT '模板代码',
  `name` varchar(255) DEFAULT NULL COMMENT '模板名称',
  `content` longtext COMMENT '模板内容',
  `createtime` int(10) DEFAULT NULL COMMENT '创建时间',
  `updatetime` int(10) DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of __PREFIX__ezprint
-- ----------------------------
INSERT INTO `__PREFIX__ezprint` VALUES ('1', 'list', '列表示例', '<p></p><p style=\"text-align: center; \">基本信息</p><table data-type=\"table\" class=\"table table-bordered\" style=\"text-align: center;\"><tbody><tr><td>姓名</td><td><p><a class=\"printVar\" data-field=\"nickname\" href=\"nickname\">{nickname}</a><br></p></td></tr><tr><td>邮箱</td><td><p><a class=\"printVar\" data-field=\"email\" href=\"email\">{email}</a><br></p></td></tr></tbody></table>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<p></p><p></p><table data-type=\"dataSource\" id=\"list\" class=\"table table-bordered\"><tbody><tr><td><p><a class=\"printTableVar\" data-field=\"name\" href=\"name\">[姓名]</a><br></p></td><td><p><a class=\"printTableVar\" data-field=\"email\" href=\"email\">[邮箱]</a><br></p></td><td><p><a class=\"printTableVar\" data-field=\"createtime\" href=\"createtime\">[创建时间]</a><br></p></td></tr></tbody></table><p style=\"text-align: center; \"><br></p><p></p>', '1591189280', '1593147426');
INSERT INTO `__PREFIX__ezprint` VALUES ('2', 'hetong', '合同', '<p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\"><a class=\"printVar\" data-field=\"company1\" href=\"company1\"><u><b>{company1}</b></u></a>公司（以下简称甲方）为统一和提高<a class=\"printVar\" data-field=\"company2\" href=\"company2\"><font color=\"#000000\" style=\"background-color: rgb(255, 0, 0);\"><u><b>{company2}</b></u></font></a>(以下简称乙方)的店面和产品形象。为乙方营造更好的销售环境，经双方协商，本着自愿、平等、互惠、互利的原则，达成如下协议：</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">自协议签定之日，甲方负责为乙方提供店面整体设计及装修。装修内容包括：</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">门头广告牌的设计、制作、安装;<br>产品形象墙的设计、制作、安装;<br>产品展示架的设计、制作、安装;<br>店内主体色调的制定、粉刷;<br>店内棚顶吊旗的设计、制作、安装;<br>甲方免费为乙方提供样板一套、安装工作服四套及各种证书和产品说明。</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">自协议签订之日起，乙方需向甲方交纳装修保证金人民币<a class=\"printVar\" data-field=\"price\" href=\"price\">{price}</a>元整。</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">乙方在协议签订之日起一年内不得兼营其它品牌或与甲方有冲突的产品，否则将扣除乙方的装修保证金。</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">甲、乙双方合作满一年后，乙方能很好的维护甲方的产品形象，并无违约情况，甲方将如数返还乙方的装修保证金（返款方式以地板兑现）。</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">本协议一式3份，甲方2份，乙方1份。<br>本协议修改由双方协商解决。<br>本协议自双方盖章之日起生效至年月日终止。</p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px; text-indent: 2em;\"><br style=\"text-indent: 0px;\"></p><p style=\"margin-bottom: 0px; padding: 5px 0px; font-family: tahoma, 微软雅黑; font-size: 16px;\">甲&nbsp;&nbsp;方：&nbsp;&nbsp;&nbsp;<b><a class=\"printVar\" data-field=\"name1\" href=\"name1\">{name1}</a>&nbsp;</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 乙&nbsp;&nbsp;方：<a class=\"printVar\" data-field=\"name2\" href=\"name2\">{name2}</a><br>办公地址：&nbsp;&nbsp;&nbsp;<b><a class=\"printVar\" data-field=\"addr1\" href=\"addr1\">{addr1}</a>&nbsp;</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;办公地址：<a class=\"printVar\" data-field=\"addr2\" href=\"addr2\"><b>{addr2}</b></a><br>开户银行：&nbsp;&nbsp;&nbsp;<b>&nbsp;<a class=\"printVar\" data-field=\"bank1\" href=\"bank1\">{bank1}</a>&nbsp;&nbsp;&nbsp;</b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 开户银行：<a class=\"printVar\" data-field=\"bank2\" href=\"bank2\"><b>{bank2}</b></a><br>代表人（签字）：&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 代表人（签字）：<br><br></p>', '1592621691', '1592665065');

CREATE TABLE IF NOT EXISTS `__PREFIX__ezprint_example` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `createtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of __PREFIX__ezprint_example
-- ----------------------------
INSERT INTO `__PREFIX__ezprint_example` VALUES ('1', 'hetong', 'xuc2hao', 'test@qq.com', '1592140816');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('2', 'cesi', '昵称1', 'flow@qq.com', '1592140816');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('3', 'bbbbb', '人事专员', 'test@qq.com', '1592140816');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('4', '89707', '89707', 'hrhr2@qq.com', '1592140816');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('5', 'a', 'a', 'a', '1592580662');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('6', 'b', 'b', 'b', '1592580669');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('7', 'c', 'c', 'c', '1592580677');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('8', 'd', 'd', 'd', '1592580684');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('9', 'e', 'e', 'e', '1592580692');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('10', 'f', 'f', 'f', '1592580729');
INSERT INTO `__PREFIX__ezprint_example` VALUES ('11', 'g', 'g', 'g', '1592580737');