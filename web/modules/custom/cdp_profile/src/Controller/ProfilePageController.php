<?php

namespace Drupal\cdp_profile\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class ProfilePageController.
 *
 * @package Drupal\cdp_profile\Controller
 */
class ProfilePageController extends ControllerBase {

  /**
   * Profile frontpage.
   */
  public function profileFront() {

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Hello, World!'),
    ];

  }
}
