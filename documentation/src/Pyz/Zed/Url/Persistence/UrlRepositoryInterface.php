<?php

namespace Pyz\Zed\Url\Persistence;

use Generator;
use Spryker\Zed\Url\Persistence\UrlRepositoryInterface as SprykerUrlRepositoryInterface;

interface UrlRepositoryInterface extends SprykerUrlRepositoryInterface
{
    /**
     * @return \Generator
     */
    public function getCategoryUrls(): Generator;
}
