<?php

namespace Pyz\Zed\Url\Business;

use Generator;
use Spryker\Zed\Url\Business\UrlFacadeInterface as SprykerUrlFacadeInterface;

interface UrlFacadeInterface extends SprykerUrlFacadeInterface
{
    /**
     * @return \Generator
     */
    public function getCategoryUrls(): Generator;
}
