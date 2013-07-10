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

require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'sendMail.php');

jimport( 'joomla.application.component.model' );

/**
 * Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class JEventModelApply extends JModel

{
	//global $mainframe; 
	function __construct()
	{
		parent::__construct();

		$array = JRequest::getVar('cid',  0, '', 'array');
		$this->setId((int)$array[0]);
		$this->setId2((int)$array[0]);
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
	 * setId2 Function set's id2 for all other functions
	 * @return void
	 */		
	function setId2($id)
	{
		// Set id and wipe data
		$this->_id2		= $id2;
		//$this->_data	= null;
	}
	
	/**
	 * resendApplicationEmail Function gets 
	 * infos for application email and sends it
	 * @return void
	 */	
	function resendApplicationEmail(){
		//echo "resend... AppReID: " . $_POST['appReId'];
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
		$query->from($db->nameQuote('#__jevent_events_apply'));
		$query->where($db->nameQuote('idt_drivin_event_apply') . '=' . $_POST['appReId']);
		if(!$bCanceled)
			$query->where($db->nameQuote('dt_Cancel') . ' is null');
		else
			$query->where($db->nameQuote('dt_Cancel') . ' is not null');

		$db->setQuery($query);
		if ($link = $db->loadRowList()) {
			//echo " Count: " . count($link);
			//echo " Item: " . $link[0][0];
			$mailer = new jEventMailer();
			//$mailer->test();
			if(!$mailer->sendApplicationEmail2(1, $link, $this->getEventById(), false)){
				$this->setError($mailer->error);
				echo "Eroooor " . $mailer->error;
			}
		}else{
			echo "No Records found";
		}
		return true;
	}
	
	/**
	 * resendCancelEmail Function gets 
	 * infos for cancel email and sends it
	 * @return void
	 */	
	function resendCancelEmail(){
		//echo "resend...";
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		if($_POST['cancelReId'] == '')
			$nId = $_POST['appCanId'];
		else
			$nId = $_POST['cancelReId'];

		$query->select($db->nameQuote('s_name'));
		$query->select($db->nameQuote('s_prename'));
		$query->select($db->nameQuote('s_address'));
		$query->select($db->nameQuote('s_plz'));
		$query->select($db->nameQuote('s_city'));
		$query->select($db->nameQuote('s_phone'));
		$query->select($db->nameQuote('s_email'));
		$query->select($db->nameQuote('idt_drivin_event_apply')); 
		$query->select($db->nameQuote('s_title'));		
		$query->from($db->nameQuote('#__jevent_events_apply'));
		$this->_id2 = $nId;
		$query->where($db->nameQuote('idt_drivin_event_apply') . '=' . $nId);
		//if(!$bCanceled)
		//	$query->where($db->nameQuote('dt_Cancel') . ' is null');
		//else
			$query->where($db->nameQuote('dt_Cancel') . ' is not null');
		//echo "SQLSTRING: " . $query;
		$db->setQuery($query);
		if ($link = $db->loadRowList()) {
			$mailer = new jEventMailer();
			//$mailer->test();
			
			if(!$mailer->sendApplicationEmail2(1, $link, $this->getEventById2(), true)){
				$this->setError($mailer->error);
				echo "Eroooor " . $mailer->error;
			}
		}else{
			echo "No Record Found! ReID: ". $nId;
		}
		return true;
	
	}
	
	/**
	 * Gets the choosen event by it's id
	 * @return array Recordset-Array with event-data
	 */	
	function getEventById()
	{
		//echo " From ByID: " . $this->_id;
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
		//echo " From ByID: " . count($link);
		//echo " From ByID: " . $query;
		return $link;
	}
	
	
	/**
	 * Gets the choosen event by it's id
	 * @return array Recordset-Array with event-data
	 */	
	function getEventById2()
	{
		//echo "From ByID2: " . $this->_id2;
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
		//echo " From ByID2: " . count($link);
		//echo " From ByID2: " . $query;
		return $link;
	}
	
	//global $mainframe; 
	/**
	 * Cancel an event
	 * @return boolean TRUE if succeeded
	 */	
	function cancel(){
		//echo "In Cancel";
		
		//echo 'Das aktuelle Datum und die aktuelle Zeit ist: ';
		//echo  JFactory::getDate('now', JFactory::getApplication()->getCfg('offset'))->toFormat() . "\n<br/><br/>";
		
		//$date = JFactory::getDate();
		//$date->setOffset(JFactory::getApplication()->getCfg('offset'));
	 
	 	//echo "Offset: " . JFactory::getApplication()->getCfg('offset');
		//echo 'Das aktuelle Datum und die aktuelle Zeit ist: ' . $date->toFormat() . "\n";
		$date =& JFactory::getDate($time= 'now', $tzOffset=0);

		//$date->setOffset($mainframe->getCfg('offset'));
		//echo 'Das aktuelle Datum und die aktuelle Zeit ist: ' . $date->toFormat();
		
		//echo "New date: " . date('Y-m-d H:i:s');

		//return false;
		
		$insData =new stdClass();
		$insData->idt_drivin_event_apply = $_POST['appCanId'];

		//$date = new DateTime();
		$insData->dt_cancel =  date('Y-m-d H:i:s'); //'CURRENT_TIMESTAMP';//$date->getTimestamp();
		
		$db = JFactory::getDBO();
		if(!$db->updateObject( '#__jevent_events_apply', $insData, 'idt_drivin_event_apply' )){
			echo $database->stderr();
			return false;
		}
		return true;//resendCancelEmailById($insData->idt_drivin_event_apply);
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
		
		if($data["dsr_txt_prename"] == '' ||
			$data["dsr_txt_name"] == '' ||
			$data["dsr_txt_address"] == '' ||
			$data["dsr_txt_plz"] == '' ||
			$data["dsr_txt_city"] == '' ||
			$data["dsr_txt_phone"] == '' ||
			$data["dsr_txt_email"] == '' ||
			!filter_var($_POST["dsr_txt_email"], FILTER_VALIDATE_EMAIL) ){
			
			JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
			return false;
		}else{
			// Make a MySQL Connection
			//return true;
			
			$insData =new stdClass();
			$insData->idt_drivin_event_apply = $_POST['id_upt'];
			//$data->idt_drivin_event = $_POST['id_upt'];
			
			$insData->s_name = $data["dsr_txt_name"];
			$insData->s_prename = $data["dsr_txt_prename"];
			$insData->s_address = $data["dsr_txt_address"];
			$insData->s_plz = $data["dsr_txt_plz"] ;
			$insData->s_city = $data["dsr_txt_city"];
			$insData->s_phone = $data["dsr_txt_phone"];
			$insData->s_email = $data["dsr_txt_email"];
			$insData->dt_cancel = null;
			$insData->s_title = $data["dsr_title"];
			
			$db = JFactory::getDBO();
			if(!$db->updateObject( '#__jevent_events_apply', $insData, 'idt_drivin_event_apply' )){
				echo $database->stderr();
				return false;
			}

			
			//echo "Data Updated!";
			//return true;
			return true;
		}
	}
	
	function check($email)
	{
		//echo "In Function check()<br/>";
	    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email, $matches))
	    { 
	        //if (checkdate($matches[2], $matches[3], $matches[1]))
	        //{ 
	            return true; 
	        //} 
	    } 
	    return false;
	}  
	/**
	 * Add an new event
	 * @return boolean TRUE if succeeded
	 */	
	function store()
	{	
		//$row =& $this->getTable();
		$db		= JFactory::getDbo();
		
		$data = JRequest::get( 'post' );
		
		if($data["dsr_txt_prename"] == '' ||
			$data["dsr_txt_name"] == '' ||
			$data["dsr_txt_address"] == '' ||
			$data["dsr_txt_plz"] == '' ||
			$data["dsr_txt_city"] == '' ||
			$data["dsr_txt_phone"] == '' ||
			$data["dsr_txt_email"] == '' ||
			$data["dsr_chk_AGB"] == "" ||
			$data["dsr_title"] == "" ||
			!filter_var($_POST["dsr_txt_email"], FILTER_VALIDATE_EMAIL) ){
			
			JError::raiseWarning( 500, JText::_('COM_JEVENT_LBL_CORRECT_ERRORS') );
			return false;
		}
		
		/*if(!$this->check($data["dsr_txt_email"] )){
			JError::raiseWarning( 500, JText::_('Email not valid!') );
			return false;
		}*/
			
		$insData =new stdClass();
		//$insData->idt_drivin_event_apply = $_POST['id_upt'];
		$insData->idt_drivin_event = $_POST["applyEventId"];
		
		$insData->s_name = $data["dsr_txt_name"];
		$insData->s_prename = $data["dsr_txt_prename"];
		$insData->s_address = $data["dsr_txt_address"];
		$insData->s_plz = $data["dsr_txt_plz"] ;
		$insData->s_city = $data["dsr_txt_city"];
		$insData->s_phone = $data["dsr_txt_phone"];
		$insData->s_email = $data["dsr_txt_email"];
		$insData->dt_cancel = null;
		$insData->s_title = $data["dsr_title"];
				
		$db = JFactory::getDBO();
		if(!$db->insertObject( '#__jevent_events_apply', $insData, 'idt_drivin_event_apply' )){
			echo $db->stderr();
			//return false;
			$bSQLOk = false;
		}else{
			$bSQLOk = true;
			//test();
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
		$query->from($db->nameQuote('#__jevent_events_apply'));
		$query->where($db->nameQuote('idt_drivin_event_apply') . '=' . $db->insertid());
		if(!$bCanceled)
			$query->where($db->nameQuote('dt_Cancel') . ' is null');
		else
			$query->where($db->nameQuote('dt_Cancel') . ' is not null');

		$db->setQuery($query);
		//if ($link = $db->loadRowList()) {
		$link = $db->loadRowList();
			$mailer = new jEventMailer();
			//$mailer->test();
			if(!$mailer->sendApplicationEmail2($db->insertid(), $link, $this->getEventById())){
				$this->setError($mailer->error);
				echo "Eroooor " . $mailer->error;
			}
		}
			
		//if($bSQLOk)
		//	$bMailOk = sendApplicationEmail($_POST["dsr_txt_email"], $_POST["applyEventId"]);
		//else
		//	$bMailOk = false;
		//$mailer = new jEventMailer();
		//$mailer->test();

		// Bind the form fields to the hello table
		/*if (!$row->bind($data)) {
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
		}*/

		return true;
	}
}
