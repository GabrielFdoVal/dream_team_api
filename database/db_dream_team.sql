-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2022 às 01:14
-- Versão do servidor: 10.4.25-MariaDB
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_dream_team`
--

DELIMITER $$
--
-- Procedimentos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paga_comum` (IN `codLiga` INT(11))   begin
	declare usu1 int(11);
	declare usu2 int(11);
	declare usu3 int(11);
    declare maxPonto decimal(9,2);
    declare base int default 0;

	if( (select qt_rodada from tb_liga_comum where cd_liga_comum = codLiga) = 0) then
		if( (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) <= 50 ) then
			set base = (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) * 3 + (select sum(qt_pontos) from ordem_usuario_comum where cd_liga_comum = codLiga) * 0.35;
		else 
			set base = (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) * 2.5 + (select sum(qt_pontos) from ordem_usuario_comum where cd_liga_comum = codLiga) * 0.30;
		end if;
        begin
			set maxPonto = (select max(qt_pontos) from ordem_usuario_comum where cd_liga_comum = codLiga);
			set usu1 = (select cd_usuario from ordem_usuario_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_usuario_comum where cd_usuario = usu1;
			set maxPonto = (select max(qt_pontos) from ordem_usuario_comum where cd_liga_comum = codLiga);
			set usu2 = (select cd_usuario from ordem_usuario_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_usuario_comum where cd_usuario = usu2;
			set maxPonto = (select max(qt_pontos) from ordem_usuario_comum where cd_liga_comum = codLiga);
			set usu3 = (select cd_usuario from ordem_usuario_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_usuario_comum where cd_usuario = usu3;
			update tb_usuario set qt_leonita = qt_leonita + base  where cd_usuario = usu1;
			update tb_usuario set qt_leonita = qt_leonita + base*0.8  where cd_usuario = usu2;
			update tb_usuario set qt_leonita = qt_leonita + base*0.55  where cd_usuario = usu3;
			delete from ordem_usuario_comum where cd_liga_comum = codLiga;
			delete from tb_liga_comum where cd_liga_comum = codLiga;
        end;
	else 
		select 'Liga ainda não acabou';
     end if;   
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_rodada`
--

CREATE TABLE `log_rodada` (
  `cd_rodada` int(10) DEFAULT NULL,
  `cd_admin` int(10) NOT NULL,
  `dt_ajuste` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `log_rodada`
--

INSERT INTO `log_rodada` (`cd_rodada`, `cd_admin`, `dt_ajuste`) VALUES
(1, 1, '2022-11-28 20:26:35');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_tb_jogador`
--

CREATE TABLE `log_tb_jogador` (
  `cd_jogador` int(10) NOT NULL,
  `nm_jogador` varchar(80) NOT NULL,
  `nm_posicao` varchar(20) NOT NULL,
  `qt_ponto` int(3) NOT NULL,
  `qt_rebote` int(3) NOT NULL,
  `qt_toco` int(3) NOT NULL,
  `qt_bola_recuperada` int(3) NOT NULL,
  `qt_assistencia` int(3) NOT NULL,
  `qt_arremesso_errado` int(3) NOT NULL,
  `qt_turn_over` int(3) NOT NULL,
  `cd_imagem` varchar(120) NOT NULL,
  `qt_preco` double NOT NULL,
  `cd_time` int(10) NOT NULL,
  `cd_rodada` int(10) DEFAULT NULL,
  `cd_admin` int(10) NOT NULL,
  `dt_ajuste` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `log_tb_jogador`
--

INSERT INTO `log_tb_jogador` (`cd_jogador`, `nm_jogador`, `nm_posicao`, `qt_ponto`, `qt_rebote`, `qt_toco`, `qt_bola_recuperada`, `qt_assistencia`, `qt_arremesso_errado`, `qt_turn_over`, `cd_imagem`, `qt_preco`, `cd_time`, `cd_rodada`, `cd_admin`, `dt_ajuste`) VALUES
(1, 'Teste1', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1, 1, 1, '2022-11-28 20:26:22'),
(2, 'Teste2', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 2, 1, 1, '2022-11-28 20:26:25'),
(3, 'Teste3', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 2, 1, 1, '2022-11-28 20:26:27'),
(4, 'Teste4', 'Armador', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 2, 1, 1, '2022-11-28 20:26:30'),
(5, 'Teste5', 'Pivo', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 2, 1, 1, '2022-11-28 20:26:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_usuario_comum`
--

CREATE TABLE `ordem_usuario_comum` (
  `cd_usuario` int(10) NOT NULL,
  `cd_liga_comum` int(10) NOT NULL,
  `qt_pontos` int(3) DEFAULT NULL,
  `ic_criador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `ordem_usuario_comum`
--

INSERT INTO `ordem_usuario_comum` (`cd_usuario`, `cd_liga_comum`, `qt_pontos`, `ic_criador`) VALUES
(3, 2, 150, 1),
(2, 1, 100, 1),
(4, 3, 500, 1),
(2, 2, 100, 0),
(4, 1, 300, 0),
(5, 3, 48, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin`
--

CREATE TABLE `tb_admin` (
  `cd_admin` int(10) NOT NULL,
  `nm_admin` varchar(100) DEFAULT NULL,
  `cd_email` varchar(100) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `nm_senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_admin`
--

INSERT INTO `tb_admin` (`cd_admin`, `nm_admin`, `cd_email`, `dt_nascimento`, `nm_senha`) VALUES
(1, 'Alison de Oliveira', 'admin@gmail.com', '2001-09-18', 'Abc12345!');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_compra_jogador`
--

CREATE TABLE `tb_compra_jogador` (
  `cd_compra` int(10) NOT NULL,
  `cd_usuario` int(10) DEFAULT NULL,
  `cd_jogador` int(10) DEFAULT NULL,
  `dt_compra` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_jogador`
--

CREATE TABLE `tb_jogador` (
  `cd_jogador` int(10) NOT NULL,
  `nm_jogador` varchar(80) DEFAULT NULL,
  `nm_posicao` varchar(20) DEFAULT NULL,
  `qt_ponto` int(3) DEFAULT NULL,
  `qt_rebote` int(3) DEFAULT NULL,
  `qt_toco` int(3) DEFAULT NULL,
  `qt_bola_recuperada` int(3) DEFAULT NULL,
  `qt_assistencia` int(3) DEFAULT NULL,
  `qt_arremesso_errado` int(3) DEFAULT NULL,
  `qt_turn_over` int(3) DEFAULT NULL,
  `cd_imagem` varchar(120) DEFAULT NULL,
  `qt_preco` double DEFAULT NULL,
  `cd_time` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_jogador`
--

INSERT INTO `tb_jogador` (`cd_jogador`, `nm_jogador`, `nm_posicao`, `qt_ponto`, `qt_rebote`, `qt_toco`, `qt_bola_recuperada`, `qt_assistencia`, `qt_arremesso_errado`, `qt_turn_over`, `cd_imagem`, `qt_preco`, `cd_time`) VALUES
(1, 'Deodato', 'Ala', 11, 2, 1, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/Gui-Deodato.png', 100, 1),
(2, 'R. Rachel', 'Ala', 15, 2, 1, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2017/10/Rachel.png', 100, 1),
(3, 'Renato', 'Armador', 8, 2, 8, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2021/07/Renato.png', 100, 1),
(4, 'Mineiro', 'Armador', 8, 5, 8, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/RAFA-MINEIRO-400x386.png', 100, 1),
(5, 'Olivinha', 'Pivo', 4, 10, 0, 2, 1, 1, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/OLIVINHA-1-400x381.png', 100, 1),
(6, 'Reynan', 'Ala', 11, 2, 1, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2020/10/Reynan-1-400x400.png', 100, 2),
(7, 'David Jackson', 'Ala', 15, 2, 1, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/David-Jackson_-400x400.png', 100, 2),
(8, 'Du Klafke', 'Armador', 8, 2, 8, 1, 2, 3, 1, 'https://lnb.com.br/wp-content/uploads/2020/10/Du-Klafke-1-400x400.png', 100, 2),
(9, 'Márcio', 'Pivo', 4, 10, 0, 2, 1, 1, 1, 'https://lnb.com.br/wp-content/uploads/2018/08/Marcio-2-400x400.png', 100, 2),
(10, 'Lucas Mariano', 'Pivo', 4, 10, 0, 2, 1, 1, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/Lucas-Mariano-1-400x400.png', 100, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_liga_comum`
--

CREATE TABLE `tb_liga_comum` (
  `cd_liga_comum` int(10) NOT NULL,
  `nm_liga_comum` varchar(100) DEFAULT NULL,
  `qt_rodada` int(3) DEFAULT NULL,
  `qt_usuario` int(3) DEFAULT NULL,
  `ic_privada` tinyint(1) NOT NULL,
  `cd_privada` varchar(8) NOT NULL,
  `vl_entrar` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_liga_comum`
--

INSERT INTO `tb_liga_comum` (`cd_liga_comum`, `nm_liga_comum`, `qt_rodada`, `qt_usuario`, `ic_privada`, `cd_privada`, `vl_entrar`) VALUES
(1, 'Amigos Fatec', 5, 18, 0, '12345678', 100),
(2, 'ADS 6º', 5, 6, 1, '15630945', 300),
(3, 'Rua 23', 12, 20, 0, '87654321', 500);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_liga_patrocinada`
--

CREATE TABLE `tb_liga_patrocinada` (
  `cd_liga_patrocinada` int(10) NOT NULL,
  `nm_liga_patrocinada` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_liga_patrocinada`
--

INSERT INTO `tb_liga_patrocinada` (`cd_liga_patrocinada`, `nm_liga_patrocinada`) VALUES
(1, 'Liga Adidas'),
(2, 'Liga Caixa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_partida`
--

CREATE TABLE `tb_partida` (
  `cd_partida` int(10) NOT NULL,
  `dt_partida` date DEFAULT NULL,
  `hr_partida` time DEFAULT NULL,
  `qt_ponto_casa` int(3) DEFAULT NULL,
  `qt_ponto_visitante` int(3) DEFAULT NULL,
  `cd_time_casa` int(10) DEFAULT NULL,
  `cd_time_visitante` int(10) DEFAULT NULL,
  `cd_rodada` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_partida`
--

INSERT INTO `tb_partida` (`cd_partida`, `dt_partida`, `hr_partida`, `qt_ponto_casa`, `qt_ponto_visitante`, `cd_time_casa`, `cd_time_visitante`, `cd_rodada`) VALUES
(1, '2022-11-20', '17:43:46', 0, 0, 1, 2, 1),
(2, '2022-11-29', '18:30:04', 0, 0, 1, 2, 2),
(4, '2022-12-01', '18:30:04', 0, 0, 1, 2, 4),
(5, '2022-12-03', '18:30:04', 0, 0, 1, 2, 5),
(6, '2022-12-05', '18:30:04', 0, 0, 1, 2, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_rodada`
--

CREATE TABLE `tb_rodada` (
  `cd_rodada` int(10) NOT NULL,
  `dt_inicio` date DEFAULT NULL,
  `dt_fim` date DEFAULT NULL,
  `qt_rodada` int(3) DEFAULT NULL,
  `hr_inicio` time DEFAULT NULL,
  `hr_fim` time DEFAULT NULL,
  `cd_turno` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_rodada`
--

INSERT INTO `tb_rodada` (`cd_rodada`, `dt_inicio`, `dt_fim`, `qt_rodada`, `hr_inicio`, `hr_fim`, `cd_turno`) VALUES
(1, '2022-11-20', '2022-11-28', 1, '18:30:04', '23:30:04', NULL),
(2, '2022-11-29', '2022-11-30', 2, '18:25:24', '18:25:24', NULL),
(4, '2022-12-01', '2022-12-02', 4, '18:25:24', '18:25:24', NULL),
(5, '2022-12-03', '2022-12-04', 5, '18:25:24', '18:25:24', NULL),
(6, '2022-12-05', '2022-12-06', 6, '18:25:24', '18:25:24', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_temporada`
--

CREATE TABLE `tb_temporada` (
  `cd_temporada` int(10) NOT NULL,
  `nm_temporada` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_time`
--

CREATE TABLE `tb_time` (
  `cd_time` int(10) NOT NULL,
  `nm_time` varchar(80) DEFAULT NULL,
  `cd_logo` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_time`
--

INSERT INTO `tb_time` (`cd_time`, `nm_time`, `cd_logo`) VALUES
(1, 'Flamengo', 'https://w7.pngwing.com/pngs/440/236/png-transparent-flamengo-hd-logo.png'),
(2, 'SESI Franca', 'https://upload.wikimedia.org/wikipedia/en/7/75/Franca_basquete_logo.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_turno`
--

CREATE TABLE `tb_turno` (
  `cd_turno` int(10) NOT NULL,
  `cd_temporada` int(10) NOT NULL,
  `qt_turno` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `cd_usuario` int(10) NOT NULL,
  `nm_usuario` varchar(100) DEFAULT NULL,
  `cd_email` varchar(100) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `qt_leonita` int(9) DEFAULT NULL,
  `qt_ametista` int(9) DEFAULT NULL,
  `nm_senha` varchar(30) DEFAULT NULL,
  `nm_apelido` varchar(8) DEFAULT NULL,
  `qt_pontos` int(9) DEFAULT NULL,
  `cd_tatica` tinyint(1) DEFAULT NULL,
  `cd_liga_patrocinada` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `cd_email`, `dt_nascimento`, `qt_leonita`, `qt_ametista`, `nm_senha`, `nm_apelido`, `qt_pontos`, `cd_tatica`, `cd_liga_patrocinada`) VALUES
(2, 'Jorge', 'jorge@email.com', '2001-09-18', 1000, 0, 'Jorge123!', 'jorgin', 150, 0, 1),
(3, 'Gabriel', 'gabriel@gmail.com', '1993-11-24', 3050, 0, 'Gabriel1$$$', 'dovalz', 150, 0, 1),
(4, 'Maria', 'maria@gmail.com', '1992-11-18', 1500, 0, 'Maria123!', 'mariazin', 200, 0, 2),
(5, 'Lucas', 'lucas@gmail.com', '1997-09-25', 45, 0, 'Lucas123!', 'lucazin', 20, 0, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ordem_usuario_comum`
--
ALTER TABLE `ordem_usuario_comum`
  ADD KEY `fk_ordem_comum` (`cd_liga_comum`),
  ADD KEY `fk_ordem_usuario` (`cd_usuario`);

--
-- Índices para tabela `tb_compra_jogador`
--
ALTER TABLE `tb_compra_jogador`
  ADD PRIMARY KEY (`cd_compra`),
  ADD KEY `fk_compra_usuario` (`cd_usuario`),
  ADD KEY `fk_compra_jogador` (`cd_jogador`);

--
-- Índices para tabela `tb_jogador`
--
ALTER TABLE `tb_jogador`
  ADD PRIMARY KEY (`cd_jogador`),
  ADD KEY `fk_jogador_time` (`cd_time`);

--
-- Índices para tabela `tb_liga_comum`
--
ALTER TABLE `tb_liga_comum`
  ADD PRIMARY KEY (`cd_liga_comum`);

--
-- Índices para tabela `tb_liga_patrocinada`
--
ALTER TABLE `tb_liga_patrocinada`
  ADD PRIMARY KEY (`cd_liga_patrocinada`);

--
-- Índices para tabela `tb_partida`
--
ALTER TABLE `tb_partida`
  ADD PRIMARY KEY (`cd_partida`),
  ADD KEY `fk_partida_rodada` (`cd_rodada`),
  ADD KEY `fk_partida_visitante` (`cd_time_visitante`),
  ADD KEY `fk_partida_casa` (`cd_time_casa`);

--
-- Índices para tabela `tb_rodada`
--
ALTER TABLE `tb_rodada`
  ADD PRIMARY KEY (`cd_rodada`),
  ADD KEY `fk_rodada_turno` (`cd_turno`);

--
-- Índices para tabela `tb_temporada`
--
ALTER TABLE `tb_temporada`
  ADD PRIMARY KEY (`cd_temporada`);

--
-- Índices para tabela `tb_time`
--
ALTER TABLE `tb_time`
  ADD PRIMARY KEY (`cd_time`);

--
-- Índices para tabela `tb_turno`
--
ALTER TABLE `tb_turno`
  ADD PRIMARY KEY (`cd_turno`),
  ADD KEY `fk_turno_temporada` (`cd_temporada`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`cd_usuario`),
  ADD KEY `fk_usuario_liga` (`cd_liga_patrocinada`);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ordem_usuario_comum`
--
ALTER TABLE `ordem_usuario_comum`
  ADD CONSTRAINT `fk_ordem_comum` FOREIGN KEY (`cd_liga_comum`) REFERENCES `tb_liga_comum` (`cd_liga_comum`),
  ADD CONSTRAINT `fk_ordem_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

--
-- Limitadores para a tabela `tb_compra_jogador`
--
ALTER TABLE `tb_compra_jogador`
  ADD CONSTRAINT `fk_compra_jogador` FOREIGN KEY (`cd_jogador`) REFERENCES `tb_jogador` (`cd_jogador`),
  ADD CONSTRAINT `fk_compra_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

--
-- Limitadores para a tabela `tb_jogador`
--
ALTER TABLE `tb_jogador`
  ADD CONSTRAINT `fk_jogador_time` FOREIGN KEY (`cd_time`) REFERENCES `tb_time` (`cd_time`);

--
-- Limitadores para a tabela `tb_partida`
--
ALTER TABLE `tb_partida`
  ADD CONSTRAINT `fk_partida_casa` FOREIGN KEY (`cd_time_casa`) REFERENCES `tb_time` (`cd_time`),
  ADD CONSTRAINT `fk_partida_rodada` FOREIGN KEY (`cd_rodada`) REFERENCES `tb_rodada` (`cd_rodada`),
  ADD CONSTRAINT `fk_partida_visitante` FOREIGN KEY (`cd_time_visitante`) REFERENCES `tb_time` (`cd_time`);

--
-- Limitadores para a tabela `tb_rodada`
--
ALTER TABLE `tb_rodada`
  ADD CONSTRAINT `fk_rodada_turno` FOREIGN KEY (`cd_turno`) REFERENCES `tb_turno` (`cd_turno`);

--
-- Limitadores para a tabela `tb_turno`
--
ALTER TABLE `tb_turno`
  ADD CONSTRAINT `fk_turno_temporada` FOREIGN KEY (`cd_temporada`) REFERENCES `tb_temporada` (`cd_temporada`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
