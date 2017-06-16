-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 16-Jun-2017 às 08:47
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prodepa_sgl`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_ap`
--

CREATE TABLE `sgl_ap` (
  `cod_ap` int(10) UNSIGNED NOT NULL,
  `cod_area_atuacao` int(10) UNSIGNED NOT NULL,
  `nome_ap` varchar(50) NOT NULL,
  `banda_ap` varchar(20) NOT NULL,
  `color_code_ap` int(3) DEFAULT NULL,
  `ip_ap` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_ap`
--

INSERT INTO `sgl_ap` (`cod_ap`, `cod_area_atuacao`, `nome_ap`, `banda_ap`, `color_code_ap`, `ip_ap`) VALUES
(1, 2, 'AP-01', '15 Mbps', 11, '192.168.10.1'),
(2, 2, 'AP-02', '10 Mbps', 22, '192.168.10.2'),
(3, 2, 'AP-03', '13 Mbps', 33, '192.168.10.3'),
(4, 3, 'AP-01', '10 Mbps', 11, '192.168.11.1'),
(5, 3, 'AP-02', '10 Mbps', 22, '192.168.11.2'),
(6, 3, 'AP-02', '15 Mbps', 33, '192.168.11.3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_cidade_area_atuacao`
--

CREATE TABLE `sgl_cidade_area_atuacao` (
  `cod_area_atuacao` int(10) UNSIGNED NOT NULL,
  `cidade_area_atuacao` varchar(30) NOT NULL,
  `cod_nucleo` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_cidade_area_atuacao`
--

INSERT INTO `sgl_cidade_area_atuacao` (`cod_area_atuacao`, `cidade_area_atuacao`, `cod_nucleo`) VALUES
(2, 'Cidade A', 7),
(3, 'Cidade B', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_cidade_nucleo`
--

CREATE TABLE `sgl_cidade_nucleo` (
  `cod_nucleo` int(10) UNSIGNED NOT NULL,
  `cidade_nucleo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_cidade_nucleo`
--

INSERT INTO `sgl_cidade_nucleo` (`cod_nucleo`, `cidade_nucleo`) VALUES
(7, 'Itaituba');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_orgao`
--

CREATE TABLE `sgl_orgao` (
  `cod_orgao` int(10) UNSIGNED NOT NULL,
  `nome_orgao` varchar(200) NOT NULL,
  `categoria_orgao` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_orgao`
--

INSERT INTO `sgl_orgao` (`cod_orgao`, `nome_orgao`, `categoria_orgao`) VALUES
(1, 'Orgão A', 'Estadual'),
(2, 'Orgão B', 'Federal'),
(3, 'Orgão C ', 'Privado'),
(4, 'Orgão E', 'Terceiro Setor'),
(5, 'Orgão D', 'Municipal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_redemetro`
--

CREATE TABLE `sgl_redemetro` (
  `cod_redemetro` int(10) UNSIGNED NOT NULL,
  `nome_redemetro` varchar(45) DEFAULT NULL,
  `estensao_redemetro` varchar(45) DEFAULT NULL,
  `cod_area_atuacao` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_redemetro`
--

INSERT INTO `sgl_redemetro` (`cod_redemetro`, `nome_redemetro`, `estensao_redemetro`, `cod_area_atuacao`) VALUES
(1, 'REDE METRO 01', '15 Km', 2),
(2, 'REDE METRO 01', '30 Km', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_unidade`
--

CREATE TABLE `sgl_unidade` (
  `cod_unidade` int(10) UNSIGNED NOT NULL,
  `cod_orgao` int(10) UNSIGNED NOT NULL,
  `cod_cidade` int(10) UNSIGNED NOT NULL,
  `cod_ap` int(10) UNSIGNED DEFAULT NULL,
  `cod_redemetro` int(10) UNSIGNED DEFAULT NULL,
  `nome_unidade` varchar(255) NOT NULL,
  `ip_unidade` varchar(15) NOT NULL,
  `nome_vlan_unidade` varchar(50) NOT NULL,
  `tag_vlan_unidade` int(5) NOT NULL,
  `conexao_unidade` varchar(20) NOT NULL,
  `banda_unidade` varchar(20) NOT NULL,
  `statu_unidade` varchar(20) NOT NULL,
  `zabbix_unidade` varchar(20) NOT NULL,
  `url_zabbix_unidade` varchar(200) DEFAULT NULL,
  `data_ativacao_unidade` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_unidade`
--

INSERT INTO `sgl_unidade` (`cod_unidade`, `cod_orgao`, `cod_cidade`, `cod_ap`, `cod_redemetro`, `nome_unidade`, `ip_unidade`, `nome_vlan_unidade`, `tag_vlan_unidade`, `conexao_unidade`, `banda_unidade`, `statu_unidade`, `zabbix_unidade`, `url_zabbix_unidade`, `data_ativacao_unidade`) VALUES
(1, 1, 2, 1, NULL, 'Unidade A', '192.168.1.1.', 'unidade_a', 11, 'Rádio', '3 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/f13/f13_access_graph_app.php?hostid=11491', '2014-08-15'),
(2, 2, 2, NULL, 1, 'Unidade B', '192.168.1.2', 'unidade_b', 22, 'Fibra', '10 Mbps', 'Ativo', '', '', '2009-02-20'),
(3, 3, 2, 2, NULL, 'Unidade C', '192.168.1.3', 'unidade_3', 33, 'Rádio', '3 Mbps', 'Ativo', 'Não Cadastrado', '', '2012-03-10'),
(4, 4, 2, NULL, 1, 'Unidade E', '192.168.1.4', 'unidade_e', 44, 'Fibra', '4 Mbps', 'Ativo', 'Não Cadastrado', '', '2013-01-30'),
(5, 5, 2, 3, NULL, 'Unidade D', '192.168.1.5', 'unidade_d', 55, 'Rádio', '3 Mbps', 'Ativo', 'Não Cadastrado', '', '2011-08-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_unidade_contato`
--

CREATE TABLE `sgl_unidade_contato` (
  `cod_contato` int(10) UNSIGNED NOT NULL,
  `cod_unidade` int(10) UNSIGNED NOT NULL,
  `nome_contato` varchar(70) DEFAULT NULL,
  `email_contato` varchar(50) DEFAULT NULL,
  `telefone1_contato` varchar(20) DEFAULT NULL,
  `telefone2_contato` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_unidade_contato`
--

INSERT INTO `sgl_unidade_contato` (`cod_contato`, `cod_unidade`, `nome_contato`, `email_contato`, `telefone1_contato`, `telefone2_contato`) VALUES
(1, 2, 'Joab', 'joab@email.com', '(093) 3518-2222', '(093) 99244-1111'),
(3, 1, 'Joab Alencar', 'temp@email.com', '(093) 3518-2222', '(093) 92244-5554');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_unidade_contrato`
--

CREATE TABLE `sgl_unidade_contrato` (
  `cod_contrato` int(10) UNSIGNED NOT NULL,
  `cod_unidade` int(10) UNSIGNED NOT NULL,
  `numero_contrato` varchar(50) NOT NULL,
  `nome_contrato` varchar(150) NOT NULL,
  `data_inicial_contrato` date DEFAULT NULL,
  `data_vigencia_contrato` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_unidade_contrato`
--

INSERT INTO `sgl_unidade_contrato` (`cod_contrato`, `cod_unidade`, `numero_contrato`, `nome_contrato`, `data_inicial_contrato`, `data_vigencia_contrato`) VALUES
(1, 2, '0001/2009', 'ACTF - Acordo de Cooperação Técnico e Financeiro', '2009-01-20', '2019-01-20'),
(3, 1, '0002/2014', 'C - Contrato', '2014-08-15', '2020-08-15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_unidade_endereco`
--

CREATE TABLE `sgl_unidade_endereco` (
  `cod_endereco` int(10) UNSIGNED NOT NULL,
  `cod_unidade` int(10) UNSIGNED NOT NULL,
  `logradouro_endereco` varchar(50) DEFAULT NULL,
  `numero_endereco` varchar(10) DEFAULT NULL,
  `bairro_endereco` varchar(70) DEFAULT NULL,
  `complemento_endereco` varchar(255) DEFAULT NULL,
  `latitude_endereco` varchar(30) DEFAULT NULL,
  `longitude_endereco` varchar(30) DEFAULT NULL,
  `gps_endereco` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_unidade_endereco`
--

INSERT INTO `sgl_unidade_endereco` (`cod_endereco`, `cod_unidade`, `logradouro_endereco`, `numero_endereco`, `bairro_endereco`, `complemento_endereco`, `latitude_endereco`, `longitude_endereco`, `gps_endereco`) VALUES
(1, 1, 'Av Rotary', '1065', 'Bela Vista', '', '-18.74442696661774', '-44.43084496137692', ''),
(2, 2, 'Trav. Raimundo Preto', '1106', 'Centro', '', '-18.74114489283859', '-44.42954575771478', ''),
(3, 3, 'Av. Tapajos', '221', 'Centro', '', '-18.7532048', '-44.43067329999997', ''),
(4, 4, 'Av. Terezina', '33', 'Jacunda', '', '-18.754830274604085', '-44.43410652753903', ''),
(5, 5, 'Tv. Quinse de Agosto', 'S/N', 'Centro', '', '-18.7532048', '-44.43067329999997', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_unidade_historico`
--

CREATE TABLE `sgl_unidade_historico` (
  `cod_historico` int(10) UNSIGNED NOT NULL,
  `cod_unidade` int(10) UNSIGNED NOT NULL,
  `cod_usuario` int(10) UNSIGNED NOT NULL,
  `descricao_historico` text,
  `data_historico` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_unidade_historico`
--

INSERT INTO `sgl_unidade_historico` (`cod_historico`, `cod_unidade`, `cod_usuario`, `descricao_historico`, `data_historico`) VALUES
(1, 1, 2, 'Foi trocado o rádio.', '2017-06-14 13:28:59');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sgl_usuario`
--

CREATE TABLE `sgl_usuario` (
  `cod_usuario` int(10) UNSIGNED NOT NULL,
  `nome_usuario` varchar(15) NOT NULL,
  `sobrenome_usuario` varchar(100) DEFAULT NULL,
  `usuario_usuario` varchar(30) NOT NULL,
  `email_usuario` varchar(100) NOT NULL,
  `senha_usuario` varchar(32) NOT NULL,
  `cod_cidade_nucleo` int(10) UNSIGNED NOT NULL,
  `cargo_usuario` varchar(50) DEFAULT NULL,
  `sexo_usuario` varchar(1) DEFAULT 'M',
  `statu_admin_usuario` int(1) UNSIGNED DEFAULT NULL,
  `img_usuario` varchar(255) DEFAULT NULL,
  `statu_usuario` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sgl_usuario`
--

INSERT INTO `sgl_usuario` (`cod_usuario`, `nome_usuario`, `sobrenome_usuario`, `usuario_usuario`, `email_usuario`, `senha_usuario`, `cod_cidade_nucleo`, `cargo_usuario`, `sexo_usuario`, `statu_admin_usuario`, `img_usuario`, `statu_usuario`) VALUES
(2, 'Joab', 'Torres Alencar', 'joab.alencar', 'joab.alencar@prodepa.pa.gov.br', '47cafbff7d1c4463bbe7ba972a2b56e3', 7, 'Estagiário', 'M', 1, 'uploads/usuarios/6ddf3ee5a475c1604adea25f5dc1f100.jpg', 1),
(3, 'Daniel', 'Silva Ivens', 'daniel.silva', 'daniel.ivens@prodepa.pa.gov.br', '47cafbff7d1c4463bbe7ba972a2b56e3', 7, 'Estagiário', 'M', 0, 'uploads/usuarios/user_masculino.png', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sgl_ap`
--
ALTER TABLE `sgl_ap`
  ADD PRIMARY KEY (`cod_ap`),
  ADD UNIQUE KEY `cod_area_atuacao_UNIQUE` (`ip_ap`),
  ADD KEY `cod_area_atuacao` (`cod_area_atuacao`);

--
-- Indexes for table `sgl_cidade_area_atuacao`
--
ALTER TABLE `sgl_cidade_area_atuacao`
  ADD PRIMARY KEY (`cod_area_atuacao`),
  ADD UNIQUE KEY `cidade_area_atuacao_UNIQUE` (`cidade_area_atuacao`),
  ADD KEY `cod_nucleo` (`cod_nucleo`);

--
-- Indexes for table `sgl_cidade_nucleo`
--
ALTER TABLE `sgl_cidade_nucleo`
  ADD PRIMARY KEY (`cod_nucleo`),
  ADD UNIQUE KEY `nome_cidade_UNIQUE` (`cidade_nucleo`);

--
-- Indexes for table `sgl_orgao`
--
ALTER TABLE `sgl_orgao`
  ADD PRIMARY KEY (`cod_orgao`),
  ADD UNIQUE KEY `nome_orgao_UNIQUE` (`nome_orgao`);

--
-- Indexes for table `sgl_redemetro`
--
ALTER TABLE `sgl_redemetro`
  ADD PRIMARY KEY (`cod_redemetro`),
  ADD KEY `fk_sgl_redemetro_sgl_cidade_area_atuacao1_idx` (`cod_area_atuacao`);

--
-- Indexes for table `sgl_unidade`
--
ALTER TABLE `sgl_unidade`
  ADD PRIMARY KEY (`cod_unidade`),
  ADD UNIQUE KEY `ip_unidade_UNIQUE` (`ip_unidade`),
  ADD KEY `cod_cidade_idx` (`cod_cidade`),
  ADD KEY `cod_ap_idx` (`cod_ap`),
  ADD KEY `cod_orgao_idx` (`cod_orgao`),
  ADD KEY `fk_sgl_unidade_sgl_redemetro1_idx` (`cod_redemetro`);

--
-- Indexes for table `sgl_unidade_contato`
--
ALTER TABLE `sgl_unidade_contato`
  ADD PRIMARY KEY (`cod_contato`),
  ADD KEY `cod_unidade_idx` (`cod_unidade`);

--
-- Indexes for table `sgl_unidade_contrato`
--
ALTER TABLE `sgl_unidade_contrato`
  ADD PRIMARY KEY (`cod_contrato`),
  ADD KEY `fk_sgl_unidade_contrato_sgl_unidade1_idx` (`cod_unidade`);

--
-- Indexes for table `sgl_unidade_endereco`
--
ALTER TABLE `sgl_unidade_endereco`
  ADD PRIMARY KEY (`cod_endereco`),
  ADD KEY `cod_unidade` (`cod_unidade`);

--
-- Indexes for table `sgl_unidade_historico`
--
ALTER TABLE `sgl_unidade_historico`
  ADD PRIMARY KEY (`cod_historico`),
  ADD KEY `fk_sgl_unidade_historico_sgl_unidade1_idx` (`cod_unidade`),
  ADD KEY `fk_sgl_unidade_historico_sgl_usuario1_idx` (`cod_usuario`);

--
-- Indexes for table `sgl_usuario`
--
ALTER TABLE `sgl_usuario`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `email_usuario_UNIQUE` (`email_usuario`),
  ADD KEY `sgnr_cod_nucleo_idx` (`cod_cidade_nucleo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sgl_ap`
--
ALTER TABLE `sgl_ap`
  MODIFY `cod_ap` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sgl_cidade_area_atuacao`
--
ALTER TABLE `sgl_cidade_area_atuacao`
  MODIFY `cod_area_atuacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sgl_cidade_nucleo`
--
ALTER TABLE `sgl_cidade_nucleo`
  MODIFY `cod_nucleo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sgl_orgao`
--
ALTER TABLE `sgl_orgao`
  MODIFY `cod_orgao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sgl_redemetro`
--
ALTER TABLE `sgl_redemetro`
  MODIFY `cod_redemetro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sgl_unidade`
--
ALTER TABLE `sgl_unidade`
  MODIFY `cod_unidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sgl_unidade_contato`
--
ALTER TABLE `sgl_unidade_contato`
  MODIFY `cod_contato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sgl_unidade_contrato`
--
ALTER TABLE `sgl_unidade_contrato`
  MODIFY `cod_contrato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sgl_unidade_endereco`
--
ALTER TABLE `sgl_unidade_endereco`
  MODIFY `cod_endereco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sgl_unidade_historico`
--
ALTER TABLE `sgl_unidade_historico`
  MODIFY `cod_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sgl_usuario`
--
ALTER TABLE `sgl_usuario`
  MODIFY `cod_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `sgl_ap`
--
ALTER TABLE `sgl_ap`
  ADD CONSTRAINT `cod_area_atuacao` FOREIGN KEY (`cod_area_atuacao`) REFERENCES `sgl_cidade_area_atuacao` (`cod_area_atuacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_cidade_area_atuacao`
--
ALTER TABLE `sgl_cidade_area_atuacao`
  ADD CONSTRAINT `cod_nucleo` FOREIGN KEY (`cod_nucleo`) REFERENCES `sgl_cidade_nucleo` (`cod_nucleo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_redemetro`
--
ALTER TABLE `sgl_redemetro`
  ADD CONSTRAINT `fk_sgl_redemetro_sgl_cidade_area_atuacao1` FOREIGN KEY (`cod_area_atuacao`) REFERENCES `sgl_cidade_area_atuacao` (`cod_area_atuacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_unidade`
--
ALTER TABLE `sgl_unidade`
  ADD CONSTRAINT `cod_ap` FOREIGN KEY (`cod_ap`) REFERENCES `sgl_ap` (`cod_ap`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_cidade` FOREIGN KEY (`cod_cidade`) REFERENCES `sgl_cidade_area_atuacao` (`cod_area_atuacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cod_orgao` FOREIGN KEY (`cod_orgao`) REFERENCES `sgl_orgao` (`cod_orgao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sgl_unidade_sgl_redemetro1` FOREIGN KEY (`cod_redemetro`) REFERENCES `sgl_redemetro` (`cod_redemetro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_unidade_contato`
--
ALTER TABLE `sgl_unidade_contato`
  ADD CONSTRAINT `fk_unidade` FOREIGN KEY (`cod_unidade`) REFERENCES `sgl_unidade` (`cod_unidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_unidade_contrato`
--
ALTER TABLE `sgl_unidade_contrato`
  ADD CONSTRAINT `fk_sgl_unidade_contrato_sgl_unidade1` FOREIGN KEY (`cod_unidade`) REFERENCES `sgl_unidade` (`cod_unidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_unidade_endereco`
--
ALTER TABLE `sgl_unidade_endereco`
  ADD CONSTRAINT `cod_unidade` FOREIGN KEY (`cod_unidade`) REFERENCES `sgl_unidade` (`cod_unidade`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_unidade_historico`
--
ALTER TABLE `sgl_unidade_historico`
  ADD CONSTRAINT `fk_sgl_unidade_historico_sgl_unidade1` FOREIGN KEY (`cod_unidade`) REFERENCES `sgl_unidade` (`cod_unidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sgl_unidade_historico_sgl_usuario1` FOREIGN KEY (`cod_usuario`) REFERENCES `sgl_usuario` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `sgl_usuario`
--
ALTER TABLE `sgl_usuario`
  ADD CONSTRAINT `sgl_cod_nucleo` FOREIGN KEY (`cod_cidade_nucleo`) REFERENCES `sgl_cidade_nucleo` (`cod_nucleo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
