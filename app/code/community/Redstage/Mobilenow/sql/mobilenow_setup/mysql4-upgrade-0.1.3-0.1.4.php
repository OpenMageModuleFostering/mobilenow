<?php

$installer = $this;

$installer->startSetup();

/*$installer->run("
ALTER TABLE `themesettings` ADD `ip_override` VARCHAR( 255 ) NOT NULL AFTER `exclude_user_agent_regex_custom_values` ,
ADD `css_override` TEXT NOT NULL AFTER `ip_override` ,
ADD `social_links` VARCHAR( 255 ) NOT NULL AFTER `css_override` ,
ADD `cart_inputs` VARCHAR( 255 ) NOT NULL AFTER `social_links`,
ADD `analytics` TEXT NOT NULL AFTER `cart_inputs`;");
$installer->endSetup();*/

?>
