<?php
class Redstage_Mobilenow_Block_Adminhtml_System_Config_Form_Link extends Mage_Adminhtml_Block_System_Config_Form_Field{

    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/system/config/link.phtml');
    }
 
    /**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
}