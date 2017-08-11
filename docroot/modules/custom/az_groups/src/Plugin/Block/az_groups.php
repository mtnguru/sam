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
 *   id = "az_top_nav",
 *   admin_label = @Translation("AZ top nav"),
 *   category = @Translation("Atomizer")
 * )
 */
class az_groups extends BlockBase {

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
    ],
    'sam' => [
      'hosts' => [
        'structuredatom.org',
        'atom',
      ],
      'name' => 'Structured Atom Model',
      'theme' => 'structured-atom-model',
      'menu' => 'structured-atom-model',
    ],
    'geo' => [
      'hosts' => [
        'eugeology.rocks',
        'eg',
      ],
      'name' => 'EU Geology',
      'theme' => 'eu-geology',
      'menu' => 'eu-geology',
    ],
  ];

  public function build() {
    $currentMenu = NULL;
    $host = \Drupal::request()->getHttpHost();
    foreach ($this->sites as $sitename => $site) {
      foreach ($site['hosts'] as $hostname) {
        if ($host == $hostname) {
          $menuName = $site['menu'];
          $menu_tree_service = \Drupal::service('menu.link_tree');

          // Build the typical default set of menu tree parameters.
          $parameters = $menu_tree_service->getCurrentRouteMenuTreeParameters($menuName);
          $expandedParents = $parameters->expandedParents;
          reset($expandedParents);
          $root = current($expandedParents);
          $parameters = new \Drupal\Core\Menu\MenuTreeParameters();
          $parameters->setRoot($root);
          $parameters->setMaxDepth(3);
          $parameters->setMinDepth(1);


          // Load the tree based on this set of parameters.
          $tree = $menu_tree_service->load($menuName, $parameters);

          //Set Cache for block
          $cache['max-age'] = 3600;
          $cache['contexts'][] = 'url.path';
          $cache['tags'][] = $root;

          // Apply some manipulators (checking the access, sorting).
          $manipulators = [
            ['callable' => 'menu.default_tree_manipulators:checkNodeAccess'],
            ['callable' => 'menu.default_tree_manipulators:checkAccess'],
            ['callable' => 'menu.default_tree_manipulators:generateIndexAndSort'],
          ];
          $tree = $menu_tree_service->transform($tree, $manipulators);
          // And the last step is to actually build the tree.
          return $menu_tree_service->build($tree);
          break;
        }
      }
    }
    return ['#markup' => 'No match to host: ' . $host];
  }
}

    /**** Original example
    //Get node IDs from menu
    $nids = array();
    foreach($tree as $item){
      $nids[] = $item->link->getUrlObject()->getRouteParameters()['node'];
    }

    //Load nodes & generate content from nodes
    $nodes = (!empty($nids)) ? entity_load_multiple('node', $nids) : array();
    if (!empty($nodes) && is_array($nodes)){
      foreach($nodes as $key=>$val) {
        $nodeContent = array(
          '#prefix' => '<div class="block-child-page-menu">',
          '#suffix' => '</div>'
        );
        $url = \Drupal::service('path.alias_manager')->getAliasByPath('/node/'.$key);

        //Get image thumbnail from content & use specified image style
        if(null !== $val->get('field_thumbnail')->entity){
          $imgPath = ($val->get('field_thumbnail')->entity->uri->value);
          $imgCroppedPath = \Drupal\image\Entity\ImageStyle::load('basic_page_thumbnail')->buildUrl($imgPath);
          $img = ($imgPath != '') ? '<img src="' . $imgCroppedPath . '" />' : '';
        }
        else {
          $img = "";
        }
        $nodeContent['#markup'] = '<a href="'.$url.'">' .
            '<h2>' . $val->getTitle() . '</h2>' .
            $img .
          '</a>';
        $content[] = $nodeContent;
      }
    }else{
      //Menu has no nodes
      $content['#markup'] = '';
    }
    //Add cache & css library to block
    $content['#cache'] = $cache;
    $content["#attached"] = array('library' => array('child_pages_display/child_pages_display_css'));
    return $content;
  }  */
