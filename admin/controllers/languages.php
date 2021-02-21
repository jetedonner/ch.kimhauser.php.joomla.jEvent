<?php
/**
* @version      1.0.1 (2021-02-21)
* @author       kimhauser.ch, kim@kimhauser.ch (Kim-Daivd Hauser)
* @package      ch.kimhauser.php.joomla.jEvent
* @link 		https://github.com/jetedonner/ch.kimhauser.php.joomla.jEvent
* @copyright    Copyright (C) 1991 - 2021 kimhauser.ch. All rights reserved.
* @license      GNU/GPL
*/

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');

class HellosControllerLanguages extends JController{
    
    function __construct( $config = array() ){
        parent::__construct( $config );
        //checkAccessController("languages");
        //addSubmenu("other");
        
        $this->registerTask( 'apply',    'save');
    }

    function display(){  	        		
        
        //$languages = &$this->getModel("languages");
        //$rows = $languages->getAllLanguages(0);
        //$jshopConfig = &JSFactory::getConfig();        
                
		//$view=&$this->getView("languages_list", 'html');		
        //$view->assign('rows', $rows);
        //$view->assign('default_front', $jshopConfig->frontend_lang);
        //$view->assign('defaultLanguage', $jshopConfig->defaultLanguage);
		//$view->display(); 
        
    }

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		//echo "IN SAVING";
		$model = $this->getModel('languages');

		if ($model->store($post)) {
			$msg = JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_MAILTEXTS_SAVED' );
		} else {
			$msg = JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_MAILTEXTS_SAVEING_ERROR' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_jEvent&view=languages';
		$this->setRedirect($link, $msg);
		//JRequest::setVar( 'view', 'options' );
		//JRequest::setVar( 'layout', 'default'  );
		//parent::display();
	}
	
	
	/**
	 * cancel editing a record
	 * @return void
	 */
	function cancel()
	{
		$msg = JText::_( 'Operation Cancelled' );
		$this->setRedirect( 'index.php?option=com_jEvent', $msg );
	}
	   
    function publish(){
        $this->publishLanguage(1);
    }
    
    function unpublish(){
        $this->publishLanguage(0);
    }

    function publishLanguage($flag) {
        $db = &JFactory::getDBO();
        $cid = JRequest::getVar("cid");
        foreach ($cid as $key => $value) {
            $query = "UPDATE `#__jshopping_languages` SET `publish` = '" . $db->getEscaped($flag) . "' WHERE `id` = '" . $db->getEscaped($value) . "'";
            $db->setQuery($query);
            $db->query();
        }
        $this->setRedirect("index.php?option=com_jshopping&controller=languages");
    }
}
?>