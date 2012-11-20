<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once( JPATH_COMPONENT.DS.'controllers'.DS.'controller.php' );




if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

$user =& JFactory::getUser();
		if ( $user->guest ) {
		  echo( 'You need to log in to use this component' );
		  die();
		  return false;
		} else {



$classname    = 'formularioController'.$controller;
$controller   = new $classname( );

$controller->execute( JRequest::getVar( 'task' ) );

$controller->redirect();
}
?>
