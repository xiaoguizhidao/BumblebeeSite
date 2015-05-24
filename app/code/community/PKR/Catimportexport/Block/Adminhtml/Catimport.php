<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_Catimportexport_Block_Adminhtml_Catimport extends Mage_Adminhtml_Block_Widget_Form_Container{
	
	public function __construct() {
		parent::__construct();
		$this->_objectId = 'id';
		$this->_blockGroup = "catimportexport";
		$this->_controller = "adminhtml";
		$this->_mode = 'import';
		$this->removeButton('back')
		->removeButton('save');
		
		$this->_addButton("saveandcontinue", array(
				"label"     => Mage::helper("catimportexport")->__("Import"),
				"onclick"   => "getData()",
				"class"     => "save",
		), -100);
		
		
		
		$this->_formScripts[] = "
		
							function getData(){
								editForm.submit($('edit_form').action);
							}
						";
	}
	
	public function getHeaderText()
	{
			return Mage::helper("catimportexport")->__("Import Category products");
	}
}