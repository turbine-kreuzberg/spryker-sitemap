<?php

namespace TurbineKreuzberg\Zed\Sitemap\Business\Builder;

interface IndexBuilderInterface
{
    public function buildIndex(): string|bool;
}
