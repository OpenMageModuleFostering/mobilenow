<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Generalthemesavebutton extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    //You can write html for your button here
    $html = '<tr>  <td class="label">&nbsp;</td>      
    <td class="value">
        <button style="" onclick="continueToDesign()" class="scalable save continue_step" type="button" title="Save" id="general_theme_save">
            <span><span><span>Save</span></span></span>
        </button>
    </td>   
    </tr>';
   return $html;
  }
}
?>