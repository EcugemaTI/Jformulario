<?php

defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );
jimport( 'joomla.utilities.simplexml' );
jimport( 'joomla.utilities.simplexmlelement' );

class SyscardModelSyscard extends JModel
{

var $datos;

	function getTarjetas($pStrTipo, $pStrValor, $pStrEstado)
		{

			require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');


						$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
						$pluginParams = new JParameter( $plugin->params );
						$wsdlUsuario = $pluginParams->get('usuarioWsdl');
						$wsdlClave = $pluginParams->get('passwordWsdl');
						$wsdlUri = $pluginParams->get('uriWsdl');
						$wsdlMetodo = 'mostrarTarjetas';
						$user =& JFactory::getUser();
						$this->logging(1,'model.getTarjetas','antes de consumir');

						$wsdlParametros="";
						$wsdlParametros=array(
									"UsuarioWs" => $wsdlUsuario,
									"ClaveWs" => $wsdlClave,
									"UsuarioSyscards" =>$user->name,
									"pStrTipo" =>$pStrTipo,
									"pStrvalor" =>$pStrValor,
									"pStrEstado" =>$pStrEstado

						);
						$this->logging(1,$wsdlMetodo, print_r($wsdlParametros,true));

						$result =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);

						$this->logging(1,$wsdlMetodo, 'despues de consumir');

//						$this->logging(1,$wsdlMetodo,'resultado'. print_r($arrEstadoCivil,true) );
						if(array_key_exists('info',$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]) ){
							$arrEstadoCivil=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
							$arrErrores=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
							if($arrErrores["co_error"]<>0){
								$this->logging(1,$wsdlMetodo, 'resultados:' .print_r($arrEstadoCivil,true) );
								$this->datos=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
							}
							else{

//								$this->logging(1,$wsdlMetodo, 'con unset' .print_r($arrEstadoCivil,true) );
								$this->datos = $arrEstadoCivil;
								}
						}
						else
							$this->datos = array(
									"ta_tarjeta"=>'0',
									"cl_cliente"=>'##'
									);


			return $this->datos;
	}
	function getCustomer($identificacion)
		{

			require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');


						$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
						$pluginParams = new JParameter( $plugin->params );
						$wsdlUsuario = $pluginParams->get('usuarioWsdl');
						$wsdlClave = $pluginParams->get('passwordWsdl');
						$wsdlUri = $pluginParams->get('uriWsdl');
						$wsdlMetodo = 'obtenerCliente';
						$user =& JFactory::getUser();
						$this->logging(1,'model.getCliente','antes de consumir');

						$wsdlParametros="";
						$wsdlParametros=array(
									"UsuarioWs" => $wsdlUsuario,
									"ClaveWs" => $wsdlClave,
									"UsuarioSyscards" =>$user->name,
									"pStrIdentificacion" =>$identificacion

						);
						$this->logging(1,$wsdlMetodo, print_r($wsdlParametros,true));

						$result =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);

						$this->logging(1,$wsdlMetodo, 'despues de consumir');

						if(array_key_exists('info',$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]) ){
							$arrEstadoCivil=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
							$arrErrores=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
							if($arrErrores["co_error"]<>0)
								$this->datos=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
							else{

								//$this->logging(1,$wsdlMetodo, 'con unset' .print_r($arrEstadoCivil,true) );
								$this->datos = $arrEstadoCivil;
								}
						}
						else
							$this->datos = array(
									"ta_tarjeta"=>'0',
									"cl_cliente"=>'##'
									);


			return $this->datos;
	}




	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
		jimport('joomla.error.log');
		if($p_debug==1){
			$log = &JLog::getInstance('extranet.log.php');
			$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
		}
	}


}


?>
