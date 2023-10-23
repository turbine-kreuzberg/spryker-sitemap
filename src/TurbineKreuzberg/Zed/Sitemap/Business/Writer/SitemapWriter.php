<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

use TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilderInterface;
use TurbineKreuzberg\Zed\Sitemap\Exception\InvalidArgumentException;
use TurbineKreuzberg\Zed\Sitemap\SitemapConfig;

class SitemapWriter implements SitemapWriterInterface
{
    private bool $generated = false;

    /**
     * @var \TurbineKreuzberg\Zed\Sitemap\Business\Builder\SitemapBuilderInterface
     */
    private SitemapBuilderInterface $builder;

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
     * @param string|null $name
     *
     * @throws \TurbineKreuzberg\Zed\Sitemap\Exception\InvalidArgumentException
     *
     * @return void
     */
    public function writeSitemap(?string $name): void
    {
        foreach ($this->plugins as $plugin) {
            if ($name !== null && $plugin->getName() !== $name) {
                continue;
            }

            $Sitemap = $this->builder->buildSitemap($plugin);
            file_put_contents($this->getFullPath($plugin->getName()), gzencode($Sitemap));
            $this->generated = true;
        }

        if ($this->generated === false) {
            throw new InvalidArgumentException('No sitemap generated. Either no plugins are registered or the plugin name is invalid.');
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
