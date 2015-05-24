<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Productlink
 * @copyright   Copyright (c) 2013 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)

 */

class Sashas_Productlink_Block_Renderer_Category_Productlink extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract {
	
	public function render(Varien_Object $row)
	{
		$value = $row->getData($this->getColumn()->getIndex());				
	 	$url=Mage::getUrl('*/catalog_product/edit', array('id' =>$value, '_secure'=>true, '_current' => true, '_store'=>Mage::app()->getRequest()->getParam('store')));	 
		$value='<a href="'.$url.'" target="_blank" >Edit</a>';
		return $value;
	}
}