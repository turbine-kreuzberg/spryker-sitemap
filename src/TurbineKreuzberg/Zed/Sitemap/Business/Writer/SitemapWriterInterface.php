<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

interface SitemapWriterInterface
{
    /**
     * @param string|null $name
     *
     * @return void
     */
    public function writeSitemap(?string $name): void;
}
