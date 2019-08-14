<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Logoimagedisplay extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    $logo_name = Mage::registry("subsettings_data")->getLogo();
    
    $dir_path = Mage::getBaseDir('media').DS.'mobilenow_theme_images/logo/'.$logo_name;
    if(@file_exists($dir_path) && $logo_name != ''){    
        $m_logo = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'mobilenow_theme_images/logo/'.$logo_name;
        $html = '<tr><td class="label "></td><td class="value "><img src="'.$m_logo.'" id="logo_preview" width="70"/></td></tr>';
    } else {
        $html = '<tr><td class="label "></td><td class="value "><img src="" id="logo_preview" width="70" /></td></tr>';
    }
   return $html;
  }
}
?>