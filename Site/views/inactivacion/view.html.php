<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewInactivacion extends JView
{

var $strAjaxScript;

    function display($tpl = null)
    {
		$model =& $this->getModel();
		$this->logging(1,'InactivacionView.display', 'datos'  );
		$bajas = $model->getEstados();
		$this->assignRef('bajas',$bajas);
		$mensaje = str_replace('_',' ',JRequest::getCmd('mensaje'));
		$status = JRequest::getCmd('status');
		$this->assignRef('mensaje',$mensaje);
		$this->assignRef('status',$status);
		$this->logging(1,'InactivacionView.display', 'Asignacion de bajas' . print_r($bajas,true));

		/* añado Ajax */
		$document	= JFactory::getDocument();
		$this->insertarAjax();
		$document-> addScriptDeclaration ($this->strAjaxScript);
    	parent::display($tpl);
    }
    function logging($p_debug=0, $p_modulo='default',$p_mensaje){
			jimport('joomla.error.log');
			if($p_debug==0){
				$log = &JLog::getInstance();
				$log->addEntry(array('comment' => '[' . $p_modulo .']-' . $p_mensaje  ));
			}
	}
	function insertarAjax(){
		JHTML::_( 'behavior.mootools' );

		$this->strAjaxScript = 	<<<EOD
									function fEnableControl(){

										document.getElementById('motivo').disabled=false;
										document.getElementById('baja').disabled=false;
									};
									window.addEvent('domready', function() {
											$('btnsubmit').disabled=true;
											$('baja').disabled=true;
											$('motivo').disabled=true;
											$('09119922').innerHTML="";
											$('Numero').addEvent('keyup', function (evt) {

												busqueda();

											  
											});
											$('Numero').addEvent('keydown', function (evt) {
												if( evt.key == 'enter')
													busqueda();

											 });//evento keydown
											$('Numero').addEvent('keypress', function (evt) {
												if($('tipo').options[$('tipo').selectedIndex].value=='tarjeta')
													if($('Numero').value.length==16)
														return false;
												if($('tipo').options[$('tipo').selectedIndex].value=='ci')
													if($('Numero').value.length==13)
														return false;
												if($('tipo').options[$('tipo').selectedIndex].value=='persona')
													if($('Numero').value.length==60)
														return false;

											 });//evento keydown
											

											$('baja').addEvent('change', function () {
												$('btnsubmit').disabled=false;
											});

									});
EOD;
		return $this->strAjaxScript;
	}
}
?>
