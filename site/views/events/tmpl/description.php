<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php

$bOld = ($_GET["Old"] == '1' ? true : false);
$bEditMode = ($_GET["EditMode"] == '1' ? true : false);

foreach (($bOld ? $this->oldEvents : $this->events) as $event) {
	if($event[6] == $_GET["nId"]){
		if(!$bEditMode){
			echo $event[10];
		}else{
			echo "<form name='frmDesc'><h1>" . JText::sprintf('COM_JEVENT_LBL_TITLE_DESCRIPTION', $event[3]) . "</h1><br/>";
			
			$editor =& JFactory::getEditor();
			echo $editor->display('content', $event[10], '550', '400', '60', '20', false);
			echo "<br/><input type='submit' value='Save'/>";
			?>
				<input type="hidden" name="nId" value="<?php echo $_GET["nId"]; ?>" />
				<input type="hidden" name="submited" value="1" />
				<input type="hidden" name="option" value="com_jevent" />
				<input type="hidden" id="task" name="task" value="saveDescription" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="controller" value="apply" />
			<?php
			echo "</form>";
		}
	}
}
?>

