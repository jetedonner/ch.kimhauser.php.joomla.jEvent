<?php defined('_JEXEC') or die('Restricted access'); 

	//echo ($_GET["task"] == 'editEvent' ? "[EDITMODE]: " . $this->nId : ""); 
	//echo ($_GET["task"] == 'addEvent' ? "[ADDMODE]: " . $this->nId : ""); 
	$bEditMode = ($_POST["flag"] == 'editEvent' ? true : false);
	$bAddMode = ($_POST["flag"] == 'addEvent' ? true : false);
	//$bInit = ($_GET["Init"] == '1' ? false : true);
	
	
	
	$data = JRequest::get( 'post' );
	//echo "flagUpt: " . $this->flagUpt;
	if($data['flagUpt'] == '1' & $_POST['bOk'] == '1'){
		//echo "FLAG!!!!!!!!!";
		$bAddMode = true;
	}
	
	if($data['flagUpt'] == '2' ){
		//echo "FLAG2!!!!!!!!!";
		$bAddMode = false;
		$bEditMode = true;
	}
	
	//echo "AddMode: " . $bAddMode;
	//echo "1st try: " . $data['flagUpt'] . " bOk: " . $_POST['bOk']. " EditMode: " . $bEditMode . "/ submited: " . $data['submited'];
	
	//if($_POST['bOk'] = '1')
	//	$bAddMode = false;
	//echo 'Submited: ' .$data['submited'];
	if($data['submited'] == '')
		$bInit = false;
	else
		$bInit = true;
		
	//echo "nRet: " . $data['nRet'];
	if(!$bOld & $admc->showDebugInfo){ 
		//if(){
			echo "<div  style='width=80%;border:1px solid; border-color:#A5A5A5;'><font color='#A5A5A5'><b>User Info;</b><br/>";
			echo "Is admin user: " . $admc->isAdminUser($user->id)  . " / Is admin group: " . $bIsAdminGroup . "<br/>"
			. "Name: " . $user->name . " / User: " . $user->username . " / ID: " . $user->id . "<br/>GroupId(s):<br/>";
			
			foreach($user->groups as $str){
				echo "- " . $str . "<br/>";
			}
			echo "<br/>";
			echo "<b>Debug Info:</b><br/>";
			echo "RedLight: " . $admc->showRedLight . "<br/>";
			echo "bAddMode: " . $bAddMode . "<br/>";
			echo "bEditMode: " . $bEditMode . " (ID: " . $this->nId . ")<br/>";
			echo "</font></div>";
		//}
	}
?>
<?php
	$txtErrStyle = 'border-color: #CC005B; border-style: solid; border-width: 1px';
?>
<h1><?php echo JText::_(($bOld ? 'COM_JEVENT_TITLE_OLD_EVENTS' : 'COM_JEVENT_TITLE_CURRENT_EVENTS')); ?></h1>
<?php if($bOld){?>
	<font color="#A5A5A5">
<?php } ?>
<script>
	function doApply(idApply){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'apply';
		document.getElementById('cid[]').value = idApply;
		document.getElementById('submited').value = '';
		document.forms['frmTblLessons'].submit();
		//alert('Apply!!! (' + idApply + ')');
	}
	
	function doList(idList){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'participants';
		document.getElementById('task').value = 'participants';
		document.getElementById('cid[]').value = idList;
		document.getElementById('submited').value = '';
		document.forms['frmTblLessons'].submit();
		//index.php?option=com_jEvent&controller=participants&task=participants&cid[]='. $event[9]
		//alert('List!!! (' + idList + ')');
	}
	
	function doEdit(idEdit){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'editEvent';
		document.getElementById('cid[]').value = idEdit;
		document.getElementById('flag').value = 'editEvent';
		document.getElementById('submited').value = '';
		//alert('Edit!!! (' + idEdit + ')');
		
		document.forms['frmTblLessons'].submit();
		//index.php?option=com_jEvent&controller=apply&task=editEvent&cid[]='. $event[9]
		
	}
	
	function doAdd(){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'addEvent';
		//document.getElementById('cid[]').value = idList;
		document.getElementById('submited').value = '';
		document.getElementById('flag').value = 'addEvent';
		//alert('Add!!!');
		document.forms['frmTblLessons'].submit();
		//index.php?option=com_jEvent&controller=apply&task=addEvent&cid[]='. $event[9] . '&Init=1'
		
	}
	
	function doDelete(idDel){
		if(confirm('<?php echo JText::_('COM_JEVENT_QUE_WANT_TO_DELETE_EVENT') ?>')) { 
			//window.location= 'index.php?option=com_jevent&controller=apply&task=deleteEvent&cid[]=idDel'; 
			document.getElementById('option').value = 'com_jevent';
			document.getElementById('controller').value = 'apply';
			document.getElementById('task').value = 'deleteEvent';
			document.getElementById('cid[]').value = idDel;
			//document.getElementById('submited').value = '';
			//alert('Del!!! (' + idDel + ')');
			document.forms['frmTblLessons'].submit();
			//index.php?option=com_jEvent&controller=participants&task=participants&cid[]='. $event[9]
			//alert('Del!!! (' + idDel + ')');
		}
	}
	
	function doUpdate(idEvt, sOld){
		if(sOld == 0){
			document.getElementById('option').value = 'com_jevent';
			document.getElementById('controller').value = 'apply';
			document.getElementById('task').value = 'updateEvent';
			document.getElementById('cid[]').value = idEvt;
			//document.getElementById('id_upt').value = idEvt;
			document.getElementById('flagUpt').value = '1';
			document.forms['frmTblLessons'].submit();
		}else{
			var x=document.getElementsByName("cid[]");
			x[1].value = idEvt;
			//alert(x[1].value);
			//document.forms['frmTblLessonsOld'].cid[]
			document.forms['frmTblLessonsOld'].option.value = 'com_jevent';
			document.forms['frmTblLessonsOld'].controller.value = 'apply';
			document.forms['frmTblLessonsOld'].task.value = 'updateEvent';
			document.forms['frmTblLessonsOld'].flagUpt.value = '1';
			document.forms['frmTblLessonsOld'].submit();
		}
		//document.forms['frmTblApplications<?php echo ($bShowCanceledParticipants ? 'Old' : '' );?>'].submit();
	}
	
	function doCancel(idEvt){
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'cancel';
		//document.getElementById('cid[]').value = idEvt;
		document.forms['frmTblLessons'].submit();
		//document.forms['frmTblApplications<?php echo ($bShowCanceledParticipants ? 'Old' : '' );?>'].submit();
	}
	
	function doSaveNew(){
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'saveNewEvent';
		document.getElementById('flagUpt').value = '1';
		document.forms['frmTblLessons'].submit();
	}
	
</script>
<?php //echo "bOk: " . $_POST['bOk'];?>
<form id="frmTblLessons<?php echo ($bOld ? 'Old': ''); ?>" method="post">
	<input type="hidden" id="submited" name="submited" value="1" />
	<input type="hidden" id="option" name="option" value="com_jevent" />
	<input type="hidden" id="task" name="task" value="<?php echo ($bEditMode ? 'updateEvent' : 'saveNewEvent'); ?>" />
	<input type="hidden" id="controller" name="controller" value="apply" />
	<input type="hidden" id="cid[]" name="cid[]" value="0"/>
	<input type="hidden" id="flag" name="flag" value=""/>
	<input type="hidden" id="flagUpt" name="flagUpt" value="2"/>
	<input type="hidden" name="boxchecked" value="0" />
<table width="100%" border="0" style="border-collapse:collapse;" cellspacing="0">
<thead>
<tr>
	<td width="7%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_DATE'); ?></b>
	</td>
	<td width="6%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_TIME'); ?></b>
	</td>
	<td width="6%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_TIME_TO'); ?></b>
	</td>
	<td width="15%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_EVENT_TYPE'); ?></b>
	</td>
	<td width="28%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_PLACE'); ?></b>
	</td>
	<td width="10%" style="border:0">
		<b><?php echo JText::_('COM_JEVENT_LBL_PRICE'); ?></b>
	</td>
	<td width="7%" style="border:0" align="center">
		<b><?php echo JText::_('COM_JEVENT_LBL_NUM_PLACES'); ?></b>
	</td>
	<td width="10%" style="border:0" align="center">
		<b><?php echo JText::_('COM_JEVENT_LBL_JOIN'); ?></b>
	</td>
	<?php if(($admc->isAdminUser($user->id) | $bIsAdminGroup)){ ?>
		<td width="10%" style="border:0">
			<b><?php echo JText::_('COM_JEVENT_LBL_ADMIN'); ?></b>
		</td>
	<?php } ?>
</tr>
</thead>
<tbody>
	<?php 
	$sGroup = '';
    $user =& JFactory::getUser();
    $nIdx = 0;
    if(count(($bOld ? $this->oldEvents : $this->events)) > 0 ){
	    foreach (($bOld ? $this->oldEvents : $this->events) as $event) { 
	    
	    $date = new DateTime($event[11]);
		if($sGroup != $date->format('M Y'))
			echo '<tr style="border-bottom: solid 1px;"><td colspan="'. (($admc->isAdminUser($user->id) | $bIsAdminGroup) ? '9' : '8'). '"><b>' . $date->format('M Y') . '</b></td></tr>';
			$sGroup = $date->format('M Y');
	    ?>
	    <tr>
	    	<!--
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="dt_event_upt" name="dt_event_upt" value="<?php echo ($bInit ? $_POST["dt_event_upt"] : $event[0]) ;?>" size="8"/>' : $event[0]) ?></td>
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="dt_event_time_upt" name="dt_event_time_upt" value="<?php echo ($bInit ? $_POST["dt_event_time_upt"] : $event[1]) ;?>" size="4"/>' : $event[1]) ?></td>
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="dt_event_end_upt" name="dt_event_end_upt" value="<?php echo ($bInit ? $_POST["dt_event_end_upt"] : $event[2]) ;?>" size="4"/>' : $event[2]) ?></td>
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="s_category_upt" name="s_category_upt" value="<?php echo ($bInit ? $_POST["s_category_upt"] : $event[3]) ;?>" size="14"/>' : '<a href="javascript: window.open(\'index.php/component/jEvent/?controller=apply&amp;task=showDescription&amp;cid[0]=2' . ( ($admc->isAdminUser($user->id) | $bIsAdminGroup) ? '&amp;EditMode=1' : '') . '&amp;Old=' . ($bOld ? '1' : '0') . '&amp;nId=' .$event[9] . '\',\'\',\'status=no, target=miniwin;targetfeatures=toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=600,\'); void(\'\');" )><b>' . $event[3] . '</b></a>') ?></td>
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="s_place_upt" name="s_place_upt" value="<?php echo ($bInit ? $_POST["s_place_upt"] : $event[4]) ;?>" size="28"/>' : '<a href="' . $googleMapsLink . $event[4] .'" target="_blank">' . $event[4] . '</a>') ?></td>
			<td><?php echo (($bEditMode & $this->nId == $event[9]) ? '<input type="text" id="s_price_upt" name="s_price_upt" value="<?php echo ($bInit ? $_POST["s_price_upt"] : $event[5]) ;?>" size="8"/><input type="hidden" id="id_upt" name="id_upt" value="'. $event[9] . '" />' : $event[5]) ?></td>
	    	-->
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="8" style="<?php echo ( $bInit & $_POST['dt_event_upt'] == '' ? $txtErrStyle : '');?>" id="dt_event_upt" name="dt_event_upt" value="<?php echo ($bInit ? $_POST["dt_event_upt"] : $event[0]) ;?>" size="8"/>
				<input type="hidden" id="id_upt" name="id_upt" value="<?php echo $event[9]; ?>" />
				<?php }else{  
					
					
					echo "&nbsp;&nbsp;" . $date->format('d.m');
					//echo $event[0];
					  } ?>
			</td>
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="4" style="<?php echo ( $bInit & $_POST['dt_event_time_upt'] == '' ? $txtErrStyle : '');?>" id="dt_event_time_upt" name="dt_event_time_upt" value="<?php echo ($bInit ? $_POST["dt_event_time_upt"] : $event[1]) ;?>" size="8"/>
				
				<?php }else{  
					
					echo $event[1];
					  } ?>
			</td>
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="4" style="<?php echo ( $bInit & $_POST['dt_event_end_upt'] == '' ? $txtErrStyle : '');?>" id="dt_event_end_upt" name="dt_event_end_upt" value="<?php echo ($bInit ? $_POST["dt_event_end_upt"] : $event[2]) ;?>" size="8"/>
				
				<?php }else{  
					
					echo $event[2];
					  } ?>
			</td>
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="14" style="<?php echo ( $bInit & $_POST['s_category_upt'] == '' ? $txtErrStyle : '');?>" id="s_category_upt" name="s_category_upt" value="<?php echo ($bInit ? $_POST["s_category_upt"] : $event[3]) ;?>" size="8"/>
				
				<?php }else{  
					
					//echo $event[3];
				?>
					<!--
					<a href="javascript: window.open(\'index.php/component/jEvent/?controller=apply&amp;task=showDescription&amp;cid[0]=2<?php echo ( ($admc->isAdminUser($user->id) | $bIsAdminGroup) ? '&amp;EditMode=1' : '') . '&amp;Old=' . ($bOld ? '1' : '0') . '&amp;nId=' . $event[9]; ?> '\',\'\',\'status=no, target=miniwin;targetfeatures=toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=600,\'); void(\'\');" )><b><?php echo $event[3];?></b></a>
					-->
					<a href="javascript: window.open('index.php/component/jevent/?controller=apply&amp;task=showDescription&amp;cid[0]=2<?php echo ( ($admc->isAdminUser($user->id) | $bIsAdminGroup) ? '&amp;EditMode=1' : '') . '&amp;Old=' . ($bOld ? '1' : '0') . '&amp;nId=' . $event[9]; ?>','','status=no, target=miniwin;targetfeatures=toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,width=600,height=600,'); void('');"><b><?php echo $event[3];?></b></a>
				<?php
					  } ?>
			</td>
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="28" style="<?php echo ( $bInit & $_POST['s_place_upt'] == '' ? $txtErrStyle : '');?>" id="s_place_upt" name="s_place_upt" value="<?php echo ($bInit ? $_POST["s_place_upt"] : $event[4]) ;?>" size="8"/>
				
				<?php }else{  
					
					//echo $event[4];
					?>
						<a href="<?php echo $googleMapsLink . $event[4]; ?>" target="_blank"><?php echo $event[4]; ?></a>
					<?php
					  } ?>
			</td>
			<td>
				<?php if($bEditMode & $this->nId == $event[9]) { ?>
				<input type="text" size="8" style="<?php echo ( $bInit & $_POST['s_price_upt'] == '' ? $txtErrStyle : '');?>" id="s_price_upt" name="s_price_upt" value="<?php echo ($bInit ? $_POST["s_price_upt"] : $event[5]) ;?>" size="8"/>
				
				<?php }else{  
					
					echo $event[5];
					  } ?>
			</td>
			<td align="center">
				<?php 
					if($bEditMode & $this->nId == $event[9]){
						?>
							<input type="text" style="<?php echo ( $bInit & $_POST['n_num_part_upt'] == '' ? $txtErrStyle : '');?>" id="n_num_part_upt" name="n_num_part_upt" value="<?php echo ($bInit ? $_POST["n_num_part_upt"] : $event[7]) ;?>" size="4"/>
						<?php
					}else{
						if($admc->showRedLight){
							echo '<img src="' . $sroot . '/images/Ampel_' . ($event[8] <= 0 ? 'Rot' : ($event[8] <= ($event[7]/100*20) ? 'Gelb' :'Gruen')) .'.GIF" title="'. $event[8] .' von '. $event[7] . ' sind frei" alt="Places free"/>'; 
						}else{
							echo ( $event[8] <= 0 ? '<font color="#CC005B">' : '') . '<b>' . $event[8] . '</b>' . ( $event[8] <= 0 ? '</font>' : ''); ///' .$event[7];
						}
					}
				?>
			</td>
			<?php 
				$link 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=apply&cid[]='. $event[9] ); 
				$link2 		= JRoute::_( 'index.php?option=com_jEvent&controller=participants&task=participants&cid[]='. $event[9] ); 
				$link3 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=editEvent&cid[]='. $event[9] ); 
				$link4 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=addEvent&cid[]='. $event[9] . '&Init=1'); 
			?>
			<td align="center">
				<?php if($event[8] <= 0) { 
						echo '<font color="#CC005B">' . JText::_('COM_JEVENT_LBL_EVENT_OCCUPIED') . '</font>';				
					} else { ?>
					<a href="javascript:doApply(<?php echo $event[9];?>);"><img src="<?php echo $sroot;?>/images/apply.jpg" alt="List" title="<?php echo JText::_('COM_JEVENT_LBL_APPLY'); ?>"/></a>
					<!--
					<a href="<?php echo $link; ?>"><img src="<?php echo $sroot;?>/images/apply.jpg" alt="List" title="<?php echo JText::_('COM_JEVENT_LBL_APPLY'); ?>"/></a>
					-->
				<?php } ?>
			</td>
			<?php if(($admc->isAdminUser($user->id) | $bIsAdminGroup)){ ?>
				<td valign="middle">
					<a href="javascript:doList('<?php echo $event[9]; ?>');"><img src="<?php echo $sroot;?>/images/list.png" alt="List" title="<?php echo JText::_('COM_JEVENT_LBL_LIST_PARTICIPANTS'); ?>"/></a>
					<!--
					<a href="<?php echo $link2; ?>"><img src="<?php echo $sroot;?>/images/list.png" alt="List" title="<?php echo JText::_('COM_JEVENT_LBL_LIST_PARTICIPANTS'); ?>"/></a>
					-->
					<?php if($bEditMode & $this->nId == $event[9]){ ?>
						
						<a href="javascript:doUpdate(<?php echo $event[9] . ', ' . ($bOld ? '1' : '0'); ?>);"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>"/></a>
						<!--
						<a href="javascript:document.forms['<?php echo $bOld ? 'frmTblLessonsOld' : 'frmTblLessons'; ?>'].submit();"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>"/></a>
						-->
						
						<a href="javascript:doCancel();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
						<!--
						<a href="javascript:history.back();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
						<a href="index.php?option=com_jEvent"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
						-->
					<?php } else { ?>
					
						<a href="javascript:doEdit('<?php echo $event[9]; ?>');"><img src="<?php echo $sroot;?>/images/edit.png" alt="Edit" title="<?php echo JText::_('COM_JEVENT_LBL_EDIT'); ?>"/></a>
						<!--
						<a href="<?php echo $link3; ?>"><img src="<?php echo $sroot;?>/images/edit.png" alt="Edit" title="<?php echo JText::_('COM_JEVENT_LBL_EDIT'); ?>"/></a>
						-->
						<a href="javascript:doDelete('<?php echo $event[9]; ?>');"><img src="<?php echo $sroot;?>/images/delete.png" alt="Delete" title="<?php echo JText::_('COM_JEVENT_LBL_DELETE_EVENT'); ?>"/></a>
						<!--
						<a href="javascript:if(confirm('<?php echo JText::_('COM_JEVENT_QUE_WANT_TO_DELETE_EVENT') ?>')) { window.location= 'index.php?option=com_jevent&controller=apply&task=deleteEvent&cid[]=<?php echo $event[9];?>'; }"><img src="<?php echo $sroot;?>/images/delete.png" alt="Delete" title="<?php echo JText::_('COM_JEVENT_LBL_DELETE_EVENT'); ?>"/></a>
						-->
					<?php } ?>
				</td>
			<?php } ?>
	    </tr>
	    <?php 
	    	$nIdx++;
	    }
	    if($bAddMode & !$bOld) { ?>
			<tr>
				<td><input type="text" size="8" style="<?php echo ((($bInit & $_POST['dt_event'] == "") | $data['nRet'] == 1) ? $txtErrStyle : '')?>" id="dt_event" name="dt_event" value="<?php echo $_POST['dt_event']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo ((($bInit & $_POST['dt_event_time'] == "") | $data['nRet'] == 1) ? $txtErrStyle : '')?>" id="dt_event_time" name="dt_event_time" value="<?php echo $_POST['dt_event_time']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo ((($bInit & $_POST['dt_event_end'] == "") | $data['nRet'] == 2) ? $txtErrStyle : '')?>" id="dt_event_end" name="dt_event_end" value="<?php echo $_POST['dt_event_end']; ?>"/></td>
				<td><input type="text" size="14" style="<?php echo (($bInit & $_POST['s_category'] == "") ? $txtErrStyle : '')?>" id="s_category" name="s_category" value="<?php echo $_POST['s_category']; ?>"/></td>
				<td><input type="text" size="28" style="<?php echo (($bInit & $_POST['s_place'] == "") ? $txtErrStyle : '')?>" id="s_place" name="s_place" value="<?php echo $_POST['s_place']; ?>"/></td>
				<td><input type="text" size="8" style="<?php echo (($bInit & $_POST['s_price'] == "") ? $txtErrStyle : '')?>" id="s_price" name="s_price" value="<?php echo $_POST['s_price']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo ((($bInit & $_POST['n_num_part'] == "") | $data['nRet'] == 3) ? $txtErrStyle : '')?>" id="n_num_part" name="n_num_part" value="<?php echo $_POST['n_num_part']; ?>"/></td>
				
				<td></td>
				<td>
					<a href="javascript:doSaveNew();"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>" /></a>
					
					<a href="javascript:doCancel();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
					<!--
					<a href="javascript:history.back();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
					<a href="index.php?option=com_jEvent"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
					-->
				</td>
			</tr>
		<?php }
		
		if(!$bAddMode & !$bOld & ($admc->isAdminUser($user->id) | $bIsAdminGroup)){ ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td>
				
				<a href="javascript:doAdd();"><img src="<?php echo $sroot;?>/images/create_new.gif" alt="New" title="<?php echo JText::_('COM_JEVENT_LBL_NEW'); ?>"/></a>
				<!--
				<a href="<?php echo $link4; ?>"><img src="<?php echo $sroot;?>/images/create_new.gif" alt="New" title="<?php echo JText::_('COM_JEVENT_LBL_NEW'); ?>"/></a>
				-->
				</td>
			</tr>
	<?php } 
		
    }else{ 
    	$link4 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=addEvent&cid[]='. $event[9] . '&Init=1'); 
    ?>
    	<tr>
    		<td colspan="8"><b><?php echo JText::_('COM_JEVENT_LBL_NO_APPLICANTS'); ?></b></td>
    	</tr>
    		<?php    if($bAddMode & !$bOld) { ?>
			<tr>
				<td><input type="text" size="8" style="<?php echo (($bInit & $_POST['dt_event'] == "") ? $txtErrStyle : '')?>" id="dt_event" name="dt_event" value="<?php echo $_POST['dt_event']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo (($bInit & $_POST['dt_event_time'] == "") ? $txtErrStyle : '')?>" id="dt_event_time" name="dt_event_time" value="<?php echo $_POST['dt_event_time']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo (($bInit & $_POST['dt_event_end'] == "") ? $txtErrStyle : '')?>" id="dt_event_end" name="dt_event_end" value="<?php echo $_POST['dt_event_end']; ?>"/></td>
				<td><input type="text" size="14" style="<?php echo (($bInit & $_POST['s_category'] == "") ? $txtErrStyle : '')?>" id="s_category" name="s_category" value="<?php echo $_POST['s_category']; ?>"/></td>
				<td><input type="text" size="28" style="<?php echo (($bInit & $_POST['s_place'] == "") ? $txtErrStyle : '')?>" id="s_place" name="s_place" value="<?php echo $_POST['s_place']; ?>"/></td>
				<td><input type="text" size="8" style="<?php echo (($bInit & $_POST['s_price'] == "") ? $txtErrStyle : '')?>" id="s_price" name="s_price" value="<?php echo $_POST['s_price']; ?>"/></td>
				<td><input type="text" size="4" style="<?php echo (($bInit & $_POST['n_num_part'] == "") ? $txtErrStyle : '')?>" id="n_num_part" name="n_num_part" value="<?php echo $_POST['n_num_part']; ?>"/></td>
				
				<td></td>
				<td>
					<a href="javascript:document.forms['frmTblLessons'].submit();"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>" /></a>
					
					<a href="javascript:history.back();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
					<!-- 
					<a href="index.php?option=com_jEvent"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
					-->
				</td>
			</tr>
		<?php } ?>
		<?php if(($admc->isAdminUser($user->id) | $bIsAdminGroup) & !$bOld ){ ?>
    	<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><a href="javascript:doAdd();"><img src="<?php echo $sroot;?>/images/create_new.gif" alt="New" title="<?php echo JText::_('COM_JEVENT_LBL_NEW'); ?>"/></a></td>
			</tr>
		<?php }?>
    <?php
    }
    ?>
</tbody>
</table>
</form>
<?php if($bOld){?>
	</font>
<?php } ?>