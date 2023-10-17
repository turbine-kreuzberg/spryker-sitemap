<?php

namespace Pyz\Zed\Console;

use Spryker\Zed\Console\ConsoleDependencyProvider as SprykerConsoleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use TurbineKreuzberg\Zed\Sitemap\Communication\Console\SitemapConsole;
use TurbineKreuzberg\Zed\Sitemap\Communication\Console\SitemapIndexConsole;

class ConsoleDependencyProvider extends SprykerConsoleDependencyProvider
{
    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getConsoleCommands(Container $container)
    {
        return [
            new SitemapIndexConsole(),
            new SitemapConsole(),
        ];
    }
}
