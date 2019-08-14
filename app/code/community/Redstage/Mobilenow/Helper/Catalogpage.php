<?php
class Redstage_Mobilenow_Helper_Catalogpage extends Mage_Core_Helper_Abstract
{
    // function for generationg catalog layout xml
    static public function generateCatalogPageLayoutXML($post_data)
    {   
        $themeSubSettings['c_pagelayoutmain'] = array();
        $themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'] = 0;
        $themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'] = 0;
        $themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'] = 0;
        if($post_data['c_layout_breadcrumbs'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'] = $post_data['c_layout_breadcrumbs'];
        if($post_data['c_layout_toolbar'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'] = $post_data['c_layout_toolbar'];
        if($post_data['c_layout_pag_top'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'] = $post_data['c_layout_pag_top'];        
        
            if(count($themeSubSettings['c_pagelayoutmain']) > 0){
                asort($themeSubSettings['c_pagelayoutmain']);
            } 
            $c_main_sort_xml = array();
            if(!$post_data['show_breadcrumbs'] ||$post_data['show_breadcrumbs'] != '1'){
                $c_main_sort_xml['c_layout_breadcrumbs'] = '<action method="setData"><name>showbreadcrumb</name><value>0</value></action>';
            } else {
                $c_main_sort_xml['c_layout_breadcrumbs'] = '<action method="setData"><name>showbreadcrumb</name><value>1</value></action><action method="setData"><name>breadcrumb</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'].'</value></action>';
            }
//            if(!$post_data['show_sortby_dropdown'] ||$post_data['show_sortby_dropdown'] != '1'){
//                $c_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>showsortbydropdown</name><value>0</value></action>';
//            } else {
//                $c_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>showsortbydropdown</name><value>1</value></action>';
//            }
            $c_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
            if(!$post_data['show_pagination'] ||$post_data['show_pagination'] == '2'){
                $c_main_sort_xml['c_layout_pag_top'] = '';
            } else {
                $c_main_sort_xml['c_layout_pag_top'] = '<action method="setData"><name>pager</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'].'</value></action>';
            }
               
        $themeSubSettings['c_bottom_pagelayoutmain'] = array();
        $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'] = 0;
        $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'] = 0;
        if($post_data['c_layout_toolbar'] > 0)
            $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'] = $post_data['c_layout_toolbar'];
        if($post_data['c_layout_pag_top'] > 0)
            $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'] = $post_data['c_layout_pag_top'];
        
            if(count($themeSubSettings['c_bottom_pagelayoutmain']) > 0){
                asort($themeSubSettings['c_bottom_pagelayoutmain']);
            }
            $c_bottom_main_sort_xml = array();            
//            if(!$post_data['show_sortby_dropdown'] ||$post_data['show_sortby_dropdown'] != '1'){
//                $c_bottom_main_sort_xml['c_layout_toolbar'] = '';
//            } else {
//                $c_bottom_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
//            }
            $c_bottom_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
            if(!$post_data['show_pagination'] ||$post_data['show_pagination'] == '1'){
                $c_bottom_main_sort_xml['c_layout_pag_top'] = '';
            } else {
                $c_bottom_main_sort_xml['c_layout_pag_top'] = '<action method="setData"><name>pager</name><value>'.$themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'].'</value></action>';
            }
        
        $catalog_layout_xml = '';
        
        $catalog_layout_xml .= '<remove name="newsletter"/><reference name="root">
                                        <action method="unsetChild"><name>breadcrumbs</name></action>
                                    </reference>';
//        $catalog_layout_xml .= '<reference name="left">
//            <block type="catalog/layer_view" name="catalog.leftnav" after="currency" template="catalog/layer/view.phtml"/>
//        </reference>';
        $catalog_layout_xml .='<reference name="content">';
        
        $catalog_layout_xml .= '
            <block type="mobilenow/toolbar" name="custom_toolbar" template="catalog/product/list/customtoolbar.phtml">';
                foreach($themeSubSettings['c_pagelayoutmain'] as $cmkey=>$cmvalue){
                    $catalog_layout_xml .= $c_main_sort_xml[$cmkey];
                } 		 
                	 
        $catalog_layout_xml .='   	 
                     <action method="setData"><name>pagerlimitlist</name><value>'.$post_data['number_of_products_choice_steps'].'</value></action>
                     <action method="setData"><name>defaultlistperpage</name><value>'.$post_data['number_of_products_per_page'].'</value></action>               	 
            </block>';
        
        $themeSubSettings['c_listpagelayoutmain'] = array();
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'] = 0;
        if($post_data['c_list_layout_product_price'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'] = $post_data['c_list_layout_product_price'];
        if($post_data['c_list_layout_product_review'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'] = $post_data['c_list_layout_product_review'];
        if($post_data['c_list_layout_product_learn'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'] = $post_data['c_list_layout_product_learn'];        
        if($post_data['c_list_layout_product_addtocart'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'] = $post_data['c_list_layout_product_addtocart'];        
//        
               
        $c_list_sort_xml = array();
        $c_list_sort_xml['c_list_layout_product_price'] = '<action method="setData"><name>price</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_review'] = '<action method="setData"><name>ratings</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_learn'] = '<action method="setData"><name>cart</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_addtocart'] = ' <action method="setData"><name>more</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'].'</value></action>';
          
        $catalog_layout_xml .='
            <block type="catalog/category_view" name="category.products" template="catalog/category/view.phtml">
                <block type="catalog/product_list" name="product_list" template="catalog/product/mobilelist.phtml">';
                if($post_data['show_review_stars'] && $post_data['show_review_stars'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showstar</name><value>1</value></action>';
                }
                if($post_data['show_add_to_cart'] && $post_data['show_add_to_cart'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showcartbtn</name><value>1</value></action>';
                }
                if($post_data['show_learn_more'] && $post_data['show_learn_more'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showlernmore</name><value>1</value></action>';
                }
                  
                foreach($c_list_sort_xml as $c_listkey=>$c_listvalue){
                    $catalog_layout_xml .= $c_listvalue;
                } 
                    
                $catalog_layout_xml .= '    
                    <action method="addColumnCountLayoutDepend"><layout>empty</layout><count>6</count></action>
                    <action method="addColumnCountLayoutDepend"><layout>one_column</layout><count>5</count></action>
                    <action method="addColumnCountLayoutDepend"><layout>two_columns_left</layout><count>4</count></action>
                    <action method="addColumnCountLayoutDepend"><layout>two_columns_right</layout><count>4</count></action>
                    <action method="addColumnCountLayoutDepend"><layout>three_columns</layout><count>3</count></action>
                    <action method="setToolbarBlockName"><name>product_list_toolbar</name></action>
                </block>
            </block>
            ';        
        $catalog_layout_xml .= '<block type="mobilenow/toolbar" name="custom_toolbar_bottom" template="catalog/product/list/customtoolbar.phtml">';
        foreach($themeSubSettings['c_bottom_pagelayoutmain'] as $cmbkey=>$cmbvalue){
                    $catalog_layout_xml .= $c_bottom_main_sort_xml[$cmbkey];
                } 
        $catalog_layout_xml .='   	 
                     <action method="setData"><name>pagerlimitlist</name><value>'.$post_data['number_of_products_choice_steps'].'</value></action>
                     <action method="setData"><name>defaultlistperpage</name><value>'.$post_data['number_of_products_per_page'].'</value></action>               	 
            </block>';
        
        $catalog_layout_xml .='</reference>';
        
        return $catalog_layout_xml;
    }    
    
    
    // function for generationg catalog search page layout xml
    static public function generateCatalogSearchPageLayoutXML($post_data)
    {           
        $themeSubSettings['c_pagelayoutmain'] = array();
        $themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'] = 0;
        $themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'] = 0;
        $themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'] = 0;
        if($post_data['c_layout_breadcrumbs'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'] = $post_data['c_layout_breadcrumbs'];
        if($post_data['c_layout_toolbar'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'] = $post_data['c_layout_toolbar'];
        if($post_data['c_layout_pag_top'] > 0)
            $themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'] = $post_data['c_layout_pag_top'];        
        
        if(count($themeSubSettings['c_pagelayoutmain']) > 0){
            asort($themeSubSettings['c_pagelayoutmain']);
        }
            $c_main_sort_xml = array();
            if(!$post_data['show_breadcrumbs'] ||$post_data['show_breadcrumbs'] != '1'){
                $c_main_sort_xml['c_layout_breadcrumbs'] = '<action method="setData"><name>showbreadcrumb</name><value>0</value></action>';
            } else {
                $c_main_sort_xml['c_layout_breadcrumbs'] = '<action method="setData"><name>showbreadcrumb</name><value>1</value></action><action method="setData"><name>breadcrumb</name><value>'. $themeSubSettings['c_pagelayoutmain']['c_layout_breadcrumbs'].'</value></action>';
            }
//            if(!$post_data['show_sortby_dropdown'] ||$post_data['show_sortby_dropdown'] != '1'){
//                $c_main_sort_xml['c_layout_toolbar'] = '';
//            } else {
//                $c_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
//            }
            $c_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
            if(!$post_data['show_pagination'] || $post_data['show_pagination'] == '2'){
                $c_main_sort_xml['c_layout_pag_top'] = '';
            } else {
                $c_main_sort_xml['c_layout_pag_top'] = '<action method="setData"><name>pager</name><value>'.$themeSubSettings['c_pagelayoutmain']['c_layout_pag_top'].'</value></action>';
            }
        $themeSubSettings['c_bottom_pagelayoutmain'] = array();
        $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'] = 0; 
        $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'] = 0;      
        if($post_data['c_layout_toolbar'] > 0)
            $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'] = $post_data['c_layout_toolbar'];
        if($post_data['c_layout_pag_top'] > 0)
            $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'] = $post_data['c_layout_pag_top'];
        
        if(count($themeSubSettings['c_bottom_pagelayoutmain']) > 0){
            asort($themeSubSettings['c_bottom_pagelayoutmain']);
        }
            $c_bottom_main_sort_xml = array();            
//            if(!$post_data['show_sortby_dropdown'] ||$post_data['show_sortby_dropdown'] != '1'){
//                $c_bottom_main_sort_xml['c_layout_toolbar'] = '';
//            } else {
//                $c_bottom_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
//            }
            $c_bottom_main_sort_xml['c_layout_toolbar'] = '<action method="setData"><name>sortbox</name><value>'.$themeSubSettings['c_bottom_pagelayoutmain']['c_layout_toolbar'].'</value></action>';
            if(!$post_data['show_pagination'] ||$post_data['show_pagination'] == '1'){
                $c_bottom_main_sort_xml['c_layout_pag_top'] = '';
            } else {
                $c_bottom_main_sort_xml['c_layout_pag_top'] = '<action method="setData"><name>pager</name><value>'. $themeSubSettings['c_bottom_pagelayoutmain']['c_layout_pag_top'].'</value></action>';
            }
        
        $catalog_layout_xml = '';
        
        $catalog_layout_xml .= '<remove name="newsletter"/><reference name="root">        	  
            <action method="setTemplate"><template>page/1column.phtml</template></action>
            <action method="unsetChild"><name>breadcrumbs</name></action>
        </reference>';
        $catalog_layout_xml .= '<reference name="left">
            <block type="catalogsearch/layer" name="catalogsearch.leftnav" after="currency" template="catalog/layer/view.phtml"/>
        </reference>'; 
        $catalog_layout_xml .='<reference name="content">';
        
        $catalog_layout_xml .= '
            <block type="mobilenow/toolbar" name="custom_toolbar" template="catalog/product/list/customtoolbar.phtml">';
                foreach($themeSubSettings['c_pagelayoutmain'] as $cmkey=>$cmvalue){
                    $catalog_layout_xml .= $c_main_sort_xml[$cmkey];
                } 		 
                	 
        $catalog_layout_xml .='   	 
                     <action method="setData"><name>pagerlimitlist</name><value>'.$post_data['number_of_products_choice_steps'].'</value></action>
                     <action method="setData"><name>defaultlistperpage</name><value>'.$post_data['number_of_products_per_page'].'</value></action>               	 
            </block>';
        
        $themeSubSettings['c_listpagelayoutmain'] = array();
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'] = 0;
        $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'] = 0;
        if($post_data['c_list_layout_product_price'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'] = $post_data['c_list_layout_product_price'];
        if($post_data['c_list_layout_product_review'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'] = $post_data['c_list_layout_product_review'];
        if($post_data['c_list_layout_product_learn'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'] = $post_data['c_list_layout_product_learn'];        
        if($post_data['c_list_layout_product_addtocart'] > 0)
            $themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'] = $post_data['c_list_layout_product_addtocart'];        
//        
        $c_list_sort_xml = array();       
        $c_list_sort_xml['c_list_layout_product_price'] = '<action method="setData"><name>price</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_price'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_review'] = '<action method="setData"><name>ratings</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_review'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_learn'] = '<action method="setData"><name>cart</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_learn'].'</value></action>';
        $c_list_sort_xml['c_list_layout_product_addtocart'] = ' <action method="setData"><name>more</name><value>'.$themeSubSettings['c_listpagelayoutmain']['c_list_layout_product_addtocart'].'</value></action>';
        
        
        $catalog_layout_xml .='
            <block type="catalogsearch/result" name="search.result" template="catalogsearch/result.phtml">
                    <block type="catalog/product_list" name="search_result_list" template="catalog/product/mobilelist.phtml">';
                if($post_data['show_review_stars'] && $post_data['show_review_stars'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showstar</name><value>1</value></action>';
                }
                if($post_data['show_add_to_cart'] && $post_data['show_add_to_cart'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showcartbtn</name><value>1</value></action>';
                }
                if($post_data['show_learn_more'] && $post_data['show_learn_more'] == '1'){
                    $catalog_layout_xml .= '<action method="setData"><name>showlernmore</name><value>1</value></action>';
                }
                  
                foreach($c_list_sort_xml as $c_listkey=>$c_listvalue){
                    $catalog_layout_xml .= $c_listvalue;
                } 
                    
                $catalog_layout_xml .= '    
                        <action method="addColumnCountLayoutDepend"><layout>empty</layout><count>6</count></action>
                        <action method="addColumnCountLayoutDepend"><layout>one_column</layout><count>5</count></action>
                        <action method="addColumnCountLayoutDepend"><layout>two_columns_left</layout><count>4</count></action>
                        <action method="addColumnCountLayoutDepend"><layout>two_columns_right</layout><count>4</count></action>
                        <action method="addColumnCountLayoutDepend"><layout>three_columns</layout><count>3</count></action>
                        <action method="setToolbarBlockName"><name>product_list_toolbar</name></action>
                    </block>                
                    <action method="setListOrders"/>
                    <action method="setListModes"/>
                    <action method="setListCollection"/>
                </block>
            ';    
                
        $catalog_layout_xml .= '<block type="mobilenow/toolbar" name="custom_toolbar_bottom" template="catalog/product/list/customtoolbar.phtml">';
        foreach($themeSubSettings['c_bottom_pagelayoutmain'] as $cmbkey=>$cmbvalue){
                    $catalog_layout_xml .= $c_bottom_main_sort_xml[$cmbkey];
                } 
        $catalog_layout_xml .='   	 
                     <action method="setData"><name>pagerlimitlist</name><value>'.$post_data['number_of_products_choice_steps'].'</value></action>
                     <action method="setData"><name>defaultlistperpage</name><value>'.$post_data['number_of_products_per_page'].'</value></action>               	 
            </block>';
        
        $catalog_layout_xml .='</reference>';
        
        return $catalog_layout_xml;
    }    
    
}
	 