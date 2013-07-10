<?php
/**
 * Hellos View for Hello World Component
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://docs.joomla.org/Developing_a_Model-View-Controller_Component_-_Part_4
 * @license		GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * Hellos View
 *
 * @package    Joomla.Tutorials
 * @subpackage Components
 */
class HellosViewOptions extends JView
{
	/**
	 * Hellos view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::sprintf( 'COM_JEVENT_MNU_SELECT_ADMIN', 'Options' ), 'events' );
		//JToolBarHelper::deleteList();
		//JToolBarHelper::editListX();
		//JToolBarHelper::addNewX();
		JToolBarHelper::cancel();
		JToolBarHelper::apply();
		
		JSubMenuHelper::addEntry(
			JText::_('COM_JEVENT_MNU_SELECT_ACCESS'),
			'index.php?option=com_jevent&view=hellos',
			$vName == 'hellos'
		);

		JSubMenuHelper::addEntry(
			JText::_('COM_JEVENT_MNU_SELECT_OPTIONS'),
			'index.php?option=com_jevent&view=options',
			$vName == 'options'
		);
		
		JSubMenuHelper::addEntry(
			JText::_('COM_JEVENT_MNU_SELECT_MAILTEXT'),
			'index.php?option=com_jevent&view=languages',
			$vName == 'languages'
		);
		
		// Get data from the model
		$items		= & $this->get( 'Data');

		$this->assignRef('items',		$items);

		parent::display($tpl);
	}
}