var $j= jQuery.noConflict();
$j(document).ready(function()
{
    //////////////////////////Design sub settings save us click function/////////////////////////////////////
    $j('#theme_save_as').click(function(){
        var sub_setting_theme_name=$j('#sub_setting_theme_name').val();
        var form_key=$j('input:hidden[name=form_key]').val();
        var status='design';
        designAndLayoutAjax(sub_setting_theme_name,form_key,status);       
    });    
    //////////////////////////Top save us click function/////////////////////////////////////
    $j('#theme_save_as_top').click(function(){       
        var sub_setting_theme_name=$j('#sub_setting_theme_name_text').val();
        var form_key=$j('input:hidden[name=form_key]').val();
        var status='topsave';
        designAndLayoutAjax(sub_setting_theme_name,form_key,status);       
    });
    //////////////////////////Design subsettings save (update) click function/////////////////////////////////////
    $j('#save_settings').click(function(){
        $j('#hidden_selected_val').val($j("#preset_sub_settings").val());
        $j('#hidden_theme_sub_setting_name').val($j('#preset_sub_settings option:selected').text());
        $j.fn.colorbox.close();
        removeThemeClasses();
        var save_settings_url = $('edit_form').action+'back/edit/savesubsettings/'+$j("#preset_sub_settings").val()+'/load_id/'+$j("#preset_sub_settings").val();
        save_settings_url = _setCommonArguments(save_settings_url);
        editForm.submit(save_settings_url);        
    });    
    //////////////////////////Layout sub settings save us click function/////////////////////////////////////
    $j('#layout_save_as').click(function(){
       var sub_setting_theme_name=$j('#layout_theme_name').val();
       var form_key=$j('input:hidden[name=form_key]').val();
       var status='layout';
       designAndLayoutAjax(sub_setting_theme_name,form_key,status);       
    });
    //////////////////////////Layout sub settings save (update) click function/////////////////////////////////////
    $j('#layout_save_settings').click(function(){
        $j('#hidden_selected_val').val($j("#preset_layout_sub_settings").val());
        $j('#hidden_theme_sub_setting_name').val($j('#preset_layout_sub_settings option:selected').text());
        $j.fn.colorbox.close();
        removeThemeClasses();
        var save_settings_url = $('edit_form').action+'back/edit/savesubsettings/'+$j("#preset_layout_sub_settings").val()+'/load_id/'+$j("#preset_layout_sub_settings").val();
        save_settings_url = _setCommonArguments(save_settings_url);               
        editForm.submit(save_settings_url);
        //$j('.continue_step').show();
     });
     //////////////////////////Close the popup on clicking cancel button in colorbox/////////////////////////////////////
     $j('.cancel_final').click(function(){
        $j.fn.colorbox.close();
     });
     /////////////////////////////////Check for mobilenow account settings///////////////////////////
     var currentPageUrl=window.location.pathname;
     $j('#row_mobilenowsettings_mobilenowaccount_subscription').hide();     
     var checkForString=currentPageUrl.indexOf("section/mobilenowsettings");
     if(checkForString != -1){
         if($j('#mobilenowsettings_mobilenowaccount_subscription').val()){
            var enodedSubscriptionVal=$j.parseJSON($j('#mobilenowsettings_mobilenowaccount_subscription').val());         
            if(enodedSubscriptionVal.subscritionStatus=='active')
            {
               if(enodedSubscriptionVal.productId==2 || enodedSubscriptionVal.productId==5)
               {
                   $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>FREE - </strong><a href="https://mobilenowapp.com/am/login/index" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
               }
               else if(enodedSubscriptionVal.productId==1 || enodedSubscriptionVal.productId==4)
               {
                   $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>Active | Paid | Level 1 - </strong><a href="https://mobilenowapp.com/am/login/index" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
               }
               toUpdatedAccountDetails($j('#mobilenowsettings_mobilenowaccount_email').val(),$j('#mobilenowsettings_mobilenowaccount_username').val());                       
            }
         }
     }
    //This section for checking the mobile account settings end here//
    /////////////////////////////////////////////General / Home page//////////////////////////////////////
    //Show/Hide homepage banner
     $j('#show_home_page_banner').click(function() {
        var showHomePageBanner=$j(this).val();
        showOrHideFn(showHomePageBanner,'homepagebanner');                       
    });
    var initialHomePageBanner=$j('#show_home_page_banner').val();
    showOrHideFn(initialHomePageBanner,'homepagebanner');
    ///////////////////////////////////////////////////////////////////////
    $j('#header_link_home').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'header_link_home_name');
    });
    var initialcheckboxval= $j('#header_link_home').val();
    enableDisbaleSortOrder(initialcheckboxval,'header_link_home_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#header_link_login').click(function() {
       var logincheckboxval= $j(this).val();
        enableDisbaleSortOrder(logincheckboxval,'header_link_login_name');
    });
    var initiallogincheckboxval= $j('#header_link_login').val();
    enableDisbaleSortOrder(initiallogincheckboxval,'header_link_login_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#header_link_myaccount').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'header_link_myaccount_name');
    });
    var initialcheckboxval= $j('#header_link_myaccount').val();
    enableDisbaleSortOrder(initialcheckboxval,'header_link_myaccount_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#header_link_wishlist').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'header_link_wishlist_name');
    });
    var initialcheckboxval= $j('#header_link_wishlist').val();
    enableDisbaleSortOrder(initialcheckboxval,'header_link_wishlist_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#footer_link_home').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'footer_link_home_name');
    });
    var initialcheckboxval= $j('#footer_link_home').val();
    enableDisbaleSortOrder(initialcheckboxval,'footer_link_home_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#footer_link_login').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'footer_link_login_name');
    });
    var initialcheckboxval= $j('#footer_link_login').val();
    enableDisbaleSortOrder(initialcheckboxval,'footer_link_login_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#footer_link_myaccount').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'footer_link_myaccount_name');
    });
    var initialcheckboxval= $j('#footer_link_myaccount').val();
    enableDisbaleSortOrder(initialcheckboxval,'footer_link_myaccount_name');
    ///////////////////////////////////////////////////////////////////////
    $j('#footer_link_wishlist').click(function() {
       var checkboxval= $j(this).val();
        enableDisbaleSortOrder(checkboxval,'footer_link_wishlist_name');
    });
    var initialcheckboxval= $j('#footer_link_wishlist').val();
    enableDisbaleSortOrder(initialcheckboxval,'footer_link_wishlist_name');
    ////////////////////////////////////////////////////////////Catalog Page/////////////////////////////////////////
    //Show Bradcrumbs in catalog page
    $j('#show_breadcrumbs').click(function() {
        var showbreadcrumb=$j(this).val();
        CheckforBreadcrumbs(showbreadcrumb);
                       
    });
    var intialShowBreadcrumb=$j('#show_breadcrumbs').val();        
    CheckforBreadcrumbs(intialShowBreadcrumb);
    //Sort options checkbox in catalog page
    $j('#show_sortby_dropdown').click(function() {
        var sortByDropdown=$j(this).val();
        CheckforSortOptions(sortByDropdown);
                       
    });
    var intialSortDropDown=$j('#show_sortby_dropdown').val();        
    CheckforSortOptions(intialSortDropDown);
    //Show image border in catalog page
    $j('#show_image_border').click(function() {
        var showImageBorer=$j(this).val();
        showOrHideFn(showImageBorer,'imageborder');
                       
    });
    var initialShowImageBorder=$j('#show_image_border').val();
    showOrHideFn(initialShowImageBorder,'imageborder');   
    //Show/Hide Add To Cart Button
     $j('#show_add_to_cart').click(function() {
        var showAddToCart=$j(this).val();
        showOrHideFn(showAddToCart,'adtocart');
                       
    });
    var initialAddToCart=$j('#show_add_to_cart').val();
    showOrHideFn(initialAddToCart,'adtocart');
    //Show/Hide Gridlines
     $j('#show_gridlines').click(function() {
        var showGridlines=$j(this).val();
        showOrHideFn(showGridlines,'gridlines');
                       
    });
    var initialGridlines=$j('#show_gridlines').val();
    showOrHideFn(initialGridlines,'gridlines');
    //////////////////////////////////////////Product Page////////////////////////////////////////////////////
    $j('#show_product_image_border').click(function() {
       var showProductImageBorer=$j(this).val();
       showOrHideFn(showProductImageBorer,'productimageborder');

    });
    var initialProductShowImageBorder=$j('#show_product_image_border').val();
    showOrHideFn(initialProductShowImageBorder,'productimageborder');       
    //Product Description
     $j('#show_product_description').click(function() {
        var showGridlines=$j(this).val();
        showOrHideFn(showGridlines,'descriptioncolor');
                       
    });
    var initialGridlines=$j('#show_product_description').val();
    showOrHideFn(initialGridlines,'descriptioncolor');
    //Additional Information
     $j('#show_product_additional_information').click(function() {
        var showGridlines=$j(this).val();
        showOrHideFn(showGridlines,'additionalinfo');
                       
    });
    var initialGridlines=$j('#show_product_additional_information').val();
    showOrHideFn(initialGridlines,'additionalinfo');
    //Reviews
     $j('#show_full_reviews_on_product_page').click(function() {
        var showGridlines=$j(this).val();
        showOrHideFn(showGridlines,'fullreviews');
                       
    });
    var initialGridlines=$j('#show_full_reviews_on_product_page').val();
    showOrHideFn(initialGridlines,'descriptioncolor');
    ////////////Advance settings Page///////////////////////
    $j('#show_social_links').click(function() {
       var showSocialLinks=$j(this).val();
       showOrHideFn(showSocialLinks,'sociallinks');

    });
    var initialShowSocialLinks=$j('#show_social_links').val();
    showOrHideFn(initialShowSocialLinks,'sociallinks');    
    $j('#hidden_action_val').val('edit');
 });
 
 function enableDisbaleSortOrder(chkval,string)
 {
      if(chkval==1){$j("#"+string).removeAttr("disabled");}
      else {$j("#"+string).val('');$j("#"+string).attr("disabled", "disabled");}
 }
 function CheckforBreadcrumbs(showrhide)
 {
    if(showrhide==1)
    { 
         $j('#breadcrumbs_bg_color').parents('tr').show();
         $j('#breadcrumbs_font_color').parents('tr').show();
    }
    else
    {
         $j('#breadcrumbs_bg_color').parents('tr').hide();
         $j('#breadcrumbs_bg_color').next().children().removeAttr('style');
         $j('#breadcrumbs_bg_color').val(''); 
         $j('#breadcrumbs_font_color').parents('tr').hide();
         $j('#breadcrumbs_font_color').next().children().removeAttr('style');
         $j('#breadcrumbs_font_color').val(''); 
    }
 }
function showOrHideFn(showrhide,section)
{
    //Show / Hide Image Border in Catalog tab in admin section
    if(section=='imageborder')
    {
        if(showrhide==1)
        {        
            $j('#image_border_color').parents('tr').show();
            $j('#catalog_image_width').parents('tr').show();               
        }
        else
        {
            $j('#image_border_color').parents('tr').hide();
            $j('#image_border_color').next().children().removeAttr('style');
            $j('#image_border_color').val('');        
            $j('#catalog_image_width').parents('tr').hide();                   
            $j('#catalog_image_width').val('');     
        }
    }
    //Show / Hide Review stars in Catalog tab in admin section
    else if(section=='reviewstars')
    {        
        extentedShowrHide(showrhide,'review_star_color');
    }
    //Show / Hide Add to cart in Catalog tab in admin section
    else if(section=='adtocart')
    {
        if(showrhide==1)
        { 
             $j('#add_to_cart_button_bg_color').parents('tr').show();
             $j('#add_to_cart_button_font_color').parents('tr').show();
             $j('#add_to_cart_button_border_color').parents('tr').show();
        }
        else
        {
             $j('#add_to_cart_button_bg_color').parents('tr').hide();
             $j('#add_to_cart_button_bg_color').next().children().removeAttr('style');
             $j('#add_to_cart_button_bg_color').val('');
             $j('#add_to_cart_button_font_color').parents('tr').hide();
             $j('#add_to_cart_button_font_color').next().children().removeAttr('style');
             $j('#add_to_cart_button_font_color').val('');
             $j('#add_to_cart_button_border_color').parents('tr').hide();
             $j('#add_to_cart_button_border_color').next().children().removeAttr('style');
             $j('#add_to_cart_button_border_color').val('');
        }
    }
    //Show or Hide Gridlines in catalog page
    else if(section=='gridlines')
    {       
        extentedShowrHide(showrhide,'gridlines_color');
    }
    //Show or Hide cart area in home page
    else if(section=='homepagebanner')
    {
        extentedShowrHide(showrhide,'homepage_banner');
        extentedShowrHide(showrhide,'homepage_banner_url');
        extentedShowrHide(showrhide,'banner_preview');
    }
    else if(section=='productimageborder')
    {
        if(showrhide==1)
        {        
            $j('#product_image_border_color').parents('tr').show();
            $j('#product_image_width').parents('tr').show();               
        }
        else
        {
            $j('#product_image_border_color').parents('tr').hide();
            $j('#product_image_border_color').next().children().removeAttr('style');
            $j('#product_image_border_color').val('');        
            $j('#product_image_width').parents('tr').hide();                   
            $j('#product_image_width').val('');       
        }
    } else if(section == 'sociallinks'){
        extentedShowrHide(showrhide,'facebook_link');
        extentedShowrHide(showrhide,'twitter_link');
        extentedShowrHide(showrhide,'pinterest_link');
        extentedShowrHide(showrhide,'google_link');       
    }
    //Show or Hide Gridlines in productpage
    else if(section=='descriptioncolor')
    {       
        extentedShowrHide(showrhide,'product_description_color');
    }
    //Show or Hide Gridlines in productpage
    else if(section=='additionalinfo')
    {       
        extentedShowrHide(showrhide,'additional_information_bg_color');
        extentedShowrHide(showrhide,'additional_information_font_color');
    }
    //Show or Hide Gridlines in productpage
    else if(section=='fullreviews')
    {       
        extentedShowrHide(showrhide,'full_reviews_bg_color');
        extentedShowrHide(showrhide,'full_reviews_font_color');
    }
}
function extentedShowrHide(showrhide,correspnsingID)
{
    if(showrhide==1)
        { 
             $j('#'+correspnsingID).parents('tr').show();
        }
        else
        {
             $j('#'+correspnsingID).parents('tr').hide();
             $j('#'+correspnsingID).next().children().removeAttr('style');
             $j('#'+correspnsingID).val('');            
        }
}
function CheckforSortOptions(sortByDropdown){       
    var i=1;
    $j( ".checkboxes li" ).each(function() {               
        if(sortByDropdown==1)                
        {                  
            $j('#sort_options_'+i).show();
            $j('label[for="sort_options_'+i+'"]').show();
            $j('label[for="sort_options"]').show();
        }
        else
        {            
            $j('#sort_options_'+i).hide();
            $j('#sort_options_'+i).prop('checked', false);
            $j('label[for="sort_options_'+i+'"]').hide();
            $j('label[for="sort_options"]').hide();
        }
        i++;
    });     
}
function deleteSubsetting(url)
{
    var final_url=url+'delete_id/'+$j("#preset_sub_settings").val();
    final_url = _setCommonArguments(final_url);
    window.location.href = final_url;   
}
function preloadSubsettings(url)
{
    var final_url=url+'load_id/'+$j("#preset_sub_settings").val();   
    final_url = _setCommonArguments(final_url);
    window.location.href = final_url;   
}

function resetToDefault(url)
{
    var final_url=url+'reset_id/1';   
    final_url = _setCommonArguments(final_url);    
    window.location.href = final_url;   
}
function deleteLayoutSubsetting(url)
{
    var final_url=url+'delete_id/'+$j("#preset_layout_sub_settings").val();
    final_url = _setCommonArguments(final_url);
    window.location.href = final_url;   
}
function preloadLayoutSubsettings(url)
{
    var final_url=url+'load_id/'+$j("#preset_layout_sub_settings").val(); 
    final_url = _setCommonArguments(final_url);
    window.location.href = final_url;   
}
function _setCommonArguments(final_url){
   
    if(final_url.slice(-1) != "/"){
       final_url += "/";
    }
    
    var tabsIdName = mobilenow_tabsJsTabs.activeTab.name;
    final_url += 'active_tab/'+tabsIdName;
    if(tabsIdName == 'theme_layouts'){
        final_url += '/layout_subtab/'+$j("#layout_tabs").tabs('option', 'active');
    }else if(tabsIdName == 'design'){
        final_url += '/design_subtab/'+$j("#tabs").tabs('option', 'active');
    }
    return final_url;
}
function designAndLayoutAjax(sub_setting_theme_name,formKey,status)
{       
       Element.show('loading-mask');
       if($j.trim(sub_setting_theme_name)=='')
       {   
            if(status=='design')
                $j('#save_error').html('<span style="color:red">Please enter Sub Setting Theme Name</span>');
            else if(status=='layout')
                $j('#layout_save_error').html('<span style="color:red">Please enter Sub Setting Theme Name</span>');
            else
                $j('#save_error_top').html('<span style="color:red">Please enter Sub Setting Theme Name</span>');
           Element.hide('loading-mask');
       }
       else
       {                           
            $j.ajax({
                type: "POST",
                url: uniqueUrl+'?isAjax=true',
                data: {
                 'subsetname' : sub_setting_theme_name,
                 'form_key':formKey
                },               
                success: function(msg)
                {        
                    if(msg>0)
                    {   
                        if(status=='design')
                            $j('#save_error').html('<span style="color:red">This Sub Setting Theme name is already in use.</span>');
                        else if(status=='layout')
                            $j('#layout_save_error').html('<span style="color:red">This Sub Setting Theme name is already in use.</span>');
                        else
                            $j('#save_error_top').html('<span style="color:red">This Sub Setting Theme name is already in use.</span>');
                        Element.hide('loading-mask');
                    }
                    else
                    {                                                
                        $j('#hidden_theme_sub_setting_name').val(sub_setting_theme_name);
                        if(status=='design')
                        {
                            removeThemeClasses();
                            $j('#save_error').html('');
                        }                        
                        else if(status=='layout')
                        {
                            removeThemeClasses();
                            $j('#layout_save_error').html('');
                        }
                        else
                        {                            
                            $j('#save_error_top').html('');
                        }
                        $j.fn.colorbox.close(); 
                        Element.hide('loading-mask');
                        if(status!='topsave'){
                            if(status == 'design')
                                var save_as_url = $('edit_form').action+'back/edit/savesubsettings/1/buttontype/saveas_subset/';
                            else
                                var save_as_url = $('edit_form').action+'back/edit/savesubsettings/1/';  
                        }
                        else
                            var save_as_url = $('edit_form').action+'savenew/1/';
                        save_as_url = _setCommonArguments(save_as_url);                       
                        editForm.submit(save_as_url);          
                    }                   
                }
            });                     
       }
}
function removeThemeClasses()
{
    $j('#theme_name').removeClass('required-entry');
    $j('#mobile_device_design_interface').removeClass('required-entry');
    $j('#user_agent_regex_values').removeClass('required-entry');
    $j('#store_id').removeClass('required-entry');
}
function connectWithMobilenow(url)
{
    var email=$j('#mobilenowsettings_mobilenowaccount_email').val();
    var username=$j('#mobilenowsettings_mobilenowaccount_username').val();
    var password=$j('#mobilenowsettings_mobilenowaccount_password').val();    
    var checkEmail=isEmailAddress(email);    
    if(email=='' || username=='' || password=='' || checkEmail==null)
    {
       $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>Please enter your valid Email, Username and Password.</span></li></ul></li></ul>');
    }
    else
    {   
       Element.show('loading-mask');
       $j('#connect_error').html('');
       $j.ajax({
                type: "GET",
                url: url,
                data: {
                 'email' : email,
                 'username':username,
                 'password':password
                },
                dataType: "json",
                success: function(msg)
                {   
                    Element.hide('loading-mask');
                    if(msg.msg)
                    {
                        $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>'+msg.msg+'</span></li></ul></li></ul>');
                    }
                    if(msg.ok)
                    {
                        if(typeof msg.subscriptions!='undefined')
                        {
                            if(msg.daysRemaining<=0)
                            {
                                $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>You are connected with your mobileNow account, but your account is expired .</span></li></ul></li></ul>');
                            }
                            else
                            {
                                $j('#connect_error').html('<ul class="messages"><li class="success-msg"><ul><li><span>You are connected with your mobileNow account.</span></li></ul></li></ul>');
                            }                        
                            if(msg.subscriptions[2] || msg.subscriptions[5])//Free membership for 30 days
                            {
                                $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>FREE - </strong><a href="https://mobilenowapp.com/am/login/index" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
                            }
                            else if(msg.subscriptions[1] || msg.subscriptions[4])
                            {
                                $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>Active | Paid | Level 1 - </strong><a href="https://mobilenowapp.com/am/login/index" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
                            }
                            toUpdatedAccountDetails(email,username);
                        }
                        else
                        {
                            $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>There is no subscriptions for this account.</span></li></ul></li></ul>');
                        }
                    }                    
                }        
                    
            }); 
    }
}
function isEmailAddress(str) {
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;    
    return str.match(pattern);
}
function toUpdatedAccountDetails(email,name)
{
    //Update email section
    $j('#row_mobilenowsettings_mobilenowaccount_email .value').html(email);
    $j('#row_mobilenowsettings_mobilenowaccount_email .scope-label').hide();
    //Update name section
    $j('#row_mobilenowsettings_mobilenowaccount_username .value').html(name);
    $j('#row_mobilenowsettings_mobilenowaccount_username .scope-label').hide();                                                
    $j('#row_mobilenowsettings_mobilenowaccount_password').hide();                        
    //Hide scope of mobilenowapp link
    $j('#row_mobilenowsettings_mobilenowaccount_link .scope-label').hide();
    //Replace / Updated button
    $j('#row_mobilenowsettings_mobilenowaccount_button .value').html("<button style=\"\" onclick=\"disconnectAccount()\" class=\"scalable\" type=\"button\" title=\"Disconnect Account\" id=\"disconnect_mobilenow_account\"><span><span><span>Disconnect Account</span></span></span></button> &nbsp; <button style=\"\" onclick=\"refreshMobilenowfn()\" class=\"scalable\" type=\"button\" title=\"Refresh Account\" id=\"refresh_mobilenow_account\"><span><span><span>Refresh Account</span></span></span></button> <br/><i>*<strong>Disconnecting account</strong> will deactivate all active themes</i>");
    $j('#row_mobilenowsettings_mobilenowaccount_button .scope-label').hide();
}
function disconnectAccount()
{
    window.location.href=disconnectMobilenow;
}
function refreshMobilenowfn()
{
   Element.show('loading-mask');
    $j('#connect_error').html('');
    $j.ajax({
             type: "GET",
             url: refreshMobilenow,
             data: {
              'email' : $j('#row_mobilenowsettings_mobilenowaccount_email .value').html()                 
             },
             dataType: "json",
             success: function(msg)
             {                    
                    Element.hide('loading-mask');                 
                    if(msg.msg)
                    {
                        $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>'+msg.msg+'</span></li></ul></li></ul>');
                    }
                    if(msg.ok)
                    {         
                        if(typeof msg.subscriptions!='undefined')
                        {
                            if(msg.daysRemaining<=0)
                            {
                                $j('#connect_error').html('<ul class="messages"><li class="error-msg"><ul><li><span>Account settings is refreshed, but your account is expired .</span></li></ul></li></ul>');
                            }
                            else
                            {
                                $j('#connect_error').html('<ul class="messages"><li class="success-msg"><ul><li><span>Your account settings is refreshed.</span></li></ul></li></ul>');
                            }                        
                            if(msg.subscriptions[2] || msg.subscriptions[5])//Free membership for 30 days
                            {
                                $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>FREE - </strong><a href="http://mobilenowapp.com" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
                            }
                            else if(msg.subscriptions[1] || msg.subscriptions[4])
                            {
                                $j('#current_membership_level #current_membership_level_text_row .value').html('<p><strong>Active | Paid | Level 1 - </strong><a href="http://mobilenowapp.com" title="Click here to upgrade your account">Click here to upgrade your account</a></p>');
                            }
                        }
                        else
                        {
                            alert('There is no subscriptions for this account');
                             location.reload(); 
                        }
                    }
             }        

         });
}
function homeFrame(getID,frameURL)
{
	Element.show('loading-mask');
    $j("#"+getID).attr("src", home_url);
    
    $j("#"+getID).load(function() {
		Element.hide('loading-mask');
	});
  
   
}
function categoryFrame(getID,frameURL)
{
	Element.show('loading-mask');
    $j("#"+getID).attr("src", catalog_url);
     $j("#"+getID).load(function() {
		Element.hide('loading-mask');
	});
	
	
    
}
function productFrame(getID,frameURL)
{
	 Element.show('loading-mask');
    $j("#"+getID).attr("src", product_url);
     $j("#"+getID).load(function() {
		Element.hide('loading-mask');
	});
   
}

function get_query(url){
    
    var qs = url.substring(url.indexOf('?') + 1).split('&');
    for(var i = 0, result = {}; i < qs.length; i++){
        qs[i] = qs[i].split('=');
        result[qs[i][0]] = decodeURIComponent(qs[i][1]);
    }
    return result;
}

function updatePreview(theme_id,frame_id){
     Element.show('loading-mask');     
       $j.ajax({
            type: "POST",
            url: updatePreviewurl+'theme_id/'+theme_id+'/?isAjax=true',
            data: $j('#edit_form').serialize(),
            statusCode: {
            500: function() {
                 window.location.reload(true);
            }},
            success: function(msg)
            {                 
                qstring = get_query($j("#"+frame_id).attr("src"));
                //  console.log(qstring,'qstring',qstring.preview)
                if(qstring.preview!=1){
                	home_url = home_url+'&preview=1';
                	catalog_url = catalog_url+'&preview=1';	
                	product_url = product_url+'&preview=1';	
                	preview_url =  $j("#"+frame_id).attr("src")+'&preview=1';	
                }else{
                	preview_url =  $j("#"+frame_id).attr("src");
                }    
                            	
               	preview_url = preview_url.replace(/(store_id=)[^\&]+/, '$1' + $j('#store_id').val());
	
				$j("#"+frame_id).attr("src", preview_url);
				$j("#"+frame_id).load(function() {
					Element.hide('loading-mask');
				});
				
            }
        });              
}

