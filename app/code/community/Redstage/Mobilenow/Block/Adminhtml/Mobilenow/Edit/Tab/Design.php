<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Tab_Design extends Mage_Adminhtml_Block_Widget_Form 
{
    /**
    * Class constructor
    *
    */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('mobilenow/widget/design.phtml');     
    }
    protected function _prepareForm()
    {    
        if(Mage::registry("subsettings_data"))
        {           
            if(Mage::registry("subsettings_data")->getShowSearchCartArea()==1)$checked=true;
            if(Mage::registry("subsettings_data")->getShowHomePageBanner()==1)$bannerChecked=true;
            if(Mage::registry("subsettings_data")->getShowNewsletter()==1)$newsletterChecked=true;
            if(Mage::registry("subsettings_data")->getShowBreadcrumbs()==1)$breadChecked=true;   
            if(Mage::registry("subsettings_data")->getShowGridListChoice()==1)$gridChecked=true;
            if(Mage::registry("subsettings_data")->getShowSortbyDropdown()==1)$sortChecked=true;   
            if(Mage::registry("subsettings_data")->getShowImageBorder()==1)$ImBorderChecked=true;
            if(Mage::registry("subsettings_data")->getShowReviewStars()==1)$reviewsChecked=true;
            if(Mage::registry("subsettings_data")->getShowLearnMore()==1)$cataloglearnChecked=true;
            if(Mage::registry("subsettings_data")->getShowAddToCart()==1)$addtocartChecked=true;
            if(Mage::registry("subsettings_data")->getShowGridlines()==1)$gridlinesChecked=true;
            if(Mage::registry("subsettings_data")->getShowProductImageBorder()==1)$prImBorderChecked=true;
            if(Mage::registry("subsettings_data")->getShowProductAvailability()==1)$shAvlChecked=true;
            if(Mage::registry("subsettings_data")->getShowProductWishlistLink()==1)$shprdwishChecked=true;
            if(Mage::registry("subsettings_data")->getShowProductReviewsSummary()==1)$shprdrevChecked=true;
            if(Mage::registry("subsettings_data")->getShowProductDescription()==1)$shprddesChecked =true;
            if(Mage::registry("subsettings_data")->getShowProductAdditionalInformation()==1)$shadditionalChecked=true;
            if(Mage::registry("subsettings_data")->getShowFullReviewsOnProductPage()==1)$shflreChecked=true;
            if(Mage::registry("subsettings_data")->getShowRelatedProducts()==1)$shrlChecked=true;          
        }
        $form       = new Varien_Data_Form();
        $this       ->setForm($form);        
        $fieldset   = $form->addFieldset("preset_subsettings",array('class'=>'preset_subsettings'));
        if($this->getRequest()->getParam('id'))
            $newRedrict = Mage::helper('adminhtml')->getUrl('*/*/edit',array('id'=>$this->getRequest()->getParam("id")));
        else
            $newRedrict = Mage::helper('adminhtml')->getUrl('*/*/new',array('id'=>$this->getRequest()->getParam("id")));      

        $fieldset->addField('preset_sub_settings', 'select', array(
          'label'     => Mage::helper('mobilenow')->__('Preset Sub Settings'),
          'class'     => 'select_theme_name',
          'required'  => false,
          'name'      => 'preset_sub_settings',
          'onclick' => "",
          'onchange' => 'preloadSubsettings(\''.$newRedrict.'\')',          
          'values' => Mage::helper('mobilenow')->getSubsettings()         
        ));
        $fieldset->addField('custom_design_buttons', 'text', array(
                'name'=>'custom_design_buttons',                         
        ));
        $form->getElement('custom_design_buttons')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_custombuttons'));       
        /*******************************************General / Home Page**********************************************/
        $fieldset   = $form->addFieldset('general_homepage',array());		
        $fieldset  ->addField('base_mobile_theme', 'select', array(
        'label'     => Mage::helper('mobilenow')->__('Base Mobile Theme'),
        'values'    =>  array('1'=>'Blank / Text'),
        'name'      => 'base_mobile_theme',					
        'class'     => '',            
        'required'  => false        
        ));
        $fieldset->addField('logo_fielname', 'hidden', array(
        'label' => '',
        'name' => 'logo_fielname',
        ));
        $fieldset->addField('logo_preview_filename', 'hidden', array(
        'label' => '',
        'name' => 'logo_preview_filename',
        ));
        $fieldset->addField('logo_image_display', 'text', array(
                'name'=>'logo_image_display',                         
        ));
        $form->getElement('logo_image_display')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_logoimagedisplay'));
        $fieldset->addField('logo', 'file', array(
        'label'     => Mage::helper('mobilenow')->__('Logo'),
        'value'     => 'Uplaod',
        'name'      => 'logo'
        ));
        $fieldset->addField('background_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Background Color'),
        'name'      => 'background_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));        
        $fieldset->addField('custom_design_link', 'text', array(
                'name'=>'custom_design_link',                         
        ));
        $form->getElement('custom_design_link')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_customlink'));
        $fieldset->addField('links_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Links Color'),
        'name'      => 'links_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('text_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Text Color'),
        'name'      => 'text_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_search_cart_area', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Search / Cart Area'),
        'name'      => 'show_search_cart_area',
        'class'     => '',       
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $checked,
        ));
        $fieldset->addField('search_cart_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Search / Cart Area Backgorund Color'),
        'name'      => 'search_cart_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('cart_link_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Cart Link Color'),
        'name'      => 'cart_link_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_home_page_banner', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Homepage Banner'),
        'name'      => 'show_home_page_banner',
        'class'     => '',        
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $bannerChecked,
        ));
        $fieldset->addField('banner_image_display', 'text', array(
                'name'=>'banner_image_display',                         
        ));
        $form->getElement('banner_image_display')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_bannerimagedisplay'));
        $fieldset->addField('banner_fielname', 'hidden', array(
        'label' => '',
        'name' => 'banner_fielname',
        ));
        $fieldset->addField('banner_preview_filename', 'hidden', array(
        'label' => '',
        'name' => 'banner_preview_filename',
        ));
        $fieldset->addField('homepage_banner', 'file', array(
        'label'     => Mage::helper('mobilenow')->__('Homepage Banner'),
        'value'     => 'Uplaod',
        'name'      => 'homepage_banner'
        ));
        $fieldset->addField('homepage_banner_url', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Homepage Banner URL'),
        'name'      => 'homepage_banner_url',
        'class'     => '',     
        'required'  => false
        ));
        $fieldset->addField('subheader_section', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('SubHeader Section [HTML] (empty = Off)'),
        'name'      => 'subheader_section',
        'class'     => '',     
        'required'  => false
        ));
        
        $fieldset->addField('categories1', 'radios', array(
          'label'     => Mage::helper('mobilenow')->__('Categories'),
          'name'      => 'categories',
          'value'  => '1',
            'values' => array(
                            array('value'=>'1')
                       ),
          'after_element_html' => '<label class="radio_label" for="categories1">Mobile Menu</label>'
        ));
        $fieldset->addField('categories2', 'radios', array(
          'label'     =>'',
          'name'      => 'categories',
          'value'  => '2',
            'values' => array(
                            array('value'=>'2')
                       ),
          'after_element_html' => '<label class="radio_label " for="categories2">Show All</label>'
        ));
//        $fieldset->addField('categories', 'radios', array(
//          'label'     => Mage::helper('mobilenow')->__('Categories'),
//          'name'      => 'categories',
//          'onclick' => "",
//          'onchange' => "",
//          'value'  => '1',
//          'values' => array(
//                            array('value'=>'1','label'=>'Mobile Menu'),
//                            array('value'=>'2','label'=>'Show All'),                            
//                       )         
//        ));
         $fieldset->addField('categories_background_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Categories Background Color'),
        'name'      => 'categories_background_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_newsletter', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Newsletter'),
        'name'      => 'show_newsletter',
        'class'     => '',       
        'required'  => false,
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'checked' => $newsletterChecked,
        ));
        $fieldset->addField('newsletter_area_backgorund', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Newsletter Area Background'),
        'name'      => 'newsletter_area_backgorund',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('homepage_custom_code', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('Homepage Custom Code [HTML] (empty = Off)'),
        'name'      => 'homepage_custom_code',
        'class'     => '',     
        'required'  => false
        ));
        $fieldset->addField('pre_footer_section', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('Pre-Footer Section [HTML] (empty = Off)'),
        'name'      => 'pre_footer_section',
        'class'     => '',     
        'required'  => false
        ));
         $fieldset->addField('footer_section', 'textarea', array(
        'label'     => Mage::helper('mobilenow')->__('Footer Section [HTML] (empty = Off)'),
        'name'      => 'footer_section',
        'class'     => '',     
        'required'  => false
        ));
//        $fieldset->addField('show_desktop_version_link', 'checkbox', array(
//        'label'     => Mage::helper('mobilenow')->__('Show Desktop Version Link?'),
//        'name'      => 'show_desktop_version_link',
//        'class'     => '',     
//        'required'  => false
//        ));
        $fieldset->addField('custom_design_title', 'text', array(
                'name'=>'custom_design_title',                         
        ));
        $form->getElement('custom_design_title')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_customtext'));
        $fieldset->addField('button_background_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Button Background Color'),
        'name'      => 'button_background_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('button_text_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Button Text Color'),
        'name'      => 'button_text_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('button_border_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Button Border Color'),
        'name'      => 'button_border_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        /*******************************************Catalog Page**********************************************/
        $fieldset   = $form->addFieldset('catalog_page',array());
        $fieldset->addField('show_breadcrumbs', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Breadcrumbs'),
        'name'      => 'show_breadcrumbs',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
         'checked'  => $breadChecked
        ));
        $fieldset->addField('breadcrumbs_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Breadcrumbs Background Color'),
        'name'      => 'breadcrumbs_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('breadcrumbs_font_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Breadcrumbs Font Color'),
        'name'      => 'breadcrumbs_font_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
       /* $fieldset->addField('default_catalog_view', 'radios', array(
          'label'     => Mage::helper('mobilenow')->__('Default Catalog View'),
          'name'      => 'default_catalog_view',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => array(
                            array('value'=>'1','label'=>' Grid'),
                            array('value'=>'2','label'=>' List'),                            
                       )         
        ));
        $fieldset->addField('show_grid_list_choice', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Grid / List Choice'),
        'name'      => 'show_grid_list_choice',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'  => $gridChecked
        ));     */   
        $fieldset->addField('number_of_products_choice_steps', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Number of Products Choice Steps (Comma delimited, ALL = Show All)'),
        'name'      => 'number_of_products_choice_steps',
        'class'     => 'validate-per-page-value-list input-color',     
        'required'  => false
        ));
        $fieldset->addField('number_of_products_per_page', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Number of Products Per Page (default) ALL = Show All'),
        'name'      => 'number_of_products_per_page',
        'class'     => 'validate-per-page-value input-color',     
        'required'  => false
        ));
        $fieldset->addField('show_sortby_dropdown', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Sort By Dropdown'),
        'name'      => 'show_sortby_dropdown',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$sortChecked
        ));
        $fieldset->addField('sort_options', 'checkboxes', array(
          'label'     => Mage::helper('mobilenow')->__('Sort Options'),
          'name'      => 'sort_options[]',
          'values' => array(
                            array('value'=>'1','label'=>'Position'),
                            array('value'=>'2','label'=>'Price High -> Low'),
                            array('value'=>'3','label'=>'Price Low -> High'),
                            array('value'=>'4','label'=>'Name A -> Z'),
                            array('value'=>'5','label'=>'Name Z -> A'),
                       ),
          'onclick' => "",
          'onchange' => "",          
          'value'  => array('1', '5'),          
        ));
        $fieldset->addField('toolbar_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Toolbar Background Color'),
        'name'      => 'toolbar_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('toolbar_text_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Toolbar Text Color'),
        'name'      => 'toolbar_text_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_pagination', 'radios', array(
          'label'     => Mage::helper('mobilenow')->__('Show Pagination'),
          'name'      => 'show_pagination',
          'onclick' => "",
          'onchange' => "",
          'value'  => '1',
          'values' => array(
                            array('value'=>'1','label'=>' Top'),
                            array('value'=>'2','label'=>' Bottom'),
                            array('value'=>'3','label'=>' Both'),
                       )         
        ));        
        $fieldset->addField('pagination_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Pagination Background Color'),
        'name'      => 'pagination_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('pagination_button_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Pagination Buttons Background Color'),
        'name'      => 'pagination_button_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('pagination_button_text_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Pagination Button Text Color'),
        'name'      => 'pagination_button_text_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
         $fieldset->addField('custom_design_catalog', 'text', array(
                'name'=>'custom_design_catalog',                         
        ));
        $form->getElement('custom_design_catalog')->setRenderer($this->getLayout()->createBlock('mobilenow/adminhtml_mobilenow_edit_renderer_customcatalog'));
        $fieldset->addField('show_image_border', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Image Border'),
        'name'      => 'show_image_border',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$ImBorderChecked
        ));
        $fieldset->addField('image_border_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Image Border Color'),
        'name'      => 'image_border_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('catalog_image_width', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Image Border Width (px)'),
        'name'      => 'catalog_image_width',
        'class'     => '',        
        'required'  => false,
            "note"  => "Please enter a value less than 5"
        ));
        $fieldset->addField('product_title_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product Title Color'),
        'name'      => 'product_title_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('product_price_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product Price Color'),
        'name'      => 'product_price_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));        
        $fieldset->addField('product_special_price_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product Special Price Color'),
        'name'      => 'product_special_price_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_review_stars', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Review stars'),
        'name'      => 'show_review_stars',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$reviewsChecked
        ));
        $fieldset->addField('review_star_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Review Stars Color'),
        'name'      => 'review_star_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_learn_more', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show "Learn More" Link'),
        'name'      => 'show_learn_more',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$cataloglearnChecked
        ));
        $fieldset->addField('show_add_to_cart', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Add To Cart Button'),
        'name'      => 'show_add_to_cart',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$addtocartChecked
        ));
        $fieldset->addField('add_to_cart_button_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Add To Cart Button Background Color'),
        'name'      => 'add_to_cart_button_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('add_to_cart_button_font_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Add To Cart Button Font Color'),
        'name'      => 'add_to_cart_button_font_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('add_to_cart_button_border_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Add To Cart Button Border Color'),
        'name'      => 'add_to_cart_button_border_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_gridlines', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Gridlines'),
        'name'      => 'show_gridlines',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$gridlinesChecked
        ));
        $fieldset->addField('gridlines_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Gridlines Color'),
        'name'      => 'gridlines_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        /*******************************************Product Page**********************************************/
        $fieldset   = $form->addFieldset('produt_page', array());
        $fieldset->addField('productpage_title_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product Title Color'),
        'name'      => 'productpage_title_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_product_image_border', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Image Border'),
        'name'      => 'show_product_image_border',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$prImBorderChecked
        ));
        $fieldset->addField('product_image_border_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Image Border Color'),
        'name'      => 'product_image_border_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('product_image_width', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Image Width (px)'),
        'name'      => 'product_image_width',
        'class'     => '',        
        'required'  => false
        ));
        $fieldset->addField('show_product_availability', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Availability'),
        'name'      => 'show_product_availability',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shAvlChecked
        ));
        $fieldset->addField('show_product_wishlist_link', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Wishlist Link'),
        'name'      => 'show_product_wishlist_link',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shprdwishChecked
        ));
        $fieldset->addField('show_product_reviews_summary', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Reviews Summary'),
        'name'      => 'show_product_reviews_summary',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shprdrevChecked
        ));
        $fieldset->addField('show_product_description', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Description'),
        'name'      => 'show_product_description',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shprddesChecked          
        ));
        $fieldset->addField('product_description_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Product description Color'),
        'name'      => 'product_description_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_product_additional_information', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Additional Information'),
        'name'      => 'show_product_additional_information',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shadditionalChecked
        ));
        $fieldset->addField('additional_information_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Additional information background Color'),
        'name'      => 'additional_information_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('additional_information_font_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Additional information font Color'),
        'name'      => 'additional_information_font_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_full_reviews_on_product_page', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Full Reviews on Product Page'),
        'name'      => 'show_full_reviews_on_product_page',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shflreChecked
        ));
         $fieldset->addField('full_reviews_bg_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Reviews background Color'),
        'name'      => 'full_reviews_bg_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('full_reviews_font_color', 'text', array(
        'label'     => Mage::helper('mobilenow')->__('Reviews font Color'),
        'name'      => 'full_reviews_font_color',
        'class'     => 'minicolors input-color',
        'value'     => '#aaaaaa',
        'required'  => false
        ));
        $fieldset->addField('show_related_products', 'checkbox', array(
        'label'     => Mage::helper('mobilenow')->__('Show Related Products'),
        'name'      => 'show_related_products',
        'class'     => '',
        'onclick'    => 'this.value = this.checked ? 1 : 0;',
        'required'  => false,
        'checked'=>$shrlChecked
        ));        
        $fieldset->addField('hidden_selected_val', 'hidden', array(
        'label'     => Mage::helper('mobilenow')->__(''),
        'name'      => 'hidden_selected_val',
        'class'     => '',      
        'required'  => false         
        ));
        $fieldset->addField('hidden_action_val', 'hidden', array(
        'label'     => Mage::helper('mobilenow')->__(''),
        'name'      => 'hidden_action_val',
        'class'     => '',      
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
