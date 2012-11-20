<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class SyscardViewImportacion extends JView
{


    function display($tpl = null)
    {

		$this->validarUsuario();
		$document       = JFactory::getDocument();
                $this->insertarAjax();
                $document-> addScriptDeclaration ($this->strAjaxScript);

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

    function insertarAjax(){
                JHTML::_( 'behavior.mootools' );

                $this->strAjaxScript =  <<<EOD
						
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
							$('progreso').setStyle('display','none');
                                                	$('frmupload').addEvent('submit', function(e){
								e.stop();
								$('archivo').hide();
								$('labelarchivo').hide();
								$('cargar').hide();
								$('progreso').show();
								this.submit();
                        	                        });
							$('cerrar').addEvent('click'),function(){
								
							});
						});
EOD;
                        return $this->strAjaxScript;
        }

}
?>
