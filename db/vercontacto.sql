-- MySQL dump 10.13  Distrib 9.0.1, for macos14.7 (arm64)
--
-- Host: vercontacto.org   Database: vercontacto
-- ------------------------------------------------------
-- Server version	8.0.40-0ubuntu0.20.04.1
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!50503 SET NAMES utf8mb4 */
;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */
;
/*!40103 SET TIME_ZONE='+00:00' */
;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */
;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */
;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */
;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */
;
--
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */
;
/*!50503 SET character_set_client = utf8mb4 */
;
CREATE TABLE `contacto` (
  `idContacto` int NOT NULL AUTO_INCREMENT,
  `logo` text CHARACTER SET utf8mb3,
  `nombre` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `email` varchar(150) CHARACTER SET utf8mb3 DEFAULT NULL,
  `numero` varchar(16) CHARACTER SET utf8mb3 DEFAULT NULL,
  `numero2` varchar(16) CHARACTER SET utf8mb3 DEFAULT NULL,
  `numero3` varchar(16) CHARACTER SET utf8mb3 DEFAULT NULL,
  `numero4` varchar(16) CHARACTER SET utf8mb3 DEFAULT NULL,
  `info` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `color` json DEFAULT NULL,
  `redesSociales` json DEFAULT NULL,
  `web` varchar(200) CHARACTER SET utf8mb3 DEFAULT NULL,
  `share` varchar(200) CHARACTER SET utf8mb3 DEFAULT NULL,
  PRIMARY KEY (`idContacto`)
) ENGINE = InnoDB AUTO_INCREMENT = 165 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_spanish_ci COMMENT = 'Tabla de Contactos, generador';
/*!40101 SET character_set_client = @saved_cs_client */
;
--
-- Dumping routines for database 'vercontacto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */
;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */
;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */
;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */
;
-- Dump completed on 2025-07-27 16:04:56