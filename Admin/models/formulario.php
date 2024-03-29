<?php
/**
 * Hellos Model for Hello World Component
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class adminformularioModelformulario extends JModel
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;
	var $_id;

	/**
	 * Constructor that retrieves the ID from the request
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
	}

	/**
	 * Method to set the hello identifier
	 *
	 * @access	public
	 * @param	int Hello identifier
	 * @return	void
	 */
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		$this->_data	= null;
	}

	/**
	 * Method to get a hello
	 * @return object with data
	 */
	function &getData()
	{


		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__formulario '.
					'  WHERE id = ' . $this->_id;

			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data)
		{

			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->titulo = null;
			$this->_data->tabla_mapeo=null;
			$this->_data->css_forma_clase=null;
			$this->_data->usar_notificacion=false;
			$this->_data->usar_envio=false;
			$this->_data->email_remitente=null;
		}
		return $this->_data;
	}
function &getDataUno()
	{

		$this->_id = JRequest::getVar('formulario_id',  0, '', '');

		// Load the data
		if (empty( $this->_data )) {
			$query = ' SELECT * FROM #__formulario '.
					'  WHERE id = ' . $this->_id;

			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data)
		{

			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->titulo = null;
			$this->_data->tabla_mapeo=null;
			$this->_data->css_forma_clase=null;
			$this->_data->usar_notificacion=false;
			$this->_data->usar_envio=false;
			$this->_data->email_remitente=null;
		}
		return $this->_data;
	}
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function grabar()
	{
		$row =& $this->getTable();

		$data = JRequest::get( 'post' );

		// Bind the form fields to the hello table
		if (!$row->bind($data)) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Make sure the hello record is valid
		if (!$row->check()) {
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		// Store the web link table to the database
		if (!$row->store()) {
			$this->setError( $row->getErrorMsg() );
			return false;
		}

		return true;
	}

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function borrar()
	{
		$cids = JRequest::getVar( 'cid', array(0), 'post', 'array' );

		$row =& $this->getTable();

		if (count( $cids )) {
			foreach($cids as $cid) {
				if (!$row->delete( $cid )) {
					$this->setError( $row->getErrorMsg() );
					return false;
				}
			}
		}
		return true;
	}

}