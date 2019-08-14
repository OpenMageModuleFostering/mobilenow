<?php

class Redstage_Mobilenow_Helper_Cms_Page extends Mage_Cms_Helper_Page
{
    
    public function renderPage(Mage_Core_Controller_Front_Action $action, $pageId = null)
    {
        return $this->_renderPage($action, $pageId);
    }

   /**
    * Renders CMS page
    *
    * @param Mage_Core_Controller_Front_Action $action
    * @param integer $pageId
    * @param bool $renderLayout
    * @return boolean
    */
    protected function _renderPage(Mage_Core_Controller_Varien_Action  $action, $pageId = null, $renderLayout = true)
    {

        $page = Mage::getSingleton('cms/page');
        if (!is_null($pageId) && $pageId!==$page->getId()) {
            $delimeterPosition = strrpos($pageId, '|');
            if ($delimeterPosition) {
                $pageId = substr($pageId, 0, $delimeterPosition);
            }

            $page->setStoreId(Mage::app()->getStore()->getId());
            if (!$page->load($pageId)) {
                return false;
            }
        }

        if (!$page->getId()) {
            return false;
        }

        $inRange = Mage::app()->getLocale()
            ->isStoreDateInInterval(null, $page->getCustomThemeFrom(), $page->getCustomThemeTo());

        if(!Mage::getSingleton('core/session')->getMobileNowId()){
                if ($page->getCustomTheme()) {
                    if ($inRange) {
                        list($package, $theme) = explode('/', $page->getCustomTheme());
                        Mage::getSingleton('core/design_package')
                            ->setPackageName($package)
                            ->setTheme($theme);
                    }
                }
        }

        $action->getLayout()->getUpdate()
            ->addHandle('default')
            ->addHandle('cms_page');

        $action->addActionLayoutHandles();
		$package =  Mage::getSingleton('core/design_package')->getPackageName();
      
	    if ($page->getRootTemplate() && $package!='redstage-mobilenow') {
            $handle = ($page->getCustomRootTemplate()
                        && $page->getCustomRootTemplate() != 'empty'
                        && $inRange) ? $page->getCustomRootTemplate() : $page->getRootTemplate();
            $action->getLayout()->helper('page/layout')->applyHandle($handle);
        }

        Mage::dispatchEvent('cms_page_render', array('page' => $page, 'controller_action' => $action));

        $action->loadLayoutUpdates();
        $layoutUpdate = ($page->getCustomLayoutUpdateXml() && $inRange)
            ? $page->getCustomLayoutUpdateXml() : $page->getLayoutUpdateXml();
        $action->getLayout()->getUpdate()->addUpdate($layoutUpdate);
        $action->generateLayoutXml()->generateLayoutBlocks();

        $contentHeadingBlock = $action->getLayout()->getBlock('page_content_heading');
        if ($contentHeadingBlock) {
            $contentHeading = $this->escapeHtml($page->getContentHeading());
            $contentHeadingBlock->setContentHeading($contentHeading);
        }

       if ($page->getRootTemplate() && $package!='redstage-mobilenow') {
            $action->getLayout()->helper('page/layout')
                ->applyTemplate($page->getRootTemplate());
        }

        /* @TODO: Move catalog and checkout storage types to appropriate modules */
        $messageBlock = $action->getLayout()->getMessagesBlock();
        foreach (array('catalog/session', 'checkout/session', 'customer/session') as $storageType) {
            $storage = Mage::getSingleton($storageType);
            if ($storage) {
                $messageBlock->addStorageType($storageType);
                $messageBlock->addMessages($storage->getMessages(true));
            }
        }

        if ($renderLayout) {
            $action->renderLayout();
        }

        return true;
    }

    
}
