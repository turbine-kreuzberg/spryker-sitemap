<?php

namespace TurbineKreuzberg\Zed\Sitemap\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface getFacade()
 */
class SitemapIndexConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'sitemap:index:generate';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Generate sitemap index (do not forget to generate sitemaps first).';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $this->getFacade()->generateIndex();

            $output->writeln('Sitemap was successfully generated.');

            return static::CODE_SUCCESS;
        } catch (Exception $exception) {
            $output->writeln(sprintf('Sitemap could not be generated. Reason: %s', $exception->getMessage()));

            return static::CODE_ERROR;
        }
    }
}
