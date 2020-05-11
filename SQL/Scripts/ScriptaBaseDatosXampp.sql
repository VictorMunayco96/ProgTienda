-- MySQL Script generated by MySQL Workbench
-- 05/10/20 21:35:17
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DBTienda
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DBTienda
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DBTienda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `DBTienda` ;

-- -----------------------------------------------------
-- Table `DBTienda`.`Tienda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Tienda` (
  `IdTienda` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `RazonSocial` VARCHAR(45) NULL COMMENT '',
  `Ruc` BIGINT NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdTienda`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Sucursal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Sucursal` (
  `IdSucursal` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `IdTienda` INT NOT NULL COMMENT '',
  `Direccion` VARCHAR(45) NULL COMMENT '',
  `Departamento` VARCHAR(45) NULL COMMENT '',
  `Provincia` VARCHAR(45) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdSucursal`)  COMMENT '',
  INDEX `fk_Sucursal_Tienda_idx` (`IdTienda` ASC)  COMMENT '',
  CONSTRAINT `fk_Sucursal_Tienda`
    FOREIGN KEY (`IdTienda`)
    REFERENCES `DBTienda`.`Tienda` (`IdTienda`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Cliente` (
  `IdCliente` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdCliente`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Personal` (
  `IdPesona` INT NOT NULL COMMENT '',
  `Nombre` VARCHAR(60) NULL COMMENT '',
  `Apellido` VARCHAR(60) NULL COMMENT '',
  `FecNac` VARCHAR(45) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  `TipoDocumento` VARCHAR(45) NULL COMMENT '',
  `NumDocumento` INT NULL COMMENT '',
  `Area` VARCHAR(45) NULL COMMENT '',
  `Cargo` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`IdPesona`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Usuario` (
  `IdUsuario` INT NOT NULL COMMENT '',
  `IdPesonal` INT NOT NULL COMMENT '',
  `Usuario` VARCHAR(45) NULL COMMENT '',
  `Contraseña` VARCHAR(45) NULL COMMENT '',
  `TipoUsuario` VARCHAR(45) NULL COMMENT '',
  `Estado` VARCHAR(45) NULL COMMENT '',
  PRIMARY KEY (`IdUsuario`)  COMMENT '',
  INDEX `fk_Usuario_Personal1_idx` (`IdPesonal` ASC)  COMMENT '',
  CONSTRAINT `fk_Usuario_Personal1`
    FOREIGN KEY (`IdPesonal`)
    REFERENCES `DBTienda`.`Personal` (`IdPesona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`TipoProducto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`TipoProducto` (
  `IdTipoProducto` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `TipoProducto` VARCHAR(60) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdTipoProducto`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Categoria`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Categoria` (
  `IdCategoria` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `IdTipoProducto` INT NOT NULL COMMENT '',
  `Categoria` VARCHAR(65) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdCategoria`)  COMMENT '',
  INDEX `fk_Categoria_TipoProducto1_idx` (`IdTipoProducto` ASC)  COMMENT '',
  CONSTRAINT `fk_Categoria_TipoProducto1`
    FOREIGN KEY (`IdTipoProducto`)
    REFERENCES `DBTienda`.`TipoProducto` (`IdTipoProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Producto` (
  `IdProducto` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `IdCategoria` INT NOT NULL COMMENT '',
  `Codigo` BIGINT NOT NULL COMMENT '',
  `Nombre` VARCHAR(45) NULL COMMENT '',
  `StockMinTienda` DECIMAL(7,2) NULL COMMENT '',
  `StockMinGeneral` DECIMAL(7,2) NULL COMMENT '',
  `Descripcion` VARCHAR(45) NULL COMMENT '',
  `Imagen` VARCHAR(45) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdProducto`)  COMMENT '',
  INDEX `fk_Producto_Categoria1_idx` (`IdCategoria` ASC)  COMMENT '',
  CONSTRAINT `fk_Producto_Categoria1`
    FOREIGN KEY (`IdCategoria`)
    REFERENCES `DBTienda`.`Categoria` (`IdCategoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Proveedor` (
  `IdProveedor` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `RazonSocial` VARCHAR(45) NULL COMMENT '',
  `TipoDocumento` VARCHAR(45) NULL COMMENT '',
  `NumDocumento` BIGINT NULL COMMENT '',
  `Rublo` VARCHAR(45) NULL COMMENT '',
  `NumCelular` VARCHAR(12) NULL COMMENT '',
  `Telf` VARCHAR(12) NULL COMMENT '',
  `Correo` VARCHAR(65) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdProveedor`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Compra` (
  `IdCompra` INT NOT NULL COMMENT '',
  `IdUsuario` INT NOT NULL COMMENT '',
  `IdProveedor` INT NOT NULL COMMENT '',
  `TipoComprobante` VARCHAR(45) NULL COMMENT '',
  `SerieCompro` VARCHAR(45) NULL COMMENT '',
  `NumCompro` VARCHAR(45) NULL COMMENT '',
  `Fecha` DATETIME NULL COMMENT '',
  `Asunto` VARCHAR(45) NULL COMMENT '',
  `Descripcion` VARCHAR(45) NULL COMMENT '',
  `EstadoCom` TINYINT NULL COMMENT '',
  `Impuesto` VARCHAR(45) NULL COMMENT '',
  `TotalCompra` VARCHAR(45) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdCompra`)  COMMENT '',
  INDEX `fk_Compra_Usuario1_idx` (`IdUsuario` ASC)  COMMENT '',
  INDEX `fk_Compra_Proveedor1_idx` (`IdProveedor` ASC)  COMMENT '',
  CONSTRAINT `fk_Compra_Usuario1`
    FOREIGN KEY (`IdUsuario`)
    REFERENCES `DBTienda`.`Usuario` (`IdUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Compra_Proveedor1`
    FOREIGN KEY (`IdProveedor`)
    REFERENCES `DBTienda`.`Proveedor` (`IdProveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`DetalleCompra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`DetalleCompra` (
  `IdDetalleCompra` INT NOT NULL COMMENT '',
  `IdCompra` INT NOT NULL COMMENT '',
  `IdProducto` INT NOT NULL COMMENT '',
  `Cantidad` DECIMAL(7,2) NULL COMMENT '',
  `PrecioCompra` DECIMAL(7,2) NULL COMMENT '',
  `CodigoBarra` BIGINT NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdDetalleCompra`)  COMMENT '',
  INDEX `fk_DetalleCompra_Compra1_idx` (`IdCompra` ASC)  COMMENT '',
  INDEX `fk_DetalleCompra_Producto1_idx` (`IdProducto` ASC)  COMMENT '',
  CONSTRAINT `fk_DetalleCompra_Compra1`
    FOREIGN KEY (`IdCompra`)
    REFERENCES `DBTienda`.`Compra` (`IdCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleCompra_Producto1`
    FOREIGN KEY (`IdProducto`)
    REFERENCES `DBTienda`.`Producto` (`IdProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Venta` (
  `IdVenta` INT NOT NULL COMMENT '',
  `IdSucursal` INT NOT NULL COMMENT '',
  `IdCliente` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdVenta`)  COMMENT '',
  INDEX `fk_Venta_Sucursal1_idx` (`IdSucursal` ASC)  COMMENT '',
  INDEX `fk_Venta_Cliente1_idx` (`IdCliente` ASC)  COMMENT '',
  CONSTRAINT `fk_Venta_Sucursal1`
    FOREIGN KEY (`IdSucursal`)
    REFERENCES `DBTienda`.`Sucursal` (`IdSucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_Cliente1`
    FOREIGN KEY (`IdCliente`)
    REFERENCES `DBTienda`.`Cliente` (`IdCliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`DetalleVenta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`DetalleVenta` (
  `IdDetalleVenta` INT NOT NULL COMMENT '',
  `IdVenta` INT NOT NULL COMMENT '',
  `Producto_IdProducto` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdDetalleVenta`)  COMMENT '',
  INDEX `fk_DetalleVenta_Venta1_idx` (`IdVenta` ASC)  COMMENT '',
  INDEX `fk_DetalleVenta_Producto1_idx` (`Producto_IdProducto` ASC)  COMMENT '',
  CONSTRAINT `fk_DetalleVenta_Venta1`
    FOREIGN KEY (`IdVenta`)
    REFERENCES `DBTienda`.`Venta` (`IdVenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetalleVenta_Producto1`
    FOREIGN KEY (`Producto_IdProducto`)
    REFERENCES `DBTienda`.`Producto` (`IdProducto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`Permiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`Permiso` (
  `IdPermiso` INT NOT NULL COMMENT '',
  `Permiso` VARCHAR(45) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  PRIMARY KEY (`IdPermiso`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`DetallePermiso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`DetallePermiso` (
  `IdDetallePermiso` INT NOT NULL COMMENT '',
  `IdPermiso` INT NOT NULL COMMENT '',
  `IdUsuario` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdDetallePermiso`)  COMMENT '',
  INDEX `fk_DetallePermiso_Permiso1_idx` (`IdPermiso` ASC)  COMMENT '',
  INDEX `fk_DetallePermiso_Usuario1_idx` (`IdUsuario` ASC)  COMMENT '',
  CONSTRAINT `fk_DetallePermiso_Permiso1`
    FOREIGN KEY (`IdPermiso`)
    REFERENCES `DBTienda`.`Permiso` (`IdPermiso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_DetallePermiso_Usuario1`
    FOREIGN KEY (`IdUsuario`)
    REFERENCES `DBTienda`.`Usuario` (`IdUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DBTienda`.`IngresoTienda`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DBTienda`.`IngresoTienda` (
  `IdIngresoTienda` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `Cantidad` DECIMAL(7,2) NULL COMMENT '',
  `IdSucursal` INT NOT NULL COMMENT '',
  `IdUsuario` INT NOT NULL COMMENT '',
  `PrecioVentaXMenor` DECIMAL(7,2) NULL COMMENT '',
  `PrecioVentaXMayor` DECIMAL(7,2) NULL COMMENT '',
  `Estado` TINYINT NULL COMMENT '',
  `IdDetalleCompra` INT NOT NULL COMMENT '',
  PRIMARY KEY (`IdIngresoTienda`)  COMMENT '',
  INDEX `fk_IngresoTienda_Sucursal1_idx` (`IdSucursal` ASC)  COMMENT '',
  INDEX `fk_IngresoTienda_Usuario1_idx` (`IdUsuario` ASC)  COMMENT '',
  INDEX `fk_IngresoTienda_DetalleCompra1_idx` (`IdDetalleCompra` ASC)  COMMENT '',
  CONSTRAINT `fk_IngresoTienda_Sucursal1`
    FOREIGN KEY (`IdSucursal`)
    REFERENCES `DBTienda`.`Sucursal` (`IdSucursal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IngresoTienda_Usuario1`
    FOREIGN KEY (`IdUsuario`)
    REFERENCES `DBTienda`.`Usuario` (`IdUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_IngresoTienda_DetalleCompra1`
    FOREIGN KEY (`IdDetalleCompra`)
    REFERENCES `DBTienda`.`DetalleCompra` (`IdDetalleCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
