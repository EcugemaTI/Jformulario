<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
JHTML::script('saldosmovimientos.js', 'components/com_syscards/js/',true);
?>
<h1>SALDOS</h1>
<div id="flash" class="<?php echo $this->status ?>">
	<?php echo $this->mensaje ?>
</div>



<div id="minitoolb">
	<div id="criterio">
 	 <label>Tipo de consulta:</label>
 	 	<select name="tipo" id="tipo" >
 	 		<option value="0" selected  >Cuenta</option>
 	 		<option value="ci">C.I.</option>
	  	 	<option value="persona" >Nombres</option>
	  	 	<option value="tarjeta">Tarjeta</option>
	 	 </select>
	</div>

	<div id="criterio">
		<label>#:</label>
		<input maxlength="20" size="20" name="Numero"  id="Numero"  />
	</div>

</div>
<form name="consulta" action="index.php" method="post" >
<hr>
<div id="contenedor" name="contenedor">
</div>
<br>
<div id="minitoolsb">
	<input id="btnsubmit" name="btnsubmit" type="submit" value="Consultar" disabled />
 <input maxlength="20" size="20" type="checkbox" value="1"  name="no_html"  id="no_html"  />Exportar a excel

</div>




<input type="hidden" value="" name="txtNumero" />
<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="consultar_saldo" name="task" />


</form>

