<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Node;

use Drupal\bundle_classes_demo\Entity\Media\Image;
use Drupal\bundle_classes_demo\Entity\Traits\FieldProcessorTrait;
use Drupal\Component\Render\MarkupInterface;
use Drupal\Core\Render\Markup;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\node\Entity\Node;

/**
 * A base class for all the Node bundles.
 */
abstract class NodeBase extends Node {

  use FieldProcessorTrait;
  use StringTranslationTrait;

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
    assert($media instanceof Image);

    return $media->buildMediaRender();
  }

  /**
   * Get the node author information.
   */
  public function getNodeAuthorName(): MarkupInterface {
    $author = $this->get('uid')->view();
    return \Drupal::service('renderer')->render($author);
  }

  /**
   * Get the content type label.
   */
  public function getContentTypeLabel(): ?string {
    return $this->type->getEntity()?->label();
  }

}
