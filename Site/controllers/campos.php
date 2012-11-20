<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class adminformularioControllerCampos extends JController
{
	function display()
	{

		parent::display();
	}

	function indice()
	{

		$formulario_id = JRequest::getCmd( 'formulario_id', '' );
		/*Estableciendo modelos para trabajar con el ombre del formulario*/
		$view = & $this->getView( 'campos', 'html' );
		$view->setModel( $this->getModel( 'campos' ), true );
		$view->setModel( $this->getModel( 'formulario' ) );


		JRequest::setVar('formulario_id',$formulario_id);
		JRequest::setVar( 'view', 'campos' );
		JRequest::setVar( 'layout', 'default'  );     // <-- The default form is named here, but in
						  // some complex views, multiple layouts might
						  // be needed.
		$view->display();
		//parent::display();
	}
	function nuevo(){
		JRequest::setVar( 'view', 'campo' );
		JRequest::setVar( 'layout', 'nuevo'  );
		$view = & $this->getView( 'campo', 'html' );
		$view->setModel( $this->getModel( 'campos' ), true );
		$view->setModel( $this->getModel( 'formulario' ) );
		$view->setLayout('nuevo');
		$view->display();
		//parent::display();

	}
	function crear(){

		$DatoCampo = $this->getModel('campo');

		if ($DatoCampo->grabar($post)) {
			$msg = JText::_( "Campo grabado con exito!" );
		} else {
			$msg = JText::_( "Error grabando campo!" );
		}
		$array = JRequest::get( 'post' );
		$formulario_id = $array["formulario_id"];
		// Check the table in so it can be edited.... we are done with it anyway
		$link = "index.php?option=com_formulario&task=indice&controller=campos&formulario_id=" . $formulario_id;
		$this->setRedirect($link, $msg);
	}
	function editar(){

		$view = & $this->getView( 'campo', 'html' );
		$view->setModel( $this->getModel( 'campo' ), true );
		$view->setModel( $this->getModel( 'formulario' ) );
		$view->setLayout('nuevo');

		$view->display();
		//parent::display();
	}
	function actualizar(){
		$option = JRequest::getCmd('option');
		$formulario_id = JRequest::getVar('formulario_id',0,'','');
		$DatoFormulario = $this->getModel('campo');

		if ($DatoFormulario->grabar($post)) {

			$msg =  "Campo actualizado con exito!' ";
		} else {

			$msg = "'Error actualizando formulario!' ";
		}

		// Check the table in so it can be edited.... we are done with it anyway
		//$link = "index.php?option=" . $option . "&task=indice&controller=formularios";
		//echo "index.php?option=com_formulario&task=indice&controller=formularios",$msg;
		$this->setRedirect("index.php?option=com_formulario&task=indice&controller=campos&formulario_id=" . $formulario_id,$msg);
	}

	function borrar()
	{
		$DatoFormulario = $this->getModel('campo');

		if ($DatoFormulario->borrar($post)) {

			$msg =  "Campo borrado con exito!' ";
		} else {

			$msg = "'Error borrando formulario!' ";
		}
		$formulario_id = JRequest::getCmd( 'formulario_id', '' );
		$this->setRedirect("index.php?option=com_formulario&task=indice&controller=campos&formulario_id=" . $formulario_id,$msg);
	}
   function cancel()
   	{
   	$link = "index.php?option=com_formulario&task=indice&controller=campos&formulario_id=" . JRequest::getVar('formulario_id',0,'','');
   		$this->setRedirect($link);
   	}
   	function close()
   	{
   	$link = "index.php?option=com_formulario&task=indice&controller=campos&formulario_id=" . JRequest::getVar('formulario_id',0,'','');
   		$this->setRedirect($link);
	}


}
?>
