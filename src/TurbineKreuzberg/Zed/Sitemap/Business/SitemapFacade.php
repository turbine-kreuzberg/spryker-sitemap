<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \TurbineKreuzberg\Zed\Sitemap\Business\SitemapBusinessFactory getFactory()
 */
class SitemapFacade extends AbstractFacade implements SitemapFacadeInterface
{
    /**
     * @return void
     */
    public function generateSitemap(): void
    {
        $this->getFactory()->createSitemapWriter()->writeSitemap();
    }

    /**
     * @return void
     */
    public function generateIndex(): void
    {
        $this->getFactory()->createIndexWriter()->writeIndex();
    }
}
