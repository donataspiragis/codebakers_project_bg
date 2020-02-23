<?php

namespace Drupal\tasker\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\Entity\User;

/**
 * Defines the Task entity.
 *
 * @ingroup tasker
 *
 * @ContentEntityType(
 *   id = "task",
 *   label = @Translation("Task"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\tasker\TaskListBuilder",
 *     "views_data" = "Drupal\tasker\Entity\TaskViewsData",
 *     "translation" = "Drupal\tasker\TaskTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\tasker\Form\TaskForm",
 *       "add" = "Drupal\tasker\Form\TaskForm",
 *       "edit" = "Drupal\tasker\Form\TaskForm",
 *       "delete" = "Drupal\tasker\Form\TaskDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tasker\TaskHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\tasker\TaskAccessControlHandler",
 *   },
 *   base_table = "task",
 *   data_table = "task_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer task entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/task/{task}",
 *     "add-form" = "/admin/structure/task/add",
 *     "edit-form" = "/admin/structure/task/{task}/edit",
 *     "delete-form" = "/admin/structure/task/{task}/delete",
 *     "collection" = "/admin/structure/task",
 *   },
 *   field_ui_base_route = "task.settings"
 * )
 */
class Task extends ContentEntityBase implements TaskInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getTask() {
    return $this->get('task_title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTask($name) {
    $this->set('task_title', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->get('task_description')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setDescription($description) {
    $this->set('task_description', $description);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTaskStatus() {
    return $this->get('task_status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTaskStatus($task_status) {
    $this->set('task_status', $task_status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getUrlTitle() {
    if (!empty($this->get('task_url')->getValue())) {
      $task_url = $this->get('task_url')->getValue();
      $task_url = $task_url[0]['title'];
      return $task_url;
    }
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function setUrlTitle($task_url_title) {
    $task_url = $this->get('task_url')->getValue();
    $task_url->set($task_url[0]['title'], $task_url);
    return $task_url;
  }

  /**
   * {@inheritdoc}
   */
  public function getUrlUri() {
    if (!empty($this->get('task_url')->getValue())) {
      $task_url = $this->get('task_url')->getValue();
      $task_url = $task_url[0]['uri'];
      return $task_url;
    }
    return '';
  }

  /**
   * {@inheritdoc}
   */
  public function setUrlUri($task_url_uri) {
    $task_url = $this->get('task_url')->getValue();
    $task_url->set($task_url[0]['uri'], $task_url_uri);
    return $task_url;
  }

  /**
   * {@inheritdoc}
   */
  public function getDeveloperName() {
    $developer = $this->get('task_developer')->getValue();
    $developer = $developer[0]['target_id'];
    $developer = User::load($developer)->getUsername();
    return $developer;
  }

  /**
   * {@inheritdoc}
   */
  public function setDeveloperName($task_developer) {
    $developer = $this->get('task_developer')->getValue();
    $developer = $developer[0]['target_id'];
    $developer = User::load($developer)->setUsername($task_developer);
    return $developer;
  }

  /**
   * {@inheritdoc}
   */
  public function getLeadName() {

    $lead = $this->get('task_techlead')->getValue();
    $lead = $lead[0]['target_id'];
//    $lead = User::load($lead)->getRoles();
//    dump($lead);
//    die();
    return $lead;
  }

  /**
   * {@inheritdoc}
   */
  public function setLeadName($task_techlead) {
    $lead = $this->get('task_techlead')->getValue();
    $lead = $lead[0]['target_id'];
    $lead = User::load($lead)->setUsername($task_techlead);
    return $lead;
  }

  /**
   * {@inheritdoc}
   */
  public function getDeadline() {
    return $this->get('task_deadline')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setDeadline($task_deadline) {
    $this->set('task_deadline', $task_deadline);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTimeWish() {
    return $this->get('task_time_wish')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTimeWish($task_time_wish) {
    $this->set('task_time_wish', $task_time_wish);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getTimeTrue() {
    return $this->get('task_time_true')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTimeTrue($task_time_true) {
    $this->set('task_time_true', $task_time_true);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['task_title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Task title'))
      ->setDescription(t('The title of the Task entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -6,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Task description'))
      ->setDescription(t('Task description.'))
      ->setSettings([
        'default_value' => '',
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'text_textarea',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'settings' => [
          'rows' => 4,
        ],
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_status'] = BaseFieldDefinition::create('list_string')
      ->setLabel(t('Task status'))
      ->setDescription(t('Task status.'))
      ->setSettings([
        'allowed_values' => [
          'To do' => 'To do',
          'In progress' => 'In progress',
          'Done' => 'Done',
        ],
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'options_select',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_url'] = BaseFieldDefinition::create('link')
      ->setLabel(t('Task url'))
      ->setDescription(t('Task url.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'url',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);


    $ids = \Drupal::entityQuery('user')
      ->condition('status', 1)
      ->condition('roles', 'developer')
      ->execute();
    $users = User::loadMultiple($ids);

    $fields['task_developer'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Task developer'))
      ->setDescription(t('Task developer.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setSetting('handler', 'default')
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
          'filter' => [
            'role' => ['developer'],
          ],
        ],
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_techlead'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Task techlead'))
      ->setDescription(t('Task techlead.'))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_deadline'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Task time Tech-lead'))
      ->setDescription(t('Task time evaluated hours.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['task_time_wish'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Task time by Developer'))
      ->setDescription(t('Task time evaluated hours.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['task_time_true'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Task time it took'))
      ->setDescription(t('Task time evaluated hours.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayOptions('form', [
        'type' => 'integer',
        'weight' => -3,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(FALSE);

    $fields['status']->setDescription(t('A boolean indicating whether the Task is published.'))
      ->setDisplayOptions('form', [
        'type' => 'hidden',
      ])
      ->setDisplayOptions('view', [
        'type' => 'hidden',
      ])
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
