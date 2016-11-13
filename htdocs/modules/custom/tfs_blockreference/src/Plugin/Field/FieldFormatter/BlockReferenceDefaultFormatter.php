<?php

/**
 * @file
 * Definition of BlockReferenceDefaultFormatter.
 */

namespace Drupal\tfs_blockreference\Plugin\Field\FieldFormatter;

use Drupal;
use Drupal\block\Entity\Block;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'blockreference' formatter.
 *
 * @FieldFormatter(
 *   id = "blockreference_default",
 *   module = "tfs_blockreference",
 *   label = @Translation("Block"),
 *   field_types = {
 *     "blockreference"
 *   }
 * )
 */
class BlockReferenceDefaultFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      /** @var BlockReference $item */
      $block = Block::load($item->value);
      $elements[$delta] = Drupal::entityTypeManager()
        ->getViewBuilder('block')
        ->view($block);
    }
    return $elements;
  }

}
