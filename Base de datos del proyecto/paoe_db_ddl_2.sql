-- MySQL Workbench Synchronization
-- Generated: 2022-10-30 18:41
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Juan Nicolas

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `paoe_db` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `paoe_db`.`solicitante` (
  `documento` INT(12) NOT NULL,
  `tipo_consultante` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `telefono` INT(12) NOT NULL,
  `localidad` VARCHAR(45) NOT NULL,
  `edad` INT(3) NOT NULL,
  `genero` VARCHAR(45) NOT NULL,
  `financiacion` VARCHAR(45) NULL DEFAULT NULL,
  `codigo` VARCHAR(45) NULL DEFAULT NULL,
  `semestre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`documento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`programa` (
  `nom_programa` VARCHAR(45) NOT NULL,
  `modalidad` VARCHAR(45) NOT NULL,
  `telefono` INT(12) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `nom_director` VARCHAR(45) NOT NULL,
  `facultad` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`nom_programa`),
  INDEX `fk_programa_facultad_idx` (`facultad` ASC),
  CONSTRAINT `fk_programa_facultad`
    FOREIGN KEY (`facultad`)
    REFERENCES `paoe_db`.`facultad` (`nom_facultad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`facultad` (
  `nom_facultad` VARCHAR(45) NOT NULL,
  `telefono` INT(12) NOT NULL,
  `correo` VARCHAR(45) NOT NULL,
  `nom_decano` VARCHAR(45) NOT NULL,
  `cc_usuario` INT(12) NOT NULL,
  PRIMARY KEY (`nom_facultad`),
  INDEX `fk_facultad_usuario_idx` (`cc_usuario` ASC),
  CONSTRAINT `fk_facultad_psicologo`
    FOREIGN KEY (`cc_usuario`)
    REFERENCES `paoe_db`.`usuario` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`usuario` (
  `cedula` INT(12) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `edad` INT(3) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`cedula`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`asesoria` (
  `num_asesoria` INT(6) NOT NULL,
  `fecha_hora` DATETIME NOT NULL,
  `tipo_acompanamiento` VARCHAR(45) NOT NULL,
  `acceso_servicio` VARCHAR(45) NOT NULL,
  `remitido_por` VARCHAR(45) NOT NULL,
  `problematica_ref_trab` VARCHAR(45) NOT NULL,
  `acciones_realizadas` VARCHAR(45) NOT NULL,
  `asistencia` VARCHAR(45) NOT NULL,
  `culminacion` VARCHAR(45) NOT NULL,
  `remitido_a` VARCHAR(45) NOT NULL,
  `observaciones` VARCHAR(45) NOT NULL,
  `cc_usuario` INT(12) NOT NULL,
  `doc_solicitante` INT(12) NOT NULL,
  PRIMARY KEY (`num_asesoria`),
  INDEX `fk_asesoria_usuario_idx` (`cc_usuario` ASC),
  INDEX `fk_asesoria_solicitante_idx` (`doc_solicitante` ASC),
  CONSTRAINT `fk_asesoria_cc_usuario`
    FOREIGN KEY (`cc_usuario`)
    REFERENCES `paoe_db`.`usuario` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asesoria_doc_solicitante`
    FOREIGN KEY (`doc_solicitante`)
    REFERENCES `paoe_db`.`solicitante` (`documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`programas_estudiante` (
  `paciente` INT(12) NOT NULL,
  `programa` VARCHAR(45) NOT NULL,
  `ingreso` DATE NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `egreso` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`paciente`, `programa`),
  INDEX `fk_programas_estudiante_programa_idx` (`programa` ASC),
  INDEX `fk_programas_estudiante_solicitante_idx` (`paciente` ASC),
  CONSTRAINT `fk_programas_estudiante_paciente`
    FOREIGN KEY (`paciente`)
    REFERENCES `paoe_db`.`solicitante` (`documento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_programas_estudiante_programa`
    FOREIGN KEY (`programa`)
    REFERENCES `paoe_db`.`programa` (`nom_programa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`rol` (
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(45) NOT NULL,
  `codigo` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`nombre`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`perfil` (
  `nombre` VARCHAR(45) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `rol` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`nombre`),
  INDEX `fk_perfil_rol_idx` (`rol` ASC),
  CONSTRAINT `fk_perfil_rol1`
    FOREIGN KEY (`rol`)
    REFERENCES `paoe_db`.`rol` (`nombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`cuenta` (
  `correo` VARCHAR(150) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  `token` VARCHAR(45) NULL DEFAULT NULL,
  `ultima_sesion` DATETIME NULL DEFAULT NULL,
  `usuario` INT(12) NOT NULL,
  `perfil` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`correo`),
  INDEX `fk_cuenta_usuario_idx` (`usuario` ASC),
  INDEX `fk_cuenta_perfil_idx` (`perfil` ASC),
  UNIQUE INDEX `token_UNIQUE` (`token` ASC),
  CONSTRAINT `fk_cuenta_usuario`
    FOREIGN KEY (`usuario`)
    REFERENCES `paoe_db`.`usuario` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_cuenta_perfil`
    FOREIGN KEY (`perfil`)
    REFERENCES `paoe_db`.`perfil` (`nombre`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `paoe_db`.`eventoscalendar` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `evento` VARCHAR(250) NOT NULL,
  `color_evento` VARCHAR(45) NOT NULL,
  `fecha_inicio` VARCHAR(45) NOT NULL,
  `fecha_fin` VARCHAR(45) NOT NULL,
  `usuario_cedula` INT(12) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_eventoscalendar_usuario_idx` (`usuario_cedula` ASC),
  CONSTRAINT `fk_eventoscalendar_usuario`
    FOREIGN KEY (`usuario_cedula`)
    REFERENCES `paoe_db`.`usuario` (`cedula`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
