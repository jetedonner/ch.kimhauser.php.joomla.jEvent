<?php defined('_JEXEC') or die('Restricted access'); 


//var_dump($this->items);
?>
 
 <form action = "index.php?option=com_jevent&controller=languages" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="1">
<input type="hidden" name="view" value="languages">
<div class="col100">
<fieldset class="adminform">
    <legend><?php echo JText::_('COM_JEVENT_LBL_APPLICATION_MAILTEXT'); ?></legend>
    <h3>Subject</h3>
    <input name="dsr_applicationSubject" type="text" size="116" value="<?php echo $this->items[0]->applicationSubject;?>"><br/><br/>
    <h3>Mailtext</h3>
    <?php
		$editor =& JFactory::getEditor();
		echo $editor->display('content', $this->items[0]->applicationEmail, '550', '400', '60', '20', false);
		?>

</fieldset>
</div>
<div class="col100">
<fieldset class="adminform">
    <legend><?php echo JText::_('COM_JEVENT_LBL_CANCEL_MAILTEXT'); ?></legend>
    <h3>Subject</h3>
    <input name="dsr_cancelSubject" type="text" size="116"  value="<?php echo $this->items[0]->cancelSubject;?>"><br/><br/>
    <h3>Mailtext</h3>
    <?php
		//$editor2 =& JFactory::getEditor();
		echo $editor->display('content2', $this->items[0]->cancelEmail, '550', '400', '60', '20', false);
		?>

</fieldset>
</div>
<div class="clr"></div>
</form>
