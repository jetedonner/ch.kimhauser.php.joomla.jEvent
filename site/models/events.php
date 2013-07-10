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
class JEventModelEvents extends JModel
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
		
	/**
	 * Deletes an event
	 * @return boolean TRUE if succeeded
	 */	
	function deleteEvent()
	{		
		$array = JRequest::getVar('cid',  0, '', 'array');
		//echo "In delete: " . (int)$array[0];
		
		$db =& JFactory::getDBO();
		$query = "DELETE FROM #__jevent_events WHERE idt_drivin_event = " . (int)$array[0];
		$db->setQuery($query);
		if(!$result = $db->query()){
			echo $db->stderr();
			return false;
		}else{
			return true;
		}
 		
	}			
	
	/**
	 * Add an new event
	 * @return boolean TRUE if succeeded
	 */
	 
	function check($dateTime)
	{
		//echo "In Function check()<br/>";
	    if (preg_match("/^(\d{2}).(\d{2}).(\d{4}) ([01][0-9]|2[0-3]):([0-5][0-9])$/", $dateTime, $matches))
	    { 
	        //if (checkdate($matches[2], $matches[3], $matches[1]))
	        //{ 
	            return true; 
	        //} 
	    } 
	    return false;
	}  
	
	function store()
	{	
		//echo "In function store()<br/>";
		//$row =& $this->getTable();
		$db		= JFactory::getDbo();
		
		$data = JRequest::get( 'post' );
		
		if($data["dt_event"] == '' ||
			$data["dt_event_time"] == '' ||
			$data["dt_event_end"] == '' ||
			$data["s_category"] == '' ||
			$data["s_place"] == '' ||
			$data["n_num_part"] == '' ||
			$data["s_price"] == ''  ){
			
			JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
			return 0;
		}else{
			try {
				// Make a MySQL Connection
				//echo "If data OK<br/>";
				$data =new stdClass();
				$data->idt_drivin_event = null;
				
				if($this->check($_POST['dt_event'] .  ' ' . $_POST['dt_event_time'])){
					//echo "Before createFromFormat<br/>";
				
					/*try {
					    $date = DateTime::createFromFormat('d.m.Y H:i:s', $_POST['dt_event'] .  ' ' . $_POST['dt_event_time'] . ':00');
					} catch (Exception $e) {
					    // For demonstration purposes only...
					    print_r(DateTime::getLastErrors());
					
					    // The real object oriented way to do this is
					    // echo $e->getMessage();
					}*/
					$date = DateTime::createFromFormat('d.m.Y H:i:s', $_POST['dt_event'] .  ' ' . $_POST['dt_event_time'] . ':00');
					//echo "After createFromFormat - Before date->format<br/>";
	
					$data->dt_event_time = $date->format('Y-m-d H:i:s') ;
					//echo "After date->format<br/>";
					
					if($this->check($_POST['dt_event'] .  ' ' . $_POST['dt_event_end'])){
						$date = DateTime::createFromFormat('d.m.Y H:i:s', $_POST['dt_event'] .  ' ' . $_POST['dt_event_end'] . ':00');
						$data->dt_event_end =   $date->format('Y-m-d H:i:s') ;
						
						if (!is_numeric($_POST['n_num_part'])) {
							JError::raiseWarning( 500, JText::_('Number of participants not valid!'));
							return 3;
						}
						
						$data->s_category = "" . $_POST['s_category'] . "";
						$data->s_description = "";
						$data->s_place = "" . $_POST['s_place'] . "";
						$data->n_num_part = $_POST['n_num_part'];
						$data->s_price = "" . $_POST['s_price'] . "";
						
						$db = JFactory::getDBO();
						//$db->insertObject( '#__jevent_events', $data, 'idt_drivin_event' );
			
						if(!$db->insertObject( '#__jevent_events', $data, 'idt_drivin_event' )){
							JError::raiseWarning( 500, $database->stderr());
							return 0;
						}
				
						//echo "Data Inserted!";
						return -1;
					}else{
						//echo "NO<br/>";
						JError::raiseWarning( 500, JText::_('Time to not valid!'));
						return 2;
					}
				}else{
					//echo "NO<br/>";
					JError::raiseWarning( 500, JText::_('Date or Time from not valid!'));
					return 1;
				}

					
			}catch (Exception $e) {
				//echo $e->getMessage();
				JError::raiseWarning( 500, $e->getMessage());
				return 0;
			}
		}
	}
	
	/**
	 * Update an event
	 * @return boolean TRUE if succeeded
	 */
	function update()
	{	
		
		
		//$row =& $this->getTable();
		$db		= JFactory::getDbo();
		
		$data = JRequest::get( 'post' );
		
		//echo "In func: " . $data["dt_event"];
		
		//echo "Param: " . $data["dt_event_upt"] . " / " . $data["dt_event_time_upt"]  . " / " . $data["dt_event_end_upt"] . " / " .
		//	$data["s_category_upt"] . " / " .	$data["s_place_upt"] . " / " . $data["n_num_part_upt"] . " / " . $data["s_price_upt"];
		//echo "<br/> $data['n_num_part_upt'] = " . $data["n_num_part_upt"]; 
		//echo "<br/>data[n_num_part_upt] = " . $data["n_num_part_upt"];
		//echo "<br/>data[n_num_part_upt] if = " . ($data["n_num_part_upt"] == '' ? '1' : '0');
		//return true;
		if($data["dt_event_upt"] == '' ||
			$data["dt_event_time_upt"] == '' ||
			$data["dt_event_end_upt"] == '' ||
			$data["s_category_upt"] == '' ||
			$data["s_place_upt"] == '' ||
			$data["n_num_part_upt"] == '' ||
			$data["s_price_upt"] == '' ||
			$_POST['id_upt'] == '' ){
			
			JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
			return false;
		}else{
			// Make a MySQL Connection
			$data =new stdClass();
			$data->idt_drivin_event = $_POST['id_upt'];
			
			//echo "id_upt: " . $_POST['id_upt'];
			
			$date = DateTime::createFromFormat('d.m.Y H:i:s', $_POST['dt_event_upt'] .  ' ' . $_POST['dt_event_time_upt'] . ':00');
			$data->dt_event_time = $date->format('Y-m-d H:i:s') ;

			$date = DateTime::createFromFormat('d.m.Y H:i:s', $_POST['dt_event_upt'] .  ' ' . $_POST['dt_event_end_upt'] . ':00');
			$data->dt_event_end =   $date->format('Y-m-d H:i:s') ;

			$data->s_category = "" . $_POST['s_category_upt'] . "";
			//$data->s_description = "";
			$data->s_place = "" . $_POST['s_place_upt'] . "";
			$data->n_num_part = $_POST['n_num_part_upt'];
			$data->s_price = "" . $_POST['s_price_upt'] . "";
			
			$db = JFactory::getDBO();
			if($db->updateObject( '#__jevent_events', $data, 'idt_drivin_event' )){
				return true;
			}else{
				JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
				return false;
			}
		}
	}
	
	/**
	 * Update the description of an event
	 * @return boolean TRUE if succeeded
	 */
	function updateDescription()
	{	
		//echo "In func: " . $data["dt_event"];
		//$row =& $this->getTable();
		$db		= JFactory::getDbo();
		
		$data = JRequest::get( 'post' );
		//echo "Param: " . $data["dt_event_upt"] . " / " . $data["dt_event_time_upt"]  . " / " . $data["dt_event_end_upt"] . " / " .
		//	$data["s_category_upt"] . " / " .	$data["s_place_upt"] . " / " . $data["n_num_part_upt"] . " / " . $data["s_price_upt"];
		
		//echo "ID: " . $_GET["nId"] . " Content: " . $_GET["content"] ;
		if($_GET["content"] == '' ||
			$_GET["nId"] == ''){
			JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
			return false;
		}else{
			// Make a MySQL Connection
			$data =new stdClass();
			$data->idt_drivin_event = $_GET['nId'];
			
			$data->s_description = $_GET["content"];
			
			$db = JFactory::getDBO();
			$db->updateObject( '#__jevent_events', $data, 'idt_drivin_event' );

			
			//echo "Data Updated!";
			return true;
		}
		return false;
	}
	
	
	/**
	 * Get all events
	 * @return recordset Recordset with all events
	 */	
	function getEventsExt($bOld)
	{
		
		$db		=& JFactory::getDBO();
		$query	= $db->getQuery(true);
		
		$query->select("DATE_FORMAT(t1.dt_event_time, '%d.%m.%Y')");
		$query->select("DATE_FORMAT(t1.dt_event_time, '%H:%i')");
		$query->select("DATE_FORMAT(t1.dt_event_end, '%H:%i')");
		$query->select($db->nameQuote('t1.s_category'));
		$query->select($db->nameQuote('t1.s_place'));
		$query->select($db->nameQuote('t1.s_price'));
		$query->select($db->nameQuote('t1.idt_drivin_event'));
		$query->select($db->nameQuote('t1.n_num_part'));
		$query->select('t1.`n_num_part` - (SELECT COUNT(t2.`idt_drivin_event_apply`) ' .
			' FROM #__jevent_events_apply as t2 ' .
			' WHERE t2.`idt_drivin_event` = t1.`idt_drivin_event`  AND t2.dt_cancel is null) as n_num_free');
		$query->select($db->nameQuote('t1.idt_drivin_event'));
		$query->select($db->nameQuote('t1.s_description'));
		$query->select($db->nameQuote('t1.dt_event_time'));
		$query->from('#__jevent_events as t1');
		if($bOld)
			$query->where($db->nameQuote('t1.dt_event_time') . '< current_timestamp()');
		else	
			$query->where($db->nameQuote('t1.dt_event_time') . '>= current_timestamp()');
		$query->order("t1.dt_event_time" . ($bOld ? " DESC" : ""));

		$db->setQuery($query);
		$link = $db->loadRowList();
		return $link;
	}
	
	/**
	 * Get all events
	 * @return recordset Recordset with all events (active)
	 */	
	function getEvents()
	{
		return $this->getEventsExt(false);
	}

	/**
	 * Get all events
	 * @return recordset Recordset with all events (old)
	 */		
	function getOldEvents()
	{
		return $this->getEventsExt(true);
	}
}
