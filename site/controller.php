<?php
/**
 * Hello World default controller
 * 
 * @package    Joomla.Tutorials
 * @subpackage Components
 * @link http://dev.joomla.org/component/option,com_jd-wiki/Itemid,31/id,tutorials:components/
 * @license		GNU/GPL
 */

jimport('joomla.application.component.controller');

/**
 * Hello World Component Controller
 *
 * @package		HelloWorld
 */
class JEventController extends JController
{
	/**
	 * Method to display the view
	 *
	 * @access	public
	 */
	function display()
	{
		//if($controller == ''){
		//	JRequest::setVar( 'view', 'events' );
		//	JRequest::setVar( 'layout', 'default'  );
		//}
		parent::display();
	}

}
?>