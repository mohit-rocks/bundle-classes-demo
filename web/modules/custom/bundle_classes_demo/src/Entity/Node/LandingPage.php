<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Node;

use Drupal\Core\Cache\CacheableMetadata;

/**
 * A base class for Landing Page bundles.
 */
class LandingPage extends NodeBase {

  public const BUNDLE = 'landing_page';

  /**
   * Generate render array for the content header.
   *
   * @return array
   */
  public function buildHeader(): array {
    $build = [
      '#theme' => 'landing_page_header',
      '#title' => $this->label(),
    ];
    if ($headerImage = $this->buildFeaturedImage()) {
      $build['#image'] = $headerImage;
    }
    if ($summary = $this->buildTeaser()) {
      $build['#summary'] = $summary;
    }

    CacheableMetadata::createFromObject($this)->applyTo($build);
    return $build;
  }

}
