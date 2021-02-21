<?php
/**
* Controller for Admin Component
* @version      1.0.1 (2021-02-21)
* @author       kimhauser.ch, kim@kimhauser.ch (Kim-Daivd Hauser)
* @package      ch.kimhauser.php.joomla.jEvent
* @link 		https://github.com/jetedonner/ch.kimhauser.php.joomla.jEvent
* @copyright    Copyright (C) 1991 - 2021 kimhauser.ch. All rights reserved.
* @license      GNU/GPL
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Admin Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class HellosControllerHello extends HellosController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'edit' );
		$this->registerTask( 'apply',    'save');

	}

	/**
	 * display the edit form
	 * @return void
	 */
	function edit()
	{
		JRequest::setVar( 'view', 'hello' );
		JRequest::setVar( 'layout', 'form'  );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();
	}

	/**
	 * save a record (and redirect to main page)
	 * @return void
	 */
	function save()
	{
		$model = $this->getModel('hello');

		if ($model->store($post)) {
			$msg = JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_USER_SAVED' );
		} else {
			$msg = $model->getError();
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_jEvent';
		$this->setRedirect($link, $msg);
	}

	/**
	 * remove record(s)
	 * @return void
	 */
	function remove()
	{
		$model = $this->getModel('hello');
		if(!$model->delete()) {
			$msg = JText::_( 'Error: One or More Greetings Could not be Deleted' );
		} else {
			$msg = JText::_( 'Greeting(s) Deleted' );
		}

		$this->setRedirect( 'index.php?option=com_jEvent', $msg );
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
}