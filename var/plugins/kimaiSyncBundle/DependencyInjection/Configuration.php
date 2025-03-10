<?php

/*
    Definiert konfigurierbare Optionen für KimaiSync.
*/

namespace KimaiPlugin\KimaiSyncBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Konfigurationsparameter für KimaiSync.
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('kimai_sync');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()

            // Connection
            ->scalarNode('setting_master_connection')
                ->defaultValue('mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB')
                ->end()
            ->scalarNode('setting_slave_connection')
                ->defaultValue('mysql://username:password@127.0.0.1:3306/databseName?charset=utf8mb4&serverVersion=10.5.8-MariaDB')
                ->end()

            // Cron Settings
            ->integerNode('setting_cron_on_off')
                ->defaultValue("0")               // "1" or "0" string
                ->end()
            ->scalarNode('setting_cron_time')
                ->defaultValue("03:00")         // (HH:mm)
                ->end()


            // Way to Sync
            ->integerNode('setting_way_to_go')
                ->defaultValue(1)
                ->info('1: Master -> Slave, 2: Master <- Slave, 3: Master <-> Slave')
                ->end()
        ->end();

        return $treeBuilder;
    }
}