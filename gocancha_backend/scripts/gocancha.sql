-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: localhost    Database: gocancha
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `address_distrito` varchar(145) DEFAULT NULL,
  `address_calle` varchar(145) DEFAULT NULL,
  `address_numero` varchar(145) DEFAULT NULL,
  `address_referencia` varchar(245) DEFAULT NULL,
  `address_latitud` decimal(10,6) DEFAULT NULL,
  `address_longitud` decimal(10,6) DEFAULT NULL,
  `address_direccionusuario` varchar(250) DEFAULT '',
  `address_estado` tinyint(3) DEFAULT NULL,
  `address_default` char(1) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_address_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_address_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
INSERT INTO `address` VALUES (1,1,'Piura','Tupac Amaru','210','Por el parque',-5.190923,-80.650216,'Tupac Amaru 210',1,'0'),(2,4,'Piura','Tupac Amaru','210','Por el parque',-5.190923,-80.650216,'Tupac Amaru 210',1,'0'),(3,1,'Urb Santa Ana','Urb Los educadores Mz Q lote 23','',NULL,-5.187785,-80.642985,'Urb Los educadores Mz Q lote 23',1,'1'),(4,4,'Residencial Piura',' , Piura','',NULL,-5.189165,-80.646646,' , Piura',1,'0'),(5,7,'Residencial Piura','Residencial Piura','',NULL,-5.189165,-80.646646,'Residencial Piura',1,'1'),(6,8,'Residencial Piura',' , Piura','',NULL,-5.189165,-80.646646,' , Piura',1,'0'),(7,8,'Urb. Bancaria','Santo Tomas 245, Urb. Bancaria','',NULL,-5.186694,-80.645241,'Santo Tomas 245, Urb. Bancaria',1,'0'),(8,4,'Piura',' , Piura','',NULL,-5.164760,-80.633928,' , Piura',1,'0'),(9,8,'Urb Mariscal Ramon Castilla','Avenida Velasco Astete 180, Urb Mariscal Ramon Castilla','',NULL,-12.092901,-76.986053,'Avenida Velasco Astete 180, Urb Mariscal Ramon Castilla',1,'0'),(10,4,'Ot Centro Historico de Piura','Ica 748, Ot Centro Historico de Piura','',NULL,-5.194944,-80.629258,'Ica 748, Ot Centro Historico de Piura',1,'1'),(11,8,'Piura',' , Piura','',NULL,-5.178288,-80.654888,' , Piura',1,'0'),(12,8,'Urb Mariscal Ramon Castilla','Avenida Velasco Astete 296, Urb Mariscal Ramon Castilla','',NULL,-12.094483,-76.985907,'Avenida Velasco Astete 296, Urb Mariscal Ramon Castilla',1,'0'),(13,8,'Urb Mariscal Ramon Castilla','Calle 29 130, Urb Mariscal Ramon Castilla','',NULL,-12.093312,-76.985008,'Calle 29 130, Urb Mariscal Ramon Castilla',1,'0'),(14,8,'Casuarinas Sur','Calle Las Dalias 321, Casuarinas Sur','',NULL,-12.127660,-76.970448,'Calle Las Dalias 321, Casuarinas Sur',1,'0'),(15,8,'Piura','Piura','',NULL,-5.164803,-80.633934,'Piura',1,'0'),(16,8,'Urb Ingenieros Valle Hermoso','Las Azucenas 166, Urb Ingenieros Valle Hermoso','',NULL,-12.128416,-76.974032,'Las Azucenas 166, Urb Ingenieros Valle Hermoso',1,'0'),(17,8,'Urb. Piura 4ta Etapa',' , Urb. Piura 4ta Etapa','',NULL,-5.190837,-80.653848,' , Urb. Piura 4ta Etapa',1,'0'),(18,8,'Miraflores','Cayetano Heredia 109, Miraflores','',NULL,-5.197825,-80.621098,'Cayetano Heredia 109, Miraflores',1,'0'),(19,8,'Ot Centro Historico de Piura','Ica 732, Ot Centro Historico de Piura','',NULL,-5.194952,-80.629215,'Ica 732, Ot Centro Historico de Piura',1,'0'),(20,8,'Los Geranios',' , Los Geranios','',NULL,-5.170992,-80.629333,' , Los Geranios',1,'0'),(21,8,'Urb Mariscal Ramon Castilla','Calle 31 169, Urb Mariscal Ramon Castilla','',NULL,-12.094694,-76.987131,'Calle 31 169, Urb Mariscal Ramon Castilla',1,'0'),(22,8,'Urb Corpac','Calle William Gilbert 150, Urb Corpac','',NULL,-12.105132,-77.010585,'Calle William Gilbert 150, Urb Corpac',1,'0'),(23,8,'Residencial Piura','Los Cocos 294, Residencial Piura','',NULL,-5.190988,-80.642964,'Los Cocos 294, Residencial Piura',1,'0'),(24,8,'Urb Residencial Valle Hermoso','Jirón Jacarandá 692, Urb Residencial Valle Hermoso','',NULL,-12.124029,-76.975104,'Jirón Jacarandá 692, Urb Residencial Valle Hermoso',1,'0'),(25,8,'Urb. Bancaria','Jiron Tambogrande 834, Urb. Bancaria','',NULL,-5.187015,-80.645312,'Jiron Tambogrande 834, Urb. Bancaria',1,'0'),(26,8,'Urb Santa Ana','Jiron Tambogrande 568, Urb Santa Ana','',NULL,-5.187609,-80.642577,'Jiron Tambogrande 568, Urb Santa Ana',1,'0'),(27,13,'Urb Mariscal Ramon Castilla','Avenida Velasco Astete 180, Urb Mariscal Ramon Castilla','',NULL,-12.092880,-76.986165,'Avenida Velasco Astete 180, Urb Mariscal Ramon Castilla',1,'1'),(28,10,'Nueva Providencia',' , Nueva Providencia','',NULL,-5.164797,-80.633904,' , Nueva Providencia',1,'0'),(29,8,'Gamarra','Jirón Huánuco 1741, Gamarra','',NULL,-12.065950,-77.014654,'Jirón Huánuco 1741, Gamarra',1,'1'),(30,10,'Ot Centro Historico de Piura','Ica 732, Ot Centro Historico de Piura','',NULL,-5.194936,-80.629169,'Ica 732, Ot Centro Historico de Piura',1,'0'),(31,10,'Las Violetas','Avenida Tupac Amaru 11025, Las Violetas','',NULL,-11.997222,-77.054917,'Avenida Tupac Amaru 11025, Las Violetas',1,'0'),(32,10,'Los Geranios',' , Los Geranios','',NULL,-5.170992,-80.629333,' , Los Geranios',1,'1'),(33,14,'Casuarinas Sur','Calle Las Dalias 321, Casuarinas Sur','',NULL,-12.127702,-76.970415,'Calle Las Dalias 321, Casuarinas Sur',1,'1');
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_version` varchar(45) DEFAULT NULL,
  `application_platform` varchar(45) DEFAULT 'android',
  `application_canskip` tinyint(3) DEFAULT '1',
  `application_url` varchar(250) DEFAULT NULL,
  `application_message` varchar(500) DEFAULT NULL,
  `application_name` varchar(45) DEFAULT NULL,
  `application_code` varchar(10) DEFAULT NULL,
  `application_state` char(1) DEFAULT '1',
  PRIMARY KEY (`application_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application`
--

LOCK TABLES `application` WRITE;
/*!40000 ALTER TABLE `application` DISABLE KEYS */;
INSERT INTO `application` VALUES (1,'1','android/ios',1,NULL,NULL,'GoCancha',NULL,'1');
/*!40000 ALTER TABLE `application` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bloqueo`
--

DROP TABLE IF EXISTS `bloqueo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bloqueo` (
  `bloqueo_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancha_id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) DEFAULT NULL,
  `bloqueo_fecha` datetime DEFAULT NULL,
  `bloqueo_fechareserva` date DEFAULT NULL,
  `bloqueo_horainicio` time DEFAULT NULL,
  `bloqueo_horafin` time DEFAULT NULL,
  PRIMARY KEY (`bloqueo_id`),
  KEY `fk_bloqueo_cliente1_idx` (`cliente_id`),
  KEY `fk_bloqueo_cancha1_idx` (`cancha_id`),
  KEY `fk_bloqueo_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_bloqueo_cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`cancha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bloqueo_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_bloqueo_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bloqueo`
--

LOCK TABLES `bloqueo` WRITE;
/*!40000 ALTER TABLE `bloqueo` DISABLE KEYS */;
INSERT INTO `bloqueo` VALUES (141,32,NULL,15,'2022-02-04 18:09:40','2022-02-04','20:00:00','20:59:00'),(142,32,NULL,15,'2022-02-04 18:13:41','2022-02-04','22:00:00','22:59:00'),(155,35,13,NULL,'2022-02-12 21:58:22','2022-02-13','10:00:00','11:00:00'),(162,26,NULL,13,'2022-02-13 11:31:15','2022-02-13','17:00:00','17:59:00'),(163,12,NULL,11,'2022-04-25 20:19:08','2022-04-26','10:00:00','11:00:00');
/*!40000 ALTER TABLE `bloqueo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cancha`
--

DROP TABLE IF EXISTS `cancha`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cancha` (
  `cancha_id` int(11) NOT NULL AUTO_INCREMENT,
  `deporte_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `cancha_nombre` varchar(90) DEFAULT NULL,
  `cancha_precio` decimal(10,2) DEFAULT NULL,
  `cancha_tipo` varchar(45) DEFAULT NULL,
  `cancha_size` varchar(45) DEFAULT NULL,
  `cancha_estado` char(1) DEFAULT NULL,
  `cancha_urllogo` varchar(150) DEFAULT NULL,
  `cancha_usapreciohora` char(1) DEFAULT '0',
  `cancha_inicio` time DEFAULT NULL,
  `cancha_fin` time DEFAULT NULL,
  `cancha_preciohora` decimal(10,2) DEFAULT NULL,
  `cancha_padreid` int(11) DEFAULT NULL,
  PRIMARY KEY (`cancha_id`),
  KEY `fk_cancha_deporte1_idx` (`deporte_id`),
  KEY `fk_cancha_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_cancha_deporte1` FOREIGN KEY (`deporte_id`) REFERENCES `deporte` (`deporte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_cancha_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cancha`
--

LOCK TABLES `cancha` WRITE;
/*!40000 ALTER TABLE `cancha` DISABLE KEYS */;
INSERT INTO `cancha` VALUES (2,1,4,'CANCHA 1',120.00,'6','5','1','logoappcanchita/20211118/cloud-3b07fa2aab2d4860acab3c11d64e5d1c-normal','1','09:00:00','18:00:00',80.00,NULL),(3,1,5,'XENTENARIO',100.00,'6','5','1','logoappcanchita/20211118/cloud-367cfa229ef24c26b8729d526d8cf69e-normal','0',NULL,NULL,NULL,NULL),(4,1,6,'EL BERNABEU',110.00,'6','6','1','logoappcanchita/20211118/cloud-291e1c16a11a44e8b93b3ed9976c2464-normal','0',NULL,NULL,NULL,NULL),(5,1,7,'LA BOMBONERA',110.00,'6','5','1','logoappcanchita/20211118/cloud-e983c420408c44a98cba0364f02182b6-normal','0',NULL,NULL,NULL,NULL),(6,1,8,'XENTENARIO',110.00,'6','5','1','logoappcanchita/20211122/cloud-f9e7d7c5e29f429e807dbeb27e8db199-normal','0',NULL,NULL,NULL,NULL),(7,1,9,'LA 10',100.00,'6','5','1','logoappcanchita/20211123/cloud-1054ba5051f74e38bbcb24224e904281-normal','0',NULL,NULL,NULL,NULL),(8,1,10,'SIMBILA',100.00,'1','6','1','logoappcanchita/20211123/cloud-01da264a582049a08c3f2fd2dbded5cf-normal','0',NULL,NULL,NULL,NULL),(9,1,11,'UTAJA',133.00,'6','4','1','gocancha/logoProvider/cloud-e2bd5424a9571e033a98442b6843eafc-normal','1',NULL,NULL,133.00,14),(10,1,4,'CANCHA 2',150.00,'6','6','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','0',NULL,NULL,NULL,NULL),(11,1,12,'TIMAO II',110.00,'6','4','1','logoappcanchita/20211223/cloud-568bdc6508c44cbd9d717589623fc548-normal','0',NULL,NULL,NULL,NULL),(12,1,11,'ldsffl',98.00,'5','6','1','gocancha/logoProvider/cloud-a40b193a4400c456666c7712a06fe8bf-normal','1','00:00:00','00:00:00',98.00,NULL),(13,1,11,'C. HIJA',21.00,'4','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','1','00:00:00','00:00:00',21.00,14),(14,1,11,'CANCHA PADRE',44.00,'4','9','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','1',NULL,NULL,NULL,NULL),(15,1,11,'jdfF SDF FSDF',45.00,'3','1','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','0',NULL,NULL,NULL,NULL),(16,1,11,'fl',99.00,'4','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','1','10:00:00','19:59:00',99.00,NULL),(17,1,11,'dsfdsf',333.00,'3','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','1',NULL,NULL,333.00,NULL),(18,1,11,'pedro test',45.00,'1','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-5c35ff18db961ed9bafff5224f978875-normal','1',NULL,NULL,45.00,NULL),(19,1,11,'dfdsfsdf',34.00,'6','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-fa2cec574b860463b57db38dbcc2cf07-normal','1','04:00:00','20:59:00',34.00,NULL),(20,1,11,'dfdf',4.00,'4','6','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-aad5bbc053dd0b9b5869f57a2af2e4dd-normal','0',NULL,NULL,NULL,NULL),(21,1,11,'pedro',93.00,'6','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-5aa5034b54d992548134f07ed424849b-normal','1',NULL,NULL,93.00,NULL),(22,1,11,'peter',49.00,'2','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-49dd621d1cd122e3950c8d4908e6beb6-normal','1',NULL,NULL,49.00,NULL),(23,1,11,'pepep 4',34.00,'3','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-d14b9ef0f862c36a2f7f73f3dc71acbc-normal','1','05:00:00','20:59:00',34.00,NULL),(24,5,4,'CANCHA 3',120.00,'3','1','1',NULL,'0',NULL,NULL,NULL,NULL),(25,1,11,'cancha fial',95.00,'2','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-4e784e48bdb8baa07721756423130e07-normal','1','18:06:00','14:00:00',95.00,NULL),(26,1,13,'ULIMA',450.00,'6','9','1','logoappcanchita/20220212/cloud-8aaabab58b4a4b51a281e38aff8ecb45-normal','1','17:00:00','20:00:00',450.00,NULL),(27,2,13,'VOLLEYLOVER',123.00,'3','5','1','logoappcanchita/20220214/cloud-5d62d356253a4de1a95d638715186369-normal','0',NULL,NULL,NULL,NULL),(28,1,11,'pedro',80.00,'6','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-29ea08832d2ca78c83710e44356fe86f-normal','0','21:05:00','22:59:00',80.00,NULL),(29,1,14,'CHEEK EAT TEENS',100.00,'6','9','1','logoappcanchita/20220214/cloud-96157358eb9849ba896a4bee5a53de89-normal','1','06:00:00','17:00:00',100.00,NULL),(30,4,13,'CANCHA 1',70.00,'3','1','1','logoappcanchita/20220214/cloud-471578f0a332454495ac64ff97c7d9c3-normal','0',NULL,NULL,NULL,NULL),(31,4,13,'CANCHA 2',70.00,'3','1','1','logoappcanchita/20220212/cloud-b5d6614bc17f4678b3d3e69e7afe2f9a-normal','0',NULL,NULL,NULL,NULL),(32,4,15,'LUCHO HORNA',80.00,'5','1','1','logoappcanchita/20220214/cloud-053945d1b1954284ab6e94fa066a846e-normal','1','08:00:00','09:00:00',80.00,NULL),(33,1,13,'Campo 2',70.00,'6','5','1','logoappcanchita/20220214/cloud-6ba250d07fbe49ae9427f870d100c335-normal','1','06:00:00','07:00:00',120.00,26),(34,1,14,'THE CHEEK',70.00,'6','5','1','logoappcanchita/20220214/cloud-2151ca59bb664f38bfa74d97675c42a3-normal','0',NULL,NULL,NULL,29),(35,1,14,'CHIQUITIN',70.00,'6','5','1','logoappcanchita/20220214/cloud-93e20fd315324a8480a66282a713304a-normal','0',NULL,NULL,NULL,29),(36,1,8,'cancha 2',100.00,'6','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-481dd82e26dcfe047eb592f63b866e36-normal','0',NULL,NULL,NULL,NULL),(37,1,16,'CANCHA 1',450.00,'1','9','1','logoappcanchita/20220212/cloud-1fbfb65cdd7a4b1984cec8ee6ea8f319-normal','0',NULL,NULL,NULL,NULL),(38,1,16,'CANCHA 2',170.00,'1','5','1','logoappcanchita/20220212/cloud-922b17cb9d634e208a04df1f8715cabf-normal','0',NULL,NULL,NULL,37),(39,1,16,'CANCHA 3',170.00,'1','5','1','logoappcanchita/20220212/cloud-ec9803fa7a4b4a8eb95a6e8f29da7caa-normal','0',NULL,NULL,NULL,37),(40,1,16,'CANCHA 4',170.00,'1','5','1','logoappcanchita/20220212/cloud-4f21efc75a384cf5b062763384757c8a-normal','0',NULL,NULL,NULL,37),(41,1,16,'CANCHA 5',170.00,'1','5','1','logoappcanchita/20220212/cloud-a1241a8af3e24fc8a0dcd018ebd8883a-normal','0',NULL,NULL,NULL,37),(42,4,17,'CANCHA 1',80.00,'5','4','1','logoappcanchita/20220214/cloud-9c9c196d4ba946f69f4afefcd9577b08-normal','0',NULL,NULL,NULL,NULL),(43,4,17,'CANCHA 2',80.00,'8','4','1','logoappcanchita/20220214/cloud-5d4d29e1e15046bab6dd4bf5717362e2-normal','0',NULL,NULL,NULL,NULL),(44,4,17,'CANCHA 3',60.00,'7','4','1','logoappcanchita/20220214/cloud-2df794def00b4b7fa5965bc0aa35d7cd-normal','0',NULL,NULL,NULL,NULL),(45,1,11,'cancha final',20.00,'1','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-25f4c1271ad9a3bb0166d58a8fc7aba0-normal','1',NULL,NULL,20.00,NULL),(46,1,11,'dfvdfg',34535.00,'1','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-d780717a16eb183b0311b032a86ea9fa-normal','1',NULL,NULL,34535.00,NULL),(47,1,11,'test final',20.00,'2','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-98d69c175aa10dbaa04b81df883d1840-normal','1',NULL,NULL,20.00,NULL),(48,1,11,'producto new',10.00,'1','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-4e706bae2d61fdfe3246feb6534291e9-normal','1',NULL,NULL,10.00,NULL),(49,1,11,'test ultimo ',99.00,'1','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-4e706bae2d61fdfe3246feb6534291e9-normal','1',NULL,NULL,99.00,NULL),(50,1,11,'test 101',101.00,'4','4','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-76cb96678997e43169880145309e84bd-normal','1',NULL,NULL,101.00,NULL),(51,1,11,'test 102',102.00,'1','5','1','products/eca0e6f514b20b3ee5ec90397634f443/cloud-530d6e677dd7f35688144bfd5663ecf3-normal','1',NULL,NULL,102.00,NULL);
/*!40000 ALTER TABLE `cancha` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canchaimagen`
--

DROP TABLE IF EXISTS `canchaimagen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canchaimagen` (
  `canchaimagen_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancha_id` int(11) NOT NULL,
  `canchaimagen_url` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`canchaimagen_id`),
  KEY `fk_canchaimagen_cancha1_idx` (`cancha_id`),
  CONSTRAINT `fk_canchaimagen_cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`cancha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canchaimagen`
--

LOCK TABLES `canchaimagen` WRITE;
/*!40000 ALTER TABLE `canchaimagen` DISABLE KEYS */;
INSERT INTO `canchaimagen` VALUES (1,2,'appcanchita/20211117/cloud-4dc6da0fe6d84ddabbc7492ecd24e31f-normal'),(2,3,'appcanchita/20211118/cloud-105dfbc1a4344c3287a518a2dff7540a-normal'),(3,4,'appcanchita/20211118/cloud-aefc5cf544d5410ea22074007ca79586-normal'),(4,5,'appcanchita/20211118/cloud-df8fedc3b1544045845ca55401f27726-normal'),(5,7,'appcanchita/20211123/cloud-5076f0f49590451c86991892b56df962-normal'),(6,8,'appcanchita/20211123/cloud-94d0ae0d1ab744bc8ca8f099984d5e4d-normal'),(7,9,'appcanchita/20211123/cloud-083468415ee24844a912f7dbb7c3dae6-normal'),(8,2,'appcanchita/20211222/cloud-c3a2c1d6bd314be190135aac39790e66-normal'),(9,2,'appcanchita/20211222/cloud-bd1c12847ebb4c329d62ea8865da2794-normal'),(10,2,'appcanchita/20211222/cloud-4dc4df3eb4594c7cae802e85f1ed6598-normal'),(11,2,'appcanchita/20211222/cloud-519b32a94aa4421e9f67058625247a28-normal'),(12,2,'appcanchita/20211222/cloud-38818f7b78064c099c89eb5e4ed23f78-normal'),(13,22,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-5a4107f24e0e6818ff4ff64a75a2f264-normal'),(14,22,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-3de82742ccdaff249d2108c221068960-normal'),(15,22,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-242eb9d43ea64735ef1ebb4bfb7d77fa-normal'),(16,23,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-a15e57eb227a8565104218927d88f863-normal'),(17,23,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-7d8a0388c3ac1bb7ac0fc33144e83fd6-normal'),(18,23,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-f58695ea7856171be1f969e95eae9549-normal'),(19,25,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-edcfc17540711d5c21075507eba3f10f-normal'),(20,26,'appcanchita/20211230/cloud-6c155299046c427fbf2257902259709d-normal'),(21,26,'appcanchita/20211230/cloud-63320deb9460442d9a482767117149e0-normal'),(22,26,'appcanchita/20211230/cloud-9cc65df2a6844ca68551d82d3f2e32e6-normal'),(23,28,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-93ce611e94ad7525360bf973ad737c94-normal'),(24,28,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-ff15958e6115d228dd4111d50fc5ca88-normal'),(25,27,'appcanchita/20220212/cloud-2ae7513257ca4f65b65e20c50e0c0a73-normal'),(26,27,'appcanchita/20211230/cloud-3752ad3cdb6d4ce487e4c113248031cb-normal'),(27,27,'appcanchita/20211230/cloud-c7b6a4bb726140ceafc625237ffd4b03-normal'),(28,33,'appcanchita/20220214/cloud-cb30073f8f914a1e9a9e53cae0f036ad-normal'),(29,36,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-7a569e231493ea19b5e9e887d61f1e43-normal'),(30,12,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-ed363b2f53f2fe7b0b581c36a93ccac4-normal'),(31,29,'appcanchita/20220212/cloud-3fa59d534b894215ad5693bad69eaf05-normal'),(32,45,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-5ac7b426dd38618d08d502184120cb00-normal'),(33,46,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-6d0470532ecd1f8cc49146ebd249e3d3-normal'),(34,47,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-fd2b6deafefd3b881bf9b72d35c5d8dd-normal'),(35,48,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-3cdf6a0b123ab4d141f7ec7fc863371c-normal'),(36,49,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-3cdf6a0b123ab4d141f7ec7fc863371c-normal'),(37,50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-ef93a3446cd11e00c909b89f020544da-normal'),(38,51,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-9e49315ffb93fe492537b5e8e536b9ed-normal'),(39,13,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-248bfe767c701df9c786c6028403c805-normal'),(40,42,'appcanchita/20220212/cloud-6ec318ff9d064381b89dc5c53cf2e5ea-normal'),(41,43,'appcanchita/20220212/cloud-e49a43c021b945bea2fe9850db289ee3-normal'),(42,44,'appcanchita/20220212/cloud-ecef96956b0542f0ba907d7748c8d58a-normal'),(43,34,'appcanchita/20220212/cloud-c710a85b523c41e9a26012e73a47cf60-normal'),(44,35,'appcanchita/20220212/cloud-f10ecf33be0f45bc8d84c8d035e9c175-normal'),(45,32,'appcanchita/20220214/cloud-dda2995e78f0490ea7d881b964c4924f-normal'),(46,30,'appcanchita/20220212/cloud-d4f7239712644f14bbb0aeefd803ac32-normal'),(47,9,'gocancha/imageSportplatform/cloud-17577f9d1ae184e47f291ea8cc331c5d-normal'),(48,9,'gocancha/imageSportplatform/cloud-fee26b1830fa34e586617562c2390685-normal');
/*!40000 ALTER TABLE `canchaimagen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `canchaprecio`
--

DROP TABLE IF EXISTS `canchaprecio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `canchaprecio` (
  `canchaprecio_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancha_id` int(11) NOT NULL,
  `canchaprecio_valor` decimal(10,2) DEFAULT NULL,
  `canchaprecio_dia` tinyint(3) DEFAULT NULL,
  `canchaprecio_horainicio` time DEFAULT NULL,
  `canchaprecio_horafin` time DEFAULT NULL,
  `canchaprecio_estado` char(1) DEFAULT NULL,
  `canchaprecio_valoroferta` decimal(10,2) DEFAULT NULL,
  `canchaprecio_horainiciooferta` time DEFAULT NULL,
  `canchaprecio_horafinoferta` time DEFAULT NULL,
  PRIMARY KEY (`canchaprecio_id`),
  KEY `fk_canchaprecio_cancha1_idx` (`cancha_id`),
  CONSTRAINT `fk_canchaprecio_cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`cancha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=148 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `canchaprecio`
--

LOCK TABLES `canchaprecio` WRITE;
/*!40000 ALTER TABLE `canchaprecio` DISABLE KEYS */;
INSERT INTO `canchaprecio` VALUES (1,14,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(2,14,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(3,14,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(4,14,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(5,14,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(6,14,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(7,14,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(8,13,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(9,13,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(10,13,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(11,13,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(12,13,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(13,13,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(14,13,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(15,6,80.00,1,'00:30:00','23:00:00','1',NULL,NULL,NULL),(16,6,90.00,2,'00:00:00','23:59:00','1',NULL,NULL,NULL),(17,6,70.00,3,'00:00:00','23:59:00','1',NULL,NULL,NULL),(18,6,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(19,6,120.00,5,'00:00:00','23:59:00','1',NULL,NULL,NULL),(20,6,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(21,6,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(22,26,320.00,1,'09:00:00','17:00:00','1',210.00,'09:00:00','17:00:00'),(23,26,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(24,26,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(25,26,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(26,26,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(27,26,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(28,26,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(29,37,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(30,37,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(31,37,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(32,37,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(33,37,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(34,37,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(35,37,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(36,38,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(37,38,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(38,38,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(39,38,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(40,38,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(41,38,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(42,38,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(43,39,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(44,39,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(45,39,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(46,39,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(47,39,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(48,39,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(49,39,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(50,40,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(51,40,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(52,40,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(53,40,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(54,40,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(55,40,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(56,40,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(57,41,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(58,41,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(59,41,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(60,41,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(61,41,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(62,41,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(63,41,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(64,42,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(65,42,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(66,42,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(67,42,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(68,42,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(69,42,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(70,42,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(71,43,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(72,43,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(73,43,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(74,43,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(75,43,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(76,43,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(77,43,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(78,44,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(79,44,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(80,44,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(81,44,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(82,44,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(83,44,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(84,44,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(85,29,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(86,29,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(87,29,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(88,29,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(89,29,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(90,29,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(91,29,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(92,34,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(93,34,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(94,34,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(95,34,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(96,34,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(97,34,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(98,34,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(99,35,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(100,35,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(101,35,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(102,35,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(103,35,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(104,35,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(105,35,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(106,27,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(107,27,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(108,27,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(109,27,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(110,27,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(111,27,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(112,27,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(113,30,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(114,30,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(115,30,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(116,30,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(117,30,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(118,30,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(119,30,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(120,31,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(121,31,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(122,31,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(123,31,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(124,31,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(125,31,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(126,31,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(127,33,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(128,33,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(129,33,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(130,33,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(131,33,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(132,33,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(133,33,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(134,32,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(135,32,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(136,32,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(137,32,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(138,32,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(139,32,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(140,32,NULL,7,NULL,NULL,'0',NULL,NULL,NULL),(141,9,NULL,1,NULL,NULL,'0',NULL,NULL,NULL),(142,9,NULL,2,NULL,NULL,'0',NULL,NULL,NULL),(143,9,NULL,3,NULL,NULL,'0',NULL,NULL,NULL),(144,9,NULL,4,NULL,NULL,'0',NULL,NULL,NULL),(145,9,NULL,5,NULL,NULL,'0',NULL,NULL,NULL),(146,9,NULL,6,NULL,NULL,'0',NULL,NULL,NULL),(147,9,NULL,7,NULL,NULL,'0',NULL,NULL,NULL);
/*!40000 ALTER TABLE `canchaprecio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `caracteristica`
--

DROP TABLE IF EXISTS `caracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `caracteristica` (
  `caracteristica_id` int(11) NOT NULL AUTO_INCREMENT,
  `caracteristica_nombre` varchar(50) DEFAULT NULL,
  `caracteristica_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`caracteristica_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caracteristica`
--

LOCK TABLES `caracteristica` WRITE;
/*!40000 ALTER TABLE `caracteristica` DISABLE KEYS */;
INSERT INTO `caracteristica` VALUES (1,'Techado','1'),(2,'Enmallado','1'),(3,'Domo','0'),(4,'Estacionamiento','1'),(5,'Tienda','1'),(6,'Acepta Tarjeta','1');
/*!40000 ALTER TABLE `caracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_nombres` varchar(60) DEFAULT NULL,
  `cliente_apellidos` varchar(60) DEFAULT NULL,
  `cliente_telefono` varchar(15) DEFAULT NULL,
  `cliente_fecharegistro` datetime DEFAULT NULL,
  `cliente_activado` char(1) DEFAULT NULL,
  `cliente_codigoactivo` varchar(10) DEFAULT NULL,
  `cliente_fbid` varchar(100) DEFAULT NULL,
  `cliente_gid` varchar(100) DEFAULT NULL,
  `cliente_aid` varchar(100) DEFAULT NULL,
  `cliente_estado` char(1) DEFAULT '1',
  `cliente_urlfoto` varchar(150) DEFAULT NULL,
  `cliente_correo` varchar(25) DEFAULT NULL,
  `cliente_tipocomprobante` char(1) DEFAULT NULL,
  `cliente_numerodoc` varchar(20) DEFAULT NULL,
  `cliente_razonsocial` varchar(45) DEFAULT NULL,
  `cliente_direccion` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` VALUES (1,'Geyson','Farfan Fuego','959560928',NULL,'1','4476','29036529830056608787',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,NULL,NULL,NULL,'1',NULL,NULL,'29036529830056608787',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,'29036529830056608787','1',NULL,NULL,NULL,NULL,NULL,NULL),(4,'GhianCo','Zapata lopez','999999999',NULL,'1','4476',NULL,'1149609127266513188452',NULL,'1',NULL,'ghiancorx@gmail.com','1','47359833','',' , Piura'),(5,'Ghianco','Zapata',NULL,NULL,'1',NULL,'48488633784795042',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Magna Gabriela','Bobadilla La Torre',NULL,NULL,'1',NULL,NULL,'107878410184386194941',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(7,'Joan','Payano Camacho','996038536',NULL,'1',NULL,'10223371945201206',NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(8,'Alexander','Chavesta','993838938',NULL,'1',NULL,NULL,'116401736808117364088',NULL,'1',NULL,'alex.chavesta@gmail.com','1','70456390','','Calle 31 169, Urb Mariscal Ramon Castilla'),(9,'Augusto','Apellidos','996038915',NULL,'1',NULL,NULL,'1.1640173680812E+20',NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL),(10,'GhianCo','Zapata lopez','996038916','2022-02-03 09:39:13','1',NULL,NULL,'114960912726651318845',NULL,'1',NULL,'ghiancorx@gmail.com','1','47359833','556','-'),(11,'Ghianco Zapata','',NULL,'2022-02-03 10:07:02','1',NULL,'4848863378479504',NULL,NULL,'1',NULL,'ghiancoremix2011@hotmail.',NULL,NULL,NULL,NULL),(12,'Philip','Baker',NULL,'2022-02-03 16:44:33','1',NULL,NULL,'101225146324770941734',NULL,'1',NULL,'philipbaker.19266@gmail.c',NULL,NULL,NULL,NULL),(13,'Lita','Icochea','988560222','2022-02-03 22:20:01','1',NULL,NULL,'114708296511774726862',NULL,'1',NULL,'litaicochea@gmail.com','1','06635298',NULL,NULL),(14,'Jesus','Quezada Rosales','972129720','2022-02-04 17:25:49','1',NULL,NULL,'100809329811493548334',NULL,'1',NULL,'jesus.quezada.r@gmail.com','1','70444788',NULL,NULL),(15,'Nohadys','Orozco',NULL,'2022-02-14 18:33:42','1',NULL,NULL,'106078784310494000065',NULL,'1',NULL,'nohaorozco@gmail.com',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clienteproveedor`
--

DROP TABLE IF EXISTS `clienteproveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clienteproveedor` (
  `clienteproveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  PRIMARY KEY (`clienteproveedor_id`),
  KEY `fk_clienteproveedor_proveedor1_idx` (`proveedor_id`),
  KEY `fk_clienteproveedor_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_clienteproveedor_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_clienteproveedor_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clienteproveedor`
--

LOCK TABLES `clienteproveedor` WRITE;
/*!40000 ALTER TABLE `clienteproveedor` DISABLE KEYS */;
/*!40000 ALTER TABLE `clienteproveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deporte`
--

DROP TABLE IF EXISTS `deporte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deporte` (
  `deporte_id` int(11) NOT NULL AUTO_INCREMENT,
  `deporte_nombre` varchar(45) NOT NULL,
  `deporte_urlimagen` varchar(150) DEFAULT NULL,
  `deporte_orden` int(11) DEFAULT NULL,
  `deporte_estado` char(1) DEFAULT '0',
  PRIMARY KEY (`deporte_id`,`deporte_nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deporte`
--

LOCK TABLES `deporte` WRITE;
/*!40000 ALTER TABLE `deporte` DISABLE KEYS */;
INSERT INTO `deporte` VALUES (1,'Fútbol','gocancha/imageSports/a94q3nei9p4lfeo245jx.png',1,'1'),(2,'Vóleibol','gocancha/imageSports/gdnvzfpqwdxgglpehszn.png',4,'1'),(3,'Básquetbol','gocancha/imageSports/b08oi5j3teuworstskc7.png',3,'1'),(4,'Tenis','gocancha/imageSports/g5fwdgihxta9ng3w59k0.png',2,'1'),(5,'Pádel','gocancha/imageSports/efpltpzqjyvttso4i9ea.png',5,'1');
/*!40000 ALTER TABLE `deporte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorito`
--

DROP TABLE IF EXISTS `favorito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorito` (
  `favorito_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `favorito_fecha` datetime DEFAULT NULL,
  PRIMARY KEY (`favorito_id`),
  KEY `fk_favorito_proveedor1_idx` (`proveedor_id`),
  KEY `fk_favorito_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_favorito_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_favorito_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorito`
--

LOCK TABLES `favorito` WRITE;
/*!40000 ALTER TABLE `favorito` DISABLE KEYS */;
INSERT INTO `favorito` VALUES (20,7,4,'2021-11-25 11:43:50'),(22,8,4,'2021-11-25 11:43:59'),(29,7,8,'2021-11-27 15:03:06'),(30,7,1,'2021-12-02 22:22:43'),(32,6,8,'2021-12-10 00:25:36'),(34,4,8,'2021-12-23 18:03:22'),(35,15,8,'2022-01-27 21:46:26'),(40,13,8,'2022-01-27 22:19:53'),(44,14,8,'2022-02-03 22:56:33'),(60,13,13,'2022-02-04 17:34:01'),(61,15,13,'2022-02-04 17:34:21'),(62,8,10,'2022-02-13 10:56:20');
/*!40000 ALTER TABLE `favorito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarioatencion`
--

DROP TABLE IF EXISTS `horarioatencion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarioatencion` (
  `horarioatencion_id` int(11) NOT NULL AUTO_INCREMENT,
  `horarioatenciondia_id` int(11) NOT NULL,
  `horarioatencion_inicio` time DEFAULT NULL,
  `horarioatencion_fin` time DEFAULT NULL,
  PRIMARY KEY (`horarioatencion_id`),
  KEY `fk_horarioatencion_horarioatenciondia1_idx` (`horarioatenciondia_id`),
  CONSTRAINT `fk_horarioatencion_horarioatenciondia1` FOREIGN KEY (`horarioatenciondia_id`) REFERENCES `horarioatenciondia` (`horarioatenciondia_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarioatencion`
--

LOCK TABLES `horarioatencion` WRITE;
/*!40000 ALTER TABLE `horarioatencion` DISABLE KEYS */;
INSERT INTO `horarioatencion` VALUES (3,3,'09:00:00','23:59:00'),(4,4,'09:00:00','23:59:00'),(5,5,'09:00:00','23:59:00'),(6,6,'09:00:00','23:59:00'),(7,7,'09:00:00','23:59:00'),(8,8,'09:00:00','23:59:00'),(9,9,'10:00:00','21:00:00'),(10,10,'00:00:00','19:00:00'),(11,11,'00:00:00','23:59:00'),(12,12,'00:00:00','20:00:00'),(13,13,'00:00:00','18:30:00'),(14,14,'00:00:00','20:00:00'),(15,15,'00:00:00','19:00:00'),(16,16,'00:00:00','20:00:00'),(17,17,'09:00:00','23:00:00'),(18,18,'09:00:00','23:00:00'),(19,19,'09:00:00','23:00:00'),(20,20,'09:00:00','23:00:00'),(21,21,'09:00:00','23:00:00'),(22,22,'09:00:00','23:00:00'),(23,23,'09:00:00','23:00:00'),(24,24,'10:00:00','22:00:00'),(25,25,'10:00:00','23:59:00'),(26,26,'10:00:00','23:00:00'),(27,27,'09:00:00','23:00:00'),(28,28,'09:30:00','23:00:00'),(29,29,'09:00:00','23:00:00'),(30,30,'10:00:00','23:59:00'),(31,31,'08:00:00','23:00:00'),(32,32,'08:00:00','23:00:00'),(33,33,'08:00:00','23:00:00'),(34,34,'08:00:00','23:00:00'),(35,35,'08:00:00','23:00:00'),(36,36,'08:00:00','23:59:00'),(37,37,'08:00:00','23:00:00'),(38,38,'08:00:00','23:00:00'),(39,39,'07:00:00','23:59:00'),(40,40,'07:00:00','23:59:00'),(41,41,'07:00:00','23:59:00'),(42,42,'07:00:00','23:59:00'),(43,43,'07:00:00','23:59:00'),(44,44,'07:00:00','23:59:00'),(45,45,'07:00:00','23:59:00'),(46,46,'07:00:00','23:59:00'),(47,47,'07:00:00','23:59:00'),(48,48,'07:00:00','23:59:00'),(49,49,'07:00:00','23:59:00'),(50,50,'07:00:00','23:59:00'),(51,51,'07:00:00','23:59:00'),(52,52,'09:00:00','22:00:00'),(53,53,'09:00:00','22:00:00'),(54,54,'09:00:00','22:00:00'),(55,55,'09:00:00','22:00:00'),(56,56,'09:00:00','22:00:00'),(57,57,'09:00:00','22:00:00'),(58,58,'09:00:00','22:00:00'),(59,59,'09:00:00','21:30:00'),(60,60,'09:00:00','21:30:00'),(61,61,'09:00:00','21:30:00'),(62,62,'09:00:00','21:30:00'),(63,63,'09:00:00','21:30:00'),(64,64,'09:00:00','21:30:00'),(65,65,NULL,NULL),(66,66,'12:00:00','23:00:00'),(67,67,'09:00:00','22:00:00'),(69,68,'09:00:00','22:00:00'),(70,69,'10:00:00','22:00:00'),(71,70,'10:00:00','22:00:00'),(72,71,'09:00:00','22:00:00'),(73,72,'09:00:00','22:00:00'),(74,73,'09:00:00','20:00:00'),(75,74,'09:00:00','20:00:00'),(76,75,'11:00:00','22:00:00'),(77,76,'08:30:00','22:00:00'),(78,77,'09:00:00','22:00:00'),(79,78,'10:00:00','22:00:00'),(80,79,'09:00:00','22:00:00'),(81,80,'08:00:00','22:00:00'),(82,81,'08:00:00','22:00:00'),(83,82,'08:00:00','22:00:00'),(84,83,'08:00:00','22:00:00'),(85,84,'08:00:00','22:00:00'),(86,85,'08:00:00','22:00:00'),(87,86,'08:00:00','22:00:00'),(88,87,'09:00:00','22:00:00'),(89,88,'09:00:00','22:00:00'),(90,89,'09:00:00','22:00:00'),(91,90,'09:00:00','22:00:00'),(92,91,'09:00:00','22:00:00'),(93,92,'09:00:00','22:00:00'),(94,93,'09:00:00','22:00:00'),(95,94,'09:00:00','22:00:00'),(96,95,'09:00:00','22:00:00'),(97,96,'09:00:00','22:00:00'),(98,97,'09:00:00','22:00:00'),(99,98,'09:00:00','22:00:00'),(100,99,'09:00:00','22:00:00'),(101,100,'09:00:00','22:00:00');
/*!40000 ALTER TABLE `horarioatencion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarioatenciondia`
--

DROP TABLE IF EXISTS `horarioatenciondia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarioatenciondia` (
  `horarioatenciondia_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancha_id` int(11) DEFAULT NULL,
  `proveedor_id` int(11) NOT NULL,
  `horarioatenciondia_dia` tinyint(3) NOT NULL,
  `horarioatenciondia_estado` tinyint(3) NOT NULL,
  PRIMARY KEY (`horarioatenciondia_id`),
  KEY `fk_horarioatenciondia_cancha1_idx` (`cancha_id`),
  KEY `fk_horarioatenciondia_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_horarioatenciondia_cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`cancha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_horarioatenciondia_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarioatenciondia`
--

LOCK TABLES `horarioatenciondia` WRITE;
/*!40000 ALTER TABLE `horarioatenciondia` DISABLE KEYS */;
INSERT INTO `horarioatenciondia` VALUES (3,NULL,4,1,1),(4,NULL,4,2,1),(5,NULL,4,3,1),(6,NULL,4,4,1),(7,NULL,4,5,1),(8,NULL,4,6,1),(9,NULL,4,7,1),(10,NULL,5,1,1),(11,NULL,5,2,1),(12,NULL,5,3,1),(13,NULL,5,4,1),(14,NULL,5,5,1),(15,NULL,5,6,1),(16,NULL,5,7,1),(17,NULL,6,1,1),(18,NULL,6,2,1),(19,NULL,6,3,1),(20,NULL,6,4,1),(21,NULL,6,5,1),(22,NULL,6,6,1),(23,NULL,6,7,1),(24,NULL,7,1,1),(25,NULL,7,2,1),(26,NULL,7,3,1),(27,NULL,7,4,1),(28,NULL,7,5,1),(29,NULL,7,6,1),(30,NULL,7,7,1),(31,NULL,8,1,1),(32,NULL,8,2,1),(33,NULL,8,3,1),(34,NULL,8,4,1),(35,NULL,8,5,1),(36,NULL,8,6,1),(37,NULL,8,7,1),(38,NULL,9,1,1),(39,NULL,9,2,1),(40,NULL,9,3,1),(41,NULL,9,4,1),(42,NULL,9,5,1),(43,NULL,9,6,1),(44,NULL,9,7,1),(45,NULL,10,1,1),(46,NULL,10,2,1),(47,NULL,10,3,1),(48,NULL,10,4,1),(49,NULL,10,5,1),(50,NULL,10,6,1),(51,NULL,10,7,1),(52,NULL,11,1,1),(53,NULL,11,2,1),(54,NULL,11,3,1),(55,NULL,11,4,1),(56,NULL,11,5,1),(57,NULL,11,6,1),(58,NULL,11,7,1),(59,NULL,12,1,1),(60,NULL,12,2,1),(61,NULL,12,3,1),(62,NULL,12,4,1),(63,NULL,12,5,1),(64,NULL,12,6,1),(65,NULL,12,7,0),(66,NULL,13,1,1),(67,NULL,13,2,1),(68,NULL,13,3,1),(69,NULL,13,4,1),(70,NULL,13,5,1),(71,NULL,13,6,1),(72,NULL,13,7,1),(73,NULL,14,1,1),(74,NULL,14,2,1),(75,NULL,14,3,1),(76,NULL,14,4,1),(77,NULL,14,5,1),(78,NULL,14,6,1),(79,NULL,14,7,1),(80,NULL,15,1,1),(81,NULL,15,2,1),(82,NULL,15,3,1),(83,NULL,15,4,1),(84,NULL,15,5,1),(85,NULL,15,6,1),(86,NULL,15,7,1),(87,NULL,16,1,1),(88,NULL,16,2,1),(89,NULL,16,3,1),(90,NULL,16,4,1),(91,NULL,16,5,1),(92,NULL,16,6,1),(93,NULL,16,7,1),(94,NULL,17,1,1),(95,NULL,17,2,1),(96,NULL,17,3,1),(97,NULL,17,4,1),(98,NULL,17,5,1),(99,NULL,17,6,1),(100,NULL,17,7,1);
/*!40000 ALTER TABLE `horarioatenciondia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login` (
  `login_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_nombres` varchar(60) DEFAULT NULL,
  `login_apellidos` varchar(60) DEFAULT NULL,
  `login_usuario` varchar(15) DEFAULT NULL,
  `login_clave` varchar(15) DEFAULT NULL,
  `login_estado` char(1) DEFAULT '1',
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'Joan','Payano','joan','1234','1'),(2,'Juan','Perez','juan','1234','1'),(3,'Victor','Rosales','vrosales','yisus','1'),(4,'Miguel','Icochea','Cheek','1234','1');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginproveedor`
--

DROP TABLE IF EXISTS `loginproveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loginproveedor` (
  `loginproveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  PRIMARY KEY (`loginproveedor_id`),
  KEY `fk_loginproveedor_login1_idx` (`login_id`),
  KEY `fk_loginproveedor_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_loginproveedor_login1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_loginproveedor_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginproveedor`
--

LOCK TABLES `loginproveedor` WRITE;
/*!40000 ALTER TABLE `loginproveedor` DISABLE KEYS */;
INSERT INTO `loginproveedor` VALUES (1,1,11),(3,1,5),(4,1,6),(5,1,7),(6,1,8),(7,1,9),(8,1,10),(10,2,6),(12,3,13),(13,3,14),(14,4,15),(15,4,16),(16,4,17);
/*!40000 ALTER TABLE `loginproveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagodata`
--

DROP TABLE IF EXISTS `pagodata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagodata` (
  `pagodata_id` int(11) NOT NULL AUTO_INCREMENT,
  `reserva_id` int(11) NOT NULL,
  `pagodata_json` longtext,
  `pagodata_integracion` char(1) DEFAULT NULL,
  PRIMARY KEY (`pagodata_id`),
  KEY `fk_pagodata_reserva1_idx` (`reserva_id`),
  CONSTRAINT `fk_pagodata_reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`reserva_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagodata`
--

LOCK TABLES `pagodata` WRITE;
/*!40000 ALTER TABLE `pagodata` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagodata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permiso` (
  `permiso_id` int(11) NOT NULL AUTO_INCREMENT,
  `permiso_descripcion` varchar(145) DEFAULT NULL,
  `permiso_categoria` varchar(145) DEFAULT NULL,
  `permiso_categoriapadre` varchar(145) DEFAULT NULL,
  PRIMARY KEY (`permiso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permisousuario`
--

DROP TABLE IF EXISTS `permisousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permisousuario` (
  `permisousuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `permiso_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `permisousuario_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`permisousuario_id`),
  KEY `fk_permisousuario_permiso1_idx` (`permiso_id`),
  KEY `fk_permisousuario_usuario1_idx` (`usuario_id`),
  CONSTRAINT `fk_permisousuario_permiso1` FOREIGN KEY (`permiso_id`) REFERENCES `permiso` (`permiso_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisousuario_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permisousuario`
--

LOCK TABLES `permisousuario` WRITE;
/*!40000 ALTER TABLE `permisousuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `permisousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform`
--

DROP TABLE IF EXISTS `platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platform` (
  `platform_id` int(11) NOT NULL AUTO_INCREMENT,
  `application_id` int(11) NOT NULL,
  `platform_version` varchar(45) DEFAULT NULL,
  `platform_name` varchar(45) DEFAULT NULL,
  `platform_canskip` tinyint(3) DEFAULT NULL,
  `platform_url` varchar(250) DEFAULT NULL,
  `platform_messageupdate` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`platform_id`),
  KEY `fk_platform_application1_idx` (`application_id`),
  CONSTRAINT `fk_platform_application1` FOREIGN KEY (`application_id`) REFERENCES `application` (`application_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform`
--

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` VALUES (1,1,NULL,'ANDROID',1,NULL,'Hay una actualización disponible'),(2,1,NULL,'IOS',1,NULL,'Hay una actualización disponible'),(3,1,NULL,'WEB',NULL,NULL,NULL);
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedor` (
  `proveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_nombre` varchar(80) DEFAULT NULL,
  `proveedor_razonsocial` varchar(100) DEFAULT NULL,
  `proveedor_ruc` varchar(15) DEFAULT NULL,
  `proveedor_fecharegistro` datetime DEFAULT NULL,
  `proveedor_latitud` decimal(10,6) DEFAULT NULL,
  `proveedor_longitud` decimal(10,6) DEFAULT NULL,
  `proveedor_direccion` varchar(220) DEFAULT NULL,
  `proveedor_referencia` varchar(100) DEFAULT NULL,
  `proveedor_urllogo` varchar(150) DEFAULT NULL,
  `proveedor_rating` decimal(6,2) DEFAULT NULL,
  `proveedor_tipocomision` char(1) DEFAULT NULL,
  `proveedor_comision` decimal(10,2) DEFAULT NULL,
  `proveedor_porcetanjereserva` decimal(10,2) DEFAULT NULL,
  `proveedor_contacto` varchar(45) DEFAULT NULL,
  `proveedor_telefono` varchar(20) DEFAULT NULL,
  `proveedor_encendido` char(1) DEFAULT NULL,
  `proveedor_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`proveedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (4,'EL GATO','EL GATO','123456789123333','2021-11-17 23:00:57',-5.179706,-80.628801,'Urb San Eduardo','Cerca al Gobierno Regional','logoappcanchita/20211118/cloud-55350dc12420403ebc43111ad25b62aa-normal',4.00,'2',7.00,50.00,'MANUEL','999888777','1','1'),(5,'LA 12','LA DOCE','10473598332','2021-11-18 15:49:49',-2.166640,-79.945114,'LOS CEIBOS','Piura','logoappcanchita/20211118/cloud-7a70483cd51348fa9ea4dec0c2b9c932-normal',5.00,'2',7.00,50.00,'PEDRO','934345345','1','1'),(6,'EL BERNABEU','EL BERNABEU','12345678910','2021-11-18 19:05:41',8.514768,-82.426522,'los algarrobos','pasando el idepund','logoappcanchita/20211118/cloud-72ebe09b01154e9b96ef57151bed687b-normal',3.00,'2',7.00,20.00,'JUAN','999777444','1','1'),(7,'LA BOMBONERA','LA BOMBONERA','101055667781','2021-11-18 19:33:38',-5.191603,-80.653555,'Urb Piura','Por el colegio Bacilio','logoappcanchita/20211118/cloud-789b3f9bffd340d89bc498a28efb4c70-normal',NULL,'2',7.00,20.00,'JOSE LUIS','987654321','1','1'),(8,'EL CENTENARIO','EL CENTENARIO','99988877744','2021-11-22 18:45:30',-5.180220,-80.629028,'el chipe','Cerca al Gobierno Regional','logoappcanchita/20211122/cloud-34ea61d6ba8540caa8b3b67aaee72aec-normal',NULL,'2',7.00,30.00,'CESAR','999444555','1','1'),(9,'LA 10','LA DIEZ','12345678911','2021-11-23 09:46:03',-5.191603,-80.653555,'Urb Piura','Dentro del colegio Lopez Albujar','logoappcanchita/20211123/cloud-f11a5396e2344c41aa8d52ffab68b0f4-normal',NULL,'2',7.00,25.00,'LUIS','987654321','1','1'),(10,'SIMBILA','SIMBILA','12345658912','2021-11-23 09:55:36',-5.247867,-80.652114,'SIMBILA','Detrás del grifo San José','logoappcanchita/20211123/cloud-f11249575df846fb94cfacc6ab0b02d0-normal',NULL,'2',7.00,20.00,'EDUARDO','987321456','1','1'),(11,'UTAJA','UTAJA','20403965932','2021-11-23 10:02:51',-5.166661,-80.615929,'Prolongación, Av. Guillermo Irazola s/n, 20000','Dentro del restaurante Utaja','logoappcanchita/20211123/cloud-cf015437f4904dc593d5ec0d8b8930e5-normal',3.00,'2',7.00,20.00,'ALBERTO','943218765','1','1'),(12,'NUEVO','NUEVO PR','12345678917','2021-12-23 21:56:40',-5.268845,-80.674305,'CATACAOS',NULL,'logoappcanchita/20211223/cloud-5f8d7aaeb84540a4b59462b95b1ff1cb-normal',NULL,'2',7.00,40.00,'CARLOS','987234165','1','1'),(13,'POLIDEPORTIVO','SIN RAZON S.A.C','123990449091231','2021-12-29 17:37:45',-12.127733,-76.970366,'Jiron las Dalias 321, Santiago de Surco','Zegel','logoappcanchita/20220212/cloud-5ca7f3686a014cd0b7fa9e01ef699e7c-normal',NULL,'2',7.00,30.00,'ALBERTO PEREZ','993939372','1','1'),(14,'CHEEK´S HOUSE','CHEEK','21323123','2021-12-29 17:44:45',-12.092486,-76.985695,'av. velasco astete 180','penta','logoappcanchita/20220212/cloud-ecf1a6019fa74cb2a3fa68abfa433352-normal',NULL,'2',7.00,70.00,'MARTIN PALOMARES','2313123','1','1'),(15,'ROLANDO GARRIDO','TENNIS SAC','2034204545','2021-12-30 14:58:05',-12.124292,-76.975160,'AV DE LOS INGENIEROS 199','PLAZA VEA DE VALLE HERMOSO','logoappcanchita/20220212/cloud-e7f62c347dc74a88887127b8032dd108-normal',NULL,'2',7.00,50.00,'CARLOS','987654321','1','1'),(16,'CAMP NOU','BARCELO FC S.A.C','972129720','2022-01-19 18:30:00',-12.079472,-77.035017,'AVENIDA AREQUIPA 1490','CUADRA 14 DE AV. AREQUIPA','logoappcanchita/20220212/cloud-03fbf9207bd24559a8f907f2d62733f5-normal',NULL,'2',7.00,10.00,'PIERO','9097889667','1','1'),(17,'WIMBLEDON','NO ME NEE PAKIN SAC','123123155123123','2022-01-19 18:44:30',-12.152712,-77.022881,'AVENIDA PEDRO DE OSMA 340','CERCA AL COLEGIO PEDRO RUIZ GALLO','logoappcanchita/20220212/cloud-dab778a8ca2840a7bb6dd79a4010d399-normal',NULL,'2',7.00,80.00,'MOME','2882938339','1','1');
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedorcaracteristica`
--

DROP TABLE IF EXISTS `proveedorcaracteristica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedorcaracteristica` (
  `proveedorcaracteristica_id` int(11) NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(11) NOT NULL,
  `caracteristica_id` int(11) NOT NULL,
  PRIMARY KEY (`proveedorcaracteristica_id`),
  KEY `fk_proveedorcaracteristica_caracteristica1_idx` (`caracteristica_id`),
  KEY `fk_proveedorcaracteristica_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_proveedorcaracteristica_caracteristica1` FOREIGN KEY (`caracteristica_id`) REFERENCES `caracteristica` (`caracteristica_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_proveedorcaracteristica_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedorcaracteristica`
--

LOCK TABLES `proveedorcaracteristica` WRITE;
/*!40000 ALTER TABLE `proveedorcaracteristica` DISABLE KEYS */;
INSERT INTO `proveedorcaracteristica` VALUES (1,8,2),(2,8,1),(3,9,2),(4,9,1),(5,10,2),(6,11,2),(8,4,2),(9,6,1),(10,6,2),(11,6,3),(12,12,2),(13,12,6),(14,4,6),(15,4,5),(16,13,6),(17,13,4),(18,13,5),(19,14,5),(20,14,6),(21,14,4),(22,15,4),(23,15,5),(24,15,6),(25,16,4),(26,16,6),(27,16,5),(28,17,1),(29,17,4);
/*!40000 ALTER TABLE `proveedorcaracteristica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `reserva_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `cancha_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `reserva_fecha` datetime DEFAULT NULL,
  `reserva_total` decimal(10,2) DEFAULT NULL,
  `reserva_precio` decimal(10,2) DEFAULT '0.00',
  `reserva_fechaprogramacion` date DEFAULT NULL,
  `reserva_horainicio` time DEFAULT NULL,
  `reserva_horafin` time DEFAULT NULL,
  `reserva_estado` char(1) DEFAULT NULL,
  `reserva_tipopago` char(1) DEFAULT NULL,
  `reserva_pagocon` decimal(10,2) DEFAULT NULL,
  `reserva_urlvoucher` varchar(120) DEFAULT NULL,
  `reserva_deviceid` varchar(120) DEFAULT NULL,
  `reserva_comision` decimal(14,6) DEFAULT NULL,
  `reserva_firstorder` char(1) DEFAULT NULL,
  `reserva_motivorechazo` varchar(100) DEFAULT NULL,
  `reserva_rating` decimal(6,2) DEFAULT '0.00',
  `reserva_tipo` char(1) DEFAULT '1' COMMENT '1. APP\n2. MANUAL',
  `reserva_cliente` varchar(85) DEFAULT NULL,
  `reserva_telefono` varchar(12) DEFAULT NULL,
  `reserva_canal` char(1) DEFAULT '1',
  PRIMARY KEY (`reserva_id`),
  KEY `fk_reserva_cliente1_idx` (`cliente_id`),
  KEY `fk_reserva_cancha1_idx` (`cancha_id`),
  KEY `fk_reserva_platform1_idx` (`platform_id`),
  KEY `fk_reserva_address1_idx` (`address_id`),
  KEY `fk_reserva_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_reserva_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_cancha1` FOREIGN KEY (`cancha_id`) REFERENCES `cancha` (`cancha_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_platform1` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`platform_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
INSERT INTO `reserva` VALUES (1,8,33,13,9,1,'2022-01-20 19:29:54',8.00,1.00,'2022-01-20','20:00:00','21:00:00','3','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-fadace0246577997342a75bb16e958e6-normal',NULL,7.000000,'1','Cancelado por el proveedor',0.00,'1',NULL,NULL,'1'),(2,4,10,4,11,2,'2022-01-20 20:47:41',157.00,150.00,'2022-01-21','17:00:00','18:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-19bebbc1a3b68c44e5759a1d4e6aa93b-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(3,8,13,11,18,2,'2022-01-20 21:25:32',27.00,20.00,'2022-01-21','11:00:00','12:00:00','3','1',41.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-d5fbcc7e4c35fc1dafedb7973fdb8121-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(4,8,22,11,18,2,'2022-01-21 10:08:26',56.00,49.00,'2022-01-21','11:00:00','12:00:00','3','1',26.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-de6495dbe1508caee3ab030818d919df-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(5,4,10,4,8,3,'2022-01-25 18:57:53',157.00,150.00,'2022-01-25','20:00:00','21:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-4aa92f4ee5f9b08efbfdb3c8e9d24a44-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(6,8,10,4,18,3,'2022-01-25 21:21:52',157.00,150.00,'2022-01-25','22:00:00','23:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-12dc71b8c48d531e26097c41209a0d1e-normal',NULL,7.000000,'0','El voucher es invalido',0.00,'1',NULL,NULL,'1'),(7,8,10,4,18,3,'2022-01-25 22:00:07',157.00,150.00,'2022-01-25','23:00:00','00:00:00','2','1',100.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-3fc9fb0d8b380a489238f3608fa8fac7-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(8,8,6,8,14,1,'2022-01-26 20:27:50',117.00,110.00,'2022-01-27','16:00:00','17:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-1c05ad188aa4f3269f2bbcb1e1d16b0f-normal',NULL,7.000000,'0','124950 Perrisus',0.00,'1',NULL,NULL,'1'),(9,8,33,13,14,1,'2022-01-26 20:36:52',8.00,1.00,'2022-01-27','20:00:00','21:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-a6ebfc38d3b29b1cc595aae14349ccec-normal',NULL,7.000000,'0','cancelado por shawarmis',0.00,'1',NULL,NULL,'1'),(10,8,32,15,9,1,'2022-01-27 21:59:20',327.00,320.00,'2022-01-28','09:00:00','13:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-e64d1bf63864079a3e02b7e4e56b60af-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(11,NULL,26,13,NULL,1,'2022-01-28 06:46:55',448.00,448.00,'2022-01-28','20:00:00','20:59:00','1','1',224.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','Hugo González','987654321','3'),(12,NULL,26,13,NULL,1,'2022-01-28 06:51:05',448.00,448.00,'2022-01-28','21:00:00','21:59:00','3','1',448.00,'',NULL,0.000000,'1',NULL,0.00,'2','Jorge Ruiz','978653124','4'),(13,8,10,4,20,1,'2022-01-31 19:49:06',157.00,150.00,'2022-02-01','20:00:00','21:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-f999f6e2a3ad6519c49abed90e9edde8-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(14,8,10,4,20,1,'2022-02-01 20:27:30',157.00,150.00,'2022-02-01','21:00:00','22:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-2941e9b2dd5760b9fc2bef2aba13da60-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(15,NULL,26,13,NULL,1,'2022-02-03 19:18:10',448.00,448.00,'2022-02-03','21:00:00','21:59:00','3','3',50.00,'',NULL,0.000000,'1',NULL,0.00,'2','Joan payano','969285779','3'),(16,13,33,13,27,1,'2022-02-03 22:21:59',8.00,1.00,'2022-02-05','14:00:00','15:00:00','3','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-c1201c69d426c41e09b052e5b6721ff4-normal',NULL,7.000000,'1',NULL,0.00,'1',NULL,NULL,'1'),(17,10,10,4,28,3,'2022-02-03 22:45:12',157.00,150.00,'2022-02-03','23:00:00','00:00:00','0','1',78.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-2bd25c6efaa75b8baf4a5a4d7bcba287-normal',NULL,7.000000,'1','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(18,NULL,9,11,NULL,1,'2022-02-04 17:35:51',724.60,724.60,'2022-02-05','01:00:00','06:59:00','0','1',25.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','92344355','2'),(19,NULL,9,11,NULL,1,'2022-02-04 17:36:48',604.60,604.60,'2022-02-05','09:00:00','13:59:00','3','1',400.00,'',NULL,0.000000,'1',NULL,0.00,'2','tse','546456546','2'),(20,8,32,15,29,3,'2022-02-04 17:47:46',87.00,80.00,'2022-02-04','19:00:00','20:00:00','3','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-7619461c743fac0160ce60beb51438de-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(21,NULL,32,15,NULL,1,'2022-02-04 17:56:54',85.40,85.40,'2022-02-05','16:00:00','16:59:00','3','1',70.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','peuifh','1283688','3'),(22,NULL,32,15,NULL,1,'2022-02-04 18:03:04',85.40,85.40,'2022-02-05','17:00:00','17:59:00','0','1',50.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','0rueba3','5565676795','3'),(23,8,32,15,29,3,'2022-02-04 18:11:17',87.00,80.00,'2022-02-05','21:00:00','22:00:00','2','1',0.00,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-ae3f1791ff9b26f3ccbec77125db8ef0-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(24,NULL,12,11,NULL,1,'2022-02-07 10:06:09',9644.32,9644.32,'2022-02-07','18:00:00','18:59:00','0','1',500.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','996037829','2'),(25,NULL,12,11,NULL,1,'2022-02-07 10:08:26',9644.32,9644.32,'2022-02-07','22:00:00','22:59:00','0','1',500.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sdfsfsf','353535','2'),(26,NULL,17,11,NULL,1,'2022-02-07 10:26:53',666.34,666.34,'2022-02-07','17:00:00','18:59:00','0','1',250.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','test','546456546','2'),(27,NULL,19,11,NULL,1,'2022-02-07 10:30:25',74.32,74.32,'2022-04-28','18:00:00','19:59:00','2','1',50.00,'',NULL,0.000000,'1',NULL,0.00,'2','rgdgdfg','567567567','2'),(28,NULL,17,11,NULL,1,'2022-02-07 10:31:28',333.34,333.34,'2022-02-07','22:00:00','22:59:00','0','1',150.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','fgdfg','56646','2'),(29,NULL,21,11,NULL,1,'2022-02-07 10:37:10',191.14,191.14,'2022-02-07','17:00:00','18:59:00','0','1',50.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','dfdgfdg','54645646','2'),(30,NULL,21,11,NULL,1,'2022-02-07 10:43:32',191.14,191.14,'2022-02-07','17:00:00','18:59:00','0','1',50.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','9456466','2'),(31,NULL,19,11,NULL,1,'2022-02-07 10:44:36',108.32,108.32,'2022-02-07','17:00:00','19:59:00','0','1',50.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','95464564','2'),(32,NULL,20,11,NULL,1,'2022-02-07 10:45:34',18.92,18.92,'2022-02-07','17:00:00','19:59:00','0','1',10.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','9345345345','2'),(33,NULL,17,11,NULL,1,'2022-02-07 10:46:28',999.34,999.34,'2022-02-07','17:00:00','19:59:00','0','1',500.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','94564646','2'),(34,NULL,3,5,NULL,1,'2022-02-07 17:04:17',205.00,205.00,'2022-02-08','22:00:00','23:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','xcvsdv','945645646','2'),(35,NULL,3,5,NULL,1,'2022-02-07 17:05:58',205.00,205.00,'2022-02-07','20:00:00','21:59:00','2','1',100.00,'',NULL,0.000000,'1',NULL,0.00,'2','dgdg','56456546546','2'),(36,NULL,13,11,NULL,1,'2022-02-07 17:10:59',26.60,26.60,'2022-02-07','22:00:00','22:59:00','2','1',20.00,'',NULL,0.000000,'1',NULL,0.00,'2','dsdsfdsf','9456546456','2'),(37,NULL,17,11,NULL,1,'2022-02-07 17:12:28',333.34,333.34,'2022-02-07','22:00:00','22:59:00','3','1',150.00,'',NULL,0.000000,'1',NULL,0.00,'2','dfgdgdfg','9564646456','2'),(38,10,10,4,30,3,'2022-02-07 17:27:49',157.00,150.00,'2022-02-07','19:00:00','20:00:00','0','1',78.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-cbeba49e38c3a41ea428c180c8a5bf74-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(39,10,2,4,30,3,'2022-02-07 17:35:16',127.00,120.00,'2022-02-07','19:00:00','20:00:00','0','1',63.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-d2bb935957c03099d8c56a40f57b0e57-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(40,NULL,12,11,NULL,1,'2022-02-08 17:55:30',19478.32,19478.32,'2022-02-08','22:00:00','23:59:00','0','1',500.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','TESST','4535','2'),(41,NULL,21,11,NULL,1,'2022-02-08 17:58:57',98.14,98.14,'2022-02-08','21:00:00','21:59:00','3','1',50.00,'',NULL,0.000000,'1',NULL,0.00,'2','DFSDFSDF','456456456','2'),(42,NULL,23,11,NULL,1,'2022-02-08 18:00:06',40.32,40.32,'2022-02-08','22:00:00','22:59:00','2','1',29.00,'',NULL,0.000000,'1',NULL,0.00,'2','dfdsfs','456456','2'),(43,NULL,18,11,NULL,1,'2022-02-08 18:00:58',51.10,51.10,'2022-02-08','22:00:00','22:59:00','2','1',30.00,'',NULL,0.000000,'1',NULL,0.00,'2','fggdfg','654','2'),(44,NULL,35,14,NULL,1,'2022-02-08 20:38:56',7.98,7.98,'2022-02-10','19:00:00','19:59:00','3','1',7.98,'',NULL,0.000000,'0',NULL,0.00,'2','Alejandro Ruiz','987654321','3'),(45,NULL,27,13,NULL,1,'2022-02-09 16:18:28',127.54,127.54,'2022-02-09','18:00:00','18:59:00','3','3',127.54,'',NULL,0.000000,'1',NULL,0.00,'2','Patricia Morales','987453126','2'),(46,NULL,31,13,NULL,1,'2022-02-10 09:33:01',75.60,75.60,'2022-02-10','22:00:00','22:59:00','3','1',75.60,'',NULL,0.000000,'1',NULL,0.00,'2','Rosa Rosales','991691363','5'),(47,NULL,12,11,NULL,1,'2022-02-12 10:11:08',201.04,201.04,'2022-02-16','10:00:00','11:59:00','2','1',100.00,'',NULL,0.000000,'1',NULL,0.00,'2','test','334','2'),(48,NULL,17,11,NULL,1,'2022-02-12 10:15:41',333.34,333.34,'2022-02-12','16:00:00','16:59:00','2','1',150.00,'',NULL,0.000000,'1',NULL,0.00,'2','test ','2232323','2'),(49,NULL,33,13,NULL,1,'2022-02-12 19:35:06',75.60,75.60,'2022-02-18','20:00:00','20:59:00','3','1',75.60,'',NULL,0.000000,'1',NULL,0.00,'2','Miguel Icochea','987456123','5'),(50,10,9,11,NULL,3,'2022-02-13 01:55:20',273.00,266.00,'2022-02-18','14:00:00','16:00:00','0','1',54.60,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-da4d5066338fa59dff0db46a5b875f73-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(51,10,2,4,28,3,'2022-02-13 01:59:34',127.00,120.00,'2022-02-18','16:00:00','17:00:00','0','1',63.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-9e7a5f33e3560f4507cbf48b235ca081-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(52,NULL,37,16,NULL,1,'2022-02-13 09:07:46',448.00,448.00,'2022-02-13','10:00:00','10:59:00','2','1',200.00,'',NULL,0.000000,'1',NULL,0.00,'2','prueba 1','85656595','5'),(53,NULL,37,16,NULL,1,'2022-02-13 09:16:16',448.00,448.00,'2022-02-13','15:00:00','15:59:00','2','1',200.00,'',NULL,0.000000,'1',NULL,0.00,'2','hfkfkffl','326568955','4'),(54,10,6,8,NULL,3,'2022-02-13 11:23:21',117.00,110.00,'2022-02-13','17:00:00','18:00:00','0','1',35.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-09a22620206d469902d1fd445bc6b74b-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(55,10,6,8,NULL,3,'2022-02-13 11:29:25',117.00,110.00,'2022-02-13','21:00:00','22:00:00','0','1',35.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-a0e8ec259c04a8d2effc1ea37c27cd2a-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(56,10,6,8,NULL,3,'2022-02-13 11:32:51',337.00,330.00,'2022-02-13','14:00:00','17:00:00','0','1',101.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-f559302f594d4c1419c22853b43cbbb0-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(57,10,36,8,28,3,'2022-02-13 11:36:11',307.00,300.00,'2022-02-13','14:00:00','17:00:00','0','1',92.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-a3314f93e0695f97743ed73e459b2789-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(58,10,6,8,28,3,'2022-02-13 11:43:10',227.00,220.00,'2022-02-17','15:00:00','17:00:00','0','1',68.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-e44daaa91df8fa440f69e97c721a9de5-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(59,10,10,4,28,3,'2022-02-13 11:45:35',457.00,450.00,'2022-02-18','11:00:00','14:00:00','0','1',228.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-5a0c138e478ab620d522ec0ae2120c31-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(60,10,6,8,28,3,'2022-02-13 16:55:35',117.00,110.00,'2022-02-13','17:00:00','18:00:00','0','1',35.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-e9b4bddc90947274a100c8bdad3f5cff-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(61,10,2,4,28,3,'2022-02-13 16:57:30',127.00,120.00,'2022-02-14','22:00:00','23:00:00','0','1',63.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-2cafdeda3f6cebc93bb60c66df5f5ecd-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(62,10,6,8,28,1,'2022-02-13 18:48:46',117.00,110.00,'2022-02-13','19:00:00','20:00:00','0','1',35.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-3e949f38beba5f1cdcd5a12fc678f4ef-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(63,10,39,16,31,1,'2022-02-13 19:19:38',347.00,340.00,'2022-02-13','20:00:00','22:00:00','0','1',34.70,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-c056f88c6f281d881273a7c2701fdd9e-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(64,10,6,8,32,3,'2022-02-13 22:12:59',87.00,80.00,'2022-02-14','11:00:00','12:00:00','0','1',26.10,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-00d19ef6b05f8fa96bb433f893c64252-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(65,10,2,4,32,3,'2022-02-13 22:14:07',127.00,120.00,'2022-02-14','23:00:00','00:00:00','0','1',63.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-734c1f847ff720d96f04960ff7008968-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(66,NULL,9,11,NULL,1,'2022-02-14 12:09:25',137.34,137.34,'2022-02-14','16:00:00','16:59:00','0','1',50.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','dsfsdf','345345','2'),(67,NULL,13,11,NULL,1,'2022-02-14 12:17:28',69.58,69.58,'2022-02-14','16:00:00','18:59:00','0','1',40.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sdfsdfsdf','4564646546','2'),(68,NULL,12,11,NULL,1,'2022-02-14 12:19:03',201.04,201.04,'2022-02-14','18:00:00','19:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sdfsdfsdf','34556546','3'),(69,NULL,9,11,NULL,1,'2022-02-14 12:21:07',137.34,137.34,'2022-02-14','23:00:00','23:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','945656456','2'),(70,NULL,12,11,NULL,1,'2022-02-14 12:23:27',299.04,299.04,'2022-02-14','15:00:00','17:59:00','0','1',150.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','pedro','9345345345','2'),(71,NULL,12,11,NULL,1,'2022-02-14 12:28:45',103.04,103.04,'2022-02-14','23:00:00','23:59:00','0','1',50.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','dfdsf','456456456','4'),(72,NULL,9,11,NULL,1,'2022-02-14 12:29:23',137.34,137.34,'2022-02-14','22:00:00','22:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sdfsfs','3454535','2'),(73,NULL,9,11,NULL,1,'2022-02-14 12:32:32',137.34,137.34,'2022-02-14','22:00:00','22:59:00','0','1',100.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','sf','456456','2'),(74,NULL,9,11,NULL,1,'2022-02-14 12:37:24',137.34,137.34,'2022-02-14','15:00:00','15:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','ghiaco','934453534535','2'),(75,NULL,15,11,NULL,1,'2022-02-14 12:40:27',51.10,51.10,'2022-02-14','23:00:00','23:59:00','0','1',20.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','una mas','9345435435','2'),(76,NULL,17,11,NULL,1,'2022-02-14 12:42:50',333.34,333.34,'2022-02-14','17:00:00','17:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sdfsdfsdf','45646456','2'),(77,NULL,20,11,NULL,1,'2022-02-14 12:50:12',10.92,10.92,'2022-02-14','22:00:00','22:59:00','0','1',5.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','refresg','9234435435','2'),(78,NULL,20,11,NULL,1,'2022-02-14 12:54:46',10.92,10.92,'2022-02-14','13:00:00','13:59:00','0','1',5.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','pity','967576','2'),(79,NULL,20,11,NULL,1,'2022-02-14 12:58:58',10.92,10.92,'2022-02-14','15:00:00','15:59:00','0','1',10.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','dfsdf','5456456','2'),(80,NULL,48,11,NULL,1,'2022-02-14 13:00:49',16.80,16.80,'2022-02-14','16:00:00','16:59:00','2','1',5.00,'',NULL,0.000000,'0',NULL,0.00,'2','ghiaco','9345345345','2'),(81,NULL,17,11,NULL,1,'2022-02-14 13:01:18',333.34,333.34,'2022-02-14','16:00:00','16:59:00','0','1',150.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','test final','9345435435','2'),(82,NULL,17,11,NULL,1,'2022-02-14 13:05:04',333.34,333.34,'2022-02-14','17:00:00','17:59:00','0','1',150.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','tecero','9345435','2'),(83,NULL,19,11,NULL,1,'2022-02-14 13:06:29',74.32,74.32,'2022-02-14','22:00:00','23:59:00','0','1',40.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','cuarto','9345435345','2'),(84,NULL,17,11,NULL,1,'2022-02-14 13:15:23',333.34,333.34,'2022-02-14','23:00:00','23:59:00','0','1',150.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','sin swipper','934543535','2'),(85,NULL,50,11,NULL,1,'2022-02-14 13:15:52',105.98,105.98,'2022-02-14','23:00:00','23:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','swioer 2','9345345','2'),(86,NULL,13,11,NULL,1,'2022-02-14 13:17:37',27.58,27.58,'2022-02-14','23:00:00','23:59:00','0','1',2.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','543543','534345','3'),(87,NULL,50,11,NULL,1,'2022-02-14 13:26:34',105.98,105.98,'2022-02-14','16:00:00','16:59:00','0','1',100.00,'',NULL,0.000000,'1','Cancelado por el proveedor',0.00,'2','test','934534534','2'),(88,NULL,48,11,NULL,1,'2022-02-14 13:28:10',16.80,16.80,'2022-02-14','17:00:00','17:59:00','0','1',14.00,'',NULL,0.000000,'0','Cancelado por el proveedor',0.00,'2','fgdfgdfg','94564646','2'),(89,NULL,20,11,NULL,1,'2022-02-14 13:28:36',10.92,10.92,'2022-02-14','20:00:00','20:59:00','2','1',9.00,'',NULL,0.000000,'1',NULL,0.00,'2','final','92343254','2'),(90,NULL,22,11,NULL,1,'2022-02-14 13:31:08',55.02,55.02,'2022-02-14','17:00:00','17:59:00','2','1',43.00,'',NULL,0.000000,'1',NULL,0.00,'2','finalm test','934534','2'),(91,10,23,11,30,3,'2022-02-14 18:20:45',41.00,34.00,'2022-02-14','21:00:00','22:00:00','0','1',8.20,'gocancha/voucherReservation/cloud-05176f8c27a70ca62265302035225e82-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(92,10,10,4,30,3,'2022-02-14 18:25:15',157.00,150.00,'2022-02-14','20:00:00','21:00:00','0','1',78.50,'gocancha/voucherReservation/cloud-a745f1459647b27aabc8cab7fc3e9a25-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(93,10,10,4,30,1,'2022-02-15 09:31:52',157.00,150.00,'2022-02-15','11:00:00','12:00:00','0','1',78.50,'gocancha/voucherReservation/cloud-2b0be5bb8d46c90c0bf53d09033b0b42-normal',NULL,7.000000,'0','teste ',0.00,'1',NULL,NULL,'1'),(94,10,2,4,30,1,'2022-02-15 09:33:51',127.00,120.00,'2022-02-15','11:00:00','12:00:00','2','1',0.00,'gocancha/voucherReservation/cloud-2ae1dff45d21ffd192cf21bf7051d1f7-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(95,10,10,4,30,1,'2022-02-15 09:42:38',157.00,150.00,'2022-02-15','15:00:00','16:00:00','0','1',78.50,'gocancha/voucherReservation/cloud-aa0a5cbae9a31e3b47e125523aed31be-normal',NULL,7.000000,'0','kmmmm',0.00,'1',NULL,NULL,'1'),(96,10,6,8,30,1,'2022-02-15 09:44:25',97.00,90.00,'2022-02-15','11:00:00','12:00:00','0','1',29.10,'gocancha/voucherReservation/cloud-f08da58c7ab082ddda5fb050a6cb8a33-normal',NULL,7.000000,'0','Rechazado por el cliente',0.00,'1',NULL,NULL,'1'),(97,10,10,4,30,1,'2022-02-15 09:51:07',157.00,150.00,'2022-02-15','15:00:00','16:00:00','0','1',78.50,'gocancha/voucherReservation/cloud-b2ae51479fe1549f66a3cd54f630a6cc-normal',NULL,7.000000,'0','tstef',0.00,'1',NULL,NULL,'1'),(98,10,6,8,30,1,'2022-02-15 09:55:38',97.00,90.00,'2022-02-15','16:00:00','17:00:00','0','1',29.10,'gocancha/voucherReservation/cloud-f05512805cadbf329e655f60bdd929e5-normal',NULL,7.000000,'0','hjbbjh',0.00,'1',NULL,NULL,'1'),(99,10,2,4,30,1,'2022-02-15 10:01:39',127.00,120.00,'2022-02-15','12:00:00','13:00:00','2','1',90.00,'gocancha/voucherReservation/cloud-b58112056764adf5149eef293a450a0e-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(100,10,12,11,30,1,'2022-02-15 10:02:47',105.00,98.00,'2022-02-15','16:00:00','17:00:00','2','1',90.00,'gocancha/voucherReservation/cloud-111afc3946679d8bdd5627b1ec0bc2b2-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(101,10,6,8,30,1,'2022-02-15 10:10:45',97.00,90.00,'2022-02-15','12:00:00','13:00:00','0','1',29.10,'gocancha/voucherReservation/cloud-265315d7270f10cd35ce6b38e04ac0de-normal',NULL,7.000000,'0','testst',0.00,'1',NULL,NULL,'1'),(102,10,2,4,30,1,'2022-02-15 10:15:16',127.00,120.00,'2022-02-15','16:00:00','17:00:00','0','1',63.50,'gocancha/voucherReservation/cloud-eee825d2417698ea134614a3f3a25e6c-normal',NULL,7.000000,'0','kjhjjk',0.00,'1',NULL,NULL,'1'),(103,10,2,4,30,1,'2022-02-15 10:19:45',127.00,120.00,'2022-02-15','16:00:00','17:00:00','2','1',0.00,'gocancha/voucherReservation/cloud-eea23c5f962ae4f328265868aadcf489-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(104,10,6,8,30,1,'2022-02-15 10:22:10',97.00,90.00,'2022-02-15','16:00:00','17:00:00','2','1',90.00,'gocancha/voucherReservation/cloud-8c134b9acd4153e989f83b324436920f-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(105,14,32,15,33,1,'2022-02-15 10:24:37',87.00,80.00,'2022-02-18','20:00:00','21:00:00','1','1',43.50,'products/eca0e6f514b20b3ee5ec90397634f443/cloud-78bb4e9f94ea840c0ca7bd6551dc8be6-normal',NULL,7.000000,'1',NULL,0.00,'1',NULL,NULL,'1'),(106,10,23,11,30,1,'2022-02-15 10:27:50',41.00,34.00,'2022-02-15','16:00:00','17:00:00','2','1',90.00,'gocancha/voucherReservation/cloud-a7adeb512dc0d109d037cddc18d7ccba-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(107,10,10,4,30,1,'2022-02-15 10:30:03',157.00,150.00,'2022-02-15','17:00:00','18:00:00','0','1',78.50,'gocancha/voucherReservation/cloud-173232afa54f08f25afa04ae7d990eed-normal',NULL,7.000000,'0','jhjhjhkjhk',0.00,'1',NULL,NULL,'1'),(108,10,6,8,30,1,'2022-02-15 10:43:50',117.00,110.00,'2022-02-17','12:00:00','13:00:00','2','1',90.00,'gocancha/voucherReservation/cloud-b2970eed3510221989d005eefa3066d0-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(109,10,2,4,30,3,'2022-02-15 11:35:44',127.00,120.00,'2022-02-15','17:00:00','18:00:00','1','1',63.50,'gocancha/voucherReservation/cloud-3a7191976236078f568b497532db1f4d-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(110,10,6,8,NULL,3,'2022-02-15 11:56:55',97.00,90.00,'2022-02-15','13:00:00','14:00:00','1','1',29.10,'gocancha/voucherReservation/cloud-f1c156604984ce6f7b6aa79a8af77d2d-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(111,10,3,5,NULL,3,'2022-02-15 12:04:40',107.00,100.00,'2022-02-15','18:00:00','19:00:00','1','1',53.50,'gocancha/voucherReservation/cloud-482b4abe653fa663f09fcd9e2f3db0a7-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(112,10,3,5,30,3,'2022-02-15 12:06:02',107.00,100.00,'2022-02-17','11:00:00','12:00:00','1','1',53.50,'gocancha/voucherReservation/cloud-b5223ed813f91dcd5848f8869c109731-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(113,10,10,4,30,3,'2022-02-15 12:11:18',157.00,150.00,'2022-02-17','12:00:00','13:00:00','1','1',78.50,'gocancha/voucherReservation/cloud-f07b2b2650619c91bf7e778da9a85fb5-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(114,10,51,11,30,3,'2022-02-15 12:12:33',109.00,102.00,'2022-02-17','12:00:00','13:00:00','1','1',21.80,'gocancha/voucherReservation/cloud-f07b2b2650619c91bf7e778da9a85fb5-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(115,10,5,7,30,1,'2022-02-15 12:17:19',117.00,110.00,'2022-02-17','12:00:00','13:00:00','1','1',23.40,'gocancha/voucherReservation/cloud-f07b2b2650619c91bf7e778da9a85fb5-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(116,10,5,7,30,1,'2022-02-15 12:19:49',117.00,110.00,'2022-02-15','14:00:00','15:00:00','1','1',23.40,'gocancha/voucherReservation/cloud-fa6c20c91c27fa0cb3cdae5f4024d9e4-normal',NULL,7.000000,'0',NULL,0.00,'1',NULL,NULL,'1'),(117,NULL,15,11,NULL,1,'2022-03-04 15:56:38',52.00,52.00,'2022-03-04','17:00:00','18:00:00','2','3',25.00,'',NULL,0.000000,'1',NULL,0.00,'2','dfdsfsf','954646456','2'),(118,NULL,9,11,NULL,1,'2022-03-04 16:01:46',273.00,273.00,'2022-03-04','18:00:00','20:00:00','2','3',100.00,'',NULL,0.000000,'1',NULL,0.00,'2','gcdgdfgdg','945646456','2');
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservapago`
--

DROP TABLE IF EXISTS `reservapago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservapago` (
  `reservapago_id` int(11) NOT NULL AUTO_INCREMENT,
  `reserva_id` int(11) NOT NULL,
  `reservapago_monto` decimal(10,2) DEFAULT NULL,
  `reservapago_fecha` datetime DEFAULT NULL,
  `reservapago_tipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`reservapago_id`),
  KEY `fk_reservapago_reserva1_idx` (`reserva_id`),
  CONSTRAINT `fk_reservapago_reserva1` FOREIGN KEY (`reserva_id`) REFERENCES `reserva` (`reserva_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservapago`
--

LOCK TABLES `reservapago` WRITE;
/*!40000 ALTER TABLE `reservapago` DISABLE KEYS */;
INSERT INTO `reservapago` VALUES (1,1,2.40,'2022-01-20 19:29:55','1'),(2,2,0.00,'2022-01-20 20:47:41','1'),(3,3,5.40,'2022-01-20 21:25:32','1'),(4,3,21.60,'2022-01-20 21:31:09','3'),(5,4,11.20,'2022-01-21 10:08:26','1'),(6,5,0.00,'2022-01-25 18:57:54','1'),(7,6,0.00,'2022-01-25 21:21:52','1'),(8,7,78.50,'2022-01-25 22:00:07','1'),(9,8,0.00,'2022-01-26 20:27:50','1'),(10,9,0.00,'2022-01-26 20:36:52','1'),(11,10,0.00,'2022-01-27 21:59:20','1'),(12,11,224.00,'2022-01-28 06:46:55','1'),(13,12,448.00,'2022-01-28 06:51:05','1'),(14,13,0.00,'2022-01-31 19:49:06','1'),(15,14,0.00,'2022-02-01 20:27:30','1'),(16,1,5.60,'2022-02-03 19:09:56','1'),(17,15,50.00,'2022-02-03 19:18:10','3'),(18,16,0.00,'2022-02-03 22:22:00','1'),(19,17,78.50,'2022-02-03 22:45:12','1'),(20,18,25.00,'2022-02-04 17:35:51','1'),(21,19,400.00,'2022-02-04 17:36:48','1'),(22,20,0.00,'2022-02-04 17:47:47','1'),(23,20,87.00,'2022-02-04 17:50:15','1'),(24,21,70.00,'2022-02-04 17:56:54','1'),(25,21,15.40,'2022-02-04 17:57:42','1'),(26,22,50.00,'2022-02-04 18:03:05','1'),(27,23,0.00,'2022-02-04 18:11:17','1'),(28,4,44.80,'2022-02-04 18:18:29','1'),(29,19,204.60,'2022-02-07 10:03:53','1'),(30,24,500.00,'2022-02-07 10:06:09','1'),(31,25,500.00,'2022-02-07 10:08:26','1'),(32,26,250.00,'2022-02-07 10:26:53','1'),(33,27,50.00,'2022-02-07 10:30:25','1'),(34,28,150.00,'2022-02-07 10:31:28','1'),(35,29,50.00,'2022-02-07 10:37:11','1'),(36,30,50.00,'2022-02-07 10:43:32','1'),(37,31,50.00,'2022-02-07 10:44:36','1'),(38,32,10.00,'2022-02-07 10:45:34','1'),(39,33,500.00,'2022-02-07 10:46:28','1'),(40,34,100.00,'2022-02-07 17:04:17','1'),(41,35,100.00,'2022-02-07 17:06:01','1'),(42,36,20.00,'2022-02-07 17:10:59','1'),(43,37,150.00,'2022-02-07 17:12:28','1'),(44,37,183.34,'2022-02-07 17:14:57','1'),(45,38,78.50,'2022-02-07 17:27:49','1'),(46,39,63.50,'2022-02-07 17:35:16','1'),(47,40,500.00,'2022-02-08 17:55:30','1'),(48,41,50.00,'2022-02-08 17:58:57','1'),(49,42,29.00,'2022-02-08 18:00:06','1'),(50,43,30.00,'2022-02-08 18:00:58','1'),(51,41,48.14,'2022-02-08 18:01:43','1'),(52,44,7.98,'2022-02-08 20:38:56','1'),(53,45,127.54,'2022-02-09 16:18:28','3'),(54,15,398.00,'2022-02-09 16:19:24','1'),(55,46,75.60,'2022-02-10 09:33:01','1'),(56,47,100.00,'2022-02-12 10:11:08','1'),(57,48,150.00,'2022-02-12 10:15:41','1'),(58,49,75.60,'2022-02-12 19:35:06','1'),(59,50,54.60,'2022-02-13 01:55:21','1'),(60,51,63.50,'2022-02-13 01:59:34','1'),(61,52,200.00,'2022-02-13 09:07:46','1'),(62,53,200.00,'2022-02-13 09:16:16','1'),(63,54,35.10,'2022-02-13 11:23:21','1'),(64,55,35.10,'2022-02-13 11:29:25','1'),(65,56,101.10,'2022-02-13 11:32:51','1'),(66,57,92.10,'2022-02-13 11:36:11','1'),(67,58,68.10,'2022-02-13 11:43:10','1'),(68,59,228.50,'2022-02-13 11:45:35','1'),(69,60,35.10,'2022-02-13 16:55:35','1'),(70,61,63.50,'2022-02-13 16:57:30','1'),(71,62,35.10,'2022-02-13 18:48:46','1'),(72,63,34.70,'2022-02-13 19:19:39','1'),(73,64,26.10,'2022-02-13 22:13:00','1'),(74,65,63.50,'2022-02-13 22:14:07','1'),(75,66,50.00,'2022-02-14 12:09:25','1'),(76,67,40.00,'2022-02-14 12:17:28','1'),(77,68,100.00,'2022-02-14 12:19:03','1'),(78,69,100.00,'2022-02-14 12:21:07','1'),(79,70,150.00,'2022-02-14 12:23:27','1'),(80,71,50.00,'2022-02-14 12:28:45','1'),(81,72,100.00,'2022-02-14 12:29:23','1'),(82,73,100.00,'2022-02-14 12:32:32','1'),(83,74,100.00,'2022-02-14 12:37:24','1'),(84,75,20.00,'2022-02-14 12:40:29','1'),(85,76,100.00,'2022-02-14 12:42:50','1'),(86,77,5.00,'2022-02-14 12:50:12','1'),(87,78,5.00,'2022-02-14 12:54:46','1'),(88,79,10.00,'2022-02-14 12:58:58','1'),(89,80,5.00,'2022-02-14 13:00:49','1'),(90,81,150.00,'2022-02-14 13:01:18','1'),(91,82,150.00,'2022-02-14 13:05:04','1'),(92,83,40.00,'2022-02-14 13:06:29','1'),(93,84,150.00,'2022-02-14 13:15:23','1'),(94,85,100.00,'2022-02-14 13:15:52','1'),(95,86,2.00,'2022-02-14 13:17:37','1'),(96,87,100.00,'2022-02-14 13:26:34','1'),(97,88,14.00,'2022-02-14 13:28:10','1'),(98,89,9.00,'2022-02-14 13:28:36','1'),(99,90,43.00,'2022-02-14 13:31:08','1'),(100,91,8.20,'2022-02-14 18:20:45','1'),(101,92,78.50,'2022-02-14 18:25:15','1'),(102,93,78.50,'2022-02-15 09:31:52','1'),(103,94,0.00,'2022-02-15 09:33:51','1'),(104,95,78.50,'2022-02-15 09:42:38','1'),(105,96,29.10,'2022-02-15 09:44:25','1'),(106,97,78.50,'2022-02-15 09:51:07','1'),(107,98,29.10,'2022-02-15 09:55:38','1'),(108,99,90.00,'2022-02-15 10:01:40','1'),(109,100,90.00,'2022-02-15 10:02:47','1'),(110,101,29.10,'2022-02-15 10:10:45','1'),(111,102,63.50,'2022-02-15 10:15:16','1'),(112,103,0.00,'2022-02-15 10:19:45','1'),(113,104,90.00,'2022-02-15 10:22:10','1'),(114,105,43.50,'2022-02-15 10:24:38','1'),(115,106,90.00,'2022-02-15 10:27:50','1'),(116,107,78.50,'2022-02-15 10:30:03','1'),(117,108,90.00,'2022-02-15 10:43:50','1'),(118,16,8.00,'2022-02-15 10:45:07','1'),(119,109,63.50,'2022-02-15 11:35:44','1'),(120,110,29.10,'2022-02-15 11:56:56','1'),(121,111,53.50,'2022-02-15 12:04:40','1'),(122,112,53.50,'2022-02-15 12:06:02','1'),(123,113,78.50,'2022-02-15 12:11:18','1'),(124,114,21.80,'2022-02-15 12:12:33','1'),(125,115,23.40,'2022-02-15 12:17:19','1'),(126,116,23.40,'2022-02-15 12:19:49','1'),(127,117,25.00,'2022-03-04 15:56:38','3'),(128,118,100.00,'2022-03-04 16:01:46','3');
/*!40000 ALTER TABLE `reservapago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `token_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `token_valor` varchar(500) DEFAULT NULL,
  `token_fcm` varchar(200) DEFAULT NULL,
  `token_debeexpirar` char(1) DEFAULT NULL,
  `token_deviceid` varchar(45) DEFAULT NULL,
  `token_device` varchar(45) DEFAULT NULL,
  `token_fecha` datetime DEFAULT NULL,
  `token_fechaexpiracion` datetime DEFAULT NULL,
  `token_version` varchar(10) DEFAULT NULL,
  `token_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`token_id`),
  KEY `fk_token_platform1_idx` (`platform_id`),
  KEY `fk_token_cliente1_idx` (`cliente_id`),
  CONSTRAINT `fk_token_cliente1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`cliente_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_token_platform1` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`platform_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=332 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (2,1,NULL,'1d8b04f4d1e1144fe8dd4651aa8ba6e4','dJJQjdMsRTiGk-EN9BDg7V:APA91bE-Sro_SjBfdOS--LLP9P6kdKnIeSC9ODSgRiVGwAg4wPN0IPebbXqqQfc8l6UkXGSUEZ2U731wI3UM6u_XWsLPZFyQ8zCbbQEM771ntjnCAL1_O6dg2ZaQm23UOuJaqnb48ySC','0',NULL,NULL,'2021-10-23 15:09:14','2021-10-29 15:09:14',NULL,'1'),(3,1,NULL,'621d07efd9e70acd4f469b64bb69d490',NULL,'0',NULL,NULL,'2021-10-23 15:09:31','2021-10-29 15:09:31',NULL,'1'),(4,2,NULL,'ca5cab8d26addeaa9eea6dd5f99d9ad7',NULL,'0',NULL,NULL,'2021-10-23 15:10:29','2021-10-29 15:10:29',NULL,'1'),(5,3,NULL,'411f5790f8999ffaaf75b5b989bafa58',NULL,'0',NULL,NULL,'2021-10-23 15:10:42','2021-10-29 15:10:42',NULL,'1'),(6,3,NULL,'14c20ad3094e1b24cbec8c85b8bc8a07',NULL,'0',NULL,NULL,'2021-10-23 15:11:53','2021-10-29 15:11:53',NULL,'1'),(7,3,NULL,'343ea1e097510cded737eb98655f42ed',NULL,'0',NULL,NULL,'2021-10-23 15:12:06','2021-10-29 15:12:06',NULL,'1'),(8,1,NULL,'f466916da777e7bfca384dad7c126279',NULL,'0',NULL,NULL,'2021-10-23 15:12:27','2021-10-29 15:12:27',NULL,'1'),(9,1,NULL,'fe6d454c468dea050499c04f07f6914d',NULL,'0',NULL,NULL,'2021-10-27 10:47:40','2021-11-02 10:47:40',NULL,'1'),(10,4,NULL,'fc2c60f4a1d52432063b0bdae547ac01',NULL,'0',NULL,NULL,'2021-11-03 20:40:27','2021-11-09 20:40:27',NULL,'1'),(11,4,NULL,'b6e201f40eb551838f6f3b5862e9a7ee',NULL,'0',NULL,NULL,'2021-11-05 16:53:12','2021-11-11 16:53:12',NULL,'1'),(12,1,NULL,'b1049de17b4e659165eae597e7632aa8',NULL,'0',NULL,NULL,'2021-11-07 22:03:05','2021-11-13 22:03:05',NULL,'1'),(16,4,NULL,'6f96a8c4732c24c20f06f5e69448736a',NULL,'0',NULL,NULL,'2021-11-10 00:10:01','2021-11-16 00:10:01',NULL,'1'),(17,4,NULL,'07ffe0d0baba6afbd6647b9dd3494fa1',NULL,'0',NULL,NULL,'2021-11-10 14:29:33','2021-11-16 14:29:33',NULL,'1'),(18,4,NULL,'f639fc604b56aabf46a45d7aac46efee',NULL,'0',NULL,NULL,'2021-11-10 16:32:18','2021-11-16 16:32:18',NULL,'1'),(19,1,NULL,'abdd68301f16861636686faa5cf14ce8',NULL,'0',NULL,NULL,'2021-11-11 01:14:40','2021-11-17 01:14:40',NULL,'1'),(20,1,NULL,'0a842ccc2180902cfd78027022268800',NULL,'0',NULL,NULL,'2021-11-11 01:15:02','2021-11-17 01:15:02',NULL,'1'),(21,1,NULL,'bd9049e969209f9124370adb24f81797',NULL,'0',NULL,NULL,'2021-11-11 01:15:09','2021-11-17 01:15:09',NULL,'1'),(22,4,NULL,'33c2237db877710b001723786a4e363f',NULL,'0',NULL,NULL,'2021-11-12 00:39:38','2021-11-18 00:39:38',NULL,'1'),(23,4,NULL,'07a5ef79307c1f592e97b36ce0bf4017',NULL,'0',NULL,NULL,'2021-11-12 16:04:31','2021-11-18 16:04:31',NULL,'1'),(24,5,NULL,'c7ec784469326cf89200168d342831c4',NULL,'0',NULL,NULL,'2021-11-12 16:06:01','2021-11-18 16:06:01',NULL,'1'),(25,1,NULL,'18dd43a1d611c11b47aa074cac9713de',NULL,'0',NULL,NULL,'2021-11-12 18:34:37','2021-11-18 18:34:37',NULL,'1'),(26,4,NULL,'1174f24c4ce81748590690f1b9758dde',NULL,'0',NULL,NULL,'2021-11-13 10:25:00','2021-11-19 10:25:00',NULL,'1'),(27,4,NULL,'082028668646230b1f2cfcc24c42399f',NULL,'0',NULL,NULL,'2021-11-13 20:00:05','2021-11-19 20:00:05',NULL,'1'),(28,5,NULL,'4fede843f1a3da3c9183e10f9a7c5590',NULL,'0',NULL,NULL,'2021-11-13 20:03:28','2021-11-19 20:03:28',NULL,'1'),(29,4,NULL,'16b6739b004cc537e9e7063cdc6b3375',NULL,'0',NULL,NULL,'2021-11-13 20:13:09','2021-11-19 20:13:09',NULL,'1'),(30,4,NULL,'1e61c21a0c2f1ba5378e8028d18ecad5',NULL,'0',NULL,NULL,'2021-11-13 20:24:43','2021-11-19 20:24:43',NULL,'1'),(31,4,NULL,'f878b2f888cd58e4b69886216d70f50c',NULL,'0',NULL,NULL,'2021-11-13 20:27:35','2021-11-19 20:27:35',NULL,'1'),(32,4,NULL,'4804a625cbc480e5d106f6d38aea2e0a',NULL,'0',NULL,NULL,'2021-11-13 20:30:18','2021-11-19 20:30:18',NULL,'1'),(33,4,NULL,'41ec91b3883dd11042cd9b4225fa8f41',NULL,'0',NULL,NULL,'2021-11-13 20:31:01','2021-11-19 20:31:01',NULL,'1'),(34,4,NULL,'5943288d928da50b8af1b0392575cbd5',NULL,'0',NULL,NULL,'2021-11-13 20:31:47','2021-11-19 20:31:47',NULL,'1'),(35,4,NULL,'1a1bdbd546009a5ab0977f058604f6d0',NULL,'0',NULL,NULL,'2021-11-13 20:32:22','2021-11-19 20:32:22',NULL,'1'),(36,4,NULL,'208ab91e24423b6b4fcd5d17a62552ae',NULL,'0',NULL,NULL,'2021-11-13 20:32:53','2021-11-19 20:32:53',NULL,'1'),(37,4,NULL,'604562e683b8875619ba395172126e56',NULL,'0',NULL,NULL,'2021-11-13 20:33:25','2021-11-19 20:33:25',NULL,'1'),(38,4,NULL,'ab38b307ddc43288c1b7d7c4ad11ae5c',NULL,'0',NULL,NULL,'2021-11-13 20:34:37','2021-11-19 20:34:37',NULL,'1'),(39,4,NULL,'25838db6748c49dec7b67179e548dc68',NULL,'0',NULL,NULL,'2021-11-13 20:35:07','2021-11-19 20:35:07',NULL,'1'),(40,4,NULL,'e3295c329de0e5fde2483c646644ddd5',NULL,'0',NULL,NULL,'2021-11-13 20:35:46','2021-11-19 20:35:46',NULL,'1'),(41,4,NULL,'f0be283bd08a25b5923e97a7e640d8a0',NULL,'0',NULL,NULL,'2021-11-13 20:38:39','2021-11-19 20:38:39',NULL,'1'),(42,4,NULL,'67377012a9e762c73a1562313a62586e',NULL,'0',NULL,NULL,'2021-11-13 20:41:02','2021-11-19 20:41:02',NULL,'1'),(43,4,NULL,'8aadb0a9d61c9fa8420d5a4f73485ef3',NULL,'0',NULL,NULL,'2021-11-13 20:41:48','2021-11-19 20:41:48',NULL,'1'),(44,5,NULL,'399d6806326e1432694e5422619a5cb7',NULL,'0',NULL,NULL,'2021-11-13 20:45:44','2021-11-19 20:45:44',NULL,'1'),(45,4,NULL,'50f75694a020e711ccbc9279226fcd32',NULL,'0',NULL,NULL,'2021-11-13 21:16:58','2021-11-19 21:16:58',NULL,'1'),(46,4,NULL,'c22f8a1878bbc23e6317163b06435aef',NULL,'0',NULL,NULL,'2021-11-13 22:07:12','2021-11-19 22:07:12',NULL,'1'),(47,5,NULL,'f6eeb0d93a9e9823fb95f6bf88ce95f4',NULL,'0',NULL,NULL,'2021-11-14 18:37:58','2021-11-20 18:37:58',NULL,'1'),(48,6,NULL,'d04b958feb16d548c9b470a88cba7da0',NULL,'0',NULL,NULL,'2021-11-14 20:36:07','2021-11-20 20:36:07',NULL,'1'),(49,4,NULL,'fba0f4fcbed3a5ae30df62a2c39b3ec7',NULL,'0',NULL,NULL,'2021-11-15 18:52:52','2021-11-21 18:52:52',NULL,'1'),(56,4,NULL,'e078a974a20ea551b80c52b3f9fdcc7a',NULL,'0',NULL,NULL,'2021-11-17 17:20:54','2021-11-23 17:20:54',NULL,'1'),(62,4,NULL,'3c5e21019305e51bf0d5c7d3a9d9327a',NULL,'0',NULL,NULL,'2021-11-17 21:38:31','2021-11-23 21:38:31',NULL,'1'),(64,7,NULL,'44ced459e09ef828ff111f2bca932f8f',NULL,'0',NULL,NULL,'2021-11-18 15:49:26','2021-11-24 15:49:26',NULL,'1'),(66,4,NULL,'a8b8e6ad14f382d2411ecab5391b9db1',NULL,'0',NULL,NULL,'2021-11-18 19:16:22','2021-11-24 19:16:22',NULL,'1'),(67,4,NULL,'6ff2062dd81e98eba0b134a43a20bb75',NULL,'0',NULL,NULL,'2021-11-18 19:17:49','2021-11-24 19:17:49',NULL,'1'),(68,4,NULL,'258d8c21433b00392b767534deb2a3e4',NULL,'0',NULL,NULL,'2021-11-20 12:00:57','2021-11-26 12:00:57',NULL,'1'),(70,9,NULL,'135e949405fd9d914bbd360cc8de1e99',NULL,'0',NULL,NULL,'2021-11-20 13:19:56','2021-11-26 13:19:56',NULL,'1'),(71,4,NULL,'04049fc78fe19b58ef9751fa12112712',NULL,'0',NULL,NULL,'2021-11-20 13:22:14','2021-11-26 13:22:14',NULL,'1'),(74,8,NULL,'9adca10e50c710051c498ba3688ee423',NULL,'0',NULL,NULL,'2021-11-20 13:45:49','2021-11-26 13:45:49',NULL,'1'),(75,8,NULL,'c05be244b06fac760c3bda1c27a15a7e',NULL,'0',NULL,NULL,'2021-11-20 14:02:23','2021-11-26 14:02:23',NULL,'1'),(76,8,NULL,'15d54f0fd0e901fd57b5deed074a1d81',NULL,'0',NULL,NULL,'2021-11-20 14:11:43','2021-11-26 14:11:43',NULL,'1'),(77,8,NULL,'85efcd2f63d8ea499e78a4ccf26ed42f',NULL,'0',NULL,NULL,'2021-11-20 18:55:21','2021-11-26 18:55:21',NULL,'1'),(78,8,NULL,'01c51f29f4eb5b52d55a5a64959b110b',NULL,'0',NULL,NULL,'2021-11-21 18:57:40','2021-11-27 18:57:40',NULL,'1'),(79,8,NULL,'d72ec6d4bb6b16cad6848aafa0b61f2d',NULL,'0',NULL,NULL,'2021-11-22 23:29:35','2021-11-28 23:29:35',NULL,'1'),(80,4,NULL,'a26e461661028c1153cc652b7fa9abfd',NULL,'0',NULL,NULL,'2021-11-25 10:19:20','2021-12-01 10:19:20',NULL,'1'),(81,8,NULL,'b43c2db9a42f635ea56cf3a5f1a2e87c',NULL,'0',NULL,NULL,'2021-11-26 20:38:06','2021-12-02 20:38:06',NULL,'1'),(82,8,NULL,'5c313090d815ddd6782b00edffdc56b4',NULL,'0',NULL,NULL,'2021-11-26 20:54:18','2021-12-02 20:54:18',NULL,'1'),(83,8,NULL,'ec8676714736922717fee2fc8be25707',NULL,'0',NULL,NULL,'2021-11-26 22:37:14','2021-12-02 22:37:14',NULL,'1'),(84,8,NULL,'866f0904016741deb6f4be083ae20d36',NULL,'0',NULL,NULL,'2021-11-26 22:38:20','2021-12-02 22:38:20',NULL,'1'),(85,8,NULL,'420128e64a0843a653708b4d5dba2fd9',NULL,'0',NULL,NULL,'2021-11-26 22:49:01','2021-12-02 22:49:01',NULL,'1'),(86,8,NULL,'02b432bf44852e5571994e06576e8776',NULL,'0',NULL,NULL,'2021-11-26 23:39:36','2021-12-02 23:39:36',NULL,'1'),(87,8,NULL,'4568375476ef757583ad41ad88750ae6',NULL,'0',NULL,NULL,'2021-11-26 23:43:16','2021-12-02 23:43:16',NULL,'1'),(88,8,NULL,'c2183b4a03ddc9e2d9667d29e5e2720f',NULL,'0',NULL,NULL,'2021-11-27 00:51:57','2021-12-03 00:51:57',NULL,'1'),(89,8,NULL,'c5a4c4ec256238c0199028bc2b2243f7',NULL,'0',NULL,NULL,'2021-11-27 21:15:18','2021-12-03 21:15:18',NULL,'1'),(90,4,NULL,'c0488c737fa9a3201283c8eb06ca87c9',NULL,'0',NULL,NULL,'2021-11-30 09:26:36','2021-12-06 09:26:36',NULL,'1'),(91,4,NULL,'6058c2f0cc60010fcb9a02fde40d9885',NULL,'0',NULL,NULL,'2021-11-30 09:46:22','2021-12-06 09:46:22',NULL,'1'),(92,4,NULL,'17f09913be3df736ff9bd3ca459ef746',NULL,'0',NULL,NULL,'2021-11-30 10:47:38','2021-12-06 10:47:38',NULL,'1'),(93,1,NULL,'42690ec22ced9602f02e6a237c4b8a67',NULL,'0',NULL,NULL,'2021-11-30 16:15:12','2021-12-06 16:15:12',NULL,'1'),(95,4,NULL,'6016ab361c9f2b764784647878c1ccbc',NULL,'0',NULL,NULL,'2021-12-01 20:43:37','2021-12-07 20:43:37',NULL,'1'),(96,8,NULL,'2565dcdc1f0c840eafc359e265d31a7a',NULL,'0',NULL,NULL,'2021-12-01 21:43:34','2021-12-07 21:43:34',NULL,'1'),(97,1,NULL,'a40b41e09a363b8ae36a8ec663921c07',NULL,'0',NULL,NULL,'2021-12-01 22:19:54','2021-12-07 22:19:54',NULL,'1'),(98,1,NULL,'7e21eecba880a178507c93805fe1267c',NULL,'0',NULL,NULL,'2021-12-01 22:30:34','2021-12-07 22:30:34',NULL,'1'),(99,1,NULL,'2e3906ac2592f7a67fd412d7af8a5bb0',NULL,'0',NULL,NULL,'2021-12-01 22:37:14','2021-12-07 22:37:14',NULL,'1'),(100,1,NULL,'36b64cc2283f77676067281f771e0bf6',NULL,'0',NULL,NULL,'2021-12-01 22:54:18','2021-12-07 22:54:18',NULL,'1'),(106,8,NULL,'e13f8607cc3a5a85311ac18abe151a57',NULL,'0',NULL,NULL,'2021-12-04 00:07:24','2021-12-10 00:07:24',NULL,'1'),(108,8,NULL,'8c50c6195efb724f9f1e7f9e26ada03e',NULL,'0',NULL,NULL,'2021-12-04 20:05:42','2021-12-10 20:05:42',NULL,'1'),(110,8,NULL,'b27e84fed1baa0746e52e12c15888742',NULL,'0',NULL,NULL,'2021-12-04 21:25:23','2021-12-10 21:25:23',NULL,'1'),(111,8,NULL,'92f0da4605ab16f38c021bb0cef555e5',NULL,'0',NULL,NULL,'2021-12-06 20:59:06','2021-12-12 20:59:06',NULL,'1'),(113,8,NULL,'76ac8f369676e4f6a3b5add133db45aa',NULL,'0',NULL,NULL,'2021-12-10 00:14:07','2021-12-16 00:14:07',NULL,'1'),(115,8,NULL,'3ef32ed845449622cee969a9feebd892',NULL,'0',NULL,NULL,'2021-12-10 19:33:32','2021-12-16 19:33:32',NULL,'1'),(116,8,NULL,'2877982f1976908df726065cc6b9e583',NULL,'0',NULL,NULL,'2021-12-10 19:47:31','2021-12-16 19:47:31',NULL,'1'),(118,1,NULL,'c40d735596b80e1a37e77ae42eafd734',NULL,'0',NULL,NULL,'2021-12-10 20:41:08','2021-12-16 20:41:08',NULL,'1'),(119,8,NULL,'7a94937ce0f0d476b55a9635b21bc193',NULL,'0',NULL,NULL,'2021-12-11 10:21:58','2021-12-17 10:21:58',NULL,'1'),(121,8,NULL,'724e9b5a61d0586478241097241921f6',NULL,'0',NULL,NULL,'2021-12-13 12:40:17','2021-12-19 12:40:17',NULL,'1'),(122,4,NULL,'bdf129fe789ef4d18aa3eb70a99e32ae',NULL,'0',NULL,NULL,'2021-12-16 13:27:13','2021-12-22 13:27:13',NULL,'1'),(123,4,NULL,'81c08718b6f65606372aee8ab8ccfac6',NULL,'0',NULL,NULL,'2021-12-17 17:52:22','2021-12-23 17:52:22',NULL,'1'),(125,8,NULL,'b04d5a8fdd18c8cbb30443f98624be53',NULL,'0',NULL,NULL,'2021-12-17 19:02:47','2021-12-23 19:02:47',NULL,'1'),(127,8,NULL,'e3950785203d0e0ccf6f32f852aad1fd',NULL,'0',NULL,NULL,'2021-12-17 19:10:33','2021-12-23 19:10:33',NULL,'1'),(128,8,NULL,'5a816daa3818893a4cac155387808604',NULL,'0',NULL,NULL,'2021-12-18 00:09:59','2021-12-24 00:09:59',NULL,'1'),(129,8,NULL,'78235d11bd4b2ccdc3fcffac8d80f7ff',NULL,'0',NULL,NULL,'2021-12-18 00:10:07','2021-12-24 00:10:07',NULL,'1'),(130,8,NULL,'6c8478c9cc8476e6f3242eb76ec07e7f',NULL,'0',NULL,NULL,'2021-12-18 00:17:17','2021-12-24 00:17:17',NULL,'1'),(131,8,NULL,'3ef04baeafab067f889440143da9533b',NULL,'0',NULL,NULL,'2021-12-18 02:07:59','2021-12-24 02:07:59',NULL,'1'),(132,8,NULL,'dcf1fb5a25f1039f12842ab8595d91e3',NULL,'0',NULL,NULL,'2021-12-19 13:36:06','2021-12-25 13:36:06',NULL,'1'),(134,4,NULL,'c3f38a5202276c8cdc9f79541de2098d',NULL,'0',NULL,NULL,'2021-12-21 15:35:10','2021-12-27 15:35:10',NULL,'1'),(135,8,NULL,'bda7e744231563ddec82c123f839a735',NULL,'0',NULL,NULL,'2021-12-21 17:57:52','2021-12-27 17:57:52',NULL,'1'),(136,8,NULL,'8bdb144be1ea3bbc7d2cd58e8a90c39e',NULL,'0',NULL,NULL,'2021-12-22 15:31:58','2021-12-28 15:31:58',NULL,'1'),(137,8,NULL,'5c9fb4718a44264c4816c779abfc87c4',NULL,'0',NULL,NULL,'2021-12-22 17:27:53','2021-12-28 17:27:53',NULL,'1'),(138,8,NULL,'b6765aaa4e87a4286b1718072e983b98',NULL,'0',NULL,NULL,'2021-12-22 21:15:00','2021-12-28 21:15:00',NULL,'1'),(139,8,NULL,'fe98c1b841a90741a9a02473c2ebc441',NULL,'0',NULL,NULL,'2021-12-22 23:25:40','2021-12-28 23:25:40',NULL,'1'),(140,8,NULL,'e0fd3538f8233c7d86fc6f7aef8c321b',NULL,'0',NULL,NULL,'2021-12-22 23:29:15','2021-12-28 23:29:15',NULL,'1'),(141,8,NULL,'ef3783791366ee878c42d739ec16ad1e',NULL,'0',NULL,NULL,'2021-12-23 09:33:15','2021-12-29 09:33:15',NULL,'1'),(142,8,NULL,'2e12d5149bc41e7eaa3cfb4b597c3a76',NULL,'0',NULL,NULL,'2021-12-23 09:49:58','2021-12-29 09:49:58',NULL,'1'),(146,8,NULL,'bafbdc06f90f1cadec38b21ed8381986',NULL,'0',NULL,NULL,'2021-12-23 13:56:19','2021-12-29 13:56:19',NULL,'1'),(147,8,NULL,'0fe56dae9912187027ee59d0ea377ec0',NULL,'0',NULL,NULL,'2021-12-23 14:00:53','2021-12-29 14:00:53',NULL,'1'),(148,8,NULL,'115759b2a1e043715e3bfa4cb955e0a4',NULL,'0',NULL,NULL,'2021-12-23 14:02:32','2021-12-29 14:02:32',NULL,'1'),(149,4,NULL,'c496914a16f30d14842362ad5efdece8',NULL,'0',NULL,NULL,'2021-12-23 15:47:22','2021-12-29 15:47:22',NULL,'1'),(150,8,NULL,'370ed5d59eddae8681c47abd259398d3',NULL,'0',NULL,NULL,'2021-12-23 17:52:09','2021-12-29 17:52:09',NULL,'1'),(151,8,NULL,'6e3eede52736442897bf5f880c17c651',NULL,'0',NULL,NULL,'2021-12-23 20:54:43','2021-12-29 20:54:43',NULL,'1'),(152,8,NULL,'71134b8d8fd11d69f0019f4a68ff410d',NULL,'0',NULL,NULL,'2021-12-24 08:55:54','2021-12-30 08:55:54',NULL,'1'),(153,8,NULL,'76f6edf6891a7a8e3049643527e033f4',NULL,'0',NULL,NULL,'2021-12-24 10:39:26','2021-12-30 10:39:26',NULL,'1'),(154,8,NULL,'c2d0f18bb3fb2cefaf436fa18391c0ad',NULL,'0',NULL,NULL,'2021-12-24 11:03:44','2021-12-30 11:03:44',NULL,'1'),(155,8,NULL,'3f432e49899df04540cc050c20305240',NULL,'0',NULL,NULL,'2021-12-24 12:34:08','2021-12-30 12:34:08',NULL,'1'),(156,8,NULL,'5fc9a025e0d9279053d249762aa2426f',NULL,'0',NULL,NULL,'2021-12-24 14:15:47','2021-12-30 14:15:47',NULL,'1'),(158,8,NULL,'daab902e56c894d35efec74acfa20fa7',NULL,'0',NULL,NULL,'2021-12-24 15:37:07','2021-12-30 15:37:07',NULL,'1'),(159,8,NULL,'389553f8df75b297099054a6e0929eb4',NULL,'0',NULL,NULL,'2021-12-24 16:13:14','2021-12-30 16:13:14',NULL,'1'),(160,8,NULL,'85dfcd537444b7f35bb7a9dcb22cb081',NULL,'0',NULL,NULL,'2021-12-27 10:11:23','2022-01-02 10:11:23',NULL,'1'),(161,4,NULL,'858d475df576ddd5ceec3dd339846873',NULL,'0',NULL,NULL,'2021-12-27 17:38:44','2022-01-02 17:38:44',NULL,'1'),(162,8,NULL,'e8ef5b1a7be0170277fd81b2642eb8d6',NULL,'0',NULL,NULL,'2021-12-29 11:01:57','2022-01-04 11:01:57',NULL,'1'),(164,8,NULL,'9e8da49a82d419e5ed5c650fcd68d125',NULL,'0',NULL,NULL,'2021-12-29 18:01:21','2022-01-04 18:01:21',NULL,'1'),(165,8,NULL,'3fe0846fb02aa96154aab1fdecad6c4a',NULL,'0',NULL,NULL,'2021-12-29 19:02:20','2022-01-04 19:02:20',NULL,'1'),(167,8,NULL,'4352a03c0254a7c4c2ab8e148f85eb3d',NULL,'0',NULL,NULL,'2021-12-30 19:16:15','2022-01-05 19:16:15',NULL,'1'),(168,8,NULL,'891111280e3ceaa18c339a3bdd180e54',NULL,'0',NULL,NULL,'2022-01-03 09:48:01','2022-01-09 09:48:01',NULL,'1'),(169,8,NULL,'da5d15107e87b9a543a9a3397cb8c286',NULL,'0',NULL,NULL,'2022-01-03 09:55:47','2022-01-09 09:55:47',NULL,'1'),(171,8,NULL,'57ec2f5a7fbe8c215f93cf00a3a18a55',NULL,'0',NULL,NULL,'2022-01-03 13:52:27','2022-01-09 13:52:27',NULL,'1'),(172,8,NULL,'c938b003ab5ecc756bd15a2455aacb8f',NULL,'0',NULL,NULL,'2022-01-03 14:27:22','2022-01-09 14:27:22',NULL,'1'),(173,8,NULL,'5a2aabafb3ee3a37b68a6a1ad4628b36',NULL,'0',NULL,NULL,'2022-01-03 16:19:45','2022-01-09 16:19:45',NULL,'1'),(174,8,NULL,'a4a97572a8688d0e03ac2514a77e22c1',NULL,'0',NULL,NULL,'2022-01-03 17:08:49','2022-01-09 17:08:49',NULL,'1'),(175,8,NULL,'1bb1f5556ea72af92aa9400f0f5b307d',NULL,'0',NULL,NULL,'2022-01-03 17:31:21','2022-01-09 17:31:21',NULL,'1'),(176,8,NULL,'e6ab4b6e977e44e4e2d2c982f130523b',NULL,'0',NULL,NULL,'2022-01-03 18:00:46','2022-01-09 18:00:46',NULL,'1'),(178,4,NULL,'d361e16d6df50bd4af2ba9c158d7b3e5',NULL,'0',NULL,NULL,'2022-01-03 18:13:13','2022-01-09 18:13:13',NULL,'1'),(179,8,NULL,'8b76e8992538001607006c44049266e5',NULL,'0',NULL,NULL,'2022-01-03 18:37:41','2022-01-09 18:37:41',NULL,'1'),(180,8,NULL,'0dbe950dc4d0e72afadfc403098c84ed',NULL,'0',NULL,NULL,'2022-01-04 16:30:43','2022-01-10 16:30:43',NULL,'1'),(185,8,NULL,'b02fb12ee40472a13bc26bc3e56d847d','fQll2xdvQamo9xPJsECb9I:APA91bGcrjYCx86V2eBs1aac1Aw3_oPQrZCV7NWPICEs1XQd2_gPNVCQ9Mp5HxFAyY_kdqNSsZyBqzD9m2f8qT1heLWzc63vMJhH5bf5uA8oVbTReawlG1_3zAr6mk1b-LEqNicxs5jA','0',NULL,NULL,'2022-01-05 21:09:52','2022-01-11 21:09:52',NULL,'1'),(186,8,NULL,'9b0561f1695a4a1157d24fe68eac961c','cAAmYIQVSWmL2813kqpXln:APA91bFnTUEdWRNqGbIqDgWV0WwkD1flDlBa5tqSKktX4O_NFb5ZXWANNKyFM0v2vbmp4nabe0h2A2lXeE4OuAUfeftX_6yCYmTZTXDiKEZvPm8e6C51XmYso3uGOIUOhXWNjVo4fp3p','0',NULL,NULL,'2022-01-06 09:52:31','2022-01-12 09:52:31',NULL,'1'),(188,8,NULL,'8b7442dd707534a26c5a5e17a66ff09f',NULL,'0',NULL,NULL,'2022-01-06 10:35:51','2022-01-12 10:35:51',NULL,'1'),(190,8,NULL,'ce428fd9ad2bce719c85612653b92de7',NULL,'0',NULL,NULL,'2022-01-06 11:25:57','2022-01-12 11:25:57',NULL,'1'),(192,8,NULL,'7cc1a9cee37788e0e0c8023d75373bcd','fmnelf5rTMaSXCi2GNaFl8:APA91bFskNJuRXeIUKknr_MBr2KU4iftlu4JS89LGTX1_LnNcVhAuM3PjusHIxzIZGUnBgJF6UG44SypmnEQp6AKkXcn8YaDGgmYCJm6skD6ApkxQq84DbnAxSPYgIYWP-C_heqc15IR','0',NULL,NULL,'2022-01-06 11:37:24','2022-01-12 11:37:24',NULL,'1'),(193,4,NULL,'a1df4b122cc5ea9e03afdd4b2802be21',NULL,'0',NULL,NULL,'2022-01-06 12:18:04','2022-01-12 12:18:04',NULL,'1'),(194,8,NULL,'44494d8636f21d4ad9a78bf6037458a7','e7i9uF4MSOyKxXdzgjRbEW:APA91bF718CdfCQjvIFljvnmpkUbvsT_kendg69QkXAsocFU4fM6A35nBHRv8Yq6NIeZcIWOURYW-rolH6vyryVf_YcTnJN9kYDVukNsFW4B2T2piIj-XZf8Qlo8zsXEt5FQJsbfKL5Z','0',NULL,NULL,'2022-01-06 21:27:12','2022-01-12 21:27:12',NULL,'1'),(195,8,1,'e52287544a5c86cc4c5235e7b5ee78fa','cV9TCnSBS4yamYjEcfQc4m:APA91bELIlygqqhL0Y2NxHz3qUIjgSLbO5r3bQMN5BytTOSdcz0QZ0nCL0KKPEVCmznhV1Yyx4NKGKTDRlLfTx1OGUCjM6VZ_CgXzbvoQfy87x3VkLsBUJtrKU9iJ0KscKjHaS6HR-W6','0',NULL,NULL,'2022-01-07 10:13:57','2022-01-13 10:13:57',NULL,'1'),(201,1,1,'599d36185accb0188209fc76aa765486',NULL,'0',NULL,NULL,'2022-01-07 10:59:21','2022-01-13 10:59:21',NULL,'1'),(202,1,1,'b1b0c907df773689aeccecf49be29390',NULL,'0',NULL,NULL,'2022-01-07 11:24:37','2022-01-13 11:24:37',NULL,'1'),(203,1,1,'6c3b43ae90f17939af3be3087f00ace7',NULL,'0',NULL,NULL,'2022-01-07 11:30:35','2022-01-13 11:30:35',NULL,'1'),(204,1,1,'956d06d6c89d503bf6fd65a0549d7cb3',NULL,'0',NULL,NULL,'2022-01-07 11:31:19','2022-01-13 11:31:19',NULL,'1'),(206,1,3,'d6766cce382df267963ea573a2022dd5',NULL,'0',NULL,NULL,'2022-01-07 11:36:01','2022-01-13 11:36:01',NULL,'1'),(207,4,3,'338bca48a941dac3e4a7c89749ca2129',NULL,'0',NULL,NULL,'2022-01-07 11:36:21','2022-01-13 11:36:21',NULL,'1'),(209,8,1,'00c150d291bc234cd6a8acf29d1baba1','fQHrVBy9SH62DqQpfv2EmU:APA91bEVRHU1dk1m2aSce0wA3Q9tUyXnqhpA_de-rta0ZNlMaeR6PS2eNj5FJdORAn3fbAMAf0recMMvDxCrj8SMKr6aSL0fjsxt5FKczOSy_dGb2jJz1lwwQe0bLtZWjLVqH59rXa1f','0',NULL,NULL,'2022-01-07 17:39:35','2022-01-13 17:39:35',NULL,'1'),(210,8,1,'e097d6e12d1f14706887128afcf61ff7',NULL,'0',NULL,NULL,'2022-01-07 18:09:35','2022-01-13 18:09:35',NULL,'1'),(211,8,1,'b0a066d8da84e3c421c91dd25959a4c1','eFeS7vz4Q2-HHEAwQIwVtG:APA91bHPJ_gQ7KtzUWZ8MtTOO8MQ054GuPKdCWfrg0w7W_eOQjCbxCiuNCBxnB9hEQXtLXhPxdAaljPoyrw6-BJZ9I0yN9dh6UQkAXLr0PRNMlyouaFQDHzLDvJxWyyUH86CJP9LYHZ0','0',NULL,NULL,'2022-01-08 15:46:01','2022-01-14 15:46:01',NULL,'1'),(214,8,1,'ebd656fd4b11aedc4db376e2128aa049','d8rZTWhbTmichP215KRpcX:APA91bHweTtkqSM6XyregqKQHxzQ8yKqs1n8rq3ZBbUbaBWwCYM7gjZz1Uz_fprLgv4hqKhyb8fsoQ88OtSb-qwcuBYhUcdaeToBQo_WMLO1wjuLVYdrbqoPoc8dmwrsSupkmbIYDMgL','0',NULL,NULL,'2022-01-10 21:05:23','2022-01-16 21:05:23',NULL,'1'),(215,8,1,'6e8db0f96f10be4cd3d1c2f686c78b57','cRDwOZf6SAC0qqRMgDW87v:APA91bHLkLEiJSaADG-v5MFJ4LVgmq0YCyCWt-icfMyNUCjtlWnS8rAqhYK1ObLmxKO1Lktd2Q5qHR5yd7l44t9PdVGD6Xjwh0BRIMgGTk1TZOG9hG8ORQnnyq5XIo_OgXhyZmh7LVmq','0',NULL,NULL,'2022-01-10 21:58:11','2022-01-16 21:58:11',NULL,'1'),(216,8,1,'c00ad062668b2f612f5585342311689f','eN4M_Hc1TJuljptzMtO6b0:APA91bH8UzO77iRU7cB2kYfVlMXGI-Y0oV_2IGn22L-58oCO-q5LhMpy6tUEHqkVMOfMToH4ip12LxZvGIBkQOhGDfxb_HUA5zlqAjQUFw7h3BcwUNmURoQknw-0F0abaZAlh29qNMmm','0',NULL,NULL,'2022-01-10 22:20:29','2022-01-16 22:20:29',NULL,'1'),(218,8,1,'8078673d2bd7ac319e6684db1a85f9c3',NULL,'0',NULL,NULL,'2022-01-11 20:17:10','2022-01-17 20:17:10',NULL,'1'),(221,8,1,'f0b6d65e81db3b1396ee685b0973560a','eFeS7vz4Q2-HHEAwQIwVtG:APA91bHPJ_gQ7KtzUWZ8MtTOO8MQ054GuPKdCWfrg0w7W_eOQjCbxCiuNCBxnB9hEQXtLXhPxdAaljPoyrw6-BJZ9I0yN9dh6UQkAXLr0PRNMlyouaFQDHzLDvJxWyyUH86CJP9LYHZ0','0',NULL,NULL,'2022-01-12 14:55:30','2022-01-18 14:55:30',NULL,'1'),(222,8,1,'5d4fa4a0760cb00344628afe9aca462c','dByVXn2lQo67ia_FCUZoGy:APA91bGuTOT0LnmccCsgaF3Wo_9HXP66N45jUpKYHT-NewG2AQSCbe43d0i2h4hHhe-O-UgC4ep91JcPYNXJyS_vJlC3HAnH4QAAZUY3skzfc2HzLNJjy8Yk3ulsNT2l6XuTJhfyajoJ','0',NULL,NULL,'2022-01-12 16:20:48','2022-01-18 16:20:48',NULL,'1'),(223,8,1,'da5f97fb571897c8a64bba79a0a4e3d7','c-VVOVBfRp-UswNjbeDAC8:APA91bGADDST35GnUOWLT2bdsfttL9-P3owxk2NVeSD2WHOPB2hEBvq7YW7aKO46gh2JJkHg42p8y6KfnfDySGwRISzrXSn8F3oQdul3PTFy8t9QQuyDCswlrtwqyO-kDUAkloZtu7ci','0',NULL,NULL,'2022-01-12 19:10:49','2022-01-18 19:10:49',NULL,'1'),(224,8,1,'ba237855461d902e725e61b0edf97d5d','fCssWLXJQkijyB4hA-MRos:APA91bFIyK72ttjZyMGsagQQl1Thxz6G44DlqfsJTLhAZQZYFNN8dcDIhcLRIsWD3Qonx6whMPgHYNKcGiQnIol4r3Pgkhbpyan-5o4SIBqhiItYKBUjo_GgSZ4EcMOtwjfsePzjULQD','0',NULL,NULL,'2022-01-13 13:32:33','2022-01-19 13:32:33',NULL,'1'),(225,8,1,'8d2e50b48f33e80b47c3e629860bf120','cytK6FVVSQ-iIjyoegUdor:APA91bEg38Jnn5OBCKSeYpViNXSWxBEpcIKA3mY3R7qNah-glkZD8hMg92F8X2hM083m9TcGmHk4OSaGZMGVp8QR1T4ljkRcIi3UyZQl-HEJBEmg8UUiM45SQ-bVsXzub0de-1S3lR6n','0',NULL,NULL,'2022-01-13 13:48:39','2022-01-19 13:48:39',NULL,'1'),(227,8,1,'f90d4c6672728ff9ee31754784f626f4',NULL,'0',NULL,NULL,'2022-01-13 20:55:25','2022-01-19 20:55:25',NULL,'1'),(228,8,1,'958e11f4e6688a517936e673012f73ae','dKJ6wglVSUOybsKaWHtEw_:APA91bFsi6-tmJ_i1BKUZmi0P3zas3J-F5tSsw93h-rRrZ4knHT72dAM2ZxjBnyLgzinPlkUbfrp-EnDH-DR40U3R9CighzsmVSuwWHSi8HusIguNmUiNS0wPzDH9uFxJq-oLtTgKT7G','0',NULL,NULL,'2022-01-13 21:26:14','2022-01-19 21:26:14',NULL,'1'),(229,8,1,'28e887e43500f1a339eaa23f4fb931e3','enxidG22T_u2l62tOvCZ-0:APA91bEleBYnnQiL4y6oV-VOiau_Ov_KWk7cQp2s1ETdL3zqvwH7Jqk_k9-YbMprIlD0S_z0EcMmzgk1NktKecciFlgyZeGqwpz8_liISjp2l1elco5DOCJpDLHUw-5ViJMjNDT7_CmE','0',NULL,NULL,'2022-01-13 21:28:15','2022-01-19 21:28:15',NULL,'1'),(231,8,1,'74c5bd36833de5fec1521cd73388090d','fZclTHmDSQmpYVv24NSjKc:APA91bF-ATn_uC8LByn7fJjvhpfvZ3L-Q6QbXZLysIvO2GMo6Iaup5jHRjxMgFnVV-UM-2e2RzsphWYkTotNFrxpaW2qMb-q9Xo8lzpAXgh-2X6w4xatauY-EujPPMJvMQf2xCQQw0gH','0',NULL,NULL,'2022-01-14 12:51:06','2022-01-20 12:51:06',NULL,'1'),(232,8,1,'364306ac6ebf814a912f36fe4287f392','fZclTHmDSQmpYVv24NSjKc:APA91bF-ATn_uC8LByn7fJjvhpfvZ3L-Q6QbXZLysIvO2GMo6Iaup5jHRjxMgFnVV-UM-2e2RzsphWYkTotNFrxpaW2qMb-q9Xo8lzpAXgh-2X6w4xatauY-EujPPMJvMQf2xCQQw0gH','0',NULL,NULL,'2022-01-14 12:51:14','2022-01-20 12:51:14',NULL,'1'),(233,8,1,'07c417750832ab838ae65fe8e02889d0','cXfPth7BT9Cat_9zD1Ghpx:APA91bFhUB3AxWgwzzYD4YjpapMuFFyDrIWBSuJCgDo6K3JBXbbUReoQmjxmZPTLMFL_DYel19NrPzpC_fBP5GlZK07PFtAnlvcd0EdPAs_lq49YJ4qmJKDdfr-eofQU5BoEMX8i-vMv','0',NULL,NULL,'2022-01-14 16:53:11','2022-01-20 16:53:11',NULL,'1'),(234,8,1,'db784bef2e7c4268415c7d221b9a8f9d',NULL,'0',NULL,NULL,'2022-01-14 17:01:17','2022-01-20 17:01:17',NULL,'1'),(235,8,1,'240ba4d523a1fd32a3be7832f53fc172',NULL,'0',NULL,NULL,'2022-01-14 17:01:28','2022-01-20 17:01:28',NULL,'1'),(236,8,1,'289efa2cc465312697149b3cb9ea3a6a',NULL,'0',NULL,NULL,'2022-01-14 17:01:39','2022-01-20 17:01:39',NULL,'1'),(237,8,1,'8b17cce9a20e9a33a16d77401ae7df5f','enxidG22T_u2l62tOvCZ-0:APA91bE1OqBoK05jm9lEHNnI2wiyAbgC2wdmwmbknuaRbIuilTmQfM1P7kKg-4gHK9qzFZQFTaBZ9CDgh7jyA2oeeIxE8ghNrc7d-FBXpzjDnuieYiHXJZX0T6lsxrAPlkpP6IJcb7BX','0',NULL,NULL,'2022-01-14 17:02:04','2022-01-20 17:02:04',NULL,'1'),(238,8,1,'d4832212792db46a888a2b03bd809f96',NULL,'0',NULL,NULL,'2022-01-14 17:53:17','2022-01-20 17:53:17',NULL,'1'),(239,8,1,'d37ea1067d4c7e15aea4e7f22686242c','fzFwJepqSs2aSNsgrnplbn:APA91bHWKKQk8NnlibDk9_2RpmuUQXnjVIw_iGygdWa30WwIwRUxwUlYi-A0FQ7WZWju_cb2R_nj89cp7Rctw56ZOkrIA1bOXMnu8xhQpJe8nCv9QvRSx5Yz5c5f5ySyg_YRLFE0WBW_','0',NULL,NULL,'2022-01-14 20:55:49','2022-01-20 20:55:49',NULL,'1'),(241,8,2,'04c820060db0a4ac2eaa869ea758b1d0',NULL,'0',NULL,NULL,'2022-01-20 20:50:42','2022-01-26 20:50:42',NULL,'1'),(242,8,2,'602f299880a6f41c1234a825edae135f',NULL,'0',NULL,NULL,'2022-01-20 20:50:44','2022-01-26 20:50:44',NULL,'1'),(243,8,2,'e44f0de8252224415d81d429955b1bfc',NULL,'0',NULL,NULL,'2022-01-20 21:00:53','2022-01-26 21:00:53',NULL,'1'),(244,8,2,'e8a9823d51548b08dcc7659cf6168616',NULL,'0',NULL,NULL,'2022-01-20 21:10:19','2022-01-26 21:10:19',NULL,'1'),(249,8,1,'e2c3901193b39d0e5e7e0236a90d2435','dLMReie8Qxm15TBxVTlAVv:APA91bE0atK0WiRfSNqbwxWFztM3i6buwg-DwdcOppELS1iI7R-hCSUzvIcbLkpzWqqXwNQT0PXBDtJCm_cFCLW1_6i8feB3P589ofhQl-L1AN-uEA7CqhQ6IHtzug5SXxHICSuup_HJ','0',NULL,NULL,'2022-01-25 19:06:59','2022-01-31 19:06:59',NULL,'1'),(250,8,3,'f0025a8b9f3350de47b75810ae3047d2',NULL,'0',NULL,NULL,'2022-01-25 20:51:14','2022-01-31 20:51:14',NULL,'1'),(252,8,1,'f4b1501920ba124e01ebc62049b50637','chFWCP5cSkCkhB-8ZabCqC:APA91bHrlo6PKH3lDSB8kNayuiyuTEQ1fg8ajDj0w4saaB0UE_UN3HxbpC5vgGsdCFZhEhmbQlLE_JZ8scq_jzKgEoWNzEifurt_WcQX1roBnqCYYzhyqUdTDn6On_roMxnl6cFXnh9p','0',NULL,NULL,'2022-01-26 09:13:42','2022-02-01 09:13:42',NULL,'1'),(253,4,3,'4c7619dcd3abeee300221110522e3607',NULL,'0',NULL,NULL,'2022-01-26 16:48:01','2022-02-01 16:48:01',NULL,'1'),(255,8,1,'46fd70fd7aa6133a1a08057d0ba03b8e','f5lPnP55Rt2FdxPjEyC9Al:APA91bFcdQJkTyMJmQynvYd4sN--tnsi-PEo9l0c0MiVeHfdjE7S7zM_KfLU7ZQzmzTDIeqy4YKifkot2XqlEARkwtV9tZ597lnzA1BnCndBrB0ulAJrtMuMlkVSCeqiw0xD-ZsBW436','0',NULL,NULL,'2022-01-27 21:41:46','2022-02-02 21:41:46',NULL,'1'),(257,8,1,'b93ef2354c39730486b28953a0d45851','cbMpuO7vQ_upw1GoBpLkSh:APA91bFKKUCDG-FKeBCeDaQWI0F1atm_Xdfcmulm8xo1XUzzjOkNC6VkH4R81zHPBvYf--3lQqxTYFLv0fbrLFgDy8CmomRCg3ZdAO3O-U0gy75-Tzwe_P5BhjQLejDeZdxMFkvC8QUu','0',NULL,NULL,'2022-01-29 16:17:04','2022-02-04 16:17:04',NULL,'1'),(261,4,3,'ad77fcc97a8d65ac7c5c9efac8a72747',NULL,'0',NULL,NULL,'2022-01-29 19:40:53','2022-02-04 19:40:53',NULL,'1'),(262,8,3,'892c8e4aa30209de84625783051465e4',NULL,'0',NULL,NULL,'2022-01-31 12:23:17','2022-02-06 12:23:17',NULL,'1'),(264,8,1,'1ca15dd6bd10a1d6715637ff52b27430','c69j3rtASiqdtviEgneFMe:APA91bFr2Mmm1JpXSDZa8eEc4L_SW4_5qgx88jLi2nXA4fClMLgTMxCwN3qp_gnpNM13oWOlRw--PjQKxy_MIJQ_pZjbofsifeID5LSiUJyabHcXXymz_AmWHte-QaGdKA5oAsJwz1Mc','0',NULL,NULL,'2022-01-31 19:45:51','2022-02-06 19:45:51',NULL,'1'),(265,8,1,'b3af11bc5f17d88d948b1c10610de05c','e06q80caRaO6bxe3CoQqx1:APA91bE2cVnYL00CJwnCsfeRqSG5consn5NbBWqjSGeKETud2dMnZt-9rWl9bHioh1KJ1-ja--9a8XM7qbYBpKTZYwKEyhwkTED6mIkImNWjkL_puzXBxOwSQakMnI4x-9DWF3JhJLeV','0',NULL,NULL,'2022-02-01 20:26:32','2022-02-07 20:26:32',NULL,'1'),(266,4,3,'240a51559a7bac94d5a911fec377afce',NULL,'0',NULL,NULL,'2022-02-02 17:46:08','2022-02-08 17:46:08',NULL,'1'),(268,4,3,'c627ecec05130a9f5de401a9a19d30d4',NULL,'0',NULL,NULL,'2022-02-02 18:15:12','2022-02-08 18:15:12',NULL,'1'),(271,10,3,'dd7612057971ce87b5920a8ea390def2',NULL,'0',NULL,NULL,'2022-02-03 09:44:32','2022-02-09 09:44:32',NULL,'1'),(274,11,1,'4abbabdf97fae2331eb54d4bab210cfb','fJBlExkeQHqSs-0qTGfbUl:APA91bH0pYJwCLApRS_qBSc7E0OTTlEYJmd9nxUODD5oV1vIbCSLRs1Gnb_Fkaa4or_badRPHDrmrOkKERRJIs8qUbiWrObOLaKhEfiTU4eBOY2Fhsgv5V9oDhFZDg2h9EqFeFNKxKXo','0',NULL,NULL,'2022-02-03 10:08:04','2022-02-09 10:08:04',NULL,'1'),(278,12,1,'f149445324dd4d94c48c7030fc81f37d',NULL,'0',NULL,NULL,'2022-02-03 16:44:33','2022-02-09 16:44:33',NULL,'1'),(287,10,3,'7dc033c755708f08187f16acd09c89d1',NULL,'0',NULL,NULL,'2022-02-03 21:33:23','2022-02-09 21:33:23',NULL,'1'),(295,10,1,'3232ab5e4834766c0124b7e4353a9cc4','c12hiAY2S2e-Ay8jHLPVvK:APA91bGYX83OgaCeqFGbz_uV3a5BLS6X5FMzSIUSXVXzCFHMdBBBRzoaGL8XjiJsVT2JfaHPPJNASKzz4SPQmVGvknmIdabZYwepkgljBzToFDBCP327ofyDYfn8oDUK1j2EUtS0_xAy','0',NULL,NULL,'2022-02-03 22:11:47','2022-02-09 22:11:47',NULL,'1'),(296,13,1,'c618d45b6a65f2b1fd8be670d279b60c','erLw3FchSNKnbPG1UqNpuF:APA91bELYTqgQyeV4v2CQGHfcDl-iRLOaqn3lSYuG1XcJqTZHkMkK_rs7tEysEyt-2qzLb7Qo9YLluweSbQPZaboa-CRkaoHHLqDgSb_8N5NEgcx8O1x7ifpY1AbP6kIVgxA55YMCG-d','0',NULL,NULL,'2022-02-03 22:20:01','2022-02-09 22:20:01',NULL,'1'),(297,8,3,'3febf5fc2faaeae75e88a3127cfb09b4',NULL,'0',NULL,NULL,'2022-02-03 22:42:35','2022-02-09 22:42:35',NULL,'1'),(299,10,3,'a79c8db88fe8c8db54f662ea8f969d88',NULL,'0',NULL,NULL,'2022-02-03 22:47:33','2022-02-09 22:47:33',NULL,'1'),(300,10,3,'2c4800bb2ed2c6dd0f13fffb13bda3ee',NULL,'0',NULL,NULL,'2022-02-04 09:49:56','2022-02-10 09:49:56',NULL,'1'),(301,14,1,'c29dd6156a3577ad7194a2031ce6dbdb','fKeTn6BASPa05P4Q8brvWo:APA91bEGeqIKmDRca_y1PLMwibo4zbKBi64tqQLPNiCbD1tD08V-e9AAKptlFpkjbp2OZsvluivqLnnuPr1L5Dg-bPYpl-wFfQYN4swRcmfqJJmwh0Ax_VWxv_tELksP5ZEkEzxCYCij','0',NULL,NULL,'2022-02-04 17:25:49','2022-02-10 17:25:49',NULL,'1'),(302,13,1,'ef88025017d4dd5767bbfa87e46a0ee4','d_UbVBXyT3ih_DXlLvulLN:APA91bF7WzcyLBU5opCVLAqt4pWMWzwsTX6gAPekTWDWmXx37-DyiaqmCz6rp2kEKi68-qO_tuFjpJe7U-8quWnF_Nj8G0u6CgZS9VYMEjShdkYPELt4ygJEcli-_NMLAxWgptSyfHTv','0',NULL,NULL,'2022-02-04 17:33:33','2022-02-10 17:33:33',NULL,'1'),(303,8,3,'5686c0d8dcaf01d53e9ab4e465c6a47b',NULL,'0',NULL,NULL,'2022-02-04 17:44:55','2022-02-10 17:44:55',NULL,'1'),(304,10,3,'d5afd545fa329a894c7789f85ed85b8d',NULL,'0',NULL,NULL,'2022-02-04 17:53:35','2022-02-10 17:53:35',NULL,'1'),(305,10,3,'df88eccbe4a6fb3814e498c6b7fa220e',NULL,'0',NULL,NULL,'2022-02-07 17:22:54','2022-02-13 17:22:54',NULL,'1'),(306,10,3,'c7e7f36b3b9e9de14667f36ae176f6c2',NULL,'0',NULL,NULL,'2022-02-08 18:53:19','2022-02-14 18:53:19',NULL,'1'),(307,10,3,'c284a0100faff07ef5b14811505d1c33',NULL,'0',NULL,NULL,'2022-02-08 19:40:03','2022-02-14 19:40:03',NULL,'1'),(308,10,3,'be27c0bfa30e8f84d8e627fd68393b02',NULL,'0',NULL,NULL,'2022-02-12 15:58:56','2022-02-18 15:58:56',NULL,'1'),(309,10,3,'4d9e1ac48f0232d3697707ab88fabd0a',NULL,'0',NULL,NULL,'2022-02-12 18:32:02','2022-02-18 18:32:02',NULL,'1'),(310,13,1,'69e06b5ae804812756cffb5ea10306e8','dQTYvWX8QpOynmhEot8A7L:APA91bH0bumQPgMQ_CK-gV8hUr6NGCOwguAGzgN-_eYApBJwBFNHdQ8wfAbT2iOHOPMqAkv6cUmw9zVrAQLE0PnAbJZmK6Y8_DEWbgeXIMbGkpRE-_dj8oRrC6CDSNpou2GxDVmTir_q','0',NULL,NULL,'2022-02-12 19:57:50','2022-02-18 19:57:50',NULL,'1'),(311,10,3,'656c8b681828dc949902884f08379d48',NULL,'0',NULL,NULL,'2022-02-13 12:15:11','2022-02-19 12:15:11',NULL,'1'),(312,10,1,'cf7c32bbd0af2af3571186a30685244d','dzvXgNqpSByKPfqvbB35sa:APA91bExof6FJa4VQG0kMcYpXeBZRBOOtRzlZHuGmsPin85ToU0N31fCpK5YAvigMZLfoWaUePgZ9_4Svipe5JmFnCvG6s-xYTRYePpXrdx8Kx-9QSsC1hEY5CoAtWm5aqLglU3pRWCK','0',NULL,NULL,'2022-02-13 12:26:40','2022-02-19 12:26:40',NULL,'1'),(313,10,1,'3a8949b9b5c7730a2df239fadab2dfc8','cK-eLFWASa60XngULct3vo:APA91bFuvV6UcE5xmIQvQnDyvD1Smjshj96T51hAbx1XoGmUjba6CTjXi0I_aXbH4nWPeBCHqJHiEUD5Sdv_6nCxUDyDQiPpS-snZLj4v5l3nlfpshWN-HSuuiVbT7WTGh3pYfVArLxH','0',NULL,NULL,'2022-02-13 13:08:18','2022-02-19 13:08:18',NULL,'1'),(314,10,1,'074643f479d02ee05e91b93767c61821','eNTsSdToQMykPsVGCe8uG5:APA91bE9GZeA_Xnh2AlFTrQGZTUf41CYTkaLdBnHufY24VqhdIT0HSrK_7G5miTsu36j1mKV9th29IZNO2eJ9-enowkFE7HyVc5txkm2WKPHEpOx2YxbncubcSHrgt08hHAoIVZJ21yV','0',NULL,NULL,'2022-02-13 14:43:05','2022-02-19 14:43:05',NULL,'1'),(315,10,1,'1a5abd82d455d8788e8ab58ff2a601dd','eCFTQBjUTiix3IE0-uVJy3:APA91bHdVvNKt245LO8McgIYszyBFIwyV46ni3KS4vK1kStL0ZgJKecSE37YO-BYwL_Z2s-YnXGE-9PLR_gJCesRt59PUbyDLWyS0fxfxBRdtuABB-oLAOWCKE_rYWLkMHV9nGGcdCDF','0',NULL,NULL,'2022-02-13 18:45:40','2022-02-19 18:45:40',NULL,'1'),(316,10,1,'29eb456e07d6bf4419ed6b263d9d011e','fCs7JqpjSR-YFAXB5RHHK7:APA91bG3KWhL87YYIqUTK36DJEhQg9W2tMw5fzQMGxAWNuRoImEmaabmSZMbFipM26kobXawhU56vVa8mmFafHr-eRHwFw6i0dFLNvSUNuzHab7BEGO2zlhSno8Q9Wj8-H8MFHGcrt1f','0',NULL,NULL,'2022-02-13 18:52:57','2022-02-19 18:52:57',NULL,'1'),(317,10,1,'d1007a0b0ec4fe9886f1e9c9fe494eb4','c50iYaSfRhOMwdQYx-PU7-:APA91bHbFaWc2E5Z7tw_Xgrr2b66wzLqIe3sOlt-OdZMiutkXLyI_76lCT8YiH8eCiOPAL9mMHC5kjxLuuFS3gIYvBi0-jSR3bJlaPzfFtkkPd0q2Oa7Wmh-_nShhE_b-Xe0UilyNGF5','0',NULL,NULL,'2022-02-13 19:03:01','2022-02-19 19:03:01',NULL,'1'),(318,10,3,'9b1aa4be6c13090731e3d7f46544cbb2',NULL,'0',NULL,NULL,'2022-02-13 21:51:24','2022-02-19 21:51:24',NULL,'1'),(319,13,1,'0f942933954020a1879a0dc78cbcc727','dK2crl6ETyGIRD3ehKr84w:APA91bEt9hWdN2068DGcea04zzfbMMbqFRLsnV8DZt2iDmZPsgxssYv3gyuqo91x3YBX614uRJ4wwALqEOWX_1XpDFVa8JQ8x67ZgK7iu6Vm6KUKQF3g5uv5JxERhcCpio3zOHUWoPK_','0',NULL,NULL,'2022-02-14 11:40:48','2022-02-20 11:40:48',NULL,'1'),(320,10,3,'234119fe3768f3b6d83fb4f07346afe3',NULL,'0',NULL,NULL,'2022-02-14 16:31:53','2022-02-20 16:31:53',NULL,'1'),(321,10,3,'b50941e7a2fd6fd8784d575f2b43f827',NULL,'0',NULL,NULL,'2022-02-14 18:16:03','2022-02-20 18:16:03',NULL,'1'),(322,15,1,'268c821cb1f0d66d825f260cbf0f5068','eUJwVSsiQwC7nLa88MS3-1:APA91bEkaO4zASYEUBvXLe_gxtUIisHMHDsvxafMJljHrogLr5XjiPiI4baJgCZ4BkpfwimummmZnPN75I_EJ4vmPCDNu3Voy1wvHI9aHsRQy1M4wVby1RKgZjtHq6S-isP9ia5bBQ93','0',NULL,NULL,'2022-02-14 18:33:42','2022-02-20 18:33:42',NULL,'1'),(323,10,3,'ce51a2d0a3535d6327c043935b02cf04',NULL,'0',NULL,NULL,'2022-02-14 22:27:22','2022-02-20 22:27:22',NULL,'1'),(324,10,1,'e6fe7f00fce6d817209b6bc7a0a56398','c-baiqvpTJitIUeV55MDRk:APA91bF8lddb_8m5x33zVNjqO0m6ZwnFIoqDWvds1N9nn0QoCAs3BCLGmp8yxLJ18U_JFgBbfI2A2sv-yjFG99_xA_B86GJcPL_WoHD-MVg1geuE6JC05IoLIGxffJVfN-_GpSX6iRSx','0',NULL,NULL,'2022-02-15 09:30:11','2022-02-21 09:30:11',NULL,'1'),(325,14,1,'efcba6102bcaeee125431badb9ea8622','dOA8QZhMTD-6WXyANL1A8M:APA91bHZ82dE9cNjP-h_ET6BBEqoFObk62YvkYqYB5Oymsnzf_a_A1_ZhvvArQLaqUBhRyr1k_rfpo90HDZ4h5firPke_SGovUht1mmFXjjawGqqn9qyGIBvT58er8d2cJylPu1OStUi','0',NULL,NULL,'2022-02-15 10:20:42','2022-02-21 10:20:42',NULL,'1'),(326,10,1,'ef0d4a4434087a20e4115eba9125aafb','c3Ocrl9VS4OYuTQLlIG7a9:APA91bHsJaxOTAdb6PrBkpmQ-UvV0eSnlhWJmqWsxHMnchmuVi4AeqGMgfFb4lh5L2DsJ3J17ZPVEZhNUTjxEKNqgC7TwTUUWRVHAVHSMiM9BxPUVN1ZehO5aIUfox8sprsWtWue7cLZ','0',NULL,NULL,'2022-02-15 10:43:03','2022-02-21 10:43:03',NULL,'1'),(328,10,3,'1864d0c827db0a2a4a5e0be03b5146c7',NULL,'0',NULL,NULL,'2022-02-15 11:35:28','2022-02-21 11:35:28',NULL,'1'),(329,10,3,'7eb4644b7cbb668ba6561b0a1d8ff2b1',NULL,'0',NULL,NULL,'2022-02-15 11:46:35','2022-02-21 11:46:35',NULL,'1'),(330,10,3,'f07eafc76fd9ae4cfeaaa7920bb278f5',NULL,'0',NULL,NULL,'2022-02-15 11:55:40','2022-02-21 11:55:40',NULL,'1'),(331,1,1,'af30eb6800779f724e85d65cd54601bd',NULL,'0',NULL,NULL,'2022-06-05 15:01:52','2022-12-05 15:01:52',NULL,'1');
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokenproveedor`
--

DROP TABLE IF EXISTS `tokenproveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokenproveedor` (
  `tokenproveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `platform_id` int(11) DEFAULT NULL,
  `tokenproveedor_valor` varchar(500) DEFAULT NULL,
  `tokenproveedor_fcm` varchar(200) DEFAULT NULL,
  `tokenproveedor_debeexpirar` char(1) DEFAULT NULL,
  `tokenproveedor_deviceid` varchar(45) DEFAULT NULL,
  `tokenproveedor_device` varchar(45) DEFAULT NULL,
  `tokenproveedor_fecha` datetime DEFAULT NULL,
  `tokenproveedor_fechaexpiracion` datetime DEFAULT NULL,
  `tokenproveedor_version` varchar(10) DEFAULT NULL,
  `tokenproveedor_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`tokenproveedor_id`),
  KEY `fk_tokenproveedor_login1_idx` (`login_id`),
  KEY `fk_tokenproveedor_platform1_idx` (`platform_id`),
  CONSTRAINT `fk_tokenproveedor_login1` FOREIGN KEY (`login_id`) REFERENCES `login` (`login_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tokenproveedor_platform1` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`platform_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokenproveedor`
--

LOCK TABLES `tokenproveedor` WRITE;
/*!40000 ALTER TABLE `tokenproveedor` DISABLE KEYS */;
INSERT INTO `tokenproveedor` VALUES (1,1,NULL,'5da054d60d9dfdbe924f63cddc383083',NULL,'0',NULL,NULL,'2021-12-14 11:36:46','2021-12-20 11:36:46',NULL,'1'),(2,1,NULL,'461146f55613506c60635ce267e6a6e6',NULL,'0',NULL,NULL,'2021-12-14 11:38:16','2021-12-20 11:38:16',NULL,'1'),(3,1,NULL,'f3deb0de020e40ce41a225eaa872bd65',NULL,'0',NULL,NULL,'2021-12-14 11:40:19','2021-12-20 11:40:19',NULL,'1'),(4,1,NULL,'5f391b9ea6ac23127fe498066eadf6fa',NULL,'0',NULL,NULL,'2021-12-14 11:41:56','2021-12-20 11:41:56',NULL,'1'),(5,1,NULL,'b085c8b6a9b53d8d5bb86bcd1ecc9c89',NULL,'0',NULL,NULL,'2021-12-14 12:17:38','2021-12-20 12:17:38',NULL,'1'),(6,1,NULL,'7d29621ac2c77a38af87b5848aa410da',NULL,'0',NULL,NULL,'2021-12-14 12:34:51','2021-12-20 12:34:51',NULL,'1'),(7,1,NULL,'ed115ff916041c91b54130b3996b9d66',NULL,'0',NULL,NULL,'2021-12-14 13:53:42','2021-12-20 13:53:42',NULL,'1'),(8,1,NULL,'497fdcf16c350c2ae70b00d5d52100c9',NULL,'0',NULL,NULL,'2021-12-15 13:15:29','2021-12-21 13:15:29',NULL,'1'),(9,1,NULL,'daf7a28ccc4209a2b6970bc69b4723db',NULL,'0',NULL,NULL,'2021-12-15 17:39:25','2021-12-21 17:39:25',NULL,'1'),(10,1,NULL,'5e9a584407266dc03725c57109f29365',NULL,'0',NULL,NULL,'2021-12-16 13:46:45','2021-12-22 13:46:45',NULL,'1'),(11,1,NULL,'551019d9fef906c2a242cedeaa69d506',NULL,'0',NULL,NULL,'2021-12-17 17:02:44','2021-12-23 17:02:44',NULL,'1'),(12,1,NULL,'28c9b3e8df9ccc30919a50f56921eb6d',NULL,'0',NULL,NULL,'2021-12-17 19:04:43','2021-12-23 19:04:43',NULL,'1'),(13,1,NULL,'0d2d9898d659f35a58a80a37bdd83e47',NULL,'0',NULL,NULL,'2021-12-17 20:47:43','2021-12-23 20:47:43',NULL,'1'),(14,1,NULL,'229ee67bc9a6357e183eba534fbb8154',NULL,'0',NULL,NULL,'2021-12-18 09:34:37','2021-12-24 09:34:37',NULL,'1'),(15,1,NULL,'83bf87fca27f173a94a7666d010a0516',NULL,'0',NULL,NULL,'2021-12-19 19:50:01','2021-12-25 19:50:01',NULL,'1'),(16,1,NULL,'6d653f6cdb2274a0b7e7c014e1c9b9b2',NULL,'0',NULL,NULL,'2021-12-20 10:06:30','2021-12-26 10:06:30',NULL,'1'),(17,1,NULL,'0300b3e118450ee91a3459776ceac7c9',NULL,'0',NULL,NULL,'2021-12-21 12:14:08','2021-12-27 12:14:08',NULL,'1'),(18,1,NULL,'d67acd05aad33b68bbe5fd4106aeb11a',NULL,'0',NULL,NULL,'2021-12-21 12:34:37','2021-12-27 12:34:37',NULL,'1'),(19,1,NULL,'6a7f275175378ddf2c5c1b4d49960a71',NULL,'0',NULL,NULL,'2021-12-21 14:28:37','2021-12-27 14:28:37',NULL,'1'),(20,1,NULL,'b86d13ff4fb2322500aa6235175c88b7',NULL,'0',NULL,NULL,'2021-12-22 21:34:02','2021-12-28 21:34:02',NULL,'1'),(21,1,NULL,'398303efa563c2fac7bfacf514a26792',NULL,'0',NULL,NULL,'2021-12-23 12:46:49','2021-12-29 12:46:49',NULL,'1'),(22,2,NULL,'6ce5dfc532d483d2f1b37c753f22783f',NULL,'0',NULL,NULL,'2021-12-23 21:40:32','2021-12-29 21:40:32',NULL,'1'),(23,1,NULL,'b800c6d816e0ff23ebcbc7447cec59a3',NULL,'0',NULL,NULL,'2021-12-23 21:42:01','2021-12-29 21:42:01',NULL,'1'),(24,1,NULL,'ee0d75d8e4a999a0587de8920f764ffe',NULL,'0',NULL,NULL,'2021-12-24 09:47:39','2021-12-30 09:47:39',NULL,'1'),(25,1,NULL,'0766773c76e2f3b4b5885ff70c75e151',NULL,'0',NULL,NULL,'2021-12-24 11:12:40','2021-12-30 11:12:40',NULL,'1'),(26,1,NULL,'39063ad35fc6d262aa063b6ef36ad8a5',NULL,'0',NULL,NULL,'2021-12-24 17:32:31','2021-12-30 17:32:31',NULL,'1'),(27,1,NULL,'5cd8a0be0d9d6d23fc84f0781033cb95',NULL,'0',NULL,NULL,'2021-12-27 17:53:04','2022-01-02 17:53:04',NULL,'1'),(28,1,NULL,'75234e2bbf55018314283e4e85e9f337',NULL,'0',NULL,NULL,'2021-12-27 18:03:46','2022-01-02 18:03:46',NULL,'1'),(29,1,NULL,'f4077de96d78e613362e548c0c8ff0bd',NULL,'0',NULL,NULL,'2021-12-28 11:39:58','2022-01-03 11:39:58',NULL,'1'),(30,1,NULL,'86c58077d42b88d17ca67bc9eda2eda4',NULL,'0',NULL,NULL,'2021-12-28 11:41:36','2022-01-03 11:41:36',NULL,'1'),(31,1,NULL,'7cc63facd9729885734d515d6355a218',NULL,'0',NULL,NULL,'2021-12-28 11:43:44','2022-01-03 11:43:44',NULL,'1'),(32,1,NULL,'becfdecf6000ac32d634610c9c9a2d16',NULL,'0',NULL,NULL,'2021-12-29 15:13:08','2022-01-04 15:13:08',NULL,'1'),(33,1,NULL,'e1f4d7883c255b780aeeeb858fe44b46',NULL,'0',NULL,NULL,'2021-12-29 16:09:00','2022-01-04 16:09:00',NULL,'1'),(34,3,NULL,'f6382ebffc11e22c6e8f6d3fe73b7180',NULL,'0',NULL,NULL,'2021-12-29 17:33:29','2022-01-04 17:33:29',NULL,'1'),(35,1,NULL,'bf33d977adc12d6abeee5ff8a6eb7d19',NULL,'0',NULL,NULL,'2021-12-29 17:39:38','2022-01-04 17:39:38',NULL,'1'),(36,3,NULL,'e9ef07a003d58ef09dbcd6583d9c11bd',NULL,'0',NULL,NULL,'2021-12-29 17:48:53','2022-01-04 17:48:53',NULL,'1'),(37,3,NULL,'77af85be4cdfa8567e76abdf65b4f981',NULL,'0',NULL,NULL,'2021-12-29 19:18:24','2022-01-04 19:18:24',NULL,'1'),(38,1,NULL,'73c4c24f1879c2ab20b84f8ffa1965db',NULL,'0',NULL,NULL,'2021-12-29 23:38:45','2022-01-04 23:38:45',NULL,'1'),(39,3,NULL,'a60dc14fc63247354b92a788e35fa37d',NULL,'0',NULL,NULL,'2022-01-01 14:39:16','2022-01-07 14:39:16',NULL,'1'),(40,3,NULL,'4efaca1eb805a780d502a3082423017f',NULL,'0',NULL,NULL,'2022-01-04 22:45:26','2022-01-10 22:45:26',NULL,'1'),(41,1,NULL,'6246b5f7e0ddebef3081898166e094c8',NULL,'0',NULL,NULL,'2022-01-05 21:05:36','2022-01-11 21:05:36',NULL,'1'),(42,1,NULL,'8623fef54023f468cda9feba46d25be3',NULL,'0',NULL,NULL,'2022-01-06 12:38:49','2022-01-12 12:38:49',NULL,'1'),(43,1,NULL,'681a98b28f7d7c737f53724912cecbe5',NULL,'0',NULL,NULL,'2022-01-06 16:27:10','2022-01-12 16:27:10',NULL,'1'),(44,1,1,'6ac33997c3d5eb0afee2253c9c3e4c75',NULL,'0',NULL,NULL,'2022-01-07 16:55:02','2022-01-13 16:55:02',NULL,'1'),(45,1,1,'0e8727acfca23f9b977d56da4e17e525',NULL,'0',NULL,NULL,'2022-01-07 17:30:23','2022-01-13 17:30:23',NULL,'1'),(46,1,1,'488cb55effac3ae4b1085209843aeb5f',NULL,'0',NULL,NULL,'2022-01-08 10:45:25','2022-01-14 10:45:25',NULL,'1'),(47,1,1,'af526e945dce742c03c6dbe2ff5e1aed',NULL,'0',NULL,NULL,'2022-01-10 21:09:33','2022-01-16 21:09:33',NULL,'1'),(48,4,1,'55403e5f7bf16df43405d14a94cf3691',NULL,'0',NULL,NULL,'2022-01-10 21:10:23','2022-01-16 21:10:23',NULL,'1'),(49,3,1,'22415faa4ed4b3dc737063db26e2e4a1',NULL,'0',NULL,NULL,'2022-01-10 21:11:26','2022-01-16 21:11:26',NULL,'1'),(50,3,1,'b19cb8df093ab3568a39b7e23b107bb3',NULL,'0',NULL,NULL,'2022-01-10 21:26:46','2022-01-16 21:26:46',NULL,'1'),(51,1,1,'0447a03476322e439b6a13a2c1b0b036',NULL,'0',NULL,NULL,'2022-01-11 20:20:35','2022-01-17 20:20:35',NULL,'1'),(52,4,1,'8f9148ec1b049b83fecb9263ec3becf7',NULL,'0',NULL,NULL,'2022-01-11 21:00:21','2022-01-17 21:00:21',NULL,'1'),(53,1,1,'c693a30a92db810342f3c7bec45ec1f1',NULL,'0',NULL,NULL,'2022-01-11 21:02:12','2022-01-17 21:02:12',NULL,'1'),(54,1,1,'3b51fcf1ee243810cd21a8bcf10655c2',NULL,'0',NULL,NULL,'2022-01-12 11:22:19','2022-01-18 11:22:19',NULL,'1'),(55,3,1,'94df28c26f434dadfe5aa23a8708b05e',NULL,'0',NULL,NULL,'2022-01-12 19:45:24','2022-01-18 19:45:24',NULL,'1'),(56,1,1,'1511c8657c41d75596e86d108dd62346',NULL,'0',NULL,NULL,'2022-01-13 15:46:43','2022-01-19 15:46:43',NULL,'1'),(57,1,1,'64cea07b7eddecb0766439c47878d416',NULL,'0',NULL,NULL,'2022-01-13 16:26:32','2022-01-19 16:26:32',NULL,'1'),(58,1,1,'6495d869b549f03ffed183370ab1d158',NULL,'0',NULL,NULL,'2022-01-13 18:04:01','2022-01-19 18:04:01',NULL,'1'),(59,1,1,'3aa96cd71ebeb3e076b89ba15d21af81',NULL,'0',NULL,NULL,'2022-01-13 18:16:11','2022-01-19 18:16:11',NULL,'1'),(60,1,1,'dcb41dd422afb2b825d1c5b97c48cce9',NULL,'0',NULL,NULL,'2022-01-13 19:55:04','2022-01-19 19:55:04',NULL,'1'),(61,1,1,'a15a96f936802649bee260116c17a152',NULL,'0',NULL,NULL,'2022-01-13 20:38:56','2022-01-19 20:38:56',NULL,'1'),(62,4,1,'484b0c6c62cedcacb3f2d3884aa39747',NULL,'0',NULL,NULL,'2022-01-13 21:17:18','2022-01-19 21:17:18',NULL,'1'),(63,3,1,'2379670545d070dfb34db81ed01931e8',NULL,'0',NULL,NULL,'2022-01-13 21:20:16','2022-01-19 21:20:16',NULL,'1'),(64,1,1,'16e1b526c8a989a6e0658c356048ae50',NULL,'0',NULL,NULL,'2022-01-14 09:54:58','2022-01-20 09:54:58',NULL,'1'),(65,1,1,'0c01e92b515b64fe08634fe8aec574d3',NULL,'0',NULL,NULL,'2022-01-14 09:57:48','2022-01-20 09:57:48',NULL,'1'),(66,3,1,'ac365e18beab4d4554451081f62a4fd9',NULL,'0',NULL,NULL,'2022-01-14 13:02:07','2022-01-20 13:02:07',NULL,'1'),(67,1,1,'cd116a86df6a60986684dc7abce3de06',NULL,'0',NULL,NULL,'2022-01-14 16:55:29','2022-01-20 16:55:29',NULL,'1'),(68,1,1,'7484c12e647b92f4a68192408873e781',NULL,'0',NULL,NULL,'2022-01-14 20:54:33','2022-01-20 20:54:33',NULL,'1'),(69,1,1,'8faf1200e8497daaa98e2a9858aceeaa',NULL,'0',NULL,NULL,'2022-01-14 20:55:17','2022-01-20 20:55:17',NULL,'1'),(70,1,1,'c65081963fc182997194407103ab1b92',NULL,'0',NULL,NULL,'2022-01-14 21:42:25','2022-01-20 21:42:25',NULL,'1'),(71,1,1,'d2ae750bf7e2e5111535be7ce3ca8419',NULL,'0',NULL,NULL,'2022-01-15 10:02:04','2022-01-21 10:02:04',NULL,'1'),(72,1,1,'35007b071cc8afe2f3c9348c67f7f82a',NULL,'0',NULL,NULL,'2022-01-20 21:23:33','2022-01-26 21:23:33',NULL,'1'),(73,1,1,'bc1b505d1b9653429abadeda853123f7',NULL,'0',NULL,NULL,'2022-01-21 09:36:38','2022-01-27 09:36:38',NULL,'1'),(74,1,1,'562ab129e5fb604a9ccb8eb2b92a290a',NULL,'0',NULL,NULL,'2022-01-21 23:11:56','2022-01-27 23:11:56',NULL,'1'),(75,1,1,'79cdaf1966899adddbf1811c57774107',NULL,'0',NULL,NULL,'2022-01-26 16:57:30','2022-02-01 16:57:30',NULL,'1'),(76,4,1,'2b669d2cb5b06c3512a5758fb457211c',NULL,'0',NULL,NULL,'2022-01-26 19:18:52','2022-02-01 19:18:52',NULL,'1'),(77,3,1,'25d122aaf5b6be2e9ecfad321bee848d',NULL,'0',NULL,NULL,'2022-01-26 19:51:04','2022-02-01 19:51:04',NULL,'1'),(78,1,1,'c7018c913cb64f6b21ed43a52635e9d0',NULL,'0',NULL,NULL,'2022-01-27 19:32:03','2022-02-02 19:32:03',NULL,'1'),(79,3,1,'bf8e0584e6738f0b3464bc65c84688c1',NULL,'0',NULL,NULL,'2022-01-29 16:18:03','2022-02-04 16:18:03',NULL,'1'),(80,1,1,'3af3fb380c012e24f016deb5fb15d530',NULL,'0',NULL,NULL,'2022-01-29 18:42:51','2022-02-04 18:42:51',NULL,'1'),(81,1,1,'be8eb34b59c3f7c3c63dd53dce8d3ef2',NULL,'0',NULL,NULL,'2022-01-29 19:57:17','2022-02-04 19:57:17',NULL,'1'),(82,1,1,'0ff1b1a1482d9c97107b1f963388d675',NULL,'0',NULL,NULL,'2022-01-29 20:22:24','2022-02-04 20:22:24',NULL,'1'),(83,1,1,'7848195d9cd3472f93364415b0eafd90',NULL,'0',NULL,NULL,'2022-01-31 11:43:05','2022-02-06 11:43:05',NULL,'1'),(84,1,1,'230fd0f33b7fd5ef42ce00ccb0f2f60b',NULL,'0',NULL,NULL,'2022-01-31 12:47:46','2022-02-06 12:47:46',NULL,'1'),(85,1,1,'7fc68a93e668a7d7eee1f4eef0e1e74a',NULL,'0',NULL,NULL,'2022-01-31 12:55:01','2022-02-06 12:55:01',NULL,'1'),(86,1,1,'8e0757cd7c5d62be1f89c30aefc17e85',NULL,'0',NULL,NULL,'2022-01-31 18:40:22','2022-02-06 18:40:22',NULL,'1'),(87,1,1,'a3a2e9a0bd47921d78b0e64c6bfcbe2a',NULL,'0',NULL,NULL,'2022-01-31 18:47:08','2022-02-06 18:47:08',NULL,'1'),(88,1,1,'571f042e0f0f28f687c18d852f5ce7ca',NULL,'0',NULL,NULL,'2022-01-31 18:48:13','2022-02-06 18:48:13',NULL,'1'),(89,1,1,'1905c769ab46f893c75e55d11cc485c3',NULL,'0',NULL,NULL,'2022-01-31 19:19:20','2022-02-06 19:19:20',NULL,'1'),(90,1,1,'ddb848089fcb817dcd06b76788bd6c4f',NULL,'0',NULL,NULL,'2022-01-31 19:34:56','2022-02-06 19:34:56',NULL,'1'),(91,1,1,'c12ff871461c29cbf95737cc8a2b6b43',NULL,'0',NULL,NULL,'2022-02-01 00:09:33','2022-02-07 00:09:33',NULL,'1'),(92,1,1,'aa90b34f34e73a7d787f661c332b35ef',NULL,'0',NULL,NULL,'2022-02-01 00:36:59','2022-02-07 00:36:59',NULL,'1'),(93,1,1,'45b7391c7d222f83efa94ca15728ac14',NULL,'0',NULL,NULL,'2022-02-02 10:13:05','2022-02-08 10:13:05',NULL,'1'),(94,1,1,'02da481990f11b081069476dd1384a7b',NULL,'0',NULL,NULL,'2022-02-02 10:26:21','2022-02-08 10:26:21',NULL,'1'),(95,1,1,'d96fdb4f2d9f02ddffefd9d1b939304d',NULL,'0',NULL,NULL,'2022-02-02 17:12:45','2022-02-08 17:12:45',NULL,'1'),(96,1,1,'5f1f150f6aadaae3c2a5c63dff58383e',NULL,'0',NULL,NULL,'2022-02-02 17:18:16','2022-02-08 17:18:16',NULL,'1'),(97,3,1,'4f747e6496fd99d5deb4ddf94bc1435e',NULL,'0',NULL,NULL,'2022-02-03 17:38:57','2022-02-09 17:38:57',NULL,'1'),(98,1,1,'01422192e3cf9b36c898e1d2e69db1d2',NULL,'0',NULL,NULL,'2022-02-03 21:57:06','2022-02-09 21:57:06',NULL,'1'),(99,3,1,'5c51c9dd18e3b9de679488ecf75eb440',NULL,'0',NULL,NULL,'2022-02-03 22:07:39','2022-02-09 22:07:39',NULL,'1'),(100,3,1,'23d274c4113ddcc30ddf34c2c99b91b1',NULL,'0',NULL,NULL,'2022-02-03 23:19:37','2022-02-09 23:19:37',NULL,'1'),(101,1,1,'5c9c64b81b5742cd27896cee5e7dc5ad',NULL,'0',NULL,NULL,'2022-02-03 23:24:16','2022-02-09 23:24:16',NULL,'1'),(102,1,1,'4a05a07cbb178f2a4c9753fab0014bca',NULL,'0',NULL,NULL,'2022-02-03 23:36:48','2022-02-09 23:36:48',NULL,'1'),(103,1,1,'67ca9e06064ccc4efeea8f7046dd411c',NULL,'0',NULL,NULL,'2022-02-04 10:32:45','2022-02-10 10:32:45',NULL,'1'),(104,3,1,'56ff5a50012e2d353fb02f8ddafecdfa',NULL,'0',NULL,NULL,'2022-02-04 13:36:00','2022-02-10 13:36:00',NULL,'1'),(105,1,1,'26dd3bb965cf25d4e876627333c0f7a3',NULL,'0',NULL,NULL,'2022-02-04 13:39:05','2022-02-10 13:39:05',NULL,'1'),(106,3,1,'f33192228e7f5dfc6e1b2546a7f6817b',NULL,'0',NULL,NULL,'2022-02-04 17:22:29','2022-02-10 17:22:29',NULL,'1'),(107,4,1,'53f5899a070f7933dc4772ebc0e9a73d',NULL,'0',NULL,NULL,'2022-02-04 17:25:57','2022-02-10 17:25:57',NULL,'1'),(108,3,1,'f083ee3979c70625922d2c6b4d5d43ae',NULL,'0',NULL,NULL,'2022-02-04 17:53:23','2022-02-10 17:53:23',NULL,'1'),(109,4,1,'46d46cf3486f0ddb5bb37c5eb39a83c9',NULL,'0',NULL,NULL,'2022-02-04 17:54:06','2022-02-10 17:54:06',NULL,'1'),(110,4,1,'bcc3860f50a706070b587b930da6caa7',NULL,'0',NULL,NULL,'2022-02-04 18:02:22','2022-02-10 18:02:22',NULL,'1'),(111,1,1,'659aaccb6984473e14fab8818a9bd6d9',NULL,'0',NULL,NULL,'2022-02-04 18:16:41','2022-02-10 18:16:41',NULL,'1'),(112,1,1,'2c361779863199f8a4489ad3824d33ff',NULL,'0',NULL,NULL,'2022-02-07 16:12:37','2022-02-13 16:12:37',NULL,'1'),(113,1,1,'99f3a21d112cd62ff06ebb0b12a9aa2b',NULL,'0',NULL,NULL,'2022-02-07 21:54:12','2022-02-13 21:54:12',NULL,'1'),(114,1,1,'39f77273f74d35ab8b904616fb603f4c',NULL,'0',NULL,NULL,'2022-02-08 12:32:44','2022-02-14 12:32:44',NULL,'1'),(115,1,1,'d0b9311c882cbd8db34ccedd56871d13',NULL,'0',NULL,NULL,'2022-02-08 19:18:46','2022-02-14 19:18:46',NULL,'1'),(116,1,1,'c44a339f8ffd67fe9f70721f16d5dc9e',NULL,'0',NULL,NULL,'2022-02-09 18:43:51','2022-02-15 18:43:51',NULL,'1'),(117,3,1,'e123993973d616caeb1ce15158bfc34f',NULL,'0',NULL,NULL,'2022-02-09 23:41:28','2022-02-15 23:41:28',NULL,'1'),(118,1,1,'336b3663e9d33ef0093285546745d944',NULL,'0',NULL,NULL,'2022-02-11 09:50:31','2022-02-17 09:50:31',NULL,'1'),(119,1,1,'95a7f93e85dd985e45df194e2b071ba6',NULL,'0',NULL,NULL,'2022-02-11 10:28:55','2022-02-17 10:28:55',NULL,'1'),(120,1,1,'6b758a678565e8dc0e76cdb45a8f0da6',NULL,'0',NULL,NULL,'2022-02-11 14:26:44','2022-02-17 14:26:44',NULL,'1'),(121,4,1,'facd27cb747ad1a18011e4dc5b11b4f9',NULL,'0',NULL,NULL,'2022-02-12 20:23:51','2022-02-18 20:23:51',NULL,'1'),(122,1,1,'9acbcf6454411ee22671a27c9b99e831',NULL,'0',NULL,NULL,'2022-02-14 11:36:10','2022-02-20 11:36:10',NULL,'1'),(123,1,1,'2f72975825b92b0fbba0e1eee6bc01ce',NULL,'0',NULL,NULL,'2022-02-14 22:11:11','2022-02-20 22:11:11',NULL,'1'),(124,1,1,'2b0e7f2eecc441856d574a9765026fdc',NULL,'0',NULL,NULL,'2022-02-15 10:55:19','2022-02-21 10:55:19',NULL,'1'),(125,1,1,'0e7779a1a94e05f9e6b3f89320f95906',NULL,'0',NULL,NULL,'2022-02-15 11:19:47','2022-02-21 11:19:47',NULL,'1'),(126,1,1,'c7444e73f26ebab155b6d815e39b1244',NULL,'0',NULL,NULL,'2022-02-15 11:31:25','2022-02-21 11:31:25',NULL,'1'),(127,1,1,'51b26b93e7cd10258a226e74f8701e51',NULL,'0',NULL,NULL,'2022-02-15 11:37:19','2022-02-21 11:37:19',NULL,'1'),(128,1,1,'7eaaddedb2c1b8af55daa01904d21113',NULL,'0',NULL,NULL,'2022-02-15 11:49:18','2022-02-21 11:49:18',NULL,'1'),(129,1,1,'e8b05667020c32c18f5d07b7c5508ad0','dPBA_gydR_6LvaRXeRVfif:APA91bEbnRYPZAE35MV7iQaCUBWUl7-kXseBMTH8mN87t9a3oscLZxocuAHgcZj_4URdn4vr8K8WPryzDASwYg-SodAUdaKywGED7zvsXQ_gMfUjXLq-6P2sFmnexqYIjMGwGgTA-UWk','0',NULL,NULL,'2022-02-15 11:52:53','2022-02-21 11:52:53',NULL,'1'),(130,1,1,'8b72c3160be0a7f299664889ffb3384b','dPBA_gydR_6LvaRXeRVfif:APA91bEbnRYPZAE35MV7iQaCUBWUl7-kXseBMTH8mN87t9a3oscLZxocuAHgcZj_4URdn4vr8K8WPryzDASwYg-SodAUdaKywGED7zvsXQ_gMfUjXLq-6P2sFmnexqYIjMGwGgTA-UWk','0',NULL,NULL,'2022-02-15 11:58:26','2022-02-21 11:58:26',NULL,'1'),(131,1,1,'8843e041ad945ba6ff42f4eeaaf84fa2',NULL,'0',NULL,NULL,'2022-03-04 15:22:59','2022-03-10 15:22:59',NULL,'1'),(132,1,1,'63332424516391f2922854f5c31c039e',NULL,'0',NULL,NULL,'2022-04-25 19:57:52','2022-05-01 19:57:52',NULL,'1');
/*!40000 ALTER TABLE `tokenproveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_nombres` varchar(45) DEFAULT NULL,
  `usuario_apellidos` varchar(45) DEFAULT NULL,
  `usuario_usuario` varchar(45) DEFAULT NULL,
  `usuario_clave` varchar(45) DEFAULT NULL,
  `usuario_estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'GhianCo','Zapata','ghianco','1234','1'),(2,'Jesus','Quezada','jquezada','yisus','1'),(3,'Miguel','Icochea','micochea','cheek','1');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarioproveedor`
--

DROP TABLE IF EXISTS `usuarioproveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarioproveedor` (
  `usuarioproveedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  PRIMARY KEY (`usuarioproveedor_id`),
  KEY `fk_usuarioproveedor_usuario1_idx` (`usuario_id`),
  KEY `fk_usuarioproveedor_proveedor1_idx` (`proveedor_id`),
  CONSTRAINT `fk_usuarioproveedor_proveedor1` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedor` (`proveedor_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuarioproveedor_usuario1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usuario_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarioproveedor`
--

LOCK TABLES `usuarioproveedor` WRITE;
/*!40000 ALTER TABLE `usuarioproveedor` DISABLE KEYS */;
INSERT INTO `usuarioproveedor` VALUES (1,1,4),(2,1,5),(3,1,6),(4,1,7),(5,1,8),(6,1,9),(7,1,10),(8,1,11),(9,1,12),(10,1,13),(11,1,14),(12,1,15),(13,1,16),(14,1,17);
/*!40000 ALTER TABLE `usuarioproveedor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-05 15:09:40
