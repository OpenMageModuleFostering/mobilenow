<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Customtext extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    //You can write html for your button here
    $html = '<tr>        
    <td class="value" colspan="2">
        <strong>Default Buttons Color Settings</strong>
        <hr/>
    </td>   
    </tr>';
   return $html;
  }
}
?>