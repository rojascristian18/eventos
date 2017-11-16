/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.6.25 : Database - eventos_dev
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `evento_administradores` */

DROP TABLE IF EXISTS `evento_administradores`;

CREATE TABLE `evento_administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol_id` int(11) DEFAULT NULL,
  `codigopais_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `fono` varchar(9) NOT NULL DEFAULT '1',
  `imagen` varchar(150) DEFAULT NULL,
  `ultimo_acceso` datetime DEFAULT NULL,
  `google_id` varchar(100) DEFAULT NULL,
  `google_dominio` varchar(100) DEFAULT NULL,
  `google_nombre` varchar(50) DEFAULT NULL,
  `google_apellido` varchar(50) DEFAULT NULL,
  `google_imagen` varchar(100) DEFAULT NULL,
  `count_tareas` int(11) DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship14` (`rol_id`),
  KEY `codigo_pais` (`codigopais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `evento_administradores` */

LOCK TABLES `evento_administradores` WRITE;

insert  into `evento_administradores`(`id`,`rol_id`,`codigopais_id`,`nombre`,`apellidos`,`email`,`clave`,`fono`,`imagen`,`ultimo_acceso`,`google_id`,`google_dominio`,`google_nombre`,`google_apellido`,`google_imagen`,`count_tareas`,`activo`,`created`,`modified`) values (1,1,1,'Desarrollo Nodriza Spa','','desarrollo@nodriza.cl','c1721c9e60f0c1a4a5f9df1cd0b4f0c916b02275','99291234',NULL,'2017-06-20 12:49:35',NULL,'','','','',0,1,'2017-04-12 17:58:56','2017-06-20 12:49:35'),(2,1,1,'Cristian ','Rojas Pérez','cristian.rojas@nodriza.cl','43496642d74ad5c4a0cce621044f02fd817a0928','992965777',NULL,'2017-11-16 15:45:36','100199598951995687437','nodriza.cl','Cristian','Rojas','https://lh6.googleusercontent.com/-jYJmerMF8sQ/AAAAAAAAAAI/AAAAAAAAAEw/ax7lJsKiR4w/photo.jpg?sz=50',0,1,'2017-06-15 16:53:17','2017-11-16 15:45:36');

UNLOCK TABLES;

/*Table structure for table `evento_banners` */

DROP TABLE IF EXISTS `evento_banners`;

CREATE TABLE `evento_banners` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `imagen` varchar(150) NOT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `orden` int(11) DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship2` (`evento_id`),
  CONSTRAINT `Relationship2` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `evento_banners` */

LOCK TABLES `evento_banners` WRITE;

UNLOCK TABLES;

/*Table structure for table `evento_categorias` */

DROP TABLE IF EXISTS `evento_categorias`;

CREATE TABLE `evento_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `nombre_corto` varchar(100) NOT NULL,
  `cuerpo` longtext,
  `imagen_principal` varchar(150) DEFAULT NULL,
  `icono_imagen` varchar(100) DEFAULT NULL,
  `icono_texto` varchar(50) DEFAULT NULL,
  `orden` int(11) DEFAULT '1',
  `seo_titulo` varchar(100) DEFAULT NULL,
  `seo_descripcion` varchar(160) DEFAULT NULL,
  `seo_palabras_claves` text,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `contador_productos` int(11) DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship1` (`evento_id`),
  CONSTRAINT `Relationship1` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `evento_categorias` */

LOCK TABLES `evento_categorias` WRITE;

insert  into `evento_categorias`(`id`,`evento_id`,`parent_id`,`nombre`,`nombre_corto`,`cuerpo`,`imagen_principal`,`icono_imagen`,`icono_texto`,`orden`,`seo_titulo`,`seo_descripcion`,`seo_palabras_claves`,`activo`,`contador_productos`,`created`,`modified`) values (5,3,7,'Taladros','taladros',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','herramientas.png','Taladros',0,NULL,NULL,NULL,1,0,'2017-10-23 12:50:02','2017-10-25 12:52:37'),(6,3,7,'Esmeriles','esmeriles',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','herramientas.png','Esmeriles',1,NULL,NULL,NULL,1,0,'2017-10-23 12:50:03','2017-10-25 12:52:37'),(7,3,NULL,'Sierras','sierras',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','herramientas.png','Sierras',0,NULL,NULL,NULL,1,0,'2017-10-24 17:11:34','2017-10-25 12:52:36'),(8,6,NULL,'Accesorios','accesorios',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','fa fa-cog','Accesorios',0,NULL,NULL,NULL,1,0,'2017-10-25 13:12:56','2017-11-16 14:13:44'),(9,6,NULL,'Puntas Phillips','puntas-phillips',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','fa fa-cog','Puntas Phillips',1,NULL,NULL,NULL,1,0,'2017-10-26 12:29:04','2017-11-16 14:13:45'),(10,6,NULL,'Impresión 3D','impresion-3d',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','fa fa-cog','Impresión 3D',2,NULL,NULL,NULL,1,0,'2017-10-26 17:32:51','2017-11-16 14:13:46'),(11,6,NULL,'MultiHerramientas','multiherramientas',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','fa fa-cog','MultiHerramientas',3,NULL,NULL,NULL,1,0,'2017-10-26 17:32:51','2017-11-16 14:13:47'),(12,6,NULL,'Rectificadores','rectificadores',NULL,'92e713369508fede2fe0447b48a2e77a5f113914_bahco_slider_web_min.png','fa fa-cog','Rectificadores',4,NULL,NULL,NULL,1,0,'2017-10-26 17:32:52','2017-11-16 14:13:47'),(13,6,NULL,'Makita','makita',NULL,NULL,'fa fa-cog','Makita',1,NULL,NULL,NULL,1,0,'2017-11-15 16:47:57','2017-11-16 14:13:48');

UNLOCK TABLES;

/*Table structure for table `evento_categorias_productos` */

DROP TABLE IF EXISTS `evento_categorias_productos`;

CREATE TABLE `evento_categorias_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IX_Relationship3` (`categoria_id`),
  CONSTRAINT `Relationship3` FOREIGN KEY (`categoria_id`) REFERENCES `evento_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

/*Data for the table `evento_categorias_productos` */

LOCK TABLES `evento_categorias_productos` WRITE;

insert  into `evento_categorias_productos`(`id`,`categoria_id`,`id_product`) values (186,9,1136),(187,11,1136),(188,9,1262),(189,10,1262),(190,8,1395),(191,8,1408),(192,9,1408),(193,10,1428),(194,11,1428),(195,9,1429),(196,10,1457),(197,9,1577),(198,9,1646),(199,12,1992),(200,13,2475),(201,10,4915),(202,11,4915);

UNLOCK TABLES;

/*Table structure for table `evento_despachos` */

DROP TABLE IF EXISTS `evento_despachos`;

CREATE TABLE `evento_despachos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `orden` int(11) DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IX_Relationship5` (`evento_id`),
  CONSTRAINT `Relationship5` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

/*Data for the table `evento_despachos` */

LOCK TABLES `evento_despachos` WRITE;

insert  into `evento_despachos`(`id`,`evento_id`,`nombre`,`descripcion`,`orden`,`activo`) values (64,3,'Despacho a Santiago','Despacho a domicilio',1,1),(94,6,'Retiro en Tienda','Retira en nuestro local ubicado en ....',1,1);

UNLOCK TABLES;

/*Table structure for table `evento_eventos` */

DROP TABLE IF EXISTS `evento_eventos`;

CREATE TABLE `evento_eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tienda_id` int(11) DEFAULT NULL,
  `subdomino` varchar(50) NOT NULL,
  `nombre_tema` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sub_titulo` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `logo` varchar(150) NOT NULL,
  `favicon` varchar(150) DEFAULT NULL,
  `imagen_portada` varchar(150) DEFAULT NULL,
  `fono` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `host_imagenes` varchar(300) DEFAULT NULL,
  `fecha_inicio` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `imagen_inactivo` varchar(150) DEFAULT NULL,
  `url_redireccion` varchar(300) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `mostrar_banners` tinyint(1) NOT NULL DEFAULT '1',
  `contador_visitas` bigint(20) DEFAULT '0',
  `mostrar_cuotas` tinyint(1) DEFAULT '0',
  `cantidad_cuotas` tinyint(4) DEFAULT NULL,
  `informacion_adicional_productos` longtext,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `css_adicional` longtext,
  `js_adicional` longtext,
  `minificar_css` tinyint(1) DEFAULT '0',
  `minificar_js` tinyint(1) DEFAULT '0',
  `cache` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `evento_eventos` */

LOCK TABLES `evento_eventos` WRITE;

insert  into `evento_eventos`(`id`,`tienda_id`,`subdomino`,`nombre_tema`,`nombre`,`sub_titulo`,`descripcion`,`logo`,`favicon`,`imagen_portada`,`fono`,`email`,`host_imagenes`,`fecha_inicio`,`fecha_final`,`imagen_inactivo`,`url_redireccion`,`activo`,`mostrar_banners`,`contador_visitas`,`mostrar_cuotas`,`cantidad_cuotas`,`informacion_adicional_productos`,`created`,`modified`,`css_adicional`,`js_adicional`,`minificar_css`,`minificar_js`,`cache`) values (3,1,'precybermonday','','Pre Cyber Monday','Pre Cyber Monday 2017','','nodriza.png',NULL,NULL,'+56 2 2222 2222','contacto@nodriza.cl',NULL,'2017-10-17 00:00:00','2017-10-27 23:59:59','maxresdefault.jpg',NULL,0,1,0,1,6,'','2017-10-17 12:27:08','2017-10-24 17:11:25','','',0,0,0),(6,1,'cybermonday','cybermonday','Test','Test',NULL,'logo_1.png','isotipo_1.png',NULL,'999999999','contacto@nodriza.cl',NULL,'2017-10-25 00:00:42','2017-11-18 00:00:59','inactividad_evento.jpg',NULL,1,1,0,1,6,NULL,'2017-10-25 13:12:53','2017-11-16 14:13:28',NULL,NULL,0,0,1);

UNLOCK TABLES;

/*Table structure for table `evento_eventos_marcas` */

DROP TABLE IF EXISTS `evento_eventos_marcas`;

CREATE TABLE `evento_eventos_marcas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `orden` tinyint(4) DEFAULT '1',
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IX_Relationship6` (`evento_id`),
  CONSTRAINT `Relationship6` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `evento_eventos_marcas` */

LOCK TABLES `evento_eventos_marcas` WRITE;

insert  into `evento_eventos_marcas`(`id`,`evento_id`,`nombre`,`imagen`,`orden`,`activo`) values (1,3,'Dremel','dremel.jpg',1,1),(2,3,'Bahco','bahco.jpg',2,1),(4,3,'Milwaukee','milwaukee.jpg',3,1),(6,3,'Skil','skil.jpg',4,1),(7,6,'Dremel','dremel.jpg',1,1),(8,6,'Makita','makita.jpg',2,1),(9,6,'Skil','skil.jpg',3,1);

UNLOCK TABLES;

/*Table structure for table `evento_eventos_productos` */

DROP TABLE IF EXISTS `evento_eventos_productos`;

CREATE TABLE `evento_eventos_productos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT '1',
  `orden` int(11) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IX_Relationship7` (`evento_id`),
  CONSTRAINT `Relationship7` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

/*Data for the table `evento_eventos_productos` */

LOCK TABLES `evento_eventos_productos` WRITE;

insert  into `evento_eventos_productos`(`id`,`evento_id`,`id_product`,`activo`,`orden`) values (16,6,1992,1,1),(17,6,4915,1,1),(18,6,1262,1,1),(19,6,1261,1,1),(20,6,1136,1,1),(21,6,1429,1,1),(22,6,1435,1,1),(23,6,1428,1,1),(24,6,2475,1,1),(25,6,1408,1,1),(26,6,1457,1,1),(27,6,1646,1,1),(28,6,1577,1,1),(29,6,1395,1,1);

UNLOCK TABLES;

/*Table structure for table `evento_marcas_fabricantes` */

DROP TABLE IF EXISTS `evento_marcas_fabricantes`;

CREATE TABLE `evento_marcas_fabricantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventos_marca_id` int(11) DEFAULT NULL,
  `id_manufacturer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=162 DEFAULT CHARSET=utf8;

/*Data for the table `evento_marcas_fabricantes` */

LOCK TABLES `evento_marcas_fabricantes` WRITE;

insert  into `evento_marcas_fabricantes`(`id`,`eventos_marca_id`,`id_manufacturer`) values (29,1,8),(30,1,21),(31,1,22),(32,2,34),(33,4,33),(34,6,13),(35,6,23),(36,6,24),(37,6,25),(153,7,8),(154,7,21),(155,7,22),(156,8,3),(157,8,28),(158,9,13),(159,9,23),(160,9,24),(161,9,25);

UNLOCK TABLES;

/*Table structure for table `evento_modulos` */

DROP TABLE IF EXISTS `evento_modulos`;

CREATE TABLE `evento_modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `url` varchar(50) DEFAULT NULL,
  `icono` varchar(30) NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '1',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `evento_modulos` */

LOCK TABLES `evento_modulos` WRITE;

insert  into `evento_modulos`(`id`,`parent_id`,`nombre`,`url`,`icono`,`orden`,`activo`,`created`,`modified`) values (1,NULL,'Control de accesos','','fa fa-unlock-alt',1,1,'2017-04-13 13:35:40','2017-09-12 17:10:06'),(2,1,'Administradores','administradores','fa fa-user',1,1,'2017-04-13 13:37:39','2017-04-13 13:37:39'),(3,1,'Módulos','modulos','fa fa-cubes',1,1,'2017-04-13 13:39:18','2017-04-13 13:39:18'),(4,1,'Roles de usuario','roles','fa fa-flag-checkered',3,1,'2017-04-13 13:40:13','2017-04-13 13:41:07'),(5,NULL,'Tiendas','tiendas','fa fa-shopping-cart',2,1,'2017-04-13 13:48:54','2017-06-16 11:04:11'),(20,NULL,'Eventos','eventos','fa fa-calendar',3,1,'2017-09-12 17:13:34','2017-09-12 17:13:34'),(21,NULL,'Banners','banners','fa fa-picture-o',4,1,'2017-11-14 16:38:10','2017-11-14 16:38:10'),(22,NULL,'Páginas','paginas','fa fa-file',5,1,'2017-11-16 10:58:46','2017-11-16 10:58:46');

UNLOCK TABLES;

/*Table structure for table `evento_modulos_roles` */

DROP TABLE IF EXISTS `evento_modulos_roles`;

CREATE TABLE `evento_modulos_roles` (
  `modulo_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  PRIMARY KEY (`modulo_id`,`rol_id`),
  KEY `Relationship16` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `evento_modulos_roles` */

LOCK TABLES `evento_modulos_roles` WRITE;

insert  into `evento_modulos_roles`(`modulo_id`,`rol_id`) values (1,1),(2,1),(3,1),(4,1),(5,1),(20,1),(21,1),(22,1),(5,2),(20,2),(21,2),(22,2);

UNLOCK TABLES;

/*Table structure for table `evento_paginas` */

DROP TABLE IF EXISTS `evento_paginas`;

CREATE TABLE `evento_paginas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` bigint(20) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `cuerpo` longtext,
  `orden_menu` tinyint(4) DEFAULT '1',
  `activo` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `evento_paginas` */

LOCK TABLES `evento_paginas` WRITE;

insert  into `evento_paginas`(`id`,`evento_id`,`nombre`,`slug`,`imagen`,`cuerpo`,`orden_menu`,`activo`,`created`,`modified`) values (1,6,'Términos y Condiciones','terminos-y-condiciones','slider_toolmania_concurso_bosch.png','<div class=\"rte\" id=\"each__title\">\r\n		<h3 style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Registro de usuario</span></h3>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">El registro del cliente en este\r\n sitio constituye una condición indispensable para comprar productos a \r\ntravés del mismo. Para ello, el cliente debe registrar en la página de \r\nregistro sus datos básicos como su nombre, apellido, dirección y \r\nteléfonos, los cuales se considerarán como fidedignos. El registro del \r\ncliente en el sitio <a href=\"http://www.toolmania.cl\">www.toolmania.cl</a>\r\n implica el conocimiento y aceptación de los términos y condiciones de \r\nventas descritos en el presente documento. El usuario inscrito podrá a \r\ntravés de <a href=\"http://www.toolmania.cl\">www.toolmania.cl</a> \r\ndisponer la rectificación, eliminación y/o cancelación de sus datos \r\ncuando lo estime conveniente, en conformidad a la ley 19.628.</p>\r\n<h3 dir=\"ltr\" style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Clave secreta</span></h3>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Una vez registrado, el cliente \r\ndeberá ingresar su clave secreta para realizar cada compra, lo que \r\npermitirá el acceso personalizado, confidencial y seguro. La \r\nadministración de esta clave secreta es de absoluta responsabilidad del \r\ncliente. Su entrega a terceras personas o su utilización por dichas \r\nterceras personas, no implicará responsabilidad alguna para Nodriza. El \r\nusuario tendrá la posibilidad de cambiar la clave de acceso, para lo \r\ncual deberá sujetarse al procedimiento establecido en el sitio \r\nrespectivo.</p>\r\n<h3 dir=\"ltr\" style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Productos</span></h3>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Los productos promocionados a \r\ntravés del Sitio pueden ser vendidos por Nodriza u otros por Proveedores\r\n autorizados. La responsabilidad del cumplimiento de ciertas \r\nobligaciones recaerá en Nodriza solamente en los casos en que ocurra \r\nalgún percance ya sea en la compra, por medio de webpay, en caso de \r\nincurrir en errores de información respecto a la disponibilidad de los \r\nproductos comercializados o incumplimiento en plazos de despacho que son\r\n realizados por Nodriza; en el resto de los casos, dicha responsabilidad\r\n recaerá en el Proveedor correspondiente.</p>\r\n<h3 dir=\"ltr\" style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Garantías</span></h3>\r\n\r\n<p>Conforme lo dispone la Ley del Consumidor, todo producto nuevo cuenta\r\n con garantía legal la cual rige para los primeros tres meses desde la \r\nrecepción del mismo y procede sólo en casos de fallas de fabricación. Si\r\n este es el caso, el cliente puede concurrir al servicio técnico \r\nindicado por toolmania.cl para que se corrobore que la falla es de \r\nfabricación y no corresponde a otra causa. En caso que el diagnóstico \r\ndetermine que la falla del producto está cubierta por la garantía, ésta \r\noperará en los términos contemplados en la ley.</p>\r\n\r\n<p>No se procederá a devoluciones, cambios o reparación de ningún \r\nproducto sin previo diagnóstico servicio técnico que establezca que la \r\nfalla está cubierta conforme a lo dispuesto en la Ley del Consumidor. \r\nSin perjuicio de lo previsto en la ley, nunca estarán cubiertas fallas \r\natribuibles a daños físicos o imputables a la acción o mal uso del \r\ncliente. Al momento de la compra el cliente entiende y acepta que no se \r\nharán efectivas garantías de ningún tipo sin previo diagnóstico del \r\nservicio técnico. Los plazos de diagnóstico dependen de los servicios \r\ntécnicos según cada producto y son independientes de toolmania.cl</p>\r\n\r\n<p>Los gastos o costos de cualquier tipo en que incurra el cliente para \r\nhacer efectiva una garantía serán de su propio cargo, así como todo daño\r\n emergente y lucro cesante causado mientras el producto se encuentre en \r\nservicio técnico. Toolmania.cl no ofrece productos de reemplazo mientras\r\n se repara un producto por garantía.</p>\r\n<h3 dir=\"ltr\"><span style=\"color:#2445a2;\">Cambio y Devoluciones</span></h3>\r\n<p>El cambio de los productos que se venden a través del Sitio está \r\nsujeto a disponibilidad de stock y su devolución está condicionada al \r\ncumplimiento de las circunstancias bajo las cuales la ley permite a los \r\nconsumidores la restitución de los bienes adquiridos y la consecuente \r\nexigencia de restitución del precio pagado. Será obligación el ejercicio\r\n de la garantía –otorgada por &nbsp;el Proveedor –antes de intentar la \r\ndevolución del producto. Sólo podrán ser devueltos los productos \r\ndefectuosos y aquellos que no correspondan al producto adquirido por el \r\nusuario.</p>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Tratándose de productos \r\nvendidos con despacho, para cambios o devoluciones los compradores \r\ndeberán hacer llegar los productos a las oficinas del proveedor \r\ncorrespondiente o a las dependencias de Nodriza, salvo que se indique \r\nalgo distinto en la respectiva publicación. Será de cargo del cliente el\r\n envío del producto.</p>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Nodriza no hará retiro de \r\nproductos a los clientes en caso de defecto, incompatibilidad \r\ncompra-entrega o falta de accesorios. El producto devuelto deberá ser \r\nremitido con su boleta y con todos los elementos originales del \r\nembalaje, como las etiquetas, certificados de garantía, manuales de uso,\r\n cajas y elementos de protección, en buen estado.</p>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Ni Nodriza ni el Proveedor son responsables de la pérdida, hurto o robo del producto adquirido por el usuario.</p>\r\n<h3 dir=\"ltr\"><span style=\"color:#2445a2;\">Despacho<br></span></h3>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">El despacho se realizará una \r\nvez que se haga efectivo el pago del producto. En caso de existir una \r\ndevolución, esta solo se limitará al valor del producto, descontándose \r\nel valor publicado del despacho. <br>En el caso de las compras con despacho, debes tener en cuenta que aplican las siguientes condiciones:</p>\r\n\r\n<ul style=\"text-align:justify;\"><li dir=\"ltr\"><span>Toolmania realizará despachos en todo el territorio Chileno a través de servicios logísticos contratados.</span></li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>Debes ingresar una dirección válida en la que el \r\nproducto pueda ser entregado en cualquier momento, durante el horario \r\nestablecido.</span></p>\r\n</li><li dir=\"ltr\"><span>En el caso de despachos a Regiones (excluyendo \r\nRegión Metropolitana), estos se efectuarán a través de servicios \r\nlogísticos (definidos por el cliente y toolmania), con cobro al cliente \r\nuna vez retirados de las oficinas del servicio logístico o directamente \r\nen su domicilio.</span></li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>El producto puede ser recibido por cualquier persona mayor de edad que esté en el domicilio.&nbsp;</span></p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>Si la dirección corresponde a un edificio o recinto \r\ndonde no se permite libre acceso, el producto se entregará al portero o \r\nencargado de turno.&nbsp;</span></p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>La recepción indica que estás conforme con el estado del producto.&nbsp;</span></p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>En caso de que la dirección que hayas informado sea errónea o no haya quien reciba, te <b>constituirás en mora de recibir</b>: es decir, deberás asumir gastos de bodegaje y/o traslado adicional. En estos casos, <b>Toolmania</b> quedará liberado del cuidado y conservación del producto.</span></p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\"><span>Si el proveedor no pudiese entregar un producto, se \r\ngestionarán todas las acciones que correspondan para entregarte una \r\nsolución rápida para tu conformidad. Para solicitar la restitución del \r\ndinero, una vez evaluada la situación, es condición que hayas hecho la \r\ndevolución del producto.</span></p>\r\n</li><li dir=\"ltr\"><span>La garantía no cubre productos que hayan sido \r\nintervenidos o adulterados por terceros. Tampoco cubre daños provocados \r\npor cortes de luz o alzas de voltaje, en estos casos debes dirigir el \r\nreclamo a tu proveedor de energía eléctrica.&nbsp;</span></li></ul>\r\n<h3 dir=\"ltr\"><span style=\"color:#2445a2;\">Horarios</span></h3>\r\n<ul><li>\r\n<p><span style=\"color:#4a4a4a;\">El Horario de entrega de los productos al Cliente, cuando elige la opción \"Retiro en Tienda\", es de&nbsp;<span>&nbsp;09:30 a 14:00hrs y de 15:00 a 18:30 hrs.</span></span></p>\r\n</li><li>\r\n<p><span style=\"color:#4a4a4a;\">Toolmania despachará sus productos en&nbsp; \r\nun tiempo máximo de&nbsp;96 horas. En el caso que los despachos se encuentren\r\n en las fechas de los eventos Cyberday o Cybermonday , Toolmania tomará \r\nun plazo máximo de 2 semanas el despacho de sus productos.</span></p>\r\n</li></ul>\r\n<h3 dir=\"ltr\" style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Ofertas y promociones</span></h3>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">Nodriza podrá modificar las \r\ninformaciones dadas en el sitio web www.toolmania.cl, incluyendo las \r\nreferidas a mercaderías, servicios, precios, existencias y condiciones, \r\nen cualquier momento y sin previo aviso.</p>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">En las promociones ofrecidas \r\npor Nodriza que consistan en la entrega gratuita o rebajada de un \r\nproducto por la compra de otro, el despacho del bien que se entregue \r\ngratuitamente o a precio rebajado se hará en el mismo lugar al cual se \r\ndespacha el producto principal. Nodriza podrá modificar las \r\ninformaciones relacionadas a promociones cuando estime convenientes sin \r\nprevio aviso.</p>\r\n<p dir=\"ltr\" style=\"text-align:justify;\">No se podrá participar en promociones sin adquirir conjuntamente todos los productos comprendidos en ellas.</p>\r\n<h3 dir=\"ltr\" style=\" text-align:justify;\"><span style=\"color:#2445a2;\">Medios de pago</span></h3>\r\n<ul style=\"text-align:justify;\"><li dir=\"ltr\">\r\n<p dir=\"ltr\">Tarjetas de débito bancarias acogidas al sistema \r\nRedcompra®: Tarjetas emitidas en Chile por bancos nacionales, que se \r\nencuentren afiliadas a Transbank. Las compras por este medio no se \r\nconsideran hechas en efectivo.</p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\">Tarjetas de crédito bancarias: Tarjetas emitidas en Chile \r\nque se encuentren afiliadas a Transbank. No se admiten compras con \r\ntarjetas internacionales a través del sitio web <a href=\"http://www.toolmania.cl\">www.toolmania.cl</a>.</p>\r\n</li><li dir=\"ltr\">\r\n<p dir=\"ltr\">Transferencia electrónica o depósito en cuenta corriente: \r\nTransferencia electrónica o depósito a la cuenta corriente de Nodriza \r\ninformada al momento de la compra y enviar comprobante a <a href=\"mailto:contactotoolmania@nodriza.cl\">contacto@toolmania.cl</a>\r\n dentro de una hora desde la orden o se anulará la compra. El envío \r\noportuno del comprobante de pago a Nodriza es de exclusiva \r\nresponsabilidad del cliente.</p>\r\n</li></ul><p dir=\"ltr\" style=\"text-align:justify;\">Una vez que los fondos \r\nestén disponibles en la cuenta corriente de Nodriza, se enviará una \r\nconfirmación escrita al cliente que es la confirmación de la compra y el\r\n hecho que da cuenta de la formación del consentimiento.</p>\r\n<p style=\"text-align:justify;\">Los aspectos relativos al funcionamiento \r\nde las tarjetas aceptadas en Nodriza, están sujetos al contrato \r\nexistente entre el cliente y la identidad emisora y ésta y Transbank, \r\nsin que a Nodriza le quepa responsabilidad alguna en relación con los \r\naspectos señalados en dichos contratos. Nodriza sólo puede validar \r\ncargos previamente autorizados por Transbank.</p>\r\n<h3 dir=\"ltr\"><span style=\"color:#2445a2;\">Representante Legal</span></h3>\r\n<p>Nuestro representante legal es la Señora Blanca Pavez Ortiz, \r\nDomiciliada en la calle Diagonal Oriente 1355, Ñuñoa, Santiago. Su \r\nteléfono es el +56 22 3792188, y su correo electrónico es <a href=\"mailto:bpavez@nodriza.cl\">bpavez@nodriza.cl</a>.</p>\r\n	</div>',1,1,'2017-11-16 11:10:25','2017-11-16 11:42:29');

UNLOCK TABLES;

/*Table structure for table `evento_pagos` */

DROP TABLE IF EXISTS `evento_pagos`;

CREATE TABLE `evento_pagos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `orden` int(11) DEFAULT '1',
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `IX_Relationship4` (`evento_id`),
  CONSTRAINT `Relationship4` FOREIGN KEY (`evento_id`) REFERENCES `evento_eventos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

/*Data for the table `evento_pagos` */

LOCK TABLES `evento_pagos` WRITE;

insert  into `evento_pagos`(`id`,`evento_id`,`nombre`,`descripcion`,`orden`,`activo`) values (64,3,'Mercado pago','{{cuota}} de {{monto}}',1,1),(123,6,'Webpay','Tarjetas de crédito o débito redcompra con Webpay',1,1),(124,6,'Mecadopago','Hasta {{cuota}} de {{monto}} sin interés con Mercado pago',2,1);

UNLOCK TABLES;

/*Table structure for table `evento_roles` */

DROP TABLE IF EXISTS `evento_roles`;

CREATE TABLE `evento_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `permisos` text NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `evento_roles` */

LOCK TABLES `evento_roles` WRITE;

insert  into `evento_roles`(`id`,`nombre`,`permisos`,`activo`,`created`,`modified`) values (1,'Super usuario','{\r\n	\"eventos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"administradores\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"modulos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"roles\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tiendas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"banners\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"paginas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	}\r\n}',1,'2017-04-13 00:00:00','2017-11-16 10:55:50'),(2,'Administrador','{\r\n	\"eventos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"administradores\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 0, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"modulos\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"roles\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"tiendas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"banners\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	},\r\n	\"paginas\" : {\r\n		\"agregar\" : 1, \"editar\" : 1, \"ver\" : 1, \"eliminar\" : 1, \"activar\" : 1, \"exportar\" : 1\r\n	}\r\n}',1,'2017-06-16 11:03:55','2017-11-16 10:56:45');

UNLOCK TABLES;

/*Table structure for table `evento_tiendas` */

DROP TABLE IF EXISTS `evento_tiendas`;

CREATE TABLE `evento_tiendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `url` varchar(50) NOT NULL,
  `nombre_base_de_datos` varchar(50) NOT NULL,
  `host` varchar(100) NOT NULL,
  `usuario_mysql` varchar(50) NOT NULL,
  `pass_mysql` varchar(50) NOT NULL,
  `db_configuracion` varchar(20) NOT NULL,
  `prefijo` varchar(20) NOT NULL,
  `principal` tinyint(1) NOT NULL DEFAULT '0',
  `tema` varchar(50) NOT NULL,
  `logo` varchar(150) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `evento_tiendas` */

LOCK TABLES `evento_tiendas` WRITE;

insert  into `evento_tiendas`(`id`,`nombre`,`url`,`nombre_base_de_datos`,`host`,`usuario_mysql`,`pass_mysql`,`db_configuracion`,`prefijo`,`principal`,`tema`,`logo`,`activo`,`created`,`modified`) values (1,'Toolmania','www.toolmania.cl','toolmania2','69.164.205.133','nodriza','IgP_8111980_IgP','toolmania','tm_',1,'dark','logo_min.png',1,'2017-04-13 14:04:20','2017-10-20 16:12:42'),(2,'Walko','www.walko.cl','walko','69.164.205.133','nodriza','IgP_8111980_IgP','walko','ac_',0,'forest','asistecar_1478097949.jpg',1,'2017-04-17 16:28:01','2017-04-17 16:28:01');

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
