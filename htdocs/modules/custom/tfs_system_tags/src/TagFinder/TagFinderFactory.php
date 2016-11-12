<?php


namespace Drupal\tfs_system_tags\TagFinder;


use Drupal\Component\Plugin\Exception\PluginNotFoundException;

class TagFinderFactory implements TagFinderFactoryInterface {

  /**
   * @var TagFinderInterface[]
   */
  protected $tagFinders;


  /**
   * {@inheritdoc}
   */
  public function addTagFinder(TagFinderInterface $tag_finder) {
    $this->tagFinders[$tag_finder->getEntityType()] = $tag_finder;
  }

  /**
   * {@inheritdoc}
   */
  public function getTagFinder($entity_type) {
    if (isset($this->tagFinders[$entity_type]) && $this->tagFinders[$entity_type] instanceof TagFinderInterface) {
      return $this->tagFinders[$entity_type];
    }

    throw new PluginNotFoundException('tag_finder', sprintf('No TagFinder found for entity type "%s"', $entity_type));
  }
}