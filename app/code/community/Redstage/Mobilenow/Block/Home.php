<?php   
class Redstage_Mobilenow_Block_Home extends Mage_Core_Block_Template{   

	public function __construct()
    {
       $this->setTemplate('mobilenow/home.phtml');
	  
	   
    }
	
	public function mobileLinks()
    {
     	if (!$this->helper('customer')->isLoggedIn() )
		{
			$loginlabel  ='Log In';
			$loginurl =$this->getUrl('customer/account/login/',array());		
		}
		else
		{
			$loginlabel  ='Logout';		
			$loginurl =$this->getUrl('customer/account/logout/',array());
		} 
		$menu['home'] = array('label' => 'Home','url'=>Mage::getBaseUrl() );
	    $menu['login'] = array('label' => $loginlabel,'url'=>$loginurl );
	    $menu['account']  = array('label' => 'My Account','url'=>$this->getUrl('customer/account/'));	
	    $menu['wishlist']= array('label' => 'Wishlist','url'=>$this->getUrl('wishlist'));

		if($this->getData('home') != '')
                    $links['home'] = $this->getData('home');
                if($this->getData('login') != '')
                    $links['login'] = $this->getData('login');
                if($this->getData('account') != '')
                    $links['account'] = $this->getData('account');
                if($this->getData('wishlist') != '')
                    $links['wishlist'] = $this->getData('wishlist');
		 
		//$links = array_flip($links);
		asort($links);
		foreach($links as $k=>&$link){
			$link=$menu[$k];
		}
		return $links;
    }


	

}



