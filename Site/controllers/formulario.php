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

		if ($DatoFormulario->grabar($post)) {
			$msg = JText::_( "Formulario grabado con exito!" );
		} else {
			$msg = JText::_( "Error grabando formulario!" );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = "index.php?option=com_formulario&view=formulario&id=" . JRequest::getVar('formulario_id',0,0,0);;
		$this->setRedirect($link, $msg);
	}
	
}
?>
