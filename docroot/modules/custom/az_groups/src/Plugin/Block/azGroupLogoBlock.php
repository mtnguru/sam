<?php
/**
* @file
* Display top Navigation menu for groups depending on the URL.
*/


/**
 * Displays children pages as a block
 */

namespace Drupal\az_groups\Plugin\Block;
use Drupal\az_groups\azGroupConfig;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Path;
use Drupal\Core\Menu;

/**
 * Provides a 'Next Previous' block.
 *
 * @Block(
 *   id = "az_group_logo_block",
 *   admin_label = @Translation("AZ Group Logo Block"),
 *   category = @Translation("Atomizer")
 * )
 */
class azGroupLogoBlock extends BlockBase {

  // @TODO move this into database with config form
  protected $sites = [
    'em' => [
      'hosts' => [
        'etherealmatters.org',
        'em',
      ],
      'name' => 'Ethereal Matters',
      'theme' => 'ethereal-matters',
      'menu' => 'ethereal-matters',
      'icon' => 'public://icons/em_icon.gif',
    ],
    'sam' => [
      'hosts' => [
        'structuredatom.org',
        'atom',
      ],
      'name' => 'Structured Atom Model',
      'theme' => 'structured-atom-model',
      'menu' => 'structured-atom-model',
      'icon' => 'public://icons/sam_icon.gif',
    ],
    'geo' => [
      'hosts' => [
        'eugeology.rocks',
        'eg',
      ],
      'name' => 'EU Geology',
      'theme' => 'eu-geology',
      'menu' => 'eu-geology',
      'icon' => 'public://icons/valles_marineris.jpg',
    ],
  ];

  public function build() {
    $host = \Drupal::request()->getHttpHost();
    $site = azGroupConfig::getConfig($host);

    $variables = array(
      'style_name' => 'thumbnail',
      'uri' => $site['icon'],
    );

    $variables['width'] = $variables['height'] = NULL;

    $build = [
      '#type' => 'container',
      '#attributes' => [
        'class' => [$site['class']],
      ],
      'logo' => [
        '#theme' => 'image_style',
        '#width' => null,
        '#height' => null,
        '#style_name' => $variables['style_name'],
        '#uri' => $variables['uri'],
      ],
      'name' => [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['name'],
        ],
        'text'=> [
          '#markup' => $site['name'],
        ],
      ],
    ];
    return $build;
  }
}

