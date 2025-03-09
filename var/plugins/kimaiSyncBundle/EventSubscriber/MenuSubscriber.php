<?php
/*
    Reagiert auf System-Events, um Synchronisation automatisch durchzuführen.
*/

namespace KimaiPlugin\KimaiSyncBundle\EventSubscriber;

use App\Event\ConfigureMainMenuEvent;
use App\Utils\MenuItemModel;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Automatische Datenbanksynchronisation über Events.
 */
final class MenuSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly AuthorizationCheckerInterface $security) { }

    public static function getSubscribedEvents(): array
    {
        return [
            ConfigureMainMenuEvent::class => ['onMenuConfigure', 100],
        ];
    }

    public function onMenuConfigure(ConfigureMainMenuEvent $event): void
    {
        $auth = $this->security;

        if (!$auth->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return;
        }

        if (!$auth->isGranted('kimai_sync')) {
            return;
        }

        $menu = $event->getSystemMenu();

        $menu->addChild(
            new MenuItemModel('kimai_sync', 'KimaiSync', 'kimai_sync', [], 'fa-solid fa-rotate')
        );
    }
}

