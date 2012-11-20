<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class adminformularioViewFormularios extends JView
{


    function display($tpl = null)
    {
       JToolBarHelper::title( JText::_( 'Formularios' ), 'generic.png' );
        JToolBarHelper::deleteList("¿Estás seguro de borrar el siguiente formulario?","borrar");
        JToolBarHelper::editListX('editar');
        JToolBarHelper::addNewX('nuevo');
	 // Get data from the model
        $items =& $this->get( 'Data');
 
        $this->assignRef( 'items', $items );
    	parent::display($tpl);
    }

}
?>