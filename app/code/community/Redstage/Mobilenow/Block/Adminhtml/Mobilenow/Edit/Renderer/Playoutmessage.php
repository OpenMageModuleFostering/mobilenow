<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Playoutmessage extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    
    $html = '
        <tr><td class="label "></td><td class="value "></td></tr><tr>        
    <td class="value " colspan="2">
        <span class="message-italic">Organize the order of elements on the Product Page below. Be sure to preview your changes before saving and publishing your theme as certain 
                           changes can make your page confusing. If you want to exclude any elements - go back to the Theme Design Section</span>
    </td>   
    </tr>
        <tr>';
   return $html;
  }
}
?>