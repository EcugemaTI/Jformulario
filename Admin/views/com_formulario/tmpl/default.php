<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'

//JHTMLBehavior::formvalidation();
JHTML::_('behavior.formvalidation');
JHTML::_( 'behavior.modal' );
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
JHTML::stylesheet('calendar.css', 'includes/calendar/skins/default/');
JHTML::script('calendar.js', 'includes/calendar/',true);
header('Content-type: text/html; charset=ISO-8859-15');

?>

<script language="javascript">
function myValidate(f) {
  
   if (document.formvalidator.isValid(f)) {
      f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
      return true;
   }
   else {
      var msg = 'Some values are not acceptable.  Please retry.';

      //Example on how to test specific fields
      if($('email').hasClass('invalid')){msg += '\n\n\t* Invalid E-Mail Address';}

      alert(msg);
   }
   return false;
}
</script>

<a class="modal" rel="{handler: 'iframe', size: {x: 800, y: 560}}" id="modalWindowLink" href="<?php echo JURI::base() . '?option=com_syscards&view=importacion&no_html=0&hidemainmenu=1'?>"></a>

<h1>ACTIVACION</h1>
<div id="flash" class="<?php echo $this->status ?>">
	<?php echo $this->mensaje ?>
</div>



<div id="minitoolb">


	<div id="criterio">
 	 <label>Tipo:</label>
 	 	<select name="tipo" id="tipo" >

 	 		<!-- <option value="ci" selected>CI</option>-->
 	 		<!-- <option value="persona" selected>Nombres</option>-->
 	 		<option value="tarjeta" selected>Tarjeta</option>
 	 		<option value="archivo">Archivo</option>


	 	 </select>
	</div>

	<div id="criterio">
		<label>#:</label>
		<input maxlength="16" size="20" name="Numero"  id="Numero"  />
	</div>

</div>
<form name="consulta" action="index.php" method="post" id="consulta" class="form-validate" onSubmit="return myValidate(this);">
<input type="hidden" name="check" value="post"/>
<hr>
<div id="contenedor" name="contenedor">
</div>
<br>


	<p>
	<label>Cupo de tarjeta:</label><br>
		<input maxlength="4" size="20" name="cupo"  id="cupo" class="required validate-cupo " value="0" /><span id="errcupo" name="errcupo" /></span>
	</p>

    <p>
	<label>Tipo de Identificaci&oacute;n:</label><br>
		<select id="tipo_iden" name="tipo_iden" class="required" >
			<option value="C">C&eacute;dula</option>
			<option value="P">Pasaporte</option>
		</select>
	</p>
	<p>
	<label>Identificaci&oacute;n:</label><br>
		<input maxlength="30" size="20" name="identificacion"  id="identificacion" class="required validate-identifica"  /><span id="erridentificacion" /></span>
<div id="contenedorC" name="contenedorC">
</div>

	</p>

	<p>
	<label>Apellidos:</label><br>
		<input maxlength="30" size="20" name="apellidos"  id="apellidos" class="required validate-apellidos" />
	</p>


	<p>
	<label>Nombres:</label><br>
		<input maxlength="20" size="20" name="nombres"  id="nombres"  class="required validate-nombres"/>
	</p>

	<p>
	<label>Nombre de pl&aacutestico</label><br>
		<input maxlength="30" size="20" name="plastico"  id="plastico"  />
	</p>


	<input id="btnsubmit" name="btnsubmit" type="submit" value="Activar" class="button validate" disabled />

<input type="hidden" value="" name="decCupo" id="decCupo" />
<input type="hidden" value="" name="txtNumero" />
<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="activacion_proceso" name="task" />


</form>
