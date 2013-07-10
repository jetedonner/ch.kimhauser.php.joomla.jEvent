<?php // no direct access
defined('_JEXEC') or die('Restricted access');

	$menuitemid = JRequest::getInt( 'Itemid' );
	if ($menuitemid) {
	    $menu = JSite::getMenu();
	    $menuparams = $menu->getParams( $menuitemid );

	    $showHtml = $menuparams->get('showHtml');
	    $htmlBefore = $menuparams->get('htmlBefore');
		$htmlAfter = $menuparams->get('htmlAfter');
	}
 	
	require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'adminConfig.php');
	$user =& JFactory::getUser();
	$admc = new jEventAdminConfig();
 
	$bIsAdminGroup = false;
	foreach($user->groups as $str){
		if(($admc->isAdminGroup($str))){
			$bIsAdminGroup = true;
			break;
		}
	}
	
	require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'helperFunctions.php');
	//echo "<h1>hi</h1>";
	if($showHtml)
		echo $htmlBefore;
	
	$bOld = false;
	require(JPATH_COMPONENT.DS.'views' . DS . 'events' . DS .'tmpl' . DS. 'eventList.php');
	
	if(($admc->isAdminUser($user->id) | $bIsAdminGroup)){
		$bOld = true;
		require(JPATH_COMPONENT.DS.'views' . DS . 'events' . DS .'tmpl' . DS. 'eventList.php');
	}
	if($showHtml)
		echo $htmlAfter;
?>