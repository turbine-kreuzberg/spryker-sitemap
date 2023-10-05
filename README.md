# spryker-sitemap

Sitemap index

```xml
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc>https://www.example.com/sitemap1.xml.gz</loc>
  </sitemap>
  <sitemap>
    <loc>https://www.example.com/sitemap2.xml.gz</loc>
  </sitemap>
</sitemapindex>
```


```php

$config[KernelConstants::CORE_NAMESPACES] = [
    // add TurbineKreuzberg as a core namespace
    'TurbineKreuzberg',
];
```

In `ConsoleDependencyProvider` add

```php
use Shared\Zed\Sitemap\Communication\Console\SitemapConsole;use Shared\Zed\Sitemap\Communication\Console\SitemapIndexConsole;

    protected function getConsoleCommands(Container $container): array
    {
        $commands = [
            // ...

            new SitemapIndexConsole(),
            new SitemapConsole(),
        ];
```
