<?php

namespace Drupal\tfs_system_tags\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class SystemTagEntityForm.
 *
 * @package Drupal\tfs_system_tags\Form
 */
class SystemTagEntityForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $system_tag_entity = $this->entity;
    $form['label'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $system_tag_entity->label(),
      '#description' => $this->t("Label for the System tag."),
      '#required' => TRUE,
    );

    $form['id'] = array(
      '#type' => 'machine_name',
      '#default_value' => $system_tag_entity->id(),
      '#machine_name' => array(
        'exists' => '\Drupal\tfs_system_tags\Entity\SystemTagEntity::load',
      ),
      '#disabled' => !$system_tag_entity->isNew(),
    );

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $system_tag_entity = $this->entity;
    $status = $system_tag_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label System tag.', [
          '%label' => $system_tag_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label System tag.', [
          '%label' => $system_tag_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($system_tag_entity->urlInfo('collection'));
  }

}
