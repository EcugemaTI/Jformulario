<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
            <th width="5">
                <?php echo JText::_( 'ID' ); ?>
            </th>
	    <th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>			
            <th>
                <?php echo JText::_( 'Nombre' ); ?>
            </th>
            <th>
                <?php echo JText::_( 'Tipo' ); ?>
            </th>
	 
	    <th>
                <?php echo JText::_( 'Obligatorio' ); ?>
            </th>
        </tr>            
    </thead>
    <?php
    $k = 0;
    if(count($this->items)>0){
	foreach ($this->items as &$row)
	    {
	       
		$checked 	= JHTML::_('grid.id',   $i, $row->id );
		$link 		= JRoute::_( 'index.php?option=com_formulario&controller=campos&task=editar&cid[]='. $row->id . '&formulario_id=' . $this->formulario_id );
		?>
		<tr class="<?php echo "row" . $k; ?>">
		    <td>
			<?php echo $row->id; ?>
		    </td>
		    <td>
				<?php echo $checked; ?>
			</td>
		    <td>
			<a href="<?php echo $link; ?>"><?php echo $row->nombre; ?></a>
		    </td>
		    <td>
			<?php echo $row->tipo; ?>
		    </td>		    
		 	    		    
	    <td>
			<?php echo $row->es_obligatorio; ?>
		    </td>			    
		</tr>
		<?php
		$k = 1 - $k;
	    }
    }
    else
    {
    ?>
		<tr class="row0" >
		    <td>
			
		    </td>
		    <td>
			
		    </td>
		</tr>
		<?php
    }
    ?>
    </table>
</div>
 
<input type="hidden" name="option" value="com_formulario" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="formulario_id" value="<?php echo $this->formulario_id;?>" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="campos" />
 
</form>