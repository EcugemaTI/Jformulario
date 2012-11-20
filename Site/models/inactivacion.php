<?php

defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );
jimport( 'joomla.utilities.simplexml' );
jimport( 'joomla.utilities.simplexmlelement' );

class SyscardModelInactivacion extends JModel
{

var $datos;
var $order_id;


	function getEstados($pStrTipo='T')
	{
		$this->logging(1,'model.getEstados', 'ingresa a getEstados()' );
			require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');

			//Si es cuenta hay que mostrar y preguntarle si desea realizar activacion de cada una de las tarjetas.
			//sino
			//recupero datos de soap
			$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
			$pluginParams = new JParameter( $plugin->params );
			$wsdlUsuario = $pluginParams->get('usuarioWsdl');
			$wsdlClave = $pluginParams->get('passwordWsdl');
			$wsdlUri = $pluginParams->get('uriWsdl');
			$wsdlMetodo = 'mostrarEstados';

			$this->logging(1,'model.getEstados','antes de consumir');

			$wsdlParametros="";
			$wsdlParametros=array(
						"UsuarioWs" => $wsdlUsuario,
						"ClaveWs" => $wsdlClave,
						"pStrTipoEstado" =>$pStrTipo

			);
			$this->logging(1,'model.getEstados', print_r($wsdlParametros,true));

			$result =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);

			$this->logging(1,'model.getEstados', 'despues de consumir');
			$this->logging(1,'model.getEstados', 'resultado' .print_r($result,true) );

			$arrErrores=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
			$this->datos=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["estados"];
			$this->logging(1,'model.getEstados', 'result:' . print_r($result,true) );

			return $this->datos;
		}
	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
			jimport('joomla.error.log');
			if($p_debug==0){
				$log = &JLog::getInstance();
				$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
			}
	}

}


?>
