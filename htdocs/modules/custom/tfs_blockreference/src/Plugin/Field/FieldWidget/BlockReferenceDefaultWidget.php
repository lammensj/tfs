<?php

/**
 * @file
 * Definition of BlockReferenceDefaultWidget.
 */

namespace Drupal\tfs_blockreference\Plugin\Field\FieldWidget;

use Drupal;
use Drupal\block\BlockInterface;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'blockreference_default' widget.
 *
 * @FieldWidget(
 *   id = "blockreference_default",
 *   label = @Translation("Block select"),
 *   field_types = {
 *     "blockreference"
 *   }
 * )
 */
class BlockReferenceDefaultWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = $element + array(
      '#type' => 'select',
      '#options' => $this->getBlocks(),
      '#empty_value' => '',
      '#default_value' => (isset($items[$delta]->value)) ? $items[$delta]->value : NULL,
      '#description' => t('Select a block'),
    );
    return $element;
  }

  /**
   * Get the blocks as form options.
   *
   * @return array
   *   An array of block id options.
   */
  protected function getBlocks() {
    $options = [];
    $theme = Drupal::config('system.theme')->get('default');

    /** @var BlockInterface[] $blocks */
    $blocks = Drupal::entityTypeManager()->getStorage('block')->loadByProperties(['theme' => $theme]);
    foreach ($blocks as $block_id => $block) {
      $region = $block->getRegion();
      if ($region == BlockInterface::BLOCK_REGION_NONE) {
        $options[$block_id] = $block->label();
      }
    }

    return $options;
  }

}
