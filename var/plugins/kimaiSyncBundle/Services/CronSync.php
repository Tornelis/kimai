<?php

/*
namespace KimaiPlugin\KimaiSyncBundle\CronSync;

use App\Service\KimaiSyncConfiguration;
use App\Service\KimaiSyncService;

require __DIR__.'/vendor/autoload.php';

// Symfony-Kernel (wenn innerhalb Symfony/Kimai-Umgebung genutzt)
$kernel = new \App\Kernel('prod', false);
$kernel->boot();

$config = $kernel->getContainer()->get(KimaiSyncConfiguration::class);
$syncService = new KimaiSyncService($config);

// Prüfen ob Cronjob aktiviert wurde
if ($config->isCronSyncActive()) {
    $syncService->syncDatabases();
    echo "[".date('Y-m-d H:i:s')."] Database sync executed.\n";
} else {
    echo "[".date('Y-m-d H:i:s')."] Database sync is deactivated.\n";
}
    
*/