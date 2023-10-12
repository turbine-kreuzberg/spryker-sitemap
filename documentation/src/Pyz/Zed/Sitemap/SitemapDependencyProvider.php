<?php

use Pyz\Zed\Url\Communication\Plugin\Sitemap\CategorySitemapPlugin;
use TurbineKreuzberg\Zed\Sitemap\SitemapDependencyProvider as TurbineSitemapDependencyProvider;

class SitemapDependencyProvider extends TurbineSitemapDependencyProvider
{
    /**
     * @return array<\TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface>
     */
    protected function getSitemapPlugins(): array
    {
        return [
            new CategorySitemapPlugin(),
        ];
    }
}
