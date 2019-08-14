<?php

$installer = $this;

$installer->startSetup();

$installer->run("

DROP TABLE IF EXISTS {$this->getTable('customer_bestsellers')};
CREATE TABLE {$this->getTable('customer_bestsellers')} (
  `bestsellers_id` int(11) NOT NULL default 0,
  `title` varchar(255) NOT NULL default '',
  PRIMARY KEY (`bestsellers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS {$this->getTable('grid_bestsellers')};
CREATE TABLE {$this->getTable('grid_bestsellers')} (
  `id` int(11) unsigned NOT NULL auto_increment,
  `bestsellers_id` int(11) NOT NULL ,
  `product_id` int(11) NOT NULL ,
  `position` int(11) NOT NULL default 0,
  `store_id` smallint(6) NOT NULL default '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

");

$installer->run("
INSERT INTO `{$installer->getTable('customer_bestsellers')}`
(`bestsellers_id`, `title`) values (1,'Generic Bestsellers Products');
");

$installer->endSetup(); 