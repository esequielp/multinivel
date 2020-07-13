/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.7.26 : Database - multinivel2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `arbol` */

DROP TABLE IF EXISTS `arbol`;

CREATE TABLE `arbol` (
  `idarbol` bigint(20) NOT NULL AUTO_INCREMENT,
  `lugar` bigint(20) NOT NULL,
  `lado` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `idusuario` bigint(20) NOT NULL,
  `idpadre` bigint(20) NOT NULL,
  `idmatriz` bigint(20) NOT NULL,
  `reservado` int(1) DEFAULT '0',
  `fecha_reserva` datetime DEFAULT NULL,
  PRIMARY KEY (`idarbol`),
  KEY `idusuario` (`idusuario`),
  KEY `idmatriz` (`idmatriz`),
  CONSTRAINT `arbol_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `arbol_ibfk_2` FOREIGN KEY (`idmatriz`) REFERENCES `matriz` (`idmatriz`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `arbol` */

insert  into `arbol`(`idarbol`,`lugar`,`lado`,`posicion`,`idusuario`,`idpadre`,`idmatriz`,`reservado`,`fecha_reserva`) values (1,1,0,0,1,1,1,0,NULL),(2,2,0,1,2,1,1,0,NULL),(3,3,0,2,3,1,1,0,NULL),(4,4,0,3,4,1,1,1,'2020-07-12 21:11:11');

/*Table structure for table `calificaciones` */

DROP TABLE IF EXISTS `calificaciones`;

CREATE TABLE `calificaciones` (
  `idcalificacion` bigint(20) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) DEFAULT NULL,
  `positivas` int(11) DEFAULT NULL,
  `negativas` int(11) DEFAULT NULL,
  `fecha_positiva` datetime DEFAULT NULL,
  `fecha_negativa` datetime DEFAULT NULL,
  PRIMARY KEY (`idcalificacion`),
  KEY `idusuario` (`idusuario`),
  CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `calificaciones` */

insert  into `calificaciones`(`idcalificacion`,`idusuario`,`positivas`,`negativas`,`fecha_positiva`,`fecha_negativa`) values (1,1,10,0,'2020-07-12 20:11:20',NULL);

/*Table structure for table `matriz` */

DROP TABLE IF EXISTS `matriz`;

CREATE TABLE `matriz` (
  `idmatriz` bigint(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  `fecha_inicio` datetime DEFAULT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `idusuario` bigint(20) NOT NULL,
  `idpago` int(11) NOT NULL,
  PRIMARY KEY (`idmatriz`),
  KEY `idusuario` (`idusuario`),
  KEY `idpago` (`idpago`),
  CONSTRAINT `matriz_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`),
  CONSTRAINT `matriz_ibfk_2` FOREIGN KEY (`idpago`) REFERENCES `pago` (`idpago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `matriz` */

insert  into `matriz`(`idmatriz`,`nombre`,`monto`,`fecha_inicio`,`fecha_fin`,`idusuario`,`idpago`) values (1,'Matriz Esequiel Palacios',3,'2020-07-12 20:10:46',NULL,1,1);

/*Table structure for table `pago` */

DROP TABLE IF EXISTS `pago`;

CREATE TABLE `pago` (
  `idpago` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` bigint(20) NOT NULL,
  `idtipopago` int(11) NOT NULL,
  `idplan` int(11) DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `status` int(1) NOT NULL,
  `monto` decimal(16,2) DEFAULT NULL,
  PRIMARY KEY (`idpago`),
  KEY `idtipopago` (`idtipopago`),
  KEY `idplan` (`idplan`),
  CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`idtipopago`) REFERENCES `pago_tipo` (`idtipopago`),
  CONSTRAINT `pago_ibfk_2` FOREIGN KEY (`idplan`) REFERENCES `plan` (`idplan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `pago` */

insert  into `pago`(`idpago`,`idusuario`,`idtipopago`,`idplan`,`fecha_pago`,`status`,`monto`) values (1,1,1,1,'2020-07-12 14:30:45',1,'3.00');

/*Table structure for table `pago_arbol` */

DROP TABLE IF EXISTS `pago_arbol`;

CREATE TABLE `pago_arbol` (
  `idpagoarbol` int(11) NOT NULL AUTO_INCREMENT,
  `idarbol` bigint(20) NOT NULL,
  `idtipopago` int(11) NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`idpagoarbol`),
  KEY `idarbol` (`idarbol`),
  KEY `idtipopago` (`idtipopago`),
  CONSTRAINT `pago_arbol_ibfk_1` FOREIGN KEY (`idarbol`) REFERENCES `arbol` (`idarbol`),
  CONSTRAINT `pago_arbol_ibfk_2` FOREIGN KEY (`idtipopago`) REFERENCES `pago_tipo` (`idtipopago`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `pago_arbol` */

insert  into `pago_arbol`(`idpagoarbol`,`idarbol`,`idtipopago`,`fecha_pago`,`status`) values (1,2,1,'2020-07-12 21:05:56',1);

/*Table structure for table `pago_tipo` */

DROP TABLE IF EXISTS `pago_tipo`;

CREATE TABLE `pago_tipo` (
  `idtipopago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apiurl` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apikey` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`idtipopago`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `pago_tipo` */

insert  into `pago_tipo`(`idtipopago`,`nombre`,`apiurl`,`apikey`) values (1,'Airtm',NULL,NULL),(2,'Pandco',NULL,NULL),(3,'Paypal',NULL,NULL);

/*Table structure for table `plan` */

DROP TABLE IF EXISTS `plan`;

CREATE TABLE `plan` (
  `idplan` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `monto` int(11) DEFAULT NULL,
  PRIMARY KEY (`idplan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `plan` */

insert  into `plan`(`idplan`,`nombre`,`monto`) values (1,'MATRIZ 3$',3),(2,'MATRIZ 5$',5),(3,'MATRIZ 10$',10),(4,'MATRIZ 15$',15),(5,'MATRIZ 20$',20),(6,'MATRIZ 25$',25),(7,'MATRIZ 30$',30),(8,'MATRIZ 35$',35),(9,'MATRIZ 40$',40),(10,'MATRIZ 50$',50),(11,'MATRIZ 100$',100);

/*Table structure for table `tasa_cambio` */

DROP TABLE IF EXISTS `tasa_cambio`;

CREATE TABLE `tasa_cambio` (
  `idatasa` int(11) NOT NULL AUTO_INCREMENT,
  `monto` decimal(16,2) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `variacion_bs` decimal(16,2) DEFAULT NULL,
  `variacion_porcentaje` int(11) DEFAULT NULL,
  PRIMARY KEY (`idatasa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `tasa_cambio` */

insert  into `tasa_cambio`(`idatasa`,`monto`,`fecha`,`variacion_bs`,`variacion_porcentaje`) values (1,'224.00','2020-07-12 20:04:06',NULL,NULL);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(250) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `apellido` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `cedula` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telefono` varchar(12) COLLATE utf8_bin DEFAULT NULL,
  `pais` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

/*Data for the table `usuario` */

insert  into `usuario`(`idusuario`,`username`,`password`,`nombre`,`apellido`,`cedula`,`fecha_nac`,`email`,`telefono`,`pais`,`created_at`) values (1,'esequielp','123','Esequiel','Palacios','14130584','1979-06-18','esequielp@gmail.com','04145315679','Venezuela','2020-07-12 14:25:54'),(2,'nohely','123','Nohely','Palacios','18836776','1988-07-16','nohelypalacios@gmail.com','04143783526','Venezuela','2020-07-12 20:30:50'),(3,'Vacio','Vacio','Vacio','Vacio','99999999',NULL,NULL,NULL,NULL,'2020-07-12 20:40:53'),(4,'Zury','123','Zurizaday','Palacios','20222333','2020-06-19','zurisaday@gmail.com','0414111111','Venezuela','2020-07-12 21:10:42');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
