<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Tab_Advsettings extends Mage_Adminhtml_Block_Widget_Form 
{
    /**
    * Class constructor
    *
    */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/widget/advsettings.phtml');     
    }
    protected function _prepareForm()
    {    
        if(Mage::registry("mobilenow_data"))
        {      
            $reg_data = Mage::registry("mobilenow_data");      
            $socialLinkData = json_decode($reg_data['social_links']);
            $cartInputData = json_decode($reg_data['cart_inputs']);
            if($socialLinkData->show_social_links ==1)$social_checked=true;
            if($cartInputData->show_cart_discount ==1)$cart_discount_checked=true;
            if($cartInputData->show_cart_shipping_quote ==1)$cart_shippng_quote_checked=true;
        }
        $form       = new Varien_Data_Form();
        $this       ->setForm($form);
        
        $fieldset   = $form->addFieldset("preset_advsettings_subsettings", array("legend"=>Mage::helper("mobilenow")->__("Mobile Theme Advanced Settings")));	
        $fieldset   ->addField("ip_override", "text", array(
        "label"     => Mage::helper("mobilenow")->__("IP override"),					
        "class"     => "",
        "required"  => false,
        "name"      => "ip_override",
        "note"  => "When this setting is enabled (by having an IP in the text box), your activated themes will ONLY show up for this IP address for testing purposes."
        ));
        $fieldset->addField('custom_css', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('Custom CSS Override'),
        'name'      => 'custom_css',
        'class'     => '',     
        'required'  => false,
            "note"  => "If you want to override any CSS classes, you may do that here!"
        ));
        $fieldset->addField('show_social_links', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Social Links?'),
        'name'      => 'show_social_links',
        'class'     => '',        
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $social_checked,
        ));
        $fieldset   ->addField("facebook_link", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Facebook"),					
        "class"     => "",
        "required"  => false,
        "name"      => "facebook_link",
        ));
        $fieldset   ->addField("twitter_link", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Twitter"),					
        "class"     => "",
        "required"  => false,
        "name"      => "twitter_link",
        ));
        $fieldset   ->addField("pinterest_link", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Pinterest"),					
        "class"     => "",
        "required"  => false,
        "name"      => "pinterest_link",
        ));
        $fieldset   ->addField("google_link", "text", array(
        "label"     => Mage::helper("mobilenow")->__("Google+"),					
        "class"     => "",
        "required"  => false,
        "name"      => "google_link",
        "note"  => "Input your social profile links above and the social icons will appear in the footer of your theme."
        ));
        $fieldset->addField('show_cart_discount', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Cart - Show Discount Code Input'),
        'name'      => 'show_cart_discount',
        'class'     => '',        
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $cart_discount_checked,
        ));
        $fieldset->addField('show_cart_shipping_quote', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Cart - Show Shipping Quote Input'),
        'name'      => 'show_cart_shipping_quote',
        'class'     => '',        
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $cart_shippng_quote_checked,
        ));
        $fieldset->addField('analytics', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('Analytics'),
        'name'      => 'analytics',
        'class'     => '',     
        'required'  => false      
        ));
        if (Mage::getSingleton("adminhtml/session")->getMobilenowData())
        {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getMobilenowData());
            Mage::getSingleton("adminhtml/session")->setMobilenowData(null);
        } 
        elseif(Mage::registry("mobilenow_data"))
        {
            $prefiled_values = Mage::registry("mobilenow_data")->getData();
            
            
            //advanced settings page
            $socialLinkData = json_decode($prefiled_values['social_links']);
            $cartInputData = json_decode($prefiled_values['cart_inputs']);
        
            $prefiled_values['custom_css'] = $prefiled_values['css_override'];
            $prefiled_values['show_social_links'] = $socialLinkData->show_social_links;
            $prefiled_values['facebook_link'] = $socialLinkData->facebook_link;
            $prefiled_values['twitter_link'] = $socialLinkData->twitter_link;
            $prefiled_values['pinterest_link'] = $socialLinkData->pinterest_link;
            $prefiled_values['google_link'] = $socialLinkData->google_link;
            $prefiled_values['show_cart_discount'] = $cartInputData->show_cart_discount;
            $prefiled_values['show_cart_shipping_quote'] = $cartInputData->show_cart_shipping_quote;
            
            
            $form->setValues($prefiled_values);
        }
        return parent::_prepareForm();
    }
    
}
