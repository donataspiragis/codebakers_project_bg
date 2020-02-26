<?php

namespace Drupal\tasker\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Task entities.
 *
 * @ingroup tasker
 */
interface TaskInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  public function getCreatedTime();

  /**
   * Sets the Task creation timestamp.
   *
   * @param int $timestamp
   *   The Task creation timestamp.
   *
   * @return \Drupal\tasker\Entity\TaskInterface
   *   The called Task entity.
   */
  public function setCreatedTime($timestamp);

}
