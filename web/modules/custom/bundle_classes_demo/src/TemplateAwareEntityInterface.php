<?php

declare(strict_types=1);

namespace Drupal\bundle_classes_demo;

use Drupal\Core\Cache\CacheableMetadata;

/**
 * Provides an interface for entities that need preprocessing.
 */
interface TemplateAwareEntityInterface {

  /**
   * Gets templates variables.
   *
   * @param \Drupal\Core\Cache\CacheableMetadata $cacheableMetadata
   *   Cacheable metadata.
   */
  public function getTemplateVariables(CacheableMetadata $cacheableMetadata): array;

}
