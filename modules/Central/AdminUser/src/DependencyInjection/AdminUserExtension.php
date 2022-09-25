<?php

namespace Central\AdminUser\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AdminUserExtension extends Extension
{

	public function load(array $configs, \Symfony\Component\DependencyInjection\ContainerBuilder $container)
	{
		$loader = new YamlFileLoader(
			$container,
			new FileLocator(__DIR__ . '/../../config/')
		);
		$loader->load('services.yaml');

		$configuration = $this->getConfiguration($configs, $container);

		$config = $this->processConfiguration($configuration, $configs);
	}

	public function getAlias(): string
	{
		return 'central_admin_user';
	}
}