<?php

namespace Central\AdminUser;

use Central\AdminUser\DependencyInjection\AdminUserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AdminUserBundle extends Bundle
{
	public function getContainerExtension(): ?\Symfony\Component\DependencyInjection\Extension\ExtensionInterface
	{
		if (!$this->extension) {
			$this->extension = new AdminUserExtension();
		}
		return $this->extension;
	}

	public function getPath(): string
	{
		return \dirname(__DIR__);
	}
}