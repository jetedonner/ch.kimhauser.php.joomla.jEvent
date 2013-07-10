<?php 
defined('_JEXEC') or die('Restricted access'); // no direct access 
require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'helperFunctions.php');	
?>

<script>
	function doBack2Events(){
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'reloadView1';
		document.forms['frmTblApplications'].submit();		
	}
</script>

<h1><?php echo JText::_('COM_JEVENT_TITLE_LIST_PARTICIPANTS');?></h1>
<?php require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'showLessonInfo.php'); ?>
<a href="javascript:doBack2Events();"><?php echo JText::_('COM_JEVENT_LBL_BACK'); ?></a>

<h1><?php echo JText::_('COM_JEVENT_TITLE_LIST_PARTICIPANTS_OK');?></h1>
<?php 
	  $bShowCanceledParticipants = false;
	  require(JPATH_COMPONENT.DS.'views' . DS. 'participants' . DS.'tmpl' . DS. 'participantsList.php'); ?>
<a href="javascript:doBack2Events();"><?php echo JText::_('COM_JEVENT_LBL_BACK'); ?></a>

<?php if(count($this->eventListCanceled) > 0){?>
<h1><?php echo JText::_('COM_JEVENT_TITLE_LIST_PARTICIPANTS_CANCELED');?></h1>
<?php 
	  $bShowCanceledParticipants = true;
	  require(JPATH_COMPONENT.DS.'views' . DS. 'participants' . DS.'tmpl' . DS. 'participantsList.php'); ?>
<a href="javascript:doBack2Events();"><?php echo JText::_('COM_JEVENT_LBL_BACK'); ?></a>
<?php } ?>