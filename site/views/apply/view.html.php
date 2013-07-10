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
 
class JEventViewApply extends JView
{
	function display($tpl = null)
	{
		$array = JRequest::getVar('cid',  0, '', 'array');
		$nId = (int)$array[0];
		$this->assignRef( 'nId',	$nId );
		
		$event = $this->get( 'EventById' );
		$this->assignRef( 'event',	$event );
		
		parent::display($tpl);
	}
}
?>
