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
var $telefonocelular = null;
var $estadocivil = null;
var $apellidopaternoconyuge = null;
var $apellidomaternoconyuge = null;
var $nombresconyuge = null;
var $cedulaconyuge = null;
var $vivienda = null;
var $nombreempresaactual = null;
var $actividadempresa = null;
var $situacion = null;
var $cargo = null;
var $empciudad = null;
var $emptelefonofijo = null;
var $empdireccion = null;
var $empprofesion = null;
var $empresaanterior = null;
var $empanttiempotrabajo = null;
var $empanttelefonofijo = null;
var $banco = null;
var $tipodecuenta = null;
var $sueldomensual = null;
var $otrosingresos = null;
var $totalingresos = null;
var $tarjetasdecredito = null;
var $origendeotrosingresos = null;
var $referencia1apellidos = null;
var $referencia1nombres = null;
var $referencia1parentezco = null;
var $referencia1telefonotrab = null;
var $referencia1telefonodom = null;
var $referencia1telcel = null;
var $referencia2apellidos = null;
var $referencia2nombres = null;
var $referencia2parentezco = null;
var $referencia2telefonotrab = null;
var $referencia2telefonodom = null;
var $referencia2telefonocel = null;
var $reporterecibo = null;
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