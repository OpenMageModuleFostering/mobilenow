<?php


class Redstage_Mobilenow_Model_Layout_update extends Mage_Core_Model_Layout_Update
{
	public function saveCache()
    {
        if (!Mage::app()->useCache('layout')) {
            return false;
        }
        $str = $this->asString();
        $tags = $this->getHandles();
        $tags[] = self::LAYOUT_GENERAL_CACHE_TAG;      
		return Mage::app()->saveCache($str, $this->getCacheId().Mage::getSingleton('core/session')->getMobileNowId().Mage::getSingleton('core/session')->getLoadFrom(), $tags, null);
    }
}
	