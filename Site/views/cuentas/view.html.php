<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewCuentas extends JView
{


    function display($tpl = null)
    {

		$mensaje = str_replace('_',' ',JRequest::getCmd('mensaje'));
		$status = JRequest::getCmd('status');
		$user =& JFactory::getUser();
		$model =& $this->getModel();
		$cuentas = $model->getCuentas($user->name);

		$this->assignRef('mensaje',$mensaje);
		$this->assignRef('status',$status);
		$this->assignRef('cuentas',$cuentas);


    	parent::display($tpl);
    }

		function logging($p_debug=0, $p_modulo='default',$p_mensaje){
				jimport('joomla.error.log');
				if($p_debug==1){
					$log = &JLog::getInstance();
					$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
				}
	}
}
?>