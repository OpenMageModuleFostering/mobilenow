<?php


class Redstage_Mobilenow_Block_Adminhtml_Mobilenow extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_mobilenow";
        $this->_blockGroup = "mobilenow";
	$this->_headerText = Mage::helper("mobilenow")->__("MobileNow: Manage Mobile Themes");
	$this->_addButtonLabel = Mage::helper("mobilenow")->__("Add New Mobile Theme");
	parent::__construct();
	
	}
}