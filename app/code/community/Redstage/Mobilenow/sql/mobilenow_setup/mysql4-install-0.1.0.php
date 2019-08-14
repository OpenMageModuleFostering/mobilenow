<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
DROP TABLE IF EXISTS {$this->getTable('theme_store_id')};
DROP TABLE IF EXISTS {$this->getTable('themesubsettings')};
DROP TABLE IF EXISTS {$this->getTable('themelayoutsettings')};
DROP TABLE IF EXISTS {$this->getTable('themesettings')};
CREATE TABLE IF NOT EXISTS {$this->getTable('themesettings')} (
    `theme_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `theme_name` varchar(255) NOT NULL,
    `mobile_device_design_interface` int(11) NOT NULL,       
    `user_agent_regex_values` varchar(255) NOT NULL,  
    `user_agent_regex_custom_values` varchar(255) NOT NULL,
    `exclude_user_agent_regex_custom_values` varchar(255) NOT NULL,
    `ip_override` VARCHAR( 255 ) NOT NULL,
    `css_override` TEXT NOT NULL,
    `social_links` VARCHAR( 255 ) NOT NULL,
    `cart_inputs` VARCHAR( 255 ) NOT NULL,
    `analytics` TEXT NOT NULL,
    `status` int(11) NOT NULL,      
    `theme_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`theme_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;        
CREATE TABLE {$this->getTable('theme_store_id')} (
    `theme_id` int(11) unsigned NOT NULL COMMENT 'Theme ID',
    `store_id` smallint(5) unsigned NOT NULL COMMENT 'Store ID',
    PRIMARY KEY (`theme_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;        
ALTER TABLE {$this->getTable('theme_store_id')}
    ADD CONSTRAINT `FK_THEME_ID` FOREIGN KEY (`theme_id`) REFERENCES {$this->getTable('themesettings')} (`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `FK_STORE_ID` FOREIGN KEY (`store_id`) REFERENCES {$this->getTable('core_store')} (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;        
CREATE TABLE IF NOT EXISTS {$this->getTable('themesubsettings')} (
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `defaultsubsetting` int(10) NOT NULL,
    `subsetname` varchar(255) NOT NULL,
    `primary` int(10) NOT NULL,
    `logo` varchar(255) NOT NULL,
    `bgcolor` varchar(255) NOT NULL,
    `links` text NOT NULL,
    `textcolor` varchar(255) NOT NULL,
    `searchcart` text NOT NULL,
    `homepagebanner` text NOT NULL,
    `subheadersection` text NOT NULL,
    `categories` text NOT NULL,
    `newsletter` text NOT NULL,
    `homepagecustomcode` text NOT NULL,
    `prefootersection` text NOT NULL,
    `footersection` text NOT NULL,
    `buttoncolor` text NOT NULL,
    `breadcrumb` text NOT NULL,
    `catalogview` text NOT NULL,
    `numberofproductsperpage` varchar(255) NOT NULL,
    `numberofproductschoice` varchar(255) NOT NULL,
    `catalogsortby` text NOT NULL,
    `toolbarcolor` text NOT NULL,
    `pagination` text NOT NULL,
    `catalogimagedetails` text NOT NULL,
    `catalogproductcolor` text NOT NULL,
    `catalogreviews` text NOT NULL,
    `cataloglearnmore` text NOT NULL,
    `catalogaddtocart` text NOT NULL,
    `cataloggridlines` text NOT NULL,
    `producttitlecolor` text NOT NULL,
    `productimagedetails` text NOT NULL,
    `showproductdeails` text NOT NULL,
    `homepagelayoutmain` text NOT NULL,
    `cataloglayoutmain` text NOT NULL,
    `cataloglayoutgrid` text NOT NULL,
    `cataloglayoutlist` text NOT NULL,  
    `productlayoutmain` text NOT NULL,
    `parent` INT(10) NOT NULL,
    `themeid` int(10) NOT NULL,   
    `preview` tinyint(1) NOT NULL DEFAULT '0',
    `css_filename` VARCHAR( 255 ) NOT NULL,
    `dateinserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS {$this->getTable('themelayoutsettings')} (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `theme_id` int(11) unsigned NOT NULL,
    `layout_link_id` int(10) unsigned NOT NULL,
    `preview` tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`),
    KEY `theme_id` (`theme_id`),
    KEY `layout_link_id` (`layout_link_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
ALTER TABLE {$this->getTable('themelayoutsettings')}
    ADD CONSTRAINT `themelayoutsettings_ibfk_2` FOREIGN KEY (`theme_id`) REFERENCES {$this->getTable('themesettings')} (`theme_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `themelayoutsettings_ibfk_1` FOREIGN KEY (`layout_link_id`) REFERENCES {$this->getTable('core_layout_link')} (`layout_link_id`) ON DELETE CASCADE ON UPDATE CASCADE;  
SQLTEXT;

$installer->run($sql);
$installer->endSetup();

