<?php


namespace Drupal\tfs_system_tags\TagFinder;


use Drupal\Core\Entity\EntityInterface;

interface TagFinderInterface {

  /**
   * Find an entity by tag id.
   *
   * @param string $tag_id
   *
   * @return EntityInterface|NULL
   */
  public function findByTag($tag_id);

  /**
   * Get the entity type for which for this TagFinder is applicable.
   *
   * @return string
   */
  public function getEntityType();
}