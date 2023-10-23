<?php

namespace TurbineKreuzbergTest\Zed\Sitemap\Business;

use Codeception\Test\Unit;
use DOMDocument;
use TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacade;
use TurbineKreuzberg\Zed\Sitemap\Exception\InvalidArgumentException;

class SitemapFacadeTest extends Unit
{
 /**
  * @var \TurbineKreuzbergTest\Zed\Sitemap\SitemapBusinessTester
  */
    protected $tester;

    /**
     * @return void
     */
    protected function _after()
    {
        if (file_exists('/tmp/dummy-abstract-sitemap.xml.gz')) {
            unlink('/tmp/dummy-abstract-sitemap.xml.gz');
        }
    }

    /**
     * @return void
     */
    public function testIndexCreation()
    {
        /** @var \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface $facade */
        $facade = $this->tester->getLocator()->sitemap()->facade();

        $this->assertInstanceOf(SitemapFacade::class, $facade);

        codecept_debug(print_r($facade, true));

        $facade->generateIndex();

        $this->validateSitemapIndexAgainstXsdSchema('/tmp/sitemap_index.xml');
    }

    /**
     * @return void
     */
    public function testSitemapCreation()
    {
        /** @var \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface $facade */
        $facade = $this->tester->getLocator()->sitemap()->facade();

        $this->assertInstanceOf(SitemapFacade::class, $facade);

        codecept_debug(print_r($facade, true));

        $facade->generateSitemap(null);

        $this->validateSitemapAgainstXsdSchema('/tmp/dummy-abstract-sitemap.xml.gz');
    }

    /**
     * @return void
     */
    public function testSingleSitemapCreation()
    {
        /** @var \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface $facade */
        $facade = $this->tester->getLocator()->sitemap()->facade();

        $this->assertInstanceOf(SitemapFacade::class, $facade);

        $facade->generateSitemap('dummy-abstract-sitemap');

        $this->validateSitemapAgainstXsdSchema('/tmp/dummy-abstract-sitemap.xml.gz');
    }

    /**
     * @return void
     */
    public function testSingleSitemapCreationFailsDueToInvalidName()
    {
        /** @var \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface $facade */
        $facade = $this->tester->getLocator()->sitemap()->facade();

        $this->assertInstanceOf(SitemapFacade::class, $facade);

        $this->expectException(InvalidArgumentException::class);

        $facade->generateSitemap('invalid-name');


    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    private function validateSitemapIndexAgainstXsdSchema(string $filePath): void
    {
        $doc = new DOMDocument();
        $doc->load($filePath);

        $result = $doc->schemaValidate(__DIR__ . '/../_support/XSD/sitemaps.org_schemas_sitemap_0.9_siteindex.xsd.xml');

        $this->assertTrue($result, sprintf('Sitemap index %s is valid', $filePath));
    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    private function validateSitemapAgainstXsdSchema(string $filePath): void
    {
        codecept_debug($filePath);

        $this->unzipFile($filePath);

        $doc = new DOMDocument();
        $doc->load(str_replace('.gz', '', $filePath));

        $result = $doc->schemaValidate(__DIR__ . '/../_support/XSD/sitemaps.org_schemas_sitemap_0.9_sitemap.xsd.xml');

        $this->assertTrue($result, sprintf('Sitemap %s is valid', $filePath));
    }

    /**
     * @param string $filePath
     *
     * @return void
     */
    private function unzipFile(string $filePath): void
    {
        // Raising this value may increase performance
        $buffer_size = 4096; // read 4kb at a time
        $out_file_name = str_replace('.gz', '', $filePath);

        // Open our files (in binary mode)
        $file = gzopen($filePath, 'rb');
        $out_file = fopen($out_file_name, 'wb');

        // Keep repeating until the end of the input file
        while (!gzeof($file)) {
            // Read buffer-size bytes
            // Both fwrite and gzread and binary-safe
            fwrite($out_file, gzread($file, $buffer_size));
        }

        // Files are done, close files
        fclose($out_file);
        gzclose($file);
    }
}
