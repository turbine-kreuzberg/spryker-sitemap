<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \TurbineKreuzberg\Zed\Sitemap\Business\SitemapBusinessFactory getFactory()
 */
class SitemapFacade extends AbstractFacade implements SitemapFacadeInterface
{
    /**
     * @param string|null $name
     *
     * @return void
     */
    public function generateSitemap(?string $name): void
    {
        $this->getFactory()->createSitemapWriter()->writeSitemap($name);
    }

    /**
     * @return void
     */
    public function generateIndex(): void
    {
        $this->getFactory()->createIndexWriter()->writeIndex();
    }
}
