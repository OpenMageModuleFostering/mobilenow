<?php

class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId("mobilenowGrid");
        $this->setDefaultSort("theme_id");
        $this->setDefaultDir("ASC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("mobilenow/mobilenow")->getCollection();                           
        $this->setCollection($collection);        
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {         
        /*$this ->addColumn("theme_id", array(
        "header"=> Mage::helper("mobilenow")->__("ID"),
        "align" =>"right",
        "width" => "50px",
        "type"  => "number",
        "index" => "theme_id",
        ));*/
        $this   ->addColumn('theme_name', array(
        "header"=> Mage::helper("mobilenow")->__("Mobile Theme Name"),
        "index" => 'theme_name',
        'renderer'=> new Redstage_Mobilenow_Block_Adminhtml_Renderer_Themename,
        ));
         if (!Mage::app()->isSingleStoreMode()) {
            $this->addColumn('store_id', array(
                'header'        => Mage::helper('cms')->__('Store View'),
                'index'         => 'store_id',
                'type'          => 'store',
                'store_all'     => true,
                'store_view'    => true,
                'sortable'      => false,
                'filter_condition_callback'
                                => array($this, '_filterStoreCondition'),
            ));
        }
        $this->addColumn('mobile_device_design_interface', array(
        'header' => Mage::helper('mobilenow')->__('Mobile Device & User Agents'),
        'index' => 'mobile_device_design_interface',
        'type' => 'options',
        'options'=>Mage::helper("mobilenow")->getGridOptionArrayMobileDevice(),	
        'renderer'=> new Redstage_Mobilenow_Block_Adminhtml_Renderer_Merge,
        ));
         $this->addColumn('status', array(
        'header' => Mage::helper('mobilenow')->__('Status'),
        'index' => 'status',
        'type' => 'options',
        'options'=>Mage::helper("mobilenow")->getOptionArrayStatus(),				
        ));   
         $this->addColumn('change_status', array(
        'header' => Mage::helper('mobilenow')->__('Change Status'),
        'index' => 'change_status',
        'filter'    => false,
        'sortable'  => false,
        'renderer'=> new Redstage_Mobilenow_Block_Adminhtml_Renderer_Status,
        ));        
        //$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
        //$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }
    //    protected function _prepareMassaction()
    //    {
    //            $this->setMassactionIdField('theme_id');
    //            $this->getMassactionBlock()->setFormFieldName('theme_ids');
    //            $this->getMassactionBlock()->setUseSelectAll(true);
    //            $this->getMassactionBlock()->addItem('remove_mobilenow', array(
    //                             'label'=> Mage::helper('mobilenow')->__('Remove Mobilenow'),
    //                             'url'  => $this->getUrl('*/adminhtml_mobilenow/massRemove'),
    //                             'confirm' => Mage::helper('mobilenow')->__('Are you sure?')
    //                    ));
    //            return $this;
      //  }			    
     protected function _afterLoadCollection()
    {
        $this->getCollection()->walk('afterLoad');
        parent::_afterLoadCollection();
    }

    protected function _filterStoreCondition($collection, $column)
    {        
        if (!$value = $column->getFilter()->getValue()) {
            return;
        }

        $this->getCollection()->addStoreFilter($value);
    }
}