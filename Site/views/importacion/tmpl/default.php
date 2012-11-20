<?php
JHTML::stylesheet('syscards.css', 'components/com_syscards/css/');
JHTML::stylesheet('calendar.css', 'includes/calendar/skins/default/');
JHTML::script('calendar.js', 'includes/calendar/',true);
header('Content-type: text/html; charset=ISO-8859-15');

/*if($_POST){
	$tmp_name = $_FILES["archivo"]["tmp_name"];
        $name = $tmp_name; //$_FILES["archivo"]["name"];
	jimport('excel.reader'); 
	$datos = new Spreadsheet_Excel_Reader();
	$datos->read($name);
	$celdas = $datos->sheets[0]['cells'];
	$output = "<table width='300' align='center' border=1 >";
	$i=1;
	while(array_key_exists($i,$celdas))
	{
		$output.= "<tr><td width='150' align='center'>" . $celdas[$i][1] . "</td>
				<td width='150' align='center'>" . $celdas[$i][2] . "</td>
				<td width='150' align='center'>" . $celdas[$i][3] . "</td>
				<td width='150' align='center'>" . $celdas[$i][4] . "</td>
				<td width='150' align='center'>" . $celdas[$i][5] . "</td>
				<td width='150' align='center'>" . $celdas[$i][6] . "</td>
			</tr>";
		$i++;
	}
	$output .=  "</table>";
}*/
?>

<html>
<body>
<form id="frmupload"  enctype="multipart/form-data" method="post" action="<?php echo JURI::base() . '?option=' . $option . '&task=activacion_masiva&no_html=0'?>">
  <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
  <table width="100%">
  <tr>
  <td><div id="labelarchivo">Seleccione archivo:</div></td>
  <td><input type="file" name="archivo" id="archivo" /></td>
  <td><input type="submit" value="Cargar" id="cargar" /></td>
  </tr>
  </table>
  </form>
  <div align="center" style="display:none" id="progreso">
	 <img align="absmiddle" src="images/stories/loader-bar.gif">
       	 <br /> Por favor espere mientras procesamos su archivo...

  </div>
Para saber los pasos a realizar en la carga de datos haga click <a href="mnuopayuda/48-activacion-masiva" target='_blank'>aqu&iacute;.<img src="images/stories/icon_help.gif"></a>
<?php

$texto = '
  <h3>Pasos para realizar carga de datos.</h3>
  <ol>
<li>Descargue el archivo <a href="/images/plantilla.xls">aqu&iacute; </a>o desde la ventana de activaci&oacute;n.</li>
<li>Abra el archivo con Microsoft Excel (2003/2010) o Libre Office &gt;3.1 y prepare el formato. Dependiendo del programa que use variar&aacute; la forma de 
cambiar 
el formato y llenarlo.</li>
<li>Haga clic en las columnas A,B,C,D,E,F as&iacute; se sombrear&aacute;n las columnas completas. Haga click derecho y se mostrar&aacute; un men&uacute; 
flotante.</li>
<li>Seleccione Formato de Celda cambie el formato de las celdas y seleccione TEXTO.</li>
<li>Llene los datos de cada columna. Tome en cuenta las siguientes recomendaciones:<ol>
<li>La columna de <strong>"Tipo de identificacion" </strong>tiene dos valores: C para cédula y P para pasaporte.</li>
<li>El monto debe ser NUMÉRICA, puede agregar decimales si necesitase hacerlo.</li>
<li>La cédula debe</li>
</ol></li>
<li>Guarde el archivo y cierre el archivo.</li>
</ol>';
?>
<br>
<p align="center">
<a id="sbox-btn-close"  onclick="window.parent.SqueezeBox.close();" href="#" ><img valign="middle" 
src="<?php echo JURI::base()?>/media/system/images/closebox.png">Cerrar</a>
</p>
  </body>
  </html>
