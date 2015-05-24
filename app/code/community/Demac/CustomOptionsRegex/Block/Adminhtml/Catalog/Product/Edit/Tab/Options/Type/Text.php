<?php

class Demac_CustomOptionsRegex_Block_Adminhtml_Catalog_Product_Edit_Tab_Options_Type_Text extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Options_Type_Abstract {

    public function __construct()
    {
        parent::__construct();
        //Set the template to our's so we can add the additional fields for the regex information
        $this->setTemplate('demac/customoptionsregex/catalog/product/edit/options/type/text.phtml');
    }
}