<?php

namespace Drupal\sponsored_news\SponsoredNews\Provider;

use Drupal\file\FileInterface;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;

/**
 * Trait MockProviderTrait.
 *
 * @package Drupal\sponsored_news\SponsoredNews\Provider
 */
trait MockProviderTrait {

  /**
   * @param \Drupal\file\FileInterface $file
   *
   * @return int
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function import(FileInterface $file) {
    $node = Node::create([
      'status' => NodeInterface::PUBLISHED,
      'type' => 'article',
      'title' => 'Mock title - ' . static::NAME . '- ' . time(),
      'body' => [
        'value' => '<p>Mock body - ' . static::NAME . '- ' . time() . '</p>',
        'format' => 'basic_html',
      ],
    ]);

    return $node->save();
  }

}
