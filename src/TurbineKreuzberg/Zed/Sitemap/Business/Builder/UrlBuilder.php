<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

use TurbineKreuzberg\Zed\Sitemap\SitemapConfig;

class UrlBuilder implements UrlBuilderInterface
{
    /**
     * @var \TurbineKreuzberg\Zed\Sitemap\SitemapConfig
     */
    private SitemapConfig $configuration;

    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\SitemapConfig $configuration
     */
    public function __construct(SitemapConfig $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function buildUrl(string $url): string
    {
        $protocol = 'http';

        if ($this->configuration->getIsSSLEnabled()) {
            $protocol = 'https';
        }

        return sprintf('%s//%s%s', $protocol, $this->configuration->getHostname(), $url);
    }
}
