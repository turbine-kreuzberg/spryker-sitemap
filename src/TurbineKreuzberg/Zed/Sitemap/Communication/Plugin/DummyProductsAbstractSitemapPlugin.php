<?php

namespace TurbineKreuzberg\Zed\Sitemap\Communication\Plugin;

use Generator;
use TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface;

class DummyProductsAbstractSitemapPlugin implements SitemapPluginInterface
{
 /**
  * @return void
  */
    public function readValue(): Generator
    {
        $data = [
            [
                'url' => '/en/canon-legria-hf-g25-184',
                'updated_at' => '2023-09-29 12:12:50',
            ],
            [
                'url' => '/en/sony-xperia-sgp512e1-183',
                'updated_at' => '2023-09-29 12:12:50',
            ],
            [
                'url' => '/en/samsung-galaxy-view-sm-t670-182',
                'updated_at' => '2023-09-29 12:12:50',
            ],
        ];

        foreach ($data as $value) {
            yield $value;
        }
    }

    public function getName(): string
    {
        return 'dummy-abstract-sitemap';
    }
}
