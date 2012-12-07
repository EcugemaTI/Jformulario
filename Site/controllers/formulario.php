<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

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
		$post['tipodecuenta'] = implode(',',$post['tipodecuenta']);
		$post['tarjetasdecredito'] = implode(',',$post['tarjetasdecredito']);
				if ($DatoFormulario->grabar($post)) {
					$msg = JText::_( "Formulario grabado con exito!" );
				} else {
					$msg = JText::_( "Error grabando formulario!" );
				}

				// Check the table in so it can be edited.... we are done with it anyway
				$link = "index.php";
				$this->setRedirect($link, $msg);

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

}
?>
