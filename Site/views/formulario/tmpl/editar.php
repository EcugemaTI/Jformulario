<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Formulario' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="greeting">
					<?php echo JText::_( 'Titulo' ); ?>:
				</label>
			</td>
		
			<td>
				<input class="text_area" type="text" name="titulo" id="titulo" size="32" maxlength="30" value="<?php echo $this->formulario->titulo;?>" />
			</td>
		</tr><tr>
			<td width="100" align="right" class="key">
				<label for="tabla_mapeo">
					<?php echo JText::_( 'Tabla de datos' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="tabla_mapeo" id="tabla_mapeo" size="32" maxlength="30" value="<?php echo $this->formulario->tabla_mapeo;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="css_forma_clase">
					<?php echo JText::_( 'Css formulario' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="css_forma_clase" id="css_forma_clase" size="32" maxlength="30" value="<?php echo $this->formulario->css_forma_clase;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="css_nombre">
					<?php echo JText::_( 'Archivo css' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="css_nombre" id="css_nombre" size="32" maxlength="30" value="<?php echo $this->formulario->css_nombre;?>" />
			</td>
			</tr><tr>
			<td width="100" align="right" class="key">
				<label for="usar_notificacion">
					<?php echo JText::_( 'Notificar administrador?' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="radio" name="usar_notificacion" id="usar_notificacion0" value="<?php ($this->formulario->usar_notificacion)?true:false; ?>"  /> SI
				<input class="text_area" type="radio" name="usar_notificacion" id="usar_notificacion1"  value="<?php (!$this->formulario->usar_notificacion)?true:false; ?>" /> NO
			</td>
			</tr>
			<tr>
			<td width="100" align="right" class="key">
				<label for="usar_envio">
					<?php echo JText::_( 'Notificar usuario?' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="radio" name="usar_envio" id="usar_envio0" value="<?php ($this->formulario->usar_envio)?true:false; ?>"  /> SI
				<input class="text_area" type="radio" name="usar_envio" id="usar_envio1"  value="<?php (!$this->formulario->usar_envio)?true:false; ?>" /> NO
			</td>
			</tr>
			<tr>
			<td width="100" align="right" class="key">
				<label for="css_nombre">
					<?php echo JText::_( 'Remitente' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="email_remitente" id="email_remitente" size="32" maxlength="60" value="<?php echo $this->formulario->email_remitente;?>" />
			</td>			
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_formulario" />
<input type="hidden" name="id" value="<?php echo $this->formulario->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="formularios" />
</form>
