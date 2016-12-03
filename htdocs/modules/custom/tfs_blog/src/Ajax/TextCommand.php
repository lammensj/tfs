<?php


namespace Drupal\tfs_blog\Ajax;


use Drupal\Core\Ajax\CommandInterface;

class TextCommand implements CommandInterface {

  /**
   * @var string
   */
  protected $selector;

  /**
   * @var string
   */
  protected $data;

  /**
   * TextCommand constructor.
   *
   * @param $selector
   * @param $data
   */
  public function __construct($selector, $data) {
    $this->selector = $selector;
    $this->data = $data;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    return [
      'command' => 'text',
      'selector' => $this->selector,
      'data' => $this->data
    ];
  }
}