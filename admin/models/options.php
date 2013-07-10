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
class HellosModelOptions extends JModel
{
	/**
	 * Hellos data array
	 *
	 * @var array
	 */
	var $_data;


	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery()
	{
		$query = ' SELECT * '
			. ' FROM #__jevent_admin_options '
		;

		return $query;
	}

	/**
	 * Retrieves the hello data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery();
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}
	
	/**
	 * Method to store a record
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function store()
	{	
		//$row =& $this->getTable();

		$data = JRequest::get( 'post' );
		//var_dump($data);
		
		$db =& JFactory::getDBO();
		//var_dump($data);
		if($data["show_red_light"] == '1')
			$show = '1';
		else
			$show = '0';
		
		if($data["show_debug_info"] == '1')
			$showDbg = '1';
		else
			$showDbg = '0';
				
		$insData = new stdClass();
		$insData->showRedLight = $show;
		$insData->showDebugInfo = $showDbg;
		$insData->phonenumber = $data["phonenumber"];
		$insData->idt_jevent_admin_options = 1;
		if(!$db->updateObject( '#__jevent_admin_options', $insData, 'idt_jevent_admin_options' )){
			$this->setError($db->stderr());
			echo $db->stderr();
			return false;
		}
	    //$sql = 'DELETE FROM #__jevent_admin_user';
	    //$db->setQuery($sql);
	    //$db->query();

		/*
		$array = JRequest::getVar('cid',  0, '', 'array');
		for($i = 0; $i < count($array); $i++){
			//echo $array[$i];
			$insData = new stdClass();
			$insData->idt_user = $array[$i];
			//insData->greeting = null;
			if(!$db->updateObject( '#__jevent_admin_user', $insData, 'idt_jevent_adminuser' )){
				$this->setError($db->stderr());
				return false;
			}
		}*/
		
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