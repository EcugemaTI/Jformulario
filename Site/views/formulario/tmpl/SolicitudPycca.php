
<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php
JHTML::_('behavior.formvalidation');
JHTML::_( 'behavior.modal' );

header('Content-type: text/html; charset=ISO-8859-15');

?>
<script language="javascript">
function myValidate(f) {

   if (document.formvalidator.isValid(f)) {
      f.check.value='<?php echo JUtility::getToken(); ?>'; //send token
      return true;
   }
   else {
      var msg = 'Some values are not acceptable.  Please retry.';
	alert('a');
      //Example on how to test specific fields
      if($('email').hasClass('invalid')){msg += '\n\n\t* Invalid E-Mail Address';}

      alert(msg);
   }
   return false;
}

</script>

<form action="index.php" method="post" name="adminForm" id="adminForm"  class="form-validate" onSubmit="return myValidate(this);">
<input type="hidden" name="check" value="post"/>

<div class="col100">
	<fieldset class="adminform">
		<legend><h1><?php echo JText::_($this->formulario[0]->titulo); ?></h1></legend>
<br /><br />
<span name="errcupo" id="errcupo"></span>
		<table class="admintable">
		 <?php
		 if(count($this->formulario)>0){
			foreach ($this->formulario as &$row)
				{
					/*Armo variables para usar*/
					$requerido = ($row->es_obligatorio)?'required':'';
					$clase_custom = strlen($row->expresion_regular)>0?'validate-' . $row->nombre:'';
					$otras_clases = $row->clase_adicional;
					$clase_control = $requerido . ' ' . $clase_custom . ' ' . $otras_clases;
					$options=null;

				?>
				<tr>
					<td width="200" align="right" class="key">
						<label for="<?php echo $row->nombre?>">
							<?php echo JText::_( $row->etiqueta ); ?>:
						</label>
					</td>

					<td>
						<?php switch($row->tipo){
							case 'lista':
								$result = explode(',',$row->combo_datos);
								$options[] = JHTML::_('select.option',0,'--','id','descripcion');
								foreach($result as $value) :
									$result2 = explode('|',$value);
									$options[] = JHTML::_('select.option',$result2[1],JText::_($result2[0]),'id','descripcion');
								endforeach;
								echo JHTML::_('select.genericlist',  $options, $row->nombre, "class=$clase_control" , 'id', 'descripcion');
								break;
							case 'check':
								$result = explode(',',$row->combo_datos);
								foreach($result as $value) :
									$result2 = explode('|',$value);
									echo "<label for='" . $result2[0] . "'>";
									echo $result2[0];
									echo "</label>";
									echo JHTML::_('grid.id',$row->nombre,$result2[1]);
								endforeach;

								break;
							case 'calendario':
								echo JHTML::calendar($row>fechanacimiento, $row->nombre,$row->nombre);
								break;
							case 'texto': /* Caja de texto*/
								?>
								<input type="text"  class="<?php echo $clase_control;?>" name="<?php echo $row->nombre?>" id="<?php echo $row->nombre?>" size="32"  />

						<?php
								break;
							}
						echo ( $row->es_obligatorio)?'*':'';
						echo "<span id='err" . $row->nombre . "'></span>";
						?>
						<br/>
					</td>
				</tr>
		<?php	}
		}?>

	</table>
	</fieldset>
</div>
<div class="clr"></div>
<p>* Campos obligatorios</p>
<input type="hidden" name="option" value="com_formulario" />
<input type="hidden" name="formulario_id" value="<?php echo $this->formulario[0]->id; ?>" />
<input type="hidden" name="task" value="grabar" />
<input type="hidden" name="controller" value="formulario" />
<input type="submit" name="btnGrabar" value="Grabar"  class="button validate" />
</form>
