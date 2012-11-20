<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class adminformularioControllerFormularios extends JController
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
	function crear(){
		$DatoFormulario = $this->getModel('formulario');

		if ($DatoFormulario->grabar($post)) {
			$msg = JText::_( "Formulario grabado con exito!" );
		} else {
			$msg = JText::_( "Error grabando formulario!" );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = "index.php?option=com_formulario&task=indice&controller=formularios";
		$this->setRedirect($link, $msg);
	}
	function editar(){
		JRequest::setVar( 'view', 'formulario' );
		JRequest::setVar( 'layout', 'nuevo'  );     // <-- The default form is named here, but in
						  // some complex views, multiple layouts might
						  // be needed.
		
		parent::display();
	}	
	function actualizar(){
		$option = JRequest::getCmd('option');
		$DatoFormulario = $this->getModel('formulario');
		
		if ($DatoFormulario->grabar($post)) {

			$msg =  "Formulario grabado con exito!' ";
		} else {

			$msg = "'Error grabando formulario!' ";
		}

		// Check the table in so it can be edited.... we are done with it anyway
		//$link = "index.php?option=" . $option . "&task=indice&controller=formularios";
		//echo "index.php?option=com_formulario&task=indice&controller=formularios",$msg;
		$this->setRedirect("index.php?option=com_formulario&task=indice&controller=formularios",$msg);
	}	
	
	function borrar()
	{
		$DatoFormulario = $this->getModel('formulario');

		if ($DatoFormulario->borrar($post)) {
		
			$msg =  "Formulario borrado con exito!' ";
		} else {
		
			$msg = "'Error borrando formulario!' ";
		}
		$this->setRedirect("index.php?option=com_formulario&task=indice&controller=formularios",$msg);
	}
	function cancel()
	{
		$link = "index.php?option=com_formulario&task=indice&controller=formularios";
		$this->setRedirect($link);
	}
	function close()
	{
	$link = "index.php?option=com_formulario&task=indice&controller=formularios";
		$this->setRedirect($link);
	}

}
?>
