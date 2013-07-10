<?php
/**
 * Hello Controller for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Hello Hello Controller
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class JEventControllerApply extends JEventController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add'  , 	'apply' );
		$this->registerTask( 'add'  , 	'saveApplication' );
		$this->registerTask( 'add'  , 	'editEvent' );
		$this->registerTask( 'add'  , 	'addEvent' );
		$this->registerTask( 'add'  , 	'saveNewEvent' );
		$this->registerTask( 'add'  , 	'deleteEvent' );
		$this->registerTask( 'add'  , 	'updateEvent' );
		$this->registerTask( 'add'  , 	'editApplication' );
		$this->registerTask( 'add'  , 	'updateApplication' );
		$this->registerTask( 'add'  , 	'resendApplicationEmail' );
		$this->registerTask( 'add'  , 	'resendCancelEmail' );
		$this->registerTask( 'add'  , 	'cancelApplication' );
		$this->registerTask( 'add'  , 	'showAGB' );
		$this->registerTask( 'add'  , 	'showDescription' );
		$this->registerTask( 'add'  , 	'saveDescription' );
		$this->registerTask( 'add'  , 	'cancel' );
		$this->registerTask( 'add'  , 	'cancel2' );
		$this->registerTask( 'add'  , 	'reloadView1' );
	}


	/**
	 * Save description of event 
	 * @return void	 
	 */
	function saveDescription(){
		//echo "saveDescription";
		$model = $this->getModel('events');
		
		if($model->updateDescription($post)){
			//JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_APPLICATION_CANCELED' ) );
			echo "<script>window.close();</script>";
		}else{
		
		}
		//JRequest::setVar( 'view', 'events' );
		//JRequest::setVar( 'layout', 'description'  );
		//JRequest::setVar( 'tmpl', 'component'  );
		//&amp;tmpl=component
		//parent::display();
	}
	
	/**
	 * Show description of event 
	 * @return void	 
	 */
	function showDescription(){
		JRequest::setVar( 'view', 'events' );
		JRequest::setVar( 'layout', 'description'  );
		JRequest::setVar( 'tmpl', 'component'  );
		//&amp;tmpl=component
		parent::display();
	}

	/**
	 * Show AGB for application 
	 * @return void	 
	 */
	function showAGB(){
		JRequest::setVar( 'view', 'apply' );
		JRequest::setVar( 'layout', 'disclaimer'  );
		JRequest::setVar( 'tmpl', 'component'  );
		//&amp;tmpl=component
		parent::display();
	}
	
	/**
	 * Cancel application 
	 * @return void	 
	 */
	function cancelApplication(){
		//echo "Cancel Application";
		$model = $this->getModel('apply');
		
		if($model->cancel($post)){
			//$model = $this->getModel('apply');
		
			if($model->resendCancelEmail($post)){
			
			}
			//$msg = JText::_( 'COM_JEVENT_TXT_APPLICATION_CANCELED' );
			JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_APPLICATION_CANCELED' ) );
			JRequest::setVar( 'view', 'participants' );
			JRequest::setVar( 'layout', 'default'  );
			parent::display();
		}else{
		
		}
		//JRequest::setVar( 'view', 'participants' );
		//JRequest::setVar( 'layout', 'default'  );
		//parent::display();
	}
	
	/**
	 * Resend application email
	 * @return void
	 */
	function resendApplicationEmail(){
		$model = $this->getModel('apply');
		
		if($model->resendApplicationEmail($post)){
		
		}
		//$msg = JText::_( 'COM_JEVENT_TXT_APPLICATION_EMAIL_RESENT' );
		JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_APPLICATION_EMAIL_RESENT' ) );
		JRequest::setVar( 'view', 'participants' );
		JRequest::setVar( 'layout', 'default'  );
		parent::display();
	}
	
	/**
	 * Resend cancel email 
	 * @return void
	 */
	function resendCancelEmail(){
		
		$model = $this->getModel('apply');
		
		if($model->resendCancelEmail($post)){
		
		}
		//$msg = JText::_( 'COM_JEVENT_TXT_CANCEL_EMAIL_RESENT' );
		JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_CANCEL_EMAIL_RESENT' ) );
		JRequest::setVar( 'view', 'participants' );
		JRequest::setVar( 'layout', 'default'  );
		parent::display();
	}
	
	/**
	 * Update application
	 * @return void	 
	 */
	function updateApplication(){
		//echo "Upt";
		$model = $this->getModel('apply');
		
		if ($model->update($post)) {
			//$msg = JText::_( 'COM_JEVENT_TXT_APPLICATION_UPDATED' );
			JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_APPLICATION_UPDATED' ) );
			JRequest::setVar( 'view', 'participants' );
			JRequest::setVar( 'layout', 'default'  );
			//document.getElementById('cid[]').value = idEdit;
			//JRequest::setVar( 'flagUpt', '3'  );
			JRequest::setVar( 'cid[]', 0 );
			JRequest::setVar( 'appId', 0 );
			parent::display();
		} else {
			//$msg = JText::_( 'COM_JEVENT_TXT_APPLICATION_ERROR_SAVEING' );
			//echo "Saveing: " . $_POST['cid[]'];
			JRequest::setVar( 'view', 'participants' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'cid[]', $_POST['cid[]'] );
			JRequest::setVar( 'flagUpt', '2'  );
			//$array = JRequest::getVar('cid',  0, '', 'array');
			//JRequest::setVar( 'bOk', (int)$array[0]  );
			JRequest::setVar( 'bOk', $_POST['appId']  );
			parent::display();
		}
	}
	
	/**
	 * Edit application 
	 * @return void	 
	 */
	function editApplication(){
		JRequest::setVar( 'view', 'participants' );
		JRequest::setVar( 'layout', 'default'  );
		//JRequest::setVar( 'flagUpt', ''  );
		parent::display();
		//controller=participants&task=participants&cid[0]=13
	}
	
	/**
	 * Update event 
	 * @return void	 
	 */
	function updateEvent(){
		$model = $this->getModel('events');
		
		if ($model->update($post)) {
			//echo "after update";
			//$msg = JText::_( 'COM_JEVENT_TXT_EVENT_UPDATED' );
		
			JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_EVENT_UPDATED' ) );
			
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'flagUpt', '0'  );
			JRequest::setVar( 'bOk', '0'  );
			
			parent::display();
		} else {
			//JError::raiseError( 4711, JText::_( 'COM_JEVENT_TXT_EVENT_ERROR_SAVEING' ) );
			//JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_EVENT_ERROR_SAVEING' ) );
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'flagUpt', '2'  );
			$array = JRequest::getVar('cid',  0, '', 'array');
			//$this->setId((int)$array[0]);
			JRequest::setVar( 'bOk', (int)$array[0]  );
			parent::display();
		}
	}
	
	/**
	 * Delete event 
	 * @return void
	 */	
	function deleteEvent(){
		$model = $this->getModel('events');
		
		if ($model->deleteEvent($post)) {
			//$msg = JText::_( 'COM_JEVENT_TXT_EVENT_DELETED' );
			JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_EVENT_DELETED' ) );
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			
			parent::display();
		}else{
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'flagUpt', '0'  );
			parent::display();
		}
	
	}
	
	/**
	 * Save new event 
	 * @return void	 
	 */
	function saveNewEvent(){
		$model = $this->getModel('events');
		
		$nRet = $model->store($post);
		if ( $nRet == -1 ) {
			//$msg = JText::_( 'COM_JEVENT_TXT_EVENT_NEW_SAVED' );
			
			JFactory::getApplication()->enqueueMessage( JText::_( 'COM_JEVENT_TXT_EVENT_NEW_SAVED' ) );
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'bOk', 2 );
			//JRequest::setVar( 'nRet', $nRet );
			parent::display();
		} else if($nRet >= 0 ) {
			//echo "After $model->store($post) Return FALSE<br/>";
			$msg = JText::_( 'COM_JEVENT_TXT_EVENT_ERROR_SAVEING' );
			$type = 'error';
			
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			JRequest::setVar( 'nRet', $nRet );
			JRequest::setVar( 'bOk', 1 );
			parent::display();
		}
		
	}
	
	/**
	 * Save application 
	 * @return void	 
	 */
	function saveApplication(){
		$model = $this->getModel('apply');

		if ($model->store($post)) {
			//$msg = JText::sprintf( 'COM_JEVENT_TXT_APPLICATION_NEW_SAVED', $_POST['dsr_txt_email"], $_POST["dsr_txt_email"] );
			
			JFactory::getApplication()->enqueueMessage( JText::sprintf( 'COM_JEVENT_TXT_APPLICATION_NEW_SAVED', $_POST['dsr_txt_email'], $_POST['dsr_txt_email'] ) );
			
			JRequest::setVar( 'view', 'events' );
			JRequest::setVar( 'layout', 'default'  );
			parent::display();
		} else {
			//$msg = JText::_( 'COM_JEVENT_TXT_APPLICATION_ERROR_SAVEING' );

			JRequest::setVar( 'view', 'apply' );
			JRequest::setVar( 'layout', 'default');

			
			parent::display();
		}
	}
	
	function cancel(){
		JError::raiseNotice( 100, 'Operation canceled!' );
		$this->reloadView1();
	}
	
	function reloadView1(){
		
		JRequest::setVar( 'view', 'events' );
		JRequest::setVar( 'layout', 'default');
		JRequest::setVar( 'flagUpt', ''  );
		
		parent::display();
	}
	
	function cancel2(){
		JError::raiseNotice( 100, 'Operation canceled!' );
		JRequest::setVar( 'view', 'participants' );
		JRequest::setVar( 'layout', 'default');
		
		parent::display();
	}
	
	/**
	 * display the edit form
	 * @return void
	 */
	function addEvent()
	{
		JRequest::setVar( 'view', 'events' );
		JRequest::setVar( 'layout', 'default'  );

		JRequest::setVar( 'flagUpt', ''  );
		parent::display();
	}
	
	/**
	 * display the edit form
	 * @return void
	 */
	function editEvent()
	{
		JRequest::setVar( 'view', 'events' );
		JRequest::setVar( 'layout', 'default'  );
		
		parent::display();
	}
	
	/**
	 * display the edit form
	 * @return void
	 */
	function apply()
	{
		JRequest::setVar( 'view', 'apply' );
		JRequest::setVar( 'layout', 'default'  );

		parent::display();
	}
}