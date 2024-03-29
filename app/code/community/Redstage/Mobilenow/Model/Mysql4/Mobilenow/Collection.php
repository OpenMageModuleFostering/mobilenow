<?php
    class Redstage_Mobilenow_Model_Mysql4_Mobilenow_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
    {
		public function _construct(){
			$this->_init("mobilenow/mobilenow");
                        $this->_map['fields']['store'] = 'store_table.store_id';
		}
               /**
                * Add filter by store
                *
                * @param int|Mage_Core_Model_Store $store
                * @param bool $withAdmin
                * @return Mage_Cms_Model_Resource_Block_Collection
                */
               public function addStoreFilter($store, $withAdmin = true)
               {                   
                   if ($store instanceof Mage_Core_Model_Store) {
                       $store = array($store->getId());
                   }

                   if (!is_array($store)) {
                       $store = array($store);
                   }

                   if ($withAdmin) {
                       $store[] = Mage_Core_Model_App::ADMIN_STORE_ID;
                   }
                   $this->addFilter('store', array('in' => $store), 'public');

                   return $this;
               }
                 /**
                * Get SQL for get record count.
                * Extra GROUP BY strip added.
                *
                * @return Varien_Db_Select
                */
               public function getSelectCountSql()
               {
                    /*Previous Code 
                    $countSelect = parent::getSelectCountSql();
                    $countSelect->reset(Zend_Db_Select::GROUP);
                    return $countSelect;*/
                    $this->_renderFilters();
                    $countSelect = clone $this->getSelect();
                    $countSelect->reset(Zend_Db_Select::ORDER);
                    $countSelect->reset(Zend_Db_Select::LIMIT_COUNT);
                    $countSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
                    $countSelect->reset(Zend_Db_Select::COLUMNS);
                    if(count($this->getSelect()->getPart(Zend_Db_Select::GROUP)) > 0)
                    {
                        $countSelect->reset(Zend_Db_Select::GROUP);
                        $countSelect->distinct(true);
                        $group = $this->getSelect()->getPart(Zend_Db_Select::GROUP);
                        $countSelect->columns("COUNT(DISTINCT ".implode(", ", $group).")");
                    } 
                    else
                    {
                        $countSelect->columns('COUNT(*)');
                    }
                    return $countSelect;
               }

               /**
                * Join store relation table if there is store filter
                */
               protected function _renderFiltersBefore()
               {
                   //if ($this->getFilter('store')) {
                       $this->getSelect()->join(
                           array('store_table' => $this->getTable('mobilenow/themestore')),'main_table.theme_id = store_table.theme_id',array())->group('main_table.theme_id');

                       /*
                        * Allow analytic functions usage because of one field grouping
                        */
                       $this->_useAnalyticFunction = true;
                   //}
                   return parent::_renderFiltersBefore();
               }
    }
	 