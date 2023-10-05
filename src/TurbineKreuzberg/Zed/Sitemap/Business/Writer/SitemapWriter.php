<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

use TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilderInterface;
use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;
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
     * @param SitemapConfig $configuration
     * @param SitemapBuilderInterface $builder
     * @param SitemapPluginInterface[] $plugins
     */
    public function __construct(
        SitemapConfig $configuration,
        SitemapBuilderInterface $builder,
        array $plugins,
    ) {
        $this->configuration = $configuration;
        $this->plugins = $plugins;
        $this->builder = $builder;
    }

    /**
     * @throws \RuntimeException
     *
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
