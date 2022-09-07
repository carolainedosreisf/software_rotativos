-- MySQL Script generated by MySQL Workbench
-- Sat Aug 20 09:48:20 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Cidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cidade` (
  `CidadeId` INT NOT NULL AUTO_INCREMENT,
  `NomeCidade` VARCHAR(80) NOT NULL,
  `Estado` CHAR(2) NULL,
  PRIMARY KEY (`CidadeId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Cadastro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Cadastro` (
  `CadastroId` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(80) NOT NULL,
  `TipoCadastro` CHAR(1) NULL,
  `Cpf` VARCHAR(18) NULL,
  `NumeroTelefone` VARCHAR(15) NULL,
  `NumeroCelular` VARCHAR(15) NULL,
  `NumeroCep` VARCHAR(9) NULL,
  `CidadeId` INT NULL,
  `NumeroEndereco` DECIMAL(5,0) NULL,
  `Endereco` VARCHAR(80) NULL,
  `BairroEndereco` VARCHAR(50) NULL,
  `Complemento` VARCHAR(80) NULL,
  `Mensalista` CHAR(1) NULL,
  PRIMARY KEY (`CadastroId`),
  INDEX `FK20_idx` (`CidadeId` ASC),
  UNIQUE INDEX `Cpf_UNIQUE` (`Cpf` ASC),
  CONSTRAINT `FK20`
    FOREIGN KEY (`CidadeId`)
    REFERENCES `mydb`.`Cidade` (`CidadeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Permissao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Permissao` (
  `PermissaoId` INT NOT NULL,
  `Descricao` VARCHAR(80) NULL,
  PRIMARY KEY (`PermissaoId`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Empresa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Empresa` (
  `EmpresaId` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(80) NOT NULL,
  `RazaoSocial` VARCHAR(100) NULL,
  `CpfCnpj` VARCHAR(18) NULL,
  `TipoEmpresa` CHAR(1) NULL,
  `Endereco` VARCHAR(80) NULL,
  `NumeroEndereco` DECIMAL(5,0) NULL,
  `Complemento` VARCHAR(45) NULL,
  `NumeroCep` VARCHAR(9) NULL,
  `CidadeId` INT NULL,
  `BairroEndereco` VARCHAR(80) NULL,
  `UrlLogo` VARCHAR(255) NULL,
  `NumeroVagas` DECIMAL(5,0) NOT NULL,
  `Sobre` VARCHAR(255) NULL,
  `NumeroTelefone1` VARCHAR(15) NULL,
  `NumeroTelefone2` VARCHAR(15) NULL,
  `Email` VARCHAR(80) NULL,
  PRIMARY KEY (`EmpresaId`),
  INDEX `FK11_idx` (`CidadeId` ASC),
  UNIQUE INDEX `Cnpj_UNIQUE` (`CpfCnpj` ASC),
  CONSTRAINT `FK11`
    FOREIGN KEY (`CidadeId`)
    REFERENCES `mydb`.`Cidade` (`CidadeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DiasAtendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`DiasAtendimento` (
  `DiasAtendimentoId` INT NOT NULL AUTO_INCREMENT,
  `DescricaoDiasAtendimento` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`DiasAtendimentoId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Estacionamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Estacionamento` (
  `EstacionamentoId` INT NOT NULL AUTO_INCREMENT,
  `RazaoSocial` VARCHAR(100) NULL,
  `CpfCnpj` VARCHAR(18) NULL,
  `Endereco` VARCHAR(80) NULL,
  `NumeroEndereco` DECIMAL(5,0) NULL,
  `Complemento` VARCHAR(45) NULL,
  `NumeroCep` VARCHAR(9) NULL,
  `CidadeId` INT NULL,
  `BairroEndereco` VARCHAR(80) NULL,
  `NumeroVagas` DECIMAL(5,0) NOT NULL,
  `Sobre` VARCHAR(255) NULL,
  `NumeroTelefone1` VARCHAR(15) NULL,
  `NumeroTelefone2` VARCHAR(15) NULL,
  `Email` VARCHAR(80) NULL,
  `DiasAtendimentoId` INT NULL,
  `precoLivre` DECIMAL(18,2) NULL,
  `PrecoHora` DECIMAL(18,2) NULL,
  `EmpresaId` INT NOT NULL,
  `DataCadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EstacionamentoId`),
  INDEX `FK14_idx` (`DiasAtendimentoId` ASC),
  INDEX `FK23_idx` (`EmpresaId` ASC),
  INDEX `FK30_idx` (`CidadeId` ASC),
  CONSTRAINT `FK14`
    FOREIGN KEY (`DiasAtendimentoId`)
    REFERENCES `mydb`.`DiasAtendimento` (`DiasAtendimentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK23`
    FOREIGN KEY (`EmpresaId`)
    REFERENCES `mydb`.`Empresa` (`EmpresaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK30`
    FOREIGN KEY (`CidadeId`)
    REFERENCES `mydb`.`Cidade` (`CidadeId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Login`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Login` (
  `LoginId` INT NOT NULL AUTO_INCREMENT,
  `Email` VARCHAR(80) NULL,
  `NomeUsuario` VARCHAR(50) NULL,
  `Senha` VARCHAR(255) NULL,
  `CadastroId` INT NULL,
  `EstacionamentoId` INT NULL,
  `PermissaoId` INT NOT NULL,
  PRIMARY KEY (`LoginId`),
  INDEX `FK10_idx` (`CadastroId` ASC),
  INDEX `FK16_idx` (`EstacionamentoId` ASC),
  UNIQUE INDEX `Email_UNIQUE` (`Email` ASC),
  UNIQUE INDEX `NomeUsuario_UNIQUE` (`NomeUsuario` ASC),
  UNIQUE INDEX `CadastroId_UNIQUE` (`CadastroId` ASC),
  INDEX `FK21_idx` (`PermissaoId` ASC),
  CONSTRAINT `FK10`
    FOREIGN KEY (`CadastroId`)
    REFERENCES `mydb`.`Cadastro` (`CadastroId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK16`
    FOREIGN KEY (`EstacionamentoId`)
    REFERENCES `mydb`.`Estacionamento` (`EstacionamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK21`
    FOREIGN KEY (`PermissaoId`)
    REFERENCES `mydb`.`Permissao` (`PermissaoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`FotoEstacionamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FotoEstacionamento` (
  `FotoEstacionamentoId` INT NOT NULL AUTO_INCREMENT,
  `EstacionamentoId` INT NOT NULL,
  `UrlFoto` VARCHAR(255) NULL,
  PRIMARY KEY (`FotoEstacionamentoId`),
  INDEX `FK12_idx` (`EstacionamentoId` ASC),
  CONSTRAINT `FK12`
    FOREIGN KEY (`EstacionamentoId`)
    REFERENCES `mydb`.`Estacionamento` (`EstacionamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`FormaPagamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FormaPagamento` (
  `FormaPagamentoId` INT NOT NULL AUTO_INCREMENT,
  `Descricao` VARCHAR(80) NOT NULL,
  PRIMARY KEY (`FormaPagamentoId`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Receber`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Receber` (
  `ReceberId` INT NOT NULL AUTO_INCREMENT,
  `FormaPagamentoId` INT NOT NULL,
  `CadastroId` INT NOT NULL,
  `FluxoVagaId` INT NULL,
  `Valor` DECIMAL(18,2) NOT NULL,
  PRIMARY KEY (`ReceberId`),
  INDEX `FK13_idx` (`FormaPagamentoId` ASC) ,
  INDEX `FK22_idx` (`CadastroId` ASC),
  CONSTRAINT `FK13`
    FOREIGN KEY (`FormaPagamentoId`)
    REFERENCES `mydb`.`FormaPagamento` (`FormaPagamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK22`
    FOREIGN KEY (`CadastroId`)
    REFERENCES `mydb`.`Cadastro` (`CadastroId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`FluxoVaga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`FluxoVaga` (
  `FluxoVagaId` INT NOT NULL AUTO_INCREMENT,
  `DataEntrada` DATE NOT NULL,
  `DataSaida` DATE NULL,
  `HoraEntrada` TIME NOT NULL,
  `HoraSaida` TIME NULL,
  `CadastroId` INT NOT NULL,
  `PlacaVeiculo` VARCHAR(30) NOT NULL,
  `Observacao` VARCHAR(255) NULL,
  `EstacionamentoId` INT NOT NULL,
  `Reserva` CHAR(1) NOT NULL,
  PRIMARY KEY (`FluxoVagaId`),
  INDEX `FK15_idx` (`CadastroId` ASC),
  INDEX `FK24_idx` (`EstacionamentoId` ASC),
  CONSTRAINT `FK15`
    FOREIGN KEY (`CadastroId`)
    REFERENCES `mydb`.`Cadastro` (`CadastroId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK24`
    FOREIGN KEY (`EstacionamentoId`)
    REFERENCES `mydb`.`Estacionamento` (`EstacionamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


INSERT INTO `mydb`.`Cidade` (`CidadeId`, `NomeCidade`, `Estado`) VALUES
        (1, 'Águas de Chapecó', 'SC'),
        (2, 'Águas Frias', 'SC'),
        (3, 'Águas Mornas', 'SC'),
        (4, 'Alfredo Wagner', 'SC'),
        (5, 'Alto Bela Vista', 'SC'),
        (6, 'Anchieta', 'SC'),
        (7, 'Angelina', 'SC'),
        (8, 'Anita Garibaldi', 'SC'),
        (9, 'Anitápolis', 'SC'),
        (10, 'Antônio Carlos', 'SC'),
        (11, 'Apiúna', 'SC'),
        (12, 'Arabutã', 'SC'),
        (13, 'Araquari', 'SC'),
        (14, 'Araranguá', 'SC'),
        (15, 'Armazém', 'SC'),
        (16, 'Arroio Trinta', 'SC'),
        (17, 'Arvoredo', 'SC'),
        (18, 'Ascurra', 'SC'),
        (19, 'Atalanta', 'SC'),
        (20, 'Aurora', 'SC'),
        (21, 'Balneário Arroio do Silva', 'SC'),
        (22, 'Balneário Barra do Sul', 'SC'),
        (23, 'Balneário Camboriú', 'SC'),
        (24, 'Balneário Gaivota', 'SC'),
        (25, 'Bandeirante', 'SC'),
        (26, 'Barra Bonita', 'SC'),
        (27, 'Barra Velha', 'SC'),
        (28, 'Bela Vista do Toldo', 'SC'),
        (29, 'Belmonte', 'SC'),
        (30, 'Benedito Novo', 'SC'),
        (31, 'Biguaçu', 'SC'),
        (32, 'Blumenau', 'SC'),
        (33, 'Bocaina do Sul', 'SC'),
        (34, 'Bom Jardim da Serra', 'SC'),
        (35, 'Bom Jesus', 'SC'),
        (36, 'Bom Jesus do Oeste', 'SC'),
        (37, 'Bom Retiro', 'SC'),
        (38, 'Bombinhas', 'SC'),
        (39, 'Botuverá', 'SC'),
        (40, 'Braço do Norte', 'SC'),
        (41, 'Braço do Trombudo', 'SC'),
        (42, 'Brunópolis', 'SC'),
        (43, 'Brusque', 'SC'),
        (44, 'Caçador', 'SC'),
        (45, 'Caibi', 'SC'),
        (46, 'Calmon', 'SC'),
        (47, 'Camboriú', 'SC'),
        (48, 'Campo Alegre', 'SC'),
        (49, 'Campo Belo do Sul', 'SC'),
        (50, 'Campo Erê', 'SC'),
        (51, 'Campos Novos', 'SC'),
        (52, 'Canelinha', 'SC'),
        (53, 'Canoinhas', 'SC'),
        (54, 'Capão Alto', 'SC'),
        (55, 'Capinzal', 'SC'),
        (56, 'Capivari de Baixo', 'SC'),
        (57, 'Catanduvas', 'SC'),
        (58, 'Caxambu do Sul', 'SC'),
        (59, 'Celso Ramos', 'SC'),
        (60, 'Cerro Negro', 'SC'),
        (61, 'Chapadão do Lageado', 'SC'),
        (62, 'Chapecó', 'SC'),
        (63, 'Cocal do Sul', 'SC'),
        (64, 'Concórdia', 'SC'),
        (65, 'Cordilheira Alta', 'SC'),
        (66, 'Coronel Freitas', 'SC'),
        (67, 'Coronel Martins', 'SC'),
        (68, 'Correia Pinto', 'SC'),
        (69, 'Corupá', 'SC'),
        (70, 'Criciúma', 'SC'),
        (71, 'Cunha Porã', 'SC'),
        (72, 'Cunhataí', 'SC'),
        (73, 'Curitibanos', 'SC'),
        (74, 'Descanso', 'SC'),
        (75, 'Dionísio Cerqueira', 'SC'),
        (76, 'Dona Emma', 'SC'),
        (77, 'Doutor Pedrinho', 'SC'),
        (78, 'Entre Rios', 'SC'),
        (79, 'Ermo', 'SC'),
        (80, 'Erval Velho', 'SC'),
        (81, 'Faxinal dos Guedes', 'SC'),
        (82, 'Flor do Sertão', 'SC'),
        (83, 'Florianópolis', 'SC'),
        (84, 'Formosa do Sul', 'SC'),
        (85, 'Forquilhinha', 'SC'),
        (86, 'Fraiburgo', 'SC'),
        (87, 'Frei Rogério', 'SC'),
        (88, 'Galvão', 'SC'),
        (89, 'Garopaba', 'SC'),
        (90, 'Garuva', 'SC'),
        (91, 'Gaspar', 'SC'),
        (92, 'Governador Celso Ramos', 'SC'),
        (93, 'Grão Pará', 'SC'),
        (94, 'Gravatal', 'SC'),
        (95, 'Guabiruba', 'SC'),
        (96, 'Guaraciaba', 'SC'),
        (97, 'Guaramirim', 'SC'),
        (98, 'Guarujá do Sul', 'SC'),
        (99, 'Guatambú', 'SC'),
        (100, 'Herval d`Oeste', 'SC'),
        (101, 'Ibiam', 'SC'),
        (102, 'Ibicaré', 'SC'),
        (103, 'Ibirama', 'SC'),
        (104, 'Içara', 'SC'),
        (105, 'Ilhota', 'SC'),
        (106, 'Imaruí', 'SC'),
        (107, 'Imbituba', 'SC'),
        (108, 'Imbuia', 'SC'),
        (109, 'Indaial', 'SC'),
        (110, 'Iomerê', 'SC'),
        (111, 'Ipira', 'SC'),
        (112, 'Iporã do Oeste', 'SC'),
        (113, 'Ipuaçu', 'SC'),
        (114, 'Ipumirim', 'SC'),
        (115, 'Iraceminha', 'SC'),
        (116, 'Irani', 'SC'),
        (117, 'Irati', 'SC'),
        (118, 'Irineópolis', 'SC'),
        (119, 'Itá', 'SC'),
        (120, 'Itaiópolis', 'SC'),
        (121, 'Itajaí', 'SC'),
        (122, 'Itapema', 'SC'),
        (123, 'Itapiranga', 'SC'),
        (124, 'Itapoá', 'SC'),
        (125, 'Ituporanga', 'SC'),
        (126, 'Jaborá', 'SC'),
        (127, 'Jacinto Machado', 'SC'),
        (128, 'Jaguaruna', 'SC'),
        (129, 'Jaraguá do Sul', 'SC'),
        (130, 'Jardinópolis', 'SC'),
        (131, 'Joaçaba', 'SC'),
        (132, 'Joinville', 'SC'),
        (133, 'José Boiteux', 'SC'),
        (134, 'Jupiá', 'SC'),
        (135, 'Lacerdópolis', 'SC'),
        (136, 'Lages', 'SC'),
        (137, 'Laguna', 'SC'),
        (138, 'Lajeado Grande', 'SC'),
        (139, 'Laurentino', 'SC'),
        (140, 'Lauro Muller', 'SC'),
        (141, 'Lebon Régis', 'SC'),
        (142, 'Leoberto Leal', 'SC'),
        (143, 'Lindóia do Sul', 'SC'),
        (144, 'Lontras', 'SC'),
        (145, 'Luiz Alves', 'SC'),
        (146, 'Luzerna', 'SC'),
        (147, 'Macieira', 'SC'),
        (148, 'Mafra', 'SC'),
        (149, 'Major Gercino', 'SC'),
        (150, 'Major Vieira', 'SC'),
        (151, 'Maracajá', 'SC'),
        (152, 'Maravilha', 'SC'),
        (153, 'Marema', 'SC'),
        (154, 'Massaranduba', 'SC'),
        (155, 'Matos Costa', 'SC'),
        (156, 'Meleiro', 'SC'),
        (157, 'Mirim Doce', 'SC'),
        (158, 'Modelo', 'SC'),
        (159, 'Mondaí', 'SC'),
        (160, 'Monte Carlo', 'SC'),
        (161, 'Monte Castelo', 'SC'),
        (162, 'Morro da Fumaça', 'SC'),
        (163, 'Morro Grande', 'SC'),
        (164, 'Navegantes', 'SC'),
        (165, 'Nova Erechim', 'SC'),
        (166, 'Nova Itaberaba', 'SC'),
        (167, 'Nova Trento', 'SC'),
        (168, 'Nova Veneza', 'SC'),
        (169, 'Novo Horizonte', 'SC'),
        (170, 'Orleans', 'SC'),
        (171, 'Otacílio Costa', 'SC'),
        (172, 'Ouro', 'SC'),
        (173, 'Ouro Verde', 'SC'),
        (174, 'Paial', 'SC'),
        (175, 'Painel', 'SC'),
        (176, 'Palhoça', 'SC'),
        (177, 'Palma Sola', 'SC'),
        (178, 'Palmeira', 'SC'),
        (179, 'Palmitos', 'SC'),
        (180, 'Papanduva', 'SC'),
        (181, 'Paraíso', 'SC'),
        (182, 'Passo de Torres', 'SC'),
        (183, 'Passos Maia', 'SC'),
        (184, 'Paulo Lopes', 'SC'),
        (185, 'Pedras Grandes', 'SC'),
        (186, 'Penha', 'SC'),
        (187, 'Peritiba', 'SC'),
        (188, 'Petrolândia', 'SC'),
        (189, 'Piçarras', 'SC'),
        (190, 'Pinhalzinho', 'SC'),
        (191, 'Pinheiro Preto', 'SC'),
        (192, 'Piratuba', 'SC'),
        (193, 'Planalto Alegre', 'SC'),
        (194, 'Pomerode', 'SC'),
        (195, 'Ponte Alta', 'SC'),
        (196, 'Ponte Alta do Norte', 'SC'),
        (197, 'Ponte Serrada', 'SC'),
        (198, 'Porto Belo', 'SC'),
        (199, 'Porto União', 'SC'),
        (200, 'Pouso Redondo', 'SC'),
        (201, 'Praia Grande', 'SC'),
        (202, 'Presidente Castelo Branco', 'SC'),
        (203, 'Presidente Getúlio', 'SC'),
        (204, 'Presidente Nereu', 'SC'),
        (205, 'Princesa', 'SC'),
        (206, 'Quilombo', 'SC'),
        (207, 'Rancho Queimado', 'SC'),
        (208, 'Rio das Antas', 'SC'),
        (209, 'Rio do Campo', 'SC'),
        (210, 'Rio do Oeste', 'SC'),
        (211, 'Rio do Sul', 'SC'),
        (212, 'Rio dos Cedros', 'SC'),
        (213, 'Rio Fortuna', 'SC'),
        (214, 'Rio Negrinho', 'SC'),
        (215, 'Rio Rufino', 'SC'),
        (216, 'Riqueza', 'SC'),
        (217, 'Rodeio', 'SC'),
        (218, 'Romelândia', 'SC'),
        (219, 'Salete', 'SC'),
        (220, 'Saltinho', 'SC'),
        (221, 'Salto Veloso', 'SC'),
        (222, 'Sangão', 'SC'),
        (223, 'Santa Cecília', 'SC'),
        (224, 'Santa Helena', 'SC'),
        (225, 'Santa Rosa de Lima', 'SC'),
        (226, 'Santa Rosa do Sul', 'SC'),
        (227, 'Santa Terezinha', 'SC'),
        (228, 'Santa Terezinha do Progresso', 'SC'),
        (229, 'Santiago do Sul', 'SC'),
        (230, 'Santo Amaro da Imperatriz', 'SC'),
        (231, 'São Bento do Sul', 'SC'),
        (232, 'São Bernardino', 'SC'),
        (233, 'São Bonifácio', 'SC'),
        (234, 'São Carlos', 'SC'),
        (235, 'São Cristovão do Sul', 'SC'),
        (236, 'São Domingos', 'SC'),
        (237, 'São Francisco do Sul', 'SC'),
        (238, 'São João Batista', 'SC'),
        (239, 'São João do Itaperiú', 'SC'),
        (240, 'São João do Oeste', 'SC'),
        (241, 'São João do Sul', 'SC'),
        (242, 'São Joaquim', 'SC'),
        (243, 'São José', 'SC'),
        (244, 'São José do Cedro', 'SC'),
        (245, 'São José do Cerrito', 'SC'),
        (246, 'São Lourenço do Oeste', 'SC'),
        (247, 'São Ludgero', 'SC'),
        (248, 'São Martinho', 'SC'),
        (249, 'São Miguel da Boa Vista', 'SC'),
        (250, 'São Miguel do Oeste', 'SC'),
        (251, 'São Pedro de Alcântara', 'SC'),
        (252, 'Saudades', 'SC'),
        (253, 'Schroeder', 'SC'),
        (254, 'Seara', 'SC'),
        (255, 'Serra Alta', 'SC'),
        (256, 'Siderópolis', 'SC'),
        (257, 'Sombrio', 'SC'),
        (258, 'Sul Brasil', 'SC'),
        (259, 'Taió', 'SC'),
        (260, 'Tangará', 'SC'),
        (261, 'Tigrinhos', 'SC'),
        (262, 'Tijucas', 'SC'),
        (263, 'Timbé do Sul', 'SC'),
        (264, 'Timbó', 'SC'),
        (265, 'Timbó Grande', 'SC'),
        (266, 'Três Barras', 'SC'),
        (267, 'Treviso', 'SC'),
        (268, 'Treze de Maio', 'SC'),
        (269, 'Treze Tílias', 'SC'),
        (270, 'Trombudo Central', 'SC'),
        (271, 'Tubarão', 'SC'),
        (272, 'Tunápolis', 'SC'),
        (273, 'Turvo', 'SC'),
        (274, 'União do Oeste', 'SC'),
        (275, 'Urubici', 'SC'),
        (276, 'Urupema', 'SC'),
        (277, 'Urussanga', 'SC'),
        (278, 'Vargeão', 'SC'),
        (279, 'Vargem', 'SC'),
        (280, 'Vargem Bonita', 'SC'),
        (281, 'Vidal Ramos', 'SC'),
        (282, 'Videira', 'SC'),
        (283, 'Vitor Meireles', 'SC'),
        (284, 'Witmarsum', 'SC'),
        (285, 'Xanxerê', 'SC'),
        (286, 'Xavantina', 'SC'),
        (287, 'Xaxim', 'SC'),
        (288, 'Zortéa', 'SC');

INSERT INTO `mydb`.`Permissao` (`PermissaoId`, `Descricao`) VALUES
        (1, 'Administrador do Software'),
        (2, 'Empresas de Rotativos (Acesso Total)'),
        (3, 'Empresas de Rotativos (Acesso Restringido)'),
        (4, 'Clientes de Empresas de Rotativos');
