<?php

namespace Drupal\cdp_register\Form;

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
class RegistersForm extends RegForm {

  /**
   * RegistersForm constructor.
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
    $form['account']['name']['#access'] = FALSE;
    $form['account']['name']['#value'] = 'change'.var_dump(user_password());
//    $form['account']['name'][''] = 'invisible';
//    $form['timezone'] = [];
    $form['#attached']['library'][] = 'cdp_register/form_register';
    $form['account']['pass'] = [
      '#type' => 'password_confirm',
      '#size' => 25,
      '#description' => $this->t('To change the current user password, enter the new password in both fields.'),
    ];


    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Remove unneeded values.
    $form_state->cleanValues();
    var_dump($this->makeName($form_state->getValue('mail')));
    $form_state->setValue('name', $this->makeName($form_state->getValue('mail')));
    //$config = \Drupal::config('user.settings')->set('verify_mail',FALSE);
    \Drupal::configFactory()->getEditable('user.settings')->set('verify_mail',FALSE)->save();
    var_dump(\Drupal::config('user.settings')->get('verify_mail'));
//    die();

    parent::submitForm($form, $form_state);
  }
  public function makeName($name){
    $newName = explode('@',$name);
    return str_replace('.','',$newName[0].explode('.',$newName[1])[0]);
  }
  public function save(array $form, FormStateInterface $form_state) {
    $role_id = 'Deveporeis';
    $this->entity->set('roles', $role_id);
    $name = 'antras';
//    $this->entity->set('name', $name);
    parent::save($form, $form_state);
  }

}
