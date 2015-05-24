<?php

/* @var $installer Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$optionTable = $installer->getTable('catalog/product_option');

//Add a new columns to the product options table to hold our regex 'attribute' data
$installer->getConnection()
    ->addColumn($optionTable,'regex',
        array(
            'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
            'length'    => 250,
            'nullable'  => true,
            'comment'   => 'RegEx'
        )
    );

$installer->getConnection()
    ->addColumn($optionTable,'regex_message',
        array(
            'type'      => Varien_Db_Ddl_Table::TYPE_BLOB,
            'nullable'  => true,
            'comment'   => 'RegEx Message'
        )
    );

$installer->endSetup();