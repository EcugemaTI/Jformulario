<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');

?>

<h1>Saldos de Cta.</h1>


								<strong><?php echo $this->nombre; ?></strong>
						<p>
							<strong>Resumen</strong><br>
						</p>
						<p>
													Cupo: <?php echo $this->cupo; ?>
						</p>
						<p>

								<strong>Saldo total:</strong>
							</p>
							<p>
								USD <?php echo $this->saldototal; ?>
							</p>
							<p>
								<strong>Saldo diferido:</strong>
							</p>
							<p>
								USD <?php echo $this->saldodiferido;?>
							</p>
							<p>
								<strong>Saldo rotativo:</strong>
							</p>
							<p>
								USD <?php echo $this->saldorotativo; ?>
							</p>
							<p>
								<strong>Fecha tope de pago:</strong>
							</p>
							<p>
								 <?php echo $this->fechaTopePago; ?>
							</p>

<p>

</p>
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
	//print_r($this->movimientos);
	$total_mov = count($this->movimientos);

	if(array_key_exists(0,$this->movimientos)){
		foreach($this->movimientos as $mov){

		   if($strClass=="alt")
				$strClass = "none";
		   else
				$strClass = "alt";
echo "<tr class='" . $strClass . "'><td>" . $mov["fecha"] . "</td><td>" . $mov["dt_tarjeta"] . "</td><td>/</td><td>" . $mov["descripcion"] . "</td><td>" . $mov["tt_abreviatura"] . "</td><td>" . round($mov["dt_total"],2) . "</td></tr>";
		}
	}
	else
		echo "<tr class='" . $strClass . "'><td>" . $this->movimientos["fecha"] . "</td><td>" . $this->movimientos["dt_tarjeta"] . "</td><td>/</td><td>" . $this->movimientos["descripcion"] . "</td><td>" . $this->movimientos["tt_abreviatura"] . "</td><td>" . round($this->movimientos["dt_total"],2) . "</td></tr>";

}

?>
<?php

if(is_array($this->movimientos_p)){
	$strClass="alt";
	//print_r($this->movimientos_p);
	$total_mov = count($this->movimientos_p);

	if(array_key_exists(0,$this->movimientos_p)){
		foreach($this->movimientos_p as $mov){

		   if($strClass=="alt")
				$strClass = "none";
		   else
				$strClass = "alt";
echo "<tr class='" . $strClass . "'><td>" . $mov["fecha"] . "</td><td>" . $mov["dt_tarjeta"] . "</td><td>/</td><td>" . $mov["descripcion"] . "</td><td>" . $mov["tt_abreviatura"] . "</td><td>" . round($mov["dt_total"],2) . "</td></tr>";
		}
	}
	else
		echo "<tr class='" . $strClass . "'><td>" . $this->movimientos_p["fecha"] . "</td><td>" . $this->movimientos_p["dt_tarjeta"] . "</td><td>/</td><td>" . $this->movimientos_p["descripcion"] . "</td><td>" . $this->movimientos_p["tt_abreviatura"] . "</td><td>" . round($this->movimientos_p["dt_total"],2) . "</td></tr>";

}

?>
</table>

