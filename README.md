# spryker-sitemap

Module generates sitemap according to the [sitemap protocol](https://www.sitemaps.org/protocol.html).

## Usage

To use the provided console commands you will need to register TurbineKreuzberg namespace in your `config_default.php`.

```php

$config[KernelConstants::CORE_NAMESPACES] = [
    // add TurbineKreuzberg as a core namespace
    'TurbineKreuzberg',
];
```

In `ConsoleDependencyProvider` you need to add Sitemap consoles that you want to use.

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

If everything is working properly you should see sitemap section in your
```text
 sitemap
  sitemap:generate        Generate sitemap for all active products.
  sitemap:index:generate  Generate sitemap index (do not forget to generate sitemaps first).
```

## Sitemap plugins

In order for console commands to do anything you will need to register at least one sitemap plugin in `SitemapDependencyProvider`. Plugins need to implement
`\TurbineKreuzberg\Zed\Sitemap\Dependency\Plugin\SitemapPluginInterface`


### Technical considerations
Sitemap generation can be resource intensive and that is why we can use [generators](https://www.php.net/manual/en/language.generators.php) to reduce the memory usage.
ORMs should be avoided for bulk operations and Propel provides access to underline [PDO](https://www.php.net/manual/en/book.pdo.php) and
we can utilize [PDOStatement::fetch](https://www.php.net/manual/en/pdostatement.fetch.php) to iterate through database records to save the memory.


### Example plugin

In the [documentation folder](./documentation) you can find a fully implemented [CategorySitemapPlugin](./documentation/src/Pyz/Zed/Url/Communication/Plugin/Sitemap/CategorySitemapPlugin.php)
that will call url module to retrieve all the URLs for categories. You can find all the necessary changed in the project corresponding folders.


## Extending the module functionality

## A word about sitemaps

Sitemap standard comes with some [limitations](https://www.sitemaps.org/faq.html#faq_sitemap_size) that we need to consider.
Probably most crucial is that you can have 50k links in one sitemap. If you have more than that you need to create sitemap index and multiple sitemaps. When you create your plugins you need to take that into account.

### Sitemap index example

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

## Testing

### Checking for code style violations

#### Sniffing
`vendor/bin/phpcs --standard=vendor/spryker/code-sniffer/Spryker/ruleset.xml ./src`

#### Fixing of automatically fixable errors
`vendor/bin/phpcbf --standard=vendor/spryker/code-sniffer/Spryker/ruleset.xml ./src`

### PHPStan
`vendor/bin/phpstan`
