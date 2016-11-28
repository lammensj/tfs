<?php


namespace Drupal\tfs_blog\Plugin\DsField;


use Drupal\ds\Plugin\DsField\DsFieldBase;

/**
 * Class NodeCount
 * @package Drupal\tfs_blog\Plugin\DsField
 *
 * @DsField(
 *   id = "node_count",
 *   title = @Translation("Node count"),
 *   entity_type = "node",
 *   ui_limit = {"blog_post|teaser"}
 * )
 */
class NodeCount extends DsFieldBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $stats = statistics_get($this->entity()->id());

    return [
      'wrapper' => [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['node-count']
        ],
        'viewed' => [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#value' => $stats['totalcount']
        ],
        'copy' => [
          '#markup' => $this->formatPlural($stats['totalcount'], 'view', 'views')
        ]
      ],
    ];
  }

}