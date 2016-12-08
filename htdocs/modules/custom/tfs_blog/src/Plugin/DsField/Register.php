<?php


namespace Drupal\tfs_blog\Plugin\DsField;


use Drupal\ds\Plugin\DsField\DsFieldBase;
use Drupal\node\NodeInterface;
use Drupal\tfs_system_tags\TagFinder\TagFinderFactoryInterface;
use Drupal\tfs_system_tags\TagFinder\TagFinderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class Register
 * @package Drupal\tfs_blog\Plugin\DsField
 *
 * @DsField(
 *   id = "register",
 *   title = @Translation("Register"),
 *   entity_type = "node",
 *   ui_limit = {"blog_post|restricted_full_content"}
 * )
 */
class Register extends DsFieldBase {

  /**
   * @var TagFinderInterface
   */
  protected $tagFinder;


  /**
   * Register constructor.
   *
   * @param array                     $configuration
   * @param string                    $plugin_id
   * @param mixed                     $plugin_definition
   * @param TagFinderFactoryInterface $tag_finder_factory
   */
  public function __construct($configuration, $plugin_id, $plugin_definition, TagFinderFactoryInterface $tag_finder_factory) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->tagFinder = $tag_finder_factory->getTagFinder('node');
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('tfs_system_tags.tag_finder_factory')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $output = [];
    /** @var NodeInterface|NULL $subscribe */
    $subscribe = $this->tagFinder->findByTag('subscribe_info');
    if ($subscribe) {
      $output = node_view($subscribe);
    }

    return $output;
  }

}