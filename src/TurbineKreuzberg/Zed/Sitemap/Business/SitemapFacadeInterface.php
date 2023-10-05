<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business;

interface SitemapFacadeInterface
{
    /**
     * @return void
     */
    public function generateSitemap(): void;

    /**
     * @return void
     */
    public function generateIndex(): void;
}
