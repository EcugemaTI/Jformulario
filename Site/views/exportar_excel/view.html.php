<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewExportar_excel extends JView
{


    function display($tpl = null)
    {


		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
		//encero variables que se envian al tpl
		$nombre = "";
		$saldototal = 0;
		$saldodiferido=0;
		$saldorotativo=0;
		$movimientos = "";


  		//recupero datos para activar inactivar
  		$option = JRequest::getCmd('option');
  		$tarjeta = JRequest::getCmd('tarjeta');
  		$empresa = JRequest::getCmd('empresa');
  		$cuenta = JRequest::getCmd('cuenta');
  		$mes = JRequest::getCmd('mes');
		$anio = substr(JRequest::getCmd('anio'),-2);
		$user =& JFactory::getUser();
		$periodo = $anio . $mes;


		/* Movimientos */

		$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
		$pluginParams = new JParameter( $plugin->params );
		$wsdlUsuario = $pluginParams->get('usuarioWsdl');
		$wsdlClave = $pluginParams->get('passwordWsdl');
		$wsdlUri = $pluginParams->get('uriWsdl');
		$wsdlMetodo = 'mostrarMovimientos';
		$wsdlParametros="";
		$wsdlParametros=array(
				"UsuarioWs" => 'test',
				"ClaveWs" => 'test',
				"UsuarioSyscards" => $user->name,
				"pIntEmpresa" => 27,
				"pStrCuenta" =>$cuenta,
				"pStrPeriodo" =>$periodo,
				"pStrTranDeHoy" =>'S'
		);

		$this->logging(1,$wsdlMetodo , 'PARAMETROS' .  print_r($wsdlParametros,true));

		$result2 =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);
		$this->logging(1,$wsdlMetodo , 'PARAMETROS' .  print_r($result2,true));
		if(array_key_exists('info',$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
		{
			$arrErrores	=$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
			$movimientos		=$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
			$this->logging(1,$wsdlMetodo, 'Movimientos:' .  print_r($movimientos,true));

		}
		$fecha_de_pago = date('y-m-d');
		$this->assignRef('movimientos',$movimientos);

	/* Movmientos procesados */
		$wsdlParametros=array(
				"UsuarioWs" => 'test',
				"ClaveWs" => 'test',
				"UsuarioSyscards" => $user->name,
				"pIntEmpresa" => 27,
				"pStrCuenta" =>$cuenta,
				"pStrPeriodo" =>$periodo,
				"pStrTranDeHoy" =>'S'
		);

		$this->logging(1,$wsdlMetodo , 'MOV PROCESADOS' .  print_r($wsdlParametros,true));

		$result3 =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);
		$this->logging(1,$wsdlMetodo , 'PARAMETROS' .  print_r($result3,true));
		if(array_key_exists('info',$result3[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
		{
			$arrErrores	=$result3[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
			$movimientos_p		=$result3[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
			$lineas = count($result3[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"]);
			$this->logging(1,$wsdlMetodo, 'Movimientos procesados:' .  print_r($movimientos,true));

		}
		$this->assignRef('movimientos_p',$movimientos_p);

		/* añado Ajax */
		$document	= JFactory::getDocument();
		$this->insertarAjax();
		$document-> addScriptDeclaration ($this->strAjaxScript);

    	parent::display($tpl);
    }

	function insertarAjax(){
		JHTML::_( 'behavior.mootools' );

		$this->strAjaxScript = 	<<<EOD

									window.addEvent('domready', function() {

											$('09119922').innerHTML="";

									});
EOD;
		return $this->strAjaxScript;
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