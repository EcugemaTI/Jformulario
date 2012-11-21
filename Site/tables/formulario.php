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
class TableFormulario extends JTable
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
	var $titulo = null;

	/**
	 * @var string
	 */
	var $tabla_mapeo = null;

/**
	 * @var string
	 */
	var $css_forma_clase = null;

/**
	 * @var string
	 */
	var $css_nombre = null;

/**
	 * @var string
	 */
	var $usar_notificacion = 1;
	
/**
	 * @var string
	 */
	var $usar_envio = 1;
	
	/**
	 * @var string
	 */
	var $email_remitente = null;
	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableFormulario(& $db) {
		parent::__construct('#__formulario', 'id', $db);
	}
}