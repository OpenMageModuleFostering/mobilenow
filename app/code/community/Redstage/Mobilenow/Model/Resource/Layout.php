<?php

class Redstage_Mobilenow_Model_Resource_Layout extends Mage_Core_Model_Resource_Layout
{
	
	public function fetchUpdatesByHandle($handle, $params = array())
    {
    	$fr_admin = Mage::app()->getRequest()->getParam('isadmin');
		$ld_theme_id = Mage::app()->getRequest()->getParam('theme_id');
		$preview = Mage::app()->getRequest()->getParam('preview') ? Mage::app()->getRequest()->getParam('preview'):0;	
		if($fr_admin==1 && $ld_theme_id){
			$store = Mage::app()->getRequest()->getParam('store_id');
			
						
		}else{
			$store = Mage::app()->getStore()->getId();
			
		}
		
    	if(Mage::getSingleton('core/session')->getMobileNowId()){
	    	
			$bind = array(
	            'store_id'  => $store,
	            'area'      => Mage::getSingleton('core/design_package')->getArea(),
	            'package'   => 'redstage-mobilenow',
	            'theme'     => 'default'
	        );
		}else{
			$bind = array(
	            'store_id'  => $store,
	            'area'      => Mage::getSingleton('core/design_package')->getArea(),
	            'package'   => Mage::getSingleton('core/design_package')->getPackageName(),
	            'theme'     => Mage::getSingleton('core/design_package')->getTheme('layout')
	        );
		}
  

        foreach ($params as $key => $value) {
            if (isset($bind[$key])) {
                $bind[$key] = $value;
            }
        }
        $bind['layout_update_handle'] = $handle;
        $result = '';

        $readAdapter = $this->_getReadAdapter();
        if ($readAdapter) {
        	if(Mage::getSingleton('core/session')->getMobileNowId()){
        		$select = $readAdapter->select()
                ->from(array('layout_update' => $this->getMainTable()), array('xml'))    
                ->join(array('link'=>$this->getTable('core/layout_link')), 
                        'link.layout_update_id=layout_update.layout_update_id',
                        '')
       			->join(array('theme'=>$this->getTable('mobilenow/themelayoutsettings')), 
                        'theme.layout_link_id=link.layout_link_id AND theme.layout_update_id=layout_update.layout_update_id',                      
                        '')
                ->where('link.store_id IN (0, :store_id)')
                ->where('link.area = :area')
                ->where('link.package = :package')
                ->where('link.theme = :theme')
                ->where('layout_update.handle = :layout_update_handle')
    			->where('theme.theme_id ='.Mage::getSingleton('core/session')->getMobileNowId())
				->where('theme.preview ='.$preview)
                ->order('layout_update.sort_order ' . Varien_Db_Select::SQL_ASC);
        	}else{
        		$select = $readAdapter->select()
                ->from(array('layout_update' => $this->getMainTable()), array('xml'))    
                ->join(array('link'=>$this->getTable('core/layout_link')), 
                        'link.layout_update_id=layout_update.layout_update_id',
                        '')
       			->where('link.store_id IN (0, :store_id)')
                ->where('link.area = :area')
                ->where('link.package = :package')
                ->where('link.theme = :theme')
                ->where('layout_update.handle = :layout_update_handle')    			
                ->order('layout_update.sort_order ' . Varien_Db_Select::SQL_ASC);
        	}
            

            $result = join('', $readAdapter->fetchCol($select, $bind));
        }

        return $result;
	}
	
}