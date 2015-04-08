CREATE DATABASE  IF NOT EXISTS `sisbio` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sisbio`;
-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sisbio
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.12.04.1

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
-- Table structure for table `Especie`
--

DROP TABLE IF EXISTS `Especie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Especie` (
  `idEspecie` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCientifico` varchar(255) NOT NULL,
  `NomeComum` varchar(255) DEFAULT NULL,
  `Autor` varchar(255) DEFAULT NULL,
  `Descricao` text,
  `idGenero` int(11) NOT NULL,
  `idTipo_Organismo` int(11) NOT NULL,
  PRIMARY KEY (`idEspecie`),
  KEY `fk_Especie_Genero1` (`idGenero`),
  KEY `fk_Especie_Tipo_Organismo1` (`idTipo_Organismo`),
  CONSTRAINT `fk_Especie_Genero1` FOREIGN KEY (`idGenero`) REFERENCES `Genero` (`idGenero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Especie_Tipo_Organismo1` FOREIGN KEY (`idTipo_Organismo`) REFERENCES `TipoOrganismo` (`idTipoOrganismo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=624 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Especie`
--

LOCK TABLES `Especie` WRITE;
/*!40000 ALTER TABLE `Especie` DISABLE KEYS */;
INSERT INTO `Especie` VALUES (1,'Aburria Jacutinga','Jacutinga','Spix, 1825','',1,1),(2,'Accipiter Bicolor ','Gavião-Bombachinha-Grande','Vieillot, 1817','',2,1),(3,'Accipiter Poliogaster ','Tauató-Pintado','Temminck, 1824','',2,1),(4,'Accipiter Striatus ','Gaviãozinho','Vieillot, 1808','',2,1),(5,'Accipiter Superciliosus ','Gavião-Miudinho','Linnaeus, 1766','',2,1),(6,'Actitis Macularius ','Maçarico-Pintado','Linnaeus, 1766','',3,1),(7,'Aegolius Harrisii ','Caburé-Acanelado','Cassin, 1849','',4,1),(8,'Agelaioides Badius ','Asa-De-Telha','Vieillot, 1819','',5,1),(9,'Agelasticus Cyanopus ','Carretão','Vieillot, 1819','',6,1),(10,'Agelasticus Thilius ','Sargento','Molina, 1782','',7,1),(11,'Agriornis Murinus ','Gauchinho','Orbigny & Lafresnaye, 1837','',8,1),(12,'Alectrurus Risora ','Tesoura-Do-Campo','Vieillot, 1824','',9,1),(13,'Alectrurus Tricolor ','Galito','Vieillot, 1816','',9,1),(14,'Alopochelidon Fucata ','Andorinha-Morena','Temminck, 1822','',10,1),(15,'Amazilia Fimbriata ','Beija-Flor-De-Garganta-Verde','Gmelin, 1788','',11,1),(16,'Amazilia Versicolor ','Beija-Flor-De-Banda-Branca','Vieillot, 1818','',11,1),(17,'Amazona Aestiva ','Papagaio-Verdadeiro','Linnaeus, 1758','',12,1),(18,'Amazona Pretrei','Charão','Temminck, 1830','',12,1),(19,'Amazona Vinacea ','Papagaio-De-Peito-Roxo','Kuhl, 1820','',12,1),(20,'Amazonetta Brasiliensis ','Marreca-Pé-Vermelho','Gmelin, 1789','',13,1),(21,'Amblyramphus Holosericeus ','Cardeal-Do-Banhado','Scopoli, 1786','',14,1),(22,'Ammodramus Humeralis ','Tico-Tico-Do-Campo','Bosc, 1792','',15,1),(23,'Anabacerthia Amaurotis ','Limpa-Folha-Miúdo','Temminck, 1823','',16,1),(24,'Anas Bahamensis','Marreca-Toicinho','Linnaeus, 1758','',17,1),(25,'Anas Cyanoptera ','Marreca-Colorada','Vieillot, 1816','',17,1),(26,'Anas Discors ','Marreca-De-Asa-Azul','Linnaeus, 1766','',17,1),(27,'Anas Flavirostris ','Marreca-Pardinha','Vieillot, 1816','',17,1),(28,'Anas Georgica ','Marreca-Parda','Gmelin, 1789','',17,1),(29,'Anas Platalea ','Marreca-Colhereira','Vieillot, 1816','',17,1),(30,'Anas Sibilatrix ','Marreca-Oveira','Poeppig, 1829','',17,1),(31,'Anas Versicolor ','Marreca-Cricri','Vieillot, 1816','',17,1),(32,'Anhinga Anhinga ','Biguatinga','Linnaeus, 1766','',18,1),(33,'Anodorhynchus Glaucus ','Arara-Azul-Pequena','Vieillot, 1816','',19,1),(34,'Anous Stolidus ','Trinta-Réis-Escuro','Linnaeus, 1758','',20,1),(35,'Anthracothorax Nigricollis','Beija-Flor-De-Veste-Preta','Vieillot, 1817','',21,1),(36,'Anthus Correndera ','Caminheiro-De-Espora','Vieillot, 1818','',22,1),(37,'Anthus Furcatus ','Caminheiro-De-Unha-Curta','D\'orbigny & Lafresnaye, 1837','',22,1),(38,'Anthus Hellmayri ','Caminheiro-De-Barriga-Acanelada','Hartert, 1909','',22,1),(39,'Anthus Lutescens ','Caminheiro-Zumbidor','Pucheran, 1855','',22,1),(40,'Anthus Nattereri ','Caminheiro-Grande','Sclater, 1878','',22,1),(41,'Antrostomus Rufus ','João-Corta-Pau','Boddaert, 1783','',23,1),(42,'Antrostomus Sericocaudatus ','Bacurau-Rabo-De-Seda','Cassin, 1849','',23,1),(43,'Anumbius Annumbi','Cochicho','Vieillot, 1817','',24,1),(44,'Aphantochroa Cirrochloris ','Beija-Flor-Cinza','Vieillot, 1818','',25,1),(45,'Aramides Cajanea ','Três-Potes','Statius Muller, 1776','',26,1),(46,'Aramides Saracura','Saracura-Do-Mato','Spix, 1825','',26,1),(47,'Aramides Ypecaha','Saracuruçu','Vieillot, 1819','',26,1),(48,'Aramus C','Carão','Linnaeus, 1766','',27,1),(49,'Aratinga Leucophthalma','Maracanã-Malhada','Statius Muller, 1776','',28,1),(50,'Ardea Alba ','Garça-Branca-Grande',' Linnaeus, 1758','',29,1),(51,'Ardea Cocoi ','Garça-Moura ou socó-Grande','Linnaeus, 1766','',29,1),(52,'Arenaria Interpres ','Vira-Pedra','Linnaeus, 1758','',30,1),(53,'Arremon Semitorquatus ','Tico-Tico-Do-Mato','Swainson, 1838','',31,1),(54,'Arundinicola Leucocephala ','Freirinha','Linnaeus, 1764','',32,1),(55,'Asio Clamator ','Coruja-Orelhuda','Vieillot, 1808','',33,1),(56,'Asio Flammeus ','Mocho-Dos-Banhados','Pontoppidan, 1763','',33,1),(57,'Asio Stygius ','Mocho-Diabo','Wagler, 1832','',33,1),(58,'Asthenes Baeri ','Lenheiro','Berlepsch, 1906','',34,1),(59,'Asthenes Hudsoni ','Lenheiro-Platino','Sclater, 1874','',34,1),(60,'Asthenes Pyrrholeuca','Lenheiro-De-Rabo-Comprido','Vieillot, 1817','',34,1),(61,'Athene Cunicularia ','Coruja-Do-Campo','Molina, 1782','',35,1),(62,'Attila Phoenicurus ','Capitão-Castanho','Pelzeln, 1868','',36,1),(63,'Attila Rufus ','Capitão-De-Saíra','Vieillot, 1819','',37,1),(64,'Automolus Leucophthalmus ','Barranqueiro-De-Olho-Branco','Wied, 1821','',38,1),(65,'Bartramia Longicauda ','Maçarico-Do-Campo','Bechstein, 1812','',39,1),(66,'Baryphthengus Ruficapillus ','Juruva','Vieillot, 1818','',40,1),(67,'Basileuterus Culicivorus','Pula-Pula','Deppe, 1830','',42,1),(68,'Basileuterus Leucoblepharus ','Pula-Pula-Assobiador','Vieillot, 1817','',41,1),(69,'Batara Cinerea','Matracão','Vieillot, 1819','',43,1),(70,'Botaurus Pinnatus ','Socó-Boi-Baio','Wagler, 1829','',44,1),(71,'Brotogeris Chiriri ','Periquito-De-Encontro-Amarelo','Vieillot, 1818','',45,1),(72,'Brotogeris Tirica ','Periquito-Rico','Gmelin, 1788','',45,1),(73,'Bubo Virginianus ','Jacurutu','Gmelin, 1788','',46,1),(74,'Bubulcus Ibis ','Garça-Vaqueira','Linnaeus, 1758','',47,1),(75,'Busarellus Nigricollis ','Gavião-Velho','Latham, 1790','',48,1),(76,'Buteo Brachyurus ','Gavião-De-Rabo-Curto','Vieillot, 1816','',49,1),(77,'Buteo Swainsoni ','Gavião-Papa-Gafanhoto','Bonaparte, 1838','',49,1),(78,'Butorides Striata ','Socozinho','Linnaeus, 1758','',50,1),(79,'Cacicus Chrysopterus ','Tecelão','Vigors, 1825','',51,1),(80,'Cacicus Haemorrhous ','Guaxe','Linnaeus, 1766','',51,1),(81,'Cairina Moschata ','Pato-Do-Mato','Linnaeus, 1758','',52,1),(82,'Calidris Alba ','Maçarico-Branco','Pallas, 1764','',53,1),(83,'Calidris Bairdii ','Maçarico-De-Bico-Fino','Coues, 1861','',53,1),(84,'Calidris Canutus ','Maçarico-De-Papo-Vermelho','Linnaeus, 1758','',53,1),(85,'Calidris Fuscicollis ','Maçarico-De-Sobre-Branco','Vieillot, 1819','',53,1),(86,'Calidris Himantopus ','Maçarico-Pernilongo','Bonaparte, 1826','',53,1),(87,'Calidris Melanotos ','Maçarico-De-Colete','Vieillot, 1819','',53,1),(88,'Calidris Minutilla','Maçariquinho','Vieillot, 1819','',53,1),(89,'Calidris Pusilla ','Maçarico-Miúdo','Linnaeus, 1766','',53,1),(90,'Calliphlox Amethystina ','Estrelinha','Boddaert, 1783','',54,1),(91,'Callonetta Leucophrys ','Marreca-De-Coleira','Vieillot, 1816','',55,1),(92,'Campephilus Leucopogon ','Pica-Pau-De-Barriga-Preta','Valenciennes, 1826','',56,1),(93,'Campephilus Robustus','Pica-Pau-Rei','Lichtenstein, 1818','',56,1),(94,'Camptostoma Obsoletum ','Risadinha','Temminck, 1824','',57,1),(95,'Campylorhamphus Falcularius ','Arapaçu-De-Bico-Torto','Vieillot, 1822','',58,1),(96,'Capsiempis Flaveola','Marianinha-Amarela','Lichtenstein, 1823','',59,1),(97,'Caracara Plancus ','Caracará','Miller, 1777','',60,1),(98,'Carduelis Carduelis','Pintassilgo-Europeu','Linnaeus, 1758','',61,1),(99,'Cariama Cristata ','Seriema','Linnaeus, 1766','',62,1),(100,'Carpornis Cucullata ','Corocoxó','Swainson, 1821','',63,1),(101,'Cathartes Aura ','Urubu-De-Cabeça-Vermelha','Linnaeus, 1758','',64,1),(102,'Cathartes Burrovianus ','Urubu-De-Cabeça-Amarela','Cassin, 1845','',64,1),(103,'Celeus Flavescens ','João-Velho','Gmelin, 1788','',65,1),(104,'Certhiaxis Cinnamomeus','Curutié','Gmelin, 1788','',66,1),(105,'Chaetura Cinereiventris ','Andorinhão-De-Sobre-Cinzento','Sclater, 1862','',67,1),(106,'Chaetura Meridionalis ','Andorinhão-Do-Temporal','Hellmayr, 1907','',67,1),(107,'Chamaeza Campanisona ','Tovaca-Campainha','Lichtenstein, 1823','',68,1),(108,'Chamaeza Ruficauda ','Tovaca-De-Rabo-Vermelho','Cabanis & Heine, 1859','',68,1),(109,'Charadrius Collaris ','Batuíra-De-Coleira','Vieillot, 1818','',69,1),(110,'Charadrius Falklandicus ','Batuíra-De-Coleira-Dupla','Latham, 1790','',69,1),(111,'Charadrius Modestus ','Batuíra-De-Peito-Avermelhado','Lichtenstein, 1823','',69,1),(112,'Charadrius Semipalmatus ','Batuíra-Norte-Americana','Bonaparte, 1825','',70,1),(113,'Chauna Torquata','Tachã','Oken, 1816','',71,1),(114,'Chionis Albus ','Pomba-Antártica','Gmelin, 1789','',72,1),(115,'Chiroxiphia Caudata ','Dançador','Shaw & Nodder, 1793','',73,1),(116,'Chlidonias Leucopterus ','Trinta-Réis-Negro-De-Asa-Branca','Temminck, 1815','',74,1),(117,'Chlidonias Niger ','Trinta-Réis-Negro','Linnaeus, 1758','',74,1),(118,'Chloris Chloris','Verdelhão','Linnaeus, 1758','',75,1),(119,'Chloroceryle Amazona ','Martim-Pescador-Verde','Latham, 1790','',77,1),(120,'Chloroceryle Americana ','Martim-Pescador-Pequeno','Gmelin, 1788','',76,1),(121,'Chlorophonia Cyanea ','Bandeirinha ou bonito-Do-Campo','Thunberg, 1822','',78,1),(122,'Chlorostilbon Lucidus ','Besourinho-De-Bico-Vermelho','Shaw, 1812','',79,1),(123,'Chondrohierax Uncinatus ','Caracoleiro','Temminck, 1822','',80,1),(124,'Chordeiles Minor ','Bacurau-Norte-Americano','Forster, 1771','',81,1),(125,'Chordeiles Nacunda ','Corucão','Vieillot, 1817','',81,1),(126,'Chordeiles Pusillus ','Bacurauzinho','Gould, 1861','',81,1),(127,'Chroicocephalus Cirrocephalus ','Gaivota-De-Cabeça-Cinza','Vieillot, 1818','',83,1),(128,'Chroicocephalus Maculipennis ','Gaivota-Maria-Velha','Lichtenstein, 1823','',82,1),(129,'Chrysomus Ruficapillus ','Garibaldi','Vieillot, 1819','',84,1),(130,'Cichlocolaptes Leucophrus ','Trepador-Sobrancelha','Jardine & Selby, 1830','',85,1),(131,'Ciconia Maguari ','João-Grande','Gmelin, 1789','',86,1),(132,'Cinclodes Fuscus ','Pedreiro-Dos-Andes','Vieillot, 1818','',87,1),(133,'Cinclodes Pabsti ','Teresinha Ou Pedreiro','Sick, 1969','',87,1),(134,'Circus Buffoni ','Gavião-Do-Banhado','Gmelin, 1788','',88,1),(135,'Circus Cinereus','Gavião-Cinza',' Vieillot, 1816','',89,1),(136,'Cissopis Leverianus ','Tiê-Tinga','Gmelin, 1788','',90,1),(137,'Cistothorus Platensis ','Corruíra-Do-Campo','Latham, 1790','',91,1),(138,'Claravis Pretiosa ','Rola-Azul','Ferrari-Perez, 1886','',92,1),(139,'Clibanornis Dendrocolaptoides ','Cisqueiro','Pelzeln, 1859','',93,1),(140,'Clytolaema Rubricauda ','Beija-Flor-Papo-De-Fogo','Boddaert, 1783','',94,1),(141,'Cnemotriccus Fuscatus ','Guaracavuçu','Wied, 1831','',95,1),(142,'Coccyzus Americanus ','Papa-Lagarta-Norte-Americano','Linnaeus, 1758','',96,1),(143,'Coccyzus Euleri ','Papa-Lagarta-De-Euler','Cabanis, 1873','',97,1),(144,'Coccyzus Melacoryphus ','Papa-Lagarta-Verdadeiro','Vieillot, 1817','',96,1),(145,'Coereba Flaveola ','Cambacica','Linnaeus, 1758','',98,1),(146,'Colaptes Campestris','Pica-Pau-Do-Campo','Vieillot, 1818','',99,1),(147,'Colaptes Melanochloros ','Pica-Pau-Verde-Barrado','Gmelin, 1788','',99,1),(148,'Colibri Serrirostris ','Beija-Flor-De-Orelha-Violeta','Vieillot, 1816','',100,1),(149,'Colonia Colonus ','Viuvinha','Vieillot, 1818','',101,1),(150,'Columba Livia ','Pombo-Doméstico','Gmelin, 1789','',102,1),(151,'Columbina Picui ','Rolinha-Picuí','Temminck, 1813','',103,1),(152,'Columbina Squammata ','Fogo-Apagou','Lesson, 1831','',103,1),(153,'Columbina Talpacoti','Rolinha-Roxa','Temminck, 1811','',103,1),(154,'Conirostrum Speciosum ','Figuinha-De-Rabo-Castanho','Temminck, 1824','',104,1),(155,'Conopophaga Lineata ','Chupa-Dente','Wied, 1831','',105,1),(156,'Contopus Cinereus','Papa-Moscas-Cinzento','Spix, 1825','',106,1),(157,'Coragyps Atratus ','Urubu-De-Cabeça-Preta','Bechstein, 1793','',107,1),(158,'Coryphistera Alaudina ','Corredor-Crestudo','Burmeister, 1860','',108,1),(159,'Corythopis Delalandi ','Estalador','Lesson, 1830','',109,1),(160,'Coscoroba Coscoroba ','Capororoca','Molina, 1782','',110,1),(161,'Coturnicops Notatus','Pinto-D\'água-Pintalgado','Gould, 1841','',111,1),(162,'Cranioleuca Obsoleta ','Arredio-Oliváceo','Reichenbach, 1853','',112,1),(163,'Cranioleuca Pyrrhophia','Arredio','Vieillot, 1818','',112,1),(164,'Cranioleuca Sulphurifera','Arredio-De-Papo-Manchado','Burmeister, 1869','',112,1),(165,'Crotophaga Ani ','Anu-Preto','Linnaeus, 1758','',113,1),(166,'Crotophaga Major ','Anu-Coroca','Gmelin, 1788','',113,1),(167,'Crypturellus Noctivagus ','Jaó-Do-Litoral','Wied, 1820','',115,1),(168,'Crypturellus Obsoletus ','Inambuguaçu','Temminck, 1815','',115,1),(169,'Crypturellus Parvirostris ','Inambuxororó','Wagler, 1827','',114,1),(170,'Crypturellus Tataupa','Inambuxintã','Temminck, 1815','',114,1),(171,'Culicivora Caudacuta ','Papa-Moscas-Do-Campo','Vieillot, 1818','',116,1),(172,'Cyanocorax Caeruleus ','Gralha-Azul','Vieillot, 1818','',117,1),(173,'Cyanocorax Chrysops ','Gralha-Picaça','Vieillot, 1818','',117,1),(174,'Cyanoloxia Brissonii ','Azulão','Lichtenstein, 1823','',118,1),(175,'Cyanoloxia Glaucocaerulea ','Azulinho','D\'orbigny & Lafresnaye, 1837','',118,1),(176,'Cyanoloxia Moesta ','Negrinho-Do-Mato','Hartlaub, 1853','',118,1),(177,'Cyclarhis Gujanensis ','Gente-De-Fora-Vem ou pitiguari','Gmelin, 1789','',119,1),(178,'Cygnus Melancoryphus ','Cisne-De-Pescoço-Preto','Molina, 1782','',120,1),(179,'Cypseloides Fumigatus','Andorinhão-Preto-Da-Cascata','Streubel, 1848','',121,1),(180,'Cypseloides Senex','Andorinhão-Velho-Da-Cascata','Temminck, 1826','',121,1),(181,'Dacnis Cayana ','Saí-Azul','Linnaeus, 1766','',122,1),(182,'Dendrocincla Turdina ','Arapaçu-Liso','Lichtenstein, 1820','',123,1),(183,'Dendrocolaptes Platyrostris','Arapaçu-Grande',' Spix, 1825','',124,1),(184,'Dendrocygna Autumnalis ','Marreca-Asa-Branca','Linnaeus, 1758','',125,1),(185,'Dendrocygna Bicolor','Marreca-Caneleira','Vieillot, 1816','',125,1),(186,'Dendrocygna Viduata ','Marreca-Piadeira ou irerê','Linnaeus, 1766','',125,1),(187,'Diuca Diuca ','Diuca','Molina, 1782','',126,1),(188,'Dolichonyx Oryzivorus','Triste-Pia','Linnaeus, 1758','',127,1),(189,'Donacospiza Albifrons ','Tico-Tico-Do-Banhado','Vieillot, 1817','',128,1),(190,'Dromococcyx Pavoninus ','Peixe-Frito-Pavonino','Pelzeln, 1870','',129,1),(191,'Dromococcyx Phasianellus ','Peixe-Frito-Verdadeiro','Spix, 1824','',129,1),(192,'Drymophila Malura ','Choquinha-Carijó','Temminck, 1825','',130,1),(193,'Drymophila Rubricollis ','Trovoada-De-Bertoni','Bertoni, 1901','',131,1),(194,'Drymornis Bridgesii ','Arapaçu-Do-Espinilho','Eyton, 1850','',132,1),(195,'Dryocopus Galeatus','Pica-Pau-De-Cara-Amarela','Temminck, 1822','',133,1),(196,'Dryocopus Lineatus ','Pica-Pau-De-Banda-Branca','Linnaeus, 1766','',56,1),(197,'Dysithamnus Mentalis ','Choquinha-Lisa','Temminck, 1823','',134,1),(198,'Egretta Caerulea','Garça-Azul','Linnaeus, 1758','',135,1),(199,'Egretta Thula ','Garça-Branca-Pequena','Molina, 1782','',136,1),(200,'Elaenia Chilensis ','Guaracava-De-Crista-Branca','Hellmayr, 1927','',137,1),(201,'Elaenia Flavogaster ','Guaracava-De-Barriga-Amarela','Thunberg, 1822','',137,1),(202,'Elaenia Mesoleuca ','Tuque','Deppe, 1830','',137,1),(203,'Elaenia Obscura','Tucão','D\'orbigny & Lafresnaye, 1837','',137,1),(204,'Elaenia Parvirostris ','Guaracava-De-Bico-Curto','Pelzeln, 1868','',137,1),(205,'Elaenia Spectabilis ','Guaracava-Grande','Pelzeln, 1868','',137,1),(206,'Elanoides Forficatus ','Gavião-Tesoura','Linnaeus, 1758','',138,1),(207,'Elanus Leucurus ','Gavião-Peneira','Vieillot, 1818','',139,1),(208,'Eleoscytalopus Indigoticus','Macuquinho','Wied, 1831','',140,1),(209,'Emberizoides Herbicola ','Canário-Do-Campo','Vieillot, 1817','',141,1),(210,'Emberizoides Ypiranganus ','Canário-Do-Brejo','Ihering & Ihering, 1907','',141,1),(211,'Embernagra Platensis ','Sabiá-Do-Banhado','Gmelin, 1789','',141,1),(212,'Empidonomus Varius ','Peitica','Vieillot, 1818','',142,1),(213,'Estrilda Astrild ','Bico-De-Lacre','Linnaeus, 1758','',143,1),(214,'Eupetomena Macroura ','Beija-Flor-Tesoura','Gmelin, 1788','',144,1),(215,'Euphonia Chalybea ','Cais-Cais','Mikan, 1825','',145,1),(216,'Euphonia Chlorotica ','Fim-Fim','Linnaeus, 1766','',145,1),(217,'Euphonia Cyanocephala ','Gaturamo-Rei','Vieillot, 1818','',145,1),(218,'Euphonia Pectoralis ','Gaturamo-Serrador ou ferro-Velho','Latham, 1801','',145,1),(219,'Euphonia Violacea ','Gaturamo-Verdadeiro','Linnaeus, 1758','',145,1),(220,'Euscarthmus Meloryphus ','Barulhento','Wied, 1831','',146,1),(221,'Falco Deiroleucus ','Falcão-De-Peito-Vermelho','Temminck, 1825','',147,1),(222,'Falco Femoralis ','Falcão-De-Coleira','Temminck, 1822','',147,1),(223,'Falco Peregrinus ','Falcão-Peregrino','Tunstall, 1771','',147,1),(224,'Falco Rufigularis ','Falcão-De-Garganta-Branca','Daudin, 1800','',147,1),(225,'Falco Sparverius ','Quiriquiri','Linnaeus, 1758','',147,1),(226,'Florisuga Fusca ','Beija-Flor-Preto-De-Rabo-Branco','Vieillot, 1817','',148,1),(227,'Fluvicola Albiventer ','Lavadeira-De-Cara-Branca','Spix, 1825','',149,1),(228,'Formicarius Colma ','Galinha-Do-Mato','Boddaert, 1783','',150,1),(229,'Fulica Armillata ','Carqueja-De-Bico-Manchado','Vieillot, 1817','',151,1),(230,'Fulica Leucoptera ','Carqueja-De-Bico-Amarelo','Vieillot, 1817','',151,1),(231,'Fulica Rufifrons ','Carqueja-De-Escudo-Vermelho','Philippi & Landbeck, 1861','',151,1),(232,'Furnarius Rufus ','João-De-Barro','Gmelin, 1788','',152,1),(233,'Gallinago Paraguaiae ','Narceja','Vieillot, 1816','',153,1),(234,'Gallinago Undulata ','Narcejão','Boddaert, 1783','',153,1),(235,'Gallinula Galeata ','Galinhola ou frango-D\'água','Lichtenstein,1818','',154,1),(236,'Gallinula Melanops','Frango-D\'água-Carijó','Vieillot, 1819','',154,1),(237,'Gelochelidon Nilotica','Trinta-Réis-De-Bico-Preto','Gmelin, 1789','',155,1),(238,'Geositta Cunicularia ','Curriqueiro','Vieillot, 1816','',156,1),(239,'Geothlypis Aequinoctialis ','Pia-Cobra','Gmelin, 1789','',157,1),(240,'Geotrygon Montana ','Pariri','Linnaeus, 1758','',158,1),(241,'Geranoaetus Albicaudatus ','Gavião-De-Rabo-Branco','Vieillot, 1816','',159,1),(242,'Geranoaetus Melanoleucus','águia-Chilena','Vieillot, 1819','',159,1),(243,'Geranospiza Caerulescens ','Gavião-Pernilongo','Vieillot, 1817','',160,1),(244,'Glaucidium Brasilianum ','Caburé','Gmelin, 1788','',161,1),(245,'Gnorimopsar Chopi ','Chopim Ou Graúna','Vieillot, 1819','',162,1),(246,'Grallaria Varia','Tovacuçu','Boddaert, 1783','',163,1),(247,'Griseotyrannus Aurantioatrocristatus ','Peitica-De-Chapéu-Preto','D\'orbigny & Lafresnaye, 1837','',164,1),(248,'Gubernatrix Cristata ','Cardeal-Amarelo','Vieillot, 1817','',165,1),(249,'Gubernetes Yetapa ','Tesoura-Do-Brejo','Vieillot, 1818','',166,1),(250,'Guira Guira ','Anu-Branco','Gmelin, 1788','',167,1),(251,'Habia Rubica','Tiê-Do-Mato-Grosso','Vieillot, 1817','',168,1),(252,'Haematopus Palliatus ','Piru-Piru','Temminck, 1820','',169,1),(253,'Haplospiza Unicolor','Cigarra-Bambu',' Cabanis, 1851','',170,1),(254,'Harpagus Diodon','Gavião-Bombachinha','Temminck, 1823','',171,1),(255,'Harpia Harpyja ','Gavião-Real','Linnaeus, 1758','',172,1),(256,'Heliobletus Contaminatus ','Trepadorzinho','Berlepsch, 1885','',173,1),(257,'Heliomaster Furcifer ','Beija-Flor-De-Barba-Azul','Shaw, 1812','',174,1),(258,'Hemithraupis Guira ','Papo-Preto','Linnaeus, 1766','',175,1),(259,'Hemithraupis Ruficapilla ','Saíra-Ferrugem','Vieillot, 1818','',175,1),(260,'Hemitriccus Diops','Olho-Falso','Temminck, 1822','',177,1),(261,'Hemitriccus Margaritaceiventer ','Olho-De-Ouro','D\'orbigny & Lafresnaye, 1837','',176,1),(262,'Hemitriccus Obsoletus ','Catraca','Miranda-Ribeiro, 1906','',176,1),(263,'Hemitriccus Orbitatus ','Tiririzinho-Do-Mato','Wied, 1831','',176,1),(264,'Herpetotheres Cachinnans ','Acauã','Linnaeus, 1758','',178,1),(265,'Heteronetta Atricapilla ','Marreca-De-Cabeça-Preta','Merrem, 1841','',179,1),(266,'Heterospizias Meridionalis ','Gavião-Caboclo','Latham, 1790','',180,1),(267,'Himantopus Melanurus ','Pernilongo','Vieillot, 1817','',181,1),(268,'Hirundinea Ferruginea','Birro','Gmelin, 1788','',182,1),(269,'Hirundo Rustica','Andorinha-De-Bando','Linnaeus, 1758','',183,1),(270,'Hydropsalis Albicollis ','Bacurau','Gmelin, 1789','',184,1),(271,'Hydropsalis Anomala ','Curiango-Do-Banhado','Gould, 1838','',184,1),(272,'Hydropsalis Forcipata ','Bacurau-Tesoura-Gigante','Nitzsch, 1840','',184,1),(273,'Hydropsalis Longirostris ','Bacurau-Da-Telha','Bonaparte, 1825','',184,1),(274,'Hydropsalis Parvula ','Bacurau-Pequeno','Gould, 1837','',184,1),(275,'Hydropsalis Torquata ','Bacurau-Tesoura','Gmelin, 1789','',184,1),(276,'Hylocharis Chrysura ','Beija-Flor-Dourado','Shaw, 1812','',185,1),(277,'Hylopezus Nattereri ','Pinto-Do-Mato','Pinto, 1937','',186,1),(278,'Hylophilus Poicilotis ','Verdinho-Coroado','Temminck, 1822','',187,1),(279,'Hymenops Perspicillatus ','Viuvinha-De-óculos','Gmelin, 1789','',188,1),(280,'Hypoedaleus Guttatus ','Chocão-Carijó','Vieillot, 1816','',189,1),(281,'Icterus Pyrrhopterus  ','Encontro','Vieillot, 1819','',190,1),(282,'Ictinia Plumbea','Sovi','Gmelin, 1788','',191,1),(283,'Ixobrychus Exilis ','Socoí-Vermelho','Gmelin, 1789','',192,1),(284,'Ixobrychus Involucris ','Socoí-Amarelo','Vieillot, 1823','',192,1),(285,'Jabiru Mycteria ','Jabiru Ou Tuiuiú','Lichtenstein, 1819','',193,1),(286,'Jacana Jacana ','Jaçanã','Linnaeus, 1766','',194,1),(287,'Knipolegus Cyanirostris ','Maria-Preta-De-Bico-Azulado','Vieillot, 1818','',195,1),(288,'Knipolegus Lophotes ','Maria-Preta-De-Penacho','Boie, 1828','',195,1),(289,'Knipolegus Nigerrimus ','Maria-Preta-De-Garganta-Vermelha','Vieillot, 1818','',195,1),(290,'Lanio Cucullatus ','Tico-Tico-Rei','Statius Muller, 1776','',196,1),(291,'Lanio Melanops ','Tiê-De-Topete','Vieillot, 1818','',196,1),(292,'Larus Atlanticus','Gaivota-De-Rabo-Preto',' Olrog, 1958','',197,1),(293,'Larus Dominicanus ','Gaivotão','Lichtenstein, 1823','',197,1),(294,'Laterallus Leucopyrrhus ','Pinto-D\'água-Avermelhado','Vieillot, 1819','',198,1),(295,'Laterallus Melanophaius','Pinto-D\'água-Comum','Vieillot, 1819','',199,1),(296,'Lathrotriccus Euleri ','Enferrujado','Cabanis, 1868','',200,1),(297,'Legatus Leucophaius ','Bem-Te-Vi-Pirata','Vieillot, 1818','',201,1),(298,'Lepidocolaptes Angustirostris ','Arapaçu-Do-Cerrado','Vieillot, 1818','',202,1),(299,'Lepidocolaptes Falcinellus ','Arapaçu-Escamoso-Do-Sul','Cabanis & Heine, 1859','',202,1),(300,'Leptasthenura Platensis','Rabudinho',' Reichenbach, 1853','',203,1),(301,'Leptasthenura Setaria ','Grimpeiro','Temminck, 1824','',203,1),(302,'Leptasthenura Striolata','Grimpeirinho','Pelzeln, 1856','',203,1),(303,'Leptodon Cayanensis ','Gavião-De-Cabeça-Cinza','Latham, 1790','',204,1),(304,'Leptopogon Amaurocephalus ','Cabeçudo','Tschudi, 1846','',205,1),(305,'Leptotila Rufaxilla','Juriti-Gemedeira','Richard & Bernard, 1792','',207,1),(306,'Leptotila Verreauxi ','Juriti-Pupu','Bonaparte, 1855','',206,1),(307,'Lessonia Rufa ','Colegial','Gmelin, 1789','',208,1),(308,'Leucochloris Albicollis ','Beija-Flor-De-Papo-Branco','Vieillot, 1818','',209,1),(309,'Leucophaeus Pipixcan ','Gaivota-De-Franklin','Wagler, 1831','',210,1),(310,'Limnoctites Rectirostris ','Arredio-Do-Gravatá','Gould, 1839','',211,1),(311,'Limnodromus Griseus ','Maçarico-De-Costas-Brancas','Gmelin, 1789','',212,1),(312,'Limnornis Curvirostris ','João-Da-Palha','Gould, 1839','',213,1),(313,'Limosa Haemastica ','Maçarico-De-Bico-Virado','Linnaeus, 1758','',214,1),(314,'Lochmias Nematura ','João-Porca','Lichtenstein, 1823','',215,1),(315,'Lophornis Magnificus','Topetinho-Vermelho','Vieillot, 1817','',216,1),(316,'Lurocalis Semitorquatus ','Tuju','Gmelin, 1789','',217,1),(317,'Machetornis Rixosa ','Suiriri-Cavaleiro','Vieillot, 1819','',218,1),(318,'Mackenziaena Leachii ','Brujarara-Assobiador','Such, 1825','',219,1),(319,'Mackenziaena Severa ','Borralhara','Lichtenstein, 1823','',220,1),(320,'Manacus Manacus ','Rendeira','Linnaeus, 1766','',221,1),(321,'Megaceryle Torquata ','Martim-Pescador-Grande','Linnaeus, 1766','',222,1),(322,'Megarynchus Pitangua ','Neinei','Linnaeus, 1766','',223,1),(323,'Megascops Choliba ','Corujinha-Do-Mato','Vieillot, 1817','',224,1),(324,'Megascops Sanctaecatarinae ','Corujinha-Do-Sul','Salvin, 1897','',224,1),(325,'Melanerpes Candidus ','Pica-Pau-Branco','Otto, 1796','',225,1),(326,'Melanerpes Flavifrons ','Benedito-De-Testa-Amarela','Vieillot, 1818','',225,1),(327,'Mesembrinibis Cayennensis','Coró-Coró','Gmelin, 1789','',226,1),(328,'Micrastur Ruficollis ','Gavião-Caburé','Vieillot, 1817','',227,1),(329,'Micrastur Semitorquatus ','Gavião-Relógio','Vieillot, 1817','',227,1),(330,'Micrococcyx Cinereus ','Papa-Lagarta-Cinzento','Vieillot, 1817','',228,1),(331,'Milvago Chimachima ','Carrapateiro','Vieillot, 1816','',229,1),(332,'Milvago Chimango ','Chimango','Vieillot, 1816','',229,1),(333,'Mimus Saturninus ','Sabiá-Do-Campo','Lichtenstein, 1823','',230,1),(334,'Mimus Triurus ','Calhandra-De-Três-Rabos','Vieillot, 1818','',230,1),(335,'Mionectes Rufiventris ','Supi-De-Cabeça-Cinza','Cabanis, 1846','',231,1),(336,'Molothrus Oryzivorus ','Iraúna-Grande','Gmelin, 1788','',232,1),(337,'Molothrus Oryzivorus ','Vira-Bosta','Gmelin, 1789','',232,1),(338,'Molothrus Rufoaxillaris ','Vira-Bosta-Picumã','Cassin, 1866','',233,1),(339,'Morphnus Guianensis ','Uiraçu-Falso','Daudin, 1800','',234,1),(340,'Muscipipra Vetula ','Tesoura-Cinzenta','Lichtenstein, 1823','',235,1),(341,'Mycteria Americana ','Cabeça-Seca','Linnaeus, 1758','',236,1),(342,'Myiarchus Ferox ','Maria-Cavaleira','Gmelin, 1789','',237,1),(343,'Myiarchus Swainsoni ','Irré','Cabanis & Heine, 1859','',237,1),(344,'Myiarchus Tyrannulus ','Maria-Cavaleira-De-Rabo-Ferrugem','Statius Muller, 1776','',238,1),(345,'Myiodynastes Maculatus ','Bem-Te-Vi-Rajado','Statius Muller, 1776','',239,1),(346,'Myiopagis Caniceps','Guaracava-Cinzenta','Swainson, 1835','',240,1),(347,'Myiopagis Viridicata ','Guaracava-De-Crista-Alaranjada','Vieillot, 1817','',240,1),(348,'Myiophobus Fasciatus ','Filipe','Statius Muller, 1776','',241,1),(349,'Myiopsitta Monachus ','Caturrita','Boddaert, 1783','',242,1),(350,'Myiornis Auricularis','Miudinho','Vieillot, 1818','',243,1),(351,'Myiozetetes Similis ','Bem-Te-Vi-Pequeno','Spix, 1825','',244,1),(352,'Myrmeciza Squamosa ','Papa-Formiga-De-Grota','Pelzeln, 1868pelzeln, 1868','',245,1),(353,'Myrmotherula Gularis ','Choquinha-De-Garganta-Pintada','Spix, 1825','',246,1),(354,'Myrmotherula Unicolor ','Choquinha-Cinzenta','Ménétriès, 1835','',382,1),(355,'Nemosia Pileata ','Saíra-De-Chapéu-Preto','Boddaert, 1783','',247,1),(356,'Neocrex Erythrops','Turu-Turu','Sclater, 1867','',248,1),(357,'Neoxolmis Rufiventris','Gaúcho-Chocolate','Vieillot, 1823','',249,1),(358,'Netta Peposaca','Marrecão','','',251,1),(359,'Netta Peposaca ','Marrecão','Vieillot, 1816','',251,1),(360,'Nomonyx Dominica ','Marreca-De-Bico-Roxo','Linnaeus, 1766','',252,1),(361,'Nonnula Rubecula ','Macuru','Spix, 1824','',253,1),(362,'Notharchus Swainsoni ','Capitão-Do-Mato','Gray, 1846','',254,1),(363,'Nothura Maculosa ','Perdiz Ou Codorna','Temminck, 1815','',255,1),(364,'Numenius Phaeopus ','Maçarico-De-Bico-Torto','Linnaeus, 1758','',256,1),(365,'Nyctanassa Violacea ','Savacu-De-Coroa','Linnaeus, 1758','',257,1),(366,'Nyctibius Griseus ','Urutau','Gmelin, 1789','',258,1),(367,'Nycticorax Nycticorax ','Savacu','Linnaeus, 1758','',259,1),(368,'Nycticryphes Semicollaris ','Narceja-De-Bico-Torto','Vieillot, 1816','',260,1),(369,'Nystalus Chacuru','João-Bobo','Vieillot, 1816','',261,1),(370,'Odontophorus Capueira ','Uru','Spix, 1825','',262,1),(371,'Oreopholus Ruficollis ','Batuíra-De-Papo-Ferrugíneo','Wagler, 1829','',263,1),(372,'Ortalis Guttata ','Aracuã','Spix, 1825','',264,1),(373,'Orthogonys Chloricterus ','Catirumbava','Vieillot, 1819','',265,1),(374,'Oxyruncus Cristatus ','Araponga-Do-Horto','Swainson, 1821','',266,1),(375,'Oxyura Vittata ','Marreca-Pés-Na-Bunda','Philippi, 1860','',267,1),(376,'Pachyramphus Castaneus ','Caneleirinho','Jardine & Selby, 1827','',268,1),(377,'Pachyramphus Polychopterus ','Caneleirinho-Preto','Vieillot, 1818','',269,1),(378,'Pachyramphus Validus ','Caneleiro-De-Chapéu-Preto','Lichtenstein, 1823','',269,1),(379,'Pachyramphus Viridis ','Caneleirinho-Verde','Vieillot, 1816','',269,1),(380,'Pandion Haliaetus ','águia-Pescadora','Linnaeus, 1758','',270,1),(381,'Parabuteo Leucorrhous ','Gavião-De-Sobre-Branco','Quoy & Gaimard, 1824','',271,1),(382,'Parabuteo Unicinctus ','Gavião-Asa-De-Telha','Temminck, 1824','',271,1),(383,'Pardirallus Maculatus ','Saracura-Carijó','Boddaert, 1783','',272,1),(384,'Pardirallus Nigricans ','Saracura-Sanã','Vieillot, 1819','',273,1),(385,'Pardirallus Sanguinolentus ','Saracura-Do-Banhado','Swainson, 1837','',272,1),(386,'Paroaria Capitata ','Cavalaria','D\'orbigny & Lafresnaye, 1837','',274,1),(387,'Paroaria Coronata ','Cardeal','Miller, 1776','',274,1),(388,'Parula Pitiayumi ','Mariquita','Vieillot, 1817','',275,1),(389,'Passer Domesticus','Pardal','Linnaeus, 1758','',276,1),(390,'Patagioenas Cayennensis ','Pomba-Galega','Bonnaterre, 1792','',277,1),(391,'Patagioenas Maculosa ','Pomba-Do-Orvalho','Temminck, 1813','',277,1),(392,'Patagioenas Picazuro ','Asa-Branca ou pombão','Temminck, 1813','',277,1),(393,'Patagioenas Plumbea','Pomba-Amargosa','Vieillot, 1818','',277,1),(394,'Penelope Obscura ','Jacuaçu','Temminck, 1815','',279,1),(395,'Penelope Superciliaris ','Jacu-Velho ou jacupemba','Temminck, 1815','',278,1),(396,'Petrochelidon Pyrrhonota ','Andorinha-De-Sobre-Acanelado','Vieillot, 1817','',280,1),(397,'Phacellodomus Ferrugineigula ','João-Botina','Pelzeln, 1858','',281,1),(398,'Phacellodomus Ruber ','Graveteiro','Vieillot, 1817','',281,1),(399,'Phacellodomus Striaticollis ','Tio-Tio','D\'orbigny & Lafresnaye, 1838','',281,1),(400,'Phaethornis Eurynome ','Rabo-Branco-De-Garganta-Rajada','Lesson, 1832','',282,1),(401,'Phaethornis Pretrei ','Rabo-Branco-Acanelado','Lesson & Delattre, 1839','',282,1),(402,'Phaetusa Simplex ','Trinta-Réis-Grande','Gmelin, 1789','',283,1),(403,'Phalacrocorax Brasilianus ','Biguá','Gmelin, 1789','',284,1),(404,'Phalaropus Tricolor ','Pisa-N\'água','Vieillot, 1819','',285,1),(405,'Phibalura Flavirostris ','Tesourinha-Do-Mato','Vieillot, 1816','',286,1),(406,'Philomachus Pugnax','Combatente','Linnaeus, 1758','',287,1),(407,'Philydor Atricapillus ','Limpa-Folha-Coroado','Wied, 1821','',288,1),(408,'Philydor Lichtensteini ','Limpa-Folha-Ocráceo','Cabanis & Heine, 1859','',289,1),(409,'Philydor Rufum ','Limpa-Folha-De-Testa-Baia','Vieillot, 1818','',289,1),(410,'Phimosus Infuscatus ','Maçarico-De-Cara-Pelada ou chapéu-Velho','Lichtenstein, 1823','',290,1),(411,'Phleocryptes Melanops ','Bate-Bico','Vieillot, 1817','',291,1),(412,'Phoenicoparrus Andinus ','Flamingo-Andino','Philippi, 1854','',292,1),(413,'Phoenicopterus Chilensis ','Flamingo','Molina, 1782','',293,1),(414,'Phrygilus Fruticeti ','Canário-Andino-Negro','Kittlitz, 1833','',294,1),(415,'Phyllomyias Fasciatus ','Piolhinho','Thunberg, 1822','',296,1),(416,'Phyllomyias Griseocapilla ','Piolhinho-Serrano','Sclater, 1862','',296,1),(417,'Phyllomyias Virescens ','Piolhinho-Verdoso','Temminck, 1824','',295,1),(418,'Phylloscartes Difficilis ','Estalinho','Ihering & Ihering, 1907','',297,1),(419,'Phylloscartes Eximius ','Barbudinho','Temminck, 1822','',297,1),(420,'Phylloscartes Kronei ','Maria-Da-Restinga','Willis & Oniki, 1992','',297,1),(421,'Phylloscartes Ventralis ','Borboletinha-Do-Mato','Temminck, 1824','',297,1),(422,'Phytotoma Rutila','Corta-Ramos-De-Rabo-Branco',' Vieillot, 1818','',298,1),(423,'Piaya Cayana ','Alma-De-Gato','Linnaeus, 1766','',299,1),(424,'Piculus Aurulentus ','Pica-Pau-Dourado','Temminck, 1821','',300,1),(425,'Picumnus Nebulosus ','Pica-Pau-Anão-Carijó','Sundevall, 1866','',302,1),(426,'Picumnus Temminckii ','Pica-Pau-Anão-De-Coleira','Lafresnaye, 1845','',301,1),(427,'Pionopsitta Pileata ','Cuiú-Cuiú','Scopoli, 1769','',303,1),(428,'Pionus Maximiliani ','Maitaca-Bronzeada','Kuhl, 1820','',304,1),(429,'Pipraeidea Bonariensis','Sanhaçu-Papa-Laranja','Gmelin, 1789','',305,1),(430,'Pipraeidea Melanonota ','Saíra-Viúva','Vieillot, 1819','',305,1),(431,'Piprites Chloris ','Papinho-Amarelo','Temminck, 1822','',307,1),(432,'Piprites Pileata','Caneleirinho-De-Boné-Preto','Temminck, 1822','',306,1),(433,'Piranga Flava','Sanhaçu-De-Fogo','Vieillot, 1822','',308,1),(434,'Pitangus Sulphuratus ','Bem-Te-Vi','Linnaeus, 1766','',309,1),(435,'Platalea Ajaja ','Colhereiro','Linnaeus, 1758','',310,1),(436,'Platyrinchus Leucoryphus','Patinho-Gigante',' Wied, 1831','',311,1),(437,'Platyrinchus Mystaceus ','Patinho','Vieillot, 1818','',311,1),(438,'Plegadis Chihi ','Maçarico-Preto','Vieillot, 1817','',312,1),(439,'Pluvialis Dominica ','Batuiruçu','Statius Muller, 1776','',314,1),(440,'Pluvialis Squatarola ','Batuiruçu-De-Axila-Preta','Linnaeus, 1758','',313,1),(441,'Podicephorus Major ','Mergulhão-Grande','Boddaert, 1783','',315,1),(442,'Podilymbus Podiceps ','Mergulhão','Linnaeus, 1758','',316,1),(443,'Poecilotriccus Plumbeiceps ','Tororó','Lafresnaye, 1846','',317,1),(444,'Polioptila Dumicola ','Balança-Rabo-De-Máscara','Vieillot, 1817','',319,1),(445,'Polioptila Lactea ','Balança-Rabo-Leitoso','Sharpe, 1885','',318,1),(446,'Polystictus Pectoralis ','Papa-Moscas-Canela','Vieillot, 1817','',320,1),(447,'Polytmus Guainumbi ','Beija-Flor-De-Bico-Curvo','Pallas, 1764','',321,1),(448,'Poospiza Cabanisi ','Quete','Bonaparte, 1850','',322,1),(449,'Poospiza Melanoleuca ','Capacetinho','D\'orbigny & Lafresnaye, 1837','',322,1),(450,'Poospiza Nigrorufa','Quem-Te-Vestiu','D\'orbigny & Lafresnaye, 1837','',322,1),(451,'Poospiza Thoracica','Peito-Pinhão','Nordmann, 1835','',322,1),(452,'Porphyrio Flavirostris ','Frango-D\'água-Pequeno','Gmelin, 1789','',323,1),(453,'Porphyrio Martinica ','Frango-D\'água-Azul','Linnaeus, 1766','',323,1),(454,'Porzana Albicollis','Sanã-Carijó','Vieillot, 1819','',324,1),(455,'Porzana Flaviventer ','Sanã-Amarela','Boddaert, 1783','',324,1),(456,'Porzana Spiloptera ','Sanã-Cinza','Durnford, 1877','',324,1),(457,'Primolius Maracana ','Maracanã','Vieillot, 1816','',325,1),(458,'Procacicus Solitarius','Iraúna-De-Bico-Branco','Vieillot, 1816','',326,1),(459,'Procnias Nudicollis ','Araponga Ou Ferreiro','Vieillot, 1817','',327,1),(460,'Progne Chalybea ','Andorinha-Doméstica-Grande','Gmelin, 1789','',328,1),(461,'Progne Tapera','Andorinha-Do-Campo','Vieillot, 1817','',328,1),(462,'Pseudastur Polionotus ','Gavião-Pombo-Branco','Kaup, 1847','',329,1),(463,'Pseudocolopteryx Flaviventris','Amarelinho-Do-Junco','D\'orbigny & Lafresnaye, 1837','',331,1),(464,'Pseudocolopteryx Sclateri ','Tricolino','Oustalet, 1892','',330,1),(465,'Pseudoleistes Guirahuro ','Chopim-Do-Brejo','Vieillot, 1819','',332,1),(466,'Pseudoleistes Virescens ','Dragão','Vieillot, 1819','',333,1),(467,'Pseudoseisura Lophotes ','Coperete','Reichenbach, 1853','',334,1),(468,'Psilorhamphus Guttatus ','Macuquinho-Pintado','Ménétriès, 1835','',335,1),(469,'Pteroglossus Bailloni ','Araçari-Banana','Vieillot, 1819','',336,1),(470,'Pteroglossus Castanotis ','Araçari-Castanho','Gould, 1834','',336,1),(471,'Pulsatrix Koeniswaldiana ','Murucututu-De-Barriga-Amarela','Bertoni & Bertoni, 1901','',337,1),(472,'Pulsatrix Perspicillata ','Murucututu','Salvin, 1897','',337,1),(473,'Pygochelidon Cyanoleuca','Andorinha-Pequena-De-Casa','Vieillot, 1817','',338,1),(474,'Pyriglena Leucoptera ','Papa-Taoca','Vieillot, 1818','',339,1),(475,'Pyrocephalus Rubinus ','Príncipe','Boddaert, 1783','',340,1),(476,'Pyroderus Scutatus ','Pavó','Shaw, 1792','',341,1),(477,'Pyrrhocoma Ruficeps ','Cabecinha-Castanha','Strickland, 1844','',342,1),(478,'Pyrrhura Frontalis ','Tiriba-De-Testa-Vermelha','Vieillot, 1817','',343,1),(479,'Ramphastos Dicolorus','Tucano-De-Bico-Verde',' Linnaeus, 1766','',345,1),(480,'Ramphastos Toco ','Tucanuçu','Statius Muller, 1776','',344,1),(481,'Rhea Americana ','Ema','Linnaeus, 1758','',346,1),(482,'Rhynchotus Rufescens ','Perdigão','Temminck, 1815','',347,1),(483,'Riparia Riparia ','Andorinha-Do-Barranco','Linnaeus, 1758','',348,1),(484,'Rollandia Rolland','Mergulhão-De-Orelha-Branca','Quoy & Gaimard, 1824','',349,1),(485,'Rostrhamus Sociabilis ','Gavião-Caramujeiro','Vieillot, 1817','',350,1),(486,'Rupornis Magnirostris ','Gavião-Carijó','Gmelin, 1788','',351,1),(487,'Rynchops Niger ','Talha-Mar','Linnaeus, 1758','',352,1),(488,'Saltator Aurantiirostris','Bico-Duro ou bico-De-Ouro',' Vieillot, 1817','',353,1),(489,'Saltator Coerulescens','Sabiá-Gongá',' Vieillot, 1817','',353,1),(490,'Saltator Fuliginosus ','Bico-De-Pimenta','Daudin, 1800','',353,1),(491,'Saltator Maxillosus ','Bico-Grosso','Cabanis, 1851','',353,1),(492,'Saltator Similis ','Trinca-Ferro-Verdadeiro','D\'orbigny & Lafresnaye, 1837','',353,1),(493,'Sarcoramphus Papa ','Urubu-Rei','Linnaeus, 1758','',354,1),(494,'Sarkidiornis Sylvicola ','Pato-De-Crista','Hering & Ihering, 1907','',355,1),(495,'Satrapa Icterophrys','Suiriri-Pequeno','Vieillot, 1818','',356,1),(496,'Schiffornis Virescens','Flautim','Lafresnaye, 1838','',357,1),(497,'Schoeniophylax Phryganophilus','Bichoita','Vieillot, 1817','',358,1),(498,'Sclerurus Scansor ','Vira-Folha','Ménétriès, 1835','',359,1),(499,'Scytalopus Iraiensis ','Macuquinho-Da-Várzea','Bornschein, Reinert & Pichorim, 1998','',360,1),(500,'Scytalopus Pachecoi ','Tapaculo-Ferreirinho','Maurício, 2005','',360,1),(501,'Scytalopus Speluncae ','Tapaculo-Preto','Wied, 1831','',360,1),(502,'Selenidera Maculirostris ','Araçaripoca','Lichtenstein, 1823','',361,1),(503,'Serpophaga Griseicapilla ','Alegrinho-Trinador','Straneck, 2007','',362,1),(504,'Serpophaga Munda ','Alegrinho-De-Barriga-Branca','Berlepsch, 1893','',362,1),(505,'Serpophaga Nigricans','João-Pobre','Vieillot, 1817','',362,1),(506,'Serpophaga Subcristata ','Alegrinho','Vieillot, 1817','',362,1),(507,'Sicalis Flaveola','Canário-Da-Terra-Verdadeiro','Linnaeus, 1766','',363,1),(508,'Sicalis Luteola ','Tipio','Sparrman, 1789','',363,1),(509,'Sirystes Sibilator ','Suiriri-Assobiador','Vieillot, 1818','',364,1),(510,'Sittasomus Griseicapillus ','Arapaçu-Verde','Vieillot, 1818','',365,1),(511,'Spartonoica Maluroides ','Boininha','D\'orbigny & Lafresnaye, 1837','',366,1),(512,'Spizaetus Melanoleucus ','Gavião-Pato','Vieillot, 1816','',368,1),(513,'Spizaetus Ornatus ','Gavião-De-Penacho','Daudin, 1800','',367,1),(514,'Spizaetus Tyrannus','Gavião-Pega-Macaco','Wied, 1820','',368,1),(515,'Sporagra Magellanica ','Pintassilgo','Vieillot, 1805','',369,1),(516,'Sporophila Angolensis','Curió','Linnaeus, 1766','',370,1),(517,'Sporophila Bouvreuil','Caboclinho','Statius Muller, 1776','',370,1),(518,'Sporophila Caerulescens ','Coleirinho','Vieillot, 1823','',370,1),(519,'Sporophila Cinnamomea ','Caboclinho-De-Chapéu-Cinzento','Lafresnaye, 1839','',370,1),(520,'Sporophila Collaris','Coleiro-Do-Brejo','Boddaert, 1783','',370,1),(521,'Sporophila Frontalis ','Pixoxó','Verreaux, 1869','',370,1),(522,'Sporophila Hypoxantha','Caboclinho-De-Barriga-Vermelha','Cabanis, 1851','',370,1),(523,'Sporophila Leucoptera ','Chorão','Vieillot, 1817','',370,1),(524,'Sporophila Lineola ','Bigodinho','Linnaeus, 1758','',370,1),(525,'Sporophila Melanogaster ','Caboclinho-De-Barriga-Preta','Pelzeln, 1870','',370,1),(526,'Sporophila Palustris ','Caboclinho-De-Papo-Branco','Barrows, 1883','',370,1),(527,'Sporophila Plumbea ','Patativa','Wied, 1830','',370,1),(528,'Sporophila Ruficollis ','Caboclinho-De-Papo-Escuro','Cabanis, 1851','',370,1),(529,'Stelgidopteryx Ruficollis','Andorinha-Serradora','Vieillot, 1817','',371,1),(530,'Stephanophorus Diadematus ','Sanhaçu-Frade','Temminck, 1823','',372,1),(531,'Stephanoxis Lalandi ','Beija-Flor-De-Topete','Vieillot, 1818','',373,1),(532,'Stercorarius Antarcticus ','Gaivota-Rapineira-Antártica','Lesson, 1831','',374,1),(533,'Stercorarius Chilensis ','Gaivota-Rapineira-Chilena','Bonaparte, 1857','',374,1),(534,'Stercorarius Longicaudus ','Gaivota-Rapineira-De-Cauda-Comprida','Vieillot, 1819','',374,1),(535,'Stercorarius Parasiticus ','Gaivota-Rapineira-Comum','Linnaeus, 1758','',374,1),(536,'Stercorarius Pomarinus ','Gaivota-Rapineira-Pomarina','Temminck, 1815','',374,1),(537,'Sterna Hirundinacea ','Trinta-Réis-De-Bico-Vermelho','Lesson, 1831','',375,1),(538,'Sterna Hirundo ','Trinta-Réis-Boreal','Linnaeus, 1758','',376,1),(539,'Sterna Paradisaea ','Trinta-Réis-ártico','Pontoppidan, 1763','',375,1),(540,'Sterna Trudeaui ','Trinta-Réis-De-Coroa-Branca','Audubon, 1838','',375,1),(541,'Sternula Antillarum ','Trinta-Réis-Miúdo','Lesson, 1847','',377,1),(542,'Sternula Superciliaris','Trinta-Réis-Anão','Vieillot, 1819','',377,1),(543,'Streptoprocne Biscutata ','Andorinhão-De-Coleira-Falha','Sclater, 1866','',378,1),(544,'Streptoprocne Zonaris ','Andorinhão-De-Coleira','Shaw, 1796','',378,1),(545,'Strix Hylophila ','Coruja-Listrada','Temminck, 1825','',379,1),(546,'Strix Virgata ','Coruja-Do-Mato','Cassin, 1849','',379,1),(547,'Sturnella Defilippii ','Peito-Vermelho-Grande','Bonaparte, 1850','',381,1),(548,'Sturnella Superciliaris ','Polícia-Inglesa','Bonaparte, 1850','',380,1),(549,'Stymphalornis Acutirostris ','Bicudinho-Do-Brejo','Bornschein, Reinert & Teixeira, 1995','',382,1),(550,'Sublegatus Modestus','Guaracava-Modesta','Wied, 1831','',383,1),(551,'Suiriri Suiriri ','Suiriri-Cinzento','Vieillot, 1818','',384,1),(552,'Synallaxis Albescens ','Uí-Pi','Temminck, 1823','',385,1),(553,'Synallaxis Cinerascens ','Pi-Puí','Temminck, 1823','',385,1),(554,'Synallaxis Frontalis ','Petrim','Pelzeln, 1859','',385,1),(555,'Synallaxis Ruficapilla ','Pichororé','Vieillot, 1819','',385,1),(556,'Synallaxis Spixi ','João-Teneném','Sclater, 1856','',385,1),(557,'Syndactyla Rufosuperciliata ','Trepador-Quiete','Lafresnaye, 1832','',386,1),(558,'Syrigma Sibilatrix ','Maria-Faceira','Temminck, 1824','',387,1),(559,'Tachuris Rubrigastra','Papa-Piri','Vieillot, 1817','',388,1),(560,'Tachybaptus Dominicus ','Mergulhão-Pequeno','Linnaeus, 1766','',389,1),(561,'Tachycineta Albiventer ','Andorinha-Do-Rio','Boddaert, 1783','',391,1),(562,'Tachycineta Leucopyga ','Andorinha-Chilena','Meyen ,1834','',390,1),(563,'Tachycineta Leucorrhoa ','Andorinha-De-Testa-Branca','Vieillot, 1817','',390,1),(564,'Tachyphonus Coronatus ','Tiê-Preto','Vieillot, 1822','',392,1),(565,'Tangara Cyanocephala ','Saíra-Militar','Statius Muller, 1776','',393,1),(566,'Tangara Cyanoptera ','Sanhaçu-De-Encontro-Azul','Vieillot, 1817','',393,1),(567,'Tangara Palmarum','Sanhaçu-Do-Coqueiro','Wied, 1823','',393,1),(568,'Tangara Peruviana','Saíra-Sapucaia','Desmarest, 1806','',393,1),(569,'Tangara Preciosa ','Saíra-Preciosa','Cabanis, 1850','',393,1),(570,'Tangara Sayaca','Sanhaçu-Cinzento','Linnaeus, 1766','',393,1),(571,'Tangara Seledon ','Saíra-De-Sete-Cores','Statius Muller, 1776','',393,1),(572,'Tapera Naevia ','Saci','Linnaeus, 1766','',394,1),(573,'Tersina Viridis ','Saí-Andorinha','Illiger, 1811','',395,1),(574,'Thalasseus Acuflavidus ','Trinta-Réis-De-Bico-Amarelo','Cabot, 1847','',396,1),(575,'Thalasseus Maximus ','Trinta-Réis-Real','Boddaert, 1783','',396,1),(576,'Thalurania Glaucopis ','Beija-Flor-De-Fronte-Violeta','Gmelin, 1788','',397,1),(577,'Thamnophilus Caerulescens ','Choca-Da-Mata','Vieillot, 1816','',398,1),(578,'Thamnophilus Ruficapillus ','Choca-De-Boné-Vermelho','Vieillot, 1816','',398,1),(579,'Theristicus Caerulescens','Maçarico-Real','Vieillot, 1817','',399,1),(580,'Theristicus Caudatus ','Curicaca','Boddaert, 1783','',399,1),(581,'Tigrisoma Lineatum ','Socó-Boi-Verdadeiro','Boddaert, 1783','',400,1),(582,'Tinamus Solitarius ','Macuco','Vieillot, 1819','',401,1),(583,'Tityra Cayana ','Anambé-Branco-De-Rabo-Preto','Linnaeus, 1766','',402,1),(584,'Tityra Inquisitor','Anambé-Branco-De-Bochecha-Parda','Lichtenstein, 1823','',402,1),(585,'Tolmomyias Sulphurescens ','Bico-Chato-De-Orelha-Preta','Spix, 1825','',403,1),(586,'Triclaria Malachitacea','Sabiá-Cica','Spix, 1824','',404,1),(587,'Tringa Flavipes','Maçarico-De-Perna-Amarela','Gmelin, 1789','',405,1),(588,'Tringa Melanoleuca ','Maçarico-Grande-De-Perna-Amarela','Gmelin, 1789','',405,1),(589,'Tringa Semipalmata ','Maçarico-De-Asa-Branca','Gmelin, 1789','',405,1),(590,'Tringa Solitaria ','Maçarico-Solitário','Wilson, 1813','',405,1),(591,'Troglodytes Musculus ','Corruíra','Naumann, 1823','',406,1),(592,'Trogon Rufus ','Surucuá-De-Barriga-Amarela','Gmelin, 1788','',407,1),(593,'Trogon Surrucura ','Surucuá-Variado','Vieillot, 1817','',407,1),(594,'Tryngites Subruficollis ','Maçarico-Acanelado','Vieillot, 1819','',408,1),(595,'Turdus Albicollis ','Sabiá-Coleira','Vieillot, 1818','',409,1),(596,'Turdus Amaurochalinus ','Sabiá-Poca','Cabanis, 1850','',409,1),(597,'Turdus Flavipes ','Sabiá-Una','Vieillot, 1818','',410,1),(598,'Turdus Leucomelas ','Sabiá-Barranco','Vieillot, 1818','',409,1),(599,'Turdus Rufiventris ','Sabiá-Laranjeira','Vieillot, 1818','',409,1),(600,'Turdus Subalaris ','Sabiá-Ferreiro','Seebohm, 1887','',409,1),(601,'Tyranniscus Burmeisteri ','Piolhinho-Chiador','Cabanis & Heine, 1859','',411,1),(602,'Tyrannus Melancholicus ','Suiriri','Vieillot, 1819','',412,1),(603,'Tyrannus Savana ','Tesourinha','Vieillot, 1808','',413,1),(604,'Tyto Alba ','Coruja-De-Igreja','Scopoli, 1769','',414,1),(605,'Urubitinga Coronata ','águia-Cinzenta','Vieillot, 1817','',415,1),(606,'Urubitinga Urubitinga ','Gavião-Preto','Gmelin, 1788','',415,1),(607,'Vanellus Chilensis','Quero-Quero','Molina, 1782','',416,1),(608,'Veniliornis Mixtus ','Picapauzinho-Chorão','Boddaert, 1783','',418,1),(609,'Veniliornis Spilogaster ','Picapauzinho-Verde-Carijó','Wagler, 1827','',417,1),(610,'Vireo Olivaceus ','Juruviara','Linnaeus, 1766','',419,1),(611,'Volatinia Jacarina ','Tiziu','Linnaeus, 1766','',420,1),(612,'Xanthopsar Flavus ','Veste-Amarela','Gmelin, 1788','',421,1),(613,'Xema Sabini ','Gaivota-De-Sabine','Sabine, 1819','',422,1),(614,'Xenops Rutilans ','Bico-Virado-Carijó','Temminck, 1821','',423,1),(615,'Xenopsaris Albinucha ','Tijerila','Burmeister, 1869','',424,1),(616,'Xiphocolaptes Albicollis ','Arapaçu-Grande-De-Garganta-Branca','Vieillot, 1818','',425,1),(617,'Xiphorhynchus Fuscus ','Arapaçu-Rajado','Vieillot, 1818','',426,1),(618,'Xolmis Cinereus','Primavera','Vieillot, 1816','',427,1),(619,'Xolmis Coronatus ','Noivinha-Coroada','Vieillot, 1823','',427,1),(620,'Xolmis Dominicanus ','Noivinha-De-Rabo-Preto','Vieillot, 1823','',427,1),(621,'Xolmis Irupero ','Noivinha','Vieillot, 1823','',427,1),(622,'Zenaida Auriculata ','Pomba-De-Bando','Des Murs, 1847','',428,1),(623,'Zonotrichia Capensis ','Tico-Tico','Statius Muller, 1776','',429,1);
/*!40000 ALTER TABLE `Especie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Ordem`
--

DROP TABLE IF EXISTS `Ordem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Ordem` (
  `idOrdem` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCientifico` varchar(255) NOT NULL,
  `NomeComum` varchar(255) DEFAULT NULL,
  `Descricao` text,
  `idFilo` int(11) NOT NULL,
  PRIMARY KEY (`idOrdem`),
  KEY `fk_Ordem_Filo1` (`idFilo`),
  CONSTRAINT `fk_Ordem_Filo1` FOREIGN KEY (`idFilo`) REFERENCES `Filo` (`idFilo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Ordem`
--

LOCK TABLES `Ordem` WRITE;
/*!40000 ALTER TABLE `Ordem` DISABLE KEYS */;
INSERT INTO `Ordem` VALUES (1,'Accipitriformes','','',1),(2,'Anseriformes','','',1),(3,'Apodiformes ','','',1),(4,'Caprimulgiformes ','','',1),(5,'Cariamiformes ','','',1),(6,'Cathartiformes ','','',1),(7,'Charadriiformes ','','',1),(8,'Ciconiiformes ','','',1),(9,'Columbiformes ','','',1),(10,'Coraciiformes ','','',1),(11,'Cuculiformes ','','',1),(12,'Falconiformes ','','',1),(13,'Galbuliformes ','','',1),(14,'Galliformes','','',1),(15,'Gruiformes ','','',1),(16,'Passeriformes ','','',1),(17,'Pelecaniformes ','','',1),(18,'Phoenicopteriformes ','','',1),(19,'Piciformes ','','',1),(20,'Podicipediformes','','',1),(21,'Psittaciformes ','','',1),(22,'Strigiformes ','','',1),(23,'Struthioniformes','','',1),(24,'Tinamiformes','','',1),(25,'Trogoniformes ','','',1);
/*!40000 ALTER TABLE `Ordem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Atributo`
--

DROP TABLE IF EXISTS `Atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Atributo` (
  `idAtributo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `idTipoDado` int(11) NOT NULL,
  `idTipoAtributo` int(11) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`idAtributo`),
  KEY `fk_Propriedade_TipoAtributo1` (`idTipoAtributo`),
  KEY `fk_Atributo_TipoDado1` (`idTipoDado`),
  CONSTRAINT `fk_Propriedade_TipoAtributo1` FOREIGN KEY (`idTipoAtributo`) REFERENCES `TipoAtributo` (`idTipoAtributo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atributo_TipoDado1` FOREIGN KEY (`idTipoDado`) REFERENCES `TipoDado` (`idTipoDado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Atributo`
--

LOCK TABLES `Atributo` WRITE;
/*!40000 ALTER TABLE `Atributo` DISABLE KEYS */;
/*!40000 ALTER TABLE `Atributo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Projeto`
--

DROP TABLE IF EXISTS `Projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Projeto` (
  `idProjeto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `Data_Inicio` date NOT NULL,
  `Data_Fim` date DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  `idPesquisadorResponsavel` int(11) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`idProjeto`),
  KEY `fk_Projeto_Pesquisador1` (`idPesquisadorResponsavel`),
  CONSTRAINT `fk_Projeto_Pesquisador1` FOREIGN KEY (`idPesquisadorResponsavel`) REFERENCES `Pesquisador` (`idPesquisador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Projeto`
--

LOCK TABLES `Projeto` WRITE;
/*!40000 ALTER TABLE `Projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `Projeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoOrganismo`
--

DROP TABLE IF EXISTS `TipoOrganismo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoOrganismo` (
  `idTipoOrganismo` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`idTipoOrganismo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoOrganismo`
--

LOCK TABLES `TipoOrganismo` WRITE;
/*!40000 ALTER TABLE `TipoOrganismo` DISABLE KEYS */;
INSERT INTO `TipoOrganismo` VALUES (1,'Aves',NULL);
/*!40000 ALTER TABLE `TipoOrganismo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ColetaItemPropriedade`
--

DROP TABLE IF EXISTS `ColetaItemPropriedade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ColetaItemPropriedade` (
  `idColetaItemPropriedade` int(11) NOT NULL AUTO_INCREMENT,
  `idColetaItem` int(11) NOT NULL,
  `idTipoOrganismo` int(11) NOT NULL,
  `idAtributo` int(11) NOT NULL,
  `value` text NOT NULL,
  `impossivelColetar` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idColetaItemPropriedade`),
  KEY `fk_ColetaItemPropriedade_ColetaItem1` (`idColetaItem`),
  KEY `fk_ColetaItemPropriedade_TipoOrganismo_has_Atributo1` (`idTipoOrganismo`,`idAtributo`),
  CONSTRAINT `fk_ColetaItemPropriedade_ColetaItem1` FOREIGN KEY (`idColetaItem`) REFERENCES `ColetaItem` (`idColetaItem`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ColetaItemPropriedade_TipoOrganismo_has_Atributo1` FOREIGN KEY (`idTipoOrganismo`, `idAtributo`) REFERENCES `TipoOrganismo_has_Atributo` (`idTipoOrganismo`, `idAtributo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ColetaItemPropriedade`
--

LOCK TABLES `ColetaItemPropriedade` WRITE;
/*!40000 ALTER TABLE `ColetaItemPropriedade` DISABLE KEYS */;
/*!40000 ALTER TABLE `ColetaItemPropriedade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoDado`
--

DROP TABLE IF EXISTS `TipoDado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoDado` (
  `idTipoDado` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(255) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`idTipoDado`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoDado`
--

LOCK TABLES `TipoDado` WRITE;
/*!40000 ALTER TABLE `TipoDado` DISABLE KEYS */;
INSERT INTO `TipoDado` VALUES (1,'Inteiro',NULL),(2,'Real',NULL),(3,'TextoCurto',NULL),(4,'TextoLongo','');
/*!40000 ALTER TABLE `TipoDado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ColetaItem`
--

DROP TABLE IF EXISTS `ColetaItem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ColetaItem` (
  `idColetaItem` int(11) NOT NULL AUTO_INCREMENT,
  `idColeta` int(11) NOT NULL,
  `idEspecie` int(11) NOT NULL,
  PRIMARY KEY (`idColetaItem`),
  KEY `fk_ColetaItem_Coleta1` (`idColeta`),
  KEY `fk_ColetaItem_Especie1` (`idEspecie`),
  CONSTRAINT `fk_ColetaItem_Coleta1` FOREIGN KEY (`idColeta`) REFERENCES `Coleta` (`idColeta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ColetaItem_Especie1` FOREIGN KEY (`idEspecie`) REFERENCES `Especie` (`idEspecie`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ColetaItem`
--

LOCK TABLES `ColetaItem` WRITE;
/*!40000 ALTER TABLE `ColetaItem` DISABLE KEYS */;
/*!40000 ALTER TABLE `ColetaItem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoAtributo`
--

DROP TABLE IF EXISTS `TipoAtributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoAtributo` (
  `idTipoAtributo` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(45) NOT NULL,
  `Descricao` text,
  PRIMARY KEY (`idTipoAtributo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoAtributo`
--

LOCK TABLES `TipoAtributo` WRITE;
/*!40000 ALTER TABLE `TipoAtributo` DISABLE KEYS */;
INSERT INTO `TipoAtributo` VALUES (1,'Atributo Funcional',NULL),(2,'Atributo de Comunidade',NULL);
/*!40000 ALTER TABLE `TipoAtributo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TipoOrganismo_has_Atributo`
--

DROP TABLE IF EXISTS `TipoOrganismo_has_Atributo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TipoOrganismo_has_Atributo` (
  `idTipoOrganismo` int(11) NOT NULL,
  `idAtributo` int(11) NOT NULL,
  PRIMARY KEY (`idTipoOrganismo`,`idAtributo`),
  KEY `fk_TipoOrganismo_has_Atributo_Atributo1` (`idAtributo`),
  KEY `fk_TipoOrganismo_has_Atributo_TipoOrganismo1` (`idTipoOrganismo`),
  CONSTRAINT `fk_TipoOrganismo_has_Atributo_TipoOrganismo1` FOREIGN KEY (`idTipoOrganismo`) REFERENCES `TipoOrganismo` (`idTipoOrganismo`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TipoOrganismo_has_Atributo_Atributo1` FOREIGN KEY (`idAtributo`) REFERENCES `Atributo` (`idAtributo`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TipoOrganismo_has_Atributo`
--

LOCK TABLES `TipoOrganismo_has_Atributo` WRITE;
/*!40000 ALTER TABLE `TipoOrganismo_has_Atributo` DISABLE KEYS */;
/*!40000 ALTER TABLE `TipoOrganismo_has_Atributo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pesquisador`
--

DROP TABLE IF EXISTS `Pesquisador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pesquisador` (
  `idPesquisador` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `lattes` varchar(255) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `Resumo` text,
  PRIMARY KEY (`idPesquisador`),
  UNIQUE KEY `lattes_UNIQUE` (`lattes`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pesquisador`
--

LOCK TABLES `Pesquisador` WRITE;
/*!40000 ALTER TABLE `Pesquisador` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pesquisador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Genero`
--

DROP TABLE IF EXISTS `Genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Genero` (
  `idGenero` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCientifico` varchar(255) NOT NULL,
  `NomeComum` varchar(255) DEFAULT NULL,
  `Descricao` text,
  `idFamilia` int(11) NOT NULL,
  PRIMARY KEY (`idGenero`),
  KEY `fk_Genero_Familia1` (`idFamilia`),
  CONSTRAINT `fk_Genero_Familia1` FOREIGN KEY (`idFamilia`) REFERENCES `Familia` (`idFamilia`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=430 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Genero`
--

LOCK TABLES `Genero` WRITE;
/*!40000 ALTER TABLE `Genero` DISABLE KEYS */;
INSERT INTO `Genero` VALUES (1,'Aburria ','','',23),(2,'Accipiter','','',1),(3,'Actitis','','',63),(4,'Aegolius ','','',66),(5,'Agelaioides ','','',35),(6,'Agelasticus','','',35),(7,'Agelasticus ','','',35),(8,'Agriornis ','','',76),(9,'Alectrurus ','','',76),(10,'Alopochelidon','','',34),(11,'Amazilia ','','',72),(12,'Amazona ','','',53),(13,'Amazonetta','','',4),(14,'Amblyramphus ','','',35),(15,'Ammodramus ','','',26),(16,'Anabacerthia ','','',31),(17,'Anas','','',4),(18,'Anhinga ','','',6),(19,'Anodorhynchus','','',53),(20,'Anous ','','',65),(21,'Anthracothorax ','','',72),(22,'Anthus','','',41),(23,'Antrostomus ','','',11),(24,'Anumbius','','',31),(25,'Aphantochroa ','','',72),(26,'Aramides ','','',54),(27,'Aramus','','',8),(28,'Aratinga ','','',53),(29,'Ardea','','',9),(30,'Arenaria','','',63),(31,'Arremon ','','',26),(32,'Arundinicola','','',76),(33,'Asio ','','',66),(34,'Asthenes','','',31),(35,'Athene ','','',66),(36,'Attila','','',76),(37,'Attila ','','',76),(38,'Automolus','','',31),(39,'Bartramia','','',63),(40,'Baryphthengus','','',40),(41,'Basileuterus','','',45),(42,'Basileuterus ','','',45),(43,'Batara ','','',67),(44,'Botaurus','','',9),(45,'Brotogeris','','',53),(46,'Bubo','','',66),(47,'Bubulcus','','',9),(48,'Busarellus','','',1),(49,'Buteo','','',1),(50,'Butorides','','',9),(51,'Cacicus ','','',35),(52,'Cairina ','','',4),(53,'Calidris ','','',63),(54,'Calliphlox','','',72),(55,'Callonetta','','',4),(56,'Campephilus ','','',49),(57,'Camptostoma','','',76),(58,'Campylorhamphus','','',25),(59,'Capsiempis ','','',76),(60,'Caracara','','',28),(61,'Carduelis ','','',30),(62,'Cariama','','',13),(63,'Carpornis ','','',22),(64,'Cathartes','','',14),(65,'Celeus','','',49),(66,'Certhiaxis','','',31),(67,'Chaetura ','','',7),(68,'Chamaeza ','','',29),(69,'Charadrius','','',15),(70,'Charadrius ','','',15),(71,'Chauna','','',5),(72,'Chionis ','','',16),(73,'Chiroxiphia','','',50),(74,'Chlidonias','','',65),(75,'Chloris ','','',30),(76,'Chloroceryle','','',2),(77,'Chloroceryle ','','',2),(78,'Chlorophonia','','',30),(79,'Chlorostilbon ','','',72),(80,'Chondrohierax','','',1),(81,'Chordeiles ','','',11),(82,'Chroicocephalus','','',38),(83,'Chroicocephalus ','','',38),(84,'Chrysomus ','','',35),(85,'Cichlocolaptes','','',31),(86,'Ciconia','','',17),(87,'Cinclodes','','',31),(88,'Circus','','',1),(89,'Circus ','','',1),(90,'Cissopis','','',68),(91,'Cistothorus ','','',73),(92,'Claravis','','',19),(93,'Clibanornis','','',31),(94,'Clytolaema','','',72),(95,'Cnemotriccus','','',76),(96,'Coccyzus','','',24),(97,'Coccyzus ','','',24),(98,'Coereba ','','',18),(99,'Colaptes ','','',49),(100,'Colibri','','',72),(101,'Colonia ','','',76),(102,'Columba','','',19),(103,'Columbina','','',19),(104,'Conirostrum','','',68),(105,'Conopophaga','','',20),(106,'Contopus','','',76),(107,'Coragyps','','',14),(108,'Coryphistera ','','',31),(109,'Corythopis','','',59),(110,'Coscoroba','','',4),(111,'Coturnicops','','',54),(112,'Cranioleuca ','','',31),(113,'Crotophaga ','','',24),(114,'Crypturellus','','',70),(115,'Crypturellus ','','',70),(116,'Culicivora','','',76),(117,'Cyanocorax','','',21),(118,'Cyanoloxia','','',12),(119,'Cyclarhis','','',78),(120,'Cygnus','','',4),(121,'Cypseloides','','',7),(122,'Dacnis','','',68),(123,'Dendrocincla','','',25),(124,'Dendrocolaptes ','','',25),(125,'Dendrocygna','','',4),(126,'Diuca ','','',68),(127,'Dolichonyx','','',35),(128,'Donacospiza a','','',26),(129,'Dromococcyx ','','',24),(130,'Drymophila','','',67),(131,'Drymophila ','','',67),(132,'Drymornis ','','',25),(133,'Dryocopus ','','',49),(134,'Dysithamnus ','','',67),(135,'Egretta','','',9),(136,'Egretta ','','',9),(137,'Elaenia','','',76),(138,'Elanoides','','',1),(139,'Elanus','','',1),(140,'Eleoscytalopus ','','',58),(141,'Emberizoides','','',26),(142,'Empidonomus ','','',76),(143,'Estrilda ','','',27),(144,'Eupetomena ','','',72),(145,'Euphonia','','',30),(146,'Euscarthmus','','',76),(147,'Falco','','',28),(148,'Florisuga','','',72),(149,'Fluvicola ','','',76),(150,'Formicarius','','',29),(151,'Fulica','','',54),(152,'Furnarius ','','',31),(153,'Gallinago','','',63),(154,'Gallinula','','',54),(155,'Gelochelidon ','','',65),(156,'Geositta ','','',62),(157,'Geothlypis','','',45),(158,'Geotrygon','','',19),(159,'Geranoaetus','','',1),(160,'Geranospiza','','',1),(161,'Glaucidium ','','',66),(162,'Gnorimopsar ','','',35),(163,'Grallaria','','',32),(164,'Griseotyrannus ','','',76),(165,'Gubernatrix ','','',26),(166,'Gubernetes ','','',76),(167,'Guira','','',24),(168,'Habia','','',12),(169,'Haematopus','','',33),(170,'Haplospiza','','',26),(171,'Harpagus','','',1),(172,'Harpia','','',1),(173,'Heliobletus ','','',31),(174,'Heliomaster','','',72),(175,'Hemithraupis ','','',68),(176,'Hemitriccus','','',59),(177,'Hemitriccus ','','',59),(178,'Herpetotheres','','',28),(179,'Heteronetta','','',4),(180,'Heterospizias ','','',1),(181,'Himantopus ','','',56),(182,'Hirundinea','','',76),(183,'Hirundo ','','',34),(184,'Hydropsalis ','','',11),(185,'Hylocharis ','','',72),(186,'Hylopezus','','',32),(187,'Hylophilus','','',78),(188,'Hymenops ','','',76),(189,'Hypoedaleus','','',67),(190,'Icterus','','',35),(191,'Ictinia','','',1),(192,'Ixobrychus','','',9),(193,'Jabiru','','',17),(194,'Jacana ','','',37),(195,'Knipolegus ','','',76),(196,'Lanio','','',68),(197,'Larus ','','',38),(198,'Laterallus','','',54),(199,'Laterallus ','','',54),(200,'Lathrotriccus','','',76),(201,'Legatus ','','',76),(202,'Lepidocolaptes','','',25),(203,'Leptasthenura ','','',31),(204,'Leptodon','','',1),(205,'Leptopogon ','','',59),(206,'Leptotila','','',19),(207,'Leptotila ','','',19),(208,'Lessonia ','','',76),(209,'Leucochloris','','',72),(210,'Leucophaeus','','',38),(211,'Limnoctites ','','',31),(212,'Limnodromus','','',63),(213,'Limnornis ','','',31),(214,'Limosa','','',63),(215,'Lochmias ','','',31),(216,'Lophornis ','','',72),(217,'Lurocalis ','','',11),(218,'Machetornis','','',76),(219,'Mackenziaena','','',67),(220,'Mackenziaena ','','',67),(221,'Manacus ','','',50),(222,'Megaceryle','','',2),(223,'Megarynchus ','','',76),(224,'Megascops ','','',66),(225,'Melanerpes','','',49),(226,'Mesembrinibis','','',69),(227,'Micrastur','','',28),(228,'Micrococcyx','','',24),(229,'Milvago','','',28),(230,'Mimus ','','',39),(231,'Mionectes ','','',59),(232,'Molothrus','','',35),(233,'Molothrus ','','',35),(234,'Morphnus','','',1),(235,'Muscipipra','','',76),(236,'Mycteria','','',17),(237,'Myiarchus','','',76),(238,'Myiarchus ','','',76),(239,'Myiodynastes ','','',76),(240,'Myiopagis','','',76),(241,'Myiophobus','','',76),(242,'Myiopsitta','','',53),(243,'Myiornis','','',59),(244,'Myiozetetes ','','',76),(245,'Myrmeciza ','','',67),(246,'Myrmotherula','','',67),(247,'Nemosia','','',68),(248,'Neocrex','','',54),(249,'Neoxolmis','','',76),(250,'Netta','','',3),(251,'Netta','','',4),(252,'Nomonyx','','',4),(253,'Nonnula ','','',10),(254,'Notharchus ','','',10),(255,'Nothura ','','',70),(256,'Numenius ','','',63),(257,'Nyctanassa','','',9),(258,'Nyctibius','','',42),(259,'Nycticorax','','',9),(260,'Nycticryphes','','',60),(261,'Nystalus','','',10),(262,'Odontophorus','','',43),(263,'Oreopholus ','','',15),(264,'Ortalis ','','',23),(265,'Orthogonys ','','',68),(266,'Oxyruncus ','','',71),(267,'Oxyura','','',4),(268,'Pachyramphus','','',71),(269,'Pachyramphus ','','',71),(270,'Pandion ','','',44),(271,'Parabuteo ','','',1),(272,'Pardirallus','','',54),(273,'Pardirallus ','','',54),(274,'Paroaria ','','',68),(275,'Parula','','',45),(276,'Passer ','','',46),(277,'Patagioenas','','',19),(278,'Penelope','','',23),(279,'Penelope ','','',23),(280,'Petrochelidon ','','',34),(281,'Phacellodomus ','','',31),(282,'Phaethornis','','',72),(283,'Phaetusa','','',65),(284,'Phalacrocorax','','',47),(285,'Phalaropus ','','',63),(286,'Phibalura ','','',22),(287,'Philomachus ','','',63),(288,'Philydor','','',31),(289,'Philydor ','','',31),(290,'Phimosus','','',69),(291,'Phleocryptes ','','',31),(292,'Phoenicoparrus','','',48),(293,'Phoenicopterus ','','',48),(294,'Phrygilus ','','',26),(295,'Phyllomyias','','',76),(296,'Phyllomyias ','','',76),(297,'Phylloscartes','','',59),(298,'Phytotoma','','',22),(299,'Piaya','','',24),(300,'Piculus','','',49),(301,'Picumnus','','',49),(302,'Picumnus ','','',49),(303,'Pionopsitta ','','',53),(304,'Pionus','','',53),(305,'Pipraeidea ','','',68),(306,'Piprites','','',36),(307,'Piprites ','','',36),(308,'Piranga','','',12),(309,'Pitangus ','','',76),(310,'Platalea','','',69),(311,'Platyrinchus ','','',36),(312,'Plegadis','','',69),(313,'Pluvialis','','',15),(314,'Pluvialis ','','',15),(315,'Podicephorus','','',51),(316,'Podilymbus','','',51),(317,'Poecilotriccus','','',59),(318,'Polioptila','','',52),(319,'Polioptila ','','',52),(320,'Polystictus','','',76),(321,'Polytmus','','',72),(322,'Poospiza ','','',26),(323,'Porphyrio','','',54),(324,'Porzana','','',54),(325,'Primolius ','','',53),(326,'Procacicus ','','',35),(327,'Procnias ','','',22),(328,'Progne','','',34),(329,'Pseudastur','','',1),(330,'Pseudocolopteryx','','',76),(331,'Pseudocolopteryx ','','',76),(332,'Pseudoleistes','','',35),(333,'Pseudoleistes ','','',35),(334,'Pseudoseisura','','',31),(335,'Psilorhamphus ','','',58),(336,'Pteroglossus','','',55),(337,'Pulsatrix','','',66),(338,'Pygochelidon ','','',34),(339,'Pyriglena ','','',67),(340,'Pyrocephalus','','',76),(341,'Pyroderus ','','',22),(342,'Pyrrhocoma','','',68),(343,'Pyrrhura','','',53),(344,'Ramphastos','','',55),(345,'Ramphastos ','','',55),(346,'Rhea','','',57),(347,'Rhynchotus','','',70),(348,'Riparia','','',34),(349,'Rollandia','','',51),(350,'Rostrhamus ','','',1),(351,'Rupornis','','',1),(352,'Rynchops','','',61),(353,'Saltator ','','',68),(354,'Sarcoramphus','','',14),(355,'Sarkidiornis ','','',4),(356,'Satrapa','','',76),(357,'Schiffornis','','',71),(358,'Schoeniophylax','','',31),(359,'Sclerurus ','','',62),(360,'Scytalopus','','',58),(361,'Selenidera','','',55),(362,'Serpophaga','','',76),(363,'Sicalis ','','',26),(364,'Sirystes','','',76),(365,'Sittasomus ','','',25),(366,'Spartonoica','','',31),(367,'Spizaetus','','',1),(368,'Spizaetus ','','',1),(369,'Sporagra ','','',30),(370,'Sporophila ','','',26),(371,'Stelgidopteryx','','',34),(372,'Stephanophorus ','','',68),(373,'Stephanoxis','','',72),(374,'Stercorarius ','','',64),(375,'Sterna','','',65),(376,'Sterna ','','',65),(377,'Sternula ','','',65),(378,'Streptoprocne','','',7),(379,'Strix ','','',66),(380,'Sturnella','','',35),(381,'Sturnella ','','',35),(382,'Stymphalornis','','',67),(383,'Sublegatus','','',76),(384,'Suiriri ','','',76),(385,'Synallaxis ','','',31),(386,'Syndactyla ','','',31),(387,'Syrigma','','',9),(388,'Tachuris ','','',36),(389,'Tachybaptus','','',51),(390,'Tachycineta','','',34),(391,'Tachycineta ','','',34),(392,'Tachyphonus ','','',68),(393,'Tangara','','',68),(394,'Tapera ','','',24),(395,'Tersina ','','',68),(396,'Thalasseus ','','',65),(397,'Thalurania','','',72),(398,'Thamnophilus','','',67),(399,'Theristicus','','',69),(400,'Tigrisoma','','',9),(401,'Tinamus','','',70),(402,'Tityra','','',71),(403,'Tolmomyias','','',59),(404,'Triclaria','','',53),(405,'Tringa','','',63),(406,'Troglodytes ','','',73),(407,'Trogon ','','',74),(408,'Tryngites ','','',63),(409,'Turdus','','',75),(410,'Turdus ','','',75),(411,'Tyranniscus','','',76),(412,'Tyrannus','','',76),(413,'Tyrannus ','','',76),(414,'Tyto ','','',77),(415,'Urubitinga ','','',1),(416,'Vanellus ','','',15),(417,'Veniliornis','','',49),(418,'Veniliornis ','','',49),(419,'Vireo','','',78),(420,'Volatinia','','',26),(421,'Xanthopsar ','','',35),(422,'Xema','','',38),(423,'Xenops ','','',31),(424,'Xenopsaris ','','',71),(425,'Xiphocolaptes ','','',25),(426,'Xiphorhynchus ','','',25),(427,'Xolmis ','','',76),(428,'Zenaida ','','',19),(429,'Zonotrichia ','','',26);
/*!40000 ALTER TABLE `Genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Coleta`
--

DROP TABLE IF EXISTS `Coleta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Coleta` (
  `idColeta` int(11) NOT NULL AUTO_INCREMENT,
  `Data_Coleta` date NOT NULL,
  `Observacao` text,
  `idUnidadeGeografica` int(11) NOT NULL,
  `coordenadaGeografica` point DEFAULT NULL,
  PRIMARY KEY (`idColeta`),
  KEY `fk_Coleta_UnidadeGeografica1` (`idUnidadeGeografica`),
  CONSTRAINT `fk_Coleta_UnidadeGeografica1` FOREIGN KEY (`idUnidadeGeografica`) REFERENCES `UnidadeGeografica` (`idUnidadeGeografica`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Coleta`
--

LOCK TABLES `Coleta` WRITE;
/*!40000 ALTER TABLE `Coleta` DISABLE KEYS */;
/*!40000 ALTER TABLE `Coleta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UnidadeGeografica`
--

DROP TABLE IF EXISTS `UnidadeGeografica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UnidadeGeografica` (
  `idUnidadeGeografica` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(255) NOT NULL,
  `shape` polygon NOT NULL,
  `Data_Criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `idProjeto` int(11) NOT NULL,
  `idPesquisador` int(11) NOT NULL,
  `idUnidadeGeograficaPai` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUnidadeGeografica`),
  KEY `fk_UnidadeGeografica_Projeto1` (`idProjeto`),
  KEY `fk_UnidadeGeografica_Pesquisador1` (`idPesquisador`),
  KEY `fk_UnidadeGeografica_UnidadeGeografica1` (`idUnidadeGeograficaPai`),
  CONSTRAINT `fk_UnidadeGeografica_Pesquisador1` FOREIGN KEY (`idPesquisador`) REFERENCES `Pesquisador` (`idPesquisador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UnidadeGeografica_Projeto1` FOREIGN KEY (`idProjeto`) REFERENCES `Projeto` (`idProjeto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_UnidadeGeografica_UnidadeGeografica1` FOREIGN KEY (`idUnidadeGeograficaPai`) REFERENCES `UnidadeGeografica` (`idUnidadeGeografica`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UnidadeGeografica`
--

LOCK TABLES `UnidadeGeografica` WRITE;
/*!40000 ALTER TABLE `UnidadeGeografica` DISABLE KEYS */;
/*!40000 ALTER TABLE `UnidadeGeografica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Familia`
--

DROP TABLE IF EXISTS `Familia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Familia` (
  `idFamilia` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCientifico` varchar(255) NOT NULL,
  `NomeComum` varchar(255) DEFAULT NULL,
  `Descricao` text,
  `idOrdem` int(11) NOT NULL,
  PRIMARY KEY (`idFamilia`),
  KEY `fk_Familia_Ordem1` (`idOrdem`),
  CONSTRAINT `fk_Familia_Ordem1` FOREIGN KEY (`idOrdem`) REFERENCES `Ordem` (`idOrdem`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Familia`
--

LOCK TABLES `Familia` WRITE;
/*!40000 ALTER TABLE `Familia` DISABLE KEYS */;
INSERT INTO `Familia` VALUES (1,'Accipitridae ','','',1),(2,'Alcedinidae ','','',10),(3,'Anatidae','','',2),(4,'Anatidae ','','',2),(5,'Anhimidae','','',2),(6,'Anhingidae ','','',8),(7,'Apodidae ','','',3),(8,'Aramidae ','','',15),(9,'Ardeidae ','','',17),(10,'Bucconidae ','','',13),(11,'Caprimulgidae ','','',4),(12,'Cardinalidae ','','',16),(13,'Cariamidae ','','',5),(14,'Cathartidae ','','',6),(15,'Charadriidae ','','',7),(16,'Chionidae ','','',7),(17,'Ciconiidae ','','',8),(18,'Coerebidae ','','',16),(19,'Columbidae ','','',9),(20,'Conopophagidae ','','',16),(21,'Corvidae ','','',16),(22,'Cotingidae ','','',16),(23,'Cracidae','','',14),(24,'Cuculidae ','','',11),(25,'Dendrocolaptidae ','','',16),(26,'Emberizidae ','','',16),(27,'Estrildidae ','','',16),(28,'Falconidae ','','',12),(29,'Formicariidae ','','',16),(30,'Fringillidae ','','',16),(31,'Furnariidae ','','',16),(32,'Grallariidae ','','',16),(33,'Haematopodidae ','','',7),(34,'Hirundinidae ','','',16),(35,'Icteridae ','','',16),(36,'Incertae sedis','','',16),(37,'Jacanidae ','','',7),(38,'Laridae ','','',7),(39,'Mimidae ','','',16),(40,'Momotidae ','','',10),(41,'Motacillidae ','','',16),(42,'Nyctibiidae ','','',4),(43,'Odontophoridae','','',14),(44,'Pandionidae ','','',1),(45,'Parulidae ','','',16),(46,'Passeridae ','','',16),(47,'Phalacrocoracidae ','','',8),(48,'Phoenicopteridae ','','',18),(49,'Picidae ','','',19),(50,'Pipridae ','','',16),(51,'Podicipedidae','','',20),(52,'Polioptilidae ','','',16),(53,'Psittacidae ','','',21),(54,'Rallidae ','','',15),(55,'Ramphastidae ','','',19),(56,'Recurvirostridae ','','',7),(57,'Rheidae','','',23),(58,'Rhinocryptidae ','','',16),(59,'Rhynchocyclidae','','',16),(60,'Rostratulidae ','','',7),(61,'Rynchopidae ','','',7),(62,'Scleruridae ','','',16),(63,'Scolopacidae ','','',7),(64,'Stercorariidae ','','',7),(65,'Sternidae ','','',7),(66,'Strigidae ','','',22),(67,'Thamnophilidae ','','',16),(68,'Thraupidae ','','',16),(69,'Threskiornithidae ','','',17),(70,'Tinamidae','','',24),(71,'Tityridae ','','',16),(72,'Trochilidae ','','',3),(73,'Troglodytidae ','','',16),(74,'Trogonidae ','','',25),(75,'Turdidae ','','',16),(76,'Tyrannidae ','','',16),(77,'Tytonidae ','','',22),(78,'Vireonidae ','','',16);
/*!40000 ALTER TABLE `Familia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pesquisador_has_Projeto`
--

DROP TABLE IF EXISTS `Pesquisador_has_Projeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Pesquisador_has_Projeto` (
  `idPesquisador` int(11) NOT NULL,
  `idProjeto` int(11) NOT NULL,
  PRIMARY KEY (`idPesquisador`,`idProjeto`),
  KEY `fk_Pesquisador_has_Projeto_Projeto1` (`idProjeto`),
  KEY `fk_Pesquisador_has_Projeto_Pesquisador1` (`idPesquisador`),
  CONSTRAINT `fk_Pesquisador_has_Projeto_Pesquisador1` FOREIGN KEY (`idPesquisador`) REFERENCES `Pesquisador` (`idPesquisador`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Pesquisador_has_Projeto_Projeto1` FOREIGN KEY (`idProjeto`) REFERENCES `Projeto` (`idProjeto`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pesquisador_has_Projeto`
--

LOCK TABLES `Pesquisador_has_Projeto` WRITE;
/*!40000 ALTER TABLE `Pesquisador_has_Projeto` DISABLE KEYS */;
/*!40000 ALTER TABLE `Pesquisador_has_Projeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Coleta_has_Pesquisador`
--

DROP TABLE IF EXISTS `Coleta_has_Pesquisador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Coleta_has_Pesquisador` (
  `idColeta` int(11) NOT NULL,
  `idPesquisador` int(11) NOT NULL,
  PRIMARY KEY (`idColeta`,`idPesquisador`),
  KEY `fk_Coleta_has_Pesquisador_Pesquisador1` (`idPesquisador`),
  KEY `fk_Coleta_has_Pesquisador_Coleta1` (`idColeta`),
  CONSTRAINT `fk_Coleta_has_Pesquisador_Coleta1` FOREIGN KEY (`idColeta`) REFERENCES `Coleta` (`idColeta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Coleta_has_Pesquisador_Pesquisador1` FOREIGN KEY (`idPesquisador`) REFERENCES `Pesquisador` (`idPesquisador`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Coleta_has_Pesquisador`
--

LOCK TABLES `Coleta_has_Pesquisador` WRITE;
/*!40000 ALTER TABLE `Coleta_has_Pesquisador` DISABLE KEYS */;
/*!40000 ALTER TABLE `Coleta_has_Pesquisador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Filo`
--

DROP TABLE IF EXISTS `Filo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Filo` (
  `idFilo` int(11) NOT NULL AUTO_INCREMENT,
  `NomeCientifico` varchar(255) NOT NULL,
  `NomeComum` varchar(255) DEFAULT NULL,
  `Descricao` text,
  PRIMARY KEY (`idFilo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Filo`
--

LOCK TABLES `Filo` WRITE;
/*!40000 ALTER TABLE `Filo` DISABLE KEYS */;
INSERT INTO `Filo` VALUES (1,'Chordata',NULL,NULL);
/*!40000 ALTER TABLE `Filo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-08 15:53:06
