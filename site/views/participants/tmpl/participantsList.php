<?php // no direct access
defined('_JEXEC') or die('Restricted access'); 
	$array = JRequest::getVar('cid',  0, '', 'array');
	//echo 'POST: ' . $_POST['submited'];
	if($_POST['submited'] == '1')
		$bInit = false;
	else
		$bInit = true;
	
	$appId = $_POST["appId"];	
	if($_POST['flagUpt'] == '2')
		$appId = $_POST["bOk"];		
	
	//if($_POST['flagUpt'] = '3')
	//	$appId = 0;
		
	//echo "cid: " . $_POST['cid[]'] . " / flagUpt" . $_POST['flagUpt'] . " / bOk: " . $_POST['bOk'] . " / appId: " . $appId;  
	
		
if($bShowCanceledParticipants){
?>
	<font color="#A5A5A5">
<?php } ?>

<script>
	function resendEmail(id, reId, bCanceled){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		if(bCanceled){
			document.getElementById('task').value = 'resendCancelEmail';
			document.getElementById('appCanId').value = reId;
			document.getElementById('cancelReId').value = reId;
		}else
			document.getElementById('task').value = 'resendApplicationEmail';
		document.getElementById('cid[]').value = id;
		document.getElementById('appReId').value = reId;
		document.getElementById('submited').value = '';
		document.forms['frmTblApplications'].submit();
	};
	
	function doEdit(idEdit, idApp){

		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'editApplication';
		document.getElementById('cid[]').value = idEdit;
		document.getElementById('appId').value = idApp;
		document.getElementById('submited').value = '';
		//alert('Edit!!! (' + idEdit + ')');
		
		document.forms['frmTblApplications'].submit();
		
	}	
	
	function doCancel(idEvt, idCan){
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'cancelApplication';
		document.getElementById('cid[]').value = idEvt;
		document.getElementById('appCanId').value = idCan;
		document.getElementById('submited').value = '';
				
		document.forms['frmTblApplications'].submit();
		
	}
	
	function doUpdate(idEvt, idUpt, sOld){
		if(sOld == 0){
			document.getElementById('option').value = 'com_jevent';
			document.getElementById('controller').value = 'apply';
			document.getElementById('task').value = 'updateApplication';
			document.getElementById('cid[]').value = idEvt;
			document.getElementById('appId').value = idUpt;
			document.forms['frmTblApplications'].submit();
		}else{
			var x=document.getElementsByName("cid[]");
			x[1].value = idEvt;
			//salert(x[1].value);
			document.forms['frmTblApplicationsOld'].option.value = 'com_jevent';
			document.forms['frmTblApplicationsOld'].controller.value = 'apply';
			document.forms['frmTblApplicationsOld'].task.value = 'updateApplication';
			document.forms['frmTblApplicationsOld'].appId.value = idUpt;
			document.forms['frmTblApplicationsOld'].submit();
		}
	}
	
	function doCancel2(){
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'cancel2';
		document.forms['frmTblApplications'].submit();		
	}
</script>
<?php
	$txtErrStyle = 'border-color: #CC005B; border-style: solid; border-width: 1px';
?>
<form id="frmTblApplications<?php echo ($bShowCanceledParticipants ? 'Old' : '' );?>" method="post">
	<input type="hidden" id="option" name="option" value="com_jevent" />
	<input type="hidden" id="controller" name="controller" value="apply" />
	<input type="hidden" id="task" name="task" value="updateApplication" />
			
	<input type="hidden" id="cancelFlag" name="cancelFlag" value="0"/>
	<input type="hidden" id="submited" name="submited" value="1" />
	<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
	<input type="hidden" id="cid[]" name="cid[]" value="<?php echo (int)$array[0]; ?>" />
	<input type="hidden" id="appId" name="appId" value="" />
	<input type="hidden" id="appReId" name="appReId" value="" />
	<input type="hidden" id="appCanId" name="appCanId" value="" />
	<input type="hidden" id="cancelReId" name="cancelReId" value="" />
	<table width="100%">
		<thead>
			<tr>
			<!-- 
			<select name="dsr_title">
		      <option><?php echo JText::_('COM_JEVENT_LBL_TITLE_MR'); ?></option>
		      <option><?php echo JText::_('COM_JEVENT_LBL_TITLE_MRS'); ?></option>
		    </select>
		    -->
		    	<td width="7%"><b><?php echo JText::_('COM_JEVENT_LBL_DATE'); ?></b></td>
		    	<td width="6%"><b><?php echo JText::_('COM_JEVENT_LBL_TITLE'); ?></b></td>
				<td width="10%"><b><?php echo JText::_('COM_JEVENT_LBL_PRENAME'); ?></b></td>
				<td width="10%"><b><?php echo JText::_('COM_JEVENT_LBL_NAME') ; ?></b></td>
				<td width="15%"><b><?php echo JText::_('COM_JEVENT_LBL_ADDRESS'); ?></b></td>
				<td width="12%"><b><?php echo JText::_('COM_JEVENT_LBL_ZIPCITY'); ?></b></td>
				<td width="12%"><b><?php echo JText::_('COM_JEVENT_LBL_PHONE'); ?></b></td>
				<td width="17%"><b><?php echo JText::_('COM_JEVENT_LBL_EMAIL'); ?></b></td>
				<td width="30%"><b><?php echo JText::_('COM_JEVENT_LBL_ADMIN'); ?></b></td>
			</tr>
		</thead>
		<tbody>
			<?php
			if(count(($bShowCanceledParticipants ? $this->eventListCanceled : $this->eventList)) > 0){
				foreach (($bShowCanceledParticipants ? $this->eventListCanceled : $this->eventList) as $aEvent) { ?>
					<?php 
						$link2 		= JRoute::_( 'index.php?option=com_jEvent&controller=participants&task=participants&cid[]='. (int)$array[0] ); 
						$link3 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=editApplication&cid[]=' . (int)$array[0] . '&appId=' . $aEvent[7]); 
						$link4 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=resendApplicationEmail&cid[]=' . (int)$array[0] . '&appReId=' . $aEvent[7]); 
						$link5 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=cancelApplication&cid[]='. (int)$array[0] . '&appCanId=' . $aEvent[7]); 
						$link6 		= JRoute::_( 'index.php?option=com_jEvent&controller=apply&task=resendCancelEmail&cid[]=' . (int)$array[0] . '&cancelReId=' . $aEvent[7]); 
						$sTmp = (int)$array[0] . ', ' . $aEvent[7] . ', ' . ($bShowCanceledParticipants ? '1' : '0');
						$sTmp2 = (int)$array[0] . ',' . $aEvent[7];
						if($bShowCanceledParticipants)
							$date = new DateTime($aEvent[10]);
						else
							$date = new DateTime($aEvent[9]);
					?>
					<tr>
						<td><?php echo $date->format('d.m.Y');?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<select name="dsr_title"><option >' . JText::_('COM_JEVENT_LBL_TITLE_MR') . '</option>' .
		      					'<option ' . ($aEvent[8] == JText::_('COM_JEVENT_LBL_TITLE_MRS') ? 'selected' : '') . '>'. JText::_('COM_JEVENT_LBL_TITLE_MRS'). ' </option></select>' : $aEvent[8]); ?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_prename"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_prename" id="dsr_txt_prename" size="8" value="' . ($bInit ? $aEvent[1] : $_POST["dsr_txt_prename"]) . '"/>' : $aEvent[1]);?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_name"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_name" id="dsr_txt_name" size="8" value="' . ($bInit ? $aEvent[0] : $_POST["dsr_txt_name"]) . '"/>' : $aEvent[0]);?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_address"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_address" id="dsr_txt_address" size="14" value="' . ($bInit ? $aEvent[2] : $_POST["dsr_txt_address"]) . '"/>' : '<a href="' . $googleMapsLink . $aEvent[2] . ', ' . $aEvent[3] . ' ' . $aEvent[4] . '" target="_blank">' . $aEvent[2] . '</a>');?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_plz"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_plz" id="dsr_txt_plz" size="2" value="' . ($bInit ? $aEvent[3] : $_POST["dsr_txt_plz"]) . '"/><input type="text" style="' . ((!$bInit & $_POST["dsr_txt_city"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_city" id="dsr_txt_city" size="8" value="' . ($bInit ? $aEvent[4] : $_POST["dsr_txt_city"]) . '"/>' : '<a href="' . $googleMapsLink . $aEvent[2] . ', ' . $aEvent[3] . ' ' . $aEvent[4] . '" target="_blank">' . $aEvent[3] . ' ' . $aEvent[4] . '</a>');?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_phone"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_phone" id="dsr_txt_phone" size="10" value="' . ($bInit ? $aEvent[5] : $_POST["dsr_txt_phone"]) . '"/>' : $aEvent[5]);?></td>
						<td><?php echo ($appId == $aEvent[7] ? '<input type="text" style="' . ((!$bInit & $_POST["dsr_txt_email"] == "") ? $txtErrStyle : "") . '" name="dsr_txt_email" id="dsr_txt_email" size="20" value="' . ($bInit ? $aEvent[6] : $_POST["dsr_txt_email"]) . '"/><input type="hidden" id="id_upt" name="id_upt" value="'. $aEvent[7] . '" />' : '<a href="mailto:' . $aEvent[6] . '">' . $aEvent[6] . '</a>');?></td>
						<td>
							<!--
							<a href="<?php echo ($bShowCanceledParticipants ? $link6 : $link4); ?>" onclick="return confirm('<?php echo ($bShowCanceledParticipants ? JText::_('COM_JEVENT_QUE_WANT_TO_RESEND_CANCEL_EMAIL') : JText::_('COM_JEVENT_QUE_WANT_TO_RESEND_APPLICATION_EMAIL')); ?>')"><img src="<?php echo $sroot;?>/images/mail.png" alt="Resend" title="<?php echo ($bShowCanceledParticipants ? JText::_('COM_JEVENT_LBL_APPLY_RESEND_CANCEL_EMAIL') : JText::_('COM_JEVENT_LBL_APPLY_RESEND_APPLICATION_EMAIL')); ?>"/></a>
							-->
							
							<a href="javascript:resendEmail(<?php echo $sTmp ;?>);" onclick="return confirm('<?php echo ($bShowCanceledParticipants ? JText::_('COM_JEVENT_QUE_WANT_TO_RESEND_CANCEL_EMAIL') : JText::_('COM_JEVENT_QUE_WANT_TO_RESEND_APPLICATION_EMAIL')); ?>')"><img src="<?php echo $sroot;?>/images/mail.png" alt="Resend" title="<?php echo ($bShowCanceledParticipants ? JText::_('COM_JEVENT_LBL_APPLY_RESEND_CANCEL_EMAIL') : JText::_('COM_JEVENT_LBL_APPLY_RESEND_APPLICATION_EMAIL')); ?>"/></a>
							<?php 
								//echo ($appId == $aEvent[7] ? 'Yes ' : 'No ');
								//echo "[" . $appId . "] [" . $aEvent[7] . "]";
								if($appId == $aEvent[7] ){
							?>
								<a href="javascript:doUpdate(<?php echo $sTmp2 . ', ' . ($bShowCanceledParticipants ? '1' : '0'); ?>);"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>"/></a>
								<!--
								<a href="javascript:document.forms['frmTblApplications<?php echo ($bShowCanceledParticipants ? 'Old' : '' );?>'].submit();"><img src="<?php echo $sroot;?>/images/save.png" alt="Save" title="<?php echo JText::_('COM_JEVENT_LBL_SAVE'); ?>"/></a>
								-->
								
								<a href="javascript:doCancel2();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
								<!--
								<a href="javascript:history.back();"><img src="<?php echo $sroot;?>/images/cancel.png" alt="Cancel" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL'); ?>"/></a>
								-->
							<?php } else { ?>
							
								<a href="javascript:doEdit(<?php echo $sTmp2;?>);"><img src="<?php echo $sroot;?>/images/edit.png" alt="Edit" title="<?php echo JText::_('COM_JEVENT_LBL_EDIT'); ?>"/></a>
								<!-- 
								<a href="<?php echo $link3; ?>"><img src="<?php echo $sroot;?>/images/edit.png" alt="Edit" title="<?php echo JText::_('COM_JEVENT_LBL_EDIT'); ?>"/></a>
								-->
								<?php if(!$bShowCanceledParticipants){?>
									<a href="javascript:doCancel(<?php echo (int)$array[0] . ', ' . $aEvent[7]; ?>);" onclick="return confirm('<?php echo JText::_('COM_JEVENT_QUE_WANT_TO_CANCEL_APPLICATION')?>');"><img src="<?php echo $sroot;?>/images/delete.png" alt="Delete" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL_APPLICATION'); ?>"/></a>
									<!--
									<a href="<?php echo $link5; ?>" onclick="return confirm('<?php echo JText::_('COM_JEVENT_QUE_WANT_TO_CANCEL_APPLICATION')?>');"><img src="<?php echo $sroot;?>/images/delete.png" alt="Delete" title="<?php echo JText::_('COM_JEVENT_LBL_CANCEL_APPLICATION'); ?>"/></a>
									-->
								<?php } ?>
							<?php } ?>
						</td>
					</tr>	
				<?php
				}
			}else{
				?>
				<tr>
					<td><?php echo JText::_('COM_JEVENT_LBL_NO_APPLICANTS'); ?></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</form>
<?php if($bShowCanceledParticipants){?>
	</font>
<?php } ?>
