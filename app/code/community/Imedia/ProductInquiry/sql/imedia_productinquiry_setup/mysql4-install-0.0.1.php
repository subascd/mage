<?php

$installer = $this;

$installer->startSetup();


$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('product_inquiry')};
CREATE TABLE {$this->getTable('product_inquiry')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) NOT NULL default '0',
  `product_name` varchar(255) NOT NULL default '',
  `product_sku` varchar(255) NOT NULL default '',
  `user_name` varchar(255) NOT NULL default '',
  `user_email` varchar(255) NOT NULL default '',
  `user_question` text NOT NULL default '',
  `admin_answer` text NOT NULL default '',
  `is_active` varchar(255) NOT NULL default 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

    ");


$installer->endSetup();