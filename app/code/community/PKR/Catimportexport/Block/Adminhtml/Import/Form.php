<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_Catimportexport_Block_Adminhtml_Import_Form extends Mage_Adminhtml_Block_Widget_Form
{
	public function __construct() {
        parent::__construct();
        $this->setId('edit_form');
        
    }
    
    protected function _prepareForm()
    {
    	$helper = Mage::helper('importexport');
    	$form = new Varien_Data_Form(
			array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/importcategories'),
			'method' => 'post',
			'enctype' => 'multipart/form-data'
			)
		);
        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form', array('legend'=>Mage::helper('catimportexport')->__('Import Setting')));
          
        $fieldset->addField(Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE, 'file', array(
            'name'     => Mage_ImportExport_Model_Import::FIELD_NAME_SOURCE_FILE,
            'label'    => $helper->__('Select File to Import'),
            'title'    => $helper->__('Select File to Import'),
            'required' => true
        ));
        
        $fieldset->addField('keep_file', 'select', array(
            'name'     => 'keep_file',
            'title'    => Mage::helper('catimportexport')->__('Save uploaded file'),
            'label'    => Mage::helper('catimportexport')->__('Save uploaded file'),
            'required' => true,
            'values'   => Mage::getModel('catimportexport/option_filesave')->getOptionArray()
        ));
          
        return parent::_prepareForm();
    }
}
