<?php
/**
 * Hello Model for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.model');

/**
 * Hello Hello Model
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class HellosModelHello extends JModel
{
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
			$query = ' SELECT * FROM #__hello '.
					'  WHERE id = '.$this->_id;
			$this->_db->setQuery( $query );
			$this->_data = $this->_db->loadObject();
		}
		if (!$this->_data) {
			$this->_data = new stdClass();
			$this->_data->id = 0;
			$this->_data->greeting = null;
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
		$row =& $this->getTable();

		$data = JRequest::get( 'post' );
		//var_dump($data);
		
		$db =& JFactory::getDBO();
	    $sql = 'DELETE FROM #__jevent_admin_user';
	    $db->setQuery($sql);
	    $db->query();
	    
	   	$sql = 'DELETE FROM #__jevent_admin_usergroup';
	    $db->setQuery($sql);
	    $db->query();

		echo "BEFORE ARRAY: ";
		$array = JRequest::getVar('cid',  0, '', 'array');
		for($i = 0; $i < count($array); $i++){
			echo "(" . $array[$i] .") ";
			if($array[$i] != 0){
				$insData = new stdClass();
				$insData->idt_user = $array[$i];
				//insData->greeting = null;
				if(!$db->insertObject( '#__jevent_admin_user', $insData, 'idt_jevent_adminuser' )){
					$this->setError($db->stderr());
					return false;
				}
			}
		}
		
		echo "BEFORE ARRAY: ";
		$array = JRequest::getVar('cid2',  0, '', 'array');
		for($i = 0; $i < count($array); $i++){
			echo "ARRAY i: " . $array[$i];
			$insData = new stdClass();
			$insData->idt_usergroup = $array[$i];
			//insData->greeting = null;
			if(!$db->insertObject( '#__jevent_admin_usergroup', $insData, 'idt_jevent_adminusergroup' )){
				$this->setError($db->stderr());
				return false;
			}
		}
		
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

	/**
	 * Method to delete record(s)
	 *
	 * @access	public
	 * @return	boolean	True on success
	 */
	function delete()
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