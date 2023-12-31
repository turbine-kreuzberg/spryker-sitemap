<?php

namespace TurbineKreuzberg\Zed\Sitemap\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \TurbineKreuzberg\Zed\Sitemap\Business\SitemapFacadeInterface getFacade()
 */
class SitemapConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'sitemap:generate';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Generate sitemap(s).';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addArgument('name', InputArgument::OPTIONAL, 'Name of the sitemap you want to generate');
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
            $name = $input->getArgument('name');

            $this->getFacade()->generateSitemap($name);

            $output->writeln('Sitemap was successfully generated.');

            return static::CODE_SUCCESS;
        } catch (Exception $exception) {
            $output->writeln(sprintf('Sitemap could not be generated. Reason: %s', $exception->getMessage()));

            return static::CODE_ERROR;
        }
    }
}
