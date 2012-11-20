
<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=movimientos" . date("Ymd")  . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
$output = "<table>";
foreach($this->movimientos as $card){
	foreach($card as $mov){
		$output .= "<tr ><td>" . $mov["fecha"] . "</td><td>" . $mov["dt_tarjeta"] . "</td><td>" . $mov["nombre"]  . "</td><td>" . $mov["cl_identifica"]  . "</td><td>" . $mov["descripcion"] . "</td><td>" . $mov["tt_abreviatura"] . "</td><td align='right'>" . round($mov["dt_total"],2) . "</td></tr>";
	}
}

$output .="</table>";
echo $output;

?>
