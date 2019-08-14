<?php

$installer = $this;

$installer->startSetup();
$tableThemeSetting = $installer->getTable('themelayoutsettings');

$installer->run("
ALTER TABLE `{$tableThemeSetting}` ADD `layout_update_id` INT( 10 ) UNSIGNED NOT NULL ,
ADD INDEX ( `layout_update_id` );
ALTER TABLE `{$tableThemeSetting}` ADD FOREIGN KEY ( `layout_update_id` ) REFERENCES `{$this->getTable('core_layout_update')}` (
`layout_update_id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
");
$installer->endSetup();
?>
