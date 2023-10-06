<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use TurbineKreuzberg\Zed\Sitemap\Business\Builder\IndexBuilder;
use TurbineKreuzberg\Zed\Sitemap\Business\Builder\IndexBuilderInterface;
use TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilder;
use TurbineKreuzberg\Zed\Sitemap\Business\Builder\UrlBuilder;
use TurbineKreuzberg\Zed\Sitemap\Business\Writer\IndexWriter;
use TurbineKreuzberg\Zed\Sitemap\Business\Writer\IndexWriterInterface;
use TurbineKreuzberg\Zed\Sitemap\Business\Writer\SitemapWriter;
use TurbineKreuzberg\Zed\Sitemap\Business\Writer\SitemapWriterInterface;
use TurbineKreuzberg\Zed\Sitemap\SitemapDependencyProvider;

/**
 * @method \TurbineKreuzberg\Zed\Sitemap\SitemapConfig getConfig()
 */
class SitemapBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \TurbineKreuzberg\Zed\Sitemap\Business\Writer\SitemapWriterInterface
     */
    public function createSitemapWriter(): SitemapWriterInterface
    {
        return new SitemapWriter(
            $this->getConfig(),
            $this->createSitemapBuilder(),
            $this->getSitemapPlugins(),
        );
    }

    /**
     * @return \TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilder
     */
    public function createSitemapBuilder(): SitemapBuilder
    {
        return new SitemapBuilder(
            $this->createUrlBuilder(),
        );
    }

    /**
     * @return \TurbineKreuzberg\Zed\Sitemap\Business\Writer\IndexWriterInterface
     */
    public function createIndexWriter(): IndexWriterInterface
    {
        return new IndexWriter(
            $this->getConfig(),
            $this->createIndexBuilder(),
        );
    }

    /**
     * @return \TurbineKreuzberg\Zed\Sitemap\Business\Builder\IndexBuilderInterface
     */
    private function createIndexBuilder(): IndexBuilderInterface
    {
        return new IndexBuilder($this->getConfig(), $this->getSitemapPlugins());
    }

    /**
     * @return \TurbineKreuzberg\Zed\Sitemap\Business\Builder\UrlBuilder
     */
    public function createUrlBuilder(): UrlBuilder
    {
        return new UrlBuilder($this->getConfig());
    }

    /**
     * @return array
     */
    private function getSitemapPlugins(): array
    {
        return $this->getProvidedDependency(SitemapDependencyProvider::PLUGINS_SITEMAP);
    }
}
