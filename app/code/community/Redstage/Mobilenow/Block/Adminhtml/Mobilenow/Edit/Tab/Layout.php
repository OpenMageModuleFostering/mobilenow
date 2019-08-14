<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Tab_Layout extends Mage_Adminhtml_Block_Widget_Form 
{
    /**
    * Class constructor
    *
    */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/widget/layout.phtml');     
    }
    protected function _prepareForm()
    {  
        $form       = new Varien_Data_Form();
        $this       ->setForm($form);
        
        $fieldset   = $form->addFieldset("preset_layout_subsettings",array('class'=>'preset_subsettings'));
        if($this->getRequest()->getParam('edit'))
            $newRedrict = Mage::helper('adminhtml')->getUrl('*/*/edit',array('id'=>$this->getRequest()->getParam("id")));
        else
             $newRedrict = Mage::helper('adminhtml')->getUrl('*/*/new',array('id'=>$this->getRequest()->getParam("id")));      
        $fieldset->addField('preset_layout_sub_settings', 'select', array(
          'label'     => Mage::helper('mobilenow')->__('Preset Sub Settings'),
          'class'     => 'select_theme_name',
          'required'  => false,
          'name'      => 'preset_layout_sub_settings',
          'onclick' => "",
          'onchange' => 'preloadLayoutSubsettings(\''.$newRedrict.'\')',          
          'values' => Mage::helper('mobilenow')->getSubsettings()
        ));
        $fieldset->addField('custom_layout_buttons', 'text', array(
                'name'=>'custom_layout_buttons',                         
        ));
        $form->getElement('custom_layout_buttons')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_customlayoutbuttons'));  	
        

        /*******************************************General / Home Page**********************************************/
        $fieldset   = $form->addFieldset('general_layout_homepage',array());
        
        $fieldset->addField('homepage_layout_head_message', 'text', array(
                'name'=>'homepage_layout_head_message',                         
        ));
        $form->getElement('homepage_layout_head_message')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_hlayoutmessage'));
        
        $fieldsetHLayout   = $fieldset->addFieldset('general_layout_h_fields',array('class'=>'layout-fields'));
        
        $fieldsetHLayout->addField('h_layout_heading', 'note', array(
            'label'=>'Block Name',
            'text'     => 'Sort Order',
        ));
        $fieldsetHLayout->addField('h_layout_search_cart', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Search/Cart'),
        'name'      => 'h_layout_search_cart',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetHLayout->addField('h_layout_sub_header', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Sub Header'),
        'name'      => 'h_layout_sub_header',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetHLayout->addField('h_layout_banner', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Feature Banner'),
        'name'      => 'h_layout_banner',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetHLayout->addField('h_layout_feature', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Homepage Feature'),
        'name'      => 'h_layout_feature',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetHLayout->addField('h_layout_categories', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Categories'),
        'name'      => 'h_layout_categories',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetHLayout->addField('h_layout_news_signup', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Newsletter Signup'),
        'name'      => 'h_layout_news_signup',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        
        /*******************************************Catalog Page**********************************************/
        $fieldset   = $form->addFieldset('catalog_layout_page',array());
        
        $fieldset->addField('catalog_layout_head_message', 'text', array(
                'name'=>'catalog_layout_head_message',                         
        ));
        $form->getElement('catalog_layout_head_message')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_clayoutmessage'));
        
        $fieldsetCLayout   = $fieldset->addFieldset('general_layout_c_fields',array('class'=>'layout-fields'));
        
        $fieldsetCLayout->addField('c_layout_heading', 'note', array(
            'label'=>'Block Name',
            'text'     => 'Sort Order',
        ));
        $fieldsetCLayout->addField('c_layout_breadcrumbs', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Breadcrumbs'),
        'name'      => 'c_layout_breadcrumbs',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetCLayout->addField('c_layout_toolbar', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Toolbar'),
        'name'      => 'c_layout_toolbar',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetCLayout->addField('c_layout_pag_top', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Pagination (top)'),
        'name'      => 'c_layout_pag_top',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        
        //for grid
//        $fieldsetCLayout   = $fieldset->addFieldset('general_layout_c_fields_grid',array('class'=>'layout-fields layout-grid-listheading'));
//        
//        $fieldsetCLayout->addField('c_grid_layout_heading', 'note', array(
//            'text'=>'Product Grid View - <a class="headlink" href="">view in preview</a>'
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_image', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Image'),
//        'name'      => 'c_grid_layout_product_image',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_title', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Title'),
//        'name'      => 'c_grid_layout_product_title',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_price', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Price'),
//        'name'      => 'c_grid_layout_product_price',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_review', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Review Summary'),
//        'name'      => 'c_grid_layout_product_review',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_learn', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Learn More'),
//        'name'      => 'c_grid_layout_product_learn',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_grid_layout_product_addtocart', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Add to Cart'),
//        'name'      => 'c_grid_layout_product_addtocart',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
        
        
        //for list
        $fieldsetCLayout   = $fieldset->addFieldset('general_layout_c_fields_list',array('class'=>'layout-fields layout-grid-listheading'));
        
        $fieldsetCLayout->addField('c_list_layout_heading', 'note', array(
            'text'=>'Product List View - <a class="headlink" href="">view in preview</a>'
        ));
//        $fieldsetCLayout->addField('c_list_layout_product_image', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Image'),
//        'name'      => 'c_list_layout_product_image',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
//        $fieldsetCLayout->addField('c_list_layout_product_title', 'text', array(
//        'label'     => Mage::helper('mobilenow')->__('Product - Title'),
//        'name'      => 'c_list_layout_product_title',
//        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
//        'required'  => false
//        ));
        $fieldsetCLayout->addField('c_list_layout_product_price', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product - Price'),
        'name'      => 'c_list_layout_product_price',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetCLayout->addField('c_list_layout_product_review', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product - Review Summary'),
        'name'      => 'c_list_layout_product_review',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetCLayout->addField('c_list_layout_product_learn', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product - Learn More'),
        'name'      => 'c_list_layout_product_learn',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetCLayout->addField('c_list_layout_product_addtocart', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product - Add to Cart'),
        'name'      => 'c_list_layout_product_addtocart',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        
        
        
        /*******************************************Product Page**********************************************/
        $fieldset   = $form->addFieldset('produt_layout_page',array());
        
        $fieldset->addField('product_layout_head_message', 'text', array(
                'name'=>'product_layout_head_message',                         
        ));
        $form->getElement('product_layout_head_message')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_playoutmessage'));
        //Product page Top section
        $fieldsetPTLayout   = $fieldset->addFieldset('general_layout_pt_fields',array('class'=>'layout-fields'));
        
        $fieldsetPTLayout->addField('pt_layout_heading', 'note', array(
            'label'=>'Block Name',
            'text'     => 'Sort Order',
        ));
        $fieldsetPTLayout->addField('p_layout_availability', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Availability'),
        'name'      => 'p_layout_availability',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPTLayout->addField('p_layout_pricing', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Pricing'),
        'name'      => 'p_layout_pricing',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPTLayout->addField('p_layout_addtocart', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Customize / Add to Cart'),
        'name'      => 'p_layout_addtocart',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPTLayout->addField('p_layout_wishlist', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Wishlist Link'),
        'name'      => 'p_layout_wishlist',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPTLayout->addField('p_layout_review', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Review Summary'),
        'name'      => 'p_layout_review',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        // Product page Bottom section
        $fieldsetPBLayout   = $fieldset->addFieldset('general_layout_pb_fields',array('class'=>'layout-fields'));
        
        $fieldsetPBLayout->addField('pb_layout_heading', 'note', array(
            'label'=>'Block Name',
            'text'     => 'Sort Order',
        ));
        $fieldsetPBLayout->addField('p_layout_desc', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Description'),
        'name'      => 'p_layout_desc',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPBLayout->addField('p_layout_additionalinfo', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Additional Information'),
        'name'      => 'p_layout_additionalinfo',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPBLayout->addField('p_layout_fullreview', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Full Reviews'),
        'name'      => 'p_layout_fullreview',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        $fieldsetPBLayout->addField('p_layout_relatedproduct', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Related Products'),
        'name'      => 'p_layout_relatedproduct',
        'class'     => 'sort_order validate-digits validate-greater-than-zero',     
        'required'  => false
        ));
        
        
        if (Mage::getSingleton("adminhtml/session")->getSubsettingsData())
        {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getSubsettingsData());
            Mage::getSingleton("adminhtml/session")->setSubsettingsData(null);
        } 
        elseif(Mage::registry("subsettings_data"))
        {           
            $form->setValues(Mage::registry("subsettings_data")->getData());
        }
        return parent::_prepareForm();
    }
}