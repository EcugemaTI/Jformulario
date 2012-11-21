function busqueda(){
if($('tipo').options[$('tipo').selectedIndex].value=='tarjeta')
	max_length = 16;
else
	max_length = 5;

/*Criterio de busqueda tiene caracteres*/
if($('Numero').value.length>0 &&  $('Numero').value.length >= max_length && $('contenedor').get('class')=='' ){

		$('btnsubmit').disabled=true;
		$('contenedor').addClass('ajax-loading');
		$('contenedor').innerHTML ="Consultando espere un momento...";
		var valorTipo = $('tipo').options[$('tipo').selectedIndex].value;
		var a = new Ajax('index.php?option=com_syscards&no_html=1&task=consultarTarjetas',
		{
			method: 'post',
			data:   'tipo=' + valorTipo + '&txtIdn=' + $('Numero').value + '&estado=',
			onComplete: function(response){
				var resp = Json.evaluate(response);
				var cabecera="";
				var detalle="";
				$('contenedor').removeClass('ajax-loading').setHTML("");
				$('contenedor').innerHTML ="";
				$('btnsubmit').disabled=true;
				if(resp.ta_tarjeta =='0' && resp.cl_cliente=='##'){
					cabecera="";
					detalle ="<table id='movimientos'><tbody><tr>    <th>0 registro(s) encontrado(s), vuelva a consultar.<th></tbody>";
				}
				else {
					cabecera="<table id='movimientos'><tbody><tr>			<th><img src='images/uncheck.jpg' id='ucuc' /></th>			<th># Tarjeta</th><th>Nombre</th><th>Identificaci&oacute;n</th><th>Fecha activaci&oacute;n</th>		</tr>	</tbody>";
					detalle="";
					if(resp.length>1)
					{
						for(var i=0;i<resp.length;i++){
							detalle += "<tr class='none'><td><input name='tarjeta[]' id= 'tarjeta[]' class='check-me'  type='checkbox' onclick=\"fEnableControl();\" value='" + resp[i].ta_tarjeta + "'></td><td>" +  resp[i].ta_tarjeta + "</td><td>" +  resp[i].cl_cliente + "</td><td>" + resp[i].cl_identifica + "</td><td>" + resp[i].ta_fchactivacion  + "</td></tr>";
						}
					}
					else
					{				
						detalle += "<tr class='none'><td><input name='tarjeta[]'  class='check-me'   id= 'tarjeta[]' type='checkbox' checked onclick=\"fEnableControl();\" value='" + resp.ta_tarjeta + "'></td><td>" +  resp.ta_tarjeta + "</td><td>" +  resp.cl_cliente + "</td><td>" + resp.cl_identifica + "</td><td>" + resp.ta_fchactivacion  + "</td></tr>";

					}

				}
				$('contenedor').innerHTML= cabecera + detalle + "</table>";
				$('contenedor').innerHTML+="<hr>";
				fEnableControl();

	                                       var ucuc = $('ucuc');
                                                ucuc.addEvent('click', function() {
                                                        if(ucuc.get('rel') == 'yes') {
                                                                do_check = false;
                                                                ucuc.set('src','images/uncheck.jpg').set('rel','no');
								$('btnsubmit').disabled=true;
                                                        }
                                                        else {
                                                                do_check = true;
                                                                ucuc.set('src','images/check.jpg').set('rel','yes');
								$('btnsubmit').disabled=false;
                                                        }
                                                        $$('.check-me').each(function(el) { el.checked = do_check; });
                                                });

			}//onComplete
		}).request();
}//criterio si tiene caracteres
}
