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
class JEventViewDocumentation extends JView
{
	function display($tpl = null)
	{
		//$flagUpt = JRequest::getVar('flagUpt');	
		//$this->assignRef( 'flagUpt',	$flagUpt );
		
		//$greeting = $this->get( 'Greeting' );
		//$this->assignRef( 'greeting',	$greeting );
		/*
		$array = JRequest::getVar('cid',  0, '', 'array');
		$nId = (int)$array[0];
		$this->assignRef( 'nId',	$nId );

		$events = $this->get( 'Events' );
		$this->assignRef( 'events',	$events );
		
		$oldEvents = $this->get( 'OldEvents' );
		$this->assignRef( 'oldEvents',	$oldEvents );
		
		$testVar = 
		$this->assignRef( 'testVar',	$testVar );
		*/
		parent::display($tpl);
	}
}
?>
