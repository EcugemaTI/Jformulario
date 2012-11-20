<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
$total__movimientos=0;
?>

<h1>Saldos</h1>

<table id="movimientos">
<tr>
<?php if($this->tarjeta=='S'){ ?>
	<th># Tarjeta</th>
	<th>Fecha activaci&oacute;n</th>
<?php } ?>

	<th>C&eacute;dula/Ruc</th>
	<th>Colaborador</th>
	<th>Cupo</th>
	<th>Disponible</th>
<?php if($this->tarjeta=='N'){ ?>
	<th>Deuda total</th>
<?php } ?>
	<th>Fecha tope de pago</th>
	<th>Estado</th>

</tr>
<?php
if(is_array($this->movimientos)){
	$strClass="alt";
	$total__movimientos= 0;
	$total_mov = count($this->movimientos);

		foreach($this->movimientos as $mov){
				if($this->tarjeta=='N'){
					$cupo = $mov["cupo"];
					$disponible = $mov["disponible_cuenta"];
					$deuda_total = "<td align='right'>$" . round($mov["deuda_total"],2) . "</td>";
					$fecha="";
					$tarjeta_n = "";
					$estado = $mov["maestado"];
				}
				else{
					$cupo = $mov["cupo_tarjeta"];
					$disponible = $mov["disponible_tarjeta"];
					$deuda_total = "";
					if(array_key_exists('fecha_activacion',$mov))
						$fecha = "<td>" . $mov["fecha_activacion"] . "</td>" ;
					else
						$fecha="<td></td>";
					$tarjeta_n = "<td>" . $mov["tarjeta_no"] . "</td>";
					$estado = $mov["estado"];
				}


				if($strClass=="alt")
					$strClass = "none";
			   	else
					$strClass = "alt";
				echo "<tr class='" . $strClass . "'>". 
					$tarjeta_n . 
					$fecha . 
					"<td>" . $mov["identificacion"]  . "</td>
					<td>" . $mov["nombre"] . "</td>
					<td align='right'>$" . round($cupo,2) . "</td>
					<td align='right'>$" . round($disponible,2) . "</td>" .
					 $deuda_total . 
					 "<td>" . $mov["fechaTopePago"] . "</td>
					<td>" . $estado .
					"</td></tr>";
		}//foreach1

}
?>
</table>

