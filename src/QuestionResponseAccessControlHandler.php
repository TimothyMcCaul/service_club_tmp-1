<?php

namespace Drupal\service_club_tmp;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Question response entity.
 *
 * @see \Drupal\service_club_tmp\Entity\QuestionResponse.
 */
class QuestionResponseAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\service_club_tmp\Entity\QuestionResponseInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished question response entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published question response entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit question response entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete question response entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add question response entities');
  }

}
