<?php
class Redstage_Mobilenow_Block_Adminhtml_System_Config_Form_Button extends Mage_Adminhtml_Block_System_Config_Form_Field{

    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/system/config/button.phtml');
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
    /**
     * Generate button html
     *
     * @return string
     */
    public function getButtonHtml()
    {
        $connectUrl=Mage::helper('adminhtml')->getUrl('mobilenow/adminhtml_mobilenow/mobileConnect');
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
            'id'        => 'connect_mobile_now_button',
            'label'     => $this->helper('adminhtml')->__('Connect Account to Mobile Now'),
             'onclick'  => 'connectWithMobilenow(\''.$connectUrl.'\')' 
        ));
 
        return $button->toHtml();
    }

}