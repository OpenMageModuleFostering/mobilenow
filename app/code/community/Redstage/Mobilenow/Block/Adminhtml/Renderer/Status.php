<?php
class Redstage_Mobilenow_Block_Adminhtml_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
        {             
            if ($row->getData('status')==0)
            {
                return '<a class="grid_link" href="'.Mage::helper("adminhtml")->getUrl("mobilenow/adminhtml_mobilenow/status",array('status_id'=>$row->getData('status'),'theme_id'=>$row->getData('theme_id'))).'" title="Click Here To Activate Theme">Activate Theme</a>';
            }
            else
            {
                return '<a class="grid_link" href="'.Mage::helper("adminhtml")->getUrl("mobilenow/adminhtml_mobilenow/status",array('status_id'=>$row->getData('status'),'theme_id'=>$row->getData('theme_id'))).'" title="Click Here To Deactivate Theme">Deactivate Theme</a>';
            }
        }    
}?>

        