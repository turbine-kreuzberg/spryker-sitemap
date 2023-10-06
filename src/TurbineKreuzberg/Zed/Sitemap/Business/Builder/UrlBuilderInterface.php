<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

interface UrlBuilderInterface
{
    /**
     * @param string $url
     *
     * @return string
     */
    public function buildUrl(string $url): string;
}
