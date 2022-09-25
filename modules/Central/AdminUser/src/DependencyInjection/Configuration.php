<?php

namespace Central\AdminUser\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

	public function getConfigTreeBuilder()
	{
		$treeBuilder = new TreeBuilder('sso_admin_user');
		/** @var ArrayNodeDefinition $rootNode */
		$rootNode = $treeBuilder->getRootNode();

		return $treeBuilder;
	}
}