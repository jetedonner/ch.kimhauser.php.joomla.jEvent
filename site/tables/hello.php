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
class TableEvents extends JTable
{
	/**
	 * Primary Key
	 *
	 * @var int
	 */
	//var $id = null;

	/**
	 * @var string
	 */
	//var $greeting = null;
	
	//var $idt_drivin_event = null;
	//var $dt_event_time = null;
	//var $dt_event_end = null;
	var $s_category = null;
	//var $s_description = null;
	var $s_place = null;
	var $n_num_part = null;
	var $s_price = null;


	/**
	 * Constructor
	 *
	 * @param object Database connector object
	 */
	function TableHello(& $db) {
		parent::__construct('#__jevent_events', 'idt_drivin_event', $db);
	}
}