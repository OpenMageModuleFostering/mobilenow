<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Customcatalog extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
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
        <strong>Product Views</strong>
        <hr/>';
        /*<strong>List View - <a href="#" class="link-color">View in Preview Window</a></strong>*/
     $html .= '  <strong>List View</strong>
    </td>   
    </tr>';
   return $html;
  }
}
?>