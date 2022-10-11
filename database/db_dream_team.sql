-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Out-2022 às 22:27
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_patrocinador_liga`
--

CREATE TABLE `ordem_patrocinador_liga` (
  `cd_patrocinador` int(10) NOT NULL,
  `cd_liga_patrocinada` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_usuario_comum`
--

CREATE TABLE `ordem_usuario_comum` (
  `cd_usuario` int(10) NOT NULL,
  `cd_liga_comum` int(10) NOT NULL,
  `qt_pontos` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Extraindo dados da tabela `tb_compra_jogador`
--

INSERT INTO `tb_compra_jogador` (`cd_compra`, `cd_usuario`, `cd_jogador`, `dt_compra`) VALUES
(2, 2, 9, '2022-10-07 22:08:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_icone`
--

CREATE TABLE `tb_icone` (
  `cd_icone` int(10) NOT NULL,
  `vl_icone` double DEFAULT NULL,
  `cd_url` varchar(64) DEFAULT NULL,
  `nm_icone` varchar(45) DEFAULT NULL,
  `nm_raridade` varchar(45) DEFAULT NULL
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
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1),
(2, 'Felipe', 'Pivô', 6, 10, 6, 4, 1, 5, 1, 'https://lnb.com.br/wp-content/uploads/2018/08/Felipe-Nascimento-1-400x400.png', 12, 2),
(3, 'Da Silva', 'Ala', 20, 8, 2, 3, 6, 7, 3, 'https://lnb.com.br/wp-content/uploads/2020/10/TULIO-400x394.png', 23, 1),
(4, 'Márcio', 'Ala', 19, 6, 3, 1, 2, 4, 2, 'https://lnb.com.br/wp-content/uploads/2018/08/Marcio-2-400x400.png', 16, 2),
(5, 'Batista', 'Pivô', 12, 9, 5, 1, 0, 3, 0, 'https://lnb.com.br/wp-content/uploads/2016/10/BATISTA-400x394.png', 15, 1),
(6, 'Du Klafke', 'Armador', 15, 4, 2, 5, 3, 3, 2, 'https://lnb.com.br/wp-content/uploads/2020/10/Du-Klafke-1-400x400.png', 15, 2),
(7, 'Olivinha', 'Pivô', 6, 10, 5, 2, 0, 0, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/OLIVINHA-1-400x381.png', 14, 1),
(8, 'Scala', 'Armador', 14, 2, 3, 6, 7, 0, 1, 'https://lnb.com.br/wp-content/uploads/2021/07/Santiago-Scala-400x400.png', 18, 2),
(9, 'Renato', 'Ala', 15, 4, 3, 2, 2, 0, 3, 'https://lnb.com.br/wp-content/uploads/2021/07/Renato.png', 14, 1),
(10, 'Lucas Dias', 'Ala', 2, 12, 4, 1, 0, 3, 0, 'https://lnb.com.br/wp-content/uploads/2016/10/lucas-dias-1-400x394.png', 16, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_liga_comum`
--

CREATE TABLE `tb_liga_comum` (
  `cd_liga_comum` int(10) NOT NULL,
  `nm_liga_comum` varchar(100) DEFAULT NULL,
  `qt_rodada` int(3) DEFAULT NULL,
  `qt_usuario` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Liga Caixa'),
(2, 'Liga Nike'),
(3, 'Liga Adidas'),
(4, 'Liga Gatorade'),
(5, 'Liga Growth');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_ordem_compra_icone`
--

CREATE TABLE `tb_ordem_compra_icone` (
  `cd_compra` int(10) NOT NULL,
  `cd_usuario` int(10) NOT NULL,
  `cd_icone` int(10) NOT NULL,
  `cd_origem` varchar(45) DEFAULT NULL,
  `dt_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_patrocinador`
--

CREATE TABLE `tb_patrocinador` (
  `cd_patrocinador` int(10) NOT NULL,
  `nm_oficial` varchar(100) DEFAULT NULL,
  `nm_nickname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'gabriel', 'gabriel@gmail.com', '2002-03-28', 1000, 0, '1234', 'teste', 150, 0, 3),
(2, 'gabriel', 'gabriel1@gmail.com', '2022-09-04', 536, 0, 'doVal13$$$', 'dovalzet', 200, 0, 3),
(3, 'lucas', 'lucas@gmail.com', '2022-09-05', 0, 0, 'Lucas123$', 'luquinha', 250, 0, 3),
(4, 'Matheus', 'matheus@email.com', '2022-09-13', 12, 0, 'matheus###1', 'matheusi', 150, 0, 3),
(5, 'Juca', 'juca@email.com', '2022-09-25', 45, 0, 'juquinha@1', 'jucazin', 251, 0, 3),
(6, 'Gabriel', 'lucas1@gmail.com', '2022-09-22', 0, 0, 'Lucas123%', 'luquinha', 0, 0, 3),
(7, 'Gabriel', 'gabriel2@gmail.com', '2002-03-28', 2000, 0, 'Gabriel1$', 'gabrielz', 0, 0, 3),
(8, 'gabriel', 'gabriel3@gmail.com', '2002-01-31', 2000, 0, 'Gabriel1@', 'Gabriel1', 0, 0, 3),
(9, 'Gabriel', 'gabriel11111@gmai', '2002-04-16', 2000, 0, 'Gabriel1@', 'dovalzet', 0, 3, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ordem_patrocinador_liga`
--
ALTER TABLE `ordem_patrocinador_liga`
  ADD KEY `fk_ordem_patrocinador` (`cd_patrocinador`),
  ADD KEY `fk_ordem_liga` (`cd_liga_patrocinada`);

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
-- Índices para tabela `tb_icone`
--
ALTER TABLE `tb_icone`
  ADD PRIMARY KEY (`cd_icone`);

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
-- Índices para tabela `tb_ordem_compra_icone`
--
ALTER TABLE `tb_ordem_compra_icone`
  ADD PRIMARY KEY (`cd_compra`),
  ADD KEY `fk_compra_icone` (`cd_usuario`);

--
-- Índices para tabela `tb_partida`
--
ALTER TABLE `tb_partida`
  ADD PRIMARY KEY (`cd_partida`),
  ADD KEY `fk_partida_rodada` (`cd_rodada`),
  ADD KEY `fk_partida_visitante` (`cd_time_visitante`),
  ADD KEY `fk_partida_casa` (`cd_time_casa`);

--
-- Índices para tabela `tb_patrocinador`
--
ALTER TABLE `tb_patrocinador`
  ADD PRIMARY KEY (`cd_patrocinador`);

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
-- Limitadores para a tabela `ordem_patrocinador_liga`
--
ALTER TABLE `ordem_patrocinador_liga`
  ADD CONSTRAINT `fk_ordem_liga` FOREIGN KEY (`cd_liga_patrocinada`) REFERENCES `tb_liga_patrocinada` (`cd_liga_patrocinada`),
  ADD CONSTRAINT `fk_ordem_patrocinador` FOREIGN KEY (`cd_patrocinador`) REFERENCES `tb_patrocinador` (`cd_patrocinador`);

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
-- Limitadores para a tabela `tb_ordem_compra_icone`
--
ALTER TABLE `tb_ordem_compra_icone`
  ADD CONSTRAINT `fk_compra_icone` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`),
  ADD CONSTRAINT `fk_icone_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

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

--
-- Limitadores para a tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `fk_usuario_liga` FOREIGN KEY (`cd_liga_patrocinada`) REFERENCES `tb_liga_patrocinada` (`cd_liga_patrocinada`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
