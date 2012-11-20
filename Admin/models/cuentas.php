<?php

defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );
jimport( 'joomla.utilities.simplexml' );
jimport( 'joomla.utilities.simplexmlelement' );

class SyscardModelCuentas extends JModel
{

var $datos;



function getCuentas(){
			require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');


			$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
			$pluginParams = new JParameter( $plugin->params );
			$wsdlUsuario = $pluginParams->get('usuarioWsdl');
			$wsdlClave = $pluginParams->get('passwordWsdl');
			$wsdlUri = $pluginParams->get('uriWsdl');
			$wsdlMetodo = 'mostrarCuentas';
			$user =& JFactory::getUser();
			$this->logging(1,'model.getCuentas','antes de consumir');

			$wsdlParametros="";
			$wsdlParametros=array(
						"UsuarioWs" => $wsdlUsuario,
						"ClaveWs" => $wsdlClave,
						"UsuarioSyscards" =>$user->name,
						"pintEmpresa" =>27,
						"pStrCatalogo" =>"EstadoCivil"

			);
			$this->logging(1,$wsdlMetodo, print_r($wsdlParametros,true));

			$result =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);

			$this->logging(1,$wsdlMetodo, 'despues de consumir');
			$this->logging(1,$wsdlMetodo, 'resultado' .print_r($result,true) );
			if(count($result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["catalogo"])){
				$arrEstadoCivil=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["catalogo"];
				$arrErrores=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
				$this->datos=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["catalogo"];
			}


			return $this->datos;
	}


	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
		jimport('joomla.error.log');
		if($p_debug==1){
			$log = &JLog::getInstance();
			$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
		}
	}


}


?>
