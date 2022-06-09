<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Node;

use Drupal\bundle_classes_demo\Entity\Traits\FieldProcessorTrait;
use Drupal\media\Entity\Media;
use Drupal\node\Entity\Node;

/**
 * A base class for all the Node bundles.
 */
abstract class NodeBase extends Node {

  use FieldProcessorTrait;

  public const BUNDLE = NULL;

  /**
   * Builds the featured image render array.
   *
   * @return array
   *   The render array.
   */
  public function buildFeaturedImage(): array {
    if (!$this->hasField('field_media') || $this->field_media->isEmpty()) {
      return [];
    }
    /** @var \Drupal\Core\Field\Plugin\Field\FieldType\EntityReferenceItem $headerImageItem */
    $mediaImageItem = $this->get('field_media');
    $media = $mediaImageItem->entity;
    assert($media instanceof Media);

    // @todo: Use another bundle class for Media and move it there.
    $viewBuilder = \Drupal::entityTypeManager()->getViewBuilder('media');
    return $viewBuilder->view($media, 'default');
  }

}
