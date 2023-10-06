<?php

namespace TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin;

use Generator;

interface SitemapPluginInterface
{
    /**
     * @return \Generator
     */
    public function readValue(): Generator;

    /**
     * @return string
     */
    public function getName(): string;
}
