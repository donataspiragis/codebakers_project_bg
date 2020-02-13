<?php

namespace Drupal\cdp_core\Controller;

use Drupal\Core\Controller\ControllerBase;


class CdpController extends ControllerBase {

  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => t('Our second test page'),
    ];
  }
}
