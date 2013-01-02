<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
		require_once('solicita-tarjeta-credipyyca/class.phpmailer.php');
		require_once('configuration.php');
class formularioControllerFormulario extends JController
{
	function display()
	{

		parent::display();
	}

	function indice()
	{
		JRequest::setVar( 'view', 'formularios' );
		JRequest::setVar( 'layout', 'default'  );     // <-- The default form is named here, but in
						  // some complex views, multiple layouts might
						  // be needed.

		parent::display();
	}
	function nuevo(){
		JRequest::setVar( 'view', 'formulario' );
		JRequest::setVar( 'layout', 'nuevo'  );     // <-- The default form is named here, but in
						  // some complex views, multiple layouts might
						  // be needed.

		parent::display();

	}
	function grabar(){

		/*Grabar cada campo*/
		$DatoFormulario = $this->getModel('formulario');
		$post = JRequest::get( 'post' );
		if($post['tipodecuenta'][0])
			$post['tipodecuenta'] = implode(',',$post['tipodecuenta']);
		if( $post['tarjetasdecredito'][0] )
			$post['tarjetasdecredito'] = implode(',',$post['tarjetasdecredito']);
				if ($DatoFormulario->grabar($post)) {
					$msg = JText::_( "Formulario grabado con exito!" );
					$this->notificarPycca($post,'');
				} else {
					$msg = JText::_( "Error grabando formulario!" );
				}

				// Check the table in so it can be edited.... we are done with it anyway
				$link = "index.php";
				//$this->setRedirect($link, $msg);

	}

function grabargeneric(){

		/*Grabar cada campo*/
		$DatoFormulario = $this->getModel('formulario');
		$post = JRequest::get( 'post' );
				if ($DatoFormulario->grabar($post)) {
					$msg = JText::_( "Formulario grabado con exito!" );
				} else {
					$msg = JText::_( "Error grabando formulario!" );
				}

				// Check the table in so it can be edited.... we are done with it anyway
				$link = "index.php";
				//$this->setRedirect($link, $msg);

	}
function notificarPycca($post,$recipients){
            $exito=false;
            if(isset($post['check']))
		{
			$asunto = "Solicitud Credito Directo Internet";

			$body="DATOS PERSONALES ***************" . chr(13) . chr(10);
			$body.="Cedula: " . $post['cedula'] . chr(13) . chr(10);
			$body.="Apellido Paterno: " . $post['apellidopaterno'] . chr(13) . chr(10);
			$body.="Apellido Materno: " . $post['apellidomaterno'] . chr(13) . chr(10);
			$body.="Nombre: " . $post['nombres'] . chr(13) . chr(10);
			$body.="Sexo: " . $post['sexo'] . chr(13) . chr(10);
			$body.="Fecha de Nacimiento: " . $post['fechadenacimiento'] . chr(13) . chr(10);
			$body.="Nacionalidad: " . $post['nacionalidad'] . chr(13) . chr(10);
			$body.="Domicilio: " . $post['domicilioactual'] . chr(13) . chr(10);
			$body.="Ciudad: " . $post['ciudad'] . chr(13) . chr(10);
			$body.="Telefono fijo: " . $post['telefonofijo'] . chr(13) . chr(10);
			$body.="Telefono celular: " . $post['telefonocelular'] . chr(13) . chr(10);
			$body.="Tiempo Domicilio Actual: " . $post['tiempodomicilioactual'] . chr(13) . chr(10);
			$body.="Estado Civil: " . $post['estadocivil'] . chr(13) . chr(10);
			$body.="Vivienda: " . $post['vivienda'] . chr(13) . chr(10);
			$body.="Cedula Conyuge: " . $post['cedulaconyuge'] . chr(13) . chr(10);
			$body.="Apellido Paterno Conyuge: " . $post['apellidopaternoconyuge'] . chr(13) . chr(10);
			$body.="Apellido Materno Conyuge: " . $post['apellidomaternoconyuge'] . chr(13) . chr(10);
			$body.="Nombres Conyuge: " . $post['nombresconyuge'] . chr(13) . chr(10) . chr(13) . chr(10);

			$body.="DATOS LABORALES ******************" . chr(13) . chr(10);
			$body.="Relacion laboral: " . $post['situacion'] . chr(13) . chr(10);
			$body.="Nombre Empresa Actual: " . $post['nombreempresaactual'] . chr(13) . chr(10);
			$body.="Actividad de la Empresa: " . $post['actividadempresa'] . chr(13) . chr(10);
			$body.="Cargo: " . $post['cargo'] . chr(13) . chr(10);
			$body.="Antiguedad: " . $post['empantiguedad'] . chr(13) . chr(10);
			$body.="Direccion: " . $post['empdireccion'] . chr(13) . chr(10);
			$body.="Ciudad: " . $post['empciudad'] . chr(13) . chr(10);
			$body.="Telefono: " . $post['emptelefonofijo'] . chr(13) . chr(10);

			$body.="Profesion: " . $post['empprofesion'] . chr(13) . chr(10);
			$body.="Empresa anterior: " . $post['empresaanterior'] . chr(13) . chr(10);
			$body.="Tiempo: " . $post['empanttiempotrabajo'] . chr(13) . chr(10);
			$body.="Telefono: " . $post['empanttelefonofijo'] . chr(13) . chr(10) . chr(13) . chr(10);


			$body.="INFORMACION FINANCIERA ******************" . chr(13) . chr(10);
			$body.="Banco: " . $post['banco'] . chr(13) . chr(10);
			$body.="Tipo de cuenta: " . $post['tipodecuenta'] . chr(13) . chr(10);
			$body.="Sueldo: " . $post['sueldomensual'] . chr(13) . chr(10);
			$body.="Otros Ingresos: " . $post['otrosingresos'] . chr(13) . chr(10);
			$body.="Total Ingresos: " . $post['totalingresos'] . chr(13) . chr(10);
			$body.="Justificacion de Otros Ingresos: " . $post['origendeotrosingresos'] . chr(13) . chr(10);

			$body.="Tarjetas de cr&eacute;dito: " . $post['tarjetasdecredito'] . chr(13) . chr(10);
			
			$body.="REFERENCIAS FAMILIARES ******************" . chr(13) . chr(10);
			$body.="Apellidos: " . $post['referencia1apellidos'] . chr(13) . chr(10);
			$body.="Nombres: " . $post['referencia1nombres'] . chr(13) . chr(10);
			$body.="Parentesco: " . $post['referencia1parentezco'] . chr(13) . chr(10);
			$body.="Telefono Trabajo: " . $post['referencia1telefonotrab'] . chr(13) . chr(10);
			$body.="Telefono Domicilio: " . $post['referencia1telefonodom'] . chr(13) . chr(10);
			$body.="Telefono Celular: " . $post['referencia1telcel'] . chr(13) . chr(10);

			$body.="Apellidos: " . $post['referencia2apellidos'] . chr(13) . chr(10);
			$body.="Nombres: " . $post['referencia2nombres'] . chr(13) . chr(10);
			$body.="Parentesco: " . $post['referencia2parentezco'] . chr(13) . chr(10);
			$body.="Telefono Trabajo: " . $post['referencia2telefonotrab'] . chr(13) . chr(10);
			$body.="Telefono Domicilio: " . $post['referencia2telefonodom'] . chr(13) . chr(10);
			$body.="Telefono Celular: " . $post['referencia2telefonocel'] . chr(13) . chr(10) . chr(13) . chr(10);

			$body.="DATOS ADICIONALES ******************" . chr(13) . chr(10);
			$body.="Lugar de entrega del estado de cuenta: " . $post['reporterecibo'] . chr(13) . chr(10);
			$body.="E-mail: " . $post['email'] . chr(13) . chr(10);

			
			$strDestinatarios ="fbazurto@pycca.com"; 
	//		$strDestinatarios ="gvelasquez@pycca.com, jpaladines@pycca.com, backoffice_cc@pycca.com, mlozano@pycca.com, cmieles@pycca.com, snavarro@pycca.com";

			$destinatarios = explode(',',$strDestinatarios);
			//print_r($destinatarios);
			date_default_timezone_set('America/Guayaquil');

			
			$jconfig = new JConfig;
			$mail             = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			$mail->Host       = $jconfig->smtphost; // SMTP server
		    //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
							       // 1 = errors and messages
							       // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->Port       = $jconfig->smtpport;                    // set the SMTP port for the GMAIL server
			$mail->Username   = $jconfig->smtpuser; // SMTP account username
			$mail->Password   = $jconfig->smtppass;        // SMTP account password
	//		$mail->From($jconfig->smtpuser, 'Solicitud de Credito Directo');
			foreach($destinatarios as $destinatario)
			{
				$mail->AddAddress($destinatario, $destinatario);
			};
			$mail->Subject    = $asunto;
			$mail->IsHTML(false);
			$mail->Body = $body;
			//$mail->MsgHTML($body);

			if($mail->Send()) {
			    $exito=true;
			}
			/*********************************/
			/*****	Respuesta	*****/
			$mailr             = new PHPMailer();
			$mailr->IsSMTP(); // telling the class to use SMTP
			$mailr->Host       = $jconfig->smtphost; // SMTP server
			//$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
							       // 1 = errors and messages
							       // 2 = messages only
			$mailr->SMTPAuth   = true;                  // enable SMTP authentication
			$mailr->Port       = $jconfig->smtpport;                    // set the SMTP port for the GMAIL server
			$mailr->Username   = $jconfig->smtpuser; // SMTP account username
			$mailr->Password   = $jconfig->smtppass;        // SMTP account password
	//		$mailr->SetFrom($jconfig->smtpuser, 'Solicitud de Credito Directo');
			$strDestinatarios =  $post['email'];
			$destinatarios = explode(',',$strDestinatarios);

			foreach($destinatarios as $destinatario)
			{
				$mailr->AddAddress($destinatario, $destinatario);
			};
			$mailr->Subject    = "Almacenes PYCCA";
			$mailr->IsHTML(True);
			$mailr->AddEmbeddedImage('clubpycca.png', 'logoimg', 'clubpycca.png');
			$msgbox = "<img src=\"cid:logoimg\" />";
			$mailr->AltBody="Almacenes Pycca.";
			$body=$msgbox;
			$mailr->Body = $body;
			//$mail->MsgHTML($body);
			if(!$mailr->Send()) {
				echo "Error sending: " . $mailr->ErrorInfo;
			}

		}
	}
}
?>
