<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewSaldosmovimientos extends JView
{

var $strAjaxScript;

    function display($tpl = null)
    {
		$mensaje = str_replace('_',' ',JRequest::getCmd('mensaje'));
		$status = JRequest::getCmd('status');
		$this->assignRef('mensaje',$mensaje);
		$this->assignRef('status',$status);
		$default = array('movimientos'=>'zipperblues');
		$movimientos= JRequest::get('movimientos',$default);
		$tarjeta= JRequest::getVar('tarjeta','N');
		if(array_key_exists('movimientos',$movimientos))
			$movimientos=$movimientos['movimientos'];
		else
			$movimientos=$default;
			
		$this->assignRef('movimientos',$movimientos);
		$this->assignRef('tarjeta',$tarjeta);

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
									function fEnableControl (){
										$('btnsubmit').disabled=false;
									}
									window.addEvent('domready', function() {
											$('btnsubmit').disabled=true;
											$('09119922').innerHTML="";
											if($('tipo').options[$('tipo').selectedIndex].value=='0')
                                                                                        	$('btnsubmit').disabled=false;
                                                                                        else
                                                                           		        $('btnsubmit').disabled=true;


											$('Numero').addEvent('keydown', function (evt) {
											if( evt.key == 'enter' && $('tipo').options[$('tipo').selectedIndex].value!='0' ){ 
												if(this.value.length>0){
													$('btnsubmit').disabled=true;
													$('contenedor').addClass('ajax-loading');
													$('contenedor').innerHTML ="Consultando espere unos minutos...";
													var valorTipo = $('tipo').options[$('tipo').selectedIndex].value;
													var a = new Ajax('index.php?option=com_syscards&no_html=1&task=consultarTarjetas',
													{
														method: 'post',
														data:   'tipo=' + valorTipo + '&txtIdn=' + this.value + '&estado=',
														onComplete: function(response){
														var resp = Json.evaluate(response);
														$('contenedor').removeClass('ajax-loading').setHTML("");

														$('contenedor').innerHTML ="";
														$('btnsubmit').disabled=true;
														if(resp.ta_tarjeta=='0')
															$('contenedor').innerHTML ="0 registro(s) encontrado(s), vuelva a consultar.<br>";
														else {
															if(resp.length>1)
															{
																for(var i=0;i<resp.length;i++){
																	$('contenedor').innerHTML+="<input name='tarjeta' id= 'tarjeta' type='radio'  onclick=\"fEnableControl();\" value='" + resp[i].ta_tarjeta + "'>" + resp[i].ta_tarjeta + "," + resp[i].cl_cliente + "," + resp[i].cl_identifica + "<br>";
																}
															}
															else
															{
																	$('contenedor').innerHTML+="<input name='tarjeta' id= 'tarjeta' type='radio'  onclick=\"fEnableControl();\" value='" + resp.ta_tarjeta + "'>" + resp.ta_tarjeta + "," + resp.cl_cliente + "," + resp.cl_identifica + "<br>";
															}
														}
														$('contenedor').innerHTML+="<hr>";
														}
													}).request();
												}
											  }//if evento keydown
											});
											$('tipo').addEvent('change', function () {
												$('contenedor').innerHTML="";
												$('Numero').value="";

												if(this.options[this.selectedIndex].value=='0')		
													$('btnsubmit').disabled=false;
												else				
													$('btnsubmit').disabled=true;
											});


									});
EOD;
		return $this->strAjaxScript;
	}
}
?>
