<?php

$installer = $this;

$installer->startSetup();

$installer->run("ALTER TABLE  `{$this->getTable('catalog/product_option')}` ADD  `validators` TEXT NOT NULL");

$installer->endSetup();
