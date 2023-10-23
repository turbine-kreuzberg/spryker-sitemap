<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business;

interface SitemapFacadeInterface
{
    /**
     * @param string|null $name
     *
     * @return void
     */
    public function generateSitemap(?string $name): void;

    /**
     * @return void
     */
    public function generateIndex(): void;
}
