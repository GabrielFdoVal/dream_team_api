SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_paga_comum` (IN `codLiga` INT(11))   begin
	declare usu1 int(11);
	declare usu2 int(11);
	declare usu3 int(11);
    declare maxPonto decimal(9,2);
    declare base int default 0;
    
	if( (select qt_rodada from tb_liga_comum where cd_liga_comum = codLiga) = 0) then
		if( (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) <= 50 ) then
			set base = (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) * 3 + (select sum(qt_pontos) from ordem_comum where cd_liga_comum = codLiga) * 0.35;
		else 
			set base = (select qt_usuario from tb_liga_comum where cd_liga_comum = codLiga) * 2.5 + (select sum(qt_pontos) from ordem_comum where cd_liga_comum = codLiga) * 0.30;
		end if;
        begin
			set maxPonto = (select max(qt_pontos) from ordem_comum where cd_liga_comum = codLiga);
			set usu1 = (select cd_usuario from ordem_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_comum where cd_usuario = usu1;
			set maxPonto = (select max(qt_pontos) from ordem_comum where cd_liga_comum = codLiga);
			set usu2 = (select cd_usuario from ordem_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_comum where cd_usuario = usu2;
			set maxPonto = (select max(qt_pontos) from ordem_comum where cd_liga_comum = codLiga);
			set usu3 = (select cd_usuario from ordem_comum where cd_liga_comum = codLiga order by qt_pontos DESC LIMIT 1);
			delete from ordem_comum where cd_usuario = usu3;
			update tb_usuario set qt_leonitas = qt_leonitas + base  where cd_usuario = usu1;
			update tb_usuario set qt_leonitas = qt_leonitas + base*0.8  where cd_usuario = usu2;
			update tb_usuario set qt_leonitas = qt_leonitas + base*0.55  where cd_usuario = usu3;
			delete from ordem_comum where cd_liga_comum = codLiga;
			delete from tb_liga_comum where cd_liga_comum = codLiga;
        end;
	else 
		select 'Liga ainda não acabou';
     end if;   
end$$

DELIMITER ;

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

INSERT INTO `log_tb_jogador` (`cd_jogador`, `nm_jogador`, `nm_posicao`, `qt_ponto`, `qt_rebote`, `qt_toco`, `qt_bola_recuperada`, `qt_assistencia`, `qt_arremesso_errado`, `qt_turn_over`, `cd_imagem`, `qt_preco`, `cd_time`, `cd_rodada`, `cd_admin`, `dt_ajuste`) VALUES
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 1, 3, 4, '2022-11-01 00:00:00'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2, 3, 4, '2022-11-01 12:16:52'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2, NULL, 3, '2022-11-01 12:25:19'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2, NULL, 3, '2022-11-01 12:25:32'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2, NULL, 3, '2022-11-01 12:27:22'),
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2, NULL, 3, '2022-11-01 12:27:40');

CREATE TABLE `ordem_patrocinador_liga` (
  `cd_patrocinador` int(10) NOT NULL,
  `cd_liga_patrocinada` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `ordem_usuario_comum` (
  `cd_usuario` int(10) NOT NULL,
  `cd_liga_comum` int(10) NOT NULL,
  `qt_pontos` int(3) DEFAULT NULL,
  `ic_criador` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ordem_usuario_comum` (`cd_usuario`, `cd_liga_comum`, `qt_pontos`, `ic_criador`) VALUES
(1, 5, 0, 0),
(1, 5, 0, 1);

CREATE TABLE `tb_admin` (
  `cd_admin` int(10) NOT NULL,
  `nm_admin` varchar(100) DEFAULT NULL,
  `cd_email` varchar(100) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `nm_senha` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_compra_jogador` (
  `cd_compra` int(10) NOT NULL,
  `cd_usuario` int(10) DEFAULT NULL,
  `cd_jogador` int(10) DEFAULT NULL,
  `dt_compra` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_icone` (
  `cd_icone` int(10) NOT NULL,
  `vl_icone` double DEFAULT NULL,
  `cd_url` varchar(64) DEFAULT NULL,
  `nm_icone` varchar(45) DEFAULT NULL,
  `nm_raridade` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `tb_jogador` (`cd_jogador`, `nm_jogador`, `nm_posicao`, `qt_ponto`, `qt_rebote`, `qt_toco`, `qt_bola_recuperada`, `qt_assistencia`, `qt_arremesso_errado`, `qt_turn_over`, `cd_imagem`, `qt_preco`, `cd_time`) VALUES
(1, 'Yago', 'Armador', 27, 4, 3, 6, 10, 5, 3, 'https://lnb.com.br/wp-content/uploads/2016/10/YAGO-400x394.png', 24, 2),
(2, 'Felipe', 'Pivô', 6, 10, 6, 4, 1, 5, 1, 'https://lnb.com.br/wp-content/uploads/2018/08/Felipe-Nascimento-1-400x400.png', 12, 2),
(3, 'Da Silva', 'Ala', 20, 8, 2, 3, 6, 7, 3, 'https://lnb.com.br/wp-content/uploads/2020/10/TULIO-400x394.png', 23, 1),
(4, 'Márcio', 'Ala', 19, 6, 3, 1, 2, 4, 2, 'https://lnb.com.br/wp-content/uploads/2018/08/Marcio-2-400x400.png', 16, 2),
(5, 'Batista', 'Pivô', 12, 9, 5, 1, 0, 3, 0, 'https://lnb.com.br/wp-content/uploads/2016/10/BATISTA-400x394.png', 15, 1),
(6, 'Du Klafke', 'Armador', 15, 4, 2, 5, 3, 3, 2, 'https://lnb.com.br/wp-content/uploads/2020/10/Du-Klafke-1-400x400.png', 15, 2),
(7, 'Olivinha', 'Pivô', 6, 10, 5, 2, 0, 0, 1, 'https://lnb.com.br/wp-content/uploads/2016/10/OLIVINHA-1-400x381.png', 14, 1),
(8, 'Scala', 'Armador', 14, 2, 3, 6, 7, 0, 1, 'https://lnb.com.br/wp-content/uploads/2021/07/Santiago-Scala-400x400.png', 18, 2),
(9, 'Renato', 'Ala', 15, 4, 3, 2, 2, 0, 3, 'https://lnb.com.br/wp-content/uploads/2021/07/Renato.png', 14, 1),
(10, 'Lucas Dias', 'Ala', 2, 12, 4, 1, 0, 3, 0, 'https://lnb.com.br/wp-content/uploads/2016/10/lucas-dias-1-400x394.png', 16, 2),
(11, 'Teste', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1),
(12, 'Teste', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1),
(13, 'Teste', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1),
(14, 'Teste', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1),
(15, 'Teste', 'Ala', 10, 10, 10, 10, 10, 10, 10, 'https://cdn.w600.comps.canstockphoto.com.br/soldado-3d-ping%C3%BCim-banco-de-ilustra%C3%A7%C3%A3o_csp19614160.jpg', 10, 1);

CREATE TABLE `tb_liga_comum` (
  `cd_liga_comum` int(10) NOT NULL,
  `nm_liga_comum` varchar(100) DEFAULT NULL,
  `qt_rodada` int(3) DEFAULT NULL,
  `qt_usuario` int(3) DEFAULT NULL,
  `ic_privada` tinyint(1) NOT NULL,
  `cd_privada` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_liga_comum` (`cd_liga_comum`, `nm_liga_comum`, `qt_rodada`, `qt_usuario`, `ic_privada`, `cd_privada`) VALUES
(1, 'liguinha', 5, 20, 1, ''),
(2, 'liguinha', 5, 20, 1, ''),
(3, 'liguinha', 5, 20, 1, ''),
(4, 'liguinha', 5, 20, 1, ''),
(5, 'liguinha', 5, 20, 1, ''),
(6, 'liguinha', 5, 20, 1, ''),
(7, 'liguinha', 5, 20, 1, ''),
(8, 'liguinha', 5, 20, 1, ''),
(9, 'liguinha', 5, 20, 1, ''),
(10, 'liguinha', 5, 20, 1, ''),
(11, 'liguinha', 5, 20, 1, ''),
(12, 'liguinha', 5, 20, 1, '43495904'),
(13, 'liguinha', 5, 20, 1, '90382225'),
(14, 'liguinha', 5, 20, 1, '77359577'),
(15, 'liguinha', 5, 20, 1, '71172773'),
(16, 'liguinha', 5, 20, 1, '18546572'),
(17, 'liguinha', 5, 20, 1, '73782249');

CREATE TABLE `tb_liga_patrocinada` (
  `cd_liga_patrocinada` int(10) NOT NULL,
  `nm_liga_patrocinada` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_liga_patrocinada` (`cd_liga_patrocinada`, `nm_liga_patrocinada`) VALUES
(1, 'Liga Caixa'),
(2, 'Liga Nike'),
(3, 'Liga Adidas'),
(4, 'Liga Gatorade'),
(5, 'Liga Growth');

CREATE TABLE `tb_ordem_compra_icone` (
  `cd_compra` int(10) NOT NULL,
  `cd_usuario` int(10) NOT NULL,
  `cd_icone` int(10) NOT NULL,
  `cd_origem` varchar(45) DEFAULT NULL,
  `dt_compra` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `tb_patrocinador` (
  `cd_patrocinador` int(10) NOT NULL,
  `nm_oficial` varchar(100) DEFAULT NULL,
  `nm_nickname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_rodada` (
  `cd_rodada` int(10) NOT NULL,
  `dt_inicio` date DEFAULT NULL,
  `dt_fim` date DEFAULT NULL,
  `qt_rodada` int(3) DEFAULT NULL,
  `hr_inicio` time DEFAULT NULL,
  `hr_fim` time DEFAULT NULL,
  `cd_turno` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_temporada` (
  `cd_temporada` int(10) NOT NULL,
  `nm_temporada` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `tb_time` (
  `cd_time` int(10) NOT NULL,
  `nm_time` varchar(80) DEFAULT NULL,
  `cd_logo` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_time` (`cd_time`, `nm_time`, `cd_logo`) VALUES
(1, 'Flamengo', 'https://w7.pngwing.com/pngs/440/236/png-transparent-flamengo-hd-logo.png'),
(2, 'SESI Franca', 'https://upload.wikimedia.org/wikipedia/en/7/75/Franca_basquete_logo.png');

CREATE TABLE `tb_turno` (
  `cd_turno` int(10) NOT NULL,
  `cd_temporada` int(10) NOT NULL,
  `qt_turno` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

INSERT INTO `tb_usuario` (`cd_usuario`, `nm_usuario`, `cd_email`, `dt_nascimento`, `qt_leonita`, `qt_ametista`, `nm_senha`, `nm_apelido`, `qt_pontos`, `cd_tatica`, `cd_liga_patrocinada`) VALUES
(1, 'gabriel', 'gabriel@gmail.com', '2002-03-28', 1000, 0, '1234', 'teste', 150, 0, 1),
(2, 'gabriel', 'gabriel1@gmail.com', '2022-09-04', 550, 0, 'doVal13$$$', 'dovalzet', 200, 0, 3),
(3, 'lucas', 'lucas@gmail.com', '2022-09-05', 0, 0, 'Lucas123$', 'luquinha', 250, 0, 3),
(4, 'Matheus', 'matheus@email.com', '2022-09-13', 12, 0, 'matheus###1', 'matheusi', 150, 0, 3),
(5, 'Juca', 'juca@email.com', '2022-09-25', 45, 0, 'juquinha@1', 'jucazin', 251, 0, 3),
(6, 'Gabriel', 'lucas1@gmail.com', '2022-09-22', 0, 0, 'Lucas123%', 'luquinha', 0, 0, 3),
(7, 'Gabriel', 'gabriel2@gmail.com', '2002-03-28', 2000, 0, 'Gabriel1$', 'gabrielz', 0, 0, 3),
(8, 'gabriel', 'gabriel3@gmail.com', '2002-01-31', 2000, 0, 'Gabriel1@', 'Gabriel1', 0, 0, 3),
(9, 'Gabriel', 'gabriel11111@gmai', '2002-04-16', 2000, 0, 'Gabriel1@', 'dovalzet', 0, 3, 3);


ALTER TABLE `ordem_patrocinador_liga`
  ADD KEY `fk_ordem_patrocinador` (`cd_patrocinador`),
  ADD KEY `fk_ordem_liga` (`cd_liga_patrocinada`);

ALTER TABLE `ordem_usuario_comum`
  ADD KEY `fk_ordem_comum` (`cd_liga_comum`),
  ADD KEY `fk_ordem_usuario` (`cd_usuario`);

ALTER TABLE `tb_compra_jogador`
  ADD PRIMARY KEY (`cd_compra`),
  ADD KEY `fk_compra_usuario` (`cd_usuario`),
  ADD KEY `fk_compra_jogador` (`cd_jogador`);

ALTER TABLE `tb_icone`
  ADD PRIMARY KEY (`cd_icone`);

ALTER TABLE `tb_jogador`
  ADD PRIMARY KEY (`cd_jogador`),
  ADD KEY `fk_jogador_time` (`cd_time`);

ALTER TABLE `tb_liga_comum`
  ADD PRIMARY KEY (`cd_liga_comum`);

ALTER TABLE `tb_liga_patrocinada`
  ADD PRIMARY KEY (`cd_liga_patrocinada`);

ALTER TABLE `tb_ordem_compra_icone`
  ADD PRIMARY KEY (`cd_compra`),
  ADD KEY `fk_compra_icone` (`cd_usuario`);

ALTER TABLE `tb_partida`
  ADD PRIMARY KEY (`cd_partida`),
  ADD KEY `fk_partida_rodada` (`cd_rodada`),
  ADD KEY `fk_partida_visitante` (`cd_time_visitante`),
  ADD KEY `fk_partida_casa` (`cd_time_casa`);

ALTER TABLE `tb_patrocinador`
  ADD PRIMARY KEY (`cd_patrocinador`);

ALTER TABLE `tb_rodada`
  ADD PRIMARY KEY (`cd_rodada`),
  ADD KEY `fk_rodada_turno` (`cd_turno`);

ALTER TABLE `tb_temporada`
  ADD PRIMARY KEY (`cd_temporada`);

ALTER TABLE `tb_time`
  ADD PRIMARY KEY (`cd_time`);

ALTER TABLE `tb_turno`
  ADD PRIMARY KEY (`cd_turno`),
  ADD KEY `fk_turno_temporada` (`cd_temporada`);

ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`cd_usuario`),
  ADD KEY `fk_usuario_liga` (`cd_liga_patrocinada`);


ALTER TABLE `ordem_patrocinador_liga`
  ADD CONSTRAINT `fk_ordem_liga` FOREIGN KEY (`cd_liga_patrocinada`) REFERENCES `tb_liga_patrocinada` (`cd_liga_patrocinada`),
  ADD CONSTRAINT `fk_ordem_patrocinador` FOREIGN KEY (`cd_patrocinador`) REFERENCES `tb_patrocinador` (`cd_patrocinador`);

ALTER TABLE `ordem_usuario_comum`
  ADD CONSTRAINT `fk_ordem_comum` FOREIGN KEY (`cd_liga_comum`) REFERENCES `tb_liga_comum` (`cd_liga_comum`),
  ADD CONSTRAINT `fk_ordem_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

ALTER TABLE `tb_compra_jogador`
  ADD CONSTRAINT `fk_compra_jogador` FOREIGN KEY (`cd_jogador`) REFERENCES `tb_jogador` (`cd_jogador`),
  ADD CONSTRAINT `fk_compra_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

ALTER TABLE `tb_jogador`
  ADD CONSTRAINT `fk_jogador_time` FOREIGN KEY (`cd_time`) REFERENCES `tb_time` (`cd_time`);

ALTER TABLE `tb_ordem_compra_icone`
  ADD CONSTRAINT `fk_compra_icone` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`),
  ADD CONSTRAINT `fk_icone_usuario` FOREIGN KEY (`cd_usuario`) REFERENCES `tb_usuario` (`cd_usuario`);

ALTER TABLE `tb_partida`
  ADD CONSTRAINT `fk_partida_casa` FOREIGN KEY (`cd_time_casa`) REFERENCES `tb_time` (`cd_time`),
  ADD CONSTRAINT `fk_partida_rodada` FOREIGN KEY (`cd_rodada`) REFERENCES `tb_rodada` (`cd_rodada`),
  ADD CONSTRAINT `fk_partida_visitante` FOREIGN KEY (`cd_time_visitante`) REFERENCES `tb_time` (`cd_time`);

ALTER TABLE `tb_rodada`
  ADD CONSTRAINT `fk_rodada_turno` FOREIGN KEY (`cd_turno`) REFERENCES `tb_turno` (`cd_turno`);

ALTER TABLE `tb_turno`
  ADD CONSTRAINT `fk_turno_temporada` FOREIGN KEY (`cd_temporada`) REFERENCES `tb_temporada` (`cd_temporada`);

ALTER TABLE `tb_usuario`
  ADD CONSTRAINT `fk_usuario_liga` FOREIGN KEY (`cd_liga_patrocinada`) REFERENCES `tb_liga_patrocinada` (`cd_liga_patrocinada`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
