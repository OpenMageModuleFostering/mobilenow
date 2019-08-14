<?php
class Redstage_Mobilenow_Adminhtml_MobilenowController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {        
        $this->loadLayout()->_setActiveMenu("mobilenow/mobilenow")->_addBreadcrumb(Mage::helper("adminhtml")->__("Mobilenow  Manager"),Mage::helper("adminhtml")->__("Mobilenow Manager"));
        return $this;
    }
    public function indexAction() 
    {
        $this->_title($this->__("Mobilenow"));
        $this->_title($this->__("MobileNow: Manage Mobile Themes"));
        Mage::helper("mobilenow")->_disableModule('Redstage_Mobilenow');
        $this->_initAction();
        $this->renderLayout();
    }
    public function editAction()
    {		               
        $this->_title($this->__("Mobilenow"));
        $this->_title($this->__("Mobilenow"));
        $this->_title($this->__("Edit Item"));
        Mage::helper("mobilenow")->_disableModule('Redstage_Mobilenow');
        $id = $this->getRequest()->getParam("id");
        $tab_data= $this->getRequest()->getParam("tab");
        $loadId=$this->getRequest()->getParam('load_id');
        $loadReset=$this->getRequest()->getParam('reset_delete');
        $model = Mage::getModel("mobilenow/mobilenow")->load($id);
        if ($model->getId())
        {
            Mage::register("mobilenow_data", $model);                            
            $this->_loadSubsettings($loadId,$loadReset);
            $this->loadLayout();
            $this->_setActiveMenu("mobilenow/mobilenow");
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mobilenow Manager"), Mage::helper("adminhtml")->__("Mobilenow Manager"));
            $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mobilenow Description"), Mage::helper("adminhtml")->__("Mobilenow Description"));
            $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
            $this->_addContent($this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit"))->_addLeft($this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tabs"));                                                                               
            $this->renderLayout();                                       
        } 
        else
        {
            //Mage::getSingleton("adminhtml/session")->addError(Mage::helper("mobilenow")->__("Item does not exist."));
            $this->_redirect("*/*/new",array('active_tab'=>$this->getRequest()->getParam('active_tab'),
            'design_subtab'=>$this->getRequest()->getParam('design_subtab'),
            'layout_subtab'=>$this->getRequest()->getParam('layout_subtab'),
            'load_id' => $this->getRequest()->getParam('load_id')
            ));
        }
    }
    public function newAction()
    {
        //$this->_title($this->__("Mobilenow"));        
        $this->_title($this->__("MobileNow: Create New Mobile Theme"));
        Mage::helper("mobilenow")->_disableModule('Redstage_Mobilenow');
        $id   = $this->getRequest()->getParam("id");
        $model  = Mage::getModel("mobilenow/mobilenow")->load($id);
        $loadReset=$this->getRequest()->getParam('reset_delete');
        $loadId=$this->getRequest()->getParam('load_id');
        $this->_loadSubsettings($loadId,$loadReset);
        $data = Mage::getSingleton("adminhtml/session")->getFormData(true);
        if (!empty($data)) {
                $model->setData($data);
        }
        Mage::register("mobilenow_data", $model);
        $this->loadLayout();
        $this->_setActiveMenu("mobilenow/mobilenow");
        $this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mobilenow Manager"), Mage::helper("adminhtml")->__("Mobilenow Manager"));
        $this->_addBreadcrumb(Mage::helper("adminhtml")->__("Mobilenow Description"), Mage::helper("adminhtml")->__("Mobilenow Description"));
        $this->_addContent($this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit"))->_addLeft($this->getLayout()->createBlock("mobilenow/adminhtml_mobilenow_edit_tabs"));
        $this->renderLayout();
    }
    public function saveAction()
    { 
        $post_data=$this->getRequest()->getPost(); 
        $button_type = $this->getRequest()->getParam('buttontype');
        //echo '<pre>'; print_r($post_data); echo '</pre>';exit;
        if (!empty($post_data))
        {   
            if($post_data['show_learn_more']!=1)$post_data['show_learn_more']=0;            
            try
            {	
                $themeSubSettingsModel = Mage::getModel('mobilenow/themesubsettings');
                $arg_array = array();
                if($this->getRequest()->getParam("active_tab")){
                    $arg_array['active_tab'] = $this->getRequest()->getParam("active_tab");
                }
                if($this->getRequest()->getParam("design_subtab")){
                    $arg_array['design_subtab'] = $this->getRequest()->getParam("design_subtab");
                }
                if($this->getRequest()->getParam("layout_subtab")){
                    $arg_array['layout_subtab'] = $this->getRequest()->getParam("layout_subtab");
                }
                if($this->getRequest()->getParam("load_id")){
                    $arg_array['load_id'] = $this->getRequest()->getParam("load_id");
                }
                if(!$post_data['hidden_action_val'])
                    $arg_array['loadPreivew'] = 1;
                //This Condition saves the Theme and the respective Sub Settings
                if (!$this->getRequest()->getParam("savesubsettings"))
                {     
                    if( !$post_data['stores']) $this->_redirect("*/*/");
                    $createnewThemeFlag='';
                    $saveAsTop=$this->getRequest()->getParam("savenew");
                    $post_data['user_agent_regex_values']=implode(',',$post_data['user_agent_regex_values']);
                    //Save Theme                    
                    // saving advanced settings
                    $post_data['css_override']    = $post_data['custom_css'];
                    $post_data['social_links']    = json_encode(array('show_social_links'=>$post_data['show_social_links'],
                                                                            'facebook_link'=>$post_data['facebook_link'],
                                                                            'twitter_link'=>$post_data['twitter_link'],
                                                                            'pinterest_link'=>$post_data['pinterest_link'],
                                                                            'google_link'=>$post_data['google_link']
                                                                            ));
                    $post_data['cart_inputs']    = json_encode(array('show_cart_discount'=>$post_data['show_cart_discount'], 
                                                                'show_cart_shipping_quote'=>$post_data['show_cart_shipping_quote']));
                    
                    
                    $model = Mage::getModel("mobilenow/mobilenow");
                    if(!$saveAsTop)
                    {
                        $model->addData($post_data)->setId($this->getRequest()->getParam("id"))->save();                        
                    }                      
                    else
                    {
                        $createnewThemeFlag=1;
                        $post_data['theme_name']=$post_data['hidden_theme_sub_setting_name'];
                        $model->addData($post_data)->save();                    
                    }
                    //Save Preset Subsettings with respect to Theme
                    $saveProcessedData=Mage::helper("mobilenow")->ProcessThemeDesignFormData($post_data,'',$model->getId(),$createnewThemeFlag);                        
                    //Check for values whether to save / Update in themesubsettings table
                    $selectAttributes = array('themeid'=> $model->getId(), 'preview'=> 0);
                    $selectCurrentRecord=$themeSubSettingsModel->loadByAttributes($selectAttributes);
                    //$selectCurrentRecord=$themeSubSettingsModel->load($model->getId(),'themeid');                     
                    
                    // preset_sub_settings and preset_layout_sub_settings will have the same value
                    if(!$saveAsTop)
                        $saveProcessedData['parent']=$post_data['preset_sub_settings'];
                    else 
                        $saveProcessedData['parent']=0;                                                         
                    //If Condition will updated the record in themesubsettings table and else will insert a new record                    
                    if($selectCurrentRecord->getId())
                    {                           
                        $ThemesubsetId=$selectCurrentRecord->getId();                    
                        $themeSubSettingsModel->setData($saveProcessedData)->setId($ThemesubsetId)->save();
                    }
                    else                                            
                    {    
                    /*  if($saveAsTop)
                        {
                            //Create new subsetting
                            $themeSubSettingsModel->setData($saveProcessedData)->save();
                            $saveProcessedData['parent']=$themeSubSettingsModel->getId();
                            $saveProcessedData['themeid']=$model->getId();
                            $saveProcessedData['subsetname']='';
                        }*/
                        //Insert the same record and assign it to a theme                        
                        if($post_data['hidden_action_val'])
                        $themeSubSettingsModel->setData($saveProcessedData)->save();                        
                    }                       
                    
                    //Check for values whether to save / Update in themesubsettings table
                    $themeSubSettingsModelDel = Mage::getModel('mobilenow/themesubsettings');
                    $attributesDel = array('themeid'=> $model->getId(), 'preview'=> 1);
                    $selectCurrentRecordDel=$themeSubSettingsModelDel->loadByAttributes($attributesDel);    
                    if($selectCurrentRecordDel->getId()){
                        $selectCurrentRecordDel->delete();
                    }
                    
                    $css_var_arr = $this->__setCssVariables($post_data);
                    $csspath = Mage::getBaseDir('media').DS.'mobilenow_theme_css'.DS; 
                    $css_file_name = Mage::getBaseDir('media').DS.'mobilenow_theme_css'.DS.md5($model->getId()).'.css'; 
                    mkdir($csspath);   
                    $css_string = Mage::helper('mobilenow/theme')->generateThemeCssFile($css_var_arr);
                    if (file_exists($css_file_name) ){ 
                        @unlink($css_file_name);
                    }
                    if($post_data['custom_css'] != ''){
                        $css_string .= $post_data['custom_css'];
                    }
                    
                    file_put_contents($css_file_name, $css_string);
                    // generating homepage layout xml
                    
                    
                   // echo $css_string;die;
                   // echo $css_string;die;
                    
                   
                    // generating homepage layout xml
                    $home_xml_string = Mage::helper('mobilenow/homepage')->generateHomePageLayoutXML($post_data);
                    
                    if($home_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$home_xml_string,'cms_index_index',$post_data['stores']);                        
                    }   
                    
                    
                    // generating default layout xml
                    $default_xml_string = Mage::helper('mobilenow/homepage')->generateDefaultPageLayoutXML($post_data,md5($model->getId()));
                    if($default_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$default_xml_string,'default',$post_data['stores']);                        
                    }   
                    
                    // generating catalog layout xml
                    $catalog_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogPageLayoutXML($post_data);
                    //echo $catalog_xml_string;die;
                    if($catalog_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_xml_string,'catalog_category_layered',$post_data['stores']);                        
                    }  
                    // generating catalog layout xml
                    $catalog_default_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogPageLayoutXML($post_data);
                    //echo $catalog_xml_string;die;
                    if($catalog_default_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_default_xml_string,'catalog_category_default',$post_data['stores']);                        
                    }
                    // generating catalog search page layout xml
                    $catalog_search_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogSearchPageLayoutXML($post_data);
                    //echo $catalog_search_xml_string;die;
                    if($catalog_search_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_search_xml_string,'catalogsearch_result_index',$post_data['stores']);                        
                    }  
                    if($this->getRequest()->getParam("id")){
                        $cache = Mage::app()->getCache(); 
                        $cache->remove("Mobilethemefront".$this->getRequest()->getParam("id"));
                        $cache = Mage::app()->getCache(); 
                        $cache->remove("Mobilethemepreview".$this->getRequest()->getParam("id"));
                        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Theme was updated successfully"));
                    } else {
                        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Theme was successfully saved"));
                    }
                    Mage::getSingleton("adminhtml/session")->setMobilenowData(false);                
                    if ($this->getRequest()->getParam("back"))
                    {   
                        $arg_array["id"] = $model->getId();
                        $this->_redirect("*/*/edit", $arg_array);
                        return;
                    }
                    $this->_redirect("*/*/",$arg_array);
                    return;
                }
                /****************************************Save Theme Sub setting only starts here************************************/
                else
                {
                    //Condition updates the value in each records (Edit subsettings)
                    if($post_data['hidden_selected_val']!='')
                    {         
                                                                              
                        $themeSubSettingsModel->load($post_data['hidden_selected_val']);
                        //Condition to teset primary / Default subsetting
                        if($themeSubSettingsModel->getPrimary()==1 || $themeSubSettingsModel->getDefaultsubsetting()==1)
                        {
                            //If Primary / Default throughs errior messgae
                            Mage::getSingleton("adminhtml/session")->addError('Default / Pre-defined Preset Sub Settings Cannot be edited. Please create a new theme.'); 
                            //$themeSubSettingsModel->setData($saveProcessedData)->setId($post_data['hidden_selected_val']);
                            // Condition to check whether we are from new/edit action
                            if ($this->getRequest()->getParam("back"))
                            {
                                //Set the parameter and redirect
                                $arg_array["id"] = $this->getRequest()->getParam("id");                    
                                $this->_redirect("*/*/edit", $arg_array);
                                return;
                            }
                            $this->_redirect("*/*/",$arg_array);
                            return;
                        }
                        else
                        {
                            $saveProcessedData=Mage::helper("mobilenow")->ProcessThemeDesignFormData($post_data,'',$this->getRequest()->getParam("id")); 
                            //Set The Data to update
                            $getsubsetIdToSet=$themeSubSettingsModel->getcollection()->addFieldToFilter('themeid',$this->getRequest()->getParam("id"))->addFieldToFilter('preview','0')->getFirstItem();                            
                            $saveProcessedData['parent']=$post_data['preset_sub_settings'];
                            $currentSubsetId= $getsubsetIdToSet->getId();
                            $themeSubSettingsModel->setData($saveProcessedData)->setId($currentSubsetId);
                            $arg_array["load_id"] = $post_data['hidden_selected_val'];
                            Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Preset Sub Settings was sucessfully Updated"));
                        }
                    }
                    else
                    {
                        $saveProcessedData=Mage::helper("mobilenow")->ProcessThemeDesignFormData($post_data,$button_type,$this->getRequest()->getParam("id"));                                                       
                        //Set the Data to Insert
                        $themeSubSettingsModel->setData($saveProcessedData);
                        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Preset Sub Settings was successfully saved"));
                    }                    
                    //save Data
                    $themeSubSettingsModel->save();
                    if ($this->getRequest()->getParam("back"))
                    {
                        $arg_array["id"] = $this->getRequest()->getParam("id");
                        if(!$arg_array["load_id"])
                        $arg_array["load_id"] = $themeSubSettingsModel->getId();                    
                        $this->_redirect("*/*/edit", $arg_array);
                        return;
                    }
                    $this->_redirect("*/*/",$arg_array);
                    return;
                }                               
            } 
            catch (Exception $e) {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                Mage::getSingleton("adminhtml/session")->setMobilenowData($this->getRequest()->getPost());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                return;                
            }

        }
        $this->_redirect('*/*/');
    }
    public function deleteAction()
    {
                    if( $this->getRequest()->getParam("id") > 0 ) {
                            try {                                    
                                    $model = Mage::getModel("mobilenow/mobilenow");
                                    $model->setId($this->getRequest()->getParam("id"))->delete();                                    
                                    $subsetModel= Mage::getModel("mobilenow/themesubsettings")->load($this->getRequest()->getParam("id"),'themeid');
                                    $subsetDeleteId=$subsetModel->getId();
                                    $subsetModel->setId($subsetDeleteId)->delete();                                   
                                    Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Theme was successfully deleted"));
                                    $this->_redirect("*/*/");
                            } 
                            catch (Exception $e) {
                                    Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                                    $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
                            }
                    }
                    $this->_redirect("*/*/");
    }
    public function massRemoveAction()
    {
            try {
                    $ids = $this->getRequest()->getPost('theme_ids', array());
                    foreach ($ids as $id) {
          $model = Mage::getModel("mobilenow/mobilenow");
                              $model->setId($id)->delete();
                    }
                    Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
            }
            catch (Exception $e) {
                    Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
            }
            $this->_redirect('*/*/');
    }
    /**
     * Export order grid to CSV format
     */
    public function exportCsvAction()
    {
            $fileName   = 'mobilenow.csv';
            $grid       = $this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_grid');
            $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    } 
    /**
     *  Export order grid to Excel XML format
     */
    public function exportExcelAction()
    {
            $fileName   = 'mobilenow.xml';
            $grid       = $this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_grid');
            $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }                
    /**
     *  Redirected To Mobilenowapp
     */
    public function helpAction()
    {
        $this->_redirectUrl('https://mobilenowapp.com/am/login/index');
    }
    public function statusAction()
    {
        $id=$this->getRequest()->getParam('theme_id');
        $status=$this->getRequest()->getParam('status_id');                    
        try
        {    
            if ($status==0)
            {
                $data=array('status'=>1);  
                $correspondingMsg='Theme has been activated successfully';
            }
            else
            {
                $data=array('status'=>0);                            
                $correspondingMsg='Theme has been deactivated successfully';
            }
            $model = Mage::getModel('mobilenow/mobilenow')->load($id)->addData($data);
            if($model->setId($id)->save())
            {
                 Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__($correspondingMsg));
            }
        }
        catch (Exception $e)
        {
            Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
    public function _loadSubsettings($loadId,$loadReset)
    {    
        $getSubsettings=Mage::getModel("mobilenow/themesubsettings");
        $id=$this->getRequest()->getParam("id");
        $subsetParentId='';
        if($loadId!='')
        {
            $checkLoadIdInParent=$getSubsettings->getcollection()->addFieldToFilter('parent',$loadId)->addFieldToFilter('themeid',$id)->getFirstItem();           
            if($checkLoadIdInParent->getParent())
            {
                $getSubsetDefaultId=$checkLoadIdInParent->getId();
                $subsetParentId=$checkLoadIdInParent->getParent();
            }                
            else
            {
                $getSubsetDefaultId=$loadId;
            }                
        }
        else
        {            
            //Check whether we are in edit/new action
            if($this->getRequest()->getParam("id"))
            {         
                $checkThemeidInSubset=$getSubsettings->load($this->getRequest()->getParam("id"),'themeid');                       
                $subsetParentId=$checkThemeidInSubset->getParent();
            }
            if($subsetParentId!='')
            {                   
                $getSubsetDefaultId=$checkThemeidInSubset->getId();                
            }
            else
            {    
                if($loadReset)
                {
                    $getSubsetDefaultId=$loadReset;
                }
                else
                {
                    $getDefaultIds=$getSubsettings->load(1,'defaultsubsetting');                   
                    $getSubsetDefaultId=$getDefaultIds->getId();
                }
            }             
        }
        $subsettingsModel=$getSubsettings->load($getSubsetDefaultId);
        $setBothFormData=Mage::helper("mobilenow")->setDesignAndLayoutFormData($subsettingsModel,$getSubsetDefaultId,$subsetParentId);        
        return  Mage::register("subsettings_data", $setBothFormData);
    }
    public function deleteSettingsAction()
    {     
        if($this->getRequest()->getParam('delete_id') > 0)
        {
            try 
            {
                $model = Mage::getModel("mobilenow/themesubsettings");
                $getModelData=$model->load($this->getRequest()->getParam("delete_id"));               
                if($getModelData->getPrimary()!=1 && $getModelData->getDefaultsubsetting()!=1)
                {
                    $restrictDelete=$model->load($this->getRequest()->getParam("delete_id"),'parent');
                    if($restrictDelete->getParent())
                    {
                        Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Sub settings is used by Theme, cannot be Deleted"));
                    }
                    else
                    {
                        $model->setId($this->getRequest()->getParam("delete_id"))->delete();
                        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Preset Sub Settings was successfully deleted"));
                    }
                    $this->_mobilenowRedirect();
                }
                else
                {
                    $this->_loadSubsettings($this->getRequest()->getParam("delete_id"));
                    Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Default / Pre-defined Preset Sub Settings Cannot be deleted"));
                    $this->_mobilenowRedirect();
                }
            } 
            catch (Exception $e) 
            {
                Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
                $this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
            }
        }
        // $this->_redirect("*/*/");
    }
    public function _mobilenowRedirect($resetDeleteId)
    {
        //$arg_array = array();
        if($this->getRequest()->getParam("active_tab"))
            $arg_array['active_tab'] = $this->getRequest()->getParam("active_tab");
        if($this->getRequest()->getParam("design_subtab"))
            $arg_array['design_subtab'] = $this->getRequest()->getParam("design_subtab");        
        if($this->getRequest()->getParam("layout_subtab"))
            $arg_array['layout_subtab'] = $this->getRequest()->getParam("layout_subtab");
        if($resetDeleteId)
            $arg_array['reset_delete'] = $resetDeleteId;
        
        if($this->getRequest()->getParam("id")!='')
        {$arg_array['id'] = $this->getRequest()->getParam("id");
            $this->_redirect("*/*/edit", $arg_array);
        }
        else
        {
            $this->_redirect("*/*/new",$arg_array);
        }
    }
    public function checkUniqueNameSaveAction()
    {           
        $checkUniqueName=$this->getRequest()->getParam('subsetname');
        $collectionCheck=Mage::getModel('mobilenow/themesubsettings')->load($checkUniqueName,'subsetname');
        echo $collectionCheck->getId();
    }    
    public function resetSubsettingsAction()
    {          
        $getSubsettings=Mage::getModel("mobilenow/themesubsettings"); 
        if($this->getRequest()->getParam("reset_id"))
        {           
            $resetDeleteId=$this->getRequest()->getParam("reset_delete");
            $resetCheck=$getSubsettings->getcollection()->addFieldToFilter('parent',$resetDeleteId)->addFieldToFilter('themeid',$this->getRequest()->getParam("id"))->getFirstItem();
            if($resetCheck->getParent())
            {
                $resetProceedDelete=$resetCheck->getId();
                $getSubsettings->setId($resetProceedDelete)->delete();
                Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Preset Sub Settings was successfully Reset to Default."));                
            }                       
            else
            {
                Mage::getSingleton("adminhtml/session")->addError(Mage::helper("adminhtml")->__("Preset Sub Settings cannot reset further."));                
            }
            $this->_mobilenowRedirect($this->getRequest()->getParam("reset_delete"));
        }
    }
    
    // function for saving homepage layout xml 
    public function __saveHomePageLayoutXML($theme_id,$home_xml_string,$handle,$stores = array(),$preview = 0){
         //selecting layout update id
        $themeLayoutSettingsCollection = Mage::getModel('mobilenow/themelayoutsettings')->getCollection();
        $themeLayoutSettingsCollection->addFieldToFilter('main_table.theme_id',$theme_id);
        if($preview == 1){
            $themeLayoutSettingsCollection->addFieldToFilter('main_table.preview',$preview);
        }
        $themeLayoutSettingsCollection->addFieldToFilter('layoutupdate.handle',$handle);
        $themeLayoutSettingsCollection->getSelect()->group('main_table.layout_update_id')->join( array('layoutupdate'=>'core_layout_update'), 'main_table.layout_update_id = layoutupdate.layout_update_id',array('layoutupdate.handle'));
        $currentThemeSetings = $themeLayoutSettingsCollection->getData();

        //$collection->getSelect()->join( array('table_alias'=>$this->getTable('module/table_name')), 'main_table.foreign_id = table_alias.primary_key', array('table_alias.*'), 'schema_name_if_different');


//        echo $themeLayoutSettingsCollection->printLogQuery(true);die;
        //echo '<pre>';print_r($currentThemeSetings);echo '</pre>';
//        var_dump($currentThemeSetings[0]['layout_update_id']);die;
        
        
        if($preview == 0){
            $themeLayoutSettingsCollectionDel = Mage::getModel('mobilenow/themelayoutsettings')->getCollection();
            $themeLayoutSettingsCollectionDel->addFieldToFilter('main_table.theme_id',$theme_id);            
            $themeLayoutSettingsCollectionDel->addFieldToFilter('main_table.preview',1);            
            $themeLayoutSettingsCollectionDel->addFieldToFilter('layoutupdate.handle',$handle);
            $themeLayoutSettingsCollectionDel->getSelect()->group('main_table.layout_update_id')->join( array('layoutupdate'=>'core_layout_update'), 'main_table.layout_update_id = layoutupdate.layout_update_id',array('layoutupdate.handle'));
            $currentThemeSetingsDel = $themeLayoutSettingsCollectionDel->getData();
            if(is_array($currentThemeSetingsDel) && count($currentThemeSetingsDel) > 0) {
                $coreLayoutUpdateModelDel = Mage::getModel('mobilenow/corelayoutupdate'); 
               
                foreach($currentThemeSetingsDel as $delThem){ //print_r($delThem['layout_update_id']);die;
                    //$coreLayoutUpdateCollection->addFieldToFilter('layout_update_id',$delThem['layout_update_id']);
                    $coreLayoutUpdateModelDel->load($delThem['layout_update_id'])->delete();
                }
            }
        }
        
        $coreLayoutUpdateModel = Mage::getModel('mobilenow/corelayoutupdate');
        //for updating the existing record
        if(is_array($currentThemeSetings) && count($currentThemeSetings) > 0) {
            if($currentThemeSetings[0]['layout_update_id']){
                $coreLayoutUpdateModel->setLayoutUpdateId($currentThemeSetings[0]['layout_update_id']);   
            }
        }                           
        $coreLayoutUpdateModel->setHandle($handle);
        $coreLayoutUpdateModel->setXml($home_xml_string);
        $coreLayoutUpdateModel->setSortOrder(0);
        $coreLayoutUpdateModel->save();
        //for deleting related records from core_layout_link and themelayoutsettings
        if(is_array($currentThemeSetings) && count($currentThemeSetings) > 0) {
            
            $coreLayoutLinkCollection = Mage::getModel('mobilenow/corelayoutlink')->getCollection(); 
            $ids = array();
            foreach($currentThemeSetings as $currentTh) {
                $ids[] = $currentTh['layout_update_id'];
            }
           // $coreLayoutLinkCollection->addFieldToFilter('layout_update_id', $currentThemeSetings[0]['layout_update_id']);
            $coreLayoutLinkCollection->addFieldToFilter('layout_update_id', array('in' => $ids));
            foreach($coreLayoutLinkCollection as $corelayout){
                $corelayout->delete();
            }
             
        }

        foreach($stores as $store_id){
            $coreLayoutLinkModel = Mage::getModel('mobilenow/corelayoutlink');                
            $coreLayoutLinkModel->setStoreId($store_id);
            $coreLayoutLinkModel->setArea('frontend');
            $coreLayoutLinkModel->setPackage('redstage-mobilenow');
            $coreLayoutLinkModel->setTheme('default');
            $coreLayoutLinkModel->setLayoutUpdateId($coreLayoutUpdateModel->getLayoutUpdateId());
            $coreLayoutLinkModel->save();
            $themeLayoutSettingsModel = Mage::getModel('mobilenow/themelayoutsettings');
            $themeLayoutSettingsModel->setThemeId($theme_id);
            $themeLayoutSettingsModel->setLayoutLinkId($coreLayoutLinkModel->getLayoutLinkId());
            $themeLayoutSettingsModel->setLayoutUpdateId($coreLayoutUpdateModel->getLayoutUpdateId());
            $themeLayoutSettingsModel->setPreview($preview);
            $themeLayoutSettingsModel->save();
        }
    }
    public function mobileConnectAction()
    {
        $email=$this->getRequest()->getParam('email');
        $username=$this->getRequest()->getParam('username');
        $password=$this->getRequest()->getParam('password');
        $this->_thirdPartyAuthenticate($url,$email,$username,$password,'connect');    
    }
    public function disconnectMobilenowAction()
    {
        $subscriptionstatus = json_decode(Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/subscription'));                 
        if($subscriptionstatus->subscritionStatus=='active')
        {
            $subscriptionstatus->subscritionStatus='inactive';
        }        
        $subscriptionstatus=json_encode($subscriptionstatus);
        $mobilenowConfigSave = new Mage_Core_Model_Config();   
        $mobilenowConfigSave ->saveConfig('mobilenowsettings/mobilenowaccount/subscription', $subscriptionstatus, 'default', 0);
        $deactivateAllThemes=Mage::getModel('mobilenow/mobilenow');
        $collectionthemes=$deactivateAllThemes->getCollection()->addFieldToFilter('status',1);
        foreach($collectionthemes as $deactivateAllTheme)
        {
             $changeStatus['status']=0;
             $currThemeId=$deactivateAllTheme->getThemeId();
             $deactivateAllThemes->load($currThemeId)->addData($changeStatus)->setId($currThemeId)->save();             
        }  
        Mage::app()->cleanCache();
        Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Your MobileNow account settings has been disconnected."));                
        $this->_redirect("adminhtml/system_config/edit/section/mobilenowsettings/");        
    }
    public function refreshMobilenowACtion()
    {
        $email=$this->getRequest()->getParam('email');
        $username=Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/username');
        $password=Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/password');
        $this->_thirdPartyAuthenticate($url,$email,$username,$password,'refresh');
    }
    public function _thirdPartyAuthenticate($url,$email,$username,$password,$status)
    {
       // $certUrl=Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_SKIN).'adminhtml/default/default/www.mobilenowapp.com';
        $key='mrrzwfNuE0ACLCDZyOMR';       
        $url = 'https://mobilenowapp.com/am/api/check-access/by-login-pass?_key='.$key.'&login='.$email.'&pass='.$password;
        //open connection
        $ch = curl_init();
        //set the url, number of POST vars, POST data           
        curl_setopt($ch, CURLOPT_URL,$url);              
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
        //  curl_setopt($ch, CURLOPT_USERPWD, 'secure:6f2TGHt4_');
        // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);        
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0); 
        //execute post
        $result = curl_exec($ch);
        $resultDecode=json_decode($result);
        $memberDetails=array();
        $memberDetails['ok']=$resultDecode->ok;
        if($resultDecode->name) $memberDetails['name']=$resultDecode->name;
        if($resultDecode->subscriptions)
        {
           $memberSubscriptions=$resultDecode->subscriptions;
           foreach($memberSubscriptions as $key=>$memberSubscription)
           {
              $subscribe['productId']=$key;
              $subscribe['subscrptionDate']=$memberSubscription;
              /*if($key==2)
              {*/
                $dateExpire=$memberSubscription;
                $today = date("Y-m-d");   
                $days = (strtotime($dateExpire) - strtotime($today)) / (60 * 60 * 24);
                $subscribe['daysRemaining']=$days;
                $resultDecode->daysRemaining=$days;
              //}
              $subscribe['subscritionStatus']='active';
           }
           $memberDetails['subscriptions']=json_encode($subscribe);
        }        
        if($resultDecode->msg) $memberDetails['msg']=$resultDecode->msg;
        if($memberDetails['ok'])
        {
            $mobilenowConfigSave = new Mage_Core_Model_Config();       
            $mobilenowConfigSave->saveConfig('mobilenowsettings/mobilenowaccount/subscription', $memberDetails['subscriptions'], 'default', 0);
            $mobilenowConfigSave->saveConfig('mobilenowsettings/mobilenowaccount/email', $email, 'default', 0);
            $mobilenowConfigSave->saveConfig('mobilenowsettings/mobilenowaccount/username', $username, 'default', 0);
            $mobilenowConfigSave->saveConfig('mobilenowsettings/mobilenowaccount/password', $password, 'default', 0);            
        }
        Mage::app()->cleanCache(); 
       /* if(curl_exec($ch) === false)
        {
            echo 'Curl error: ' . curl_error($ch);
        }
        else
        {
            echo 'Operation completed without any errors';
        }*/
        print_r(json_encode($resultDecode));
        //close connection
        curl_close($ch); 
    }
    
    public function __setCssVariables($post_data){
        $css_var_arr = array();
        $css_var_arr['background_color'] = $post_data['background_color'];
        $css_var_arr['search_cart_area_bg_color'] = $post_data['search_cart_bg_color'];
        $css_var_arr['cart_link_color'] = $post_data['cart_link_color'];
        $css_var_arr['links_color'] = $post_data['links_color'];
        $css_var_arr['text_color'] = $post_data['text_color'];
        $css_var_arr['categories_bg_color'] = $post_data['categories_background_color'];
        $css_var_arr['categories_bg_borderwidth'] = ($post_data['categories_background_color'] != '')?'1':'0';
        $css_var_arr['button_bg_color'] = $post_data['button_background_color'];
        $css_var_arr['button_border_color'] = $post_data['button_border_color'];
        $css_var_arr['button_text_color'] = $post_data['button_text_color'];

        $css_var_arr['breadcrumb_bg_color'] = $post_data['breadcrumbs_bg_color'];
        $css_var_arr['breadcrumb_font_color'] = $post_data['breadcrumbs_font_color'];

        $css_var_arr['toolbar_bg_color'] = $post_data['toolbar_bg_color'];
        $css_var_arr['toolbar_text_color'] = $post_data['toolbar_text_color'];
        $css_var_arr['pagination_panel_bg_color'] = $post_data['pagination_bg_color'];
        $css_var_arr['pagination_button_bg_color'] = $post_data['pagination_button_bg_color'];
        $css_var_arr['pagination_button_text_color'] = $post_data['pagination_button_text_color'];

        $css_var_arr['image_border_color'] = $post_data['image_border_color'];
        $css_var_arr['image_border_width'] = ($post_data['show_image_border'] != '')?(($post_data['catalog_image_width'] != '')?$post_data['catalog_image_width']:'1'):'0';
        $css_var_arr['product_title_color'] = $post_data['product_title_color'];
        $css_var_arr['product_price_color'] = $post_data['product_price_color'];
        $css_var_arr['product_special_price_color'] = $post_data['product_special_price_color'];
        $css_var_arr['review_star_color'] = $post_data['review_star_color'];

        $css_var_arr['add_to_cart_bg_color'] = $post_data['add_to_cart_button_bg_color'];
        $css_var_arr['add_to_cart_button_text_color'] = $post_data['add_to_cart_button_font_color'];
        $css_var_arr['add_to_cart_border_color'] = $post_data['add_to_cart_button_border_color'];
        $css_var_arr['gridlines_color'] = $post_data['gridlines_color'];       
        $css_var_arr['gridlines_color_width'] = ($post_data['gridlines_color'] != '')?'1':'0';
        $css_var_arr['newsletter_bg_color'] = $post_data['newsletter_area_backgorund'];

        $css_var_arr['productpage_title_color'] = $post_data['productpage_title_color'];
        $css_var_arr['product_image_border_color'] = $post_data['product_image_border_color'];
        $css_var_arr['product_image_border_width'] = ($post_data['product_image_border_color'] != '')?'1':'0';
        $css_var_arr['product_description_color'] = $post_data['product_description_color'];
		$css_var_arr['additional_information_bg_color'] = $post_data['additional_information_bg_color'];
		$css_var_arr['additional_information_font_color'] = $post_data['additional_information_font_color'];
		$css_var_arr['full_reviews_bg_color'] = $post_data['full_reviews_bg_color'];
		$css_var_arr['full_reviews_font_color'] = $post_data['full_reviews_font_color'];
	    return $css_var_arr;
    }
    public function updatePreviewAction()
    {   
        if(!Mage::getSingleton('admin/session')->isLoggedIn())
            $this->_redirectUrl(Mage::helper("adminhtml")->getUrl("admin/index/index/"));
        $post_data=$this->getRequest()->getPost();   
        if($post_data['show_learn_more']!=1)$post_data['show_learn_more']=0;
        if(!isset($post_data['stores']) || count($post_data['stores']) == 0){
            $post_data['stores'] = array(0);
        }
        if ($post_data & $post_data['stores'])
        {
            try
            {	
                $themeSubSettingsModel = Mage::getModel('mobilenow/themesubsettings');
                if ($this->getRequest()->getParam("theme_id")){
                    $theme_id = $this->getRequest()->getParam("theme_id");
                    $model = Mage::getModel("mobilenow/mobilenow")->load($theme_id,'theme_id');
                    
                    $createnewThemeFlag='';                    
                    //Save Preset Subsettings with respect to Theme
                    $saveProcessedData=Mage::helper("mobilenow")->ProcessThemeDesignFormData($post_data,'',$model->getId(),$createnewThemeFlag,'1');                        
                    
                    //Check for values whether to save / Update in themesubsettings table
                    $attributes = array('themeid'=> $model->getId(), 'preview'=> 1);
                    $selectCurrentRecord=$themeSubSettingsModel->loadByAttributes($attributes);                               
                    // preset_sub_settings and preset_layout_sub_settings will have the same value
                    $saveProcessedData['parent']=$post_data['preset_sub_settings'];
                    //If Condition will updated the record in themesubsettings table and else will insert a new record                    
                    if($selectCurrentRecord->getId())
                    {                           
                        $ThemesubsetId=$selectCurrentRecord->getId();                    
                        $themeSubSettingsModel->setData($saveProcessedData)->setId($ThemesubsetId)->save();
                    }
                    else                                            
                    {   
                        $saveProcessedData['preview'] = 1;
                        //Insert the same record and assign it to a theme
                        $themeSubSettingsModel->setData($saveProcessedData)->save();                        
                    } 
                    $css_var_arr = $this->__setCssVariables($post_data); 
                    $csspath = Mage::getBaseDir('media').DS.'mobilenow_theme_css'.DS; 
                    $css_file_name = Mage::getBaseDir('media').DS.'mobilenow_theme_css'.DS.md5($model->getId().'_preview').'.css'; 
                    mkdir($csspath);   
                    $css_string = Mage::helper('mobilenow/theme')->generateThemeCssFile($css_var_arr);
                    if (file_exists($css_file_name) ){ 
                        @unlink($css_file_name);
                    }
                    if($post_data['custom_css'] != ''){
                        $css_string .= $post_data['custom_css'];
                    }
                    
                    file_put_contents($css_file_name, $css_string);
                    // generating homepage layout xml
                    
                    
                   // echo $css_string;die;
                   // echo $css_string;die;
                    
                   
                    // generating homepage layout xml
                    $home_xml_string = Mage::helper('mobilenow/homepage')->generateHomePageLayoutXML($post_data);
                    
                    if($home_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$home_xml_string,'cms_index_index',$post_data['stores'],1);                        
                    }   
                    
                    
                    // generating default layout xml
                    $default_xml_string = Mage::helper('mobilenow/homepage')->generateDefaultPageLayoutXML($post_data,md5($model->getId().'_preview'));
                    if($default_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$default_xml_string,'default',$post_data['stores'],1);                        
                    }   
                    
                    // generating catalog layout xml
                    $catalog_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogPageLayoutXML($post_data);
                    //echo $catalog_xml_string;die;
                    if($catalog_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_xml_string,'catalog_category_layered',$post_data['stores'],1);                        
                    }  
                    // generating catalog layout xml
                    $catalog_default_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogPageLayoutXML($post_data);
                    //echo $catalog_xml_string;die;
                    if($catalog_default_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_default_xml_string,'catalog_category_default',$post_data['stores'],1);                        
                    }
                    // generating catalog search page layout xml
                    $catalog_search_xml_string = Mage::helper('mobilenow/catalogpage')->generateCatalogSearchPageLayoutXML($post_data);
                    //echo $catalog_search_xml_string;die;
                    if($catalog_search_xml_string != ''){
                        $this->__saveHomePageLayoutXML($model->getId(),$catalog_search_xml_string,'catalogsearch_result_index',$post_data['stores'],1);                        
                    }  
                    
                    $cache = Mage::app()->getCache(); 
                    $cache->remove("Mobilethemepreview".$theme_id);
                    
                    echo 'success';die;
                    
                }else{
                    echo 'failed';    

                }
                   die;                                
            } 
            catch (Exception $e) {
                echo $e->getMessage();
                
                die;                
            }

        }
    }
    
    public function uploadDesignImageAction(){
        $theme_id = $this->getRequest()->getParam("theme_id");
        $data =  array();
        $data['mesasage'] = 'success';
        $data['preview_name'] = '';
        if ($this->getRequest()->getParam("upload_type") == 'logo'){
            if($_FILES['logo']['name']!=''){ $logo = time().str_replace(' ', '_',$_FILES['logo']['name']);}//else{$themeSubSettings['logo']='';}
            if(trim($logo)!='')
            {
                try{
                    $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'logo'.DS.'preview'.DS.$theme_id; 
                    $uploader = new Varien_File_Uploader('logo');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','png','gif'));
                    $uploader->setAllowCreateFolders(true);
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($path,$logo); 
                    $data['preview_name'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'mobilenow_theme_images'.DS.'logo'.DS.'preview'.DS.$theme_id.DS.$logo;
                } catch (Exception $e) {
                    $data['mesasage'] = $e->getMessage();
                }                
            }
            $data['logo_image_name'] = $logo;
            echo json_encode($data);
            exit;
        } else if($this->getRequest()->getParam("upload_type") == 'banner'){
            if($_FILES['homepage_banner']['name']!=''){ $logo = time().str_replace(' ', '_',$_FILES['homepage_banner']['name']);}//else{$themeSubSettings['logo']='';}
            if(trim($logo)!='')
            {
                try{
                    $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'banner'.DS.'preview'.DS.$theme_id; 
                    $uploader = new Varien_File_Uploader('homepage_banner');
                    $uploader->setAllowedExtensions(array('jpg','jpeg','png','gif'));
                    $uploader->setAllowCreateFolders(true);
                    $uploader->setAllowRenameFiles(false);
                    $uploader->setFilesDispersion(false);
                    $uploader->save($path,$logo);
                    $data['preview_name'] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'mobilenow_theme_images'.DS.'banner'.DS.'preview'.DS.$theme_id.DS.$logo;
                 } catch (Exception $e) {
                    $data['mesasage'] = $e->getMessage();
                } 
            }
            $data['banner_image_name'] = $logo;
            echo json_encode($data);
            exit;
        }
    }
}
