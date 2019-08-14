<?php
class Redstage_Mobilenow_Model_Mysql4_Mobilenow extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("mobilenow/mobilenow", "theme_id");
    }
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {   
        $arrayUserAgent=Mage::helper("mobilenow")->getOptionArrayUserAgent();
        if($object->getStatus()==1)
        {
            $allStores = Mage::app()->getStores();      
            foreach ($allStores as $_eachStoreId => $val)
            {
               $_storeId[] = Mage::app()->getStore($_eachStoreId)->getId();
            }       
            if(implode('',$object->getStores())==0){
                $checkStores=$_storeId;
            }
            else{          
                $checkStores=$object->getStores();
                $checkStores[]='0';
            }
            //print_r($object->getData());
            //$themeStoreCollection = Mage::getModel('mobilenow/themestore')->getCollection()->addFieldToFilter('store_id', $object->getStores());        
            $themeStoreCollection =$this->_getReadAdapter()->select()->from(array('themestore' => $this->getTable('mobilenow/themestore')))->where('themestore.store_id IN (?)', $checkStores);
            //echo $themeStoreCollection;exit;
            $themeStoreCollection=$this->_getReadAdapter()->fetchAll($themeStoreCollection);        
            foreach($themeStoreCollection as $themeStore)
            {   
                /////////////// Processing values from DB on each iteration////////
                $mobilenowCollection=Mage::getModel('mobilenow/mobilenow')->load($themeStore['theme_id']);
                if($object->getThemeId()!=$mobilenowCollection->getThemeID() && $mobilenowCollection->getStatus()==1){
                    $collectionUserAgent=explode(',',$mobilenowCollection->getUserAgentRegexValues());                        
                    foreach($collectionUserAgent as $collectAgent)
                    {                
                        $finalCollectionUserAgent[]=$arrayUserAgent[$collectAgent];
                    }            
                    $customCollectionUserAgentValues=explode('|',$mobilenowCollection->getUserAgentRegexCustomValues());
                    $mergedCollectionUserAgent=array_filter(array_map('strtolower',array_merge($finalCollectionUserAgent,$customCollectionUserAgentValues)));            
                    //echo '<pre>';print_r($mergedCollectionUserAgent);echo '</pre>';
                    /////////////// Processing User posted values////////
                    $objectUserAgent=explode(',',$object->getUserAgentRegexValues());
                    foreach($objectUserAgent as $objectAgent)
                    {                
                        $finalobjectUserAgent[]=$arrayUserAgent[$objectAgent];                
                    }            
                    $objectCustomUserAgent=explode('|',$object->getUserAgentRegexCustomValues());
                    $mergedObjectUserAgent=array_filter(array_map('strtolower',array_merge($finalobjectUserAgent,$objectCustomUserAgent)));           
                    $resultUseragent=array_intersect($mergedObjectUserAgent,$mergedCollectionUserAgent);            
                    if (!empty($resultUseragent) || in_array('all',$mergedCollectionUserAgent) || in_array('all',$mergedObjectUserAgent))
                    {
                       Mage::throwException(Mage::helper('mobilenow')->__('The selected User Agents and Store View combination already exists.'));
                    }            
                }            
            }
        }
        //Check for the subscription details Free/Active subscription
        //echo '<pre>';print_r($object->getData());echo '</pre>';exit;
        if(Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/subscription'))
            $MnSubscription=json_decode(Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/subscription'));            
        if(($MnSubscription->productId==2 && $object->getStatus()==1) || ($MnSubscription->productId==5 && $object->getStatus()==1))
            Mage::throwException(Mage::helper('mobilenow')->__('You cannot activate theme, because you are using a Free account.'));
    }
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {      
        $oldStores = $this->lookupStoreIds($object->getId());
        $newStores = (array)$object->getStores();

        $table  = $this->getTable('mobilenow/themestore');
        $insert = array_diff($newStores, $oldStores);
        $delete = array_diff($oldStores, $newStores);

        if ($delete) {
            $where = array(
                'theme_id = ?'     => (int) $object->getId(),
                'store_id IN (?)' => $delete
            );

            $this->_getWriteAdapter()->delete($table, $where);
        }

        if ($insert) {
            $data = array();

            foreach ($insert as $storeId) {
                $data[] = array(
                    'theme_id'  => (int) $object->getId(),
                    'store_id' => (int) $storeId
                );
            }

            $this->_getWriteAdapter()->insertMultiple($table, $data);
        }

        return parent::_afterSave($object);

    }    
    public function load(Mage_Core_Model_Abstract $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'identifier';
        }

        return parent::load($object, $value, $field);
    }
    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {
        if ($object->getId()) {
            $stores = $this->lookupStoreIds($object->getId());
            $object->setData('store_id', $stores);
            $object->setData('stores', $stores);
        }

        return parent::_afterLoad($object);
    }   
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {
            $stores = array(
                (int) $object->getStoreId(),
                Mage_Core_Model_App::ADMIN_STORE_ID,
            );

            $select->join(
                array('cbs' => $this->getTable('mobilenow/themestore')),
                $this->getMainTable().'.theme_id = cbs.theme_id',
                array('store_id')
            )/*->where('is_active = ?', 1)*/
            ->where('cbs.store_id in (?) ', $stores)
            ->order('store_id DESC')
            ->limit(1);
        }

        return $select;
    }
        /**
     * Get store ids to which specified item is assigned
     *
     * @param int $id
     * @return array
     */
    public function lookupStoreIds($id)
    {
        $adapter = $this->_getReadAdapter();

        $select  = $adapter->select()
            ->from($this->getTable('mobilenow/themestore'), 'store_id')
            ->where('theme_id = :theme_id');

        $binds = array(
            ':theme_id' => (int) $id
        );

        return $adapter->fetchCol($select, $binds);
    }
}