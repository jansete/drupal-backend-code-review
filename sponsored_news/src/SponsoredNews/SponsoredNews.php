<?php

namespace Drupal\sponsored_news\SponsoredNews;

use Drupal\file\FileInterface;
use Drupal\sponsored_news\SponsoredNews\Provider\IzukuProvider;
use Drupal\sponsored_news\SponsoredNews\Provider\ShoyoProvider;

/**
 * Class SponsoredNews.
 *
 * @package Drupal\sponsored_news\SponsoredNews
 */
class SponsoredNews {

  /**
   * @param                            $provider_name
   * @param \Drupal\file\FileInterface $file
   *
   * @return int
   * @throws \Drupal\Core\Entity\EntityStorageException
   */
  public function import($provider_name, FileInterface $file) {
    switch ($provider_name) {
      case 'izuku':
        $provider = new IzukuProvider();
        break;
      case 'shoyo':
        $provider = new ShoyoProvider();
        break;
      default:
        throw new \Exception('Provider ' . $provider_name . ' doesn\'t exist');
    }

    return $provider->import($file);
  }

}
