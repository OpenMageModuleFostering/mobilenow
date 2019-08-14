<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Product list toolbar
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Redstage_Mobilenow_Block_Toolbar extends Mage_Core_Block_Template
{
    
    function getCustomToolBarHtml()
	{
		
		 $toolBarBlock = Mage::app()->getLayout()->createBlock('catalog/product_list_toolbar');
		 $toolBarBlock->setData('pager',$this->getData('pager')); 
		 $toolBarBlock->setData('sortbox',$this->getData('sortbox')); 
		 $toolBarBlock->setData('breadcrumb',$this->getData('breadcrumb')); 
		 $toolBarBlock->setData('showbreadcrumb',$this->getData('showbreadcrumb')); 
		 
		 $toolBarBlock->setData('_current_grid_mode', 'list');
		 $toolBarBlock->disableParamsMemorizing();
		 
		 $pagerlimitlist =explode(',', $this->getData('pagerlimitlist'));
		 if('all'== strtolower($pagerlimitlist[0])){
		 		$mode= 'list';
		 	    $perPageConfigKey = 'catalog/frontend/' . $mode . '_per_page_values';
		 	    $perPageValues = (string)Mage::getStoreConfig($perPageConfigKey);
		        $perPageValues = explode(',', $perPageValues);
		        $perPageValues = array_combine($perPageValues, $perPageValues);		       
		        $pagerlimitlist=    $perPageValues + array('all'=>$this->__('All'));
		       
		 	  //$toolBarBlock->addPagerLimit('list', 'All', '');
			  //$toolBarBlock->setDefaultListPerPage('All'); 
			  
		 }else{
		 	 
		 }
		
		 foreach ($pagerlimitlist as $key => $value) {
			 $toolBarBlock->addPagerLimit('list', $value, '');
		 }

		 if (in_array($this->getData('defaultlistperpage'), $pagerlimitlist)) {
		 	  		
		 	  
			  $toolBarBlock->setDefaultListPerPage( ucfirst($this->getData('defaultlistperpage')) ); 
			  //$toolBarBlock->setData('_current_limit', '10');
		 }
		 //$toolBarBlock->
		 
		$toolBarBlock->disableParamsMemorizing();
		
		 
		 //echo   $toolBarBlock->getDefaultPerPageValue();
		 //$toolBarBlock->setData('_current_grid_mode', 'list');
		
		 $pagerBlock = Mage::app()->getLayout()->createBlock('page/html_pager');
		 // $pagerBlock->setDefaultListPerPage('10');
		     
		 $toolBarBlock->setChild('product_list_toolbar_pager',$pagerBlock);
		 $productList = Mage::app()->getLayout()->createBlock('catalog/product_list');

		 $toolBarBlock->setCollection($productList->getLoadedProductCollection());
		 //$toolBarBlock->setDefaultListPerPage('10');
		 return $toolBarBlock->toHtml();
		
		
		/*$toolbar = Mage::app()->getLayout()->createBlock('catalog/product_list_toolbar');
        $pager = Mage::app()->getLayout()->createBlock('page/html_pager');
        $toolbar->setChild('product_list_toolbar_pager',$pager);
		
		// called prepare sortable parameters
        $collection = $this->_getProductCollection();

        // use sortable parameters
        if ($orders = $this->getAvailableOrders()) {
            $toolbar->setAvailableOrders($orders);
        }
        if ($sort = $this->getSortBy()) {
            $toolbar->setDefaultOrder($sort);
        }
        if ($dir = $this->getDefaultDirection()) {
            $toolbar->setDefaultDirection($dir);
        }
        if ($modes = $this->getModes()) {
            $toolbar->setModes($modes);
        }
        // set collection to toolbar and apply sort
        $toolbar->setCollection($collection);
        return $toolbar->toHtml();*/
    
	}
    
}
