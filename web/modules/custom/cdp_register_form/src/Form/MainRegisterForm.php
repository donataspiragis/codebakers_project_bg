<?php

namespace Drupal\cdp_register_form\Form;


use Drupal\Core\Form\FormStateInterface;
use Drupal\user\RegisterForm;

/**
 * Class MainRegisterForm
 *
 * @package Drupal\cdp_register_form
 */
class MainRegisterForm extends RegisterForm {


  public function buildForm(array $form, FormStateInterface $form_state) {

    $form = parent::buildForm($form, $form_state);
    $form['account']['mail']['#description'] = '';
    $form['account']['name']['#access'] = FALSE;
    $form['account']['name']['#value'] = 'name' . user_password();
    $form['submit']['#value'] = 'Register';
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $form_state->setValue('name', $this->makeName($form_state->getValue('mail')));

    parent::submitForm($form, $form_state);
  }

  /**
   * @param $name
   *
   * @return mixed
   */
  public function makeName($name) {
    $newName = explode('@', $name);
    return $newName[0];
  }
  public function save(array $form, FormStateInterface $form_state) {
    $storage = $form_state->getStorage();
    $role_id = $storage['role'];
    $this->entity->set('roles', $role_id);
    parent::save($form, $form_state);
  }
}