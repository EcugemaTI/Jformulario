<?php
// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');

?>

<h1>Movimientos</h1>
<h3>Periodo</h3>
<p><label><b>Desde:</b><br><?php echo $this->fecha_inicio;?></label></p>
<p><label><b>Fin:</b><br><?php echo $this->fecha_fin;?></label></p>
<table id="movimientos">
<tr>
	<th>Fecha</th>
	<th># Tarjeta</th>
	<th>Colaborador</th>
	<th>C&eacute;dula</th>
	<th>Almac&eacute;n</th>
	<th>Simb.</th>
	<th>Valor</th>
</tr>
<?php
$total=0;
if(is_array($this->movimientos)){
	$strClass="alt";
	$total_mov = count($this->movimientos);
	foreach($this->movimientos as $tarjeta){
		foreach($tarjeta as $mov){
			if($strClass=="alt")
				$strClass = "none";
			else
				$strClass = "alt";

			echo "<tr class='" . $strClass . "'><td>" . $mov["fecha"] . "</td><td>" . $mov["dt_tarjeta"] . "</td><td>" . $mov["nombre"]  . "</td><td>" . $mov["cl_identifica"]  . "</td><td>" . $mov["descripcion"] . "</td><td>" . $mov["tt_abreviatura"] . "</td><td align='right'>$" . round($mov["dt_total"],2) . "</td></tr>";
			$total += round($mov["dt_total"],2);
		}//foreach2
	}//foreach1
}//if

?>
</table>

<h2>Total de movimientos: $<?php echo $total ?></h2>
