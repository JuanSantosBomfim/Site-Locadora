-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.6.10-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema dblocadora
--

CREATE DATABASE IF NOT EXISTS dblocadora;
USE dblocadora;

--
-- Definition of table `tblator`
--

DROP TABLE IF EXISTS `tblator`;
CREATE TABLE `tblator` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(65) NOT NULL,
  `dataNasc` varchar(45) NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `biografia` text NOT NULL,
  `participacao` varchar(150) DEFAULT NULL,
  `foto` varchar(45) NOT NULL,
  `destaque` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblator`
--

/*!40000 ALTER TABLE `tblator` DISABLE KEYS */;
INSERT INTO `tblator` (`id`,`nome`,`dataNasc`,`sexo`,`biografia`,`participacao`,`foto`,`destaque`) VALUES 
 (19,'Tom Cruise','2016','Masculino','nada','24','arquivos/ator1.jpg',1),
 (20,'dsadas','asdasd','Outro','dasd','0','arquivos/croissants.jpg',0);
/*!40000 ALTER TABLE `tblator` ENABLE KEYS */;


--
-- Definition of table `tblcategoria`
--

DROP TABLE IF EXISTS `tblcategoria`;
CREATE TABLE `tblcategoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblcategoria`
--

/*!40000 ALTER TABLE `tblcategoria` DISABLE KEYS */;
INSERT INTO `tblcategoria` (`id`,`nome`) VALUES 
 (6,'Filmes Classicos'),
 (7,'Documentario');
/*!40000 ALTER TABLE `tblcategoria` ENABLE KEYS */;


--
-- Definition of table `tblestado`
--

DROP TABLE IF EXISTS `tblestado`;
CREATE TABLE `tblestado` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblestado`
--

/*!40000 ALTER TABLE `tblestado` DISABLE KEYS */;
INSERT INTO `tblestado` (`id`,`nome`) VALUES 
 (1,'Acre (AC)'),
 (2,'Alagoas (AL)'),
 (3,'Amapá (AP)'),
 (4,'Amazonas (AM)'),
 (5,'Bahia (BA)'),
 (6,'Ceará (CE)'),
 (7,'Distrito Federal (DF)'),
 (8,'Espírito Santo (ES)'),
 (9,'Goiás (GO)'),
 (10,'Maranhão (MA)'),
 (11,'Mato Grosso (MT)'),
 (12,'Mato Grosso do Sul (MS)'),
 (13,'Minas Gerais (MG)'),
 (14,'Pará (PA) '),
 (15,'Paraíba (PB)'),
 (16,'Paraná (PR)'),
 (17,'Pernambuco (PE)'),
 (18,'Piauí (PI)'),
 (19,'Rio de Janeiro (RJ)'),
 (20,'Rio Grande do Norte (RN)'),
 (21,'Rio Grande do Sul (RS)'),
 (22,'Rondônia (RO)'),
 (23,'Roraima (RR)'),
 (24,'Santa Catarina (SC)'),
 (25,'São Paulo (SP)'),
 (26,'Sergipe (SE)'),
 (27,'Tocantins (TO)');
/*!40000 ALTER TABLE `tblestado` ENABLE KEYS */;


--
-- Definition of table `tblfaleconosco`
--

DROP TABLE IF EXISTS `tblfaleconosco`;
CREATE TABLE `tblfaleconosco` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `homepag` varchar(45) DEFAULT NULL,
  `linkface` varchar(45) DEFAULT NULL,
  `sugestao` text,
  `infoprodutos` varchar(45) DEFAULT NULL,
  `sexo` varchar(45) NOT NULL,
  `profissao` varchar(45) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfaleconosco`
--

/*!40000 ALTER TABLE `tblfaleconosco` DISABLE KEYS */;
INSERT INTO `tblfaleconosco` (`id`,`nome`,`telefone`,`celular`,`email`,`homepag`,`linkface`,`sugestao`,`infoprodutos`,`sexo`,`profissao`) VALUES 
 (2,'jose','123','123456','jose@test.com','asdasfaf','asfasdfsdf','jtyh','sdfdsfdsf','masculino','nenhum'),
 (3,'dasda','dasda','sdas','sda@dsadasdsa','asd','asd','asdas','das','das','dasd'),
 (4,'dasdas','sdasd','dasda','asdads@sadasd','dasd','das','asd','asd','asd','dasdad');
/*!40000 ALTER TABLE `tblfaleconosco` ENABLE KEYS */;


--
-- Definition of table `tblfilme`
--

DROP TABLE IF EXISTS `tblfilme`;
CREATE TABLE `tblfilme` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `genero` int(10) unsigned NOT NULL,
  `detalhe` text NOT NULL,
  `foto` varchar(45) NOT NULL,
  `destaque` int(10) unsigned DEFAULT NULL,
  `preco` float NOT NULL,
  `promocao` int(10) unsigned DEFAULT NULL,
  `promoporcent` int(10) unsigned DEFAULT NULL,
  `categoria` int(10) unsigned DEFAULT NULL,
  `subcategoria` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblfilme_1` (`genero`),
  KEY `FK_tblfilme_2` (`categoria`),
  KEY `FK_tblfilme_3` (`subcategoria`),
  CONSTRAINT `FK_tblfilme_1` FOREIGN KEY (`genero`) REFERENCES `tblgenero` (`id`),
  CONSTRAINT `FK_tblfilme_2` FOREIGN KEY (`categoria`) REFERENCES `tblcategoria` (`id`),
  CONSTRAINT `FK_tblfilme_3` FOREIGN KEY (`subcategoria`) REFERENCES `tblsubcategoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblfilme`
--

/*!40000 ALTER TABLE `tblfilme` DISABLE KEYS */;
INSERT INTO `tblfilme` (`id`,`nome`,`genero`,`detalhe`,`foto`,`destaque`,`preco`,`promocao`,`promoporcent`,`categoria`,`subcategoria`) VALUES 
 (26,'Documentario - HD',3,'test','arquivos/ator1.jpg',1,123,0,0,7,5),
 (27,'Documentario - History',5,'test','arquivos/filme1.jpg',0,333,0,0,7,6),
 (28,'Filme Classico- HD',4,'test','arquivos/google2.png',0,324,0,NULL,6,5),
 (29,'Filme Classico- History',5,'test','arquivos/jequiti.jpg',0,324,0,NULL,6,6);
/*!40000 ALTER TABLE `tblfilme` ENABLE KEYS */;


--
-- Definition of table `tblgenero`
--

DROP TABLE IF EXISTS `tblgenero`;
CREATE TABLE `tblgenero` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblgenero`
--

/*!40000 ALTER TABLE `tblgenero` DISABLE KEYS */;
INSERT INTO `tblgenero` (`id`,`nome`) VALUES 
 (1,'Ação'),
 (2,'Aventura'),
 (3,'Terror'),
 (4,'Suspense'),
 (5,'Comédia');
/*!40000 ALTER TABLE `tblgenero` ENABLE KEYS */;


--
-- Definition of table `tbllocadora`
--

DROP TABLE IF EXISTS `tbllocadora`;
CREATE TABLE `tbllocadora` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `detalhe` text NOT NULL,
  `foto` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbllocadora`
--

/*!40000 ALTER TABLE `tbllocadora` DISABLE KEYS */;
INSERT INTO `tbllocadora` (`id`,`nome`,`descricao`,`detalhe`,`foto`) VALUES 
 (9,'Acme tunes SA','Locadora','TESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST\r\nTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST\r\nTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST\r\nTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTESTTEST\r\nTESTTESTTESTTESTTESTtestset2','arquivos/logo2 (2).png');
/*!40000 ALTER TABLE `tbllocadora` ENABLE KEYS */;


--
-- Definition of table `tblnivel`
--

DROP TABLE IF EXISTS `tblnivel`;
CREATE TABLE `tblnivel` (
  `nivel` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnivel`
--

/*!40000 ALTER TABLE `tblnivel` DISABLE KEYS */;
INSERT INTO `tblnivel` (`nivel`,`nome`) VALUES 
 (10,'Administrador do sistema'),
 (13,'Operador básico'),
 (14,'Cataloguista');
/*!40000 ALTER TABLE `tblnivel` ENABLE KEYS */;


--
-- Definition of table `tblnossasloja`
--

DROP TABLE IF EXISTS `tblnossasloja`;
CREATE TABLE `tblnossasloja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` int(10) unsigned NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `rua` varchar(45) NOT NULL,
  `telefone` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblnossasloja_1` (`estado`),
  CONSTRAINT `FK_tblnossasloja_1` FOREIGN KEY (`estado`) REFERENCES `tblestado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblnossasloja`
--

/*!40000 ALTER TABLE `tblnossasloja` DISABLE KEYS */;
INSERT INTO `tblnossasloja` (`id`,`estado`,`cidade`,`rua`,`telefone`) VALUES 
 (1,11,'4213123','3123','3123'),
 (2,1,'salvador','rua test','123425233123');
/*!40000 ALTER TABLE `tblnossasloja` ENABLE KEYS */;


--
-- Definition of table `tblsubcategoria`
--

DROP TABLE IF EXISTS `tblsubcategoria`;
CREATE TABLE `tblsubcategoria` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `categoria` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblsubcategoria_1` (`categoria`),
  CONSTRAINT `FK_tblsubcategoria_1` FOREIGN KEY (`categoria`) REFERENCES `tblcategoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblsubcategoria`
--

/*!40000 ALTER TABLE `tblsubcategoria` DISABLE KEYS */;
INSERT INTO `tblsubcategoria` (`id`,`nome`,`categoria`) VALUES 
 (5,'HD',6),
 (6,'History',7),
 (7,'faroeste',6);
/*!40000 ALTER TABLE `tblsubcategoria` ENABLE KEYS */;


--
-- Definition of table `tblusuario`
--

DROP TABLE IF EXISTS `tblusuario`;
CREATE TABLE `tblusuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nivel` int(10) unsigned NOT NULL,
  `nome` varchar(100) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_tblusuario_1` (`nivel`),
  CONSTRAINT `FK_tblusuario_1` FOREIGN KEY (`nivel`) REFERENCES `tblnivel` (`nivel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblusuario`
--

/*!40000 ALTER TABLE `tblusuario` DISABLE KEYS */;
INSERT INTO `tblusuario` (`id`,`nivel`,`nome`,`senha`) VALUES 
 (4,10,'juan','123'),
 (5,13,'jose','1a2b');
/*!40000 ALTER TABLE `tblusuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
