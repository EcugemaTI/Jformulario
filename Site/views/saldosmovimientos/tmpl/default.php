<?php

JHTMLBehavior::formvalidation();
// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
JHTML::stylesheet('calendar.css', 'includes/calendar/skins/default/');
JHTML::script('calendar.js', 'includes/calendar/',true);


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
      if($('anio').hasClass('invalid')){msg += '\n\n\t* Invalid E-Mail Address';}

      alert(msg);
   }
   return false;
}
</script>
<h1>MOVIMIENTOS</h1>
<div id="flash" class="<?php echo $this->status ?>">
	<?php echo $this->mensaje ?>
</div>



<form name="consulta" action="index.php" method="get"  class="form-validate" onSubmit="return myValidate(this);">

<input type="hidden" name="check" value="post"/>



<p>

	<input type="hidden" value="27" name="cuenta" class="required validate-numeric" />

</p>





<p>
	<label>A&ntilde;o</label><br>
	<input maxlength="4" size="4" name="anio"  id="anio"  class="required validate-numeric"/>
	</select>
</p>
<p>
	<label>Mes</label><br>
	<select id="mes" name="mes" class="required">
	<?php

		for($i=1;$i<=12;$i++){
			if($i<=9)
				echo "<option value='0" . $i . "'>0" . $i . "</option>";
			else
				echo "<option value='" . $i . "'>" . $i . "</option>";
		}

	?>
	</select>
</p>
<p>
	<input type="checkbox" value="1" name="no_html" />Exportar a excel
</p>
<br>
<input type="hidden" value="com_syscards" name="option" />
	<input id="btnsubmit" name="btnsubmit" type="submit" value="Consultar" class="button validate" />


<input type="hidden" value="27" name="empresa" />
<input type="hidden" value="com_syscards" name="option" />
<input type="hidden" value="saldos_movimientos_resultado" name="task" />

<input type="hidden" value="salmovresultado" name="view" />


</form>