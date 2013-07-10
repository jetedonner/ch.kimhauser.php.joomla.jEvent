<?php
/**
* @version      2.0.0 31.07.2010
* @author       MAXXmarketing GmbH
* @package      Jshopping
* @copyright    Copyright (C) 2010 webdesigner-profi.de. All rights reserved.
* @license      GNU/GPL
*/

defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.application.component.model');

class HellosModelLanguages extends JModel{ 
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
		/*if($data["show_red_light"] == '1')
			$show = '1';
		else
			$show = '0';
		
		if($data["show_debug_info"] == '1')
			$showDbg = '1';
		else
			$showDbg = '0';
		*/		
		//echo $data["content"];
		
		$insData = new stdClass();
		$insData->applicationEmail = JRequest::getVar( 'content', '', 'post', 'string', JREQUEST_ALLOWHTML ); // $data["content"];
		$insData->cancelEmail = JRequest::getVar( 'content2', '', 'post', 'string', JREQUEST_ALLOWHTML ); //$data["content2"];
		$insData->applicationSubject = JRequest::getVar( 'dsr_applicationSubject', '', 'post', 'string', JREQUEST_ALLOWHTML ); // $data["content"];
		$insData->cancelSubject = JRequest::getVar( 'dsr_cancelSubject', '', 'post', 'string', JREQUEST_ALLOWHTML ); //$data["content2"];
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

    function getAllLanguages($publish = 1) {
        $jshopConfig = &JSFactory::getConfig();
        $db =& JFactory::getDBO();
        $where_add = $publish ? "where `publish`='1'": ""; 
        $query = "SELECT * FROM `#__jshopping_languages` ".$where_add." order by `ordering`";
        $db->setQuery($query);
        $rowssort = array();
        $rows = $db->loadObjectList();
        foreach($rows as $k=>$v){
            $rows[$k]->lang = substr($v->language, 0, 2);
            if ($jshopConfig->cur_lang == $v->language) $rowssort[] = $rows[$k];
        }
        foreach($rows as $k=>$v){
            if (isset($rowssort[0]) && $rowssort[0]->language==$v->language) continue;
            $rowssort[] = $v;            
        }
        unset($rows);
        return $rowssort;
    }
      
}

?>