<?php


namespace Drupal\tfs_blog\Controller;


use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Controller\ControllerBase;
use Drupal\tfs_blog\Ajax\TextCommand;

/**
 * Class ViewCountController
 * @package Drupal\tfs_blog\Controller
 */
class ViewCountController extends ControllerBase {

  /**
   * @param int $nid
   *
   * @return ReplaceCommand
   */
  public function countAction($nid) {
    $stats = statistics_get($nid);

    $response = new AjaxResponse();
    $response->addCommand(new TextCommand(sprintf('[data-stats-nid=%d]', $nid), $stats['totalcount']));

    return $response;
  }

}