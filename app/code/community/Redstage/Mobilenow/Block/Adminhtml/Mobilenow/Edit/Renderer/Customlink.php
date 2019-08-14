<?php
class Redstage_Mobilenow_Block_Adminhtml_Mobilenow_Edit_Renderer_Customlink extends Mage_Adminhtml_Block_Widget implements Varien_Data_Form_Element_Renderer_Interface
{
    /**
    * renderer
    *
    * @param Varien_Data_Form_Element_Abstract $element
    */
    
    public function render(Varien_Data_Form_Element_Abstract $element) {
    //Retriving the values for all text box
        if(Mage::registry("subsettings_data"))
        { 
            if(Mage::registry("subsettings_data")->getHeaderLinkHomeName()!=''){$headerLinkHomeName=Mage::registry("subsettings_data")->getHeaderLinkHomeName();}
            if(Mage::registry("subsettings_data")->getFooterLinkHomeName()!='')$footerLinkHomeName=Mage::registry("subsettings_data")->getFooterLinkHomeName();
            if(Mage::registry("subsettings_data")->getHeaderLinkLoginName()!='')$headerLinkLoginName=Mage::registry("subsettings_data")->getHeaderLinkLoginName();
            if(Mage::registry("subsettings_data")->getFooterLinkLoginName()!='')$footerLinkLoginName=Mage::registry("subsettings_data")->getFooterLinkLoginName();
            if(Mage::registry("subsettings_data")->getHeaderLinkMyaccountName()!='')$headerLinkMyaccountName=Mage::registry("subsettings_data")->getHeaderLinkMyaccountName();
            if(Mage::registry("subsettings_data")->getFooterLinkMyaccountName()!='')$footerLinkMyaccountName=Mage::registry("subsettings_data")->getFooterLinkMyaccountName();
            if(Mage::registry("subsettings_data")->getHeaderLinkWishlistName()!='')$headerLinkWishlistName=Mage::registry("subsettings_data")->getHeaderLinkWishlistName();
            if(Mage::registry("subsettings_data")->getFooterLinkWishlistName()!='')$footerLinkWishlistName=Mage::registry("subsettings_data")->getFooterLinkWishlistName();
            //Checking for selected checkbox
             if(Mage::registry("subsettings_data")->getHeaderLinkHome()==1)$headerLinkHome='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getFooterLinkHome()==1)$footerLinkHome='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getHeaderLinkLogin()==1)$headerLinkLogin='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getFooterLinkLogin()==1)$footerLinkLogin='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getHeaderLinkMyaccount()==1)$headerLinkMyaccount='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getFooterLinkMyaccount()==1)$footerLinkMyaccount='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getHeaderLinkWishlist()==1)$headerLinkWishlist='checked="checked" value="1"';
            if(Mage::registry("subsettings_data")->getFooterLinkWishlist()==1)$footerLinkWishlist='checked="checked" value="1"';
        }
    $html = '<tr>        
    <td class="value"><label>Links</label>
    </td><td>
        <table cellspacing="0" cellpadding="0" width="360px">
            <tr>                
                <td class="value">
                    <table cellspacing="0" cellpadding="0" width="100%">
                        <tr height="30px">
                            <td width="130px">&nbsp;</td>
                            <td width="100px" align="center">Header</td>
                            <td width="185px" align="center">Sort Order</td>
                            <td width="100px" align="center">Footer</td>
                            <td width="185px" align="center">Sort Order</td>
                        </tr>
                        <tr height="30px">
                            <td>Home</td>
                            <td align="center"><input type="checkbox" id="header_link_home" name="header_link_home" '.$headerLinkHome.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="header_link_home_name" name="header_link_home_name" value="'.$headerLinkHomeName.'"/></td>
                            <td align="center"><input type="checkbox" id="footer_link_home" name="footer_link_home" '.$footerLinkHome.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="footer_link_home_name" name="footer_link_home_name" value="'.$footerLinkHomeName.'"/></td>
                        </tr>
                        <tr height="30px">
                            <td>Log in</td>
                            <td align="center"><input type="checkbox" id="header_link_login" name="header_link_login"'.$headerLinkLogin.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="header_link_login_name" name="header_link_login_name" value="'.$headerLinkLoginName.'"/></td>
                            <td align="center"><input type="checkbox" id="footer_link_login" name="footer_link_login" '.$footerLinkLogin.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="footer_link_login_name" name="footer_link_login_name" value="'.$footerLinkLoginName.'"/></td>
                        </tr>
                        <tr height="30px">
                            <td>My Account</td>
                            <td align="center"><input type="checkbox" id="header_link_myaccount" name="header_link_myaccount" '.$headerLinkMyaccount.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="header_link_myaccount_name" name="header_link_myaccount_name" value="'.$headerLinkMyaccountName.'"/></td>
                            <td align="center"><input type="checkbox" id="footer_link_myaccount" name="footer_link_myaccount" '.$footerLinkMyaccount.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="footer_link_myaccount_name" name="footer_link_myaccount_name" value="'.$footerLinkMyaccountName.'"/></td>
                        </tr>
                        <tr height="30px">
                            <td>Wishlist</td>
                           <td align="center"><input type="checkbox" id="header_link_wishlist" name="header_link_wishlist" '.$headerLinkWishlist.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="header_link_wishlist_name" name="header_link_wishlist_name" value="'.$headerLinkWishlistName.'"/></td>
                            <td align="center"><input type="checkbox" id="footer_link_wishlist" name="footer_link_wishlist" '.$footerLinkWishlist.' onclick="this.value = this.checked ? 1 : 0;"/></td>
                            <td align="center"><input type="textbox" class="design_small validate-number input-text" id="footer_link_wishlist_name" name="footer_link_wishlist_name" value="'.$footerLinkWishlistName.'"/></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
      </td>
    </tr>';
   return $html;
  }
}
?>