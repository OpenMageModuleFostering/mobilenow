<?php

$installer = $this;

$installer->startSetup();

$installer->run("
INSERT INTO `core_config_data` (`config_id`, `scope`, `scope_id`, `path`, `value`) VALUES (NULL, 'default', '0', 'mobilenowsettings/mobilenowaccount/subscription', '0');");
$installer->endSetup();
?>
