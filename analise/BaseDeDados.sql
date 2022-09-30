-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 30-Set-2022 às 02:44
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `mydb`
--

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`CadastroId`, `Nome`, `TipoCadastro`, `Cpf`, `NumeroTelefone`, `NumeroCelular`, `NumeroCep`, `CidadeId`, `NumeroEndereco`, `Endereco`, `BairroEndereco`, `Complemento`, `Mensalista`) VALUES
(1, 'Antônio da Silva', NULL, '08173646090', '488577886', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Jose de Sousa', NULL, '11129047008', '4885778687', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Maria da Rosa', NULL, '99872556040', '488857758', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Extraindo dados da tabela `cidade`
--

INSERT INTO `cidade` (`CidadeId`, `NomeCidade`, `Estado`) VALUES
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

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`EmpresaId`, `Nome`, `RazaoSocial`, `CpfCnpj`, `TipoEmpresa`, `Endereco`, `NumeroEndereco`, `Complemento`, `NumeroCep`, `CidadeId`, `BairroEndereco`, `UrlLogo`, `Sobre`, `NumeroTelefone1`, `NumeroTelefone2`, `Email`, `DataCadastro`) VALUES
(1, 'Rotativos João', 'Rotativos João', '67318259000156', 'J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-10 12:10:54'),
(2, 'Aguiar Estacionamentos', 'Aguiar Estacionamentos', '74522886000170', 'J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-09-15 22:55:04'),
(4, 'Zé Rotativos', 'Zé Rotativos', '90914664000159', 'J', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2022-07-22 12:33:39');

--
-- Extraindo dados da tabela `estacionamento`
--

INSERT INTO `estacionamento` (`EstacionamentoId`, `NomeEstacionamento`, `CpfCnpj`, `Endereco`, `NumeroEndereco`, `Complemento`, `NumeroCep`, `CidadeId`, `BairroEndereco`, `NumeroVagas`, `Sobre`, `NumeroTelefone1`, `NumeroTelefone2`, `Email`, `DiasAtendimentoId`, `precoLivre`, `PrecoHora`, `EmpresaId`, `DataCadastro`) VALUES
(1, 'Rotativos João (Cruzeiro do Sul)', '67318259000156', 'Rua Hercílio Luz', '100', NULL, '88811092', 70, 'Cruzeiro do Sul', '100', NULL, '48565456456', '48554456456', 'rotativos.joao@teste.com', NULL, '0.00', '0.00', 1, '2022-09-10 12:10:54'),
(2, 'Aguiar Estacionamentos', '74522886000170', 'Avenida Centenário', '100', NULL, '88815000', 70, 'Próspera', '50', NULL, '48999985557', '48755585757', 'aguiar.estacionamentos@teste.com', NULL, '10.00', '5.00', 2, '2022-09-15 22:55:04'),
(3, 'Rotativos João (Santa Bárbara)', '58409749000177', 'Rua Jerônimo Coelho', '100', NULL, '88804340', 70, 'Santa Bárbara', '100', NULL, '48455454545', NULL, 'rotativos.joao@teste.com', NULL, '10.00', '5.00', 1, '2022-09-22 12:18:29'),
(7, 'Zé Rotativos (Centro)', '90914664000159', 'Rua Coronel Marcos Rovaris', '100', NULL, '88801100', 70, 'Centro', '200', NULL, '4899775757', NULL, 'ze.rotativos@gmail.com', NULL, '0.00', '5.00', 4, '2022-09-22 12:33:39'),
(8, 'Zé Rotativos (Próspera)', '90914664000159', 'Avenida Centenário', '100', NULL, '88815000', 70, 'Próspera', '150', NULL, '48775557575', NULL, 'ze.rotativos@gmail.com', NULL, '8.00', '4.00', 4, '2022-09-22 12:38:41');

--
-- Extraindo dados da tabela `formapagamento`
--

INSERT INTO `formapagamento` (`FormaPagamentoId`, `Descricao`) VALUES
(1, 'Pix'),
(2, 'Dinheiro'),
(3, 'Cartão de Débito'),
(4, 'Cartão de Crédito'),
(5, 'Online');

--
-- Extraindo dados da tabela `fotoestacionamento`
--

INSERT INTO `fotoestacionamento` (`FotoEstacionamentoId`, `EstacionamentoId`, `UrlFoto`) VALUES
(10, 2, '/estacionamentos/2524975640024223631202209152256.PNG'),
(11, 7, '/estacionamentos/3018677628477373060202209221410.PNG');

--
-- Extraindo dados da tabela `permissao`
--

INSERT INTO `permissao` (`PermissaoId`, `Descricao`) VALUES
(1, 'Administrador do Software'),
(2, 'Empresas de Rotativos (Permissão Total)'),
(3, 'Empresas de Rotativos (Permissão Restringida)'),
(4, 'Clientes de Empresas de Rotativos');

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`LoginId`, `Email`, `NomeUsuario`, `Senha`, `CadastroId`, `EstacionamentoId`, `PermissaoId`, `TokenEmail`, `Status`) VALUES
(1, 'rotativos.joao@teste.com', 'rotativos.joao', '25d55ad283aa400af464c76d713c07ad', NULL, 1, 2, NULL, 'A'),
(12, 'aguiar.estacionamentos@teste.com', 'aguiar.estacionamentos', '25d55ad283aa400af464c76d713c07ad', NULL, 2, 2, NULL, 'A'),
(15, 'ze.rotativos@gmail.com', 'ze.rotativos', '25d55ad283aa400af464c76d713c07ad', NULL, 7, 2, NULL, 'A'),
(16, 'caroldosreis97@gmail.com', 'carolaine.zerotativos', NULL, NULL, 7, 3, NULL, 'I');

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`ReservaId`, `DataEntrada`, `DataSaida`, `HoraEntrada`, `HoraSaida`, `CadastroId`, `Observacao`, `EstacionamentoId`) VALUES
(1, '2022-09-28', '2022-09-28', '08:00:00', '10:00:00', 1, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 8),
(2, '2022-09-27', '2022-09-27', '12:00:00', '16:00:00', 1, NULL, 7),
(3, '2022-09-26', '2022-09-26', '12:00:00', '16:00:00', 2, NULL, 8),
(8, '2022-09-30', '2022-09-30', '10:00:00', '12:00:00', 3, NULL, 8),
(9, '2022-09-30', '2022-09-30', '14:00:00', '16:30:00', 3, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 8),
(10, '2022-09-30', '2022-09-30', '08:00:00', '12:00:00', 1, NULL, 8),
(11, '2022-09-30', '2022-09-30', '19:15:00', '21:15:00', 1, NULL, 8),
(12, '2022-09-30', '2022-09-30', '09:00:00', '12:00:00', 2, NULL, 8);


--
-- Extraindo dados da tabela `fluxovaga`
--

INSERT INTO `fluxovaga` (`FluxoVagaId`, `DataEntrada`, `DataSaida`, `HoraEntrada`, `HoraSaida`, `CadastroId`, `PlacaVeiculo`, `Observacao`, `EstacionamentoId`, `ReservaId`, `Status`) VALUES
(1, '2022-09-23', '2022-09-23', '14:30:00', '20:35:00', NULL, 'ABC1234', NULL, 8, NULL, 'F'),
(2, '2022-09-23', '2022-09-23', '16:00:00', '18:00:00', NULL, 'FGD5434', NULL, 7, NULL, 'F'),
(3, '2022-09-23', '2022-09-23', '19:00:00', '20:00:00', NULL, 'ASD3R32', NULL, 8, NULL, 'F'),
(4, '2022-09-23', '2022-09-23', '12:00:00', '16:00:00', NULL, 'GHJ7755', NULL, 7, NULL, 'F'),
(5, '2022-09-24', '2022-09-24', '10:00:00', '12:15:00', NULL, 'DHH1234', NULL, 7, NULL, 'F'),
(6, '2022-09-24', '2022-09-24', '11:21:00', '13:30:00', NULL, 'HEM2F53', NULL, 7, NULL, 'F'),
(7, '2022-09-24', '2022-09-24', '08:49:00', '10:00:00', NULL, 'CHF6N49', NULL, 7, NULL, 'F'),
(8, '2022-09-22', '2022-09-22', '12:33:00', '13:08:00', NULL, 'GHN6977', NULL, 7, NULL, 'F'),
(9, '2022-09-22', '2022-09-22', '12:19:00', '14:56:00', NULL, 'JHV7733', NULL, 7, NULL, 'F'),
(10, '2022-09-22', '2022-09-22', '08:14:00', '11:58:00', NULL, 'QGQ2355', NULL, 7, NULL, 'F'),
(11, '2022-09-22', '2022-09-22', '08:37:00', '12:21:00', NULL, 'CWL5K69', NULL, 7, NULL, 'F'),
(12, '2022-09-22', '2022-09-22', '17:45:00', '21:22:00', NULL, 'GQH8568', NULL, 7, NULL, 'F'),
(13, '2022-09-22', '2022-09-22', '14:03:00', '17:50:00', NULL, 'URT2888', NULL, 7, NULL, 'F'),
(14, '2022-09-22', '2022-09-22', '19:16:00', '20:03:00', NULL, 'SKQ8846', NULL, 7, NULL, 'F'),
(15, '2022-09-22', '2022-09-22', '10:06:00', '11:59:00', NULL, 'HFG8K82', NULL, 8, NULL, 'F'),
(16, '2022-09-21', '2022-09-21', '14:57:00', '21:12:00', NULL, 'ESP6962', NULL, 8, NULL, 'F'),
(17, '2022-09-21', '2022-09-21', '14:46:00', '19:16:00', NULL, 'YBM6841', NULL, 8, NULL, 'F'),
(18, '2022-09-21', '2022-09-21', '13:57:00', '16:42:00', NULL, 'IAO8J16', NULL, 8, NULL, 'F'),
(19, '2022-09-21', '2022-09-21', '19:19:00', '20:38:00', NULL, 'AVU1772', NULL, 8, NULL, 'F'),
(20, '2022-09-21', '2022-09-21', '16:12:00', '21:57:00', NULL, 'PWG7485', NULL, 8, NULL, 'F'),
(21, '2022-09-21', '2022-09-21', '16:36:00', '20:31:00', NULL, 'NJH3Y68', NULL, 8, NULL, 'F'),
(22, '2022-09-21', '2022-09-21', '09:31:00', '12:21:00', NULL, 'LVP7L46', NULL, 8, NULL, 'F'),
(23, '2022-09-21', '2022-09-21', '15:40:00', '21:54:00', NULL, 'RXS2321', NULL, 8, NULL, 'F'),
(24, '2022-09-21', '2022-09-21', '11:04:00', '19:07:00', NULL, 'ECW2574', NULL, 8, NULL, 'F'),
(25, '2022-09-21', '2022-09-21', '11:01:00', '13:03:00', NULL, 'WTN1J96', NULL, 8, NULL, 'F'),
(26, '2022-09-21', '2022-09-21', '16:48:00', '17:38:00', NULL, 'ZHW3M76', NULL, 8, NULL, 'F'),
(27, '2022-09-21', '2022-09-21', '17:13:00', '21:16:00', NULL, 'XLF7474', NULL, 8, NULL, 'F'),
(28, '2022-09-21', '2022-09-21', '10:28:00', '12:52:00', NULL, 'JXI1527', NULL, 8, NULL, 'F'),
(29, '2022-09-21', '2022-09-21', '17:37:00', '19:25:00', NULL, 'QXY4548', NULL, 8, NULL, 'F'),
(30, '2022-09-21', '2022-09-21', '11:59:00', '16:17:00', NULL, 'HXN2C12', NULL, 8, NULL, 'F'),
(31, '2022-09-21', '2022-09-21', '19:07:00', '21:34:00', NULL, 'CBC4332', NULL, 8, NULL, 'F'),
(32, '2022-09-21', '2022-09-21', '08:57:00', '10:02:00', NULL, 'CND2K83', NULL, 8, NULL, 'F'),
(33, '2022-09-21', '2022-09-21', '17:45:00', '18:49:00', NULL, 'RST5N88', NULL, 8, NULL, 'F'),
(34, '2022-09-21', '2022-09-21', '19:20:00', '21:17:00', NULL, 'GNZ8Q97', NULL, 8, NULL, 'F'),
(35, '2022-09-21', '2022-09-21', '12:05:00', '20:12:00', NULL, 'SOB3922', NULL, 8, NULL, 'F'),
(36, '2022-09-21', '2022-09-21', '17:33:00', '20:02:00', NULL, 'CLO2M79', NULL, 8, NULL, 'F'),
(37, '2022-09-21', '2022-09-21', '18:23:00', '20:13:00', NULL, 'NOA9C64', NULL, 8, NULL, 'F'),
(38, '2022-09-21', '2022-09-21', '13:36:00', '15:47:00', NULL, 'HDO1756', NULL, 8, NULL, 'F'),
(39, '2022-09-21', '2022-09-21', '08:35:00', '17:59:00', NULL, 'VJB5519', NULL, 8, NULL, 'F'),
(40, '2022-09-21', '2022-09-21', '17:44:00', '20:23:00', NULL, 'HTM7F18', NULL, 8, NULL, 'F'),
(41, '2022-09-21', '2022-09-21', '18:09:00', '20:57:00', NULL, 'AME4A62', NULL, 8, NULL, 'F'),
(42, '2022-09-21', '2022-09-21', '17:56:00', '20:35:00', NULL, 'JOB6885', NULL, 8, NULL, 'F'),
(43, '2022-09-21', '2022-09-21', '17:58:00', '20:03:00', NULL, 'TZG4I77', NULL, 8, NULL, 'F'),
(44, '2022-09-21', '2022-09-21', '13:15:00', '14:10:00', NULL, 'UJF6U86', NULL, 8, NULL, 'F'),
(45, '2022-09-21', '2022-09-21', '17:32:00', '20:18:00', NULL, 'DWU7T55', NULL, 8, NULL, 'F'),
(46, '2022-09-21', '2022-09-21', '18:38:00', '20:45:00', NULL, 'FMZ4P51', NULL, 8, NULL, 'F'),
(47, '2022-09-21', '2022-09-21', '14:42:00', '19:22:00', NULL, 'CDM6I17', NULL, 8, NULL, 'F'),
(48, '2022-09-21', '2022-09-21', '11:40:00', '19:47:00', NULL, 'RIO7643', NULL, 8, NULL, 'F'),
(49, '2022-09-21', '2022-09-21', '14:38:00', '15:19:00', NULL, 'VNV6M21', NULL, 8, NULL, 'F'),
(50, '2022-09-21', '2022-09-21', '09:22:00', '11:26:00', NULL, 'YMM1K11', NULL, 8, NULL, 'F'),
(51, '2022-09-21', '2022-09-21', '17:05:00', '18:45:00', NULL, 'IYA4E23', NULL, 8, NULL, 'F'),
(52, '2022-09-21', '2022-09-21', '18:57:00', '21:46:00', NULL, 'XJQ1214', NULL, 8, NULL, 'F'),
(53, '2022-09-21', '2022-09-21', '12:43:00', '20:12:00', NULL, 'UCF8T52', NULL, 8, NULL, 'F'),
(54, '2022-09-21', '2022-09-21', '11:14:00', '15:31:00', NULL, 'YAB1G56', NULL, 8, NULL, 'F'),
(55, '2022-09-21', '2022-09-21', '09:02:00', '11:15:00', NULL, 'LMB4442', NULL, 8, NULL, 'F'),
(56, '2022-09-21', '2022-09-21', '19:49:00', '20:13:00', NULL, 'DLM2J16', NULL, 8, NULL, 'F'),
(57, '2022-09-21', '2022-09-21', '13:16:00', '20:11:00', NULL, 'BBQ1V42', NULL, 8, NULL, 'F'),
(58, '2022-09-21', '2022-09-21', '09:40:00', '21:40:00', NULL, 'YPA1658', NULL, 8, NULL, 'F'),
(59, '2022-09-21', '2022-09-21', '17:52:00', '18:30:00', NULL, 'NHQ6G81', NULL, 8, NULL, 'F'),
(60, '2022-09-21', '2022-09-21', '14:41:00', '19:50:00', NULL, 'KXO9547', NULL, 8, NULL, 'F'),
(61, '2022-09-21', '2022-09-21', '10:48:00', '14:11:00', NULL, 'ATE2F73', NULL, 8, NULL, 'F'),
(62, '2022-09-21', '2022-09-21', '17:48:00', '21:25:00', NULL, 'JEX8S37', NULL, 8, NULL, 'F'),
(63, '2022-09-21', '2022-09-21', '13:07:00', '17:29:00', NULL, 'LLZ7Q65', NULL, 8, NULL, 'F'),
(64, '2022-09-21', '2022-09-21', '12:53:00', '21:04:00', NULL, 'BJQ7Q63', NULL, 8, NULL, 'F'),
(65, '2022-09-21', '2022-09-21', '14:28:00', '20:27:00', NULL, 'FOC9F94', NULL, 8, NULL, 'F'),
(66, '2022-09-21', '2022-09-21', '16:28:00', '21:32:00', NULL, 'TGE8538', NULL, 8, NULL, 'F'),
(67, '2022-09-21', '2022-09-21', '19:58:00', '20:34:00', NULL, 'FVQ5865', NULL, 8, NULL, 'F'),
(68, '2022-09-21', '2022-09-21', '16:49:00', '21:21:00', NULL, 'KNB9917', NULL, 8, NULL, 'F'),
(69, '2022-09-21', '2022-09-21', '17:06:00', '18:36:00', NULL, 'DHZ5988', NULL, 8, NULL, 'F'),
(70, '2022-09-21', '2022-09-21', '14:53:00', '21:03:00', NULL, 'SXY8558', NULL, 8, NULL, 'F'),
(71, '2022-09-21', '2022-09-21', '18:59:00', '19:33:00', NULL, 'HIT9X93', NULL, 8, NULL, 'F'),
(72, '2022-09-21', '2022-09-21', '12:28:00', '17:47:00', NULL, 'UNT1K22', NULL, 8, NULL, 'F'),
(73, '2022-09-21', '2022-09-21', '10:41:00', '13:02:00', NULL, 'LNB1R33', NULL, 8, NULL, 'F'),
(74, '2022-09-21', '2022-09-21', '15:26:00', '20:56:00', NULL, 'UJP6I31', NULL, 8, NULL, 'F'),
(75, '2022-09-21', '2022-09-21', '14:42:00', '17:12:00', NULL, 'UJM7413', NULL, 8, NULL, 'F'),
(76, '2022-09-21', '2022-09-21', '19:22:00', '20:36:00', NULL, 'XDG3R77', NULL, 8, NULL, 'F'),
(77, '2022-09-21', '2022-09-21', '19:28:00', '21:27:00', NULL, 'FNO8W56', NULL, 8, NULL, 'F'),
(78, '2022-09-21', '2022-09-21', '15:16:00', '19:44:00', NULL, 'NQD9W61', NULL, 8, NULL, 'F'),
(79, '2022-09-21', '2022-09-21', '12:43:00', '14:10:00', NULL, 'NWM2G11', NULL, 8, NULL, 'F'),
(80, '2022-09-21', '2022-09-21', '13:44:00', '16:51:00', NULL, 'OUB5S57', NULL, 8, NULL, 'F'),
(81, '2022-09-21', '2022-09-21', '18:22:00', '19:43:00', NULL, 'UGS6E12', NULL, 8, NULL, 'F'),
(82, '2022-09-21', '2022-09-21', '18:29:00', '21:49:00', NULL, 'VJJ1W92', NULL, 8, NULL, 'F'),
(83, '2022-09-21', '2022-09-21', '19:30:00', '20:37:00', NULL, 'ESM1Q42', NULL, 8, NULL, 'F'),
(84, '2022-09-21', '2022-09-21', '10:48:00', '16:04:00', NULL, 'NRV9C38', NULL, 8, NULL, 'F'),
(85, '2022-09-21', '2022-09-21', '16:15:00', '21:01:00', NULL, 'SAD9N25', NULL, 8, NULL, 'F'),
(86, '2022-09-21', '2022-09-21', '15:30:00', '17:54:00', NULL, 'HWQ2D56', NULL, 8, NULL, 'F'),
(87, '2022-09-21', '2022-09-21', '11:32:00', '20:17:00', NULL, 'OUQ3736', NULL, 8, NULL, 'F'),
(88, '2022-09-21', '2022-09-21', '18:17:00', '19:43:00', NULL, 'EPH7Z51', NULL, 8, NULL, 'F'),
(89, '2022-09-21', '2022-09-21', '10:06:00', '14:02:00', NULL, 'VYT3R38', NULL, 8, NULL, 'F'),
(90, '2022-09-21', '2022-09-21', '16:11:00', '20:58:00', NULL, 'GCP7138', NULL, 8, NULL, 'F'),
(91, '2022-09-21', '2022-09-21', '16:53:00', '19:30:00', NULL, 'XZD9U31', NULL, 8, NULL, 'F'),
(92, '2022-09-21', '2022-09-21', '10:02:00', '21:19:00', NULL, 'ORD6O67', NULL, 8, NULL, 'F'),
(93, '2022-09-21', '2022-09-21', '08:48:00', '16:50:00', NULL, 'LRM7239', NULL, 8, NULL, 'F'),
(94, '2022-09-21', '2022-09-21', '13:47:00', '18:40:00', NULL, 'KFU7994', NULL, 8, NULL, 'F'),
(95, '2022-09-21', '2022-09-21', '11:15:00', '21:20:00', NULL, 'IAW8214', NULL, 8, NULL, 'F'),
(96, '2022-09-21', '2022-09-21', '08:05:00', '17:03:00', NULL, 'FCI8726', NULL, 8, NULL, 'F'),
(97, '2022-09-21', '2022-09-21', '09:13:00', '18:48:00', NULL, 'KZA6649', NULL, 8, NULL, 'F'),
(98, '2022-09-21', '2022-09-21', '10:51:00', '11:07:00', NULL, 'SVN7563', NULL, 8, NULL, 'F'),
(99, '2022-09-21', '2022-09-21', '08:49:00', '13:34:00', NULL, 'QEY4821', NULL, 8, NULL, 'F'),
(100, '2022-09-21', '2022-09-21', '17:28:00', '20:10:00', NULL, 'IQB4Q16', NULL, 8, NULL, 'F'),
(101, '2022-09-21', '2022-09-21', '17:10:00', '18:57:00', NULL, 'ZVV4B66', NULL, 8, NULL, 'F'),
(102, '2022-09-21', '2022-09-21', '18:19:00', '19:52:00', NULL, 'MBM6E27', NULL, 8, NULL, 'F'),
(103, '2022-09-21', '2022-09-21', '10:10:00', '18:11:00', NULL, 'KOH1116', NULL, 8, NULL, 'F'),
(104, '2022-09-21', '2022-09-21', '11:15:00', '14:35:00', NULL, 'WRE4F51', NULL, 8, NULL, 'F'),
(105, '2022-09-21', '2022-09-21', '11:15:00', '13:49:00', NULL, 'DYD8746', NULL, 8, NULL, 'F'),
(106, '2022-09-21', '2022-09-21', '14:43:00', '18:39:00', NULL, 'WHY5749', NULL, 8, NULL, 'F'),
(107, '2022-09-21', '2022-09-21', '12:10:00', '18:08:00', NULL, 'WHB2594', NULL, 8, NULL, 'F'),
(108, '2022-09-21', '2022-09-21', '17:02:00', '20:30:00', NULL, 'SCD6D39', NULL, 8, NULL, 'F'),
(109, '2022-09-21', '2022-09-21', '19:32:00', '21:41:00', NULL, 'MHU9F55', NULL, 8, NULL, 'F'),
(110, '2022-09-21', '2022-09-21', '12:13:00', '13:50:00', NULL, 'BLT7S79', NULL, 8, NULL, 'F'),
(111, '2022-09-21', '2022-09-21', '14:29:00', '16:37:00', NULL, 'NAY1315', NULL, 8, NULL, 'F'),
(112, '2022-09-21', '2022-09-21', '14:23:00', '15:02:00', NULL, 'UJG7I15', NULL, 8, NULL, 'F'),
(113, '2022-09-21', '2022-09-21', '19:41:00', '20:39:00', NULL, 'ZES6841', NULL, 8, NULL, 'F'),
(114, '2022-09-21', '2022-09-21', '13:07:00', '19:19:00', NULL, 'UST5K21', NULL, 8, NULL, 'F'),
(115, '2022-09-21', '2022-09-21', '11:11:00', '19:23:00', NULL, 'ADZ7489', NULL, 8, NULL, 'F'),
(116, '2022-09-22', '2022-09-22', '14:07:00', '15:41:00', NULL, 'NTB6U83', NULL, 8, NULL, 'F'),
(117, '2022-09-22', '2022-09-22', '09:46:00', '12:16:00', NULL, 'SFO4596', NULL, 8, NULL, 'F'),
(118, '2022-09-22', '2022-09-22', '09:06:00', '11:57:00', NULL, 'ZIM8F43', NULL, 8, NULL, 'F'),
(119, '2022-09-22', '2022-09-22', '13:33:00', '17:19:00', NULL, 'YLH4W89', NULL, 8, NULL, 'F'),
(120, '2022-09-22', '2022-09-22', '18:33:00', '21:51:00', NULL, 'SOY6D81', NULL, 8, NULL, 'F'),
(121, '2022-09-22', '2022-09-22', '10:47:00', '21:52:00', NULL, 'SGM6778', NULL, 8, NULL, 'F'),
(122, '2022-09-22', '2022-09-22', '11:12:00', '16:40:00', NULL, 'FCT4S53', NULL, 8, NULL, 'F'),
(123, '2022-09-22', '2022-09-22', '13:53:00', '17:51:00', NULL, 'PVX1V61', NULL, 8, NULL, 'F'),
(124, '2022-09-22', '2022-09-22', '16:44:00', '21:55:00', NULL, 'FBQ8492', NULL, 8, NULL, 'F'),
(125, '2022-09-22', '2022-09-22', '13:08:00', '17:39:00', NULL, 'YJK7741', NULL, 8, NULL, 'F'),
(126, '2022-09-22', '2022-09-22', '13:54:00', '14:56:00', NULL, 'UTT9565', NULL, 8, NULL, 'F'),
(127, '2022-09-22', '2022-09-22', '08:46:00', '10:28:00', NULL, 'AFD6113', NULL, 8, NULL, 'F'),
(128, '2022-09-22', '2022-09-22', '14:01:00', '19:26:00', NULL, 'XNU8345', NULL, 8, NULL, 'F'),
(129, '2022-09-22', '2022-09-22', '12:06:00', '16:14:00', NULL, 'JSD8H57', NULL, 8, NULL, 'F'),
(130, '2022-09-22', '2022-09-22', '19:20:00', '20:43:00', NULL, 'TNK3566', NULL, 8, NULL, 'F'),
(131, '2022-09-22', '2022-09-22', '10:07:00', '20:01:00', NULL, 'EAE8493', NULL, 8, NULL, 'F'),
(132, '2022-09-22', '2022-09-22', '13:30:00', '19:36:00', NULL, 'HYD9Z75', NULL, 8, NULL, 'F'),
(133, '2022-09-22', '2022-09-22', '15:41:00', '17:08:00', NULL, 'QZT7526', NULL, 8, NULL, 'F'),
(134, '2022-09-22', '2022-09-22', '16:29:00', '21:03:00', NULL, 'LFC2128', NULL, 8, NULL, 'F'),
(135, '2022-09-22', '2022-09-22', '14:01:00', '17:15:00', NULL, 'RWW2L75', NULL, 8, NULL, 'F'),
(136, '2022-09-22', '2022-09-22', '19:04:00', '20:43:00', NULL, 'RPA8O54', NULL, 8, NULL, 'F'),
(137, '2022-09-22', '2022-09-22', '14:07:00', '15:58:00', NULL, 'NAD9953', NULL, 8, NULL, 'F'),
(138, '2022-09-22', '2022-09-22', '11:57:00', '17:46:00', NULL, 'LDS3Q83', NULL, 8, NULL, 'F'),
(139, '2022-09-22', '2022-09-22', '16:32:00', '19:11:00', NULL, 'EKK4I49', NULL, 8, NULL, 'F'),
(140, '2022-09-22', '2022-09-22', '17:49:00', '19:18:00', NULL, 'SWM2K53', NULL, 8, NULL, 'F'),
(141, '2022-09-22', '2022-09-22', '11:03:00', '15:50:00', NULL, 'JRF8A46', NULL, 8, NULL, 'F'),
(142, '2022-09-22', '2022-09-22', '09:26:00', '19:15:00', NULL, 'CIX9R81', NULL, 8, NULL, 'F'),
(143, '2022-09-22', '2022-09-22', '19:53:00', '20:18:00', NULL, 'POM5X76', NULL, 8, NULL, 'F'),
(144, '2022-09-22', '2022-09-22', '10:38:00', '11:21:00', NULL, 'QNB9M68', NULL, 8, NULL, 'F'),
(145, '2022-09-22', '2022-09-22', '11:10:00', '15:21:00', NULL, 'GOD6B41', NULL, 8, NULL, 'F'),
(146, '2022-09-22', '2022-09-22', '16:43:00', '18:42:00', NULL, 'QBE3S65', NULL, 8, NULL, 'F'),
(147, '2022-09-22', '2022-09-22', '08:36:00', '17:29:00', NULL, 'PCY9656', NULL, 8, NULL, 'F'),
(148, '2022-09-22', '2022-09-22', '12:45:00', '15:33:00', NULL, 'AOZ5143', NULL, 8, NULL, 'F'),
(149, '2022-09-22', '2022-09-22', '09:53:00', '11:31:00', NULL, 'WLT7926', NULL, 8, NULL, 'F'),
(150, '2022-09-22', '2022-09-22', '17:29:00', '19:21:00', NULL, 'STS1L23', NULL, 8, NULL, 'F'),
(151, '2022-09-22', '2022-09-22', '09:36:00', '21:20:00', NULL, 'KTD3832', NULL, 8, NULL, 'F'),
(152, '2022-09-22', '2022-09-22', '16:46:00', '19:59:00', NULL, 'LQP7541', NULL, 8, NULL, 'F'),
(153, '2022-09-22', '2022-09-22', '18:44:00', '19:55:00', NULL, 'GUV9794', NULL, 8, NULL, 'F'),
(154, '2022-09-22', '2022-09-22', '12:26:00', '16:50:00', NULL, 'YWF2884', NULL, 8, NULL, 'F'),
(155, '2022-09-22', '2022-09-22', '18:54:00', '20:52:00', NULL, 'IWN3829', NULL, 8, NULL, 'F'),
(156, '2022-09-22', '2022-09-22', '13:48:00', '16:21:00', NULL, 'MCO7551', NULL, 8, NULL, 'F'),
(157, '2022-09-22', '2022-09-22', '11:11:00', '14:55:00', NULL, 'BIB2257', NULL, 8, NULL, 'F'),
(158, '2022-09-22', '2022-09-22', '12:50:00', '13:37:00', NULL, 'RQV6Z77', NULL, 8, NULL, 'F'),
(159, '2022-09-22', '2022-09-22', '17:33:00', '20:11:00', NULL, 'AHK2H14', NULL, 8, NULL, 'F'),
(160, '2022-09-22', '2022-09-22', '17:30:00', '18:14:00', NULL, 'ZZT6125', NULL, 8, NULL, 'F'),
(161, '2022-09-22', '2022-09-22', '14:31:00', '18:13:00', NULL, 'BLC6616', NULL, 8, NULL, 'F'),
(162, '2022-09-22', '2022-09-22', '10:14:00', '19:30:00', NULL, 'PNE9419', NULL, 8, NULL, 'F'),
(163, '2022-09-22', '2022-09-22', '16:06:00', '19:55:00', NULL, 'QQG5563', NULL, 8, NULL, 'F'),
(164, '2022-09-22', '2022-09-22', '18:17:00', '20:16:00', NULL, 'SGV3Y89', NULL, 8, NULL, 'F'),
(165, '2022-09-22', '2022-09-22', '11:41:00', '21:32:00', NULL, 'MNN5543', NULL, 8, NULL, 'F'),
(166, '2022-09-25', '2022-09-25', '14:00:00', '16:00:00', NULL, 'HGH5645', NULL, 7, NULL, 'F'),
(167, '2022-09-26', '2022-09-26', '10:00:00', '12:05:00', 2, 'SDF5654', NULL, 8, NULL, 'F'),
(170, '2022-09-28', '2022-09-28', '08:10:00', '10:30:00', 1, 'FGH4345', NULL, 8, 1, 'F'),
(171, '2022-09-26', '2022-09-26', '12:15:00', '15:45:00', 2, 'FGD4343', NULL, 8, 3, 'F'),
(172, '2022-09-27', '2022-09-27', '14:42:00', '16:00:00', NULL, 'DFG4345', NULL, 8, NULL, 'F'),
(175, '2022-09-27', '2022-09-27', '12:00:00', '13:00:00', NULL, 'FGG4565', NULL, 7, NULL, 'F'),
(176, '2022-09-30', '2022-09-30', '09:50:00', '10:00:00', 3, 'DFG4556', NULL, 8, 8, 'F'),
(177, '2022-09-27', '2022-09-27', '12:11:00', '15:00:00', 1, 'FGD5434', NULL, 7, 2, 'F'),
(178, '2022-09-30', '2022-09-30', '08:15:00', '11:30:00', 1, 'FGG5564', NULL, 8, 10, 'F'),
(179, '2022-09-30', '2022-09-30', '13:30:00', '16:00:00', 3, 'DFG6556', NULL, 8, 9, 'F'),
(180, '2022-09-29', NULL, '14:31:00', NULL, NULL, 'DFG4456', NULL, 8, NULL, 'E');
--
-- Extraindo dados da tabela `receber`
--

INSERT INTO `receber` (`ReceberId`, `FormaPagamentoId`, `CadastroId`, `FluxoVagaId`, `Valor`, `CarteiraId`, `ReservaId`, `Status`) VALUES
(1, 2, NULL, 1, '8.00', NULL, NULL, 'F'),
(2, 3, NULL, 2, '10.00', NULL, NULL, 'F'),
(3, 4, NULL, 3, '4.00', NULL, NULL, 'F'),
(4, 2, NULL, 4, '20.00', NULL, NULL, 'F'),
(5, 1, NULL, 5, '11.25', NULL, NULL, 'F'),
(6, 4, NULL, 8, '2.92', NULL, NULL, 'F'),
(7, 1, NULL, 9, '13.08', NULL, NULL, 'F'),
(8, 3, NULL, 10, '18.67', NULL, NULL, 'F'),
(9, 2, NULL, 11, '18.67', NULL, NULL, 'F'),
(10, 3, NULL, 12, '18.08', NULL, NULL, 'F'),
(11, 3, NULL, 13, '18.92', NULL, NULL, 'F'),
(12, 4, NULL, 14, '3.92', NULL, NULL, 'F'),
(13, 2, NULL, 15, '7.53', NULL, NULL, 'F'),
(14, 2, NULL, 6, '10.75', NULL, NULL, 'F'),
(15, 1, NULL, 7, '5.92', NULL, NULL, 'F'),
(16, 3, NULL, 16, '8.00', NULL, NULL, 'F'),
(17, 1, NULL, 17, '8.00', NULL, NULL, 'F'),
(18, 2, NULL, 18, '8.00', NULL, NULL, 'F'),
(19, 2, NULL, 19, '5.27', NULL, NULL, 'F'),
(20, 4, NULL, 20, '8.00', NULL, NULL, 'F'),
(21, 4, NULL, 21, '8.00', NULL, NULL, 'F'),
(22, 4, NULL, 22, '8.00', NULL, NULL, 'F'),
(23, 3, NULL, 23, '8.00', NULL, NULL, 'F'),
(24, 1, NULL, 24, '8.00', NULL, NULL, 'F'),
(25, 4, NULL, 25, '8.00', NULL, NULL, 'F'),
(26, 3, NULL, 26, '3.33', NULL, NULL, 'F'),
(27, 3, NULL, 27, '8.00', NULL, NULL, 'F'),
(28, 2, NULL, 28, '8.00', NULL, NULL, 'F'),
(29, 1, NULL, 29, '7.20', NULL, NULL, 'F'),
(30, 4, NULL, 30, '8.00', NULL, NULL, 'F'),
(31, 3, NULL, 31, '8.00', NULL, NULL, 'F'),
(32, 3, NULL, 32, '4.33', NULL, NULL, 'F'),
(33, 4, NULL, 33, '4.27', NULL, NULL, 'F'),
(34, 4, NULL, 34, '7.80', NULL, NULL, 'F'),
(35, 4, NULL, 35, '8.00', NULL, NULL, 'F'),
(36, 3, NULL, 36, '8.00', NULL, NULL, 'F'),
(37, 2, NULL, 37, '7.33', NULL, NULL, 'F'),
(38, 1, NULL, 38, '8.00', NULL, NULL, 'F'),
(39, 2, NULL, 39, '8.00', NULL, NULL, 'F'),
(40, 4, NULL, 40, '8.00', NULL, NULL, 'F'),
(41, 1, NULL, 41, '8.00', NULL, NULL, 'F'),
(42, 2, NULL, 42, '8.00', NULL, NULL, 'F'),
(43, 3, NULL, 43, '8.00', NULL, NULL, 'F'),
(44, 3, NULL, 44, '3.67', NULL, NULL, 'F'),
(45, 3, NULL, 45, '8.00', NULL, NULL, 'F'),
(46, 4, NULL, 46, '8.00', NULL, NULL, 'F'),
(47, 2, NULL, 47, '8.00', NULL, NULL, 'F'),
(48, 4, NULL, 48, '8.00', NULL, NULL, 'F'),
(49, 4, NULL, 49, '2.73', NULL, NULL, 'F'),
(50, 2, NULL, 50, '8.00', NULL, NULL, 'F'),
(51, 3, NULL, 51, '6.67', NULL, NULL, 'F'),
(52, 3, NULL, 52, '8.00', NULL, NULL, 'F'),
(53, 1, NULL, 53, '8.00', NULL, NULL, 'F'),
(54, 3, NULL, 54, '8.00', NULL, NULL, 'F'),
(55, 3, NULL, 55, '8.00', NULL, NULL, 'F'),
(56, 4, NULL, 56, '1.60', NULL, NULL, 'F'),
(57, 2, NULL, 57, '8.00', NULL, NULL, 'F'),
(58, 2, NULL, 58, '8.00', NULL, NULL, 'F'),
(59, 2, NULL, 59, '2.53', NULL, NULL, 'F'),
(60, 2, NULL, 60, '8.00', NULL, NULL, 'F'),
(61, 3, NULL, 61, '8.00', NULL, NULL, 'F'),
(62, 3, NULL, 62, '8.00', NULL, NULL, 'F'),
(63, 3, NULL, 63, '8.00', NULL, NULL, 'F'),
(64, 2, NULL, 64, '8.00', NULL, NULL, 'F'),
(65, 1, NULL, 65, '8.00', NULL, NULL, 'F'),
(66, 2, NULL, 66, '8.00', NULL, NULL, 'F'),
(67, 1, NULL, 67, '2.40', NULL, NULL, 'F'),
(68, 4, NULL, 68, '8.00', NULL, NULL, 'F'),
(69, 1, NULL, 69, '6.00', NULL, NULL, 'F'),
(70, 3, NULL, 70, '8.00', NULL, NULL, 'F'),
(71, 4, NULL, 71, '2.27', NULL, NULL, 'F'),
(72, 4, NULL, 72, '8.00', NULL, NULL, 'F'),
(73, 3, NULL, 73, '8.00', NULL, NULL, 'F'),
(74, 3, NULL, 74, '8.00', NULL, NULL, 'F'),
(75, 2, NULL, 75, '8.00', NULL, NULL, 'F'),
(76, 1, NULL, 76, '4.93', NULL, NULL, 'F'),
(77, 4, NULL, 77, '7.93', NULL, NULL, 'F'),
(78, 4, NULL, 78, '8.00', NULL, NULL, 'F'),
(79, 4, NULL, 79, '5.80', NULL, NULL, 'F'),
(80, 3, NULL, 80, '8.00', NULL, NULL, 'F'),
(81, 3, NULL, 81, '5.40', NULL, NULL, 'F'),
(82, 4, NULL, 82, '8.00', NULL, NULL, 'F'),
(83, 1, NULL, 83, '4.47', NULL, NULL, 'F'),
(84, 4, NULL, 84, '8.00', NULL, NULL, 'F'),
(85, 4, NULL, 85, '8.00', NULL, NULL, 'F'),
(86, 1, NULL, 86, '8.00', NULL, NULL, 'F'),
(87, 2, NULL, 87, '8.00', NULL, NULL, 'F'),
(88, 4, NULL, 88, '5.73', NULL, NULL, 'F'),
(89, 1, NULL, 89, '8.00', NULL, NULL, 'F'),
(90, 1, NULL, 90, '8.00', NULL, NULL, 'F'),
(91, 1, NULL, 91, '8.00', NULL, NULL, 'F'),
(92, 1, NULL, 92, '8.00', NULL, NULL, 'F'),
(93, 2, NULL, 93, '8.00', NULL, NULL, 'F'),
(94, 1, NULL, 94, '8.00', NULL, NULL, 'F'),
(95, 2, NULL, 95, '8.00', NULL, NULL, 'F'),
(96, 3, NULL, 96, '8.00', NULL, NULL, 'F'),
(97, 4, NULL, 97, '8.00', NULL, NULL, 'F'),
(98, 1, NULL, 98, '1.07', NULL, NULL, 'F'),
(99, 1, NULL, 99, '8.00', NULL, NULL, 'F'),
(100, 1, NULL, 100, '8.00', NULL, NULL, 'F'),
(101, 4, NULL, 101, '7.13', NULL, NULL, 'F'),
(102, 2, NULL, 102, '6.20', NULL, NULL, 'F'),
(103, 4, NULL, 103, '8.00', NULL, NULL, 'F'),
(104, 2, NULL, 104, '8.00', NULL, NULL, 'F'),
(105, 4, NULL, 105, '8.00', NULL, NULL, 'F'),
(106, 4, NULL, 106, '8.00', NULL, NULL, 'F'),
(107, 2, NULL, 107, '8.00', NULL, NULL, 'F'),
(108, 1, NULL, 108, '8.00', NULL, NULL, 'F'),
(109, 2, NULL, 109, '8.00', NULL, NULL, 'F'),
(110, 4, NULL, 110, '6.47', NULL, NULL, 'F'),
(111, 2, NULL, 111, '8.00', NULL, NULL, 'F'),
(112, 2, NULL, 112, '2.60', NULL, NULL, 'F'),
(113, 3, NULL, 113, '3.87', NULL, NULL, 'F'),
(114, 3, NULL, 114, '8.00', NULL, NULL, 'F'),
(115, 3, NULL, 115, '8.00', NULL, NULL, 'F'),
(116, 4, NULL, 116, '6.27', NULL, NULL, 'F'),
(117, 1, NULL, 117, '8.00', NULL, NULL, 'F'),
(118, 1, NULL, 118, '8.00', NULL, NULL, 'F'),
(119, 2, NULL, 119, '8.00', NULL, NULL, 'F'),
(120, 2, NULL, 120, '8.00', NULL, NULL, 'F'),
(121, 3, NULL, 121, '8.00', NULL, NULL, 'F'),
(122, 1, NULL, 122, '8.00', NULL, NULL, 'F'),
(123, 2, NULL, 123, '8.00', NULL, NULL, 'F'),
(124, 3, NULL, 124, '8.00', NULL, NULL, 'F'),
(125, 2, NULL, 125, '8.00', NULL, NULL, 'F'),
(126, 4, NULL, 126, '4.13', NULL, NULL, 'F'),
(127, 4, NULL, 127, '6.80', NULL, NULL, 'F'),
(128, 3, NULL, 128, '8.00', NULL, NULL, 'F'),
(129, 2, NULL, 129, '8.00', NULL, NULL, 'F'),
(130, 3, NULL, 130, '5.53', NULL, NULL, 'F'),
(131, 4, NULL, 131, '8.00', NULL, NULL, 'F'),
(132, 1, NULL, 132, '8.00', NULL, NULL, 'F'),
(133, 3, NULL, 133, '5.80', NULL, NULL, 'F'),
(134, 3, NULL, 134, '8.00', NULL, NULL, 'F'),
(135, 1, NULL, 135, '8.00', NULL, NULL, 'F'),
(136, 1, NULL, 136, '6.60', NULL, NULL, 'F'),
(137, 2, NULL, 137, '7.40', NULL, NULL, 'F'),
(138, 1, NULL, 138, '8.00', NULL, NULL, 'F'),
(139, 1, NULL, 139, '8.00', NULL, NULL, 'F'),
(140, 4, NULL, 140, '5.93', NULL, NULL, 'F'),
(141, 3, NULL, 141, '8.00', NULL, NULL, 'F'),
(142, 1, NULL, 142, '8.00', NULL, NULL, 'F'),
(143, 2, NULL, 143, '1.67', NULL, NULL, 'F'),
(144, 1, NULL, 144, '2.87', NULL, NULL, 'F'),
(145, 4, NULL, 145, '8.00', NULL, NULL, 'F'),
(146, 2, NULL, 146, '7.93', NULL, NULL, 'F'),
(147, 2, NULL, 147, '8.00', NULL, NULL, 'F'),
(148, 4, NULL, 148, '8.00', NULL, NULL, 'F'),
(149, 1, NULL, 149, '6.53', NULL, NULL, 'F'),
(150, 2, NULL, 150, '7.47', NULL, NULL, 'F'),
(151, 3, NULL, 151, '8.00', NULL, NULL, 'F'),
(152, 4, NULL, 152, '8.00', NULL, NULL, 'F'),
(153, 2, NULL, 153, '4.73', NULL, NULL, 'F'),
(154, 4, NULL, 154, '8.00', NULL, NULL, 'F'),
(155, 2, NULL, 155, '7.87', NULL, NULL, 'F'),
(156, 3, NULL, 156, '8.00', NULL, NULL, 'F'),
(157, 3, NULL, 157, '8.00', NULL, NULL, 'F'),
(158, 1, NULL, 158, '3.13', NULL, NULL, 'F'),
(159, 1, NULL, 159, '8.00', NULL, NULL, 'F'),
(160, 1, NULL, 160, '2.93', NULL, NULL, 'F'),
(161, 2, NULL, 161, '8.00', NULL, NULL, 'F'),
(162, 2, NULL, 162, '8.00', NULL, NULL, 'F'),
(163, 1, NULL, 163, '8.00', NULL, NULL, 'F'),
(164, 4, NULL, 164, '7.93', NULL, NULL, 'F'),
(165, 1, NULL, 165, '8.00', NULL, NULL, 'F'),
(166, 1, NULL, 167, '8.00', NULL, NULL, 'F'),
(167, 2, NULL, 166, '10.00', NULL, NULL, 'F'),
(168, 1, NULL, 170, '8.00', NULL, NULL, 'F'),
(169, 2, NULL, 171, '8.00', NULL, NULL, 'F'),
(170, 2, NULL, 172, '5.20', NULL, NULL, 'F'),
(171, 1, NULL, NULL, '8.00', NULL, 8, 'F'),
(172, 2, NULL, 175, '5.00', NULL, NULL, 'F'),
(173, 2, NULL, 177, '14.08', NULL, NULL, 'F'),
(174, 1, NULL, NULL, '8.00', NULL, 10, 'F'),
(175, 1, NULL, NULL, '8.00', NULL, 9, 'F'),
(176, 3, NULL, NULL, '8.00', NULL, 11, 'F');

COMMIT;
