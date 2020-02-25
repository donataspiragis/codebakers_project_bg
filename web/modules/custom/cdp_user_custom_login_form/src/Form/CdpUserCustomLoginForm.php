<?php

namespace Drupal\cdp_user_custom_login_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\user\UserAuthInterface;
use Drupal\user\UserInterface;
use Drupal\user\UserStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CdpUserCustomLoginForm extends FormBase {

  protected $userStorage;

  protected $userAuth;

  public function __construct(UserStorageInterface $user_storage, UserAuthInterface $user_auth) {
    $this->userStorage = $user_storage;
    $this->userAuth = $user_auth;
  }

  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')->getStorage('user'),
      $container->get('user.auth')
    );
  }

  public function getFormId() {
    return 'cdp_user_custom_login_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#size' => 60,
      '#maxlength' => UserInterface::USERNAME_MAX_LENGTH,
      '#description' => $this->t('Enter your email'),
      '#required' => TRUE,
    ];

    $form['pass'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#size' => 60,
      '#description' => $this->t('Enter the password that accompanies your username.'),
      '#required' => TRUE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = ['#type' => 'submit', '#value' => $this->t('Custom log in')];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $password = trim($form_state->getValue('pass'));
    $mail = $form_state->getValue('mail');

    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $users = $this->userStorage->loadByProperties(['mail' => $mail]);

      if (count($users) !== 1) {
        $form_state->setError($form['mail'], $this->t('User with this email does not exist.'));
      } else {
        $user = reset($users);
        $uid = $this->userAuth->authenticate($user->getAccountName(), $password);
        $form_state->set('uid', $uid);
      }
    } else {
      $form_state->setError($form['mail'], $this->t('Your provided email is not valid.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $uid = $form_state->get('uid');
    $user = $this->userStorage->load($uid);

    if ($user) {
      user_login_finalize($user);
    }
  }
  
}
