<?php

namespace TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin;

use Generator;

interface SitemapPluginInterface
{
    public function readValue(): Generator;

    public function getName(): string;
}
