<?php

namespace Pyz\Zed\Url\Persistence;

use Pyz\Zed\Url\UrlDependencyProvider;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Url\Persistence\UrlPersistenceFactory as SprykerUrlPersistenceFactory;

/**
 * @method \Spryker\Zed\Url\UrlConfig getConfig()
 * @method \Pyz\Zed\Url\Persistence\UrlRepositoryInterface getRepository()
 * @method \Spryker\Zed\Url\Persistence\UrlQueryContainerInterface getQueryContainer()
 */
class UrlPersistenceFactory extends SprykerUrlPersistenceFactory
{
 /**
  * @return \Spryker\Zed\Locale\Business\LocaleFacadeInterface
  */
    public function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getProvidedDependency(UrlDependencyProvider::PYZ_FACADE_LOCAL);
    }
}
