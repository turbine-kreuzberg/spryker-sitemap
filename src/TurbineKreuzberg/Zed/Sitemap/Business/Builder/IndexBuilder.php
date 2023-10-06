<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

use SimpleXMLElement;
use TurbineKreuzberg\Zed\Sitemap\SitemapConfig;

class IndexBuilder implements IndexBuilderInterface
{
    /**
     * @var string
     */
    protected const XML_TAG_WITH_ENCODING = '<?xml version="1.0" encoding="UTF-8"?>';

    /**
     * @var string
     */
    protected const XML_URL_SET_TAG_WITH_NAMESPACE = '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></sitemapindex>';

    /**
     * @var string
     */
    protected const XML_LOC_KEY = 'loc';

    /**
     * @var string
     */
    protected const XML_SITEMAP_KEY = 'sitemap';

    /**
     * @var \TurbineKreuzberg\Zed\Sitemap\SitemapConfig
     */
    private SitemapConfig $configuration;

    /**
     * @var \TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface[]
     */
    private array $plugins;

    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\SitemapConfig $configuration
     * @param \TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface[] $plugins
     */
    public function __construct(SitemapConfig $configuration, array $plugins)
    {
        $this->configuration = $configuration;
        $this->plugins = $plugins;
    }

    /**
     * @return string|bool
     */
    public function buildIndex(): string|bool
    {
        $xmlUrlSetObject = new SimpleXMLElement(static::XML_TAG_WITH_ENCODING . static::XML_URL_SET_TAG_WITH_NAMESPACE);

        foreach ($this->plugins as $plugin) {
            $xmlUrlChildObject = $xmlUrlSetObject->addChild(static::XML_SITEMAP_KEY);
            $xmlUrlChildObject->addChild(
                static::XML_LOC_KEY,
                sprintf('%s/%s.xml.gz', rtrim($this->configuration->getHostname(), '/'), $plugin->getName()),
            );
        }

        return $xmlUrlSetObject->asXML();
    }
}
