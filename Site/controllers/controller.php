<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class formularioController extends JController
{
	function display()
	{
		parent::display();
	}


	function logging($p_debug=0, $p_modulo='default',$p_mensaje){
		jimport('joomla.error.log');
		if($p_debug==1){
			$log = &JLog::getInstance('extranet.log.php');
			$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
		}
	}
	function validarUsuario(){
		$user =& JFactory::getUser();
		if ( $user->guest ) {
		  echo( 'You need to log in to use this component' );
		  return false;
		} else {
		  return true;
}
	}


}
?>
