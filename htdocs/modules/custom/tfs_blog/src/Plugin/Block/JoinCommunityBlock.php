<?php

namespace Drupal\tfs_blog\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;


/**
 * Class JoinCommunityBlock
 * @package Drupal\tfs_blog\Plugin\Block
 *
 * @Block(
 *   id = "join_community",
 *   admin_label = @Translation("Join community")
 * )
 */
class JoinCommunityBlock extends BlockBase {

  public function build() {
    $url = Url::fromRoute('user.register');

    return [
      '#type' => 'link',
      '#title' => $this->t('Join our community'),
      '#url' => $url,
      '#attributes' => [
        'class' => ['join-community']
      ]
    ];
  }

}