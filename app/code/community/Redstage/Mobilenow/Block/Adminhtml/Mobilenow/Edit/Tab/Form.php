<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/widget/form.phtml');     
    }     
    protected function _prepareForm()
    {
        $form       = new Varien_Data_Form();
        $this       ->setForm($form);
        $fieldset   = $form->addFieldset("mobilenow_form", array("legend"=>Mage::helper("mobilenow")->__("Mobile Theme Basic Settings")));		
        $fieldset   ->addField("theme_name", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Theme Name"),					
        "class"     => "required-entry",
        "required"  => true,
        "name"      => "theme_name",
        ));
         $fieldset  ->addField("mobile_device_design_interface", "select", array(
        "label"     => Mage::helper("mobilenow")->__("Mobile Device Design Interface"),
        "values"    =>  Mage::helper("mobilenow")->getValueArrayMobileDevice(),
        "name"      => "mobile_device_design_interface",					
        "class"     => "required-entry",
        "required"  => true,        
        "note"      => "This version of MobileNow has a iPhone/SmartPhone design interface. Future versions will include iPad, 7 Inch Tablets and other Android interfaces.",
        ));				
        $fieldset  ->addField("user_agent_regex_values", "multiselect", array(
        "label"     => Mage::helper("mobilenow")->__("User Agent RegEx Values"),
        "values"    => Mage::helper("mobilenow")->getValueArrayUserAgent(),
        "name"      => "user_agent_regex_values",					
        "class"     => "required-entry",
        "required"  => true,        
        "note"      => "<span>Choose the user agents that you want to trigger this mobile theme.</span><br><br><span>Hold CTRL + Click to select multiple values.</span><br><br><span>You can change this value in the future, if you create additional themes.</span>",
        ));
        if (!Mage::app()->isSingleStoreMode()) {
        $fieldset   ->addField('store_id', 'multiselect', array(
        "name"      => "stores[]",
        "label"     => Mage::helper("mobilenow")->__("Store View"),
        "title"     => Mage::helper("mobilenow")->__("Store View"),
        "required"  => true,
        "values"    => Mage::getSingleton("adminhtml/system_store")
                    ->getStoreValuesForForm(false, true),
        ));
        }
        else {
        $fieldset   ->addField("store_id", "hidden", array(
        "name"      => "stores[]",
        "value"     => Mage::app()->getStore(true)->getId()
        ));
        }
        $fieldset   ->addField("user_agent_regex_custom_values", "text", array(
        "label"     => Mage::helper("mobilenow")->__("User Agent RegEx Custom Values"),					
        "class"     => "",
        "required"  => false,
        "name"      => "user_agent_regex_custom_values",      
        "note"      => "Input your custom User Agent RegEx Values separated by the Pipe \"|\" Character.",
        ));
        $fieldset   ->addField("exclude_user_agent_regex_custom_values", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Exclude User Agent RegEx Custom Values"),					
        "class"     => "",
        "required"  => false,
        "name"      => "exclude_user_agent_regex_custom_values",      
        "note"      => "You can force the exclusion of any User Agent in this custom field.",    
        ));
        $fieldset   ->addField("status", "select", array(
        "label"     => Mage::helper("mobilenow")->__("Status"),
        "values"    => Mage::helper("mobilenow")->getValueArrayStatus(),
        "name"      => "status",					
        "class"     => "required-entry",
        "required"  => true,
        ));
        $fieldset->addField('hidden_theme_sub_setting_name', 'hidden', array(
        'label'     => Mage::helper('mobilenow')->__(''),
        'name'      => 'hidden_theme_sub_setting_name',
        'class'     => '',       
        'required'  => false         
        ));
        $fieldset->addField('general_theme_savebutton', 'text', array(
                'name'=>'general_theme_savebutton',                         
        ));
        $form->getElement('general_theme_savebutton')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_generalthemesavebutton'));
        
        
        if (Mage::getSingleton("adminhtml/session")->getMobilenowData())
        {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getMobilenowData());
            Mage::getSingleton("adminhtml/session")->setMobilenowData(null);
        } 
        elseif(Mage::registry("mobilenow_data"))
        {
            $form->setValues(Mage::registry("mobilenow_data")->getData());
        }
        return parent::_prepareForm();
    }
}
