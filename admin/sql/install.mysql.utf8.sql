DROP TABLE IF EXISTS `#__uslugi`;
CREATE TABLE `#__uslugi` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Имя услуги',
  `alias` varchar(25) NOT NULL COMMENT 'Псевдомен услуги',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Кадастровые услуги';
 
INSERT INTO `#__uslugi` (`id`,`name`,`alias`,`ordering`) VALUES
        (1,'Провести кадастровые работы по уточнению границ земельного участка','cadrab',1),
        (2,'Раздел земельного участка','razdel',2),
        (3,'Образование земельного участка из гос. Собственности','obrazovan',3),
        (4,'Проведение топографической съемки земельного участка','topograf',4),
        (5,'Изготовление технического плана','tehplan',5),
        (6,'Определение местоположения точек на местности по заданным координатам','points',6),
        (7,'Заказ сведений ЕГРП','egrpsved',7),
        (8,'Заказать кадастровые сведения','cadsved',8);

DROP TABLE IF EXISTS `#__uslugi_tablelists`;
CREATE TABLE `#__uslugi_tablelists` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Имя таблицы',
  `alias` varchar(25) NOT NULL COMMENT 'Псевдомен таблицы',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Вспомогательные таблицы';
 
INSERT INTO `#__uslugi_tablelists` (`id`,`name`,`alias`,`ordering`) VALUES
        (1,'Типы документов','cadsved_doctype',1),
        (2,'Типы недвижимости','cadsved_real',2),
        (3,'Вариант доставки','variant_dostavki',3),
        (4,'Вариант сведений','variant_svedeniy',4),
        (5,'Местоположение земельного участка','rayon',5),
        (6,'Площадь земельного участка','square',6),
        (7,'Список тригеров','triggers',7);

DROP TABLE IF EXISTS `#__uslugi_cadsved`;
CREATE TABLE `#__uslugi_cadsved` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cadsved_doctype_id` int(2) NOT NULL COMMENT 'ID таблицы типа документа',
  `cadsved_real_id` int(2) NOT NULL COMMENT 'ID таблицы типа недвижимости',
  `copies` int(3) NOT NULL COMMENT 'Кол-во копий',
  `variant_svedeniy_id` int(2) NOT NULL COMMENT 'ID таблицы варианта сведений',
  `variant_dostavki_id` int(2) NOT NULL COMMENT 'ID таблицы варианта доставки',
  `address` varchar(100) NOT NULL COMMENT 'Почтовый адрес',
  `time` varchar(100) NOT NULL COMMENT 'Удобное время',
  `fio` varchar(100) NOT NULL COMMENT 'ФИО',
  `phone` varchar(10) NOT NULL COMMENT 'Телефон',
  `email` varchar(70) NOT NULL COMMENT 'E-mail',
  `sum` decimal(15,0) NOT NULL COMMENT 'Сумма заявки',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Кадастровые сведения';
 
DROP TABLE IF EXISTS `#__uslugi_cadsved_doctype`;
CREATE TABLE `#__uslugi_cadsved_doctype` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Типы документов';
 
INSERT INTO `#__uslugi_cadsved_doctype` (`id`,`name`,`price`,`ordering`) VALUES
        (1,'кадастровая выписка','',1),
        (2,'кадастровый паспорт','',2);

DROP TABLE IF EXISTS `#__uslugi_cadsved_real`;
CREATE TABLE `#__uslugi_cadsved_real` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Типы недвижимости';
 
INSERT INTO `#__uslugi_cadsved_real` (`id`,`name`,`price`,`ordering`) VALUES
        (1,'земельный участок','',1),
        (2,'здание','',2),
        (3,'помещение','',3),
        (4,'сооружение','',4);

DROP TABLE IF EXISTS `#__uslugi_variant_dostavki`;
CREATE TABLE `#__uslugi_variant_dostavki` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Вариант доставки';
 
INSERT INTO `#__uslugi_variant_dostavki` (`id`,`name`,`price`,`ordering`) VALUES
        (1,'с доставкой','',1),
        (2,'без доставки','',2);

DROP TABLE IF EXISTS `#__uslugi_variant_svedeniy`;
CREATE TABLE `#__uslugi_variant_svedeniy` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Вариант сведений';
 
INSERT INTO `#__uslugi_variant_svedeniy` (`id`,`name`,`price`,`ordering`) VALUES
        (1,'в электронном формате','',1),
        (2,'на бумажном носителе','',2);

DROP TABLE IF EXISTS `#__uslugi_rayon`;
CREATE TABLE `#__uslugi_rayon` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Местоположение земельного участка';
 
INSERT INTO `#__uslugi_rayon` (`id`,`name`,`price`,`ordering`) VALUES
        (1,'г.Тюмень','3000',1),
        (2,'Тюменский район','3000',2),
        (3,'г.Заводоуковск','5000',3),
        (4,'Другое','5000',4);

DROP TABLE IF EXISTS `#__uslugi_square`;
CREATE TABLE `#__uslugi_square` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `range` int(14) NOT NULL COMMENT 'Верхняя граница',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Площадь земельного участка';
 
INSERT INTO `#__uslugi_square` (`id`,`name`,`price`,`range`,`ordering`) VALUES
        (1,'менее 1500 кв.м.','10000','1500',1),
        (2,'от 1500 кв.м. до 3000 кв.м.','12000','3000',2),
        (3,'3000 кв.м. до 5000 кв.м.','14000','5000',3);

DROP TABLE IF EXISTS `#__uslugi_triggers`;
CREATE TABLE `#__uslugi_triggers` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Наименование',
  `alias` varchar(20) NOT NULL COMMENT 'Псевдоним',
  `price` decimal(14,0) NOT NULL COMMENT 'Стоимость',
  `ordering` int(4) NOT NULL COMMENT 'Выравнивание',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Список тригеров';
 
INSERT INTO `#__uslugi_triggers` (`id`,`name`,`alias`,`price`) VALUES
        (1,'количество экземпляров межевого плана','ex_count','800'),
        (2,'Вы нам доверяете процедуру внесение сведений о земельном участке на кадастровый учет','trust_saved','1000'),
        (3,'Доставка на дом','home_delivery','1');
