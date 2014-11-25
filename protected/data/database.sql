SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `kdomestriha2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `kdomestriha2` ;

-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_user` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `fb_id` BIGINT(11) NULL ,
  `password` VARCHAR(255) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `nickname` VARCHAR(20) NULL ,
  `gender` TINYINT NULL ,
  `reg_date` DATE NULL ,
  `auth_level` TINYINT NULL DEFAULT 2 ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `nickname_UNIQUE` (`nickname` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) ,
  UNIQUE INDEX `fb_id_UNIQUE` (`fb_id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_salon`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_salon` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(70) NOT NULL ,
  `address` VARCHAR(70) NOT NULL ,
  `lat` FLOAT(10,6) NULL ,
  `lng` FLOAT(10,6) NULL ,
  `phone` VARCHAR(45) NULL ,
  `website` VARCHAR(70) NULL ,
  `fb_site` VARCHAR(70) NULL ,
  `email` VARCHAR(45) NULL ,
  `description` TEXT NULL ,
  `create_time` DATETIME NOT NULL ,
  `update_time` DATETIME NOT NULL ,
  `avg_rating` FLOAT NULL DEFAULT NULL ,
  `avg_sub_rating1` FLOAT NULL DEFAULT NULL ,
  `avg_sub_rating2` FLOAT NULL DEFAULT NULL ,
  `avg_sub_rating3` FLOAT NULL DEFAULT NULL ,
  `avg_price_women` INT NULL DEFAULT NULL ,
  `avg_price_men` INT NULL DEFAULT NULL ,
  `account_level` TINYINT NULL ,
  `create_user_id` INT NOT NULL ,
  `owner_user_id` INT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tbl_salon_tbl_user_idx` (`create_user_id` ASC) ,
  INDEX `fk_tbl_salon_tbl_user1_idx` (`owner_user_id` ASC) ,
  CONSTRAINT `fk_tbl_salon_tbl_user`
    FOREIGN KEY (`create_user_id` )
    REFERENCES `kdomestriha2`.`tbl_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salon_tbl_user1`
    FOREIGN KEY (`owner_user_id` )
    REFERENCES `kdomestriha2`.`tbl_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_opening_hours`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_opening_hours` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `weekday` TINYINT NOT NULL ,
  `open_time` VARCHAR(5) NULL DEFAULT '--:--' ,
  `close_time` VARCHAR(5) NULL DEFAULT '--:--' ,
  `salon_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tbl_opening_hours_tbl_salon1_idx` (`salon_id` ASC) ,
  CONSTRAINT `fk_tbl_opening_hours_tbl_salon1`
    FOREIGN KEY (`salon_id` )
    REFERENCES `kdomestriha2`.`tbl_salon` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_salon_photo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_salon_photo` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `ext` VARCHAR(4) NULL ,
  `create_time` DATETIME NOT NULL ,
  `salon_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tbl_salon_photo_tbl_salon1_idx` (`salon_id` ASC) ,
  CONSTRAINT `fk_tbl_salon_photo_tbl_salon1`
    FOREIGN KEY (`salon_id` )
    REFERENCES `kdomestriha2`.`tbl_salon` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_salon_rating`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_salon_rating` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `rating` FLOAT NOT NULL ,
  `sub_rating1` TINYINT NOT NULL ,
  `sub_rating2` TINYINT NOT NULL ,
  `sub_rating3` TINYINT NOT NULL ,
  `descritpion` TEXT NOT NULL ,
  `heading` VARCHAR(190) NULL DEFAULT NULL ,
  `gender` TINYINT NULL DEFAULT NULL ,
  `price` INT NULL DEFAULT NULL ,
  `hairdresser_name` VARCHAR(70) NULL ,
  `active` TINYINT NULL DEFAULT 0 ,
  `activation_link` VARCHAR(255) NULL ,
  `create_time` DATETIME NOT NULL ,
  `create_user_id` INT NOT NULL ,
  `create_user_ip` VARCHAR(45) NULL ,
  `salon_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tbl_salon_rating_tbl_salon1_idx` (`salon_id` ASC) ,
  INDEX `fk_tbl_salon_rating_tbl_user1_idx` (`create_user_id` ASC) ,
  CONSTRAINT `fk_tbl_salon_rating_tbl_salon1`
    FOREIGN KEY (`salon_id` )
    REFERENCES `kdomestriha2`.`tbl_salon` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salon_rating_tbl_user1`
    FOREIGN KEY (`create_user_id` )
    REFERENCES `kdomestriha2`.`tbl_user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_operation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_operation` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `kdomestriha2`.`tbl_salon_rating_operation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `kdomestriha2`.`tbl_salon_rating_operation` (
  `salon_rating_id` INT NOT NULL ,
  `operation_id` INT NOT NULL ,
  PRIMARY KEY (`salon_rating_id`, `operation_id`) ,
  INDEX `fk_tbl_salon_rating_has_tbl_operation_tbl_operation1_idx` (`operation_id` ASC) ,
  INDEX `fk_tbl_salon_rating_has_tbl_operation_tbl_salon_rating1_idx` (`salon_rating_id` ASC) ,
  CONSTRAINT `fk_tbl_salon_rating_has_tbl_operation_tbl_salon_rating1`
    FOREIGN KEY (`salon_rating_id` )
    REFERENCES `kdomestriha2`.`tbl_salon_rating` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_salon_rating_has_tbl_operation_tbl_operation1`
    FOREIGN KEY (`operation_id` )
    REFERENCES `kdomestriha2`.`tbl_operation` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
