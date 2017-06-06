-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 03-Jun-2017 às 19:49
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
(1, 2, 'AP01', '10 Mbps', 11, '10.101.10.14'),
(2, 2, 'AP02', '10 Mbps', 22, '10.101.10.15'),
(3, 2, 'AP03', '10 Mbps', 33, '10.101.10.16'),
(4, 2, 'AP04', '10 Mbps', 44, '10.101.10.17'),
(5, 2, 'AP05', '10 Mbps', 55, '10.101.10.18'),
(6, 2, 'AP06', '10 Mbps', 66, '10.101.10.19'),
(7, 2, 'AP07', '10 Mbps', 77, '10.101.10.20'),
(8, 6, 'AP01', '10 Mbps', 11, '10.101.45.14'),
(9, 6, 'AP02', '10 Mbps', 22, '10.101.45.15'),
(10, 6, 'AP03', '10 Mbps', 33, '10.101.45.16'),
(11, 6, 'AP04', '10 Mbps', 44, '10.101.45.17'),
(12, 6, 'AP05', '10 Mbps', 55, '10.101.45.18'),
(13, 6, 'AP06', '10 Mbps', 66, '10.101.45.19'),
(14, 6, 'AP07', '10 Mbps', 77, '10.101.45.21');

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
(1, 'Altamira', 1),
(2, 'Itaituba', 2),
(3, 'Santarém', 3),
(4, 'Marabá', 4),
(5, 'Paragominas', 5),
(6, 'Rurópolis', 2),
(7, 'Temp21', 3);

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
(1, 'Altamira'),
(6, 'Belém'),
(2, 'Itaituba'),
(4, 'Marabá'),
(5, 'Paragominas'),
(3, 'Santarém');

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
(1, 'TJE - Tribunal do Estado do Pará', 'Estadual'),
(2, 'SEFA - Secretaria de Estado da Fazenda do Pará', 'Estadual'),
(3, 'TRE - Tribunal Regional Eleitoral', 'Estadual'),
(4, 'MINPUB - Ministerio Publico do Estado do Pará', 'Estadual'),
(5, 'ADEPARÁ - Agência de Defesa Agropecuária do Estado do Pará', 'Federal'),
(6, 'BOMBEIROS - Corpo de Bombeiros Militar do Pará', 'Estadual'),
(7, 'DETRAN - Departamento de Transito do Estado do Pará', 'Estadual'),
(8, 'EMATER - Empresa de Assistencia Tecnica e Extenção Rural do Estado do Pará', 'Estadual'),
(9, 'PM - Policia Militar do Pará', 'Estadual'),
(10, 'SEDAP - Secretaria de Estado de Desenvolvimento Agropecuario e de Pesca', 'Estadual'),
(11, 'SEDUC - Secretaria de Estado de Educação', 'Estadual'),
(12, 'CPC - Centro de Pericias Cientificas Renato Chaves', 'Estadual'),
(13, 'IASEP - Instituto de Assistencia dos Servidores do Estado do Pará', 'Estadual'),
(14, 'PC - Policia Civil', 'Estadual'),
(15, 'SEASTER - Secretaria de Estado de Assistencia Social , Trabalho , Emprego e Renda', 'Estadual'),
(16, 'SUSIPE - Superintendencia do Sistema Penitenciario do Estado do Pará', 'Estadual'),
(17, 'Clinica Betel - Obras Sociais', 'Terceiro Setor'),
(18, 'SEBRAE - Serviço Brasileiro de Apoio às Micro e Pequenas Empresas', 'Federal'),
(19, 'IFPA - Instituto Federal de Educação, Ciência e Tecnologia', 'Federal'),
(20, 'PMI - Prefeitura Municipal de Itaituba', 'Municipal'),
(21, 'SECTEC - Secretaria de Estado de Ciência, Tecnologia e Educação Tecnológica', 'Estadual'),
(22, 'PRODEPA - Processamento de Dados do Estado do Pará', 'Estadual'),
(23, 'PMR - Prefeitura Municipal de Rurópolis', 'Municipal'),
(24, 'CREDCIDADAO - Núcleo de Gerenciamento do Programa de Microcrédito', 'Estadual'),
(25, 'CMI - Câmara Municipal de Itaituba', 'Municipal'),
(26, 'CMR - Câmara Municipal de Rurópolis', 'Municipal');

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
(1, 'REDE METRO 01', '10,5 Km', 2),
(2, 'REDE METRO 01', '10,3 Km', 6);

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
(1, 20, 2, 6, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Antônio Gonzaga Barros - Telecentro Rosirene Lopes', '10.111.4.1', '', 21, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-20'),
(2, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. A Mão Cooperadora I (R/C)', '10.120.67.1', 'ita_ecoop', 22, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-25'),
(3, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Engenheiro Fernando Guilhon - Telecentro Josué Gonçalves', '10.120.68.1', 'ita_eguilhon', 23, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2014-05-28'),
(4, 20, 2, 2, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Presidente Castelo Branco - Telecentro Idalina Campelo', '10.120.69.1', 'ita_ecastelo', 24, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-20'),
(5, 14, 2, 5, NULL, '19ª Seccional Urbana de Polícia Civil', '10.11.24.1', 'ita_pcivil', 25, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-21'),
(6, 21, 2, 1, NULL, 'INFOCENTRO - Sindicato dos Trabalhadores e Trabalhadoras Rurais de Itaituba', '10.112.78.1', 'ita_srurais', 26, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-22'),
(7, 11, 2, 3, NULL, 'E.E.E.M Benedito Correa de Souza', '10.120.70.1', 'ita_ebenedito', 27, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-23'),
(8, 11, 2, 5, NULL, 'E.E.E.M. Professora Maria das Graças Escócio Cerqueira', '10.120.71.1', 'ita_eescocio', 28, 'Radio', '3 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-24'),
(9, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Barão do Rio Branco', '10.120.110.1', 'ita_ebarao', 29, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-25'),
(10, 20, 2, 5, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Coronel Fontoura', '10.120.73.1', 'ita_efontoura', 30, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-26'),
(11, 20, 2, 5, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Rotaryano Djalma Serique', '10.120.74.1', 'ita_edjalma', 31, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-27'),
(12, 20, 2, 4, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Dom Pedro I', '10.120.75.1', 'ita_edompedro', 32, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-28'),
(13, 20, 2, 2, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Dr. Everaldo Martins', '10.120.76.1', 'ita_eeveraldo', 33, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-29'),
(14, 21, 2, 1, NULL, 'INFOCENTRO - Profª. Jayne Eyre Migliath / E.M.E.I.E.F São Francisco das Chagas', '10.112.37.1', 'ita_echagas', 34, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-30'),
(15, 21, 2, 3, NULL, 'INFOCENTRO - Escola Joaquim Caetano Correa (E.M.)', '10.112.36.1', 'ita_ejoaquim', 35, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-03-31'),
(16, 20, 2, 6, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Padre José de Anchieta', '10.120.78.1', 'ita_eanchieta', 36, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-01'),
(17, 20, 2, 3, NULL, 'SEMSA - Secretaria Municipal de Saúde / Sede', '10.123.25.1', 'ita_secsaude', 37, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-02'),
(18, 20, 2, 3, NULL, 'SEMSA - Secretaria Municipal de Saúde / Hospital Municipal', '10.126.96.1', 'ita_hmunicipal', 38, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-03'),
(20, 20, 2, 2, NULL, 'Museu Aracy Paraguaçu', '10.126.87.1', 'ita_museu', 40, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-05'),
(21, 11, 2, 5, NULL, 'E.E.E.M. Maria do Socorro Jacob', '10.130.43.1', 'ita_ejacob', 42, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-06'),
(22, 6, 2, 6, NULL, '7º Grupamento', '10.55.11.1', 'ita_bombeiros', 43, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-07'),
(23, 24, 2, 6, NULL, 'Unidade Local', '10.6.3.1', 'ita_bcidadao', 44, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-08'),
(24, 20, 2, 2, NULL, 'SEMMAP - Secretaria Municipal de Meio Ambiente e Produção', '10.123.26.2', 'ita_ambiente', 41, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-09'),
(25, 20, 2, 5, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Brigadeiro Coimbra Haroldo Veloso - Telecentro Allan Freitas', '10.120.80.1', 'ita_ebrigadeiro', 45, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-10'),
(26, 20, 2, 3, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Coronel Raimundo Pereira Brasil - Telecentro Pereira Brasil', '10.120.81.1', 'ita_erbrasil', 46, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-11'),
(28, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Maria da Consolação de Mendonça Cerqueira - Telecentro Maria da Consolação', '10.120.82.1', 'ita_econsola', 48, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-12'),
(29, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Magalhães Barata', '10.120.83.1', 'ita_emagalhaes', 49, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-13'),
(30, 20, 2, 2, NULL, 'SEMDAS - Secretaria Municipal de Assistência Social', '10.126.123.1', 'ita_semdas', 50, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-14'),
(31, 13, 2, 2, NULL, 'Unidade Local', '10.83.6.1', 'ita_ipasep', 51, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-15'),
(32, 20, 2, 1, NULL, 'SEMED - Sec. Mun. de Educação / E.M. São Tomé', '10.120.84.1', 'ita_estome', 52, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-16'),
(33, 11, 2, 5, NULL, 'EETEPA - Escola Estadual Tecnológica do Pará', '10.126.90.1', 'ita_etpp', 53, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-17'),
(34, 20, 2, 5, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Maria de Nazaré Freire (Centro Municipal de Educação Infantil)', '10.120.85.1', 'ita_enazare', 54, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-18'),
(35, 20, 2, 5, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Prof. Maria do Socorro Bentes Leite', '10.120.86.1', 'ita_ebentes', 55, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-19'),
(36, 20, 2, 3, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Prof. Helena Cirino', '10.120.87.1', 'ita_ecirino', 56, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-20'),
(37, 17, 2, 6, NULL, 'Sede', '10.126.91.1', 'ita_obras', 57, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-21'),
(38, 20, 2, 5, NULL, 'SEMINFRA - Secretaria Municipal de InfraEstrutura', '10.123.27.1', 'ita_seminfra', 58, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-22'),
(39, 20, 2, 2, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Presidente Castelo Branco - Pólo Universitário UAB/UEPA - Antiga Alice Carneiro', '10.120.88.1', 'ita_ealice', 59, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-23'),
(40, 20, 2, 2, NULL, 'Coordenadoria Municipal de Trânsito (COMTRI)', '10.123.33.1', 'ita_comtri', 61, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-24'),
(41, 20, 2, 2, NULL, 'Biblioteca Municipal', '10.126.92.1', 'ita_biblioteca', 62, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-25'),
(42, 20, 2, 2, NULL, 'PREFEITURA / Sede', '10.60.13.1', 'ita_prefeitura', 63, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-26'),
(43, 5, 2, 2, NULL, '10ª Ciretran', '10.13.12.1', 'ita_detran', 64, 'Rádio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-27'),
(44, 5, 2, 3, NULL, '12ª URE', '10.130.55.1', 'ita_seduc', 65, 'Rádio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-28'),
(45, 2, 2, 2, NULL, 'Posto', '10.2.68.1', 'ita_sefa', 66, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-29'),
(46, 1, 2, 2, NULL, 'Fórum Desembargador Walter Bezerra Falcão', '10.87.24.1', 'ita_forum', 67, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-30'),
(47, 4, 2, 3, NULL, 'Unidade Local', '10.16.8.1', 'ita_mp', 68, 'Radio', '4 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-01'),
(48, 25, 2, 2, NULL, 'Sede', '10.71.4.1', 'ita_camara', 69, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-02'),
(49, 11, 2, 1, NULL, 'E.E.E.M. E.R.C. Centro Educacional Anchieta', '10.130.54.1', 'ita_seducerc', 70, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-03'),
(50, 21, 2, 2, NULL, 'INFOCENTRO - Colônia de Pescadores Z-56', '10.112.35.1', 'ita_pescadores', 71, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-04'),
(51, 20, 2, 3, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Duque de Caxias', '10.120.109.1', 'ita_eduque', 72, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-05'),
(52, 11, 2, 1, NULL, 'E.E.E.M. E.R.C. Maranata', '10.130.53.1', 'ita_emaranata', 73, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-06'),
(53, 11, 2, 3, NULL, 'E.E.E.M. E.R.C. Isaac Newton', '10.130.52.1', 'ita_isaac', 74, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-07'),
(54, 20, 2, 2, NULL, 'SEMED - Secretaria Municipal de Educação / Sede', '10.123.32.1', 'ita_sedu', 75, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-08'),
(55, 14, 2, 5, NULL, 'DEAM - Delegacia Especializada de Atendimento à Mulher', '10.11.2.1', 'ita_deam', 76, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-09'),
(56, 5, 2, 6, NULL, 'Gerência Regional', '10.8.10.1', 'ita_adepara', 77, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-10'),
(57, 15, 2, 1, NULL, 'SINE - Sistema Nacional de Emprego', '10.105.10.1', 'ita_sine', 78, 'Radio', '2 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-11'),
(58, 21, 2, 2, NULL, 'INFOCENTRO - Asgrufocita - Associação dos Grupos Folclóricos Culturais de Itaituba', '10.112.71.1', 'ita_ponto', 79, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-12'),
(59, 9, 2, NULL, 1, '15° Batalhão de Policia Militar', '10.61.27.1', 'ita_15bpm', 80, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-13'),
(60, 22, 2, 2, NULL, 'SM HOTZONE ORLA', '10.132.2.1', 'ita_hotzorla', 81, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-14'),
(61, 22, 2, 2, NULL, 'HOTZONE ORLA', '10.132.2.2', 'ita_hotzorla', 81, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-15'),
(62, 22, 2, 5, NULL, 'SM HOTZONE AEROPORTO', '10.132.1.1', 'ita_hotzaero', 82, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-16'),
(63, 22, 2, 5, NULL, 'HOTZONE AEROPORTO', '10.132.1.2', 'ita_hotzaero', 82, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-17'),
(64, 1, 2, 3, NULL, 'Escritório Regional', '10.50.5.1', 'ita_sagri', 83, 'Rádio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-18'),
(65, 21, 2, 1, NULL, 'INFOCENTRO - Apae', '10.112.90.1', 'ita_apae', 84, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-19'),
(66, 21, 2, 3, NULL, 'INFOCENTRO - Rotary Club de Itaituba', '10.112.134.1', 'ita_rotary', 85, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-20'),
(67, 21, 2, 6, NULL, 'INFOCENTRO - A Mão Cooperadora - Obras Sociais, Educ. Igreja de Deus do Brasil', '10.112.92.1', 'ita_mao', 86, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-21'),
(68, 21, 2, 1, NULL, 'INFOCENTRO - Associação Indígena Pahyhyp Munduruku do Núcleo Tapajós', '10.112.93.1', 'ita_phayhy', 87, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-22'),
(69, 18, 2, 1, NULL, 'Unidade Local', '10.126.134.1', 'ita_sebrae', 88, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-23'),
(70, 21, 2, 6, NULL, 'INFOCENTRO - Associação dos Mineradores de Ouro do Tapajós', '10.126.94.1', 'ita_mineradores', 89, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-24'),
(71, 21, 2, 1, NULL, 'INFOCENTRO - Associação dos Filhos de Itaituba (ASFITA)', '10.112.170.1', 'ita_filhos', 90, 'Radio', '2 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-25'),
(72, 21, 2, 1, NULL, 'INFOCENTRO - Sindicato dos Trabalhadores em Saúde do Pará', '10.112.171.1', 'ita_sindsaude', 91, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-26'),
(73, 21, 2, 5, NULL, 'INFOCENTRO - Escola Tecnológica do Pará', '10.112.172.1', 'ita_etepa', 92, 'Radio', '2 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-27'),
(74, 19, 2, 6, NULL, 'Campus Itaituba', '10.101.10.60', 'ita_ifpa', 1465, 'Radio', '4 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-28'),
(75, 12, 2, 5, NULL, 'Núcleo Avançado de Itaituba', '10.25.13.1', 'ita_cpc', 93, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-29'),
(76, 3, 2, 7, NULL, '34ª Zona Eleitoral', '10.128.32.1', 'ita_tre34', 94, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-30'),
(77, 16, 2, 7, NULL, 'Centro de Recuperação Regional de Itaituba - CRRI', '10.84.40.1', 'ita_susipe', 95, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-31'),
(78, 23, 6, 11, NULL, 'SEMSA - Sec. Mun. de Saúde / Hospital Municipal de Rurópolis', '10.120.98.1', 'rur_hospital', 21, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11489', '2009-06-01'),
(79, 23, 6, 12, NULL, 'Creche Municipal', '10.126.107.1', 'rur_creche', 22, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11490', '2009-06-02'),
(80, 23, 6, 9, NULL, 'SEMSA - Sec. Mun. de Saúde / Unidade de Saúde Família Alvorada', '10.126.114.1', 'rur_usfa', 23, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11491', '2009-06-03'),
(81, 21, 6, 8, NULL, 'Infocentro Bela Vista', '10.112.66.1', 'rur_infobela', 24, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11492', '2009-06-04'),
(82, 23, 6, 10, NULL, 'SEMED - Sec. Mun. de Educação / E.M.E.F. Vila Nova', '10.120.100.1', 'rur_evila', 25, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11493', '2009-06-05'),
(83, 23, 6, 10, NULL, 'SEMED - Sec. Mun. de Educação / SEDE', '10.123.29.1', 'rur_sedu', 26, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11494', '2009-06-06'),
(84, 23, 6, 10, NULL, 'SEMED - Sec. Mun. de Educação / E.M.E.F. Elcione Barbalho', '10.120.101.1', 'rur_elcione', 27, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11495', '2009-06-07'),
(85, 23, 6, 11, NULL, 'Biblioteca Municipal', '10.126.108.1', 'rur_biblioteca', 28, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11496', '2009-06-08'),
(86, 23, 6, 10, NULL, 'SEMED - Sec. Mun. de Educação / E.M.E.I.F. Mundo da Criança', '10.120.102.1', 'rur_ecrianca', 29, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11497', '2009-06-09'),
(87, 8, 6, 11, NULL, 'Escritório Regional', '10.54.13.1', 'rur_emater', 30, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11498', '2009-06-10'),
(88, 23, 6, 10, NULL, 'SEMED - Sec. Mun. de Educação / E.M. Padre José de Anchieta 1', '10.120.103.1', 'rur_eanchieta1', 31, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11499', '2009-06-11'),
(89, 23, 6, 11, NULL, 'SEMED - Sec. Mun. de Educação / Escola Municipal Prof. Alderi Campiol', '10.120.104.1', 'rur_ealderi', 32, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11500', '2009-06-12'),
(90, 14, 6, 14, NULL, 'Delegacia', '10.11.49.1', 'rur_pcivil', 33, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11501', '2009-06-13'),
(91, 23, 6, 10, NULL, 'SEMTRAS - Sec. Mun. de Trabalho e Assistência Social / SEDE', '10.123.30.1', 'rur_smtas', 34, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11502', '2009-06-14'),
(92, 23, 6, 10, NULL, 'PETI - Programa de Erradicação do Trabalho Infantil', '10.126.109.1', 'rur_peti', 35, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11503', '2009-06-15'),
(93, 3, 6, 10, NULL, 'Centro de Projetos Sociais e Culturais', '10.126.115.1', 'rur_cpsc', 36, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11504', '2009-06-16'),
(94, 23, 6, 10, NULL, 'SEMSA - Sec. Mun. de Saúde / Centro de Atenção Básica e Epidemiologia Genuíno', '10.126.116.1', 'rur_epidemi', 37, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11505', '2009-06-17'),
(95, 23, 6, 10, NULL, 'Instituto de Previdência do Município', '10.126.110.1', 'rur_previd', 38, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11506', '2009-06-18'),
(96, 23, 6, 10, NULL, 'SEMSA - Secretaria Municipal de Saúde / SEDE', '10.123.31.1', 'rur_sms', 39, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11507', '2009-06-19'),
(97, 11, 6, 14, NULL, 'E.E. Eurico Vale', '10.130.47.1', 'rur_eeurico', 40, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11508', '2009-06-20'),
(98, 5, 6, 11, NULL, 'Regional', '10.8.3.1', 'rur_adepara', 41, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11509', '2009-06-21'),
(99, 2, 6, 11, NULL, 'Posto', '10.2.69.1', 'rur_sefa', 42, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11510', '2009-06-22'),
(100, 21, 6, 12, NULL, 'Infocentro Almir Gabriel', '10.112.180.1', 'rur_ealmir', 43, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11511', '2009-06-23'),
(101, 23, 6, 11, NULL, 'Controle de Endemias', '10.126.111.1', 'rur_endemias', 44, 'Radio', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11512', '2009-06-24'),
(102, 23, 6, 11, NULL, 'Garagem Municipal', '10.126.112.1', 'rur_garagem', 45, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11513', '2009-06-25'),
(103, 23, 6, 10, NULL, 'Sede de Governo', '10.60.15.1', 'rur_prefeitura', 46, 'Radio', '5 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11514', '2009-06-26'),
(104, 9, 6, 9, NULL, '17ª CIPM - Companhia Independente da PM', '10.61.15.1', 'rur_qgpm', 47, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11515', '2009-06-27'),
(105, 1, 6, 10, NULL, 'Fórum Juiz Insalescio Franco Carneiro', '10.87.74.1', 'rur_forum', 48, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11516', '2009-06-28'),
(106, 4, 6, 10, NULL, 'Sede', '10.16.9.1', 'rur_mp', 49, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11517', '2009-06-29'),
(107, 26, 6, 10, NULL, 'Sede', '10.71.3.1', 'rur_camara', 50, 'Radio', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11518', '2009-06-30'),
(108, 22, 6, 11, NULL, 'HOTZONE Praça Cívica', '10.132.3.1', 'rur_hotzone', 51, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11520', '2009-07-02'),
(109, 3, 6, 10, NULL, '68ª Zona Eleitoral', '10.128.40.1', 'rur_tre', 52, 'Radio', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11524', '2009-07-06'),
(110, 2, 2, NULL, 1, 'Posto', '10.2.68.12', 'ita_sefa2', 66, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-29'),
(111, 1, 2, NULL, 1, 'Fórum Desembargador Walter Bezerra Falcão', '10.87.24.12', 'ita_forum2', 67, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-04-30'),
(112, 4, 2, NULL, 1, 'Unidade Local', '10.16.8.12', 'ita_mp2', 68, 'Fibra', '4 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11488', '2009-05-01'),
(113, 23, 6, NULL, 2, 'SEMSA - Secretaria Municipal de Saúde / SEDE', '10.123.31.12', 'rur_sms2', 39, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11507', '2009-06-19'),
(114, 11, 6, NULL, 2, 'E.E. Eurico Vale', '10.130.47.12', 'rur_eeurico2', 40, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11508', '2009-06-20'),
(115, 5, 6, NULL, 2, 'Regional', '10.8.3.12', 'rur_adepara2', 41, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11509', '2009-06-21'),
(116, 2, 6, NULL, 2, 'Posto', '10.2.69.12', 'rur_sefa2', 42, 'Fibra', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11510', '2009-06-22'),
(117, 21, 6, NULL, 2, 'Infocentro Almir Gabriel', '10.112.180.12', 'rur_ealmir2', 43, 'Fibra', '2 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11511', '2009-06-23'),
(118, 23, 6, NULL, 2, 'Controle de Endemias', '10.126.111.12', 'rur_endemias2', 44, 'Fibra', '1 Mbps', 'Desativado', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11512', '2009-06-24'),
(119, 23, 6, NULL, 2, 'Garagem Municipal', '10.126.112.12', 'rur_garagem2', 45, 'Fibra', '1 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11513', '2009-06-25'),
(120, 23, 6, NULL, 2, 'Sede de Governo', '10.60.15.12', 'rur_prefeitura2', 46, 'Fibra', '5 Mbps', 'Ativo', 'Cadastrado', 'http://zabbix.prodepa.pa.gov.br/zabbix/charts.php?form_refresh=1&fullscreen=1&groupid=0&hostid=11514', '2009-06-26');

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
(1, 1, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5545'),
(2, 2, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-6664', '(093) 98200-3839'),
(3, 2, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5554'),
(4, 3, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-3344', '(093) 992244-6654'),
(5, 4, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5546'),
(6, 4, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-24', '(093) 98200-3840'),
(7, 5, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5555'),
(8, 5, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-3296', '(093) 992244-6655'),
(9, 6, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5547'),
(10, 7, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-6616', '(093) 98200-3841'),
(11, 7, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5556'),
(12, 8, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-9936', '(093) 992244-6656'),
(13, 8, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5546'),
(14, 9, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-13256', '(093) 98200-3840'),
(15, 10, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5555'),
(16, 10, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-16576', '(093) 992244-6655'),
(17, 11, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5547'),
(18, 11, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-19896', '(093) 98200-3841'),
(19, 12, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5556'),
(20, 13, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-23216', '(093) 992244-6656'),
(21, 13, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(22, 14, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-26536', '(093) 98200-3842'),
(23, 14, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5557'),
(24, 15, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-29856', '(093) 992244-6657'),
(25, 16, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5547'),
(26, 16, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-33176', '(093) 98200-3841'),
(27, 17, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5556'),
(28, 17, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-36496', '(093) 992244-6656'),
(29, 18, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(32, 20, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-43136', '(093) 992244-6657'),
(33, 20, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(34, 21, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-46456', '(093) 98200-3843'),
(35, 22, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(36, 22, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-49776', '(093) 992244-6658'),
(37, 23, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(38, 23, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-53096', '(093) 98200-3842'),
(39, 24, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5557'),
(40, 25, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-56416', '(093) 992244-6657'),
(41, 25, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(42, 26, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-59736', '(093) 98200-3843'),
(43, 26, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(45, 28, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(46, 28, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-66376', '(093) 98200-3844'),
(47, 29, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(48, 29, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-69696', '(093) 992244-6659'),
(49, 30, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(50, 31, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-73016', '(093) 98200-3843'),
(51, 31, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(52, 32, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-76336', '(093) 992244-6658'),
(53, 32, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(54, 33, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-79656', '(093) 98200-3844'),
(55, 34, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(56, 34, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-82976', '(093) 992244-6659'),
(57, 35, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(58, 35, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-86296', '(093) 98200-3845'),
(59, 36, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(60, 37, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-89616', '(093) 992244-6660'),
(61, 37, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(62, 38, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-92936', '(093) 98200-3844'),
(63, 38, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(64, 39, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-96256', '(093) 992244-6659'),
(65, 40, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(66, 40, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-99576', '(093) 98200-3845'),
(67, 41, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(68, 41, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-102896', '(093) 992244-6660'),
(69, 42, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(70, 43, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-1062', '(093) 98200-3846'),
(72, 44, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-1095', '(093) 99224-4666'),
(73, 44, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(74, 45, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-112856', '(093) 98200-3845'),
(75, 46, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(76, 46, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-116176', '(093) 992244-6660'),
(77, 47, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(78, 47, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-119496', '(093) 98200-3846'),
(79, 48, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5561'),
(80, 49, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-122816', '(093) 992244-6661'),
(81, 49, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5553'),
(82, 50, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-126136', '(093) 98200-3847'),
(83, 50, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5562'),
(84, 51, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-129456', '(093) 992244-6662'),
(85, 52, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(86, 52, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-132776', '(093) 98200-3846'),
(87, 53, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5561'),
(88, 53, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-136096', '(093) 992244-6661'),
(89, 54, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5553'),
(90, 55, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-139416', '(093) 98200-3847'),
(91, 55, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5562'),
(92, 56, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-142736', '(093) 992244-6662'),
(93, 56, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5554'),
(94, 57, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-146056', '(093) 98200-3848'),
(95, 58, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5563'),
(96, 58, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-149376', '(093) 992244-6663'),
(97, 59, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5553'),
(98, 59, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-152696', '(093) 98200-3847'),
(99, 60, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5562'),
(100, 61, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-156016', '(093) 992244-6662'),
(101, 61, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5554'),
(102, 62, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-159336', '(093) 98200-3848'),
(103, 62, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5563'),
(104, 63, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-162656', '(093) 992244-6663'),
(105, 64, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5555'),
(106, 64, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-165976', '(093) 98200-3849'),
(107, 65, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5564'),
(108, 65, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-169296', '(093) 992244-6664'),
(109, 66, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5554'),
(110, 67, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-172616', '(093) 98200-3848'),
(111, 67, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5563'),
(112, 68, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-175936', '(093) 992244-6663'),
(113, 68, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5555'),
(114, 69, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-179256', '(093) 98200-3849'),
(115, 70, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5564'),
(116, 70, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-182576', '(093) 992244-6664'),
(117, 71, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5556'),
(118, 71, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-185896', '(093) 98200-3850'),
(119, 72, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5565'),
(120, 73, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5546'),
(121, 73, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-189216', '(093) 98200-3840'),
(122, 74, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5555'),
(123, 74, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-192536', '(093) 992244-6655'),
(124, 75, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5547'),
(125, 76, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-195856', '(093) 98200-3841'),
(126, 76, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5556'),
(127, 77, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-199176', '(093) 992244-6656'),
(128, 77, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(129, 78, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-202496', '(093) 98200-3842'),
(130, 79, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5557'),
(131, 79, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-205816', '(093) 992244-6657'),
(132, 80, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5547'),
(133, 80, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-209136', '(093) 98200-3841'),
(134, 81, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5556'),
(135, 82, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-212456', '(093) 992244-6656'),
(136, 82, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(137, 83, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-215776', '(093) 98200-3842'),
(138, 83, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5557'),
(139, 84, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-219096', '(093) 992244-6657'),
(140, 85, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(141, 85, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-222416', '(093) 98200-3843'),
(142, 86, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(143, 86, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-225736', '(093) 992244-6658'),
(144, 87, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5548'),
(145, 88, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-229056', '(093) 98200-3842'),
(146, 88, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5557'),
(147, 89, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-232376', '(093) 992244-6657'),
(148, 89, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(149, 90, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-235696', '(093) 98200-3843'),
(150, 91, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(151, 91, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-239016', '(093) 992244-6658'),
(152, 92, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(153, 92, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-242336', '(093) 98200-3844'),
(154, 93, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(155, 94, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-245656', '(093) 992244-6659'),
(156, 94, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5549'),
(157, 95, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-248976', '(093) 98200-3843'),
(158, 95, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5558'),
(159, 96, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-252296', '(093) 992244-6658'),
(160, 97, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(161, 97, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-255616', '(093) 98200-3844'),
(162, 98, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(163, 98, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-258936', '(093) 992244-6659'),
(164, 99, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(165, 100, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-262256', '(093) 98200-3845'),
(166, 100, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(167, 101, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-265576', '(093) 992244-6660'),
(168, 101, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5550'),
(169, 102, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-268896', '(093) 98200-3844'),
(170, 103, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5559'),
(171, 103, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-272216', '(093) 992244-6659'),
(172, 104, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(173, 104, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-275536', '(093) 98200-3845'),
(174, 105, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(175, 106, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-278856', '(093) 992244-6660'),
(176, 106, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(177, 107, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-282176', '(093) 98200-3846'),
(178, 107, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5561'),
(179, 108, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-285496', '(093) 992244-6661'),
(180, 109, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5551'),
(181, 109, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-288816', '(093) 98200-3845'),
(182, 110, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5560'),
(183, 110, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-292136', '(093) 992244-6660'),
(184, 111, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(185, 112, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-295456', '(093) 98200-3846'),
(186, 112, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5561'),
(187, 113, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-298776', '(093) 992244-6661'),
(188, 113, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5553'),
(189, 114, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-302096', '(093) 98200-3847'),
(190, 115, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5562'),
(191, 115, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-305416', '(093) 992244-6662'),
(192, 116, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5552'),
(193, 116, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-308736', '(093) 98200-3846'),
(194, 117, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5561'),
(195, 118, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-312056', '(093) 992244-6661'),
(196, 118, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 99244-5553'),
(197, 119, 'Paulo Nardel', 'paulo.nardel@temp.com', '(093) 3518-315376', '(093) 98200-3847'),
(198, 119, 'Joab Torres Alencar', 'joabtorres@hotmail.com', '', '(093) 92244-5562'),
(199, 120, 'Daniel Ivens', 'daniel@temp.com', '(093) 3518-318696', '(093) 992244-6662');

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
(1, 1, '0001/2009', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(2, 1, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(3, 2, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(5, 3, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(6, 3, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(8, 4, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(9, 5, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(10, 5, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(11, 6, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(13, 7, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(14, 7, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(15, 8, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(16, 8, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(17, 9, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(18, 9, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(21, 11, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(22, 11, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(23, 12, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(24, 12, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(25, 13, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(27, 14, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(28, 15, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(29, 16, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(31, 16, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(32, 17, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(33, 17, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(34, 18, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(36, 18, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(40, 20, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(41, 21, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(42, 21, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(43, 22, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(45, 22, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(46, 23, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(47, 23, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(49, 24, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(50, 24, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(51, 25, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(52, 26, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(54, 26, '0001/2016', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(58, 28, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(59, 28, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(60, 29, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(61, 29, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(63, 30, '0001/2015', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(64, 30, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(65, 31, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(67, 31, '0001/2016', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(68, 32, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(69, 32, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(70, 33, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(72, 34, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(73, 34, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(74, 35, '0001/2015', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(76, 35, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(77, 36, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(78, 36, '0001/2016', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(79, 37, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(81, 37, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(82, 38, '0001/2017', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(83, 38, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(85, 39, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(86, 40, '0001/2015', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(87, 40, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(89, 41, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(90, 41, '0001/2016', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(91, 42, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(92, 42, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(94, 43, '0001/2017', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(96, 44, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(98, 45, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(99, 45, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(100, 46, '0001/2019', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(101, 46, '0001/2016', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(103, 47, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(104, 47, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(105, 48, '0001/2017', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(107, 49, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(108, 49, '0001/2018', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(109, 50, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(110, 50, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(112, 51, '0001/2019', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(113, 51, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(114, 52, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(116, 52, '0001/2020', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(117, 53, '0001/2017', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(118, 53, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(119, 54, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(121, 54, '0001/2018', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(122, 55, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(123, 55, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(125, 56, '0001/2019', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(126, 57, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(127, 57, '0001/2020', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(128, 58, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(130, 58, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(131, 59, '0001/2021', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(132, 59, '0001/2018', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(134, 60, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(135, 60, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(136, 61, '0001/2019', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(137, 61, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(139, 62, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(140, 62, '0001/2020', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(141, 63, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(145, 65, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(146, 65, '0001/2022', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(148, 66, '0001/2019', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(149, 66, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(150, 67, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(152, 67, '0001/2020', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(153, 68, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(154, 68, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(155, 69, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(157, 69, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(158, 70, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(159, 71, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(161, 71, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(162, 72, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(163, 72, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(164, 73, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(166, 73, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(167, 74, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(168, 74, '0001/2007', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(170, 75, '0001/2004', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(171, 75, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(172, 76, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(173, 76, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(175, 77, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(176, 77, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(177, 78, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(179, 78, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(180, 79, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(181, 79, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(183, 80, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(184, 80, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(185, 81, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(186, 81, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(188, 82, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(189, 82, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(190, 83, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(192, 83, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(193, 84, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(194, 84, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(195, 85, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(197, 85, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(198, 86, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(199, 86, '0001/2007', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(201, 87, '0001/2004', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(202, 87, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(203, 88, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(204, 88, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(206, 89, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(207, 89, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(208, 90, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(210, 90, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(211, 91, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(212, 91, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(213, 92, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(215, 92, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(216, 93, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(217, 93, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(219, 94, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(220, 94, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(221, 95, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(222, 95, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(224, 96, '0001/2007', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(225, 96, '0001/2004', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(226, 97, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(228, 97, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(229, 98, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(230, 98, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(231, 99, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(233, 99, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(234, 100, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(235, 100, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(237, 101, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(238, 101, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(239, 102, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(240, 102, '0001/2008', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(242, 103, '0001/2005', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(243, 103, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(244, 104, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(246, 104, '0001/2013', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(247, 105, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(248, 105, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(249, 106, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(251, 106, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(252, 107, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(253, 107, '0001/2015', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(255, 108, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(256, 108, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(257, 109, '0001/2009', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(258, 109, '0001/2006', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(260, 110, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(261, 111, '0001/2014', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(262, 111, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(265, 112, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(266, 114, '0001/2011', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(267, 114, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(269, 115, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(270, 115, '0001/2012', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(271, 116, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(273, 116, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(274, 117, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(275, 118, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(277, 119, '0002/2009', 'C - Contrato', '2014-08-15', '2020-10-20'),
(278, 119, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(279, 120, '0001/2010', 'ACT - Acordo de Cooperação Técnica', '2009-08-15', '2014-10-20'),
(280, 64, '2222222222222', 'C - Contrato', '2222-11-22', '2222-11-24'),
(282, 43, '200044', 'ACTF - Acordo de Cooperação Técnico e Financeiro', NULL, NULL);

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
(1, 1, 'Av. Rotary', '1065', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(2, 2, 'Av. Rotary', '1066', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(3, 3, 'Av. Rotary', '1067', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(4, 4, 'Av. Rotary', '1068', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(5, 5, 'Av. Rotary', '1069', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(6, 6, 'Av. Rotary', '1070', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(7, 7, 'Av. Rotary', '1071', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(8, 8, 'Av. Rotary', '1072', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(9, 9, 'Av. Rotary', '1073', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(10, 10, 'Av. Rotary', '1074', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(11, 11, 'Av. Rotary', '1075', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(12, 12, 'Av. Rotary', '1076', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(13, 13, 'Av. Rotary', '1077', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(14, 14, 'Av. Rotary', '1078', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(15, 15, 'Av. Rotary', '1079', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(16, 16, 'Av. Rotary', '1080', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(17, 17, 'Av. Rotary', '1081', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(18, 18, 'Av. Rotary', '1082', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(20, 20, 'Av. Rotary', '1084', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(21, 21, 'Av. Rotary', '1085', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(22, 22, 'Av. Rotary', '1086', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(23, 23, 'Av. Rotary', '1087', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(24, 24, 'Av. Rotary', '1088', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(25, 25, 'Av. Rotary', '1089', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(26, 26, 'Av. Rotary', '1090', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(28, 28, 'Av. Rotary', '1092', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(29, 29, 'Av. Rotary', '1093', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(30, 30, 'Av. Rotary', '1094', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(31, 31, 'Av. Rotary', '1095', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(32, 32, 'Av. Rotary', '1096', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(33, 33, 'Av. Rotary', '1097', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(34, 34, 'Av. Rotary', '1098', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(35, 35, 'Av. Rotary', '1099', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(36, 36, 'Av. Rotary', '1100', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(37, 37, 'Av. Rotary', '1101', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(38, 38, 'Av. Rotary', '1102', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(39, 39, 'Av. Rotary', '1103', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(40, 40, 'Av. Rotary', '1104', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(41, 41, 'Av. Rotary', '1105', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(42, 42, 'Av. Rotary', '1106', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(43, 43, 'Av. Rotary', '1107', 'Bela Vista', '', '-4.251192', '-55.979806', '04°1531.61S, 55°5956.64W'),
(44, 44, 'Av. Rotary', '1108', 'Bela Vista', '', '-4.251192', '-55.979806', '04°1531.61S, 55°5956.64W'),
(45, 45, 'Av. Rotary', '1109', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(46, 46, 'Av. Rotary', '1110', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(47, 47, 'Av. Rotary', '1111', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(48, 48, 'Av. Rotary', '1112', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(49, 49, 'Av. Rotary', '1113', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(50, 50, 'Av. Rotary', '1114', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(51, 51, 'Av. Rotary', '1115', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(52, 52, 'Av. Rotary', '1116', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(53, 53, 'Av. Rotary', '1117', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(54, 54, 'Av. Rotary', '1118', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(55, 55, 'Av. Rotary', '1119', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(56, 56, 'Av. Rotary', '1120', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(57, 57, 'Av. Rotary', '1121', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(58, 58, 'Av. Rotary', '1122', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(59, 59, 'Av. Rotary', '1123', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(60, 60, 'Av. Rotary', '1124', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(61, 61, 'Av. Rotary', '1125', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(62, 62, 'Av. Rotary', '1126', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(63, 63, 'Av. Rotary', '1127', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(64, 64, 'Av. Rotary', '1128', 'Bela Vista', '', '-4.251192', '-55.979806', '\\\\\\"04°1531.61\\\\\\"\\\\\\"S, 55°5956.64W\\\\\\"'),
(65, 65, 'Av. Rotary', '1129', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(66, 66, 'Av. Rotary', '1130', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(67, 67, 'Av. Rotary', '1131', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(68, 68, 'Av. Rotary', '1132', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(69, 69, 'Av. Rotary', '1133', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(70, 70, 'Av. Rotary', '1134', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(71, 71, 'Av. Rotary', '1135', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(72, 72, 'Av. Rotary', '1136', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(73, 73, 'Av. Rotary', '1137', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(74, 74, 'Av. Rotary', '1138', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(75, 75, 'Av. Rotary', '1139', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(76, 76, 'Av. Rotary', '1140', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(77, 77, 'Av. Rotary', '1141', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(78, 78, 'Av. Rotary', '1142', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(79, 79, 'Av. Rotary', '1143', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(80, 80, 'Av. Rotary', '1144', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(81, 81, 'Av. Rotary', '1145', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(82, 82, 'Av. Rotary', '1146', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(83, 83, 'Av. Rotary', '1147', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(84, 84, 'Av. Rotary', '1148', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(85, 85, 'Av. Rotary', '1149', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(86, 86, 'Av. Rotary', '1150', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(87, 87, 'Av. Rotary', '1151', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(88, 88, 'Av. Rotary', '1152', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(89, 89, 'Av. Rotary', '1153', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(90, 90, 'Av. Rotary', '1154', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(91, 91, 'Av. Rotary', '1155', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(92, 92, 'Av. Rotary', '1156', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(93, 93, 'Av. Rotary', '1157', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(94, 94, 'Av. Rotary', '1158', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(95, 95, 'Av. Rotary', '1159', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(96, 96, 'Av. Rotary', '1160', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(97, 97, 'Av. Rotary', '1161', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(98, 98, 'Av. Rotary', '1162', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(99, 99, 'Av. Rotary', '1163', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(100, 100, 'Av. Rotary', '1164', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(101, 101, 'Av. Rotary', '1165', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(102, 102, 'Av. Rotary', '1166', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(103, 103, 'Av. Rotary', '1167', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(104, 104, 'Av. Rotary', '1168', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(105, 105, 'Av. Rotary', '1169', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(106, 106, 'Av. Rotary', '1170', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(107, 107, 'Av. Rotary', '1171', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(108, 108, 'Av. Rotary', '1172', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(109, 109, 'Av. Rotary', '1173', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(110, 110, 'Av. Rotary', '1174', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(111, 111, 'Av. Rotary', '1175', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(112, 112, 'Av. Rotary', '1176', 'Bela Vista', '', '-4.251192', '-55.979806', '\\\\\\"04°1531.61\\\\\\"\\\\\\"S, 55°5956.64W\\\\\\"'),
(113, 113, 'Av. Rotary', '1177', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(114, 114, 'Av. Rotary', '1178', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(115, 115, 'Av. Rotary', '1179', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(116, 116, 'Av. Rotary', '1180', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(117, 117, 'Av. Rotary', '1181', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(118, 118, 'Av. Rotary', '1182', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(119, 119, 'Av. Rotary', '1183', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"'),
(120, 120, 'Av. Rotary', '1184', 'Bela Vista', NULL, '-4.251192', '-55.979806', '"04°1531.61""S, 55°5956.64W"');

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
(1, 1, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(2, 2, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(3, 3, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(4, 4, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(5, 5, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(6, 6, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(7, 7, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(8, 8, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(9, 9, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(10, 10, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(11, 11, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(12, 12, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(13, 13, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(14, 14, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(15, 15, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(16, 16, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(17, 17, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(18, 18, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(20, 20, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(21, 21, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(22, 22, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(23, 23, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(24, 24, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(25, 25, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(26, 26, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(28, 28, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(29, 29, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(30, 30, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(31, 31, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(32, 32, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(33, 33, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(34, 34, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(35, 35, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(36, 36, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(37, 37, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(38, 38, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(39, 39, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(40, 40, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(41, 41, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(42, 42, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(43, 43, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(44, 44, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(45, 45, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(46, 46, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(47, 47, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(48, 48, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(49, 49, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(50, 50, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(51, 51, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(52, 52, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(53, 53, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(54, 54, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(55, 55, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(56, 56, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(57, 57, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(58, 58, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(60, 60, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(61, 61, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(62, 62, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(63, 63, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(64, 64, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(65, 65, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(66, 66, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(67, 67, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(68, 68, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(69, 69, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(70, 70, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(71, 71, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(72, 72, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(73, 73, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(74, 74, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(75, 75, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(76, 76, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(77, 77, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(78, 78, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(79, 79, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(80, 80, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(81, 81, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(82, 82, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(83, 83, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(84, 84, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(85, 85, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(86, 86, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(87, 87, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(88, 88, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(89, 89, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(90, 90, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(91, 91, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(92, 92, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(93, 93, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(94, 94, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(95, 95, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(96, 96, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(97, 97, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(98, 98, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(99, 99, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(100, 100, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(101, 101, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(102, 102, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(103, 103, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(104, 104, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(105, 105, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(106, 106, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(107, 107, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(108, 108, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(109, 109, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(110, 110, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(111, 111, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(112, 112, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(113, 113, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(114, 114, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(115, 115, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(116, 116, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(117, 117, 2, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(118, 118, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(119, 119, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(120, 120, 1, 'Foi efetivado uma visita comercial', '2017-05-13 20:44:12'),
(125, 33, 1, 'Exemplo: Descrição do histórico...', '2017-05-20 00:53:04'),
(126, 67, 1, 'Exemplo: Descrição do histórico...', '2017-05-20 17:05:48'),
(127, 14, 1, 'Exemplo: Descrição do histórico...', '2017-05-22 12:39:40');

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
(1, 'Joab ', 'Torres Alencar', 'joab.alencar', 'joab.alencar@prodepa.pa.gov.br', '47cafbff7d1c4463bbe7ba972a2b56e3', 2, 'Estagiário', 'M', 1, 'uploads/usuarios/4ae29f09f4dc502bab15ff957c295754.jpg', 1),
(2, 'Daniel', 'Silva Ivens', 'daniel.silva', 'daniel.ivens@prodepa.pa.gov.br', '47cafbff7d1c4463bbe7ba972a2b56e3', 2, 'Estagiário', 'M', 1, 'uploads/usuarios/8061e8d7b4ade506c13ec12538b37914.jpg', 1),
(3, 'Joab', 'Torres', 'joab.temp', 'temp1@prodepa.gov.br', '700c8b805a3e2a265b01c77614cd8b21', 2, 'Estagiário', 'M', 0, 'uploads/usuarios/user_masculino.png', 1),
(4, 'Paulo Nardel', 'Silva', 'paulo.nardel', 'paulo.nardel@prodepa.pa.gov.br', '47cafbff7d1c4463bbe7ba972a2b56e3', 2, 'Gerente de Núcleo', 'M', 1, 'uploads/usuarios/93e260159bf034fd2689284488f340cd.jpg', 1);

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
  MODIFY `cod_ap` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `sgl_cidade_area_atuacao`
--
ALTER TABLE `sgl_cidade_area_atuacao`
  MODIFY `cod_area_atuacao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sgl_cidade_nucleo`
--
ALTER TABLE `sgl_cidade_nucleo`
  MODIFY `cod_nucleo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sgl_orgao`
--
ALTER TABLE `sgl_orgao`
  MODIFY `cod_orgao` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sgl_redemetro`
--
ALTER TABLE `sgl_redemetro`
  MODIFY `cod_redemetro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sgl_unidade`
--
ALTER TABLE `sgl_unidade`
  MODIFY `cod_unidade` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `sgl_unidade_contato`
--
ALTER TABLE `sgl_unidade_contato`
  MODIFY `cod_contato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
--
-- AUTO_INCREMENT for table `sgl_unidade_contrato`
--
ALTER TABLE `sgl_unidade_contrato`
  MODIFY `cod_contrato` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;
--
-- AUTO_INCREMENT for table `sgl_unidade_endereco`
--
ALTER TABLE `sgl_unidade_endereco`
  MODIFY `cod_endereco` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT for table `sgl_unidade_historico`
--
ALTER TABLE `sgl_unidade_historico`
  MODIFY `cod_historico` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- AUTO_INCREMENT for table `sgl_usuario`
--
ALTER TABLE `sgl_usuario`
  MODIFY `cod_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
