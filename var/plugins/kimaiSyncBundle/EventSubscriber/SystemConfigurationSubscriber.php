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
            (new SystemConfiguration('kimaiSync_config'))
            ->setConfiguration([
                
                (new Configuration('kimaiSync.db_target'))
                    ->setTranslationDomain('system-configuration')
                    ->setType(TextType::class)

                /*
                (new Configuration('demo.activate_dots'))
                    ->setTranslationDomain('system-configuration')
                    ->setType(CheckboxType::class),
                */
            ])
        );
    }
}
