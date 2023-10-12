<?php

namespace Pyz\Zed\Url\Persistence;

use Generator;
use PDO;
use Propel\Runtime\Propel;
use Spryker\Zed\Url\Persistence\UrlRepository as SprykerUrlRepository;

/**
 * @method \Pyz\Zed\Url\Persistence\UrlPersistenceFactory getFactory()
 */
class UrlRepository extends SprykerUrlRepository implements UrlRepositoryInterface
{
     /**
      * @return \Generator
      */
    public function getCategoryUrls(): Generator
    {
        $currentLocale = $this->getFactory()->getLocaleFacade()->getCurrentLocale();

        $sqlString = $this->getProductConcreteSitemapSqlString();

        $pdo = Propel::getConnection();
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $pdo->prepare($sqlString);
        $statement->bindValue(':p0', $currentLocale->getIdLocale());
        $statement->execute();

        while ($row = $statement->fetch()) {
            yield $row;
        }
    }

    /**
     * @return string
     */
    protected function getProductConcreteSitemapSqlString(): string
    {
        return 'select url from spy_url where fk_locale = :p0 and fk_resource_categorynode is not null and fk_resource_redirect is null ;';
    }
}
