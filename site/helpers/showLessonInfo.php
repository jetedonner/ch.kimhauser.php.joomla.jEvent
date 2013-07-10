<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<table width="100%">
	<thead>
		<tr>
			<td width="20%"></td>
			<td width="80%"></td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td valign="top">
			<b><?php echo JText::_('COM_JEVENT_LBL_LESSON'); ?></b><br/>
			<?php echo JText::_('COM_JEVENT_LBL_DATE'); ?><br/>
			<?php echo JText::_('COM_JEVENT_LBL_TIME'); ?><br/>
			<?php echo JText::_('COM_JEVENT_LBL_PLACE'); ?><br/>
			<?php echo JText::_('COM_JEVENT_LBL_PRICE'); ?><br/>
			<?php echo JText::_('COM_JEVENT_LBL_PLACES_FREE'); ?><br/><br/>
		</td>
		<td>
			<b><?php echo $this->event[0][3]?></b><br/>
			<?php echo $this->event[0][0]?><br/>
			<?php echo $this->event[0][1]?> - <?php echo $this->event[0][2]?><br/>
			<a href="<?php echo $googleMapsLink . $this->event[0][4]?>" target="_blank"><?php echo $this->event[0][4]?></a><br/>
			<?php echo $this->event[0][5]?><br/>
			<?php echo JText::sprintf('COM_JEVENT_LBL_ONE_FROM_MANY', $this->event[0][8], $this->event[0][7]);?><br><br/>
		</td>
	</tr>
	</tbody>
</table>