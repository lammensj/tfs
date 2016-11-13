<?php

/**
 * @file
 * Definition of BlockReference.
 */

namespace Drupal\tfs_blockreference\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\TypedData\DataDefinition;
use Drupal\Core\Field\FieldStorageDefinitionInterface;

/**
 * Plugin implementation of the 'block_reference' field type.
 *
 * @FieldType(
 *   id = "blockreference",
 *   label = @Translation("Block reference"),
 *   description = @Translation("Reference an existing block"),
 *   category = @Translation("Custom"),
 *   default_widget = "blockreference_default",
 *   default_formatter = "blockreference_default"
 * )
 */
class BlockReference extends FieldItemBase {


  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'char',
          'length' => '255',
          'not null' => FALSE,
        ),
      ),
      'indexes' => array(
        'value' => array('value'),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Block'));
    return $properties;
  }


  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();
    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public function getConstraints() {
    $constraint_manager = \Drupal::typedDataManager()->getValidationConstraintManager();
    $constraints = parent::getConstraints();
    $constraints[] = $constraint_manager->create('ComplexData', array(
      'value' => array(
        'Length' => array(
          'max' => 255,
          'maxMessage' => t('%name: the block id may not be longer than @max characters.', array(
            '%name' => $this->getFieldDefinition()
              ->getLabel(),
            '@max' => 255,
          )),
        ),
      ),
    ));
    return $constraints;
  }

}
