<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = "theme_id";
        $this->_blockGroup = "mobilenow";
        $this->_controller = "adminhtml_mobilenow";
        $this->_removeButton("save", "label", Mage::helper("mobilenow")->__("Save Theme"));
        $this->_removeButton("reset", "label", Mage::helper("mobilenow")->__("Reset"));
        $this->_updateButton("delete", "label", Mage::helper("mobilenow")->__("Delete Theme"));
         $this->_addButton("saveas", array(
                "label"     => Mage::helper("mobilenow")->__("Save As.."),
                "onclick"   => "javascript:showSaveAsPopup(this);",
                "class"     => "inline_save_as_top",
                "title"     => '',
        ), -100);
        $this->_addButton("saveandcontinue", array(
                "label"     => Mage::helper("mobilenow")->__("Save And Continue Edit"),
                "onclick"   => "saveAndContinueEdit()",
                "class"     => "save",
        ), -100);
        $this->_formScripts[] = "
                                function saveAndContinueEdit(){
                                    editForm.submit($('edit_form').action+'back/edit/');
                                }                                 
                                function continueToDesign()
                                {   
                                    if(editForm.validate())
                                    {                                                                
                                        editForm.submit($('edit_form').action+'back/edit/');
                                    }
                                }";         
    }
    public function getHeaderText()
    {
        if( Mage::registry("mobilenow_data") && Mage::registry("mobilenow_data")->getId() )
        {
            return Mage::helper("mobilenow")->__("MobileNow: Edit Theme '%s'", $this->htmlEscape(Mage::registry("mobilenow_data")->getThemeName()));
         } 
         else
         {
             return Mage::helper("mobilenow")->__("MobileNow: Create a New Mobile Theme");

         }
    }
}