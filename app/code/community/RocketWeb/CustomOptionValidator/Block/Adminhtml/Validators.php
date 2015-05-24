<?php
class RocketWeb_CustomOptionValidator_Block_Adminhtml_Validators extends Mage_Core_Block_Template {
	public function getValidatorsInGroups() {
		$ret = array();
		
		$model = Mage::getModel('rocketweb_cov/validator_type');
		$groups = $model->getGroups();
		$items = $model->getTypes();
		
		foreach($groups as $group) {
			foreach($items as $key=>$data) {
				if($group == $data['group']) {
					$ret[$group][$key] = $data;	
				}
			}
		}
		return json_encode($ret);
	}
}
