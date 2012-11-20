<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class adminformularioViewCampos extends JView
{


    function display($tpl = null)
    {
    $formulario_id =  JRequest::getVar('formulario_id',  0, '', '');
       JToolBarHelper::title( JText::_( 'Campos' ), 'generic.png' );
       if($formulario_id>0){
        JToolBarHelper::deleteList("¿Estás seguro de borrar el campo seleccionado?","borrar");
        JToolBarHelper::editListX('editar');
        JToolBarHelper::addNewX('nuevo');
	 // Get data from the model
        $items =& $this->get( 'Data');
	
	$data = & $this->get('DataUno','formulario');
	//$this->assignRef('formulario',$data->titulo);
	JToolBarHelper::title( JText::_( $data->titulo ), 'generic.png' );
	}
	$this->assignRef('formulario_id',$formulario_id);
        $this->assignRef( 'items', $items );
    	parent::display($tpl);
    }

}
?>