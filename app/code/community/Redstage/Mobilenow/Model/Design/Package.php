<?php


class Redstage_Mobilenow_Model_Design_Package extends Mage_Core_Model_Design_Package
{
    private static $_regexMatchCache      = array();
    private static $_customThemeTypeCache = array();
	
    public function setPackageName($name = '')
    {
    	//echo $_SERVER['HTTP_USER_AGENT'];exit;
    	 $cache = Mage::app()->getCache();		
    	 $fr_admin = Mage::app()->getRequest()->getParam('isadmin');
		 $ld_theme_id = Mage::app()->getRequest()->getParam('theme_id');
		 $preview = Mage::app()->getRequest()->getParam('preview') ? Mage::app()->getRequest()->getParam('preview'):0;	
		
    	 if( Mage::helper('core')->isModuleEnabled('Redstage_Mobilenow')){ 
			
			  if($fr_admin==1 && $ld_theme_id){
			  		$themePackage = $this->_getThemesettingsValue($ld_theme_id);
				  	$m_themeid	=	$ld_theme_id;
				  	$themePackage_name	=	'redstage-mobilenow';	
					$from='preview';						
					Mage::getSingleton('core/session')->setMobileNowId($m_themeid);
					Mage::getSingleton('core/session')->setLoadFrom($from);
					
			  } 
			  else{
			  	 $themePackage = $this->_checkUserAgentAgainstmobileNow();
				 $from='front';				 
			     $m_themeid =$themePackage['id'];
			  	  if ($themePackage['ip_override'])	{
				  	if ($themePackage['ip_override'] == $_SERVER['REMOTE_ADDR']){
				  		$themePackage_name=  	$themePackage['val'];				
						Mage::getSingleton('core/session')->setMobileNowId($themePackage['id']);
						Mage::getSingleton('core/session')->setLoadFrom($from);
				  	}else{
				  		$themePackage=null;
				  		$themePackage_name= null;
						Mage::getSingleton('core/session')->setMobileNowId('');
				  	}
					
				  }	else{
				  		$themePackage_name=  	$themePackage['val'];				
						Mage::getSingleton('core/session')->setMobileNowId($themePackage['id']);
						Mage::getSingleton('core/session')->setLoadFrom($from);
				  }	
			  }
			
				
			if(!$cache->load("Mobiletheme".$from.$m_themeid)){
				$themeSubSettingsModel = Mage::getModel('mobilenow/themesubsettings');
				//$selectCurrentRecord = $themeSubSettingsModel->load($m_themeid,'themeid');	
			    $attributes = array('themeid'=> $m_themeid, 'preview'=> $preview);
				
                $selectCurrentRecord=$themeSubSettingsModel->loadByAttributes($attributes);   
			
				$selectCurrentRecord->setData('social_links',$themePackage['social_links'])	;
				$selectCurrentRecord->setData('cart_inputs',$themePackage['cart_inputs'])	;
                                $selectCurrentRecord->setData('analytics',$themePackage['analytics'])	;
				$cache->save(serialize($selectCurrentRecord), "Mobiletheme".$from.$m_themeid, array(), 60*60);
			}
    	 }
		 //echo $themePackage_name;
    	 if (empty($name)) {
            // see, if exceptions for user-agents defined in config
            
			$customPackage = $this->_checkUserAgentAgainstRegexps('design/package/ua_regexp');
            if ($customPackage) {
                $this->_name = $customPackage;
            }
			elseif ($themePackage) {						
				 		 $this->_name = $themePackage_name;
				 
			}
            else {
                $this->_name = Mage::getStoreConfig('design/package/name', $this->getStore());
            }
        }
        else {
            $this->_name = $name;
        }
		
        // make sure not to crash, if wrong package specified
        if (!$this->designPackageExists($this->_name, $this->getArea())) {
            $this->_name = self::DEFAULT_PACKAGE;
        }	
		
        return $this;
    }



	protected function _checkUserAgentAgainstmobileNow($regexpsConfigPath='design/mobile_now')
    {
    	if (empty($_SERVER['HTTP_USER_AGENT'])) {
            return false;
        }
		
		if (!empty(self::$_customThemeTypeCache[$regexpsConfigPath])) {
            return self::$_customThemeTypeCache[$regexpsConfigPath];
        }
		
        
        $regexps = $this->_generateRegexparryfromMobileNow();

        if (empty($regexps)) {
            return false;
        }
		
		if( $this->_getExcludePackageByUserAgent($regexps))
			return false;
		else{
			return self::getPackageByUserAgent($regexps, $regexpsConfigPath);
		}
		
       return self::getPackageByUserAgent($regexps, $regexpsConfigPath);
    }


	protected function _generateRegexparryfromMobileNow(){
		 $store_id = Mage::app()->getStore()->getId();
		 $collection = Mage::getModel("mobilenow/mobilenow")->getCollection();      
         $resource = Mage::getSingleton('core/resource');

         $collection->getSelect()
              ->join(
                      array('lk'=>$resource->getTableName('mobilenow/themestore')),
                     'lk.theme_id = main_table.theme_id',
                      array('lk.store_id','lk.theme_id')
                      );
    	 $collection->addStoreFilter($store_id);
		 $exp_chek =array();
		 foreach($collection as $themes){
			if($themes->getStatus()){
				$agents =  Mage::helper('mobilenow')->getOptionArrayUserAgent(); 				
				if(0==$themes->getUserAgentRegexValues()){
					$reg_val =array_keys($agents);
					array_shift($reg_val);
				}else
					$reg_val = explode(',', $themes->getUserAgentRegexValues());
				$reg_piped='';
				
		        foreach($reg_val as $val){
		        	$reg_piped .=$agents[$val].'|';
					$exp_chek[$themes->getThemeId()]['regexp'] =rtrim($reg_piped.$themes->getUserAgentRegexCustomValues(),'|');
					$exp_chek[$themes->getThemeId()]['value'] = 'redstage-mobilenow';
					$exp_chek[$themes->getThemeId()]['exclude'] = $themes->getExcludeUserAgentRegexCustomValues()	;					
					$exp_chek[$themes->getThemeId()]['ip_override'] = $themes->getIpOverride()	;
					$exp_chek[$themes->getThemeId()]['social_links'] = $themes->getSocialLinks()	;
					$exp_chek[$themes->getThemeId()]['cart_inputs'] = $themes->getCartInputs()	;
                                        $exp_chek[$themes->getThemeId()]['analytics'] = $themes->getAnalytics()	;
		        }
				
			}
		}
		return $exp_chek;
		
	}	

	protected function _getThemesettingsValue($ld_theme_id){
		
		$themes =  Mage::getModel("mobilenow/mobilenow")->load($ld_theme_id);
		
		$settings['ip_override'] = $themes->getIpOverride()	;
		$settings['social_links'] = $themes->getSocialLinks()	;
		$settings['cart_inputs'] = $themes->getCartInputs()	;
                $settings['analytics'] = $themes->getAnalytics()	;
		
		return $settings ;
	}
	protected function _getExcludePackageByUserAgent(array $rules)
    {
        
		if(isset($rule['exclude'])){
	        foreach ($rules as $rule) {
	            $regexp = '/' . trim($rule['exclude'], '/') . '/';
	            if (@preg_match($regexp, $_SERVER['HTTP_USER_AGENT'])) {
	            	//echo $rule['exclude'];
	               return true;
	            }
	        }
		}
        return false;
    }
	
	public static function getPackageByUserAgent(array $rules, $regexpsConfigPath = 'path_mock')
    {
        foreach ($rules as $id=> $rule) {
            if (!empty(self::$_regexMatchCache[$rule['regexp']][$_SERVER['HTTP_USER_AGENT']])) {
               
                $pkg['val']=$rule['value'];
				$pkg['ip_override']=$rule['ip_override'];
				$pkg['social_links']=$rule['social_links'];
				$pkg['cart_inputs']=$rule['cart_inputs'];
                                $pkg['analytics']=$rule['analytics'];
				$pkg['id']=$id;
				self::$_customThemeTypeCache[$regexpsConfigPath] = $pkg;
				return $pkg;
            }

            $regexp = '/' . trim($rule['regexp'], '/') . '/';

            if (@preg_match($regexp, $_SERVER['HTTP_USER_AGENT'])) {
                self::$_regexMatchCache[$rule['regexp']][$_SERVER['HTTP_USER_AGENT']] = true;
                
                $pkg['val']=$rule['value'];
				$pkg['id']=$id;
				$pkg['ip_override']=$rule['ip_override'];
				$pkg['social_links']=$rule['social_links'];
				$pkg['cart_inputs']=$rule['cart_inputs'];
                                $pkg['analytics']=$rule['analytics'];
				self::$_customThemeTypeCache[$regexpsConfigPath] = $pkg;
				return $pkg;				
            }
        }

        return false;
    }
    
}
