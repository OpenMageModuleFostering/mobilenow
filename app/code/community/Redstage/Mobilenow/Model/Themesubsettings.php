<?php

class Redstage_Mobilenow_Model_Themesubsettings extends Mage_Core_Model_Abstract
{
    protected function _construct(){
        parent::_construct();
       $this->_init("mobilenow/themesubsettings");

    }
    
    public function loadByAttributes($attributes)
{
    $this->setData($this->getResource()->loadByAttributes($attributes));
    return $this;
}

}
	 