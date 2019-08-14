<?php
class Redstage_Mobilenow_Model_Mysql4_Themestore extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mobilenow/themestore", "theme_id");
    }
    
}