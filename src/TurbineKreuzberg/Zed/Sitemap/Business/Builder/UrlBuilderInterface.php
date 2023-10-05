<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

interface UrlBuilderInterface
{
    public function buildUrl(string $url): string;
}
