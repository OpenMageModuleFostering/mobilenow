<?php
class Redstage_Mobilenow_Helper_Homepage extends Mage_Core_Helper_Abstract
{
    // function for generationg homepage layout xml
    static public function generateHomePageLayoutXML($post_data)
    {
        
        $themeSubSettings['homepagelayoutmain'] = array();
        $themeSubSettings['homepagelayoutmain']['h_layout_search_cart'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_sub_header'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_banner'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_feature'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_categories'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_news_signup'] = 0;
        if($post_data['h_layout_search_cart'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_search_cart'] = $post_data['h_layout_search_cart'];
        if($post_data['h_layout_sub_header'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_sub_header'] = $post_data['h_layout_sub_header'];
        if($post_data['h_layout_banner'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_banner'] = $post_data['h_layout_banner'];
        if($post_data['h_layout_feature'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_feature'] = $post_data['h_layout_feature'];
        if($post_data['h_layout_categories'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_categories'] = $post_data['h_layout_categories'];
        if($post_data['h_layout_news_signup'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_news_signup'] = $post_data['h_layout_news_signup'];
        
        
        $header_nodes = '';
        if($post_data['header_link_home'] && $post_data['header_link_home'] == '1'){
            if($post_data['header_link_home_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>home</name><value>'.$post_data['header_link_home_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>home</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_login'] && $post_data['header_link_login'] == '1'){
            if($post_data['header_link_login_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>login</name><value>'.$post_data['header_link_login_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>login</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_myaccount'] && $post_data['header_link_myaccount'] == '1'){
            if($post_data['header_link_myaccount_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>account</name><value>'.$post_data['header_link_myaccount_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>account</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_wishlist'] && $post_data['header_link_wishlist'] == '1'){
            if($post_data['header_link_wishlist_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>wishlist</name><value>'.$post_data['header_link_wishlist_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>wishlist</name><value>0</value></action>';  
            }
        }
        $footer_nodes = '';
        if($post_data['footer_link_home'] && $post_data['footer_link_home'] == '1'){
            if($post_data['footer_link_home_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>home</name><value>'.$post_data['footer_link_home_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>home</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_login'] && $post_data['footer_link_login'] == '1'){
            if($post_data['footer_link_login_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>login</name><value>'.$post_data['footer_link_login_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>login</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_myaccount'] && $post_data['footer_link_myaccount'] == '1'){
            if($post_data['footer_link_myaccount_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>account</name><value>'.$post_data['footer_link_myaccount_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>account</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_wishlist'] && $post_data['footer_link_wishlist'] == '1'){
            if($post_data['footer_link_wishlist_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>wishlist</name><value>'.$post_data['footer_link_wishlist_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>wishlist</name><value>0</value></action>';  
            }
        }
        $pre_footer_content = '';
        if($post_data['pre_footer_section'] && $post_data['pre_footer_section'] != ''){
            $pre_footer_content .= '<block type="mobilenow/home" name="prefootercontent" template="mobilenow/prefootercontent.phtml"/>';
        }
        $footer_content = '';
        if($post_data['footer_section'] && $post_data['footer_section'] != ''){
            $footer_content .= '<block type="mobilenow/home" name="footercontent" template="mobilenow/footercontent.phtml"/>';
        }
        
        
            //print_r($themeSubSettings['homepagelayoutmain']);
             //echo '</pre>';            
            $h_org_xml = array();
            if(!$post_data['show_search_cart_area'] ||$post_data['show_search_cart_area'] != '1'){
                $h_org_xml['h_layout_search_cart'] = '';
            } else {
                $h_org_xml['h_layout_search_cart'] = '
                    <block type="mobilenow/home" name="catalog.search" template="mobilenow/search-panel.phtml">
                        <block type="core/template" name="top.search" as="topSearch" template="catalogsearch/form.mini.phtml"/>     
                    </block>';
            }
            if(!$post_data['subheader_section'] || trim($post_data['subheader_section']) == ''){
                $h_org_xml['h_layout_sub_header'] = '';
            } else{
                $h_org_xml['h_layout_sub_header'] = '<block type="mobilenow/home" name="subheader" template="mobilenow/subheader.phtml"/>';
            }
            if(!$post_data['show_home_page_banner'] ||$post_data['show_home_page_banner'] != '1'){
                $h_org_xml['h_layout_banner'] = '';
            } else {
                $h_org_xml['h_layout_banner'] = '<block type="mobilenow/home" name="homebanner" template="mobilenow/banner.phtml"/>';
            }    
            //finding out category menu type
            $menu_type = '';
            if(!$post_data['categories'] ||$post_data['categories'] != ''){
                $menu_type = '<action method="setData"><name>menutype</name><value>'.$post_data['categories'].'</value></action>';
            }
            
            $h_org_xml['h_layout_categories'] = '
                    <block type="mobilenow/home" name="catalog.topnav" template="mobilenow/nav.phtml">'.
                    $menu_type
                    .'                
                        <block type="catalog/navigation" name="catalog_footernav" as="catalog_footernav" template="catalog/navigation/mobile-menu.phtml"/>
                        <block type="core/text_list" name="top.menu" as="topMenu" translate="label">
                            <label>Navigation Bar</label>
                            <block type="page/html_topmenu" name="catalog.topnav" template="page/html/topmenu.phtml"/>
                        </block>
                     </block>'; 
            if(!$post_data['homepage_custom_code'] || trim($post_data['homepage_custom_code']) == ''){
                $h_org_xml['h_layout_feature'] = '';
            } else{
                $h_org_xml['h_layout_feature'] = '<block type="mobilenow/home" name="homepagefeature" template="mobilenow/customhome.phtml"/>';
            }
            if(!$post_data['show_newsletter'] ||$post_data['show_newsletter'] != '1'){
                $h_org_xml['h_layout_news_signup'] = '';
            } else {
                $h_org_xml['h_layout_news_signup'] = '<block type="newsletter/subscribe" name="newsletter" template="newsletter/subscribe.phtml"/>';
            }
            
//            $h_i = 0;
//            foreach($themeSubSettings['homepagelayoutmain'] as $hkey=>$hvalue){
//                $hvar[$h_i] = $h_org_xml[$hkey];
//                $h_i++;
//            }

            $h_layout_xml = '
            <remove name="breadcrumbs" />
            <remove name="right"/>           
            <remove name="content"/>        
            <reference name="root">         
                <action method="setTemplate"><template>page/mobilenow-home.phtml</template></action>            
            </reference>        
            <reference name="header">';
            if($header_nodes != ''){
                $h_layout_xml .='<block type="mobilenow/home" name="mobilelinks" as="mobilelinks" template="mobilenow/toplinks.phtml">'.$header_nodes.'</block>';
            }
            $h_layout_xml .='                
                <block type="mobilenow/home" name="homepage" as="homepage">';
                if(count($themeSubSettings['homepagelayoutmain']) > 0){
            
                    //echo '<pre>';

                    asort($themeSubSettings['homepagelayoutmain']);
                    foreach($themeSubSettings['homepagelayoutmain'] as $hkey=>$hvalue){
                        $h_layout_xml .= $h_org_xml[$hkey];
                    }   
                }
            $h_layout_xml .='
                </block>
            </reference>
            <reference name="footer">
     		<action method="unsetChildren"/>';
                $h_layout_xml .= $pre_footer_content;
                if($footer_nodes != ''){
                    $h_layout_xml .='<block type="mobilenow/home" name="mobilelinks-footer" as="mobilelinks-footer" template="mobilenow/footerlinks.phtml">'.$footer_nodes.'</block>';
                }
                $h_layout_xml .= $footer_content;
                $h_layout_xml .='                
            </reference>
            ';


            //echo($h_layout_xml);

            //die;

            return $h_layout_xml;
            
       
        
        
    }
    
    // function for generationg Default layout xml
    static public function generateDefaultPageLayoutXML($post_data,$css_name)
    {   
        $themeSubSettings['homepagelayoutmain'] = array();
        $themeSubSettings['homepagelayoutmain']['h_layout_search_cart'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_sub_header'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_banner'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_feature'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_categories'] = 0;
        $themeSubSettings['homepagelayoutmain']['h_layout_news_signup'] = 0;
        if($post_data['h_layout_search_cart'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_search_cart'] = $post_data['h_layout_search_cart'];
        if($post_data['h_layout_sub_header'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_sub_header'] = $post_data['h_layout_sub_header'];
        if($post_data['h_layout_categories'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_categories'] = $post_data['h_layout_categories'];
        if($post_data['h_layout_news_signup'] > 0)
            $themeSubSettings['homepagelayoutmain']['h_layout_news_signup'] = $post_data['h_layout_news_signup'];
        
        $header_nodes = '';
        if($post_data['header_link_home'] && $post_data['header_link_home'] == '1'){
            if($post_data['header_link_home_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>home</name><value>'.$post_data['header_link_home_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>home</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_login'] && $post_data['header_link_login'] == '1'){
            if($post_data['header_link_login_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>login</name><value>'.$post_data['header_link_login_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>login</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_myaccount'] && $post_data['header_link_myaccount'] == '1'){
            if($post_data['header_link_myaccount_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>account</name><value>'.$post_data['header_link_myaccount_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>account</name><value>0</value></action>';  
            }
        }
        if($post_data['header_link_wishlist'] && $post_data['header_link_wishlist'] == '1'){
            if($post_data['header_link_wishlist_name'] > 0) {
                $header_nodes .=' <action method="setData"><name>wishlist</name><value>'.$post_data['header_link_wishlist_name'].'</value></action>';  
            } else {
                $header_nodes .=' <action method="setData"><name>wishlist</name><value>0</value></action>';  
            }
        }
        $footer_nodes = '';
        if($post_data['footer_link_home'] && $post_data['footer_link_home'] == '1'){
            if($post_data['footer_link_home_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>home</name><value>'.$post_data['footer_link_home_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>home</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_login'] && $post_data['footer_link_login'] == '1'){
            if($post_data['footer_link_login_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>login</name><value>'.$post_data['footer_link_login_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>login</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_myaccount'] && $post_data['footer_link_myaccount'] == '1'){
            if($post_data['footer_link_myaccount_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>account</name><value>'.$post_data['footer_link_myaccount_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>account</name><value>0</value></action>';  
            }
        }
        if($post_data['footer_link_wishlist'] && $post_data['footer_link_wishlist'] == '1'){
            if($post_data['footer_link_wishlist_name'] > 0) {
                $footer_nodes .=' <action method="setData"><name>wishlist</name><value>'.$post_data['footer_link_wishlist_name'].'</value></action>';  
            } else {
                $footer_nodes .=' <action method="setData"><name>wishlist</name><value>0</value></action>';  
            }
        }
        
        $footer_content = '';
        if($post_data['footer_section'] && $post_data['footer_section'] != ''){
            $footer_content .= '<block type="mobilenow/home" name="footercontent" template="mobilenow/footercontent.phtml"/>';
        }
        
        
            //print_r($themeSubSettings['homepagelayoutmain']);
             //echo '</pre>';            
            $h_org_xml = array();
            if(!$post_data['show_search_cart_area'] ||$post_data['show_search_cart_area'] != '1'){
                $h_org_xml['h_layout_search_cart'] = '';
            } else {
                $h_org_xml['h_layout_search_cart'] = '
                    <block type="mobilenow/home" name="catalog.search" template="mobilenow/search-panel.phtml">
                        <block type="core/template" name="top.search" as="topSearch" template="catalogsearch/form.mini.phtml"/>     
                    </block>';
            }
            if(!$post_data['subheader_section'] || trim($post_data['subheader_section']) == ''){
                $h_org_xml['h_layout_sub_header'] = '';
            } else{
                $h_org_xml['h_layout_sub_header'] = '<block type="mobilenow/home" name="subheader" template="mobilenow/subheader.phtml"/>';
            }
              
            //finding out category menu type
            $menu_type = '';
            if(!$post_data['categories'] ||$post_data['categories'] != ''){
                $menu_type = '<action method="setData"><name>menutype</name><value>'.$post_data['categories'].'</value></action>';
            }
            
            $h_org_xml['h_layout_categories'] = '
                    <block type="mobilenow/home" name="catalog.topnav" template="mobilenow/nav.phtml">'.
                    $menu_type
                    .'                
                        <block type="catalog/navigation" name="catalog_footernav" as="catalog_footernav" template="catalog/navigation/mobile-menu.phtml"/>
                        <block type="core/text_list" name="top.menu" as="topMenu" translate="label">
                            <label>Navigation Bar</label>
                            <block type="page/html_topmenu" name="catalog.topnav" template="page/html/topmenu.phtml"/>
                        </block>
                     </block>';             
//            if(!$post_data['show_newsletter'] ||$post_data['show_newsletter'] != '1'){
//                $h_org_xml['h_layout_news_signup'] = '';
//            } else {
//                $h_org_xml['h_layout_news_signup'] = '<block type="newsletter/subscribe" name="newsletter" template="newsletter/subscribe.phtml"/>';
//            }
        
        
        
        
        $default_layout_xml = '
            <remove name="right"/>           
            <reference name="root">
                <action method="setTemplate"><template>page/1column.phtml</template></action>            
            </reference>        
            <reference name="head">
                <block type="core/text" name="include_themecss">
                    <action method="setText"><text><![CDATA[<link rel="stylesheet" type="text/css" href="'.Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA).'mobilenow_theme_css/'.$css_name.'.css?'.time().'" media="all"/>]]></text></action>
                </block> </reference>
            <reference name="header">';
                if($header_nodes != ''){
                    $default_layout_xml .='<block type="mobilenow/home" name="mobilelinks" as="mobilelinks" template="mobilenow/toplinks.phtml">'.$header_nodes.'</block>';
                }
                $default_layout_xml .='                
                <block type="mobilenow/home" name="homepage" as="homepage">';
                    if(count($themeSubSettings['homepagelayoutmain']) > 0){
                        asort($themeSubSettings['homepagelayoutmain']);
                        foreach($themeSubSettings['homepagelayoutmain'] as $hkey=>$hvalue){
                            $default_layout_xml .= $h_org_xml[$hkey];
                        } 
                    }
            $default_layout_xml .='
                </block>';
            $default_layout_xml .='</reference>';
            $default_layout_xml .= '<reference name="footer">
                    <action method="unsetChildren"/>';
                    if($footer_nodes != ''){
                        $default_layout_xml .='<block type="mobilenow/home" name="mobilelinks-footer" as="mobilelinks-footer" template="mobilenow/footerlinks.phtml">'.$footer_nodes.'</block>';
                    }
                    $default_layout_xml .= $footer_content;
                    $default_layout_xml .='</reference>';
            return $default_layout_xml;
    }
}
	 