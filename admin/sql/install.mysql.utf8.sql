DROP TABLE IF EXISTS `#__uslugi`;
CREATE TABLE `#__uslugi` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Имя услуги',
  `alias` varchar(25) NOT NULL COMMENT 'Псевдомен услуги',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Кадастровые услуги';
 
INSERT INTO `#__uslugi` (`id`,`name`,`alias`) VALUES
        (1,'Провести кадастровые работы по уточнению границ земельного участка','cadrab'),
        (2,'Раздел земельного участка','razdel'),
        (3,'Образование земельного участка из гос. Собственности','obrazovan'),
        (4,'Проведение топографической съемки земельного участка','topograf'),
        (5,'Изготовление технического плана','tehplan'),
        (6,'Определение местоположения точек на местности по заданным координатам','points'),
        (7,'Заказ сведений ЕГРП','egrpsved'),
        (8,'Заказать кадастровые сведения','cadsved');

DROP TABLE IF EXISTS `#__uslugi_tablelists`;
CREATE TABLE `#__uslugi_tablelists` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Имя таблицы',
  `alias` varchar(25) NOT NULL COMMENT 'Псевдомен таблицы',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Вспомогательные таблицы';
 
INSERT INTO `#__uslugi_tablelists` (`id`,`name`,`alias`) VALUES
        (1,'Типы документов','cadsved_doctype'),
        (2,'Типы недвижимости','cadsved_real'),
        (3,'Вариант доставки','variant_dostavki'),
        (4,'Вариант сведений','variant_svedeniy'),
        (5,'Местоположение земельного участка','rayon'),
        (6,'Площадь земельного участка','square'),
        (7,'Список тригеров','triggers');

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
  `sum` decimal(15,2) NOT NULL COMMENT 'Сумма заявки',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='Кадастровые сведения';
 
DROP TABLE IF EXISTS `#__uslugi_cadsved_doctype`;
CREATE TABLE `#__uslugi_cadsved_doctype` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Типы документов';
 
INSERT INTO `#__uslugi_cadsved_doctype` (`id`,`name`) VALUES
        (1,'кадастровая выписка'),
        (2,'кадастровый паспорт');

DROP TABLE IF EXISTS `#__uslugi_cadsved_real`;
CREATE TABLE `#__uslugi_cadsved_real` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Типы недвижимости';
 
INSERT INTO `#__uslugi_cadsved_real` (`id`,`name`) VALUES
        (1,'земельный участок'),
        (2,'здание'),
        (3,'помещение'),
        (4,'сооружение');

DROP TABLE IF EXISTS `#__uslugi_variant_dostavki`;
CREATE TABLE `#__uslugi_variant_dostavki` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Вариант доставки';
 
INSERT INTO `#__uslugi_variant_dostavki` (`id`,`name`) VALUES
        (1,'с доставкой'),
        (2,'без доставки');

DROP TABLE IF EXISTS `#__uslugi_variant_svedeniy`;
CREATE TABLE `#__uslugi_variant_svedeniy` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Вариант сведений';
 
INSERT INTO `#__uslugi_variant_svedeniy` (`id`,`name`) VALUES
        (1,'в электронном формате'),
        (2,'на бумажном носителе');

DROP TABLE IF EXISTS `#__uslugi_rayon`;
CREATE TABLE `#__uslugi_rayon` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Местоположение земельного участка';
 
INSERT INTO `#__uslugi_rayon` (`id`,`name`) VALUES
        (1,'г.Тюмень'),
        (2,'Тюменский район'),
        (3,'г.Заводоуковск'),
        (4,'Другое');

DROP TABLE IF EXISTS `#__uslugi_square`;
CREATE TABLE `#__uslugi_square` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT 'Наименование',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Площадь земельного участка';
 
INSERT INTO `#__uslugi_square` (`id`,`name`) VALUES
        (1,'менее 1500 кв.м.'),
        (2,'от 1500 кв.м. до 3000 кв.м.'),
        (3,'3000 кв.м. до 5000 кв.м.');

DROP TABLE IF EXISTS `#__uslugi_triggers`;
CREATE TABLE `#__uslugi_triggers` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'Наименование',
  `alias` varchar(20) NOT NULL COMMENT 'Псевдоним',
  `price` decimal(14,2) NOT NULL COMMENT 'Стоимость',
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT 'Список тригеров';
 
INSERT INTO `#__uslugi_triggers` (`id`,`name`,`alias`) VALUES
        (1,'количество экземпляров межевого плана','ex_count'),
        (2,'Вы нам доверяете процедуру внесение сведений о земельном участке на кадастровый учет','trust_saved'),
        (3,'Доставка на дом','home_delivery');
