<?php

namespace Drupal\sponsored_news\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\node\Entity\Node;

/**
 * Class SponsoredNewsController.
 *
 * @package Drupal\sponsored_news\Controller
 */
class SponsoredNewsController extends ControllerBase {

  /**
   * @return array
   */
  public function settingsImport() {
    return \Drupal::formBuilder()->getForm('Drupal\sponsored_news\Form\SponsoredNewsSettingsImportForm');
  }

  /**
   * @return array
   */
  public function listing() {
    $items = [];
    $nids = \Drupal::database()
                   ->select('node_field_data', 'n')
                   ->fields('n', ['nid'])
                   ->condition('n.status', 1)
                   ->condition('n.type', 'article')
                   ->orderBy('n.created', 'DESC')
                   ->execute()
                   ->fetchCol();

    $view_builder = \Drupal::entityTypeManager()->getViewBuilder('node');

    foreach ($nids as $nid) {
      $node = Node::load($nid);
      $items[] = $view_builder->view($node, 'teaser');
    }

    return [
      '#theme' => 'sponsored_news_listing',
      '#items' => $items,
      '#admin_link' => \Drupal::currentUser()->hasPermission('access sponsored_news settings')
        ? Link::createFromRoute('Import sponsored news', 'sponsored_news.settings.import')
        : NULL,
      '#cache' => [
        'keys' => ['sponsored_news_listing'],
        'tags' => ['sponsored_news:listing'],
      ],
    ];
  }

}
