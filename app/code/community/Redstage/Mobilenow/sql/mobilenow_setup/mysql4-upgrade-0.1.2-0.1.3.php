<?php

$installer = $this;

$installer->startSetup();
$tableCoreConfig = $installer->getTable('core_config_data');

$installer->run("
INSERT INTO `{$tableCoreConfig}` (`config_id`, `scope`, `scope_id`, `path`, `value`) VALUES (NULL, 'default', '0', 'mobilenowsettings/mobilenowaccount/subscription', '0');");
$installer->endSetup();
?>
