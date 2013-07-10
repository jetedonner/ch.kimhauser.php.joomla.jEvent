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
class TableApply extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	var $idt_drivin_event_apply = null;
	var $s_name = '';
	var $s_prename = '';
	var $s_address = '';
	var $s_plz = '';
	var $s_city = '';
	var $s_phone = '';
	var $s_email = '';
	var $idt_drivin_event = -1;
	var $dt_cancel = null;

	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableApply(& $db) {
		parent::__construct('t_drivin_event_apply', 'idt_drivin_event_apply', $db); //#__hello
	}
}