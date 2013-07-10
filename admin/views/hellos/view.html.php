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
class HellosViewHellos extends JView
{
	/**
	 * Hellos view display method
	 * @return void
	 **/
	function display($tpl = null)
	{
		JToolBarHelper::title(   JText::sprintf( 'COM_JEVENT_MNU_SELECT_ADMIN', 'Access Rights' ), 'events' );
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
		//$_lang = &$this->getModel("languages");
        //$languages = $_lang->getAllLanguages(1);
        //$multilang = count($languages)>1;
        
        /*foreach($this->languages as $lang){
       		JSubMenuHelper::addEntry(
				$lang->lang,
				'index.php?option=com_jevent&view=options',
				$vName == 'options'
			);*/
       /*$name = "name_".$lang->language;
       $alias = "alias_".$lang->language;
       $description = "description_".$lang->language;
       $short_description = "short_description_".$lang->language;
       $meta_title = "meta_title_".$lang->language;
       $meta_keyword = "meta_keyword_".$lang->language;
       $meta_description = "meta_description_".$lang->language;
       
       $name_pane = _JSHOP_DESCRIPTION; if ($this->multilang) $name_pane.=" (".$lang->lang.")".'<img class = "tab_image" border = "0" src = "' . JURI::root() . '/administrator/components/com_jshopping/images/flags/' . $lang->lang . '.gif" />';
   		*/
   		//}
		
		// Get data from the model
		$items		= & $this->get( 'Data');
		$this->assignRef('items',		$items);

		$items2		= & $this->get( 'Data2');
		$this->assignRef('items2',		$items2);
		
		parent::display($tpl);
	}
}