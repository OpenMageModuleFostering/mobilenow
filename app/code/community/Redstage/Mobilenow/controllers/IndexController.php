<?php
class Redstage_Mobilenow_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Mobile Now"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("mobile now", array(
                "label" => $this->__("Mobile Now"),
                "title" => $this->__("Mobile Now")
		   ));
      $this->renderLayout(); 
	  
    }
}