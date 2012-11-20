<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class formularioController extends JController
{
	function display()
	{
		parent::display();
	}

	function activacion()
	{
		$this->logging(1,'activacion','entrando');
		parent::display();
		$this->logging(1,'activacion','despues de display');
	}
	function activacion_resultado(){



		parent::display();
	}
	function activacion_proceso($identificacion='',$apellidos='',$nombres='',$cupo='',$tarjeta='',$tipo_iden='',$retorno=0){

  		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
		$this->validarUsuario();

  		//recupero datos para activar inactivar
  		$option = JRequest::getCmd('option');
		if($identificacion=='')
	  		$identificacion = JRequest::getCmd('identificacion');
		if($apellidos=='')
	  		$apellidos = $_POST['apellidos'];
		if($nombres=='')
	  		$nombres = $_POST['nombres'];
  		$fnacimiento = JRequest::getCmd('fnacimiento');
  		$sexo = JRequest::getCmd('sexo');
  		$estadocivil = JRequest::getCmd('estadocivil');
  		$nacionalidad = JRequest::getCmd('nacionalidad');
  		$situacion = JRequest::getCmd('situacion');
  		$plastico = $_POST['plastico'];//JRequest::getCmd('plastico');
		if($cupo=='')
			$cupo = JRequest::getCmd('cupo');
		if($tarjeta=='')
	  		$tarjeta = JRequest::getCmd('tarjeta');
		if($tipo_iden=='')
	  		$tipo_iden = JRequest::getCmd('tipo_iden');

		$this->logging(1,'activacion_proceso', 'opcion=' . $option);
		$this->logging(1,'activacion_proceso', 'identificacion=' . $identificacion);
		$this->logging(1,'activacion_proceso', 'apellidos=' . $apellidos);
		$this->logging(1,'activacion_proceso', 'nombres=' . $nombres);
		$this->logging(1,'activacion_proceso', 'fnacimiento=' . $fnacimiento);
		$this->logging(1,'activacion_proceso', 'sexo=' . $sexo);
		$this->logging(1,'activacion_proceso', 'estadocivil=' . $estadocivil);
		$this->logging(1,'activacion_proceso', 'nacionalidad=' . $nacionalidad);
		$this->logging(1,'activacion_proceso', 'situacion=' . $situacion);
		$this->logging(1,'activacion_proceso', 'tarjeta=' . $tarjeta);
		$this->logging(1,'activacion_proceso', 'tipo_iden=' . $tipo_iden);
		$this->logging(1,'activacion_proceso', 'plastico=' . $_POST['plastico']);
		$this->logging(1,'activacion_proceso', 'plastico=' . $plastico);

  		//Si es cuenta hay que mostrar y preguntarle si desea realizar activacion de cada una de las tarjetas.
  		//sino
  		//recupero datos de soap

		$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
		$pluginParams = new JParameter( $plugin->params );
		$wsdlUsuario = $pluginParams->get('usuarioWsdl');
		$wsdlClave = $pluginParams->get('passwordWsdl');
		$wsdlUri = $pluginParams->get('uriWsdl');
		$wsdlMetodo = 'setActivo';
		$user =& JFactory::getUser();
		$this->logging(1,$wsdlMetodo,'antes de consumir');
		$wsdlParametros="";
		$wsdlParametros=array(
					"UsuarioWs" => $wsdlUsuario,
					"ClaveWs" => $wsdlClave,
					"UsuarioSyscards" => $user->name,
					"pStrEmpresa" =>'27',
					"pStrIden" =>$identificacion,
					"pStrApellidos" =>$apellidos,
					"pStrNombres" =>$nombres,
					"pStrFechaNac" =>$fnacimiento,
					"pStrSituacion" => $situacion,
					"pstrNacionalidad" =>$nacionalidad ,
					"pStrEstadoCivil" =>$estadocivil,
					"pStrSexo" =>$sexo,
					"pStrTarjeta" =>$tarjeta,
					"pIntCupo" => $cupo,
					"tipo_iden"=>$tipo_iden,
					"pStrPlastico"=>$plastico

		);
		$this->logging(1,$wsdlMetodo, print_r($wsdlParametros,true));

		$result =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);

		$this->logging(1,$wsdlMetodo, 'despues de consumir');
		$this->logging(1,$wsdlMetodo, 'resultado' .print_r($result,true) );

		if(array_key_exists('error1',$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
			{
				$errores="";
				$arrErrores=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["error1"];
				$arrErrores2=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["error2"];
				//$arrErrores3=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["error3"];
				if($arrErrores["Column3"]!='+')
					$errores = $arrErrores["Column1"];
				if(array_key_exists("Column1",$arrErrores2))
						$errores .= '<br>' . $arrErrores2["Column1"];

				$this->logging(1,'activacion_proceso', 'errores' . print_r($arrErrores,true) );
				$errores = str_replace(' ','_',$errores);
				if(strlen($errores)>0)
					if($retorno==1)
						return $errores;
					else
						$this->setRedirect('mnuopactivacion?mensaje=' . $errores . '&status=falla' );
				else
					if($retorno==1)
						return 'OK';
					else
						$this->setRedirect('mnuopactivacion?mensaje=Se_ha_activado_correctamente: ' . $tarjeta . ' &status=exito' );
			}
		else{
			if($retorno==1)
				return 'Ha ocurrido un error.';
			else
				$this->setRedirect('mnuopactivacion?mensaje=Ha_ocurrido_un_error_ver_log&status=falla' );
		}



	}
	function consultar_movimientos(){

  		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
  		$this->validarUsuario();
  		$option = JRequest::getCmd('option');
		//Trae tarjeta? 
  		$tarjeta = JRequest::getCmd('tarjeta');
  		$fecha_inicio = JRequest::getCmd('fecha_inicio');
  		$fecha_fin = JRequest::getCmd('fecha_fin');
		$excel = JRequest::getCmd('no_html');
		$datos = JRequest::get('post');
		if($tarjeta=='Array')
			$tarjetas = $datos['tarjeta'];
		else
			$tarjetas = array(
					0 =>$tarjeta);

		/* WSDL */
                $plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
                $pluginParams = new JParameter( $plugin->params );
                $wsdlUsuario = $pluginParams->get('usuarioWsdl');
                $wsdlClave = $pluginParams->get('passwordWsdl');
                $wsdlUri = $pluginParams->get('uriWsdl');
                $wsdlMetodo = 'mostrarMovimientos';
                $wsdlParametros="";
		$user =& JFactory::getUser();
		$i=0;
		$movimientos = array();
		$total = 0;
		foreach($tarjetas as $card){
			//$fecha_inicio="03/05/2012";
			//$fecha_fin="03/05/2012";
			$wsdlParametros=array(
				"UsuarioWs" => $wsdlUsuario,
				"ClaveWs" => $wsdlClave,
				"UsuarioSyscards" =>$user->name,
				"pIntEmpresa" =>27,
				"pStrTarjeta" =>$card,
				"pstrFechaInicio" =>$fecha_inicio,
				"pstrFechaFin" => $fecha_fin
			);
		
			//$this->logging(1,$wsdlMetodo , 'Parametros' .  print_r($wsdlParametros,true));
                	$result2 =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);
                	$this->logging(1,$wsdlMetodo , 'Resultado' .  print_r($result2,true));
                	if(array_key_exists('info',$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
                	{
                        	$arrErrores     =$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
	                        $movimientos[$i]    = $result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
				$i++;
	                }
		}// foreach
		$this->logging(1,$wsdlMetodo, 'DataSet completo de movimientos:' .  print_r($movimientos,true));

       		JRequest::setVar('view','saldosmovimientos');
       		JRequest::setVar('layout','movimientos_resultado');
       		JRequest::setVar('movimientos',$movimientos);
		if($excel=="1")
       			JRequest::setVar('layout','excel_movimientos_resultado');
		
		parent::display();


	}
	function obtenerTarjetaPrincipal(){
		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
		$user =& JFactory::getUser();

                /* WSDL */
                $plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
                $pluginParams = new JParameter( $plugin->params );
                $wsdlUsuario = $pluginParams->get('usuarioWsdl');
                $wsdlClave = $pluginParams->get('passwordWsdl');
                $wsdlUri = $pluginParams->get('uriWsdl');
                $wsdlMetodo = 'mostrarTarjetaPrincipal';
                $wsdlParametros="";
                //$fecha_inicio="03/05/2012";
                //$fecha_fin="03/05/2012";
                $wsdlParametros=array(
                                "UsuarioWs" => 'test',
                                "ClaveWs" => 'test',
                                "UsuarioSyscards" =>$user->name
                );

                $this->logging(1,$wsdlMetodo , 'Parametros' .  print_r($wsdlParametros,true));
                $movimientos="";
                $result2 =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);
                $this->logging(1,$wsdlMetodo , 'PARAMETROS' .  print_r($result2,true));
		$tarjeta ="";
                if(array_key_exists('info',$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
                {
                        $arrErrores     =$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
			$tarjeta    =$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
			$tarjeta = $tarjeta["ta_tarjeta"];
		}	
		return $tarjeta;	
	}
	function consultar_saldo(){
  		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
  		$this->validarUsuario();
  		$option = JRequest::getCmd('option');
		//Trae tarjeta? 
  		$tarjeta = JRequest::getCmd('tarjeta');
		$excel = JRequest::getCmd('no_html');
		$datos = JRequest::get('post');
                if($tarjeta=='Array')
                        $tarjetas = $datos['tarjeta'];
                else
                        $tarjetas = array(
                                        0 =>$tarjeta);

		if($tarjeta==""){
			$tarjeta = $this->obtenerTarjetaPrincipal();
	     		JRequest::setVar('tarjeta','N');		
			$tarjetas = array( 0 =>$tarjeta);
		}
		else
	       		JRequest::setVar('tarjeta','S');		

		/* WSDL Saldos*/
                $plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
                $pluginParams = new JParameter( $plugin->params );
                $wsdlUsuario = $pluginParams->get('usuarioWsdl');
                $wsdlClave = $pluginParams->get('passwordWsdl');
                $wsdlUri = 'http://webpycca:8610/wsWebsiteDefinitivo/wsWebsite.asmx?WSDL'; //$pluginParams->get('uriWsdl');
                $wsdlMetodo = 'getSaldoTarjeta';
                $wsdlParametros="";
		//$fecha_inicio="03/05/2012";
		//$fecha_fin="03/05/2012";

		$user =& JFactory::getUser();
                $i=0;
                $movimientos = array();
                $total = 0;
                foreach($tarjetas as $card){
			$wsdlParametros=array(
				"usuario" => 'test',
				"clave" => 'test' ,
				"tarjeta" =>$card
			);
                	$result2 =  JPyccaWsdl::consumir($wsdlUri,$wsdlMetodo,$wsdlParametros);
                	if(array_key_exists('info',$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]))
                	{
                        	$arrErrores     =$result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["errores"];
				$movimientos[$i]    = $result2[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
				$this->logging(1,$wsdlMetodo , 'mov' .  print_r($movimientos[$i],true));
                                $i++;
                	}
		}//foreach

       		JRequest::setVar('view','saldosmovimientos');
       		JRequest::setVar('layout','saldos_resultado');
       		JRequest::setVar('movimientos',$movimientos);
		if($excel=="1")
       		JRequest::setVar('layout','excel_saldos_resultado');
		
		parent::display();


	}

	function inactivacion_proceso(){

	require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');

			$this->validarUsuario();
	  		//recupero datos para activar inactivar

	  		$option = JRequest::getCmd('option');
	  		$tipo_activacion = JRequest::getCmd('tipo');
	  		$tarjeta = JRequest::getCmd('tarjeta');
	  		$baja = JRequest::getCmd('baja');/* 0->estado,1->subestado	*/
	  		$motivo = JRequest::getCmd('motivo');

			$this->logging(1,'inactivacion_proceso', 'opcion=' . $option);
			$this->logging(1,'inactivacion_proceso', 'tipo_activacion=' . $tipo_activacion);
			$this->logging(1,'inactivacion_proceso', 'tarjeta=' . $tarjeta);
			$this->logging(1,'inactivacion_proceso', 'baja=' . print_r($baja,true));
			$this->logging(1,'inactivacion_proceso', 'baja=' . $baja);
			$this->logging(1,'inactivacion_proceso', 'motivo=' . $motivo);


			$plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
			$pluginParams = new JParameter( $plugin->params );
			$wsdlUsuario = $pluginParams->get('usuarioWsdl');
			$wsdlClave = $pluginParams->get('passwordWsdl');
			$wsdlUri = $pluginParams->get('uriWsdl');
			$wsdlMetodo = 'activacion';
			$user =& JFactory::getUser();
			$this->logging(1,'inactivacion_proceso','antes de consumir');
			$wsdlParametros="";
			$wsdlParametros=array(
						"UsuarioWs" => $wsdlUsuario,
						"ClaveWs" => $wsdlClave,
						"UsuarioSyscards" => $user->name,
						"pStrTipo" =>'persona',//$tipo_activacion,
						"pStrNumero" =>$tarjeta,
						"pStrAccion" =>'I',
						"pStrMotivo" =>$motivo,
						"pIntEstado" =>$baja[0],
						"pIntSubEstado" => $baja[1]

			);
			$this->logging(1,'inactivacion_proceso', 'Enviando WS:' . $wsdlMetodo);
			$this->logging(1,'inactivacion_proceso', 'PARAMETROS:' . print_r($wsdlParametros,true));

			$result =  JPyccaWsdl::consumir($wsdlUri,'activacion',$wsdlParametros);
			if(is_array($result))
			{
				$this->logging(1,'inactivacion_proceso', 'despues de consumir');
				$this->logging(1,'inactivacion_proceso', 'resultado' .print_r($result,true) );

				$arrErrores=$result["activacionResult"]["diffgram"]["NewDataSet"]["errores"];
				$this->logging(1,'inactivacion_proceso', 'errores' . print_r($arrErrores,true) );
				$arrErrores["DescripcionError"] = str_replace(' ','_',$arrErrores["DescripcionError"]);
				if($arrErrores["CodigoError"]<>0)
					$this->setRedirect('mnuopinactivacion?mensaje=' . $arrErrores["DescripcionError"] . '&status=falla' );
				else
					$this->setRedirect('mnuopinactivacion?mensaje=Se_ha_inactivado_correctamente:' . $tarjeta . ' &status=exito' );
			}
			else
					$this->setRedirect('mnuopinactivacion?mensaje=Ha_ocurrido_un_error_ver_log&status=falla' );

	}

	/*	$this->consultarTarjetas() */
	/*********************************************************************/
	/*	Realiza consulta de las tarjetas que pertenecen a una cedula.*/
	/********************************************************************/
	function consultarTarjetas(){
	    	$datos = null;
	    	include(JPATH_COMPONENT. DS . 'lib' . DS . "json.class.php");

	    	$tipo_consulta = JRequest::getCmd('tipo');
  		$idn = JRequest::getCmd('txtIdn');
  		$estado = JRequest::getCmd('estado');
		$modelo = $this->getModel('syscard');
	        $datos = $modelo->getTarjetas($tipo_consulta,$idn,$estado);
		if(count($datos)){
		        $json = new JSON;
			echo json_encode($datos );
		}
	}

        /* CONSULTA DE CLIENTE */
        /*******************/

	function obtenerCus(){
	    	$datos = null;
	    	include(JPATH_COMPONENT. DS . 'lib' . DS . "json.class.php");

  		$idn = JRequest::getCmd('txtIdn');
		$modelo = $this->getModel('syscard');
	        $datos = $modelo->getCustomer($idn);
		if(count($datos)){
		        $json = new JSON;
			echo json_encode($datos );
		}
	}
	
	/* ACTIVACION BULK */
	/*******************/
	/* requisitos: el archivo debe ser excel */
	function activacion_masiva(){
		require_once(JPATH_ROOT . DS . 'libraries' . DS .'joomla' . DS . 'utilities' . DS . 'jpyccawsdl.php');
		error_reporting(E_ALL ^ E_NOTICE);
	        $tmp_name = $_FILES["archivo"]["tmp_name"];
        	$name = $tmp_name; //$_FILES["archivo"]["name"];
	        jimport('excel.reader');
        	$datos = new Spreadsheet_Excel_Reader();
	        $datos->read($name);
        	$celdas = $datos->sheets[0]['cells'];
		$output=array();
	        $i=2;
        	while(array_key_exists($i,$celdas))
	        {
			try{
				if(!array_key_exists(1,$celdas[$i]))
					$celdas[$i][1] = "######t";

				if(!array_key_exists(2,$celdas[$i]))
					$celdas[$i][2] = "######i";

				if(!array_key_exists(3,$celdas[$i]))
					$celdas[$i][3] = "######c";

				if(!array_key_exists(4,$celdas[$i]))
					$celdas[$i][4] = "######n";

				if(!array_key_exists(5,$celdas[$i]))
					$celdas[$i][5] = "######a";

				if(!array_key_exists(6,$celdas[$i]))
					$celdas[$i][6] = "######m";

		                $this->logging(1,'activacion_masiva','antes de consumir' . print_r($celdas,true));
					$output[$i] = array(
					$celdas[$i][1]=>"tarjeta",
					$celdas[$i][2] =>"tipo",
					$celdas[$i][3] =>"cedula",
					$celdas[$i][4]=>"nombre",
					$celdas[$i][5]=>"apellidos" ,
					$celdas[$i][6]=>"monto"
					) ;
			}
			catch(Exception $ex){
		                $this->logging(1,'activacion_masiva',$ex->getMessage());				
			}

	                $i++;
        	}
		$xml = new SimpleXMLElement('<root/>');
		array_walk_recursive($output, array ($xml, 'addChild'));
              	$this->logging(1,'activacion_masiva', 'array:' . print_r($output,true));
                $plugin =& JPluginHelper::getPlugin('authentication', 'pyccasyscard');
                $pluginParams = new JParameter( $plugin->params );
                $wsdlUsuario = $pluginParams->get('usuarioWsdl');
                $wsdlClave = $pluginParams->get('passwordWsdl');
                $wsdlUri = $pluginParams->get('uriWsdl');
                $wsdlMetodo = 'activacion_masiva';
                $user =& JFactory::getUser();
                $this->logging(1,'activacion_masiva','antes de consumir');
                $wsdlParametros="";
                $wsdlParametros=array(
                                          "UsuarioWs" => $wsdlUsuario,
                                                "ClaveWs" => $wsdlClave,
                                                "UsuarioSyscards" => $user->name,
                                                "pDataT" =>$xml->asXML()
                        );
		$activacion="";
                $result =  JPyccaWsdl::consumir($wsdlUri,'activacion_masiva',$wsdlParametros);
		 $this->logging(1,'tarjetas xml',$xml->asXML());
		$this->logging(1,'activacion_masiva', $wsdlUri);
                if(is_array($result)){
//                	$this->logging(1,'activacion_masiva', 'PARAMETROS:' . print_r($result,true));
			$activacion=$result[$wsdlMetodo . "Result"]["diffgram"]["NewDataSet"]["info"];
		}


		JRequest::setVar('view','activacionmasiva');
		JRequest::setVar('no_html',0);
		JRequest::setVar('layout','default');
		JRequest::setVar('hidemainmenu',1);
		JRequest::setVar('outputs',$activacion);
                parent::display();

	}

	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
		jimport('joomla.error.log');
		if($p_debug==1){
			$log = &JLog::getInstance('extranet.log.php');
			$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
		}
	}
	function validarUsuario(){
		$user =& JFactory::getUser();
		if ( $user->guest ) {
		  echo( 'You need to log in to use this component' );
		  return false;
		} else {
		  return true;
}
	}


}
?>
