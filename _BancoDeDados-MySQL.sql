-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Nov 30, 2010 as 04:54 
-- Versão do Servidor: 5.1.41
-- Versão do PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `joaninha`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `idAgenda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idTurma` int(11) DEFAULT NULL,
  `idAluno` int(11) DEFAULT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto` longtext NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  `dataInserido` int(11) NOT NULL,
  PRIMARY KEY (`idAgenda`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`idAgenda`, `idTurma`, `idAluno`, `titulo`, `texto`, `idFuncionario`, `dataInserido`) VALUES
(7, NULL, 6, 'Chegou o uniforme!', 'OlÃ¡, tudo bem?\n\nSeu uniforme jÃ¡ estÃ¡ disponÃ­vel na secretaria. Para buscar a encomenda, procurar a secretÃ¡ria Cristina no horÃ¡rio da saÃ­da.\nAceitamos pagamentos em cartÃ£o, dinheiro ou inclusÃ£o na boleto de mensalidade.\n\nAtÃ© breve!', 1, 1277841981),
(8, 10, NULL, 'Festa Julina', 'OlÃ¡, sÃ´!\n\nNÃ³is tamu marcanu um arraiÃ¡ danado de bÃ£o pra semana que vem, dia 9, a partir das 15 horas!\nVai ter brincadeiras, pipoca, bolo, curau e muito mais!\n\nVenha aproveitar conosco tambÃ©m!', 1, 1277842221),
(9, 9, NULL, 'AlteraÃ§Ãµes na lista de materiais', 'AtenÃ§Ã£o, pais!\n\nForam realizadas alteraÃ§Ãµes na lista de materiais da turma do seu filho, devido a mudanÃ§as em nossas atividades.\n\nAs atualizacÃµes jÃ¡ estÃ£o disponÃ­veis em nosso site.\n\nContamos com sua colaboraÃ§Ã£o.', 1, 1277842350),
(10, 8, NULL, 'CalendÃ¡rio da copa do mundo', 'Devido ao jogo das quartas de final da seleÃ§Ã£o brasileira, na sexta-feira (02/julho) Ã s 11 horas da manhÃ£, estamos informando que encerraremos nossas atividades Ã s 10h00, retornando Ã s 15h.\n\nAgradecemos a compreensÃ£o e contamos com a torcida de todos!', 1, 1277842571),
(13, NULL, 5, 'Segunda via de boleto', 'Sua segunda via do boleto da mensalidade de Junho jÃ¡ estÃ¡ disponÃ­vel na secretaria.', 1, 1277842759),
(14, 6, NULL, 'Abertura da Loja Virtual', 'AtravÃ©s deste comunicado, estamos informando a implementaÃ§Ã£o de um novo serviÃ§o em nosso sistema.\n\nAgora, os senhores pais poderÃ£o adquirir os uniformes e outros produtos para seus filhos, atravÃ©s da nossa Loja Virtual.\n\nAcesse agora mesmo e confira as ofertas disponÃ­veis.\n\nSecretaria.', 1, 1289255328);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE IF NOT EXISTS `aluno` (
  `idAluno` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `idTurma` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `dataNasc` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `CEP` varchar(9) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `nomeMae` varchar(100) NOT NULL,
  `nomePai` varchar(100) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `responsavel` varchar(3) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idAluno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`idAluno`, `usuario`, `senha`, `idTurma`, `nome`, `sexo`, `dataNasc`, `endereco`, `numero`, `complemento`, `CEP`, `cidade`, `UF`, `telefone`, `celular`, `email`, `nomeMae`, `nomePai`, `CPF`, `responsavel`, `ocultar`) VALUES
(3, 'aninha', '12345', 6, 'Ana Alves', 'f', '11/11/2009', 'Rua Eta', 8, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 2222-9999', '(11) 9999-2222', 'aninha@alves.com.br', 'Maria Alves', 'JoÃ£o Alves', '123.456.789-06', 'mae', 'nao'),
(4, 'beto', '12345', 15, 'Alberto Alves', 'm', '22/06/2006', 'Rua TÃ©ta', 9, 'apto 802', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 3333-8888', '(11) 8888-3333', 'alberto@alves.com.br', 'Maria Alves', 'JoÃ£o Alves', '123.456.789-06', 'mae', 'nao'),
(5, 'bia', '12345', 10, 'Beatriz de Campos', 'm', '23/04/2008', 'Rua Iota', 10, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 4444-7777', '(11) 7777-4444', 'bia@campos.com.br', 'Viviane da Silva Campos', 'Marcos de Campos', '123.456.789-07', 'pai', 'nao'),
(6, 'gui', '12345', 8, 'Guilherme Leite', 'm', '02/03/2010', 'Rua Capa', 11, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 5555-6666', '(11) 6666-5555', 'gui@leite.com.br', 'Maria Aparecida Leite', 'AntÃ´nio Leite', '123.456.789-08', 'mae', 'nao'),
(7, 'biel', '12345', 10, 'Gabriel Fernandes', 'm', '02/07/2007', 'Rua Lambda', 12, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 1212-1212', '(11) 2121-2121', 'biel@fernandes.com.br', 'Maria LÃºcia Fernandes', 'JoÃ£o da Silva', '123.456.789-09', 'mae', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `assunto`
--

CREATE TABLE IF NOT EXISTS `assunto` (
  `idAssunto` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `assunto` varchar(50) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idAssunto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `assunto`
--

INSERT INTO `assunto` (`idAssunto`, `assunto`, `ocultar`) VALUES
(1, 'SugestÃµes', 'nao'),
(2, 'OpiniÃ£o', 'nao'),
(3, 'PrÃ©-MatrÃ­cula', 'nao'),
(5, 'Secretaria', 'nao'),
(6, 'Esportes', 'nao'),
(7, 'Passeios', 'nao'),
(8, 'Teatro', 'nao'),
(9, 'Atividades', 'nao'),
(10, 'Transporte', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contato`
--

CREATE TABLE IF NOT EXISTS `contato` (
  `idMensagem` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `idAssunto` int(11) NOT NULL,
  `mensagem` longtext NOT NULL,
  `dataEnvio` int(11) NOT NULL,
  `dataLeitura` int(11) NOT NULL,
  `resolvido` varchar(3) NOT NULL,
  PRIMARY KEY (`idMensagem`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `contato`
--

INSERT INTO `contato` (`idMensagem`, `nome`, `email`, `telefone`, `idAssunto`, `mensagem`, `dataEnvio`, `dataLeitura`, `resolvido`) VALUES
(13, 'Soraia Soares', 'soraia@soares.com.br', '(11) 9898-9898', 3, 'OlÃ¡, tudo bem?\nMeu filho completarÃ¡ 6 meses mÃªs que vem, entÃ£o eu gostaria de obter maiores informaÃ§Ãµes sobre as mensalidades e horÃ¡rios da escola.\n\nGrata e no aguardo de resposta,', 1277843407, 0, 'nao'),
(14, 'ClÃ¡udia Abreu Azevedo', 'claudia@aa.com.br', '(11) 7070-7070', 5, 'OlÃ¡, tudo bem?\n\nPreciso de um novo uniforme para meu filho, que estuda no Jardim II. Com quem devo falar? VocÃªs tÃªm modelos com o tamanho para que eu possa escolher?', 1277843884, 0, 'nao'),
(15, 'Vanessa Lima', 'vanessa@lima.com.br', '(11) 2020-2020', 10, 'Vi no site que vocÃªs tÃªm transporte prÃ³prio e gostaria de saber se minha regiÃ£o pode ser atendida pelo serviÃ§o de vocÃªs. Moro no ButantÃ£, prÃ³ximo ao Instituto ButantÃ£.', 1277844019, 0, 'nao'),
(16, 'Maria Alves', 'maria@alves.com.br', '(11) 1111-2222', 6, 'OlÃ¡, como vÃ£o?\nGostaria de saber se as aulas de futebol continuarÃ£o acontecendo no inverno, apesar do frio.', 1277844169, 0, 'nao'),
(17, 'Amanda Mendes', 'amanda@mendes.com.br', '(11) 0011-2233', 7, 'OlÃ¡! \n\nSou representante da Brinquedoteca Brinque Mais e gostaria de divulgar nosso programa de visitas. Contamos com grande acervo de brinquedos, monitores treinados, lanche e atividades temÃ¡ticas.\nPara maiores informaÃ§Ãµes, consulte nosso site: www.brinquemaisbrinquedoteca.com.br ou entre em contato com amanda@brinquemaisbrinquedoteca.com.br.\n\nGrata!', 1277844336, 1277932571, 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE IF NOT EXISTS `funcionario` (
  `idFuncionario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `dataNasc` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  `CEP` varchar(9) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `UF` varchar(2) NOT NULL,
  `telefone` varchar(14) NOT NULL,
  `celular` varchar(14) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `usuario`, `senha`, `idTipo`, `nome`, `sexo`, `dataNasc`, `endereco`, `numero`, `complemento`, `CEP`, `cidade`, `UF`, `telefone`, `celular`, `email`, `CPF`, `ocultar`) VALUES
(1, 'admin', 'admin', 1, 'Administrador', 'm', '01/01/2010', 'R. Administrador', 123, NULL, '12345-678', 'SÃ£o Paulo', 'SP', '(11) 1234-5678', NULL, 'admin@admin.com.br', '123.456.789-00', 'nao'),
(5, 'profbercarioM', '12345', 3, 'Vera Alves', 'f', '01/01/1980', 'Rua Alfa', 2, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 1111-2222', '(11) 2222-1111', 'vera@joaninha.edu.br', '123.456.789-00', 'nao'),
(6, 'profbercarioT', '12345', 3, 'LÃºcia Batista', 'f', '01/02/1981', 'Rua Beta', 3, 'apto 01', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 3333-4444', '(11) 4444-3333', 'lucia@joaninha.edu.br', '123.456.789-01', 'nao'),
(7, 'profmaternalM', '12345', 3, 'Odete Castro', 'f', '01/03/1982', 'Rua Gama', 4, 'fundos', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 5555-6666', '(11) 6666-5555', 'odete@joaninha.edu.br', '123.456.789-02', 'nao'),
(8, 'profmaternalT', '12345', 3, 'AngÃ©lica da Silva', 'f', '01/04/1983', 'Rua Delta', 5, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 7777-8888', '(11) 8888-7777', 'angelica@joaninha.edu.br', '123.456.789-03', 'nao'),
(9, 'profjardim1', '12345', 3, 'Carla Souza', 'f', '01/05/1984', 'Rua Epsilon', 6, 'casa 3', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 9999-0000', '(11) 0000-9999', 'carla@joaninha.edu.br', '123.456.789-04', 'nao'),
(10, 'profjardim2', '12345', 3, 'MÃ´nica Soares da Silva', 'f', '01/06/1985', 'Rua Zeta', 7, '', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 1111-0000', '(11) 0000-1111', 'monicass@joaninha.edu.br', '123.456.789-05', 'nao'),
(11, 'cris', '12345', 2, 'Cristina Cruz', 'f', '04/05/1988', 'Alameda Grega', 131, 'edifÃ­cio atena ap 3', '12345-678', 'SÃ£o Paulo', 'SP', '(11) 3434-3434', '(11) 4343-4343', 'cristina@joaninha.edu.br', '123.456.789-10', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `listaproduto`
--

CREATE TABLE IF NOT EXISTS `listaproduto` (
  `idProduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `produto` varchar(100) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Extraindo dados da tabela `listaproduto`
--

INSERT INTO `listaproduto` (`idProduto`, `produto`, `ocultar`) VALUES
(4, 'mamadeira para chÃ¡ - 150ml', 'nao'),
(5, 'lÃ¡pis de cor', 'nao'),
(6, 'escova de dentes', 'nao'),
(7, 'cartolina colorida', 'nao'),
(8, 'cartolina branca', 'nao'),
(9, 'toalha', 'nao'),
(10, 'cola branca', 'nao'),
(11, 'caneca plÃ¡stica', 'nao'),
(12, 'shampoo infantil', 'nao'),
(13, 'canetinhas hidrocor (12 cores)', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `listaturma`
--

CREATE TABLE IF NOT EXISTS `listaturma` (
  `idLista` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idTurma` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  PRIMARY KEY (`idLista`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `listaturma`
--

INSERT INTO `listaturma` (`idLista`, `idTurma`, `idProduto`, `qtd`) VALUES
(6, 8, 4, 2),
(7, 6, 4, 1),
(8, 7, 4, 1),
(9, 8, 12, 1),
(10, 8, 9, 1),
(11, 20, 13, 1),
(12, 20, 8, 6),
(13, 18, 8, 3),
(14, 19, 8, 3),
(15, 11, 11, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojaitem`
--

CREATE TABLE IF NOT EXISTS `lojaitem` (
  `idItem` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `idProduto` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `dataInserido` int(11) NOT NULL,
  PRIMARY KEY (`idItem`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `lojaitem`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `lojapedido`
--

CREATE TABLE IF NOT EXISTS `lojapedido` (
  `idPedido` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idAluno` int(11) NOT NULL,
  `dataInicio` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `formaPgm` varchar(10) NOT NULL,
  `cartaoTipo` varchar(10) NOT NULL,
  `cartaoNum` varchar(20) NOT NULL,
  `cartaoVenc` varchar(5) NOT NULL,
  `cartaoNome` varchar(100) NOT NULL,
  `cartaoCodS` varchar(3) NOT NULL,
  `cartaoParcelas` int(11) NOT NULL,
  PRIMARY KEY (`idPedido`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Extraindo dados da tabela `lojapedido`
--


-- --------------------------------------------------------

--
-- Estrutura da tabela `lojaproduto`
--

CREATE TABLE IF NOT EXISTS `lojaproduto` (
  `idProduto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `descricao` longtext NOT NULL,
  `valor` varchar(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `dataInserido` int(11) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Extraindo dados da tabela `lojaproduto`
--

INSERT INTO `lojaproduto` (`idProduto`, `nome`, `descricao`, `valor`, `img`, `dataInserido`, `ocultar`) VALUES
(1, 'Uniforme de Ballet', '- Collant tipo regata.\n- Meia-CalÃ§a.\n- Rendinha\n- Sapatilha', '63,00', '1.jpg', 1285980755, 'nao'),
(2, 'Kimono Infantil DragÃ£o', '- Kimono DragÃ£o Infantil - branco\n- BlusÃ£o com saia em tecido tranÃ§ado, super-reforÃ§ado.\n- CalÃ§a em lona grossa, ultrarresistente.\n- Conjunto prÃ©-lavado (prÃ©-encolhido).\n- Peso aproximado: blusÃ£o - 430 g/mÂ² e calÃ§a - 430 g/mÂ².\n- Garantia do fabricante: contra defeito de fabricaÃ§Ã£o.\n- Produto: nacional.\n\nImportante: o kimono nÃ£o acompanha a faixa de graduaÃ§Ã£o. A faixa Ã© vendida separadamente.\nExcepcionalmente os kimonos podem encolher entre 1% e 3% nas lavagens normais, sem o uso de secadoras.', '87,00', '2.jpg', 1285981975, 'nao'),
(3, 'Touca NataÃ§Ã£o Rosa', '- Toca de nataÃ§Ã£o da marca Speedo, modelo Jr. Solid Latex.\n- 100% Latex\n- Produto importado.', '5,00', '3.jpg', 1285983036, 'nao'),
(4, 'Touca NataÃ§Ã£o Azul', '- Toca de nataÃ§Ã£o da marca Speedo, modelo Jr. Solid LateX.\n- 100% Latex\n- Produto importado.', '5,00', '4.jpg', 1285983347, 'nao'),
(5, 'Ã“culos de NataÃ§Ã£o', '- Ã“culos de nataÃ§Ã£o da marca Speedo, modelo Jr. Hydrospex.\n- Lentes espelhadas, anti-embaÃ§antes com proteÃ§Ã£o UV\n- AlÃ§a de silicone de fÃ¡cil ajuste.\n- Hipo-alergÃªnico\n-  Produto importado.', '27,20', '5.jpg', 1285983578, 'nao'),
(6, 'Tankini', '- Tankini da marca Speedo, modelo Hibiscus Swirl.\n-  85% Nylon / 15% Spandex\n-  Produto importado.', '34,00', '6.jpg', 1286083414, 'nao'),
(7, 'Sunga', '- Sunga da marca Speedo, modelo Axcel Spliced.\n- Costuras ReforÃ§adas.\n- 74% Nylon / 26% Xtra Life LycraÂ®\n-  Produto importado.', '30,00', '7.jpg', 1286083711, 'nao'),
(8, 'Shorts', '- Shorts do uniforme do Time A e B da Joaninha.\n- Shorts  da marca Adidas, modelo Tiro Striker\n- Estilo e performance ao seu pequeno jogador.\n- Tecido com tecnologia CLIMALITEÂ®\n- 100% Polyester\n-  Produto importado.', '30,60', '8.jpg', 1286137307, 'nao'),
(9, 'Camiseta Time B', '- Camisa do uniforme do Time B da Joaninha.\n- Camisa da marca Adidas, modelo Tiro Jersey\n- Estilo e performance ao seu pequeno jogador.\n- Tecido com tecnologia CLIMALITEÂ®\n- 100% Polyester\n-  Produto importado.', '51,00', '9.jpg', 1286137560, 'nao'),
(10, 'Camiseta Time A', '- Camisa do uniforme do Time A da Joaninha.\n- Camisa da marca Adidas, modelo Tiro Jersey\n- Estilo e performance ao seu pequeno jogador.\n- Tecido com tecnologia CLIMALITEÂ®\n- 100% Polyester\n-  Produto importado.', '51,00', '10.jpg', 1286138628, 'nao'),
(11, 'Camiseta Vermelha', '- Camiseta manga curta, VERMELHA , da marca Adidas.\n- 100% algodÃ£o.\n- Produto importado.', '30,60', '11.jpg', 1286139021, 'nao'),
(12, 'Camiseta Branca', '- Camiseta manga curta, branca, da marca Adidas.\n- 100% algodÃ£o.\n- Produto importado.', '30,60', '12.jpg', 1286139090, 'nao'),
(13, 'CalÃ§a', '- Produto da marca Adidas, modelo Firebird.\n- Modelo clÃ¡ssico de calÃ§a Adidas para as crianÃ§as.\n- Com elÃ¡stico na cintura com as 3 listras laterais\n- Muito confortÃ¡vel\n- 100% algodÃ£o\n- Produto importado.', '59,50', '13.jpg', 1286139181, 'nao'),
(14, 'Blusa', '- Produto da marca Adidas, modelo Firebird.\n- Modelo clÃ¡sico de blusa Adidas  para as crianÃ§as.\n- Todos os detalhes do modelo adulto, incluido ziper e bolsos frontais e as 3 listras.\n- Muito confortÃ¡vel.\n- 100% AlgodÃ£o.\n- Produto importado.', '68,00', '14.jpg', 1286139259, 'nao'),
(15, 'Conjunto', '- Produto da marca Adidas, modelo Firebird.\n- Agasalho Adidas modelo old-school para as crianÃ§as.\n- Todo o estilo do Adidas adi Firebird versÃ£o adulta,  em um tamanho infantil.\n- ElÃ¡tico na cintura e tecido macio, uma escolha confortavel para o cotidiano das crianÃ§as\n- Bolsos frontais na blusa e na calÃ§a\n- 100% AlgodÃ£o.\n- Produto importado.', '76,50', '15.jpg', 1288997312, 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipofuncionario`
--

CREATE TABLE IF NOT EXISTS `tipofuncionario` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(100) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `tipofuncionario`
--

INSERT INTO `tipofuncionario` (`idTipo`, `tipo`, `ocultar`) VALUES
(1, 'Administrador', 'nao'),
(2, 'Secretaria', 'nao'),
(3, 'Professor', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE IF NOT EXISTS `turma` (
  `idTurma` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `turma` varchar(50) NOT NULL,
  `ocultar` varchar(3) NOT NULL,
  PRIMARY KEY (`idTurma`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turma`, `ocultar`) VALUES
(6, 'BerÃ§Ã¡rio ManhÃ£', 'nao'),
(7, 'BerÃ§Ã¡rio Tarde', 'nao'),
(8, 'BerÃ§Ã¡rio Integral', 'nao'),
(9, 'Maternal ManhÃ£', 'nao'),
(10, 'Maternal Tarde', 'nao'),
(11, 'Maternal Integral', 'nao'),
(12, 'Jardim I ManhÃ£', 'nao'),
(13, 'Jardim I Tarde', 'nao'),
(14, 'Jardim I Integral', 'nao'),
(15, 'Jardim II ManhÃ£', 'nao'),
(16, 'Jardim II Tarde', 'nao'),
(17, 'Jardim II Integral', 'nao'),
(18, 'Jardim III ManhÃ£', 'nao'),
(19, 'Jardim III Tarde', 'nao'),
(20, 'Jardim III Integral', 'nao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE IF NOT EXISTS `uf` (
  `uf` varchar(2) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `uf`
--

INSERT INTO `uf` (`uf`, `nome`) VALUES
('AC', 'Acre'),
('AL', 'Alagoas'),
('AP', 'AmapÃ¡'),
('AM', 'Amazonas'),
('BA', 'Bahia'),
('CE', 'CearÃ¡'),
('DF', 'Distrito Federal'),
('ES', 'Espirito Santo'),
('GO', 'GoiÃ¡s'),
('MA', 'MaranhÃ£o'),
('MT', 'Mato Grosso'),
('MS', 'Mato Grosso do Sul'),
('MG', 'Minas Gerais'),
('PA', 'ParÃ¡'),
('PB', 'ParaÃ­ba'),
('PR', 'ParanÃ¡'),
('PE', 'Pernambuco'),
('PI', 'PiauÃ­'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RS', 'Rio Grande do Sul'),
('RO', 'RondÃ´nia'),
('RR', 'Roraima'),
('SC', 'Santa Catarina'),
('SP', 'SÃ£o Paulo'),
('SE', 'Sergipe'),
('TO', 'Tocantins');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
