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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etiqueta` varchar(30) NOT NULL DEFAULT 'ETIQUETA',
  `tipo` varchar(30) NOT NULL DEFAULT 'TEXT',
  `combo_datos` varchar(300) NOT NULL,
  `expresion_regular` varchar(1000) DEFAULT NULL,
  `es_obligatorio` tinyint(1) NOT NULL DEFAULT '1',
  `formulario_id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `mensaje_validacion` varchar(200) NOT NULL,
  `clase_adicional` varchar(200) NOT NULL,
  `grupo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__campos` (`id`, `etiqueta`, `tipo`, `combo_datos`, `expresion_regular`, `es_obligatorio`, `formulario_id`, `nombre`, `mensaje_validacion`, `clase_adicional`, `grupo`) VALUES (101,'Nombres','texto','','[A-Z][a-zA-Z]*\\D{3}',1,1,'nombres','debe tener al menos 3 caracteres.','',''),(102,'Apellidos','texto','','[A-Z][a-zA-Z]*\\D{3}',1,1,'apellidos','debe tener al menos 3 caracteres.','',''),(103,'Estado Civil','lista','Soltero|S,Casado|C,Viudo|V,Cojo|O','[A-Z][a-zA-Z]*\\D{3}',1,1,'estadocivil','debe tener al menos 3 caracteres.','',''),(104,'Correo electr','texto','','',1,1,'email','debe tener al menos 3 caracteres.','validate-email',''),(1,'Nombres','texto','','/^[a-zA-Z0-9_]{3,16}$/',1,1,'nombres','debe tener al menos 3 caracteres.','','3. INFORMACION FINANCIERA'),(2,'Apellidos','texto','','/^[a-zA-Z0-9_]{3,16}$/',1,1,'apellidos','debe tener al menos 3 caracteres.','','3. INFORMACION FINANCIERA'),(3,'Estado Civil','lista','Soltero|S,Casado|C,Viudo|V,Cojo|O','',1,1,'estadocivil','debe tener al menos 3 caracteres.','','3. INFORMACION FINANCIERA'),(4,'Correo electr','texto','','',1,1,'email','debe tener al menos 3 caracteres.','validate-email','3. INFORMACION FINANCIERA'),(5,'Cédula','texto','','',1,2,'cedula','error en el código verificador.No letras ni espacios.','validate-cedula','1. DATOS PERSONALES'),(6,'Apellido paterno','texto','','/^[a-zA-Z0-9_]{1,30}$/',1,2,'apellidopaterno','Apellido paterno es obligatorio.','','1. DATOS PERSONALES'),(7,'Apellido materno','texto','','/^[a-zA-Z0-9_]{1,30}$/',1,2,'apellidomaterno','debe ser mayor a 2 letras y menor a 30.','','1. DATOS PERSONALES'),(8,'Nombres','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'nombres','debe ser mayor a 2 letras y menor a 30.','','1. DATOS PERSONALES'),(9,'Sexo','lista','Femenino|F,Masculino|M','',1,2,'sexo','Seleccione sexo','','1. DATOS PERSONALES'),(10,'Fecha de nacimiento','calendario','','/^([1-9]|0[1-9]|1[0-9]|2[0-9]|3[0-1])[- / .]([1-9]|0[1-9]|1[0-2])[- / .](1[9][0-9][0-9]|2[0][0-9][0-9])$/',1,2,'fechadenacimiento','debe ingresar la fecha en formato dia/mes/año','','1. DATOS PERSONALES'),(11,'Nacionalidad','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'nacionalidad','debe ser mayor a 2 letras y menor a 30.','','1. DATOS PERSONALES'),(12,'Ciudad','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'ciudad','debe ser mayor a 2 letras y menor a 30.','','1. DATOS PERSONALES'),(13,'Domicilio actual:','texto','','/^[a-zA-Z0-9_]{2,90}$/',1,2,'domicilioactual','no puede ser mayor a 90 letras','','1. DATOS PERSONALES'),(14,'Tiempo domicilio actual','lista','menor a 12 meses|menor a 12 meses,12 meses|12 meses,mayor a 12 meses| mayor a 12 meses','',1,2,'tiempodomicilioactual','','','1. DATOS PERSONALES'),(15,'Teléfono fijo','texto','','',1,2,'telefonofijo','debe ser numérico y debe ser de 9 dígitos','validate-convencional','1. DATOS PERSONALES'),(16,'Teléfono celular','texto','','',1,2,'telefonocelular','debe ser numérico y debe ser de 9 dígitos','validate-celular','1. DATOS PERSONALES'),(17,'Estado civil','lista','Soltero|S,Casado|C,Divorciado|D,Unión Libre|U,Viudo|V','',1,2,'estadocivil','','','1. DATOS PERSONALES'),(18,'Apellido paterno cónyuge','texto','','',0,2,'apellidopaternoconyuge','','','1. DATOS PERSONALES'),(19,'Apellido materno cónyuge','texto','','/^[a-zA-Z0-9_]{0,30}$/',0,2,'apellidomaternoconyuge','debe tener 30 caracteres o menos.','','1. DATOS PERSONALES'),(20,'Nombres cónyuge','texto','','/^[a-zA-Z0-9_]{0,30}$/',0,2,'nombresconyuge','debe tener 30 caracteres o menos.','','1. DATOS PERSONALES'),(21,'Cédula cónyuge','texto','','/^[a-zA-Z0-9_]{0,30}$/',0,2,'cedulaconyuge','es obligatorio y el número de caracteres debe ser menor a 30.','','1. DATOS PERSONALES'),(22,'Vivienda','lista','Propia|Propia,Arrendada|Arrendada,Otro|Otro','',1,2,'vivienda','','','1. DATOS PERSONALES'),(23,'Nombre empresa actual','texto','','/^[a-zA-Z0-9_]{0,30}$/',1,2,'nombreempresaactual','es obligatorio y el número de caracteres debe ser menor a 30.','','2. DATOS LABORALES'),(24,'Actividad empresa','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'actividadempresa','número de caracteres debe ser mayor a 2 y menor a 30.','','2. DATOS LABORALES'),(25,'Situación','lista','Dependiente|dependiente,Independiente|independiente','',1,2,'situacion','es obligatorio debe ingresar 30 caracteres o menos.','','2. DATOS LABORALES'),(26,'Cargo','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'cargo','número de caracteres debe ser mayor a 2 y menor a 30.','','2. DATOS LABORALES'),(27,'Ciudad','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'empciudad','es obligatorio y el número de caracteres debe ser menor a 30.','','2. DATOS LABORALES'),(28,'Teléfono fijo','texto','','',1,2,'emptelefonofijo','','validate-convencional','2. DATOS LABORALES'),(29,'Dirección','texto','','/^[a-zA-Z0-9_]{2,150}$/',1,2,'empdireccion','es obligatorio y el número de caracteres debe ser menor a 150.','','2. DATOS LABORALES'),(30,'Profesión','texto','','/^[a-zA-Z0-9_]{2,30}$/',0,2,'empprofesion','es obligatorio y el número de caracteres debe ser menor a 30.','','2. DATOS LABORALES'),(31,'Empresa anterior donde trabajó','texto','','/^[a-zA-Z0-9_]{2,80}$/',0,2,'empresaanterior','debe tener 80 caracteres o menos.','','2. DATOS LABORALES'),(32,'Tiempo','texto','','/^[a-zA-Z0-9_]{2,30}$/',0,2,'empanttiempotrabajo','debe ser mayor a 2 letras y menor a 30.','','2. DATOS LABORALES'),(33,'Teléfono fijo','texto','','',0,2,'empanttelefonofijo','','validate-convencional','2. DATOS LABORALES'),(34,'Banco','texto','','/^[a-zA-Z0-9_]{2,30}$/',0,2,'banco','no puede ser mayor a 30 caracteres.','','3. INFORMACION FINANCIERA'),(35,'','check','Ahorro|AHO,Corriente|COR','',0,2,'tipodecuenta','','','3. INFORMACION FINANCIERA'),(36,'Sueldo mensual','texto','','/^[0-9._]{0,30}$/',1,2,'sueldomensual','debe ingresar el sueldo mensual .','','3. INFORMACION FINANCIERA'),(37,'Otros ingresos','texto','','/^[0-9._]{0,30}$/',1,2,'otrosingresos','debe ingresar otros ingresos.','','3. INFORMACION FINANCIERA'),(38,'Total ingresos','texto','','/^[0-9._]{0,30}$/',1,2,'totalingresos','debe ingresar total de ingresos','','3. INFORMACION FINANCIERA'),(39,'Tarjetas de crédito','check','Diners|Diners,Mastercard|Mastercard,Visa|Visa, American Express| American Express','',0,2,'tarjetasdecredito','','','3. INFORMACION FINANCIERA'),(40,'Origen de otros ingresos','texto','','/^[a-zA-Z0-9_]{2,60}$/',0,2,'origendeotrosingresos','','','3. INFORMACION FINANCIERA'),(41,'Apellidos','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia1apellidos','debe ingresar apellido de referencia.','','4. REFERENCIAS PERSONALES'),(42,'Nombres','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia1nombres','debe ingresar el nombre de la referencia1','','4. REFERENCIAS PERSONALES'),(43,'Parentezco','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia1parentezco','debe ingresar el parentezco para referencia 1.','','4. REFERENCIAS PERSONALES'),(44,'Telefono trabajo','texto','','/^[0-9_]{9}$/',1,2,'referencia1telefonotrab','debe ingresar el teléfono para referencia 1.','','4. REFERENCIAS PERSONALES'),(45,'Teléfono domicilio','texto','','/^[0-9_]{9}$/',1,2,'referencia1telefonodom','debe ingresar el teléfono domicilio para referencia 1.','','4. REFERENCIAS PERSONALES'),(46,'Teléfono celular','texto','','/^[0-9_]{10}$/',1,2,'referencia1telcel','debe ingresar el teléfono celular en referencia 1.','','4. REFERENCIAS PERSONALES'),(47,'Apellidos','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia2apellidos','debe ingresar los apellidos para la referencia 2.','','4. REFERENCIAS PERSONALES'),(48,'Nombres','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia2nombres','debe ingresar el nombre de la referencia2.','','4. REFERENCIAS PERSONALES'),(49,'Parentezco','texto','','/^[a-zA-Z0-9_]{2,30}$/',1,2,'referencia2parentezco','debe ingresar el parentezco para referencia 2.','','4. REFERENCIAS PERSONALES'),(50,'Teléfono trabajo','texto','','/^[0-9_]{9}$/',1,2,'referencia2telefonotrab','debe ingresar el teléfono de trabajo de referencia 2.','','4. REFERENCIAS PERSONALES'),(51,'Teléfono domicilio','texto','','/^[0-9_]{9}$/',1,2,'referencia2telefonodom','debe ingresar el teléfono domicilio para referencia 2.','','4. REFERENCIAS PERSONALES'),(52,'Teléfono celular','texto','','/^[0-9_]{10}$/',1,2,'referencia2telefonocel','debe ingresar el teléfono celular en referencia 2.','','4. REFERENCIAS PERSONALES'),(53,'Dónde desea recibir su reporte','lista','Domicilio|DOM,Oficina|OFI','',1,2,'reporterecibo','debe seleccionar el lugar para recibir su reporte Credito directo.','','DATOS ADICIONALES'),(54,'Email','texto','','/^(.+\\@.+\\..+)$/',1,2,'email','debe ingresar un email válido, por ej.: correo@dominio.com','','DATOS ADICIONALES');

INSERT INTO `jos_formulario` (`id`, `titulo`, `tabla_mapeo`, `css_forma_clase`, `css_nombre`, `usar_notificacion`, `usar_envio`, `email_remitente`) VALUES (1,'Formulario1','datos1','','formulario.css',1,0,'Fabio Bazurto'),(2,'Solicitud Pycca','datos1','','formulario.css',1,0,'Fabio Bazurto');


CREATE TABLE `datos1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(80) DEFAULT NULL,
  `apellidopaterno` varchar(80) DEFAULT NULL,
  `apellidomaterno` varchar(80) DEFAULT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `sexo` varchar(80) DEFAULT NULL,
  `fechadenacimiento` varchar(80) DEFAULT NULL,
  `nacionalidad` varchar(80) DEFAULT NULL,
  `ciudad` varchar(80) DEFAULT NULL,
  `domicilioactual` varchar(80) DEFAULT NULL,
  `tiempodomicilioactual` varchar(80) DEFAULT NULL,
  `telefonofijo` varchar(80) DEFAULT NULL,
  `telefonocelular` varchar(80) DEFAULT NULL,
  `estadocivil` varchar(80) DEFAULT NULL,
  `apellidopaternoconyuge` varchar(80) DEFAULT NULL,
  `apellidomaternoconyuge` varchar(80) DEFAULT NULL,
  `nombresconyuge` varchar(80) DEFAULT NULL,
  `cedulaconyuge` varchar(80) DEFAULT NULL,
  `vivienda` varchar(80) DEFAULT NULL,
  `nombreempresaactual` varchar(80) DEFAULT NULL,
  `actividadempresa` varchar(80) DEFAULT NULL,
  `situacion` varchar(80) DEFAULT NULL,
  `cargo` varchar(80) DEFAULT NULL,
  `empciudad` varchar(80) DEFAULT NULL,
  `emptelefonofijo` varchar(80) DEFAULT NULL,
  `empdireccion` varchar(80) DEFAULT NULL,
  `empprofesion` varchar(80) DEFAULT NULL,
  `empresaanterior` varchar(80) DEFAULT NULL,
  `empanttiempotrabajo` varchar(80) DEFAULT NULL,
  `empanttelefonofijo` varchar(80) DEFAULT NULL,
  `banco` varchar(80) DEFAULT NULL,
  `tipodecuenta` varchar(80) DEFAULT NULL,
  `sueldomensual` varchar(80) DEFAULT NULL,
  `otrosingresos` varchar(80) DEFAULT NULL,
  `totalingresos` varchar(80) DEFAULT NULL,
  `tarjetasdecredito` varchar(80) DEFAULT NULL,
  `origendeotrosingresos` varchar(80) DEFAULT NULL,
  `referencia1apellidos` varchar(80) DEFAULT NULL,
  `referencia1nombres` varchar(80) DEFAULT NULL,
  `referencia1parentezco` varchar(80) DEFAULT NULL,
  `referencia1telefonotrab` varchar(80) DEFAULT NULL,
  `referencia1telefonodom` varchar(80) DEFAULT NULL,
  `referencia1telcel` varchar(80) DEFAULT NULL,
  `referencia2apellidos` varchar(80) DEFAULT NULL,
  `referencia2nombres` varchar(80) DEFAULT NULL,
  `referencia2parentezco` varchar(80) DEFAULT NULL,
  `referencia2telefonotrab` varchar(80) DEFAULT NULL,
  `referencia2telefonodom` varchar(80) DEFAULT NULL,
  `referencia2telefonocel` varchar(80) DEFAULT NULL,
  `reporterecibo` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;