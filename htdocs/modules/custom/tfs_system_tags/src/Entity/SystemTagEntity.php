<?php

namespace Drupal\tfs_system_tags\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;
use Drupal\tfs_system_tags\SystemTagEntityInterface;

/**
 * Defines the System tag entity.
 *
 * @ConfigEntityType(
 *   id = "system_tag_entity",
 *   label = @Translation("System tag"),
 *   handlers = {
 *     "list_builder" = "Drupal\tfs_system_tags\SystemTagEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\tfs_system_tags\Form\SystemTagEntityForm",
 *       "edit" = "Drupal\tfs_system_tags\Form\SystemTagEntityForm",
 *       "delete" = "Drupal\tfs_system_tags\Form\SystemTagEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\tfs_system_tags\SystemTagEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "system_tag_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/system_tag_entity/{system_tag_entity}",
 *     "add-form" = "/admin/structure/system_tag_entity/add",
 *     "edit-form" = "/admin/structure/system_tag_entity/{system_tag_entity}/edit",
 *     "delete-form" = "/admin/structure/system_tag_entity/{system_tag_entity}/delete",
 *     "collection" = "/admin/structure/system_tag_entity"
 *   }
 * )
 */
class SystemTagEntity extends ConfigEntityBase implements SystemTagEntityInterface {
  /**
   * The System tag ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The System tag label.
   *
   * @var string
   */
  protected $label;

}
