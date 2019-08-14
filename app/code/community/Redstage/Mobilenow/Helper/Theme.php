<?php
class Redstage_Mobilenow_Helper_Theme extends Mage_Core_Helper_Abstract
{
	
    protected $_themeId = null;
	public function __construct()
    {
        $this->_themeId = Mage::getSingleton('core/session')->getMobileNowId();
		$this->_from = Mage::getSingleton('core/session')->getLoadFrom();
		
    }
	public function getTheme()
    {
       // return Mage::getSingleton('checkout/cart');
    }
	
	public function getThemeId()
    {      
		return $this->_themeId;
    }
	
	public function getThemeData($val=''){
		 if ($val== '') return false;		
		 $subsettings = unserialize(Mage::app()->getCache()->load("Mobiletheme".$this->_from.$this->_themeId));
		 $subsettings->getData($val) ;
		 //echo $subsettings;
		 $final = $subsettings->getData($val) ;
		 // return $final = json_decode($subsettings->getData($val));
		 $check_json = json_decode($final);
		 if (is_object($check_json))		   
		     return $check_json; 
		  else 
		 	return $final;		  
	} 
	
	public function getSortbox(){
		// /$sort_array=array(); 
        $sort_array[1]=array('label'=>'Position','order'=>'position','dir'=>'asc');
        $sort_array[2]=array('label'=>'Price High -&gt Low','order'=>'price','dir'=>'desc');
        $sort_array[3]=array('label'=>'Price Low -&gt  High','order'=>'price','dir'=>'asc');
        $sort_array[4]=array('label'=>'Name A -&gt  Z','order'=>'name','dir'=>'asc');
        $sort_array[5]=array('label'=>'Name Z -&gt  A','order'=>'name','dir'=>'desc');      
        return $sort_array ;
	}
	
	//$a = $this->helper('mobilenow/theme')->getThemeData('homepagebanner');
	// $this->helper('mobilenow/theme')->getThemeId()
	        
        function generateThemeCssFile($css_var_arr) {
            $values_array = array();

            $css_content = '.page{background-color: {%background_color%} ;}
                            .header-container .search-panel {
                              background-color: {%search_cart_area_bg_color%};
                            }


                            a, a:not(img), a span:not(.price) {
                              color: {%links_color%} !important;
                            }                            

                            a:focus, a:active, a:not(img):focus, a:not(img):active, a span:not(.price):focus, a span:not(.price):active {
                              color: {%links_color%} !important;
                            }

                            a:hover, a:not(img):hover, a span:not(.price):hover {
                              text-decoration: none !important;
                              border-bottom-color: {%links_color%} !important;
                              color: {%links_color%} !important;
                              border-bottom: 1px solid {%links_color%};
                            }

                            body, p, fieldset, table, span:not(.counter), span:not(.price), span span:not(.label), label, h1, h2, h3, h4, h5, h6,
                            input[type="text"], input[type="password"], input[type="date"], input[type="datetime"], input[type="datetime-local"],
                            input[type="month"], input[type="week"], input[type="email"], input[type="number"], input[type="search"], input[type="tel"],
                            input[type="time"], input[type="url"], textarea {
                              color: {%text_color%} !important;
                            }

                            .nav-container #nav, .nav-container #nav ul a, .top-bar, .top-bar-section ul, #mobile-menu li {
                              background-color: {%categories_bg_color%};
                            }
                            .nav-container #nav li a{border-bottom:{%categories_bg_borderwidth%}px solid {%categories_bg_color%}; }
                            
							ul.title-area .name a { color: {%text_color%} !important;}
							
                            button.secondary, .button.secondary {
                              background-color: {%button_bg_color%} !important;
                              border-color: {%button_border_color%} !important;
                              color: {%button_text_color%} !important;
                            }
                            div.breadcrumbs {
                              background: none repeat scroll 0 0 {%breadcrumb_bg_color%} !important;
                            }
                            div.breadcrumbs span, div.breadcrumbs a, div.breadcrumbs span {
                              color: {%breadcrumb_font_color%} !important;
                            }
                            div.breadcrumbs a:hover {
                              text-decoration: none !important;
                              border-bottom-color: {%breadcrumb_font_color%};
                              color: {%breadcrumb_font_color%} !important;
                              border-bottom: 1px solid {%breadcrumb_font_color%};
                            }
                            .toolbar-panel {
                              background-color: {%toolbar_bg_color%} !important;
                            }
                            .toolbar-panel label {
                              color: {%toolbar_text_color%} !important;
                            }
                            .pager-panel {
                              background: none repeat scroll 0 0 {%pagination_panel_bg_color%} !important;
                              color: {%pagination_button_text_color%} !important;
                            }
                            .pager-panel a.previous, .pager-panel a.link {
                              background: none repeat scroll 0 0 {%pagination_button_bg_color%} !important;
                              color: {%pagination_button_text_color%} !important;
                              text-decoration: none !important;
                              border-bottom: 1px solid {%pagination_button_bg_color%} !important;
                            }
                            .pager-panel a.previous span.notch, .pager-panel a.link span.notch {
                              border: 11px solid transparent;
                              border-right: 11px solid {%pagination_button_bg_color%} !important;
                              border-right: 11px solid {%pagination_button_bg_color%} !important;
                            }
                            .pager-panel a.previous span.counter, .pager-panel a.link span.counter {
                              color: {%pagination_button_text_color%} !important;
                            }
                            .pager-panel a.next {
                              background: none repeat scroll 0 0 {%pagination_button_bg_color%} !important;
                              color: {%pagination_button_text_color%} !important;
                              border-bottom: 1px solid {%pagination_button_bg_color%} !important;
                            }
                            .pager-panel a.next span.notch {
                              border: 11px solid transparent;
                              border-left: 11px solid {%pagination_button_bg_color%} !important;
                              border-left: 11px solid {%pagination_button_bg_color%} !important;
                            }
                            .pager-panel a.next span.counter {
                              color: {%pagination_button_text_color%} !important;
                            }
                            .pager-panel ul.pagination li .arrow .notch:hover {
                              text-decoration: none !important;
                              border-color: {%pagination_button_bg_color%} !important;
                            }
                            .pager-panel ul.pagination .arrow a:hover, .pager-panel ul.pagination ul.pagination .arrow a:active, .pager-panel ul.pagination ul.pagination li .arrow a:focus, .pager-panel ul.pagination ul.pagination li .arrow a:focus span.notch, .pager-panel ul.pagination ul.pagination li .arrow .notch:hover {
                              text-decoration: none !important;
                              background: none repeat scroll 0 0 {%pagination_button_bg_color%} !important;
                            }

                            .products-list .item {
                              border-bottom: {%gridlines_color_width%}px solid {%gridlines_color%} !important;
                            }
                            .products-list .item .product-image {
                              border: {%image_border_width%}px solid {%image_border_color%} !important;
                            }
                            .product-view .product-image img{
                                border: {%product_image_border_width%}px solid {%product_image_border_color%} !important;
                            }

                            .product-name {
                              color: {%product_title_color%} !important;
                              text-decoration: none !important;
                            }
                            .products-list h2.product-name a {
                              color: {%product_title_color%} !important;
                              text-decoration: underline !important;
                            }
                            .products-list h2.product-name a:hover {
                              text-decoration: none !important;
                              color: {%product_title_color%} !important;
                              border-bottom: 1px solid {%product_title_color%} !important;
                            }
                            .product-name h3,h2.product-name a {
                              color: {%productpage_title_color%} !important;
                            }
                            h2.product-name a:hover{
                            color: {%productpage_title_color%} !important;
                            text-decoration: none !important;
                            border-bottom: 1px solid {%productpage_title_color%} !important;
                            }
                            .regular-price span.price, .regular-price span.price-label, .minimal-price span.price, .minimal-price span.price-label,.mobile-price .cart-price span.price,
                            .special-price .price{
                              color: {%product_price_color%} !important;
                              font-weight: bold;
                            }

                            .price-box a span.price {
                              color: {%product_special_price_color%} !important;
                            }
                            .price-box a:hover span.price {
                              text-decoration: none !important;
                              border-bottom-color: {%product_special_price_color%};
                              color: {%product_special_price_color%} !important;
                              border-bottom: 1px solid {%product_special_price_color%};
                            }

                            .rating-box .rating {
                              color: {%review_star_color%} !important;
                            }

                            .add-to-cart button.secondary, .add-to-cart .button.secondary {
                              background-color: {%add_to_cart_bg_color%} !important;
                              border-color: {%add_to_cart_border_color%} !important;
                              color: {%add_to_cart_button_text_color%} !important;
							  margin :0px!important;
                            }
                            .addtocart.secondary, .addtocart.secondary {
                              background-color: {%add_to_cart_bg_color%} !important;
                              border-color: {%add_to_cart_border_color%} !important;
                              color: {%add_to_cart_button_text_color%} !important;
							  margin :0px!important;
                            }
                            .block-subscribe {
                              background-color: {%newsletter_bg_color%} !important;
                            }
                             .products-list .item .product-image-mobilelist{width:auto !important;}
                             a.menucart,a.mycarticon{color:{%cart_link_color%} !important;} 
                             a.menucart:hover,a.mycarticon:hover{color:{%cart_link_color%} !important;border-bottom-color:{%cart_link_color%} !important;}
                             .product-view .product-collateral .box-description h2, 
                             .product-view .product-collateral .box-additional h2, 
                             .product-view .product-collateral .box-up-sell h2, 
                             .product-view .product-collateral .box-tags h2, 
                             .product-view .product-collateral .block-related h2, 
                             .product-view .product-collateral .box-reviews h2
							 {
							 	background:  {%breadcrumb_bg_color%} !important;
    						 	padding:5px 3px;
								color: {%breadcrumb_font_color%} !important;
							 }
							 .product-view .product-collateral .box-description .std {
							 	color: {%product_description_color%} !important;
							 }
							 #product-attribute-specs-table table tr.even,#product-attribute-specs-table table tr.alt, #product-attribute-specs-table table tr:nth-of-type(2n) {
							     background: {%additional_information_bg_color%} !important;
							     color :{%additional_information_font_color%}!important;
							 }
							 #product-attribute-specs-table > tbody {
							     background: {%additional_information_bg_color%} !important;
							     color :{%additional_information_font_color%} !important;
							 }
							
							  #product-attribute-specs-table tbody tr,  #product-attribute-specs-table tbody td {
							    background: {%additional_information_bg_color%} !important;
							    border: 1px solid {%background_color%};
							    color : {%additional_information_font_color%} !important;
							 }
							 .box-collateral.box-reviews >*{
							 	 background: {%full_reviews_bg_color%} !important;
								 color :{%full_reviews_font_color%} !important;
							 }								 
                             ';
            $matches = array();
            preg_match_all("/\{\%([a-z_A-Z0-9]*)\%\}/", $css_content, $matches);
            $variables_array = $matches[1];

            if (count($variables_array) > 0)
                foreach ($variables_array as $key) {
                    $values_array[] = $css_var_arr[$key];
                }

            $new_variables_array = array();
            foreach ($variables_array as $variable) {
                $new_variables_array[] = '/\{\%' . $variable . '\%\}/';
            }
            $body_content = preg_replace($new_variables_array, $values_array, $css_content);


            return $body_content;
        }
	
}

  