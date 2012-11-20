<?php


// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');


?>

<h1>CUENTAS</h1>
<div id="flash" class="<?php echo $this->status ?>">
	<?php echo $this->mensaje ?>
</div>



<form name="consulta" action="index.php" method="get"  class="form-validate" onSubmit="return myValidate(this);">

<input type="hidden" name="check" value="post"/>



<p>
	<label>Escoja una cuenta para transaccionar</label><br>
	<select>
	<option>--</option>
	</select>
</p>




	<input id="btnsubmit" name="btnsubmit" type="submit" value="Seleccionar" class="button validate" />


<input type="hidden" value="27" name="empresa" />
<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="salmovresultado" name="view" />


</form>