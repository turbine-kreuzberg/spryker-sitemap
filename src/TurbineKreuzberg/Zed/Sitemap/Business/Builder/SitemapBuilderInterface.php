<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;

interface SitemapBuilderInterface
{
    public function buildSitemap(SitemapPluginInterface $plugin): string|bool;
}
