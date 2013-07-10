<?php

foreach($this->languages as $lang){
       $name = "name_".$lang->language;
       $alias = "alias_".$lang->language;
       $description = "description_".$lang->language;
       $short_description = "short_description_".$lang->language;
       $meta_title = "meta_title_".$lang->language;
       $meta_keyword = "meta_keyword_".$lang->language;
       $meta_description = "meta_description_".$lang->language;
       
       $name_pane = _JSHOP_DESCRIPTION; if ($this->multilang) $name_pane.=" (".$lang->lang.")".'<img class = "tab_image" border = "0" src = "' . JURI::root() . '/administrator/components/com_jshopping/images/flags/' . $lang->lang . '.gif" />';
   
   echo $pane->startPanel($name_pane, $lang->lang.'-page');
   ?>
   
     <div class="col100">
     <table class="admintable" >
       <tr>
         <td class="key" style="width:180px;">
           <?php echo _JSHOP_TITLE;?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "80" name = "<?php echo $name?>" value = "<?php echo $row->$name?>" />
         </td>
       </tr>
       <tr>
         <td class="key">
           <?php echo _JSHOP_ALIAS;?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "80" name = "<?php echo $alias?>" value = "<?php echo $row->$alias?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_SHORT_DESCRIPTION;?>
         </td>
         <td>
           <textarea name = "<?php print $short_description;?>" cols = "55" rows="5"><?php echo $row->$short_description ?></textarea>
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_DESCRIPTION;?>
         </td>
         <td>
           <?php
              $editor = &JFactory::getEditor();
              print $editor->display('description'.$lang->id,  $row->$description , '100%', '350', '75', '20' ) ;
           ?>
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_TITLE; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_title; ?>" value = "<?php echo $row->$meta_title;?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_DESCRIPTION; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_description?>" value = "<?php echo $row->$meta_description?>" />
         </td>
       </tr>
       <tr>
         <td  class="key">
           <?php echo _JSHOP_META_KEYWORDS; ?>
         </td>
         <td>
           <input type = "text" class = "inputbox" size = "160" name = "<?php print $meta_keyword?>" value = "<?php print $row->$meta_keyword?>" />
         </td>
       </tr>
     </table>
     </div>
     <div class="clr"></div>
   <?php
  echo $pane->endPanel();
}

?>