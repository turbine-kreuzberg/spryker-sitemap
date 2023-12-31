<?php

namespace TurbineKreuzberg\Zed\Sitemap;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use TurbineKreuzberg\Shared\Sitemap\SitemapConstants;

class SitemapConfig extends AbstractBundleConfig
{
 /**
  * @return string
  */
    public function getHostname(): string
    {
        return $this->get(SitemapConstants::PUBLIC_HOSTNAME, 'www.example.com');
    }

    /**
     * @return string
     */
    public function getSitemapIndexFilename(): string
    {
        return $this->get(SitemapConstants::INDEX_FILENAME, 'sitemap_index.xml');
    }

    /**
     * @return bool
     */
    public function getIsSSLEnabled(): bool
    {
        return $this->get(SitemapConstants::IS_SSL_ENABLED, true);
    }

    /**
     * @return string
     */
    public function getSitemapFolderPath(): string
    {
        return $this->get(SitemapConstants::SITEMAP_FOLDER_PATH, '/tmp');
    }
}
