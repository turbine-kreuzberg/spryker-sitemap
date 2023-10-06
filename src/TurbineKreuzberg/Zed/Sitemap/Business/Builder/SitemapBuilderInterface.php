<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;

interface SitemapBuilderInterface
{
    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface $plugin
     *
     * @return string|bool
     */
    public function buildSitemap(SitemapPluginInterface $plugin): string|bool;
}
