<?php

namespace Drupal\graphql_compose_extend\Plugin\GraphQL\DataProducer;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\graphql\GraphQL\Execution\FieldContext;
use Drupal\graphql\Plugin\GraphQL\DataProducer\DataProducerPluginBase;

/**
 * @DataProducer(
 *   id = "current_date_and_time",
 *   name = @Translation("Current date and time"),
 *   description = @Translation("Current date and time."),
 *   produces = @ContextDefinition("any",
 *     label = @Translation("Current date and time")
 *   )
 * )
 */
class CurrentDateAndTime extends DataProducerPluginBase {

  /**
   * Returns the current date and time, cached for min 5 seconds.
   *
   * @param \Drupal\graphql\GraphQL\Execution\FieldContext $context
   *
   * @return string
   *   The current date and time.
   */
  public function resolve(FieldContext $context) {
    $context->addCacheableDependency((new CacheableMetadata())->setCacheMaxAge(5));

    $date = new DrupalDateTime('now', new \DateTimeZone('UTC'));

    return $date->format('Y-m-d H:i:s');
  }

}
