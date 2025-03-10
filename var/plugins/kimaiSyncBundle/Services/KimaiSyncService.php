<?php


/**
 * $config = new KimaiSyncConfiguration();
 * $syncService = new KimaiSyncService($config);
 * $syncService->syncDatabases();
 */

namespace KimaiPlugin\KimaiSyncBundle\Services;

use KimaiPlugin\KimaiSyncBundle\Configuration\KimaiSyncConfiguration;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Connection;

class KimaiSyncService {

    /**
     * Master Database String
     * Example with MySQL:
     *  - mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
     * @var string
     */
    private $master;

    /**
     * Slave Database String
     * Example with MySQL:
     *  - mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
     * @var string
     */
    private $slave;

    /**
     * @var KimaiSyncConfiguration
     */
    private $configuration;

    /**
     * @var Connection
     */
    private $masterConn;

    /**
     * @var Connection
     */
    private $slaveConn;


    public function __construct(KimaiSyncConfiguration $configuration) {
        $this->master = $_SERVER["DATABASE_URL"];
        $this->slave =  $_SERVER["SLAVE_DATABSE_URL"];
        $this->configuration = $configuration;

        // TO-DO: Function check if DB exists, if not create
        // TO-DO: Function check if DB Scheme is compatible or the same
        $this->masterConn = DriverManager::getConnection(['url' => $this->master]);
        $this->slaveConn = DriverManager::getConnection(['url' => $this->slave]);
    }

    private function getWayToSync(): int {
        return $this->configuration->getWayToSync();
    }

    public function syncDatabases(): void {
        $syncType = $this->getWayToSync();

        switch ($syncType) {
            case 1:
                $this->syncMasterToSlave();
                break;
            case 2:
                $this->syncSlaveToMaster();
                break;
            case 3:
                $this->syncMasterToSlave();
                $this->syncSlaveToMaster();
                break;
            default:
                throw new \RuntimeException('Unknown sync type');
        }
    }

    private function syncMasterToSlave(): void {
        $data = $this->masterConn->fetchAllAssociative('SELECT * FROM timesheet');
        
        $this->slaveConn->executeStatement('TRUNCATE TABLE timesheet');

        foreach ($data as $row) {
            $this->slaveConn->insert('timesheet', $row);
        }
    }

    private function syncSlaveToMaster(): void {
        $data = $this->slaveConn->fetchAllAssociative('SELECT * FROM timesheet');
        
        $this->masterConn->executeStatement('TRUNCATE TABLE timesheet');

        foreach ($data as $row) {
            $this->masterConn->insert('timesheet', $row);
        }
    }
}