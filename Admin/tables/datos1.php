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
	var $cedula = null;
	/**
	 * @var string
	 */
	var $apellidopaterno = null;
	/**
	 * @var string
	 */

	var $apellidomaterno = null;
	/**
	 * @var string
	 */
	var $nombres = null;

	/**
	 * @var string
	 */
	var $sexo = null;

	/**
	 * @var string
	 */
	var $fechadenacimiento = null;
	/**
	 * @var string
	 */
	var $nacionalidad = null;
	/**
	 * @var string
	 */

	var $ciudad = null;

	/**
	 * @var string
	 */
	var $domicilioactual = null;

	/**
	 * @var string
	 */
	var $tiempodomicilioactual = null;

	/**
	 * @var string
	 */

	var $telefonofijo = null;

	/**
	 * @var string
	 */

	var $telefonocelular = null;

	/**
	 * @var string
	 */

	var $estadocivil = null;

	/**
	 * @var string
	 */

	var $apellidopaternoconyuge = null;
	/**
	 * @var string
	 */

	var $apellidomaternoconyuge = null;
	/**
	 * @var string
	 */

	var $nombresconyuge = null;
	/**
	 * @var string
	 */

	var $cedulaconyuge = null;
	/**
	 * @var string
	 */

	var $vivienda = null;
	/**
	 * @var string
	 */

	var $nombreempresaactual = null;
	/**
	 * @var string
	 */

	var $actividadempresa = null;
	/**
	 * @var string
	 */

	var $situacion = null;
	/**
	 * @var string
	 */

	var $cargo = null;
	/**
	 * @var string
	 */

	var $empciudad = null;
	/**
	 * @var string
	 */

	var $emptelefonofijo = null;
	/**
	 * @var string
	 */

	var $empdireccion = null;
	/**
	 * @var string
	 */

	var $empprofesion = null;
	/**
	 * @var string
	 */

	var $empresaanterior = null;
	/**
	 * @var string
	 */

	var $empanttiempotrabajo = null;
	/**
	 * @var string
	 */

	var $empanttelefonofijo = null;
	/**
	 * @var string
	 */

	/**
	 * @var string
	 */

	var $banco = null;
	/**
	 * @var string
	 */

	var $tipodecuenta = null;
	/**
	 * @var string
	 */


	var $sueldomensual = null;
	/**
	 * @var string
	 */

	var $otrosingresos = null;
	/**
	 * @var string
	 */

	var $totalingresos = null;
	/**
	 * @var string
	 */

	var $tarjetasdecredito = null;
	/**
	 * @var string
	 */

	var $origendeotrosingresos = null;
	/**
	 * @var string
	 */

	var $referencia1apellidos = null;
	/**
	 * @var string
	 */

	var $referencia1nombres = null;
	/**
	 * @var string
	 */

	var $referencia1parentezco = null;
	/**
	 * @var string
	 */

	var $referencia1telefonotrab = null;
	/**
	 * @var string
	 */

	var $referencia1telefonodom = null;
	/**
	 * @var string
	 */

	var $referencia1telcel = null;
	/**
	 * @var string
	 */

	var $referencia2apellidos = null;
	/**
	 * @var string
	 */

	var $referencia2nombres = null;
	/**
	 * @var string
	 */

	var $referencia2parentezco = null;
	/**
	 * @var string
	 */

	var $referencia2telefonotrab = null;
	/**
	 * @var string
	 */

	var $referencia2telefonodom = null;
	/**
	 * @var string
	 */

	var $referencia2telefonocel = null;
	/**
	 * @var string
	 */

	var $reporterecibo = null;
	/**
	 * @var string
	 */

	var $email = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableDatos1(& $db) {
		parent::__construct('datos1', 'id', $db);
	}
}