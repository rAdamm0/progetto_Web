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
DROP SCHEMA IF EXISTS `weblio`;
CREATE SCHEMA IF NOT EXISTS `weblio` DEFAULT CHARACTER SET utf8 ;
USE `weblio`;
CREATE TABLE IF NOT EXISTS `weblio`.`utente`(
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `pw` VARCHAR(512) NOT NULL,
  `nome` VARCHAR(30) NOT NULL,
  `cognome` VARCHAR(20) NOT NULL,
  `corso` VARCHAR(50),
  `anno` int,
  `num_matricola` INT NOT NULL UNIQUE,
  `immagine_profilo` VARCHAR(100) NOT NULL,
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
`immagine_libro` VARCHAR(50),
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
`id_prenotazioni` INT AUTO_INCREMENT,
`email` VARCHAR(100) NOT NULL,
`codice_libro` INT NOT NULL,
`data_inizio` DATE NOT NULL,
`data_fine` DATE NOT NULL,
FOREIGN KEY(`email`) REFERENCES `weblio`.`utente`(`email`)
ON UPDATE CASCADE
ON DELETE CASCADE,
FOREIGN KEY(`codice_libro`) REFERENCES `weblio`.`libri`(`codice_libro`)
ON UPDATE CASCADE
ON DELETE CASCADE,
PRIMARY KEY(`id_prenotazioni`),
INDEX `idx_chronological_order`(`data_inizio` DESC),
CONSTRAINT chk_date CHECK (`data_inizio`<=`data_fine`),
CONSTRAINT chk_duration CHECK(DATEDIFF(`data_fine`, `data_inizio`)<31)
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

CREATE TABLE IF NOT EXISTS `weblio`.`config`(
    `last_date` DATE NOT NULL 
)Engine=InnoDB;

DELIMITER $$

CREATE PROCEDURE SearchAllColumns(
    IN TableName VARCHAR(64),
    IN SearchText VARCHAR(255)
)
BEGIN
    DECLARE done INT DEFAULT FALSE;
    DECLARE colName VARCHAR(64);
    DECLARE sqlText TEXT DEFAULT '';
    
    DECLARE cur1 CURSOR FOR 
        SELECT COLUMN_NAME 
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_NAME = TableName 
          AND TABLE_SCHEMA = DATABASE();
          
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    OPEN cur1;

    read_loop: LOOP
        FETCH cur1 INTO colName;
        IF done THEN
            LEAVE read_loop;
        END IF;

        IF sqlText = '' THEN
            SET sqlText = CONCAT("COALESCE(", colName, ", '')");
        ELSE
            SET sqlText = CONCAT(sqlText, " , ' ' , COALESCE(", colName, ", '')");
        END IF;
    END LOOP;

    CLOSE cur1;

    SET @finalSql = CONCAT("SELECT * FROM ", TableName,
                           " WHERE CONCAT(", sqlText, ") LIKE '%",
                           SearchText, "%'");

    PREPARE stmt FROM @finalSql;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;

END$$

DELIMITER ;

CREATE VIEW `prenotazioni passate` AS
SELECT p.id_prenotazioni,u.email,l.nome_libro, l.edizione, p.data_inizio, p.data_fine, GROUP_CONCAT(a.cognome_autore SEPARATOR ",") AS autori 
FROM prenotazioni p join libri l on p.codice_libro = l.codice_libro join autore_libro al on l.codice_libro = al.codice_libro join autori a on al.codice_autore = a.codice_autore join utente u on p.email = u.email 
WHERE p.data_fine<>'' 
GROUP BY p.id_prenotazioni,l.nome_libro, l.edizione, u.email,p.data_inizio, p.data_fine; 
