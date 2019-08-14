<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Customlayoutbuttons extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    //You can write html for your button here
        $setflag='';
        if(Mage::registry("subsettings_data")->getParent()!=0)
        {
            $checkForParentToReset=Mage::getModel('mobilenow/themesubsettings')->load(Mage::registry("subsettings_data")->getParent());
            if($checkForParentToReset->getPrimary()==1) $setflag=1;
            else $setflag='';
        }
    $html = ' <tr>        
                <td class="value" colspan="2">       
                    <a class="inline_save_as link_button_cls scalable save" title="" href="#inline_save_as_layout"><span class="save">Save As..</span></a>
                </td>
             </tr>';
			 if(Mage::registry("subsettings_data")->getPrimary()!=1 && $setflag!=1){
            $html .='<tr>        
                <td class="value" colspan="2">       
                    <a class="save_settings_link link_button_cls scalable save" title="" href="#inline_save_setting_layout""><span class="save">Save Settings..</span></a>
                </td>
             </tr>';
			 }
            if($setflag || (Mage::registry("subsettings_data")->getParent()==0 && Mage::registry("subsettings_data")->getPrimary()==1)){
             $html .='<tr><td class="value" style="width:290px;"></td></tr>
                 <tr>                
                <td class="value" colspan="2">       
                    <a class="reset_settings_link link_button_rst scalable" title="" href="#inline_reset_setting_layout"><span>Reset Settings to Default</span></a>
                </td>
            </tr>';}
            if(!$setflag && Mage::registry("subsettings_data")->getPrimary()==0){
              $html .='<tr><td class="value" style="width:330px;"></td></tr>
                  <tr>        
                <td class="value" colspan="2">       
                    <a class="inline_delete link_button_dlt scalable delete" title="" href="#inline_delete_layout"><span class="delete">Delete Custom Sub Settings</span></a>
                </td>
             </tr>
            ';}
   return $html;
  }
}
?>