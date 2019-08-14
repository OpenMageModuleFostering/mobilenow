<?php

$installer = $this;

$installer->startSetup();

$installer->run("
ALTER TABLE `themelayoutsettings` ADD `layout_update_id` INT( 10 ) UNSIGNED NOT NULL ,
ADD INDEX ( `layout_update_id` );
ALTER TABLE `themelayoutsettings` ADD FOREIGN KEY ( `layout_update_id` ) REFERENCES `core_layout_update` (
`layout_update_id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
");
$installer->endSetup();
?>
