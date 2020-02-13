<?php

namespace Drupal\cdp_copyright\Plugin\Block;

/**
 * @file
 * Contains \Drupal\cdp_copyright\Plugin\Block\CdpCopyright.
 */

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 *
 * @Block (
 *   id = "cdp_copyright",
 *   admin_label = @Translation("Copyright block"),
 *   category = @Translation("Custom")
 * )
 */
class CdpCopyright extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'company_name' => '',
      'year_start' => '',
      'year_to' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {

    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your company name'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['company_name'],
    ];

    $form['year_start'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Year from'),
      '#description' => $this->t('Fill project start date.'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['year_start'],
    ];

    $form['year_to'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Year to date'),
      '#description' => $this->t('If no need leave empty and it will be current year'),
      '#default_value' => $this->configuration['year_to'],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['company_name'] = $form_state->getValue('company_name');
    $this->configuration['year_start'] = $form_state->getValue('year_start');
    $this->configuration['year_to'] = $form_state->getValue('year_to');
  }

  /**o
   * {@inheritdoc}
   */
  public function build() {
    $date = new \DateTime();
    if (empty($this->configuration['year_to'])) {
      $this->configuration['year_to'] = $date->format('Y');
    }

    return [
      '#type' => 'markup',
      '#markup' => $this->t('@company - Copyright &copy; @year-@year_to', [
        '@year' => $this->configuration['year_start'],
        '@year_to' => $this->configuration['year_to'],
        '@company' => $this->configuration['company_name'],
      ]),
    ];

  }

}
