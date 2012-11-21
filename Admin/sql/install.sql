DROP TABLE IF EXISTS `#__formulario`;

CREATE TABLE `#__formulario` (
  `id` int(11) NOT NULL auto_increment,
  `titulo` varchar(30) NOT NULL,
  `tabla_mapeo` varchar(30) NOT NULL,
  `css_forma_clase` varchar(30) NOT NULL,
  `css_nombre` varchar(30) NOT NULL,
  `usar_notificacion` tinyint(1) NOT NULL DEFAULT 1,
  `usar_envio` tinyint(1) NOT NULL DEFAULT 0,
  `email_remitente` varchar(60) NOT NULL,
  
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `#__campos`;

CREATE TABLE `#__campos` (
  `id` int(11) NOT NULL auto_increment,
  `etiqueta` varchar(30) NOT NULL DEFAULT 'ETIQUETA',
  `tipo` varchar(30) NOT NULL DEFAULT 'TEXT',
  `combo_datos` varchar(300) NOT NULL,
  `expresion_regular` varchar(80) NOT NULL,
  `es_obligatorio` tinyint(1) NOT NULL DEFAULT 1  ,
  `formulario_id` int(11) NOT NULL  ,
  `nombre` varchar(30) NOT NULL  ,
  `clase` varchar(80) NOT NULL  ,
  `validacion` varchar(80) NOT NULL  ,
  PRIMARY KEY  (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;