-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema weblio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema weblio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `weblio` DEFAULT CHARACTER SET utf8 ;
USE `weblio`;
CREATE TABLE IF NOT EXISTS `weblio`.`utente`(
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(512) NOT NULL,
  `nome` VARCHAR(30) NOT NULL,
  `cognome` VARCHAR(20) NOT NULL,
  `corso` VARCHAR(50) NOT NULL,
  `attivo` int NOT NULL DEFAULT 0,
  `corso` VARCHAR(100),
  `anno` int,
  `num_matricola` INT NOT NULL UNIQUE,
  `immagine_profilo` MEDIUMBLOB,
  `is_docente` INT DEFAULT 0,
  INDEX `idx_nome`(`cognome` ASC),
  PRIMARY KEY(`email`)
) Engine=InnoDB;


CREATE TABLE IF NOT EXISTS `weblio`.`corsi`(
 `codice_corso` INT NOT NULL,
 `nome_corso` VARCHAR(50) NOT NULL,
 `descrizione` TEXT NOT NULL,
 `lingua` VARCHAR(30) NOT NULL DEFAULT 'Italiano',
 `docente` VARCHAR(30),
 PRIMARY KEY (`codice_corso`),
 INDEX `idx_corso`(`nome_corso` ASC)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`libri`(
`codice_libro` INT AUTO_INCREMENT,
`nome_libro` VARCHAR(50) NOT NULL, 
`edizione` INT NOT NULL,
`data_uscita` INT NOT NULL,
`descrizione` TEXT,
`disponibile` INT DEFAULT 0,
PRIMARY KEY(`codice_libro`),
INDEX `idx_libri`(`nome_libro` ASC)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`libro_corso`(
`codice_libro` INT NOT NULL,
`codice_corso` INT NOT NULL,
FOREIGN KEY(`codice_libro`) REFERENCES `weblio`.`libri`(`codice_libro`)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(`codice_corso`) REFERENCES `weblio`.`corsi`(`codice_corso`)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY (`codice_libro`,`codice_corso`)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`prenotazioni`(
`email` VARCHAR(100) NOT NULL,
`codice_libro` INT NOT NULL,
`data_inizio` DATE NOT NULL,
`data_fine` DATE,
FOREIGN KEY(`email`) REFERENCES `weblio`.`utente`(`email`)
ON UPDATE CASCADE
ON DELETE CASCADE,
FOREIGN KEY(`codice_libro`) REFERENCES `weblio`.`libri`(`codice_libro`)
ON UPDATE CASCADE
ON DELETE CASCADE,
PRIMARY KEY(`email`, `codice_libro`, `data_inizio`),
INDEX `idx_chronological_order`(`data_inizio` DESC)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`autori`(
`codice_autore` INT AUTO_INCREMENT,
`nome_autore` VARCHAR(50),
`cognome_autore` VARCHAR(50),
`descrizione` TEXT,
PRIMARY KEY(`codice_autore`)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`autore_libro`(
`codice_autore` INT,
`codice_libro` INT,
FOREIGN KEY(`codice_autore`) REFERENCES `weblio`.`autori`(`codice_autore`)
ON DELETE CASCADE
ON UPDATE CASCADE,
FOREIGN KEY(`codice_libro`) REFERENCES `weblio`.`libri`(`codice_libro`)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY(`codice_autore`, `codice_libro`)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`recensione`(
`email` VARCHAR(100) NOT NULL,
`codice_libro` INT NOT NULL,
`valutazione` INT NOT NULL,
`descrizione` TEXT,
FOREIGN KEY(`email`) REFERENCES `weblio`.`utente`(`email`)
ON UPDATE CASCADE
ON DELETE CASCADE,
FOREIGN KEY(`codice_libro`) REFERENCES `weblio`.`libri`(`codice_libro`)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY(`email`, `codice_libro`)
)Engine=InnoDB;

CREATE TABLE IF NOT EXISTS `weblio`.`utente_corso`(
`email` VARCHAR(100) NOT NULL,
`codice_corso` INT NOT NULL,
FOREIGN KEY(`email`) REFERENCES `weblio`.`utente`(`email`)
ON UPDATE CASCADE
ON DELETE CASCADE,
FOREIGN KEY(`codice_corso`) REFERENCES `weblio`.`corsi`(`codice_corso`)
ON DELETE CASCADE
ON UPDATE CASCADE,
PRIMARY KEY(`email`, `codice_corso`)
)Engine=InnoDB;
