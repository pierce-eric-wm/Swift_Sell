-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema swiftSell
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema swiftSell
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `swiftSell` DEFAULT CHARACTER SET latin1 ;
USE `swiftSell` ;

-- -----------------------------------------------------
-- Table `swiftSell`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `swiftSell`.`users` (
  `userid` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  `phoneNumber` BIGINT(12) NOT NULL,
  `cardNumber` BIGINT(20) NOT NULL,
  `catagory` ENUM('Auto','Clothing','Technology','Household','Games','Tools','Sport') NOT NULL,
  `profileImage` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`userid`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `swiftSell`.`carts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `swiftSell`.`carts` (
  `cartid` INT(11) NOT NULL AUTO_INCREMENT,
  `productid` INT(11) NOT NULL,
  `productName` VARCHAR(45) NOT NULL,
  `productPrice` VARCHAR(45) NOT NULL,
  `users_userid` INT(11) NOT NULL,
  PRIMARY KEY (`cartid`),
  INDEX `fk_carts_users1_idx` (`users_userid` ASC),
  CONSTRAINT `fk_carts_users1`
    FOREIGN KEY (`users_userid`)
    REFERENCES `swiftSell`.`users` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `swiftSell`.`emailList`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `swiftSell`.`emailList` (
  `emailid` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` INT(11) NOT NULL,
  `subscribed` VARCHAR(45) NOT NULL,
  `catagory` VARCHAR(45) NOT NULL,
  `users_userid` INT(11) NOT NULL,
  PRIMARY KEY (`emailid`),
  INDEX `fk_emailList_users_idx` (`users_userid` ASC),
  CONSTRAINT `fk_emailList_users`
    FOREIGN KEY (`users_userid`)
    REFERENCES `swiftSell`.`users` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `swiftSell`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `swiftSell`.`products` (
  `productid` INT(11) NOT NULL AUTO_INCREMENT,
  `users_userid` INT(11) NOT NULL,
  `users_username` VARCHAR(45) NOT NULL,
  `productName` VARCHAR(45) NOT NULL,
  `productPrice` INT(11) NOT NULL,
  `productDescription` VARCHAR(1000) NOT NULL,
  `productCatagory` ENUM('Auto','Clothing','Technology','Household','Games','Tools','Sport') NOT NULL,
  `productLikes` INT(11) NULL DEFAULT NULL,
  `productImage` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`productid`),
  INDEX `fk_products_users1_idx` (`users_userid` ASC),
  CONSTRAINT `fk_products_users1`
    FOREIGN KEY (`users_userid`)
    REFERENCES `swiftSell`.`users` (`userid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
