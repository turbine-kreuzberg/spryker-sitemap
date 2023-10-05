<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

interface SitemapWriterInterface
{
    /**
     * @return void
     */
    public function writeSitemap(): void;
}
