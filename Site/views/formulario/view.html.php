<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class formularioViewformulario extends JView
{


    function display($tpl = null)
    {


	$formulario		=& $this->get('Data');
	$this->assignRef('formulario',		$formulario);
	$document =& JFactory::getDocument();
	$document ->addStyleSheet( '/components' . DS . 'com_formulario' . DS . 'css' .DS . $formulario[0]->css_nombre);
	
    	parent::display($tpl);
    }
    

}
?>
