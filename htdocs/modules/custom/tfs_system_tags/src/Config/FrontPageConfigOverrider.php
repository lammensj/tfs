<?php


namespace Drupal\tfs_system_tags\Config;


use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;
use Drupal\tfs_system_tags\TagFinder\TagFinderFactoryInterface;
use Drupal\tfs_system_tags\TagFinder\TagFinderInterface;
use Drupal\node\NodeInterface;

class FrontPageConfigOverrider implements ConfigFactoryOverrideInterface {

  /**
   * @var TagFinderInterface
   */
  protected $systemTagFinder;


  /**
   * FrontPageConfigOverrider constructor.
   *
   * @param TagFinderFactoryInterface $tag_finder_factory
   */
  public function __construct(TagFinderFactoryInterface $tag_finder_factory) {
    $this->systemTagFinder = $tag_finder_factory->getTagFinder('node');
  }

  /**
   * {@inheritdoc}
   */
  public function loadOverrides($names) {
    $overrides = [];
    if (in_array('system.site', $names)) {
      $node = $this->systemTagFinder
        ->findByTag(SystemTagDefinitions::TAG_HOMEPAGE);
      if ($node) {
        $overrides['system.site'] = [
          'page' => [
            'front' => sprintf('/%s', $node->toUrl()->getInternalPath())
          ]
        ];
      }
    }

    return $overrides;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheSuffix() {
    return 'TFSSystemTagsOverrider';
  }

  /**
   * {@inheritdoc}
   */
  public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheableMetadata($name) {
    return new CacheableMetadata();
  }
}