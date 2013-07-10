<?php defined('_JEXEC') or die('Restricted access');
class jEventAdminConfig {
	
	var $showRedLight = 1;
	var $options = null;
	var $adminusers = null;
	var $admingroups = null;
	
	function __construct() {
       $this->options = $this->getOptions();
       $this->adminusers = $this->getAdminUsers();
       $this->admingroups = $this->getAdminGroups();
   }


	/**
	 * Retrieves the option data
	 * @return array Array of objects containing the option from the database
	 */
	function getOptions()
	{
		// Lets load the data if it doesn't already exist
		$db =& JFactory::getDBO();
		
		$query = ' SELECT * '
		. ' FROM #__jevent_admin_options ';

		$db->setQuery($query);
		$_data = $db->loadRowList();
		$this->showRedLight = $_data[0][1];
		$this->showDebugInfo = $_data[0][2];
		$this->phonenumber = $_data[0][5];
		return $_data[0];	
	}
	
	/**
	 * Check is user is edit user for frontend
	 * @return boolean True if user is edit user for frontend
	 */
	function isAdminUser($userid){
		for($i = 0; $i < count($this->adminusers); $i++){
			if($this->adminusers[$i] == $userid){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Check is group is edit group for frontend
	 * @return boolean True if group is edit group for frontend
	 */
	function isAdminGroup($groupid){
		for($i = 0; $i < count($this->admingroups); $i++){
			if($this->admingroups[$i][1] == $groupid){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Retrieves all admnin users
	 * @return recordset Recordset with all admin users
	 */
	function getAdminUsers()
	{
		// Lets load the data if it doesn't already exist
		$db =& JFactory::getDBO();
		
		$query = ' SELECT * '
		. ' FROM #__jevent_admin_user ';
		
		$db->setQuery($query);
		$_data = $db->loadRowList();
		return $_data[0];	
	}
	
	/**
	 * Retrieves all admnin groups
	 * @return recordset Recordset with all admin groups
	 */
	function getAdminGroups()
	{
		// Lets load the data if it doesn't already exist
		$db =& JFactory::getDBO();
		
		$query = ' SELECT * '
		. ' FROM #__jevent_admin_usergroup ';
		
		$db->setQuery($query);
		$_data = $db->loadRowList();
		return $_data;	
	}
}
?>