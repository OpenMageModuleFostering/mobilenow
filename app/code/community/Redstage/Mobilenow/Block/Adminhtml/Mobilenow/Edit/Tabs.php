<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("mobilenow_tabs");
        $this->setDestElementId("edit_form");
        $this->setTitle(Mage::helper("mobilenow")->__("Add New Mobile Theme"));
    }
    protected function _beforeToHtml()
    {
        $this->addTab("form_section", array(
        "label" => Mage::helper("mobilenow")->__("General Theme Settings"),
        "title" => Mage::helper("mobilenow")->__("General Theme Settings"),
        "content" => $this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tab_form")->toHtml(),
        ));
        if(Mage::app()->getRequest()->getActionName()!='new'){
            $this->addTab("design", array(
            "label" => Mage::helper("mobilenow")->__("Theme Design"),
            "title" => Mage::helper("mobilenow")->__("Theme Design"),
            "content" => $this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tab_design")->toHtml(),
            ));
            $this->addTab("theme_layouts", array(
            "label" => Mage::helper("mobilenow")->__("Theme Layouts"),
            "title" => Mage::helper("mobilenow")->__("Theme Layouts"),
            "content" =>$this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tab_layout")->toHtml(),
            ));
            $this->addTab("advanced_settings", array(
            "label" => Mage::helper("mobilenow")->__("Advanced Settings"),
            "title" => Mage::helper("mobilenow")->__("Advanced Settings"),
            "content" => $this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tab_advsettings")->toHtml(),
            ));
        }
        /*$this->addTab("analytics", array(
        "label" => Mage::helper("mobilenow")->__("Analytics"),
        "title" => Mage::helper("mobilenow")->__("Analytics"),
        "content" => 'Analytics content will be updated soon',
        ));
        $this->addTab("submission_history", array(
        "label" => Mage::helper("mobilenow")->__("Submission History"),
        "title" => Mage::helper("mobilenow")->__("Submission History"),
        "content" => 'Submission History content will be updated soon',
        ));
        $this->addTab("cache_management", array(
        "label" => Mage::helper("mobilenow")->__("Cache Management"),
        "title" => Mage::helper("mobilenow")->__("Cache Management"),
        "content" => 'Cache Management content will be updated soon',
        ));
        $this->addTab("social_networking", array(
        "label" => Mage::helper("mobilenow")->__("Social Networking"),
        "title" => Mage::helper("mobilenow")->__("Social Networking"),
        "content" => 'Social Networking content will be updated soon',
        ));
        $this->addTab("push_notification", array(
        "label" => Mage::helper("mobilenow")->__("Push Notification"),
        "title" => Mage::helper("mobilenow")->__("Push Notification"),
        "content" => 'Push Notification content will be updated soon',
        ));*/
         //if($this->getRequest()->getParam('load_id') || $this->getRequest()->getParam('reset_id'))
            //$this->setActiveTab('design');
        if($this->getRequest()->getParam('active_tab'))
            $this->setActiveTab($this->getRequest()->getParam('active_tab'));
        return parent::_beforeToHtml();
    }

}
