<?php

declare(strict_types=1);

namespace BundleClassesDemo\Tests\Functional;

use Drupal\bundle_classes_demo\Entity\Node\Article;
use Drupal\taxonomy\Entity\Vocabulary;
use weitzman\DrupalTestTraits\ExistingSiteBase;

class LandingPageTest extends ExistingSiteBase {

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->failOnLoggedErrors();
  }

  /**
   * An example test method to test article content type of umami profile.
   */
  public function testArticleNode(): void {
    $author = $this->createUser([], null, true);

    // Create a taxonomy term. Will be automatically cleaned up at the end of the test.
    $vocab = Vocabulary::load('tags');
    $term = $this->createTerm($vocab);

    // Create a "Llama" article. Will be automatically cleaned up at end of test.
    $node = $this->createNode([
      'title' => 'Llama',
      'type' => 'article',
      'field_tags' => [
        'target_id' => $term->id(),
      ],
      'moderation_state' => 'published',
      'uid' => $author->id(),

    ]);
    $node->setPublished()->save();
    $this->assertEquals($author->id(), $node->getOwnerId());

    // We can browse pages.
    $this->drupalGet($node->toUrl());
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->pageTextContains($node->getTitle());
  }

  /**
   * Test the "getArticleType" method of the article bundle class.
   */
  public function testArticleType(): void {
    $node = $this->createNode([
      'title' => 'Llama',
      'type' => 'article',
      'moderation_state' => 'published',
      'body' => 'Lorem Ipsum',
    ]);
    $node->save();
    assert($node instanceof Article);
    $this->assertEquals('Summary', $node->getArticleType());

    $node->set('body', 'Lorem ipsum dolor sit amet');
    $node->save();
    $this->assertEquals('Short report', $node->getArticleType());

    $node->set('body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quam felis suscipit id nunc in');
    $node->save();
    $this->assertEquals('Essay', $node->getArticleType());

    $node->set('body', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quam felis, suscipit id nunc in, commodo rhoncus enim. Nulla finibus justo sit amet justo viverra, id malesuada dui tempor. Nunc sodales, lectus at ornare sagittis, velit mi dapibus est, vitae placerat est tortor id enim.');
    $node->save();
    $this->assertEquals('Research', $node->getArticleType());
  }

}
