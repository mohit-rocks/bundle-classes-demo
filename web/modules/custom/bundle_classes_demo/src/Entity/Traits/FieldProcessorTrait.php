<?php

declare(strict_types=1);

namespace Drupal\bundle_classes_demo\Entity\Traits;

use Drupal\text\Plugin\Field\FieldType\TextItem;

/**
 * Generic method that are needed across all the entities.
 */
trait FieldProcessorTrait {

  /**
   * Build summary for the node text. We can use this in other bundle classes.
   *
   * @return array
   */
  public function buildTeaser(): array {
    if (!$this->hasTeaser()) {
      return [];
    }
    return [
      '#type' => 'processed_text',
      '#text' => $this->field_teaser->value,
      '#format' => 'plain_text',
    ];
  }

  /**
   * If this entity has a teaser value.
   *
   * @return bool
   *   TRUE if it has a summary, else FALSE.
   */
  public function hasTeaser(): bool {
    return $this->hasField('field_teaser') && !$this->field_teaser->isEmpty();
  }
}
