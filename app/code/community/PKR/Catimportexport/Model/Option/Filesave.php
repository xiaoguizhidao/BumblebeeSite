<?php
/**
@author: Pardeep Kumar <pardeep19@gmail.com>
@copyright: Orange Mantra
*/

class PKR_Catimportexport_Model_Option_Filesave extends Varien_Object {
	
	protected $_options = array();
	
	public function getOptionArray()
	{
		
		$this->_options[] = array(
				'label' => 'Please select option',
				'value' => ''
		);
		
		$this->_options[] = array(
				'label' => 'Save csv in Import folder',
				'value' => '0'
		);
		
		$this->_options[] = array(
				'label' => 'Delete csv after successful upload',
				'value' => '1'
		);
	
		return $this->_options;
	}

}