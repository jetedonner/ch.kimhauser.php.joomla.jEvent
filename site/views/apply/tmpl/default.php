<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>

<?php require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'helperFunctions.php');?>

<script>
	function doBack2Events(){
		//alert('hi!!!');
		document.getElementById('option').value = 'com_jevent';
		document.getElementById('controller').value = 'apply';
		document.getElementById('task').value = 'reloadView1';
		//alert('hi 2!!!');
		document.forms['frmTblApply'].submit();		
	}
</script>


<?php 
	//COM/components/com_jevent/templates/AGB.html
	$data = JRequest::get( 'post' );
	//echo 'Submited: ' .$data['submited'];
	if($data['submited'] == '')
		$bInit = false;
	else
		$bInit = true;
?>
<script>
	function load(){
		//alert("Hi");
		window.open('index.php/component/jEvent/?controller=apply&task=showAGB','mywindow','width=800,height=800,toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,scrollbars=yes,copyhistory=yes,resizable=yes');
	}
</script>
<h1><?php echo JText::_('COM_JEVENT_TITLE_APPLY'); ?></h1>
<form id="frmTblApply" method="post">
<?php require_once(JPATH_COMPONENT.DS.'helpers' . DS. 'showLessonInfo.php'); ?>

<?php //echo 'CHK' . $data['dsr_chk_AGB']; 
	if($data['dsr_chk_AGB'] == "")
		$sChecked = '';
	else
		$sChecked = 'checked';
?>
<?php
	$txtErrStyle = 'border-color: #CC005B; border-style: solid; border-width: 1px';
?>
<table width="100%" >
	<thead>
		<tr>
			<td width="20%"></td>
			<td width="80%"></td>
		</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo JText::_('COM_JEVENT_LBL_TITLE'); ?></td>
		<td>
			<select name="dsr_title">
		      <option><?php echo JText::_('COM_JEVENT_LBL_TITLE_MR'); ?></option>
		      <option><?php echo JText::_('COM_JEVENT_LBL_TITLE_MRS'); ?></option>
		    </select>
		</td>
	</tr>
	<tr>
		<td><?php echo (($bInit & $data['dsr_txt_prename'] == "") ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_PRENAME') . '</b></font>': JText::_('COM_JEVENT_LBL_PRENAME')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_prename'] == "") ? $txtErrStyle : '')?>" size="50" id="dsr_txt_prename" name="dsr_txt_prename" value="<?php echo ($_POST["dsr_txt_prename"] != '' ? $_POST["dsr_txt_prename"] : '');?>"/></td>
	</tr>
	<tr>
		<td><?php echo (($bInit & $data['dsr_txt_name'] == "") ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_NAME') . '</b></font>': JText::_('COM_JEVENT_LBL_NAME')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_name'] == "") ? $txtErrStyle : '')?>" size="50" id="dsr_txt_name" name="dsr_txt_name" value="<?php echo ($_POST["dsr_txt_name"] != '' ? $_POST["dsr_txt_name"] : '');?>"/></td>
	</tr>
	<tr>
		<td><?php echo (($bInit & $data['dsr_txt_address'] == "") ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_ADDRESS') . '</b></font>': JText::_('COM_JEVENT_LBL_ADDRESS')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_address'] == "") ? $txtErrStyle : '')?>" size="50" id="dsr_txt_address" name="dsr_txt_address" value="<?php echo ($_POST["dsr_txt_address"] != '' ? $_POST["dsr_txt_address"] : '');?>"/></td>
	</tr>
	<tr>
		<td><?php echo ((($bInit & $data['dsr_txt_plz'] == "") | ($bInit & $data['dsr_txt_city'] == "")) ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_ZIPCITY') . '</b></font>': JText::_('COM_JEVENT_LBL_ZIPCITY')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_plz'] == "")  ? $txtErrStyle : '')?>" size="9" id="dsr_txt_plz" name="dsr_txt_plz" value="<?php echo ($_POST["dsr_txt_plz"] != '' ? $_POST["dsr_txt_plz"] : '');?>"/> / <input type="text" style="<?php echo (($bInit & $data['dsr_txt_city'] == "")  ? $txtErrStyle : '')?>" size="34" id="dsr_txt_city" name="dsr_txt_city" value="<?php echo ($_POST["dsr_txt_city"] != '' ? $_POST["dsr_txt_city"] : '');?>"/></td>
	</tr>
	<tr>
		<td><?php echo (($bInit & $data['dsr_txt_phone'] == "") ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_PHONE') . '</b></font>': JText::_('COM_JEVENT_LBL_PHONE')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_phone'] == "") ? $txtErrStyle : '')?>" size="50" id="dsr_txt_phone" name="dsr_txt_phone" value="<?php echo ($_POST["dsr_txt_phone"] != '' ? $_POST["dsr_txt_phone"] : '');?>"/></td>
	</tr>
	<tr>
		<td><?php echo (($bInit & $data['dsr_txt_email'] == "" | ($data['dsr_txt_email'] != "" & !filter_var($_POST['dsr_txt_email'], FILTER_VALIDATE_EMAIL))) ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_LBL_EMAIL') . '</b></font>': JText::_('COM_JEVENT_LBL_EMAIL')); ?></td>
		<td><input type="text" style="<?php echo (($bInit & $data['dsr_txt_email'] == "" | ($data['dsr_txt_email'] != "" & !filter_var($_POST['dsr_txt_email'], FILTER_VALIDATE_EMAIL))) ? $txtErrStyle : '')?>" size="50" id="dsr_txt_email" name="dsr_txt_email" value="<?php echo ($_POST["dsr_txt_email"] != '' ? $_POST["dsr_txt_email"] : '');?>"/></td>
	</tr>
	<tr>
		<td></td>
		<td>
			<br/><input type="checkbox" id="dsr_chk_AGB" name="dsr_chk_AGB" <?php echo $sChecked; ?>/> <?php echo (($bInit & $data['dsr_chk_AGB'] == "") ? '<font color="#CC005B"><b>' . JText::_('COM_JEVENT_TXT_APPLY_DISCLAMER') . '</b></font>': JText::_('COM_JEVENT_TXT_APPLY_DISCLAMER')); ?> <a href="javascript:load()">AGB</a>
		</td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" value="<?php echo JText::_('COM_JEVENT_LBL_APPLY_SEND'); ?>"/></td>
	</tr>
	</tbody>
</table>
<input type="hidden" id="submited" name="submited" value="1" />
<input type="hidden" id="option" name="option" value="com_jevent" />
<input type="hidden" id="task" name="task" value="saveApplication" />
<input type="hidden" id="boxchecked" name="boxchecked" value="0" />
<input type="hidden" id="controller" name="controller" value="apply" />
<input type="hidden" name="applyEventId" id="applyEventId" value="<?php echo $this->nId;?>" />
<input type="hidden" name="cid[]" id="cid[]" value="<?php echo $this->nId;?>" />
</form>

<a href="javascript:doBack2Events();"><?php echo JText::_('COM_JEVENT_LBL_BACK'); ?></a>
<br/>
<br/>
