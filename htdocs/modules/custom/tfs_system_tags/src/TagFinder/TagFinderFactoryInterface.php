<?php


namespace Drupal\tfs_system_tags\TagFinder;


interface TagFinderFactoryInterface {

  /**
   * Adds a TagFinder
   *
   * @param TagFinderInterface $tag_finder
   */
  public function addTagFinder(TagFinderInterface $tag_finder);

  /**
   * Get a TagFinder by entity type.
   *
   * @param string $entity_type
   *
   * @return TagFinderInterface
   */
  public function getTagFinder($entity_type);

}