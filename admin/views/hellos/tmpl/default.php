<?php defined('_JEXEC') or die('Restricted access');

$document =& JFactory::getDocument();
$document->addStyleSheet( '/components/com_jevent/css/default.css' );

function users2($name, $active, $nouser = 0, $javascript = NULL, $order = 'name', $reg = 1)
{
	$db = JFactory::getDbo();
	
	$and = '';
	if ($reg) {
	// Does not include registered users in the list
		//$and = ' AND m.group_id != 2';
	}
	
	$query = 'SELECT u.id AS value, u.name AS text, g.title AS groupId'
	. ' FROM #__users AS u'
	. ' JOIN #__user_usergroup_map AS m ON m.user_id = u.id'
	. ' JOIN #__usergroups AS g ON g.id = m.group_id' 
	. ' WHERE u.block = 0'
	. $and
	. ' ORDER BY '. $order;
	
	//echo $query;
	$db->setQuery($query);
	
	/*if ($nouser) {
		$users[] = JHtml::_('select.option', '0', JText::_('JOPTION_NO_USER'));
		$users = array_merge($users, $db->loadObjectList());
	} else {*/
		$users = $db->loadObjectList();
	//}
	
	/*$users = JHtml::_(
		'select.genericlist',
		$users,
		$name,
		array('list.attr' => 'class="inputbox" size="1" '. $javascript, 'list.select' => $active)
	);*/
	return $users;
}

function groups()
{
	$db = JFactory::getDbo();
	
	$query = 'SELECT id as value, title as text, parent_id as value2 FROM `#__usergroups` order by id';
	
	$db->setQuery($query);
	
	$groups = $db->loadObjectList();

	return $groups;
}


$name = 'user';
$active = 0;
//echo JHTML::_('list.users', $name, $active);
$userList = users2($name, $active);
$groupList = groups();
/*foreach ($userList as $user) { 
	echo $user->text;
}*/
//var_dump($this->items);
 ?>
 
<form action="index.php" method="post" name="adminForm">
<div id="editcell">
	<?php echo JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_NOTE' ); ?>
	<!--<b>Select jEvent admin users:</b><br/>
	Choose which users can edit the lessons and administrate the applications in the FrontEnd<br/>
	 <select name="top5" size="10"  width="300" style="width: 300px" multiple>
      <?php foreach ($userList as $user) { ?>
      	<option><?php echo $user->text; ?></option>
      <?php } ?>
    </select>-->
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $userList ); ?>);" />
			</th>
			<th width="80">
				<?php echo JText::_( 'Group' ); ?>
			</th>			
			<th style="text-align:left;">
				<?php echo JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_USER' ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	$i=0;
	foreach ($userList as $user) {
	//for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		//$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $user->value );
		$link 		= JRoute::_( 'index.php?option=com_jEvent&controller=hello&task=edit&cid[]='. $user->value );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $user->value; ?>
			</td>
			<td>
				<!-- <?php echo $checked; ?> -->
				<!-- <input type="checkbox"/> -->
				<input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $user->value;?>" onclick="isChecked(this.checked);" title="Checkbox for row <?php echo ($i+1);?>" 
					<?php 
						foreach($this->items as $item){
							if($item->idt_user == $user->value){
								echo "checked";
								break;
							}
						}
					?>
				/>
			</td>
			<td>
				<?php echo $user->groupId; ?>
			</td>
			<td>
				<a href="<?php echo $link; ?>"><?php echo $user->text; ?></a>
			</td>
		</tr>
		<?php
		$k = 1 - $k;
		$i++;
	}
	?>
	</table>
</div>
<br/><br/>
<div id="editcell">
	<?php echo JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_NOTE' ); ?>
	<!--<b>Select jEvent admin users:</b><br/>
	Choose which users can edit the lessons and administrate the applications in the FrontEnd<br/>
	 <select name="top5" size="10"  width="300" style="width: 300px" multiple>
      <?php foreach ($userList as $user) { ?>
      	<option><?php echo $user->text; ?></option>
      <?php } ?>
    </select>-->
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'ID' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $groupList ); ?>);" />
			</th>
			<th width="80">
				<?php echo JText::_( 'Parent id' ); ?>
			</th>		
			<th style="text-align:left;">
				<?php echo JText::_( 'COM_JEVENT_LBL_SELECT_ADMIN_USERGROUP' ); ?>
			</th>
		</tr>
	</thead>
	<?php
	$k = 0;
	$i=0;
	foreach ($groupList as $group) {
	//for ($i=0, $n=count( $this->items ); $i < $n; $i++)	{
		//$row = &$this->items[$i];
		$checked 	= JHTML::_('grid.id',   $i, $user->value );
		$link 		= JRoute::_( 'index.php?option=com_jEvent&controller=hello&task=edit&cid[]='. $group->value );
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $group->value; ?>
			</td>
			<td>
				<!-- <?php echo $checked; ?> -->
				<!-- <input type="checkbox"/> -->
				<input type="checkbox" id="cb2<?php echo $i;?>" name="cid2[]" value="<?php echo $group->value;?>" onclick="isChecked(this.checked);" title="Checkbox for row <?php echo ($i+1);?>" 
					<?php 
						foreach($this->items2 as $item){
							if($item->idt_usergroup == $group->value){
								echo "checked";
								break;
							}
						}
					?>
				/>
			</td>
			<td>
				<?php echo $group->value2; ?>
			</td>
			<td>
				<?php echo $group->text; ?>
			</td>
			<!--
			<td>
				<a href="<?php echo $link; ?>"><?php echo $group->text; ?></a>
			</td>-->
		</tr>
		<?php
		$k = 1 - $k;
		$i++;
	}
	?>
	</table>
</div>

<input type="hidden" name="option" value="com_jEvent" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="hello" />
</form>
