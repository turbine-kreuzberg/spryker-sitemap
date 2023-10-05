<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

use RuntimeException;
use TurbineKreuzberg\Zed\Sitemap\Business\Builder\IndexBuilderInterface;
use TurbineKreuzberg\Zed\Sitemap\SitemapConfig;

class IndexWriter implements IndexWriterInterface
{
    /**
     * @var string
     */
    public const EXCEPTION_MESSAGE_SITEMAP_INDEX_WAS_NOT_CREATED = 'Sitemap index could not be created.';

    private IndexBuilderInterface $indexBuilder;

    private SitemapConfig $sitemapConfig;

    /**
     * @param \TurbineKreuzberg\Zed\Sitemap\SitemapConfig $sitemapConfig
     * @param \TurbineKreuzberg\Zed\Sitemap\Business\Builder\IndexBuilderInterface $indexBuilder
     */
    public function __construct(SitemapConfig $sitemapConfig, IndexBuilderInterface $indexBuilder)
    {
        $this->sitemapConfig = $sitemapConfig;
        $this->indexBuilder = $indexBuilder;
    }

    /**
     * @throws \RuntimeException
     *
     * @return void
     */
    public function writeIndex(): void
    {
        $index = $this->indexBuilder->buildIndex();
        if (is_bool($index)) {
            throw new RuntimeException(static::EXCEPTION_MESSAGE_SITEMAP_INDEX_WAS_NOT_CREATED);
        }

        file_put_contents($this->getFullPath(), $index);
    }

    /**
     * @return string
     */
    protected function getFullPath(): string
    {
        return sprintf(
            '%s/%s',
            rtrim($this->sitemapConfig->getSitemapFolderPath(), '/'),
            $this->sitemapConfig->getSitemapIndexFilename(),
        );
    }
}
