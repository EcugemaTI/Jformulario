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
  `mensaje_validacion` varchar(200) NOT NULL  ,
  `clase_adicional` varchar(200) NOT NULL  ,
  PRIMARY KEY  (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;


INSERT INTO `#__formulario` VALUES (1,'Formulario1','datos1','','formulario.css',1,0,'Fabio Bazurto');

INSERT INTO `#__campos` VALUES (1,'Nombres','texto','','[A-Z][a-zA-Z]*\\D{3}',1,1,'nombres','debe tener al menos 3 caracteres.','');
INSERT INTO `#__campos` VALUES (2,'Apellidos','texto','','[A-Z][a-zA-Z]*\\D{3}',1,1,'apellidos','debe tener al menos 3 caracteres.','');
INSERT INTO `#__campos` VALUES (3,'Estado Civil','lista','Soltero|S,Casado|C,Viudo|V,Cojo|O','[A-Z][a-zA-Z]*\\D{3}',1,1,'estadocivil','debe tener al menos 3 caracteres.','');
INSERT INTO `#__campos` VALUES (4,'Correo electrónico','texto','','',1,1,'email','debe tener al menos 3 caracteres.','validate-email');