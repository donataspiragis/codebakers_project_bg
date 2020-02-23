<?php

namespace Drupal\tasker;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Task entities.
 *
 * @ingroup tasker
 */
class TaskListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Task ID');
    $header['task_name'] = $this->t('Task name');
    $header['task_description'] = $this->t('Task description');
    $header['task_status'] = $this->t('Task status');
    $header['task_url'] = $this->t('Task url');
    $header['task_developer'] = $this->t('Task developer');
    $header['task_techlead'] = $this->t('Task techlead');
    $header['task_deadline'] = $this->t('Task deadline');
    $header['task_time_wish'] = $this->t('Task wishes');
    $header['task_time_true'] = $this->t('Task true');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\tasker\Entity\Task $entity */



    $row['id'] = $entity->id();
    $row['task_name'] = $entity->getTask();
    $row['task_description'] = $entity->getDescription();
    $row['task_status'] = $entity->getTaskStatus();
    $row['task_url'] = $entity->getUrlTitle();
    $row['task_developer'] = $entity->getDeveloperName();
    $row['task_techlead'] = $entity->getLeadName();
    $row['task_deadline'] = $entity->getDeadline() . 'h';
    $row['task_time_wish'] = (empty($entity->getTimeWish())) ? 'waiting' : $entity->getTimeWish() . 'h';
    $row['task_time_true'] = (empty($entity->getTimeTrue())) ? 'waiting' : $entity->getTimeTrue() . 'h';
    return $row + parent::buildRow($entity);
  }

}
