<?php

namespace KimaiPlugin\KimaiSyncBundle\Configuration;

use App\Configuration\SystemConfiguration;

final class EasyBackupConfiguration {
    private $configuration;

    public function __construct(SystemConfiguration $configuration) {
        $this->configuration = $configuration;
    }

    /*
        Get Configurations Saved in DB Table Kimai2.Configuration
        Key = kimaiSync.*
        ConfigEntrie = Value
    */

    public function getConfig(String $configEntrie) {
        if (!is_string($configEntrie)) {
            return 'NOT SET';
        }
        return $configEntrie;
    }
}
