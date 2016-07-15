alter table tbvendedor add MAC varchar(17);
alter table tbvendedor add pedirMesa char(1) default 'S';


DROP TABLE IF EXISTS `tbmactablet`;
CREATE TABLE `tbmactablet` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `MAC` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `tbpedidotablet`;
CREATE TABLE `tbpedidotablet` (
  `incremento` int(11) NOT NULL DEFAULT '0',
  `link` varchar(30) NOT NULL DEFAULT '0',
  `codigoproduto` varchar(30) DEFAULT NULL,
  `descricaoproduto` varchar(255) DEFAULT NULL,
  `quantidade` double DEFAULT NULL,
  `valorunit` double DEFAULT NULL,
  `valortotal` double DEFAULT NULL,
  `codvendedor` int(11) DEFAULT NULL,
  `nomevendedor` varchar(65) DEFAULT NULL,
  `acrescimo` double DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `agrupado` char(1) DEFAULT 'N',
  `un` char(5) DEFAULT 'UN',
  KEY `NewIndex` (`link`,`incremento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



DROP TABLE IF EXISTS `tbpedido_tablet_imp`;
CREATE TABLE `tbpedido_tablet_imp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(30) NOT NULL DEFAULT '0',
  `codigoproduto` varchar(30) DEFAULT NULL,
  `descricaoproduto` varchar(255) DEFAULT NULL,
  `quantidade` double DEFAULT NULL,
  `valorunit` double DEFAULT NULL,
  `valortotal` double DEFAULT NULL,
  `codvendedor` int(11) DEFAULT NULL,
  `nomevendedor` varchar(65) DEFAULT NULL,
  `acrescimo` double DEFAULT NULL,
  `desconto` double DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `agrupado` char(1) DEFAULT 'N',
  `un` char(5) DEFAULT 'UN',
  `idcontrole` int(11) DEFAULT '0',
  `status` int(11) DEFAULT '0',
  `sigla` varchar(6) DEFAULT NULL,
  `TIPO` varchar(50) DEFAULT NULL,
  `codoperador` int(11) DEFAULT NULL,
  `operador` varchar(60) DEFAULT NULL,
  `data_entrega` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

