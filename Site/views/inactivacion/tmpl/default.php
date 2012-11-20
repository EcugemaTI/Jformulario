<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
JHTML::script('inactivacion.js', 'components/com_syscards/js/',true);
?>
<h1>INACTIVACION</h1>
<div id="flash" class="<?php echo $this->status ?>">
	<?php echo $this->mensaje ?>
</div>



<div id="minitoolb">


	<div id="criterio">
 	 <label>Tipo:</label>
 	 	<select name="tipo" id="tipo" >
 	 		<option value="0" selected  >--</option>
 	 		<option value="ci">C.I.</option>
	  	 	<option value="persona" >Nombres</option>
	  	 	<option value="tarjeta" selected>Tarjeta</option>
	 	 </select>
	</div>

	<div id="criterio">
		<label>#:</label>
		<input maxlength="60" size="20" name="Numero"  id="Numero"  />
	</div>

</div>
<form name="consulta" action="index.php" method="post" >
<hr>
<div id="contenedor" name="contenedor">
</div>
<br>
<div id="minitoolsb">


	<div id="criterio">
		<label>Baja:</label>

		<select name="baja" id="baja">
	 	 		<option value="0" selected >--</option>
				<option value="1|1">Cancelada por Cliente</option>
				<option value="1|4">Tarjeta Extraviada</option>
				<option value="1|5">Tarjeta Robada</option><option 
				<option value="1|8">Cliente  Fallecido</option>
				<option value="1|A">Tarjeta Deteriorada</option>
		<?php
			//foreach($this->bajas as $baja){
		  	// 	echo '<option value="' .$baja["id"] . '" >' . $baja["nombre"] . '</option>';
			//}
		?>
	 	 </select>
	</div><br>

	<div id="criterio">
		<label>Motivo:</label><br>


		<?php
		$editor =& JFactory::getEditor();
		echo $editor->display('motivo', 'Escriba el motivo...', '550', '400', '60', '20', false);
		?>
	</div><br><br>
	<input id="btnsubmit" name="btnsubmit" type="submit" value="Inactivar" disabled />

</div>




<input type="hidden" value="" name="txtNumero" />
<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="inactivacion_proceso" name="task" />


</form>

