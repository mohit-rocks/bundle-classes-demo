<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Media;

use Drupal\media\Entity\Media;

/**
 * Bundle class for Image media bundle.
 */
class Image extends Media {

  public const BUNDLE = 'image';

  /**
   * Render media using given view mode.
   *
   * @return array
   *   The render array.
   */
  public function buildMediaRender(string $view_mode = 'default'): array {
    $viewBuilder = \Drupal::entityTypeManager()->getViewBuilder('media');
    return $viewBuilder->view($this, $view_mode);
  }

}
