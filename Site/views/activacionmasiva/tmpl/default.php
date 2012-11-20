<?php
JHTML::_('behavior.tooltip');
// Add a reference to a CSS file
// The default path is 'media/system/css/'


//print_r( $this->mensaje);
$outputz = "<table id='movimientos' width='100%' ><tbody>";
$outputz.= "<tr><th width='150' align='center'>Tarjeta</th>                                        <th align='center'>Tipo iden.</th>                                        
<th align='center'>Cedula</th>                                        <th align='center'>Nombre</th>                                        <th 
align='center'>Apellidos</th>                                        <th align='center'>Monto</th>                                        <th align='center' 
width='20%'>Estado</th>                                </tr>";

foreach($this->mensaje as $celdas){
	//if($celdas['estado']!='OK')
	//else
	$img = "checkin.png";
	$title = "Pycca";
	
	if($celdas['estado']=='OK')
		if($celdas['estado2']=='OK' || $celdas['estado2']==''){
			$estado = $celdas['estado'];
			$img = "checkin.png";
			}
		else{
			$estado = $celdas['estado2'];
			$img = "error.png";
			$title = "Error";

		}
	else
	{
			$estado = utf8_encode($celdas['estado']);
			$img = "error.png";
			$title = "Error";
	}
		
	$outputz .= "<tr><td width='150' align='center'>" . $celdas['tarjeta'] . "</td>
                                        <td width='150' align='center'>" . $celdas['tipo'] . "</td>
                                        <td width='150' align='center'>" . $celdas['cedula'] . "</td>
                                        <td width='150' align='center'>" . $celdas['nombres'] . "</td>
                                        <td width='150' align='center'>" . $celdas['apellidos'] . "</td>
                                        <td width='150' align='center'>" . $celdas['montos'] . "</td>
                                        <td  align='center'>" . JHTML::tooltip($estado, $title, $img, '',  '') . $estado . " </td>
                                </tr>";
}
$outputz.= "</tbody></table>";
echo $outputz;
?>
