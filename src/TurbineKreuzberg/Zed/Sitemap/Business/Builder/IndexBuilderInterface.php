<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

interface IndexBuilderInterface
{
    /**
     * @return string|bool
     */
    public function buildIndex(): string|bool;
}
