<?php

declare(strict_types = 1);

namespace Drupal\bundle_classes_demo\Entity\Node;

use Drupal\bundle_classes_demo\TemplateAwareEntityInterface;
use Drupal\Core\Cache\CacheableMetadata;

/**
 * A base class for Article bundles.
 */
class Article extends NodeBase implements TemplateAwareEntityInterface {

  public const BUNDLE = 'article';

  /**
   * {@inheritdoc}
   */
  public function getTemplateVariables(CacheableMetadata $cacheable_metadata): array {
    $cacheable_metadata->addCacheableDependency($this);
    // Do any processing and prepare the template variable values.
    $calculated_variable = "🍩☕️";
    return [
      'breakfast' => $calculated_variable,
    ];
  }

  /**
   * Get human-readable length of the article.
   *
   * @return string
   */
  public function getArticleType(): string {
    $word_count = str_word_count($this->get('body')->value);
    return match(true) {
      $word_count > 0 && $word_count < 3 => 'Summary',
      $word_count > 3 && $word_count < 10 => 'Short report',
      $word_count > 10 && $word_count < 18 => 'Essay',
      default => 'Research',
    };
  }

}
