<?php

/*
    Get Configurations Saved in DB Table Kimai2.Configuration
    Key = kimaiSync.*
    ConfigEntrie = Value
*/

namespace KimaiPlugin\KimaiSyncBundle\Configuration;

use App\Configuration\SystemConfiguration;

final class KimaiSyncConfiguration
{
    private $configuration;

    public function __construct(SystemConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Ordnet eine Verbindung zwischen Master und Slave einem numerischen Code zu:
     * 
     * - "Master -> Slave" liefert den Code 1.
     * - "Master <- Slave" liefert den Code 2.
     * - "Master <-> Slave" liefert den Code 3.
     * 
     * Es werden keine Eingabeparameter benötigt.
     * 
     * @return int Ein numerischer Code (1, 2 oder 3), der die Verbindungsrichtung repräsentiert.
     */
    public function getWayToSync(): int
    {
        $config = $this->configuration->find('kimai_sync.setting_way_to_go');
        if (!is_string($config)) {
            return 0;
        }
        return (int)$config;
    }

    /**
     * Gibt Verbindungsstring zu DB zurück
     * 
     * Es werden keine Eingabeparameter benötigt.
     * 
     * @return string mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
     */
    public function getMasterConnection(): string
    {
        $config = $this->configuration->find('kimai_sync.setting_master_connection');
        if (!is_string($config)) {
            return 'NOT SET';
        }
        return $config;
    }

    /**
     * Gibt Verbindungsstring zu DB zurück
     * 
     * Es werden keine Eingabeparameter benötigt.
     * 
     * @return string mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
     */
    public function getSlaveConnection(): string
    {
        $config = $this->configuration->find('kimai_sync.setting_slave_connection');
        if (!is_string($config)) {
            return 'NOT SET';
        }
        return $config;
    }

    /**
     * Gibt zurück ob Cron aktiviert ist oder nicht
     * 
     * Es werden keine Eingabeparameter benötigt.
     * 
     * @return string "1" for active, "0" for inactive
     */
    public function getCronOnOff(): string
    {
        $config = $this->configuration->find('kimai_sync.setting_cron_on_off');
        if (!is_string($config)) {
            return 'NOT SET';
        }
        return $config;
    }

    /**
     * Gibt zurück wann ein Cron Job ausgeführt wird
     * 
     * Es werden keine Eingabeparameter benötigt.
     * 
     * @return string (HH:mm) ; (:mm)
     */
    public function getCronTime(): string
    {
        $config = $this->configuration->find('kimai_sync.setting_cron_time');
        if (!is_string($config)) {
            return 'NOT SET';
        }
        return $config;
    }
}
