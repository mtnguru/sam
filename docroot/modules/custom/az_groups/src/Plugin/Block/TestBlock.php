<?php
/**
* @file
* Display top Navigation menu for groups depending on the URL.
*/


/**
 * Displays children pages as a block
 */

namespace Drupal\az_groups\Plugin\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Path;
use Drupal\Core\Menu;

/**
 * Provides a 'Next Previous' block.
 *
 * @Block(
 *   id = "test_block",
 *   admin_label = @Translation("AZ Test Block"),
 *   category = @Translation("Atomizer"),
 * )
 */
class TestBlock extends BlockBase {


  public function build() {
    return array(
      '#markup' => $this->t('Hello, World!'),
    );
  }
}
