<?php

namespace Drupal\cdp_register\Controller;

use Drupal\Core\Form\FormStateInterface;
/**
 * Class RegisterCallController.
 *
 * @package Drupal\cdp_register\Controller
 */
class RegisterCallController {

  /**
   * Function brings form.
   */
  public function getForm() {

    return \Drupal::formBuilder()->getForm('Drupal\cdp_register\RegisterForm');
  }

}
