<?php
class Redstage_Mobilenow_Model_Mysql4_Themesubsettings extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mobilenow/themesubsettings", "id");
    }
    public function loadByAttributes($attributes)
    {
        $adapter = $this->_getReadAdapter();
        $where   = array();
        foreach ($attributes as $attributeCode=> $value) {
            $where[] = sprintf('%s=:%s', $attributeCode, $attributeCode);
        }
        $select = $adapter->select()
            ->from($this->getMainTable())
            ->where(implode(' AND ', $where));

        $binds = $attributes;

        return $adapter->fetchRow($select, $binds);
    }
}