<?php

class Demac_CustomOptionsRegex_Block_Adminhtml_Catalog_Product_Edit_Tab_Options_Option extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Options_Option {

    public function getOptionValues()
    {
        $values = parent::getOptionValues();
        $optionsArr = array_reverse($this->getProduct()->getOptions(), true);

        //Add our regex attribute data
        foreach($values as $value){
            $option = $optionsArr[$value->getOptionId()];
            $value->setRegex($option->getRegex());
            $value->setRegexMessage($option->getRegexMessage());
        }

        $this->_values = $values;

        return $this->_values;
    }
}
