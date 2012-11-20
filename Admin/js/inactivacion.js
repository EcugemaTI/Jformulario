function busqueda()
{
if($('tipo').options[$('tipo').selectedIndex].value=='tarjeta')
	max_length = 16;
else
	max_length = 5;

if( $('Numero').value.length >= max_length ){
	if($('Numero').value.length>0 && $('contenedor').get('class')==''){
		$('contenedor').addClass('ajax-loading');
		$('contenedor').innerHTML ="Consultando espere un momento...";
		var valorTipo = $('tipo').options[$('tipo').selectedIndex].value;
		var a = new Ajax('index.php?option=com_syscards&no_html=1&task=consultarTarjetas&tipo=' + valorTipo + '&txtIdn=' + $('Numero').value + '&estado=0000000000',
		{
			method: 'get',
			onComplete: function(response){
			var resp = Json.evaluate(response);
			var cabecera="";
			var detalle="";

			$('contenedor').removeClass('ajax-loading').setHTML("");

			$('contenedor').innerHTML ="";
			$('btnsubmit').disabled=true;
			if(resp.ta_tarjeta =='0' && resp.cl_cliente=='##' )
				detalle ="<table id='movimientos'><tbody><tr>    <th>0 registro(s) encontrado(s), vuelva a consultar.<th></tbody>";
			else {
				cabecera="<table id='movimientos'><tbody><tr>			<th>&nbsp;</th>			<th># Tarjeta</th>			<th>Nombre</th><th>Fecha activaci&oacute;n</th>		</tr>	</tbody>";
				detalle="";
				if(resp.length>1)
				{
					for(var i=0;i<resp.length;i++){
						detalle += "<tr class='none'><td><input name='tarjeta' id= 'tarjeta' type='radio' onclick=\"fEnableControl();\" value='" + resp[i].ta_tarjeta + "'></td><td>" +  resp[i].ta_tarjeta + "</td><td>" +  resp[i].cl_cliente + "</td><td>" + resp[i].ta_fchactivacion  + "</td></tr>";
					}
				}
				else
				{
					fEnableControl();
					detalle += "<tr class=\"none\"><td><input name=\"tarjeta\" id=\"tarjeta\" type=\"radio\" checked onclick=\"fEnableControl();\" value='" + resp.ta_tarjeta + "'></td><td>" +  resp.ta_tarjeta + "</td><td>" +  resp.cl_cliente + "</td><td>" + resp.ta_fchactivacion  + "</td></tr>";
				}
			}														
				$('contenedor').innerHTML= cabecera + detalle + "</table>";
				$('contenedor').innerHTML+="<hr>";
		}
		}).request();												
	}
}
}
