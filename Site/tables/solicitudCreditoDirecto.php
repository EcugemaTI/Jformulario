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
class TableDatos1 extends JTable
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
	var $fullname = null;

	/**
	 * @var string
	 */
	var $campo2 = null;

	
	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableDatos1(& $db) {
		parent::__construct('datos1', 'id', $db);
	}
}