<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Campos' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="nombre">
					<?php echo JText::_( 'Nombre' ); ?>:
				</label>
			</td>

			<td>
				<input class="text_area" type="text" name="nombre" id="nombre" size="32" maxlength="30" value="<?php echo $this->campo->nombre;?>" />
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key">
				<label for="etiqueta">
					<?php echo JText::_( 'Etiqueta' ); ?>:
				</label>
			</td>

			<td>
				<input class="text_area" type="text" name="etiqueta" id="etiqueta" size="32" maxlength="30" value="<?php echo $this->campo->etiqueta;?>" />
			</td>
		</tr><tr>
			<td width="100" align="right" class="key">
				<label for="tipo">
					<?php echo JText::_( 'Tipo' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="tipo" id="tipo" size="32" maxlength="30" value="<?php echo $this->campo->tipo;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="combo_datos">
					<?php echo JText::_( 'Datos de lista'); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="combo_datos" id="combo_datos" size="32" maxlength="30" value="<?php echo $this->campo->combo_datos;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="expresion_regular">
					<?php echo JText::_( 'Expresión regular' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="expresion_regular" id="expresion_regular" size="32" maxlength="30" value="<?php echo $this->campo->expresion_regular;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="es_obligatorio">
					<?php echo JText::_( 'Obligatorio' ); ?>:
				</label>
			</td>
			<td>

				<input class="text_area" type="radio" name="es_obligatorio" id="es_obligatorio0" <?php echo ($this->campo->es_obligatorio==true)?"checked":""; ?>  value="1" /> SI
				<input class="text_area" type="radio" name="es_obligatorio" id="es_obligatorio1" <?php echo (!$this->campo->es_obligatorio==true)?"checked":""; ?> value="0"/> NO
			</td>
			</tr>

	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_formulario" />
<input type="hidden" name="id" value="<?php echo $this->campo->id; ?>" />
<input type="hidden" name="formulario_id" value="<?php echo $this->formulario_id; ?>" />
<input type="hidden" name="task"  />
<input type="hidden" name="controller" value="campos" />
</form>
