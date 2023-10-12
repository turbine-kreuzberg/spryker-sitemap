<?php

namespace Pyz\Zed\Url\Business;

use Generator;
use Spryker\Zed\Url\Business\UrlFacade as SprykerUrlFacade;

/**
 * @method \Spryker\Zed\Url\Business\UrlBusinessFactory getFactory()
 * @method \Pyz\Zed\Url\Persistence\UrlRepositoryInterface getRepository()
 */
class UrlFacade extends SprykerUrlFacade implements UrlFacadeInterface
{
    /**
     * @return \Generator
     */
    public function getCategoryUrls(): Generator
    {
        return $this->getRepository()->getCategoryUrls();
    }
}
