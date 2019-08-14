<?php
class Redstage_Mobilenow_Adminhtml_IndexController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
           $this->loadLayout();
	   $this->_title($this->__("Mobile Now App"));
	   $this->renderLayout();
    }
    public function createthemeAction()
    {
        $this->loadLayout()->_setActiveMenu('mobilenow/createtheme');
        $this->renderLayout();
    }
    public function managethemeAction()
    {
        $this->loadLayout()->_setActiveMenu('mobilenow/managetheme');
        $this->renderLayout();
    }
    public function manageaccountAction()
    {
        $this->loadLayout()->_setActiveMenu('mobilenow/manageaccount');
        $this->renderLayout();
    }
    public function configoptAction()
    {
        Mage::app()->getResponse()->setRedirect(Mage::helper('adminhtml')->getUrl("adminhtml/system_config/"));
    }
    public function helpAction()
    {
        $this->_redirectUrl('http://mobilenowapp.com/');
    }
}