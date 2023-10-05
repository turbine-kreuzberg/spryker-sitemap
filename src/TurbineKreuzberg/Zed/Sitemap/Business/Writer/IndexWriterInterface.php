<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Writer;

interface IndexWriterInterface
{
    /**
     * @return void
     */
    public function writeIndex(): void;

}
