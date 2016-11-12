<?php


namespace Drupal\tfs_system_tags\TagFinder;


use Drupal\Core\Entity\Query\QueryFactory;

abstract class AbstractTagFinder implements TagFinderInterface {

  /**
   * @var QueryFactory
   */
  protected $queryFactory;


  /**
   * AbstractTagFinder constructor.
   *
   * @param QueryFactory $query_factory
   */
  public function __construct(QueryFactory $query_factory) {
    $this->queryFactory = $query_factory;
  }

  /**
   * {@inheritdoc}
   */
  abstract public function findByTag($tag_id);

  /**
   * {@inheritdoc}
   */
  abstract public function getEntityType();
}