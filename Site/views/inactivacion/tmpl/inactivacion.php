<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');

?>
<h1>INACTIVAR</h1>
<form name="consulta" action="index.php" method="post" >

<div id="minitoolb">


	<div id="criterio">
 	 <label>Tipo:</label>
 	 	<select name="accion">
 	 		<!-- <option value="0"  >--</option> -->
	  	 	<!-- <option value="cuenta" >Cuenta</option> -->
	  	 	<option value="tarjeta" selected>Tarjeta</option>
	 	 </select>
	</div>

	<div id="criterio">
		<label>#:</label>
		<input maxlength="20" size="20" name="txtTarjeta"  />
	</div>
	<div id="criterio">
		<label>Baja:</label>

		<select name="accion">
	 	 		<option value="0"  >--</option>
	<?php

			foreach($this->bajas as $baja){
		  	 	echo '<option value="' .$baja["id"] . '" >' . $baja["nombre"] . '</option>';
			}
		?>
	 	 </select>
	</div>
</div>
<hr>


<p>
<label>Motivo:</label>
<br>
<textarea id="motivo">
</textarea>
</p>
<input type="submit" value="Inactivar" />



<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="inactivacion_proceso" name="task" />


</form>

