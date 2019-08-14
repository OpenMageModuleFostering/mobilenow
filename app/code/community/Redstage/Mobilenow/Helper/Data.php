<?php
class Redstage_Mobilenow_Helper_Data extends Mage_Core_Helper_Abstract
{
    static public function getOptionArrayMobileDevice()
    {
        $data_array=array(); 
        $data_array['']='Please select Device Type';
        $data_array[1]='iPhone';        
        return($data_array);
    }
    static public function getGridOptionArrayMobileDevice()
    {
        $data_array=array();         
        $data_array[1]='iPhone';        
        return($data_array);
    }
    static public function getValueArrayMobileDevice()
    {
        $data_array=array();
          foreach(Redstage_Mobilenow_Helper_Data::getOptionArrayMobileDevice() as $k=>$v)
          {
                $data_array[]=array('value'=>$k,'label'=>$v);		
           }
        return($data_array);
    }		
     static public function getOptionArrayUserAgent()
    {
        $data_array=array(); 
        $data_array[0]='ALL';
        $data_array[1]='iPhone';
        $data_array[2]='iPod';
        $data_array[3]='BlackBerry';
        $data_array[4]='Palm';
        $data_array[5]='Googlebot-Mobile';
        $data_array[6]='mobi';
        $data_array[7]='Safari Mobile';
        $data_array[8]='Windows Mobile';
        $data_array[9]='Android';
        $data_array[10]='Mini';
        $data_array[11]='mobile';
        $data_array[12]='Nokia';
        $data_array[13]='SymbianOS';
        $data_array[14]='iPad';
        $data_array[15]='Silk';
        $data_array[16]='Kindle';
        $data_array[17]='Xoom';
        $data_array[18]='SCH-I800';
        $data_array[19]='Tablet';
        return($data_array);
    }
    static public function getValueArrayUserAgent()
    {
        $data_array=array();
        foreach(Redstage_Mobilenow_Helper_Data::getOptionArrayUserAgent() as $k=>$v)
        {
            $data_array[]=array('value'=>$k,'label'=>$v);		
        }
        return($data_array);
    }
    static public function getOptionArrayStatus()
    {
        $data_array=array(); 
        $data_array[1]='Active'; 
        $data_array[0]='Inactive';              
        return($data_array);
    }
    static public function getValueArrayStatus()
    {
        $data_array=array();
        foreach(Redstage_Mobilenow_Helper_Data::getOptionArrayStatus() as $k=>$v)
        {
            $data_array[]=array('value'=>$k,'label'=>$v);		
        }
        return($data_array);
    }
    public function getSubsettings()
    {
        $getAllSubSettings=Mage::getModel("mobilenow/themesubsettings")->getCollection();
        foreach($getAllSubSettings as $getAllSubSetting)
        {       
            if($getAllSubSetting->getSubsetname()!='')
            $data_array[$getAllSubSetting->getID()]=$getAllSubSetting->getSubsetname();
        }
         return($data_array);
    }
    public function processThemeDesignFormData($post_data,$button_type = '',$lastRecordId,$createnewThemeFlag,$preview = '0')
    {        
        if($preview == '1'){
             $themeSubSettings['css_filename'] = md5($lastRecordId.'_preview').'.css';
        }else {
            $themeSubSettings['css_filename'] = md5($lastRecordId).'.css';
        }
        //echo '<pre>'; print_r($post_data); echo '</pre>';
        if($lastRecordId)
        {          
            if('saveas_subset' != $button_type){
                if($createnewThemeFlag)
               {
                    $themeSubSettings['themeid']='';
                    $themeSubSettings['subsetname']=$post_data['hidden_theme_sub_setting_name']; 
                }
                else
                {
                    $themeSubSettings['themeid']=$lastRecordId;
                    $themeSubSettings['subsetname']='';            
                }
            }else{
                $themeSubSettings['subsetname']=$post_data['hidden_theme_sub_setting_name'];
                $themeSubSettings['themeid']='';
            }
        }
        else 
        {
            $themeSubSettings['subsetname']=$post_data['hidden_theme_sub_setting_name'];
            $themeSubSettings['themeid']='';
        }
        if($preview == '0'){
            //Logo
//            if($_FILES['logo']['name']!=''){ $themeSubSettings['logo']=time().$_FILES['logo']['name'];}//else{$themeSubSettings['logo']='';}
//            if(trim($themeSubSettings['logo'])!='')
//            {
//                $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'logo'.DS; 
//                $uploader = new Varien_File_Uploader('logo');
//                $uploader->setAllowedExtensions(array('jpg','jpeg','png','gif'));
//                $uploader->setAllowCreateFolders(true);
//                $uploader->setAllowRenameFiles(false);
//                $uploader->setFilesDispersion(false);
//                $uploader->save($path,$themeSubSettings['logo']);
//                if($post_data['logo_fielname'] != ''){
//                    @unlink($path.$post_data['logo_fielname']);
//                }
//            }
            //var_dump($post_data['logo_preview_filename']);die;
            if($post_data['logo_preview_filename'] != ''){
                $themeSubSettings['logo'] = $post_data['logo_preview_filename'];
                if($lastRecordId){
                    $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'logo'; 
                    $newfile = $path.DS.$post_data['logo_preview_filename'];
                    $file = $path.DS.'preview'.DS.$lastRecordId.DS.$post_data['logo_preview_filename'];
                    //var_dump($post_data['logo_fielname']);var_dump($newfile);die;
                    if (copy($file, $newfile)) {
                        if($post_data['logo_fielname'] != ''){
                            //@unlink($path.DS.$post_data['logo_fielname']);
                        }
                        //rmdir($path.DS.'preview'.DS.$lastRecordId);die;
                        $new_path = $path.DS.'preview'.DS.$lastRecordId;
                        //$this->remove_dir($new_path);
                    }
                }
            } else if($post_data['logo_fielname'] != ''){
                $themeSubSettings['logo'] = $post_data['logo_fielname'];
            }
        } else {
            if($post_data['logo_preview_filename'] != ''){
                 $themeSubSettings['logo'] ='preview'.DS.$lastRecordId.DS.$post_data['logo_preview_filename'];
            } else if($post_data['logo_fielname'] != ''){
                $themeSubSettings['logo'] = $post_data['logo_fielname'];
            }
        }
        //Body background color
        $themeSubSettings['bgcolor']=$post_data['background_color'];
        //Links                                                                                
        $homeSearchCartArr=array('header_link_home'=>$post_data['header_link_home'], 'header_link_home_name'=>$post_data['header_link_home_name'],
                                'footer_link_home'=>$post_data['footer_link_home'], 'footer_link_home_name'=>$post_data['footer_link_home_name'],
                                'header_link_login'=>$post_data['header_link_login'], 'header_link_login_name'=>$post_data['header_link_login_name'],
                                'footer_link_login'=>$post_data['footer_link_login'], 'footer_link_login_name'=>$post_data['footer_link_login_name'],
                                'header_link_myaccount'=>$post_data['header_link_myaccount'], 'header_link_myaccount_name'=>$post_data['header_link_myaccount_name'],
                                'footer_link_myaccount'=>$post_data['footer_link_myaccount'], 'footer_link_myaccount_name'=>$post_data['footer_link_myaccount_name'],
                                'header_link_wishlist'=>$post_data['header_link_wishlist'], 'header_link_wishlist_name'=>$post_data['header_link_wishlist_name'],
                                'footer_link_wishlist'=>$post_data['footer_link_wishlist'], 'footer_link_wishlist_name'=>$post_data['footer_link_wishlist_name'],
                                'links_color'=>$post_data['links_color']);
        $themeSubSettings['links']=  json_encode($homeSearchCartArr);
        //Text Color
        $themeSubSettings['textcolor']=  $post_data['text_color'];
        //Search / Cart Area                                    
        $themeSubSettings['searchcart']=  json_encode(array('show_search_cart_area'=>$post_data['show_search_cart_area'],'search_cart_bg_color'=>$post_data['search_cart_bg_color'],'cart_link_color'=>$post_data['cart_link_color']));
        //Homepage Banner     
        if($preview == '0'){
//            if($_FILES['homepage_banner']['name']!=''){ $homePageBannerImage=time().$_FILES['homepage_banner']['name'];}else{$homePageBannerImage='';}
//            $homePageBannerarr=array('show_home_page_banner'=>$post_data['show_home_page_banner'],
//                                     'homepage_banner'=>$homePageBannerImage,
//                                     'homepage_banner_url'=>$post_data['homepage_banner_url']);
//            if(trim($homePageBannerImage)!=''){
//                $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'banner'.DS; 
//                $uploader = new Varien_File_Uploader('homepage_banner');
//                $uploader->setAllowedExtensions(array('jpg','jpeg','png','gif'));
//                $uploader->setAllowCreateFolders(true);
//                $uploader->setAllowRenameFiles(false);
//                $uploader->setFilesDispersion(false);
//                $uploader->save($path,$homePageBannerImage);
//                if($post_data['banner_fielname'] != ''){
//                    @unlink($path.$post_data['banner_fielname']);
//                }
//            }else{
//                if($post_data['banner_fielname'] != ''){
//                    $homePageBannerarr['homepage_banner'] = $post_data['banner_fielname'];
//                } 
//            }
            
            $homePageBannerImage = '';
            if($post_data['banner_preview_filename'] != ''){
                $homePageBannerImage = $post_data['banner_preview_filename'];
                if($lastRecordId){
                    $path = Mage::getBaseDir('media').DS.'mobilenow_theme_images'.DS.'banner'; 
                    $newfile = $path.DS.$post_data['banner_preview_filename'];
                    $file = $path.DS.'preview'.DS.$lastRecordId.DS.$post_data['banner_preview_filename'];
                    //var_dump($post_data['logo_fielname']);var_dump($newfile);die;
                    if (copy($file, $newfile)) {
                        if($post_data['banner_fielname'] != ''){
                            //@unlink($path.DS.$post_data['banner_fielname']);
                        }
                        //rmdir($path.DS.'preview'.DS.$lastRecordId);die;
                        $new_path = $path.DS.'preview'.DS.$lastRecordId;
                        //$this->remove_dir($new_path);
                    }
                }
            } else {
                $homePageBannerImage = $post_data['banner_fielname'];
            }
            $homePageBannerarr=array('show_home_page_banner'=>$post_data['show_home_page_banner'],
                                     'homepage_banner'=>$homePageBannerImage,
                                     'homepage_banner_url'=>$post_data['homepage_banner_url']);
        } else{
            $homePageBannerImage = '';
            if($post_data['banner_preview_filename'] != ''){
                $homePageBannerImage = 'preview'.DS.$lastRecordId.DS.$post_data['banner_preview_filename'];
            } else {
                $homePageBannerImage = $post_data['banner_fielname'];
            }
            $homePageBannerarr=array('show_home_page_banner'=>$post_data['show_home_page_banner'],
                                     'homepage_banner'=>$homePageBannerImage,
                                     'homepage_banner_url'=>$post_data['homepage_banner_url']);
        }
                
        $themeSubSettings['homepagebanner']=json_encode($homePageBannerarr);
        //SubHeader Section
        $themeSubSettings['subheadersection']=$post_data['subheader_section'];
        //Categories
        $themeSubSettings['categories']=json_encode(array('categories'=>$post_data['categories'],'categories_background_color'=>$post_data['categories_background_color']));
        //Newsletter                                    
        $themeSubSettings['newsletter']=  json_encode(array('show_newsletter'=>$post_data['show_newsletter'],'newsletter_area_backgorund'=>$post_data['newsletter_area_backgorund']));
        //Home page custom code
        $themeSubSettings['homepagecustomcode']=$post_data['homepage_custom_code'];
        //Pre footer section
        $themeSubSettings['prefootersection']=$post_data['pre_footer_section'];
        //Footer section
        $themeSubSettings['footersection']=$post_data['footer_section'];
        //Default Buttons Color Settings
        $themeSubSettings['buttoncolor']=json_encode(array('button_background_color'=>$post_data['button_background_color'],'button_text_color'=>$post_data['button_text_color'],'button_border_color'=>$post_data['button_border_color']));
        /////////////////////Catalog Page settings
        //Breadcrumbs                                    
        $themeSubSettings['breadcrumb']=  json_encode(array('show_breadcrumbs'=>$post_data['show_breadcrumbs'],'breadcrumbs_bg_color'=>$post_data['breadcrumbs_bg_color'],'breadcrumbs_font_color'=>$post_data['breadcrumbs_font_color']));
        //Catalog View                                    
        //$themeSubSettings['catalogview']=  json_encode(array('default_catalog_view'=>$post_data['default_catalog_view'],'show_grid_list_choice'=>$post_data['show_grid_list_choice']));
        //Number of Products Per Page
        $themeSubSettings['numberofproductsperpage']=$post_data['number_of_products_per_page'];
        //Number of Products Choice Steps
        $themeSubSettings['numberofproductschoice']=$post_data['number_of_products_choice_steps'];
        //Sort By                                    
        $themeSubSettings['catalogsortby']=json_encode(array('show_sortby_dropdown'=>$post_data['show_sortby_dropdown'],'sort_options'=>implode(',',$post_data['sort_options'])));
        //Toolbar 
        $themeSubSettings['toolbarcolor']=json_encode(array('toolbar_bg_color'=>$post_data['toolbar_bg_color'],'toolbar_text_color'=>$post_data['toolbar_text_color']));
        //Pagination
        $themeSubSettings['pagination']=json_encode(array('show_pagination'=>$post_data['show_pagination'],'pagination_bg_color'=>$post_data['pagination_bg_color'],'pagination_button_bg_color'=>$post_data['pagination_button_bg_color'],'pagination_button_text_color'=>$post_data['pagination_button_text_color']));
        //Image Border                                   
        $themeSubSettings['catalogimagedetails']=json_encode(array('show_image_border'=>$post_data['show_image_border'],'image_border_color'=>$post_data['image_border_color'],'catalog_image_width'=>$post_data['catalog_image_width']));
        //Product color
        $themeSubSettings['catalogproductcolor']=json_encode(array('product_title_color'=>$post_data['product_title_color'],'product_price_color'=>$post_data['product_price_color'],'product_special_price_color'=>$post_data['product_special_price_color']));
        //Reviews                                    
        $themeSubSettings['catalogreviews']=json_encode(array('show_review_stars'=>$post_data['show_review_stars'],'review_star_color'=>$post_data['review_star_color']));
        //Learn more link                                    
        $themeSubSettings['cataloglearnmore']=$post_data['show_learn_more'];
        //Add To Cart Button                                    
        $themeSubSettings['catalogaddtocart']=json_encode(array('show_add_to_cart'=>$post_data['show_add_to_cart'],'add_to_cart_button_bg_color'=>$post_data['add_to_cart_button_bg_color'],'add_to_cart_button_font_color'=>$post_data['add_to_cart_button_font_color'],'add_to_cart_button_border_color'=>$post_data['add_to_cart_button_border_color']));
        //Show gridlines                                    
        $themeSubSettings['cataloggridlines']=json_encode(array('show_gridlines'=>$post_data['show_gridlines'],'gridlines_color'=>$post_data['gridlines_color']));
        //////////product Page///////////
        //Product title color
        $themeSubSettings['producttitlecolor']=$post_data['productpage_title_color'];
        //Image border                                    
        $themeSubSettings['productimagedetails']=json_encode(array('show_product_image_border'=>$post_data['show_product_image_border'],'product_image_border_color'=>$post_data['product_image_border_color'],'product_image_width'=>$post_data['product_image_width']));
        //Show other details
        $themeSubSettings['showproductdeails']=json_encode(array('show_product_availability'=>$post_data['show_product_availability'],
                                                                 'show_product_wishlist_link'=>$post_data['show_product_wishlist_link'],
                                                                 'show_product_reviews_summary'=>$post_data['show_product_reviews_summary'],
                                                                 'show_product_description'=>$post_data['show_product_description'],
                                                                 'product_description_color'=>$post_data['product_description_color'],
                                                                 'show_product_additional_information'=>$post_data['show_product_additional_information'],
                                                                 'additional_information_bg_color'=>$post_data['additional_information_bg_color'],
                                                                 'additional_information_font_color'=>$post_data['additional_information_font_color'],
                                                                 'show_full_reviews_on_product_page'=>$post_data['show_full_reviews_on_product_page'],
                                                                 'full_reviews_bg_color'=>$post_data['full_reviews_bg_color'],
                                                                 'full_reviews_font_color'=>$post_data['full_reviews_font_color'],
                                                                 'show_related_products'=>$post_data['show_related_products'],
                                                                ));

        //saving homepage layout settings
        $themeSubSettings['homepagelayoutmain']=json_encode(array('h_layout_search_cart'=>$post_data['h_layout_search_cart'],
                                                                 'h_layout_sub_header'=>$post_data['h_layout_sub_header'],
                                                                 'h_layout_banner'=>$post_data['h_layout_banner'],
                                                                 'h_layout_feature'=>$post_data['h_layout_feature'],
                                                                 'h_layout_categories'=>$post_data['h_layout_categories'],
                                                                 'h_layout_news_signup'=>$post_data['h_layout_news_signup']
                                                                ));

        //saving catalog main layout settings
        $themeSubSettings['cataloglayoutmain']=json_encode(array('c_layout_breadcrumbs'=>$post_data['c_layout_breadcrumbs'],
                                                                 'c_layout_toolbar'=>$post_data['c_layout_toolbar'],
                                                                 'c_layout_pag_top'=>$post_data['c_layout_pag_top']
                                                                ));


        //saving catalog grid layout settings
//        $themeSubSettings['cataloglayoutgrid']=json_encode(array('c_grid_layout_product_image'=>$post_data['c_grid_layout_product_image'],
//                                                                 'c_grid_layout_product_title'=>$post_data['c_grid_layout_product_title'],
//                                                                 'c_grid_layout_product_price'=>$post_data['c_grid_layout_product_price'],
//                                                                 'c_grid_layout_product_review'=>$post_data['c_grid_layout_product_review'],
//                                                                 'c_grid_layout_product_learn'=>$post_data['c_grid_layout_product_learn'],
//                                                                 'c_grid_layout_product_addtocart'=>$post_data['c_grid_layout_product_addtocart']
//                                                                ));

        //saving catalog list layout settings
        $themeSubSettings['cataloglayoutlist']=json_encode(array('c_list_layout_product_image'=>$post_data['c_list_layout_product_image'],
                                                                 'c_list_layout_product_title'=>$post_data['c_list_layout_product_title'],
                                                                 'c_list_layout_product_price'=>$post_data['c_list_layout_product_price'],
                                                                 'c_list_layout_product_review'=>$post_data['c_list_layout_product_review'],
                                                                 'c_list_layout_product_learn'=>$post_data['c_list_layout_product_learn'],
                                                                 'c_list_layout_product_addtocart'=>$post_data['c_list_layout_product_addtocart']
                                                                ));

        //saving product page layout settings
        $themeSubSettings['productlayoutmain']=json_encode(array('ptop_layout_settings'=>array('p_layout_availability'=>$post_data['p_layout_availability'],
                                                                                             'p_layout_pricing'=>$post_data['p_layout_pricing'],
                                                                                             'p_layout_addtocart'=>$post_data['p_layout_addtocart'],
                                                                                             'p_layout_wishlist'=>$post_data['p_layout_wishlist'],
                                                                                             'p_layout_review'=>$post_data['p_layout_review']),
                                                                 'pbottom_layout_settings'=>array('p_layout_desc'=>$post_data['p_layout_desc'],
                                                                                             'p_layout_additionalinfo'=>$post_data['p_layout_additionalinfo'],
                                                                                             'p_layout_fullreview'=>$post_data['p_layout_fullreview'],
                                                                                             'p_layout_relatedproduct'=>$post_data['p_layout_relatedproduct'])
                                                                ));        
        
        return $themeSubSettings;
    }
    public function setDesignAndLayoutFormData($subsettingsModel,$getSubsetDefaultId,$subsetParentId)
    {
        /*Condition that checks if a theme has a subset assigned and it's present, assigns the Parent value as preset
        dropdown value*/
        if($subsetParentId!='')$getSubsetDefaultId=$subsetParentId;
        else $getSubsetDefaultId=$getSubsetDefaultId;        
        //Background Color       
        //Links
        $decodeLinksData=json_decode($subsettingsModel->getLinks());                
        //Search / Cart
        $decodeSearchCartData=json_decode($subsettingsModel->getSearchcart());        
        //Home Page Banner
        $decodeHomeBannerData=json_decode($subsettingsModel->getHomepagebanner());                
        //SubHeader Section
        $subsettingsModel->setData('subheader_section', $subsettingsModel->getSubheadersection());
        //Categories
        $decodeCategoryData=json_decode($subsettingsModel->getCategories());               
        //Newsletter
        $decodeNewsletterData=json_decode($subsettingsModel->getNewsletter());               
        //Homepage Custom Code       
        //Pre-Footer Section         
        //Footer Section        
        // Buttons Color
        $decodeButtonData=json_decode($subsettingsModel->getButtoncolor());        
        /////////////////////Catalog Page///////////////////////////
        //Breadcrumbs
        $decodeBreadcrumbData=json_decode($subsettingsModel->getBreadcrumb());       
        //Catalog view        
        $decodeCatalogviewbData=json_decode($subsettingsModel->getCatalogview());        
        //Number of Products Per Page (default) ALL = Show All
        // Sort By
        $decodeCatalogsortbybData=json_decode($subsettingsModel->getCatalogsortby());
        //Toolbar
        $decodeToolbarData=json_decode($subsettingsModel->getToolbarcolor());
        //Pagination
        $decodePaginationData=json_decode($subsettingsModel->getPagination());
        //Image Border
        $decodeImageborderData=json_decode($subsettingsModel->getCatalogimagedetails());
        //Product Color
        $decodeProductColorData=json_decode($subsettingsModel->getCatalogproductcolor());       
        //Review Stars
        $decodeReviewstarsData=json_decode($subsettingsModel->getCatalogreviews());
        //Learnmore
        //Add to cart
        $decodeAddtocartData=json_decode($subsettingsModel->getCatalogaddtocart());
        //Gridlines
        $decodeGridlinesData=json_decode($subsettingsModel->getCataloggridlines());
        /////////////////////Product Page///////////////////////////
        //Product Title
        //Imageborder
        $decodeProductImageborderData=json_decode($subsettingsModel->getProductimagedetails());
        //Show       
        $decodeProductShowData=json_decode($subsettingsModel->getShowproductdeails());
         //echo '<pre>'; print_r($subsettingsModel->getShowproductdeails()); echo '</pre>';exit;
        //Homepage Layout
        $hLayoutData = json_decode($subsettingsModel->getHomepagelayoutmain()); 
        //Catalog Layout main
        $cLayoutData = json_decode($subsettingsModel->getCataloglayoutmain());
        //Catalog grid layout
        $cLayoutGridData = json_decode($subsettingsModel->getCataloglayoutgrid());
        //Catalog grid layout
        $cLayoutListData = json_decode($subsettingsModel->getCataloglayoutlist());
        //Product page
        $pLayoutData = json_decode($subsettingsModel->getProductlayoutmain());
        
        //var_dump($hLayoutData->h_layout_search_cart);
        $subsettingsModel->setData('preset_sub_settings', $getSubsetDefaultId)
                         ->setData('background_color', $subsettingsModel->getBgcolor())
                         ->setData('logo_fielname', $subsettingsModel->logo)
                         ->setData('header_link_home', $decodeLinksData->header_link_home)
                         ->setData('header_link_home_name', $decodeLinksData->header_link_home_name)
                         ->setData('footer_link_home', $decodeLinksData->footer_link_home)
                         ->setData('footer_link_home_name', $decodeLinksData->footer_link_home_name)
                         ->setData('header_link_login', $decodeLinksData->header_link_login)
                         ->setData('header_link_login_name', $decodeLinksData->header_link_login_name)
                         ->setData('footer_link_login', $decodeLinksData->footer_link_login)
                         ->setData('footer_link_login_name', $decodeLinksData->footer_link_login_name)
                         ->setData('header_link_myaccount', $decodeLinksData->header_link_myaccount)
                         ->setData('header_link_myaccount_name', $decodeLinksData->header_link_myaccount_name)
                         ->setData('footer_link_myaccount', $decodeLinksData->footer_link_myaccount)
                         ->setData('footer_link_myaccount_name', $decodeLinksData->footer_link_myaccount_name)
                         ->setData('header_link_wishlist', $decodeLinksData->header_link_wishlist)
                         ->setData('header_link_wishlist_name', $decodeLinksData->header_link_wishlist_name)
                         ->setData('footer_link_wishlist', $decodeLinksData->footer_link_wishlist)
                         ->setData('footer_link_wishlist_name', $decodeLinksData->footer_link_wishlist_name)
                         ->setData('links_color', $decodeLinksData->links_color)
                         ->setData('text_color', $subsettingsModel->getTextcolor())
                         ->setData('show_search_cart_area', $decodeSearchCartData->show_search_cart_area)
                         ->setData('search_cart_bg_color', $decodeSearchCartData->search_cart_bg_color)
                         ->setData('cart_link_color', $decodeSearchCartData->cart_link_color)
                         ->setData('show_home_page_banner', $decodeHomeBannerData->show_home_page_banner)                    
                         ->setData('banner_fielname', $decodeHomeBannerData->homepage_banner)                    
                         ->setData('homepage_banner_url', $decodeHomeBannerData->homepage_banner_url)
                         ->setData('categories1', $decodeCategoryData->categories)             
                         ->setData('categories2', $decodeCategoryData->categories)             
                         ->setData('categories_background_color', $decodeCategoryData->categories_background_color)
                         ->setData('show_newsletter', $decodeNewsletterData->show_newsletter)
                         ->setData('newsletter_area_backgorund', $decodeNewsletterData->newsletter_area_backgorund)
                         ->setData('homepage_custom_code', $subsettingsModel->getHomepagecustomcode())
                         ->setData('pre_footer_section', $subsettingsModel->getPrefootersection())
                         ->setData('footer_section', $subsettingsModel->getFootersection())
                         ->setData('button_background_color', $decodeButtonData->button_background_color)
                         ->setData('button_text_color', $decodeButtonData->button_text_color)
                         ->setData('button_border_color', $decodeButtonData->button_border_color)
                         ->setData('show_breadcrumbs', $decodeBreadcrumbData->show_breadcrumbs)
                         ->setData('breadcrumbs_bg_color', $decodeBreadcrumbData->breadcrumbs_bg_color)
                         ->setData('breadcrumbs_font_color', $decodeBreadcrumbData->breadcrumbs_font_color)
                         //->setData('default_catalog_view', $decodeCatalogviewbData->default_catalog_view)
                         //->setData('show_grid_list_choice', $decodeCatalogviewbData->show_grid_list_choice)                         
                         ->setData('number_of_products_per_page', $subsettingsModel->getNumberofproductsperpage())
                         ->setData('number_of_products_choice_steps', $subsettingsModel->getNumberofproductschoice())
                         ->setData('show_sortby_dropdown', $decodeCatalogsortbybData->show_sortby_dropdown)
                         ->setData('sort_options', explode(',',$decodeCatalogsortbybData->sort_options))
                         ->setData('toolbar_bg_color', $decodeToolbarData->toolbar_bg_color)
                         ->setData('toolbar_text_color', $decodeToolbarData->toolbar_text_color)
                         ->setData('show_pagination', $decodePaginationData->show_pagination)
                         ->setData('pagination_bg_color', $decodePaginationData->pagination_bg_color)
                         ->setData('pagination_button_bg_color', $decodePaginationData->pagination_button_bg_color)
                         ->setData('pagination_button_text_color', $decodePaginationData->pagination_button_text_color)
                         ->setData('show_image_border', $decodeImageborderData->show_image_border)
                         ->setData('image_border_color', $decodeImageborderData->image_border_color)
                         ->setData('catalog_image_width', $decodeImageborderData->catalog_image_width)
                         ->setData('product_title_color', $decodeProductColorData->product_title_color)
                         ->setData('product_price_color', $decodeProductColorData->product_price_color)
                         ->setData('product_special_price_color', $decodeProductColorData->product_special_price_color)
                         ->setData('show_review_stars', $decodeReviewstarsData->show_review_stars)
                         ->setData('review_star_color', $decodeReviewstarsData->review_star_color)
                         ->setData('show_learn_more', $subsettingsModel->getCataloglearnmore())
                         ->setData('show_add_to_cart', $decodeAddtocartData->show_add_to_cart)
                         ->setData('add_to_cart_button_bg_color', $decodeAddtocartData->add_to_cart_button_bg_color)
                         ->setData('add_to_cart_button_font_color', $decodeAddtocartData->add_to_cart_button_font_color)
                         ->setData('add_to_cart_button_border_color', $decodeAddtocartData->add_to_cart_button_border_color)
                         ->setData('show_gridlines', $decodeGridlinesData->show_gridlines)
                         ->setData('gridlines_color', $decodeGridlinesData->gridlines_color)
                         ->setData('productpage_title_color', $subsettingsModel->getProducttitlecolor())
                         ->setData('show_product_image_border', $decodeProductImageborderData->show_product_image_border)
                         ->setData('product_image_border_color', $decodeProductImageborderData->product_image_border_color)
                         ->setData('product_image_width', $decodeProductImageborderData->product_image_width)
                         ->setData('show_product_availability', $decodeProductShowData->show_product_availability)
                         ->setData('show_product_wishlist_link', $decodeProductShowData->show_product_wishlist_link)
                         ->setData('show_product_reviews_summary', $decodeProductShowData->show_product_reviews_summary)
                         ->setData('show_product_description', $decodeProductShowData->show_product_description)
                         ->setData('product_description_color', $decodeProductShowData->product_description_color)
                         ->setData('show_product_additional_information', $decodeProductShowData->show_product_additional_information)
                         ->setData('additional_information_bg_color', $decodeProductShowData->additional_information_bg_color)
                         ->setData('additional_information_font_color', $decodeProductShowData->additional_information_font_color)
                         ->setData('show_full_reviews_on_product_page', $decodeProductShowData->show_full_reviews_on_product_page)
                         ->setData('full_reviews_bg_color', $decodeProductShowData->full_reviews_bg_color)
                         ->setData('full_reviews_font_color', $decodeProductShowData->full_reviews_font_color)                             
                         ->setData('show_related_products', $decodeProductShowData->show_related_products)
                         ->setData('preset_layout_sub_settings', $getSubsetDefaultId)
                         ->setData('h_layout_search_cart', $hLayoutData->h_layout_search_cart)
                         ->setData('h_layout_sub_header', $hLayoutData->h_layout_sub_header)
                         ->setData('h_layout_banner', $hLayoutData->h_layout_banner)
                         ->setData('h_layout_feature', $hLayoutData->h_layout_feature)
                         ->setData('h_layout_categories', $hLayoutData->h_layout_categories)
                         ->setData('h_layout_news_signup', $hLayoutData->h_layout_news_signup)
                         ->setData('c_layout_breadcrumbs', $cLayoutData->c_layout_breadcrumbs)
                         ->setData('c_layout_toolbar', $cLayoutData->c_layout_toolbar)
                         ->setData('c_layout_pag_top', $cLayoutData->c_layout_pag_top)
                         ->setData('c_grid_layout_product_image', $cLayoutGridData->c_grid_layout_product_image)       
                         ->setData('c_grid_layout_product_title', $cLayoutGridData->c_grid_layout_product_title)       
                         ->setData('c_grid_layout_product_price', $cLayoutGridData->c_grid_layout_product_price)       
                         ->setData('c_grid_layout_product_review', $cLayoutGridData->c_grid_layout_product_review)       
                         ->setData('c_grid_layout_product_learn', $cLayoutGridData->c_grid_layout_product_learn)       
                         ->setData('c_grid_layout_product_addtocart', $cLayoutGridData->c_grid_layout_product_addtocart)      
                         ->setData('c_list_layout_product_image', $cLayoutListData->c_list_layout_product_image)        
                         ->setData('c_list_layout_product_title', $cLayoutListData->c_list_layout_product_title)        
                         ->setData('c_list_layout_product_price', $cLayoutListData->c_list_layout_product_price)        
                         ->setData('c_list_layout_product_review', $cLayoutListData->c_list_layout_product_review)        
                         ->setData('c_list_layout_product_learn', $cLayoutListData->c_list_layout_product_learn)        
                         ->setData('c_list_layout_product_addtocart', $cLayoutListData->c_list_layout_product_addtocart)  
                         ->setData('p_layout_availability', $pLayoutData->ptop_layout_settings->p_layout_availability)         
                         ->setData('p_layout_pricing', $pLayoutData->ptop_layout_settings->p_layout_pricing)         
                         ->setData('p_layout_addtocart', $pLayoutData->ptop_layout_settings->p_layout_addtocart)         
                         ->setData('p_layout_wishlist', $pLayoutData->ptop_layout_settings->p_layout_wishlist)         
                         ->setData('p_layout_review', $pLayoutData->ptop_layout_settings->p_layout_review)         
                         ->setData('p_layout_desc', $pLayoutData->pbottom_layout_settings->p_layout_desc)         
                         ->setData('p_layout_additionalinfo', $pLayoutData->pbottom_layout_settings->p_layout_additionalinfo)         
                         ->setData('p_layout_fullreview', $pLayoutData->pbottom_layout_settings->p_layout_fullreview)         
                         ->setData('p_layout_relatedproduct', $pLayoutData->pbottom_layout_settings->p_layout_relatedproduct);
        return $subsettingsModel;
    }
    static public function _disableModule($moduleName)
    {
        $configValue = Mage::getStoreConfig('mobilenowsettings/mobilenowgeneral/status');
        $subscriptionstatus = json_decode(Mage::getStoreConfig('mobilenowsettings/mobilenowaccount/subscription'));		
        if($configValue==0 || $subscriptionstatus->subscritionStatus=='inactive'|| $subscriptionstatus->subscritionStatus=='' || $subscriptionstatus->daysRemaining<=0)
        {        	
            $outputPath = "advanced/modules_disable_output/$moduleName";
            if (!Mage::getStoreConfig($outputPath))
            {
                if($configValue==0)
                {
                    Mage::getSingleton("adminhtml/session")->addError('The MobileNow extension is deactivated or there is no account set up within the configuration settings. Please set up an account within System->Configuration->MobileNow and activate the extension to unlock all of the features in MobileNow.' ); 
                }
                elseif($subscriptionstatus->subscritionStatus=='inactive'|| $subscriptionstatus->subscritionStatus=='')
                {
                    Mage::getSingleton("adminhtml/session")->addError('There is no account set up within the configuration options. Go to <a target="_blank" href="http://mobilenowapp.com" >http://mobilenowapp.com</a> to get a free account' );
                }
                elseif($subscriptionstatus->daysRemaining<=0)
                {
                    Mage::getSingleton("adminhtml/session")->addError('Your free trial period has expired. Please visit <a target="_blank" href="http://mobilenowapp.com" >http://mobilenowapp.com</a> and upgrade your account to the Gold Membership.' );
                }
                Mage::app()->getStore()->setConfig($outputPath, true);    
            }
        }        
    }
    static public function getPreviewCategoryUrl()    
    {
         //////////////////GetCategory Id to load in Iframe///////////////////////
        $previewCat=Mage::getModel('catalog/category');
        $categoryId = $previewCat->getCollection()->getLastItem();
        if($categoryId->getId())
        {
            $CategoryId=$categoryId->getId();
            $previewCat->load($CategoryId);
            $categoryURL=$previewCat->getUrlPath();        
        }    
        else
        {
            $categoryURL='';
        }
        return $categoryURL;
    }
    static public function getPreviewProductUrl()    
    {
         ///////////////Get product ID to Load in Iframe///////////////////////
        $previewProduct=Mage::getModel('catalog/product');
        $previewProductId = $previewProduct->getCollection()->getFirstItem();
        if($previewProductId->getId())
        {
            $ProductId=$previewProductId->getId();
            $previewProduct->load($ProductId);
            $productURL=$previewProduct->getUrlPath();        
        }
        else
        {
            $productURL='';
        }
        return $productURL;
    }
    
    public function remove_dir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") rmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }    
    
}	 

