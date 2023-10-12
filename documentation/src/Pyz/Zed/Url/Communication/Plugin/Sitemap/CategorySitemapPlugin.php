<?php

namespace Pyz\Zed\Url\Communication\Plugin\Sitemap;

use Generator;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;

/**
 * @method \Pyz\Zed\Url\Business\UrlFacadeInterface getFacade()
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 * @method \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface getQueryContainer()
 */
class CategorySitemapPlugin extends AbstractPlugin implements SitemapPluginInterface
{
    /**
     * @return \Generator
     */
    public function readValue(): Generator
    {
        return $this->getFacade()->getCategoryUrls();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'category-sitemap';
    }
}
