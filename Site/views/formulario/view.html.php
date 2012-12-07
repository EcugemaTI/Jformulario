<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.view');
class formularioViewformulario extends JView
{


    function display($tpl = null)
    {


	$formulario		=& $this->get('Data');
	$this->assignRef('formulario',		$formulario);

	 if(count($formulario)>0)
	 {
			foreach ($formulario as &$row)
				{


					$css =   $row->css_nombre;
					print_r($row);
					if(strlen($row->expresion_regular)>0){
					$validador .= "document.formvalidator.setHandler('" . $row->nombre . "', function(value) {

												  regex=" . stripslashes($row->expresion_regular) . ";

												if(regex.test(value)==0){
													$('err" . $row->nombre . "').innerHTML='" . $row->mensaje_validacion ."';

													return false;
												}
												else
												{
												$('err" . $row->nombre . "').innerHTML='';
													return true;
												}
											});
											";

					}

				}
	}

	$document       = JFactory::getDocument();
        $document-> addScriptDeclaration ($this->insertarValidaciones($validador));

	$document ->addStyleSheet( 'components' . DS . 'com_formulario' . DS . 'css' .DS . $css);

    	parent::display($tpl);
    }
    function insertarValidaciones($validador){
    	JHTML::_( 'behavior.mootools' );
		$this->_strAjaxScript = 	"

    window.addEvent('domready', function() {

											" . $validador . "
								});
";

return $this->_strAjaxScript;
    }
    function insertarAjax(){


		$this->strAjaxScript = 	<<<EOD
									Element.implement({
										  setFocus: function(index) {
										  this.setAttribute('tabIndex',index || 0);
										  this.focus();
										  }
									});

function check_cedula( p_cedula )
{




      numero = p_cedula;

//	  alert(numero);



      var suma = 0;

      var residuo = 0;

      var pri = false;

      var pub = false;

      var nat = false;

      var numeroProvincias = 22;

      var modulo = 11;



      /* Verifico que el campo no contenga letras */

      var ok=1;

      for (i=0; i<numero.length && ok==1 ; i++){

         var n = parseInt(numero.charAt(i));

         if (isNaN(n)) ok=0;

      }

      if (ok==0){

         //alert("No puede ingresar caracteres en el número");

         return false;

      }



      if (numero.length < 10 ){

         //alert('El número ingresado no es válido');

         return false;

      }



      /* Los primeros dos digitos corresponden al codigo de la provincia */

      provincia = numero.substr(0,2);

      if (provincia < 1 || provincia > numeroProvincias){

//         alert('El código de la provincia (dos primeros dígitos) es inválido');

		 return false;

      }



      /* Aqui almacenamos los digitos de la cedula en variables. */

      d1  = numero.substr(0,1);

      d2  = numero.substr(1,1);

      d3  = numero.substr(2,1);

      d4  = numero.substr(3,1);

      d5  = numero.substr(4,1);

      d6  = numero.substr(5,1);

      d7  = numero.substr(6,1);

      d8  = numero.substr(7,1);

      d9  = numero.substr(8,1);

      d10 = numero.substr(9,1);



      /* El tercer digito es: */

      /* 9 para sociedades privadas y extranjeros   */

      /* 6 para sociedades publicas */

      /* menor que 6 (0,1,2,3,4,5) para personas naturales */



      if (d3==7 || d3==8){

  //       alert('El tercer dígito ingresado es inválido');

         return false;

      }



      /* Solo para personas naturales (modulo 10) */

      if (d3 < 6){

         nat = true;

         p1 = d1 * 2;  if (p1 >= 10) p1 -= 9;

         p2 = d2 * 1;  if (p2 >= 10) p2 -= 9;

         p3 = d3 * 2;  if (p3 >= 10) p3 -= 9;

         p4 = d4 * 1;  if (p4 >= 10) p4 -= 9;

         p5 = d5 * 2;  if (p5 >= 10) p5 -= 9;

         p6 = d6 * 1;  if (p6 >= 10) p6 -= 9;

         p7 = d7 * 2;  if (p7 >= 10) p7 -= 9;

         p8 = d8 * 1;  if (p8 >= 10) p8 -= 9;

         p9 = d9 * 2;  if (p9 >= 10) p9 -= 9;

         modulo = 10;

      }



      /* Solo para sociedades publicas (modulo 11) */

      /* Aqui el digito verficador esta en la posicion 9, en las otras 2 en la pos. 10 */

      else if(d3 == 6){

         pub = true;

         p1 = d1 * 3;

         p2 = d2 * 2;

         p3 = d3 * 7;

         p4 = d4 * 6;

         p5 = d5 * 5;

         p6 = d6 * 4;

         p7 = d7 * 3;

         p8 = d8 * 2;

         p9 = 0;

      }



      /* Solo para entidades privadas (modulo 11) */

      else if(d3 == 9) {

         pri = true;

         p1 = d1 * 4;

         p2 = d2 * 3;

         p3 = d3 * 2;

         p4 = d4 * 7;

         p5 = d5 * 6;

         p6 = d6 * 5;

         p7 = d7 * 4;

         p8 = d8 * 3;

         p9 = d9 * 2;

      }



      suma = p1 + p2 + p3 + p4 + p5 + p6 + p7 + p8 + p9;

      residuo = suma % modulo;



      /* Si residuo=0, dig.ver.=0, caso contrario 10 - residuo*/

      digitoVerificador = residuo==0 ? 0: modulo - residuo;



      /* ahora comparamos el elemento de la posicion 10 con el dig. ver.*/

      if (pub==true){

         if (digitoVerificador != d9){

    //        alert('El ruc de la empresa del sector público es incorrecto.');

            return false;

         }

         /* El ruc de las empresas del sector publico terminan con 0001*/

         if ( numero.substr(9,4) != '0001' ){

      //      alert('El ruc de la empresa del sector público debe terminar con 0001');

            return false;

         }

      }

      else if(pri == true){

         if (digitoVerificador != d10){

        //    alert('El ruc de la empresa del sector privado es incorrecto.');

            return false;

         }

         if ( numero.substr(10,3) != '001' ){

          //  alert('El ruc de la empresa del sector privado debe terminar con 001');

            return false;

         }

      }



      else if(nat == true){
//	alert(digitoVerificador);
//	alert(d10);
         if (digitoVerificador != d10){

           // alert('El número de cédula de la persona natural es incorrecto.');

            return false;

         }

         if (numero.length >10 && numero.substr(10,3) != '001' ){

  //          alert('El ruc de la persona natural debe terminar con 001');

            return false;

         }

      }

      return true;

   }





									function fEnableControl(){
										document.getElementById('btnsubmit').disabled=false;
										$('cupo').focus();
										$('nombres').focus();
									};


									window.addEvent('domready', function() {
											$('09119922').innerHTML="";

											 $('tipo').addEvent('change', function(){
												//alert($('tipo').options[$('tipo').selectedIndex].value);
												if(this.options[this.selectedIndex].value=='archivo'){
												    	SqueezeBox.initialize({
        													size: {x: 150, y: 400},
														closeBtn:false
													    });
													SqueezeBox.fromElement($('modalWindowLink'));
												}
											});
											document.formvalidator.setHandler('cupo', function(value) {
												  regex=/^([0-9]+)$/;
												if(regex.test(value)==0){
													$('errcupo').innerHTML="<img src='images/arrow_red_left.png'>&nbsp;Cupo debe ser num&eacute;rico.";
													$('errcupo').addClass('invalid');
												}
												else{
													var valor = $('decCupo').value.toFloat();
													if(value>valor){
                                                                                                                       		$('errcupo').innerHTML="<img src='images/arrow_red_left.png'>Valor de cupo es mayor al cupo por orden establecido:$" + valor;
                                                                                                                       		$('errcupo').addClass('invalid');
																return false;
													}else{
														if(value>0){
		                                                                                                	$('errcupo').innerHTML="<img src='images/validate.png'>";
	                                                                                                                $('errcupo').addClass('');
															return true;
														}
														else
                                                                                                               		$('errcupo').innerHTML="<img src='images/arrow_red_left.png'>Valor de cupo debe ser mayor a 0";
                                                                                                            		$('errcupo').addClass('invalid');
															return false;
													}
                                                                                                }

												  return regex.test(value);
											   });
											document.formvalidator.setHandler('identifica', function(value) {
												  regex=/^([0-9]+)$/;
														if($('tipo_iden').options[$('tipo_iden').selectedIndex].value=='P')
															validador = true;
														else
															validador = check_cedula(value);
														$('erridentificacion').removeClass('invalid').setHTML("");

														if( validador==false){
															$('erridentificacion').innerHTML="<img src='images/arrow_red_left.png'>&nbsp;Formato incorrecto de c&eacute;dula.";
															$('erridentificacion').addClass('invalid');
															}
														else{
															$('erridentificacion').innerHTML="<img src='images/validate.png'>";
															$('erridentificacion').addClass('');
														}

												  return regex.test(value);
											   });


											//Consulta de cedula
											//=======================================================
											$('identificacion').addEvent('keydown', function(evt) {
												if(evt.key =='tab'){
													$('contenedorC').addClass('ajax-loading');
													$('contenedorC').innerHTML ="Consultando datos espere unos minutos...";
													tipoIden=$('tipo_iden').options[$('tipo_iden').selectedIndex].value;

													var a = new Ajax('index.php?option=com_syscards&no_html=1&task=obtenerCus',
													{
														method: 'post',
														data: 'tipo=' + tipoIden + '&txtIdn=' + this.value + '&estado=',
														onComplete: function(response){
														var resp = Json.evaluate(response);
														$('contenedorC').removeClass('ajax-loading').setHTML("");
														if(resp.cl_nombres + ''=='undefined')
														{
															$('nombres').value='';
															$('apellidos').value='';
														}
														else{
															$('nombres').value=resp.cl_nombres;
															$('apellidos').value=resp.cl_apellidos;
														}
													}
													}).request();

												}
											});

											$('Numero').addEvent('keyup', function (evt) {
												max_length = 16;
											 if( this.value.length == max_length ){
												if(this.value.length>0 && $('contenedor').get('class')==''){
													$('btnsubmit').disabled=true;
													$('contenedor').addClass('ajax-loading');
													$('contenedor').innerHTML ="Consultando espere un momento...";
													var valorTipo = $('tipo').options[$('tipo').selectedIndex].value;
													var a = new Ajax('index.php?option=com_syscards&no_html=1&task=consultarTarjetas',
													{
														method: 'post',
														data: 'tipo=' + valorTipo + '&txtIdn=' + this.value + '&estado=0000001000',
														onComplete: function(response){
														var resp = Json.evaluate(response);

														$('contenedor').removeClass('ajax-loading').setHTML("");
														var cabecera="";
														var detalle="";
														$('contenedor').innerHTML ="";
														$('btnsubmit').disabled=true;
														if(resp.ta_tarjeta =='0' && resp.cl_cliente=='##')
															   detalle ="<table id='movimientos'><tbody><tr>    <th>0 registro(s) encontrado(s), vuelva a consultar.<th></tbody>";

														else{
															cabecera="<table id='movimientos'><tbody><tr>			<th>&nbsp;</th>			<th># Tarjeta</th>			<th>Nombre</th>		</tr>	</tbody>";
															detalle="";
															if(resp.length>1){
																$('decCupo').value = resp[0].ms_cupomaxadicio;
																for(var i=0;i<resp.length;i++){
																	detalle += "<tr class='none'><td><input name='tarjeta' id= 'tarjeta' type='radio' onclick=\"fEnableControl();\" value='" + resp[i].ta_tarjeta + "'></td><td>" +  resp[i].ta_tarjeta + "</td><td>" +  resp[i].cl_cliente + "</td></tr>";
																}
															}
															else{
																fEnableControl();
																detalle += "<tr class=\"none\"><td><input name=\"tarjeta\" id=\"tarjeta\" type=\"radio\" checked onclick=\"fEnableControl();\" value='" + resp.ta_tarjeta + "'></td><td>" +  resp.ta_tarjeta + "</td><td>" +  resp.cl_cliente + "</td></tr>";
																$('cupo').focus();
																$('decCupo').set('value',resp.ms_cupomaxadicio);
															}
														}
														$('contenedor').innerHTML= cabecera + detalle + "</table>";
														$('contenedor').innerHTML+="<hr>";
													}
													}).request();
												}
												}//keydown
											});


									});
EOD;
			return $this->strAjaxScript;
	}

}
?>
