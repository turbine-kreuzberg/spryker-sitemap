<?php

namespace Pyz\Zed\Url;

use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use Spryker\Zed\Navigation\Communication\Plugin\DetachNavigationUrlAfterUrlDeletePlugin;
use Spryker\Zed\Url\UrlDependencyProvider as SprykerUrlDependencyProvider;

class UrlDependencyProvider extends SprykerUrlDependencyProvider
{
    /**
     * @var string
     */
    public const PYZ_FACADE_LOCAL = 'PYZ_FACADE_LOCAL';


    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);

        $container->set(static::PYZ_FACADE_LOCAL, function (Container $container): LocaleFacadeInterface {
            return $container->getLocator()->locale()->facade();
        });

        return $container;
    }
}
