<?php
/**
 * Hello World table class
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Hello Table class
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class TableCampo extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $id = null;

	/**
	 * @var string
	 */
	var $nombre = null;

	/**
	 * @var string
	 */
	var $etiqueta = null;

/**
	 * @var string
	 */
	var $tipo = null;

/**
	 * @var string
	 */
	var $combo_datos = null;

/**
	 * @var string
	 */
	var $expresion_regular = null;
	
/**
	 * @var bool
	 */
	var $es_obligatorio = 0;
	
	/**
	 * @var numeric
	 */
	var $formulario_id = 0;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableCampo(& $db) {
		parent::__construct('#__campos', 'id', $db);
	}
}