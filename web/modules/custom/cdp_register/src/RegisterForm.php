<?php

namespace Drupal\cdp_register;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\EntityRepositoryInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\user\AccountForm;
use Drupal\user\RegisterForm as RegForm;

/**
 * Form handler for the user register forms.
 *
 * @internal
 */
class RegisterForm extends RegForm {

  /**
   * RegisterForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityRepositoryInterface $entity_repository
   *   Comment.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   Comment.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface|null $entity_type_bundle_info
   *   Comment.
   * @param \Drupal\Component\Datetime\TimeInterface|null $time
   *   Comment.
   */
  public function __construct(EntityRepositoryInterface $entity_repository, LanguageManagerInterface $language_manager, EntityTypeBundleInfoInterface $entity_type_bundle_info = NULL, TimeInterface $time = NULL) {
    parent::__construct($entity_repository, $language_manager, $entity_type_bundle_info, $time);
    var_dump("zjbs");
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);
    $form['account']['mail']['#description'] = 'holy';
//    '#required' => TRUE,
//    $form['account']['name'] = [];
    $form['account']['name']['#display'] = 'invisible';
    $form['timezone'] = [];
    $form['#attached']['library'][] = 'cdp_register/form_register';

    return $form;
  }

}
