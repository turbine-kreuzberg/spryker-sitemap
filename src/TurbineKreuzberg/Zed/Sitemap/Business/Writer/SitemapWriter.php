<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

use TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilderInterface;
use TurbineKreuzberg\Zed\Sitemap\SitemapConfig;

class SitemapWriter implements SitemapWriterInterface
{
    protected SitemapBuilderInterface $builder;

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
     * @param \TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilderInterface $builder
     * @param \TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface[] $plugins
     */
    public function __construct(
        SitemapConfig $configuration,
        SitemapBuilderInterface $builder,
        array $plugins
    ) {
        $this->configuration = $configuration;
        $this->plugins = $plugins;
        $this->builder = $builder;
    }

    /**
     * @return void
     */
    public function writeSitemap(): void
    {
        foreach ($this->plugins as $plugin) {
            $Sitemap = $this->builder->buildSitemap($plugin);
            file_put_contents($this->getFullPath($plugin->getName()), gzencode($Sitemap));
        }
    }

    /**
     * @param string $fileName
     *
     * @return string
     */
    protected function getFullPath(string $fileName): string
    {
        return sprintf(
            '%s/%s.xml.gz',
            rtrim($this->configuration->getSitemapFolderPath(), '/'),
            $fileName,
        );
    }
}
