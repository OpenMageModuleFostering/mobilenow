<?php
class Redstage_Mobilenow_Block_Adminhtml_Renderer_Merge extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
        { 
            // Get all the array of Mobile Device Design Interface from the grid
            $mobileDeviceOptionArray=Mage::helper("mobilenow")->getOptionArrayMobileDevice();
            // Get all the array of User Agent RegEx Values from the grid
            $userAgentRegxValues=Mage::helper("mobilenow")->getOptionArrayUserAgent();            
            if ($row->getData('mobile_device_design_interface') != NULL || $row->getData('user_agent_regex_values') != NULL)
            {
                //Mobile Device Design Interface processed
                $mobileDevice = $row->getData('mobile_device_design_interface');                   
                if (array_key_exists($mobileDevice, $mobileDeviceOptionArray))
                {
                    $mobileDeviceValue=$mobileDeviceOptionArray[$mobileDevice];
                }
                //User Agent RegEx Values processed
                $userAgent = $row->getData('user_agent_regex_values');
                $explodeUserAgents=explode(',',$userAgent);
                if (!empty($explodeUserAgents))
                {
                    foreach ($explodeUserAgents as $explodeUserAgent)
                    {
                        if (array_key_exists($explodeUserAgent,$userAgentRegxValues))
                        {
                            $userAgentRegxValue[]=$userAgentRegxValues[$explodeUserAgent];
                        }
                    }
                }
                $userAgentRegxValue= implode('|',$userAgentRegxValue);           
                if ($userAgent != NULL)
                {
                        return $mobileDeviceValue . '<br> ['.$userAgentRegxValue.']'; 
                }
                else
                {
                        return $mobileDeviceValue;
                }
             }
            else
            { 
            return Mage::helper('mobilenow')->__('No Mobile Device & User Agents Assigned');
            }
        }    
}?>

        