<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class adminformularioViewCampo extends JView
{


    function display($tpl = null)
    {

		
	//get the hello
	$campo		=& $this->get('Data');
	//print_r($campo);
	$esNuevo		= ($campo->id < 1);
	
	$formulario_id	= JRequest::getVar('formulario_id',  0, '', '');
	$text = $esNuevo ? JText::_( 'new' ) : JText::_( 'edit' );
	JToolBarHelper::title(   JText::_( 'XXXXX' ).' ' .JText::_( 'Campos' ).': <small><small>[ ' . $text.' ]</small></small>' );	
	

	if ($esNuevo)  {
		JToolBarHelper::save('crear');
	}else{
		JToolBarHelper::save('actualizar');
		}
	if ($esNuevo)  {
		JToolBarHelper::cancel('cancel');
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	if($formulario_id>0)
	{
		$data = & $this->get('DataUno','formulario');
		$text = JText::_( $data->titulo ) . ' : <small><small>[ ' . $text.' campo ]</small></small>' ;
		JToolBarHelper::title( $text);
	}

	$this->assignRef('campo',		$campo);
	 $this->assignRef('formulario_id',		$formulario_id);
 
    	parent::display($tpl);
    }
}
?>
