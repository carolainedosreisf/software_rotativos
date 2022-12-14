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
  `Sobre` LONGTEXT NULL,
  `NumeroTelefone1` VARCHAR(15) NULL,
  `NumeroTelefone2` VARCHAR(15) NULL,
  `Email` VARCHAR(80) NULL,
  `DataCadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table `mydb`.`Estacionamento`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Estacionamento` (
  `EstacionamentoId` INT NOT NULL AUTO_INCREMENT,
  `NomeEstacionamento` VARCHAR(100) NULL,
  `CpfCnpj` VARCHAR(18) NULL,
  `Endereco` VARCHAR(80) NULL,
  `NumeroEndereco` DECIMAL(5,0) NULL,
  `Complemento` VARCHAR(45) NULL,
  `NumeroCep` VARCHAR(9) NULL,
  `CidadeId` INT NULL,
  `BairroEndereco` VARCHAR(80) NULL,
  `NumeroVagas` DECIMAL(5,0) NOT NULL,
  `NumeroLimiteReserva` DECIMAL(5,0) NOT NULL,
  `Sobre` VARCHAR(255) NULL,
  `NumeroTelefone1` VARCHAR(15) NULL,
  `NumeroTelefone2` VARCHAR(15) NULL,
  `Email` VARCHAR(80) NULL,
  `precoLivre` DECIMAL(18,2) NULL,
  `PrecoHora` DECIMAL(18,2) NULL,
  `EmpresaId` INT NOT NULL,
  `TipoChavePix` INT NOT NULL DEFAULT 0 COMMENT '0=> Chave Pix N??o Cadastrada,1=> CNPJ,2=> CPF,3=> E-mail,4=> Telefone,5=> Aleat??ria',
  `ChavePix` VARCHAR(500),
  `DataCadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`EstacionamentoId`),
  INDEX `FK23_idx` (`EmpresaId` ASC),
  INDEX `FK30_idx` (`CidadeId` ASC),
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
-- Table `mydb`.`DiasAtendimento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`DiasAtendimento` (
  `DiasAtendimentoId` INT NOT NULL AUTO_INCREMENT,
  `EstacionamentoId` INT NOT NULL,
  `HoraEntrada` TIME,
  `HoraSaida` TIME,
  `Dia` INT NOT NULL,
  `DiaDesc` VARCHAR(50) NOT NULL,
  `Aberto` ENUM('S','N') NOT NULL DEFAULT 'N' COMMENT 'S=>Sim,N=>N??o',
  PRIMARY KEY (`DiasAtendimentoId`),
  INDEX `EstacionamentoId_DiasAtendimento_indx` (`EstacionamentoId` ASC) ,
  CONSTRAINT `FKEstacionamentoId_DiasAtendimento`
    FOREIGN KEY (`EstacionamentoId`)
    REFERENCES `mydb`.`Estacionamento` (`EstacionamentoId`)
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
  `EmpresaId` INT NULL,
  `PermissaoId` INT NOT NULL,
  `TokenEmail` VARCHAR(255) NULL,
  `Status` CHAR(1) DEFAULT 'A' NOT NULL,
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
 CONSTRAINT `id_EmpresaId_Login`
    FOREIGN KEY (`EmpresaId`)
    REFERENCES `mydb`.`Empresa` (`EmpresaId`)
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
-- Table `mydb`.`Carteira`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Carteira` (
  `CarteiraId` INT NOT NULL AUTO_INCREMENT,
  `CadastroId` INT NULL,
  `EmpresaId` INT NULL,
  `TipoCartao` CHAR(1) NULL COMMENT 'D=>D??bito,C=>Cr??dito, se tivel nullo n??o ?? cart??o',
  `NumeroCartao` VARCHAR(50) NULL,
  `NomeCartao` VARCHAR(100) NULL,
  `DataExpiracaoCartao` CHAR(6) NULL,
  `CodigoSegurancaoCartao` CHAR(3) NULL,
  `CodigoPix` VARCHAR(255) NULL,
  `Descricao` VARCHAR(150) NULL,
  `Status` ENUM('A','I') NOT NULL DEFAULT 'A' COMMENT 'A => Ativo, I => Inativo que seria tamb??m excluido, pois n??o ser?? excluido nada dessa tabela',
  PRIMARY KEY (`CarteiraId`),
  INDEX `FK27_idx` (`CadastroId` ASC) ,
  INDEX `FK28_idx` (`EmpresaId` ASC) ,
  INDEX `FK25_idx` (`CarteiraId` ASC),
  CONSTRAINT `FK25`
    FOREIGN KEY (`CadastroId`)
    REFERENCES `mydb`.`Cadastro` (`CadastroId`),
  CONSTRAINT `FK26`
    FOREIGN KEY (`EmpresaId`)
    REFERENCES `mydb`.`Empresa` (`EmpresaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Reserva`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`Reserva` (
  `ReservaId` INT NOT NULL AUTO_INCREMENT,
  `DataEntrada` DATE NOT NULL,
  `DataSaida` DATE NULL,
  `HoraEntrada` TIME NOT NULL,
  `HoraSaida` TIME NULL,
  `CadastroId` INT NOT NULL,
  `Observacao` VARCHAR(255) NULL,
  `EstacionamentoId` INT NOT NULL,
  PRIMARY KEY (`ReservaId`),
  INDEX `FK29_idx` (`ReservaId` ASC),
  INDEX `FK30_idx` (`EstacionamentoId` ASC),
  CONSTRAINT `FK31`
    FOREIGN KEY (`EstacionamentoId`)
    REFERENCES `mydb`.`Estacionamento` (`EstacionamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
 CONSTRAINT `FK_Cadastro_Reserva`
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
  `CadastroId` INT NULL,
  `PlacaVeiculo` VARCHAR(30) NOT NULL,
  `Observacao` VARCHAR(255) NULL,
  `EstacionamentoId` INT NOT NULL,
  `ReservaId` INT NULL,
  `Status` ENUM('E','F') NOT NULL DEFAULT 'E' COMMENT 'E=>Em Andamento,F=>Finalizado',
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
    ON UPDATE NO ACTION,
  CONSTRAINT `FK39`
    FOREIGN KEY (`ReservaId`)
    REFERENCES `mydb`.`Reserva` (`ReservaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`Receber`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Receber` (
  `ReceberId` INT NOT NULL AUTO_INCREMENT,
  `FormaPagamentoId` INT NOT NULL,
  `FluxoVagaId` INT NULL,
  `ReservaId` INT NULL,
  `CarteiraId` INT NULL,
  `Valor` DECIMAL(18,2) NOT NULL,
  `Status` ENUM('A','P','R','F') NOT NULL COMMENT 'A=>Aguardando Pagamento,P=>Processando Pagamento,R=>Recusado,F=>Finalizado',
  PRIMARY KEY (`ReceberId`),
  INDEX `FK13_idx` (`FormaPagamentoId` ASC) ,
  INDEX `FK35_idx` (`FluxoVagaId` ASC),
  INDEX `FK36_idx` (`ReservaId` ASC),
  INDEX `FK37_idx` (`CarteiraId` ASC),
  CONSTRAINT `FK13`
    FOREIGN KEY (`FormaPagamentoId`)
    REFERENCES `mydb`.`FormaPagamento` (`FormaPagamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK35`
    FOREIGN KEY (`FluxoVagaId`)
    REFERENCES `mydb`.`FluxoVaga` (`FluxoVagaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK36`
    FOREIGN KEY (`ReservaId`)
    REFERENCES `mydb`.`Reserva` (`ReservaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK37`
    FOREIGN KEY (`CarteiraId`)
    REFERENCES `mydb`.`Carteira` (`CarteiraId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `mydb`.`ReceberEmpresa`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `mydb`.`ReceberEmpresa` (
  `ReceberEmpresaId` INT NOT NULL AUTO_INCREMENT,
  `FormaPagamentoId` INT NOT NULL,
  `EmpresaId` INT NOT NULL,
  `CarteiraId` INT NULL,
  `Valor` DECIMAL(18,2) NOT NULL,
  `DataPagamento` DATE NOT NULL,
  `DataVencimento` DATE NOT NULL,
  `Status` ENUM('A','P','R','F') NOT NULL COMMENT 'A=>Aguardando Pagamento,P=>Processando Pagamento,R=>Recusado,F=>Finalizado',
  PRIMARY KEY (`ReceberEmpresaId`),
  INDEX `FK32_idx` (`FormaPagamentoId` ASC) ,
  INDEX `FK33_idx` (`EmpresaId` ASC),
  INDEX `FK34_idx` (`CarteiraId` ASC),
  CONSTRAINT `FK32`
    FOREIGN KEY (`FormaPagamentoId`)
    REFERENCES `mydb`.`FormaPagamento` (`FormaPagamentoId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK33`
    FOREIGN KEY (`EmpresaId`)
    REFERENCES `mydb`.`Empresa` (`EmpresaId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `FK34`
    FOREIGN KEY (`CarteiraId`)
    REFERENCES `mydb`.`Carteira` (`CarteiraId`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- VIEW `mydb`.`view_pagamento_empresa`
-- -----------------------------------------------------

CREATE VIEW view_pagamento_empresa AS
SELECT 
	  a.EmpresaId
     ,IF((DATE_ADD(DataCadastro, INTERVAL 30 DAY)>=NOW()),'S','N') AS Experimental
     ,DATE_FORMAT((DATE_ADD(DataCadastro, INTERVAL 30 DAY)), '%d/%m/%Y %H:%i') AS VencExperimentalBr 
     ,DATE_FORMAT((DATE_ADD(DataCadastro, INTERVAL 30 DAY)), '%Y-%m-%d') AS VencExperimental
     ,(EXISTS(
         SELECT 1 
         FROM ReceberEmpresa AS b 
         WHERE b.EmpresaId = a.EmpresaId
         AND b.Status = 'F')) AS PagouAlgumaVez
     ,(SELECT b.DataPagamento
         FROM ReceberEmpresa AS b 
         WHERE b.EmpresaId = a.EmpresaId
         AND b.Status = 'F' 
         ORDER BY b.ReceberEmpresaId DESC
         LIMIT 1) AS UltPagamento
     ,(SELECT DATE_FORMAT(b.DataPagamento, '%d/%m/%Y') 
         FROM ReceberEmpresa AS b 
         WHERE b.EmpresaId = a.EmpresaId 
         AND b.Status = 'F'
         ORDER BY b.ReceberEmpresaId DESC
         LIMIT 1) AS UltPagamentoBr
     ,(SELECT b.DataVencimento
         FROM ReceberEmpresa AS b 
         WHERE b.EmpresaId = a.EmpresaId 
         AND b.Status = 'F'
         ORDER BY b.ReceberEmpresaId DESC
         LIMIT 1) AS VencUltPagamento
     ,(SELECT DATE_FORMAT(b.DataVencimento, '%d/%m/%Y')
         FROM ReceberEmpresa AS b 
         WHERE b.EmpresaId = a.EmpresaId 
         AND b.Status = 'F'
         ORDER BY b.ReceberEmpresaId DESC
         LIMIT 1) AS VencUltPagamentoBr
     ,DATE_FORMAT(NOW(), '%m/%Y') AS CompetenciaAtual
FROM Empresa AS a;

-- -----------------------------------------------------
-- FUNCTION `mydb`.`f_SituacaoEmpresa`
-- -----------------------------------------------------

DELIMITER //
CREATE FUNCTION `f_SituacaoEmpresa`(
	`p_EmpresaId` INT,
	`p_ret` INT
)
RETURNS LONGTEXT

BEGIN

  
   DECLARE p_Experimental CHAR(1);
   DECLARE p_VencExperimental VARCHAR(100);
   DECLARE p_PagouAlgumaVez INT;
   DECLARE p_UltPagamento DATE;
   DECLARE p_UltPagamentoBr VARCHAR(100);
   DECLARE p_VencUltPagamento DATE;
   DECLARE p_VencUltPagamentoBr VARCHAR(100);
   DECLARE p_CompetenciaAtual CHAR(100);
   DECLARE p_Agora DATE;
   DECLARE ret VARCHAR(1);
   DECLARE msg VARCHAR(500);
   DECLARE retornar VARCHAR(500);
   SELECT 
			Experimental
			,VencExperimentalBr
			,PagouAlgumaVez 
			,UltPagamento
			,UltPagamentoBr
			,VencUltPagamento
			,VencUltPagamentoBr
			,CompetenciaAtual
			,DATE_FORMAT(NOW(), '%Y-%m-%d')
			INTO p_Experimental
					,p_VencExperimental
					,p_PagouAlgumaVez 
					,p_UltPagamento
					,p_UltPagamentoBr
					,p_VencUltPagamento
					,p_VencUltPagamentoBr
					,p_CompetenciaAtual
					,p_Agora
		FROM view_pagamento_empresa 
		WHERE EmpresaId = p_EmpresaId;
		
	IF p_Experimental = 'S' AND p_PagouAlgumaVez = 0 THEN
		SET msg = CONCAT('{ADM_OU_EMPRESA} empresa esta utilizando o software pelo per??odo experimental com expira????o em ',p_VencExperimental,'.<br>A partir dessa data a utiliza????o do software somente ficar?? dispon??vel mediante ao pagamento mensal.');
		SET  ret = '1';
	ELSE
		IF p_PagouAlgumaVez = 1 THEN
			IF p_VencUltPagamento < p_Agora THEN
				SET msg = CONCAT('O ??ltimo pagamento venceu em ',p_UltPagamentoBr,'.<br>A utiliza????o do software somente ficar?? dispon??vel novamente mediante ao pagamento do m??s atual.');
				SET ret = '4';
			ELSE
			   SET msg = CONCAT('{ADM_OU_EMPRESA} empresa est?? com os pagamentos do software em dia.<br>O pr??ximo vencimento ocorrer?? em ',p_VencUltPagamentoBr,'.<br>A partir dessa data a utiliza????o do software somente ficar?? dispon??vel mediante ao pagamento mensal.');
				SET ret = '2';
			END IF;
		ELSE
			SET msg = CONCAT('O per??odo experimental expirou em ',p_VencExperimental,'.<br>A utiliza????o do software somente ficar?? dispon??vel mediante ao pagamento mensal.');
			SET ret = '3';
		END IF;
		
		
	END IF;
	
	IF p_ret=1 THEN SET retornar = ret; ELSE SET retornar = msg; END IF;
	
   RETURN retornar;
END //

DELIMITER ;

-- -----------------------------------------------------
-- FUNCTION `mydb`.`f_verificaCalculaValor`
-- -----------------------------------------------------

DELIMITER //

CREATE FUNCTION f_verificaCalculaValor(p_EstacionamentoId INT,p_Entrada DATETIME, p_Saida DATETIME)
RETURNS JSON

BEGIN
	DECLARE p_ValorHoraEstacioanemnto FLOAT;
	DECLARE p_ValorLivreEstacioanemnto FLOAT;
	DECLARE p_Minutos FLOAT;
	
	DECLARE p_ValorHora FLOAT;
	DECLARE p_ValorLivre FLOAT;
	DECLARE p_HorasTotais FLOAT;
	DECLARE p_Final FLOAT;
	DECLARE p_liberaPagarAdiantado CHAR(1);
	DECLARE p_NomeEstacionamento VARCHAR(150);
	
	DECLARE p_tempoDesc VARCHAR(100);
	SELECT 
			IFNULL(PrecoHora,0)
			,IFNULL(PrecoLivre,0)
			,timestampdiff(MINUTE, p_Entrada, p_Saida)
      ,NomeEstacionamento
			INTO p_ValorHoraEstacioanemnto
					,p_ValorLivreEstacioanemnto
					,p_Minutos
					,p_NomeEstacionamento
		FROM Estacionamento 
		WHERE EstacionamentoId = p_EstacionamentoId;
		
   SET p_HorasTotais = p_Minutos/60;
   SET p_ValorHora = p_ValorHoraEstacioanemnto*p_HorasTotais;
   SET p_ValorLivre = p_ValorLivreEstacioanemnto;
   
   
   
   IF ((p_ValorHora>0 && p_ValorLivre>0 && p_ValorLivre > p_ValorHora) || p_ValorLivre<=0) THEN
   	SET p_Final = p_ValorHora;
   ELSE
   	SET p_Final = p_ValorLivre;
   END IF;
   
   IF p_Final = p_ValorLivre THEN
   	SET p_liberaPagarAdiantado = 'S';
   ELSE
   	SET p_liberaPagarAdiantado = 'N';
   END IF;
   
   SET p_tempoDesc = CONCAT(p_Minutos DIV 60,'Hrs e ',p_Minutos MOD 60,' Min');
 
   RETURN CONCAT('{"liberaPagarAdiantado": "',p_liberaPagarAdiantado,'", "minutos":',p_Minutos,',"valor":',p_Final,',"tempoDesc":"',p_tempoDesc,'","NomeEstacionamento":"',p_NomeEstacionamento,'"}');


END; //

DELIMITER ;


-- -----------------------------------------------------
-- EXEMPLO SELECT f_verificaCalculaValor(8,'2022-10-14 08:00:00','2022-10-14 09:25:00') AS json;
-- -----------------------------------------------------

-- -----------------------------------------------------
-- FUNCTION `mydb`.`f_vagasLocacao`
-- -----------------------------------------------------


DELIMITER //

CREATE FUNCTION f_vagasLocacao(p_EstacionamentoId INT,p_Entrada DATETIME,p_Rertornar CHAR(1))
RETURNS INT

BEGIN

	DECLARE p_NumeroVagas INT;
	DECLARE p_ProximasReservas INT;
	DECLARE p_QtdLocacoes INT;
	DECLARE p_Lotacao INT;

	SELECT 
			NumeroVagas
			INTO p_NumeroVagas
		FROM Estacionamento 
		WHERE EstacionamentoId = p_EstacionamentoId;
  
  IF p_NumeroVagas <=0 AND p_Rertornar = 'D' THEN
    RETURN 0;
  END IF;
  
  SELECT 
			count(*)
			INTO p_ProximasReservas
		FROM reserva AS a
    LEFT JOIN FluxoVaga b ON a.ReservaId = b.ReservaId 
		WHERE a.EstacionamentoId = p_EstacionamentoId
		AND b.FluxoVagaId IS NULL
    	AND a.DataEntrada = DATE_FORMAT(p_Entrada, '%Y-%m-%d')
    	AND a.HoraEntrada >= DATE_FORMAT(p_Entrada, '%H:%i:%s');

  IF p_Rertornar = 'R' THEN
    RETURN p_ProximasReservas;
  END IF;
  
  SELECT 
			count(*)
			INTO p_QtdLocacoes
		FROM FluxoVaga AS a
		WHERE a.EstacionamentoId = p_EstacionamentoId
    AND a.Status = 'E';

  IF p_Rertornar = 'L' THEN
    RETURN p_QtdLocacoes;
  END IF;

  IF p_Rertornar = 'D' THEN

    SET p_Lotacao = (p_ProximasReservas + p_QtdLocacoes);
    IF p_Lotacao < p_NumeroVagas THEN
      RETURN p_NumeroVagas - p_Lotacao;
    ELSE
      RETURN 0;
    END IF;

  END IF;

END //

DELIMITER ;

-- -----------------------------------------------------
-- EXEMPLO SELECT f_vagasLocacao(8,NOW(),'D') AS QtdVagasDisponiveisLocacao
-- EXEMPLO SELECT f_vagasLocacao(8,NOW(),'L') AS QtdLocacoes
-- EXEMPLO SELECT f_vagasLocacao(8,NOW(),'R') AS QtdReservas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- FUNCTION `mydb`.`f_vagasLocacao`
-- -----------------------------------------------------


DELIMITER //

CREATE FUNCTION f_vagasReserva(p_EstacionamentoId INT,p_Entrada DATETIME,p_Saida DATETIME,p_Rertornar CHAR(1))
RETURNS INT

BEGIN

	DECLARE p_NumeroVagas INT;
	DECLARE p_NumeroLimiteReserva INT;
	DECLARE p_ProximasReservas INT;
	DECLARE p_QtdLocacoes INT;
	DECLARE p_Lotacao INT;
	DECLARE p_DataAgora DATE;

	SELECT 
			NumeroVagas
      ,NumeroLimiteReserva
      ,DATE_FORMAT(NOW(), '%Y-%m-%d')
			INTO p_NumeroVagas
      ,p_NumeroLimiteReserva
      ,p_DataAgora
		FROM Estacionamento 
		WHERE EstacionamentoId = p_EstacionamentoId;
  
  IF p_NumeroLimiteReserva <=0 AND p_Rertornar = 'D' THEN
    RETURN 0;
  END IF;
  
  SELECT 
			count(*)
			INTO p_ProximasReservas
		FROM reserva AS a
    LEFT JOIN FluxoVaga b ON a.ReservaId = b.ReservaId 
		WHERE a.EstacionamentoId = p_EstacionamentoId
		AND b.FluxoVagaId IS NULL
    	AND a.DataEntrada = DATE_FORMAT(p_Entrada, '%Y-%m-%d')
      AND ((a.HoraEntrada >= DATE_FORMAT(p_Entrada, '%H:%i:%s') AND a.HoraEntrada <= DATE_FORMAT(p_Saida, '%H:%i:%s')) 
              OR (a.HoraSaida >= DATE_FORMAT(p_Entrada, '%H:%i:%s') AND a.HoraEntrada <= DATE_FORMAT(p_Saida, '%H:%i:%s')));

  IF p_Rertornar = 'R' THEN
    RETURN p_ProximasReservas;
  END IF;
  
  IF p_DataAgora = DATE_FORMAT(p_Entrada, '%Y-%m-%d') THEN
      SELECT 
          count(*)
          INTO p_QtdLocacoes
        FROM FluxoVaga AS a
        WHERE a.EstacionamentoId = p_EstacionamentoId
        AND a.Status = 'E';
  ELSE
    SET p_QtdLocacoes = 0;
  END IF;
  
  IF p_Rertornar = 'L' THEN
    RETURN p_QtdLocacoes;
  END IF;

  IF p_Rertornar = 'D' THEN

    SET p_Lotacao = (p_ProximasReservas + p_QtdLocacoes);

    IF p_Lotacao < p_NumeroVagas  AND p_ProximasReservas < p_NumeroLimiteReserva THEN
      RETURN p_NumeroLimiteReserva - p_ProximasReservas;
    ELSE
      RETURN 0;
    END IF;

  END IF;

END //

DELIMITER ;

-- -----------------------------------------------------
-- EXEMPLO SELECT f_vagasReserva(8,'2022-11-03 08:00:00','2022-11-03 12:00:00','D') AS QtdVagasDisponiveisReservar
-- EXEMPLO SELECT f_vagasReserva(8,'2022-11-03 08:00:00','2022-11-03 12:00:00','L') AS QtdLocacoes
-- EXEMPLO SELECT f_vagasReserva(8,'2022-11-03 08:00:00','2022-11-03 12:00:00','R') AS QtdReservas
-- -----------------------------------------------------

-- -----------------------------------------------------
-- FUNCTION `mydb`.`f_diaSemana`
-- -----------------------------------------------------


-- DELIMITER //

-- CREATE FUNCTION f_diaSemana(p_Data DATE)
-- RETURNS INT

-- BEGIN

-- 	DECLARE p_diaTxt VARCHAR(50);
-- 	DECLARE p_Rertorno INT;

-- 	SELECT 
-- 			DAYNAME(p_Data)
-- 			INTO p_diaTxt;
  
   
--    case p_diaTxt 
--       WHEN 'Monday' THEN SET p_Rertorno = 1;
--       WHEN 'Tuesday' THEN SET p_Rertorno = 2;
--       WHEN 'Wednesday' THEN SET p_Rertorno = 3;
--       WHEN 'Thursday' THEN SET p_Rertorno = 4;
--       WHEN 'Friday' THEN SET p_Rertorno = 5;
--       WHEN 'Saturday' THEN SET p_Rertorno = 6;
--       WHEN 'Sunday' THEN SET p_Rertorno = 7;
--       ELSE SET p_Rertorno = 0;
--     end case;
    
--     RETURN p_Rertorno;

-- END //

-- DELIMITER ;

-- -----------------------------------------------------
-- EXEMPLO Select  f_diaSemana('2022-10-30') AS dia;

-- -----------------------------------------------------

ALTER TABLE `mydb`.`Estacionamento` ADD LinkMaps VARCHAR(255);
