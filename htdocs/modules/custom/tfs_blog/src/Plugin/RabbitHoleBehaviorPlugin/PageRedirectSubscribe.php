<?php


namespace Drupal\tfs_blog\Plugin\RabbitHoleBehaviorPlugin;


use Drupal\Core\Entity\Entity;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Url;
use Drupal\rabbit_hole\Annotation\RabbitHoleBehaviorPlugin;
use Drupal\rabbit_hole\Plugin\RabbitHoleBehaviorPluginBase;
use Drupal\tfs_system_tags\TagFinder\TagFinderFactoryInterface;
use Drupal\tfs_system_tags\TagFinder\TagFinderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class PageRedirectSubscribe
 * @package Drupal\tfs_blog\Plugin\RabbitHoleBehaviorPlugin
 *
 * @RabbitHoleBehaviorPlugin(
 *   id = "page_redirect_subscribe",
 *   label = @Translation("Page redirect subscribe")
 * )
 */
class PageRedirectSubscribe extends RabbitHoleBehaviorPluginBase implements ContainerFactoryPluginInterface {

  /**
   * @var TagFinderInterface
   */
  protected $tagFinder;


  /**
   * PageRedirectSubscribe constructor.
   *
   * @param array $configuration
   * @param string $plugin_id
   * @param mixed $plugin_definition
   * @param TagFinderFactoryInterface $tag_finder_factory
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, TagFinderFactoryInterface $tag_finder_factory) {
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
  public function performAction(Entity $entity) {
    $account = \Drupal::currentUser();

    if ($account->isAnonymous()) {
      $subscribePage = $this->tagFinder
        ->findByTag('subscribe_info');

      $route = Url::fromRoute('<front>')->setAbsolute()->toString();
      if ($subscribePage) {
        $route = $subscribePage->toUrl('canonical')->setAbsolute()->toString();
      }

      return new RedirectResponse($route);
    }
  }
}