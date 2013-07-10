<?php
/**
 * jEvent installer script for jEvent Joomla Component
 * 
 * @package    	jEvent
 * @subpackage 	Components (Installation)
 * @link 		http://www.kimhauser.ch
 * @license		GNU/GPL
 */

defined('_JEXEC') or die('Restricted access');
error_reporting(E_ALL & ~E_NOTICE);
/*
$adminlang = &JFactory::getLanguage();
if (file_exists(JPATH_SITE . '/administrator/components/com_jshopping/lang/' . $adminlang->getTag() . '.php')) {
	require_once (JPATH_SITE . '/administrator/components/com_jshopping/lang/' . $adminlang->getTag() . '.php');
} else {
	require_once (JPATH_SITE . '/administrator/components/com_jshopping/lang/en-GB.php');
}

require_once (JPATH_SITE.'/components/com_jshopping/lib/jtableauto.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/multilangfield.php');
require_once (JPATH_SITE.'/components/com_jshopping/tables/config.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/factory.php');
require_once (JPATH_SITE.'/components/com_jshopping/lib/functions.php');

$params = JComponentHelper::getParams('com_languages');
$frontend_lang = $params->get('site','en-GB');

$query = 'SELECT email FROM #__users AS U LEFT JOIN #__user_usergroup_map AS UM ON UM.user_id = U.id WHERE UM.group_id = "8" ORDER BY U.id';
$db->setQuery( $query );
$email_admin = $db->loadResult();
        
$db = &JFactory::getDBO();
$config = new jshopConfig($db);
$config->id = 1;
$config->adminLanguage = $adminlang->getTag();
$config->defaultLanguage = $frontend_lang;
if ($email_admin){
    $config->contact_email = $email_admin;
}
$config->securitykey = md5($email_admin.time().JPATH_SITE);
$config->store();

$session =& JFactory::getSession();
$checkedlanguage = array();
$session->set("jshop_checked_language", $checkedlanguage);

installNewLanguages("en-GB", 0);

@chmod(JPATH_SITE . '/components/com_jshopping/files', 0755);

@mkdir(JPATH_SITE . '/components/com_jshopping/files/img_manufs', 0755);
@mkdir(JPATH_SITE . '/components/com_jshopping/files/demo_products', 0755);
@mkdir(JPATH_SITE . '/components/com_jshopping/files/img_attributes', 0755);    
@mkdir(JPATH_SITE . '/components/com_jshopping/files/pdf_orders', 0755);	

@chmod(JPATH_SITE . '/components/com_jshopping/files/img_manufs', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_categories', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/img_labels', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/video_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/files_products', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport/simpleexport', 0755);
@chmod(JPATH_SITE . '/components/com_jshopping/files/importexport/simpleimport', 0755);
print "<br>";
$jshopConfig = &JSFactory::getConfig();
print '<link rel = "stylesheet" type = "text/css" href = "'.$jshopConfig->live_admin_path.'css/style.css" />';
include_once(JPATH_ADMINISTRATOR."/components/com_jshopping/views/panel/view.html.php");
$view_config = array("base_path"=>JPATH_ADMINISTRATOR."/components/com_jshopping/","template_path"=>JPATH_ADMINISTRATOR."/components/com_jshopping/views/panel/tmpl/");
$view = new JshoppingViewPanel($view_config);
$view->setLayout("info");
$view->displayInfo();
*/
?>
<a href="index.php?option=com_jevent&view=hellos">
<img src="components/com_jevent/images/event48.gif"><br/>
<h2>Start customizing jEvent</h2></a><br/>
<br/>
<strong>How to setup jEvent:</strong><br/>
<ul>
	<li><a href="index.php?option=com_jevent&view=hellos">1. Select user/usergroup for editing at the frontend (important!)</a></li>
	<li><a href="index.php?option=com_jevent&view=options">2. Adjust options</a></li>
	<li><a href="index.php?option=com_jevent&view=languages">3. Customize mailtexts</a></li>
</ul> 
<br/><br/>
Developed by <a href="mailto:kim@kimhauser.ch">kim@kimhauser.ch</a>, DaVe Inc.<br/>
Copyright under <a href="http://www.gnu.org/licenses/gpl.html">GNU Public License</a><br/>

<!--
<table align="center" style="font-weight:bold">
<tr>
<td width="250">
<a href="index.php?option=com_jshopping">
    <img src="components/com_jshopping/images/jshop_categories_b.png" align="left" style="margin-right:10px;" /><div style="line-height:48px;"><?php print JoomShopping?></div>
</a>
</td>
<td width="250">
<a href="index.php?option=com_jshopping&controller=update&task=update&installtype=url&install_url=<?php print urlencode("http://www.maxx-marketing.online.de/joomla-shop/demo/demo_products_3.3.0.zip");?>&back=<?php print urldecode("index.php?option=com_jshopping")?>">
    <img src="components/com_jshopping/images/jshop_import_export_b.png" align="left" style="margin-right:8px;" /><div style="line-height:48px;">&nbsp;<?php print _JSHOP_LOAD_SAMPLE_DATA?></div>
</a>
</td>
</tr>
</table>
-->
<br/>