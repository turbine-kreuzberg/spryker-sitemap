<?php

namespace TurbineKreuzberg\Zed\Sitemap;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use TurbineKreuzberg\Zed\Sitemap\Communication\Plugin\DummyProductsAbstractSitemapPlugin;

class SitemapDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const PLUGINS_SITEMAP = 'PLUGINS_SITEMAP';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addSitemaplugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSitemaplugins(Container $container): Container
    {
        $container->set(static::PLUGINS_SITEMAP, function (): array {
            return $this->getSitemapPlugins();
        });

        return $container;
    }

    /**
     * @return array<\Spryker\Shared\ApplicationExtension\Dependency\Plugin\ApplicationPluginInterface>
     */
    protected function getSitemapPlugins(): array
    {
        return [new DummyProductsAbstractSitemapPlugin()];
    }
}
