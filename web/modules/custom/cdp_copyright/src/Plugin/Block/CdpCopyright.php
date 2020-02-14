<?php

namespace Drupal\cdp_copyright\Plugin\Block;

/**
 * @file
 * Contains \Drupal\cdp_copyright\Plugin\Block\CdpCopyright.
 */

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
/**
 *
 * @Block (
 *   id = "cdp_copyright",
 *   admin_label = @Translation("Copyright block"),
 *   category = @Translation("CBPBG")
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
      'site_url' => '',
      'label_display' => '',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $definition = $this->getPluginDefinition();
    $form['provider'] = [
      '#type' => 'value',
      '#value' => $definition['provider'],
    ];

    $form['admin_label'] = [
      '#type' => 'item',
      '#title' => $this->t('Block description'),
      '#plain_text' => $definition['admin_label'],
    ];
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#maxlength' => 255,
      '#default_value' => $this->label(),
      '#required' => TRUE,
    ];

    $form['company_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your company name'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['company_name'],
    ];

    $form['year_start'] = [
      '#type' => 'number',
      '#title' => $this->t('Year from'),
      '#description' => $this->t('Fill project start date.'),
      '#required' => TRUE,
      '#default_value' => $this->configuration['year_start'],
    ];

    $form['year_to'] = [
      '#type' => 'number',
      '#title' => $this->t('Year to date'),
      '#description' => $this->t('If no need leave empty and it will be current year'),
      '#default_value' => $this->configuration['year_to'],
    ];
    $form['site_url'] = [
      '#type' => 'url',
      '#title' => $this->t('Insert hyperlink if necessary'),
      '#description' => $this->t('If you fill link all copyright field will become a link.'),
      '#default_value' => $this->configuration['site_url'],
    ];
    $form['label_display'] = [
      '#type' => 'hidden',
      '#title' => $this->t(''),
      '#default_value' => ($this->configuration['label_display'] === static::BLOCK_LABEL_VISIBLE),
      '#return_value' => static::BLOCK_LABEL_VISIBLE,
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
    $this->configuration['site_url'] = $form_state->getValue('site_url');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $date = new DrupalDateTime();
    $date = $date->format('Y');

    if (empty($this->configuration['year_to']) || $this->configuration['year_to'] > $date || $this->configuration['year_to'] < 0) {
      $this->configuration['year_to'] = $date;
    }
    if ($this->configuration['year_start'] > $date || $this->configuration['year_start'] < 0) {
      $this->configuration['year_start'] = $date;
    }
    if (empty($this->configuration['site_url'])) {
      $this->configuration['site_url'] = '';
    }

    return [
      '#theme' => 'cdp_copyright_theme',
      '#company_name' => $this->configuration['company_name'],
      '#year_start' => $this->configuration['year_start'],
      '#year_to' => $this->configuration['year_to'],
      '#site_url' => $this->configuration['site_url'],
      '#label_display' => FALSE,
      '#attached' => [
        'library' => [
          'cdp_copyright/copyblock',
        ],
      ],
    ];

  }

}
