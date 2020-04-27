<?php

namespace KproKGB\LongmanTelegramBotApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder('longman_telegram_bot_api');
        $rootNode = $builder->getRootNode();

        $rootNode
            ->children()
            ->arrayNode('bots')
            ->useAttributeAsKey('name')
            ->prototype('array')
            ->children()
            ->scalarNode('token')->isRequired()->end()
            ->booleanNode('without_db')->defaultFalse()->end()
            ->scalarNode('hook_url')->defaultNull()->end()
            ->end()
            ->end()
            ->end()
            ->scalarNode('default')->defaultNull()->end()
            ->scalarNode('proxy')->defaultNull()->end()
            ->arrayNode('development')
            ->children()
            ->arrayNode('developers_id')->prototype('scalar')->end()
            ->end()
            ->arrayNode('maintenance')
            ->children()
            ->booleanNode('enable')->defaultFalse()->end()
            ->scalarNode('text')->defaultValue('The robot is being repaired! Please come back later.')->end()
            ->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $builder;
    }

}
