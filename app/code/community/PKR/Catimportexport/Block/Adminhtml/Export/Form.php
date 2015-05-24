<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_Catimportexport_Block_Adminhtml_Export_Form extends Mage_Adminhtml_Block_Widget_Form
{
	public function __construct() {
        parent::__construct();
        $this->setId('edit_form');
        
    }
    
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(
			array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/exportcategories'),
			'method' => 'post',
			)
		);
        $form->setUseContainer(true);
        $this->setForm($form);
        $fieldset = $form->addFieldset('form_form', array('legend'=>Mage::helper('catimportexport')->__('Export Setting')));
          
        $fieldset->addField('category', 'multiselect', array(
          'label'     => Mage::helper('catimportexport')->__('Category'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'category',
          'values'	  => Mage::getModel('catimportexport/option_category')->getOptionArray(),
        ));
          
        return parent::_prepareForm();
    }
}
