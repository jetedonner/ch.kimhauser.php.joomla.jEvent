<?php
/**
 * Hello Model for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class JEventModelParticipants extends JModel
{
	/**
	 * Gets the greeting
	 * @return string The greeting to be displayed to the user
	 */
	function getGreeting()
	{
		$db =& JFactory::getDBO();

		$query = 'SELECT greeting FROM #__hello';
		$db->setQuery( $query );
		$greeting = $db->loadResult();

		return $greeting;
	}
	
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
		$this->setCanceled(false);
	}

	/**
	 * setId Function set's id for all other functions
	 * @return void
	 */	
	function setId($id)
	{
		// Set id and wipe data
		$this->_id		= $id;
		//$this->_data	= null;
	}
	

	/**
	 * setCanceled Function set's application as canceled
	 * @return void
	 */	
	function setCanceled($canceled)
	{
		// Set id and wipe data
		$this->_canceled= $canceled;
		//$this->_data	= null;
	}

	/**
	 * Gets the choosen event by it's id
	 * @return array Recordset-Array with event-data
	 */	
	function getEventById()
	{
		//echo "From ByID: " . $this->_id;
		$eventId = 1;
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select("DATE_FORMAT(dt_event_time, '%d.%m.%Y')");
		$query->select("DATE_FORMAT(dt_event_time, '%H:%i')");
		$query->select("DATE_FORMAT(dt_event_end, '%H:%i')");
		$query->select($db->nameQuote('t1.s_category'));
		$query->select($db->nameQuote('t1.s_place'));
		$query->select($db->nameQuote('t1.s_price'));
		$query->select($db->nameQuote('t1.idt_drivin_event'));
		$query->select($db->nameQuote('t1.n_num_part'));
		$query->select('t1.`n_num_part` - (SELECT COUNT(t2.`idt_drivin_event_apply`) ' .
			' FROM #__jevent_events_apply as t2 ' .
			' WHERE t2.`idt_drivin_event` = t1.`idt_drivin_event` AND t2.dt_cancel is null) as n_num_free');
		$query->from('#__jevent_events as t1');
		$query->where($db->nameQuote('idt_drivin_event') . '=' . $this->_id);

		$db->setQuery($query);
		if ($link = $db->loadRowList()) {
		}
		return $link;
	}
	
	/**
	 * Gets the choosen event by it's id
	 * @return array Recordset-Array with event-data
	 */	
	function getEventListById($bCanceled)
	{

		//return "Insidee";
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);

		$query->select($db->nameQuote('s_name'));
		$query->select($db->nameQuote('s_prename'));
		$query->select($db->nameQuote('s_address'));
		$query->select($db->nameQuote('s_plz'));
		$query->select($db->nameQuote('s_city'));
		$query->select($db->nameQuote('s_phone'));
		$query->select($db->nameQuote('s_email'));
		$query->select($db->nameQuote('idt_drivin_event_apply')); 
		$query->select($db->nameQuote('s_title')); 
		$query->select($db->nameQuote('dt_ins'));
		$query->select($db->nameQuote('dt_cancel'));
		$query->from($db->nameQuote('#__jevent_events_apply'));
		$query->where($db->nameQuote('idt_drivin_event') . '=' . $this->_id);
		if(!$bCanceled)
			$query->where($db->nameQuote('dt_Cancel') . ' is null');
		else
			$query->where($db->nameQuote('dt_Cancel') . ' is not null');

		$db->setQuery($query);
		if ($link = $db->loadRowList()) {
		}
		//echo "Insidee";
		return $link;
	}

	/**
	 * Gets the choosen event by it's id
	 * @return array Recordset-Array with event-data
	 */		
	function getEventListByIdGood(){
		return $this->getEventListById(false);
	}
	
	/**
	 * Gets the choosen event (old) by it's id
	 * @return array Recordset-Array with event-data
	 */		
	function getEventListByIdCanceled(){
		return $this->getEventListById(true);
	}

}
