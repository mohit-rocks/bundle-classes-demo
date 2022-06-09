<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Paragraphs;

use Drupal\paragraphs\Entity\Paragraph;

/**
 * A base class for Rich text paragraph.
 */
class RichText extends Paragraph {

  public const BUNDLE = 'rich_text';

  /**
   * Check if paragraph is featured paragraph.
   *
   * @return bool
   */
  public function isFeatured(): bool {
    if ($this->field_featured->isEmpty()) {
      return FALSE;
    }
    return (bool) $this->field_featured->value;
  }

}
