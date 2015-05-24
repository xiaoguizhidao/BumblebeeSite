<?php
/**
 * @author		Sashas
 * @category    Sashas
 * @package     Sashas_Productlink
 * @copyright   Copyright (c) 2013 Sashas IT Support Inc. (http://www.sashas.org)
 * @license     http://opensource.org/licenses/GPL-3.0  GNU General Public License, version 3 (GPL-3.0)

 */

class Sashas_Productlink_Block_Adminhtml_Catalog_Category_Tab_Product extends Mage_Adminhtml_Block_Catalog_Category_Tab_Product {

	protected function _prepareColumns()
	{
		parent::_prepareColumns();
		$this->addColumn('edit', array(
				'header'    => Mage::helper('catalog')->__('Action'),
				'width'     => '80',
				'filter' 	=>false,
				'sortable'  => false,
				'index' =>'entity_id',
				'renderer'  => 'productlink/renderer_category_productlink'
		));

	}
}