<?php


namespace Drupal\tfs_system_tags\TagFinder;



use Drupal\node\Entity\Node;

class NodeTagFinder extends AbstractTagFinder {

  /**
   * {@inheritdoc}
   */
  public function findByTag($tag_id) {
    $query = $this->queryFactory->get('node')
      ->condition('field_system_tags', $tag_id)
      ->range(0, 1);
    $result = $query->execute();

    $node = NULL;
    if ($result) {
      $node = Node::load(reset($result));
    }

    return $node;
  }

  /**
   * {@inheritdoc}
   */
  public function getEntityType() {
    return 'node';
  }
}