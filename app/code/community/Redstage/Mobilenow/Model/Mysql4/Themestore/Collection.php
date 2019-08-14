<?php
class Redstage_Mobilenow_Model_Mysql4_Themestore_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
            public function _construct()
            {
                 parent::_construct();
                 $this->_init("mobilenow/themestore");                        
            }              
}
	 