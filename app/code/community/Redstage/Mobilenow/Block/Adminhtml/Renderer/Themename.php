<?php
class Redstage_Mobilenow_Block_Adminhtml_Renderer_Themename extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
        {             
            if($row->getData('theme_name')!='')
            {
                return $row->getData('theme_name').'<a class="edit_link_grid" href="'.Mage::helper("adminhtml")->getUrl("mobilenow/adminhtml_mobilenow/edit",array('id'=>$row->getData('theme_id'))).'"><img src="'.$this->getSkinUrl("mobilenow_images/edit1.png").'" width="16" height="16"/><span class="grid_edit_link_text">Edit</a></a>';
            }
        }    
}?>

        