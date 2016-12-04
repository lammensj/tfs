<?php


namespace Drupal\tfs_mailchimp\Plugin\Condition;


use Drupal;
use Drupal\Core\Condition\ConditionPluginBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\Entity\User;

/**
 * Class UserSubscribed
 * @package Drupal\tfs_mailchimp\Plugin\Condition
 *
 * @Condition(
 *   id = "user_subscribed",
 *   label = @Translation("User subscribed")
 * )
 */
class UserSubscribed extends ConditionPluginBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['user_subscribed_activate' => 0] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);
    unset($form['negate']);

    $form['activate'] = [
      '#type' => 'radios',
      '#title' => $this->t('Activate?'),
      '#options' => [
        0 => $this->t('No'),
        1 => $this->t('Yes')
      ],
      '#default_value' => $this->configuration['user_subscribed_activate']
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
    $this->configuration['user_subscribed_activate'] = $form_state->getValue('activate');
    parent::submitConfigurationForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function evaluate() {
    if ($this->configuration['user_subscribed_activate']) {
      $user = Drupal::currentUser();
      if ($user->isAuthenticated()) {
        $user = User::load($user->id());

        return !$user->get('field_user_subscribed')->value;
      }
    }

    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function summary() {
    return $this->t('Is the user subscribed to the newsletter? Activated? %activate', [
      '%activate' => $this->configuration['activate']
    ]);
  }
}