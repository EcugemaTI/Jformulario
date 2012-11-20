<?php

// Add a reference to a CSS file
// The default path is 'media/system/css/'
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
header('Content-type: application/csv');
header("Content-Disposition: attachment; filename=archivo.csv");
header("Pragma: no-cache");
header("Expires: 0");
?>
Fecha,Tarjeta,Ref.,Descripcion,Simb,valor
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
			echo $mov["fecha"] . "," . $mov["dt_tarjeta"] . "," . $mov["descripcion"] . "," . $mov["tt_abreviatura"] . "," . round($mov["dt_total"],2) ;
		}
	}
	else
		echo  $this->movimientos["fecha"] . "," . $this->movimientos["dt_tarjeta"] . "," . $this->movimientos["descripcion"] . "," . $this->movimientos["tt_abreviatura"] . "," . round($this->movimientos["dt_total"],2) ;

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
echo $mov["fecha"] . "," . $mov["dt_tarjeta"] . "," . $mov["descripcion"] . "," . $mov["tt_abreviatura"] . "," . round($mov["dt_total"],2) ;
		}
	}
	else
		echo  $this->movimientos_p["fecha"] . "," . $this->movimientos_p["dt_tarjeta"] . "," . $this->movimientos_p["descripcion"] . "," . $this->movimientos_p["tt_abreviatura"] . "," . round($this->movimientos_p["dt_total"],2) ;

}

?>


