<?php

namespace Cuaround\SiteBundle\Entity\Repositories;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Pagerfanta,
    Pagerfanta\Adapter\DoctrineORMAdapter,
    Pagerfanta\Exception\NotValidCurrentPageException,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * ConversationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BaseRepository extends EntityRepository
{
    protected function getResult(\Doctrine\ORM\QueryBuilder $qb, $paginate = false) {
        //$query = $qb->getQuery();
        //$query->useResultCache(true);
        if($paginate) {
            return new Pagerfanta(new DoctrineORMAdapter($qb));
        } else {
            return $qb->getQuery()->getResult();
        }
    }
}