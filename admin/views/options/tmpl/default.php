<?php defined('_JEXEC') or die('Restricted access'); 


//var_dump($this->items);
?>
 
 <form action = "index.php?option=com_jevent&controller=options" method = "post" name = "adminForm" enctype = "multipart/form-data">
<input type="hidden" name="task" value="">
<input type="hidden" name="tab" value="1">
<input type="hidden" name="view" value="options">
<div class="col100">
<fieldset class="adminform">
    <legend><?php echo JText::_('COM_JEVENT_LBL_GENERAL_OPTIONS'); ?></legend>
<table class="admintable">
<!--
<tr>
    <td class="key" style="width:220px">
        <?php echo _JSHOP_EMAIL_ADMIN;?>
    </td>
    <td>
        <input type = "text" name = "contact_email" class = "inputbox" style="width:200px;" value = "<?php echo $jshopConfig->contact_email;?>" />
        <?php echo JHTML::tooltip(_JSHOP_EMAIL_ADMIN_INFO);?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_DEFAULT_LANGUAGE;?>
    </td>
    <td>
        <?php echo $lists['languages']; ?>
        <?php echo JHTML::tooltip(_JSHOP_INFO_DEFAULT_LANGUAGE);?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_TEMPLATE;?>
    </td>
    <td>
        <?php echo $lists['template'];?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_DISPLAY_PRICE_ADMIN;?>
    </td>
    <td>
        <?php echo $lists['display_price_admin']; ?>        
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_DISPLAY_PRICE_FRONT;?>
    </td>
    <td>
        <?php echo $lists['display_price_front']; ?> 
        <a href="index.php?option=com_jshopping&controller=configdisplayprice"><?php print _JSHOP_EXTENDED_CONFIG;?></a>        
    </td>
</tr>-->
<tr>
    <td class="key">
        <?php echo JText::_('COM_JEVENT_LBL_SHOW_FULL_INDICATOR_PIC');?>
    </td>
    <td>
        <input type="checkbox" name="show_red_light"  value = "1" <?php if ($this->items[0]->showRedLight) echo 'checked = "checked"';?> />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo JText::_('COM_JEVENT_LBL_SHOW_DEBUG_INFO');?>
    </td>
    <td>
        <input type="checkbox" name="show_debug_info"  value = "1" <?php if ($this->items[0]->showDebugInfo) echo 'checked = "checked"';?> />
         <!-- (Only for developers) -->
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo JText::_('COM_JEVENT_LBL_OWN_PHONENUMBER');?>
    </td>
    <td>
        <input type="text" name="phonenumber"  value = "<?php echo $this->items[0]->phonenumber; ?>"/>
         <!-- (Only for developers) -->
    </td>
</tr>
<!--
<tr>
    <td class="key">
        <?php echo _JSHOP_SAVE_INFO_TO_LOG?>
    </td>
    <td>
        <input type = "checkbox" name = "savelog" id="savelog" value = "1" <?php if ($jshopConfig->savelog) echo 'checked = "checked"';?> onclick="if (!jQuery('#savelog').attr('checked')) jQuery('#savelogpaymentdata').attr('checked',false);" />
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SAVE_PAYMENTINFO_TO_LOG?>
    </td>
    <td>
        <input type = "checkbox" name = "savelogpaymentdata" id="savelogpaymentdata" value = "1" <?php if ($jshopConfig->savelogpaymentdata) echo 'checked = "checked"';?> onclick="if (!jQuery('#savelog').attr('checked')) this.checked=false;" />
        <?php echo JHTML::tooltip(_JSHOP_SAVE_PAYMENTINFO_TO_LOG_INFO);?>
    </td>
</tr>
<tr>
    <td class="key">
        <?php echo _JSHOP_SECURITYKEY?>
    </td>
    <td>
        <input type = "input" name = "securitykey" size="50" value = "<?php print $jshopConfig->securitykey;?>" />
        <?php echo JHTML::tooltip(_JSHOP_INFO_SECURITYKEY);?>
    </td>
</tr>
-->

<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
<!--
<tr>
    <td class="key">
        <?php echo _JSHOP_LICENSEKEY?>
    </td>
    <td>
        <input type = "input" name = "licensekod" size="50" value = "<?php print $jshopConfig->licensekod;?>" />
        <a href="http://www.webdesigner-profi.de/joomla-webdesign/joomla-shop/forum/posts/22/373.html" target="_blank"><?php echo JHTML::tooltip(_JSHOP_INFO_LICENSEKEY);?></a>
    </td>
</tr>
-->

	
</table>
</fieldset>
</div>
<div class="clr"></div>
</form>
