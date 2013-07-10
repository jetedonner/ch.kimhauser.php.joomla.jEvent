<?php
/**
 * Hello View for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the HelloWorld Component
 *
 * @package		Joomla.Tutorials
 * @subpackage	Components
 */
 
class JEventViewParticipants extends JView
{
	function display($tpl = null)
	{
		$greeting = $this->get( 'Greeting' );
		$this->assignRef( 'greeting',	$greeting );

		$array = JRequest::getVar('cid',  0, '', 'array');
		$nId = (int)$array[0];
		$this->assignRef( 'nId',	$nId );
		
		$event = $this->get( 'EventById' );
		$this->assignRef( 'event',	$event );
		
		$eventList = $this->get( 'EventListByIdGood' );
		$this->assignRef( 'eventList',	$eventList );
		
		$eventListCanceled = $this->get( 'EventListByIdCanceled' );
		$this->assignRef( 'eventListCanceled',	$eventListCanceled );
		
		parent::display($tpl);
	}
}
?>
