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
                ->scalarNode('sync_mode')->defaultValue('one-way')->end()
            ->end()
        ->end();

        return $treeBuilder;
    }
}