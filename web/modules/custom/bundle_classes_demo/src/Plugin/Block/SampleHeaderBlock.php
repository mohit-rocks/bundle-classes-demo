<?php

namespace Drupal\bundle_classes_demo\Plugin\Block;

use Drupal\bundle_classes_demo\Entity\Node\LandingPage;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\CacheableMetadata;

/**
 * Provides a sample block block.
 *
 * @Block(
 *   id = "bundle_classes_demo_sample_block",
 *   admin_label = @Translation("Sample Block"),
 *   category = @Translation("Custom"),
 *   context_definitions = {
 *     "entity" = @ContextDefinition("entity:node")
 *   }
 * )
 */
class SampleHeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $node = $this->getContextValue('entity');
    if (!$node instanceof LandingPage) {
      CacheableMetadata::createFromObject($this)->applyTo($build);
      return $build;
    }
    return $node->buildHeader();
  }

}
