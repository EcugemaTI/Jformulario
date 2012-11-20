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
		$fecha_inicio = JRequest::getCmd('fecha_inicio');
		$fecha_fin = JRequest::getCmd('fecha_fin');

		$this->assignRef('mensaje',$mensaje);
		$this->assignRef('status',$status);
		$default = array(0=>array(0=>array('fecha'=>'',
									'dt_tarjeta'=>'',
									'descripcion'=>'',
									'tt_abreviatura'=>'',
									'cl_identifica'=>'',
									'nombre'=>'',
									'dt_total'=>0)));
		$movimientos= JRequest::get('movimientos',$default);
		$tarjeta= JRequest::getVar('tarjeta','N');
		if(array_key_exists('movimientos',$movimientos))
			$movimientos=$movimientos['movimientos'];
		else
			$movimientos=$default;
		//print_r($movimientos);	
		$this->assignRef('fecha_inicio',$fecha_inicio);
		$this->assignRef('fecha_fin',$fecha_fin);
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
						$('btnsubmit').disabled=true;
						$$('.check-me').each(function(el) { 
							if(el.checked==true) 
								$('btnsubmit').disabled=false;
						});
					}
					window.addEvent('domready', function() {
						 Element.implement({
                                                        //implement show
                                                            show: function() {
                                                              this.setStyle('display','');
                                                            },
                                                        //implement hide
                                                            hide: function() {
                                                              this.setStyle('display','none');
                                                            }
                                                          });

						$('btnsubmit').disabled=true;
						$('09119922').innerHTML="";
						$('Numero').hide();
						/* Valida si ha seleccionado algo.  */
						if($('tipo').options[$('tipo').selectedIndex].value=='0')
                                        	      	$('btnsubmit').disabled=false;
                                        	else
							$('btnsubmit').disabled=true;

						$('Numero').addEvent('keydown', function (evt) {
							/*Se presiona Enter.*/
							if( evt.key == 'enter' && $('tipo').options[$('tipo').selectedIndex].value!=0 ){ 
								busqueda();
						      	}//if evento keydown
						});//keydown event

						$('Numero').addEvent('keyup', function (evt) {
							if($('tipo').options[$('tipo').selectedIndex].value=='tarjeta'){
								
								busqueda();
							}
							if($('tipo').options[$('tipo').selectedIndex].value!='0' && $('tipo').options[$('tipo').selectedIndex].value!='tarjeta' && evt.key=='enter')
								busqueda();
						});//keydown event

						$('tipo').addEvent('change', function () {
							$('contenedor').innerHTML="";
							$('Numero').value="";
							if(this.options[this.selectedIndex].value=='0'){
								$('btnsubmit').disabled=false;
								$('Numero').hide();
							}
							else			
							{
								$('btnsubmit').disabled=true;
								$('Numero').show();
							}
						});//tipo change
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

					});//domready
EOD;
		return $this->strAjaxScript;
	}
}
?>
