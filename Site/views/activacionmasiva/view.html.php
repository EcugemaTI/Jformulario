<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewActivacionmasiva extends JView
{


    function display($tpl = null)
    {
	$this->validarUsuario();
	$mensaje= JRequest::get('outputs','1');
//	$mensaje = 's';
	$this->assignRef('mensaje',$mensaje['outputs']);
	$doc =& JFactory::getDocument();
	$doc->addStyleSheet( JPATH_SITE .DS.'components/com_syscards/css'.DS.'syscards.css' );
    	parent::display($tpl);
    }
	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
				jimport('joomla.error.log');
				if($p_debug==1){
					$log = &JLog::getInstance();
					$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
				}
	}
	function validarUsuario(){
		$user =& JFactory::getUser();
		if ( $user->guest ) {
		  echo( 'You need to log in to use this component' );
		  die();
		  return false;
		} else {
		  return true;
}
	}
}
?>
