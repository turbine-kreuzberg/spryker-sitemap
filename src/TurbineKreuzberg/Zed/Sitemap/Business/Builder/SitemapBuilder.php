<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

use SimpleXMLElement;
use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;

class SitemapBuilder implements SitemapBuilderInterface
{
    /**
     * @var string
     */
    protected const XML_TAG_WITH_ENCODING = '<?xml version="1.0" encoding="UTF-8"?>';

    /**
     * @var string
     */
    protected const XML_URL_SET_TAG_WITH_NAMESPACE = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"></urlset>';

    /**
     * @var string
     */
    protected const XML_URL_KEY = 'url';

    /**
     * @var string
     */
    protected const XML_LOC_KEY = 'loc';

    /**
     * @var string
     */
    protected const XML_LASTMOD_KEY = 'lastmod';

    private UrlBuilderInterface $urlBuilder;

    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\Business\Builder\UrlBuilder $urlBuilder
     */
    public function __construct(UrlBuilderInterface $urlBuilder)
    {
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface $plugin
     *
     * @return string|bool
     */
    public function buildSitemap(SitemapPluginInterface $plugin): string|bool
    {
        $xmlUrlSetObject = $this->createSimpleXMLElement();

        foreach ($plugin->readValue() as $value) {
            $xmlUrlChildObject = $xmlUrlSetObject->addChild(static::XML_URL_KEY);
            $xmlUrlChildObject->addChild(
                static::XML_LOC_KEY,
                $this->urlBuilder->buildUrl($value['url']),
            );
        }

        return $xmlUrlSetObject->asXML();
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function createSimpleXMLElement(): SimpleXMLElement
    {
        return new SimpleXMLElement(static::XML_TAG_WITH_ENCODING . static::XML_URL_SET_TAG_WITH_NAMESPACE);
    }
}
