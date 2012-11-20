<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'

header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=archivo.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<h1>Movimientos</h1>
<table id="movimientos">
<tr>
	<th>Fecha</th>
	<th>Tarjeta</th>
	<th>Ref.</th>
	<th>Descripci&oacute;n</th>
	<th>Simb.</th>
	<th>Valor</th>
</tr>
<?php

if(is_array($this->movimientos)){
	$strClass="alt";
	foreach($this->movimientos as $mov){
	   if($strClass=="alt")
	   		$strClass = "none";
	   else
			$strClass = "alt";
		echo "<tr class='" . $strClass . "'><td>" . $mov["fecha"] . "</td><td>" . $mov["dt_tarjeta"] . "</td><td>/</td><td>" . $mov["descripcion"] . "</td><td>" . $mov["tt_abreviatura"] . "</td><td>" . round($mov["dt_total"],2) . "</td></tr>";
	}
	}
?>
</table>

