<?php

/**
 *  Setze die Konfiguration in System/Einstellungen von Kimai, nicht dem eigenem Plugin Menü
 */

namespace KimaiPlugin\KimaiSyncBundle\EventSubscriber;

use App\Event\SystemConfigurationEvent;
use App\Form\Model\Configuration;
use App\Form\Model\SystemConfiguration;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class SystemConfigurationSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            SystemConfigurationEvent::class => ['onSystemConfiguration', 100],
        ];
    }

    public function onSystemConfiguration(SystemConfigurationEvent $event): void
    {
        // Die Einstellungen müssen noch via translationsdateien übersetzt werden
        $event->addConfiguration(
            // Congif Tree hat: "kimai_sync"
            // korrekt: kimai_sync_config !=  falsch: kimaiSync
            (new SystemConfiguration('kimai_sync_config'))
            ->setConfiguration([

                // Connection
                (new Configuration('kimai_sync.setting_master_connection')) // mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
                    ->setTranslationDomain('system-configuration')
                    ->setType(TextType::class),
                (new Configuration('kimai_sync.setting_slave_connection')) // mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB
                    ->setTranslationDomain('system-configuration')
                    ->setType(TextType::class),
                
                // Cron Settings
                (new Configuration('kimai_sync.setting_cron_on_off')) // "1" or "0" string
                    ->setTranslationDomain('system-configuration')
                    ->setType(CheckboxType::class),
                (new Configuration('kimai_sync.setting_cron_time'))
                    ->setTranslationDomain('system-configuration')
                    ->setType(TextType::class),

                // Way to Sync
                (new Configuration('kimai_sync.setting_way_to_go'))
                    ->setTranslationDomain('system-configuration')
                    ->setType(ChoiceType::class)
                    ->setOptions(["choices" => [
                        "Master  -> Slave" => 1, 
                        "Master <-  Slave" => 2,
                        "Master <-> Slave" => 3, 
                    ]])

                    
                /*
                (new Configuration('demo.activate_dots'))
                    ->setTranslationDomain('system-configuration')
                    ->setType(CheckboxType::class),
                */
            ])
        );
    }
}
